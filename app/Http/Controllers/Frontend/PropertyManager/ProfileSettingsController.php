<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Title; 
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Models\Media;

class ProfileSettingsController extends Controller
{
    public function getUserProfile(){
        
        $user = User::with('title')->find(Auth::user()->id);
        return view('frontend.property-manager.profile_settings', compact('user'));
    }

    public function updateProviderProfile(Request $request)
    {
        if ($request->ajax()) {
          
            if ($request->full_name != '') {
                if ($request->email != '') {
                    $validator  =   Validator::make($request->all(), [
                        "email"  =>  'email|unique:users,email,' . $request->user_id
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" =>  6, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        if ($request->phone != '') {
                            $validator  =   Validator::make($request->all(), [
                                "phone"  =>  'numeric|digits_between:8,15|unique:users,phone,' . $request->user_id
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 5, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $user = User::find($request->user_id);
                                if ($user) {
                                    $splitName = explode(' ', $request->full_name, 2);
                                    $first_name = $splitName[0];
                                    $last_name = !empty($splitName[1]) ? $splitName[1] : '';
                                    $user->first_name = $first_name;
                                    $user->last_name = $last_name;
                                    $user->email = $request->email;
                                    $user->phone = $request->phone;
                                    if($request->password != ''){
                                        $user->password = $request->password;
                                    }
                                    if($request->newsletter == '1'){
                                        $user->newsletter = 1;
                                    }
                                    else{
                                        $user->newsletter = 0;
                                    }
                                    if($request->gimmzi_update == '1'){
                                        $user->gimmzi_update = 1;
                                    }
                                    else{
                                        $user->gimmzi_update = 0;
                                    }
                                    if($request->special_promotion_offer == '1'){
                                        $user->special_promotion_offer = 1;
                                    }
                                    else{
                                        $user->special_promotion_offer = 0;
                                    }
                                    if($request->gimmzi_upcoming_event == '1'){
                                        $user->gimmzi_upcoming_event = 1;
                                    }
                                    else{
                                        $user->gimmzi_upcoming_event = 0;
                                    }
                                    if($request->unsubscribe_from_all == '1'){
                                        $user->unsubscribe_from_all = 1;
                                        $user->gimmzi_upcoming_event = 0;
                                        $user->special_promotion_offer = 0;
                                        $user->gimmzi_update = 0;
                                        $user->newsletter = 0;
                                    }
                                    else{
                                        $user->unsubscribe_from_all = 0;
                                    }
                                    if($request->communication_settings == 'email_and_text'){
                                        $user->communication_setting = 'email_and_text';
                                    }
                                    elseif($request->communication_settings == 'email_only'){
                                        $user->communication_setting = 'email_only';
                                    }
                                    elseif($request->communication_settings == 'text_only'){
                                        $user->communication_setting = 'text_only';
                                    }
                                    else{
                                        $user->communication_setting = ' ';
                                    }
                                    $user->save();

                                    if ($request->hasFile('user_photo')) {
                                        
                                        $validator  =   Validator::make($request->all(), [
                                            'user_photo' => 'mimes:jpg,jpeg,png',
                                        ]);
                                        if ($validator->fails()) {
                                            return response()->json(["status" => 7, "validation_errors" => $validator->errors()->first()]);
                                        }else{
                                            $getphoto = Media::where(['model_id' => $user->id, 'collection_name' => 'providerImages'])->first();
                                            if($getphoto){
                                                $getphoto->delete();
                                            }
                                                $userphoto = $user->addMedia($request->user_photo->getRealPath())
                                                ->usingName($request->user_photo->getClientOriginalName())
                                                ->toMediaCollection('providerImages');
                                            
                                        }
                                    }
                                    return response()->json(['status' => 1, 'data' => $user]);
                                } else {
                                    return response()->json(['status' => 4, 'message' => 'User not found']);
                                }
                            }
                        } else {
                            $user = User::find($request->user_id);
                                if ($user) {
                                    $splitName = explode(' ', $request->full_name, 2);
                                    $first_name = $splitName[0];
                                    $last_name = !empty($splitName[1]) ? $splitName[1] : '';
                                    $user->first_name = $first_name;
                                    $user->last_name = $last_name;
                                    $user->email = $request->email;
                                    if($request->password != ''){
                                        $user->password = $request->password;
                                    }
                                    if($request->newsletter == '1'){
                                        $user->newsletter = 1;
                                    }
                                    else{
                                        $user->newsletter = 0;
                                    }
                                    if($request->gimmzi_update == '1'){
                                        $user->gimmzi_update = 1;
                                    }
                                    else{
                                        $user->gimmzi_update = 0;
                                    }
                                    if($request->special_promotion_offer == '1'){
                                        $user->special_promotion_offer = 1;
                                    }
                                    else{
                                        $user->special_promotion_offer = 0;
                                    }
                                    if($request->gimmzi_upcoming_event == '1'){
                                        $user->gimmzi_upcoming_event = 1;
                                    }
                                    else{
                                        $user->gimmzi_upcoming_event = 0;
                                    }
                                    if($request->unsubscribe_from_all == '1'){
                                        $user->unsubscribe_from_all = 1;
                                        $user->gimmzi_upcoming_event = 0;
                                        $user->special_promotion_offer = 0;
                                        $user->gimmzi_update = 0;
                                        $user->newsletter = 0;
                                    }
                                    else{
                                        $user->unsubscribe_from_all = 0;
                                    }
                                    if($request->communication_settings == 'email_and_text'){
                                        $user->communication_setting = 'email_and_text';
                                    }
                                    elseif($request->communication_settings == 'email_only'){
                                        $user->communication_setting = 'email_only';
                                    }
                                    elseif($request->communication_settings == 'text_only'){
                                        $user->communication_setting = 'text_only';
                                    }
                                    else{
                                        $user->communication_setting = ' ';
                                    }
                                    $user->save();

                                    if ($request->hasFile('user_photo')) {
                                        
                                        $validator  =   Validator::make($request->all(), [
                                            'user_photo' => 'mimes:jpg,jpeg,png',
                                        ]);
                                        if ($validator->fails()) {
                                            return response()->json(["status" => 7, "validation_errors" => $validator->errors()->first()]);
                                        }else{
                                            $getphoto = Media::where(['model_id' => $user->id, 'collection_name' => 'providerImages'])->first();
                                            if($getphoto){
                                                $getphoto->delete();
                                            }
                                                $userphoto = $user->addMedia($request->user_photo->getRealPath())
                                                ->usingName($request->user_photo->getClientOriginalName())
                                                ->toMediaCollection('providerImages');
                                            
                                        }
                                    }
                                    return response()->json(['status' => 1, 'data' => $user]);
                                } else {
                                    return response()->json(['status' => 4, 'message' => 'User not found']);
                                }
                        }
                    }
                } else {
                    return response()->json(['status' => 2]);
                }
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function communityReport(){
        return view('frontend.property-manager.report-create');
    }
}
