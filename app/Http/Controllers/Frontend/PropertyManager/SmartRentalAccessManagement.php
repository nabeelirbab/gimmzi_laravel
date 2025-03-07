<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\PropertyUnderProviderUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationSendToProviderMail;
use App\Models\Title; 
use Spatie\MediaLibrary\Models\Media;
use App\Mail\ChangePasswordLinkMail;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SmartRentalAccessManagement extends Controller
{
    public function smartRentalAccess(Request $request){
        $user = Auth::user();
        $propertyDetails = PropertyUnderProviderUser::with('provider')->where('provider_user_id',$user->id)->get();
        //71
        $propertyid = $propertyDetails->first()->provider_id;
        //2
        $providers = PropertyUnderProviderUser::query();
        $providers = $providers->with('provider','provideruser','title')
                                ->join('users', 'users.id', '=', 'property_under_provider_users.provider_user_id')
                                ->join('titles', 'titles.id', '=', 'property_under_provider_users.title_id')
                                ->select(DB::raw('users.*'),DB::raw('property_under_provider_users.*'),DB::raw('titles.*'))
                                ->where('property_under_provider_users.title_id','!=',4)
                                ->where('users.active',1)
                                ->where(function ($query) {
                                    $query->where('users.created_password', '')
                                          ->orWhereNull('users.created_password');
                                });
                                // ->where('users.created_password', '=', '');
                                                     
        if($request->ajax()){
            if($request->property_id){
                $providers = $providers->where('property_under_provider_users.provider_id',$request->property_id);
            }
            if($request->search_by){
               
                $providers = $providers->whereRaw( "concat(users.first_name,' ', users.last_name) like '%" . trim($request->search_by) . "%' ");
            }
            if($request->sortby == 'name(A-Z)'){
                $providers = $providers->orderBy('users.first_name','asc');
            }
            elseif($request->sortby == 'name(Z-A)'){
                $providers = $providers->orderBy('users.first_name','desc');
            }
            elseif($request->sortby == 'role(A-Z)'){
                $providers = $providers->orderBy('titles.title_name','asc');
            }
            elseif($request->sortby == 'role(Z-A)'){
                $providers = $providers->orderBy('titles.title_name','desc');
            }
            else{
                $providers = $providers->orderBy('users.first_name','asc');
            }
            $providers = $providers->get();
            dd($providers);
            return response()->json(['status'=>'success','providers'=>$providers]);
        }
        
        $providers = $providers->where('property_under_provider_users.provider_id',$propertyid);
        $providers = $providers->orderBy('users.first_name','asc');                      
        $providers = $providers->get();
        // dd($providers);
        $pendingusers = PropertyUnderProviderUser::with('provideruser')->where('provider_id', $propertyid)
                        ->where('title_id','!=',4)
                        ->whereHas('provideruser',function($q){
                            $q->where('created_password', '!=', '');
                        })
                        ->get();
        //  dd($providers);
        return view('frontend.property-manager.smart_rental_access_management', compact('propertyDetails', 'user','providers','pendingusers'));
    }

    public function addNewProviderUser(Request $request){
        if ($request->ajax()) {
            if ($request->first_name != '') {
                if ($request->last_name != '') {
                    if ($request->email != '') {
                        $validator  =   Validator::make($request->all(), [
                            "email"  =>  "email|unique:users,email"
                        ]);
                        if ($validator->fails()) {
                            return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                        } else {
                            if ($request->phone_no != '') {
                                $validator  =   Validator::make($request->all(), [
                                    "phone_no"  =>  "unique:users,phone|digits_between:8,15"
                                ]);
                                if ($validator->fails()) {
                                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                                } else {
                                    
                                            if ($request->phone_ext != '') {
                                                // $created_password = Str::random(6);
                                                $today = date('Y-m-d');
                                                $expiry_date = date('Y-m-d', strtotime($today . ' + 14 days'));
                                                $userdata = array(
                                                    'first_name' => $request->first_name,
                                                    'last_name' => $request->last_name,
                                                    'email' => $request->email,
                                                    'phone' => $request->phone_no,
                                                    // 'userId' => $request->gimmzi_id,
                                                    'phone_ext' => $request->phone_ext,
                                                    'active' => true,
                                                    'business_id' => Auth::user()->business_id,
                                                    'invited_by' => Auth::user()->id,
                                                    // 'created_password' => $request->gimmzi_id,
                                                    // 'password' => $request->gimmzi_id,
                                                    'expiry_date' => $expiry_date
                                                );
                                                $user = User::create($userdata);
                                                $user->assignRole('PROVIDER');
                                                $userid = '1234/'.substr($user->first_name,0,3).'/'.$user->id;
                                                $user->userId = $userid;
                                                $user->created_password = $userid;
                                                $user->password = $userid;
                                                $user->save();
                                                $property = new PropertyUnderProviderUser;
                                                $property->provider_id = $request->property_id;
                                                $property->provider_user_id = $user->id;
                                                $property->save();  
                                                
                                            } else {
                                                //$created_password = Str::random(6);
                                                $today = date('Y-m-d');
                                                $expiry_date = date('Y-m-d', strtotime($today . ' + 14 days'));
                                                $userdata = array(
                                                    'first_name' => $request->first_name,
                                                    'last_name' => $request->last_name,
                                                    'email' => $request->email,
                                                    'phone' => $request->phone_no,
                                                    // 'userId' => $request->gimmzi_id,
                                                    'active' => true,
                                                    'business_id' => Auth::user()->business_id,
                                                    'invited_by' => Auth::user()->id,
                                                    // 'created_password' => $request->gimmzi_id,
                                                    // 'password' => $request->gimmzi_id,
                                                    'expiry_date' => $expiry_date
                                                );
                                                $user = User::create($userdata);
                                                $user->assignRole('PROVIDER');
                                                $userid = '1234/'.substr($user->first_name,0,3).'/'.$user->id;
                                                $user->userId = $userid;
                                                $user->created_password = $userid;
                                                $user->password = $userid;
                                                $user->save();
                                                $property = new PropertyUnderProviderUser;
                                                $property->provider_id = $request->property_id;
                                                $property->provider_user_id = $user->id;
                                                $property->save();  
                                            }

                                        if ($request->image != '') {
                                            if ($request->hasFile('image')) {
                                                //return response()->json(["status" => 2, "data" => $request->image]);
                                                $validator  =   Validator::make($request->all(), [
                                                    "image"  =>  "mimes:png,jpeg,jpg,gif"
                                                ]);
                                                if ($validator->fails()) {
                                                    return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                                                } else {
                                                    $user->addMediaFromRequest('image')->toMediaCollection('providerImages');
                                                    return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                                }
                                            } else {
                                                return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                            }
                                        } else {
                                            return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                        }
                                    
                                }
                            } else {
                                return response()->json(["status" => 4, "message" => 'phone no field is required']);
                            }
                        }
                    } else {
                        return response()->json(["status" => 5, "message" => 'email field is required']);
                    }
                } else {
                    return response()->json(["status" => 8, "message" => 'last name field is required']);
                }
            } else {
                return response()->json(["status" => 6, "message" => 'first name field is required']);
            }
        }
    }

    public function inviteNewProviderUser(Request $request)
    {
        if ($request->ajax()) {
            $title = Title::find($request->roleid);
            $user = User::find($request->userid);
            $provider_property = PropertyUnderProviderUser::with('provider')->where('provider_id',$request->propertyid)->where('provider_user_id',$request->userid)->first();
            if ($provider_property) {
                $provider_property->title_id = $request->roleid;
                $provider_property->save();
                $user->title_id = $request->roleid;
                $user->save();
                $url = url('/property-login-modal');
                $details = [
                    'role' => $title->title_name,
                    'property' => $provider_property->provider->name,
                    'propertyId' => $provider_property->provider->providerId,
                    'email'  =>  $user->email,
                    'password' => $user->userId,
                    'name' => $user->full_name,
                    'url' => $url,
                    'sender_name' => Auth::user()->full_name
                ];
                // dd($details);
                Mail::to($user->email)->queue(new InvitationSendToProviderMail($details));
                if (!Mail::failures()) {
                    return response()->json(['status' => 1, 'message' => 'send invitation']);
                } else {
                    return response()->json(['status' => 2, 'message' => 'mail not sent']);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function getSmartRentalAccessUsers(Request $request){
        if ($request->ajax()) {
            $provider = Provider::find($request->propertyid);
            $providers = PropertyUnderProviderUser::query();
            $providers = $providers->with('provider','provideruser','title')
                                    ->join('users', 'users.id', '=', 'property_under_provider_users.provider_user_id')
                                    ->join('titles', 'titles.id', '=', 'property_under_provider_users.title_id')
                                    ->select(DB::raw('users.*'),DB::raw('property_under_provider_users.*'),DB::raw('titles.*'))
                                    ->where('property_under_provider_users.title_id','!=',4)
                                    ->where('users.active',1)
                                    ->where('property_under_provider_users.provider_id',$request->propertyid)
                                    ->where('created_password', '=', '')
                                    ->get();
            if($provider){
                return response()->json(['status' => 1, 'message' => 'property detail', 'data' => $providers,'provider' => $provider]);
            }
            else{
                return response()->json(['status' => 0, 'message' => 'property not found','data' => $providers,'provider' => $provider]);
            }
        }
    }

    public function editfindProviderUser(Request $request){
        // dd($request->all());
        if($request->ajax()){
            if($request->userid != ''){
                $user = User::find($request->userid);
                

                
                if($user){
                    return response()->json(['status' => 1, 'message' => 'property user found', 'data' => $user]);
                }
                else{
                    return response()->json(['status' => 0, 'message' => 'property user not found']);
                }
            }
        }
    }



    public function findProviderUser(Request $request){
        // dd($request->all());
        if($request->ajax()){
            if($request->userid != ''){
                $user = User::find($request->userid);
                // dd($user);

                $title = Title::find($user->title_id);
                // dd($user,$title);
                $provider_property = PropertyUnderProviderUser::with('provider')->where('provider_id',$request->propertyid)->where('provider_user_id',$request->userid)->first();
                // dd($provider_property);
                if ($provider_property) {
                    $provider_property->title_id = $user->title_id;
                    $provider_property->save();
                    // $user->title_id = $request->roleid;
                    // $user->save();
                    $url = url('/property-login-modal');
                    $details = [
                        'role' => $title->title_name,
                        'property' => $provider_property->provider->name,
                        'propertyId' => $provider_property->provider->providerId,
                        'email'  =>  $user->email,
                        'password' => $user->userId,
                        'name' => $user->full_name,
                        'url' => $url,
                        'sender_name' => Auth::user()->full_name
                    ];
                    Mail::to($user->email)->queue(new InvitationSendToProviderMail($details));
                    if (!Mail::failures()) {
                        return response()->json(['status' => 1, 'message' => 'Invitation sent successfully.', 'data' => $user]);
                    } else {
                        return response()->json(['status' => 2, 'message' => 'Invitation faild.']);
                    }
                }
                // if($user){
                //     return response()->json(['status' => 1, 'message' => 'property user found', 'data' => $user]);
                // }
                // else{
                //     return response()->json(['status' => 0, 'message' => 'property user not found']);
                // }
            }
        }
    }

    public function updateProviderUser(Request $request){
        // dd($request->all());
        if ($request->ajax()) {
            //return response()->json(["status" => 2, "data" => $request->user_image]);
             if ($request->user_first_name != '') {
                 if ($request->user_last_name != '') {
                     if ($request->user_email != '') {
                         $validator  =   Validator::make($request->all(), [
                             "user_email"  =>  "required"
                         ]);
                         if ($validator->fails()) {
                             return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                         } else {
                             if ($request->user_phone_no != '') {
                                 $validator  =   Validator::make($request->all(), [
                                     "user_phone_no"  =>  "required"
                                 ]);
                                 if ($validator->fails()) {
                                     return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                                 } else{
                                     if ($request->phone_ext != '') {
                                         // $created_password = Str::random(6);
                                             $updateuser = User::find($request->edituser_id);
                                             $updateuser->first_name = $request->user_first_name;
                                             $updateuser->last_name = $request->user_last_name;
                                             $updateuser->email = $request->user_email;
                                             $updateuser->phone = $request->user_phone_no;
                                             $updateuser->phone_ext = $request->user_phone_ext;
                                             $updateuser->userId = $request->user_gimmzi_id;
                                             $updateuser->save();
                                     }else{
                                         $updateuser = User::find($request->edituser_id);
                                         $updateuser->first_name = $request->user_first_name;
                                         $updateuser->last_name = $request->user_last_name;
                                         $updateuser->email = $request->user_email;
                                         $updateuser->phone = $request->user_phone_no;
                                         $updateuser->phone_ext = $request->user_phone_ext;
                                         $updateuser->userId = $request->user_gimmzi_id;
                                         $updateuser->save();
                                     }
                                 } 
                                 if ($request->user_image != null) {
                                     if ($request->hasFile('user_image')) {
                                         //return response()->json(["status" => 2, "data" => $request->user_image]);
                                         $validator  =   Validator::make($request->all(), [
                                             "user_image"  =>  "mimes:png,jpeg,jpg,gif"
                                         ]);
                                         if ($validator->fails()) {
                                             return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                                         } else {
                                             $mediaimage = Media::where(['model_id' => $updateuser->id, 'collection_name' => 'providerImages'])->first();
                                             //return response()->json(["status" => 2, "data" => $mediaimage->file_name]);
                                             //unlink(storage_path('app/public/'.$mediaimage->id.'/'.$mediaimage->file_name));
                                             if($mediaimage)
                                                 $mediaimage->delete();
                                             $updateuser->addMediaFromRequest('user_image')->toMediaCollection('providerImages');
                                             return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                         }
                                     } else {
                                         return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                     }
                                 } else {
                                     return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                 }
                             } else{
                                     return response()->json(["status" => 4, "message" => 'phone no field is required']);
                                 
                             }
                         } 
                     }else{
                         return response()->json(["status" => 5, "message" => 'email field is required']);
                     }
                 }else{
                     return response()->json(["status" => 8, "message" => 'last name field is required']);
                 }
             }else{
                 return response()->json(["status" => 6, "message" => 'first name field is required']);
             }
         }
    }

    public function pendingUpdateProviderUser(Request $request){
        // dd($request->all());
        if ($request->ajax()) {
             if ($request->pending_user_first_name != '') {
                 if ($request->pending_user_last_name != '') {
                     if ($request->pending_user_email != '') {
                         $validator  =   Validator::make($request->all(), [
                             "pending_user_email"  =>  "required"
                         ]);
                         if ($validator->fails()) {
                             return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                         } else {
                             if ($request->pending_user_phone_no != '') {
                                 $validator  =   Validator::make($request->all(), [
                                     "pending_user_phone_no"  =>  "required"
                                 ]);
                                 if ($validator->fails()) {
                                     return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                                 } else{
                                     if ($request->phone_ext != '') {
                                             $updateuser = User::find($request->pending_edituser_id);
                                             $updateuser->first_name = $request->pending_user_first_name;
                                             $updateuser->last_name = $request->pending_user_last_name;
                                             $updateuser->email = $request->pending_user_email;
                                             $updateuser->phone = $request->pending_user_phone_no;
                                             $updateuser->phone_ext = $request->pending_user_phone_ext;
                                             $updateuser->userId = $request->user_gimmzi_id;
                                             $updateuser->save();
                                     }else{
                                         $updateuser = User::find($request->pending_edituser_id);
                                         $updateuser->first_name = $request->pending_user_first_name;
                                         $updateuser->last_name = $request->pending_user_last_name;
                                         $updateuser->email = $request->pending_user_email;
                                         $updateuser->phone = $request->pending_user_phone_no;
                                         $updateuser->phone_ext = $request->pending_user_phone_ext;
                                         $updateuser->userId = $request->user_gimmzi_id;
                                         $updateuser->save();
                                     }
                                 } 
                                 if ($request->user_image != null) {
                                     if ($request->hasFile('user_image')) {
                                         $validator  =   Validator::make($request->all(), [
                                             "user_image"  =>  "mimes:png,jpeg,jpg,gif"
                                         ]);
                                         if ($validator->fails()) {
                                             return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                                         } else {
                                             $mediaimage = Media::where(['model_id' => $updateuser->id, 'collection_name' => 'providerImages'])->first();
                                             if($mediaimage)
                                                 $mediaimage->delete();
                                             $updateuser->addMediaFromRequest('user_image')->toMediaCollection('providerImages');
                                             return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                         }
                                     } else {
                                         return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                     }
                                 } else {
                                     return response()->json(["status" => 7, "message" => 'user saved', 'data' => $updateuser]);
                                 }
                             } else{
                                     return response()->json(["status" => 4, "message" => 'phone no field is required']);
                                 
                             }
                         } 
                     }else{
                         return response()->json(["status" => 5, "message" => 'email field is required']);
                     }
                 }else{
                     return response()->json(["status" => 8, "message" => 'last name field is required']);
                 }
             }else{
                 return response()->json(["status" => 6, "message" => 'first name field is required']);
             }
         }
    }

    public function resetProviderPasswordLink(Request $request){
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if ($user) {
                $created_token = Str::random(6);
                $user->remember_token = $created_token;
                $user->save();
                $url = url('reset-provider-password-token/' . $created_token);
                $details = [
                    'name' => $user->full_name,
                    'url' => $url
                ];
                Mail::to($user->email)->queue(new ChangePasswordLinkMail($details));
                if (!Mail::failures()) {
                    return response()->json(['status' => 1, 'message' => 'send reset password link']);
                } else {
                    return response()->json(['status' => 2, 'message' => 'mail not sent']);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function resetProviderPasswordToken($token){
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            if (Auth::check()) {
                if (Auth::user() == $user) {
                    return redirect()->route('frontend.property-manager-profile')->with('token', $token);
                } else {
                    return redirect()->route('frontend.index')->with('token', $token);
                }
            } else {
                return redirect()->route('frontend.index')->with('token', $token);
            }
        }
    }

    public function deactivateProviderUser(Request $request){
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if ($user) {
                $user->active = false;
                $user->save();
                return response()->json(['status' => 1, 'message' => 'deactivated successfully', 'data' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function changeProviderUserRole(Request $request){
        if ($request->ajax()) {
            if($request->role_id != ''){
                $provideruser = User::find($request->userid);
                if($provideruser){
                    $provideruser->title_id = $request->role_id;
                    $provideruser->save();
                    $property_user = PropertyUnderProviderUser::where('provider_id',$request->propertyid)->where('provider_user_id',$request->userid)->first();
                    if($property_user){
                        $property_user->title_id = $request->role_id;
                        $property_user->save();
                    }
                    return response()->json(['status' => 1, 'message' => 'Role changed successfully']);
                }
                else{
                    return response()->json(['status' => 0, 'message' => 'user not found']);
                }
            }
            else{
                return response()->json(['status' => 0, 'message' => 'something went wrong']);
            }
            
        }
    }

    public function editApartmentclose(Request $request){
        // dd($request->all());
        if($request->ajax()){
            $pendingusers = PropertyUnderProviderUser::with('provideruser','title')->where('provider_id', $request->propertyid)
                        ->where('title_id','!=',4)
                        ->whereHas('provideruser',function($q){
                            $q->where('created_password', '!=', '');
                        })
                        ->get();
               return response()->json(['status' => 1, 'message' => 'user edited successfully', 'pending' => $pendingusers]);
        }
    }

    // public function getProviderLocation(Request $request){
    //     if ($request->ajax()) {
    //         $user = User::find($request->userid);
    //         if ($user) {
    //             $available_business = MerchantLocation::where('user_id', $request->userid)->pluck('location_id')->toArray();
    //             $get_location = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $available_business)->get();

    //             $usermainlocation = MerchantLocation::with('businessLocation', 'merchantUser')->where('user_id', $request->userid)->where('is_main', 1)->where('status', 1)->first();
    //             if ($usermainlocation) {
    //                 $userotherlocation = MerchantLocation::with('businessLocation', 'merchantUser')->where('user_id', $request->userid)->where('is_main', 0)->where('status', 1)->get();
    //                 if (count($userotherlocation) > 0) {
    //                     return response()->json(['status' => 1, 'message' => 'get main location successfully', 'main' => $usermainlocation, 'another' => $userotherlocation, 'user' => $user, 'row' => $get_location]);
    //                 } else {
    //                     return response()->json(['status' => 2, 'message' => 'get main location successfully', 'main' => $usermainlocation, 'user' => $user, 'row' => $get_location]);
    //                 }
    //             } else {
    //                 return response()->json(['status' => 3, 'message' => 'location not found', 'user' => $user, 'row' => $get_location]);
    //             }
    //         } else {
    //             return response()->json(['status' => 0, 'message' => 'user not found']);
    //         }
    //     }
    // }


    public function removePendingProvider(Request $request){
        // dd($request->all());
        if($request->ajax()){
            $user = User::find($request->userid);
            if($user){
               $provider_user = PropertyUnderProviderUser::where('provider_user_id',$request->userid)->first();
               if($provider_user){
                 $provider_user->delete();
               }
               $user->delete();
               $pendingusers = PropertyUnderProviderUser::with('provideruser','title')->where('provider_id', $request->propertyid)
                                ->where('title_id','!=',4)
                                ->whereHas('provideruser',function($q){
                                    $q->where('created_password', '!=', '');
                                })
                                ->get();
               return response()->json(['status' => 1, 'message' => 'user deleted successfully','pending'=>$pendingusers]);
            }
            else{
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function apartmentEditUser(Request $request){
        // dd($request->all());
        if ($request->ajax()) {
            $user = User::with('title')->find($request->userid);
            // dd($user);
            if ($user) {
                return response()->json(['status' => 1, 'message' => 'userfound', 'data' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }
}
