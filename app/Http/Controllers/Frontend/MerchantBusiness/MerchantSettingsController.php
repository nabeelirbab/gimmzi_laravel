<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\DisplayBoard;
use App\Models\Title;
use App\Models\User;
use App\Models\MerchantDisplayBoard;
use App\Models\DisplayDay;
use App\Models\GiftItemValue;
use App\Models\ItemOrService;
use App\Models\ItemServiceLocation;
use App\Models\MerchantLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Models\Media;
use App\Models\MerchantExternalManage;
use App\Models\LoyaltyRewardLocation;
use Facade\FlareClient\Http\Response;
use Repsonse;
use App\Models\MerchantHoursOperation;
use App\Models\HoursOperationTime;


class MerchantSettingsController extends Controller
{
    public function CorporateSetting()
    {
        $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $location = MerchantLocation::where('user_id',Auth::user()->id)->where('is_main',1)->first();
        //dd($location);
        $getusers = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
            $query->with('title')->where('active', 1)->whereIn('title_id', $usertitle); })->where('location_id',$location->location_id)->get();
          //  dd($getusers);
        $displayboard = DisplayBoard::get();
        $merchant_board = MerchantDisplayBoard::where('business_id', Auth::user()->business_id)->first();
        $adduser = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
            $query->with('title')->where('active', 0)->whereIn('title_id', $usertitle); })->where('location_id',$location->location_id)->get();
        $merchant_location = MerchantLocation::with('businessLocation.states', 'merchantUser')->where('user_id', Auth::user()->id)->get();
        $business_locations = BusinessLocation::with('states')->where('business_profile_id', Auth::user()->business_id)->where('status', 1)->get();

        return view('frontend.merchant_owner.settings.corporate-lead-setting', compact('getusers', 'displayboard', 'adduser', 'merchant_board', 'merchant_location', 'business_locations', 'location'));
    }

    public function getRemoveMerchantUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userId);
            if ($user) {
                return response()->json(['success' => 1, 'data' => $user]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function removeMerchantUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userRemove);
            if ($user) {
                $user->active = 0;
                $user->save();
                $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
                $getusers = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                    $query->with('title')->where('active', 1)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                $adduser = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                    $query->with('title')->where('active', 0)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                return response()->json(['success' => 1, 'data' => $adduser , 'users' => $getusers]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function getDispalyBoard(Request $request)
    {
        if ($request->ajax()) {

            $getboard = DisplayBoard::find($request->board_id);

            if ($getboard) {
                return response()->json(['success' => 1, 'board' => $getboard]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function getMerchantBoard()
    {
        $businessid = Auth::user()->business_id;
        $display_board = MerchantDisplayBoard::with('board')->where('business_id', $businessid)->first();
        if ($display_board) {
            return response()->json(['success' => 1, 'data' => $display_board]);
        } else {
            return response()->json(['success' => 0]);
        }
    }


    public function selectMerchantUser(Request $request)
    {
        if ($request->ajax()) {
            $add = User::find($request->userid);
            if ($add) {
                return response()->json(['success' => 1, 'data' => $add]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function addMerchantUser(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $adduser = User::find($request->user);
            if ($adduser) {
                $adduser->active = 1;
                $adduser->save();
                $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
                // $location = MerchantLocation::where('user_id',Auth::user()->id)->where('is_main',1)->first();
                $getusers = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                    $query->with('title')->where('active', 1)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                    $adduser = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                        $query->with('title')->where('active', 0)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                return response()->json(['success' => 1, 'data' => $getusers, 'user' => $user, 'adduser' => $adduser]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function saveMerchantBoard(Request $request)
    {
        if ($request->ajax()) {
            if ($request->description != '') {
                if ($request->daysArray) {

                    if (count($request->daysArray) > 0) {
                        $businessid = Auth::user()->business_id;
                        $display_board = MerchantDisplayBoard::where('business_id', $businessid)->first();
                        if ($display_board) {
                            if ($display_board->display_board_id == $request->board_id) {
                                $display_board->display_board_id = $request->board_id;
                                $display_board->description = $request->description;
                                $display_board->change_by = Auth::user()->id;
                                $display_board->save();
                                $existdays = DisplayDay::where('merchant_board_id', $display_board->id)->where('display_board_id', $request->board_id)->get();
                                if ($existdays) {
                                    foreach ($existdays as $data) {
                                        if (!in_array($data->days, $request->daysArray)) {
                                            $displatdata = DisplayDay::find($data->id);
                                            $displatdata->delete();
                                        }
                                    }
                                }
                                foreach ($request->daysArray as $days) {

                                    if ($days == 'everyday') {
                                        $everydaydisplay = DisplayDay::where('merchant_board_id', $display_board->id)->where('display_board_id', $request->board_id)->where('days', $days)->first();
                                        if ($everydaydisplay) {
                                            return response()->json(['status' => 3]);
                                        } else {
                                            $display = DisplayDay::where('merchant_board_id', $display_board->id)->where('display_board_id', $request->board_id)->get();
                                            if (count($display) > 0) {
                                                $display->each->delete();
                                            }
                                            $merchantdays =  new DisplayDay;
                                            $merchantdays->display_board_id = $request->board_id;
                                            $merchantdays->merchant_board_id = $display_board->id;
                                            $merchantdays->days = 'everyday';
                                            $merchantdays->save();
                                            return response()->json(['status' => 3]);
                                        }
                                    } else {
                                        $displayday = DisplayDay::where('merchant_board_id', $display_board->id)->where('display_board_id', $request->board_id)->where('days', $days)->first();
                                        if ($displayday) {
                                        } else {
                                            $merchantdays =  new DisplayDay;
                                            $merchantdays->display_board_id = $request->board_id;
                                            $merchantdays->merchant_board_id = $display_board->id;
                                            $merchantdays->days = $days;
                                            $merchantdays->save();
                                        }
                                    }
                                }
                                return response()->json(['status' => 3]);
                            } else {
                                $existdays = DisplayDay::where('merchant_board_id', $display_board->id)->where('display_board_id', $display_board->display_board_id)->get();
                                if ($existdays) {
                                    $existdays->each->delete();
                                }
                                $display_board->display_board_id = $request->board_id;
                                $display_board->description = $request->description;
                                $display_board->change_by = Auth::user()->id;
                                $display_board->save();

                                foreach ($request->daysArray as $days) {
                                    if ($days == 'everyday') {
                                        $merchantdays =  new DisplayDay;
                                        $merchantdays->display_board_id = $request->board_id;
                                        $merchantdays->merchant_board_id = $display_board->id;
                                        $merchantdays->days = 'everyday';
                                        $merchantdays->save();
                                        return response()->json(['status' => 3]);
                                    } else {
                                        $merchantdays =  new DisplayDay;
                                        $merchantdays->display_board_id = $request->board_id;
                                        $merchantdays->merchant_board_id = $display_board->id;
                                        $merchantdays->days = $days;
                                        $merchantdays->save();
                                    }
                                }
                                return response()->json(['status' => 3]);
                            }
                        } else {
                            $merchant_board = new MerchantDisplayBoard;
                            $merchant_board->display_board_id = $request->board_id;
                            $merchant_board->description = $request->description;
                            $merchant_board->change_by = Auth::user()->id;
                            $merchant_board->business_id = Auth::user()->business_id;
                            $merchant_board->save();
                            foreach ($request->daysArray as $days) {
                                if ($days == 'everyday') {
                                    $merchantdays =  new DisplayDay;
                                    $merchantdays->display_board_id = $request->board_id;
                                    $merchantdays->merchant_board_id = $merchant_board->id;
                                    $merchantdays->days = 'everyday';
                                    $merchantdays->save();
                                    return response()->json(['status' => 3]);
                                } else {
                                    $merchantdays =  new DisplayDay;
                                    $merchantdays->display_board_id = $request->board_id;
                                    $merchantdays->merchant_board_id = $merchant_board->id;
                                    $merchantdays->days = $days;
                                    $merchantdays->save();
                                }
                            }
                            return response()->json(['status' => 3]);
                        }
                    } else {
                        return response()->json(['status' => 1]);
                    }
                } else {
                    return response()->json(['status' => 1]);
                }
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function changeMerchantDisplayStatus(Request $request)
    {
        if ($request->ajax()) {
            $display_board = MerchantDisplayBoard::find($request->board_id);
            if ($display_board) {
                if ($request->value == 'true') {
                    $display_board->status = true;
                } else {
                    $display_board->status = false;
                }
                $display_board->save();
                return response()->json(['status' => 1]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function accountMerchantLocation(Request $request)
    {
        if ($request->ajax()) {
            $location = BusinessLocation::with('states')->find($request->location_id);
            $external_manage = MerchantExternalManage::where('location_id',$request->location_id)->first();
            $display_board = MerchantDisplayBoard::with('boardone','boardtwo')->where('location_id',$request->location_id)->first();
            $loyalty_reward = LoyaltyRewardLocation::with('loyaltyprogram')->where('location_id',$request->location_id)->get();
            if ($location) {
                return response()->json(["success" => 1, 'data' => $location,'external'=>$external_manage, 'message_board' => $display_board, 'loyalty_reward' => $loyalty_reward]);
            } else {
                return response()->json(["success" => 0]);
            }
        }
    }

    public function getDestinationlocation(Request $request)
    {
        if ($request->ajax()) {
            if ($request->location_id != '') {
                $business_locations = BusinessLocation::with('states')->where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('id', '!=', $request->location_id)->get();

                $getlocation = BusinessLocation::with('states')->where('id', $request->location_id)->first();
                // $get = ItemOrService::where('merchant_id', Auth::user()->id)->get();
                // return response()->json(['success' => $get]);

                $itemLocation = ItemServiceLocation::with('location.states', 'itemservice')->where('location_id', $request->location_id)->get();

                if ($itemLocation->isEmpty()) {
                    return response()->json(['success' => 3, 'message' => 'location not found', 'getlocation' => $getlocation]);
                }
                if ($business_locations) {
                    return response()->json(['success' => 1, 'data' => $business_locations, 'itemlocation' => $itemLocation, 'getlocation' => $getlocation]);
                } else {
                    return response()->json(['success' => 2, 'message' => 'location not found']);
                }
            } else {
                return response()->json(['success' => 0, 'message' => 'location not found']);
            }
        }
    }

    public function itemDestinationlocation(Request $request)
    {
        if ($request->ajax()) {
            if ($request->location_id != '') {
                $getlocation = BusinessLocation::with('states')->where('id', $request->location_id)->where('business_profile_id', Auth::user()->business_id)->first();

                $itemLocation = ItemServiceLocation::with('location.states', 'itemservice')->where('location_id', $request->location_id)->get();

                if ($getlocation) {
                    return response()->json(['success' => 1, 'data' => $getlocation, 'item' => $itemLocation]);
                } else {
                    return response()->json(['success' => 0, 'message' => 'location not found']);
                }
            }
        }
    }
    public function getItemCopy(Request $request)
    {
        if ($request->ajax()) {
            $itemLocation = ItemServiceLocation::with('itemservice', 'location')->whereIn('id', $request->item_ids)->get();
            if ($itemLocation) {
                return response()->json(['success' => 1, 'data' => $itemLocation]);
            } else {
                return response()->json(['success' => 0, 'message' => 'Item not found']);
            }
        }
    }
    public function storeCopyItem(Request $request)
    {
        if ($request->ajax()) {
            foreach ($request->item_ids as $item) {
                $itemLocation = ItemServiceLocation::where('item_id', $item)->where('location_id', $request->destination_id)->first();
                if (!$itemLocation) {
                    $newItem = new ItemServiceLocation();
                    $newItem->merchant_id = Auth::user()->id;
                    $newItem->location_id = $request->destination_id;
                    $newItem->item_id = $item;
                    $newItem->status = 1;
                    $newItem->save();
                }
            }
            return response()->json(['success' => 1, 'message' => 'Item saved']);
        }
    }

    public function getlocationSettings(Request $request){
        if($request->ajax()){
            $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
            $users = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                $query->with('title')->where('active', 1)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                if($users){
                    $available_users = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
                        $query->with('title')->where('active', 0)->whereIn('title_id', $usertitle); })->where('location_id',$request->location_id)->get();
                    return response()->json(['status' => 1, 'managers' => $users, 'available_managers' => $available_users]);
                }
            //$getusers = User::where('business_id', Auth::user()->business_id)->role('MERCHANT')->whereIn('title_id', $usertitle)->where('active', 1)->get();
        }
    }



    public function getMerchantDetail(Request $request){
        if($request->ajax()){
            $photos = array();
            $merchant = BusinessProfile::find($request->business_id);
            $merchant_logo = Media::where(['model_id' => $request->business_id, 'collection_name' => 'businessProfileLogo'])->first();
            if($merchant_logo){
                $merchant_logo = $merchant_logo->getUrl();
            }
            else{
                $merchant_logo = '';
            }
            $merchant_photos = Media::where(['model_id' => $request->business_id, 'collection_name' => 'businessProfilePhoto'])->get();
            if(count($merchant_photos) > 0){
                foreach($merchant_photos as $images){
                    array_push($photos,array('image' => $images->getUrl(),'id'=>$images->id));
                }
            }
            
            if($merchant){
                return response()->json(['status' => 1, 'message' => 'Merchant found','data'=>$merchant,'logo'=>$merchant_logo,'photos' => $photos]);
            }
            else{
                return response()->json(['status' => 0, 'message' => 'Merchant not found']);
            }
        }
    }





 




    public function getMerchantExternalManage(Request $request){
        if($request->ajax()){
            $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
            if($externalData){
                return response()->json(['status' => 1, 'data' => $externalData]);
            }
            else{
                return response()->json(['status' => 0]);
            }
        }
    }

    public function saveMerchantExternalManage(Request $request){
        if($request->ajax()){
            
            if($request->order_online_text != ''){
                $validator  =   Validator::make($request->all(), [
                    "order_online_text"  =>  "url"
                ],
                ['order_online_text.url' => 'Order Online URL format is invalid. Include http:// or https:// in front of URL, whichever is applicable']);
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                }
                else{
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $externalData->order_online_url = $request->order_online_text;
                        if($request->order_online_check != 0){
                            $externalData->order_online_display = 1;
                        }
                        else{
                            $externalData->order_online_display = 0;
                        }
                        $externalData->save();
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->order_online_url = $request->order_online_text;
                        if($request->order_online_check != 0){
                            $external_data->order_online_display = 1;
                        }
                        else{
                            $external_data->order_online_display = 0;
                        }
                        $external_data->save();
                    }
                }
            }
            else{
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                if($externalData){
                    $externalData->order_online_url = $request->order_online_text;
                    if($request->order_online_check != 0){
                        $externalData->order_online_display = 1;
                    }
                    else{
                        $externalData->order_online_display = 0;
                    }
                    $externalData->save();
                }
                else{
                    $external_data = new MerchantExternalManage;
                    $external_data->location_id = $request->location_id;
                    $external_data->order_online_url = $request->order_online_text;
                    if($request->order_online_check != 0){
                        $external_data->order_online_display = 1;
                    }
                    else{
                        $external_data->order_online_display = 0;
                    }
                    $external_data->save();
                }
            }

            if($request->carrers_text != ''){
                $validator  =   Validator::make($request->all(), [
                    "carrers_text"  =>  "url"
                ],
                ['carrers_text.url' => 'Careers URL format is invalid. Include http:// or https:// in front of URL, whichever is applicable']);
                if ($validator->fails()) {
                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                }
                else{
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $externalData->carrer_url = $request->carrers_text;
                        if($request->carrer_check != 0){
                            $externalData->carrer_display = 1;
                        }
                        else{
                            $externalData->carrer_display = 0;
                        }
                        $externalData->save();
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->carrer_url = $request->carrers_text;
                        if($request->carrer_check != 0){
                            $external_data->carrer_display = 1;
                        }
                        else{
                            $external_data->carrer_display = 0;
                        }
                        $external_data->save();
                    }
                }
            }
            else{
                  $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $externalData->carrer_url = $request->carrers_text;
                        if($request->carrer_check != 0){
                            $externalData->carrer_display = 1;
                        }
                        else{
                            $externalData->carrer_display = 0;
                        }
                        $externalData->save();
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->carrer_url = $request->carrers_text;
                        if($request->carrer_check != 0){
                            $external_data->carrer_display = 1;
                        }
                        else{
                            $external_data->carrer_display = 0;
                        }
                        $external_data->save();
                    }
            }

            if($request->visit_website_text != ''){
                $validator  =   Validator::make($request->all(), [
                    "visit_website_text"  =>  "url"
                ],
                ['visit_website_text.url' => 'Visit Direct Website URL format is invalid. Include Include http:// or https:// in front of URL, whichever is applicable']);
                if ($validator->fails()) {
                    return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                }
                else{
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $externalData->direct_website_url = $request->visit_website_text;
                        if($request->visit_website_check != 0){
                            $externalData->direct_website_display = 1;
                        }
                        else{
                            $externalData->direct_website_display = 0;
                        }
                        $externalData->save();
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->direct_website_url = $request->visit_website_text;
                        if($request->visit_website_check != 0){
                            $external_data->direct_website_display = 1;
                        }
                        else{
                            $external_data->direct_website_display = 0;
                        }
                        $external_data->save();
                    }
                }
            }
            else{
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $externalData->direct_website_url = $request->visit_website_text;
                        if($request->visit_website_check != 0){
                            $externalData->direct_website_display = 1;
                        }
                        else{
                            $externalData->direct_website_display = 0;
                        }
                        $externalData->save();
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->direct_website_url = $request->visit_website_text;
                        if($request->visit_website_check != 0){
                            $external_data->direct_website_display = 1;
                        }
                        else{
                            $external_data->direct_website_display = 0;
                        }
                        $external_data->save();
                    }
            }

            if($request->view_menu_check != 0){
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                if($externalData){
                    $externalData->view_menu_display = 1;
                    $externalData->save();
                }
                else{
                    $externalData = new MerchantExternalManage;
                    $externalData->location_id = $request->location_id;
                    $externalData->view_menu_display = 1;
                    $externalData->save();
                }
            }
            else{
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                if($externalData){
                    $externalData->view_menu_display = 0;
                    $externalData->save();
                }
                else{
                    $externalData = new MerchantExternalManage;
                    $externalData->location_id = $request->location_id;
                    $externalData->view_menu_display = 0;
                    $externalData->save();
                } 
            }
            if($request->flyer_check != 0){
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                if($externalData){
                    $externalData->view_flyer_display = 1;
                    $externalData->save();
                }
                else{
                    $externalData = new MerchantExternalManage;
                    $externalData->location_id = $request->location_id;
                    $externalData->view_flyer_display = 1;
                    $externalData->save();
                }
            }
            else{
                $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                if($externalData){
                    $externalData->view_flyer_display = 0;
                    $externalData->save();
                }
                else{
                    $externalData = new MerchantExternalManage;
                    $externalData->location_id = $request->location_id;
                    $externalData->view_flyer_display = 0;
                    $externalData->save();
                }
            }


            $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
            if($externalData){
                return response()->json(["status" => 3, "message" => 'External link updated successfully']);
            }
            else{
                return response()->json(["status" => 4, "message" => 'External link not updated']);
            }
            
        }
    }

    public function saveMenuImages(Request $request){
        if($request->ajax()){
            if($request->hasFile('menu_image1')){
                $validator  =   Validator::make($request->all(), [
                    "menu_image1"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'menuImage1'])->first();
                        if($image){
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('menu_image1')->toMediaCollection('menuImage1');
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->save();
                        $external_data->addMediaFromRequest('menu_image1')->toMediaCollection('menuImage1');
                    }
                }
            }
            if($request->hasFile('menu_image2')){
                $validator  =   Validator::make($request->all(), [
                    "menu_image2"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'menuImage2'])->first();
                        if($image){
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('menu_image2')->toMediaCollection('menuImage2');
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->save();
                        $external_data->addMediaFromRequest('menu_image2')->toMediaCollection('menuImage2');
                    }
                }
            }

            if($request->hasFile('menu_image3')){
                $validator  =   Validator::make($request->all(), [
                    "menu_image3"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'menuImage3'])->first();
                        if($image){
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('menu_image3')->toMediaCollection('menuImage3');
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->save();
                        $external_data->addMediaFromRequest('menu_image3')->toMediaCollection('menuImage3');
                    }
                }
            }
            return response()->json(["status" => 3, "message" => 'image saved']); 
        }
    }

    public function deleteMenuImages(Request $request){
        if($request->ajax()){
            if($request->image_number == 1){
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'menuImage1'])->first();
                if($image){
                    $image->delete();
                    return response()->json(["status" => 0, "message" => 'image deleted']); 
                }
            }
            if($request->image_number == 2){
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'menuImage2'])->first();
                if($image){
                    $image->delete();
                    return response()->json(["status" => 1, "message" => 'image deleted']); 
                }
            }
            if($request->image_number == 3){
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'menuImage3'])->first();
                if($image){
                    $image->delete();
                    return response()->json(["status" => 2, "message" => 'image deleted']); 
                }
            }
                
        }
    }

    public function saveFlyerImages(Request $request){
        if($request->ajax()){
            if($request->hasFile('flyer_image1')){
                $validator  =   Validator::make($request->all(), [
                    "flyer_image1"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'flyerImage1'])->first();
                        if($image){
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('flyer_image1')->toMediaCollection('flyerImage1');
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->save();
                        $external_data->addMediaFromRequest('flyer_image1')->toMediaCollection('flyerImage1');
                    }
                }
            }
            if($request->hasFile('flyer_image2')){
                $validator  =   Validator::make($request->all(), [
                    "flyer_image2"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = MerchantExternalManage::where('location_id', $request->location_id)->first();
                    if($externalData){
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'flyerImage2'])->first();
                        if($image){
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('flyer_image2')->toMediaCollection('flyerImage2');
                    }
                    else{
                        $external_data = new MerchantExternalManage;
                        $external_data->location_id = $request->location_id;
                        $external_data->save();
                        $external_data->addMediaFromRequest('flyer_image2')->toMediaCollection('flyerImage2');
                    }
                }
            }
            return response()->json(["status" => 3, "message" => 'image saved']); 
        }
        
    }


    public function deleteFlyerImages(Request $request){
        if($request->ajax()){
            if($request->image_number == 1){
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'flyerImage1'])->first();
                if($image){
                    $image->delete();
                    return response()->json(["status" => 0, "message" => 'image deleted']); 
                }
            }

            if($request->image_number == 2){
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'flyerImage2'])->first();
                if($image){
                    $image->delete();
                    return response()->json(["status" => 1, "message" => 'image deleted']); 
                }
            }
        }
    }


    public function merchantWebsite()
    {
        $images = array();
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $main_location = MerchantLocation::where('user_id',$userid)->where('is_main',1)->first();
       // dd($main_location);
        $merchant_location = MerchantLocation::with('businessLocation.states', 'merchantUser')->where('user_id', Auth::user()->id)->get();
        $business_id = $user->business_id;
        $business_photos = Media::where(['model_id' => $business_id, 'collection_name' => 'businessProfilePhoto'])->get();
        $business_profile = BusinessProfile::find($business_id);
        $loyalty_location = LoyaltyRewardLocation::with('loyaltyprogram')->where('location_id',$main_location->location_id)->get();
        $display =  MerchantDisplayBoard::with('boardone','boardtwo')->where('location_id',$main_location->location_id)->first();
        $external_manage = MerchantExternalManage::where('location_id',$main_location->location_id)->first();
        return view('frontend.merchant_owner.settings.merchant-website', compact('business_photos', 'business_profile', 'loyalty_location','merchant_location','external_manage','display'));
    }

    // public function downloadImage($filename){
    //     $file = Storage::disk('public')->get($filename);
  
    //     return (new Response($file, 200))
    //           ->header('Content-Type', 'image/jpeg');
    // }

    public function saveLocationHours(Request $request){
        $business_location = BusinessLocation::find($request->location_id);
         //return response()->json(["data" => $request->monday_time]);
        if($business_location){
            if(count($request->sunday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','sunday')->first();
                if($hours_operation){
                    if($request->sunday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->sunday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        if(count($request->sunday_time) > 0){
                            $hours_operation->is_open_24_hours = false;
                            $hours_operation->is_closed = false;
                            $hours_operation->is_open = true;
                            $hours_operation->save();
                            $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                            if(count($time)){
                                $time->each->delete();
                            }
                            if(count($request->sunday_time))
                            for($i=0; $i< count($request->sunday_time); $i++){
                                $close_time = $request->sunday_time[$i]['closetime'];
                                $closeTime = explode(":",$close_time);
                                $close_hour = $closeTime[0];
                                $closeMin = explode(" ",$closeTime[1]);
                                $closeMinute = $closeMin[0];
                                $closeformat = $closeMin[1];
                                $open_time = $request->sunday_time[$i]['opentime'];
                                $openTime = explode(":",$open_time);
                                $open_hour = $openTime[0];
                                $openMin = explode(" ",$openTime[1]);
                                $openMinute = $openMin[0];
                                $openformat = $openMin[1];
                                $operation_time = new HoursOperationTime;
                                $operation_time->hour_operation_id = $hours_operation->id;
                                $operation_time->open_time_hour = $open_hour;
                                $operation_time->open_time_minute = $openMinute;
                                $operation_time->open_time = $openformat;
                                $operation_time->close_time_hour = $close_hour;
                                $operation_time->close_time_minute = $closeMinute;
                                $operation_time->close_time = $closeformat;
                                $operation_time->save();
                            }
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'sunday';
                   if($request->sunday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->sunday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->sunday_time); $i++){
                        $close_time = $request->sunday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->sunday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->monday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','monday')->first();
                if($hours_operation){
                    if($request->monday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->monday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                        if(count($request->monday_time))
                        for($i=0; $i< count($request->monday_time); $i++){
                            $close_time = $request->monday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->monday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'monday';
                   if($request->monday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->monday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->monday_time); $i++){
                        $close_time = $request->monday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->monday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->tuesday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','tuesday')->first();
                if($hours_operation){
                    if($request->tuesday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->tuesday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time)){
                            $time->each->delete();
                        }
                        if(count($request->tuesday_time))
                        for($i=0; $i< count($request->tuesday_time); $i++){
                            $close_time = $request->tuesday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->tuesday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'tuesday';
                   if($request->tuesday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->tuesday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->tuesday_time); $i++){
                        $close_time = $request->tuesday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->tuesday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->wednesday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','wednesday')->first();
                if($hours_operation){
                    if($request->wednesday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->wednesday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time)){
                            $time->each->delete();
                        }
                        if(count($request->wednesday_time))
                        for($i=0; $i< count($request->wednesday_time); $i++){
                            $close_time = $request->wednesday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->wednesday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'wednesday';
                   if($request->wednesday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->wednesday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->wednesday_time); $i++){
                        $close_time = $request->wednesday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->wednesday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->thursday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','thursday')->first();
                if($hours_operation){
                    if($request->thursday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->thursday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time)){
                            $time->each->delete();
                        }
                        if(count($request->thursday_time))
                        for($i=0; $i< count($request->thursday_time); $i++){
                            $close_time = $request->thursday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->thursday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'thursday';
                   if($request->thursday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->thursday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->thursday_time); $i++){
                        $close_time = $request->thursday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->thursday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->friday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','friday')->first();
                if($hours_operation){
                    if($request->friday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->friday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time)){
                            $time->each->delete();
                        }
                        for($i=0; $i< count($request->friday_time); $i++){
                            $close_time = $request->friday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->friday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'friday';
                   if($request->friday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->friday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->friday_time); $i++){
                        $close_time = $request->friday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->friday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //return response()->json(['status' => 1]);
                }
            }

            if(count($request->saturday_time) > 0){
                $hours_operation = MerchantHoursOperation::where('location_id',$request->location_id)->where('day','saturday')->first();
                if($hours_operation){
                    if($request->saturday_time[0] == 'closed'){
                        $hours_operation->is_closed = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    elseif($request->saturday_time[0] == 'Open 24 Hours'){ 
                        $hours_operation->is_open_24_hours = true;
                        $hours_operation->is_open = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time) > 0){
                            $time->each->delete();
                        }
                    }
                    else{
                        $hours_operation->is_open_24_hours = false;
                        $hours_operation->is_closed = false;
                        $hours_operation->is_open = true;
                        $hours_operation->save();
                        $time = HoursOperationTime::where('hour_operation_id',$hours_operation->id)->get();
                        if(count($time)){
                            $time->each->delete();
                        }
                        for($i=0; $i< count($request->saturday_time); $i++){
                            $close_time = $request->saturday_time[$i]['closetime'];
                            $closeTime = explode(":",$close_time);
                            $close_hour = $closeTime[0];
                            $closeMin = explode(" ",$closeTime[1]);
                            $closeMinute = $closeMin[0];
                            $closeformat = $closeMin[1];
                            $open_time = $request->saturday_time[$i]['opentime'];
                            $openTime = explode(":",$open_time);
                            $open_hour = $openTime[0];
                            $openMin = explode(" ",$openTime[1]);
                            $openMinute = $openMin[0];
                            $openformat = $openMin[1];
                            $operation_time = new HoursOperationTime;
                            $operation_time->hour_operation_id = $hours_operation->id;
                            $operation_time->open_time_hour = $open_hour;
                            $operation_time->open_time_minute = $openMinute;
                            $operation_time->open_time = $openformat;
                            $operation_time->close_time_hour = $close_hour;
                            $operation_time->close_time_minute = $closeMinute;
                            $operation_time->close_time = $closeformat;
                            $operation_time->save();
                        }
                    }
                }
                else{
                   $hours_operation =  new MerchantHoursOperation;
                   $hours_operation->business_id = $business_location->business_profile_id;
                   $hours_operation->location_id = $request->location_id;
                   $hours_operation->day = 'saturday';
                   if($request->saturday_time[0] == 'closed'){
                    $hours_operation->is_closed = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->save();
                   }
                   elseif($request->saturday_time[0] == 'Open 24 Hours'){ 
                    $hours_operation->is_open_24_hours = true;
                    $hours_operation->is_open = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->save();
                   }
                   else{
                    $hours_operation->is_open_24_hours = false;
                    $hours_operation->is_closed = false;
                    $hours_operation->is_open = true;
                    $hours_operation->save();
                    for($i=0; $i< count($request->saturday_time); $i++){
                        $close_time = $request->saturday_time[$i]['closetime'];
                        $closeTime = explode(":",$close_time);
                        $close_hour = $closeTime[0];
                        $closeMin = explode(" ",$closeTime[1]);
                        $closeMinute = $closeMin[0];
                        $closeformat = $closeMin[1];
                        $open_time = $request->saturday_time[$i]['opentime'];
                        $openTime = explode(":",$open_time);
                        $open_hour = $openTime[0];
                        $openMin = explode(" ",$openTime[1]);
                        $openMinute = $openMin[0];
                        $openformat = $openMin[1];
                        $operation_time = new HoursOperationTime;
                        $operation_time->hour_operation_id = $hours_operation->id;
                        $operation_time->open_time_hour = $open_hour;
                        $operation_time->open_time_minute = $openMinute;
                        $operation_time->open_time = $openformat;
                        $operation_time->close_time_hour = $close_hour;
                        $operation_time->close_time_minute = $closeMinute;
                        $operation_time->close_time = $closeformat;
                        $operation_time->save();
                        //return response()->json(["data" => $closeformat]);
                    }
                   }
                   //
                }
            }

            return response()->json(['status' => 1]);
            
            
        }

    }


    public function getLocationHours(Request $request){
        if($request->ajax()){
            $merchant_hours = MerchantHoursOperation::with('location_hours')->where('location_id',$request->locationid)->get();
            if(count($merchant_hours) > 0){
                return response()->json(['status' => 1, 'data' => $merchant_hours]);
            }
            else{
                return response()->json(['status' => 2]);
            }
        }
    }




}
