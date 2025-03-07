<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use App\Models\MerchantLocation;
use App\Models\BusinessLocation;
use Illuminate\Support\Facades\Auth;
use App\Models\Deal;
use App\Models\DealLocation;
use App\Models\MerchantLoyaltyProgram;
use App\Models\LoyaltyRewardLocation;
use App\Models\ConsumerLoyaltyReward;
use App\Models\ItemOrService;
use App\Models\GiftManage;
use App\Models\GiftItemValue;
use App\Models\Transaction;
use Session;
use App\Models\ConsumerGift;
use App\Models\MerchantAutomaticGiftSetting;
use Spatie\MediaLibrary\Models\Media;
use Livewire\WithFileUploads;



class CampaignManagement extends Component
{
    use WithFileUploads;

    public $merchant_location,$business_locations, $location,$merchant_main_location, $deals, $previewDeal, $deal_locations=[], $select_location, $otherLocation = [];
    public $end_date, $deal_status, $logo_image,$upload_deal_image,$loyalty_logo_image, $loyalty_address, $program_name, $loyalty_image_upload;
    public $programs=[], $select_program, $other_program_locations = [], $program_location;
    public $tab = '', $program_date_difference, $select_program_location,$show_remove_date;
    public $consumerLoyalty,$itemTransaction, $items=[], $giftids =[], $item_id,$gift_item_name, $is_other_item = false, $gifts = [], $value_one,$value_two, $note, $receipt_no;
    public $price_show, $price, $removeid, $action_type, $action_value=[], $program_status,$select_gift, $merchant_gift_setting;
    public $progress_status,$progress_gift_id,$program_progress,$completion_status,$completion_gift_id,$program_number,$program_within,$program_timeframe,$birthday_incentive_status,$birthday_gift_id;

    public function mount(){
        $this->merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get(); 
        $this->business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type','Participating')->get();
        foreach ($this->merchant_location as $locations){
            if($locations->is_main == 1){
              
                if($locations->state_id != null){
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->state_id->name.', '.$locations->businessLocation->zip_code;
                    $this->merchant_main_location = $locations->businessLocation->id ;
                }else{
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->state_name.', '.$locations->businessLocation->zip_code;
                    $this->merchant_main_location = $locations->businessLocation->id ;
                }
               
            }
        }
        $this->deals = Deal::where('business_id', Auth::user()->business_id)->where('is_complete', 1)->orderBy('id','desc')->get();
        $this->previewDeal = '';
        $today = date('Y-m-d');
        // $this->programs = MerchantLoyaltyProgram::where('end_on', '>', $today)
        //                     ->orWhere('end_on','=',null)
        //                     ->where('business_profile_id', Auth::user()->business_id)
        //                     ->where('status', 1)->orderBy('id','desc')->get();
        // dd($this->programs);

        $this->programs = MerchantLoyaltyProgram::where(function ($query) use ($today) {
            $query->where('end_on', '>', $today)
                  ->orWhere('end_on', '=', null);
        })
        ->where('business_profile_id', Auth::user()->business_id)
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

        
        $this->consumerLoyalty = ConsumerLoyaltyReward::with('location')->whereNotNull('loyalty_reward_id')->where('status', 1)->get();
        $this->select_program = '';
        
        if(Session::has('tab')){
            $this->tab = Session::get('tab');
        }
        else{
            $this->tab = 'nav-deal';
        }
        // dd( $this->tab );
        $this->program_date_difference = '';
        $this->select_program_location = '';
        $this->show_remove_date = '';
        $this->giftids = GiftManage::where('merchant_id', Auth::user()->id)->get()->pluck('item_id');
        $this->items = ItemOrService::where('business_category_id', Auth::user()->merchantBusiness->business_category_id)
                        ->whereNotIn('id', $this->giftids)->whereIn('added_by', array(1, Auth::user()->id))->get();
        // dd($this->items); 
        $this->gifts = GiftManage::orderBy('id', 'desc')->where('merchant_id', Auth::user()->id)->where('status', 1)->get();
        foreach($this->gifts as $item){
            $this->price_show[$item->id] = false;
        }
        $this->itemTransaction = Transaction::whereHas('consumerloyalty',function($q){
            $q->whereNotNull('loyalty_reward_id');
        })->where('status', 1)->get();
        $this->merchant_gift_setting = MerchantAutomaticGiftSetting::where('business_id',Auth::user()->merchantBusiness->id)->first();
        if($this->merchant_gift_setting){
            $this->progress_status = $this->merchant_gift_setting->progress_status;
            $this->progress_gift_id = $this->merchant_gift_setting->progress_gift_id;
            $this->program_progress = $this->merchant_gift_setting->program_progress;
            $this->completion_status = $this->merchant_gift_setting->completion_status;
            $this->completion_gift_id = $this->merchant_gift_setting->completion_gift_id;
            $this->program_number = $this->merchant_gift_setting->program_number;
            $this->program_within = $this->merchant_gift_setting->program_within;
            $this->program_timeframe = $this->merchant_gift_setting->program_timeframe;
            $this->birthday_incentive_status = $this->merchant_gift_setting->birthday_incentive_status;
            $this->birthday_gift_id = $this->merchant_gift_setting->birthday_gift_id;
        }


    }

    public function changetab($type){
        $this->tab = $type;
    }

    public function getLocationDetail(){
        if($this->merchant_main_location != ''){
            $get_location = BusinessLocation::with('states')->find($this->merchant_main_location);
            if($get_location){
                if($get_location->states){
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->states->name.', '.$get_location->zip_code;
                }
                else{
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->state_name.', '.$get_location->zip_code;
                }
                
            }
        }
    }

    public function previewDeal($deal_id){
        if($deal_id){
            $this->previewDeal = Deal::with('dealLocation','dealLocation.location','dealLocation.location.states','businessProfile')->find($deal_id);
            if($this->previewDeal->deal_image != ""){
                $this->logo_image = $this->previewDeal->deal_image;
            }else{
                if($this->previewDeal->businessProfile->logo_image != ''){
                    $this->logo_image = $this->previewDeal->businessProfile->logo_image;
                }else{
                    $this->logo_image = asset('frontend_assets/images/business_image.png');;
                }
            }     
        }
        $this->emit('openDealModal');
    }

    public function UpdatedUploadDealImage(){
        $this->validate([
            'upload_deal_image' => 'required',
            'upload_deal_image.*'=> 'mimes:png,jpg|max:25600'
        ], [
            'upload_deal_image.required' => 'select at least one image for deal',
            'upload_deal_image.*.mimes' => 'Image file should be  jpg and png type',
            'upload_deal_image.*.max' => 'Image file size may not be greater than 25 mb',
        ]);

        $deal_photo = $this->previewDeal->addMedia($this->upload_deal_image->getRealPath())
            ->usingName($this->upload_deal_image->getClientOriginalName())
            ->toMediaCollection('dealPhotos');

        $this->previewDeal->main_image = '/storage/'.$deal_photo->id.'/'.$deal_photo->file_name;
        $this->previewDeal->save();

        $this->logo_image = $this->previewDeal->main_image;
        
    }

    

    public function previewProgram($program_id){
        // dd($program_id);
        $this->loyalty_programs = MerchantLoyaltyProgram::with('businessProfile','loyaltylocations','loyaltylocations.locations','loyaltylocations.locations.states')
        ->where('id',$program_id)
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->first();

        if($this->loyalty_programs){
            if($this->loyalty_programs->program_name){
                $this->program_name = $this->loyalty_programs->program_name;
            }else{
                $this->program_name = '';
            }
            $this->loyalty_address = $this->loyalty_programs->loyaltylocations[0]->locations->address.', '. $this->loyalty_programs->loyaltylocations[0]->locations->zip_code;
            if($this->loyalty_programs->loyalty_image != ""){
                $this->loyalty_logo_image = $this->loyalty_programs->loyalty_image;
            }else{
                if($this->loyalty_programs->businessProfile->logo_image != ''){
                    $this->loyalty_logo_image = $this->loyalty_programs->businessProfile->logo_image;
                }else{
                    $this->loyalty_logo_image = asset('frontend_assets/images/business_image.png');
                }
            }
        }else{
            $this->loyalty_logo_image = asset('frontend_assets/images/business_image.png');
            $this->loyalty_address = "";
        }
        
        $this->emit('openLoyalityModal');
    }
    public function UpdatedLoyaltyImageUpload(){
        // dd('12',$this->loyalty_image_upload);
        $this->validate([
            'loyalty_image_upload' => 'required',
            'loyalty_image_upload.*'=> 'mimes:png,jpg|max:25600'
        ], [
            'loyalty_image_upload.required' => 'select at least one image for deal',
            'loyalty_image_upload.*.mimes' => 'Image file should be  jpg and png type',
            'loyalty_image_upload.*.max' => 'Image file size may not be greater than 25 mb',
        ]);

        $loyalty_photo = $this->loyalty_programs->addMedia($this->loyalty_image_upload->getRealPath())
            ->usingName($this->loyalty_image_upload->getClientOriginalName())
            ->toMediaCollection('loyaltyPhotos');

            $this->loyalty_programs->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
            $this->loyalty_programs->save();

            $this->loyalty_logo_image = $this->loyalty_programs->main_photo;
    }

    public function getLocation($deal_id){
        $this->deal_locations = DealLocation::with('deal', 'location')->where('deal_id',$deal_id)->where('status',1)->get();
        $locationids = $this->deal_locations->pluck('location_id');
        $this->previewDeal = '';
        $this->previewDeal = Deal::find($deal_id);
        $this->otherLocation = BusinessLocation::where('business_profile_id',Auth::user()->business_id)
                                ->whereNotIn('id',$locationids)
                                ->where('status',1)->get();
        $this->emit('openDealLocationModal');
    }

    public function addDealLocation(){
        if($this->select_location != ''){
            $location = BusinessLocation::find($this->select_location);
            if($location){
                $exist_location = DealLocation::where('location_id',$this->select_location)->where('deal_id',$this->previewDeal->id)->count();
                if($exist_location > 0){
                    $this->emit('messageModal', [
                        'text'  => 'Please select another location',
                    ]); 
                }
                else{
                    $deal_location = new DealLocation;
                    $deal_location->deal_id = $this->previewDeal->id;
                    $deal_location->location_id = $this->select_location;
                    $deal_location->participating_type = 'Participating';
                    $deal_location->status = 1;
                    $deal_location->save();
                }
               
            }
            $this->deal_locations = DealLocation::with('deal', 'location')->where('deal_id',$this->previewDeal->id)->where('status',1)->get();
            $locationids = $this->deal_locations->pluck('location_id');
            $this->otherLocation = BusinessLocation::where('business_profile_id',Auth::user()->business_id)
                                ->whereNotIn('id',$locationids)
                                ->where('status',1)->get();
            $this->select_location = '';
            $this->emit('messageModal', [
                'text'  => 'Deal location added successfully',
            ]);                    
        }
        else{
            $this->emit('messageModal', [
                'text'  => 'Please select a location',
            ]); 
        }
    }

    public function endDeal($deal_id){
        if($deal_id){
            $this->previewDeal = '';
            $this->previewDeal = Deal::find($deal_id);
            $this->emit('openEndDateModal');
        }
    }

    public function scheduleEndDate(){
        $date=date("Y-m-d");
        // date_add($date,date_interval_create_from_date_string("8 days"));
        $this->end_date = date('m/d/Y', strtotime($date.' + 8 days'));;
        $this->emit('openScheduleDateModal');
    }

    public function setDealEndDate(){
        if($this->end_date != ''){
           if($this->previewDeal != ''){
                $showstartdate = date_format(date_create($this->previewDeal->start_Date),'m/d/Y');
                $this->validate(
                    [
                        'end_date' => ['required','after:'.$showstartdate]
                    ],
                    [
                        'end_date.required' => "The end date is required",
                        'end_date.after' => 'The end date must be a date after ' . $showstartdate,
                    ]
                );
                $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y',$this->end_date)->format('Y-m-d');
                $this->previewDeal->end_Date = $enddate;
                $this->previewDeal->save();
                $this->previewDeal = '';
                $this->deals = Deal::where('business_id', Auth::user()->business_id)->where('is_complete', 1)->orderBy('id', 'desc')->get();
                $this->emit('scheduleSuccessModal', [
                    'text'  => 'Deal end date set successfully',
                ]); 
           }

        }
        else{
            $this->emit('scheduleSuccessModal', [
                'text'  => 'No end date set',
            ]);  
        }
    }

    public function showEndDate(){
        $date=date("Y-m-d");
        $this->end_date = date('m/d/Y', strtotime($date.' + 14 days'));
        $this->emit('openShowDateModal');
    }

    public function scheduleToEnd($deal_id){
        if($deal_id){
            $this->previewDeal = '';
            $this->previewDeal = Deal::find($deal_id);
            $this->end_date = date('m/d/Y', strtotime($this->previewDeal->end_Date));
            $this->emit('extendModal',['date' => $this->previewDeal->end_Date ]);
        }
    }

    public function extendDeal($deal_id){
        if($deal_id){
            $this->previewDeal = '';
            $this->previewDeal = Deal::find($deal_id);
            $date=$this->previewDeal->end_Date;
            $this->end_date = date('m/d/Y', strtotime($date.' + 1 days'));
            $this->emit('extendModal',['date' => $this->end_date ]);
        }
    }

    public function dealByStatus(){
        if($this->deal_status != ''){
            $this->deals = '';
            $this->deals = Deal::where('business_id', Auth::user()->business_id)->where('is_complete', 1)->orderBy('created_at',$this->deal_status)->get();
        }
    }


    public function programLocation($program_id){
        if($program_id){
            $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($program_id);
            if ($this->select_program) {
                $today = date_create(date('Y-m-d'));
                $end_date = date_create($this->select_program->end_on);
                $diff=date_diff($today,$end_date);
                $this->program_date_difference = $diff->format("%a");
                $locationids = $this->select_program->loyaltylocations->pluck('location_id');
                $this->other_program_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $locationids)->where('status', 1)->get();
                $this->emit('openProgramLocationModal');
            }
        }
                   
    }

    public function addLocationToProgram(){
        if($this->program_location != ''){
            $today = date('Y-m-d');
            if ($this->select_program->end_on != null) {
                $enddate = date_create($this->select_program->end_on);
                $todaydate = date_create($today);
                $diff = date_diff($enddate, $todaydate);
                $days = $diff->format('%a');
                if (($this->select_program->end_on > $today) && ($days <= 14)) {
                    $this->emit('daysLeftModal'); 
                } else {
                    $reward_location = new LoyaltyRewardLocation;
                    $reward_location->loyalty_program_id = $this->select_program->id;
                    $reward_location->location_id = $this->program_location;
                    $reward_location->status = 1;
                    $reward_location->save();
                    if ($reward_location) {
                        $this->program_location = '';
                        $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($this->select_program->id);
                        $this->emit('messageModal', [
                            'text'  => 'Location added to this program successfully',
                        ]); 
                    } else {
                        $this->program_location = '';
                        $this->emit('messageModal', [
                            'text'  => 'Program not found',
                        ]);
                    }
                }
            }
            else{
                $reward_location = new LoyaltyRewardLocation;
                $reward_location->loyalty_program_id = $this->select_program->id;
                $reward_location->location_id = $this->program_location;
                $reward_location->status = 1;
                $reward_location->save();
                if ($reward_location) {
                    $this->program_location = '';
                    $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($this->select_program->id);
                    $this->emit('messageModal', [
                        'text'  => 'Location added to this program successfully',
                    ]); 
                } else {
                    $this->program_location = '';
                    $this->emit('messageModal', [
                        'text'  => 'Program not found',
                    ]);
                }
            }
        }
    }

    public function endProgram($program_id){
        // dd($program_id);
        $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($program_id);
        // dd($this->select_program);
        $this->emit('openEndProgramModal');
    }

    public function programScheduleEnd(){
        $this->end_date = '';
        $date=date("Y-m-d");
        $this->end_date = date('m/d/Y', strtotime($date.' + 31 days'));
        $this->emit('openScheduleEndModal',['end_date' => $this->end_date ]);
    }

    public function setProgramEndDate(){
        if ($this->select_program ) {
            // dd($this->end_date);
            $today = date('Y-m-d');
            $startdate = date_create($this->select_program ->start_on);
            $showstartdate = date_format($startdate, 'm/d/Y');
            $this->validate(
                [
                    'end_date' => ['required','after:'.$showstartdate]
                ],
                [
                    'end_date.required' => "The end date is required",
                    'end_date.after' => 'The end date must be a date after ' . $showstartdate,
                ]
            );
            $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y',$this->end_date)->format('Y-m-d');
            $this->select_program->end_on = $enddate;
            $this->select_program->save();
            $locations = LoyaltyRewardLocation::where('loyalty_program_id', $this->select_program->id)
                        ->where('end_date', null)->get();
            if (count($locations)) {
                foreach ($locations as $locationData) {
                    $locationid = $locationData->id;
                    $loyalty_location = LoyaltyRewardLocation::find($locationid);
                    $loyalty_location->end_date = $enddate;
                    $loyalty_location->save();
                }
            }
            $this->programs = MerchantLoyaltyProgram::where('end_on', '>', $today)
                            ->where('business_profile_id', Auth::user()->business_id)
                            ->where('status', 1)->orWhere('end_on','=',null)->orderBy('id','desc')->get();
                            
            $this->select_program = '';
            $this->emit('scheduleEndSuccessModal', [
                'text'  => 'Program end date set successfully',
            ]);
        }
    }

    public function yesSetEndDate(){
        // dd($this->select_program);
        if($this->select_program){
            if($this->select_program->end_on != ''){
                $this->end_date = date('m/d/Y', strtotime($this->select_program->end_on));
                $this->emit('openSetEndModal',['end_date' => $this->end_date ]);
            }
            else{
                $date=date("Y-m-d");
                $this->end_date = date('m/d/Y', strtotime($date.' + 30 days'));
                $this->emit('openSetEndModal',['end_date' => $this->end_date ]);
            }
        }
    }

    public function extendprogram($program_id){
        $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($program_id);
        if($this->select_program){
            if($this->select_program->end_on != ''){
                $date=$this->select_program->end_on;
                $this->end_date = date('m/d/Y', strtotime($date.' + 1 days')); 
            }
            else{
                $date=date("Y-m-d");
                $this->end_date = date('m/d/Y', strtotime($date.' + 2 days'));
            }
        }
        $this->emit('openScheduleEndModal',['end_date' => $this->end_date]);
    }

    public function scheduleToEndProgram($program_id){
        $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($program_id);
        if($this->select_program){
            if($this->select_program->end_on != ''){
                $date=$this->select_program->end_on;
                $this->end_date = date('m/d/Y', strtotime($date)); 
            }
            else{
                $date=date("Y-m-d");
                $this->end_date = date('m/d/Y', strtotime($date));
            }
        }
        $this->emit('openScheduleEndModal',['end_date' => $this->end_date]);
    }

    public function removeLocation($program_location_id){
        if($program_location_id){
            $this->select_program_location = LoyaltyRewardLocation::find($program_location_id);
        }
        $this->emit('openRemoveLocationModal');
    }

    public function scheduleLocationDate(){
        $date=date("Y-m-d");
        $this->end_date = date('m/d/Y', strtotime($date.' + 31 days'));
        $this->emit('openLocationSetEndModal',['end_date' => $this->end_date ]);
    }

    public function setProgramLocationEndDate(){
        if($this->select_program_location != ''){
            $merchant_program = MerchantLoyaltyProgram::find($this->select_program_location->loyalty_program_id);
            if($merchant_program){
                $showlocationdate = date_format(date_create($this->select_program_location->end_date), 'm/d/Y');
                if ($merchant_program->end_on != null) {
                    $showenddate = date_format(date_create($merchant_program->end_on), 'm/d/Y');
                    $resetenddate = date('Y-m-d', strtotime($merchant_program->end_on . ' + 1 days'));
                    $this->validate(
                        [
                            "end_date"  =>  'required|after:' . $this->select_program_location->end_date . '|before:' . $resetenddate,
                        ],
                        [
                            "end_date.required" => 'The end date is required',
                            "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                            "end_date.before" => 'The end date must be a date on or before ' . $showenddate,
                        ]
                    );
                    $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $this->end_date)->format('Y-m-d');
                    $this->select_program_location->end_date = $enddate;
                    $this->select_program_location->save();
                }
                else {
                    $this->validate(
                        [
                            "end_date"  =>  'required|after:' . $this->select_program_location->end_date,
                        ],
                        [
                            "end_date.required" => 'The end date is required',
                            "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                        ]
                    );
                        $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $this->end_date)->format('Y-m-d');
                        $this->select_program_location->end_date = $enddate;
                        $this->select_program_location->save();                    
                }
            }
            $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($this->select_program_location->loyalty_program_id);
            $this->emit('successLocationDateModal');
        }
    }

    public function LocationEndDate(){
        if($this->select_program_location){
            $merchant_program = MerchantLoyaltyProgram::find($this->select_program_location->loyalty_program_id);
            if($merchant_program){
                $today = date('Y-m-d');
                if ($merchant_program->end_on != null) {
                    if ($this->select_program_location->end_date != null) {
                        $enddate = date_create($this->select_program_location->end_date);
                        $todaydate = date_create($today);
                        $diff = date_diff($enddate, $todaydate);
                        $locationdays = $diff->format('%a');
                        if ($locationdays > 30) {
                            $this->show_remove_date = date_format($enddate, 'm/d/Y');
                        } else {
                            $programenddate = date_create($merchant_program->end_on);
                            $this->show_remove_date = date_format($programenddate, 'm/d/Y');
                        }
                    }else {
                        $programenddate = date_create($merchant_program->end_on);
                        $this->show_remove_date = date_format($programenddate, 'm/d/Y');
                    }
                } 
                else {
                    $programenddate = date_create($merchant_program->end_on);
                    $this->show_remove_date = date_format($programenddate, 'm/d/Y');
                }
            }
        }
        $this->end_date = date('m/d/Y', strtotime($today.' + 30 days'));
     //   dd($this->end_date);
        $this->emit('openRemoveYesModal',['end_date' => $this->end_date]);
    }

    public function setLocationEndDate(){
        if($this->select_program_location){
            $merchant_program = MerchantLoyaltyProgram::find($this->select_program_location->loyalty_program_id);
            $today = date('Y-m-d');
            $showstartdate = date_format(date_create($merchant_program->start_on), 'm/d/Y');
            $this->validate(
                [
                    "end_date"  =>  'required|after:' . $merchant_program->start_on
                ],
                [
                    "end_date.required" => 'The end date is required',
                    "end_date.after" => 'The end date must be a date after ' . $showstartdate,
                ]
            );
            $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $this->end_date)->format('Y-m-d');
            $this->select_program_location->end_date = $enddate;
            $this->select_program_location->save();     
        }
        $this->select_program = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($this->select_program_location->loyalty_program_id);
        $this->emit('successLocationDateModal');
    }

    public function getItem(){
        if($this->item_id != ''){
            if($this->item_id == 'add_new'){
                $this->is_other_item = true;
            }
            else{
                $this->is_other_item = false;
            }
        }
    }

    public function openAddManageGift(){
        $this->emit('addManageGift');
    }

    public function addGift(){
        $this->validate(
            [
                'item_id' => ['required'],
                'gift_item_name' => ['required_if:item_id,=,add_new'],
                'value_one' => ['required', 'numeric'],
                'value_two' => ['nullable', 'numeric'],
                'note' => ['nullable'],
            ],
            [
                'item_id.required' => "Please select a item",
                'gift_item_name.required_if' => "The gift name field is required when you select add new gift",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
                'value_two.numeric' => "The Amount should be number",
            ]
        );
        if($this->value_two != '')
        {
            $value = $this->value_one.'.'.$this->value_two;
        }
        else{
            $value = $this->value_one;
        }
        $giftManage = new GiftManage();
        if ($this->item_id == 'add_new') {
            
            $giftManage->gift_name = $this->gift_item_name;
            $giftManage->business_category_id = Auth::user()->merchantBusiness->business_category_id;
            if ($this->note != '') {
                $giftManage->note = $this->note;
            }
            $giftManage->merchant_id = Auth::user()->id;
            $giftManage->save();
            
            if ($value != '') {
                $giftvalue = new GiftItemValue;
                $giftvalue->gift_id = $giftManage->id;
                $giftvalue->price = $value;
                $giftvalue->merchant_id = Auth::user()->id;
                $giftvalue->save();
            }

            $addItemGift = new ItemOrService();
            $addItemGift->item_name =  $giftManage->gift_name;
            $addItemGift->business_category_id = Auth::user()->merchantBusiness->business_category_id;
            if ($this->note != '') {
                $addItemGift->note = $this->note;
            }
            $addItemGift->is_checked = 1;
            $addItemGift->added_by = Auth::user()->id;
            $addItemGift->merchant_id = Auth::user()->id;
            $addItemGift->save();
            if ($value != '') {
                $itemvalue = new GiftItemValue;
                $itemvalue->item_id = $addItemGift->id;
                $itemvalue->price = $value;
                $itemvalue->merchant_id = Auth::user()->id;
                $itemvalue->save();
            }
            if ($addItemGift) {
                $giftManage->item_id = $addItemGift->id;
                $giftManage->save();
            }
        }
        else{
            $getItem = ItemOrService::find($this->item_id);
            if($getItem){
                $getItem->is_checked = 1;
                $getItem->save();
                $giftManage->gift_name = $getItem->item_name;
                $giftManage->gift_value = $value;
                $giftManage->item_id = $this->item_id;
                $giftManage->business_category_id = Auth::user()->merchantBusiness->business_category_id;
                if ($this->note != '') {
                    $giftManage->note = $this->note;
                }
                $giftManage->merchant_id = Auth::user()->id;
                $giftManage->save();
            }
            if ($value != '') {
                $giftvalue = new GiftItemValue;
                $giftvalue->gift_id = $giftManage->id;
                $giftvalue->price = $value;
                $giftvalue->merchant_id = Auth::user()->id;
                $giftvalue->save();
            }
        }
        $this->item_id = ''; 
        $this->gift_item_name = '';
        $this->is_other_item = false;
        $this->value_one = '';
        $this->value_two = '';
        $this->giftids = GiftManage::where('merchant_id', Auth::user()->id)->get()->pluck('item_id');
        $this->items = ItemOrService::where('business_category_id', Auth::user()->merchantBusiness->business_category_id)
                        ->whereNotIn('id', $this->giftids)->whereIn('added_by', array(1, Auth::user()->id))->get();
        $this->gifts = GiftManage::orderBy('id', 'desc')->where('merchant_id', Auth::user()->id)->where('status', 1)->get();
        foreach($this->gifts as $item){
            $this->price_show[$item->id] = false;
        }
        $this->emit('messageModal',['text' => 'Gift Updated successfully']);
    }

    public function viewItemprice($itemid){
        $this->price_show[$itemid] = true;
    }

    public function updatedPrice($value, $key){
        $gift_value = GiftItemValue::where('gift_id', $key)->where('merchant_id', Auth::user()->id)->first();
        if($gift_value){
            $gift_value->gift_id = $key;
            $gift_value->price = $value;
            $gift_value->merchant_id = Auth::user()->id;
            $gift_value->save();
        }
        else{
            $itemprice = new GiftItemValue;
            $itemprice->gift_id = $key;
            $itemprice->price = $value;
            $itemprice->merchant_id = Auth::user()->id;
            $itemprice->save();
        }
        $this->price_show[$key] = true;
            
    }

    public function itemAction($itemid){
        // dd($this->action_value);
        if($this->action_value != ''){
            if($this->action_value == 'Remove'.$itemid){
                $this->removeid = $itemid;
                $this->action_type = 'remove';
                $removeItem = GiftManage::find($itemid);
                if ($removeItem) {
                    $this->emit('confirmModal', [
                        'text'  => 'Are you sure you want to remove '.$removeItem->item_name.' ?',
                    ]);
                }
            }
            elseif($this->action_value == 'Re-add'.$itemid){
                $this->removeid = $itemid;
                $this->action_type = 'readd';
                $removeItem = GiftManage::find($itemid);
                if ($removeItem) {
                    $this->emit('confirmModal', [
                        'text'  => 'Are you sure you want to re-add '.$removeItem->item_name.' ?',
                    ]);
                }
            }
            // elseif($this->action_value == 'Edit'.$itemid){
            //     $this->removeid = $itemid;
            //     $getItem = ItemOrService::find($itemid);
            //     if ($getItem) {
            //        $this->item_name = $getItem->item_name;
            //        if($getItem->item_price != ''){
            //         $this->value_one = $getItem->item_price->price;
            //        }
                   
            //        $this->note = $getItem->note;
            //        $this->participating_location_ids = $getItem->itemLocation->pluck('location_id');
            //       // dd($this->participating_location_ids );
            //        $this->emit('editModal');
            //     }
            // }
        }
    }

    public function removeItem(){
        if($this->removeid){
            if($this->action_type == 'remove'){
                $removeItem = GiftManage::find($this->removeid);
                if ($removeItem) {
                    $removeItem->status = 0;
                    $removeItem->save();
                    $this->emit('messageModal', [
                        'text'  => 'Gift removed successfully',
                    ]);
                }
            }
            elseif($this->action_type == 'readd'){
                $removeItem = GiftManage::find($this->removeid);
                if ($removeItem) {
                    $removeItem->status = 1;
                    $removeItem->save();
                    $this->emit('messageModal', [
                        'text'  => 'Gift re-added successfully',
                    ]);
                }
            }
            
        }
    }

    public function searchByreceipt(){
       
        if($this->receipt_no != ''){
            $this->itemTransaction = Transaction::where('status', 1)->where('receipt_no','like', '%' . trim($this->receipt_no) . '%' )->get();
        }else{
            $this->itemTransaction = Transaction::where('status', 1)->get();
        }
    }

    public function programByStatus(){
        $today = date('Y-m-d');
        if($this->program_status != ''){
            $this->programs = MerchantLoyaltyProgram::where('end_on', '>', $today)
                            ->where('business_profile_id', Auth::user()->business_id)
                            ->where('status', 1)->orWhere('end_on','=',null)->orderBy('created_at',$this->program_status)->get();
        }
    }

    public function sendGift($id){
        if($this->select_gift != ''){
           $consumer_reward =  ConsumerLoyaltyReward::find($id);
           $gift_manage = GiftManage::find($this->select_gift);
           if($consumer_reward){
              $today = date('Y-m-d');
              $consumer_gift = new ConsumerGift;
              $consumer_gift->consumer_id = $consumer_reward->consumer_id;
              $consumer_gift->consumer_loyalty_id = $id;
              $consumer_gift->program_progress = $consumer_reward->program_process_percentage;
              $consumer_gift->gift_id = $this->select_gift;
              $consumer_gift->send_on = $today;
              $consumer_gift->expire_on = date('Y-m-d', strtotime($today. ' + 45 days'));
              $consumer_gift->send_by = 'Merchant';
              $consumer_gift->send_user_by = auth()->user()->id;
              $consumer_gift->save();
              $gift = $gift_manage->gift_name;
              $this->select_gift = '';
              $this->emit('giftSuccessModal',['text' => 'The recipient will be notified of the gift that expire in 45 days','gift' => $gift]);
           }
        }
        else{
            $this->emit('messageModal',['text' => 'Please select a gift']);
        }
    }

    public function editGiftSettings(){
        $this->emit('openGiftSettingModal');
    }

   
    public function updateMerchantGiftSetting(){
        // dd($this->progress_status);
        $this->validate(
            [
                'item_id' => ['required'],
                'gift_item_name' => ['required_if:item_id,=,add_new'],
                'value_one' => ['required', 'numeric'],
                'value_two' => ['nullable', 'numeric'],
                'note' => ['nullable'],
            ],
            [
                'item_id.required' => "Please select a item",
                'gift_item_name.required_if' => "The gift name field is required when you select add new gift",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
                'value_two.numeric' => "The Amount should be number",
            ]
        );
    }


    public function render()
    {
        // dd($this->deals);
        return view('livewire.frontend.merchant.campaign-management');
    }
}
