<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\BusinessLocation;
use App\Models\State;
use App\Models\ItemOrService;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessCategory;
use App\Models\Deal;
use App\Models\DealLocation;
use App\Models\MerchantLoyaltyProgram;
use App\Models\LoyaltyRewardLocation;
use App\Models\LoyaltyProgramItem;
use App\Models\TermsAndCondition;
use Session;
use App\Models\GiftItemValue;
use App\Models\ItemServiceLocation;

class CreateCampaign extends Component
{
    use WithFileUploads;
    public $about_program,$program_type,$deal_image ,$start_date,$end_date,$uploaded_images,$main_photo, $location_ids =[], $seleted_locations = [], $deal, $voucher_limit, $voucher_unlimited,$loyalty_address,$deal_address;
    public $step_two,$step_one, $step_three, $step_four, $step_five, $step_six, $step_seven, $categoryData,$terms_condition, $main_photo_id , $main_image_upload_loyalty, $main_deal_image_upload, $deal_single_photo, $loyalty_single_photo;
    public $locations =[], $items = [], $item_id, $selected_item_id, $item_price, $deal_discount,$is_bogo, $discount_amount,$deal_description,$deal_point,$discount_type;
    public $location_name,$location_phone_number,$location_website,$location_email,$location_street_address,$location_zip_code,$location_state,$location_city,$is_available, $location_latitude, $location_longitude;
    public $step_two_loyalty, $step_three_loyalty,$step_four_loyalty, $step_five_loyalty, $step_six_loyalty;
    public $loyalty_image, $uploaded_loyalty_images, $loyalty_main_photo, $loyalty_main_photo_id, $yes_end,$no_end, $loyalty_start_date, $loyalty_end_date, $loyalty_location_ids = [],$purchase_goal;
    public $have_to_buy,$free_item, $loalty_program,$loyalty_item_id=[], $start_on_date, $free_item_no, $when_order,$loyalty_discount_amount,$spend_amount;
    public $off_percentage, $percentages, $progameName, $program_point, $program_amount, $disAmount, $loyalty_discount_type;
    public $item_service_name,$value_one,$value_two,$note, $item_select_display, $loyalty_item_select_display, $show_discount_amount,$real_item_price, $loyalty_about, $loyalty_terms;
    public $selected_item_value = [] , $get_items = [], $item_service_modal = true;

    public $display,$dscnt_amount,$itm_price;
    protected $listeners = ['datepickerEnable'];

    public function mount(){
        $this->step_one = true;
        $this->step_two = false;
        $this->is_available = true;
        $this->no_end = true;
        $this->deal_point = '';
        $this->discount_type = 'amount ($)';
        $this->display = true;
        $this->item_select_display = true;
        $this->loyalty_item_select_display = true;
        $business_category_id = Auth::user()->merchantBusiness->business_category_id;
        $this->locations = BusinessLocation::where('business_profile_id',auth()->user()->business_id)->where('status',1)->where('participating_type','Participating')->get();
        $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
        $this->categoryData = BusinessCategory::find($business_category_id);
        $text = str_replace('[Merchant Name]', Auth::user()->merchantBusiness->business_name, $this->categoryData->terms_conditions);
        $text2 = strip_tags($text);
        $this->about_program =  str_replace('&nbsp;', '', $text2);
        $terms = TermsAndCondition::where('id',2)->first();
        $this->terms_condition =  $terms->description;
        $this->percentages = [  ['value' => 'Free', 'text' => 'Free'],
                                ['value' => '25% OFF', 'text' => '25% OFF'],
                                ['value' => '35% OFF', 'text' => '35% OFF'],
                                ['value' => '50% OFF', 'text' => '50% OFF'],
                                ['value' => '75% OFF', 'text' => '75% OFF']];
        $this->off_percentage = 'Free';
        $this->progameName = '';
        if($terms){
            $terms = TermsAndCondition::where('id',3)->first();
        }
        else{
            $terms ="";
        }
        $this->loyalty_terms =  $terms->description;

        $this->loyalty_about =  str_replace('&nbsp;', '', $text2);
        $this->get_items = '';
        
        
    }

    public function backToPrevious($step){
        if($step == 'step_one'){
            $this->step_one = true;
            $this->step_two = false;
            $this->step_two_loyalty = false;
        }
        if($step == 'step_two'){
            
            $this->step_three = false;
            $this->step_two = true;
        }
        if($step == 'step_three'){
            
            $this->step_three = true;
            $this->step_four = false;
            $this->emit('enabledatepicker');
        }
        if($step == 'step_four'){
            
            $this->step_four = true;
            $this->step_five = false;
           // dd($this->location_ids);
        }
        if($step == 'step_five'){
            
            $this->step_five = true;
            $this->step_six = false;
        }
        if($step == 'step_two_loyalty'){
            
            $this->step_two_loyalty = true;
            $this->step_three_loyalty = false;
        }
        if($step == 'step_three_loyalty'){
            
            $this->step_three_loyalty = true;
            $this->step_four_loyalty = false;
            $this->step_six_loyalty = false;
            $this->emit('enableloyaltydatepicker');
        }
    }

    public function goToNext($step){
        if($step == 'step_three'){
            $this->step_three = true;
            $this->step_two = false;
            $this->emit('enabledatepicker');
        }

        if($step == 'step_three_loyalty'){
            $this->step_three_loyalty = true;
            $this->step_two_loyalty = false;
            $this->emit('enableloyaltydatepicker');
        }
    }

    public function datepickerEnable(){
        //dd('123');
        $this->emit('enabledatepicker');
    }

    public function selectType(){
        $this->validate([
            'program_type' => 'required',

        ], [
            'program_type.required' => 'Please select any one type',

        ]);
        $this->program_type = $this->program_type;
        if($this->program_type == 'deal'){
            $this->step_one = false;
            $this->step_two = true;
        }
        else{
            $this->step_two_loyalty = true;
            $this->step_one = false;
        }
        

    }

    public function updatedDealImage(){
        $this->validate([
            'deal_image' => 'required',
        ], [
            'deal_image.required' => 'select at least one image for deal',
        ]);
        // foreach ($this->deal_image as $photos) {
        //     array_push($this->uploaded_images, $photos);
        // }

        $this->main_photo =  $this->deal_image;
    }

    public function photoMakeMain($id)
    {
        if (count($this->uploaded_images) > 0) {
            foreach ($this->uploaded_images as $key => $images) {
                if ($key == $id) {
                    $this->main_photo =  $images;
                    $this->main_photo_id = $key;
                }
            }
        }
    }

    public function photoDelete($id)
    {
        if (count($this->uploaded_images) > 0) {
            foreach ($this->uploaded_images as $key => $images) {
                if ($key == $id) {
                    if ($images == $this->main_photo) {
                        $this->main_photo =  '';
                    }
                    unset($this->uploaded_images[$key]);
                }
            }
        }
    }

    public function mainPhotoDelete(){
        if ($this->main_photo) {
            $this->main_photo =  '';
            $this->main_photo_id = '';
        }
    }

    public function selectDealPhoto(){
       
            $this->validate([
                'deal_image' => 'required|array',
                'deal_image'=> 'mimes:png,jpg|max:25600'
            ], [
                'deal_image.required' => 'select at least one image for deal',
                'deal_image.*.mimes' => 'Image file should be  jpg and png type',
                'deal_image.*.max' => 'Image file size may not be greater than 25 mb',
            ]);

            $this->step_three = true;
            $this->step_two = false;
            $this->emit('enabledatepicker');

    }

    public function selectDateSpan(){
        if($this->start_date){
            $afterDate =  date('Y-m-d', strtotime($this->start_date. ' + 30 days'));
            $showafterDate =  date('m/d/Y', strtotime($this->start_date. ' + 30 days'));
            $this->emit('enabledatepicker');
            $this->validate([
                'end_date' => "nullable|after:".$afterDate
    
            ], [
                'end_date.after' => 'Please select deal end date after '.$showafterDate,
    
            ]);
           
        }
        else{
        $this->emit('enabledatepicker');
            $this->validate([
                'start_date' => 'required',
    
            ], [
                'start_date.required' => 'Please select deal start date ',
    
            ]);
        }
        
        $this->start_date = $this->start_date;
        $this->end_date = $this->end_date;
        $this->step_three = false;
        $this->step_four = true;
        $this->emit('enabledatepicker');
    }

    public function openParticipatingLocation(){
        // $this->reset();
        $this->emit('enableparticipatinglocation');
        $this->display = false;
    }

    public function closeAddPartcipatingModal(){
        // $this->step_four = true;
        // $this->locations = BusinessLocation::where('business_profile_id',auth()->user()->business_id)->where('status',1)->where('participating_type','Participating')->get();
        // dd($this->locations);
        $this->emit('disableparticipatinglocation');
        $this->display = true;
    }


    public function addParticipatingLocation(){
        //dd($this->location_ids);
        $this->validate([
            'location_name' => 'required',
            'location_phone_number' => 'required',
            'location_website' => 'nullable|url',
            'location_street_address' => 'required',
            'location_zip_code' => 'required',
            'location_city' => 'required',
            'location_state' => 'required',
            'location_email'=> 'nullable|email',
        ], [
            'location_name.required' => 'Business Location Name field is required',
            'location_phone_number.required' => 'Business Location Phone Number field is required',
            'location_website.url' => 'Business Location Website must be a valid url',
            'location_street_address.required' => 'Business Location Street Address field is required',
            'location_zip_code.required' => 'Business Location Zip Code field is required',
            'location_city.required' => 'Business Location City field is required',
            'location_state.required' => 'Business Location State field is required',
            'location_email.email'=> 'Business Location Email must be a valid email address',
        ]);
        $getstate = State::where('name',$this->location_state)->first();
        if($getstate){
            $stateid = $getstate->id;
        }
        else{
            $stateid = '';
        }
        $locationdata = array(
            'business_profile_id' => auth()->user()->business_id,
            'location_name' => $this->location_name,
            'business_phone' => $this->location_phone_number,
            'business_fax_number' => $this->location_website,
            'business_email' => $this->location_email,
            'address' => $this->location_street_address,
            'zip_code' => $this->location_zip_code,
            'city' => $this->location_city,
            'state_id' => $stateid,
            'state' => $this->location_state,
            'participating_type' => 'Participating',
            'latitude' => $this->location_latitude,
            'longitude' => $this->location_longitude
        );
        $location = BusinessLocation::create($locationdata);
        $locationid = strtoupper(substr($location->business->business_name,0,3)).'/'.strtoupper(substr($location->location_name,0,3)).'/0'.$location->id;
        $location->locationId = $locationid;
        $location->save();
        $this->locations = BusinessLocation::where('business_profile_id',auth()->user()->business_id)->where('status',1)->where('participating_type','Participating')->get();
        if($this->is_available == true){
            $this->location_ids[] = strval($location->id);
            
            $this->emit('participatinglocationsuccess',['location_id' => $this->location_ids,'location' => $location]);
        }
        else{
            $this->emit('participatinglocationsuccess',['location_id'=>'']);
        }
        
    }

    public function selectParticipatinglocation(){
        
        $this->validate([
            'location_ids' => 'required',
            'location_ids.*' => 'required',
         
        ], [
            'location_ids.required' => 'Please select at least one participating location',
        ]);

        $this->seleted_locations = $this->location_ids;
        $this->step_five = true;
        $this->step_four = false;
        //dd($this->location_ids);
        $this->emit('enabledatepicker');
    }


    public function updatedItemId(){
        // dd($this->item_id);
        if($this->item_id != ''){
            
            $this->item_select_display = true;
            $selected_item = ItemOrService::find($this->item_id);
            if($selected_item->item_price){
                $this->item_price = '$'.number_format($selected_item->item_price->price);
            }
            else{
                $this->item_price = '$'.number_format($selected_item->item_value);
            }

            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$selected_item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$selected_item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = $this->discount_amount.'% OFF '.$selected_item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($item_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$selected_item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $dis_amount = substr($this->discount_amount, 1);
                                if($this->discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                }
                                // BUY 1, AND GET 1 T-SHIRT $5 OFF
                                $this->deal_description = 'BUY 1, AND GET 1 '. $selected_item->item_name .' '.$this->show_discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point= '';
                                $this->deal_description = '';
                            }
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $selected_item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point= '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->discount_amount = $this->discount_amount;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount ;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            // if(mb_substr($this->discount_amount,-1) == '%'){
                            //     mb_substr($this->discount_amount,-1);
                            // dd($this->discount_amount);
                            // }
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $this->discount_amount;
                            $this->deal_description = $this->deal_description ;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            // $this->discount_amount = $this->discount_amount.'%';
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_description = '';
                            $this->deal_point = '';
                        }
                        
                    }
                }
            }
            else{
                $this->discount_amount = '';
                $this->discount_type = 'amount ($)';               
            }
            
        }
        else{
            $this->item_price = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function updatedDealDiscount(){
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($item_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){

                                $char = substr($this->show_discount_amount,-1);
                                if($char == '%'){
                                 $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                 $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                                 $this->discount_amount = $this->discount_amount;
                                 $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                 $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                                }
                                else{
                                    $this->show_discount_amount = $this->show_discount_amount;
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                    $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }

                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->show_discount_amount, 1);
                                if($this->show_discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->show_discount_amount = $dis_amount.'%';
                                    $this->discount_amount = $dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                                $this->deal_description =  $this->discount_amount.'% OFF '.$item->item_name;

                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            // dd($this->discount_amount);
                         
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                // $this->show_discount_amount = 
                                $char = substr($this->show_discount_amount,-1);
                                if($char == '%'){
                                 $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                 $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                                 $this->discount_amount = $this->discount_amount;
                                 $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                 $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }
                                else{
                                    $this->show_discount_amount = $this->show_discount_amount;
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                    $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->show_discount_amount, 1);
                                if($this->show_discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->show_discount_amount = $dis_amount.'%';
                                    $this->discount_amount = $dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                                
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->show_discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        // $this->show_discount_amount = $this->item_price;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);

                        $this->discount_type = 'amount ($)';
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount; 
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            // $this->disAmount = $dis_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $this->show_discount_amount = $this->show_discount_amount;
                            }
                            else{
                               $char = substr($this->show_discount_amount,-1);
                               if($char == '%'){
                                $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                               }                                
                                // dd($this->show_discount_amount);
                            }
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = ''; 
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->show_discount_amount = $this->show_discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $this->show_discount_amount = (int)$dis_amount.'%';
                            $this->discount_amount = (int)$dis_amount;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                    }
                }
            }
            else{
                    $this->discount_amount = '';
                    $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function updatedIsBogo(){
        
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $dis_amount = substr($this->discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $dis_amount = substr($this->show_discount_amount, 1);
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                $this->deal_description = '$'.$dis_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $dis_amount = substr($this->discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                // $dis_amount = substr($this->discount_amount, 1);
                                // $dis_amount = str_replace(',', '', $dis_amount);
                                // $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $dis_amount = substr($this->discount_amount, 1);
                        $dis_amount = str_replace(',', '', $dis_amount);
                        $dis_amount = (float)$dis_amount;
                        $this->deal_point = intval(ceil($item_amount/0.25));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil($this->discount_amount/0.25));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                }
            }
            else{
                    $this->discount_amount = '';
                    $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
        
    }

    public function updatedDiscountAmount(){
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = ceil(($item_amount/0.25));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                // $dis_amount = substr($this->discount_amount, 1);
                                // $dis_amount = str_replace(',', '', $dis_amount);
                                // $dis_amount = (float)$dis_amount;
                                $this->deal_point =intval(ceil($this->discount_amount/0.25));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->discount_amount, 1);
                                if($this->discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                              
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = ceil(($item_amount/0.25));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = ceil(($this->discount_amount/0.25));
                                $this->show_discount_amount = $this->show_discount_amount;
                                // dd($this->show_discount_amount);
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = ceil(($item_amount/0.25));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point =intval(ceil($this->discount_amount/0.25));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $this->discount_amount = (int)$dis_amount;
                                $this->show_discount_amount = (int)$dis_amount.'%';
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            else{
                                // dd($this->discount_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    else{
                        $this->discount_amount = $this->discount_amount;
                        $this->deal_point = '';
                    }
                }
            }
            else{
                if($this->discount_amount != ''){
                    $this->discount_amount =  $this->discount_amount;
                }
                else{
                    $this->discount_amount = '';
                }
                    
                $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }


    public function updatedItemPrice(){
        // dd($this->item_price);
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                $item_price = substr($this->item_price, 1);
                if($this->item_price[0] == '$'){
                    $item_price = substr($this->item_price, 1);
                }
                else{
                    $item_price = $this->item_price;
                    $this->item_price = '$'.number_format($this->item_price,2);
                }
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $dis_amount = substr($this->discount_amount, 1);
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));                            
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->show_discount_amount = $this->show_discount_amount;
                                // dd($this->show_discount_amount);
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $this->discount_amount = (int)$dis_amount;
                                $this->show_discount_amount = (int)$dis_amount.'%';
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            else{
                                // dd($this->discount_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    else{
                        $this->discount_amount = $this->discount_amount;
                        $this->deal_point = '';
                    }
                }
            }
            else{
                if($this->discount_amount != ''){
                    $this->discount_amount =  $this->discount_amount;
                }
                else{
                    $this->discount_amount = '';
                }
                    
                $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function createDealDescription(){

        // dd($this->location_ids);
        $price = substr($this->item_price, 1);
        $price = str_replace(',', '', $price);

        $this->real_item_price   = $price;
         $this->validate([
             'item_id' => 'required',
             'real_item_price' => 'required',
             'deal_discount' => 'required',
             'discount_amount' => 'required',
             'is_bogo' => 'required',
             'deal_description' => 'required',
          
         ], [
             'item_id.required' => 'Please select one item',
             'real_item_price.required' => 'Original Sales price field is required',
             'deal_discount.required' => 'Please select one Discount Type',
             'discount_amount.required' => 'Discount Amount field is required',
             'is_bogo.required' => 'Please select Bogo or not',
             'deal_description.required' => 'Description field is required',
         ]);
         $this->selected_item_id = $this->item_id;
         if($this->deal_discount == 'Percentage'){
 
             $this->validate([
                 'discount_amount' => 'lt:100',
                 
             ], [
                 'discount_amount.lt' => 'Discount Amount not be greater than 99%',
             ]);
             
         }
         else if($this->deal_discount == 'Dollar'){
 
             $this->validate([
                 'discount_amount' => 'lt:real_item_price',
             ], [
                 'discount_amount.lt' => 'Discount amount must be less than the original sales amount. To apply a  full discount on the item, select Free as the discount type',
             ]);
             
         }
         else{
             $this->validate([
                 'discount_amount' => 'numeric',
             ], [
                 'discount_amount.lt' => 'Discount amount should be a number',
             ]);
         }
         $this->step_six = true;
         $this->step_five = false;
    }

    public function updatedVoucherUnlimited(){
        if($this->voucher_unlimited == true){
            $this->voucher_limit = '';
        }
        else{
            $this->voucher_unlimited = false;
        }
    }

    public function updatedVoucherLimit(){
        if($this->voucher_limit){
            $this->voucher_unlimited = false;
        }
        else{
            $this->voucher_unlimited = true;
        }
    }

    public function addVoucher(){
        if($this->voucher_unlimited == false){
            $this->validate([
                'voucher_limit' => 'required|gt:14',
            ],
            [
                'voucher_limit.required' => 'Voucher Number field is required',
                'voucher_limit.min' => 'Voucher number must be greater than 14'
            ]);
        }

        $this->saveFinalDeal();
        
    }

    public function saveFinalDeal(){
    //    $this->deal_single_photo = $this->deal_image;
       
       $this->deal = new Deal;
       $this->deal->merchant_id = auth()->user()->id;
       $this->deal->business_id = auth()->user()->business_id;
       $startdate = date_format(date_create($this->start_date),'Y-m-d');
       $this->deal->start_Date = $startdate;
       if($this->end_date){
        $enddate = date_format(date_create($this->end_date),'Y-m-d');
        $this->deal->end_Date = $enddate;
       }
       $this->deal->suggested_description = $this->deal_description;
       $this->deal->sales_amount = $this->item_price;
       $this->deal->discount_type = $this->deal_discount;
       $this->deal->discount_amount = $this->discount_amount;
       $this->deal->point = $this->deal_point;
       if($this->voucher_unlimited == true){
        $this->deal->voucher_unlimited = true;
       }
       else{
        $this->deal->voucher_number = $this->voucher_limit;
       }
       
       $this->deal->status = true;
       if($this->is_bogo == 'yes'){
            $this->deal->is_bogo = true;
       }
       else{
            $this->deal->is_bogo = false;
       }
       $this->deal->terms_conditions = $this->terms_condition;
       $this->deal->about = $this->about_program;
       $this->deal->item_id = $this->selected_item_id;
       $this->deal->is_complete = true;
       $this->deal->save();
      // dd($this->seleted_locations);
       if(count($this->seleted_locations) > 0){
        foreach($this->seleted_locations as $locationid){
            $deal_location = new DealLocation;
            $deal_location->deal_id = $this->deal->id;
            $deal_location->location_id = $locationid;
            $deal_location->participating_type = 'Participating';
            $deal_location->status = true;
            $deal_location->save();
        }
        
       }
        //    if(count($this->deal_image) > 0){
        //     foreach($this->deal_image as $key=>$photo){
        //        $deal_photo = $this->deal->addMedia($photo->getRealPath())
        //         ->usingName($photo->getClientOriginalName())
        //         ->toMediaCollection('dealPhotos');

        //         $this->deal->main_image = '/storage/'.$deal_photo->id.'/'.$deal_photo->file_name;
        //         $this->deal->save();

        //         // dd($deal_photo);
        //         // if($this->main_photo_id != ''){
        //         //     if($this->main_photo_id == $key){
        //         //         $this->deal->main_image = '/storage/'.$deal_photo->id.'/'.$deal_photo->file_name;
        //         //         $this->deal->save();
        //         //     }
        //         // }
        //     }
            
        //    }
        

       if($this->main_deal_image_upload){
            $loyalty_photo = $this->deal->addMedia($this->main_deal_image_upload->getRealPath())
                ->usingName($this->main_deal_image_upload->getClientOriginalName())
                ->toMediaCollection('dealPhotos');
            $this->deal->main_image = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
            $this->deal->save();
       }else{
            if($this->deal_single_photo){
                if($this->deal_single_photo){
                        $deal_photo = $this->deal->addMedia($this->deal_single_photo->getRealPath())
                        ->usingName($this->deal_single_photo->getClientOriginalName())
                        ->toMediaCollection('dealPhotos');
                        $this->deal->main_image = '/storage/'.$deal_photo->id.'/'.$deal_photo->file_name;
                        $this->deal->save();
                }
            }
       }

       if( $this->deal){
        $this->step_six = false;
        $this->step_seven = true;
       }
       
      
   
    }

    public function PreviewDeal(){
        // dd($this->seleted_locations[0]);

        $deal_address = BusinessLocation::where('id',$this->seleted_locations[0])->first();
        $this->deal_address = $deal_address->address;
        $this->deal_single_photo = $this->main_photo;

        $this->emit('enablepreviewdeal');
    }


    public function hydrate()
    {
        $this->emit('select2');
    }


    public function updatedLoyaltyImage(){
        $this->validate([
            'loyalty_image' => 'required',
        ], [
            'loyalty_image.required' => 'select at least one image for loyalty',
        ]);
        // foreach ($this->loyalty_image as $photos) {
        //     array_push($this->uploaded_loyalty_images, $photos);
        // }

        $this->loyalty_main_photo = $this->loyalty_image;
    }

    public function loyaltyPhotoMakeMain($id)
    {
        if (count($this->uploaded_loyalty_images) > 0) {
            foreach ($this->uploaded_loyalty_images as $key => $loyaltyimages) {
                if ($key == $id) {
                    $this->loyalty_main_photo =  $loyaltyimages;
                    $this->loyalty_main_photo_id = $key;
                }
            }
        }
    }

    public function mainLoyaltyPhotoDelete(){
        // dd('vsdvdsv');
        if ($this->loyalty_main_photo) {
            $this->loyalty_main_photo =  '';
            $this->loyalty_main_photo_id = '';
        }
    }

    public function loyaltyPhotoDelete($id)
    {
        if (count($this->uploaded_loyalty_images) > 0) {
            foreach ($this->uploaded_loyalty_images as $key => $images) {
                if ($key == $id) {
                    if ($images == $this->loyalty_main_photo) {
                        $this->loyalty_main_photo =  '';
                    }
                    unset($this->uploaded_loyalty_images[$key]);
                }
            }
        }
    }

    public function photoMakeMainLoyalty($id){
        if (count($this->uploaded_loyalty_images) > 0) {
            foreach ($this->uploaded_loyalty_images as $key => $images) {
                if ($key == $id) {
                    $this->loyalty_main_photo =  $images;
                    $this->loyalty_main_photo_id = $key;
                }
            }
        }
    }

    public function selectLoyaltyPhoto(){
        $this->validate([
            'loyalty_image' => 'required|array',
            'loyalty_image'=> 'mimes:png,jpg|max:25600'
        ], [
            'loyalty_image.required' => 'select at least one image for loyalty',
            'loyalty_image.mimes' => 'Image file should be  jpg and png type',
            'loyalty_image.max' => 'Image file size may not be greater than 25 mb',
        ]);

        $this->step_three_loyalty = true;
        $this->step_two_loyalty = false;
        $this->emit('enableloyaltydatepicker');
    }

    public function updatedNoEnd(){
        if($this->no_end == true){
            $this->yes_end = false;
           
        }
        else{
            $this->yes_end = true;
        }
        $this->emit('enableloyaltydatepicker');
    }

    public function selectLoyaltyType(){
        if($this->no_end == true){
            $this->validate([
                'loyalty_start_date' => 'required',
                'no_end'=> 'required',
                'loyalty_location_ids' => 'required|array',
                'loyalty_location_ids.*' => 'required',
                'purchase_goal' => 'required',
            ], [
                'loyalty_start_date.required' => 'select start date of loyalty deal',
                'loyalty_location_ids.required' => 'Please select at least one location',
                'purchase_goal.required' => 'Please select any one purchase goal'
            ]);
            $this->emit('enableloyaltydatepicker');
        }
        else{
            $this->validate([
                'loyalty_start_date' => 'required',
                'loyalty_end_date'=> 'required',
                'loyalty_location_ids' => 'required|array',
                'loyalty_location_ids.*' => 'required',
                'purchase_goal' => 'required',
            ], [
                'loyalty_start_date.required' => 'select start date of loyalty deal',
                'loyalty_end_date.required' => 'select end date of loyalty deal',
                'loyalty_location_ids.required' => 'Please select at least one location',
                'purchase_goal.required' => 'Please select any one purchase goal'
            ]);
            $this->emit('enableloyaltydatepicker');
        }
        if($this->purchase_goal == 'free'){
            $this->step_four_loyalty = true;
            $this->step_three_loyalty = false;
        }
        else{
            $this->step_six_loyalty = true;
            $this->step_three_loyalty = false;
        }
        
    }


    public function PreviewProgram(){
        // dd($this->loyalty_location_ids[0]);
        $blnkArr = array();
        $this->program_point = 0;
        if (is_array($this->loyalty_item_id)) {
            // dd(is_array($request->free_item));
            if (count($this->loyalty_item_id) > 0) {
                for ($i = 0; $i < count($this->loyalty_item_id); $i++) {
                    $itemNameList = ItemOrService::find($this->loyalty_item_id[$i]);
                    $itemName =  $itemNameList->item_name;
                    if($itemNameList->item_price != ''){
                        $price = $itemNameList->item_price->price;
                        if ($this->purchase_goal == "free") {
                            if($this->have_to_buy != ''){
                                $this->program_point = round(((($price*0.075)/.50)*$this->have_to_buy) + $this->program_point);
                            }
                        }
                       
                        if ($this->purchase_goal == "deal_discount") {
                           
                            if($this->spend_amount != ''){
                                // dd($this->program_point);
                                $amount = substr($this->spend_amount, 1);
                                $amount = str_replace(',', '', $amount);
                                $amount = (float)$amount;
                                // dd($amount);
                                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                                //dd($this->program_point);
                            }
                            
                        }
                        
                    }
                    array_push($blnkArr, $itemName);
                    // dd($itemName);
                }
            }
        }
        if ($this->purchase_goal == "free") {
            if($this->have_to_buy != ''){
                if($this->free_item != ''){
                    if($this->off_percentage != ''){
                        $this->progameName = "Purchase" . " " . $this->have_to_buy . " " . implode(",", $blnkArr) . " " . "And Get" . " " . $this->free_item . " " . "For ".$this->off_percentage;
                    }
                }
            }
        }
        if ($this->purchase_goal == "deal_discount") {
            if($this->spend_amount != ''){
                if($this->loyalty_discount_amount != ''){
                    if($this->when_order != ''){
                        $this->progameName = "Purchase" . " " . $this->spend_amount . " " . "Or More Worth Of" . " " . implode(",", $blnkArr) . " " . "And Receive A" . " " . $this->loyalty_discount_amount . " " . "Discount on" . " " . $this->when_order . " " . "Order";
                    }
                }
            }
        }
        $loyalty_address = BusinessLocation::where('id',$this->loyalty_location_ids[0])->first();
        $this->loyalty_address = $loyalty_address->address;

        $this->loyalty_single_photo = $this->loyalty_main_photo;
        // dd($this->loyalty_single_photo);
        $this->loyalty_item_select_display = false;
        $this->emit('enablepreviewprogram');
    }

    
    public function createLoyaltyProgram(){
        // dd($this->dscnt_amount);
        
        if($this->purchase_goal == 'deal_discount'){

            $dis_amount = substr($this->loyalty_discount_amount, 1);
            $dis_amount = str_replace(',', '', $dis_amount);
            $dis_amount = (float)$dis_amount;
            $this->disAmount = $dis_amount;
            //dd($this->program_amount);
            $this->validate([
                'loyalty_item_id' => 'required|array',
                'program_amount' => 'required|numeric|lte:5000',
                'disAmount' => 'required|numeric',
                'when_order'  => 'required',
                'loyalty_discount_type' => 'required',
                'dscnt_amount' =>  'required|numeric|' . ($this->loyalty_discount_type === 'percentage' ? 'lt:100' : ''),
            ],
            [
                'loyalty_item_id.required' => 'Please select any one item',
                'program_amount.required' => 'This field is required',
                'program_amount.numeric' => 'This field must be a number',
                'program_amount.lte' => 'This amount cannot exceed $5,000',
                'disAmount.required' => 'This field is required',
                'disAmount.numeric' => 'This field must be a number',
                'when_order.required' => 'This field is required',
                'loyalty_discount_type.required' => 'This field is required',
                'dscnt_amount.required' => 'This discount amount field is required',
            ]);
            // if($this->loyalty_discount_type == 'percentage'){
                
            //     $this->validate([
            //         // 'program_amount' => 'required|numeric|lt:100',
            //         'dscnt_amount'=> 'required|numeric|lt:100'
            //     ],
            //     [
            //         // 'program_amount.required' => 'This field is required',
            //         // 'program_amount.numeric' => 'This field must be a number',
            //         // 'program_amount.lt' => 'This field must be less than 100',
            //         'dscnt_amount.required' => 'This field is required',
            //         'dscnt_amount.numeric' => 'This field must be a number',
            //         'dscnt_amount.lt' => 'Amount entered should be less than the 100%',
            //     ]);
            // }
            // dd($this->loyalty_discount_type);
            if($this->loyalty_discount_type == 'dollar'){
                $p_amnt = $this->program_amount;
                $hidden_d_amnt = $this->dscnt_amount;
                if($p_amnt <= $hidden_d_amnt){
                    $this->validate([
                        'program_amount' => 'required',
                        'dscnt_amount' => 'lt:dscnt_amount',
                    ],
                    [
                        'dscnt_amount.lt' => 'Amount entered should be less than the dollar amount to spend.'
                    ]);
                }
                
            }
        }
        else{
            $this->validate([
                'loyalty_item_id' => 'required|array',
                'have_to_buy' => 'required|numeric',
                'free_item'  => 'required',
                'off_percentage' => 'required',
            ],
            [
                'loyalty_item_id.required' => 'Please select any one item',
                'have_to_buy.required' => 'This field is required',
                'have_to_buy.numeric' => 'This field must be a number',
                'free_item.required' => 'This field is required',
                'off_percentage.required' => 'This field is required',
            ]);
        }

        if($this->item_service_modal == true){
            $this->emit('openItemPriceModal');
            $this->emit('hideStyle');
            $this->get_items = ItemOrService::with('value')
            ->whereIn('id', $this->loyalty_item_id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'item_name' => $item->item_name,
                    'price' => $item->value->isNotEmpty() ? $item->value->first()->price : '00'
                ];
            })->toArray();

            $this->selected_item_value = collect($this->get_items)
            ->pluck('price', 'id')
            ->toArray();
        }else{
            $this->saveFinalLoyalty();
        }

    }

    public function UpdatedSelectedItemValue(){
        $this->emit('hideStyle');
    }

    public function submitNewItemPrice()
    {
        $this->emit('hideStyle');
        $this->validate([
            'selected_item_value.*' => 'required|numeric|min:0.01',
        ], [
            'selected_item_value.*.required' => 'The price field is required.',
            'selected_item_value.*.numeric' => 'The price must be a valid number.',
            'selected_item_value.*.min' => 'The price must be greater than 0.',
        ]);

        
        foreach ($this->selected_item_value as $item_id => $price) {
           
            $find_item_id = GiftItemValue::where('item_id',$item_id)->first();
            if($find_item_id){
                GiftItemValue::where('item_id', $item_id)->update(['price' => $price]);
            }else{
                $itemvalue = new GiftItemValue;
                $itemvalue->item_id = $item_id;
                $itemvalue->price = $price;
                $itemvalue->merchant_id = Auth::user()->id;
                $itemvalue->save();
            } 
        }
        $this->item_service_modal =false;
        $this->emit('hideStyleoff');
        $this->emit('closeOpenItemPriceModal');
    }

    public function UpdatedMainImageUploadLoyalty(){
        // dd($this->main_image_upload_loyalty);
        $this->validate([
            'main_image_upload_loyalty' => 'nullable|mimes:png,jpg|max:25600',
        ], [
            'main_image_upload_loyalty.mimes' => 'Image file should be  jpg and png type',
            'main_image_upload_loyalty.max' => 'Image file size may not be greater than 25 mb',
        ]);
    }

    public function UpdatedMainDealImageUpload(){
        // dd($this->main_deal_image_upload);
        $this->validate([
            'main_deal_image_upload' => 'nullable|mimes:png,jpg|max:25600',
        ], [
            'main_deal_image_upload.mimes' => 'Image file should be  jpg and png type',
            'main_deal_image_upload.max' => 'Image file size may not be greater than 25 mb',
        ]);
    }
    
    public function saveFinalLoyalty(){
        // $this->loyalty_single_photo = $this->loyalty_image;
        // dd($this->loyalty_single_photo);

        $startdate = date_create($this->loyalty_start_date);
        $startDate = date_format($startdate, 'Y-m-d');
        $this->loalty_program = new MerchantLoyaltyProgram;
        $this->loalty_program->merchant_id = Auth::user()->id;
        $this->loalty_program->business_profile_id = Auth::user()->business_id;
        $this->loalty_program->purchase_goal = $this->purchase_goal;
        $this->loalty_program->start_on = $startDate;
        $this->loalty_program->about_program = $this->loyalty_about;
        $this->loalty_program->terms_conditions = $this->loyalty_terms;

        if ($this->no_end != true) {
            $enddate = date_create($this->loyalty_end_date);
            $endDate = date_format($enddate, 'Y-m-d');
            $this->loalty_program->end_on = $endDate;
        }
        if($this->purchase_goal == 'free'){
            $this->loalty_program->have_to_buy = $this->have_to_buy;
            $this->loalty_program->free_item_no = $this->free_item_no;
            $this->loalty_program->off_percentage = $this->off_percentage;
            $abbreviation =  $this->free_item;

        }
        else{
            $this->loalty_program->spend_amount = $this->spend_amount;
            $this->loalty_program->discount_amount = $this->loyalty_discount_amount;
            $this->loalty_program->when_order = $this->when_order;

            if($this->spend_amount != ''){
                // dd($this->program_point);
                $amount = substr($this->spend_amount, 1);
                $amount = str_replace(',', '', $amount);
                $amount = (float)$amount;
                // dd($amount);
                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                //dd($this->program_point);
            }
        }
        $this->loalty_program->save();

       
        
        $blnkArr = array();
        if (is_array($this->loyalty_item_id)) {
            // dd(is_array($request->free_item));
            if (count($this->loyalty_item_id) > 0) {
                for ($i = 0; $i < count($this->loyalty_item_id); $i++) {
                    $item = new LoyaltyProgramItem();
                    $item->loyalty_program_id = $this->loalty_program->id;
                    $item->item_id = $this->loyalty_item_id[$i];
                    $item->save();
                    $itemNameList = ItemOrService::find($this->loyalty_item_id[$i]);
                    $itemName =  $itemNameList->item_name;
                    // dd($itemNameList->item_price);
                    if($itemNameList->item_price != ''){
                        $price = $itemNameList->item_price->price;
                        if ($this->purchase_goal == "free") {
                            if($this->have_to_buy != ''){
                                $this->program_point = round(((($price*0.075)/.50)*$this->have_to_buy) + $this->program_point);
                                $this->loalty_program->program_points = $this->program_point;
                                $this->loalty_program->save();
                            }
                        }
                       
                        if ($this->purchase_goal == "deal_discount") {
                           
                            if($this->spend_amount != ''){
                                // dd($this->program_point);
                                $amount = substr($this->spend_amount, 1);
                                $amount = str_replace(',', '', $amount);
                                $amount = (float)$amount;
                                // dd($amount);
                                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                                $this->loalty_program->program_points = $this->program_point;
                                $this->loalty_program->save();
                                //dd($this->program_point);
                            }
                            
                        }
                        
                    }
        
                    array_push($blnkArr, $itemName);
                    // dd($itemName);
                }
            }
        }

        if (is_array($this->loyalty_location_ids)) {
            for ($j = 0; $j < count($this->loyalty_location_ids); $j++) {
                $reward_location = new LoyaltyRewardLocation;
                $reward_location->loyalty_program_id = $this->loalty_program->id;
                $reward_location->location_id = $this->loyalty_location_ids[$j];
                $reward_location->status = 1;
                if ($this->loalty_program->end_on != null) {
                    $reward_location->end_date = $this->loalty_program->end_on;
                }
                $reward_location->save();
            }
        }
        // dd($this->main_image_upload_loyalty);
        // if(count($this->uploaded_loyalty_images) > 0){
        //     foreach($this->uploaded_loyalty_images as $key=>$photo){
        //        $loyalty_photo = $this->loalty_program->addMedia($photo->getRealPath())
        //         ->usingName($photo->getClientOriginalName())
        //         ->toMediaCollection('loyaltyPhotos');
    
        //         // dd($this->loyalty_main_photo_id);
        //         if($this->loyalty_main_photo_id != ''){
        //             if($this->loyalty_main_photo_id == $key){
        //                 $this->loalty_program->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
        //                 $this->loalty_program->save();
        //             }
        //         }
        //     }  
        // }

           if($this->main_image_upload_loyalty){
                $loyalty_photo = $this->loalty_program->addMedia($this->main_image_upload_loyalty->getRealPath())
                    ->usingName($this->main_image_upload_loyalty->getClientOriginalName())
                    ->toMediaCollection('loyaltyPhotos');
                $this->loalty_program->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
                $this->loalty_program->save();
           }else{
                if($this->loyalty_image){
                    if($this->loyalty_image){
                            $loyalty_photo = $this->loalty_program->addMedia($this->loyalty_image->getRealPath())
                            ->usingName($this->loyalty_image->getClientOriginalName())
                            ->toMediaCollection('loyaltyPhotos');
                            $this->loalty_program->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
                            $this->loalty_program->save();
                    }
                }
           }
        


        if ($this->purchase_goal == "free") {
            $progameName = "Purchase" . " " . $this->have_to_buy . " " . implode(",", $blnkArr) . " " . "And Get" . " " . $abbreviation . " " . "For ".$this->off_percentage;
            $this->loalty_program->program_name = $progameName;
            $this->loalty_program->save();
        }
        if ($this->purchase_goal == "deal_discount") {
            $progameName = "Purchase" . " " . $this->spend_amount . " " . "Or More Worth Of" . " " . implode(",", $blnkArr) . " " . "And Receive A" . " " . $this->loyalty_discount_amount . " " . "Discount on" . " " . $this->when_order . " " . "Order";
            $this->loalty_program->program_name = $progameName;
            $this->loalty_program->save();
        }
        $this->start_on_date = date_format(date_create($this->loyalty_start_date),'l F dS Y' );
        if( $this->loalty_program){
            $this->step_five_loyalty = true;
            $this->step_four_loyalty = false;
            $this->step_six_loyalty = false;
        }

    }


    public function goToCampaignManagement(){
        Session::put('tab', 'nav-program');
        redirect()->route('frontend.business_owner.campaign_managament');
    }

    public function openAddItem(){
        $this->loyalty_item_select_display = false;
        $this->item_select_display = false;
        $this->loyalty_item_id = [];
        $this->item_id = '';
        $this->emit('openAddItemModal');
    }

    public function cancelAddItem(){
        $this->loyalty_item_select_display = true;
        $this->item_select_display = true;
        $this->emit('add_item_cancel');
    }

    public function addItemService(){
        //dd($this->participating_location_ids);
        // $this->emit('offselectitem');
        $this->validate(
            [
                'item_service_name' => ['required'],
                'value_one' => ['required','numeric'],
                'value_two' => ['nullable', 'numeric'],
                'note' => ['nullable'],
            ],
            [
                'item_service_name.required' => "The Item Name field is required",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
                'value_two.numeric' => "The Amount should be number",
            ]
        );
        // $this->emit('offselectitem');
        $itemService = new ItemOrService;
        $itemService->item_name = $this->item_service_name;
        $itemService->business_category_id = Auth::user()->merchantBusiness->business_category_id;
        if ($this->note != '') {
            $itemService->note = $this->note;
        }
        $itemService->merchant_id = Auth::user()->id;
        $itemService->added_by = Auth::user()->id;
        $itemService->save();
        if(($this->value_one != '') && ($this->value_two != '')){
            $value = $this->value_one.'.'.$this->value_two;
        }
        elseif(($this->value_one != '') && ($this->value_two == '')){
            $value = $this->value_one.'.00';
        }
        else{
            $value = '';
        }
        if ($value != '') {
            $itemvalue = new GiftItemValue;
            $itemvalue->item_id = $itemService->id;
            $itemvalue->price = $value;
            $itemvalue->merchant_id = Auth::user()->id;
            $itemvalue->save();
        }
        if(count($this->seleted_locations) > 0){
            foreach($this->seleted_locations as $locationid){
                $itemlocation = new ItemServiceLocation();
                $itemlocation->item_id = $itemService->id;
                $itemlocation->location_id = $locationid;
                $itemlocation->merchant_id = Auth::user()->id;
                $itemlocation->status = 1;
                $itemlocation->save();

            }
            
           }
        $business_category_id = Auth::user()->merchantBusiness->business_category_id;
        $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
        // 
        $this->emit('messageModal', [
            'text'  => 'Item or Services added successfully',
        ]);
    }
    
    public function closeMessageModal(){
        // dd(123);
        $this->item_select_display = true;
        $this->loyalty_item_select_display = true;
        $this->emit('offmessagemodal');
    }

    public function goToMerchantAccount(){
        dd(123);
        redirect()->route('frontend.business_owner.account');
    }


    public function render()
    {
        return view('livewire.frontend.merchant.create-campaign');
    }
}
