<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Cms;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ConsumerWallet;
use App\Models\Deal;
use App\Models\MerchantLoyaltyProgram;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\TempUser;
use App\Models\TermsAndCondition;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\Models\Media;

/**
 * @group  User Authentication
 *
 * APIs for managing basic auth functionality
 */
class UserController extends BaseController
{

    /**
     * @OA\Get(
     * path="/api/my-profile",
     * operationId="Profile",
     * tags={"User Management"},
     * summary="User Profile",
     * description="Get User Profile",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched profile",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */


    public function myProfile()
    {
        try {
            if (Auth::guard('api')->check()) {
                $user = Auth::guard('api')->user();
                if ($user) {
                    $today = now()->toDateString();
                    $data['user'] = $user;

                    $data['deals'] = ConsumerWallet::where('consumer_id', $user->id)
                        ->whereNotNull('deal_id')
                        ->whereNull('loyalty_id')
                        ->whereHas('deal', function ($query) use ($today, $user) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) use ($user) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', $user->id);
                                });
                        })->count();

                    $data['loyalty'] = ConsumerWallet::where('consumer_id', $user->id)
                        ->whereNotNull('loyalty_id')
                        ->whereNull('deal_id')
                        ->whereHas('loyalty', function ($query) use ($today, $user) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) use ($user) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', $user->id);
                                });
                        })->count();

                    return $this->sendResponse($data, 'My profile fetched');
                } else {
                    return $this->sendResponse([], 'No User found', 202);
                }
            } else {
                return $this->sendResponse([], 'Sign In required', 401);
            }
        } catch (\Throwable $th) {
            Log::error("EXCEPTION: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/edit-my-profile",
     * operationId="Profile Update",
     * tags={"User Management"},
     * summary="User Profile Update",
     * security={{"sanctum":{}}},
     * description="Update User Profile",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="first_name", type="string", format="text", example=""),
     *               @OA\Property(property="last_name", type="string", format="text", example=""),
     *               @OA\Property(property="phone", type="string", format="text", example=""),
     *               @OA\Property(property="dob", type="string", format="text", example=""),
     *               @OA\Property(property="zip_code", type="string", format="text", example=""),
     *               @OA\Property(property="user_photo", type="file", format="text", example=""),  
     *               @OA\Property(property="old_password", type="string", format="text", example=""),   
     *               @OA\Property(property="new_password", type="string", format="text", example=""),         
     *            ),
     *        ),
     *    ),   
     *      @OA\Response(
     *          response=200,
     *          description="Fetched profile",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function editProfile(Request $request)
    {
        $user = User::find(Auth::guard('api')->user()->id);
        $inputs = $request->all();
        $validator  =   Validator::make($request->all(), [
            "first_name" => 'nullable',
            "last_name" => 'nullable',
            "phone"  =>  ['nullable', 'digits_between:10,15', Rule::unique('users')->ignore($user->id)],
            "dob" => "nullable",
            "zip_code" => "nullable",
            "user_photo" => "nullable|mimes:jpg,jpeg,png",
            "old_password" => "nullable",
            "new_password" => "nullable|regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20"
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->hasFile('user_photo')) {
                $getphoto = Media::where(['model_id' => $user->id, 'collection_name' => 'consumerImage'])->first();
                if ($getphoto) {
                    $getphoto->delete();
                }
                $userphoto = $user->addMedia($request->user_photo->getRealPath())
                    ->usingName($request->user_photo->getClientOriginalName())
                    ->toMediaCollection('consumerImage');
            }
            if ($request->first_name != null) {
                $user->first_name = $request->first_name;
            }
            if ($request->last_name != null) {
                $user->last_name = $request->last_name;
            }
            if ($request->phone != null) {
                $user->phone = $request->phone;
            }
            if ($request->dob != null) {
                $user->date_of_birth = $request->dob;
            }
            if ($request->zip_code != null) {
                $user->zip_code = $request->zip_code;
            }
            $user->save();
            if ($request->old_password != null) {
                if ($request->new_password != null) {
                    if (strcmp($request->old_password, $request->new_password) == 0) {
                        return $this->sendError('New Password cannot be same as current password.', [], 404);
                    }
                    if (Hash::check($request->old_password, $user->password)) {
                        $user->password = $request->new_password;
                        $user->save();
                        return $this->sendResponse([], 'Password Changed Successfully', 201);
                    } else {
                        return $this->sendError('Current password is invalid', [], 404);
                    }
                } else {
                    return $this->sendError('New Password is required', [], 404);
                }
            }

            if ($user) {
                return $this->sendResponse($user, 'My profile Updated.', 201);
            } else {
                return $this->sendError('Something went wrong.', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/my-favourite-list",
     * operationId="Get Favourite List",
     * tags={"User Management"},
     * summary="Favourite List",
     * description="Get Favourite List",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Favourite List",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function favouriteList()
    {
        try {
            if (Auth::guard('api')->check()) {
                $today = date('Y-m-d');
                $latitude = Auth::guard('api')->user()->lat;
                $longitude = Auth::guard('api')->user()->long;
                $radius = 50;

                $dealsWithinRadius = Deal::where('status', 1)
                    ->whereHas('dealLocation.location', function ($query) use ($today, $latitude, $longitude, $radius) {
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
                    ->where(function ($query) {
                        $query->whereNull('consumer_id')
                            ->orWhere('consumer_id', Auth::guard('api')->user()->id)
                            ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                $subQuery->where('consumer_id', Auth::guard('api')->user()->id)
                                    ->where('is_redeemed', 1); // Exclude if deal is redeemed by Auth::guard('api')->user()->id
                            });
                    })->pluck('id');

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

                $today = date('Y-m-d');
                $favList = ConsumerFavouriteTravelTourism::with([
                    'business' => function ($query) use ($today, $dealsWithinRadius) {
                        $query->withCount([
                            'deals as deals_count' => function ($q) use ($today, $dealsWithinRadius) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_Date', '>', $today)
                                            ->orWhereNull('end_Date');
                                    })->where(function ($query) {
                                        $query->whereNull('consumer_id')
                                            ->orWhere('consumer_id', Auth::guard('api')->user()->id)
                                            ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                                $subQuery->where('consumer_id', Auth::guard('api')->user()->id)
                                                    ->where('is_redeemed', 1);
                                            });
                                    });
                            },
                            'loyalty as loyalty_count' => function ($q) use ($today) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_on', '>', $today)
                                            ->orWhereNull('end_on');
                                    });
                            }
                        ]);
                    },
                    'deal.businessProfile' => function ($query) use ($today, $dealsWithinRadius) {
                        $query->withCount([
                            'deals as deals_count' => function ($q) use ($today) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_Date', '>', $today)
                                            ->orWhereNull('end_Date');
                                    })->where(function ($query) {
                                        $query->whereNull('consumer_id')
                                            ->orWhere('consumer_id', Auth::guard('api')->user()->id)
                                            ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                                $subQuery->where('consumer_id', Auth::guard('api')->user()->id)
                                                    ->where('is_redeemed', 1);
                                            });
                                    });
                            },
                            'loyalty as loyalty_count' => function ($q) use ($today) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_on', '>', $today)
                                            ->orWhereNull('end_on');
                                    });
                            }
                        ]);
                    },
                    'loyalty.businessProfile' => function ($query) use ($today) {
                        $query->withCount([
                            'loyalty as loyalty_count' => function ($q) use ($today) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_on', '>', $today)
                                            ->orWhereNull('end_on');
                                    });
                            },
                            'deals as deals_count' => function ($q) use ($today) {
                                $q->where('status', 1)
                                    ->where(function ($q2) use ($today) {
                                        $q2->whereDate('end_Date', '>', $today)
                                            ->orWhereNull('end_Date');
                                    })->where(function ($query) {
                                        $query->whereNull('consumer_id')
                                            ->orWhere('consumer_id', Auth::guard('api')->user()->id)
                                            ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                                $subQuery->where('consumer_id', Auth::guard('api')->user()->id)
                                                    ->where('is_redeemed', 1);
                                            });
                                    });
                            },
                        ]);
                    }
                ])->where('consumer_id', Auth::guard('api')->user()->id)->get();

                foreach ($favList as $fav) {
                    if ($fav->business) {
                        $latitude = Auth::guard('api')->user()->lat;
                        $longitude = Auth::guard('api')->user()->long;

                        $validLocation = $fav->business->locations
                            ? $fav->business->locations->where('status', 1)->where('participating_type', 'Participating')->first()
                            : null;

                        if ($validLocation !== null && $validLocation->latitude !== null && $validLocation->longitude !== null) {
                            $distance = $this->haversineDistance($latitude, $longitude, $validLocation->latitude, $validLocation->longitude);
                            $distances[$fav->business->id] = $distance;
                        } else {
                            $distances[$fav->business->id] = null;
                        }
                    } else {
                        $distances[$fav->id] = null;
                    }

                    if (isset($fav->business) && isset($distances[$fav->business->id]) && $distances[$fav->business->id] !== null) {
                        $fav->business->distance = $distances[$fav->business->id];
                    }

                    if (isset($fav->business)) {
                        $fav->business->makeHidden('locations');
                    }
                }

                if (count($favList) > 0) {
                    return $this->sendResponse($favList, 'Favourite List', 201);
                } else {
                    return $this->sendError('No data found', [], 404);
                }
            } else {
                return $this->sendError('Sign up required', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }



    /**
     * @OA\Post(
     * path="/api/save-preferences",
     * operationId="save Preference",
     * tags={"User Management"},
     * summary="User save Preference",
     * security={{"sanctum":{}}},
     * description="Update User Preference",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="communication_settings", type="string", format="text", example="email_and_text/email_only/text_only"),
     *               @OA\Property(property="newsletter", type="boolean", format="text", example=""),
     *               @OA\Property(property="gimmzi_update", type="boolean", format="text", example=""),
     *               @OA\Property(property="special_promotion_offer", type="boolean", format="text", example=""),  
     *               @OA\Property(property="gimmzi_upcoming_event", type="boolean", format="text", example=""),   
     *               @OA\Property(property="unsubscribe_from_all", type="boolean", format="text", example=""),         
     *            ),
     *        ),
     *    ),   
     *      @OA\Response(
     *          response=200,
     *          description="Save user preference",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function savePreference(Request $request)
    {

        try {
            $user = Auth::guard('api')->user()->id;
            if ($user) {
                if ($request->communication_settings == 'email_and_text') {
                    $user->communication_setting = 'email_and_text';
                } elseif ($request->communication_settings == 'email_only') {
                    $user->communication_setting = 'email_only';
                } elseif ($request->communication_settings == 'text_only') {
                    $user->communication_setting = 'text_only';
                } else {
                    $user->communication_setting = ' ';
                }
                if ($request->newsletter == '1') {
                    $user->newsletter = 1;
                } else {
                    $user->newsletter = 0;
                }
                if ($request->gimmzi_update == '1') {
                    $user->gimmzi_update = 1;
                } else {
                    $user->gimmzi_update = 0;
                }
                if ($request->special_promotion_offer == '1') {
                    $user->special_promotion_offer = 1;
                } else {
                    $user->special_promotion_offer = 0;
                }
                if ($request->gimmzi_upcoming_event == '1') {
                    $user->gimmzi_upcoming_event = 1;
                } else {
                    $user->gimmzi_upcoming_event = 0;
                }
                if ($request->unsubscribe_from_all == '1') {
                    $user->unsubscribe_from_all = 1;
                    $user->gimmzi_upcoming_event = 0;
                    $user->special_promotion_offer = 0;
                    $user->gimmzi_update = 0;
                    $user->newsletter = 0;
                } else {
                    $user->unsubscribe_from_all = 0;
                }
                $user->save();
                return $this->sendResponse($user, 'Preference saved successfully', 201);
            } else {
                return $this->sendError('Not data found', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     * path="/api/currect-location",
     * operationId="Check Current Location",
     * tags={"User Management"},
     * summary="Check Current Location",   
     * security={{"sanctum":{}}},
     * description="Check Current Location",
     *     @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"current_lat", "current_long"},
     *               @OA\Property(property="current_lat", type="string", format="email", example=""),
     *               @OA\Property(property="current_long", type="string", format="email", example="")
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=201,
     *          description="Reset Email Sent",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Email Not Found",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */

    public function currentLocation(Request $request)
    {

        $validator  =   Validator::make(
            $request->all(),
            [
                "current_lat" =>  "required",
                "current_long" => "required"
            ]
        );
        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }

        if ($request->current_lat && $request->current_long) {
            $user = Auth::guard('api')->user();
            $user->update([
                'lat' => $request->current_lat,
                'long' => $request->current_long
            ]);
            return $this->sendResponse($user, 'Current Location updated', 201);
        }
    }

    /**
     * @OA\Get(
     * path="/api/add-wallet-count",
     * operationId="Add wallet count",
     * tags={"User Management"},
     * summary="Wallet count",
     * description="Add wallet count",
     *      @OA\Response(
     *          response=200,
     *          description="Add wallet count",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function addWalletCount()
    {
        try {
            if (Auth::guard('api')->check()) {
                $totalWallet = ConsumerWallet::where('consumer_id', Auth::guard('api')->user()->id)
                    ->where(function ($query) {
                        $query->whereHas('deal', function ($subQuery) {
                            $subQuery->whereHas('consumerLoyalty', function ($subSubQuery) {
                                $subSubQuery->where('is_complete_redeemed', 0);
                            });
                        })->whereHas('loyalty', function ($subQuery) {
                            $subQuery->whereHas('consumerLoyalty', function ($subSubQuery) {
                                $subSubQuery->where('is_complete_redeemed', 0);
                            });
                        })->orWhere('is_redeemed', 0);
                    })->count();
                return $this->sendResponse($totalWallet, 'Total wallet count', 201);
            } else {
                return $this->sendError('Sign up required', [], 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Post(
     *     path="/api/delete-consumer",
     *     operationId="DeleteConsumer",
     *     tags={"User Management"},
     *     summary="Delete Consumer Account",
     *     security={{"sanctum":{}}},
     *     description="Deletes the authenticated consumer's account",
     *     @OA\Response(
     *         response=200,
     *         description="Account deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Your account has been deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="User not found!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Server Error!")
     *         )
     *     )
     * )
     */


    public function deleteConsumer()
    {
        try {
            $userId =  Auth::guard('api')->user()->id;

            if (!$userId) {
                return $this->sendError('User not authenticated!', [], 401);
            }

            ConsumerWallet::where('consumer_id', $userId)->delete();
            $user = User::find($userId);
            if ($user) {
                $user->tokens()->delete();
                $user->delete();
            }

            return $this->sendResponse([], 'Your account has been deleted successfully.');
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    public function haversineDistance($lat2, $lon2)
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
}
