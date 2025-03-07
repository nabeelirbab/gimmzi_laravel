<?php

namespace App\Http\Livewire\Frontend\PropertyManager;

use Livewire\Component;
use App\Models\PropertyUnderProviderUser;
use App\Models\BuildingUnit;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderBuilding;
use App\Models\ProviderLimitSetting;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProviderBadgeSentEmail;
use App\Mail\BadgeRequestCancelByProvider;
use App\Models\Provider;
use App\Models\Point;
use App\Models\ConsumerRecognition;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use DateTime;
use DateInterval;

class SmartRentalDatabase extends Component
{
    use WithPagination;
    public $propertyDetails,$user,$address, $point, $property_id,$unit_name,$unit_id,$badge_count, $email_addresses = [],$guest_count, $badgeDates = [], $guests=[], $remaining_count,$selected_badge, $shortBadgeStatus;
    public $alldatas=[], $selectedOption = 'default', $property_name,$property, $date_order, $order_column,$order_as;
    public $checkin_date,$checkout_date, $guest, $globalSelected = [], $selectAll,$bulkIds = [], $all_email,$cancel_start_Date, $cancel_end_Date,$buldingList = [], $select_building, $search_text, $result, $showdiv, $guest_reward_value, $select_unit_id, $recognition_point, $points;
    protected $listeners = ['checkEmail','datepickerEnable','adjustdatepickerEnable'];


    public function mount(){
        $this->user = auth()->user();
        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$this->user->id)->get();
        $this->property_id = $this->propertyDetails->first()->provider_id;
        $this->address = $this->propertyDetails->first()->provider->address ;
        $this->property_name = $this->propertyDetails->first()->provider->name ;
        $this->point = number_format($this->propertyDetails->first()->provider->points_to_distribute);
        $this->property = Provider::find($this->property_id);
        $this->unit_name = '';
        $this->badge_count = 10;
        $this->guest_count = 0;
        $this->guests =[];
        $this->remaining_count = 0;
        $this->selected_badge = '';
        $this->order_column = 'id';
        $this->order_as = 'desc';
        $this->date_order = 'all';
        $this->today = date('Y-m-d');

        // dd($this->propertyDetails->pluck('provider_id'));
        $this->buldingList = ProviderBuilding::where('provider_type_id',$this->property_id)->get();
        // dd($this->buldingList);
    }

    final public function paginationView(): string
    {
        return 'livewire.frontend.property-manager.livewire-piganation';
    }

    public function updatingSelectedOption()
    {
        $this->resetPage();
    }


    public function getpropertyDetail($propertyid){
        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$this->user->id)->get();
        $this->property = Provider::find($propertyid);
        $this->property_id = $propertyid;
        $this->address = $this->property->address ;
        $this->property_name = $this->property->name ;
        $this->point = number_format($this->property->points_to_distribute);
        $this->unit_name = '';
        $this->badge_count = 10;
        $this->guest_count = 0;
        $this->guests =[];
        $this->remaining_count = 0;
        $this->selected_badge = '';
        $this->buldingList = ProviderBuilding::where('provider_type_id',$this->property_id)->get();
        $this->showdiv = false;
        $this->select_unit_id= '';
        $this->select_building = '';
    }

    public function searchResult(){
        if(!empty($this->search_text)){
            if($this->select_building == 'all'){
                $this->result = BuildingUnit::where('status',1)
                                ->where('unit','like','%'.trim($this->search_text).'%')
                                ->where('provider_id',$this->property_id)
                                ->orderBy('unit','asc')
                                ->get();
                
            }
            elseif($this->select_building != ''){
                $this->result = BuildingUnit::where('status',1)
                                ->where('unit','like','%'.trim($this->search_text).'%')
                                ->where('building_id',$this->select_building)
                                ->where('provider_id',$this->property_id)
                                ->orderBy('unit','asc')
                                ->get();
            }
            else{
                $this->result = BuildingUnit::where('status',1)
                                ->where('unit','like','%'.trim($this->search_text).'%')
                                ->where('provider_id',$this->property_id)
                                ->orderBy('unit','asc')
                                ->get();
            }
        //    dd($this->result);
            $this->showdiv = true;
        }
        else{
            $this->select_unit_id = '';
            $this->showdiv = false;
        }
    }

    public function getUnit($unitid){
        $this->select_unit_id = $unitid;
        $building_unit = BuildingUnit::find($unitid);
        $this->search_text = $building_unit->unit;
        $this->showdiv = false;
        $this->result = [];
    }



    public function addBadgeForUnit($unit_id){
        // dd($unit_id);
        $this->unit_id = $unit_id;
        $this->unit_name = BuildingUnit::find($unit_id)->unit;
        $this->remaining_count = 10;
        $this->checkin_date = '';
        $this->checkout_date = '';
        $this->badgeDates = [];
        $this->email_addresses = [];
        $this->selected_badge = '';
        $this->guests = [];
        $this->guest_count = 0;
        $badges = Apartmentbadge::where('unit_id',$this->unit_id)->get();
        if(count($badges) > 0){
            foreach($badges as $data_badge){
                $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
            }
        }
        // dd($this->badgeDates);
        $this->emit('open_add_badge',['date_range' => $this->badgeDates]);
    }

    public function getBadgeGuest($badgeid){
        if($badgeid){
            // dd($badgeid);
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->selected_badge = '';
            $this->guest_count = 0;
            $this->selected_badge = Apartmentbadge::find($badgeid);
            if($this->selected_badge){
                $this->unit_id = $this->selected_badge->unit_id;
                $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
                $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
                $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
                $badges = Apartmentbadge::where('unit_id',$this->unit_id)->get();
                if(count($badges) > 0){
                    foreach($badges as $data_badge){
                        $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
                    }
                }
               
                $this->guests = ApartmentGuestBadge::where('badges_id',$badgeid)->get();
                if(count($this->guests) > 0){
                    $this->remaining_count = $this->badge_count - count($this->guests);
                    $this->guest_count = count($this->guests);
                }
                else{
                    $this->remaining_count = 10;
                }
                $this->emit('open_add_badge',['date_range' => $this->badgeDates ]);
            }
        }
        
    }

    public function datepickerEnable(){
        $this->emit('open_add_badge',['date_range' => []]);
    }

    public function sendBadge(){
        $filteredArray = [];
        if($this->checkin_date != ''){
            if ($this->checkout_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
                $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
                if(count($this->email_addresses) > 0){
                    foreach($this->email_addresses as $emails){
                        $other_user = User::where('email',$emails)->whereHas(
                            'roles', function($q){
                                $q->where('name','!=' ,'CONSUMER');
                            }
                        )->first();
                        if($other_user){
                            $this->emit('badgeError', ['text' => $emails.' has different role. So you can not send any request for your badge']);
                        }
                        
                    }
                }
                if($checkindate == $checkoutdate){
                    $this->emit('badgeError', ['text' => 'Lease start and Lease end date cannot be same']);
                }
                elseif($checkindate > $checkoutdate){
                    $this->emit('badgeError', ['text' => 'Lease start date should not greater than Lease end date']);
                }
                else{
                    // dd(count($this->email_addresses));

                    if (count($this->email_addresses) > 0) {
                            $filteredArray = array_filter($this->email_addresses, function ($var) {
                                return (filter_var($var, FILTER_VALIDATE_EMAIL) == false);
                            });

                        if(count($filteredArray) > 0){                        
                            $this->emit('badgeError', ['text' => 'Please give correct email address']);
                        }
                        else{
                            // foreach($this->email_addresses as $emails){
                            //     $guest_badge = ApartmentGuestBadge::where('guest_email',$emails)->orderBy('id','desc')->get();
                            //     if($guest_badge){

                            //     }
                            // }




                            $i = 1;
                            $badge = Apartmentbadge::where('start_date',$checkindate)->where('end_date',$checkoutdate)->where('unit_id',$this->unit_id)->first();
    
                            if($badge){
                                
                                $all_email = $this->email_addresses;
                                $valid_email = array();
                                $used_email = array();
    
                                foreach($all_email as $email){
                                    $email_check = ApartmentGuestBadge::where('guest_email',$email)->orderBy('id','DESC')->first();
                                    if(isset($email_check->guest_email)){
                                        $used_email[] = array('badge_id'=>$email_check->badges_id,'email'=>$email_check->guest_email);
                                    }else{
                                        array_push($valid_email,$email);
                                    }
                                }
                            
                                $date_in = array();
                                //$date_over = array();
                                foreach ($used_email as $used_mail) {
                                    //dd($used_mail['email']);
                                    $expire_date = Apartmentbadge::where('id', $used_mail['badge_id'])->whereDate('end_date', '>', date('Y-m-d'))->first();
                                    if ($expire_date) {
                                        $date_in[] = $used_mail['email'];
                                    } else {
                                        //$date_over = $used_mail['email'];
                                        array_push($valid_email,$used_mail['email']);
                                    }
                                }
                                //dd($date_in,$valid_email);
                                                            
                                $used_email_count = count($date_in);
                                if($used_email_count > 0){
                                    $implode_email = implode(",  ",$date_in);
                                    //dd($implode_email);
                                    $this->emit('badgeError', ['text' => 'There is already a pending or activated badge for ' . $implode_email . ' email address. There is a limit of one resident badge per member.']);
                                }
                                // dd($valid_email);
                                    
                                //die();
                                $this->selected_badge = $badge;
                                $others = [];
                                if(count($all_email) > 0){
                                    if (count($valid_email) > 0) {
                                        foreach ($valid_email as $key => $emails) {
                                            if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                                                $user = User::where('email', $emails)->role('CONSUMER')->first();
                                                $other_user = User::where('email',$emails)->whereHas(
                                                    'roles', function($q){
                                                        $q->where('name','!=' ,'CONSUMER');
                                                    }
                                                )->first();
                                                if ($user) {
                                                    $guest_badge = ApartmentGuestBadge::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new ApartmentGuestBadge;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->guest_first_name = $user->first_name;
                                                        $guest_badge->guest_last_name = $user->last_name;
                                                        $guest_badge->user_id = $user->id;
                                                        $guest_badge->save();
                                                        $building = ProviderBuilding::find($badge->building_id);
                                                        $limit_setting = ProviderLimitSetting::where('property_id',$building->provider_type_id)->first();
                                                        if($limit_setting){
                                                            if($limit_setting->sign_up_bonus_point){
                                                                $point = $limit_setting->sign_up_bonus_point;
                                                            }
                                                            else{
                                                                $point = '';
                                                            } 
                                                        }
                                                        else{
                                                            $point = '';
                                                        }
                                                        $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                        $details = array(
                                                            'apartment_name' => $this->unit_name,
                                                            'building' => $building->building_name,
                                                            'point' => $point,
                                                            'arrival_date' => $arrival_date,
                                                            'request_id' => $guest_badge->id
                                                        );
                                                        //dd($details);
                                                        $this->guests = ApartmentGuestBadge::where('badges_id',$badge->id)->get();
                                                        if(count($this->guests) > 0){
                                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                                            $this->guest_count = count($this->guests);
                                                        }
                                                        else{
                                                            $this->remaining_count = 10;
                                                        }
                                                        Mail::to($emails)->queue(new ProviderBadgeSentEmail($details));
                                                    }
                                                }
                                                elseif($other_user){
                                                    array_push($others,$emails);
                                                }
                                                else{
                                                    
                                                        $guest_badge = new ApartmentGuestBadge;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->save();
                                                        $building = ProviderBuilding::find($badge->building_id);
                                                        $limit_setting = ProviderLimitSetting::where('property_id',$building->provider_type_id)->first();
                                                        if($limit_setting){
                                                            if($limit_setting->sign_up_bonus_point){
                                                                $point = $limit_setting->sign_up_bonus_point;
                                                            }
                                                            else{
                                                                $point = '';
                                                            } 
                                                        }
                                                        else{
                                                            $point = '';
                                                        }
                                                        $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                        $details = array(
                                                            'apartment_name' => $this->unit_name,
                                                            'building' => $building->building_name,
                                                            'point' => $point,
                                                            'arrival_date' => $arrival_date,
                                                            'request_id' => $guest_badge->id
                                                        );
                                                        //dd($details);
                                                        $this->guests = ApartmentGuestBadge::where('badges_id',$badge->id)->get();
                                                        if(count($this->guests) > 0){
                                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                                            $this->guest_count = count($this->guests);
                                                        }
                                                        else{
                                                            $this->remaining_count = 10;
                                                        }
                                                        Mail::to($emails)->queue(new ProviderBadgeSentEmail($details));
                                                   
                                                }
                                            }
                
                                        }
                                        $this->email_addresses = '';
                                        $this->guests = ApartmentGuestBadge::where('badges_id',$badge->id)->get();
                                        if(count($this->guests) > 0){
                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                            $this->guest_count = count($this->guests);
                                        }
                                        else{
                                            $this->remaining_count = 10;
                                        }
                                        if(count($others) > 0){
                                            $other_email = implode(',',$others);
                                            $this->emit('badgeError', ['text' => 'Invite Sent Successfully & '.$other_email.' has different role. So you can not send any request for your badge ']);
                                        }
                                        else{
                                            $this->emit('badgeError', ['text' => 'Invite Sent Successfully']);
                                        }
                                       
                                    
                                    }else{
                                        $this->emit('badgeError', ['text' => 'There is already a pending or activated badge for ' . $implode_email . ' email address. There is a limit of one resident badge per member.']);
                                    }
                                }else{
                                    $this->emit('badgeError', ['text' => 'Please give at least one email address']);
                                }
                                
                            }
                            else{
                               
                                if (count($this->email_addresses) > 0) {

                                    $all_email = $this->email_addresses;
                                    $valid_email = array();
                                    $used_email = array();
    
                                    foreach($all_email as $email){
                                        $email_check = ApartmentGuestBadge::where('guest_email',$email)->orderBy('id','DESC')->first();
                                        if(isset($email_check->guest_email)){
                                            $used_email[] = array('badge_id'=>$email_check->badges_id,'email'=>$email_check->guest_email);
                                        }else{
                                            array_push($valid_email,$email);
                                        }
                                    }
                            
                                    $date_in = array();
                                    //$date_over = array();
                                    foreach ($used_email as $used_mail) {
                                        //dd($used_mail['email']);
                                        $expire_date = Apartmentbadge::where('id', $used_mail['badge_id'])->whereDate('end_date', '>', date('Y-m-d'))->first();
                                        if ($expire_date) {
                                            $date_in[] = $used_mail['email'];
                                        } else {
                                            //$date_over = $used_mail['email'];
                                            array_push($valid_email,$used_mail['email']);
                                        }
                                    }
                                    
                                                            
                                    $used_email_count = count($date_in);
                                    // dd($used_email_count);
                                    if($used_email_count > 0){
                                        $implode_email = implode(",  ",$date_in);
                                        //dd($implode_email);
                                        $this->emit('badgeError', ['text' => 'There is already a pending or activated badge for ' . $implode_email . ' email address. There is a limit of one resident badge per member.']);
                                    }
                                    else{
                                        $building_id = BuildingUnit::find($this->unit_id)->building_id;
                                        $badge = new Apartmentbadge;
                                        $badge->start_date = $checkindate;
                                        $badge->end_date = $checkoutdate;
                                        $badge->unit_id = $this->unit_id;
                                        $badge->building_id = $building_id;
                                        $badge->status = true;
                                        $badge->save();
                                        $this->selected_badge = $badge;
                                        foreach ($this->email_addresses as $key => $emails) {
                                            if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                                                $user = User::where('email', $emails)->role('CONSUMER')->first();
                                                if ($user) {
                                                    $guest_badge = ApartmentGuestBadge::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new ApartmentGuestBadge;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->guest_first_name = $user->first_name;
                                                        $guest_badge->guest_last_name = $user->last_name;
                                                        $guest_badge->user_id = $user->id;
                                                        $guest_badge->save();
                                                        $building = ProviderBuilding::find($building_id);
                                                        $limit_setting = ProviderLimitSetting::where('property_id',$building->provider_type_id)->first();
                                                        if($limit_setting){
                                                            if($limit_setting->sign_up_bonus_point){
                                                                $point = $limit_setting->sign_up_bonus_point;
                                                            }
                                                            else{
                                                                $point = '';
                                                            } 
                                                        }
                                                        else{
                                                            $point = '';
                                                        }
                                                        $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                        $details = array(
                                                            'apartment_name' => $this->unit_name,
                                                            'building' => $building->building_name,
                                                            'point' => $point,
                                                            'arrival_date' => $arrival_date,
                                                            'request_id' => $guest_badge->id
                                                        );
                                                        //dd($details);
                                                        Mail::to($emails)->queue(new ProviderBadgeSentEmail($details));
                                                    }
                                                }
                                                else{
                                                    $guest_badge = ApartmentGuestBadge::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new ApartmentGuestBadge;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->save();
                                                        $building = ProviderBuilding::find($building_id);
                                                        $limit_setting = ProviderLimitSetting::where('property_id',$building->provider_type_id)->first();
                                                        if($limit_setting){
                                                            if($limit_setting->sign_up_bonus_point){
                                                                $point = $limit_setting->sign_up_bonus_point;
                                                            }
                                                            else{
                                                                $point = '';
                                                            } 
                                                        }
                                                        else{
                                                            $point = '';
                                                        }
                                                        $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                        $details = array(
                                                            'apartment_name' => $this->unit_name,
                                                            'building' => $building->building_name,
                                                            'point' => $point,
                                                            'arrival_date' => $arrival_date,
                                                            'request_id' => $guest_badge->id
                                                        );
                                                        //dd($details);
                                                        Mail::to($emails)->queue(new ProviderBadgeSentEmail($details));
                                                    } 
                                                }
                                            }
                
                                        }
                                        
                                        $this->email_addresses = '';
                                        $this->guests = ApartmentGuestBadge::where('badges_id',$badge->id)->get();
                                        if(count($this->guests) > 0){
                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                            $this->guest_count = count($this->guests);
                                        }
                                        else{
                                            $this->remaining_count = 10;
                                        }
                                        $this->emit('badgeError', ['text' => 'Invite Sent Successfully']);
                                    }  
                                }
                                else{
                                    $this->emit('badgeError', ['text' => 'Badge Created Successfully']);
                                }
                            }
                            //dd($badge);
                        }
                    }
                    else{
                        $badge = Apartmentbadge::where('start_date',$checkindate)->where('end_date',$checkoutdate)->where('unit_id',$this->unit_id)->first();
                        if($badge){
                            $this->emit('badgeError', ['text' => 'Badge is Updated']);
                        }
                        else{
                            $building_id = BuildingUnit::find($this->unit_id)->building_id;
                            $badge = new Apartmentbadge;
                            $badge->start_date = $checkindate;
                            $badge->end_date = $checkoutdate;
                            $badge->unit_id = $this->unit_id;
                            $badge->building_id = $building_id;
                            $badge->status = true;
                            $badge->save();
                            $this->selected_badge = $badge;
                            $this->emit('badgeError', ['text' => 'Badge Created Successfully']);
                        }
                        
                    }
                    
                }
                
            }
            else{
                $this->emit('badgeError', ['text' => 'Please give lease end date']);
            }
        }
        else{
            $this->emit('badgeError', ['text' => 'Please give Lease start date']);
        }
    }



    public function checkEmail()
    {

        // $checkindate = date_format(date_create($this->badge_checkin_date), 'Y-m-d');
        // $checkoutdate = date_format(date_create($this->badge_checkout_date), 'Y-m-d');
        // $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
        //     ->whereBetween('checkin_date', [$checkindate, $checkoutdate])
        //     ->count();
        if (count($this->email_addresses) > 0) {
            // dd(count($this->email_addresses));
            //foreach($this->email_addresses as $key=>$data){
            $email = end($this->email_addresses);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $email)->role('CONSUMER')->first();
                if ($user) {
                    $this->emit('memberSuccessPopup', ['type' => 'member_found']);
                } else {
                    $other_user = User::where('email',$email)->first();
                    if($other_user){
                        $this->emit('memberSuccessPopup', ['type' => 'member_different_role']);
                    }
                    else{
                        $this->emit('memberSuccessPopup', ['type' => 'member_not_found']);
                    }
                    
                }
            } else {
                $this->emit('memberSuccessPopup', ['type' => 'wrong_email']);
            }

            //}

        }
    }

    public function refreshForm(){
        if($this->selected_badge != ''){
            $this->unit_id = $this->selected_badge->unit_id;
            $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
            $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
            $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
            $this->badgeDates = array('startDate' => $this->selected_badge->start_date, 'endDate' => $this->selected_badge->end_date);
            $this->guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
            if(count($this->guests) > 0){
                $this->remaining_count = $this->badge_count - count($this->guests);
                $this->guest_count = count($this->guests);
            }
            else{
                $this->remaining_count = 10;
            }
        }
    }

    public function clearBadgeDates(){
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                // dd($this->checkin_date);
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                // dd($checkindate); 
                $this->emit('clearBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('memberSuccessPopup', ['type' => '']);
            }
        } else {
            $this->emit('memberSuccessPopup', ['type' => '']);
        }
    }

    public function removeBadgeDates()
    {
 
        if($this->selected_badge != ''){

            if($this->selected_badge){
                $this->guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
                if(count($this->guests) > 0){
                    foreach($this->guests as $guest){
                        ApartmentGuestBadge::where('id',$guest->id)->delete();
                    }
                    $this->selected_badge->delete();
                }
                else{
                    
                    $this->selected_badge->delete();
                }
            }
            $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
            // dd($this->unit_name);
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->guests = [];
            $this->guest_count = 0;
            $this->selected_badge = '';
            $this->emit('removeBadgeDate', ['text' => 'Badge request is cancelled successfully']);
        }

    }

    public function resendClearBadgeDates(){
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                // dd($this->checkin_date);
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                // dd($checkindate); 
                $this->emit('resendclearBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('memberSuccessPopup', ['type' => '']);
            }
        } else {
            $this->emit('memberSuccessPopup', ['type' => '']);
        }
    }

    public function resendRemoveBadgeDates(){
        if($this->selected_badge != ''){

            if($this->selected_badge){
                $this->guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
                if(count($this->guests) > 0){
                    foreach($this->guests as $guest){
                        ApartmentGuestBadge::where('id',$guest->id)->delete();
                    }
                    $this->selected_badge->delete();
                }
                else{
                    
                    $this->selected_badge->delete();
                }
            }
            $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
            // dd($this->unit_name);
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->guests = [];
            $this->guest_count = 0;
            $this->selected_badge = '';
            $this->emit('resendRemoveBadgeDate', ['text' => 'Badge request is cancelled successfully']);
        }
    }

    public function closeSuccessModal(){
        // $this->checkin_date = '';
        // $this->checkout_date = '';
        // $this->badgeDates = [];
        // $this->email_addresses = [];
        // $this->guests = [];
        // $this->guest_count = 0;
        $this->emit('closeSuccessPopup');
    }

    public function  adjustLease    () {
        $this->emit('openAdjustLease');
    }

    public function adjustdatepickerEnable(){
        $this->emit('openAdjustLease');
    }

    public function SaveLease(){
        if($this->checkin_date != ''){
            if ($this->checkout_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
                $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
                if($checkindate == $checkoutdate){
                    $this->emit('badgeError', ['text' => 'Lease start and Lease end date cannot be same']);
                }
                elseif($checkindate > $checkoutdate){
                    $this->emit('badgeError', ['text' => 'Lease start date should not greater than Lease end date']);
                }
                else{
                    if($this->selected_badge != ''){
                        $badge = Apartmentbadge::find($this->selected_badge->id);
                        $badge->start_date = $checkindate;
                        $badge->end_date = $checkoutdate;
                        $badge->save();
                        // $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
                        // $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
                    }
                    $this->emit('closeSaveLease');
                }

            }
        }
    }

    public function leaseRenewal(){
        if($this->selected_badge != ''){
            // dd($this->selected_badge->building->provider_type_id);
            $property_limit = ProviderLimitSetting::where('property_id', $this->selected_badge->building->provider_type_id)->first();
            if($property_limit){
                if ($property_limit->term_limit != null){
                    $start_Date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+'.$property_limit->term_limit));
                    $badge = Apartmentbadge::find($this->selected_badge->id);
                    $badge->start_date = $start_Date;
                    $badge->end_date = $end_date;
                    $badge->save();
                    $this->checkin_date = date_format(date_create($start_Date),'m/d/Y');
                    $this->checkout_date = date_format(date_create($end_date),'m/d/Y');
                }
                else{
                    $this->emit('memberSuccessPopup',['type'=>'lease_Renewal','message' => "Please set the Term limit in settings"]);
                }
            }
            else{
                $this->emit('memberSuccessPopup',['type'=>'lease_Renewal','message' => "Please set the property limit"]);
            }

        }
    }

    public function getBadgeDetail($id,$type){
        if($type == 'badge'){
            $this->selected_badge = Apartmentbadge::find($id);
            $this->guest = '';
        }
        elseif($type == 'guest'){
            $this->guest = ApartmentGuestBadge::find($id);
            $this->selected_badge = Apartmentbadge::find($this->guest->badges_id);

        }
        elseif($type == 'unit'){
            $this->guest = '';
            $this->selected_badge = '';
        }
    }

    public function guestRecognition()
    {
        //dd($this->selected_badge->building->provider_type_id);
        if($this->selected_badge != ''){
            $limit_setting = ProviderLimitSetting::where('property_id',$this->selected_badge->building->provider_type_id)->first();
            if($limit_setting){
                $this->recognition_point = $limit_setting->tenant_of_the_month_Reward;
                if($this->recognition_point == null){
                    $this->points = '';
                }else{
                    $this->points = $this->recognition_point;
                }
            }
            else{
                $this->points = '';
            }
            $this->emit('guestRecognitionpopup');
        }
        else{
            // $this->emit('termError',['text' => "No Badge is "]);
        }
        
    }

    public function closeRecognition(){
        $this->emit('disableguestRecognitionpopup');
    }

    public function tenantReward(){
        $previous_date = date('Y-m-d', strtotime('-30 days'));
        $today = date('Y-m-d');
        $thismonth = date('m');
        if ($this->guest_reward_value != '') {
            if($this->guest_reward_value == 'resident_of_the_month'){
                if(($this->guest != '') && ($this->guest->user_id != '')){
                    
                    $reward_count = ApartmentGuestBadge::where('reward_type','resident_of_the_month')->whereMonth('reward_active_on',$thismonth)->count();
                    // dd($reward_count);
                    if($reward_count >= 100){
                        $this->emit('newtermError',['text' => "Reward unavailable. No reward availabe on thos month."]);
                    }
                    else{
                        // dd($this->selected_badge->id);
                        $resident_exist = ApartmentGuestBadge::where('user_id',$this->guest->user_id)->where('reward_type','resident_of_the_month')->where('badges_id',$this->selected_badge->id)->first();
                        // dd($this->guest->user->id);
                        if($resident_exist){
                            $today = date('Y-m-d');
                            $date = $resident_exist->reward_active_on;
                            $interval = new DateInterval('P30D');
                            $dateTime = new DateTime($date);
                            $dateTime->add($interval);
                            $newDate = $dateTime->format('m-d-Y');
                            $dateformat = date('m-d-Y',strtotime($resident_exist->reward_active_on));
                            $end_recog_date = $dateTime->format('Y-m-d');
                            if($today <= $end_recog_date){
                                $this->emit('newtermError',['text' => $this->guest->user->full_name.' has already received Resident of The Month for the month of '.date('F').'. The member will be eligible to receive Resident of the month again in '.$newDate]);
                            }
                            
                        }else{
                            $this->guest->reward_type = 'resident_of_the_month';
                            $this->guest->reward_active_on = date('Y-m-d');
                            $this->guest->save();
                            $insert_recog = ConsumerRecognition::insert([
                                'user_id' => $this->guest->user->id,
                                'badge_id'=> $this->selected_badge->id,
                                'provider_id' => $this->selected_badge->building->provider_type_id,
                                'reward_type' => 'resident_of_the_month',
                                'guest_email' => $this->guest->user->email,
                                'start_date' => $this->selected_badge->start_date,
                                'end_date'=> $this->selected_badge->end_date,
                                'reward_given_date' => date('Y-m-d'),
                                'points_given' => $this->points
                            ]);

                            if($this->points != ''){
                                $this->guest->point = $this->guest->point+$this->points;
                                $this->guest->save();
    
                                 /**Add point in point table */
                                $point = new Point();
                                $point->user_id = $this->guest->user_id;
                                $point->point = $this->points;
                                $point->came_from = auth()->user()->id;
                                $point->added_for = 'resident_recognition';
                                $point->property_id = $this->selected_badge->building->provider_type_id;
                                $point->save();
    
                                /**Add point to user table*/
                                $user = User::find($this->guest->user_id);
                                $totalPoint = $user->point + $this->points;
                                $user->point =  $totalPoint;
                                $user->save();
    
                                 /**deduct point from travel tourism*/
                                 $property = Provider::find($this->selected_badge->building->provider_type_id);
                                 $property->points_to_distribute = $property->points_to_distribute - $this->points;
                                 $property->save();
                                 $this->emit('newtermError',['text' => 'Resident of The Month has been awarded to ' . $this->guest->user->full_name . ' along with ' . $this->points . ' points']);
                            }else{
                                $this->emit('newtermError',['text' => "Please add reward point to give reward in settings"]);
                            }
                        }

                    }
                }
                else{
                    $this->emit('newtermError',['text' => "For 'Resident Of The Month' reward, you have to select any one guest"]);
                }
            }
            else{
                if($this->selected_badge != ''){
                    $thismonth = date('m');
                    // dd($this->guest->user_id);
                    // $userids = $this->selected_badge->badge_guest->where('user_id','!=',null)->pluck('user_id');
                    // $resident_count = ApartmentGuestBadge::where('reward_type','resident_of_the_month')->whereMonth('reward_active_on',$thismonth)->whereIn('user_id',$userids)->count();
                    // // dd($resident_count); ->whereBetween('reward_active_on',[$previous_date,$today])
                    $reward_exist = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->where('user_id',$this->guest->user_id)->whereNotNull('family_reward_type')->first();
                    // dd($reward_exist);
                    if($reward_exist){
                        $date1=date_create($reward_exist->reward_active_on);
                        $date2=date_create($today);
                        $diff=date_diff($date1,$date2);
                        $difference = $diff->format("%a");
                        $remain_days = (30 -$difference);

                        $this->emit('newtermError',['text' => $this->selected_badge->buildingunit->unit.' has already received Family and Friends reward within the last 30 days. The unit this resident resides in will be eligible again to receive the Family and Friends reward again in '.$remain_days.' days.']);
                    }else{
                        $guest_badge = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->where('user_id','!=','')->get();
                        // dd($guest_badge);
                        if(count($guest_badge) > 0){
                            foreach($guest_badge as $guest){
                                $guest_unit = ApartmentGuestBadge::find($guest->id);
                                $guest_unit->family_reward_type = 'family_friend';
                                $guest_unit->family_friend_active_date = date('Y-m-d');
                                $guest_unit->point = $guest_unit->point+$this->points;
                                $guest_unit->save();

                                $user_datails = User::find($guest_unit->user_id);
                                $insert_recog = ConsumerRecognition::insert([
                                    'user_id' => $user_datails->id,
                                    'badge_id'=> $this->selected_badge->id,
                                    'provider_id' => $this->selected_badge->building->provider_type_id,
                                    'reward_type' => 'family_friend',
                                    'guest_email' => $user_datails->email,
                                    'start_date' => $this->selected_badge->start_date,
                                    'end_date'=> $this->selected_badge->end_date,
                                    'reward_given_date' => date('Y-m-d'),
                                    'points_given' => $this->points
                                ]);

                                /**Add point in point table */
                                $point = new Point();
                                $point->user_id = $guest_unit->user_id;
                                $point->point = $this->points;
                                $point->came_from = auth()->user()->id;
                                $point->added_for = 'resident_recognition';
                                $point->property_id = $this->selected_badge->building->provider_type_id;
                                $point->save();

                                /**Add point to user table*/
                                $user = User::find($guest_unit->user_id);
                                $totalPoint = $user->point + $this->points;
                                $user->point =  $totalPoint;
                                $user->save();

                                /**deduct point from travel tourism*/
                                $property = Provider::find($this->selected_badge->building->provider_type_id);
                                $property->points_to_distribute = $property->points_to_distribute - $this->points;
                                $property->save();

                            }
                            $this->emit('newtermError',['text' => "Friends and Family Reward has been awarded to all members in this booking with active badges along with " . $this->points . " points. If a new member is added later during their stay, they will automatically have the reward in the Badges section of their wallet."]);
                        }
                        else{
                            $this->emit('newtermError',['text' => "No active resident is there"]);
                        }

                    }
                }
                else{
                    $this->emit('newtermError',['text' => "For 'Family and Friends Rewards', you have to select any one unit badge"]);
                }
            }
        }
        else{
            $this->emit('newtermError',['text' => "Select any one option"]);
        }
    }
    

    public function addBadgeTerm(){
        if($this->selected_badge != ''){
            // dd($this->selected_badge->building->provider_type_id);
            $property_limit = ProviderLimitSetting::where('property_id', $this->selected_badge->building->provider_type_id)->first();
            if($property_limit){
                //dd($property_limit);
                if ($property_limit->term_limit != null){
                    $start_Date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+'.$property_limit->term_limit));
                    // dd($end_date);
                    $badge = Apartmentbadge::find($this->selected_badge->id);
                    $badge->start_date = $start_Date;
                    $badge->end_date = $end_date;
                    $badge->save();
                    // $this->checkin_date = date_format(date_create($start_Date),'m/d/Y');
                    // $this->checkout_date = date_format(date_create($end_date),'m/d/Y');
                    $this->emit('termError',['text' => "Term Added Successfully"]);
                }
                else{
                    // dd($property_limit->term_limit);
                    $this->emit('termError',['text' => "Please set the Term limit in settings"]);
                }
            }
            else{
                $this->emit('termError',['text' => "Please set the property limit"]);
            }

        }
        else{
            $this->emit('termError',['text' => "Please select a badge"]);
        }
    }

    public function resendBadge(){
        if($this->selected_badge != ''){
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->guest_count = 0;
                $this->unit_id = $this->selected_badge->unit_id;
                $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
                $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
                $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
                if($this->selected_badge->end_date < date('Y-m-d')){
                    $this->emit('termError', ['text' => 'Unable to send badge invites after lease end date.']);
                    return;  
                }
                $badges = Apartmentbadge::where('unit_id',$this->unit_id)->get();
                if(count($badges) > 0){
                    foreach($badges as $data_badge){
                        $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
                    }
                }
               
                $this->guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
                if(count($this->guests) > 0){
                    $this->remaining_count = $this->badge_count - count($this->guests);
                    $this->guest_count = count($this->guests);
                }
                else{
                    $this->remaining_count = 10;
                }
                $this->emit('resend_badge',['date_range' => $this->badgeDates ]);

                // dd($this->selected_badge->end_date);
                if($this->selected_badge->end_date < date('Y-m-d')){
                    $this->globalSelected = [];   
                }
                else{
                    $this->globalSelected = $this->guests->where('status', 0)->pluck('id');
                }
                // dd($this->globalSelected,$this->selected_badge->end_date,date('Y-m-d'));
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->bulkIds = $this->globalSelected;
        } else {
            $this->bulkIds = [];
        }
    }

    public function selectSingle($id)
    {
        if (!in_array($id, $this->bulkIds)) {
            $this->selectAll = false;
        } else {
            $this->selectAll = (count($this->globalSelected) == count($this->bulkIds)) ? true : false;
        }
    }

    public function resendGuestBadge(){
        $limit_setting = ProviderLimitSetting::where('property_id',$this->selected_badge->building->provider_type_id)->first();
        if($limit_setting){
            if($limit_setting->sign_up_bonus_point){
                $point = $limit_setting->sign_up_bonus_point;
            }
            else{
                $point = '';
            } 
        }
        else{
            $point = '';
        }
        if (count($this->bulkIds) > 0) {
            foreach ($this->bulkIds as $id) {
                
                if ($this->selected_badge != '') {
                   
                    $arrival_date = date_format(date_create($this->selected_badge->start_date), 'm/d/Y');
                   
                    $guest_badge = ApartmentGuestBadge::find($id);
                    $guest_badge->is_resend = 1;
                    $guest_badge->save();

                    $details = array(
                        'apartment_name' => $this->unit_name,
                        'building' => $this->selected_badge->building->building_name,
                        'point' => $point,
                        'arrival_date' => $arrival_date,
                        'request_id' => $guest_badge->id
                    );
                    //dd($details);
                    Mail::to($guest_badge->guest_email)->queue(new ProviderBadgeSentEmail($details));
                }
            }
            $this->selectAll = false;
            $this->bulkIds = [];
            $this->guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
            $this->emit('termError', ['text' => 'This badge has been successfully resent to the selected user']);
        } else {

            $this->emit('termError', ['text' => 'Please select an email address(es) to resend invite.']);
        }
    }

    public function deactivateBadge(){
        if($this->selected_badge){
            $today = date('Y-m-d');
            // if ($today > $this->selected_badge->start_date) {
            //     $this->emit('deactivateBadges', ['type' => 1]);
            // } else {
                $this->emit('deactivateBadges', ['type' => 0]);
            // }
        }
    }

    public function yesDeacivateBadge()
    {
        if ($this->selected_badge) {
            if($this->guest != ''){
                $this->guest->delete();
            }
            else{
               $badge_guest = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
                if($badge_guest){
                    $badge_guest->each->delete();
                }
                $this->selected_badge->delete();

            }
            $this->emit('termError',['text' => 'Badge deactivated successfully']);
        }
        // $this->emit('successDeactivateBadges');
    }

    public function addPoint(){
        if ($this->selected_badge) {
            if($this->guest != ''){
                if($this->guest->status == 1){
                    $provider_setting = ProviderLimitSetting::where('property_id', $this->selected_badge->building->provider_type_id)->first();
                    if($provider_setting){
                        if($provider_setting->add_point != null){
                            $setting_point = $provider_setting->add_point;
                            // dd($this->point);
                            if($this->property->points_to_distribute > $setting_point ){
                                $user = User::find($this->guest->user_id);
                                //Add point in point table
                                $point = new Point;
                                $point->user_id = $this->guest->user_id;
                                $point->point = $setting_point;
                                $point->came_from = auth()->user()->id;
                                $point->added_for = 'add_point';
                                $point->property_id = $this->selected_badge->building->provider_type_id;
                                $point->save();
                                //Add point to user table
                                $userpoint = $user->point;
                                $totalPoint = $userpoint + $setting_point;
                                $user->point =  $totalPoint;
                                $user->save();
                                //Add point to badge table
                                $this->guest->point = $totalPoint;
                                $this->guest->save();

                                //desuct point from travel tourism
                                $property = Provider::find($this->selected_badge->building->provider_type_id);
                                $property->points_to_distribute = $this->property->points_to_distribute - $setting_point;
                                $property->save();
                                $this->emit('termError',['text' => 'Points have been added to this member’s account']);
                            }
                            else{
                                $this->emit('termError',['text' => $this->property_name . "'s point should be greater than added points"]);
                            }
                        }
                        else{
                            $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                        }
                    }
                    else{
                        $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                    }
                }
                else{
                    $this->emit('termError', ['text' => 'This user has not accepted the badge request']);
                }
            }
            else{
                $guests = ApartmentGuestBadge::where('badges_id',$this->selected_badge->id)->get();
                if(count($guests) > 0){
                    foreach($guests as $badge_guest){
                        if($badge_guest->status == 1){
                            $provider_setting = ProviderLimitSetting::where('property_id', $this->selected_badge->building->provider_type_id)->first();
                            if($provider_setting){
                                if($provider_setting->add_point != null){
                                    $setting_point = $provider_setting->add_point;
                                    if($this->property->points_to_distribute > $setting_point ){
                                        $user = User::find($badge_guest->user_id);
                                        //Add point in point table
                                        $point = new Point;
                                        $point->user_id = $badge_guest->user_id;
                                        $point->point = $setting_point;
                                        $point->came_from = auth()->user()->id;
                                        $point->added_for = 'add_point';
                                        $point->property_id = $this->selected_badge->building->provider_type_id;
                                        $point->save();
                                        //Add point to user table
                                        $userpoint = $user->point;
                                        $totalPoint = $userpoint + $setting_point;
                                        $user->point =  $totalPoint;
                                        $user->save();
                                        //Add point to badge table
                                        $badge_data = ApartmentGuestBadge::find($badge_guest->id);
                                        $badge_data->point = $totalPoint;
                                        $badge_data->save();
        
                                        //desuct point from travel tourism
                                        $property = Provider::find($this->selected_badge->building->provider_type_id);
                                        $property->points_to_distribute = $this->property->points_to_distribute - $setting_point;
                                        $property->save();
                                        $this->emit('termError',['text' => 'Points have been added to this member’s account']);
                                    }
                                    else{
                                        $this->emit('termError',['text' => $this->property_name . "'s point should be greater than added points"]);
                                    }
                                }
                                else{
                                    $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                                }
                            }
                            else{
                                $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                            }
                        } 
                    }
                }
                else{
                    $this->emit('termError', ['text' => 'There is no guest to add point']);
                }

            }
        }
    }

    public function cancelBadgeRequest($guestid)
    {
        $this->guest = ApartmentGuestBadge::find($guestid);
        $this->selected_badge = Apartmentbadge::find($this->guest->badges_id);
     
        // dd($this->badge);

        $this->cancel_start_Date = date_format(date_create($this->selected_badge->start_date), 'm/d/Y');
        $this->cancel_end_Date = date_format(date_create($this->selected_badge->end_date), 'm/d/Y');
        $this->emit('cancelBadgePopup', ['badge' => $this->selected_badge]);
    }

    public function deleteGuestBadge()
    {
        
        if ($this->guest) {
            //dd($this->badge);
            Mail::to($this->guest->guest_email)->queue(new BadgeRequestCancelByProvider());
            $this->guest->delete();
            $this->emit('termError',['text' => 'Badge request is cancelled successfully']);
            // $this->emit('successPopup', ['text' => 'Badge request is cancelled successfully']);
        } else {
            $this->emit('termError',['text' => 'Badge request not found']);
            // $this->emit('successPopup', ['text' => 'Badge request not found']);
        }
    }

    public function changeDateOrder(){
        // dd($this->date_order);
        if($this->date_order == 'start_date_asc'){
            $this->order_column = 'start_date';
            $this->order_as = 'asc';
        }
        elseif($this->date_order == 'start_date_desc'){
            $this->order_column = 'start_date';
            $this->order_as = 'desc';
        }
        elseif($this->date_order == 'end_date_asc'){
            $this->order_column = 'end_date';
            $this->order_as = 'asc';
        }
        elseif($this->date_order == 'end_date_desc'){
            $this->order_column = 'end_date';
            $this->order_as = 'desc';
        }
        else{
            $this->order_column = 'id';
            $this->order_as = 'desc';
        }
    }

    public function viewconsumerProfile(){
        //dd($this->guest);
        if($this->guest  != '' && $this->guest  != null){
            if($this->guest->status == 1){
                redirect()->route('frontend.property.consumer.view.profile',$this->guest->user_id);
            }
            
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function render()
    {
        // dd($this->select_unit_id);
        $mergedData = [];
        $units = null;
        // dd($this->date_order);
        if($this->select_building != ''){
            if($this->select_building == 'all'){
                if($this->select_unit_id != ''){
                    $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                            ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                            ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                            ->where('building_units.provider_id',$this->property_id)
                                            ->where('building_units.id',$this->select_unit_id)
                                            ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                            ->get();
                }
                else{
                    $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                            ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                            ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                            ->where('building_units.provider_id',$this->property_id)
                                            ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                            ->get();
                    // $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                    //                 ->join('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                    //                 ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                    //                 ->where('building_units.provider_id',$this->property_id)
                    //                 ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                    //                 ->get();
                }
                
            }
            else{
                if($this->select_unit_id != ''){
                    $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                ->where('building_units.provider_id',$this->property_id)
                                ->where('building_units.building_id',$this->select_building)
                                ->where('building_units.id',$this->select_unit_id)
                                ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                ->get();
                }
                else{
                    $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                ->where('building_units.provider_id',$this->property_id)
                                ->where('building_units.building_id',$this->select_building)
                                ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                ->get();
                }
            }
        }
        else{
            if($this->select_unit_id != ''){
                $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                    ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                    ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                    ->where('building_units.provider_id',$this->property_id)
                                    ->where('building_units.id',$this->select_unit_id)
                                    ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                    ->get();
            }
            else{
                $units = BuildingUnit::with(['buildings','badges','badges.badge_guest','badges.badge_guest.user'])
                                    ->leftJoin('apartmentbadges', 'apartmentbadges.unit_id', '=', 'building_units.id')
                                    ->select(DB::raw('apartmentbadges.*'),DB::raw('building_units.*'))
                                    ->where('building_units.provider_id',$this->property_id)
                                    ->orderBy('apartmentbadges.'.$this->order_column,$this->order_as)
                                    ->get();

                                    
            }
        }
        // dd($units->toArray()); 
        if($units){
            $mergedData = array_merge($mergedData, $units->toArray());
        }else{
            $mergedData = $mergedData;
        }
        // $mergedData = array_merge($mergedData, $units->toArray());
        
        
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($mergedData, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($mergedData), $perPage, $currentPage);
        return view('livewire.frontend.property-manager.smart-rental-database',[
            'units' => $data,
        ]);
    }
}
