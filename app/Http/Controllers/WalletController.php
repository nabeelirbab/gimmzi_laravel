<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Models\ConsumerWallet;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\MerchantLoyaltyProgram;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function addToMyWalletWeb(Request $request)
    {
        if (Auth::check()) { 
            $validator = Validator::make($request->all(), [
                'business_id' => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
            }

            try {
                $userId = Auth::id();

                if ($request->deal_id) {
                    $deal = Deal::where(['business_id' => $request->business_id, 'id' => $request->deal_id])->first();
                    if ($deal) {
                        $alreadyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'deal_id' => $request->deal_id, 'consumer_id' => $userId])->first();
                        if ($alreadyAdded) {
                            return response()->json(['status' => true, 'message' => 'Already added to the wallet'], 200);
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = $userId;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->deal_id = $deal->id;
                            $addToWallet->points = $deal->point;
                            $addToWallet->save();
                            return response()->json(['status' => true, 'message' => 'Deal added to wallet successfully'], 201);
                        }
                    } else {
                        return response()->json(['status' => false, 'message' => 'Something went wrong'], 500);
                    }
                } elseif ($request->loyalty_id) {
                    $loyalty = MerchantLoyaltyProgram::where(['business_profile_id' => $request->business_id, 'id' => $request->loyalty_id])->first();
                    if ($loyalty) {
                        $alreadyLoyaltyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'loyalty_id' => $request->loyalty_id, 'consumer_id' => $userId])->first();
                        if ($alreadyLoyaltyAdded) {
                            return response()->json(['status' => true, 'message' => 'Already Added to the Wallet'], 200);
                            
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = $userId;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->loyalty_id = $loyalty->id;
                            $addToWallet->points = $loyalty->program_points;
                            $addToWallet->save();
                            return response()->json(['status' => true, 'message' => 'Loyalty added to wallet successfully'], 201);
                            
                        }
                    } else {
                        return response()->json(['status' => false, 'message' => 'No loyalty program found.'], 500);
                        
                    }
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return response()->json(['status' => false, 'message' => 'Server Error! Please try again.'], 500);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Sign in to save this deal or loyalty rewards!'], 401);
        }
    }
}
