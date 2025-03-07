<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\BusinessLocation;

class MerchantAccountDetailsController extends Controller
{
    public function merchantAccount()
    {
        $businessProfile = Auth::user()->merchantBusiness;
        $non_participating_location = BusinessLocation::with('states')->where('business_profile_id',Auth::user()->merchantBusiness->id)->where('participating_type','Non-participating')->first();
        $participating_location = BusinessLocation::with('states')->where('business_profile_id',Auth::user()->merchantBusiness->id)->where('participating_type','Participating')->first();
        $stateList = State::all();
        return view('frontend.merchant_owner.settings.merchant-account-details', compact('businessProfile', 'stateList','non_participating_location','participating_location'));
    }

    public function updateBusiness(Request $request)
    {
        if ($request->ajax()) {
            $non_participating_location = BusinessLocation::with('states')->where('business_profile_id',Auth::user()->merchantBusiness->id)->where('participating_type','Non-participating')->first();
            $participating_location = BusinessLocation::with('states')->where('business_profile_id',Auth::user()->merchantBusiness->id)->where('participating_type','Participating')->first();
            if ($request->business_name != '') {
                if ($request->business_phone != '') {
                    $validator  =   Validator::make($request->all(), [
                        "business_phone"  =>  'numeric|digits_between:10,15|unique:business_profiles,business_phone,' . $request->business_id
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 8, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        if ($request->business_email != '') {
                            $validator  =   Validator::make($request->all(), [
                                "business_email"  =>  'email|unique:business_profiles,business_email,' . $request->business_id
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $business = BusinessProfile::find($request->business_id);
                                if ($business) {
                                    $business->business_name = $request->business_name;
                                    $business->business_phone = $request->business_phone;
                                    $business->business_email = $request->business_email;
                                    $business->save();
                                    if($request->switch_2 == 'business'){
                                        $business->mailing_address = $request->mailing_address;
                                        $business->mailing_city = $request->mailing_city;
                                        $business->mailing_zipcode = $request->mailing_zipcode;
                                        $business->mailing_state_id = $request->mail_state_id;
                                        $business->save();
                                    }
                                    else{
                                        if($non_participating_location != ''){
                                            $non_participating_location->address = $request->business_address;
                                            $non_participating_location->city = $request->business_city;
                                            $non_participating_location->state_id = $request->business_state_id;
                                            $non_participating_location->zip_code = $request->business_zipcode;
                                            $non_participating_location->save();
                                        }
                                        else{
                                            $participating_location->address = $request->business_address;
                                            $participating_location->city = $request->business_city;
                                            $participating_location->state_id = $request->business_state_id;
                                            $participating_location->zip_code = $request->business_zipcode;
                                            $participating_location->save();
                                        }
                                    }
                                    $getuser = User::find(Auth::user()->id);
                                    if ($request->hasFile('verification_file')) {
                                        $validator  =   Validator::make($request->all(), [
                                            'verification_file' => 'mimes:pdf',
                                        ]);
                                        if ($validator->fails()) {
                                            return response()->json(["status" => 10, "validation_errors" => $validator->errors()->first()]);
                                        } else {
                                            $fileName = time() . '.' . $request->verification_file->extension();
                                            $request->verification_file->move(public_path('uploads/business_verification'), $fileName);
                                            $getuser->upload_doc = $fileName;
                                            $getuser->doc_type = 'needs_review';
                                            $getuser->doc_verify_status = 0;
                                            $getuser->save();
                                            }
                                    } 
                                    return response()->json(['status' => 1, 'data' => $business]);
                                }
                                
                                    
                            }
                        } else {
                            return response()->json(['status' => 7]);
                        }
                    }
                } else {
                    return response()->json(['status' => 6]);
                }
                            
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }
}
