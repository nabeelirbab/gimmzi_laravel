<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\BusinessCategory;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ConsumerWallet;
use App\Models\Deal;
use App\Models\DealLocation;
use App\Models\LoyaltyRewardLocation;
use App\Models\MerchantLoyaltyProgram;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MarketUniverseController extends BaseController
{


    /**
     * @OA\Get(
     * path="/api/all-category",
     * operationId="Category list",
     * tags={"Market Universe Management"},
     * summary="Category list",
     * description="Get Category list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Category list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */
    public function categoryList()
    {
        try {
            $category_lists = BusinessCategory::where('status', 1)->get();
            if ($category_lists) {
                return $this->sendResponse($category_lists, 'Category found', 201);
            } else {
                return $this->sendError("No Category Found", [], 400);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/all-types",
     * operationId="Type list",
     * tags={"Market Universe Management"},
     * summary="Type list",
     * description="Get Type list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Type list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function typeList()
    {
        try {
            $types = [
                ['value' => 'loyaltyRewards', 'text' => "Loyalty Rewards"],
                ['value' => 'gimmziDeals', 'text' => "Gimmzi Deals"]
            ];
            if ($types) {
                return $this->sendResponse($types, 'Types found', 201);
            } else {
                return $this->sendError("No type Found", [], 400);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Get(
     * path="/api/all-distance",
     * operationId="Distance list",
     * tags={"Market Universe Management"},
     * summary="Distance list",
     * description="Get Distance list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Distance list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function distanceList()
    {
        try {
            $distanceList =
                [
                    ['value' => '5.0', 'text' => "Within 5.0 mi (&lt;10)"],
                    ['value' => '10.0', 'text' => "Within 10.0 mi (&lt;10)"],
                    ['value' => '20.0', 'text' => "Within 20.0 mi (&lt;10+)"],
                    ['value' => '50.0', 'text' => "Within 50.0 mi (&lt;10)"],
                    ['value' => '100.0', 'text' => "Within 100.0 mi (&lt;10)"],
                    ['value' => '250.0', 'text' => "Within 250.0 mi (&lt;10)"],
                ];

            if ($distanceList) {
                return $this->sendResponse($distanceList, 'Distance found', 201);
            } else {
                return $this->sendError("No distance Found", [], 400);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/universe-business-profile",
     * operationId="Business Profile",
     * tags={"Market Universe Management"},
     * summary="Business Profile List",
     * description="Get Business Profile list",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="category_id", type="string", example=""),
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards"),
     *               @OA\Property(property="distance_range", type="string", example="5.0/10.0/20.0/50.0/100.0/250.0"),
     *               @OA\Property(property="lat", type="string", example=""),
     *               @OA\Property(property="long", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Get Business Profile list",
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


    public function businessProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => "nullable|exists:business_categories,id",
            'type' => "nullable|in:gimmziDeals,loyaltyRewards",
            'distance_range' => "nullable",
            'lat' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-90,90",
            'long' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-180,180",

        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            $authUserId = Auth::guard('api')->check() ? Auth::guard('api')->user()->id : null;
            $today = date('Y-m-d');
            $latitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->lat : $request->lat;
            $longitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->long : $request->long;
            $radius = 50;
            // dd($latitude, $longitude);

            $dealsWithinRadius = Deal::where('status', 1)
                ->with('dealLoyalty')
                ->whereHas('dealLocation.location', function ($query) use ($latitude, $longitude, $radius) {
                    $query->where('status', 1)
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->whereRaw(
                            "(3959 * acos(cos(radians(?)) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(?)) 
                        + sin(radians(?)) 
                        * sin(radians(latitude)))) <= ?",
                            [$latitude, $longitude, $latitude, $radius]
                        );
                })
                ->where(function ($query) use ($authUserId) {
                    $query->whereNull('consumer_id')
                        ->when($authUserId, function ($q) use ($authUserId) {
                            $q->orWhere('consumer_id', $authUserId);
                        });

                    if ($authUserId) {
                        $query->whereDoesntHave('consumerWallet', function ($subQuery) use ($authUserId) {
                            $subQuery->where('consumer_id', $authUserId)
                                ->where('is_redeemed', 1); // Exclude if deal is redeemed
                        });
                    }
                })
                ->pluck('id');
            // dd($dealsWithinRadius);


            $loyaltyWithinRadius = MerchantLoyaltyProgram::where('status', 1)
                ->whereHas('loyaltylocations.locations', function ($query) use ($today, $latitude, $longitude, $radius) {
                    $query->where('status', 1)
                        ->whereNotNull('latitude')
                        ->whereNotNull('longitude')
                        ->whereRaw(
                            "
            (3959 * acos(cos(radians(?)) 
            * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) 
            + sin(radians(?)) 
            * sin(radians(latitude)))) <= ?",
                            [$latitude, $longitude, $latitude, $radius]
                        );
                })
                ->pluck('id');



            $business_profiles = BusinessProfile::where(function ($query) use ($today, $dealsWithinRadius, $loyaltyWithinRadius) {
                $query->whereHas('deals', function ($q1) use ($today, $dealsWithinRadius) {
                    $q1->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_Date', '>', $today)
                                ->orWhereNull('end_Date');
                            if (Auth::guard('api')->check()) {
                                $q2->orWhere('consumer_id', Auth::guard('api')->user()->id);
                            }
                        })
                        ->whereIn('id', $dealsWithinRadius);
                })->orWhereHas('loyalty', function ($query) use ($today, $loyaltyWithinRadius) {
                    $query->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_on', '>', $today)
                                ->orWhereNull('end_on');
                        })->whereIn('id', $loyaltyWithinRadius);
                });
            })->with([
                'deals' => function ($query) use ($today, $dealsWithinRadius) {
                    $query->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_Date', '>', $today)
                                ->orWhereNull('end_Date');
                            if (Auth::guard('api')->check()) {
                                $q2->orWhere('consumer_id', Auth::guard('api')->user()->id);
                            }
                        })
                        ->whereIn('id', $dealsWithinRadius);
                },
                'loyalty' => function ($query) use ($today, $loyaltyWithinRadius) {
                    $query->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_on', '>', $today)
                                ->orWhereNull('end_on');
                        })->whereIn('id', $loyaltyWithinRadius);
                },

            ])->withCount([
                'deals as deals_count' => function ($query) use ($today, $dealsWithinRadius) {
                    $query->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_Date', '>', $today)
                                ->orWhereNull('end_Date');
                            if (Auth::guard('api')->check()) {
                                $q2->orWhere('consumer_id', Auth::guard('api')->user()->id);
                            }
                        })
                        ->whereIn('id', $dealsWithinRadius);
                },
                'loyalty as loyalty_count' => function ($query) use ($today, $loyaltyWithinRadius) {
                    $query->where('status', 1)
                        ->where(function ($q2) use ($today) {
                            $q2->whereDate('end_on', '>', $today)
                                ->orWhereNull('end_on');
                        })->whereIn('id', $loyaltyWithinRadius);
                }
            ])->whereHas('locations', function ($subq) {
                $subq->whereNotNull('latitude')->whereNotNull('longitude');
            })->where('status', 1)->get();


            // if ($request->category_id != null) {
            //     $business_profiles = $business_profiles->whereIn('business_category_id', $request->category_id);
            // }

            if ($request->type != null) {
                $query = BusinessProfile::query();


                if ($request->type == 'gimmziDeals') {
                    if ($request->category_id != null) {
                        $categoryIds = $request->category_id;
                        if (!is_array($categoryIds)) {
                            $categoryIds = $categoryIds ? explode(',', $categoryIds) : [];
                        }
                        $query->whereIn('business_category_id', $categoryIds);
                    }

                    $query->with(['deals' => function ($query) use ($today, $dealsWithinRadius) {
                        $query->where('status', 1)
                            ->where(function ($q2) use ($today) {
                                $q2->whereDate('end_Date', '>', $today)
                                    ->orWhereNull('end_Date');
                            })
                            ->whereIn('id', $dealsWithinRadius);
                    }])->whereHas('deals', function ($query) use ($today, $dealsWithinRadius) {
                        $query->where('status', 1)
                            ->where(function ($q2) use ($today) {
                                $q2->whereDate('end_Date', '>', $today)
                                    ->orWhereNull('end_Date');
                            })
                            ->whereIn('id', $dealsWithinRadius);
                    });
                } elseif ($request->type == 'loyaltyRewards') {
                    if ($request->category_id != null) {
                        $categoryIds = $request->category_id;
                        if (!is_array($categoryIds)) {
                            $categoryIds = $categoryIds ? explode(',', $categoryIds) : [];
                        }
                        $query->whereIn('business_category_id', $categoryIds);
                    }
                    $query->with(['loyalty' => function ($query) use ($today, $loyaltyWithinRadius) {
                        $query->where('status', 1)
                            ->where(function ($q2) use ($today) {
                                $q2->whereDate('end_on', '>', $today)
                                    ->orWhereNull('end_on');
                            })->whereIn('id', $loyaltyWithinRadius);
                    }])->whereHas('loyalty', function ($query) use ($today, $loyaltyWithinRadius) {
                        $query->where('status', 1)
                            ->where(function ($q2) use ($today) {
                                $q2->whereDate('end_on', '>', $today)
                                    ->orWhereNull('end_on');
                            })->whereIn('id', $loyaltyWithinRadius);
                    });
                } else {
                    if ($request->category_id != null) {
                        $categoryIds = $request->category_id;
                        if (!is_array($categoryIds)) {
                            $categoryIds = $categoryIds ? explode(',', $categoryIds) : [];
                        }
                        $query->whereIn('business_category_id', $categoryIds);
                    }
                }
                $query->where('status', 1);
                $business_profiles = $query->get()->makeHidden('locations');
            } else {
                if ($request->category_id != null) {
                    $business_profiles = $business_profiles->whereIn('business_category_id', $request->category_id);
                }
            }

            if ($request->type == 'gimmziDeals') {
                foreach ($business_profiles as $profile) {
                    foreach ($profile->deals as $deal) {
                        $minDistance = null;

                        foreach ($deal->dealLocation as $dealLoc) {
                            $location = $dealLoc->location ?? null;
                            if ($location !== null && $location->latitude !== null && $location->longitude !== null) {
                                $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);
                                // Log::debug('Calculated distance:', ['lat1' => $latitude, 'lon1' => $longitude, 'lat2' => $location->latitude, 'lon2' => $location->longitude, 'distance' => $distance, 'deal_id' => $deal->id]);
                                if ($minDistance === null || $distance < $minDistance) {
                                    $minDistance = $distance;
                                    $address = $location->address;
                                }
                            }
                        }
                        if ($minDistance !== null && $minDistance <= 50) {
                            $deal->distance = $minDistance;
                            $deal->address = $address;
                        }
                        unset($deal->dealLocation);
                    }
                }
            } elseif ($request->type == 'loyaltyRewards') {

                foreach ($business_profiles as $profile) {
                    foreach ($profile->loyalty as $loyatlty) {
                        $minDistance = null;
                        foreach ($loyatlty->loyaltylocations as $loyaltyLoc) {
                            $location = $loyaltyLoc->locations ?? null;

                            if ($location && $location->latitude !== null && $location->longitude !== null) {
                                $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);
                                // Log::debug('Calculated distance:', ['lat1' => $latitude, 'lon1' => $longitude, 'lat2' => $location->latitude, 'lon2' => $location->longitude, 'distance' => $distance, 'deal_id' => $deal->id]);

                                if ($minDistance === null || $distance < $minDistance) {
                                    $minDistance = $distance;
                                    $address = $location->address;
                                }
                            }
                        }
                        if ($minDistance !== null && $minDistance <= 50) {
                            $loyatlty->distance = $minDistance;
                            $loyatlty->address = $address;
                        } else {
                            $loyatlty->distance = null;
                        }
                        unset($loyatlty->loyaltylocations);
                    }
                }
            } else {
                foreach ($business_profiles as $profile) {
                    foreach ($profile->deals as $deal) {
                        $minDistance = null;
                        foreach ($deal->dealLocation as $dealLoc) {
                            $location = $dealLoc->location ?? null;
                            if ($location !== null && $location->latitude !== null && $location->longitude !== null) {
                                $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);
                                // Log::debug('Calculated distance:', ['lat1' => $latitude, 'lon1' => $longitude, 'lat2' => $location->latitude, 'lon2' => $location->longitude, 'distance' => $distance, 'deal_id' => $deal->id]);
                                if ($minDistance === null || $distance < $minDistance) {
                                    $minDistance = $distance;
                                    $address = $location->address;
                                }
                            }
                        }
                        if ($minDistance !== null && $minDistance <= 50) {
                            $deal->distance = $minDistance;
                            $deal->address = $address;
                        }
                        unset($deal->dealLocation);
                    }
                }
                foreach ($business_profiles as $profile) {
                    foreach ($profile->loyalty as $loyatlty) {
                        $minDistance = null;
                        foreach ($loyatlty->loyaltylocations as $loyaltyLoc) {
                            $location = $loyaltyLoc->locations ?? null;

                            if ($location && $location->latitude !== null && $location->longitude !== null) {
                                $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);
                                // Log::debug('Calculated distance:', ['lat1' => $latitude, 'lon1' => $longitude, 'lat2' => $location->latitude, 'lon2' => $location->longitude, 'distance' => $distance, 'deal_id' => $deal->id]);

                                if ($minDistance === null || $distance < $minDistance) {
                                    $minDistance = $distance;
                                    $address = $location->address;
                                }
                            }
                        }
                        if ($minDistance !== null && $minDistance <= 50) {
                            $loyatlty->distance = $minDistance;
                            $loyatlty->address = $address;
                        } else {
                            $loyatlty->distance = null;
                        }
                        unset($loyatlty->loyaltylocations);
                    }
                }
            }

            $filtered_profiles = [];

            foreach ($business_profiles as $business) {
                if (!$business->locations) {
                    continue;
                }

                foreach ($business->locations->where('status', 1)->where('participating_type', 'Participating') as $location) {
                    if ($location->latitude !== null && $location->longitude !== null) {
                        $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);

                        if (!$request->has('distance_range') || $distance < (float)$request->distance_range) {
                            $businessClone = clone $business;
                            $businessClone->distance = $distance;
                            $filtered_profiles[] = $businessClone;
                        }
                    }
                }
            }
            usort($filtered_profiles, function ($a, $b) {
                return $a->distance <=> $b->distance;
            });



            if (count($filtered_profiles) > 0) {
                return $this->sendResponse($filtered_profiles, 'Business profile found', 201);
            } else {
                return $this->sendError('No Business profile found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    public function haversineDistance1($lat2, $lon2)
    {
        $earthRadius = 3959; // in miles
        $current_lat = Auth::guard('api')->user()->lat;
        $current_long = Auth::guard('api')->user()->long;
        $dLat = deg2rad($lat2 - $current_lat);
        $dLon = deg2rad($lon2 - $current_long);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($current_lat)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return round($distance, 2);
    }

    private function haversineDistance2($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 3959; // Radius of the earth in miles

        // Ensure all inputs are floats and trimmed
        $lat1 = floatval(trim($lat1));
        $lon1 = floatval(trim($lon1));
        $lat2 = floatval(trim($lat2));
        $lon2 = floatval(trim($lon2));

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c; // Distance in miles


        return round($distance, 2); // Rounded to 2 decimal places
    }

    /**
     * @OA\Post(
     * path="/api/business-profile-details-by-location",
     * operationId="Business Profile by location",
     * tags={"Market Universe Management"},
     * summary="Business Profile by location ",
     * description="Get Business Profile by location ",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"business_id", "location_id"},
     *               @OA\Property(property="business_id", type="integer", example=""),
     *               @OA\Property(property="location_id", type="integer", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Get Business Profile by location ",
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
    public function businessProfileDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_id' => "required",
            'location_id' => "required",
            'lat' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-90,90",
            'long' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-180,180",

        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            $today = date('Y-m-d');
            $latitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->lat : $request->lat;
            $longitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->long : $request->long;
            $business = BusinessProfile::find($request->business_id);
            if ($business) {
                $mainLocation = BusinessLocation::where(['id' => $request->location_id, 'business_profile_id' => $request->business_id])->whereNotNull(['latitude', 'longitude'])->first();
                if ($mainLocation) {
                    $dealIds = DealLocation::where('location_id', $mainLocation->id)->pluck('deal_id');
                    $loyaltyIds = LoyaltyRewardLocation::where('location_id', $mainLocation->id)->pluck('loyalty_program_id');
                    $data['business_profiles'] = BusinessProfile::where('id', $request->business_id)->with(['deals' => function ($query) use ($today, $dealIds) {
                        $query->whereIn('id', $dealIds)
                            ->where('status', 1)
                            ->where(function ($q) use ($today) {
                                $q->whereDate('end_Date', '>', $today)
                                    ->orWhereNull('end_Date');
                            })
                            ->orderBy('id', 'desc')
                            ->where(function ($query) {
                                // Deals with consumer_id null or Auth::guard('api')->user()->id, and also deals which are not redeemed
                                $query->whereNull('consumer_id')
                                    ->when(Auth::guard('api')->check(), function ($q) {
                                        $q->orWhere('consumer_id', Auth::guard('api')->user()->id);
                                    })
                                    ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                        $subQuery->when(Auth::guard('api')->check(), function ($q) {
                                            $q->where('consumer_id', Auth::guard('api')->user()->id);
                                        })->where('is_redeemed', 1); // Exclude if deal is redeemed by Auth::guard('api')->user()->id
                                    });
                            })
                            ->take(5);
                    }, 'loyalty' => function ($query) use ($today, $loyaltyIds) {

                        $query->whereIn('id', $loyaltyIds)
                            ->where('status', 1)
                            ->where(function ($q) use ($today) {
                                $q->whereDate('end_on', '>', $today)
                                    ->orWhereNull('end_on');
                            })
                            ->orderBy('id', 'desc')
                            ->take(2);
                    }, 'merchantBoard' => function ($query) use ($mainLocation) {
                        $query->where('location_id', $mainLocation->id);
                    }, 'category'])->where('status', 1)->first()->makeHidden('locations');

                    $locDistance = null;
                    if ($mainLocation->latitude !== null && $mainLocation->longitude !== null) {
                        $locDistance = $this->haversineDistance2($latitude, $longitude, $mainLocation->latitude, $mainLocation->longitude);

                        $data['business_profiles']['selected_location_distance'] = $locDistance;
                    }



                    $all_locations = BusinessLocation::where('business_profile_id', $request->business_id)->where('id', '!=', $request->location_id)->whereNotNull(['latitude', 'longitude'])->where('status', 1)->get();
                    $distances = [];
                    foreach ($all_locations as $location) {
                        if ($location->latitude !== null && $location->longitude !== null) {
                            $distance = $this->haversineDistance2($latitude, $longitude, $location->latitude, $location->longitude);
                            // dd($distance);
                            $distances[$location->id] = $distance;
                        } else {
                            $distances[$location->id] = null;
                        }
                    }

                    $locations = [];
                    foreach ($all_locations as $location) {
                        if (isset($distances[$location->id]) && $distances[$location->id] !== null) {
                            $location->distance = $distances[$location->id];
                            $locations[] = $location;
                        }
                    }

                    usort($locations, function ($a, $b) {
                        return $a->distance <=> $b->distance;
                    });

                    $data['all_locations'] = $locations;
                    if ($data) {
                        return $this->sendResponse($data, 'Business profile found', 201);
                    } else {
                        return $this->sendError('No Business profile found', [], 404);
                    }
                } else {
                    return $this->sendError('No Location found', [], 404);
                }
            } else {
                return $this->sendError('No Business profile found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/profile-add-favourite",
     * operationId="profile add to favourite",
     * tags={"Market Universe Management"},
     * summary="Profile add to favourite",
     * description="Profile add to favourite",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"business_id"},
     *               @OA\Property(property="business_id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Profile add to favourite",
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
        if (Auth::guard('api')->check()) {
            $validator = Validator::make($request->all(), [
                'business_id' => "required",

            ]);

            if ($validator->fails()) {
                return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
            }
            try {
                $alreadyFav = ConsumerFavouriteTravelTourism::where(['consumer_id' => Auth::guard('api')->user()->id, 'business_id' => $request->business_id, 'is_favourite' => 1])->first();
                if ($alreadyFav) {
                    $alreadyFav->delete();
                    return $this->sendResponse([], 'Removed from favorites', 201);
                } else {
                    $addedFav = new ConsumerFavouriteTravelTourism();
                    $addedFav->consumer_id = Auth::guard('api')->user()->id;
                    $addedFav->business_id = $request->business_id;
                    $addedFav->is_favourite = 1;
                    $addedFav->save();
                    return $this->sendResponse($addedFav, 'Added to favorites', 201);
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return $this->sendError('Server Error!', [], 500);
            }
        } else {
            return $this->sendError('Sign up required', [], 404);
        }
    }


    /**
     * @OA\Post(
     * path="/api/deal-loyalty-add-favourite",
     * operationId="Deal or loyalty add to favourite",
     * tags={"Market Universe Management"},
     * summary="Deal/loyalty add to favourite",
     * description="Deal/loyalty add to favourite",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"type", "deal_id","loyalty_id"},
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards"),
     *               @OA\Property(property="deal_id", type="integer"),
     *               @OA\Property(property="loyalty_id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Deal/loyalty add to favourite",
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


    public function dealLoyaltyAddFavourite(Request $request)
    {

        if (Auth::guard('api')->check()) {
            $validator = Validator::make($request->all(), [
                'type' => "required|in:gimmziDeals,loyaltyRewards",
                'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
                'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",
            ]);

            if ($validator->fails()) {
                return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
            }

            try {
                if ($request->type == 'gimmziDeals') {
                    $alreadyDealFav =  ConsumerFavouriteTravelTourism::where(['consumer_id' => Auth::guard('api')->user()->id, 'deal_id' => $request->deal_id, 'is_favourite' => 1])->first();
                    if ($alreadyDealFav) {
                        $alreadyDealFav->delete();
                        return $this->sendResponse([], 'Deal Removed from favorites', 201);
                    } else {
                        $addedFav = new ConsumerFavouriteTravelTourism();
                        $addedFav->consumer_id = Auth::guard('api')->user()->id;
                        $addedFav->deal_id = $request->deal_id;
                        $addedFav->is_favourite = 1;
                        $addedFav->save();
                        return $this->sendResponse($addedFav, 'Deal Added to favorites', 201);
                    }
                } elseif ($request->type == 'loyaltyRewards') {
                    $alreadyLoyaltyFav =  ConsumerFavouriteTravelTourism::where(['consumer_id' => Auth::guard('api')->user()->id, 'loyalty_id' => $request->loyalty_id, 'is_favourite' => 1])->first();
                    if ($alreadyLoyaltyFav) {
                        $alreadyLoyaltyFav->delete();
                        return $this->sendResponse([], 'Loyalty Removed from favorites', 201);
                    } else {
                        $addedFav = new ConsumerFavouriteTravelTourism();
                        $addedFav->consumer_id = Auth::guard('api')->user()->id;
                        $addedFav->loyalty_id = $request->loyalty_id;
                        $addedFav->is_favourite = 1;
                        $addedFav->save();
                        return $this->sendResponse($addedFav, 'Loyalty Added to favorites', 201);
                    }
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return $this->sendError('Server Error!', [], 500);
            }
        } else {
            return $this->sendError('Sign up required', [], 404);
        }
    }

    /**
     * @OA\Post(
     * path="/api/add-to-my-wallet",
     * operationId="Add to my wallet",
     * tags={"Market Universe Management"},
     * summary="Add to my wallet",
     * description="Add to my wallet",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"business_id", "type","deal_id","loyalty_id"},
     *               @OA\Property(property="business_id", type="integer"),
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards"),
     *               @OA\Property(property="deal_id", type="integer"),
     *               @OA\Property(property="loyalty_id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Add to my wallet",
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

    public function addToMyWallet(Request $request)
    {
        if (Auth::guard('api')->check()) {
            $validator = Validator::make($request->all(), [
                'business_id' => "required",
                'type' => "required|in:gimmziDeals,loyaltyRewards",
                'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
                'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",

            ]);
            if ($validator->fails()) {
                return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
            }

            try {
                if ($request->type == 'gimmziDeals') {
                    $deal = Deal::where(['business_id' => $request->business_id, 'id' => $request->deal_id])->first();
                    if ($deal) {
                        $alreadyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'deal_id' => $request->deal_id, 'consumer_id' => Auth::guard('api')->user()->id])->first();
                        if ($alreadyAdded) {
                            return $this->sendResponse([], 'Already Added to My wallet', 201);
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->deal_id = $deal->id;
                            $addToWallet->points = $deal->point;
                            $addToWallet->save();
                            return $this->sendResponse($addToWallet, 'Deal added to wallet', 201);
                        }
                    } else {
                        return $this->sendError('No deal found', [], 404);
                    }
                } elseif ($request->type == 'loyaltyRewards') {
                    $loyalty = MerchantLoyaltyProgram::where(['business_profile_id' => $request->business_id, 'id' => $request->loyalty_id])->first();
                    if ($loyalty) {
                        $alreadyLoyaltyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'loyalty_id' => $request->loyalty_id, 'consumer_id' => Auth::guard('api')->user()->id])->first();
                        if ($alreadyLoyaltyAdded) {
                            return $this->sendResponse([], 'Already Added to My wallet', 201);
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->loyalty_id = $loyalty->id;
                            $addToWallet->points = $loyalty->program_points;
                            $addToWallet->save();
                            return $this->sendResponse($addToWallet, 'Loyalty Punch Card added to wallet', 201);
                        }
                    } else {
                        return $this->sendError('No loyalty found', [], 404);
                    }
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return $this->sendError('Server Error!', [], 500);
            }
        } else {
            return $this->sendError('Sign in to save this deal and redeem rewards!', [], 404);
        }
    }


    /**
     * @OA\Post(
     * path="/api/deal-loyalty-details",
     * operationId="Get Deal or LOyalty Details",
     * tags={"Market Universe Management"},
     * summary="Get Deal or LOyalty Details",
     * security={{"sanctum":{}}},
     * description="Get Deal or LOyalty Details",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"type","deal_id","loyalty_id"},
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards"),
     *               @OA\Property(property="deal_id", type="integer"),
     *               @OA\Property(property="loyalty_id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Get Deal or LOyalty Details",
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

    public function getDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'type' => "required|in:gimmziDeals,loyaltyRewards",
            'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
            'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",

        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->deal_id != null) {
                $today = date('Y-m-d');
                $details = Deal::where('id', $request->deal_id)->where(function ($query) use ($today) {
                    $query->whereDate('end_Date', '>', $today)->orWhereNull('end_Date');
                })->first();
                $message = 'Deal found';
            } elseif ($request->loyalty_id != null) {

                $today = date('Y-m-d');
                $details = MerchantLoyaltyProgram::where('id', $request->loyalty_id)->where(function ($query) use ($today) {
                    $query->whereDate('end_on', '>', $today)->orWhereNull('end_on');
                })->first();
                $message = 'Loyalty found';
            } else {
                $message = 'No data found';
            }

            if ($details) {
                return $this->sendResponse($details, $message, 201);
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
     * path="/api/search-business-profile",
     * operationId="Search business profile",
     * tags={"Market Universe Management"},
     * summary="Search business profile",
     * description="Search business profile",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name"},
     *               @OA\Property(property="name", type="string", example=""),
     *               @OA\Property(property="lat", type="string", example=""),
     *               @OA\Property(property="long", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Search business profile",
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


    public function searchBusiness(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => "required",
            'lat' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-90,90",
            'long' => Auth::guard('api')->check() ? "nullable" : "required|numeric|between:-180,180",

        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->name != null) {
                $today = date('Y-m-d');
                $business_profiles = BusinessProfile::where('business_name', 'like', '%' . trim($request->name) . '%')->where(function ($query) use ($today) {
                    $query->whereHas('deals', function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_Date', '>', $today)->orWhereNull('end_Date');
                    })->orWhereHas('loyalty', function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_on', '>', $today)->orWhereNull('end_on');
                    });
                })->where('status', 1)->select('id', 'business_name')->get()->makeHidden(['locations', 'multiple_images', 'story_image_url', 'formatted_location']);

                $distances = [];
                foreach ($business_profiles as $business) {
                    $latitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->lat : $request->lat;
                    $longitude = Auth::guard('api')->check() ? Auth::guard('api')->user()->long : $request->long;
                    $validLocation = $business->locations
                        ? $business->locations->where('status', 1)->where('participating_type', 'Participating')->first()
                        : null;
                    if ($validLocation !== null && $validLocation->latitude !== null && $validLocation->longitude !== null) {
                        $distance = $this->haversineDistance2($latitude, $longitude, $validLocation->latitude, $validLocation->longitude);
                        // dd($distance);

                        $distances[$business->id] = $distance;
                    } else {

                        $distances[$business->id] = null;
                    }
                }

                $filtered_profiles = [];
                foreach ($business_profiles as $profile) {
                    if (isset($distances[$profile->id]) && $distances[$profile->id] !== null) {
                        $profile->distance = $distances[$profile->id];
                        // $filtered_profiles[] = $profile;
                        if (!$request->has('distance_range') || $profile->distance < (float)$request->distance_range) {
                            $filtered_profiles[] = $profile;
                        }
                    }
                }

                if (count($filtered_profiles) > 0) {
                    return $this->sendResponse($filtered_profiles, 'Business Profile Fetched', 201);
                } else {
                    return $this->sendError('No data found', [], 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
}
