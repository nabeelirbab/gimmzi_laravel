<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\Provider;
use App\Models\ProviderLimitSetting;
use App\Models\ProviderSubType;
use App\Models\ProviderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CommunityPartnerController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/community-list",
     * operationId="Community Partner list",
     * tags={"Community Partner Management"},
     * summary="Community Partner list",
     * security={{"sanctum":{}}},
     * description="Get Community Partner list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Community Partner list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */
    public function communityList()
    {
        try {
            $allCommunity = Provider::with(['sub_type.type', 'floor_plans', 'property_limit' => function ($query) {
                $query->select('id', 'property_id', 'current_allowance_point_limit');
            }])->where('status', 1)->get();

            if (count($allCommunity) > 0) {
                return $this->sendResponse($allCommunity, 'All community partner', 201);
            } else {
                return $this->sendResponse([], 'Something went wrong', 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }
    /**
     * @OA\Get(
     * path="/api/all-provider-type",
     * operationId="Provider Type list",
     * tags={"Community Partner Management"},
     * summary="Provider Type list",
     * security={{"sanctum":{}}},
     * description="Get Provider Type list",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Provider Type list",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */
    public function allType()
    {
        try {
            $type = ProviderType::where('name', 'Residential')->first();
            $allSubtype = ProviderSubType::where('provider_type_id', $type->id)
            ->whereIn('name', ['Apartment Community', 'COA/HOA', 'Others'])
            ->get();
            if (count($allSubtype) > 0) {
                return $this->sendResponse($allSubtype, 'All Subtype of Provider', 201);
            } else {
                return $this->sendResponse([], 'Something went wrong', 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/filter-community",
     * operationId="Filter community partner",
     * tags={"Community Partner Management"},
     * summary="Filter community partner",
     * security={{"sanctum":{}}},
     * description="Filter community partner",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="filter_by_type", type="string", example=""),
     *               @OA\Property(property="filter_by_bed", type="string", example="1/2/3/4"),
     *               @OA\Property(property="filter_by_bath", type="string", example="1/2/3/4"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Filter community partner",
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


    public function filterCommunity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'filter_by_type' => "nullable",
            'filter_by_bed' => "nullable",
            'filter_by_bath' => "nullable",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            $query = Provider::with(['sub_type.type', 'floor_plans'])->where('status', 1);

            if ($request->filter_by_type != null) {
                $query->where('provider_sub_type_id', $request->filter_by_type);
            }
            if ($request->filter_by_bed != null || $request->filter_by_bath != null) {
                $query->whereHas('floor_plans', function ($q) use ($request) {
                    if ($request->filter_by_bed != null) {
                        $q->where(function ($subQuery) use ($request) {
                            $subQuery->where('bedroom_1', $request->filter_by_bed)
                                ->orWhere('bedroom_2', $request->filter_by_bed)
                                ->orWhere('bedroom_3', $request->filter_by_bed);
                        });
                    }

                    if ($request->filter_by_bath != null) {
                        $q->where(function ($subQuery) use ($request) {
                            $subQuery->where('bathroom_1', $request->filter_by_bath)
                                ->orWhere('bathroom_2', $request->filter_by_bath)
                                ->orWhere('bathroom_3', $request->filter_by_bath);
                        });
                    }
                });
            }

            $community = $query->get();

            if ($community->isNotEmpty()) {
                return $this->sendResponse($community, 'Community partner found', 201);
            } else {
                return $this->sendResponse([], 'No community found', 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/community-details/{id}",
     * operationId="Community partner",
     * tags={"Community Partner Management"},
     * summary="Community partner fetch",
     * security={{"sanctum":{}}},
     * @OA\Parameter(
     *    description="Id of community partner",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),
     * description="Get Community partner",
     *      @OA\Response(
     *          response=201,
     *          description="Single busniess profile Fetch done",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function communityDetails($id)
    {
        try {
            $community = Provider::with([
                'sub_type.type', 'floor_plans',
                'property_limit' => function ($query) {
                    $query->select('id', 'property_id', 'current_allowance_point_limit');
                },
                'amenity', 'features'
            ])->where('id', $id)->first();

            if ($community) {
                return $this->sendResponse($community, 'Community partner details fetched', 201);
            } else {
                return $this->sendResponse([], 'No community found', 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/add-favourite-community",
     * operationId="Add favourite community partner",
     * tags={"Community Partner Management"},
     * summary="Add favourite community partner",
     * security={{"sanctum":{}}},
     * description="Add favourite community partner",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"community_id"},
     *               @OA\Property(property="community_id", type="integer"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Add favourite community partner",
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


    public function addFavCommunity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'community_id' => "required|exists:providers,id",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            $community = Provider::find($request->community_id);
            if ($community) {
                $alreadyFav = ConsumerFavouriteTravelTourism::where(['consumer_id' => Auth::id(), 'provider_id' => $request->community_id])->first();
                if ($alreadyFav) {
                    $alreadyFav->delete();
                    return $this->sendResponse([], 'Removed from favourites', 201);
                } else {
                    $addedFav = new ConsumerFavouriteTravelTourism();
                    $addedFav->consumer_id = Auth::id();
                    $addedFav->provider_id = $request->community_id;
                    $addedFav->is_favourite = 1;
                    $addedFav->save();
                    return $this->sendResponse($addedFav, 'Added to favourites', 201);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }



    /**
     * @OA\Post(
     * path="/api/search-community-by-name",
     * operationId="Search community by name",
     * tags={"Community Partner Management"},
     * summary="Search community by name",
     * security={{"sanctum":{}}},
     * description="Search community by name",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name"},
     *               @OA\Property(property="name", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Search community by name",
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

    public function searchByName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            if ($request->name != null) {
                $getCommunity = Provider::where('name', 'LIKE', '%' . trim($request->name) . '%')->where('status', 1)->get();
                if (count($getCommunity) > 0) {
                    return $this->sendResponse($getCommunity, 'Get community partner', 201);
                } else {
                    return $this->sendResponse([], 'No community found', 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

        /**
     * @OA\Post(
     * path="/api/scan-gimmzi-point",
     * operationId="Scan gimmzi point",
     * tags={"Community Partner Management"},
     * summary="Scan gimmzi point",
     * description="Scan gimmzi point",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"zip_code"},
     *               @OA\Property(property="zip_code", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Scan gimmzi point",
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

    public function scanPoint(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zip_code' => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        try {
            if ($request->zip_code != null) {
                $getCommunity = Provider::where('zip_code', 'LIKE', '%' . trim($request->zip_code) . '%')->where('status', 1)->get();
                if (count($getCommunity) > 0) {
                    return $this->sendResponse($getCommunity, 'Get community partner', 201);
                } else {
                    return $this->sendResponse([], 'No community found', 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


}
