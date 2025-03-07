<?php

namespace App\Http\Controllers\Frontend\TravelTourism;

use App\Http\Controllers\Controller;
use App\Models\ShortTermRentalListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\MediaLibrary\Models\Media;
use App\Models\ProviderMessageBoard;
use App\Models\TravelTourism;
use PDF, session;
use App\Models\ShortTermGuestBadge;
use Illuminate\Support\Facades\Validator;
use App\Models\Badge;
use App\Models\Point;
use App\Models\ConsumerBadge;
use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\RecognitionType;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsumerRegistrationMail;
use App\Models\TravelTourismSettings;
use App\Mail\HotelBadgeSentEmail;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;




class ProfileController extends Controller
{
    public function shortTermDashboard()
    {

        return view('frontend.travel-tourism.short-term-rental.dashboard');
    }

    public function hotelResortDashboard()
    {

        return view('frontend.travel-tourism.hotel-resort.dashboard');
    }

    public function shortTermLogout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('frontend.index');
    }

    public function hotelResortLogout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('frontend.index');
    }

    public function smartGuestDatabase()
    {
        return view('frontend.travel-tourism.short-term-rental.smart-guest-database');
    }

    public function shortTermMessageBoard()
    {

        return view('frontend.travel-tourism.short-term-rental.message-board');
    }

    public function smartRentalAccessManagement()
    {
        return view('frontend.travel-tourism.short-term-rental.smart-rental-access-management');
    }

    public function deleteShortTermListingPhoto(Request $request)
    {
        if ($request->ajax()) {

            $photoArray = array();
            $media =  Media::find($request->photoid);

            if ($media) {
                $shortList = ShortTermRentalListing::find($request->listid);
                if ($shortList) {
                    if ($shortList->main_image == $media->getUrl()) {
                        $shortList->main_image = '';
                        $shortList->save();
                        $media->delete();
                        $photos = Media::where(['model_id' => $request->listid, 'collection_name' => 'ShortTermListingImages'])->get();
                        if (count($photos) > 0) {
                            foreach ($photos as $data) {
                                array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                            }
                        }
                        return response()->json(['status' => 1, 'message' => 'image deleted', 'data' => $photoArray]);
                    } else {
                        $media->delete();
                        $photos = Media::where(['model_id' => $request->listid, 'collection_name' => 'ShortTermListingImages'])->get();
                        if (count($photos) > 0) {
                            foreach ($photos as $data) {
                                array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                            }
                        }
                        return response()->json(['status' => 2, 'message' => 'image deleted', 'data' => $photoArray]);
                    }
                }
            }
        }
    }

    public function resetShortTermRentalPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            if (Auth::check()) {
                if (Auth::user() == $user) {
                    return redirect()->route('frontend.short_term.dashboard')->with('token', $token);
                } else {
                    return redirect()->route('frontend.index')->with('token', $token);
                }
            } else {
                return redirect()->route('frontend.index')->with('token', $token);
            }
        }
    }

    public function resetHotelResortPassword($token)
    {
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            if (Auth::check()) {
                if (Auth::user() == $user) {
                    return redirect()->route('frontend.hotel_resort.dashboard')->with('token', $token);
                } else {
                    return redirect()->route('frontend.index')->with('token', $token);
                }
            } else {
                return redirect()->route('frontend.index')->with('token', $token);
            }
        }
    }



    public function shortTermSettings()
    {
        return view('frontend.travel-tourism.short-term-rental.settings');
    }

    public function searchShortTerm($short_term_id)
    {
        if(session()->has('listingid')){
            session()->forget('listingid');
        }
        if(session()->has('type')){
            session()->forget('type');
        }
        if(session()->has('listing_name')){
            session()->forget('listing_name');
        }

        $short_termid = base64_decode($short_term_id);
        $listing = ShortTermRentalListing::find($short_termid);
        $today = date('Y-m-d');
        $remaining_guest = 0;
        $badges = ShortTermGuestBadge::where('listing_id', $short_termid)
                                        ->where('checkout_date', '>', $today)
                                        ->where('checkin_date','<=',$today)
                                        ->get();
        //dd($badges);
        if (count($badges) > 0) {

            foreach ($badges as $badgedata) {
                if($badgedata->checkin_time != null){
                    $chkin_time = $badgedata->checkin_time;
                }else{
                    $chkin_time = '00:00:01';
                }

                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toDateTimeString();
                $datetime_utc = new DateTime($formattedTime, new DateTimeZone('UTC'));
                $datetime_utc->setTimezone(new DateTimeZone('America/New_York'));
                $timestamp_in_est = $datetime_utc->format('Y-m-d H:i:s');
                $est_time = $datetime_utc->format('H:i:s');

                if($badgedata->checkin_date == $today){
                    if($est_time < $chkin_time){
                        $guests = 0;
                    }else{
                        $guests = ShortTermGuestBadge::where('listing_id', $short_termid)
                            ->where('checkin_date', $badgedata->checkin_date)
                            ->where('checkout_date', $badgedata->checkout_date)
                            ->count();
                    }
                }else{
                    $guests = ShortTermGuestBadge::where('listing_id', $short_termid)
                            ->where('checkin_date', $badgedata->checkin_date)
                            ->where('checkout_date', $badgedata->checkout_date)
                            ->count();
                }
                // $guests = ShortTermGuestBadge::where('listing_id', $short_termid)
                //             ->where('checkin_date', $badgedata->checkin_date)
                //             ->where('checkout_date', $badgedata->checkout_date)
                //             ->count();
                //dd($guests);
                if ($guests > 0) {
                    if ($guests == $listing->no_of_guests) {
                        // $remaining_guest = 0;
                    } elseif ($guests < $listing->no_of_guests) {
                        $remaining_guest = $listing->no_of_guests - $guests;
                    } else {
                        $remaining_guest =  $listing->no_of_guests;
                    }
                } else {
                    //$remaining_guest = 0;
                }
            }
        }
        //dd($remaining_guest);
        if ($remaining_guest  == 0) {
            session()->put('type', 'consumer');
            return redirect()->route('frontend.short-term-website', $short_term_id)->withError('New badges are not available. Log in to find deals in the area!');
        } else {
            session()->put('listingid', $short_termid);
            session()->put('listing_name', $listing->name);
            return redirect()->route('frontend.short-term-website', $short_term_id);
        }
    }

    public function searchHotel($hotel_unit_id){
        $hotel_unitid = base64_decode($hotel_unit_id);
        $get_hotel_id = HotelUnites::find($hotel_unitid);
        $hotel_id = $get_hotel_id->hotel_id;

        $listing = TravelTourism::find($hotel_id);
        $today = date('Y-m-d');
        $remaining_guest = 50;
        $badges = HotelBadges::where('unit_id', $hotel_unitid)
                                        ->where('end_date', '>', $today)
                                        ->where('start_date','<=',$today)
                                        ->get();
        
        // dd(count($badges));
        if (count($badges) > 0) {
        //    dd('ffdfd');
            foreach ($badges as $badgedata) {
                if($badgedata->checkin_time != null){
                    $chkin_time = $badgedata->checkin_time;
                }else{
                    $chkin_time = '00:00:01';
                }

                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toDateTimeString();
                $datetime_utc = new DateTime($formattedTime, new DateTimeZone('UTC'));
                $datetime_utc->setTimezone(new DateTimeZone('America/New_York'));
                $timestamp_in_est = $datetime_utc->format('Y-m-d H:i:s');
                $est_time = $datetime_utc->format('H:i:s');

                if($badgedata->start_date == $today){
                    if($est_time < $chkin_time){
                        $guests = 0;
                    }else{
                        $guests = HotelGuestBadges::where('badges_id', $badgedata->id)
                            ->count();
                    }
                }else{
                    $guests = HotelGuestBadges::where('badges_id', $badgedata->id)
                            ->count();
                }

                // dd($guests);

                if ($guests > 0) {
                    if ($guests == 10) {
                        // $remaining_guest = 0;
                    } elseif ($guests < 10) {
                        $remaining_guest = 10 - $guests;
                    } else {
                        $remaining_guest = 10;
                    }
                } else {
                    $remaining_guest = 0;
                }
            }
        }
        $encode_hotel_id = base64_encode($hotel_id);
        $encode_unit_id = base64_encode($hotel_unitid);
        
        // dd($remaining_guest);
        if ($remaining_guest  < 10) {
            session()->put('listingid', $hotel_id);
            session()->put('listing_name', $listing->name);
            session()->put('type', 'consumer');
            return redirect()->route('frontend.hotel_resort_website.hotel-resort-website', [
                'hotel_id' =>$encode_hotel_id,
                'unit_id' =>$encode_unit_id
            ]);
        } else {
            return redirect()->route('frontend.index')->withError('New badges are not available. Log in or create an account  to find deals in the area!');
            // session()->put('listingid', $hotel_id);
            // session()->put('listing_name', $listing->name);
            // return redirect()->route('frontend.hotel_resort_website.hotel-resort-website',[
            //     'hotel_id' =>$encode_hotel_id,
            //     'unit_id' =>$encode_unit_id
            // ]);
        }
    }

    public function NewhotelResortWebsite($hotel_id,$unit_id){
        $hotelid = base64_decode($hotel_id);
        $unitid = base64_decode($unit_id);
        // dd($hotelid,$unitid);
        // dd($hotelid,$unitid,$unit_id);
        return view('frontend.travel-tourism.hotel-resort.new-hotel-resort-website', compact('hotelid','unitid'));
    }

    public function guestEmailCheck(Request $request)
    {   
        // dd($request->all());
        if ($request->ajax()) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $get_role_name = User::where('email', $request->email)->first();
                if($get_role_name){
                    if($get_role_name->role_name){
                        $role_name = $get_role_name->role_name;
                        // dd($role_name);
                        if($role_name != "CONSUMER"){
                            return response()->json(['success' => false, 'text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);  
                        }
                    }
                }

                $user = User::where('email', $request->email)->role('CONSUMER')->where('active',1)->first();
                // dd( $user->role_name);

                if ($user) {
                    $today = date('Y-m-d');
                    $badge = ShortTermGuestBadge::where('checkout_date', '>', $today)->where('guest_id',$user->id)->where('badge_status',1)->count();
                    // dd($badge);
                    if($badge > 0){
                        session()->forget('listingid');
                        session()->forget('listing_name');
                        return response()->json(['success' => false, 'text' => 'User already exist in another badge.']);
                    }

                    $check_hotel_guest = HotelGuestBadges::where('user_id',$user->id)->where('status',1)->get();
                    $exist_member = array();
                    // dd($check_hotel_guest);
                    if($check_hotel_guest){
                        foreach($check_hotel_guest as $guest){
                            $date_valid = HotelBadges::where('id',$guest->badges_id)->where('end_date','>',$today)->first();  
                            // dd($date_valid);
                            if($date_valid){
                                $exist_member[]=$date_valid->id;
                            }
                        }
                        if(!empty($exist_member)){
                            return response()->json(['success' => false, 'text' => 'User already exist in another badge.']); 
                        }
                    }


                    $check_apart_guest = ApartmentGuestBadge::where('user_id',$user->id)->where('status',1)->get();
                    $exist_member = array();
                    if($check_apart_guest){
                        foreach($check_apart_guest as $guest){
                            $date_valid = HotelBadges::where('id',$guest->badges_id)->where('end_date','>',$today)->first();
                            if($date_valid){
                                $exist_member[]=$date_valid->id;
                            }
                            
                        }
                        if(!empty($exist_member)){
                            return response()->json(['success' => false, 'text' => 'User already exist in another badge.']); 
                        }
                    }

                    return response()->json(['success' => true, 'data' => $user->id]);
                    
                    
                } else {
                    // dd('sdfsd');
                    return response()->json(['success' => false, 'text' => 'user_not_found']);
                }
            } else {
                return response()->json(['success' => false, 'text' => 'Email address should be valid']);
            }
        }
    }

    public function guestAddScheduledBadge(Request $request)
    { 
        
        if ($request->ajax()) {
            // dd($request->all());
            if ($request->badge_id != '') {
                if ($request->guest_id != '') {
                    $badge = ShortTermGuestBadge::find($request->badge_id);
                    if ($badge) {
                        if ($badge->guest_email == '') {
                            $badge->guest_email = $request->email;
                            $badge->guest_id = $request->guest_id;
                            $badge->badge_status = 1;
                            $badge->save();
                            $badgeid = $badge->id;
                        } else {
                            $new_badge = new ShortTermGuestBadge;
                            $new_badge->short_term_id = $badge->short_term_id;
                            $new_badge->listing_id = $badge->listing_id;
                            $new_badge->guest_id = $request->guest_id;
                            $new_badge->checkin_date = $badge->checkin_date;
                            $new_badge->checkout_date = $badge->checkout_date;
                            $new_badge->badge_status = 1;
                            $new_badge->guest_email = $request->email;
                            $new_badge->save();
                            $badgeid = $new_badge->id;
                        }
                        $user = User::find($request->guest_id);
                        $setting = TravelTourismSettings::where('travel_tourism_id', $badge->short_term_id)->first();
                        // if ($setting) {
                        //     if ($setting->badge_bonus_point != null) {
                        //         $date1 = date_create($badge->checkin_date);
                        //         $date2 = date_create($badge->checkout_date);
                        //         $diff = date_diff($date1, $date2);
                        //         $days = $diff->format("%a");
                        //         $badge_point = ((int)$days * $setting->badge_bonus_point);
                        //         $total_point = $user->point + $badge_point;
                        //         $user->point = $total_point;
                        //         $user->save();
                        //         $guest_badge = ShortTermGuestBadge::find($badgeid);
                        //         $guest_badge->points = $badge_point;
                        //         $guest_badge->save();
                        //         $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                        //         Point::create([
                        //             'user_id' => $user->id,
                        //             'point' => $badge_point,
                        //             'badge_id' => $badgeData->id,
                        //             'sign' => '+'
                        //         ]);
                        //         ConsumerBadge::create([
                        //             'user_id' => $user->id,
                        //             'badges_id' => $badgeData->id,
                        //             'point' => $badge_point,
                        //             'badge_activate_date' => date('Y-m-d')
                        //         ]);
                        //     }
                        // }
                    }
                    session()->remove('listingid');
                    session()->remove('listing_name');
                    return response()->json(['status' => true]);
                } else {
                    $validator  =   Validator::make($request->all(), [
                        "booking_phone"  =>  "unique:users,phone|numeric|digits_between:8,15",
                        "email" =>  "unique:users,email"
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                    }
                    if (($request->consumer_birth_year != '') && ($request->consumer_birth_day != '') && ($request->consumer_birth_month != '')) {
                        $dob = $request->consumer_birth_year . '-' . $request->consumer_birth_month . '-' . $request->consumer_birth_day;
                    } else {
                        $dob = '';
                    }
                    $data = array(
                        'first_name' => $request->booking_first_name,
                        'last_name' =>  $request->booking_last_name,
                        'email' =>  $request->email,
                        'phone' =>  $request->booking_phone,
                        'zip_code' =>  $request->zip_code,
                        'date_of_birth' =>  $dob,
                        'do_you_live_apartment' =>  false,
                    );
                    session()->put('userdata', $data);
                    session()->put('badgeid', $request->badge_id);
                    return response()->json(['status' => true]);
                  
                }
            }
        }
    }

    public function newGuestPasswordSubmit(Request $request){
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "consumer_password" =>  "regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20",
                "consumer_confirm_password" =>  "regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20|same:consumer_password",
            ], [
                'consumer_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_password.min' => 'Password must be minimum 8 character',
                'consumer_password.max' => 'Password must be maximum 20 character',
                'consumer_confirm_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_confirm_password.min' => 'Password must be minimum 8 character',
                'consumer_confirm_password.max' => 'Password must be maximum 20 character',
            ]);
    
            if ($validator->fails()) {
                return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
            }

            $session = session()->get('userdata');
            $badge_id = session()->get('badgeid');
            $user = User::create($session);
            $user->password = $request->consumer_password;
            $user->active = 1;
            $user->save();
        
            $user->assignRole('CONSUMER');
            $rand = rand(1000,9999);
            $consumerid = $rand.substr($user->first_name, 0, 3);
            // $consumerid = strtoupper(substr($user->first_name, 0, 3)) . '/CON/0' . $user->id;
            $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
            $signup_point = $point = $badgeData->badge_point;
            Point::create([
                'user_id' => $user->id,
                'point' => $point,
                'badge_id' => $badgeData->id,
                'sign' => '+'
            ]);
            $consumer_badge = ConsumerBadge::create([
                'user_id' => $user->id,
                'badges_id' => $badgeData->id,
                'point' => $point,
                'badge_activate_date' => date('Y-m-d')
            ]);
            $user->point = $point;
            $user->userId = $consumerid;
            $user->save();
            $badge = ShortTermGuestBadge::find($badge_id);
            if ($badge) {
                if ($badge->guest_email == '') {
                    $badge->guest_email = $user->email;
                    $badge->guest_id = $user->id;
                    $badge->badge_status = 1;
                    $badge->save();
                    $badgeid = $badge->id;
                } else {
                    $new_badge = new ShortTermGuestBadge;
                    $new_badge->short_term_id = $badge->short_term_id;
                    $new_badge->listing_id = $badge->listing_id;
                    $new_badge->guest_id = $user->id;
                    $new_badge->checkin_date = $badge->checkin_date;
                    $new_badge->checkout_date = $badge->checkout_date;
                    $new_badge->badge_status = 1;
                    $new_badge->guest_email = $user->email;
                    $new_badge->save();
                    $badgeid = $new_badge->id;
                }
            }
            $setting = TravelTourismSettings::where('travel_tourism_id', $badge->short_term_id)->first();
            if ($setting) {
                if ($setting->badge_bonus_point != null) {
                    $today_date = date('Y-m-d'); 
                    // if($today_date >= $badge->checkin_date){
                    //     $date1 = date_create($today_date);
                    // }else{
                    //     $date1 = date_create($badge->checkin_date);
                    // }
                    $date1 = date_create($badge->checkin_date);
                    $date2 = date_create($badge->checkout_date);
                    $diff = date_diff($date1, $date2);
                    $days = $diff->format("%a");
                    // dd($days,$date1,$date2,$today_date,$badge->checkin_date);
                    $badge_point = ((int)$days * $setting->badge_bonus_point);
                    $total_point = $user->point + $badge_point;
                    $user->point = $total_point;
                    $user->save();
                    $guest_badge = ShortTermGuestBadge::find($badgeid);
                    $guest_badge->points = $badge_point;
                    $guest_badge->save();
                    $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                    Point::create([
                        'user_id' => $user->id,
                        'point' => $badge_point,
                        'badge_id' => $badgeData->id,
                        'sign' => '+'
                    ]);
                    ConsumerBadge::create([
                        'user_id' => $user->id,
                        'badges_id' => $badgeData->id,
                        'point' => $badge_point,
                        'badge_activate_date' => date('Y-m-d')
                    ]);

                    $travel_data = TravelTourism::find($badge->short_term_id);
                    if($travel_data){
                        $travel_data->points_to_distribute = ($travel_data->points_to_distribute - ($badge_point));
                        $travel_data->save();
                    }
                }
            }
            $details = [
                'email'  =>  $user->email,
                'password' => $request->consumer_password,
                'name' => $user->first_name,
                'username' => $user->userId
            ];
            Mail::to($user->email)->queue(new ConsumerRegistrationMail($details));
            session()->remove('listingid');
            session()->remove('listing_name');
            session()->remove('badgeid');
            session()->remove('userdata');
            $message1 = 'Thanks for signing up ' . $user->first_name . ' ' . $user->last_name . ' and Welcome to Smart Rewards!';
            $message2 = 'Here’s ' . $signup_point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
            return response()->json(['status' => 0,'message1' => $message1, 'message2' => $message2]);

        }
    }

    public function HotelGuestPasswordSubmit(Request $request){
        // dd('csdc');
        
        if ($request->ajax()) {
            
            // dd($request->all());
            $validator  =   Validator::make($request->all(), [
                "consumer_password" =>  "regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20",
                "consumer_confirm_password" =>  "regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20|same:consumer_password",
            ], [
                'consumer_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_password.min' => 'Password must be minimum 8 character',
                'consumer_password.max' => 'Password must be maximum 20 character',
                'consumer_confirm_password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.',
                'consumer_confirm_password.min' => 'Password must be minimum 8 character',
                'consumer_confirm_password.max' => 'Password must be maximum 20 character',
            ]);
    
            if ($validator->fails()) {
                return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
            }
            // dd($request->guest_id,$request->badge_id);
            if($request->guest_id != null){
                $user = User::find($request->guest_id);
                $badge = HotelBadges::find($request->badge_id);
                // dd($badge);
                if ($badge) {
                    $guestbadge = HotelGuestBadges::where('badges_id',$badge->id)->where('user_id',$request->guest_id)->first();
                    // dd($guestbadge);
                    if (!$guestbadge) {
                        $new_badge = new HotelGuestBadges;
                        $new_badge->badges_id = $badge->id;
                        $new_badge->user_id = $user->id;
                        $new_badge->status = 1;
                        $new_badge->guest_email = $user->email;
                        $new_badge->save();
                        $badgeid = $new_badge->id;
                    }else{
                        $badgeid = $guestbadge->id;
                    }
                }
                $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                $signup_point = $point = $badgeData->badge_point;
                $get_hotel_id = HotelBuildings::where('id',$badge->building_id)->first();
                $setting = TravelTourismSettings::where('travel_tourism_id', $get_hotel_id->hotel_id)->first();
                if ($setting) {
                    if ($setting->badge_bonus_point != null) {
                        $date1 = date_create($badge->start_date);
                        $date2 = date_create($badge->end_date);
                        $diff = date_diff($date1, $date2);
                        $days = $diff->format("%a");
                        $badge_point = ((int)$days * $setting->badge_bonus_point);
                        $total_point = $user->point + $badge_point;
                        $user->point = $total_point;
                        $user->save();
                        $guest_badge = HotelGuestBadges::find($badgeid);
                        $guest_badge->point = $total_point;
                        $guest_badge->save();
                        $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                        Point::create([
                            'user_id' => $user->id,
                            'point' => $badge_point,
                            'badge_id' => $badgeData->id,
                            'sign' => '+'
                        ]);
                        ConsumerBadge::create([
                            'user_id' => $user->id,
                            'badges_id' => $badgeData->id,
                            'point' => $badge_point,
                            'badge_activate_date' => date('Y-m-d')
                        ]);
                        $travel_data = TravelTourism::find($get_hotel_id->hotel_id);
                        if($travel_data){
                            $travel_data->points_to_distribute = ($travel_data->points_to_distribute - ($badge_point));
                            $travel_data->save();
                        }
                    }
                    
                }
                $details = [
                    'email'  =>  $user->email,
                    'password' => $request->consumer_password,
                    // 'name' => $user->first_name . ' ' . $user->last_name,
                    'name' => $user->first_name,
                    'username' =>$user->email,
                ];
                Mail::to($user->email)->queue(new ConsumerRegistrationMail($details));
                session()->remove('listingid');
                session()->remove('listing_name');
                session()->remove('badgeid');
                session()->remove('userdata');
                $message1 = 'Thanks for signing up ' . $user->first_name . ' ' . $user->last_name . ' and Welcome to Smart Rewards!';
                $message2 = 'Here’s ' . $signup_point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                return response()->json(['status' => 0,'message1' => $message1, 'message2' => $message2]);
                
            }

            $session = session()->get('userdata');
            $badge_id = session()->get('badgeid');
            $user = User::create($session);
            $user->password = $request->consumer_password;
            $user->active = 1;
            $user->save();
        
            $user->assignRole('CONSUMER');
            $rand = rand(1000,9999);
            $consumerid = $rand.substr($user->first_name, 0, 3);
            // $consumerid = strtoupper(substr($user->first_name, 0, 3)) . '/CON/0' . $user->id;
            $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
            $signup_point = $point = $badgeData->badge_point;
            Point::create([
                'user_id' => $user->id,
                'point' => $point,
                'badge_id' => $badgeData->id,
                'sign' => '+'
            ]);
            $consumer_badge = ConsumerBadge::create([
                'user_id' => $user->id,
                'badges_id' => $badgeData->id,
                'point' => $point,
                'badge_activate_date' => date('Y-m-d')
            ]);
            $user->point = $point;
            $user->userId = $consumerid;
            $user->save();
            
            $badge = HotelBadges::find($badge_id);
            
            $new_badge = new HotelGuestBadges;
            $new_badge->badges_id = $badge->id;
            $new_badge->user_id = $user->id;
            $new_badge->status = 1;
            $new_badge->guest_email = $user->email;
            $new_badge->save();
            $badgeid = $new_badge->id;
             
            
            $get_hotel_id = HotelBuildings::where('id',$badge->building_id)->first();
            // dd($get_hotel_id,$get_hotel_id->hotel_id);
            
            $setting = TravelTourismSettings::where('travel_tourism_id', $get_hotel_id->hotel_id)->first();
            // dd($user->point);
            if ($setting) {
                if ($setting->badge_bonus_point != null) {
                    $date1 = date_create($badge->start_date);
                    $date2 = date_create($badge->end_date);
                    $diff = date_diff($date1, $date2);
                    $days = $diff->format("%a");
                    // dd($days,$badge,$setting->badge_bonus_point);
                    $badge_point = ((int)$days * $setting->badge_bonus_point);
                    $total_point = $user->point + $badge_point;
                    // 
                    $user->point = $total_point;
                    // dd($user->point,$total_point,$days,$setting->badge_bonus_point);
                    $user->save();
                    $guest_badge = HotelGuestBadges::find($badgeid);
                    $guest_badge->point = $total_point;
                    $guest_badge->save();
                    $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                    Point::create([
                        'user_id' => $user->id,
                        'point' => $badge_point,
                        'badge_id' => $badgeData->id,
                        'sign' => '+'
                    ]);
                    ConsumerBadge::create([
                        'user_id' => $user->id,
                        'badges_id' => $badgeData->id,
                        'point' => $badge_point,
                        'badge_activate_date' => date('Y-m-d')
                    ]);

                    $travel_data = TravelTourism::find($get_hotel_id->hotel_id);
                    if($travel_data){
                        $travel_data->points_to_distribute = ($travel_data->points_to_distribute - ($badge_point));
                        $travel_data->save();
                    }
                }
                
            }
            $details = [
                'email'  =>  $user->email,
                'password' => $request->consumer_password,
                'name' => $user->first_name . ' ' . $user->last_name,
                'username' => $user->email,
            ];
            Mail::to($user->email)->queue(new ConsumerRegistrationMail($details));
            session()->remove('listingid');
            session()->remove('listing_name');
            session()->remove('badgeid');
            session()->remove('userdata');
            $message1 = 'Thanks for signing up ' . $user->first_name . ' ' . $user->last_name . ' and Welcome to Smart Rewards!';
            $message2 = 'Here’s ' . $signup_point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
            return response()->json(['status' => 0,'message1' => $message1, 'message2' => $message2]);

        }
    }

    public function download_pdf($short_term_id)
    {

        $travel_tourism = TravelTourism::find($short_term_id);
        $data['city'] = $travel_tourism->city;
        $data['state'] = $travel_tourism->state->name;
        $data['provider_name'] = $travel_tourism->name;
        $encode_id = base64_encode($short_term_id);
        $data['text'] = url('short-term-rental/' . $encode_id);

        $pdf = PDF::loadView('index_pdf', $data);
        //dd($pdf);
        return $pdf->download('qr-code-pdf-file-' . time() . '.pdf');
    }

    public function print_pdf($short_term_id)
    {

        $travel_tourism = TravelTourism::find($short_term_id);
        $data['city'] = $travel_tourism->city;
        $data['state'] = $travel_tourism->state->name;
        $data['provider_name'] = $travel_tourism->name;
        $encode_id = base64_encode($short_term_id);
        $data['text'] = url('short-term-rental/' . $encode_id);

        return view('frontend.travel-tourism.short-term-rental.print_qrcode', compact('data'));
    }

    public function hotelResortMessageBoard()
    {
        return view('frontend.travel-tourism.hotel-resort.message-board');
    }

    public function hotelSmartAccessManagement()
    {
        return view('frontend.travel-tourism.hotel-resort.smart-access-management');
    }

    public function hotelResortSettings()
    {
        return view('frontend.travel-tourism.hotel-resort.setting');
    }

    public function lowPointBalanceMember()
    {
        return view('frontend.travel-tourism.low-point.low-point');
    }

    public function hotelResortWebsite($hotel_id){
        $hotelid = base64_decode($hotel_id);
        // dd($hotelid);
        return view('frontend.travel-tourism.hotel-resort-website', compact('hotelid'));
    }

    public function getProviderProfile(){
        return view('frontend.travel-tourism.my-profile.profile-settings');
    }

    public function getHotelProviderProfile(){
        return view('frontend.travel-tourism.my-profile.profile-settings');
    }

    public function smartRentalDB(){
        return view('frontend.travel-tourism.hotel-resort.smart-guest-database');
    }

    public function lowPointMember(){
        return view('frontend.travel-tourism.hotel-resort.low-point-member');
    }

    public function viewProfile($id){
        // dd($id);
        $conUnit = HotelGuestBadges::with('user','guestbadges.unites.unitbuildings','guestbadges.unites')->where('user_id',$id)->orderBy('id','DESC')->first();

        $badge_id = $conUnit->badges_id;
        // dd($badge_id);
        $unitid = $conUnit->guestbadges->unit_id;
        $consumer_unit = HotelGuestBadges::with('user')->where('badges_id',$conUnit->badges_id)->whereNotIn('user_id',[$id])->get();

        $recognitions = RecognitionType::where('status',1)->get();

        $hotel_id = $conUnit->guestbadges->unites->hotel_id;

        $get_added_points = TravelTourismSettings::where('id',$hotel_id)->select('guest_of_week_point')->first();
        $points = $get_added_points->guest_of_week_point;
        // dd($conUnit->guestbadges->unites->unit_name);
        // dd($conUnit,$unitid,$consumer_unit,$recognitions,$hotel_id);
        

        $badge =  HotelBadges::with('unites')->find($badge_id);
            $unitName = $badge->unites->unit_name;
            $badge_checkin_date = $badge->start_date;
            $badge_checkout_date = $badge->end_date;
            // dd($unitName,$badge_checkin_date,$badge_checkout_date);
            $checkin_date = date_format(date_create($badge->start_date), 'm/d/Y');
            $checkout_date = date_format(date_create($badge->end_date), 'm/d/Y');

            $guests = HotelGuestBadges::where('badges_id',$badge_id)
                                        ->where('guest_email','!=',null)
                                        // ->whereIn('status', [0, 1])
                                        ->get();

            $guest_count = count($guests);
                
            $listing = HotelBuildings::find($badge->building_id);
            $building_name =  $listing->building_name;
            if ($guest_count < 10) {
                $remaining_count = (10 - $guest_count);
            } else {
                $remaining_count = 0;
            }
            // $this->emit('selectedScheduledBadgesPopup');



        return view('frontend.travel-tourism.hotel-resort.hotel_consumer_account_view', compact('consumer_unit','conUnit','recognitions','hotel_id','points','checkin_date','checkout_date','guests','guest_count','listing','building_name','remaining_count','unitName','badge_checkin_date','badge_checkout_date','badge_id') );
    }

    public function shortTermViewProfile($id){
        //dd($id);
        // $conUnit = ShortTermGuestBadge::with('guest','listing')->where('guest_id',$id)->orderBy('id','DESC')->first();
        //  //dd($conUnit->guest->full_name);
        // // $unitid = $conUnit->guestbadges->unit_id;
        // $consumer_unit = ShortTermGuestBadge::with('guest')->where('listing_id',$conUnit->listing_id)->whereNotIn('guest_id',[$id])->get();
        // $recognitions = RecognitionType::where('status',1)->get(); 

        return view('frontend.travel-tourism.short-term-rental.short_term_consumer_account_view', compact('id'));
    }

    public function hotelUserRecognation($id){
        // dd($id);
    }

    public function addPointsToConsumer(Request $request){
        $conunitId = $request->query('conunit_id');   

        $conUnit = HotelGuestBadges::with('user','guestbadges.unites.unitbuildings','guestbadges.unites')->where('user_id',$conunitId)->orderBy('id','DESC')->first();
        $hotel_id = $conUnit->guestbadges->unites->hotel_id;

        $get_added_points = TravelTourismSettings::where('id',$hotel_id)->select('add_point')->first();
        if($get_added_points){
            $get_user_points = User::where('id',$conunitId)->first();
            $old_points = $get_user_points->point;
            $new_points = $old_points + $get_added_points->add_point;
            $point_update =User::where('id',$conunitId)->update([
                'point' =>$new_points
            ]);
            if($point_update){
                return response()->json(['success' => true, 'message' => 'Points added successfully.']);
            }else{
                return response()->json(['success' => false, 'message' => 'There is no points to be added.']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'There is no points to be added.']);
        }
    }

    public function addGuestRecognitionPoints(Request $request){
        $userId = $request->query('conunit_id');
        $user_details = User::where('id',$userId)->first();
        // dd($user_details->full_name,$userId,$user_details); 
        $selectedReward = $request->query('select_reward');
        $conUnit = HotelGuestBadges::with('user','guestbadges.unites.unitbuildings','guestbadges.unites')->where('user_id',$userId)->orderBy('id','DESC')->first();
        $hotel_id = $conUnit->guestbadges->unites->hotel_id;
        $badges = HotelUnites::select('id')->where('hotel_id',$hotel_id)->get();
        foreach($badges as $badge){
            $unit_ids[] = $badge->id;
        }
        $get_badge_id = HotelBadges::whereIn('unit_id',$unit_ids)->select('id')->get();
        foreach($get_badge_id as $badge){
            $badge_ids[] = $badge->id;
        }
        // dd($selectedReward);
        $get_guest_points = TravelTourismSettings::where('id',$hotel_id)->select('guest_of_week_point')->first();
        $points = $get_guest_points->guest_of_week_point;
        $guest_recognization = TravelTourism::select('show_guest_recognition')->where('id',$hotel_id)->first();
        if ($guest_recognization->show_guest_recognition == 1) {
            
            if ($selectedReward == 'guest_of_the_week') {
                $week_badge_count = HotelGuestBadges::whereIn('badges_id', $badge_ids)->where('reward_active_on', '>', Carbon::now()->subDays(7)->format('Y-m-d'))->count();

                $guest_success_message = 'Guest of The Week has been awarded to ' . $user_details->full_name . ' along with ' . $points . ' points';
                $guest_error_message = 'Reward unavailable. There is a one reward per member per booking limit.';
                if ($week_badge_count > 0) {
                    // $this->emit('guestRecognitionError');
                    return response()->json(['status' => 0, 'message' => $guest_error_message]);

                } else {
                    $hotelBadgeStatus = HotelGuestBadges::where('user_id',$userId)->first();
                    // dd($hotelBadgeStatus);

                    $travel_tourism = TravelTourism::find($hotel_id);

                    /**Add point in point table */
                    $point = new Point();
                    $point->user_id = $hotelBadgeStatus->user_id;
                    $point->point = $points;
                    $point->came_from = Auth::id();
                    $point->save();

                    /**Add point to user table*/
                    $user = User::find($hotelBadgeStatus->user_id);
                    $totalPoint = $user->point + $points;
                    $user->point =  $totalPoint;
                    $user->save();

                    /**Add point to badge table*/
                    $hotelBadgeStatus->point = $totalPoint;
                    $hotelBadgeStatus->reward_active_on = Carbon::now();
                    $hotelBadgeStatus->save();

                    /**deduct point from travel tourism*/
                    $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $points;
                    $travel_tourism->save();

                    // $this->emit('guestRecognitionSuccess');
                    return response()->json(['status' => 1, 'message' => $guest_success_message]);

                }
            } elseif ($selectedReward == 'family_friend') {
                // dd($points);
                $get_badge = HotelGuestBadges::where('user_id',$userId)->select('badges_id')->first(); 
                // dd($get_badge);
                $same_family_badges = HotelGuestBadges::where('badges_id', $get_badge->badges_id)->where('status',1)
                ->get();

                $already_rewards_count = HotelGuestBadges::where('badges_id', $get_badge->badges_id)->where('status',1)
                    ->where('is_friend_and_family_badge_active',1)
                    ->count();
                // dd( $already_rewards_count);

                if ($already_rewards_count > 0) {
                    $guest_error_message = 'Reward unavailable. There is a two reward per booking limit.';
                    // $this->emit('guestRecognitionError');
                    return response()->json(['status' => 0, 'message' => $guest_error_message]);
                } else {
                    foreach ($same_family_badges as $user) {
                        $hotelBadgeStatus = HotelGuestBadges::find($user->id);
                        $travel_tourism = TravelTourism::find($hotel_id);

                        /**Add point in point table */
                        $point = new Point();
                        $point->user_id = $hotelBadgeStatus->user_id;
                        $point->point = $points;
                        $point->came_from = Auth::id();
                        $point->save();

                        /**Add point to user table*/
                        $user = User::find($hotelBadgeStatus->user_id);
                        $totalPoint = $user->point + $points;
                        $user->point =  $totalPoint;
                        $user->save();

                        /**Add point to badge table*/
                        $hotelBadgeStatus->point = $totalPoint;
                        $hotelBadgeStatus->is_friend_and_family_badge_active = 1;
                        $hotelBadgeStatus->save();

                        /**deduct point from travel tourism*/
                        $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $points;
                        $travel_tourism->save();
                    }
                    $guest_success_message = 'Friends and Family Reward has been awarded to all members in this booking with active badges along with ' . $points . ' points. If a new member is added later during their stay, they will automatically have the reward in the Badges section of their wallet.';
                    // $this->emit('guestRecognitionSuccess');
                    return response()->json(['status' => 1, 'message' => $guest_success_message]);
                }
            }
        } else {
            $guest_error_message = 'Guest recognition is not active';
            // $this->emit('guestRecognitionError');
            return response()->json(['status' => 0, 'message' => $guest_error_message]);
        }
    }

    public function addMember(Request $request){
        // dd('ddfdd');
        $checkIn_date = $request->query('checkinDate');
        $checkOut_date = $request->query('checkoutDate');
        $badge_id = $request->query('badgeId');
        $email_addresses = $request->query('emailAddresses');
        $badge = HotelBadges::find($badge_id);
        // dd($checkIn_date,$checkOut_date,$badge_id,$email_addresses);
        $hotel_id = $badge->unites->hotel_id;
        // dd($hotel_id);
        $keyArr = array();
        $i = 1;
        if (count($email_addresses) > 0) {
            foreach ($email_addresses as $key => $emails) {
                // dd($emails);
                if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                    $user = User::where('email', $emails)->role('CONSUMER')->first();
                    // dd($user);
                    if ($user) {
                        

                        $exist_badge = HotelGuestBadges::where('badges_id',$badge_id)
                                    ->where('guest_email',$emails)
                                    ->first();
                        // $exit_badge_another_badge = HotelGuestBadges::where('guest_email',$emails)
                        //             ->first();
                        if($exist_badge){
                            $guest_error_message = $emails .' is already exist for this badge';
                            return response()->json(['status' => 0, 'message' => $guest_error_message]);
                        }else{
                            $guest_error_message = $emails .' is already exist to another badge';
                            return response()->json(['status' => 0, 'message' => $guest_error_message]);
                        }
                            
                        // if ($exist_badge) {
                        //     $guest_error_message = $emails .' is already exist for this badge';
                        //     return response()->json(['status' => 0, 'message' => $guest_error_message]);
                        //     break; 
                        // } else {
                        //     $guest_badge = new HotelGuestBadges;
                        //     $guest_badge->badges_id = $badge_id;
                        //     $guest_badge->user_id = $user->id;
                        //     $guest_badge->status = 0;
                        //     $guest_badge->guest_email = $emails;
                        //     $guest_badge->save();
                        // }
                    } else {
                        $exist_badge = HotelGuestBadges::where('badges_id',$badge_id)
                            ->where('guest_email',$emails)
                            ->first();
                        if ($exist_badge) {
                            $guest_error_message = $emails .' is already exist for this badge';
                            return response()->json(['status' => 0, 'message' => $guest_error_message]);

                            // $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge']);
                            break;
                        } else {

                            $guest_badge = new HotelGuestBadges;
                            $guest_badge->badges_id = $badge_id;
                            $guest_badge->guest_email = $emails;
                            $guest_badge->status = 0;
                            $guest_badge->save();
                        }
                    }

                    $limit = TravelTourismSettings::where('travel_tourism_id', $hotel_id)->first();
                    if ($limit) {
                        $point = $limit->badge_bonus_point;
                    } else {
                        $point = 0;
                    }
                    $arrival_date = date_format(date_create($checkIn_date), 'm/d/Y');
                    $hotel_name = TravelTourism::select('name')->where('id',$hotel_id)->first();
                    $details = array(
                        'company_name' => $hotel_name->name,
                        'point' => $point,
                        'arrival_date' => $arrival_date,
                        'request_id' => $guest_badge->id
                    );
                    //dd($details);
                    Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                    $i++;
                }
                array_push($keyArr, $key);
            }

            $guests = HotelGuestBadges::where('badges_id',$badge_id)
                ->where('guest_email','!=', null)
                ->get();
            $guest_count = count($guests);


            
            $listing_guests = 10;
            $remaining_count = ($listing_guests - $guest_count);
            $keyArr = [];
            if ($i > 1) {
                $email_addresses = [];
                // $this->emit('NewbadgeSent', ['listing' => $this->listing, 'membercount' => $i, 'guest_badge_count' => $this->guest_count, 'text' => 'Invite Sent Successfully', 'key_arr' => $this->keyArr]);
                $guest_success_message = 'Invite Sent Successfully';
                return response()->json(['status' => 1, 'message' => $guest_success_message, 'membercount' => $i, 'guest_badge_count' => $guest_count, 'key_arr' => $keyArr]);
            }
        } else {
            $guest_error_message = 'Give valid email address';
            return response()->json(['status' => 0, 'message' => $guest_error_message]);
        }

    }

    public function shortTermReportCreate(){
        return view('frontend.travel-tourism.short-term-rental.create-report');
    }
}

                                                