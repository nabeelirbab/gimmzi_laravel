<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Mail\BadgeRequestInfoMail;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ListingType;
use App\Models\ProviderAmenity;
use App\Models\ProviderExternalManage;
use App\Models\ProviderFeature;
use App\Models\ProviderMessageBoard;
use App\Models\RequestInfoForListing;
use App\Models\ShortTermRentalListing;
use App\Models\State;
use App\Models\TravelTourism;
use App\Models\TravelTourismFormSubmitAddress;
use App\Models\TravelTourismSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TravelTourismController extends BaseController
{

    /**
     * @OA\Get(
     * path="/api/type-list",
     * operationId="Type of listing list",
     * tags={"Travel Tourism Management"},
     * summary="Type of listing list",
     * security={{"sanctum":{}}},
     * description="Get Type of listing list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Type of listing list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function typeList()
    {
        try {
            $types = ListingType::where('status', 1)->get();
            if (count($types) > 0) {
                return $this->sendResponse($types, 'Type listing fetched', 201);
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/distination-list",
     * operationId="Destionation list",
     * tags={"Travel Tourism Management"},
     * summary="Destionation list",
     * security={{"sanctum":{}}},
     * description="Get Destionation list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Destionation list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function destinationList()
    {
        try {

            $shortRentalStates = TravelTourism::where('status', 1)->where("travel_tourism_type", 'Short Rental')->pluck('id');
            $listing = ShortTermRentalListing::with('states')->whereIn('travel_tourism_id', $shortRentalStates)->select('id', 'city', 'state_id')->get()->makeHidden('photo_img');

            $hotelResortStates = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->with('state')->groupBy('state_id')->select('id', 'city', 'state_id')->get()->makeHidden('hotel_photos');

            $listingCity = $listing->concat($hotelResortStates)->unique();

            if (count($listingCity) > 0) {
                return $this->sendResponse($listingCity, 'Destination listing fetched', 201);
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/travel-tourism-list",
     * operationId="Travel tourism list",
     * tags={"Travel Tourism Management"},
     * summary="Travel tourism List",
     * security={{"sanctum":{}}},
     * description="Get Travel tourism list",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="type_id", type="string", example=""),
     *               @OA\Property(property="location_id", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Get Travel tourism list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */


    public function travelTourismList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => "nullable",
            'location_id' => "nullable"
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $shortTermListings = TravelTourism::with(['listing' => function ($q) {
                $q->where('status', 1);
            }, 'listing.type'])->where("travel_tourism_type", 'Short Rental')->get();

            foreach ($shortTermListings as $list) {
                $points = TravelTourismSettings::where('travel_tourism_id', $list->id)
                ->pluck('badge_bonus_point')
                ->first();
                $list->badge_bonus_points = $points;
            }

            $hotels = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->get();
            foreach ($hotels as $hotel) {
                $points = TravelTourismSettings::where('travel_tourism_id', $hotel->id)
                    ->pluck('badge_bonus_point')
                    ->first();
                $hotel->badge_bonus_points = $points;
            }
            if ($request->type_id != null) {
                $totalList = TravelTourism::where("travel_tourism_type", 'Short Rental')->where(function ($query) use ($request) {
                    $query->whereHas('listing', function ($query) use ($request) {
                        $query->with('type')->where('type_id', $request->type_id)->where('status', 1);
                    });
                })->with(['listing' => function ($query) use ($request) {
                    $query->where('type_id', $request->type_id)->where('status', 1);
                }, 'listing.type'])->get();


                foreach ($totalList as $list) {
                    $points = TravelTourismSettings::where('travel_tourism_id', $list->id)
                        ->pluck('badge_bonus_point')
                        ->first();
                    $list->badge_bonus_points = $points;
                }
            } elseif ($request->location_id != null) {
                $shortTerm =  TravelTourism::where("travel_tourism_type", 'Short Rental')->where(function ($query) use ($request) {
                    $query->whereHas('listing', function ($query) use ($request) {
                        $query->where('state_id', $request->location_id)->where('status', 1);
                    });
                })->with(['listing' => function ($q) use ($request) {
                    $q->where('state_id', $request->location_id);
                }, 'listing.type'])->get();

                $hotel = TravelTourism::where("state_id", $request->location_id)
                    ->where("travel_tourism_type", 'Hotel-Resort')->get();

                $totalList = $shortTerm->concat($hotel);

                foreach ($totalList as $list) {
                    $points = TravelTourismSettings::where('travel_tourism_id', $list->id)
                        ->pluck('badge_bonus_point')
                        ->first();
                    $list->badge_bonus_points = $points;
                }
            } else {
                $totalList = $shortTermListings->concat($hotels);
            }

            if (count($totalList) > 0) {
                return $this->sendResponse($totalList, 'Travel tourism list fetched', 201);
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
    /**
     * @OA\Get(
     * path="/api/short-term-details/{id}",
     * operationId="Short term listing details",
     * tags={"Travel Tourism Management"},
     * summary="Short term listing details fetch",
     * security={{"sanctum":{}}},
     * @OA\Parameter(
     *    description="Id of short term listing",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * description="Get Short term listing details",
     *      @OA\Response(
     *          response=201,
     *          description="Short term listing details Fetch done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function shortTermDetails($id)
    {
        try {
            $data['shortTermList'] = ShortTermRentalListing::with('travel_tourism')->where('id', $id)->first();
            if ($data['shortTermList']) {
                $data['features'] = ProviderFeature::where('listing_id', $id)->where('status', 1)->get();
                $data['amenities'] = ProviderAmenity::where('listing_id', $id)->where('status', 1)->get();
                $data['messageBoard'] = ProviderMessageBoard::with('messageBoard', 'messageBoardtwo')->where('travel_tourism_id',  $data['shortTermList']['travel_tourism_id'])->first();
                $data['externalLink'] = ProviderExternalManage::select('id', 'visit_website_url', 'visit_website_display')->where('listing_id', $id)->where('travel_tourism_id', $data['shortTermList']['travel_tourism_id'])->first();
                $data['morePropertyCount'] = ShortTermRentalListing::where('travel_tourism_id', $data['shortTermList']['travel_tourism_id'])->where('status', 1)->count();
                return $this->sendResponse($data, 'Short Term Listing details fetched', 201);
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Get(
     * path="/api/hotel-resort-details/{id}",
     * operationId="Hotel Resort details",
     * tags={"Travel Tourism Management"},
     * summary="Hotel Resort details fetch",
     * security={{"sanctum":{}}},
     * @OA\Parameter(
     *    description="Id of hotel-resort",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * description="Get Hotel Resort details",
     *      @OA\Response(
     *          response=201,
     *          description="Hotel Resort details Fetch done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function hotelResortDetails($id)
    {
        try {
            $data['hotelResort'] = TravelTourism::where('id', $id)->where('travel_tourism_type', 'Hotel-Resort')->first();
            if ($data['hotelResort']) {
                $data['features'] = ProviderFeature::where('travel_tourism_id', $id)->where('status', 1)->get();
                $data['amenities'] = ProviderAmenity::where('travel_tourism_id', $id)->where('status', 1)->get();
                $data['messageBoard'] = ProviderMessageBoard::with('messageBoard', 'messageBoardtwo')->where('travel_tourism_id',  $data['hotelResort']['id'])->first();
                return $this->sendResponse($data, 'Hotel Resort details fetched', 201);
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/more-properties/{id}",
     * operationId="More properties of short term",
     * tags={"Travel Tourism Management"},
     * summary="More properties of short term fetch",
     * security={{"sanctum":{}}},
     * @OA\Parameter(
     *    description="Id of short term",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * description="Get More properties of short term",
     *      @OA\Response(
     *          response=201,
     *          description="More properties of short term Fetch done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function moreProperties($id)
    {
        try {
            $data['shortTerm'] = TravelTourism::where('id', $id)->where('travel_tourism_type', 'Short Rental')->first();
            if ($data['shortTerm']) {
                $data['moreListing'] = ShortTermRentalListing::with('type')->where(['travel_tourism_id' => $id, 'status' => 1])->get();
                if (count($data['moreListing']) > 0) {
                    return $this->sendResponse($data, 'More properties fetched', 201);
                } else {
                    return $this->sendError('No property found', [], 404);
                }
            } else {
                return $this->sendError('No data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/submit-request-info",
     * operationId="submit register info of listing",
     * tags={"Travel Tourism Management"},
     * summary="Submit register info of listing",
     * description="Submit register info of listing Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"short_term_id", "listing_id","guest_name", "guest_email","guest_phone", "arrive_date","departure_date", "adult","children","comment"},
     *               @OA\Property(property="short_term_id", type="integer", format="text", example=""),
     *               @OA\Property(property="listing_id", type="integer", format="text",example=""),
     *               @OA\Property(property="guest_name", type="string", format="text", example=""),
     *               @OA\Property(property="guest_email", type="string", format="email",example=""),
     *               @OA\Property(property="guest_phone", type="string", format="text",example=""),
     *               @OA\Property(property="arrive_date", type="string", format="text",example=""),
     *               @OA\Property(property="departure_date", type="string", format="text",example=""),
     *               @OA\Property(property="adult", type="string", format="text",example=""),
     *               @OA\Property(property="children", type="string", format="password", example=""),
     *               @OA\Property(property="comment", type="string", format="password",example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="First Register Done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function submitRequestInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'short_term_id' => "required|exists:travel_tourisms,id",
            'listing_id' => "required|exists:short_term_rental_listings,id",
            'guest_name' => ['required'],
            'guest_email' => ['required', 'email'],
            'guest_phone' => ['required'],
            'arrive_date' => ['required', 'date', 'before:departure_date'],
            'departure_date' => ['required', 'date', 'after:arrive_date'],
            'adult' => ['nullable', 'numeric', 'max:99'],
            'children' => ['nullable', 'numeric', 'max:99'],
            'comment' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $request_info = new RequestInfoForListing();
            $request_info->guest_name = $request->guest_name;
            $request_info->guest_email = $request->guest_email;
            $request_info->guest_phone = $request->guest_phone;
            $request_info->arrive_date = $request->arrive_date;
            $request_info->departure_date = $request->departure_date;
            $request_info->adult = $request->adult;
            $request_info->children = $request->children;
            $request_info->comment = $request->comment;
            $request_info->short_term_id = $request->short_term_id;
            $request_info->listing_id = $request->listing_id;
            $request_info->save();
            if ($request_info) {
                $mail_address = [];
                $emails = TravelTourismFormSubmitAddress::where('listing_id', $request->listing_id)->first();
                if ($emails) {
                    if ($emails->first_email_address != null) {
                        array_push($mail_address, $emails->first_email_address);
                    }
                    if ($emails->second_email_address != null) {
                        array_push($mail_address, $emails->second_email_address);
                    }
                    if ($emails->third_email_address != null) {
                        array_push($mail_address, $emails->third_email_address);
                    }
                    if ($emails->fourth_email_address != null) {
                        array_push($mail_address, $emails->fourth_email_address);
                    }
                    if ($emails->fifth_email_address != null) {
                        array_push($mail_address, $emails->fifth_email_address);
                    }

                    if (count($mail_address) > 0) {
                        Mail::to($mail_address)->bcc('brandon.hill@gimmzi.com')->queue(new BadgeRequestInfoMail($request_info));
                        if (!Mail::failures()) {
                            return $this->sendResponse($request_info, 'Request info successfully submitted', 201);
                        }
                    }
                } else {
                    Mail::to('brandon.hill@gimmzi.com')->queue(new BadgeRequestInfoMail($request_info));
                    if (!Mail::failures()) {
                        return $this->sendResponse($request_info, 'Request info successfully submitted', 201);
                    }
                }
            } else {
                return $this->sendError('Not found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/add-favourite-travel-tourism",
     * operationId="Add favourite travel tourism",
     * tags={"Travel Tourism Management"},
     * summary="Add favourite travel tourism",
     * description="Add favourite travel tourism Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"type", "listing_id","hotel_id"},
     *               @OA\Property(property="type", type="string", format="text", example="shortTerm/hotelResort"),
     *               @OA\Property(property="listing_id", type="integer", format="text",example=""),
     *               @OA\Property(property="hotel_id", type="string", format="text", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Added favourite travel tourism",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function addFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => "required|in:shortTerm,hotelResort",
            'listing_id' => "required_if:type,=,shortTerm|exists:short_term_rental_listings,id",
            'hotel_id' => "required_if:type,=,hotelResort|exists:travel_tourisms,id"

        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->type == 'shortTerm') {
                $listing = ShortTermRentalListing::find($request->listing_id);
                if ($listing) {
                    $alreadyAdded = ConsumerFavouriteTravelTourism::where('consumer_id', Auth::id())->where('short_rental_id', $request->listing_id)->first();
                    if ($alreadyAdded) {
                        $alreadyAdded->delete();
                        return $this->sendResponse([], 'Removed from favourites', 201);
                    } else {
                        $addedFav = new ConsumerFavouriteTravelTourism();
                        $addedFav->consumer_id = Auth::id();
                        $addedFav->short_rental_id = $request->listing_id;
                        $addedFav->is_favourite = 1;
                        $addedFav->save();
                        return $this->sendResponse($addedFav, 'Added to favourites', 201);
                    }
                } else {
                    return $this->sendError('Not found', [], 404);
                }
            } elseif ($request->type == 'hotelResort') {
                $hotel = TravelTourism::where('id', $request->hotel_id)->where('travel_tourism_type', 'Hotel-Resort')->first();
                if ($hotel) {
                    $alreadyAdded = ConsumerFavouriteTravelTourism::where('consumer_id', Auth::id())->where('hotel_id', $request->hotel_id)->first();
                    if ($alreadyAdded) {
                        $alreadyAdded->delete();
                        return $this->sendResponse([], 'Removed from favourites', 201);
                    } else {
                        $addedFav = new ConsumerFavouriteTravelTourism();
                        $addedFav->consumer_id = Auth::id();
                        $addedFav->hotel_id = $request->hotel_id;
                        $addedFav->is_favourite = 1;
                        $addedFav->save();
                        return $this->sendResponse($addedFav, 'Added to favourites', 201);
                    }
                } else {
                    return $this->sendError('Not found', [], 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/add-favourite-short-term",
     * operationId="Add favourite Short Term",
     * tags={"Travel Tourism Management"},
     * summary="Add favourite Short Term",
     * description="Add favourite Short Term Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"short_term_id"},
     *               @OA\Property(property="short_term_id", type="integer", format="text", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Added favourite Short Term",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function addFavouriteShortTerm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'short_term_id' => "required|exists:travel_tourisms,id",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $shortTerm = TravelTourism::where('id', $request->short_term_id)->where('travel_tourism_type', 'Short Rental')->first();
            if ($shortTerm) {
                $alreadyAdded = ConsumerFavouriteTravelTourism::where('consumer_id', Auth::id())->where('travel_tourism_id', $request->short_term_id)->first();
                if ($alreadyAdded) {
                    $alreadyAdded->delete();
                    return $this->sendResponse([], 'Removed from favourites', 201);
                } else {
                    $addedFav = new ConsumerFavouriteTravelTourism();
                    $addedFav->consumer_id = Auth::id();
                    $addedFav->travel_tourism_id = $request->short_term_id;
                    $addedFav->is_favourite = 1;
                    $addedFav->save();
                    return $this->sendResponse($addedFav, 'Added to favourites', 201);
                }
            } else {
                return $this->sendError('Not found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/check-short-term-availability",
     * operationId="Check short-term availability",
     * tags={"Travel Tourism Management"},
     * summary="Check short-term availability",
     * description="Check short-term availability Here",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="location", type="string", format="text", example=""),
     *               @OA\Property(property="type_id", type="integer", format="text", example=""),
     *               @OA\Property(property="guest_no", type="string", format="text", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Check short-term availability",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function checkAvailability(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => "nullable",
            'type_id' => "nullable",
            'guest_no' => "nullable"
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        $query = ShortTermRentalListing::with('type', 'travel_tourism')->where('status', 1);

        if ($request->location != null) {
            $query->where('street_address', 'LIKE', '%' . trim($request->location) . '%');
        }

        if (!empty($request->type_id)) {
            $query->where('type_id', $request->type_id);
        }
        $guestNo = (int) $request->guest_no;
        if ($request->guest_no != null) {
            $query->where('no_of_guests', '>=', $guestNo);
        }

        $shortTerm = $query->get();
        foreach ($shortTerm as $list) {
            $points = TravelTourismSettings::where('travel_tourism_id', $list->id)
                ->pluck('badge_bonus_point')
                ->first();
            $list->badge_bonus_points = $points;
        }
        if (count($shortTerm) > 0) {
            return $this->sendResponse($shortTerm, 'Get short term listing', 201);
        } else {
            return $this->sendResponse([], 'No data found', 404);
        }
    }
}
