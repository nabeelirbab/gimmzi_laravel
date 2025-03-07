<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deal;
use App\Models\GiftManage;
use App\Models\ItemOrService;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;
use App\Models\GiftItemValue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\DealLocation;
use App\Models\ItemServiceLocation;
use App\Models\MerchantLocation;
use App\Models\State;
use App\Models\Title;
use App\Models\User;
use App\Models\Events;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\LoyaltyProgramItem;
use App\Models\MerchantLoyaltyProgram;
use App\Models\LoyaltyRewardLocation;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BusinessOwnerAccountController extends Controller
{
    public function Account()
    {

        // dd(Auth::user()->merchantBusiness); 
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
        if ($deal) {
            $deallocation = Deallocation::where('deal_id', $deal->id)->delete();
            $deal->delete();
        }
       
        $category_id = Auth::user()->merchantBusiness->business_category_id;

        $merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get();
       
        $item = ItemOrService::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('status', 1)->whereIn('added_by', array(1, Auth::user()->id))->get();
        $itemGet = ItemOrService::where('business_category_id', $category_id)->first();
        $dealManage = Deal::where('business_id', Auth::user()->business_id)->where('is_complete', 1)->get();
        //dd(count($dealManage));
        $managertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $getmanager = User::where('business_id', Auth::user()->business_id)->role('MERCHANT')->whereIn('title_id', $managertitle)->where('active', 1)->get();

        $usertitle = Title::where('title_name', 'Associate')->first();
        $getuser = User::where('business_id', Auth::user()->business_id)->role('MERCHANT')->whereIn('title_id', $usertitle)->where('active', 1)->get();

        $business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type','Participating')->get();
        $stateList = State::get();
        // $dealManage = Deal::where('business_id', Auth::user()->business_id)->where('is_complete', 1)->get();

        $loyaltyManage = MerchantLoyaltyProgram::with('loyaltylocations')->where('merchant_id',Auth::user()->id)->get();
        //MOBILE BUSINESS
        // $is_mobile_business = Auth::user()->merchantBusiness->no_physical_address;
        $is_mobile_business = 0;
        $today = Carbon::today()->toDateString(); 
        $active_event = Events::with('states')
                 ->where('event_end_date', '>=', $today)
                 ->where('event_start_date', '<=', $today)
                 ->where('business_id',Auth::user()->merchantBusiness->id)
                 ->get();
        // dd($active_event[0]->states);

        // dd($is_mobile_business);

       
        return view('frontend.merchant_owner.account', compact('dealManage', 'item', 'itemGet', 'getmanager', 'getuser', 'stateList', 'merchant_location','loyaltyManage', 'business_locations', 'is_mobile_business','active_event'));
    }




    public function previewDeal(Request $request)
    {
        if ($request->ajax()) {
            $previewDeal = Deal::with('dealLocation','dealLocation.location','dealLocation.location.states')->find($request->deal_Id);
            $photos = Media::where(['model_id' => $previewDeal->id, 'collection_name' => 'dealPhotos'])->get();
            $business_id = $previewDeal->business_id;
            $business_location = BusinessLocation::with('states')->where('business_profile_id',$business_id)->where('status',1)->where('participating_type','Participating')->get();
            if ($photos) {
                $photos = $photos;
            } else {
                $photos = NULL;
            }
            return response()->json(['success' => 1, 'data' => $previewDeal, 'photos' => $photos, 'locations' => $business_location ]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    // public function descriptionUPdate(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $updateDescription = Deal::find($request->description_Id);
    //         // dd($previewDeal);
    //         return response()->json(['success' => 1, 'data' => $updateDescription, 'id' =>$request->description_Id ]);
    //     } else {
    //         return response()->json(['success' => 0]);
    //     }
    // }

    public function descriptionEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->description]);
            $editDescription = Deal::find($request->description_Id);
            $editDescription->suggested_description = $request->description;
            $editDescription->update();
            return response()->json(['success' => 1, 'data' => $editDescription]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function dealPriceEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->description]);
            $editPrice = Deal::find($request->price_Id);
            $editPrice->sales_amount = $request->price;
            $editPrice->update();
            return response()->json(['success' => 1, 'data' => $editPrice]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function dealDiscountEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->discountType]);
            $editDiscountType = Deal::find($request->discountType_Id);
            $editDiscountType->discount_type = $request->discountType;
            $editDiscountType->update();
            return response()->json(['success' => 1, 'data' => $editDiscountType]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function dealDiscountAmountEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->description]);
            $editDiscounAmount = Deal::find($request->discountAmount_Id);
            $editDiscounAmount->discount_amount = $request->discountAmount;
            $editDiscounAmount->update();
            return response()->json(['success' => 1, 'data' => $editDiscounAmount]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function dealPointEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->description]);
            $editPoint = Deal::find($request->point_id);
            $editPoint->point = $request->point;
            $editPoint->update();
            return response()->json(['success' => 1, 'data' => $editPoint]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function dealVoucherEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->voucher]);
            $editVoucher = Deal::find($request->voucher_id);
            $editVoucher->voucher_number = $request->voucher;
            $editVoucher->update();
            return response()->json(['success' => 1, 'data' => $editVoucher]);
        } else {
            return response()->json(['success' => 0]);
        }
    }


    public function dealDateEdit(Request $request)
    {
        if ($request->ajax()) {
            // return response()->json(['success' => $request->end_date]);
            $editdate = Deal::find($request->date_id);

            if ($request->start_date != '') {
                $endDate =  date('Y-m-d', strtotime('+30 days', strtotime($request->start_date)));
                if ($request->end_date >= $endDate) {
                    $editdate->end_Date = $request->end_date;
                    $editdate->update();
                } else {
                    return response()->json(['success' => 0, 'message' => 'The End Date can not be less than 30 days from start date']);
                }
            }
            return response()->json(['success' => 1, 'data' => $editdate]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function saveItem(Request $request)
    {
        if ($request->ajax()) {
           
            if ($request->item_name != '') {
                $itemService = new ItemOrService;
                $itemService->item_name = $request->item_name;
                $itemService->business_category_id = Auth::user()->merchantBusiness->business_category_id;
                if ($request->note != '') {
                    $itemService->note = $request->note;
                }
                $itemService->merchant_id = Auth::user()->id;
                $itemService->added_by = Auth::user()->id;
                $itemService->save();
                if ($request->value != '') {
                    $itemvalue = new GiftItemValue;
                    $itemvalue->item_id = $itemService->id;
                    $itemvalue->price = $request->value;
                    $itemvalue->merchant_id = Auth::user()->id;
                    $itemvalue->save();
                }
                if (is_array($request->location_ids)) {
                    for ($i = 0; $i < count($request->location_ids); $i++) {
                      
                        $itemlocation = new ItemServiceLocation();
                        $itemlocation->item_id = $itemService->id;
                        $itemlocation->location_id = $request->location_ids[$i];
                        $itemlocation->merchant_id = Auth::user()->id;
                        $itemlocation->status = 1;
                        $itemlocation->save();
                    }
                }
                if ($itemService) {
                    return response()->json(['success' => 1]);
                } else {
                    return response()->json(['success' => 0]);
                }
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function saveItemGift(Request $request)
    {
        if ($request->ajax()) {
            $is_save = GiftManage::where('item_id', $request->item_Id)->first();
            if (!$is_save) {
                $getItem = ItemOrService::find($request->item_Id);
                if ($getItem) {
                    $addGift = new GiftManage();
                    $addGift->gift_name = $getItem->item_name;
                    $addGift->gift_value = $getItem->item_value;
                    $addGift->note = $getItem->note;
                    $addGift->item_id = $request->item_Id;
                    $addGift->business_category_id = $getItem->business_category_id;
                    $addGift->merchant_id = Auth::user()->id;
                    $addGift->save();
                    $getItem->is_checked = 1;
                    $getItem->save();
                }
                return response()->json(['success' => 1, 'data' => $getItem]);
            } else {
                return response()->json(['success' => 0]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function unsaveItemGift(Request $request)
    {
        if ($request->ajax()) {
            $getItem = ItemOrService::find($request->item_Id);
            $unsaveGift = GiftManage::where('item_id', $request->item_Id)->where('merchant_id', Auth::user()->id)->first();
            if ($unsaveGift) {
                $unsaveGift->delete();
                $getItem->is_checked = 0;
                $getItem->save();
            }
            return response()->json(['success' => 1, 'data' => $unsaveGift]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function removeItem(Request $request)
    {
        if ($request->ajax()) {
            $removeItem = ItemOrService::find($request->item_remove);
            if ($removeItem) {
                $removeItem->status = 0;
                $removeItem->is_checked = 0;
                $removeItem->save();
            }
            return response()->json(['success' => 1, 'data' => $removeItem]);
        } else {
            return response()->json(['success' => 0]);
        }
    }
    public function viewItem(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $viewValue = GiftItemValue::where('item_id', $request->value)->where('merchant_id', Auth::user()->id)->first();
                if ($viewValue) {
                    return response()->json(['success' => 1, 'data' => $viewValue]);
                } else {
                    return response()->json(['success' => 0]);
                }
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    public function readdItem(Request $request)
    {
        if ($request->ajax()) {
            $readdItem = ItemOrService::find($request->item_readd);
            if ($readdItem) {
                $readdItem->status = 1;
                $readdItem->save();
            }
            return response()->json(['success' => 1, 'data' => $readdItem]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function editItem(Request $request, $id)
    {
        if ($request->ajax()) {
            $editItem = ItemOrService::find($request->item_edit);
            if ($editItem) {
                return response()->json(['success' => 1, 'data' => $editItem]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function updateItem(Request $request, $id)
    {
        if ($request->ajax()) {
            $itemService = ItemOrService::find($id);
            // return response()->json(['data' => $itemService ]);
            $itemService->item_name = $request->item_name;
            $itemService->business_category_id = Auth::user()->merchantBusiness->business_category_id;
            if ($request->note != '') {
                $itemService->note = $request->note;
            }
            $itemService->save();
            if ($request->value) {
                $is_value = GiftItemValue::where('merchant_id', auth()->user()->id)->where('item_id', $id)->first();
                if ($is_value) {
                    $is_value->price = $request->value;
                    $is_value->save();
                } else {
                    $itemprice = new GiftItemValue;
                    $itemprice->item_id = $id;
                    $itemprice->price = $request->value;
                    $itemprice->merchant_id = Auth::user()->id;
                    $itemprice->save();
                }
            }
            if ($itemService) {
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }
    // public function filterAllItem(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $filterAll = ItemOrService::pluck('id','item_name');
    //         if ($filterAll) {
    //             return response()->json(['success' => 1, 'data' => $filterAll]);
    //         } else {
    //             return response()->json(['success' => 0]);
    //         }
    //     }
    // }

    public function filterItemService(Request $request)
    {
        if ($request->ajax()) {
            // $ids = array();
            // array_push($ids,array(1,Auth::user()->id));
            //return response()->json(['success' => $ids]);
            if ($request->status == 'Active') {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $activeitems = ItemOrService::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('status', 1)->whereIn('added_by', array(1, Auth::user()->id))->get();
                if (count($activeitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $activeitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            } else if ($request->status == 'Inactive') {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $inactiveitems = ItemOrService::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('status', 0)->whereIn('added_by', array(1, Auth::user()->id))->get();
                if (count($inactiveitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $inactiveitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            } else {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $allitems = ItemOrService::where('business_category_id', $category_id)->orderBy('id', 'desc')->whereIn('added_by', array(1, Auth::user()->id))->get();
                if (count($allitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $allitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            }
        }
    }

    public function addItemValue(Request $request)
    {
        if ($request->ajax()) {
            $itemprice = new GiftItemValue;
            $itemprice->item_id = $request->itemid;
            $itemprice->price = $request->price;
            $itemprice->merchant_id = Auth::user()->id;
            $itemprice->save();
            if ($itemprice) {
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    public function changeUserPassword(Request $request)
    {
        if ($request->ajax()) {
            if ($request->new_password != '') {
                if ($request->confirm_password != '') {
                    if ($request->confirm_password != $request->new_password) {
                        return response()->json(['status' => 0]);
                    } else {
                        $userid = Auth::user()->id;
                        $user = User::find($userid);
                        $user->password = $request->new_password;
                        $user->created_password = '';
                        $user->remember_token = '';
                        $user->save();
                        $details = [
                            'password' => $request->new_password,
                            'name' => Auth::user()->full_name,
                        ];
                        Mail::to(Auth::user()->email)->queue(new ResetPasswordMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 4]);
                        }
                    }
                } else {
                    return response()->json(['status' => 2]);
                }
            } else {
                return response()->json(['status' => 3]);
            }
        }
    }

    public function addNewParticipatingLocation(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {

            if ($request->manager_id != '') {
                if ($request->location_name != '') {
                    if ($request->location_phone != '') {
                        // return response()->json(["status" => '1232',]);
                        $validator  =   Validator::make($request->all(), [
                            "location_phone"  =>  "numeric|unique:business_locations,business_phone"
                        ]);
                        if ($validator->fails()) {
                            return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                        } else {
                            //return response()->json(["status" => '1232']);
                            if ($request->location_website != '') {
                                $validator  =   Validator::make($request->all(), [
                                    "location_website" => 'url',
                                ]);
                                if ($validator->fails()) {
                                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                                }
                            }
                            if ($request->location_email != '') {
                                $validator  =   Validator::make($request->all(), [
                                    "location_email" => 'email|unique:business_locations,business_email',
                                ]);
                                if ($validator->fails()) {
                                    return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                                }
                            }
                            if ($request->address != '') {
                                if ($request->zip_code != '') {
                                    if ($request->city != '') {
                                        if ($request->state != '') {
                                            $getstate = State::where('name',$request->state)->first();
                                            if($getstate){
                                                $stateid = $getstate->id;
                                            }
                                            else{
                                                $stateid = '';
                                            }

                                            if($request->location_latitude){
                                                $lat = $request->location_latitude;
                                            }else{
                                                $lat = null;
                                            }
                                            if($request->location_longitude){
                                                $long = $request->location_longitude;
                                            }else{
                                                $long = null;
                                            }
                                            $locationdata = array(
                                                'business_profile_id' => Auth::user()->business_id,
                                                'location_name' => $request->location_name,
                                                'business_phone' => $request->location_phone,
                                                'business_fax_number' => $request->location_website,
                                                'business_email' => $request->location_email,
                                                'address' => $request->address,
                                                'zip_code' => $request->zip_code,
                                                'city' => $request->city,
                                                'state_id' => $stateid,
                                                'state' => $request->state,
                                                'participating_type' => 'Participating',
                                                'latitude'=>$lat,
                                                'longitude'=>$long,
                                            );
                                            $location = BusinessLocation::create($locationdata);
                                            $locationid = strtoupper(substr($location->business->business_name,0,3)).'/'.strtoupper(substr($location->location_name,0,3)).'/0'.$location->id;
                                            $location->locationId = $locationid;
                                            $location->save();

                                            $merchant_location = new MerchantLocation();
                                            $merchant_location->user_id = $request->manager_id;
                                            $merchant_location->location_id = $location->id;
                                            $merchant_location->status = true;
                                            $merchant_location->is_main = false;
                                            $merchant_location->save();

                                            if($request->associate_user_id != ''){
                                                $merchant_location = new MerchantLocation();
                                                $merchant_location->user_id = $request->associate_user_id;
                                                $merchant_location->location_id = $location->id;
                                                $merchant_location->status = true;
                                                $merchant_location->is_main = false;
                                                $merchant_location->save();
                                            }
                                            if($location){
                                                return response()->json(["status" => 10, "message" => 'Business Location save']);
                                            } else{
                                                return response()->json(["status" => 11, "message" => 'Something Wrong']);
                                            }

                                        } else {
                                                return response()->json(["status" => 3, "message" => 'State field is required']);
                                        }
                                    } else {
                                        return response()->json(["status" => 4, "message" => 'City field is required']);
                                    }
                                } else {
                                    return response()->json(["status" => 5, "message" => 'Zip Code field is required']);
                                }
                            } else {
                                return response()->json(["status" => 6, "message" => 'Address field is required']);
                            }
                        }
                    } else {
                        return response()->json(["status" => 7, "message" => 'Location phone field is required']);
                    }
                } else {
                    return response()->json(["status" => 8, "message" => 'Location name field is required']);
                }
            } else {
                return response()->json(["status" => 9, "message" => 'Please select one manager']);
            }
        }
    }

    public function getParticipatingLocation(Request $request){
        if($request->ajax()){
            $userids = array();
            $location = BusinessLocation::with('merchantLocation')->find($request->edit_location_id);
            if($location){
                if(count($location->location_manager) > 0 ){
                    foreach($location->location_manager as $manager){
                        array_push($userids,$manager->user_id);
                    }

                }
                if(count($location->location_associate) > 0 ){
                    foreach($location->location_associate as $associate){
                        array_push($userids,$associate->user_id);
                    }

                }
                $business_id = $location->business_profile_id;
                $anotheruser = User::whereNotIn('id',$userids)->where('active',1)->where('business_id',$business_id)->role('MERCHANT')->get();
                return response()->json(["status" => 1, "data" => $location, "users" => $anotheruser]);
            }
            else{
                return response()->json(["status" => 0, "message" => 'Location not found']);
            }
        }
    }

    public function addLocationUser(Request $request){
        if($request->ajax()){
           // return response()->json(["status" =>$request->location_id]);
            if($request->location_id != ''){
                if($request->userid != ''){
                    $merchant_location = new MerchantLocation();
                    $merchant_location->user_id = $request->userid;
                    $merchant_location->location_id = $request->location_id;
                    $merchant_location->status = true;
                    $merchant_location->is_main = false;
                    $merchant_location->save();
                    if($merchant_location){
                        $location = BusinessLocation::with('merchantLocation')->where('id', $request->location_id)->first();
                        return response()->json(["status" => 1, "message" => 'User added successfully','data' => $location]);
                    }
                    else{
                        return response()->json(["status" => 0, "message" => 'User not added']);
                    }
                }
                else{
                    return response()->json(["status" => 2, "message" => 'User not found']);
                }
            }
            else{
                return response()->json(["status" => 3, "message" => 'Location not found']);
            }
        }
    }

    public function updateParticipatingLocation(Request $request){
        // dd($request->all());
        if ($request->ajax()) {
            $location = BusinessLocation::find($request->edit_location_id);

            if ($request->edit_location_name != '') {
                if ($request->edit_location_phone != '') {
                    // return response()->json(["status" => '1232',]);
                    $validator  =   Validator::make($request->all(), [
                        "edit_location_phone"  =>  "numeric|unique:business_locations,business_phone,".$location->id,
                    ],
                    ["edit_location_phone.numeric" => "Phone number must be number",
                    "edit_location_phone.unique" => "Phone number has already been taken",]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        //return response()->json(["status" => '1232']);
                        if ($request->edit_location_website != '') {
                            $validator  =   Validator::make($request->all(), [
                                "edit_location_website" => 'url',
                            ],
                            ["edit_location_website.url" => "Business location website must be a valid URL"]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->edit_location_email != '') {
                            $validator  =   Validator::make($request->all(), [
                                "edit_location_email" => 'email|unique:business_locations,business_email,'.$location->id,
                            ],
                            ["edit_location_email.email" => "Email address should be valid email",
                            "edit_location_email.unique" => "Email address has already been taken.",]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->edit_address != '') {
                            if ($request->edit_zip_code != '') {
                                if ($request->edit_city != '') {
                                    if ($request->edit_state != '') {
                                        
                                        $getstate = State::where('name',$request->edit_state)->first();
                                            if($getstate){
                                                $stateid = $getstate->id;
                                            }
                                            else{
                                                $stateid = '';
                                            }
                                        $business_location = BusinessLocation::find($request->edit_location_id);
                                        $business_location->business_profile_id = Auth::user()->business_id;
                                        $business_location->location_name = $request->edit_location_name;
                                        $business_location->business_phone = $request->edit_location_phone;
                                        $business_location->business_fax_number = $request->edit_location_website;
                                        $business_location->business_email = $request->edit_location_email;
                                        $business_location->address = $request->edit_address;
                                        if($request->latitude){
                                            $business_location->latitude = $request->latitude;
                                        }
                                        if($request->longitude){
                                            $business_location->longitude = $request->longitude;
                                        }
                                        $business_location->zip_code = $request->edit_zip_code;
                                        $business_location->city = $request->edit_city;
                                        $business_location->state_id = $stateid;
                                        $business_location->state = $request->edit_state;
                                        $business_location->save();
                                        if($business_location){
                                            return response()->json(["status" => 10, "message" => 'Business Location updated']);
                                        } else{
                                            return response()->json(["status" => 11, "message" => 'Something Wrong']);
                                        }

                                    } else {
                                            return response()->json(["status" => 3, "message" => 'State field is required']);
                                    }
                                } else {
                                    return response()->json(["status" => 4, "message" => 'City field is required']);
                                }
                            } else {
                                return response()->json(["status" => 5, "message" => 'Zip Code field is required']);
                            }
                        } else {
                            return response()->json(["status" => 6, "message" => 'Address field is required']);
                        }
                    }
                } else {
                    return response()->json(["status" => 7, "message" => 'Location phone field is required']);
                }
            } else {
                return response()->json(["status" => 8, "message" => 'Location name field is required']);
            }

        }
    }

    public function updateDealVoucher(Request $request){
        if($request->ajax()){
            if($request->deal_id != ''){
                $deal = Deal::find($request->deal_id);
                if($deal){
                    if($request->split == 'yes'){
                        $deal->is_split = 1;
                    }
                    else{
                        $deal->is_split = 0;
                    }
                    $deal->save();
                    return response()->json(["status" => 1, "message" => 'deal update']);
                }
                else{
                    return response()->json(["status" => 0, "message" => 'deal not found']);
                }
            }
            else{
                return response()->json(["status" => 0, "message" => 'deal not found']);
            }
        }
    }

    public function removeLocationAccess(Request $request){
        if($request->ajax()){
            if($request->location_id != ''){
                if($request->userid != ''){
                    $location = BusinessLocation::find($request->location_id);
                    $merchant_location = MerchantLocation::where('location_id', $location->id)->where('user_id',$request->userid)->first();
                    //return response()->json(["status" => $merchant_location]);
                    if($merchant_location){
                        $merchant_location->delete();
                        return response()->json(["status" => 1, "message" => 'removed access']);
                    }
                    else{
                        return response()->json(["status" => 0, "message" => 'location not found']);

                    }
                }
            }
        }
    }

    public function updateLocationAccessForDeal(Request $request){
        if($request->ajax()){
            $business_id = Auth::user()->business_id;
            if($request->location_id != ''){
                if($request->deal_id != ''){
                    if($request->checked == 'yes'){
                        $deal_location = new DealLocation;
                        $deal_location->deal_id = $request->deal_id;
                        $deal_location->location_id = $request->location_id;
                        $deal_location->participating_type = 'Participating';
                        $deal_location->status = 1;
                        $deal_location->save();
                        
                        $business_location_count = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('participating_type','Participating')->count();
                        $deal_location_count = DealLocation::where('deal_id',$request->deal_id)->count();
                        if($business_location_count == $deal_location_count){
                            return response()->json(["status" => 1, "message" => 'add access', "all_location" => 1]);
                        }
                        else{
                            return response()->json(["status" => 1, "message" => 'add access', "all_location" => 0]);
                        }
                        
                    }
                    else{
                        $deal_location_count = DealLocation::where('deal_id',$request->deal_id)->count();
                        if($deal_location_count == 1){
                            return response()->json(["status" => 3, "message" => 'can not remove access', "all_location" => 0]);
                        }
                        else{
                            $deal_location = DealLocation::where('location_id',$request->location_id)->where('deal_id',$request->deal_id)->first();
                            $deal_location->delete();
                            $business_location_count = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('participating_type','Participating')->count();
                            if($business_location_count == $deal_location_count){
                                return response()->json(["status" => 1, "message" => 'remove access', "all_location" => 0]);
                            }
                            else{
                                return response()->json(["status" => 1, "message" => 'remove access', "all_location" => 0]);
                            }
                        }
                    }
                }
                else{
                    return response()->json(["status" => 0, "message" => 'deal not found']);
                }
            }
            else{
                return response()->json(["status" => 2, "message" => 'location not found']);
            }
        }
    }

   


    public function getLoyaltyProgram(Request $request){
        if($request->ajax()){
           $loyalty_program = MerchantLoyaltyProgram::with('loyaltylocations')->find($request->program_id);
           if($loyalty_program){
            $business_id = Auth::user()->business_id;
            $business_location = BusinessLocation::with('states')->where('business_profile_id',$business_id)->where('status',1)->get();
              return response()->json(["success" => 1, 'data' => $loyalty_program, 'locations' => $business_location]);
           }
           else{
             return response()->json(["success" => 0]);
           }
        }
    }
    public function merchantBusinessLocation(Request $request){
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

    public function updateLocationAccessForReward(Request $request){
        if($request->ajax()){
            $business_id = Auth::user()->business_id;
            if($request->location_id != ''){
                if($request->reward_id != ''){
                    if($request->checked == 'yes'){
                        $reward_location = new LoyaltyRewardLocation;
                        $reward_location->loyalty_program_id = $request->reward_id;
                        $reward_location->location_id = $request->location_id;
                        $reward_location->status = 1;
                        $reward_location->save();
                        
                        $business_location_count = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('participating_type','Participating')->count();
                        $reward_location_count = LoyaltyRewardLocation::where('loyalty_program_id',$request->reward_id)->count();
                        if($business_location_count == $reward_location_count){
                            return response()->json(["status" => 1, "message" => 'add access', "all_location" => 1]);
                        }
                        else{
                            return response()->json(["status" => 1, "message" => 'add access', "all_location" => 0]);
                        }
                        
                    }
                    else{
                        $reward_location_count = LoyaltyRewardLocation::where('loyalty_program_id',$request->reward_id)->count();
                        if($reward_location_count == 1){
                            return response()->json(["status" => 3, "message" => 'can not remove access', "all_location" => 0]);

                        }
                        else{
                            $reward_location = LoyaltyRewardLocation::where('location_id',$request->location_id)->where('loyalty_program_id',$request->reward_id)->first();
                            $reward_location->delete();
                            $business_location_count = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('participating_type','Participating')->count();
                            if($business_location_count == $reward_location_count){
                                return response()->json(["status" => 1, "message" => 'remove access', "all_location" => 0]);
                            }
                            else{
                                return response()->json(["status" => 1, "message" => 'remove access', "all_location" => 0]);
                            }
                        }
                        
                    }
                }
                else{
                    return response()->json(["status" => 0, "message" => 'reward program not found']);
                }
            }
            else{
                return response()->json(["status" => 2, "message" => 'location not found']);
            }
        }
    }

    public function updateAllLocationAccessForDeal(Request $request){
        if($request->ajax()){
            if($request->deal_id != ''){
                if($request->checked == 'yes'){
                    $deal_location_ids = DealLocation::where('deal_id',$request->deal_id)->where('status',1)->pluck('location_id')->toArray();
                    
                    if(count($deal_location_ids) > 0){
                        $business_id = Auth::user()->business_id;
                        $business_location = BusinessLocation::where('business_profile_id',$business_id)->where('participating_type','Participating')->whereNotIn('id',$deal_location_ids)->get();
                        if(count($business_location) > 0){
                            foreach($business_location as $locations){
                                $deal_location = new DealLocation;
                                $deal_location->deal_id = $request->deal_id;
                                $deal_location->location_id = $locations->id;
                                $deal_location->participating_type = 'Participating';
                                $deal_location->status = 1;
                                $deal_location->save();
                            }
                                                      
                            return response()->json(["success" => 1]); 
                        }
                        else{
                            return response()->json(["success" => 0]);
                        }
                    }
                    else{
                        return response()->json(["success" => 0]);
                    }
                    
                }
                else{

                }
            }
            else{
                return response()->json(["success" => 0]);
            }
        }
    }

    public function updateAllLocationAccessForReward(Request $request){
        if($request->ajax()){
            if($request->reward_id != ''){
                if($request->checked == 'yes'){
                    $reward_location_ids = LoyaltyRewardLocation::where('loyalty_program_id',$request->reward_id)->where('status',1)->pluck('location_id')->toArray();
                    
                    if(count($reward_location_ids) > 0){
                        $business_id = Auth::user()->business_id;
                        $business_location = BusinessLocation::where('business_profile_id',$business_id)->where('participating_type','Participating')->whereNotIn('id',$reward_location_ids)->get();
                        if(count($business_location) > 0){
                            foreach($business_location as $locations){
                                $reward_location = new LoyaltyRewardLocation;
                                $reward_location->loyalty_program_id = $request->reward_id;
                                $reward_location->location_id = $locations->id;
                                $reward_location->status = 1;
                                $reward_location->save();
                            }
                                                      
                            return response()->json(["success" => 1]); 
                        }
                        else{
                            return response()->json(["success" => 0]);
                        }
                    }
                    else{
                        return response()->json(["success" => 0]);
                    }
                    
                }
                else{

                }
            }
            else{
                return response()->json(["success" => 0]);
            }
        }
        
    }


    public function getDealLocation(Request $request){
        if($request->ajax()){
            $deal = Deal::find($request->deal_id);
            $deal_location = DealLocation::with('deal', 'location')->where('deal_id',$request->deal_id)->where('status',1)->get();
            
            if(count($deal_location) > 0){
                $locationids = $deal_location->pluck('location_id');
                $otherLocation = BusinessLocation::where('business_profile_id',Auth::user()->business_id)->whereNotIn('id',$locationids)->where('status',1)->get();
                return response()->json(["success" => 1, "data" => $deal_location , "other_location" => $otherLocation,"deal" => $deal, "message" => "Location fetched"]);
            }else{
                return response()->json(["success" => 0, 'message' => "No location found"]); 
            }
        }
    }

    public function setDealEndDate(Request $request){
        if($request->ajax()){

            $deal = Deal::find($request->dealid);
            if($request->extend_type == 'schedule'){
                $showstartdate = date_format(date_create($deal->start_Date),'m/d/Y');
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "schedule_end_date"  =>  'required|after:'.$showstartdate,
                    ],
                    [
                        "schedule_end_date.required" => 'The end date is required',
                        "schedule_end_date.after" => 'The end date must be a date after ' . $showstartdate
                    ]
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                }
                else{
                    $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y',$request->schedule_end_date)->format('Y-m-d');
                    $deal->end_Date = $enddate;
                    $deal->save();
                    return response()->json(['status' => 1, 'data' => $deal]);
                }
            }
            elseif($request->extend_type == 'enddate'){
                $showstartdate = date_format(date_create($deal->start_Date),'m/d/Y');
                if($request->schedule_end_date < $showstartdate){
                    return response()->json(['status' => 0, 'message' => 'End date may be after '.$showstartdate]);
                }
                else{
                    $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y',$request->schedule_end_date)->format('Y-m-d');
                    $deal->end_Date = $enddate;
                    $deal->save();
                    return response()->json(['status' => 1, 'data' => $deal]);
                }
            }
            elseif($request->extend_type == 'extend'){
                $showstartdate = date_format(date_create($deal->start_Date),'m/d/Y');
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "schedule_end_date"  =>  'required|after:'.$showstartdate,
                    ],
                    [
                        "schedule_end_date.required" => 'The end date is required',
                        "schedule_end_date.after" => 'The end date must be a date after ' . $showstartdate
                    ]
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                }
                else{
                    $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y',$request->schedule_end_date)->format('Y-m-d');
                    $deal->end_Date = $enddate;
                    $deal->save();
                    return response()->json(['status' => 1, 'data' => $deal]);
                }
            }
            
        
        }

    }



    public function campaignManagement(){
        return view('frontend.merchant_owner.campaign.management');
    }

    public function createCampaign(){
        return view('frontend.merchant_owner.campaign.create');
    }


    public function businessReport(){
        return view('frontend.merchant_owner.report.create');
    }

    public function saveEvent(Request $request){
        dd($request->all());
    }
    

}
