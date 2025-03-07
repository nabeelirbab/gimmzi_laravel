<?php

namespace App\Http\Controllers\Frontend\Consumer;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\BuildingUnit;
use App\Models\ConsumerBadge;
use App\Models\MerchantLocation;
use App\Models\Point;
use App\Models\ProviderSubType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ShortTermGuestBadge;
use App\Models\TravelTourism;
use App\Models\TravelTourismSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\ApartmentGuestBadge;
use App\Models\Apartmentbadge;
use App\Models\ProviderLimitSetting;
use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;

class AuthConsumerController extends Controller
{
    public function consumerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'  => 'required|min:8'
        ], [
            'email.required' => 'The Preferred email field is required.',
            'email.email' => 'The Preferred email must be a valid email address',
            'email.regex' => 'The Preferred email format is invalid',
            'password.required' => 'The Password field is required'
        ]);

        $consumer = User::role('CONSUMER')->where('email', strtolower($request->email))->where('active', 1)->first();
        if ($consumer) {

            if (Hash::check($request->password, $consumer->password)) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    if (session()->has('get_page')) {
                        if (session()->get('get_page') == 'travel_website_page') {
                            return redirect()->route('frontend.travel-tourism.list')->with('success', 'Successfully Login.');
                        }
                    } else {
                        return redirect()->route('frontend.consumer-dashboard')->with('success', 'Successfully Login.');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Password Not match.');
            }
        } else {
            return redirect()->back()->with('error', 'Consumer not found or not active.');
        }
    }
    public function consumerDashboard()
    {
        $user = Auth::user();
        $consumerBuilding = BuildingUnit::where('consumer_id', $user->id)->with('buildings')->with('user')->get();
        $providerTypeName1 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 1)->get();
        $providerTypeName2 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 2)->get();
        $providerTypeName3 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 3)->get();
        // $providerCount = Provider::with('type')->with('provider')->where('provider_type_id', 1)->count();
        // $user-> 
        //  = MerchantLocation::with('businessLocation')->first();
        //  dd($providerType);
        return view('frontend.consumer.consumer-dashboard', compact('user', 'consumerBuilding', 'providerTypeName1', 'providerTypeName2', 'providerTypeName3'));
    }

    public function consumerLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('frontend.index');
        }
    }

    public function acceptBadgeRequest($listing_id)
    {
        if (Auth::check()) {
            // dd($listing_id); // short_term_guest_badges id 
            if (auth()->user()->role_name == 'CONSUMER') {
                $badge = ShortTermGuestBadge::find($listing_id);
                if(!$badge){
                    return redirect()->back()->with('error', 'No badge found in this request.');
                }
                if(auth()->user()->email != $badge->guest_email){
                    return redirect()->back()->with('error', 'Please login with the invited mail address to accept the badge.');
                }
                $family_badge_count = ShortTermGuestBadge::where([
                    'checkin_date' => $badge->checkin_date,
                    'checkout_date' => $badge->checkout_date,
                    'listing_id' => $badge->listing_id,
                    'is_friend_and_family_badge_active' => 1
                ])->count();
                // dd($family_badge_count);
                
                $start_date = $badge->checkin_date;
                $end_date = $badge->checkout_date;
                $guest_email = $badge->guest_email;
                $today = date('Y-m-d');
                
                $from_short_term = ShortTermGuestBadge::where('guest_email',$guest_email)->where('id','!=',$listing_id)->where('badge_status',1)
                ->where('checkout_date','>',$today)->first();
                if($from_short_term ){
                    return redirect()->back()->with('error', 'You have already active on another badge.');
                }
                
                $from_hotel = HotelGuestBadges::where('guest_email',$guest_email)->where('status',1)->get();
                if($from_hotel){
                    foreach($from_hotel as $hotel){
                        $badge_id = $hotel->badges_id;
                        $check_badge_date = HotelBadges::where('id',$badge_id)->where('end_date','>',$today)->first();
                        if($check_badge_date){
                            return redirect()->back()->with('error', 'You have already active on another badge.');
                        }
                    }
                }

                $from_apart = ApartmentGuestBadge::where('guest_email',$guest_email)->where('status',1)->get();
                if($from_apart){
                    foreach($from_apart as $apart){
                        $badge_id = $apart->badges_id;
                        $check_badge_date = Apartmentbadge::where('id',$badge_id)->where('end_date','>',$today)->first();
                        if($check_badge_date){
                            return redirect()->back()->with('error', 'You have already active on another badge.');
                        }
                    }
                }
                // dd(auth()->user()->email);
                // if(auth()->user()->email === $guest_email){
                //     return redirect()->back()->with('error', 'You have already active on a badge.');
                // }
                if ($badge) {
                    //  dd($badge);
                    if ($badge->badge_status == 0) {
                        $setting = TravelTourismSettings::where('travel_tourism_id', $badge->short_term_id)->first();

                        if ($setting) {
                            if ($setting->badge_bonus_point != null) {
                                $user = User::find(Auth::id());
                                $date1 = date_create($badge->checkin_date);
                                $date2 = date_create($badge->checkout_date);
                                $diff = date_diff($date1, $date2);
                                $days = $diff->format("%a");
                                $badge_point = ((int)$days * $setting->badge_bonus_point);
                                $badgeData = Badge::where('status', 1)->where('title', 'Gimmzi Access')->first();
                                $total_point = $user->point + $badge_point + $badgeData->badge_point;
                                // dd($badge_point, $badgeData->badge_point,$setting->badge_bonus_point,$days );
                                $user->point = $family_badge_count > 0 ? ($total_point + $setting->guest_of_week_point) : $total_point;
                                $user->save();
                                $badge->points = $family_badge_count > 0 ? ($badge_point + $setting->guest_of_week_point) : $total_point;
                                $badge->badge_status = 1;
                                $badge->guest_id = $user->id;
                                $badge->is_friend_and_family_badge_active = $family_badge_count > 0 ? 1 : 0;

                                $badge->save();
                                // $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();

                                Point::create([
                                    'user_id' => $user->id,
                                    'point' => $badge_point,
                                    'badge_id' => $badgeData->id,
                                    'sign' => '+'
                                ]);

                                Point::create([
                                    'user_id' => $user->id,
                                    'point' => $setting->guest_of_week_point,
                                    'badge_id' => $badgeData->id,
                                    'sign' => '+'
                                ]);

                                ConsumerBadge::create([
                                    'user_id' => $user->id,
                                    'badges_id' => $badgeData->id,
                                    'point' => $badge_point,
                                    'badge_activate_date' => date('Y-m-d')
                                ]);
                                ConsumerBadge::create([
                                    'user_id' => $user->id,
                                    'badges_id' => $badgeData->id,
                                    'point' => $setting->guest_of_week_point,
                                    'badge_activate_date' => date('Y-m-d')
                                ]);

                                if ($family_badge_count > 0) {
                                    $travel_tourism = TravelTourism::find($badge->short_term_id);
                                    $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $setting->guest_of_week_point;
                                    $travel_tourism->save();
                                }
                            }
                        }
                        return redirect()->back()->with('success', 'Your badge request is accepted');
                    } else {
                        return redirect()->back()->with('success', 'You have already accept the badges.');
                    }
                } else {
                    return redirect()->back()->with('error', 'No badge request found');
                }
            } else {
                return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
            }
        } else {
            $guestEmail = ShortTermGuestBadge::where('id', $listing_id)->first();
            $user = User::where('email', $guestEmail->guest_email)->first();

            $start_date = $guestEmail->checkin_date;
            $end_date = $guestEmail->checkout_date;
            $guest_email = $guestEmail->guest_email;
            $today = date('Y-m-d');

            $from_short_term = ShortTermGuestBadge::where('guest_email',$guest_email)->where('id','!=',$listing_id)->where('badge_status',1)
                                ->where('checkout_date','>',$today)->first();
                if($from_short_term ){
                    return redirect()->back()->with('error', 'You have already active on another badge.');
                }
                
            $from_hotel = HotelGuestBadges::where('guest_email',$guest_email)->where('status',1)->get();
            if($from_hotel){
                foreach($from_hotel as $hotel){
                    $badge_id = $hotel->badges_id;
                    $check_badge_date = HotelBadges::where('id',$badge_id)->where('end_date','>',$today)->first();
                    if($check_badge_date){
                        return redirect()->back()->with('error', 'You have already active on another badge.');
                    }
                }
            }

            $from_apart = ApartmentGuestBadge::where('guest_email',$guest_email)->where('status',1)->get();
            if($from_apart){
                foreach($from_apart as $apart){
                    $badge_id = $apart->badges_id;
                    $check_badge_date = Apartmentbadge::where('id',$badge_id)->where('end_date','>',$today)->first();
                    if($check_badge_date){
                        return redirect()->back()->with('error', 'You have already active on another badge.');
                    }
                }
            }

            $year = '';
            $month = '';
            $day = ''; 
            $register_data = [];

            if ($user == NULL) {
                $register_data = [
                    'email' => $guestEmail->guest_email,
                    'booking_date' => 'Check In: ' . Carbon::parse($guestEmail->checkin_date)->format('m/d/Y') . ' - Check Out: ' .  Carbon::parse($guestEmail->checkout_date)->format('m/d/Y'),
                    'sort_term_name' => $guestEmail->shortterm->name,
                    'type' => 'short_term',
                    'first_name' => '',
                    'last_name' => '',
                    'zip_code' => '',
                    'year' => $year,
                    'month' => $month,
                    'day' => $day
                ];
                Session::put("register_data", $register_data);
                Session::put('isRegistered', 1);

                return redirect()->route('frontend.index')->with('error', 'You are not registered before, please register and login');
            } else {

                $register_data = [
                    'email' => $guestEmail->guest_email,
                    'booking_date' => 'Check In: ' . Carbon::parse($guestEmail->checkin_date)->format('m/d/Y') . ' - Check Out: ' .  Carbon::parse($guestEmail->checkout_date)->format('m/d/Y'),
                    'sort_term_name' => $guestEmail->shortterm->name,
                    'type' => 'short_term',
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'zip_code' => '',
                    'year' => $year,
                    'month' => $month,
                    'day' => $day
                ];
                Session::put("register_data", $register_data);

                Session::forget('isRegistered');

                return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
            }
        }
    }

    public function acceptApartmentBadgeRequest($badge_id){
    //    dd($badge_id);
        if (Auth::check()) {
            $user = User::find(auth()->user()->id);
            $today = date('Y-m-d');
            $badge = ApartmentGuestBadge::find($badge_id);
            $guest_email = $badge->guest_email;

                $from_short_term = ShortTermGuestBadge::where('guest_email',$guest_email)->where('badge_status',1)
                                ->where('checkout_date','>',$today)->first();
                if($from_short_term ){
                    return redirect()->back()->with('error', 'You have already active on another badge.');
                }
                
                $from_hotel = HotelGuestBadges::where('guest_email',$guest_email)->where('status',1)->get();
                if($from_hotel){
                    foreach($from_hotel as $hotel){
                        $badge_id = $hotel->badges_id;
                        $check_badge_date = HotelBadges::where('id',$badge_id)->where('end_date','>',$today)->first();
                        if($check_badge_date){
                            return redirect()->back()->with('error', 'You have already active on another badge.');
                        }
                    }
                }

                $from_apart = ApartmentGuestBadge::where('guest_email',$guest_email)->where('id','!=',$badge_id)->where('status',1)->get();
                if($from_apart){
                    foreach($from_apart as $apart){
                        $badge_id = $apart->badges_id;
                        $check_badge_date = Apartmentbadge::where('id',$badge_id)->where('end_date','>',$today)->first();
                        if($check_badge_date){
                            return redirect()->back()->with('error', 'You have already active on another badge.');
                        }
                    }
                }


            if (auth()->user()->role_name == 'CONSUMER') {
                $apartment_badge = ApartmentGuestBadge::find($badge_id);
                if(($apartment_badge) && ($apartment_badge->user_id == $user->id)){
                    $badge =  Apartmentbadge::find($apartment_badge->badges_id);
                    // if($badge->start_date >= $today){
                        if($apartment_badge->status == 0){
                            $apartment_badge->status = 1;
                            $apartment_badge->save();
                            $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                            if($limit_setting){
                                if($limit_setting->sign_up_bonus_point != null){
                                    $signuppoint = $limit_setting->sign_up_bonus_point ? $limit_setting->sign_up_bonus_point : 0;
                                    $allowancepoint = $limit_setting->current_allowance_point_limit ? $limit_setting->current_allowance_point_limit : 0;
                                    
                                    $total_point = $user->point + $signuppoint + $allowancepoint;
                                    // dd($user->point , $signuppoint , $allowancepoint , $total_poin);
                                    $user->point = $total_point;
                                    
                                    $user->save();
                                    $apartment_badge->point = $signuppoint + $allowancepoint;
                                    $apartment_badge->save();
                                    $badgeData = Badge::where('status', 1)->where('title', 'Resident')->first();
                                    //Log::debug('point',$point);
                                    Point::create([
                                        'user_id' => $user->id,
                                        'point' => $signuppoint + $allowancepoint,
                                        'badge_id' => $badgeData->id,
                                        'sign' => '+'
                                    ]);
                                    ConsumerBadge::create([
                                        'user_id' => $user->id,
                                        'badges_id' => $badgeData->id,
                                        'point' => $signuppoint + $allowancepoint,
                                        'badge_activate_date' => date('Y-m-d')
                                    ]);
                                    
                                }
                            }
                            return redirect()->route('frontend.consumer-dashboard')->with('success', 'Your badge request is accepted');
                        }
                        else{
                            return redirect()->route('frontend.consumer-dashboard')->with('success', 'You have already accept the badges.');
                        }
                    // }
                }
                else {
                    return redirect()->route('frontend.consumer-dashboard')->with('error', 'No badge request found');
                }
                     
            }
            else{
                return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
            }
        }
        else{

            
            $apartment_badge = ApartmentGuestBadge::find($badge_id);
            if($apartment_badge){
               $badge =  Apartmentbadge::find($apartment_badge->badges_id);
               if($badge){
              
                if($apartment_badge->date_of_birth != null){
                   $orderdate = explode('-', $apartment_badge->date_of_birth);
                    //   $year = $orderdate[0] ?? '';
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day= $orderdate[2];
                }
                else
                {
                    $year = '';
                    $month = '';
                    $day = '';   
                }
                $today = date('Y-m-d');
                if($badge->end_date < $today){
                    
                    return redirect()->route('frontend.index')->with('error', 'Badge checkout date is expired ');
                }
                else{
                    $register_data = [];
                    if($apartment_badge->user_id == null){
                        $register_data = [
                            'first_name' => $apartment_badge->guest_first_name,
                            'last_name' => $apartment_badge->guest_last_name,
                            'email' => $apartment_badge->guest_email,
                            'booking_date' => 'Lease Start Date: ' . Carbon::parse($badge->start_date)->format('m/d/Y') . ' - Lease End Date: ' .  Carbon::parse($badge->end_date)->format('m/d/Y'),
                            'sort_term_name' => $badge->buildingunit->name.'('.$badge->building->building_name.')',
                            'type' => 'apartment',
                            'zip_code' => $apartment_badge->zip_code,
                            'year' => $year,
                            'month' => $month,
                            'day' => $day

                        ];
                        // dd($register_data);
                        Session::put("register_data", $register_data);
                        Session::put('isRegistered', 1);
                          
                        return redirect()->route('frontend.index')->with('error', 'You are not registered before, please register and login');
                    }
                    else{
                        $register_data = [
                            'first_name' => $apartment_badge->guest_first_name,
                            'last_name' => $apartment_badge->guest_last_name,
                            'email' => $apartment_badge->guest_email,
                            'booking_date' => 'Lease Start Date: ' . Carbon::parse($badge->start_date)->format('m/d/Y') . ' - Lease End Date: ' .  Carbon::parse($badge->end_date)->format('m/d/Y'),
                            'sort_term_name' => $badge->buildingunit->name.'('.$badge->building->building_name.')',
                            'type' => 'apartment',
                            'zip_code' => $apartment_badge->zip_code,
                            'year' => $year,
                            'month' => $month,
                            'day' => $day
                        ];
                        Session::put("register_data", $register_data);
        
                        Session::forget('isRegistered');
        
                        return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
                    }
                }
               }
            }
        }
    }

    public function acceptHotelBadgeRequest($badge_id){
        if (Auth::check()) {
            $apartment_badge = HotelGuestBadges::find($badge_id);
            if($apartment_badge == null){      
                return redirect()->route('frontend.consumer-dashboard')->with('error', 'No badge found.');
            }
            $badge =  HotelBadges::find($apartment_badge->badges_id);
            $start_date =$badge->start_date;
            $end_date = $badge->end_date;
            $user_email = $apartment_badge->guest_email;
            $get_from_short_term = ShortTermGuestBadge::where('guest_email',trim($user_email))->where('checkout_date','>', $start_date)->where('badge_status',1)->first();
            if(isset($get_from_short_term->id)){
                return redirect()->route('frontend.consumer-dashboard')->with('error', 'Already exist in another badge.');
            }
            $today = date('Y-m-d');
            $from_short_term = ShortTermGuestBadge::where('guest_email',trim($user_email))->where('checkout_date','>', $today)->where('badge_status',1)->first();
            // dd($from_short_term);
            if($from_short_term){
                return redirect()->route('frontend.consumer-dashboard')->with('error', 'Already exist in another badge.');
            }
            
            // if(auth()->user()->id == $apartment_badge->user_id){
                $check_active_from_another_badge = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                                ->where('hotel_guest_badges.user_id', $apartment_badge->user_id)
                                ->where('hotel_badges.end_date','>', $start_date)
                                ->where('hotel_guest_badges.id','!=', $apartment_badge->id)
                                ->where('hotel_guest_badges.status',1)
                                ->get()->toArray();
                // dd($check_active_from_another_badge);
                if(!empty($check_active_from_another_badge)){
                    return redirect()->route('frontend.consumer-dashboard')->with('error', 'You have already accept another badge.');
                }
                
                $active_from_another_badge = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                ->where('hotel_guest_badges.user_id', $apartment_badge->user_id)
                ->where('hotel_guest_badges.status', 1)
                ->where('hotel_badges.end_date','>', $today)
                ->get()->toArray();
                if(!empty($active_from_another_badge)){
                    return redirect()->route('frontend.consumer-dashboard')->with('error', 'You have already accept another badge.');
                }
                // dd($active_from_another_badge,$start_date);


                // $check_current_badge = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                // ->where('hotel_guest_badges.id','=', $apartment_badge->id) 
                // ->where('hotel_badges.end_date','>', $start_date)
                // ->where('hotel_guest_badges.status',1)
                // ->get()->toArray();
                // // dd($check_active_from_another_badge,$check_current_badge);
                // if($check_current_badge){
                //     return redirect()->route('frontend.consumer-dashboard')->with('error', 'You have already accept theis badge.');
                // }                
                    
                              
            // }
           

            // implement to check email from all guest db here
            $user = User::find(auth()->user()->id);
            $today = date('Y-m-d');
            if (auth()->user()->role_name == 'CONSUMER') {
                $apartment_badge = HotelGuestBadges::find($badge_id);
                // dd($apartment_badge, $user);
                if(($apartment_badge) && ($apartment_badge->user_id == $user->id)){
                    $badge =  HotelBadges::find($apartment_badge->badges_id);
                    // dd($badge);

                    
                    $this->selected_badge = HotelBadges::find($badge->id);
                    $hotel_id = HotelBuildings::select('hotel_id')->where('id',$this->selected_badge->building_id)->first();
                    // dd($this->selected_badge, $hotel_id);
                    // if($badge->start_date >= $today){
                    // dd($badge,$badge->start_date, $badge->end_date,auth()->user()->id);
                        if($apartment_badge->status == 0){
                            $apartment_badge->status = 1;
                            
                            $limit_setting = TravelTourismSettings::where('travel_tourism_id',$hotel_id->hotel_id)->first();
                            $date1 = date_create($badge->start_date);
                            $date2 = date_create($badge->end_date);
                            $diff = date_diff($date1, $date2);
                            $days = $diff->format("%a");
                            $badge_bonus_point = $limit_setting->badge_bonus_point * $days + $user->point;
                            $apartment_badge->point = $badge_bonus_point;
                            $apartment_badge->save();

                            $user->point = $badge_bonus_point;
                            $user->save();
                            //HERE WE CAN ADD THE POINT.
                            
                            // $limit_setting = TravelTourismSettings::where('travel_tourism_id',$hotel_id->hotel_id)->first();
                            // if($limit_setting){
                            //     if($limit_setting->sign_up_bonus_point != null){
                            //         $signuppoint = $limit_setting->sign_up_bonus_point ? $limit_setting->sign_up_bonus_point : 0;
                            //         $allowancepoint = $limit_setting->current_allowance_point_limit ? $limit_setting->current_allowance_point_limit : 0;
                                    
                            //         $total_point = $user->point + $signuppoint + $allowancepoint;
                            //         // dd($total_point);

                            //         $user->point = $total_point;
                            //         $user->save();
                            //         $apartment_badge->point = $signuppoint + $allowancepoint;
                            //         $apartment_badge->save();
                            //         $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                            //         //Log::debug('point',$point);
                            //         Point::create([
                            //             'user_id' => $user->id,
                            //             'point' => $signuppoint + $allowancepoint,
                            //             'badge_id' => $badgeData->id,
                            //             'sign' => '+'
                            //         ]);
                            //         ConsumerBadge::create([
                            //             'user_id' => $user->id,
                            //             'badges_id' => $badgeData->id,
                            //             'point' => $signuppoint + $allowancepoint,
                            //             'badge_activate_date' => date('Y-m-d')
                            //         ]);
                                    
                            //     }
                            // }
                            return redirect()->route('frontend.consumer-dashboard')->with('success', 'Your badge request is accepted.');
                        }
                        else{
                            return redirect()->route('frontend.consumer-dashboard')->with('error', 'You have already accept the badges.');
                        }
                    // }
                }
                else {
                    return redirect()->route('frontend.consumer-dashboard')->with('error', 'No badge request found');
                }
                     
            }
            else{
                return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
            }
        }
        
        else{
            // dd($badge_id);
            
            $apartment_badge = HotelGuestBadges::find($badge_id);
            if($apartment_badge == null){      
                return redirect()->route('frontend.index')->with('error', 'No badges found.');
            }
            // dd($apartment_badge);
            $unit_id = $apartment_badge->guestbadges->unit_id;
            $hotel_id = HotelUnites::select('hotel_id')->where('id',$unit_id)->first();
            $hotel = TravelTourism::select('name')->where('id',$hotel_id->hotel_id)->first();
            $hotel_name = $hotel->name;
            // dd($hotel_name);
            if($apartment_badge){
               $badge =  HotelBadges::find($apartment_badge->badges_id);
               $building_name = HotelBuildings::select('building_name')->where('id',$badge->building_id)->first();
               //dd($badge->building_id);
               if($badge){
              
                if($apartment_badge->date_of_birth != null){
                   $orderdate = explode('-', $apartment_badge->date_of_birth);
                    //   $year = $orderdate[0] ?? '';
                    $year = $orderdate[0];
                    $month = $orderdate[1];
                    $day= $orderdate[2];
                }
                else
                {
                    $year = '';
                    $month = '';
                    $day = '';   
                }
                $today = date('Y-m-d');
                if($badge->end_date < $today){
                    
                    return redirect()->route('frontend.index')->with('error', 'Badge checkout date is expired ');
                }
                else{
                    $register_data = [];
                    if($apartment_badge->user_id == null){
                        $register_data = [
                            'first_name' => $apartment_badge->guest_first_name,
                            'last_name' => $apartment_badge->guest_last_name,
                            'email' => $apartment_badge->guest_email,
                            'booking_date' => 'Check in: ' . Carbon::parse($badge->start_date)->format('m/d/Y') . ' - Check out: ' .  Carbon::parse($badge->end_date)->format('m/d/Y'),
                            // 'sort_term_name' => $badge->unites->unit_name.$building_name->$building_name,
                            'sort_term_name' => $hotel_name,
                            'type' => 'Hotel',
                            'zip_code' => $apartment_badge->zip_code,
                            'year' => $year,
                            'month' => $month,
                            'day' => $day,
                            'req_badge_id' => $apartment_badge->badges_id

                        ];
                        // dd($register_data);
                        Session::put("register_data", $register_data);
                        Session::put('isRegistered', 1);
                          
                        return redirect()->route('frontend.index')->with('error', 'You are not registered before, please register and login');
                    }
                    else{
                        $register_data = [
                            'first_name' => $apartment_badge->guest_first_name,
                            'last_name' => $apartment_badge->guest_last_name,
                            'email' => $apartment_badge->guest_email,
                            'booking_date' => 'Lease Start Date: ' . Carbon::parse($badge->start_date)->format('m/d/Y') . ' - Lease End Date: ' .  Carbon::parse($badge->end_date)->format('m/d/Y'),
                            'sort_term_name' => $badge->unites->unit_name.'('.$building_name->$building_name.')',
                            'type' => 'apartment',
                            'zip_code' => $apartment_badge->zip_code,
                            'year' => $year,
                            'month' => $month,
                            'day' => $day,
                            'req_badge_id' => $apartment_badge->badges_id
                        ];
                        Session::put("register_data", $register_data);
        
                        Session::forget('isRegistered');
        
                        return redirect()->route('frontend.index')->with('error', 'You need to be logged in as a consumer to accept the badge request ');
                    }
                }
               }
            }
        }
    }
}




