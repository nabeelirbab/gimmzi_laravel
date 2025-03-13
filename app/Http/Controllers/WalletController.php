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
        // dd($request->all());
        $businesses = BusinessProfile::where('id',$request->business_id)->with('deals')->with('states')->first();
    // dd($businesses->deals);
        if (Auth::check()) { // For web authentication
            $validator = Validator::make($request->all(), [
                'business_id' => "required",
                'type' => "required|in:gimmziDeals,loyaltyRewards",
                'deal_id' => "required_if:type,=,gimmziDeals|exists:deals,id",
                'loyalty_id' => "required_if:type,=,loyaltyRewards|exists:merchant_loyalty_programs,id",
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            try {
                $userId = Auth::id(); // Get authenticated user's ID

                if ($request->type == 'gimmziDeals') {
                    $deal = Deal::where(['business_id' => $request->business_id, 'id' => $request->deal_id])->first();
                    if ($deal) {
                        $alreadyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'deal_id' => $request->deal_id, 'consumer_id' => $userId])->first();
                        if ($alreadyAdded) {
                            return redirect()->back()->with('info', 'Already Added to My Wallet.');
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = $userId;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->deal_id = $deal->id;
                            $addToWallet->points = $deal->point;
                            $addToWallet->save();
                            return redirect()->back()->with('success', 'Deal added to wallet successfully.');
                        }
                    } else {
                        return redirect()->back()->with('error', 'No deal found.');
                    }
                } elseif ($request->type == 'loyaltyRewards') {
                    $loyalty = MerchantLoyaltyProgram::where(['business_profile_id' => $request->business_id, 'id' => $request->loyalty_id])->first();
                    if ($loyalty) {
                        $alreadyLoyaltyAdded = ConsumerWallet::where(['business_id' => $request->business_id, 'loyalty_id' => $request->loyalty_id, 'consumer_id' => $userId])->first();
                        if ($alreadyLoyaltyAdded) {
                            return redirect()->back()->with('info', 'Already Added to My Wallet.');
                        } else {
                            $addToWallet = new ConsumerWallet();
                            $addToWallet->consumer_id = $userId;
                            $addToWallet->business_id = $request->business_id;
                            $addToWallet->loyalty_id = $loyalty->id;
                            $addToWallet->points = $loyalty->program_points;
                            $addToWallet->save();
                            return redirect()->back()->with('success', 'Loyalty Punch Card added to wallet successfully.');
                        }
                    } else {
                        return redirect()->back()->with('error', 'No loyalty program found.');
                    }
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return redirect()->back()->with('error', 'Server Error! Please try again.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Sign in to save this deal and redeem rewards!');
        }
    }
}
