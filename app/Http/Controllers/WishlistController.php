<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ConsumerFavouriteTravelTourism;

class WishlistController extends Controller
{
    public function save(Request $request)
    {
        // dd($request->all(),auth()->user());
        if (Auth::check()) { // Check if user is logged in (for web)
            $validator = Validator::make($request->all(), [
                'business_id' => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["status" => false, "code" => 400, "message" => $validator->errors()->first()], 400);
            }

            try {
                $userId = Auth::id(); // Get authenticated user ID
                $businessId = $request->business_id;

                $alreadyFav = ConsumerFavouriteTravelTourism::where([
                    'consumer_id' => $userId,
                    'business_id' => $businessId,
                    'is_favourite' => 1
                ])->first();

                if ($alreadyFav) {
                    $alreadyFav->delete();
                    return response()->json(['status' => true, 'message' => 'Removed from favorites'], 200);
                } else {
                    $addedFav = new ConsumerFavouriteTravelTourism();
                    $addedFav->consumer_id = $userId;
                    $addedFav->business_id = $businessId;
                    $addedFav->is_favourite = 1;
                    $addedFav->save();

                    return response()->json(['status' => true, 'message' => 'Added to favorites'], 201);
                }
            } catch (\Throwable $th) {
                Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
                return response()->json(['status' => false, 'message' => 'Server Error!'], 500);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Sign in required'], 401);
        }
    }
}
