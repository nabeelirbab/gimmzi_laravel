<?php

namespace App\Http\Controllers\Frontend\WebsiteEnd;


use App\Models\DealLocation;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\ProviderSubType;
use App\Models\BusinessLocation;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\MerchantDisplayBoard;
use Illuminate\Support\Facades\Auth;
use App\Models\LoyaltyRewardLocation;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Validator;
use App\Models\ConsumerFavouriteTravelTourism;

class BusinessWebsiteController extends Controller
{
    public function index($id)
    {
        $business = BusinessProfile::find($id); 
        // dd($business->id);
        $message_board = MerchantDisplayBoard::where('business_id', $id)->first();
        $providerType = ProviderSubType::get();
        $businessLocation = BusinessLocation::where('business_profile_id', $id)->first();
        $message_board = MerchantDisplayBoard::with('boardone', 'boardtwo')->where('location_id', 10)->first();
        $business_photos = Media::where(['model_id' => $id, 'collection_name' => 'businessProfilePhoto'])->get();
        $businesses = BusinessProfile::where('id', '<>', $id)->withCount('deals')->with('states')->whereHas('deals')->where('status', 1)->get();
        $alreadyFav = ConsumerFavouriteTravelTourism::where('business_id',$business->id)->first();
        if ($businessLocation && isset($businessLocation->id)) {
            $dealIds = DealLocation::where('location_id', $businessLocation->id)->pluck('deal_id');
        } else {
            // Handle the case where $businessLocation is null
            // Maybe log the error or provide a default behavior
            $dealIds = collect(); // Return an empty collection or handle as needed
        }
        if ($businessLocation && isset($businessLocation->id)) {
            $loyaltyIds = LoyaltyRewardLocation::where('location_id', $businessLocation->id)->pluck('loyalty_program_id');
        } else {
            // Handle the case where $businessLocation is null
            // Maybe log the error or provide a default behavior
            $loyaltyIds = collect(); // Return an empty collection or handle as needed
        }        
        
        // $dealIds = DealLocation::where('location_id', $businessLocation->id)->pluck('deal_id');
        // $loyaltyIds = LoyaltyRewardLocation::where('location_id', $businessLocation->id)->pluck('loyalty_program_id');
        $today = date('Y-m-d');
        $businessProfile = BusinessProfile::where('id', $id)
            ->with([
                'deals' => function ($query) use ($today, $dealIds) {
                    $query->whereIn('id', $dealIds)
                        ->where('status', 1)
                        ->where(function ($q) use ($today) {
                            $q->whereDate('end_Date', '>', $today)
                                ->orWhereNull('end_Date');
                        })
                        ->orderBy('id', 'desc')
                        ->where(function ($query) {
                            $query->whereNull('consumer_id')
                                ->when(Auth::check(), function ($q) {
                                    $q->orWhere('consumer_id', Auth::user()->id);
                                })
                                ->whereDoesntHave('consumerWallet', function ($subQuery) {
                                    $subQuery->when(Auth::check(), function ($q) {
                                        $q->where('consumer_id', Auth::user()->id);
                                    })->where('is_redeemed', 1);
                                });
                        })
                        ->take(5);
                },
                'loyalty' => function ($query) use ($today, $loyaltyIds) {
                    $query->whereIn('id', $loyaltyIds)
                        ->where('status', 1)
                        ->where(function ($q) use ($today) {
                            $q->whereDate('end_on', '>', $today)
                                ->orWhereNull('end_on');
                        })
                        ->orderBy('id', 'desc')
                        ->take(2);
                }
            ])
            ->where('status', 1)
            ->first();

        $data['deals'] = $businessProfile->deals;
        $data['loyalty'] = $businessProfile->loyalty;
        // dd($businessProfile);
        // dd($data['loyalty']);
        $businessLocations = $business->locations
            ->where('status', 1)
            ->where('participating_type', 'Participating')
            ->values()
            ->toArray();

        // dd($businessLocations);
        return view('frontend.business.website', compact('business', 'message_board', 'providerType', 'business_photos', 'businesses','alreadyFav','data','businessLocations'));
    } 

    public function searchBusinessProfile(Request $request){
        
        $validator = Validator::make($request->all(), [ 
            'search' => 'required',
            'lat' => Auth::check() ? 'nullable' : 'required|numeric|between:-90,90',
            'long' => Auth::check() ? 'nullable' : 'required|numeric|between:-180,180',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        //dd($request->all());
        $search = $request->search;

        try {
            if ($search != null) {
                $today = date('Y-m-d');
                // dd($today);
                $business_profiles = BusinessProfile::where('business_name', 'like', '%' . trim($search) . '%')->where(function ($query) use ($today) {
                    $query->whereHas('deals', function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_Date', '>', $today)->orWhereNull('end_Date');
                    })->orWhereHas('loyalty', function ($query) use ($today) {
                        $query->where('status', 1)
                            ->whereDate('end_on', '>', $today)->orWhereNull('end_on');
                    });
                })->where('status', 1)->select('id', 'business_name')->get()->makeHidden(['locations', 'multiple_images', 'story_image_url', 'formatted_location']);
                //dd($business_profiles,'business_profiles');
                $distances = [];
                foreach ($business_profiles as $business) {
                    $latitude = Auth::check() ? Auth::user()->lat : $request->lat;
                    $longitude = Auth::check() ? Auth::user()->long : $request->long;
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
                //dd($filtered_profiles);
                if (count($filtered_profiles) > 0) {
                    return redirect()->route('frontend.market-universe')
                        ->with('success', 'Business Profile Fetched')
                        ->with('profiles', $filtered_profiles);
                } else {
                    return redirect()->route('frontend.market-universe')
                        ->with('error', 'No data found');
                }
            }
        } catch (\Throwable $th) {
            Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
            return redirect()->route('frontend.market-universe')
            ->with('error', 'Server Error! Please try again later.');
        }

        
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
}
