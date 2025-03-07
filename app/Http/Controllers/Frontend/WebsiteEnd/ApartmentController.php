<?php

namespace App\Http\Controllers\Frontend\WebsiteEnd;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\BuildingUnit;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\User;
use App\Models\Point;
use App\Models\ConsumerBadge;
use App\Models\ProviderLimitSetting;
use App\Models\Badge;
use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\ShortTermGuestBadge;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsumerRegistrationMail;




use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    public function index()
    {
        $providers = Provider::with('states')->where('status',1)->get();
        return view('frontend.homerent.list', compact('providers'));
    }
   

    public function apartmentView($provider_id,$unit_id){
        $provider_id = base64_decode($provider_id);
        $unit_id = base64_decode($unit_id);
        
        $today = date('Y-m-d');
        $remaining_guest = 50;
        $listing = Provider::find($provider_id);
        $badges = Apartmentbadge::where('unit_id', $unit_id)
                                        ->where('end_date', '>', $today)
                                        ->where('start_date','<=',$today)
                                        ->get();
                                       
       
        foreach ($badges as $badgedata) {
            $guests = ApartmentGuestBadge::where('badges_id', $badgedata->id)
                            ->count();
                            // dd($guests);
            if($guests == 10){
                $remaining_guest = 0;     
            }elseif($guests < 10){
                $remaining_guest = 10 - $guests;
            }
        }
        
        $encode_provider_id = base64_encode($provider_id);
        $encode_unit_id = base64_encode($unit_id);
        // dd($remaining_guest);

        if($remaining_guest == 50){
            return redirect()->route('frontend.apartment.view', [
                'id' =>$encode_provider_id
            ])->withError('New badges are not available. Log in to find deals in the area!');   
        }else {
            session()->put('apartmentUnitId', $encode_unit_id);
            session()->put('uid', $encode_unit_id);

            return redirect()->route('frontend.apartment.view',[
                'id' =>$encode_provider_id
            ]);
        }
    }

    public function viewApartment($id)
    {
        // dd($id);
        $unitid = session()->get('apartmentUnitId');
        $providerid = $id;
        return view('frontend.property-manager.apartment_website', compact('providerid','unitid'));
        // return view('frontend.homerent.view');
    }

    // public function apartmentWebsite($provider_id,$unit_id){
    //     // dd($provider_id,$unit_id,'fdvdfvdfv');
    //     $providerid = base64_decode($provider_id);
    //     $unitid = base64_decode($unit_id);
    //     return view('frontend.property-manager.apartment_website', compact('providerid','unitid'));
    // }


    public function guestEmailCheck(Request $request){
        if ($request->ajax()) {

            $get_role_name = User::where('email', $request->email)->first();
            if($get_role_name){
                if($get_role_name->role_name){
                    $role_name = $get_role_name->role_name;
                    if($role_name != "CONSUMER"){
                        return response()->json(['success' => false, 'text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);
                    }
                }
            }
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                // dd($request->email);
                $user = User::where('email', $request->email)->role('CONSUMER')->first();
               if($user){
                $today = date('Y-m-d');
                    $check_from_apart_guest = ApartmentGuestBadge::where('user_id', $user->id)->where('status',1)->first();
                    if($check_from_apart_guest){
                        $gate_date = Apartmentbadge::where('id',$check_from_apart_guest->badges_id)->where('status',1)->where('end_date','>',$today)->first();
                        if($gate_date){
                            return response()->json(['success' => false, 'text' => 'This user already under a badge.']);
                        }
                    }

                    $find_from_short = ShortTermGuestBadge::where('guest_email',$user->email)->where('badge_status',1)->where('checkout_date','>',$today)->first();
                    
                    if($find_from_short){
                        return response()->json(['success' => false, 'text' => 'This user already accepted another badge.']);
                    }

                    $find_from_hotel = HotelGuestBadges::where('guest_email',$user->email)->where('status',1)->get();
                    if($find_from_hotel){
                        foreach($find_from_hotel as $hotel){
                            $get_date = HotelBadges::where('id',$hotel->badges_id)->where('end_date','>',$today)->where('status',1)->first();
                            if($get_date){
                                return response()->json(['success' => false, 'text' => 'This user already accepted another badges.']); 
                                break;
                            }
                        }
                    }
                    
                    return response()->json(['success' => false, 'text' => 'This user already accepted another badges.']); 
                    // dd($check_from_guest);
                    // session()->forget('apartmentUnitId');
                    
               }else{
                // dd('fddsfdd');
                    return response()->json(['success' => true, 'text' => 'user_available']);
               } 
            } else {
                return response()->json(['success' => false, 'text' => 'Email address should be valid']);
            }
        }
    }

    public function guestAddScheduledBadge(Request $request){
        if ($request->ajax()) {
            // dd($request->all());
            $validator  =   Validator::make($request->all(), [
                "booking_phone"  =>  "unique:users,phone|numeric|digits_between:8,15",
                "email" =>  "unique:users,email",
                "booking_first_name" => "required",
                "booking_last_name" => "required",
                "zip_code"=> "required"
            ]);

            if ($validator->fails()) {
                return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
            }

            $get_points = ProviderLimitSetting::where('property_id',$request->provider_id)->first();
            $get_gimmzi_points = Badge::where('title','=','Gimmzi Access ')->first();
            $gimmzi_points = $get_gimmzi_points->badge_point;
            $registration_points = $get_points->sign_up_bonus_point + $get_points->current_allowance_point_limit;
            // dd($registration_points,$gimmzi_points);
            $insert_user = User::create([
                "first_name"=>$request->booking_first_name,
                "last_name"=>$request->booking_last_name,
                "email"=>$request->email,
                "phone"=>$request->booking_phone,
                "zip_code"=>$request->zip_code,
                "point" => $gimmzi_points + $registration_points
            ]);

            $insert_user->assignRole('CONSUMER');

            session()->put('user_id', $insert_user->id);
            Point::create([
                'user_id' => $insert_user->id,
                'point' => $gimmzi_points,
                'badge_id' => $request->badge_id,
                'sign' => '+'
            ]);
            Point::create([
                'user_id' => $insert_user->id,
                'point' => $registration_points,
                'badge_id' => $request->badge_id,
                'sign' => '+'
            ]);
            ConsumerBadge::create([
                'user_id' => $insert_user->id,
                'badges_id' => $request->badge_id,
                'point' => $gimmzi_points + $registration_points,
                'badge_activate_date' => date('Y-m-d')
            ]);
            ApartmentGuestBadge::insert([
                "user_id"=>$insert_user->id,
                "badges_id"=>$request->badge_id,
                "status"=>1,
                "point"=>$gimmzi_points + $registration_points,
                "guest_email"=>$request->email,
                "guest_first_name"=>$request->booking_first_name,
                "guest_last_name"=>$request->booking_last_name,
                "zip_code"=>$request->zip_code,
            ]);
            session()->remove('apartmentUnitId');
            return response()->json(['status' => true]);

        }

    }

    public function ProviderGuestPasswordSubmit(Request $request){
        $user_id = session()->get('user_id');
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

            $user = User::find($user_id);
            $user->password = $request->consumer_password;
            $user->active = 1;
            $rand = rand(1000,9999);
            $consumerid = $rand.substr($user->first_name, 0, 3);
            // $consumerid = strtoupper(substr($user->first_name, 0, 3)) . '0' . $user->id;
            $user->userId = $consumerid;
            $user->save();
            $details = [
                'email'  =>  $user->email,
                'password' => $request->consumer_password,
                'name' => $user->first_name,
                'username' => $consumerid
            ];
            // dd($details);
            Mail::to($user->email)->queue(new ConsumerRegistrationMail($details));
            session()->remove('user_id');
            session()->remove('apartmentUnitId');
            session()->remove('apartmentbadge');
            $user = User::where('id',$user_id)->first();
            $message1 = 'Thanks for signing up ' . $user->first_name . ' ' . $user->last_name . ' and Welcome to Smart Rewards!';
            $message2 = 'Here’s ' . $user->point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
            return response()->json(['status' => 0,'message1' => $message1, 'message2' => $message2]);
        }
    }





    //         if ($request->badge_id != '') {
    //             if ($request->guest_id != '') {
    //                 $badge = ShortTermGuestBadge::find($request->badge_id);
    //                 if ($badge) {
    //                     if ($badge->guest_email == '') {
    //                         $badge->guest_email = $request->email;
    //                         $badge->guest_id = $request->guest_id;
    //                         $badge->badge_status = 1;
    //                         $badge->save();
    //                         $badgeid = $badge->id;
    //                     } else {
    //                         $new_badge = new ShortTermGuestBadge;
    //                         $new_badge->short_term_id = $badge->short_term_id;
    //                         $new_badge->listing_id = $badge->listing_id;
    //                         $new_badge->guest_id = $request->guest_id;
    //                         $new_badge->checkin_date = $badge->checkin_date;
    //                         $new_badge->checkout_date = $badge->checkout_date;
    //                         $new_badge->badge_status = 1;
    //                         $new_badge->guest_email = $request->email;
    //                         $new_badge->save();
    //                         $badgeid = $new_badge->id;
    //                     }
    //                     $user = User::find($request->guest_id);
    //                     $setting = TravelTourismSettings::where('travel_tourism_id', $badge->short_term_id)->first();
    //                     if ($setting) {
    //                         if ($setting->badge_bonus_point != null) {
    //                             $date1 = date_create($badge->checkin_date);
    //                             $date2 = date_create($badge->checkout_date);
    //                             $diff = date_diff($date1, $date2);
    //                             $days = $diff->format("%a");
    //                             $badge_point = ((int)$days * $setting->badge_bonus_point);
    //                             $total_point = $user->point + $badge_point;
    //                             $user->point = $total_point;
    //                             $user->save();
    //                             $guest_badge = ShortTermGuestBadge::find($badgeid);
    //                             $guest_badge->points = $badge_point;
    //                             $guest_badge->save();
    //                             $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
    //                             Point::create([
    //                                 'user_id' => $user->id,
    //                                 'point' => $badge_point,
    //                                 'badge_id' => $badgeData->id,
    //                                 'sign' => '+'
    //                             ]);
    //                             ConsumerBadge::create([
    //                                 'user_id' => $user->id,
    //                                 'badges_id' => $badgeData->id,
    //                                 'point' => $badge_point,
    //                                 'badge_activate_date' => date('Y-m-d')
    //                             ]);
    //                         }
    //                     }
    //                 }
    //                 session()->remove('listingid');
    //                 session()->remove('listing_name');
    //                 return response()->json(['status' => true]);
    //             } else {
    //                 $validator  =   Validator::make($request->all(), [
    //                     "booking_phone"  =>  "unique:users,phone|numeric|digits_between:8,15",
    //                     "email" =>  "unique:users,email"
    //                 ]);
    //                 if ($validator->fails()) {
    //                     return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
    //                 }
    //                 if (($request->consumer_birth_year != '') && ($request->consumer_birth_day != '') && ($request->consumer_birth_month != '')) {
    //                     $dob = $request->consumer_birth_year . '-' . $request->consumer_birth_month . '-' . $request->consumer_birth_day;
    //                 } else {
    //                     $dob = '';
    //                 }
    //                 $data = array(
    //                     'first_name' => $request->booking_first_name,
    //                     'last_name' =>  $request->booking_last_name,
    //                     'email' =>  $request->email,
    //                     'phone' =>  $request->booking_phone,
    //                     'zip_code' =>  $request->zip_code,
    //                     'date_of_birth' =>  $dob,
    //                     'do_you_live_apartment' =>  false,
    //                 );
    //                 session()->put('userdata', $data);
    //                 session()->put('badgeid', $request->badge_id);
    //                 return response()->json(['status' => true]);
                  
    //             }
    //         }
    //     }
    // // }

    
    public function getProvider(Request $request){
        if($request->ajax()){
            $provider = $request->search_provider;
            $providers = Provider::with('states')->where('name', 'like', '%' . $provider . '%')
                    ->orWhere('address','like', '%' . $provider . '%')
                    ->orWhere('city','like', '%' . $provider . '%')->where('status',1)->get();
            if(count($providers) > 0){
                return response()->json(["status" => 1, "data" => $providers]);
            }
            else{
                return response()->json(["status" => 0]);
            }
        }
    }
}
