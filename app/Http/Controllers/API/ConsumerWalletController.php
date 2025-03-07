<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\ConsumerLoyaltyReward;
use App\Models\ConsumerLoyaltyRewardRedemption;
use App\Models\ConsumerWallet;
use App\Models\Deal;
use App\Models\DealLocation;
use App\Models\LoyaltyProgramItem;
use App\Models\MerchantLoyaltyProgram;
use App\Models\ShortTermGuestBadge;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ConsumerWalletController extends BaseController
{

    /**
     * @OA\Post(
     * path="/api/my-wallet-list",
     * operationId="My wallet List",
     * tags={"Consumer Wallet Management"},
     * summary="My wallet List",
     * security={{"sanctum":{}}},
     * description="My wallet List",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards/walletBadges"),
     *               @OA\Property(property="filter_by", type="string", example="is_expired/is_redeemed/is_active"),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="My wallet List",
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

    public function walletList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => "nullable|in:gimmziDeals,loyaltyRewards,walletBadges",
            'filter_by' => "nullable|in:is_expired,is_redeemed,is_active"
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            $query = ConsumerWallet::query()->where('consumer_id', Auth::guard('api')->user()->id);
            $today = date('Y-m-d');
            if ($request->type != null) {
                if ($request->type == 'gimmziDeals') {
                    if ($request->filter_by == 'is_active') {
                        $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location'])->whereHas('deal', function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date')->orWhere('consumer_id', Auth::guard('api')->user()->id);
                                })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        })->withCount('deal as active_deals_count');

                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'deal as expired_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '<', $today);
                            },
                            'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_on', '<', $today);
                            },
                        ]);
                        $message = 'Active deals';
                    } elseif ($request->filter_by == 'is_expired') {
                        $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location'])->whereHas('deal', function ($query) use ($today) {
                            $query->where('status', 1)->whereDate('end_Date', '<', $today);
                        })->withCount('deal as expired_deals_count');
                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'deal as active_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date');
                                })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as active_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->where(function ($subquery) use ($today) {
                                        $subquery->whereDate('end_on', '>=', $today)
                                            ->orWhereNull('end_on');
                                    })
                                    ->orWhereHas('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 0)->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Expried Business Profile with deal';
                    } elseif ($request->filter_by == 'is_redeemed') {

                        $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location'])->whereNotNull('deal_id')->whereHas('deal', function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        })->withCount([
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                        ]);

                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as expired_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '<', $today);
                            },
                            'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_on', '<', $today);
                            },
                            'deal as active_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date');
                                })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as active_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->where(function ($subquery) use ($today) {
                                        $subquery->whereDate('end_on', '>=', $today)
                                            ->orWhereNull('end_on');
                                    })
                                    ->orWhereHas('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 0)->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Redeemed deals';
                    } else {
                        $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location'])->whereHas('deal', function ($query) {
                            $query->where('status', 1);
                        })->withCount([
                            'deal as expired_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '<', $today);
                            },
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'deal as active_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '>=', $today)->orWhereNull('end_Date')->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)
                                            ->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Business Profile with deals';
                    }
                } elseif ($request->type == 'loyaltyRewards') {
                    if ($request->filter_by == 'is_active') {
                        $query->with(['loyalty', 'loyalty.loyaltylocations.locations'])->whereHas('loyalty', function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        })->withCount('loyalty as active_loyalty_count');

                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'deal as expired_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '<', $today);
                            },
                            'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_on', '<', $today);
                            },
                        ]);
                        $message = 'Active Loyalty punch card';
                    } elseif ($request->filter_by == 'is_expired') {
                        $query->with(['loyalty', 'loyalty.loyaltylocations.locations'])->whereHas('loyalty', function ($query) use ($today) {
                            $query->where('status', 1)->whereDate('end_on', '<', $today);
                        })->withCount('loyalty as expired_loyalty_count');

                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as redeemed_deals_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'deal as active_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date');
                                })
                                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)
                                            ->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                            'loyalty as active_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->where(function ($subquery) use ($today) {
                                        $subquery->whereDate('end_on', '>=', $today)
                                            ->orWhereNull('end_on');
                                    })
                                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Expried Business Profile with Loyalty punch cards';
                    } elseif ($request->filter_by == 'is_redeemed') {

                        $query->with(['loyalty', 'loyalty.loyaltylocations.locations'])->whereNotNull('loyalty_id')->whereHas('loyalty', function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        })->withCount([
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                        ]);
                        $filter = ConsumerWallet::query();
                        $filter->withCount([
                            'deal as expired_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_Date', '<', $today);
                            },
                            'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_on', '<', $today);
                            },
                            'deal as active_deals_count' => function ($query) use ($today) {
                                $query->where('status', 1)->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_Date', '>=', $today)
                                        ->orWhereNull('end_Date');
                                })
                                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)
                                            ->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                            'loyalty as active_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->where(function ($subquery) use ($today) {
                                        $subquery->whereDate('end_on', '>=', $today)
                                            ->orWhereNull('end_on');
                                    })
                                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Redeemed loyalty';
                    } else {
                        $query->with(['loyalty', 'loyalty.loyaltylocations.locations'])->whereHas('loyalty', function ($query) {
                            $query->where('status', 1);
                        })->withCount([
                            'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->whereDate('end_on', '<', $today);
                            },
                            'loyalty as redeemed_loyalty_count' => function ($q) {
                                $q->whereHas('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                            },
                            'loyalty as active_loyalty_count' => function ($query) use ($today) {
                                $query->where('status', 1)
                                    ->where(function ($subquery) use ($today) {
                                        $subquery->whereDate('end_on', '>=', $today)
                                            ->orWhereNull('end_on');
                                    })
                                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                        $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                    });
                            },
                        ]);
                        $message = 'Business Profile with Loyalty punch cards';
                    }
                }
            } elseif ($request->filter_by != null) {
                if ($request->filter_by == 'is_active') {

                    $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location', 'loyalty', 'loyalty.loyaltylocations.locations'])->whereHas('deal', function ($query) use ($today) {
                        $query->where('status', 1)->where(function ($subquery) use ($today) {
                            $subquery->whereDate('end_Date', '>=', $today)
                                ->orWhereNull('end_Date')->orWhere('consumer_id', Auth::guard('api')->user()->id);
                        })->whereDoesntHave('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)
                                ->where('consumer_id', Auth::guard('api')->user()->id);
                        });
                    })->orWhereHas('loyalty', function ($query) use ($today) {
                        $query->where('status', 1)->where(function ($subquery) use ($today) {
                            $subquery->whereDate('end_on', '>=', $today)
                                ->orWhereNull('end_on');
                        })
                            ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                    })->withCount([
                        'deal as active_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)->where(function ($subquery) use ($today) {
                                $subquery->whereDate('end_Date', '>=', $today)
                                    ->orWhereNull('end_Date');
                            })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)
                                        ->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        },
                        'loyalty as active_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        },

                    ]);
                    $filter = ConsumerWallet::query();
                    $filter->withCount([
                        'deal as redeemed_deals_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as redeemed_loyalty_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'deal as expired_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_Date', '<', $today);
                        },
                        'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_on', '<', $today);
                        },
                    ]);
                    $message = 'Expried Business Profile';
                } elseif ($request->filter_by == 'is_expired') {
                    $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location', 'loyalty', 'loyalty.loyaltylocations.locations'])->whereHas('deal', function ($query) use ($today) {
                        $query->where('status', 1)->whereDate('end_Date', '<', $today);
                    })->orWhereHas('loyalty', function ($query) use ($today) {
                        $query->where('status', 1)->whereDate('end_on', '<', $today);
                    })->withCount([
                        'deal as expired_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_Date', '<', $today);
                        },
                        'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_on', '<', $today);
                        }
                    ]);
                    $filter = ConsumerWallet::query();
                    $filter->withCount([
                        'deal as redeemed_deals_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as redeemed_loyalty_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'deal as active_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)->where(function ($subquery) use ($today) {
                                $subquery->whereDate('end_Date', '>=', $today)
                                    ->orWhereNull('end_Date');
                            })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)
                                    ->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as active_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        },
                    ]);
                    $message = 'Expried Business Profile';
                } elseif ($request->filter_by == 'is_redeemed') {
                    $query->whereHas('deal', function ($q) {
                        $q->whereHas('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                        });
                    })->orWhereHas('loyalty', function ($q) {
                        $q->whereHas('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                        });
                    })->withCount([
                        'deal as redeemed_deals_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as redeemed_loyalty_count' => function ($q) {
                            $q->whereHas('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                    ]);


                    $filter = ConsumerWallet::query();
                    $filter->withCount([
                        'deal as expired_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_Date', '<', $today);
                        },
                        'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->whereDate('end_on', '<', $today);
                        },
                        'deal as active_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)->where(function ($subquery) use ($today) {
                                $subquery->whereDate('end_Date', '>=', $today)
                                    ->orWhereNull('end_Date');
                            })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)
                                    ->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as active_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        },
                    ]);

                    $message = 'Redeemed profiles';
                }
            } else {

                $query->with(['deal', 'deal.dealLoyalty', 'deal.dealLocation.location', 'loyalty', 'loyalty.loyaltylocations.locations'])->withCount([
                    'deal as expired_deals_count' => function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_Date', '<', $today);
                    },
                    'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_on', '<', $today);
                    },
                ])->withCount([
                    'deal as redeemed_deals_count' => function ($q) {
                        $q->whereHas('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                        });
                    },
                    'loyalty as redeemed_loyalty_count' => function ($q) {
                        $q->whereHas('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                        });
                    },
                ])->withCount(
                    [
                        'deal as active_deals_count' => function ($query) use ($today) {
                            $query->where('status', 1)->where(function ($subquery) use ($today) {
                                $subquery->whereDate('end_Date', '>=', $today)
                                    ->orWhereNull('end_Date');
                            })->whereDoesntHave('consumerLoyalty', function ($subq) {
                                $subq->where('is_complete_redeemed', 1)
                                    ->where('consumer_id', Auth::guard('api')->user()->id);
                            });
                        },
                        'loyalty as active_loyalty_count' => function ($query) use ($today) {
                            $query->where('status', 1)
                                ->where(function ($subquery) use ($today) {
                                    $subquery->whereDate('end_on', '>=', $today)
                                        ->orWhereNull('end_on');
                                })
                                ->whereDoesntHave('consumerLoyalty', function ($subq) {
                                    $subq->where('is_complete_redeemed', 1)->where('consumer_id', Auth::guard('api')->user()->id);
                                });
                        },
                    ]
                );

                $message = 'All Business Profile deals and loyalty rewards';
            }

            $updatedBusiness = $query->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();


            if ($request->type == 'gimmziDeals') {
                if ($request->filter_by == 'is_active') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalActiveCount = $updatedBusiness->sum('active_deals_count');
                    $totalExpiredCount = $filterdata->sum('expired_deals_count');
                    $totalRedeemedCount = $filterdata->sum('redeemed_deals_count');
                } elseif ($request->filter_by == 'is_expired') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalExpiredCount = $updatedBusiness->sum('expired_deals_count');
                    $totalRedeemedCount = $filterdata->sum('redeemed_deals_count');
                    $totalActiveCount = $filterdata->sum('active_deals_count');
                } elseif ($request->filter_by == 'is_redeemed') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalExpiredCount = $filterdata->sum('expired_deals_count');
                    $totalRedeemedCount = $updatedBusiness->sum('redeemed_deals_count');
                    $totalActiveCount = $filterdata->sum('active_deals_count');
                } else {
                    $totalExpiredCount = $updatedBusiness->sum('expired_deals_count');
                    $totalRedeemedCount = $updatedBusiness->sum('redeemed_deals_count');
                    $totalActiveCount = $updatedBusiness->sum('active_deals_count');
                }
            } elseif ($request->type == 'loyaltyRewards') {
                if ($request->filter_by == 'is_active') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalActiveCount = $updatedBusiness->sum('active_loyalty_count');
                    $totalExpiredCount = $filterdata->sum('expired_loyalty_count');
                    $totalRedeemedCount = $filterdata->sum('redeemed_loyalty_count');
                } elseif ($request->filter_by == 'is_expired') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalExpiredCount =  $updatedBusiness->sum('expired_loyalty_count');
                    $totalRedeemedCount = $filterdata->sum('redeemed_loyalty_count');
                    $totalActiveCount = $filterdata->sum('active_loyalty_count');
                } elseif ($request->filter_by == 'is_redeemed') {
                    $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                    $totalExpiredCount = $filterdata->sum('expired_loyalty_count');
                    $totalRedeemedCount = $updatedBusiness->sum('redeemed_loyalty_count');
                    $totalActiveCount = $filterdata->sum('active_loyalty_count');
                } else {
                    $totalExpiredCount =  $updatedBusiness->sum('expired_loyalty_count');
                    $totalRedeemedCount =  $updatedBusiness->sum('redeemed_loyalty_count');
                    $totalActiveCount = $updatedBusiness->sum('active_loyalty_count');
                }
            } elseif ($request->filter_by == 'is_active') {
                $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                $totalActiveCount = $updatedBusiness->sum('active_deals_count') + $updatedBusiness->sum('active_loyalty_count');
                $totalExpiredCount = $filterdata->sum('expired_deals_count') + $filterdata->sum('expired_loyalty_count');
                $totalRedeemedCount = $filterdata->sum('redeemed_deals_count') + $filterdata->sum('redeemed_loyalty_count');
            } elseif ($request->filter_by == 'is_expired') {
                $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                $totalExpiredCount = $updatedBusiness->sum('expired_deals_count') + $updatedBusiness->sum('expired_loyalty_count');
                $totalRedeemedCount = $filterdata->sum('redeemed_deals_count') + $filterdata->sum('redeemed_loyalty_count');
                $totalActiveCount = $filterdata->sum('active_deals_count') + $filterdata->sum('active_loyalty_count');
            } elseif ($request->filter_by == 'is_redeemed') {
                $filterdata = $filter->with('business', 'deal', 'loyalty')->where('consumer_id', Auth::guard('api')->user()->id)->get();
                $totalExpiredCount = $filterdata->sum('expired_deals_count') + $filterdata->sum('expired_loyalty_count');
                $totalRedeemedCount = $updatedBusiness->sum('redeemed_deals_count') + $updatedBusiness->sum('redeemed_loyalty_count');
                $totalActiveCount = $filterdata->sum('active_deals_count') + $filterdata->sum('active_loyalty_count');
            } else {
                $totalExpiredCount = $updatedBusiness->sum('expired_deals_count') + $updatedBusiness->sum('expired_loyalty_count');
                $totalRedeemedCount = $updatedBusiness->sum('redeemed_deals_count') + $updatedBusiness->sum('redeemed_loyalty_count');
                $totalActiveCount = $updatedBusiness->sum('active_deals_count') + $updatedBusiness->sum('active_loyalty_count');
            }

            if ($request->type == "walletBadges") {
                $apartBadges = ApartmentGuestBadge::where('user_id', Auth::guard('api')->user()->id)->get();
                $shortTermBadges = ShortTermGuestBadge::where('guest_id', Auth::guard('api')->user()->id)->get();
                $totalBadges = $apartBadges->concat($shortTermBadges);
                $updatedBusiness = $totalBadges;
                $message = 'Gimmzi badges';
            }

            if (count($updatedBusiness) > 0) {
                return $this->sendResponse([
                    'totalWalletBusiness' => $updatedBusiness,
                    'total_expired_count' => $totalExpiredCount,
                    'total_redeemed_count' => $totalRedeemedCount,
                    'total_active_count' => $totalActiveCount
                ], $message . ' found', 201);
            } else {

                return $this->sendResponse([
                    'total_expired_count' => $totalExpiredCount,
                    'total_redeemed_count' => $totalRedeemedCount,
                    'total_active_count' => $totalActiveCount
                ], 'No data found', 404);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/redeem-program",
     * operationId="Redeem Program",
     * tags={"Consumer Wallet Management"},
     * summary="Redeem Program",
     * security={{"sanctum":{}}},
     * description="Redeem Program",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"type","deal_id","loyalty_id","program_process", "location_id", "gimmzi_id"},
     *               @OA\Property(property="type", type="string", example="gimmziDeals/loyaltyRewards"),
     *               @OA\Property(property="deal_id", type="integer"),
     *               @OA\Property(property="loyalty_id", type="integer"),
     *               @OA\Property(property="program_process", type="string", example=""),
     *               @OA\Property(property="location_id", type="string", example=""),
     *               @OA\Property(property="receipt_no", type="string", example=""),
     *               @OA\Property(property="gimmzi_id", type="string", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Redeem Program",
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


    public function redeem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => "nullable|in:gimmziDeals,loyaltyRewards",
            'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
            'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",
            'program_process' => "required_if:type,=,loyaltyRewards",
            'location_id' => "required",
            'receipt_no' => "nullable",
            'gimmzi_id' => "required"

        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->type == 'loyaltyRewards' && $request->loyalty_id != null) {
                $location = BusinessLocation::where('id', $request->location_id)->first();
                $loyalty = MerchantLoyaltyProgram::find($request->loyalty_id);
                $today = date('Y-m-d');
                $user = User::find(Auth::guard('api')->user()->id);
                if ($loyalty) {
                    $businessProfile = BusinessProfile::find($loyalty->business_profile_id);
                    if ($businessProfile) {
                        $matchingUser = User::where('business_id', $businessProfile->id)
                            ->where('userId', trim($request->gimmzi_id))
                            ->where('active', 1)
                            ->first();
                        if ($matchingUser) {
                            $alreadyReedem = ConsumerLoyaltyReward::where(['loyalty_reward_id' => $request->loyalty_id, 'consumer_id' => Auth::guard('api')->user()->id])->first();
                            $wallet = ConsumerWallet::where('consumer_id', Auth::guard('api')->user()->id)->where('loyalty_id', $request->loyalty_id)->first();
                            if ($alreadyReedem) {
                                $alreadyReedem->join_date = $today;
                                $totalProcess =  $alreadyReedem->program_process + $request->program_process;
                                if ($loyalty->purchase_goal == 'free') {
                                    if ($loyalty->have_to_buy != null) {
                                        if ($totalProcess > $loyalty->have_to_buy) {
                                            return $this->sendResponse([], 'Could not add the value', 201);
                                        } else {
                                            if ($totalProcess == $loyalty->have_to_buy) {
                                                if ($loyalty->off_percentage != null) {
                                                    $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->first();

                                                    if ($itemService && $itemService->itemservice) {
                                                        $itemName = $itemService->itemservice->item_name;
                                                    } else {
                                                        $itemName = 'N/A';
                                                    }
                                                    if ($loyalty->off_percentage != null) {
                                                        if ($loyalty->off_percentage == 'free') {
                                                            $programName = 'Free' . ' ' . $itemName;
                                                        } else {
                                                            $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                        }
                                                    } elseif ($loyalty->discount_amount != null) {
                                                        $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                    }
                                                    $newDeal = new Deal();
                                                    $newDeal->business_id = $businessProfile->id;
                                                    $newDeal->start_Date = $loyalty->start_on;
                                                    $newDeal->suggested_description = $programName;
                                                    $newDeal->sales_amount = 0;
                                                    $newDeal->discount_type = 'free';
                                                    $newDeal->discount_amount = 0;
                                                    $newDeal->point = 0;
                                                    $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                    $newDeal->loyalty_id = $loyalty->id;
                                                    $newDeal->is_complete = 0;
                                                    $newDeal->item_id = $itemService->id ?? null;
                                                    $newDeal->save();
                                                    if ($newDeal) {
                                                        $newDealLocation = new DealLocation();
                                                        $newDealLocation->deal_id = $newDeal->id;
                                                        $newDealLocation->location_id = $request->location_id;
                                                        $newDealLocation->participating_type = 'Participating';
                                                        $newDealLocation->status = 1;
                                                        $newDealLocation->save();

                                                        $addToWallet = new ConsumerWallet();
                                                        $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                        $addToWallet->business_id = $businessProfile->id;
                                                        $addToWallet->deal_id = $newDeal->id;
                                                        $addToWallet->location_id = $request->location_id;
                                                        $addToWallet->points = 0;
                                                        $addToWallet->is_redeemed = 0;
                                                        $addToWallet->save();
                                                    }
                                                }
                                            }
                                            $percent = ($totalProcess / $loyalty->have_to_buy) * 100;
                                            $percentNo = number_format($percent, 2, '.', '');
                                            $alreadyReedem->program_process = $totalProcess;
                                            $alreadyReedem->program_process_percentage = $percentNo;
                                            $alreadyReedem->save();

                                            $previousRedemption = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $alreadyReedem->id)->latest()->first();
                                            if ($previousRedemption) {
                                                $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->get();
                                                $prices = $itemService->map(function ($item) {
                                                    if (isset($item->itemservice) && isset($item->itemservice->value)) {
                                                        return $item->itemservice->value->pluck('price')->first() ?? 0;
                                                    }
                                                    return 0;
                                                })->filter();
                                                Log::debug('itemService data:', ['data' => $itemService]);
                                                Log::debug('prices data:', ['data' => $prices]);

                                                $totalPrice = $prices->sum();
                                                $itemCount = $prices->count();
                                                Log::debug('itemCount data:', ['data' => $itemCount]);
                                                if ($itemCount > 0) {
                                                    Log::info('$itemCount > 0');
                                                    $averagePrice = $totalPrice / $itemCount;
                                                } else {
                                                    Log::info(' enter else $itemCount > 0');
                                                    $averagePrice = 0;
                                                }
                                                Log::debug('itemSeraveragePricevice data:', ['data' => $averagePrice]);
                                                $valueEarned = ($averagePrice * 0.075);
                                                $totalEarning = (($valueEarned + $previousRedemption->remaining_point) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);
                                                Log::debug('pointValue data:', ['data' => $pointValue]);

                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $alreadyReedem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $averagePrice;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $remain_amount;
                                                $newPointRedemption->save();

                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    Log::debug('$previousPoint + $pointValue data:', ['data' => $previousPoint + $pointValue]);

                                                    $user->save();
                                                } else {
                                                    Log::info('Enter else');
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }
                                            }
                                        }
                                    }
                                } elseif ($loyalty->purchase_goal == 'deal_discount') {
                                    if ($loyalty->spend_amount != null) {
                                        $numericValue = str_replace(['$', ','], '', $loyalty->spend_amount);

                                        if ($totalProcess > $numericValue) {
                                            $remainProcess = $numericValue - $alreadyReedem->program_process;
                                            $addedProcess = ($remainProcess + $alreadyReedem->program_process);
                                            $remaining_balance =  $request->program_process - $remainProcess;
                                            $percent = ($addedProcess / $numericValue) * 100;
                                            $percentNo = number_format($percent, 2, '.', '');


                                            $previousRedemption = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $alreadyReedem->id)->latest()->first();
                                            if ($previousRedemption) {
                                                $exceedAmount = ($numericValue - $alreadyReedem->program_process);

                                                $valueEarned = ($exceedAmount * 0.075);
                                                $totalEarning = (($valueEarned + $previousRedemption->remaining_point) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);

                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $alreadyReedem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $request->program_process;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $remain_amount;
                                                $newPointRedemption->save();

                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    $user->save();
                                                } else {
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }
                                            }

                                            $alreadyReedem->program_process = $addedProcess;
                                            $alreadyReedem->program_process_percentage = $percentNo;
                                            $alreadyReedem->remaining_balance = $remaining_balance;
                                            if ($loyalty->discount_amount != null) {
                                                $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->first();

                                                if ($itemService && $itemService->itemservice) {
                                                    $itemName = $itemService->itemservice->item_name;
                                                } else {
                                                    $itemName = 'N/A';
                                                }
                                                if ($loyalty->off_percentage != null) {
                                                    if ($loyalty->off_percentage == 'free') {
                                                        $programName = 'Free' . ' ' . $itemName;
                                                    } else {
                                                        $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                    }
                                                } elseif ($loyalty->discount_amount != null) {
                                                    $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                }
                                                $newDeal = new Deal();
                                                $newDeal->business_id = $businessProfile->id;
                                                $newDeal->start_Date = $loyalty->start_on;
                                                $newDeal->suggested_description = $programName;
                                                $newDeal->sales_amount = 0;
                                                $newDeal->discount_type = 'free';
                                                $newDeal->discount_amount = 0;
                                                $newDeal->point = 0;
                                                $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                $newDeal->is_complete = 0;
                                                $newDeal->loyalty_id = $loyalty->id;
                                                $newDeal->item_id = $itemService->id ?? null;
                                                $newDeal->save();
                                                if ($newDeal) {
                                                    $newDealLocation = new DealLocation();
                                                    $newDealLocation->deal_id = $newDeal->id;
                                                    $newDealLocation->location_id = $request->location_id;
                                                    $newDealLocation->participating_type = 'Participating';
                                                    $newDealLocation->status = 1;
                                                    $newDealLocation->save();
                                                    $addToWallet = new ConsumerWallet();
                                                    $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                    $addToWallet->business_id = $businessProfile->id;
                                                    $addToWallet->deal_id = $newDeal->id;
                                                    $addToWallet->location_id = $request->location_id;
                                                    $addToWallet->points = 0;
                                                    $addToWallet->is_redeemed = 0;
                                                    $addToWallet->save();
                                                }
                                            }
                                        } else {

                                            $percent = ($totalProcess / $numericValue) * 100;
                                            $percentNo = number_format($percent, 2, '.', '');
                                            $alreadyReedem->program_process = $totalProcess;
                                            $alreadyReedem->program_process_percentage = $percentNo;

                                            $previousRedemption = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $alreadyReedem->id)->latest()->first();
                                            if ($previousRedemption) {
                                                $valueEarned = ($request->program_process * 0.075);
                                                $totalEarning = (($valueEarned + $previousRedemption->remaining_point) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);
                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $alreadyReedem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $request->program_process;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $remain_amount;
                                                $newPointRedemption->save();

                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    $user->save();
                                                } else {
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }
                                            }

                                            if ($totalProcess == $numericValue) {
                                                if ($loyalty->discount_amount != null) {
                                                    $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->first();

                                                    if ($itemService && $itemService->itemservice) {
                                                        $itemName = $itemService->itemservice->item_name;
                                                    } else {
                                                        $itemName = 'N/A';
                                                    }

                                                    if ($loyalty->off_percentage != null) {
                                                        if ($loyalty->off_percentage == 'free') {
                                                            $programName = 'Free' . ' ' . $itemName;
                                                        } else {
                                                            $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                        }
                                                    } elseif ($loyalty->discount_amount != null) {
                                                        $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                    }

                                                    $newDeal = new Deal();
                                                    $newDeal->business_id = $businessProfile->id;
                                                    $newDeal->start_Date = $loyalty->start_on;
                                                    $newDeal->suggested_description = $programName;
                                                    $newDeal->sales_amount = 0;
                                                    $newDeal->discount_type = 'free';
                                                    $newDeal->discount_amount = 0;
                                                    $newDeal->point = 0;
                                                    $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                    $newDeal->is_complete = 0;
                                                    $newDeal->loyalty_id = $loyalty->id;
                                                    $newDeal->item_id = $itemService->id ?? null;
                                                    $newDeal->save();
                                                    if ($newDeal) {
                                                        $newDealLocation = new DealLocation();
                                                        $newDealLocation->deal_id = $newDeal->id;
                                                        $newDealLocation->location_id = $request->location_id;
                                                        $newDealLocation->participating_type = 'Participating';
                                                        $newDealLocation->status = 1;
                                                        $newDealLocation->save();
                                                        $addToWallet = new ConsumerWallet();
                                                        $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                        $addToWallet->business_id = $businessProfile->id;
                                                        $addToWallet->deal_id = $newDeal->id;
                                                        $addToWallet->location_id = $request->location_id;
                                                        $addToWallet->points = 0;
                                                        $addToWallet->is_redeemed = 0;
                                                        $addToWallet->save();
                                                    }
                                                }
                                            }
                                        }
                                        $alreadyReedem->save();
                                    }
                                }
                                // dd( $alreadyReedem);
                                if ($loyalty->purchase_goal == 'free') {
                                    if ($loyalty->have_to_buy != null) {
                                        if ($alreadyReedem->program_process == $loyalty->have_to_buy) {
                                            $alreadyReedem->is_complete_redeemed = 1;
                                            $alreadyReedem->save();
                                        }
                                    }
                                } elseif ($loyalty->purchase_goal == 'deal_discount') {
                                    if ($loyalty->spend_amount != null) {
                                        $numericValue = str_replace(['$', ','], '', $loyalty->spend_amount);
                                        if ($alreadyReedem->program_process == $numericValue) {
                                            $alreadyReedem->is_complete_redeemed = 1;
                                            $alreadyReedem->save();
                                        }
                                    }
                                }


                                $tansaction = new Transaction();
                                $tansaction->receipt_no = $request->receipt_no;
                                if ($loyalty->purchase_goal == 'free') {
                                    $tansaction->type = 'Item';
                                } elseif ($loyalty->purchase_goal == 'deal_discount') {
                                    $tansaction->type = 'Spend';
                                }
                                $tansaction->date = $today;
                                $tansaction->location = $location->location_name;
                                $tansaction->purchase_amount = $request->program_process;
                                $tansaction->member_name = Auth::guard('api')->user()->full_name;
                                $tansaction->status = 1;
                                $tansaction->consumer_loyalty_reward_id = $alreadyReedem->id;
                                $tansaction->is_refunded = 0;
                                $tansaction->refund_full_amount = 0;
                                $tansaction->refund_all_quantity = 0;
                                $tansaction->refund_amount = 0;
                                $tansaction->refund_quantity = 0;
                                $tansaction->save();
                                return $this->sendResponse($alreadyReedem, 'Redeemed Successfully', 201);
                            } else {
                                if ($loyalty->purchase_goal == 'free') {
                                    if ($loyalty->have_to_buy != null) {
                                        $percentage = ($request->program_process / $loyalty->have_to_buy) * 100;
                                        $percentNo = number_format($percentage, 2, '.', '');
                                    }
                                } elseif ($loyalty->purchase_goal == 'deal_discount') {
                                    if ($loyalty->spend_amount != null) {

                                        $numericValue = str_replace(['$', ','], '', $loyalty->spend_amount);
                                        $percentage = ($request->program_process / $numericValue) * 100;
                                        $percentNo = number_format($percentage, 2, '.', '');
                                    }
                                }
                                $data = [
                                    'consumer_id' => Auth::guard('api')->user()->id,
                                    'loyalty_reward_id' => $request->loyalty_id,
                                    'join_date' => $today,
                                    'program_process' => $request->program_process,
                                    'program_process_percentage' => $percentNo,
                                    'status' => 1,
                                    'location_id' => $request->location_id
                                ];

                                $newRedeem = ConsumerLoyaltyReward::create($data);
                                if ($newRedeem) {

                                    if ($wallet) {
                                        $wallet->is_redeemed = 1;
                                        $wallet->save();
                                    }
                                    if ($loyalty->purchase_goal == 'deal_discount') {
                                        $totalProcess = $request->program_process;
                                        $numericValue = str_replace(['$', ','], '', $loyalty->spend_amount);
                                        if ($numericValue != null) {
                                            if ($totalProcess == $numericValue) {
                                                $valueEarned = ($request->program_process * 0.075);
                                                $totalEarning = (($valueEarned + 0) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);
                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $newRedeem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $request->program_process;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $remain_amount;
                                                $newPointRedemption->save();

                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    $user->save();
                                                } else {
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }


                                                if ($loyalty->discount_amount != null) {
                                                    $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)
                                                        ->first();

                                                    if ($itemService && $itemService->itemservice) {
                                                        $itemName = $itemService->itemservice->item_name;
                                                    } else {
                                                        $itemName = 'N/A';
                                                    }

                                                    if ($loyalty->off_percentage != null) {
                                                        if ($loyalty->off_percentage == 'free') {
                                                            $programName = 'Free' . ' ' . $itemName;
                                                        } else {
                                                            $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                        }
                                                    } elseif ($loyalty->discount_amount != null) {
                                                        $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                    }
                                                    $newDeal = new Deal();
                                                    $newDeal->business_id = $businessProfile->id;
                                                    $newDeal->start_Date = $loyalty->start_on;
                                                    $newDeal->suggested_description = $programName;
                                                    $newDeal->sales_amount = 0;
                                                    $newDeal->discount_type = 'free';
                                                    $newDeal->discount_amount = 0;
                                                    $newDeal->point = 0;
                                                    $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                    $newDeal->is_complete = 0;
                                                    $newDeal->loyalty_id = $loyalty->id;
                                                    $newDeal->item_id = $itemService->id ?? null;
                                                    $newDeal->save();
                                                    if ($newDeal) {
                                                        $newDealLocation = new DealLocation();
                                                        $newDealLocation->deal_id = $newDeal->id;
                                                        $newDealLocation->location_id = $request->location_id;
                                                        $newDealLocation->participating_type = 'Participating';
                                                        $newDealLocation->status = 1;
                                                        $newDealLocation->save();
                                                        $addToWallet = new ConsumerWallet();
                                                        $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                        $addToWallet->business_id = $businessProfile->id;
                                                        $addToWallet->deal_id = $newDeal->id;
                                                        $addToWallet->location_id = $request->location_id;
                                                        $addToWallet->points = 0;
                                                        $addToWallet->is_redeemed = 0;
                                                        $addToWallet->save();
                                                    }
                                                }

                                                $newRedeem->is_complete_redeemed = 1;
                                                $newRedeem->save();
                                            } elseif ($totalProcess > $numericValue) {


                                                $exceedAmount = ($request->program_process - $numericValue);

                                                $valueEarned = ($numericValue * 0.075);
                                                $totalEarning = (($valueEarned + 0) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);
                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $newRedeem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $request->program_process;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $exceedAmount;
                                                $newPointRedemption->save();
                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    $user->save();
                                                } else {
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }
                                                if ($loyalty->discount_amount != null) {
                                                    $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)
                                                        ->first();

                                                    if ($itemService && $itemService->itemservice) {
                                                        $itemName = $itemService->itemservice->item_name;
                                                    } else {
                                                        $itemName = 'N/A';
                                                    }

                                                    if ($loyalty->off_percentage != null) {
                                                        if ($loyalty->off_percentage == 'free') {
                                                            $programName = 'Free' . ' ' . $itemName;
                                                        } else {
                                                            $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                        }
                                                    } elseif ($loyalty->discount_amount != null) {
                                                        $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                    }
                                                    $newDeal = new Deal();
                                                    $newDeal->business_id = $businessProfile->id;
                                                    $newDeal->start_Date = $loyalty->start_on;
                                                    $newDeal->suggested_description = $programName;
                                                    $newDeal->sales_amount = 0;
                                                    $newDeal->discount_type = 'free';
                                                    $newDeal->discount_amount = 0;
                                                    $newDeal->point = 0;
                                                    $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                    $newDeal->is_complete = 0;
                                                    $newDeal->loyalty_id = $loyalty->id;
                                                    $newDeal->item_id = $itemService->id ?? null;
                                                    $newDeal->save();
                                                    if ($newDeal) {
                                                        $newDealLocation = new DealLocation();
                                                        $newDealLocation->deal_id = $newDeal->id;
                                                        $newDealLocation->location_id = $request->location_id;
                                                        $newDealLocation->participating_type = 'Participating';
                                                        $newDealLocation->status = 1;
                                                        $newDealLocation->save();
                                                        $addToWallet = new ConsumerWallet();
                                                        $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                        $addToWallet->business_id = $businessProfile->id;
                                                        $addToWallet->deal_id = $newDeal->id;
                                                        $addToWallet->location_id = $request->location_id;
                                                        $addToWallet->points = 0;
                                                        $addToWallet->is_redeemed = 0;
                                                        $addToWallet->save();
                                                    }
                                                }

                                                $newRedeem->is_complete_redeemed = 1;
                                                $newRedeem->save();
                                            } else {
                                                $valueEarned = ($request->program_process * 0.075);
                                                $totalEarning = (($valueEarned + 0) / 0.50);
                                                $pointValue = floor($totalEarning);
                                                $remain_amount = ($totalEarning - $pointValue);
                                                $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                                $newPointRedemption->consumer_reward_id =  $newRedeem->id;
                                                $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                                $newPointRedemption->given_amount = $request->program_process;
                                                $newPointRedemption->total_earning = $totalEarning;
                                                $newPointRedemption->points = $pointValue;
                                                $newPointRedemption->remaining_point = $remain_amount;
                                                $newPointRedemption->save();

                                                if ($user->earned_point > 0) {
                                                    $previousPoint = $user->earned_point;
                                                    $user->earned_point = $previousPoint + $pointValue;
                                                    $user->save();
                                                } else {
                                                    $user->earned_point =  $pointValue;
                                                    $user->save();
                                                }
                                            }
                                        }
                                    } elseif ($loyalty->purchase_goal == 'free') {
                                        $totalProcess = $request->program_process;
                                        if ($totalProcess == $loyalty->have_to_buy) {
                                            if ($loyalty->off_percentage != null) {
                                                $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->first();
                                                if ($itemService && $itemService->itemservice) {
                                                    $itemName = $itemService->itemservice->item_name;
                                                } else {
                                                    $itemName = 'N/A';
                                                }
                                                if ($loyalty->off_percentage != null) {
                                                    if ($loyalty->off_percentage == 'free') {
                                                        $programName = 'Free' . ' ' . $itemName;
                                                    } else {
                                                        $programName = $loyalty->off_percentage . ' ' . $itemName;
                                                    }
                                                } elseif ($loyalty->discount_amount != null) {
                                                    $programName = $loyalty->discount_amount . ' ' . 'OFF' . ' ' . $itemName;
                                                }
                                                $newDeal = new Deal();
                                                $newDeal->business_id = $businessProfile->id;
                                                $newDeal->start_Date = $loyalty->start_on;
                                                $newDeal->suggested_description = $programName;
                                                $newDeal->sales_amount = 0;
                                                $newDeal->discount_type = 'free';
                                                $newDeal->discount_amount = 0;
                                                $newDeal->point = 0;
                                                $newDeal->consumer_id = Auth::guard('api')->user()->id;
                                                $newDeal->is_complete = 0;
                                                $newDeal->loyalty_id = $loyalty->id;
                                                $newDeal->item_id = $itemService->id ?? null;
                                                $newDeal->save();

                                                if ($newDeal) {
                                                    $newDealLocation = new DealLocation();
                                                    $newDealLocation->deal_id = $newDeal->id;
                                                    $newDealLocation->location_id = $request->location_id;
                                                    $newDealLocation->participating_type = 'Participating';
                                                    $newDealLocation->status = 1;
                                                    $newDealLocation->save();
                                                    $addToWallet = new ConsumerWallet();
                                                    $addToWallet->consumer_id = Auth::guard('api')->user()->id;
                                                    $addToWallet->business_id = $businessProfile->id;
                                                    $addToWallet->deal_id = $newDeal->id;
                                                    $addToWallet->location_id = $request->location_id;
                                                    $addToWallet->points = 0;
                                                    $addToWallet->is_redeemed = 0;
                                                    $addToWallet->save();
                                                }
                                            }

                                            $newRedeem->is_complete_redeemed = 1;
                                            $newRedeem->save();
                                        }
                                        $itemService = LoyaltyProgramItem::where('loyalty_program_id', $request->loyalty_id)->get();
                                        if ($itemService) {
                                            $prices = $itemService->map(function ($item) {
                                                if (isset($item->itemservice) && isset($item->itemservice->value)) {
                                                    return $item->itemservice->value->pluck('price')->first() ?? 0;
                                                }
                                                return 0;
                                            })->filter();

                                            // dd($itemService);

                                            $totalPrice = $prices->sum();
                                            $itemCount = $prices->count();
                                            if ($itemCount > 0) {
                                                $averagePrice = $totalPrice / $itemCount;
                                            } else {
                                                $averagePrice = 0;
                                            }

                                            $valueEarned = ($averagePrice * 0.075);
                                            $totalEarning = (($valueEarned + 0) / 0.50);
                                            $pointValue = floor($totalEarning);
                                            $remain_amount = ($totalEarning - $pointValue);

                                            $newPointRedemption = new ConsumerLoyaltyRewardRedemption();
                                            $newPointRedemption->consumer_reward_id =  $newRedeem->id;
                                            $newPointRedemption->loyalty_reward_id = $request->loyalty_id;
                                            $newPointRedemption->given_amount = $averagePrice;
                                            $newPointRedemption->total_earning = $totalEarning;
                                            $newPointRedemption->points = $pointValue;
                                            $newPointRedemption->remaining_point = $remain_amount;
                                            $newPointRedemption->save();

                                            if ($user->earned_point > 0) {
                                                $previousPoint = $user->earned_point;
                                                $user->earned_point = $previousPoint + $pointValue;
                                                $user->save();
                                            } else {
                                                $user->earned_point =  $pointValue;
                                                $user->save();
                                            }
                                        }
                                    }


                                    $tansaction = new Transaction();
                                    $tansaction->receipt_no = $request->receipt_no;
                                    if ($loyalty->purchase_goal == 'free') {
                                        $tansaction->type = 'Item';
                                    } elseif ($loyalty->purchase_goal == 'deal_discount') {
                                        $tansaction->type = 'Spend';
                                    }
                                    $tansaction->date = $today;
                                    $tansaction->location = $location->location_name;
                                    $tansaction->purchase_amount = $request->program_process;
                                    $tansaction->member_name = Auth::guard('api')->user()->full_name;
                                    $tansaction->status = 1;
                                    $tansaction->consumer_loyalty_reward_id = $newRedeem->id;
                                    $tansaction->is_refunded = 0;
                                    $tansaction->refund_full_amount = 0;
                                    $tansaction->refund_all_quantity = 0;
                                    $tansaction->refund_amount = 0;
                                    $tansaction->refund_quantity = 0;
                                    $tansaction->save();
                                }
                                return $this->sendResponse($newRedeem, 'Redeemed Successfully', 201);
                            }
                        } else {
                            return $this->sendResponse([], 'Gimmzi id not matched', 404);
                        }
                    } else {
                        return $this->sendResponse([], 'No business profile found', 404);
                    }
                } else {
                    return $this->sendResponse([], 'No loyalty found', 404);
                }
            }
            if ($request->type == 'gimmziDeals' && $request->deal_id != null) {
                $user = User::find(Auth::guard('api')->user()->id);
                $today = date('Y-m-d');
                $deal = Deal::find($request->deal_id);

                $totalPoints = ($user->earned_point + $user->point);
                $dealPoint = $deal->point;
                // dd($deal->point);
                if ($totalPoints >= $dealPoint) {
                    $location = BusinessLocation::where('id', $request->location_id)->first();
                    $businessProfile = BusinessProfile::find($deal->business_id);
                    $matchingUser = User::where('business_id', $businessProfile->id)
                        ->where('userId', trim($request->gimmzi_id))
                        ->where('active', 1)
                        ->first();
                    if ($matchingUser) {
                        $alreadyReedem = ConsumerLoyaltyReward::where(['deal_id' => $request->deal_id, 'consumer_id' => Auth::guard('api')->user()->id])->first();
                        if ($alreadyReedem) {
                            return $this->sendResponse([], 'Deal already redeemed', 404);
                        } else {
                            if ($deal->consumer_id == Auth::guard('api')->user()->id && $deal->loyalty_id != null) {
                                $wallet = ConsumerWallet::where('consumer_id', Auth::guard('api')->user()->id)->where('deal_id', $request->deal_id)->first();
                                $wallet->delete();

                                $loyalty = ConsumerWallet::where('consumer_id', Auth::guard('api')->user()->id)->where('loyalty_id', $deal->loyalty_id)->first();
                                $loyalty->delete();

                                $redeemLoyalty = ConsumerLoyaltyReward::where('consumer_id', Auth::guard('api')->user()->id)->where('loyalty_reward_id', $deal->loyalty_id)->first();
                                $redeemLoyalty->delete();

                                $dealLocation = DealLocation::where('deal_id', $request->deal_id)->first();
                                if ($dealLocation) {
                                    $dealLocation->delete();
                                }
                                $deal->delete();
                                return $this->sendResponse([], 'Deal Redeemed Successfully', 201);
                            } else {

                                $data = [
                                    'consumer_id' => Auth::guard('api')->user()->id,
                                    'deal_id' => $request->deal_id,
                                    'join_date' => $today,
                                    'status' => 1,
                                    'location_id' => $request->location_id,
                                    'is_complete_redeemed' => 1
                                ];
                                $newRedeem = ConsumerLoyaltyReward::create($data);
                                if ($newRedeem) {
                                    $remainingDealPoints = $dealPoint;
                                    if ($user->earned_point >= $remainingDealPoints) {
                                        $user->earned_point -= $remainingDealPoints;
                                        $remainingDealPoints = 0;
                                    } else {
                                        $remainingDealPoints -= $user->earned_point;
                                        $user->earned_point = 0;
                                    }
                                    if ($remainingDealPoints > 0) {
                                        $user->point -= $remainingDealPoints;
                                    }

                                    $user->save();

                                    $wallet = ConsumerWallet::where('consumer_id', Auth::guard('api')->user()->id)->where('deal_id', $request->deal_id)->first();
                                    if ($wallet) {
                                        $wallet->is_redeemed = 1;
                                        $wallet->save();
                                    }
                                    $tansaction = new Transaction();
                                    $tansaction->date = $today;
                                    $tansaction->location = $location->location_name;
                                    $tansaction->purchase_amount = $deal->discount_amount;
                                    $tansaction->member_name = Auth::guard('api')->user()->full_name;
                                    $tansaction->status = 1;
                                    $tansaction->consumer_loyalty_reward_id = $newRedeem->id;
                                    $tansaction->is_refunded = 0;
                                    $tansaction->refund_full_amount = 0;
                                    $tansaction->refund_all_quantity = 0;
                                    $tansaction->refund_amount = 0;
                                    $tansaction->refund_quantity = 0;
                                    $tansaction->save();
                                    return $this->sendResponse($newRedeem, 'Deal Redeemed Successfully', 201);
                                } else {
                                    return $this->sendResponse([], 'Something went wrong', 404);
                                }
                            }
                        }
                    } else {
                        return $this->sendResponse([], 'Gimmzi id not matched', 404);
                    }
                } else {
                    return $this->sendResponse([], 'You don’t have enough points to add this deal to your wallet', 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/remove-from-wallet",
     * operationId="Remove from wallet",
     * tags={"Consumer Wallet Management"},
     * summary="Remove from wallet",
     * security={{"sanctum":{}}},
     * description="Remove from wallet",
     * @OA\RequestBody(
     *         @OA\JsonContent(),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"type","wallet_id", "deal_id","loyalty_id"},
     *               @OA\Property(property="type", type="string", example="gimmziDeals"),                   
     *               @OA\Property(property="wallet_id", type="integer", example=""),
     *               @OA\Property(property="deal_id", type="integer", example=""),
     *               @OA\Property(property="loyalty_id", type="integer", example=""),
     *            ),
     *        ),
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Remove from wallet",
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

    public function removeFromWallet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => "required|in:gimmziDeals,loyaltyRewards",
            'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
            'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",
            'wallet_id' => "required|exists:consumer_wallets,id",
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => false, "code" => 550, "message" => $validator->errors()->first()], 550);
        }
        try {
            if ($request->type == 'gimmziDeals') {
                $dealwallet = ConsumerWallet::where(['consumer_id' => Auth::guard('api')->user()->id, 'deal_id' => $request->deal_id])->where('id', $request->wallet_id)->first();
                if ($dealwallet) {
                    $consumerLoyalty = ConsumerLoyaltyReward::where(['consumer_id' => Auth::guard('api')->user()->id, 'deal_id' => $request->deal_id])->first();
                    if ($consumerLoyalty) {
                        $redemptions = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $consumerLoyalty->id)->latest('id')->get();
                        if ($redemptions) {
                            $redemptions->each(function ($redemption) {
                                $redemption->delete();
                            });
                        }
                        $consumerLoyalty->delete();
                    }
                    $dealwallet->delete();
                    return $this->sendResponse([], 'Successfully removed from wallet', 201);
                } else {
                    return $this->sendResponse([], 'No data found', 404);
                }
            } elseif ($request->type == 'loyaltyRewards') {
                $loyaltywallet = ConsumerWallet::where(['consumer_id' => Auth::guard('api')->user()->id, 'loyalty_id' => $request->loyalty_id])->where('id', $request->wallet_id)->first();
                //    dd($loyaltywallet);
                if ($loyaltywallet) {
                    $consumerLoyalty = ConsumerLoyaltyReward::where(['consumer_id' => Auth::guard('api')->user()->id, 'loyalty_reward_id' => $request->loyalty_id])->first();
                    // dd($consumerLoyalty);
                    if ($consumerLoyalty) {
                        $redemptions = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $consumerLoyalty->id)->latest('id')->get();
                        if ($redemptions) {
                            $redemptions->each(function ($redemption) {
                                $redemption->delete();
                            });
                        }
                        $dealLoyalty = Deal::where('loyalty_id', $request->loyalty_id)->first();
                        if ($dealLoyalty) {
                            $dealLoyalty->delete();
                        }
                        $consumerLoyalty->delete();
                    }
                    $loyaltywallet->delete();
                    return $this->sendResponse([], 'Successfully removed from wallet', 201);
                } else {
                    return $this->sendResponse([], 'No data found', 404);
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Get(
     * path="/api/earned-loyalty-points",
     * operationId="Earned Loaylty points",
     * tags={"Consumer Wallet Management"},
     * summary="Earned Loaylty points",
     * description="Get Earned Loaylty points",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Earned Loaylty points",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function earnedPoints()
    {
        try {
            if (Auth::guard('api')->check()) {
                $data['totalearnedPoints'] = Auth::guard('api')->user()->earned_point;
                $userPoint = Auth::guard('api')->user()->point;
                $data['totalPoints'] = ($data['totalearnedPoints'] + $userPoint);
                if ($data) {
                    return $this->sendResponse($data, 'Total Loyalty points', 201);
                } else {
                    return $this->sendResponse([], 'No data found', 201);
                }
            } else {
                return $this->sendResponse([], 'Sign in required', 201);
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/previous-remaining-balance",
     * operationId="Previous Remaining balance",
     * tags={"Consumer Wallet Management"},
     * summary="Previous Remaining balance",
     * description="Get Previous Remaining balance",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Previous Remaining balance",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function previousBalance()
    {
        try {
            if(Auth::guard('api')->check()){
                $lastRemainBalance = ConsumerLoyaltyReward::select('id', 'remaining_balance')->where('consumer_id', Auth::guard('api')->user()->id)->whereNotNull('remaining_balance')->latest()->first();
                if ($lastRemainBalance) {
                    return $this->sendResponse($lastRemainBalance, 'Previous Remaining Balance', 201);
                } else {
                    return $this->sendResponse([], 'No data found', 201);
                } 
            }else{
                return $this->sendResponse([], 'Sign in required', 201);
            }
           
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }


    /**
     * @OA\Get(
     * path="/api/last-redeemed-loyalty",
     * operationId="Last Redeemed Loyalty",
     * tags={"Consumer Wallet Management"},
     * summary="Last Redeemed Loyalty",
     * description="Get Last Redeemed Loyalty",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Last Redeemed Loyalty",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function lastRedeemedTime()
    {
        try {
            if(Auth::guard('api')->check()){
                $redeemPoint = ConsumerLoyaltyReward::where('consumer_id', Auth::guard('api')->user()->id)->whereNotNull('loyalty_reward_id')->pluck('id');
                $lastRedeemedTime = ConsumerLoyaltyRewardRedemption::whereIn('consumer_reward_id', $redeemPoint)->select('id', 'created_at')->latest()->first();
                if ($lastRedeemedTime) {
                    return $this->sendResponse($lastRedeemedTime, 'Last Redeemed Loyalty', 201);
                } else {
                    return $this->sendResponse([], 'No data found', 201);
                }
            }else{
                return $this->sendResponse([], 'Sign in required', 201);
            }
           
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return $this->sendError('Server Error!', [], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/updated-earned-point",
     * operationId="Updated Earned points",
     * tags={"Consumer Wallet Management"},
     * summary="Updated Earned points",
     * description="Get Updated Earned points",
     *      @OA\Response(
     *          response=200,
     *          description="Fetched Updated Earned points",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="No page found"),
     * )
     */

    public function updatedEarnedPoint()
    {
        if(Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            $redeemPoint = ConsumerLoyaltyReward::where('consumer_id', $user->id)
                ->whereNotNull('loyalty_reward_id')
                ->pluck('id');
    
            $lastRedeemedTime = ConsumerLoyaltyRewardRedemption::whereIn('consumer_reward_id', $redeemPoint)
                ->select('id', 'created_at')
                ->latest()
                ->first();
    
            if ($lastRedeemedTime) {
                $lastRedeemedDateTime = Carbon::parse($lastRedeemedTime->created_at);
                $next45Days = $lastRedeemedDateTime->addDays(45);
                if (now()->greaterThanOrEqualTo($next45Days)) {
                    $user->earned_point = 0;
                    $user->save();
                    return $this->sendResponse([], 'Earned point updated successfully', 201);
                } else {
                    return $this->sendResponse([], 'Remaining Time', 201);
                }
            } else {
                return $this->sendResponse([], 'No data found', 404);
            }
        }else{
            return $this->sendResponse([], 'Sign in required', 201);
        }
      
    }
}
