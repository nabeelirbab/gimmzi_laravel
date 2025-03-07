<?php

namespace App\Http\Livewire\Frontend\PropertyManager;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BuildingUnit;
use App\Models\BusinessLocation;
use App\Models\MerchantLocation;
use App\Models\PropertyUnderProviderUser;
use App\Models\Provider;
use App\Models\ProviderAmenity;
use App\Models\ProviderBuilding;
use App\Models\ProviderExternalManage;
use App\Models\ProviderFeature;
use App\Models\ProviderFloorPlan;
use App\Models\ProviderLimitSetting;
use App\Models\Title;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use App\Models\ProviderHoursOperation;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;

class Settings extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $user, $usertitle, $propertyDetails, $adduser, $property_limit, $property, $price = [], $business_locations = [];
    public $item_name, $value_one, $value_two, $note, $participating_location_ids = [], $action_value = [], $removeid, $action_type, $status, $property_video, $getProperty;
    public $propertyid, $location, $participating_locations, $user_message_board, $main_location, $display_board, $selectedboard, $merchantDisplay, $getusers, $manager_id, $provider_feature, $provider_amenity, $feature_id, $amenity_id, $floor_plan, $floor_image1, $floor_image2, $floor_image3, $provider_plan, $bedroom_1, $bathroom_1, $total_1, $bedroom_2, $bathroom_2, $total_2, $bedroom_3, $bathroom_3, $total_3, $image_id, $listing_videos, $video_id, $amenityid;
    public $description, $property_name,  $features = [], $amenities = [], $selectedProperty, $user_id, $manager_user, $main_image, $model_images = [], $model_video, $listing_images;
    public $visit_website_url, $phone, $lease_online_url, $contact_community_url, $external_manage, $featureid;
    public  $is_readonly = 'readonly', $edit_text = 'Edit', $hours_operation;

    public $sunday_open_time,$sunday_open_hour,$sunday_open_minute,$sunday_close_time,$sunday_close_hour,$sunday_close_minute, $sunday_open_message,$sunday_close_message, $sunday_closed;

    public $monday_open_time,$monday_open_hour,$monday_open_minute,$monday_close_time,$monday_close_hour,$monday_close_minute, $monday_open_message,$monday_close_message, $monday_closed;

    public $tuesday_open_time,$tuesday_open_hour,$tuesday_open_minute,$tuesday_close_time,$tuesday_close_hour,$tuesday_close_minute, $tuesday_open_message,$tuesday_close_message, $tuesday_closed;

    public $wednesday_open_time,$wednesday_open_hour,$wednesday_open_minute,$wednesday_close_time,$wednesday_close_hour,$wednesday_close_minute, $wednesday_open_message,$wednesday_close_message, $wednesday_closed;

    public $thursday_open_time,$thursday_open_hour,$thursday_open_minute,$thursday_close_time,$thursday_close_hour,$thursday_close_minute, $thursday_open_message,$thursday_close_message, $thursday_closed;

    public $friday_open_time,$friday_open_hour,$friday_open_minute,$friday_close_time,$friday_close_hour,$friday_close_minute, $friday_open_message,$friday_close_message, $friday_closed;

    public $saturday_open_time,$saturday_open_hour,$saturday_open_minute,$saturday_close_time,$saturday_close_hour,$saturday_close_minute, $saturday_open_message,$saturday_close_message, $saturday_closed;
    public $current_point,$signup_point,$low_point,$add_point,$tenant_point,$inspection_point,$great_tenant_point,$helper_point,$samaritan_point;

    public $showdiv=false,$result,$selected_unit_name, $qr_image,$text, $search_unit, $selected_unit_id,$text1, $term_limit, $frequency_limit;
    public $buldingList,$select_building, $community_leader_point;

    public function mount()
    {
        $this->user = Auth::user();
        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id', $this->user->id)->with('provider')->get();
        $this->selectedProperty = $this->propertyDetails->first();
        $this->usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $this->propertyid = $this->selectedProperty->provider_id;
        // dd($propertyid);
        $this->getProperty = Provider::find($this->propertyid);
        $this->status = $this->getProperty->status;
        $this->getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
            ->whereHas('provideruser', function ($q) {
                $q->where('active', 1);
            })->get();
        $this->adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
            ->whereHas('provideruser', function ($q) {
                $q->where('active', 0);
            })->get();
        $this->property_limit = ProviderLimitSetting::where('property_id', $this->propertyid)->first();
        if($this->property_limit){
            if ($this->property_limit->term_limit != null){
                $this->term_limit = $this->property_limit->term_limit;
            }
            if ($this->property_limit->frequency != null){
                $this->frequency_limit = $this->property_limit->frequency;
            }
        }
                                
        $this->description = $this->propertyDetails->first()->provider->description;
        $this->external_manage = ProviderExternalManage::where('property_id',  $this->propertyid)->first();
        // dd($this->external_manage);
        if ($this->external_manage) {
            $this->external_manage = $this->external_manage;
        } else {
            $this->external_manage = new ProviderExternalManage;
            $this->external_manage->property_id = $this->propertyid;
            $this->external_manage->save();
        }
        $this->contact_community_url = $this->external_manage->contact_community_url;
        $this->lease_online_url = $this->external_manage->lease_online_url;
        $this->visit_website_url = $this->external_manage->visit_website_url;
        $this->phone = $this->external_manage->phone;

        $this->floor_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
        if ($this->floor_plan) {
            $this->bedroom_1 =  $this->floor_plan->bedroom_1;
            $this->bedroom_2 =  $this->floor_plan->bedroom_2;
            $this->bedroom_3 =  $this->floor_plan->bedroom_3;
            $this->bathroom_1 =  $this->floor_plan->bathroom_1;
            $this->bathroom_2 =  $this->floor_plan->bathroom_2;
            $this->bathroom_3 =  $this->floor_plan->bathroom_3;
            $this->total_1 =  $this->floor_plan->total_1;
            $this->total_2 =  $this->floor_plan->total_2;
            $this->total_3 =  $this->floor_plan->total_3;
        }

        // if ($this->floor_plan) {
        // dd($this->floor_plan);
        //     $this->floor_image1 = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage1'])->first();
        //     $this->floor_image2 = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage2'])->first();
        //     $this->floor_image3 = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage3'])->first();
        // }
        $this->sunday_open_message = '';
        $this->sunday_close_message = '';
        $this->monday_open_message = '';
        $this->monday_close_message = '';
        $this->tuesday_open_message = '';
        $this->tuesday_close_message = '';
        $this->wednesday_open_message = '';
        $this->wednesday_close_message = '';
        $this->thursday_open_message = '';
        $this->thursday_close_message = '';
        $this->friday_open_message = '';
        $this->friday_close_message = '';
        $this->saturday_open_message = '';
        $this->saturday_close_message = '';
        
        $this->hours_operation = ProviderHoursOperation::where('property_id', $this->propertyid)->get();
        if(count($this->hours_operation) > 0){
            foreach($this->hours_operation as $hour_time){
                if($hour_time->day == 'sunday'){
                    if($hour_time->is_closed == 1){
                        $this->sunday_closed = 'checked'; $this->property_limit = ProviderLimitSetting::where('property_id', $this->propertyid)->first();
                    }
                    else{
                        $this->sunday_open_time = $hour_time->open_time;
                        $this->sunday_open_hour = $hour_time->open_time_hour;
                        $this->sunday_open_minute = $hour_time->open_time_minute;
                        $this->sunday_close_time = $hour_time->close_time;
                        $this->sunday_close_hour = $hour_time->close_time_hour;
                        $this->sunday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'monday'){
                    if($hour_time->is_closed == 1){
                        $this->monday_closed = 'checked';
                    }
                    else{
                        $this->monday_open_time = $hour_time->open_time;
                        $this->monday_open_hour = $hour_time->open_time_hour;
                        $this->monday_open_minute = $hour_time->open_time_minute;
                        $this->monday_close_time = $hour_time->close_time;
                        $this->monday_close_hour = $hour_time->close_time_hour;
                        $this->monday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'tuesday'){
                    if($hour_time->is_closed == 1){
                        $this->tuesday_closed = 'checked';
                    }
                    else{
                        $this->tuesday_open_time = $hour_time->open_time;
                        $this->tuesday_open_hour = $hour_time->open_time_hour;
                        $this->tuesday_open_minute = $hour_time->open_time_minute;
                        $this->tuesday_close_time = $hour_time->close_time;
                        $this->tuesday_close_hour = $hour_time->close_time_hour;
                        $this->tuesday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'wednesday'){
                    if($hour_time->is_closed == 1){
                        $this->wednesday_closed = 'checked';
                    }
                    else{
                        $this->wednesday_open_time = $hour_time->open_time;
                        $this->wednesday_open_hour = $hour_time->open_time_hour;
                        $this->wednesday_open_minute = $hour_time->open_time_minute;
                        $this->wednesday_close_time = $hour_time->close_time;
                        $this->wednesday_close_hour = $hour_time->close_time_hour;
                        $this->wednesday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'thursday'){
                    if($hour_time->is_closed == 1){
                        $this->thursday_closed = 'checked';
                    }
                    else{
                        $this->thursday_open_time = $hour_time->open_time;
                        $this->thursday_open_hour = $hour_time->open_time_hour;
                        $this->thursday_open_minute = $hour_time->open_time_minute;
                        $this->thursday_close_time = $hour_time->close_time;
                        $this->thursday_close_hour = $hour_time->close_time_hour;
                        $this->thursday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'friday'){
                    if($hour_time->is_closed == 1){
                        $this->friday_closed = 'checked';
                    }
                    else{
                        $this->friday_open_time = $hour_time->open_time;
                        $this->friday_open_hour = $hour_time->open_time_hour;
                        $this->friday_open_minute = $hour_time->open_time_minute;
                        $this->friday_close_time = $hour_time->close_time;
                        $this->friday_close_hour = $hour_time->close_time_hour;
                        $this->friday_close_minute = $hour_time->close_time_minute;
                    }
                }
                if($hour_time->day == 'saturday'){
                    if($hour_time->is_closed == 1){
                        $this->saturday_closed = 'checked';
                    }
                    else{
                        $this->saturday_open_time = $hour_time->open_time;
                        $this->saturday_open_hour = $hour_time->open_time_hour;
                        $this->saturday_open_minute = $hour_time->open_time_minute;
                        $this->saturday_close_time = $hour_time->close_time;
                        $this->saturday_close_hour = $hour_time->close_time_hour;
                        $this->saturday_close_minute = $hour_time->close_time_minute;
                    }
                }
            }
            
        }

        $this->buldingList = ProviderBuilding::where('provider_type_id',$this->propertyid)->get();
        $this->select_building = 'all';
    }




    public function property_provider($propertyId)
    {
        $getProperty = Provider::find($propertyId);
        if ($getProperty) {
            $this->property_limit = ProviderLimitSetting::where('property_id', $getProperty->id)->first();
            $this->selectedProperty = PropertyUnderProviderUser::where('provider_user_id', $this->user->id)->with('provider')->where('provider_id', $getProperty->id)->first();
            $this->propertyid = $this->selectedProperty->provider_id;
            $this->description = $this->selectedProperty->provider->description;
            $this->getProperty = Provider::find($this->propertyid);
            $this->status = $this->getProperty->status;
            $this->external_manage = ProviderExternalManage::where('property_id',  $this->propertyid)->first();
            $this->floor_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();

            if ($this->external_manage) {
                $this->external_manage = $this->external_manage;
            } else {
                $this->external_manage = new ProviderExternalManage;
                $this->external_manage->property_id = $this->propertyid;
                $this->external_manage->save();
            }
            $this->contact_community_url = $this->external_manage->contact_community_url;
            $this->lease_online_url = $this->external_manage->lease_online_url;
            $this->visit_website_url = $this->external_manage->visit_website_url;
            $this->phone = $this->external_manage->phone;
           
            if ($this->floor_plan) {
                $this->bedroom_1 =  $this->floor_plan->bedroom_1;
                $this->bedroom_2 =  $this->floor_plan->bedroom_2;
                $this->bedroom_3 =  $this->floor_plan->bedroom_3;
                $this->bathroom_1 =  $this->floor_plan->bathroom_1;
                $this->bathroom_2 =  $this->floor_plan->bathroom_2;
                $this->bathroom_3 =  $this->floor_plan->bathroom_3;
                $this->total_1 =  $this->floor_plan->total_1;
                $this->total_2 =  $this->floor_plan->total_2;
                $this->total_3 =  $this->floor_plan->total_3;
            } else {
                $this->bedroom_1 =  null;
                $this->bathroom_1 =  null;
                $this->total_1 =  null;
                $this->bedroom_2 =  null;
                $this->bathroom_2 =  null;
                $this->total_2 =  null;
                $this->bedroom_3 =  null;
                $this->bathroom_3 =  null;
                $this->total_3 =  null;
            }
            $this->sunday_open_message = '';
            $this->sunday_close_message = '';
            $this->monday_open_message = '';
            $this->monday_close_message = '';
            $this->tuesday_open_message = '';
            $this->tuesday_close_message = '';
            $this->wednesday_open_message = '';
            $this->wednesday_close_message = '';
            $this->thursday_open_message = '';
            $this->thursday_close_message = '';
            $this->friday_open_message = '';
            $this->friday_close_message = '';
            $this->saturday_open_message = '';
            $this->saturday_close_message = '';
            
            $this->hours_operation = ProviderHoursOperation::where('property_id', $this->propertyid)->get();
            if(count($this->hours_operation) > 0){
                foreach($this->hours_operation as $hour_time){
                    if($hour_time->day == 'sunday'){
                        if($hour_time->is_closed == 1){
                            $this->sunday_closed = 'checked';
                        }
                        else{
                            $this->sunday_open_time = $hour_time->open_time;
                            $this->sunday_open_hour = $hour_time->open_time_hour;
                            $this->sunday_open_minute = $hour_time->open_time_minute;
                            $this->sunday_close_time = $hour_time->close_time;
                            $this->sunday_close_hour = $hour_time->close_time_hour;
                            $this->sunday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'monday'){
                        if($hour_time->is_closed == 1){
                            $this->monday_closed = 'checked';
                        }
                        else{
                            $this->monday_open_time = $hour_time->open_time;
                            $this->monday_open_hour = $hour_time->open_time_hour;
                            $this->monday_open_minute = $hour_time->open_time_minute;
                            $this->monday_close_time = $hour_time->close_time;
                            $this->monday_close_hour = $hour_time->close_time_hour;
                            $this->monday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'tuesday'){
                        if($hour_time->is_closed == 1){
                            $this->tuesday_closed = 'checked';
                        }
                        else{
                            $this->tuesday_open_time = $hour_time->open_time;
                            $this->tuesday_open_hour = $hour_time->open_time_hour;
                            $this->tuesday_open_minute = $hour_time->open_time_minute;
                            $this->tuesday_close_time = $hour_time->close_time;
                            $this->tuesday_close_hour = $hour_time->close_time_hour;
                            $this->tuesday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'wednesday'){
                        if($hour_time->is_closed == 1){
                            $this->wednesday_closed = 'checked';
                        }
                        else{
                            $this->wednesday_open_time = $hour_time->open_time;
                            $this->wednesday_open_hour = $hour_time->open_time_hour;
                            $this->wednesday_open_minute = $hour_time->open_time_minute;
                            $this->wednesday_close_time = $hour_time->close_time;
                            $this->wednesday_close_hour = $hour_time->close_time_hour;
                            $this->wednesday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'thursday'){
                        if($hour_time->is_closed == 1){
                            $this->thursday_closed = 'checked';
                        }
                        else{
                            $this->thursday_open_time = $hour_time->open_time;
                            $this->thursday_open_hour = $hour_time->open_time_hour;
                            $this->thursday_open_minute = $hour_time->open_time_minute;
                            $this->thursday_close_time = $hour_time->close_time;
                            $this->thursday_close_hour = $hour_time->close_time_hour;
                            $this->thursday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'friday'){
                        if($hour_time->is_closed == 1){
                            $this->friday_closed = 'checked';
                        }
                        else{
                            $this->friday_open_time = $hour_time->open_time;
                            $this->friday_open_hour = $hour_time->open_time_hour;
                            $this->friday_open_minute = $hour_time->open_time_minute;
                            $this->friday_close_time = $hour_time->close_time;
                            $this->friday_close_hour = $hour_time->close_time_hour;
                            $this->friday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                    if($hour_time->day == 'saturday'){
                        if($hour_time->is_closed == 1){
                            $this->saturday_closed = 'checked';
                        }
                        else{
                            $this->saturday_open_time = $hour_time->open_time;
                            $this->saturday_open_hour = $hour_time->open_time_hour;
                            $this->saturday_open_minute = $hour_time->open_time_minute;
                            $this->saturday_close_time = $hour_time->close_time;
                            $this->saturday_close_hour = $hour_time->close_time_hour;
                            $this->saturday_close_minute = $hour_time->close_time_minute;
                        }
                    }
                }
                
            }
            else{
                $this->sunday_open_time = '';
                $this->sunday_open_hour = '';
                $this->sunday_open_minute = '';
                $this->sunday_close_time = '';
                $this->sunday_close_hour = '';
                $this->sunday_close_minute = ''; 
                $this->monday_open_time = '';
                $this->monday_open_hour ='';
                $this->monday_open_minute = '';
                $this->monday_close_time = '';
                $this->monday_close_hour = '';
                $this->monday_close_minute = '';
                $this->tuesday_open_time = '';
                $this->tuesday_open_hour = '';
                $this->tuesday_open_minute = '';
                $this->tuesday_close_time = '';
                $this->tuesday_close_hour = '';
                $this->tuesday_close_minute = '';
                $this->wednesday_open_time = '';
                $this->wednesday_open_hour = '';
                $this->wednesday_open_minute = '';
                $this->wednesday_close_time = '';
                $this->wednesday_close_hour = '';
                $this->wednesday_close_minute = '';
                $this->thursday_open_time = '';
                $this->thursday_open_hour = '';
                $this->thursday_open_minute = '';
                $this->thursday_close_time = '';
                $this->thursday_close_hour = '';
                $this->thursday_close_minute = '';
                $this->friday_open_time = '';
                $this->friday_open_hour = '';
                $this->friday_open_minute = '';
                $this->friday_close_time = '';
                $this->friday_close_hour = '';
                $this->friday_close_minute = '';
                $this->saturday_open_time = '';
                $this->saturday_open_hour = '';
                $this->saturday_open_minute = '';
                $this->saturday_close_time = '';
                $this->saturday_close_hour = '';
                $this->saturday_close_minute = '';
            }

            $this->buldingList = ProviderBuilding::where('provider_type_id',$this->propertyid)->get();
            $this->getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                                ->whereHas('provideruser', function ($q) {
                                    $q->where('active', 1);
                                })->get();
            $this->adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                            ->whereHas('provideruser', function ($q) {
                                $q->where('active', 0);
                            })->get();
        }
    }

    public function updateLimitSettings($type){
        if($this->propertyid){
            if($type == 'current_allowance'){
                $this->validate(
                    [
                        'current_point' => ['required','gt:99'],
                    ],
                    [
                        'current_point.required' => "Field is required",
                        'current_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->current_allowance_point_limit = $this->current_point;
                    $limit_settings->save();
                    $this->current_point="";
                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->current_allowance_point_limit = $this->current_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->current_point="";
                }
            }
            elseif($type == 'signup_bonus'){
                $this->validate(
                    [
                        'signup_point' => ['required','gt:99'],
                    ],
                    [
                        'signup_point.required' => "Field is required",
                        'signup_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->sign_up_bonus_point = $this->signup_point;
                    $limit_settings->save();
                    $this->signup_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->sign_up_bonus_point = $this->signup_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->signup_point="";
                }
            }
            elseif($type == 'low_point'){
                $this->validate(
                    [
                        'low_point' => ['required','gt:99'],
                    ],
                    [
                        'low_point.required' => "Field is required",
                        'low_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->low_point_balance = $this->low_point;
                    $limit_settings->save();
                    $this->low_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->low_point_balance = $this->low_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->low_point="";
                }
            }
            elseif($type == 'add_point'){
                $this->validate(
                    [
                        'add_point' => ['required','gt:24'],
                    ],
                    [
                        'add_point.required' => "Field is required",
                        'add_point.gt' => "Point must be greater than or equal 25"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->add_point = $this->add_point;
                    $limit_settings->save();
                    $this->add_point="";
                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->add_point = $this->add_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->add_point=null;
                }
            }
            elseif($type == 'tenant_Reward'){
                $this->validate(
                    [
                        'tenant_point' => ['required','gt:99'],
                    ],
                    [
                        'tenant_point.required' => "Field is required",
                        'tenant_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->tenant_of_the_month_Reward = $this->tenant_point;
                    $limit_settings->save();
                    $this->tenant_point=null;

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->tenant_of_the_month_Reward = $this->tenant_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->propertyid="";
                }
            }
            elseif($type == 'inspection_Reward'){
                $this->validate(
                    [
                        'inspection_point' => ['required','gt:99'],
                    ],
                    [
                        'inspection_point.required' => "Field is required",
                        'inspection_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->pass_inspection_reward = $this->inspection_point;
                    $limit_settings->save();
                    $this->inspection_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->pass_inspection_reward = $this->inspection_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->inspection_point="";
                }
            }
            elseif($type == 'great_tenant'){
                $this->validate(
                    [
                        'great_tenant_point' => ['required','gt:49'],
                    ],
                    [
                        'great_tenant_point.required' => "Field is required",
                        'great_tenant_point.gt' => "Point must be greater than or equal 50"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->great_tenant_reward = $this->great_tenant_point;
                    $limit_settings->save();
                    $this->great_tenant_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->great_tenant_reward = $this->great_tenant_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->great_tenant_point="";
                }
            }
            elseif($type == 'community_helper'){
                $this->validate(
                    [
                        'helper_point' => ['required','gt:49'],
                    ],
                    [
                        'helper_point.required' => "Field is required",
                        'helper_point.gt' => "Point must be greater than or equal 50"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->community_helper_reward = $this->helper_point;
                    $limit_settings->save();
                    $this->helper_point="";
                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->community_helper_reward = $this->helper_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->helper_point="";
                }
            }
            elseif($type == 'good_samaritan'){
                $this->validate(
                    [
                        'samaritan_point' => ['required','gt:49'],
                    ],
                    [
                        'samaritan_point.required' => "Field is required",
                        'samaritan_point.gt' => "Point must be greater than or equal 50"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->good_samaritan_reward = $this->samaritan_point;
                    
                    $limit_settings->save();
                    $this->samaritan_point="";
                   


                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->good_samaritan_reward = $this->samaritan_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->samaritan_point="";

                }
            }
            elseif($type == 'community_leader_point'){
                $this->validate(
                    [
                        'community_leader_point' => ['required','gt:49'],
                    ],
                    [
                        'community_leader_point.required' => "Field is required",
                        'community_leader_point.gt' => "Point must be greater than or equal 50"
                    ]
                );
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->community_leader_reward = $this->community_leader_point;
                    
                    $limit_settings->save();
                    $this->community_leader_point="";
                   


                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->community_leader_reward = $this->community_leader_point;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->community_leader_point="";

                }
            }
            $this->property_limit = ProviderLimitSetting::where('property_id', $this->propertyid)->first();

        }
    }


    public function editDescription()
    {
        $this->property = Provider::find($this->propertyid);
        if ($this->property) {
            if ($this->edit_text == 'Edit') {
                $this->is_readonly = '';
                $this->edit_text = 'Update';
            } else {
                $this->is_readonly = 'readonly';
                $this->edit_text = 'Edit';
                $this->property->description = $this->description;
                $this->property->save();
            }
        }
    }

    public function activeManager()
    {
        // dd($this->manager_id);
        $this->validate(
            [
                'manager_id' => ['required'],
            ],
            [
                'manager_id.required' => "Please select a Manager",
            ]
        );
        $manager = User::find($this->manager_id);
        // dd($manager);
        if ($manager) {
            $manager->active = true;
            $manager->save();
            $this->showUserModal('Manager Added Successfully');
            $this->getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 1);
                })->get();
            $this->adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 0);
                })->get();
        } else {
            $this->showUserModal('Manager Not Found');
        }
    }




    public function removeManager()
    {

        $manageruser = User::find($this->user_id);
        if ($manageruser) {
            $manageruser->active = false;
            $manageruser->save();
            $this->showUserModal('Manager Removed Successfully');
            $this->getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 1);
                })->get();
            $this->adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $this->propertyid)->whereIn('title_id', $this->usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 0);
                })->get();
        } else {
            $this->showUserModal('Manager Not Found');
        }
    }

    public function openSiteSettings()
    {
        $getprovider = Provider::find($this->propertyid);
        if ($getprovider) {
            $this->model_images = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyPhoto'])->get();
            $this->model_video = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyVideo'])->first();
            $this->main_image = $getprovider->main_image;
        }
        $this->emit('siteSettingsModal');
    }

    public function updateListingWebsiteStatus($status)
    {

        $getprovider = Provider::find($this->propertyid);
        if ($getprovider) {
            $getprovider->status = $status;
            $getprovider->save();
        }
        $this->status = $getprovider->status;
        //dd($this->hotel);
        // $this->listing_website = $this->hotel->show_listing_website;
    }

    public function showRemoveManager($id)
    {
        $this->user_id = $id;
        $this->manager_user = User::find($this->user_id);
        $this->emit('showRemoveModal', ['name' => $this->manager_user->full_name]);
    }

    public function featureView()
    {
        $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->emit('featureList');
    }


    public function amenityView()
    {
        $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->emit('amenityList');
    }


    public function featureManage()
    {
        $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->provider_feature = '';
        $this->feature_id = '';
        $this->emit('featureManageOpen');
    }

    public function editFeature($featureid)
    {
        $feature = ProviderFeature::find($featureid);
        if ($feature) {
            $this->provider_feature = $feature->feature_text;
            $this->feature_id = $feature->id;
            $this->emit('featureManageOpen');
        }
    }


    public function updateFeature()
    {
        $this->validate(
            [
                'provider_feature' => ['required'],
            ],
            [
                'provider_feature.required' => "Feature field is required",
            ]
        );
        if ($this->feature_id != '') {
            $feature = ProviderFeature::find($this->feature_id);
            if ($feature) {
                $feature->feature_text = $this->provider_feature;
                $feature->save();
            }
            $this->provider_feature = '';
            $this->feature_id = '';
            $this->resetForm();
            $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been updated successfully');
            $this->reset('provider_feature');
        } else {
            $feature = new ProviderFeature;
            $feature->property_id = $this->propertyid;
            $feature->feature_text = $this->provider_feature;
            $feature->status = true;
            $feature->save();
            $this->resetForm();
            $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been added successfully');
            $this->reset('provider_feature');
        }
    }

    public function closeFeatureManage()
    {
        $this->resetForm();
        $this->provider_feature = '';
        $this->feature_id = '';
        $this->emit('featureManageClose');
    }

    public function removeFeature($featureid)
    {
        $this->featureid = $featureid;
        $this->emit('showRemoveFeatureModal');
        // $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this feature!", 'Yes, delete!', 'featureDeleteConfirm', ['feature_id' => $featureid]); //($type,$title,$text,$confirmText,$method)
    }

    public function featureRemoveConfirm()
    {
        $feature = ProviderFeature::where('id', $this->featureid)->first();
        if ($feature) {
            $feature->delete();
        }
        $this->features = ProviderFeature::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->emit('hideRemoveFeatureModal');
        // $this->showFeatureSuccessModal('Feature has been removed successfully');
    }

    public function amenityManage()
    {
        $this->amenities = ProviderAmenity::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->provider_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageOpen');
    }

    public function editAmenities($amenityid)
    {
        $amenity = ProviderAmenity::find($amenityid);
        if ($amenity) {
            $this->provider_amenity = $amenity->amenity_text;
            $this->amenity_id = $amenity->id;
            $this->emit('amenityManageOpen');
        }
    }



    public function updateAmenity()
    {
        $this->validate(
            [
                'provider_amenity' => ['required'],
            ],
            [
                'provider_amenity.required' => "Amenity field is required",
            ]
        );
        if ($this->amenity_id != '') {
            $amenity = ProviderAmenity::find($this->amenity_id);
            if ($amenity) {
                $amenity->amenity_text = $this->provider_amenity;
                $amenity->save();
            }
            $this->provider_amenity = '';
            $this->amenity_id = '';
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('property_id',  $this->propertyid)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been updated successfully');
            $this->reset('provider_amenity');
        } else {
            $amenity = new ProviderAmenity;
            $amenity->property_id =  $this->propertyid;
            $amenity->amenity_text = $this->provider_amenity;
            $amenity->status = true;
            $amenity->save();
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('property_id', $this->propertyid)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been added successfully');
            $this->reset('provider_amenity');
        }
    }

    public function removeAmenities($amenityid)
    {
        // $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this amenities!", 'Yes, delete!', 'amenityDeleteConfirm', ['amenity_id' => $amenityid]); //($type,$title,$text,$confirmText,$method)
        $this->amenityid = $amenityid;
        $this->emit('showRemoveAmenitiesModal');
    }

    public function amenityDeleteConfirm()
    {
        $amenity = ProviderAmenity::where('id', $this->amenityid)->first();
        if ($amenity) {
            $amenity->delete();
        }
        $this->amenities = ProviderAmenity::where('property_id', $this->propertyid)->where('status', 1)->get();
        $this->emit('hideRemoveAmenitiesModal');
    }

    public function closeAmenityManage()
    {
        $this->resetForm();
        $this->provider_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageClose');
    }



    public function showFeatureSuccessModal($text)
    {
        $this->emit('featureSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideFeatureSuccessModal()
    {
        $this->emit('hidefeaturesuccessModal');
    }


    public function showUserModal($text)
    {
        $this->emit('userSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function updateExternalLink()
    {
        //dd($this->sunday_closed);
        if ($this->external_manage != '') {
            if (($this->contact_community_url != null) || ($this->lease_online_url != null) || ($this->visit_website_url != null)) {
                if ($this->contact_community_url != null) {
                    if ($this->phone != null) {
                        // $this->validate(
                        //     [
                        //         'contact_community_url' => ['numeric'],
                        //     ],
                        //     [
                        //         'contact_community_url.numeric' => "Contact Host Should be A number",
                        //     ]
                        // );
                        $this->external_manage->contact_community_url = $this->contact_community_url;
                        $this->external_manage->contact_community_display = true;
                        $this->external_manage->phone = $this->phone;
                        $this->external_manage->save();
                    } else {
                        $this->external_manage->contact_community_url = $this->contact_community_url;
                        $this->external_manage->contact_community_display = true;
                        $this->external_manage->save();
                    }
                } else {
                    $this->external_manage->contact_community_url = null;
                    $this->external_manage->contact_community_display = false;
                    $this->external_manage->save();
                }
                if ($this->lease_online_url != null) {
                    $this->validate(
                        [
                            'lease_online_url' => ['required', 'url'],
                        ],
                        [
                            'lease_online_url.required' => "The Lease Online Url field is required ",
                            'lease_online_url.url' => "Lease Online Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );

                    $this->external_manage->lease_online_url = $this->lease_online_url;
                    $this->external_manage->lease_online_display = true;
                    $this->external_manage->save();
                } else {

                    $this->external_manage->lease_online_url = null;
                    $this->external_manage->lease_online_display = false;
                    $this->external_manage->save();
                }
                if ($this->visit_website_url != null) {
                    $this->validate(
                        [
                            'visit_website_url' => ['required', 'url'],
                        ],
                        [
                            'visit_website_url.required' => "The visit Direct website Url field is required.",
                            'visit_website_url.url' => "Direct website Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );

                    $this->external_manage->visit_website_url = $this->visit_website_url;
                    $this->external_manage->visit_website_display = true;
                    $this->external_manage->save();
                } else {

                    $this->external_manage->visit_website_url = null;
                    $this->external_manage->visit_website_display = false;
                    $this->external_manage->save();
                }

                //$this->showExternalModal('External Link has been updated successfully');
            } else {
                $this->external_manage->lease_online_url = null;
                $this->external_manage->lease_online_display = false;
                $this->external_manage->visit_website_url = null;
                $this->external_manage->visit_website_display = false;
                $this->external_manage->save();
                //$this->showExternalModal('There are no External Link');
            }
        } 
        //dd($this->hours_operation);
        // if(count($this->hours_operation) > 0){

            $hours_operation1 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','sunday')->first();
            if($hours_operation1){
                if(($this->sunday_closed == false) || ($this->sunday_closed == null)){
                    $this->validate(
                        [
                            'sunday_open_hour' => ['required'],
                            'sunday_open_minute' => ['required'],
                            'sunday_open_time' => ['required'],
                            'sunday_close_hour' => ['required'],
                            'sunday_close_minute' => ['required'],
                            'sunday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation1->is_closed = false;
                    $hours_operation1->is_open = true;
                    $hours_operation1->open_time_hour = $this->sunday_open_hour ? $this->sunday_open_hour :'00';
                    $hours_operation1->open_time_minute = $this->sunday_open_minute ? $this->sunday_open_minute :'00';
                    $hours_operation1->open_time = $this->sunday_open_time ? $this->sunday_open_time :'00';
                    $hours_operation1->close_time_hour = $this->sunday_close_hour ? $this->sunday_close_hour :'00';
                    $hours_operation1->close_time_minute = $this->sunday_close_minute ? $this->sunday_close_minute :'00';
                    $hours_operation1->close_time = $this->sunday_close_time ? $this->sunday_close_time :'00';
                    $hours_operation1->save();
                }
                else{
                    $hours_operation1->is_closed = true;
                    $hours_operation1->is_open = false;
                    $hours_operation1->save();
                }
            }
            else{
                if(($this->sunday_closed == false) || ($this->sunday_closed == null)){
                    $this->validate(
                        [
                            'sunday_open_hour' => ['required'],
                            'sunday_open_minute' => ['required'],
                            'sunday_open_time' => ['required'],
                            'sunday_close_hour' => ['required'],
                            'sunday_close_minute' => ['required'],
                            'sunday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation1 = new ProviderHoursOperation;
                    $hours_operation1->property_id = $this->propertyid;
                    $hours_operation1->is_closed = false;
                    $hours_operation1->is_open = true;
                    $hours_operation1->open_time_hour = $this->sunday_open_hour ? $this->sunday_open_hour :'00';
                    $hours_operation1->open_time_minute = $this->sunday_open_minute ? $this->sunday_open_minute :'00';
                    $hours_operation1->open_time = $this->sunday_open_time ? $this->sunday_open_time :'00';
                    $hours_operation1->close_time_hour = $this->sunday_close_hour ? $this->sunday_close_hour :'00';
                    $hours_operation1->close_time_minute = $this->sunday_close_minute ? $this->sunday_close_minute :'00';
                    $hours_operation1->close_time = $this->sunday_close_time ? $this->sunday_close_time :'00';
                    $hours_operation1->day = 'sunday';
                    $hours_operation1->save();
                }  
                else{
                    $hours_operation1 = new ProviderHoursOperation;
                    $hours_operation1->property_id = $this->propertyid;
                    $hours_operation1->is_closed = true;
                    $hours_operation1->is_open = false;
                    $hours_operation1->day = 'sunday';
                    $hours_operation1->save();
                }
            }

                
            $hours_operation2 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','monday')->first();
            if($hours_operation2){

                if(($this->monday_closed == false) || ($this->monday_closed == null)){
                    $this->validate(
                        [
                            'monday_open_hour' => ['required'],
                            'monday_open_minute' => ['required'],
                            'monday_open_time' => ['required'],
                            'monday_close_hour' => ['required'],
                            'monday_close_minute' => ['required'],
                            'monday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation2->is_closed = false;
                    $hours_operation2->is_open = true;
                    $hours_operation2->open_time_hour = $this->monday_open_hour ? $this->monday_open_hour :'00';
                    $hours_operation2->open_time_minute = $this->monday_open_minute ? $this->monday_open_minute :'00';
                    $hours_operation2->open_time = $this->monday_open_time ? $this->monday_open_time :'00';
                    $hours_operation2->close_time_hour = $this->monday_close_hour ? $this->monday_close_hour :'00';
                    $hours_operation2->close_time_minute = $this->monday_close_minute ? $this->monday_close_minute :'00';
                    $hours_operation2->close_time = $this->monday_close_time ? $this->monday_close_time :'00';
                    $hours_operation2->save();
                }
                else{
                    $hours_operation2->is_closed = true;
                    $hours_operation2->is_open = false;
                    $hours_operation2->save();
                }
            }
            else{
                if(($this->monday_closed == false) || ($this->monday_closed == null)){
                    $this->validate(
                        [
                            'monday_open_hour' => ['required'],
                            'monday_open_minute' => ['required'],
                            'monday_open_time' => ['required'],
                            'monday_close_hour' => ['required'],
                            'monday_close_minute' => ['required'],
                            'monday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation2 = new ProviderHoursOperation;
                    $hours_operation2->property_id = $this->propertyid;
                    $hours_operation2->is_closed = false;
                    $hours_operation2->is_open = true;
                    $hours_operation2->open_time_hour = $this->monday_open_hour ? $this->monday_open_hour :'00';
                    $hours_operation2->open_time_minute = $this->monday_open_minute ? $this->monday_open_minute :'00';
                    $hours_operation2->open_time = $this->monday_open_time ? $this->monday_open_time :'00';
                    $hours_operation2->close_time_hour = $this->monday_close_hour ? $this->monday_close_hour :'00';
                    $hours_operation2->close_time_minute = $this->monday_close_minute ? $this->monday_close_minute :'00';
                    $hours_operation2->close_time = $this->monday_close_time ? $this->monday_close_time :'00';
                    $hours_operation2->day = 'monday';
                    $hours_operation2->save();
                }
                else{
                    $hours_operation2 = new ProviderHoursOperation;
                    $hours_operation2->property_id = $this->propertyid;
                    $hours_operation2->is_closed = true;
                    $hours_operation2->is_open = false;
                    $hours_operation2->day = 'monday';
                    $hours_operation2->save();
                }
            }
               
   
            $hours_operation3 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','tuesday')->first();
            if($hours_operation3){
                if(($this->tuesday_closed == false) || ($this->tuesday_closed == null)){
                    $this->validate(
                        [
                            'tuesday_open_hour' => ['required'],
                            'tuesday_open_minute' => ['required'],
                            'tuesday_open_time' => ['required'],
                            'tuesday_close_hour' => ['required'],
                            'tuesday_close_minute' => ['required'],
                            'tuesday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation3->is_closed = false;
                    $hours_operation3->is_open = true;
                    $hours_operation3->open_time_hour = $this->tuesday_open_hour ? $this->tuesday_open_hour :'00';
                    $hours_operation3->open_time_minute = $this->tuesday_open_minute ? $this->tuesday_open_minute :'00';
                    $hours_operation3->open_time = $this->tuesday_open_time ? $this->tuesday_open_time :'00';
                    $hours_operation3->close_time_hour = $this->tuesday_close_hour ? $this->tuesday_close_hour :'00';
                    $hours_operation3->close_time_minute = $this->tuesday_close_minute ? $this->tuesday_close_minute :'00';
                    $hours_operation3->close_time = $this->tuesday_close_time ? $this->tuesday_close_time :'00';
                    $hours_operation3->save();
                }
                else{
                    $hours_operation3->is_closed = true;
                    $hours_operation3->is_open = false;
                    $hours_operation3->save();
                }
            }
            else{
                if(($this->tuesday_closed == false) || ($this->tuesday_closed == null)){
                    $this->validate(
                        [
                            'tuesday_open_hour' => ['required'],
                            'tuesday_open_minute' => ['required'],
                            'tuesday_open_time' => ['required'],
                            'tuesday_close_hour' => ['required'],
                            'tuesday_close_minute' => ['required'],
                            'tuesday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation3 = new ProviderHoursOperation;
                    $hours_operation3->property_id = $this->propertyid;
                    $hours_operation3->is_closed = false;
                    $hours_operation3->is_open = true;
                    $hours_operation3->open_time_hour = $this->tuesday_open_hour ? $this->tuesday_open_hour :'00';
                    $hours_operation3->open_time_minute = $this->tuesday_open_minute ? $this->tuesday_open_minute :'00';
                    $hours_operation3->open_time = $this->tuesday_open_time ? $this->tuesday_open_time :'00';
                    $hours_operation3->close_time_hour = $this->tuesday_close_hour ? $this->tuesday_close_hour :'00';
                    $hours_operation3->close_time_minute = $this->tuesday_close_minute ? $this->tuesday_close_minute :'00';
                    $hours_operation3->close_time = $this->tuesday_close_time ? $this->tuesday_close_time :'00';
                    $hours_operation3->day = 'tuesday';
                    $hours_operation3->save();
                }
                else{
                    $hours_operation3 = new ProviderHoursOperation;
                    $hours_operation3->property_id = $this->propertyid;
                    $hours_operation3->is_closed = true;
                    $hours_operation3->is_open = false;
                    $hours_operation3->day = 'tuesday';
                    $hours_operation3->save();
                }
            
            }

            
            $hours_operation4 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','wednesday')->first();
            if($hours_operation4){
                if(($this->wednesday_closed == false) || ($this->wednesday_closed == null)){
            
                    $this->validate(
                        [
                            'wednesday_open_hour' => ['required'],
                            'wednesday_open_minute' => ['required'],
                            'wednesday_open_time' => ['required'],
                            'wednesday_close_hour' => ['required'],
                            'wednesday_close_minute' => ['required'],
                            'wednesday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation4->is_closed = false;
                    $hours_operation4->is_open = true;
                    $hours_operation4->open_time_hour = $this->wednesday_open_hour ? $this->wednesday_open_hour :'00';
                    $hours_operation4->open_time_minute = $this->wednesday_open_minute ? $this->wednesday_open_minute :'00';
                    $hours_operation4->open_time = $this->wednesday_open_time ? $this->wednesday_open_time :'00';
                    $hours_operation4->close_time_hour = $this->wednesday_close_hour ? $this->wednesday_close_hour :'00';
                    $hours_operation4->close_time_minute = $this->wednesday_close_minute ? $this->wednesday_close_minute :'00';
                    $hours_operation4->close_time = $this->wednesday_close_time ? $this->wednesday_close_time :'00';
                    $hours_operation4->save();
                }
                else{
                    $hours_operation4->is_closed = true;
                    $hours_operation4->is_open = false;
                    $hours_operation4->save();
                }
            }
            else{
                if(($this->wednesday_closed == false) || ($this->wednesday_closed == null)){
            
                    $this->validate(
                        [
                            'wednesday_open_hour' => ['required'],
                            'wednesday_open_minute' => ['required'],
                            'wednesday_open_time' => ['required'],
                            'wednesday_close_hour' => ['required'],
                            'wednesday_close_minute' => ['required'],
                            'wednesday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation4 = new ProviderHoursOperation;
                    $hours_operation4->property_id = $this->propertyid;
                    $hours_operation4->is_closed = false;
                    $hours_operation4->is_open = true;
                    $hours_operation4->open_time_hour = $this->wednesday_open_hour ? $this->wednesday_open_hour :'00';
                    $hours_operation4->open_time_minute = $this->wednesday_open_minute ? $this->wednesday_open_minute :'00';
                    $hours_operation4->open_time = $this->wednesday_open_time ? $this->wednesday_open_time :'00';
                    $hours_operation4->close_time_hour = $this->wednesday_close_hour ? $this->wednesday_close_hour :'00';
                    $hours_operation4->close_time_minute = $this->wednesday_close_minute ? $this->wednesday_close_minute :'00';
                    $hours_operation4->close_time = $this->wednesday_close_time ? $this->wednesday_close_time :'00';
                    $hours_operation4->day = 'wednesday';
                    $hours_operation4->save();
                }
                else{
                    $hours_operation4 = new ProviderHoursOperation;
                    $hours_operation4->property_id = $this->propertyid;
                    $hours_operation4->is_closed = true;
                    $hours_operation4->is_open = false;
                    $hours_operation4->day = 'wednesday';
                    $hours_operation4->save();
                }
            }
               
            
            
            $hours_operation5 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','thursday')->first();
            if($hours_operation5){
                if(($this->thursday_closed == false) || ($this->thursday_closed == null)){
            
                    $this->validate(
                        [
                            'thursday_open_hour' => ['required'],
                            'thursday_open_minute' => ['required'],
                            'thursday_open_time' => ['required'],
                            'thursday_close_hour' => ['required'],
                            'thursday_close_minute' => ['required'],
                            'thursday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation5->is_closed = false;
                    $hours_operation5->is_open = true;
                    $hours_operation5->open_time_hour = $this->thursday_open_hour ? $this->thursday_open_hour :'00';
                    $hours_operation5->open_time_minute = $this->thursday_open_minute ? $this->thursday_open_minute :'00';
                    $hours_operation5->open_time = $this->thursday_open_time ? $this->thursday_open_time :'00';
                    $hours_operation5->close_time_hour = $this->thursday_close_hour ? $this->thursday_close_hour :'00';
                    $hours_operation5->close_time_minute = $this->thursday_close_minute ? $this->thursday_close_minute :'00';
                    $hours_operation5->close_time = $this->thursday_close_time ? $this->thursday_close_time :'00';
                    $hours_operation5->save();
                }
                else{
                    $hours_operation5->is_closed = true;
                    $hours_operation5->is_open = false;
                    $hours_operation5->save();
                }
            }
            else{
                if(($this->thursday_closed == false) || ($this->thursday_closed == null)){
            
                    $this->validate(
                        [
                            'thursday_open_hour' => ['required'],
                            'thursday_open_minute' => ['required'],
                            'thursday_open_time' => ['required'],
                            'thursday_close_hour' => ['required'],
                            'thursday_close_minute' => ['required'],
                            'thursday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation5 = new ProviderHoursOperation;
                    $hours_operation5->property_id = $this->propertyid;
                    $hours_operation5->is_closed = false;
                    $hours_operation5->is_open = true;
                    $hours_operation5->open_time_hour = $this->thursday_open_hour ? $this->thursday_open_hour :'00';
                    $hours_operation5->open_time_minute = $this->thursday_open_minute ? $this->thursday_open_minute :'00';
                    $hours_operation5->open_time = $this->thursday_open_time ? $this->thursday_open_time :'00';
                    $hours_operation5->close_time_hour = $this->thursday_close_hour ? $this->thursday_close_hour :'00';
                    $hours_operation5->close_time_minute = $this->thursday_close_minute ? $this->thursday_close_minute :'00';
                    $hours_operation5->close_time = $this->thursday_close_time ? $this->thursday_close_time :'00';
                    $hours_operation5->day = 'thursday';
                    $hours_operation5->save();
                }
                else{
                    $hours_operation5 = new ProviderHoursOperation;
                    $hours_operation5->property_id = $this->propertyid;
                    $hours_operation5->is_closed = true;
                    $hours_operation5->is_open = false;
                    $hours_operation5->day = 'thursday';
                    $hours_operation5->save();
                }
            }

            $hours_operation6 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','friday')->first();
            if($hours_operation6){
                if(($this->friday_closed == false) || ($this->friday_closed == null)){
            
                    $this->validate(
                        [
                            'friday_open_hour' => ['required'],
                            'friday_open_minute' => ['required'],
                            'friday_open_time' => ['required'],
                            'friday_close_hour' => ['required'],
                            'friday_close_minute' => ['required'],
                            'friday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation6->is_closed = false;
                    $hours_operation6->is_open = true;
                    $hours_operation6->open_time_hour = $this->friday_open_hour ? $this->friday_open_hour :'00';
                    $hours_operation6->open_time_minute = $this->friday_open_minute ? $this->friday_open_minute :'00';
                    $hours_operation6->open_time = $this->friday_open_time ? $this->friday_open_time :'00';
                    $hours_operation6->close_time_hour = $this->friday_close_hour ? $this->friday_close_hour :'00';
                    $hours_operation6->close_time_minute = $this->friday_close_minute ? $this->friday_close_minute :'00';
                    $hours_operation6->close_time = $this->friday_close_time ? $this->friday_close_time :'00';
                    $hours_operation6->save();
                }
                else{
                    $hours_operation6->is_closed = true;
                    $hours_operation6->is_open = false;
                    $hours_operation6->save();
                }
            }
            else{
                if(($this->friday_closed == false) || ($this->friday_closed == null)){
            
                    $this->validate(
                        [
                            'friday_open_hour' => ['required'],
                            'friday_open_minute' => ['required'],
                            'friday_open_time' => ['required'],
                            'friday_close_hour' => ['required'],
                            'friday_close_minute' => ['required'],
                            'friday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation6 = new ProviderHoursOperation;
                    $hours_operation6->property_id = $this->propertyid;
                    $hours_operation6->is_closed = false;
                    $hours_operation6->is_open = true;
                    $hours_operation6->open_time_hour = $this->friday_open_hour ? $this->friday_open_hour :'00';
                    $hours_operation6->open_time_minute = $this->friday_open_minute ? $this->friday_open_minute :'00';
                    $hours_operation6->open_time = $this->friday_open_time ? $this->friday_open_time :'00';
                    $hours_operation6->close_time_hour = $this->friday_close_hour ? $this->friday_close_hour :'00';
                    $hours_operation6->close_time_minute = $this->friday_close_minute ? $this->friday_close_minute :'00';
                    $hours_operation6->close_time = $this->friday_close_time ? $this->friday_close_time :'00';
                    $hours_operation6->day = 'friday';
                    $hours_operation6->save();
                }
                else{
                    $hours_operation6 = new ProviderHoursOperation;
                    $hours_operation6->property_id = $this->propertyid;
                    $hours_operation6->is_closed = true;
                    $hours_operation6->is_open = false;
                    $hours_operation6->day = 'friday';
                    $hours_operation6->save();
                }
            }

            $hours_operation7 = ProviderHoursOperation::where('property_id',$this->propertyid)->where('day','saturday')->first();
            if($hours_operation7){
                if(($this->saturday_closed == false) || ($this->saturday_closed == null)){
            
                    $this->validate(
                        [
                            'saturday_open_hour' => ['required'],
                            'saturday_open_minute' => ['required'],
                            'saturday_open_time' => ['required'],
                            'saturday_close_hour' => ['required'],
                            'saturday_close_minute' => ['required'],
                            'saturday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation7->is_closed = false;
                    $hours_operation7->is_open = true;
                    $hours_operation7->open_time_hour = $this->saturday_open_hour ? $this->saturday_open_hour :'00';
                    $hours_operation7->open_time_minute = $this->saturday_open_minute ? $this->saturday_open_minute :'00';
                    $hours_operation7->open_time = $this->saturday_open_time ? $this->saturday_open_time :'00';
                    $hours_operation7->close_time_hour = $this->saturday_close_hour ? $this->saturday_close_hour :'00';
                    $hours_operation7->close_time_minute = $this->saturday_close_minute ? $this->saturday_close_minute :'00';
                    $hours_operation7->close_time = $this->saturday_close_time ? $this->saturday_close_time :'00';
                    $hours_operation7->save();
                }
                else{
                    $hours_operation7->is_closed = true;
                    $hours_operation7->is_open = false;
                    $hours_operation7->save();
                }
            }
            else{
                if(($this->saturday_closed == false) || ($this->saturday_closed == null)){
            
                    $this->validate(
                        [
                            'saturday_open_hour' => ['required'],
                            'saturday_open_minute' => ['required'],
                            'saturday_open_time' => ['required'],
                            'saturday_close_hour' => ['required'],
                            'saturday_close_minute' => ['required'],
                            'saturday_close_time' => ['required'],
                        ]
                    );
                    $hours_operation7 = new ProviderHoursOperation;
                    $hours_operation7->property_id = $this->propertyid;
                    $hours_operation7->is_closed = false;
                    $hours_operation7->is_open = true;
                    $hours_operation7->open_time_hour = $this->saturday_open_hour ? $this->saturday_open_hour :'00';
                    $hours_operation7->open_time_minute = $this->saturday_open_minute ? $this->saturday_open_minute :'00';
                    $hours_operation7->open_time = $this->saturday_open_time ? $this->saturday_open_time :'00';
                    $hours_operation7->close_time_hour = $this->saturday_close_hour ? $this->saturday_close_hour :'00';
                    $hours_operation7->close_time_minute = $this->saturday_close_minute ? $this->saturday_close_minute :'00';
                    $hours_operation7->close_time = $this->saturday_close_time ? $this->saturday_close_time :'00';
                    $hours_operation7->day = 'saturday';
                    $hours_operation7->save();
                }
                else{
                    $hours_operation7 = new ProviderHoursOperation;
                    $hours_operation7->property_id = $this->propertyid;
                    $hours_operation7->is_closed = true;
                    $hours_operation7->is_open = false;
                    $hours_operation7->day = 'saturday';
                    $hours_operation7->save();
                }
            }
               
            $this->sunday_open_message = '';
            $this->sunday_close_message = '';
            $this->monday_open_message = '';
            $this->monday_close_message = '';
            $this->tuesday_open_message = '';
            $this->tuesday_close_message = '';
            $this->wednesday_open_message = '';
            $this->wednesday_close_message = '';
            $this->thursday_open_message = '';
            $this->thursday_close_message = '';
            $this->friday_open_message = '';
            $this->friday_close_message = '';
            $this->saturday_open_message = '';
            $this->saturday_close_message = '';
        $this->showExternalModal('External Link has been updated successfully');

    }



    public function showExternalModal($text)
    {
        $this->emit('exteralSuccessModal', [
            'text'  => $text,
        ]);
    }
    public function hideExternalSuccessModal()
    {
        $this->emit('hideExternalsuccessModal');
    }
    public function showFloorImages()
    {
        $this->emit('openFloorImagesModal');
    }
    public function submitFloorPlan()
    {

      
        if ($this->floor_image1 != '') {

            $this->validate(
                [
                    'floor_image1' => ['mimes:jpg,jpeg,png']
                ]
            );
        }
        if (($this->floor_image1 != '') && ($this->bedroom_1 != '') && ($this->bathroom_1 != '') && ($this->total_1 != '')) {
           
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->property_id = $this->propertyid;
                $this->provider_plan->bedroom_1 = $this->bedroom_1;
                $this->provider_plan->bathroom_1 = $this->bathroom_1;
                $this->provider_plan->total_1 = $this->total_1;
                $this->provider_plan->save();

                $photo1 = Media::where(['model_id' =>  $this->provider_plan->id, 'collection_name' => 'floorImage1'])->first();
                if ($photo1) {
                    $photo1->delete();
                }

                if ($this->floor_image1 != 'string') {
                    // $provider_plan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                    $this->provider_plan->addMedia($this->floor_image1->getRealPath())
                        ->usingName($this->floor_image1->getClientOriginalName())
                        ->toMediaCollection('floorImage1');
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            } else {
                // dd($this->floor_image1);
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_1 = $this->bedroom_1;
                $floorplan->bathroom_1 = $this->bathroom_1;
                $floorplan->total_1 = $this->total_1;
                $floorplan->save();
                if ($this->floor_image1 != '') {
                    if ($this->floor_image1 != 'string') {
                        // $floorplan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                        $this->floorplan->addMedia($this->floor_image1->getRealPath())
                            ->usingName($this->floor_image1->getClientOriginalName())
                            ->toMediaCollection('floorImage1');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        } else {
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->bedroom_1 = $this->bedroom_1;
                $this->provider_plan->bathroom_1 = $this->bathroom_1;
                $this->provider_plan->total_1 = $this->total_1;
                $this->provider_plan->save();
                if ($this->floor_image1 != '') {
                    if ($this->floor_image1 != 'string') {
                        $photo1 = Media::where(['model_id' => $this->provider_plan->id, 'collection_name' => 'floorImage1'])->first();
                        if ($photo1) {
                            $photo1->delete();
                        }
                        $this->provider_plan->addMedia($this->floor_image1->getRealPath())
                            ->usingName($this->floor_image1->getClientOriginalName())
                            ->toMediaCollection('floorImage1');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            } else {
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_1 = $this->bedroom_1;
                $floorplan->bathroom_1 = $this->bathroom_1;
                $floorplan->total_1 = $this->total_1;
                $floorplan->save();
                if ($this->floor_image1 != '') {
                    if ($this->floor_image1 != 'string') {
                        // $floorplan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                        $this->floorplan->addMedia($this->floor_image1->getRealPath())
                            ->usingName($this->floor_image1->getClientOriginalName())
                            ->toMediaCollection('floorImage1');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        }
        if ($this->floor_image2 != '') {

            $this->validate(
                [
                    'floor_image2' => ['mimes:jpg,jpeg,png']
                ]
            );
        }
        if (($this->floor_image2 != '') && ($this->bedroom_2 != '') && ($this->bathroom_2 != '') && ($this->total_2 != '')) {
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->property_id = $this->propertyid;
                $this->provider_plan->bedroom_2 = $this->bedroom_2;
                $this->provider_plan->bathroom_2 = $this->bathroom_2;
                $this->provider_plan->total_2 = $this->total_2;
                $this->provider_plan->save();
                $photo2 = Media::where(['model_id' => $this->provider_plan->id, 'collection_name' => 'floorImage2'])->first();
                if ($photo2) {
                    $photo2->delete();
                }
                if ($this->floor_image2 != 'string') {
                    // $provider_plan->addMediaFromRequest('floor_image2')->toMediaCollection('floorImage2');
                    $this->provider_plan->addMedia($this->floor_image2->getRealPath())
                        ->usingName($this->floor_image2->getClientOriginalName())
                        ->toMediaCollection('floorImage2');
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            } else {
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_2 = $this->bedroom_2;
                $floorplan->bathroom_2 = $this->bathroom_2;
                $floorplan->total_2 = $this->total_2;
                $floorplan->save();
                if ($this->floor_image2 != '') {
                    if ($this->floor_image2 != 'string') {
                        // $floorplan->addMediaFromRequest('floorImage2')->toMediaCollection('floorImage2');
                        $this->floorplan->addMedia($this->floor_image2->getRealPath())
                            ->usingName($this->floor_image2->getClientOriginalName())
                            ->toMediaCollection('floorImage2');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        } else {
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->bedroom_2 = $this->bedroom_2;
                $this->provider_plan->bathroom_2 = $this->bathroom_2;
                $this->provider_plan->total_2 = $this->total_2;
                $this->provider_plan->save();

                if ($this->floor_image2 != '') {
                    if ($this->floor_image2 != 'string') {
                        $photo1 = Media::where(['model_id' => $this->provider_plan->id, 'collection_name' => 'floorImage2'])->first();
                        if ($photo1) {
                            $photo1->delete();
                        }
                        $this->provider_plan->addMedia($this->floor_image2->getRealPath())
                            ->usingName($this->floor_image2->getClientOriginalName())
                            ->toMediaCollection('floorImage2');
                    }
                    $this->showFloorSuccessModal('Floor Plan updated successfully');
                }
            } else {
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_2 = $this->bedroom_2;
                $floorplan->bathroom_2 = $this->bathroom_2;
                $floorplan->total_2 = $this->total_2;
                $floorplan->save();
                if ($this->floor_image2 != '') {
                    if ($this->floor_image2 != 'string') {
                        // $floorplan->addMediaFromRequest('floorImage2')->toMediaCollection('floorImage2');
                        $this->floorplan->addMedia($this->floor_image2->getRealPath())
                            ->usingName($this->floor_image2->getClientOriginalName())
                            ->toMediaCollection('floorImage2');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        }
        if ($this->floor_image3 != '') {

            $this->validate(
                [
                    'floor_image3' => ['mimes:jpg,jpeg,png'],
                ]
            );
        }
        if (($this->floor_image3 != '') && ($this->bedroom_3 != '') && ($this->bathroom_3 != '') && ($this->total_3 != '')) {
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->property_id = $this->propertyid;
                $this->provider_plan->bedroom_3 = $this->bedroom_3;
                $this->provider_plan->bathroom_3 = $this->bathroom_3;
                $this->provider_plan->total_3 = $this->total_3;
                $this->provider_plan->save();
                $photo3 = Media::where(['model_id' => $this->provider_plan->id, 'collection_name' => 'floorImage3'])->first();
                if ($photo3) {
                    $photo3->delete();
                }
                if ($this->floor_image3 != 'string') {
                    // $provider_plan->addMediaFromRequest('floor_image3')->toMediaCollection('floorImage3');
                    $this->provider_plan->addMedia($this->floor_image3->getRealPath())
                        ->usingName($this->floor_image3->getClientOriginalName())
                        ->toMediaCollection('floorImage3');
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            } else {
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_3 = $this->bedroom_3;
                $floorplan->bathroom_3 = $this->bathroom_3;
                $floorplan->total_3 = $this->total_3;
                $floorplan->save();
                if ($this->floor_image3 != '') {
                    if ($this->floor_image3 != 'string') {
                        // $floorplan->addMediaFromRequest('floorImage3')->toMediaCollection('floorImage3');
                        $this->floorplan->addMedia($this->floor_image3->getRealPath())
                            ->usingName($this->floor_image3->getClientOriginalName())
                            ->toMediaCollection('floorImage3');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        } else {
            $this->provider_plan = ProviderFloorPlan::where('property_id', $this->propertyid)->first();
            if ($this->provider_plan) {
                $this->provider_plan->bedroom_3 = $this->bedroom_3;
                $this->provider_plan->bathroom_3 = $this->bathroom_3;
                $this->provider_plan->total_3 = $this->total_3;
                $this->provider_plan->save();
                if ($this->floor_image3 != '') {
                    if ($this->floor_image3 != 'string') {
                        $photo1 = Media::where(['model_id' => $this->provider_plan->id, 'collection_name' => 'floorImage3'])->first();
                        if ($photo1) {
                            $photo1->delete();
                        }
                        $this->provider_plan->addMedia($this->floor_image3->getRealPath())
                            ->usingName($this->floor_image3->getClientOriginalName())
                            ->toMediaCollection('floorImage3');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            } else {
                $floorplan = new ProviderFloorPlan();
                $floorplan->property_id = $this->propertyid;
                $floorplan->bedroom_3 = $this->bedroom_3;
                $floorplan->bathroom_3 = $this->bathroom_3;
                $floorplan->total_3 = $this->total_3;
                $floorplan->save();
                if ($this->floor_image3 != '') {
                    if ($this->floor_image3 != 'string') {
                        // $floorplan->addMediaFromRequest('floorImage3')->toMediaCollection('floorImage3');
                        $this->floorplan->addMedia($this->floor_image3->getRealPath())
                            ->usingName($this->floor_image3->getClientOriginalName())
                            ->toMediaCollection('floorImage3');
                    }
                }
                $this->showFloorSuccessModal('Floor Plan updated successfully');
            }
        }
    }


    public function showFloorSuccessModal($text)
    {
        $this->emit('floorSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideFloorSuccessModal()
    {
        $this->emit('hideFloorsuccessModal');
    }

    public function deleteimage1()
    {
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage1'])->first();
        if ($imageone) {
            $imageone->delete();
            $this->showDeleteImageSuccessModal('Floor Plan Image deleted successfully');
        }
    }

    public function deleteimage2()
    {
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage2'])->first();
        if ($imageone) {
            $imageone->delete();
            $this->showDeleteImageSuccessModal('Floor Plan Image deleted successfully');
        }
    }

    public function deleteimage3()
    {
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage3'])->first();
        if ($imageone) {
            $imageone->delete();
            $this->showDeleteImageSuccessModal('Floor Plan Image deleted successfully');
        }
    }

    public function clearAll1()
    {

        $this->floor_plan->bedroom_1 = null;
        $this->floor_plan->bathroom_1 = null;
        $this->floor_plan->total_1 = null;
        $this->floor_plan->save();
        if($this->floor_plan){
        $this->bedroom_1 =  null;
        $this->bathroom_1 =  null;
        $this->total_1 =  null;
        }
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage1'])->first();
        if ($imageone) {
            $imageone->delete();
        }
    }

    public function clearAll2()
    {
        $this->floor_plan->bedroom_2 = null;
        $this->floor_plan->bathroom_2 = null;
        $this->floor_plan->total_2 = null;
        $this->floor_plan->save();
        if($this->floor_plan){
            $this->bedroom_2 =  null;
            $this->bathroom_2 =  null;
            $this->total_2 =  null;
        }
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage2'])->first();
        if ($imageone) {
            $imageone->delete();
        }
    }

    public function clearAll3()
    {
        $this->floor_plan->bedroom_3 = null;
        $this->floor_plan->bathroom_3 = null;
        $this->floor_plan->total_3 = null;
        $this->floor_plan->save();
        if($this->floor_plan){
            $this->bedroom_3 =  null;
            $this->bathroom_3 =  null;
            $this->total_3 =  null;
        }
        $imageone = Media::where(['model_id' => $this->floor_plan->id, 'collection_name' => 'floorImage3'])->first();
        if ($imageone) {
            $imageone->delete();
        }
    }
    public function updatedListingImages()
    {
        if ($this->listing_images) {
            $this->validate([
                'listing_images.*' => 'image|mimes:jpg,jpeg,png|max:10240', // 25MB Max
            ]);
            foreach ($this->listing_images as $photos) {
                $this->getProperty = Provider::find($this->propertyid);
                $this->getProperty->addMedia($photos->getRealPath())
                    ->usingName($photos->getClientOriginalName())
                    ->toMediaCollection('propertyPhoto');
            }
            $this->model_images = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyPhoto'])->get();
        }
    }

    public function makeEditMainPhoto($image_id)
    {
        $mediaImg = Media::find($image_id);
        if ($mediaImg) {
            $url = $mediaImg->getUrl();
            $this->getProperty = Provider::find($this->propertyid);
            if ($this->getProperty) {
                $this->getProperty->main_image = $url;
                $this->getProperty->save();
            }
            $this->reset('main_image');
            $this->main_image = $url;
        }
    }

    public function deleteEditMainPhoto($propertyid)
    {
        //dd($hotel_id);
        $providerMainImg = Provider::find($propertyid);
        // dd($shortMainImg);
        if ($providerMainImg) {
            $providerMainImg->main_image = null;
            $providerMainImg->save();
            $this->reset('main_image');
        }
    }


    public function deleteEditListPhoto($image_id)
    {
        //    dd($image_id);
        // $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'imageDeleteConfirm', ['id' => $image_id]); //($type,$title,$text,$confirmText,$method)

        $this->image_id = $image_id;
        $this->emit('showRemoveImageModal', ['text' => 'Are you sure? Do you want to remove this image?']);
    }

    public function removePropertyImage()
    {
        $getmediaImg = Media::find($this->image_id);
        $providerList = Provider::find($this->propertyid);
        // dd($getmediaImg->getUrl());
        if ($providerList->main_image == $getmediaImg->getUrl()) {
            $providerList->main_image = '';
            $providerList->save();
            $this->main_image = '';
        }
        Media::destroy($this->image_id);
        $this->model_images = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyPhoto'])->get();
        $this->emit('hideRemoveImageModal');
    }
    public function updatedListingVideos()
    {
        $this->validate([
            'listing_videos' => 'max:10240', // 25MB Max
        ], [
            'listing_videos.max' => 'The upload media may not be greater than 25 MB'
        ]);
        if ($this->listing_videos) {

            $getprovider = Provider::find($this->propertyid);
            if ($this->listing_videos != 'string') {
                $model_video = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyVideo'])->first();
                if ($model_video) {
                    $model_video->delete();
                    $getprovider->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('propertyVideo');
                } else {
                    $getprovider->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('propertyVideo');
                }
            }
        }
        $this->model_video = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyVideo'])->first();
    }

    public function deleteEditMedia()
    {
        $this->emit('showRemoveMediaModal', ['text' => 'Are you sure? Do you want to remove this media?']);
    }

    public function removePropertyVideo()
    {
        $video = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyVideo'])->first();
        if ($video) {
            $video->delete();
        }
        $this->model_video = Media::where(['model_id' => $this->propertyid, 'collection_name' => 'propertyVideo'])->first();
        $this->emit('hideRemoveMediaModal');
    }

    public function showDeleteImageSuccessModal($text)
    {
        $this->emit('deleteImageModal', [
            'text'  => $text,
        ]);
    }
    public function hideDeleteModal()
    {
        $this->emit('hidedeleteModal');
    }

    private function resetForm()
    {
        $this->resetErrorBag();
    }

    public function enableqrcodebutton(){
        $this->emit('enableqrcodeModal');
    }

    public function searchUnit(){
        // dd('ffddf');
        if(!empty($this->search_unit)){
            if($this->select_building == 'all'){

                $this->result = BuildingUnit::where('status',1)
                                ->where('unit','like','%'.trim($this->search_unit).'%')
                                ->orderBy('unit','asc')
                                ->get();
                $this->showdiv = true;
                
            }
            else{
                $this->result = BuildingUnit::where('status',1)
                                ->where('unit','like','%'.trim($this->search_unit).'%')
                                ->where('building_id',$this->select_building)
                                ->orderBy('unit','asc')
                                ->get();

                $this->showdiv = true;
            }

            
        }
        else{
            $this->showdiv = false;
        }
    }

    public function autocompleteUnitSelect($unit_id){
        $building_unit = BuildingUnit::find($unit_id);
        if($building_unit->unit != null){
            $this->selected_unit_name = $building_unit->unit;
        }
        else{
            $this->selected_unit_name = $building_unit->buildings->building_name;
        }
    
        $this->search_unit = $building_unit->unit;
        $this->selected_unit_id = $building_unit->id;
        $this->showdiv = false;
        // session()->put('apartUnitId', $unit_id);
        // Session::put('apartUnitId', $unit_id);
        $text = url('apartment/'.$building_unit->buildings->provider_type_id);
        // $text1 = url('apartment/'.$encode_id);

        $encode_provider_id = base64_encode($building_unit->buildings->provider_type_id);
        $encoded_unit_id = base64_encode($unit_id);
        
        $this->text1 = url('apartment-view/'.$encode_provider_id.'/'.$encoded_unit_id);
        // $dd =  url('apartment/'.$encode_provider_id.'/'.$encoded_unit_id);
        // dd($building_unit->buildings->provider_type_id,$unit_id,$encode_provider_id,$encoded_unit_id,$this->text1,$dd);
        //dd($unit_id);
            
        $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($this->text1);
        $this->qr_image = base64_encode($image);
    }

    public function resetUnit(){
        $this->selected_unit_name = '--';
        $this->selected_unit_id = '';
        $this->search_unit = '';
        $this->text = '';
        $this->qr_image = '';
        $this->select_building = 'all';
    }

    public function updateTermLimit($limit){
       
        if($limit){
           // dd($limit);
            if($this->propertyid){
                $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                if($limit_settings){
                    $limit_settings->term_limit = $limit;
                    $limit_settings->save();
                    $this->term_limit = $limit;
                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->term_limit = $limit;
                    $limit_settings->property_id = $this->propertyid;
                    $limit_settings->save();
                    $this->term_limit = $limit;
                }
            }
        }
    }

    public function updateFrequency($limit){
        if($limit){
            // dd($limit);
             if($this->propertyid){
                 $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                 if($limit_settings){
                     $limit_settings->frequency = $limit;
                     $limit_settings->save();
                     $this->frequency_limit = $limit;
                 }
                 else{
                     $limit_settings = new ProviderLimitSetting;
                     $limit_settings->frequency = $limit;
                     $limit_settings->property_id = $this->propertyid;
                     $limit_settings->save();
                     $this->frequency_limit = $limit;
                 }
             }
         }
    }

    public function render()
    {
        if($this->text1 != ''){
            $text1 = $this->text1;
            return view('livewire.frontend.property-manager.settings',['text1'=>$text1]);
        }else{
            return view('livewire.frontend.property-manager.settings');
        }
        
    }
}
