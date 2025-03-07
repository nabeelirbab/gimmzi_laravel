<?php

namespace App\Http\Controllers\Frontend\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Badge;
use App\Models\ConsumerBadge;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConsumerRegistrationMail;
use App\Mail\NewConfirmConsumerMail;
use App\Models\BuildingUnit;
use App\Models\Point;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use App\Models\SendRegistrationLink;
use App\Models\ConsumerUnit;
use Illuminate\Support\Str;
use App\Mail\ForgetPasswordMail;
use App\Mail\ResetPasswordMail;
use App\Models\PropertyUnderProviderUser;
use App\Models\ProspectiveAppartmentList;
use Illuminate\Support\Facades\Validator;
use App\Models\ProspectiveApartmentUser;
use App\Models\ShortTermGuestBadge;
use App\Models\TravelTourismSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderLimitSetting;
use App\Models\MyFamilyFriend;

use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\TravelTourism;


class RegistrationController extends Controller
{

    public function consumerRegistration()
    {
        return redirect()->route('frontend.index')->with('link', 'registrationlink');
    }

    public function consumerSignupStep1(Request $request)
    {
        if ($request->ajax()) {


            if (($request->phone != "") && ($request->email != "")) {
                $validator  =   Validator::make($request->all(), [
                    "phone"  =>  "unique:users,phone|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/",
                    "email" =>  "unique:users,email"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                }
                if ($request->lives_an_apartment == 'yes') {

                    if ($request->get_link == 1 && $request->get_link_2 == 0) {
                        if ($request->unit_one_name != '') {
                            $checkemail = SendRegistrationLink::with('provideruser')->where('link_send_on', $request->email)->first();
                            $checkunit = BuildingUnit::where('id', $checkemail->unit_id)->where('unit', $request->unit_one_name)->where('status', 1)->first();
                            if ($checkunit) {
                                $checkusermail = User::where('email', $request->email)->first();
                                if (!$checkusermail) {
                                    if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                                        $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                                    } else {
                                        $dob = '';
                                    }
                                    $password = rand(1000, 9999);

                                    $data = array(
                                        'first_name' => $request->first_name,
                                        'last_name' =>  $request->last_name,
                                        'email' =>  $request->email,
                                        'password' => $password,
                                        'phone' =>  $request->phone,
                                        'zip_code' =>  $request->zip_code,
                                        'city' =>  $request->city,
                                        'state_id' =>  $request->state,
                                        'date_of_birth' =>  $dob,
                                        'active' => 1,
                                        'do_you_live_apartment' =>  true
                                    );
                                    $user = User::create($data);
                                    $user->assignRole('CONSUMER');
                                    $rand = rand(1000,9999);
                                    $consumerid = $rand.substr($request->first_name, 0, 3);
                                    //$consumerid = strtoupper(substr($request->first_name, 0, 3)) . '/CON/0' . $user->id;
                                    $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                                    $point = $badgeData->badge_point;
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
                                    $provider = Provider::where('id', $checkemail->provider_id)->first();
                                    if ($provider) {
                                        $consumer_unit = ConsumerUnit::create([
                                            'provider_type_id' => $checkunit->provider_id,
                                            'provider_building_id' => $checkunit->building_id,
                                            'consumer_id' => $user->id,
                                            'unit_id' => $checkunit->id,
                                            'provider_user_id' => $provider->id
                                        ]);
                                    }
                                    $user->point = $point;
                                    $user->userId = $consumerid;
                                    $user->save();
                                    $details = [
                                        'email'  =>  $request->email,
                                        'password' => $password,
                                        'name' => $request->first_name . ' ' . $request->last_name,
                                        'username' => $consumerid,
                                    ];
                                    Mail::to($request->email)->queue(new ConsumerRegistrationMail($details));
                                    if (!Mail::failures()) {

                                        $message1 = 'Thanks for signing up ' . ucfirst($request->first_name) . ' ' . ucfirst($request->last_name) . ' and Welcome to Smart Rewards!';
                                        $message2 = 'Here’s ' . $point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                                        return response()->json(['success' => true, 'message' => 'Consumer saved successfully', 'status' => 0, 'message1' => $message1, 'message2' => $message2]);
                                    } else {
                                        return response()->json(['success' => false, 'message' => 'Something Went Wrong']);
                                    }
                                } else {
                                    return response()->json(['success' => false,  'status' => 1, 'message' => 'Email has already been used']);
                                }
                            } // else if ($checkunit->unit != $request->unit_one_name) {
                            //     return response()->json(['success' => false, 'message' => 'Unit Number Not Found', 'status' => 2]);
                            // } 
                            else {
                                return response()->json(['success' => false, 'message' => 'Not Found', 'data' => $checkemail->provideruser->full_name, 'status' => 2]);
                            }
                        } else {
                            return response()->json(['success' => false, 'message' => 'enter unit number']);
                        }
                    } else if ($request->get_link == 0 && $request->get_link_2 == 1) {

                        $checkphone = SendRegistrationLink::where('link_send_on', $request->phone)->first();
                        $checkunit = BuildingUnit::where('id', $checkphone->unit_id)->where('unit', $request->unit_two_name)->where('status', 1)->first();
                        if ($checkunit) {
                            $checkuserphone = User::where('phone', $request->phone)->first();
                            if (!$checkuserphone) {
                                if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                                    $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                                } else {
                                    $dob = '';
                                }
                                $password = rand(1000, 9999);
                                $data = array(
                                    'first_name' => $request->first_name,
                                    'last_name' =>  $request->last_name,
                                    'email' =>  $request->email,
                                    'password' => $password,
                                    'phone' =>  $request->phone,
                                    'zip_code' =>  $request->zip_code,
                                    'city' =>  $request->city,
                                    'state_id' =>  $request->state,
                                    'date_of_birth' =>  $dob,
                                    'active' => 1,
                                    'do_you_live_apartment' =>  true
                                );
                                $user = User::create($data);
                                $user->assignRole('CONSUMER');
                                $rand = rand(1000,9999);
                                $consumerid = $rand.substr($request->first_name, 0, 3);
                                // $consumerid = strtoupper(substr($request->first_name, 0, 3)) . '/CON/0' . $user->id;
                                $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                                $point = $badgeData->badge_point;
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
                                $provider = Provider::where('id', $checkphone->provider_id)->first();
                                if ($provider) {
                                    $consumer_unit = ConsumerUnit::create([
                                        'provider_type_id' => $checkunit->provider_id,
                                        'provider_building_id' => $checkunit->building_id,
                                        'consumer_id' => $user->id,
                                        'unit_id' => $checkunit->id,
                                        'provider_user_id' => $provider->id
                                    ]);
                                }
                                $user->point = $point;
                                $user->userId = $consumerid;
                                $user->save();
                                $details = [
                                    'email'  =>  $request->email,
                                    'password' => $password,
                                    'name' => $request->first_name . ' ' . $request->last_name,
                                    'status' => 1,
                                    'username' => $consumerid,
                                ];
                                Mail::to($request->email)->queue(new ConsumerRegistrationMail($details));
                                if (!Mail::failures()) {
                                    $message1 = 'Thanks for signing up ' . $request->first_name . ' ' . $request->last_name . ' and Welcome to Smart Rewards!';
                                    $message2 = 'Here’s ' . $point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                                    return response()->json(['success' => true, 'status' => 0, 'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
                                } else {
                                    return response()->json(['success' => false, 'message' => 'Something Went Wrong']);
                                }
                            } else {
                                return response()->json(['success' => false, 'message' => 'Phone has already been used']);
                            }
                        } else if ($checkunit != $request->unit_two_name) {
                            return response()->json(['success' => false, 'message' => 'Unit Number Not Found', 'status' => 2]);
                        } else {
                            return response()->json(['success' => false, 'message' => 'Not Found']);
                        }
                    } else {
                        if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                            $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                        } else {
                            $dob = '';
                        }
                        $password = rand(1000, 9999);
                        $checkusermail = User::where('email', $request->email)->first();
                        if ($checkusermail) {
                            return response()->json(['success' => false, 'message' => 'Email has already been used']);
                        } else {

                            $checkuserphone = User::where('phone', $request->phone)->first();
                            if ($checkuserphone) {
                                return response()->json(['success' => false, 'message' => 'Phone number has already been used']);
                            } else {
                                $data = array(
                                    'first_name' => $request->first_name,
                                    'last_name' =>  $request->last_name,
                                    'email' =>  $request->email,
                                    'password' => $password,
                                    'phone' =>  $request->phone,
                                    'zip_code' =>  $request->zip_code,
                                    'city' =>  $request->city,
                                    'state_id' =>  $request->state,
                                    'date_of_birth' =>  $dob,
                                    'active' => 1,
                                    'do_you_live_apartment' =>  true
                                );
                                $user = User::create($data);
                                $user->assignRole('CONSUMER');
                                $rand = rand(1000,9999);
                                $consumerid = $rand.substr($request->first_name, 0, 3);
                                // $consumerid = strtoupper(substr($request->first_name, 0, 3)) . '/CON/0' . $user->id;
                                $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                                $point = $badgeData->badge_point;
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

                                if ($user) {
                                    $message1 = 'Thanks for signing up ' . $request->first_name . ' ' . $request->last_name . ' and Welcome to Smart Rewards!';
                                    $message2 = 'Here’s ' . $point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                                    if ($request->provider_id == 'add_new') {
                                        return response()->json(['success' => true, 'status' => 10, 'city' => $request->city, 'zipcode' => $request->zip_code, 'state_id' =>  $request->state, 'consumer' => $user->id, 'message' => 'consumer saved successfully']);
                                    } else {
                                        return response()->json(['success' => true, 'status' => 3, 'consumer' => $user->id, 'password' => $password, 'provider_id' => $request->provider_id, 'message' => 'consumer saved successfully']);
                                    }
                                    //return response()->json(['success' => true, 'status'=> 3,'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
                                } else {
                                    return response()->json(['success' => false, 'message' => 'Something went wrong']);
                                }
                            }
                        }
                    }
                } else if ($request->lives_an_apartment == 'no') {
                    if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                        $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                    } else {
                        $dob = '';
                    }
                    $password = rand(10000000, 99999999);
                    $checkusermail = User::where('email', $request->email)->first();
                    if ($checkusermail) {
                        return response()->json(['success' => false, 'message' => 'Email has already been used']);
                    } else {
                        $checkuserphone = User::where('phone', $request->phone)->first();
                        if ($checkuserphone) {
                            return response()->json(['success' => false, 'message' => 'Phone number has already been used']);
                        } else {
                            $data = array(
                                'first_name' => $request->first_name,
                                'last_name' =>  $request->last_name,
                                'email' =>  $request->email,
                                'password' => $password,
                                'phone' =>  $request->phone,
                                'zip_code' =>  $request->zip_code,
                                'city' =>  $request->city,
                                'state_id' =>  $request->state,
                                'date_of_birth' =>  $dob,
                                'active' => 1,
                                'do_you_live_apartment' =>  false
                            );
                            $user = User::create($data);
                            $user->assignRole('CONSUMER');
                            $rand = rand(1000,9999);
                            $consumerid = $rand.substr($request->first_name, 0, 3);
                            // $consumerid = strtoupper(substr($request->first_name, 0, 3)) . '/CON/0' . $user->id;
                            $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                            $point = $badgeData->badge_point;
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
                            $today = date('Y-m-d');
                            $travel_badges = ShortTermGuestBadge::where('guest_email', $request->email)->where('checkin_date', '>=', $today)->where('badge_status', 0)->get();
                            // return response()->json(['success' => $travel_badges]);
                            if (count($travel_badges) > 0) {
                                foreach ($travel_badges as $travel) {
                                    $short_term = ShortTermGuestBadge::find($travel->id);
                                    $short_term->guest_id = $user->id;
                                    $short_term->badge_status = 1;
                                    $short_term->save();
                                    if ($short_term->checkin_date >= $today) {
                                        $setting = TravelTourismSettings::where('travel_tourism_id', $travel->short_term_id)->first();
                                        if ($setting) {
                                            if ($setting->badge_bonus_point != null) {
                                                $date1 = date_create($short_term->checkin_date);
                                                $date2 = date_create($short_term->checkout_date);
                                                $diff = date_diff($date1, $date2);
                                                $days = $diff->format("%a");
                                                $badge_point = ((int)$days * $setting->badge_bonus_point);
                                                $total_point = $user->point + $badge_point;
                                                $user->point = $total_point;
                                                $user->save();
                                                $short_term->points = $badge_point;
                                                $short_term->save();
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
                                            }
                                        }
                                    }
                                }
                            }

                            $details = [
                                'email'  =>  $request->email,
                                'password' => $password,
                                'name' => $request->first_name . ' ' . $request->last_name,
                                'username' => $consumerid,
                            ];
                            Mail::to($request->email)->queue(new ConsumerRegistrationMail($details));
                            if (!Mail::failures()) {
                                $message1 = 'Thanks for signing up ' . $request->first_name . ' ' . $request->last_name . ' and Welcome to Smart Rewards!';
                                $message2 = 'Here’s ' . $point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                                return response()->json(['success' => true, 'status' => 0, 'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
                            } else {
                                return response()->json(['success' => false, 'message' => 'Something went wrong']);
                            }
                        }
                    }
                    //return response()->json(['success' => $password]);
                }
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }

    public function newRegistration(Request $request)
    {
        // dd('sdcsdcdsc');
        if ($request->ajax()) {
            if (($request->phone != '') && ($request->email != '')) {

                $validator  =   Validator::make($request->all(), [
                    // "phone"  =>  "unique:users,phone",
                    'phone' => 'required|digits_between:8,15|numeric|unique:users,phone',
                    // "phone"  =>  "required|numeric|unique:users,phone|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/",
                    // "email" =>  "unique:users,email",
                    'consumer_zipcode' => 'required|numeric|regex:/^(?:(\d{5})(?:[ \-](\d{4}))?)$/i',

                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                } else {

                    if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                        $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                    } else {
                        $dob = '';
                    }
                    $password = rand(10000000, 99999999);
                    $checkusermail = User::where('email', $request->email)->first();
                    if ($checkusermail) {
                        return response()->json(['success' => false, 'status' => 3, 'message' => 'Email has already been used']);
                    } else {
                        $checkuserphone = User::where('phone', $request->phone)->first();
                        if ($checkuserphone) {
                            return response()->json(['success' => false, 'status' => 4, 'message' => 'Phone number has already been used']);
                        } else {

                            $data = array(
                                'first_name' => $request->first_name,
                                'last_name' =>  $request->last_name,
                                'email' =>  $request->email,
                                'phone' =>  $request->phone,
                                'date_of_birth' =>  $dob,
                                'active' => 1,
                                'zip_code' => $request->consumer_zipcode,
                                'req_badge_id' =>$request->req_badge_id
                            );
                            Session::put("data", $data);
                            return response()->json(['success' => true, 'status' => 2, 'message' => 'Give the password']);
                            // $user = User::create($data);
                            // $user->assignRole('CONSUMER');
                            // $consumerid = strtoupper(substr($request->first_name, 0, 3)) . '/CON/0' . $user->id;
                            // $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                            // $signup_point = $point = $badgeData->badge_point;
                            // Point::create([
                            //     'user_id' => $user->id,
                            //     'point' => $point,
                            //     'badge_id' => $badgeData->id,
                            //     'sign' => '+'
                            // ]);
                            // $consumer_badge = ConsumerBadge::create([
                            //     'user_id' => $user->id,
                            //     'badges_id' => $badgeData->id,
                            //     'point' => $point,
                            //     'badge_activate_date' => date('Y-m-d')
                            // ]);
                            // $user->point = $point;
                            // $user->userId = $consumerid;
                            // $user->save();
                            // $today = date('Y-m-d');
                            // $travel_badges = ShortTermGuestBadge::where('guest_email', $request->email)->where('checkin_date', '>=', $today)->where('badge_status', 0)->get();
                            // if (count($travel_badges) > 0) {
                            //     foreach ($travel_badges as $travel) {
                            //         $short_term = ShortTermGuestBadge::find($travel->id);
                            //         $short_term->guest_id = $user->id;
                            //         $short_term->badge_status = 1;
                            //         $short_term->save();
                            //         if ($short_term->checkin_date >= $today) {
                            //             $setting = TravelTourismSettings::where('travel_tourism_id', $travel->short_term_id)->first();
                            //             if ($setting) {
                            //                 if ($setting->badge_bonus_point != null) {
                            //                     $date1 = date_create($short_term->checkin_date);
                            //                     $date2 = date_create($short_term->checkout_date);
                            //                     $diff = date_diff($date1, $date2);
                            //                     $days = $diff->format("%a");
                            //                     $signup_point =  $setting->badge_bonus_point;
                            //                     $badge_point = ((int)$days * $setting->badge_bonus_point);
                            //                     $total_point = $user->point + $badge_point;
                            //                     $user->point = $total_point;
                            //                     $user->save();
                            //                     $short_term->points = $badge_point;
                            //                     $short_term->save();
                            //                     $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                            //                     Point::create([
                            //                         'user_id' => $user->id,
                            //                         'point' => $badge_point,
                            //                         'badge_id' => $badgeData->id,
                            //                         'sign' => '+'
                            //                     ]);
                            //                     ConsumerBadge::create([
                            //                         'user_id' => $user->id,
                            //                         'badges_id' => $badgeData->id,
                            //                         'point' => $badge_point,
                            //                         'badge_activate_date' => date('Y-m-d')
                            //                     ]);
                            //                 }
                            //             }
                            //         }
                            //     }
                            // }

                            // Log::debug($user);
                            // $apartment_badges = ApartmentGuestBadge::where('guest_email',$request->email)->where('status', 0)->get();
                            // Log::debug($apartment_badges);
                            // if(count($apartment_badges) > 0){
                            //     foreach($apartment_badges as $badge_data){
                            //         $badge = Apartmentbadge::find($badge_data->badges_id);
                            //         if($badge){
                            //             Log::debug($badge);
                            //             if($badge->start_date >= $today){
                            //                 $badge_data->user_id = $user->id;
                            //                 $badge_data->status = 1;
                            //                 $badge_data->save();
                            //                 $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                            //                 if($limit_setting){
                            //                     //Log::debug('limit_setting',$limit_setting);
                            //                     if($limit_setting->sign_up_bonus_point != null){
                            //                         if($limit_setting->current_allowance_point_limit !=null)
                            //                         {

                            //                         // $point = $limit_setting->sign_up_bonus_point + $limit_setting->current_allowance_point_limit;
                            //                         // $date1 = date_create($badge->start_date);
                            //                         // $date2 = date_create($badge->end_date);
                            //                         // $diff = date_diff($date1, $date2);
                            //                         // $days = $diff->format("%a");
                            //                         $signup_point = $limit_setting->sign_up_bonus_point;  
                            //                         $current_allowance_point = $limit_setting->current_allowance_point_limit;
                            //                         // $badge_point = $limit_setting->sign_up_bonus_point;
                            //                         $total_point = $user->point + $signup_point +  $current_allowance_point;
                            //                         $user->point = $total_point;
                            //                         $user->save();
                            //                         $badge_data->point = $user->point;
                            //                         $badge_data->save();
                            //                         $badgeData = Badge::where('status', 1)->where('title', 'Resident')->first();
                            //                         Log::debug($total_point);
                            //                         Point::create([
                            //                             'user_id' => $user->id,
                            //                             'point' => $signup_point,
                            //                             'badge_id' => $badgeData->id,
                            //                             'sign' => '+'
                            //                         ]);
                            //                         Point::create([
                            //                             'user_id' => $user->id,
                            //                             'point' => $current_allowance_point,
                            //                             'badge_id' => $badgeData->id,
                            //                             'sign' => '+'
                            //                         ]);

                            //                         ConsumerBadge::create([
                            //                             'user_id' => $user->id,
                            //                             'badges_id' => $badgeData->id,
                            //                             'point' => $signup_point,
                            //                             'badge_activate_date' => date('Y-m-d')
                            //                         ]);
                            //                         ConsumerBadge::create([
                            //                             'user_id' => $user->id,
                            //                             'badges_id' => $badgeData->id,
                            //                             'point' => $current_allowance_point,
                            //                             'badge_activate_date' => date('Y-m-d')
                            //                         ]);
                            //                     } 
                            //                 } 
                            //                 }
                            //             }
                            //         }
                            //     }
                            // }

                            // $details = [
                            //     'email'  =>  $request->email,
                            //     'password' => $password,
                            //     'name' => $request->first_name . ' ' . $request->last_name,
                            // ];
                            // Mail::to($request->email)->send(new ConsumerRegistrationMail($details));
                            // if (!Mail::failures()) {
                            //     $message1 = 'Thanks for signing up ' . $request->first_name . ' ' . $request->last_name . ' and Welcome to Smart Rewards!';
                            //     $message2 = 'Here’s ' . $signup_point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                            //     return response()->json(['success' => true, 'status' => 0, 'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
                            // } else {
                            //     return response()->json(['success' => false, 'message' => 'Something went wrong']);
                            // }

                        }
                    }
                }
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }

    public function newRegistrationConsumer(Request $request)
    {
        if ($request->ajax()) {
            if (($request->phone != '') && ($request->email != '')) {

                $validator  =   Validator::make($request->all(), [
                    "phone"  =>  "unique:users,phone",
                    "email" =>  "max:255",
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                }


                if (($request->birth_year != '') && ($request->birth_day != '') && ($request->birth_month != '')) {
                    $dob = $request->birth_year . '-' . $request->birth_month . '-' . $request->birth_day;
                } else {
                    $dob = '';
                }
                $password = Session::get('consumer_create_password');
                $checkusermail = User::where('email', $request->email)->first();
                if ($checkusermail) {
                    return response()->json(['success' => false, 'message' => 'Email has already been used']);
                } else {
                    $checkuserphone = User::where('phone', $request->phone)->first();
                    if ($checkuserphone) {
                        return response()->json(['success' => false, 'message' => 'Phone number has already been used']);
                    } else {
                        $data = array(
                            'first_name' => $request->first_name,
                            'last_name' =>  $request->last_name,
                            'email' =>  $request->email,
                            'password' => $password,
                            'phone' =>  $request->phone,
                            'date_of_birth' =>  $dob,
                            'active' => 1
                        );
                        $user = User::create($data);
                        $user->assignRole('CONSUMER');
                        $rand = rand(1000,9999);
                        $consumerid = $rand.substr($request->first_name, 0, 3);
                        // $consumerid = strtoupper(substr($request->first_name, 0, 3)) .  $user->id;
                        $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                        $point = $badgeData->badge_point;
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

                        // if()


                        $today = date('Y-m-d');
                        $travel_badges = ShortTermGuestBadge::where('guest_email', $request->email)->where('checkin_date', '>=', $today)->where('badge_status', 0)->get();
                        if (count($travel_badges) > 0) {
                            foreach ($travel_badges as $travel) {
                                $short_term = ShortTermGuestBadge::find($travel->id);
                                $short_term->guest_id = $user->id;
                                $short_term->badge_status = 1;
                                $short_term->save();
                                if ($short_term->checkin_date >= $today) {
                                    $setting = TravelTourismSettings::where('travel_tourism_id', $travel->short_term_id)->first();
                                    if ($setting) {
                                        if ($setting->badge_bonus_point != null) {
                                            $date1 = date_create($short_term->checkin_date);
                                            $date2 = date_create($short_term->checkout_date);
                                            $diff = date_diff($date1, $date2);
                                            $days = $diff->format("%a");
                                            $badge_point = ((int)$days * $setting->badge_bonus_point);
                                            $total_point = $user->point + $badge_point;
                                            $user->point = $total_point;
                                            $user->save();
                                            $short_term->points = $badge_point;
                                            $short_term->save();
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
                                        }
                                    }
                                }
                            }
                        }
                        Log::debug('user', $user);
                        $apartment_badges = ApartmentGuestBadge::where('guest_email', $request->email)->where('status', 0)->get();
                        Log::debug('apartment_badges', $apartment_badges);
                        if (count($apartment_badges) > 0) {
                            foreach ($apartment_badges as $badge_data) {
                                $badge = Apartmentbadge::find($badge_data->badges_id);
                                if ($badge) {
                                    Log::debug('badge', $badge);
                                    if ($badge->start_date >= $today) {
                                        $badge_data->user_id = $user->id;
                                        $badge_data->status = 1;
                                        $badge_data->save();
                                        $limit_setting = ProviderLimitSetting::where('property_id', $badge->building->provider_type_id)->first();
                                        if ($limit_setting) {
                                            Log::debug('limit_setting', $limit_setting);
                                            if ($limit_setting->sign_up_bonus_point != null) {
                                                $point = $limit_setting->sign_up_bonus_point;
                                                $date1 = date_create($badge->start_date);
                                                $date2 = date_create($badge->end_date);
                                                $diff = date_diff($date1, $date2);
                                                $days = $diff->format("%a");
                                                $badge_point = ((int)$days * $limit_setting->sign_up_bonus_point);
                                                $total_point = $user->point + $badge_point;
                                                $user->point = $total_point;
                                                $user->save();
                                                $apartment_badges->point = $badge_point;
                                                $apartment_badges->save();
                                                $badgeData = Badge::where('status', 1)->where('title', 'Resident')->first();
                                                Log::debug('point', $point);
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
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        $details = [
                            'email'  =>  $request->email,
                            'password' => $password,
                            'name' => $request->first_name . ' ' . $request->last_name,
                            'username' => $consumerid,
                        ];
                        Mail::to($request->email)->queue(new ConsumerRegistrationMail($details));
                        if (!Mail::failures()) {

                            Session::forget('unwanted_email');
                            Session::forget('listing_redirect_url');
                            Session::forget('type', 'register_password');
                            Session::forget('consumer_create_password');

                            $message1 = 'Thanks for signing up ' . $request->first_name . ' ' . $request->last_name . ' and Welcome to Smart Rewards!';
                            $message2 = 'Here’s ' . $point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                            return response()->json(['success' => true, 'status' => 0, 'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
                        } else {
                            return response()->json(['success' => false, 'message' => 'Something went wrong']);
                        }
                    }
                }
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }

    public function consumerLoginEmailCheck(Request $request)
    {
        if ($request->ajax()) {
            if (($request->email != '')) {
                $validator  =   Validator::make($request->all(), [
                    "email" =>  "max:255",
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                }

                $checkusermail = User::where('email', $request->email)->role('CONSUMER')->first();

                Session::put('unwanted_email', $request->email);

                if ($checkusermail) {
                    return response()->json(['success' => true, 'status' => 1, 'is_email_exists_as_consumer' => true, 'message' => 'Please login as consumer.']);
                } else {
                    Mail::to($request->email)->queue(new NewConfirmConsumerMail($request->email));

                    if (!Mail::failures()) {
                        return response()->json(['success' => true, 'status' => 2, 'is_email_exists_as_consumer' => false, 'message' => 'check your email to continue.']);
                    } else {
                        return response()->json(['success' => false, 'status' => 5, 'message' => 'Something went wrong']);
                    }
                }
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }

    public function consumerLoginPasswordCheck(Request $request)
    {
        if ($request->ajax()) {
            if (($request->password != '')) {
                $validator  =   Validator::make($request->all(), [
                    "password" =>  "min:8|max:255",
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                }

                $email = Session::get('unwanted_email');

                $consumer = User::role('CONSUMER')->where('email', strtolower($email))->where('active', 1)->first();
                if ($consumer) {
                    if (Hash::check($request->password, $consumer->password)) {
                        if (Auth::attempt(['email' => $email, 'password' => $request->password])) {
                            return response()->json(['success' => false, 'message' => 'Successfully Login',  'status' => 1]);
                        } else {
                            return response()->json(['success' => false, 'message' => 'Successfully Logissssn',  'status' => 1000]);
                        }
                    } else {
                        return response()->json(['success' => false, 'message' => 'Password not match',  'status' => 5]);
                    }
                } else {
                    return response()->json(['success' => false, 'message' => 'Your status is inactive please contact to admin',  'status' => 5]);
                }
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }


    public function consumerEmailVerificationMail($email)
    {
        Session::put('unwanted_email', $email);
        $redirect_url = Session::get('listing_redirect_url');
        Session::put('type', 'register_password');
        return redirect($redirect_url ?? '/index')->withError('Please fill the form');
    }

    public function consumerLoginPasswordCreate(Request $request)
    {
        if ($request->ajax()) {
            if (($request->password != '')) {
                $validator  =   Validator::make($request->all(), [
                    "password" =>  "regex:/^(?=.*[A-Z]).{8,}$/|min:8|max:20",
                ], [
                    'password.regex' => 'Your password should have at least 8 characters and 1 uppercase letter.'
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                }

                Session::put('consumer_create_password', $request->password);
                return response()->json(['success' => true, 'message' => 'Password stored successfully',  'status' => 1]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select one option',  'status' => 5]);
        }
    }


    public function consumerEmailCheck(Request $request)
    {
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "email" =>  "email"
            ]);
            if ($validator->fails()) {
                return response()->json(["success" => 0]);
            }
            $emailCheck = SendRegistrationLink::where('link_send_on', $request->email)->first();
            $unit = BuildingUnit::where('id', $emailCheck->unit_id)->first();
            $building = ProviderBuilding::with('providers', 'providers.states')->where('id', $unit->building_id)->first();
            if ($emailCheck) {
                return response()->json(['success' => true, 'data' => $building]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function consumerPhoneCheck(Request $request)
    {
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "phone"  =>  "regex:/^\+(?:[0-9] ?){6,14}[0-9]$/"
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 0]);
            }
            $phoneCheck = SendRegistrationLink::where('link_send_on', $request->phone)->first();
            $unit = BuildingUnit::where('id', $phoneCheck->unit_id)->first();
            $building = ProviderBuilding::with('providers', 'providers.states')->where('id', $unit->building_id)->first();
            if ($phoneCheck) {
                return response()->json(['success' => true, 'data' => $building]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function consumerSignupStep2(Request $request)
    {
        if ($request->ajax()) {
            if ($request->consumerid != '') {
                if ($request->property_id != '') {
                    $propertymanager = PropertyUnderProviderUser::with('provideruser')->where('provider_id', $request->property_id)->where('title_id', 4)->first();
                    if ($propertymanager) {
                        $manager = $propertymanager->provideruser->full_name;
                    } else {
                        $manager = '';
                    }
                    $consumer = User::find($request->consumerid);
                    $building_unit = BuildingUnit::where('unit', $request->unit)->where('access_code', $request->access_code)->where('provider_id', $request->property_id)->first();
                    if ($building_unit) {
                        $provideruser = ProviderBuilding::find($building_unit->building_id);
                        $consumer_unit = ConsumerUnit::create([
                            'provider_type_id' => $building_unit->provider_id,
                            'provider_building_id' => $building_unit->building_id,
                            'consumer_id' => $request->consumerid,
                            'unit_id' => $building_unit->id,
                            'provider_user_id' => $provideruser->provider_id
                        ]);

                        $details = [
                            'email'  =>  $consumer->email,
                            'password' => $request->password,
                            'name' => $consumer->first_name . ' ' . $consumer->last_name,
                            'username' => $consumer->userId,
                            'status' => 1
                        ];
                        Mail::to($consumer->email)->queue(new ConsumerRegistrationMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['success' => true, 'status' => 0, 'message' => "correct unit and access code given"]);
                        }
                    } else {
                        // $details = [
                        //     'email'  =>  $consumer->email,
                        //     'password' => $request->password,
                        //     'name' => $consumer->first_name . ' ' . $consumer->last_name,
                        //     'status' => 2
                        // ];
                        // Mail::to($consumer->email)->send(new ConsumerRegistrationMail($details));
                        return response()->json(['success' => false, 'status' => 2, 'data' => $manager, 'message' => "incorrect unit and access code"]);
                    }
                } else {
                    return response()->json(['success' => false, 'status' => 3, 'message' => "property not found"]);
                }
            } else {
                return response()->json(['success' => false, 'status' => 1, 'message' => "consumer not found"]);
            }
        }
    }

    public function consumerForgetPassword(Request $request)
    {
        if ($request->ajax()) {
            if ($request->email != '') {
                $user = User::where('email', $request->email)->first();
                if ($user) {
                    $token = Str::random(6);
                    $user->remember_token = $token;
                    $user->save();
                    $url = url('consumer-reset-password/' . $token . '');
                    $details = [
                        'name' => $user->full_name,
                        'email'  =>  $request->email,
                        'url' => $url
                    ];
                    //return response()->json(['success' => $details]);

                    Mail::to($request->email)->queue(new ForgetPasswordMail($details));
                    if (!Mail::failures()) {
                        return response()->json(['success' => true, 'status' => 2, 'message' => "Reset link sent to your email"]);
                    } else {
                        return response()->json(['success' => false, 'status' => 1, 'message' => "Mail not sent"]);
                    }
                } else {
                    return response()->json(['success' => false, 'status' => 0, 'message' => "User not found"]);
                }
            }
        }
    }

    public function consumerResetPassword($token)
    {
        Session::put('user_type','consumer');
        if ($token != '') {
            $user = User::where('remember_token', $token)->first();
            if ($user) {
                return redirect()->route('frontend.index')->with('token', $token);
            } else {
                $token = '';
                return redirect()->route('frontend.index')->with('token', $token);
            }
        } else {
            return redirect()->route('frontend.index');
        }
    }

    public function storeConsumerResetPassword(Request $request)
    {
        if ($request->ajax()) {
            if ($request->new_password != '') {
                if ($request->new_password == $request->confirm_password) {
                    $user = User::where('remember_token', $request->user_token)->first();
                    if ($user) {
                        $details = [
                            'name' => $user->full_name,
                            'password' => $request->new_password
                        ];
                        $user->password = $request->new_password;
                        $user->remember_token = '';
                        $user->save();
                        $data = array(
                            'first_name' => $request->first_name,
                            'last_name' =>  $request->last_name,
                            'email' =>  $request->email,
                            // 'password' => $password,
                            'phone' =>  $request->phone,
                            // 'date_of_birth' =>  $dob,
                            'active' => 1,
                            'zip_code' => $request->consumer_zipcode
                        );
                        Mail::to($user->email)->queue(new ResetPasswordMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['success' => true, 'status' => 3, 'message' => "Password updated successfully and mail sent"]);
                        } else {
                            return response()->json(['success' => false, 'status' => 4, 'message' => "Password updated successfully and mail not sent"]);
                        }
                    } else {
                        return response()->json(['success' => false, 'status' => 2, 'message' => "User not found"]);
                    }
                } else {
                    return response()->json(['success' => false, 'status' => 0, 'message' => "Confirm password does not matched with new password"]);
                }
            } else {
                return response()->json(['success' => false, 'status' => 1, 'message' => "New password should not be blank"]);
            }
        }
    }



    public function newPassword(Request $request)
    {
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

        $sessionData = Session::get('type');
        $sessionConId = Session::get('consumerId');
        $session = Session::get('data');
        // dd($session['req_badge_id']);
        $user = User::create($session);
        $user->password = $request->consumer_password;
        $user->save();

        $user->assignRole('CONSUMER');
        $rand = rand(1000,9999);
        $consumerid = $rand.substr($user->first_name, 0, 3);
        // $consumerid = strtoupper(substr($user->first_name, 0, 3)) . '0' . $user->id;
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

        if ($sessionData == 'consumer_invitation') {
            if ($sessionConId) {
                $alreadyAdded = MyFamilyFriend::where('invited_by', $sessionConId)->where('getting_point', 0)->get();
                $alreadyAddedEmail = MyFamilyFriend::where('invited_by', $sessionConId)->where('consumer_id', $user->id)->first();
                if (!$alreadyAddedEmail) {
                    if ($alreadyAdded) {
                        if ($alreadyAdded && $alreadyAdded->count() == 10) {
                            foreach ($alreadyAdded as $adduser) {
                                $adduser->getting_point = 1;
                                $adduser->save();
                            }
                            $invitedUser = User::find($sessionConId);
                            Point::create([
                                'user_id' => $invitedUser->id,
                                'point' => 25,
                                'sign' => '+'
                            ]);
                        }
                    }
                    $newMyFriendFamily = new MyFamilyFriend();
                    $newMyFriendFamily->consumer_id = $user->id;
                    $newMyFriendFamily->invited_by = $sessionConId;
                    $newMyFriendFamily->type = 'new';
                    $newMyFriendFamily->getting_point = 0;
                    $newMyFriendFamily->save();
                }
            }
        }

        $today = date('Y-m-d');
        $travel_badges = ShortTermGuestBadge::where('guest_email', $user->email)->where('checkin_date', '>=', $today)->where('badge_status', 0)->get();
        if (count($travel_badges) > 0) {
            foreach ($travel_badges as $travel) {
                $short_term = ShortTermGuestBadge::find($travel->id);
                $short_term->guest_id = $user->id;
                $short_term->badge_status = 1;
                $short_term->save();
                if ($short_term->checkin_date >= $today) {
                    $setting = TravelTourismSettings::where('travel_tourism_id', $travel->short_term_id)->first();
                    if ($setting) {
                        if ($setting->badge_bonus_point != null) {
                            $date1 = date_create($short_term->checkin_date);
                            $date2 = date_create($short_term->checkout_date);
                            $diff = date_diff($date1, $date2);
                            $days = $diff->format("%a");
                            $signup_point =  $setting->badge_bonus_point;
                            $badge_point = ((int)$days * $setting->badge_bonus_point);
                            $total_point = $user->point + $badge_point;
                            $user->point = $total_point;
                            $user->save();
                            $short_term->points = $badge_point;
                            $short_term->save();
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
                            $travel_data = TravelTourism::find($travel->short_term_id);
                            if($travel_data){
                                $travel_data->points_to_distribute = ($travel_data->points_to_distribute - $badge_point);
                                $travel_data->save();
                            }
                        }
                    }
                }
            }
        }

        // Log::debug($user);
        $badge_data = ApartmentGuestBadge::where('guest_email', $user->email)->where('status', 0)->orderBy('id', 'desc')->first();
        // Log::debug($apartment_badges);
        // dd($badge_data,'csdcsdsdds--');
        if ($badge_data) {
            // foreach($apartment_badges as $badge_data){
            $badge = Apartmentbadge::find($badge_data->badges_id);
            if ($badge) {
                // Log::debug($badge);
                // if($badge->start_date >= $today){
                $badge_data->user_id = $user->id;
                $badge_data->status = 1;
                $badge_data->save();
                $limit_setting = ProviderLimitSetting::where('property_id', $badge->building->provider_type_id)->first();
                if ($limit_setting) {
                    // Log::debug($limit_setting);
                    if ($limit_setting->sign_up_bonus_point != null) {
                        if ($limit_setting->current_allowance_point_limit != null) {

                            // $point = $limit_setting->sign_up_bonus_point + $limit_setting->current_allowance_point_limit;
                            // $date1 = date_create($badge->start_date);
                            // $date2 = date_create($badge->end_date);
                            // $diff = date_diff($date1, $date2);
                            // $days = $diff->format("%a");
                            $signup_point = $limit_setting->sign_up_bonus_point;
                            $current_allowance_point = $limit_setting->current_allowance_point_limit;
                            // $badge_point = $limit_setting->sign_up_bonus_point;
                            $total_point = $user->point + $signup_point +  $current_allowance_point;
                            // dd($total_point,$user->point,$signup_point,$current_allowance_point);
                            $user->point = $total_point;
                            $user->save();
                            $badge_data->point = $user->point;
                            $badge_data->save();
                            $badgeData = Badge::where('status', 1)->where('title', 'Resident')->first();
                            Log::debug($total_point);
                            Point::create([
                                'user_id' => $user->id,
                                'point' => $signup_point,
                                'badge_id' => $badgeData->id,
                                'sign' => '+'
                            ]);
                            Point::create([
                                'user_id' => $user->id,
                                'point' => $current_allowance_point,
                                'badge_id' => $badgeData->id,
                                'sign' => '+'
                            ]);

                            ConsumerBadge::create([
                                'user_id' => $user->id,
                                'badges_id' => $badgeData->id,
                                'point' => $signup_point,
                                'badge_activate_date' => date('Y-m-d')
                            ]);
                            ConsumerBadge::create([
                                'user_id' => $user->id,
                                'badges_id' => $badgeData->id,
                                'point' => $current_allowance_point,
                                'badge_activate_date' => date('Y-m-d')
                            ]);

                            $property = Provider::find($badge->building->provider_type_id);
                            if($property){
                                $property->points_to_distribute = ($property->points_to_distribute - ($signup_point+$current_allowance_point));
                                $property->save();
                            }
                        }
                    }
                }
                // }
            }
            // }
        }
        if($session['req_badge_id'] == ''){
            $hotel_badge_data = HotelGuestBadges::where('guest_email', $user->email)->where('status', 0)->orderBy('id', 'desc')->first();
        }else{
            $hotel_badge_data = HotelGuestBadges::where('guest_email', $user->email)->where('badges_id',$session['req_badge_id'])->where('status', 0)->orderBy('id', 'desc')->first();
        }
        

        if ($hotel_badge_data) {
            // $badge = HotelBadges::with('buildings')->find($hotel_badge_data->badges_id);
            $badge = HotelBadges::find($hotel_badge_data->badges_id);

            if ($badge) {

                //  dd($hotel_badge_data->guestbadges->start_date);
                $selected_badge_building_id = HotelBadges::select('building_id')->find($hotel_badge_data->badges_id);
                $hotel = HotelBuildings::select('hotel_id')->where('id', $selected_badge_building_id->building_id)->first();

                $hotel_id = $hotel->hotel_id;
                //dd($hotel_id);
                // dd($hotel->hotel_id);
                $hotel_badge_data->user_id = $user->id;
                $hotel_badge_data->status = 1;
                $hotel_badge_data->save();
                $id_update = HotelGuestBadges::where('guest_email', $user->email)->where('user_id',null)->update([
                    'user_id' => $user->id
                ]);
                $limit_setting = TravelTourismSettings::where('travel_tourism_id', $hotel_id)->first();
                // dd($limit_setting->current_allowance_point_limit,$limit_setting);
                //dd($hotel_badge_data, $this->selected_badge,$hotel_id->hotel_id,$limit_setting);
                if ($limit_setting) {
                    // Log::debug($limit_setting);
                    // if($limit_setting->sign_up_bonus_point != null){
                    if ($limit_setting->badge_bonus_point != null) {

                        // $point = $limit_setting->sign_up_bonus_point + $limit_setting->current_allowance_point_limit;
                        $date1 = date_create($badge->start_date);
                        $date2 = date_create($badge->end_date);
                        $diff = date_diff($date1, $date2);
                        $days = $diff->format("%a");
                       

                        $badge_bonus_point = $limit_setting->badge_bonus_point * $days;
                       
                        $total_point = $user->point + $badge_bonus_point;

                        $user->point = $total_point;
                        $user->save();
                        $hotel_badge_data->point = $user->point;
                        $hotel_badge_data->save();
                      
                        $badgeData = Badge::where('status', 1)->where('badge_type', 'Gimmzi')->first();
                        Log::debug($total_point);
                       
                        Point::create([
                            'user_id' => $user->id,
                            'point' => $badge_bonus_point,
                            'badge_id' => $badgeData->id,
                            'sign' => '+'
                        ]);

                        ConsumerBadge::create([
                            'user_id' => $user->id,
                            'badges_id' => $badgeData->id,
                            'point' => $signup_point,
                            'badge_activate_date' => date('Y-m-d')
                        ]);
                        ConsumerBadge::create([
                            'user_id' => $user->id,
                            'badges_id' => $badgeData->id,
                            'point' => $badge_bonus_point,
                            'badge_activate_date' => date('Y-m-d')
                        ]);

                        $travel_data = TravelTourism::find($hotel_id);
                        if($travel_data){
                            $travel_data->points_to_distribute = ($travel_data->points_to_distribute - $badge_bonus_point);
                            $travel_data->save();
                        }
                    }
                    // } 
                }
                // }
            }
            // }
        }



        $details = [
            'email'  =>  $user->email,
            // 'password' => $request->password,
            'name' => $user->first_name . ' ' . $user->last_name,
            'username' => $user->userId
        ];
        Mail::to($user->email)->queue(new ConsumerRegistrationMail($details));
        if (!Mail::failures()) {
            Session::forget('type', 'consumer_invitation');
            Session::forget('consumerId');
            Session::forget('register_data');
            $message1 = 'Thanks for signing up ' . $user->first_name . ' ' . $user->last_name . ' and Welcome to Smart Rewards!';
            $message2 = 'Here’s ' . $signup_point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
            return response()->json(['success' => true, 'status' => 0, 'message' => 'Consumer saved successfully', 'message1' => $message1, 'message2' => $message2]);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }






    public function consumerCancelRegistration(Request $request)
    {
        if ($request->ajax()) {
            if ($request->consumerid != '') {
                $user = User::find($request->consumerid);
                if ($user) {
                    $badge = ConsumerBadge::where('user_id', $user->id)->first();
                    if ($badge) {
                        $badge->delete();
                    }

                    $point = Point::where('user_id', $user->id)->first();
                    if ($point) {
                        $point->delete();
                    }
                    $user->delete();
                    return response()->json(['success' => false, 'status' => 1]);
                } else {
                    return response()->json(['success' => false, 'status' => 0]);
                }
            } else {
                return response()->json(['success' => false, 'status' => 2]);
            }
        }
    }

    public function consumerDismissRegistration(Request $request)
    {
        if ($request->ajax()) {
            //if($request->first_name != ''){
            $validator  =   Validator::make($request->all(), [
                "phone"  =>  "unique:users,phone|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/",
                "email" =>  "email"
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
            }
            if ($request->lives_an_apartment == 'yes') {

                if ($request->get_link == 1 && $request->get_link_2 == 0) {
                    if ($request->unit_one_name != '') {
                        $checkemail = SendRegistrationLink::with('provideruser')->where('link_send_on', $request->email)->first();
                        $checkunit = BuildingUnit::where('id', $checkemail->unit_id)->where('unit', $request->unit_one_name)->where('status', 1)->first();
                        if ($checkunit) {
                            $checkemail->delete();
                            $message1 = 'Your registration have not successfully done.';
                            return response()->json(['success' => true, 'status' => 0, 'message1' => $message1]);
                        } else {
                            return response()->json(['success' => false, 'message' => 'Not Found', 'status' => 2]);
                        }
                    } else {
                        return response()->json(['success' => false, 'message' => 'enter unit number']);
                    }
                } else if ($request->get_link == 0 && $request->get_link_2 == 1) {
                    if ($request->unit_two_name != '') {
                        $checkphone = SendRegistrationLink::where('link_send_on', $request->phone)->first();
                        $checkunit = BuildingUnit::where('id', $checkphone->unit_id)->where('unit', $request->unit_two_name)->where('status', 1)->first();
                        if ($checkunit) {
                            $checkuserphone = User::where('phone', $request->phone)->first();
                            if ($checkuserphone) {
                                $checkuserphone->delete();
                                $message1 = 'Your registration have not successfully done.';
                                return response()->json(['success' => true, 'status' => 0, 'message1' => $message1]);
                            } else {
                                return response()->json(['success' => false, 'message' => 'Not Found', 'status' => 2]);
                            }
                        } else {
                            return response()->json(['success' => false, 'message' => 'Not Found']);
                        }
                    } else {
                        return response()->json(['success' => false, 'message' => 'enter unit number']);
                    }
                }
            } else if ($request->lives_an_apartment == 'no') {
                return response()->json(['success' => false, 'message' => 'Not Found']);
            } else {
                return response()->json(['success' => false, 'status' => 5]);
            }
            // }
            // else{
            //     return response()->json(['success' => false, 'status' => 1]);
            // }

        }
    }

    public function apartmentAutocomplete(Request $request)
    {
        $term = $request->get('search');
        $data = ProspectiveAppartmentList::where('apartment_name', 'LIKE', '%' . $term . '%')
            ->take(10)
            ->groupBy('apartment_name')
            ->get();
        if (count($data) > 0) {
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
            <li><a href="javascript:void(0);" style="padding: 8px !important;">' . $row->apartment_name . '</a></li>
            ';
            }
            $output .= '</ul>';

            return response()->json($output);
        } else {
            $output = '';
            return response()->json($output);
        }
    }



    public function addProperty(Request $request)
    {
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "apartment_name"  =>  "required",
                "city" =>  "required",
                "state_id" =>  "required",
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
            } else {
                $apartment = ProspectiveAppartmentList::where('apartment_name', $request->apartment_name)->first();
                if ($apartment) {
                    $apartmentuser = new ProspectiveApartmentUser;
                    $apartmentuser->user_id = $request->user_id;
                    $apartmentuser->prospective_apartment_id = $apartment->id;
                    $apartmentuser->save();
                } else {
                    $apartment = ProspectiveAppartmentList::create([
                        'apartment_name' => $request->apartment_name,
                        'property_management_name' => $request->property_management_name,
                        'city' => $request->city,
                        'state_id' => $request->state_id,
                        'zip_code' => $request->zip_code
                    ]);
                    $apartmentuser = new ProspectiveApartmentUser;
                    $apartmentuser->user_id = $request->user_id;
                    $apartmentuser->prospective_apartment_id = $apartment->id;
                    $apartmentuser->save();
                }

                if ($apartment) {
                    $user = User::where('id', $request->user_id)->first();
                    $userpoints = Point::where('user_id', $request->user_id)->first();
                    $message1 = 'Thanks for signing up ' . $user->first_name .  ' and Welcome to Smart Rewards!';
                    $message2 = 'Here’s ' . $userpoints->point . ' POINTS from the Gimmzi Team as a Sign Up Bonus';
                    return response()->json(['status' => 1, 'message1' => $message1, 'message2' => $message2]);
                } else {
                    return response()->json(['status' => 0, 'message' => "property not added"]);
                }
            }
        }
    }
}
