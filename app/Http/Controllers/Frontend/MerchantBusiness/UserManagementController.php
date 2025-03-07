<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Mail\ChangePasswordLinkMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Title;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationSendToMerchantMail;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use App\Models\MerchantLocation;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{

    public function userManagement()
    {
        $users = User::where('business_id', Auth::user()->business_id)->whereNotIn('id', [Auth::user()->id])->where('active', 1)->where('created_password', '')->get();
        $pendingusers = User::where('business_id', Auth::user()->business_id)->whereNotIn('id', [Auth::user()->id])->where('active', 1)->where('created_password', '!=', '')->get();
        $business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->get();
        $merchant_location = MerchantLocation::where('user_id', '!=', Auth::user()->id)->where('status', 1)->get();
        $user_merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get();
        return view('frontend.merchant_owner.user-management.user_management', compact('users', 'pendingusers', 'business_locations', 'merchant_location', 'user_merchant_location'));
    }

    public function addNewUser(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(["status" => 2, "data" => $request->all()]);
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
                                    "phone_no"  =>  "unique:users,phone|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|numeric"
                                ]);
                                if ($validator->fails()) {
                                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                                } else {
                                    if ($request->gimmzi_id != '') {
                                        $validator  =   Validator::make($request->all(), [
                                            "gimmzi_id"  =>  "unique:users,userId"
                                        ]);
                                        if ($validator->fails()) {
                                            return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                                        } else {
                                            if ($request->phone_ext != '') {
                                                // $created_password = Str::random(6);
                                                if ($request->main_location != '') {
                                                    $today = date('Y-m-d');
                                                    $expiry_date = date('Y-m-d', strtotime($today . ' + 14 days'));
                                                    $userdata = array(
                                                        'first_name' => $request->first_name,
                                                        'last_name' => $request->last_name,
                                                        'email' => $request->email,
                                                        'phone' => $request->phone_ext.$request->phone_no,
                                                        'userId' => $request->gimmzi_id,
                                                        'phone_ext' => $request->phone_ext,
                                                        'active' => true,
                                                        'business_id' => Auth::user()->business_id,
                                                        'invited_by' => Auth::user()->id,
                                                        'created_password' => $request->gimmzi_id,
                                                        'password' => $request->gimmzi_id,
                                                        'expiry_date' => $expiry_date
                                                    );
                                                    $user = User::create($userdata);
                                                    $user->assignRole('MERCHANT');
                                                    $merchant_location = new MerchantLocation;
                                                    $merchant_location->user_id = $user->id;
                                                    $merchant_location->location_id = $request->main_location;
                                                    $merchant_location->status = true;
                                                    $merchant_location->is_main = true;
                                                    $merchant_location->save();
                                                    if (count($request->additional_location) > 0) {
                                                        foreach($request->additional_location as $another_location_id){
                                                            $merchant_location = new MerchantLocation;
                                                            $merchant_location->user_id = $user->id;
                                                            $merchant_location->location_id = $another_location_id;
                                                            $merchant_location->status = true;
                                                            $merchant_location->is_main = false;
                                                            $merchant_location->save();
                                                        }
                                                    }
                                                } else {
                                                    return response()->json(["status" => 10, "message" => 'Main location field is required']);
                                                }
                                            } else {
                                                if ($request->main_location != '') {
                                                    //$created_password = Str::random(6);
                                                    $today = date('Y-m-d');
                                                    $expiry_date = date('Y-m-d', strtotime($today . ' + 14 days'));
                                                    $userdata = array(
                                                        'first_name' => $request->first_name,
                                                        'last_name' => $request->last_name,
                                                        'email' => $request->email,
                                                        'phone' => $request->phone_no,
                                                        'userId' => $request->gimmzi_id,
                                                        'active' => true,
                                                        'business_id' => Auth::user()->business_id,
                                                        'invited_by' => Auth::user()->id,
                                                        'created_password' => $request->gimmzi_id,
                                                        'password' => $request->gimmzi_id,
                                                        'expiry_date' => $expiry_date
                                                    );
                                                    $user = User::create($userdata);
                                                    $user->assignRole('MERCHANT');
                                                    $merchant_location = new MerchantLocation;
                                                    $merchant_location->user_id = $user->id;
                                                    $merchant_location->location_id = $request->main_location;
                                                    $merchant_location->status = true;
                                                    $merchant_location->is_main = true;
                                                    $merchant_location->save();
                                                    if (isset($request->additional_location) && (count($request->additional_location) > 0)) {
                                                        foreach($request->additional_location as $another_location_id){
                                                            $merchant_location = new MerchantLocation;
                                                            $merchant_location->user_id = $user->id;
                                                            $merchant_location->location_id = $another_location_id;
                                                            $merchant_location->status = true;
                                                            $merchant_location->is_main = false;
                                                            $merchant_location->save();
                                                        }
                                                    }else{
                                                        return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                                    }
                                                } else {
                                                    return response()->json(["status" => 10, "message" => 'Main location field is required']);
                                                }
                                            }
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
                                                    $user->addMediaFromRequest('image')->toMediaCollection('merchantImages');
                                                    return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                                }
                                            } else {
                                                return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                            }
                                        } else {
                                            return response()->json(["status" => 7, "message" => 'user saved', 'data' => $user]);
                                        }
                                    } else {
                                        return response()->json(["status" => 3, "message" => 'gimmzi id field is required']);
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
        //return response()->json(['success' => $request->all()]);
        //Log::debug($request->first_name);
        //dd($request->all());

    }

    public function deleteNewUser(Request $request)
    {
        if ($request->ajax()) {
            $media = Media::where('model_id', $request->id)->where('collection_name', 'merchantImages')->first();
            if ($media) {
                $media->delete();
            }
            $user = User::find($request->id);
            if ($user) {
                $merchant_location = MerchantLocation::where('user_id',$user->id)->get();
                if(count($merchant_location) > 0){
                    $merchant_location->each->delete();
                }
                $user->delete();
                return response()->json(['status' => 1, 'message' => 'user deleted']);
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function inviteNewUser(Request $request)
    {
        if ($request->ajax()) {
            $title = Title::find($request->roleid);
            $user = User::find($request->userid);
            $business = BusinessProfile::find($user->business_id);
            if ($user) {
                $user->title_id = $request->roleid;
                $user->save();
                $url = url('/business-owners-login-modal');
                $details = [
                    'role' => $title->title_name,
                    'businessName' => $business->business_name,
                    'email'  =>  $user->email,
                    'password' => $user->userId,
                    'name' => $user->full_name,
                    'url' => $url
                ];
                Mail::to($user->email)->queue(new InvitationSendToMerchantMail($details));
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

    public function findUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::with('title')->find($request->userid);
            if ($user) {
                return response()->json(['status' => 1, 'message' => 'userfound', 'data' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function updateUser(Request $request){
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
                                            $mediaimage = Media::where(['model_id' => $updateuser->id, 'collection_name' => 'merchantImages'])->first();
                                            //return response()->json(["status" => 2, "data" => $mediaimage->file_name]);
                                            //unlink(storage_path('app/public/'.$mediaimage->id.'/'.$mediaimage->file_name));
                                            if($mediaimage)
                                                $mediaimage->delete();
                                            $updateuser->addMediaFromRequest('user_image')->toMediaCollection('merchantImages');
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

    public function deactivateUser(Request $request)
    {
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

    public function changeUserRole(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if ($user) {
                $user->title_id = $request->role_id;
                $user->save();
                return response()->json(['status' => 1, 'message' => 'role changed successfully', 'data' => $user]);
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function getBusinessLocation(Request $request)
    {
        if ($request->ajax()) {
            if ($request->locationid != '') {
                $business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)
                    ->where('status', 1)->where('id', '!=', $request->locationid)->get();
                if ($business_locations) {
                    return response()->json(['status' => 1, 'data' => $business_locations]);
                } else {
                    return response()->json(['status' => 0, 'message' => 'location not found']);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'location not found']);
            }
        }
    }

    public function resetPasswordLink(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if ($user) {
                $created_token = Str::random(6);
                $user->remember_token = $created_token;
                $user->save();
                $url = url('reset-password-token/' . $created_token);
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
    public function resetPasswordToken($token)
    {
        // Session::forget('merchant_token');
        Session::put('user_type','merchant');
        $user = User::where('remember_token', $token)->first();
        if ($user) {
            if (Auth::check()) {
                if (Auth::user() == $user) {
                    return redirect()->route('frontend.business_owner.account')->with('token', $token);
                } else {
                    return redirect()->route('frontend.business_owner.index')->with('token', $token);
                }
            } else {
                return redirect()->route('frontend.business_owner.index')->with('token', $token);
            }
        }
    }

    public function getMerchantLocation(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if ($user) {
                $available_business = MerchantLocation::where('user_id', $request->userid)->pluck('location_id')->toArray();
                $get_location = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $available_business)->get();

                $usermainlocation = MerchantLocation::with('businessLocation', 'merchantUser')->where('user_id', $request->userid)->where('is_main', 1)->where('status', 1)->first();
                if ($usermainlocation) {
                    $userotherlocation = MerchantLocation::with('businessLocation', 'merchantUser')->where('user_id', $request->userid)->where('status', 1)->get();
                    if (count($userotherlocation) > 0) {
                        return response()->json(['status' => 1, 'message' => 'get main location successfully', 'main' => $usermainlocation, 'another' => $userotherlocation, 'user' => $user, 'row' => $get_location]);
                    } else {
                        return response()->json(['status' => 2, 'message' => 'get main location successfully', 'main' => $usermainlocation, 'user' => $user, 'row' => $get_location]);
                    }
                } else {
                    $userotherlocation = MerchantLocation::with('businessLocation', 'merchantUser')->where('user_id', $request->userid)->where('status', 1)->get();
                    return response()->json(['status' => 3, 'message' => 'location not found', 'another' => $userotherlocation, 'user' => $user, 'row' => $get_location]);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function viewMerchantMainLocation(Request $request){
        if ($request->ajax()) {
            $user = User::find($request->userid);
            if($user){
                $viewLocation = MerchantLocation::with('businessLocation')->where('user_id', $request->userid)->where('is_main', 1)->first();
                return response()->json(['success' => 1, 'data' => $viewLocation]);
            }
           
           
        } else {
            return response()->json(['success' => 0]);
        }
    }
    public function getRemoveMerchantLocation(Request $request)
    {
        if ($request->ajax()) {
            $getLocation = MerchantLocation::with('businessLocation')->where('id', $request->get_location)->first();
            if ($getLocation) {
                return response()->json(['success' => 1, 'data' => $getLocation]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }
    public function removeAccessMerchantLocation(Request $request)
    {
        if ($request->ajax()) {
            $removeLocation = MerchantLocation::find($request->remove_location);
            if ($removeLocation) {
                // $removeLocation->status = 0;
                $userid = $removeLocation->user_id;
                if($removeLocation->is_main == 1){
                    $main_delete = 1;
                }
                else{
                    $main_delete = 0;
                }
                $removeLocation->delete();
                $available_business = MerchantLocation::where('user_id', $userid)->pluck('location_id')->toArray();
                $get_location = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $available_business)->get();
                $other_location = MerchantLocation::with('businessLocation')->where('user_id', $userid)->orderBy('id','asc')->get();
                if(count($other_location) > 0){
                    if($main_delete == 1){
                        MerchantLocation::where('id',$other_location[0]->id)->update(['is_main'=> 1]);
                    }
                    
                }
                $usermainlocation = MerchantLocation::with('businessLocation')->where('user_id', $userid)->where('is_main', 1)->where('status', 1)->first();
                if(count($get_location) > 1){
                    return response()->json(['success' => 1,'data' => $get_location,'others' => $other_location,'main' => $usermainlocation]);
                }
                else{
                    return response()->json(['success' => 1,'data' => $get_location,'others' => $other_location,'main' => $usermainlocation]);
                }
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function makeHomeMerchantLocation(Request $request)
    {
        if ($request->ajax()) {
            $anotherLocation = MerchantLocation::with('businessLocation')->where('id', $request->another_location)->first();
            $userid = $anotherLocation->user_id;
            $merchantmain = MerchantLocation::with('businessLocation')->where('user_id', $userid)->where('is_main', 1)->first();

            if ($anotherLocation) {
                return response()->json(['success' => 1, 'another' => $anotherLocation, 'main' => $merchantmain]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function replaceHomeMerchantLocation(Request $request)
    {

        if ($request->ajax()) {
            $replaceLocation = MerchantLocation::with('businessLocation')->find($request->replace_location);
            $userid = $replaceLocation->user_id;
            $merchantmain = MerchantLocation::with('businessLocation')->where('user_id', $userid)->where('is_main', 1)->first();

            if ($merchantmain) {
                $merchantmain->is_main = 0;
                $merchantmain->save();

                if ($replaceLocation) {
                    $replaceLocation->is_main = 1;
                    $replaceLocation->save();
                }
                return response()->json(['success' => 1, 'replace' => $replaceLocation, 'main' => $merchantmain]);
            }
            else{
                if ($replaceLocation) {
                    $replaceLocation->is_main = 1;
                    $replaceLocation->save();
                }
                return response()->json(['success' => 1, 'replace' => $replaceLocation,'main' => '']);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function addParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {
           

            $addnew = new MerchantLocation();
            $addnew->user_id = $request->userid;
            $addnew->location_id = $request->addlocation;
            $addnew->status = 1;
            $addnew->is_main = 0;
            $addnew->save();
            $available_business = MerchantLocation::where('user_id', $request->userid)->pluck('location_id')->toArray();
            $get_location = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $available_business)->get();
            $participatelocation = MerchantLocation::with('businessLocation')->where('user_id', $request->userid)->get();
            if(count($get_location) > 1){
                return response()->json(['success' => 1,'data' => $get_location, 'location' => $participatelocation]);
            }else{
                return response()->json(['success' => 1,'data' => $get_location, 'location' => $participatelocation]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function searchUser(Request $request){
        if($request->ajax()){
            if($request->searchby != ''){
                $search_by = trim($request->searchby);
              
               // return response()->json(['status' => 0, 'message' => $search]);
                if(filter_var($search_by, FILTER_VALIDATE_INT) !== false){
                    $users = User::with('title')->where('business_id', Auth::user()->business_id)
                                    ->whereNotIn('id', [Auth::user()->id])->where('active', 1)
                                    ->where('created_password', '')
                                    ->WhereRaw("phone like '%". $search_by . "%' ")
                                    ->get();
                    return response()->json(['status' => 1, 'data' => $users]);
                }
                else{
                    if($search_by == '01'){
                        $users = User::with('title')->where('business_id', Auth::user()->business_id)
                        ->whereNotIn('id', [Auth::user()->id])->where('active', 1)
                        ->where('created_password', '')
                        ->WhereRaw("phone like '%". $search_by . "%' ")
                        ->get();
                        return response()->json(['status' => 1, 'data' => $users]);
                    }
                    else{

                        $users = User::with('title')->where('business_id', Auth::user()->business_id)
                                        ->whereNotIn('id', [Auth::user()->id])->where('active', 1)
                                        ->where('created_password', '')
                                        ->WhereRaw(
                                            "concat(first_name,' ', last_name) like '%" . $search_by . "%' "
                                        )
                                        ->get();
                        return response()->json(['status' => 2, 'data' => $users]);
                    }
                }
            }
            else{
                return response()->json(['status' => 0, 'message' => 'field is required']);
            }
        }
    }

    public function removePendingUser(Request $request){
        if($request->ajax()){
            $user = User::find($request->userid);
            if($user){
               $locations =  MerchantLocation::where('user_id',$request->userid)->get();
               if(count($locations) > 0){
                MerchantLocation::where('user_id',$request->userid)->delete();
               }
               $user->delete();
               $pendingusers = User::where('business_id', Auth::user()->business_id)->whereNotIn('id', [Auth::user()->id])->where('active', 1)->where('created_password', '!=', '')->get();
               return response()->json(['status' => 1, 'message' => 'user deleted successfully', 'data' => $pendingusers]);
            }
            else{
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
    }

    public function editPendingUser(Request $request){
        // dd($request->all());
        if($request->ajax()){
            // $user = User::find($request->userid);
            // if($user){
               $pendingusers = User::where('business_id', Auth::user()->business_id)->whereNotIn('id', [Auth::user()->id])->where('active', 1)->where('created_password', '!=', '')->get();
               return response()->json(['status' => 1, 'message' => 'user deleted successfully', 'data' => $pendingusers]);
            // }
            // else{
            //     return response()->json(['status' => 0, 'message' => 'user not found']);
            // } 
        }
    }

    public function resendInvitationUser(Request $request){
        if($request->ajax()){
            $user = User::with('title','merchantBusiness')->find($request->userid);
            $pendingusers = User::where('business_id', Auth::user()->business_id)->whereNotIn('id', [Auth::user()->id])->where('active', 1)->where('created_password', '!=', '')->get();
               return response()->json(['status' => 1, 'message' => 'user deleted successfully', 'data' => $pendingusers]);
            if($user){
                $url = url('/business-owners-login-modal');
                $details = [
                    'role' => $user->title->title_name,
                    'businessName' => $user->merchantBusiness->business_name,
                    'email'  =>  $user->email,
                    'password' => $user->userId,
                    'name' => $user->full_name,
                    'url' => $url
                ];
                Mail::to($user->email)->queue(new InvitationSendToMerchantMail($details));
                if (!Mail::failures()) {
                    return response()->json(['status' => 1, 'message' => 'resend invitation']);
                } else {
                    return response()->json(['status' => 2, 'message' => 'mail not sent']);
                }
            }
            else{
                return response()->json(['status' => 0, 'message' => 'user not found']);
            }
        }
        
    }
    public function userManagementMerchantLocation(Request $request){
        if($request->ajax()){     
            $location = BusinessLocation::with('states')->find($request->location_id);
            // return response()->json(["success" => $location]);
            if($location){
                return response()->json(["success" => 1, 'data' => $location]);
            }
            else{
                return response()->json(["success" => 0]);

            }
        
    
}
    }
}
