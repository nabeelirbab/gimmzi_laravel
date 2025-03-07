<?php

namespace App\Http\Livewire\Frontend\TravelTourism\HotelResort;

use Livewire\Component;
use App\Models\PropertyUnderProviderUser;
use App\Models\BuildingUnit;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderBuilding;
use App\Models\ProviderLimitSetting;

use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\TravelTourismSettings;
use App\Models\TravelTourism;

use App\Models\ShortTermGuestBadge;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\HotelBadgeSentEmail;
use App\Mail\BadgeSentEmail;
use App\Mail\BadgeRequestCancelByProvider;
use App\Models\Provider;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;


class SmartGuestDatabase extends Component
{
    use WithPagination;
    // public $user;
    
    public $propertyDetails,$user,$address, $hotel_id, $listing, $point, $property_id,$unit_name,$unit_id,$badge_count, $email_addresses = [],$guest_count, $badgeDates = [], $guests=[],  $keyArr = [], $remaining_count,$selected_badge, $shortBadgeStatus,$search_name;
    public $alldatas=[], $selectedOption = 'default', $property_name,$property, $date_order, $order_column,$order_as;
    public $checkin_date,$checkout_date, $guest, $globalSelected = [], $selectAll = false,$bulkIds = [], $all_email,$cancel_start_Date, $cancel_end_Date,$buldingList = [], $select_building, $search_text, $result, $showdiv, $select_unit_id, $recognition_point, $points, $guest_success_message, $building_name, $unitName;
    protected $listeners = ['checkEmail','datepickerEnable','adjustdatepickerEnable'];
    public $current_month, $monthyear, $year, $month, $current_year, $monthly_scheduled = [];
    public $selected_email, $badgeid, $badge, $cancel_checkin_Date, $cancel_checkout_Date,$building_id, $filterValue = 'ACTIVE', $guest_reward_value = 'guest_of_the_week', $guest_error_message;
    public $resend_checkin_date, $resend_checkout_date, $not_accept_badges = []; 

    public function mount(){
        $this->user = Auth::user();
        //dd($this->user); 
        $this->listing_guests = 10;
        $this->hotel_id = Auth::user()->travel_tourism_id;
        
        // $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$this->user->id)->get();
        // $this->property_id = $this->propertyDetails->first()->provider_id;
        // $this->address = $this->propertyDetails->first()->provider->address ;
        // $this->property_name = $this->propertyDetails->first()->provider->name ;
        // $this->point = number_format($this->propertyDetails->first()->provider->points_to_distribute);
        // $this->property = Provider::find($this->property_id);
        // $this->hotel_id
        $this->month = date('m');
        $this->monthyear = date('M Y');
        $this->current_month = date('m', strtotime("-1 month"));
        $this->current_year = date('Y');
        $this->year = date('Y');
        
        $this->unit_name = '';
        $this->badge_count = 10;
        $this->guest_count = 0;
        $this->guests =[];
        $this->remaining_count = 0;
        $this->selected_badge = '';
        $this->order_column = 'id';
        $this->order_as = 'desc';
        $this->date_order = 'all';
        $this->today = date('m-d-Y');
        // dd($this->propertyDetails->pluck('provider_id'));
         $this->buldingList = HotelBuildings::with('buildingunits')->where('hotel_id',$this->hotel_id)->get();
        // dd($this->buldingList);
    }

    public function searchResult(){
        // dd($this->select_building);
        if(!empty($this->search_text)){
            if($this->select_building == 'all'){
                $this->result = HotelUnites::where('status',1)
                                ->where('unit_name','like','%'.trim($this->search_text).'%')
                                ->where('hotel_id',$this->hotel_id)
                                ->orderBy('id','desc')
                                ->get();
                
            }
            elseif($this->select_building != ''){
                $this->result = HotelUnites::where('status',1)
                                ->where('unit_name','like','%'.trim($this->search_text).'%')
                                ->where('building_id',$this->select_building)
                                ->where('hotel_id',$this->hotel_id)
                                ->orderBy('id','desc')
                                ->get();
            }
            else{
                $this->result = HotelUnites::where('status',1)
                                ->where('unit_name','like','%'.trim($this->search_text).'%')
                                ->where('hotel_id',$this->hotel_id)
                                ->orderBy('id','desc')
                                ->get();
            }
           
            $this->showdiv = true;
        }
        else{
            $this->select_unit_id = '';
            $this->showdiv = false;
        }
    }

    public function getUnit($unitid){
        // dd($unitid);
        $this->select_unit_id = $unitid;
        $building_unit = HotelUnites::find($unitid);
        $this->search_text = $building_unit->unit_name;
        $this->showdiv = false;
        $this->result = [];
    }
    
    public function searchUnit()
    {   
        // dd($this->search_name);
        if (!empty($this->search_name)) {
            $this->unit_result = HotelUnites::where('status', 1)
                ->where('unit_name', 'like', '%' . trim($this->search_name) . '%')
                ->orderBy('id', 'desc')
                ->get();
            $this->showdiv = true;
            // dd($this->result);  
        } else {
            $this->monthly_scheduled = [];
            $badgedate = HotelBadges::with('badgesguest')->whereMonth('start_date', $this->month)
                ->whereMonth('end_date', $this->month)
                ->groupBy('start_date')
                ->groupBy('end_date')->get();
            if (count($badgedate) > 0) {
                foreach ($badgedate as $badgeValue) {
                    $this->monthly_scheduled[] = HotelBadges::with('badgesguest')->where('start_date', $badgeValue->start_date)
                        ->where('end_date', $badgeValue->end_date)
                        ->groupBy('unit_id')->get();
                }
            }
            $this->showdiv = false;
        }
    }

    public function selectunit($id)
    {
        // dd($id);
        // dd($this->month);
        $this->monthly_scheduled = []; 
        $listng = HotelUnites::find($id);
        // dd($listng);
        $this->search_name =  $listng->unit_name;
        // $this->listing_id = $id;

        $badgedate = HotelBadges::whereMonth('start_date', $this->month)
            ->where('unit_id',$id)
            ->groupBy('start_date')
            ->get();
            // dd($badgedate);
            if (count($badgedate) > 0) {
                foreach ($badgedate as $badgeValue) {
                    $this->monthly_scheduled[] = HotelBadges::where('start_date', $badgeValue->start_date)
                        ->where('end_date', $badgeValue->end_date)
                        ->where('unit_id',$badgeValue->unit_id)
                        ->groupBy('unit_id')
                        ->get();
                }

            // dd($badgedate,$this->monthly_scheduled);
        // $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
        //     ->where('listing_id', $id)
        //     ->groupBy('checkin_date')
        //     ->get();
        // // dd($badgedate);
        // if (count($badgedate) > 0) {
        //     foreach ($badgedate as $badgeValue) {
        //         $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
        //             ->where('checkout_date', $badgeValue->checkout_date)->where('listing_id', $id)
        //             ->groupBy('listing_id')->get();
        //     }
        // } 
        }else {
            $this->monthly_scheduled = [];
        }
        $this->showdiv = false;
    }

    public function addBadgeForUnit($unit_id){
        //  dd($unit_id);
        $this->unit_id = $unit_id;
        $this->unit_name = HotelUnites::find($unit_id)->unit_name;
        $this->remaining_count = 10;
        $this->start_date = '';
        $this->end_date = '';
        $this->badgeDates = [];
        $this->email_addresses = [];
        $this->selected_badge = '';
        $this->guests = [];
        $this->guest_count = 0;
        $badges = HotelBadges::where('unit_id',$this->unit_id)->get();
        if(count($badges) > 0){
            foreach($badges as $data_badge){
                $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
            }
        }
        // dd($this->badgeDates);
        $this->emit('open_add_badge',['date_range' => $this->badgeDates]);
    }

    public function getBadgeGuest($badgeid){
        //dd($badgeid);
        if($badgeid){
            // dd($badgeid);
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->selected_badge = '';
            $this->guest_count = 0;
            $this->selected_badge = HotelBadges::find($badgeid);
            if($this->selected_badge){
                $this->unit_id = $this->selected_badge->unit_id;
                $this->unit_name = HotelUnites::find($this->unit_id)->unit_name;
                //dd($this->unit_id );
                $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
                $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
                $badges = HotelBadges::where('unit_id',$this->unit_id)->get();
                if(count($badges) > 0){
                    foreach($badges as $data_badge){
                        $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
                    }
                }
               
                $this->guests = HotelGuestBadges::where('badges_id',$badgeid)->get();
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

    public function closebadgePopup()
    {

        $this->emit('closeBadgePopup');
    }

    public function changeMonth($type)
    {

        $this->monthly_scheduled = [];
        // dd($type);
        if ($type == 'max') {

            if ($this->month != '') {
                $dt = strtotime($this->monthyear);
                $this->monthyear = date("M Y", strtotime("+1 month", $dt));
                // dd($this->current_month );
                $this->month  = date("m", strtotime("+1 month", $dt));
                $this->year  = date("Y", strtotime("+1 month", $dt));
                $badgedate = HotelBadges::whereMonth('start_date', $this->month)
                    ->whereYear('start_date',$this->year)
                    ->groupBy('start_date')
                    ->groupBy('end_date')->get();
                //dd($badgedate);
                if (count($badgedate) > 0) {
                    foreach ($badgedate as $badgeValue) {
                        $this->monthly_scheduled[] = HotelBadges::where('start_date', $badgeValue->start_date)
                            ->where('end_date', $badgeValue->end_date)
                            ->groupBy('building_id')->get();
                    }
                } else {
                    $this->monthly_scheduled = [];
                }
            }
        } elseif ($type == 'min') {

            if ($this->month != '') {
                $dt = strtotime($this->monthyear);
                $this->monthyear = date("M Y", strtotime("-1 month", $dt));
                //  dd($this->current_month );
                $this->month  = date("m", strtotime("-1 month", $dt));
                $this->year  = date("Y", strtotime("-1 month", $dt));
                // dd($this->monthyear,$this->month, $this->year );
                $badgedate = HotelBadges::whereMonth('start_date', $this->month)
                    ->whereYear('start_date',$this->year)
                    ->groupBy('start_date')
                    ->groupBy('end_date')->get();
                // dd($badgedate);
                if (count($badgedate) > 0) {
                    foreach ($badgedate as $badgeValue) {
                        $this->monthly_scheduled[] = HotelBadges::where('start_date', $badgeValue->start_date)
                            ->where('end_date', $badgeValue->end_date)
                            ->groupBy('building_id')->get();
                    }
                } else {
                    $this->monthly_scheduled = [];
                }
            }
        }
    }

    public function HotelBadgeModal($unitid){
        // dd('hello');
        $this->checkin_date = [];
        $this->checkout_date = [];
        $this->email_addresses = [];
        $this->select_unitId = $unitid;
        $this->dates = [];
        $this->badgeDates = [];
        $this->unites = HotelUnites::find($unitid);
        // $this->listing_guests = 10;
        $this->unit_badges_guests = 10;
        $this->start_date = '';
        $this->end_date = '';
        $badges = HotelBadges::where('unit_id', $unitid)->groupBy('start_date')->get();
        // $this->selected_badges_id
        if (count($badges) > 0) {
            foreach ($badges as $badgedata) {
                $this->badgeDates[] = array('startDate' => $badgedata->start_date, 'endDate' => $badgedata->end_date);
            }
        }
        if (count($this->badgeDates) > 0) {
            foreach ($this->badgeDates as $data) {
                if (in_array($data['startDate'], array_column($this->badgeDates, 'endDate'))) {
                    $this->dates[] = $data['startDate'];
                }
            }
        }
        //dd($this->dates);
        $this->guests = [];
        $this->emit('openListingBadge', ['unites' => $this->unites, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
    }
    public function ListingBadgeModal($badgeid){
        //dd($badgeid);
        
        
    }

    public function selectBadge($badgeid)
    {
        //dd($badgeid);
        $this->badgeid = $badgeid;
    }

    public function NewselectBadge($badgeid)
    {
        // dd($badgeid);
        $this->email_addresses = [];
        $this->badgeid = $badgeid;
        if ($this->badgeid != null) {
            $this->badge =  HotelBadges::with('unites')->find($this->badgeid);
            //  dd($this->badge->unites->unit_name);
             $this->unitName = $this->badge->unites->unit_name;
            $this->badge_checkin_date = $this->badge->start_date;
            $this->badge_checkout_date = $this->badge->end_date;
            
            //  dd($this->badge_checkin_date,$this->badge_checkout_date, $this->badge->building_id);
            $this->checkin_date = date_format(date_create($this->badge->start_date), 'm/d/Y');
            $this->checkout_date = date_format(date_create($this->badge->end_date), 'm/d/Y');

            $this->guests = HotelGuestBadges::where('badges_id',$this->badgeid)
                                        ->where('guest_email','!=',null)
                                        // ->whereIn('status', [0, 1])
                                        ->get();

            $this->guest_count = count($this->guests);
                
            $this->listing = HotelBuildings::find($this->badge->building_id);
            $this->building_name =  $this->listing->building_name;
            // dd($this->building_name);
            if ($this->guest_count < $this->listing_guests) {
                $this->remaining_count = ($this->listing_guests - $this->guest_count);
            } else {
                $this->remaining_count = 0;
            }
            // dd($this->guests); 
            $this->emit('selectedScheduledBadgesPopup');
        } else {
            $this->emit('successPopup', ['text' => 'please select a badge']);
        }
    }

    public function show_selected_badge()
    {
        // dd($this->email_addresses);
        $this->email_addresses = [];
        if ($this->badgeid != null) {
            $this->badge =  HotelBadges::with('unites')->find($this->badgeid);
            //  dd($this->badge->unites->unit_name);
             $this->unitName = $this->badge->unites->unit_name;
            $this->badge_checkin_date = $this->badge->start_date;
            $this->badge_checkout_date = $this->badge->end_date;
            
            //  dd($this->badge_checkin_date,$this->badge_checkout_date, $this->badge->building_id);
            $this->checkin_date = date_format(date_create($this->badge->start_date), 'm/d/Y');
            $this->checkout_date = date_format(date_create($this->badge->end_date), 'm/d/Y');

            $this->guests = HotelGuestBadges::where('badges_id',$this->badgeid)
                                        ->where('guest_email','!=',null)
                                        // ->whereIn('status', [0, 1])
                                        ->get();

            $this->guest_count = count($this->guests);
                
            $this->listing = HotelBuildings::find($this->badge->building_id);
            $this->building_name =  $this->listing->building_name;
            // dd($this->building_name);
            if ($this->guest_count < $this->listing_guests) {
                $this->remaining_count = ($this->listing_guests - $this->guest_count);
            } else {
                $this->remaining_count = 0;
            }
            // dd($this->guests); 
            $this->emit('selectedScheduledBadgesPopup');
        } else {
            $this->emit('successPopup', ['text' => 'please select a badge']);
        }
    }

    public function closeSelectedBadge()
    {
        $this->emit('closeSelectedScheduledBadges');
    }

    public function sendSelectedBadge()
    {   
        $this->building_id = $this->badge->building_id;
        
        //    dd($this->checkin_date);
        $i = 1;
        if (count($this->email_addresses) > 0) {
            
            foreach ($this->email_addresses as $key => $emails) {
                if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                    $user = User::where('email', $emails)->role('CONSUMER')->first();
                    // dd($user->role_name);
                    if ($user) {
                        // dd('sdfdsf');

                        $today = Carbon::now()->format('Y-m-d');

                        $exist_another_badge = HotelGuestBadges::where('status',1)
                        ->where('badges_id','!=',$this->badge->id)
                        ->where('guest_email',$emails)
                        ->first();
                        if($exist_another_badge){
                            if($today < $exist_another_badge->guestbadges->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                                break;
                            }
                        }

                        $exist_badge = HotelGuestBadges::where('badges_id',$this->badge->id)
                        ->where('guest_email',$emails)
                        ->first();
                        if($exist_badge){
                            if($today < $exist_badge->guestbadges->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already exist for this badge']);
                                break;
                            }
                        }
                        

                        $find_to_apartment = ApartmentGuestBadge::where('guest_email',$emails)
                        ->where('status',1)
                        ->first();
                        if($find_to_apartment){
                            if($today < $find_to_apartment->badge->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                                break;
                            }
                        }
                        
                        $find_to_shortTerm = ShortTermGuestBadge::where('guest_email',$emails)
                        ->where('checkout_date','>',$today)
                        ->where('badge_status',1)
                        ->first();
                        if($find_to_shortTerm){
                            $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                            break;
                        }

                        $guest_badge = new HotelGuestBadges;
                            $guest_badge->badges_id = $this->badge->id;
                            $guest_badge->guest_email = $emails;
                            $guest_badge->user_id = $user->id;
                            $guest_badge->status = 0;
                            $guest_badge->save();

                        //     $exist_badge = HotelGuestBadges::where('badges_id',$this->badge->id)
                        //     ->where('guest_email',$emails)
                        //     ->first();

                        // if ($exist_badge) {
                        //     $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge']);
                        //     break; 
                        // } else {
                        //     $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist in another badge']);
                        //     break; 
                        // }
                    } else {


                        $today = Carbon::now()->format('Y-m-d');

                        $exist_another_badge = HotelGuestBadges::where('status',1)
                        ->where('badges_id','!=',$this->badge->id)
                        ->where('guest_email',$emails)
                        ->first();
                        if($exist_another_badge){
                            if($today < $exist_another_badge->guestbadges->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                                break;
                            }
                        }


                        $exist_badge = HotelGuestBadges::where('badges_id',$this->badge->id)
                        ->where('guest_email',$emails)
                        ->first();
                        if($exist_badge){
                            if($today < $exist_badge->guestbadges->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already exist for this badge']);
                                break;
                            }
                        }
                        

                        $find_to_apartment = ApartmentGuestBadge::where('guest_email',$emails)
                        ->where('status',1)
                        ->first();
                        if($find_to_apartment){
                            if($today < $find_to_apartment->badge->end_date){
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                                break;
                            }
                        }
                        
                        $find_to_shortTerm = ShortTermGuestBadge::where('guest_email',$emails)
                        ->where('checkout_date','>',$today)
                        ->where('badge_status',1)
                        ->first();
                        if($find_to_shortTerm){
                            $this->emit('selectedSuccessPopup', ['text' => $emails . ' already in another badge']);
                            break;
                        }

                        $get_role_name = User::where('email', $emails)->first();
                        if($get_role_name){
                            if($get_role_name->role_name){
                                $role_name = $get_role_name->role_name;
                                if($role_name != "CONSUMER"){
                                    $this->emit('selectedSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);
                                    break;
                                }
                            }
                        }


                       $guest_badge = new HotelGuestBadges;
                            $guest_badge->badges_id = $this->badge->id;
                            $guest_badge->guest_email = $emails;
                            $guest_badge->status = 0;
                            $guest_badge->save();

                        // $exist_badge = HotelGuestBadges::where('badges_id',$this->badge->id)
                        //     ->where('guest_email',$emails)
                        //     ->first();
                        // if ($exist_badge) {

                        //     $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge']);
                        //     break;
                        // } else {

                        //     $guest_badge = new HotelGuestBadges;
                        //     $guest_badge->badges_id = $this->badge->id;
                        //     $guest_badge->guest_email = $emails;
                        //     $guest_badge->status = 0;
                        //     $guest_badge->save();
                        // }
                    }

                    $limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                    // dd($limit);
                    if ($limit) {
                        $point = $limit->badge_bonus_point;
                    } else {
                        $point = 0;
                    }
                    $arrival_date = date_format(date_create($this->checkin_date), 'm/d/Y');
                    //dd($arrival_date);
                    $hotel_name = TravelTourism::select('name')->where('id',$this->hotel_id)->first();
                    // dd($hotel_name->name);
                    $details = array(
                        'company_name' => $hotel_name->name,
                        'point' => $point,
                        'arrival_date' => $arrival_date,
                        'request_id' => $guest_badge->id
                    );
                    //dd($details);
                    Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                    $i++;
                }
                array_push($this->keyArr, $key);
            }
            // $this->guests = HotelBadges::with('badgesguest')
            //     ->join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
            //     ->where('hotel_badges.building_id', $this->building_id)
            //     ->where('hotel_guest_badges.guest_email', '!=', null)
            //     ->where('hotel_badges.start_date', $this->badge->start_date)
            //     ->where('hotel_badges.end_date', $this->badge->end_date)->get();

            $this->guests = HotelGuestBadges::where('badges_id',$this->badge->id)
                ->where('guest_email','!=', null)
                ->get();
            $this->guest_count = count($this->guests);

            

            $this->remaining_count = ($this->listing_guests - $this->guest_count);
            $this->keyArr = [];
            if ($i > 1) {
                $this->email_addresses = [];
                $this->emit('NewbadgeSent', ['listing' => $this->listing, 'membercount' => $i, 'guest_badge_count' => $this->guest_count, 'text' => 'Invite Sent Successfully', 'key_arr' => $this->keyArr]);
            }
        } else {
            $this->emit('selectedSuccessPopup', ['text' => 'Give valid email address', 'building' => $this->listing->building_name]);
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
                            $badge = HotelBadges::where('start_date',$checkindate)->where('end_date',$checkoutdate)->where('unit_id',$this->unit_id)->first();
    
                            if($badge){
                                
                                $all_email = $this->email_addresses;
                                $valid_email = array();
                                $used_email = array();
    
                                foreach($all_email as $email){
                                    $email_check = HotelGuestBadges::where('guest_email',$email)->orderBy('id','DESC')->first();
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
                                    $expire_date = HotelBadges::where('id', $used_mail['badge_id'])->whereDate('end_date', '>', date('Y-m-d'))->first();
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
                                                    $guest_badge = HotelGuestBadges::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new HotelGuestBadges;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->guest_first_name = $user->first_name;
                                                        $guest_badge->guest_last_name = $user->last_name;
                                                        $guest_badge->user_id = $user->id;
                                                        $guest_badge->save();
                                                        $building = HotelBuildings::find($badge->building_id);
                                                        $limit_setting = TravelTourismSettings::where('travel_tourism_id',$building->hotel_id)->first();
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
                                                        $this->guests = HotelGuestBadges::where('badges_id',$badge->id)->get();
                                                        if(count($this->guests) > 0){
                                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                                            $this->guest_count = count($this->guests);
                                                        }
                                                        else{
                                                            $this->remaining_count = 10;
                                                        }
                                                        Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                                                    }
                                                }
                                                elseif($other_user){
                                                    array_push($others,$emails);
                                                }
                                                else{
                                                    
                                                        $guest_badge = new HotelGuestBadges;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->save();
                                                        $building = HotelBuildings::find($badge->building_id);
                                                        $limit_setting = TravelTourismSettings::where('travel_tourism_id',$building->hotel_id)->first();
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
                                                        $this->guests = HotelGuestBadges::where('badges_id',$badge->id)->get();
                                                        if(count($this->guests) > 0){
                                                            $this->remaining_count = $this->badge_count - count($this->guests);
                                                            $this->guest_count = count($this->guests);
                                                        }
                                                        else{
                                                            $this->remaining_count = 10;
                                                        }
                                                        Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                                                   
                                                }
                                            }
                
                                        }
                                        $this->email_addresses = '';
                                        $this->guests = HotelGuestBadges::where('badges_id',$badge->id)->get();
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
                                        $email_check = HotelGuestBadges::where('guest_email',$email)->orderBy('id','DESC')->first();
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
                                        $expire_date = HotelBadges::where('id', $used_mail['badge_id'])->whereDate('end_date', '>', date('Y-m-d'))->first();
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
                                        $building_id = HotelUnites::find($this->unit_id)->building_id;
                                        $badge = new HotelBadges;
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
                                                    $guest_badge = HotelGuestBadges::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new HotelGuestBadges;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->guest_first_name = $user->first_name;
                                                        $guest_badge->guest_last_name = $user->last_name;
                                                        $guest_badge->user_id = $user->id;
                                                        $guest_badge->save();
                                                        $building = HotelBuildings::find($building_id);
                                                        $limit_setting = TravelTourismSettings::where('travel_tourism_id',$building->hotel_id)->first();
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
                                                        Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                                                    }
                                                }
                                                else{
                                                    $guest_badge = HotelGuestBadges::where('badges_id',$badge->id)->where('guest_email',$emails)->first();
                                                    if(!$guest_badge){
                                                        $guest_badge = new HotelGuestBadges;
                                                        $guest_badge->badges_id = $badge->id;
                                                        $guest_badge->status = false;
                                                        $guest_badge->guest_email = $emails;
                                                        $guest_badge->save();
                                                        $building = HotelBuildings::find($building_id);
                                                        $limit_setting = TravelTourismSettings::where('travel_tourism_id',$building->hotel_id)->first();
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
                                                        Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                                                    } 
                                                }
                                            }
                
                                        }
                                        
                                        $this->email_addresses = '';
                                        $this->guests = HotelGuestBadges::where('badges_id',$badge->id)->get();
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
                        $badge = HotelBadges::where('start_date',$checkindate)->where('end_date',$checkoutdate)->where('unit_id',$this->unit_id)->first();
                        if($badge){
                            $this->emit('badgeError', ['text' => 'Badge is Updated']);
                        }
                        else{
                            $building_id = HotelUnites::find($this->unit_id)->building_id;
                            $badge = new HotelBadges;
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

    public function newSendBadge(){
    //    dd($this->checkin_date,$this->checkout_date);
        
        
        $this->listing = HotelUnites::where('id',$this->unites->id)->select('building_id')->first();
        $this->building_id = $this->listing->building_id;
        // dd($this->building_id);

        $badges = HotelBadges::where('unit_id', $this->unites->id)->groupBy('start_date')->get();
        // dd($badges);
        if (count($badges)) {
            foreach ($badges as $badgedata) {
                $this->badgeDates[] = array('startDate' => $badgedata->start_date, 'endDate' => $badgedata->end_date);
            }
        }

        if (count($this->badgeDates) > 0) {
            foreach ($this->badgeDates as $data) {
                if (in_array($data['startDate'], array_column($this->badgeDates, 'endDate'))) {
                    $this->dates[] = $data['startDate'];
                }
            }
        }

        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
                $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
                
                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toDateTimeString();
                $datetime_utc = new DateTime($formattedTime, new DateTimeZone('UTC'));
                $datetime_utc->setTimezone(new DateTimeZone('America/New_York'));
                $timestamp_in_est = $datetime_utc->format('Y-m-d H:i:s');
                $est_time = $datetime_utc->format('H:i:s');
                

                //  dd($this->email_addresses);

                $newchekindate = Carbon::parse($checkindate)->addDays(1)->format('Y-m-d');
                $getDates = HotelBadges::where(function($query) use ($newchekindate, $checkoutdate) {
                    $query->whereBetween('end_date', [$newchekindate, $checkoutdate]);
                })->where('unit_id',$this->unites->id)
                ->get()->toArray();
               
                if (!empty($getDates)) {
                    $this->emit('selectedSuccessPopup', ['text' => 'Badge already exist between dates']);
                    return;
                }

                $i = 1;

                if (count($this->email_addresses) > 0) {

                    foreach ($this->email_addresses as $key => $emails) {
                        // dd($emails);
                        if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                            $user = User::where('email', $emails)->role('CONSUMER')->first();
                            // dd($user);
                            if ($user) {
                                
                                $exist_badge = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                                    ->where('hotel_badges.unit_id', $this->unites->id)
                                    ->where('hotel_badges.start_date', $checkindate)
                                    ->where('hotel_badges.end_date', $checkoutdate)
                                    ->where('hotel_guest_badges.guest_email', $emails)
                                    ->first();
                                    
                                if ($exist_badge) {       
                                    $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge']);
                                    break;
                                } 

                                $another_badge = HotelGuestBadges::where('guest_email',$emails)
                                                ->where('status',1)->first();
                                if($another_badge){
                                    // dd('sdcsd');
                                    $get_badge = HotelBadges::where('id',$another_badge->badges_id)->first();
                                    // dd($get_badge);
                                    if($get_badge->end_date > $checkindate){
                                        // dd('dssd');
                                        $this->emit('selectedSuccessPopup', ['text' => ' Member already active on another badge']);
                                    break;
                                    }
                                }
                                // dd($another_badge);
                                $find_in_short_term = ShortTermGuestBadge::where('guest_email',$emails)
                                                    ->where('badge_status',1)
                                                    ->where('checkout_date','>',$checkindate)
                                                    ->first();
                                if($find_in_short_term){
                                    $this->emit('selectedSuccessPopup', ['text' => ' Member already active on another badge']);
                                    break;
                                }

                                $find_in_apartment = ApartmentGuestBadge::where('guest_email',$emails)->where('status',1)->first();
                                if($find_in_apartment){
                                    $apartment_badges = Apartmentbadge::where('id',$find_in_apartment->badges_id)->first();
                                    if($apartment_badges->end_date > $checkindate){
                                        $this->emit('selectedSuccessPopup', ['text' =>'Member already active on another badge']);
                                        break;
                                    }
                                }

                                    $insert_badge = HotelBadges::insertGetId([
                                        'building_id'=>$this->building_id,
                                        'unit_id'=>$this->unites->id,
                                        'start_date' => $checkindate,
                                        'end_date' => $checkoutdate,
                                        'checkin_time' => $est_time,
                                        'status' => 1
                                    ]);
                                    // dd($user->id);
                                    $guest_badge = new HotelGuestBadges;
                                    $guest_badge->badges_id = $insert_badge ;
                                    $guest_badge->user_id = $user->id;
                                    $guest_badge->status = 0;
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                
                            } else {

                                $get_role_name = User::where('email', $emails)->first();
                                if($get_role_name){
                                    if($get_role_name->role_name){
                                        $role_name = $get_role_name->role_name;
                                        if($role_name != "CONSUMER"){
                                            $this->emit('selectedSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);
                                            break;
                                        }
                                    }
                                }
                                
                                $exist_badge = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                                    ->where('hotel_badges.unit_id', $this->unites->id)
                                    ->where('hotel_badges.start_date', $checkindate)
                                    ->where('hotel_badges.end_date', $checkoutdate)
                                    ->where('hotel_guest_badges.guest_email', $emails)
                                    ->first();
                                if ($exist_badge) {
                                    $this->emit('selectedSuccessPopup', ['text' => 'Member already active on another badge']);
                                    break;
                                } 

                                $another_badge = HotelGuestBadges::where('guest_email',$emails)
                                                ->where('status',1)->first();
                                if($another_badge){
                                    $get_badge = HotelBadges::where('id',$another_badge->badges_id)->first();
                                    if($get_badge->end_date > $checkindate){
                                        $this->emit('selectedSuccessPopup', ['text' =>'Member already active on another badge']);
                                    break;
                                    }
                                }

                                $find_in_short_term = ShortTermGuestBadge::where('guest_email',$emails)
                                                    ->where('badge_status',1)
                                                    ->where('checkout_date','>',$checkindate)
                                                    ->first();
                                if($find_in_short_term){
                                    $this->emit('selectedSuccessPopup', ['text' => 'Member already active on another badge']);
                                    break;
                                }

                                $find_in_apartment = ApartmentGuestBadge::where('guest_email',$emails)->where('status',1)->first();
                                if($find_in_apartment){
                                    $apartment_badges = Apartmentbadge::where('id',$find_in_apartment->badges_id)->first();
                                    if($apartment_badges->end_date > $checkindate){
                                        $this->emit('selectedSuccessPopup', ['text' => 'Member already active on another badge']);
                                        break;
                                    }
                                }
                                
                                
                                $insert_badge = HotelBadges::insertGetId([
                                    'building_id'=>$this->building_id,
                                    'unit_id'=>$this->unites->id,
                                    'start_date' => $checkindate,
                                    'end_date' => $checkoutdate,
                                    'checkin_time' => $est_time,
                                    'status' => 1
                                ]);

                                $guest_badge = new HotelGuestBadges;
                                $guest_badge->badges_id = $insert_badge ;
                                $guest_badge->status = 0;
                                $guest_badge->guest_email = $emails;
                                $guest_badge->save();
                                
                            }

                            $limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                            if ($limit) {
                                $point = $limit->badge_bonus_point;
                            } else {
                                $point = 0;
                            }
                            $arrival_date = date_format(date_create($this->checkin_date), 'm/d/Y');
                            //dd($arrival_date);
                            $hotel_name = TravelTourism::select('name')->where('id',$this->hotel_id)->first();

                            $details = array(
                                'company_name' => $hotel_name->name,
                                'point' => $point,
                                'arrival_date' => $arrival_date,
                                'request_id' => $guest_badge->id
                            );
                            // dd($details);
                            Mail::to($emails)->queue(new HotelBadgeSentEmail($details));
                            $i++;
                        }
                        // dd($emails);
                        array_push($this->keyArr, $key);
                    }
                    $this->guests = HotelBadges::with('badgesguest')
                        ->join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                        ->where('hotel_badges.building_id', $this->building_id)
                        ->where('hotel_guest_badges.guest_email', '!=', null)
                        ->where('hotel_badges.start_date', $checkindate)
                        ->where('hotel_badges.end_date', $checkoutdate)->get();
                    $guestcount = count($this->guests);
                    if ($i > 1) {
                        //dd($this->keyArr);
                        $this->emit('NewbadgeSent', ['text' => 'Invite Sent Successfully', 'listing' => $this->listing, 'membercount' => $i, 'guest_badge_count' => $guestcount, 'key_arr' => $this->keyArr]);
                    }
                } else {
                    // $guest_badge = new HotelBadges
                    // $guest_badge->building_id = $this->building_id;
                    // $guest_badge->unit_id = $this->unites->id;
                    // $guest_badge->start_date = $tcheckindate;
                    // $guest_badge->end_date = $checkoutdate;
                    // $guest_badge->status =1;

                    $insert_badge = HotelBadges::insertGetId([
                        'building_id'=>$this->building_id,
                        'unit_id'=>$this->unites->id,
                        'start_date' => $checkindate,
                        'end_date' => $checkoutdate,
                        'checkin_time' => $est_time,
                        'status' => 1
                    ]);

                    $this->emit('NewbadgeSent', ['text' => 'Badge Create Successfully', 'listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                }
            } else {
                // $this->emit('NewmemberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                $this->emit('selectedSuccessPopup', ['text' => 'Give a check-out date']);
            }
        } else {
            $this->emit('selectedSuccessPopup', ['text' => 'Give a check-in date']);

            // $this->emit('NewmemberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
        }
    }

    public function scheduledBadge()
    {
        $this->month = date('m');
        $this->year = date('Y');
        $this->monthyear = date('M Y');
        $this->current_month = date('m', strtotime("-1 month"));
        $this->current_year = date('Y');
        $this->monthly_scheduled = [];
        // dd($this->year);
        $badgedate = HotelBadges::whereMonth('start_date', $this->month)
            ->whereYear('start_date',$this->year)
            ->groupBy('start_date')
            ->groupBy('end_date')->get();
             //dd($badgedate);
        if (count($badgedate) > 0) {
            foreach ($badgedate as $badgeValue) {
                $this->monthly_scheduled[] = HotelBadges::where('start_date', $badgeValue->start_date)
                    ->where('end_date', $badgeValue->end_date)
                    ->groupBy('unit_id')->get();
            }
        }
        // dd($this->monthly_scheduled);
        $this->emit('scheduledBadgesPopup');
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

    public function badgesRefreshForm(){
        // dd('sdfsd------');
        // dd($this->select_unitId);

        // $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
        // $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
        // $this->guests = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
        //     ->where('hotel_guest_badges.guest_email', '!=', null)
        //     ->where('hotel_guest_badges.badges_id', $this->badge->id)
        //     ->where('hotel_badges.start_date', $checkindate)
        //     ->where('hotel_badges.end_date', $checkoutdate)
        //     ->get();
        // $this->guests = HotelGuestBadges::where('guest_email', '!=', null)->get();
        // $checkindate = '';
        // $checkoutdate = '';
        $this->guests = [];        
        // if (count($this->guests) > 0) {
        //     if (count($this->guests) == $this->listing_guests) {
        //         $this->remaining_guest = 0;
        //     } elseif (count($this->guests) < $this->listing_guests) {
        //         $this->remaining_guest = $this->listing_guests - count($this->guests);
        //     } else {
        //         $this->remaining_guest = $this->listing_guests;
        //     }
        // } else {
            
        // }

        $this->remaining_guest = 0;
        $this->email_addresses = [];
        // dd($this->email_addresses);

        $this->emit('NewresetBadgeForm', ['unites' => $this->listing, 'badge_guest_count' => count($this->guests)]);
        

    }

    public function refreshForm(){
        // dd('sdfsdfsdfsd');
        // if($this->selected_badge != ''){
        //     $this->unit_id = $this->selected_badge->unit_id;
        //     $this->unit_name = HotelUnites::find($this->unit_id)->unit_name;
        //     $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
        //     $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
        //     $this->badgeDates = array('startDate' => $this->selected_badge->start_date, 'endDate' => $this->selected_badge->end_date);
        //     $this->guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
        //     if(count($this->guests) > 0){
        //         $this->remaining_count = $this->badge_count - count($this->guests);
        //         $this->guest_count = count($this->guests);
        //     }
        //     else{
        //         $this->remaining_count = 10;
        //     }
        // }
        // dd($this->badge) = badge;
        //  dd($this->listing_guests);
        $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
        $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
        $this->guests = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
            ->where('hotel_guest_badges.guest_email', '!=', null)
            ->where('hotel_guest_badges.badges_id', $this->badge->id)
            ->where('hotel_badges.start_date', $checkindate)
            ->where('hotel_badges.end_date', $checkoutdate)
            ->get();
        if (count($this->guests) > 0) {
            if (count($this->guests) == $this->listing_guests) {
                $this->remaining_guest = 0;
            } elseif (count($this->guests) < $this->listing_guests) {
                $this->remaining_guest = $this->listing_guests - count($this->guests);
            } else {
                $this->remaining_guest = $this->listing_guests;
            }
        } else {
            $this->remaining_guest = 0;
        }

        $this->email_addresses = [];

        $this->emit('resetBadgeForm', ['unites' => $this->listing, 'badge_guest_count' => count($this->guests)]);
    }

    public function UnitclearBadgeDates(){
        // dd('svsdvdsv');
    //    dd($this->checkin_date,$this->checkout_date);
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                // dd($this->checkin_date);
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                // dd($checkindate); 
                $this->emit('clearUnitDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('selectedSuccessPopup', ['text' => 'Please select Check Out date.']);
            }
        } else {
            $this->emit('selectedSuccessPopup', ['text' => 'Please select Check In date.']);
        }
    }

    public function clearRecendBadgeDates(){
        // dd($this->badge);
        // dd($this->selected_badge->start_date);
        if($this->selected_badge){
            if ($this->selected_badge->start_date != '') {
                if ($this->selected_badge->end_date != '') {
                    // dd($this->checkin_date);
                    $checkindate = date_format(date_create($this->selected_badge->start_date), 'm/d/Y');
                    $checkoutdate = date_format(date_create($this->selected_badge->end_date), 'm/d/Y');
                    // dd($checkindate); , clearResendUnitDate
                    $this->emit('clearResendUnitDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
                } else {
                    $this->emit('memberSuccessPopup', ['type' => '']);
                }
            } else {
                $this->emit('memberSuccessPopup', ['type' => '']);
            }
        }else{
            if ($this->badge->start_date != '') {
                if ($this->badge->end_date != '') {
                    // dd($this->checkin_date);
                    $checkindate = date_format(date_create($this->badge->start_date), 'm/d/Y');
                    $checkoutdate = date_format(date_create($this->badge->end_date), 'm/d/Y');
                    // dd($checkindate); 
                    $this->emit('clearResendUnitDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
                } else {
                    $this->emit('memberSuccessPopup', ['type' => '']);
                }
            } else {
                $this->emit('memberSuccessPopup', ['type' => '']);
            }
        }
        
    }

    public function clearBadgeDates()
    {
        //  dd($this->checkin_date,$this->checkout_date);
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                //dd($checkoutdate);
                $this->emit('clearBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                // $this->emit('NewmemberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing]);
            }
        } else {
            // $this->emit('NewmemberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing]);
        }
    }

    public function removeBadgeDates()
    {
        // dd($this->badge);
        $this->monthly_scheduled = [];
        if($this->badge != ''){

            if($this->badge){
                $this->guests = HotelGuestBadges::where('badges_id',$this->badge->id)->get();
                if(count($this->guests) > 0){
                    foreach($this->guests as $guest){
                        HotelGuestBadges::where('id',$guest->id)->delete();
                    }
                    $this->badge->delete();
                }
                else{
                    
                    $this->badge->delete();
                }
            }

            $badgedate = HotelBadges::whereMonth('start_date', $this->month)
            ->whereYear('start_date',$this->year)
            ->groupBy('start_date')
            ->groupBy('end_date')->get();
             //dd($badgedate);
            if (count($badgedate) > 0) {
                foreach ($badgedate as $badgeValue) {
                    $this->monthly_scheduled[] = HotelBadges::where('start_date', $badgeValue->start_date)
                        ->where('end_date', $badgeValue->end_date)
                        ->groupBy('unit_id')->get();
                }
            }

            // dd($this->monthly_scheduled);
            // $this->unit_name = BuildingUnit::find($this->unit_id)->unit;
            // // dd($this->unit_name);
            // $this->checkin_date = '';
            // $this->checkout_date = '';
            // $this->badgeDates = [];
            // $this->email_addresses = [];
            // $this->guests = [];
            // $this->guest_count = 0;
            // $this->selected_badge = '';
            $this->emit('NewremoveBadgeDate', ['text' => 'Badge request is cancelled successfully']);
        }

    }

    public function removeUniteDates()
    {
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->email_addresses = [];
            $this->guests = [];
            $this->guest_count = 0;
            $this->emit('removeUniteDate', ['text' => 'Badge request is cancelled successfully']);

    }

    public function removeResendUnitDates(){
        // dd('777');
        if($this->selected_badge != ''){

            if($this->selected_badge){
                $this->guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
                if(count($this->guests) > 0){
                    foreach($this->guests as $guest){
                        HotelGuestBadges::where('id',$guest->id)->delete();
                    }
                    $this->selected_badge->delete();
                }
                else{
                    
                    $this->selected_badge->delete();
                }
            }
            // dd($this->unit_id);
            $this->unit_name = BuildingUnit::find($this->unit_id);
            // dd($this->unit_name);
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->guests = [];
            $this->guest_count = 0;
            $this->selected_badge = '';
            $this->emit('removeResendUniteDate', ['text' => 'Badge request is cancelled successfully']);
        }else{
            if($this->badge){
                $this->guests = HotelGuestBadges::where('badges_id',$this->badge->id)->get();
                if(count($this->guests) > 0){
                    foreach($this->guests as $guest){
                        HotelGuestBadges::where('id',$guest->id)->delete();
                    }
                    $this->badge->delete();
                }
                else{
                    
                    $this->badge->delete();
                }
            }
            // dd($this->unit_id);
            $this->unit_name = BuildingUnit::find($this->unit_id);
            // dd($this->unit_name);
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->badgeDates = [];
            $this->email_addresses = [];
            $this->guests = [];
            $this->guest_count = 0;
            $this->selected_badge = '';
            $this->emit('removeResendUniteDate', ['text' => 'Badge request is cancelled successfully']);
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

    public function hotelcloseSuccessModal(){
        // dd('1253');
        $this->emit('hotelcloseSuccessPopup');
    }

    public function ResendhotelcloseSuccessModal(){
        dd('sdds');
        $this->emit('ResendhotelcloseSuccessPopup');
    }


    public function  adjustLease    () {
        $this->emit('openAdjustLease');
    }

    public function adjustdatepickerEnable(){
        $this->emit('openAdjustLease');
    }

    public function SaveLease(){
         //dd($this->selected_badge);
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
                        $badge = HotelBadges::find($this->selected_badge->id);
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
            // $property_limit = ProviderLimitSetting::where('property_id', $this->selected_badge->building->provider_type_id)->first();
            $property_limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
            if($property_limit){
                if ($property_limit->term_limit != null){
                    $start_Date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+'.$property_limit->term_limit));
                    $badge = HotelBadges::find($this->selected_badge->id);
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
            $this->selected_badge = HotelBadges::find($id);
            $this->guest = '';
        }
        elseif($type == 'guest'){
            $this->guest = HotelGuestBadges::find($id);
            $this->selected_badge = HotelBadges::find($this->guest->badges_id);

        }
        elseif($type == 'unit'){
            $this->guest = '';
            $this->selected_badge = '';
        }
    }
    public function closeRecentPopup()
    {
        $this->selectAll = false;
        $this->bulkIds = [];
        $this->emit('guestbadgeClose');
    }

    public function guestRecognition()
    {
        if($this->guest != ''){
            if($this->guest->status != 0){
                if(TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first()){
                    $this->points = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first()->guest_of_week_point;
                    $this->emit('guestRecognition');
                }
            }
            else{
                $this->emit('guestError');
            }
        }
        
        
        // dd($this->points);
       
        
    }

    public function guestReward()
    {
        // dd($this->guest_reward_value,$this->guest->user_id);
        if($this->guest->user_id == null){
            $this->guest_error_message = 'This user has not accepted the badge requestt.';
            $this->emit('guestRecognitionError');
            return;
        }

        $userId = $this->guest->user_id;
        $user_details = User::where('id',$userId)->first();
        $selectedReward = $this->guest_reward_value;
        $conUnit = HotelGuestBadges::with('user','guestbadges.unites.unitbuildings','guestbadges.unites')->where('user_id',$userId)->orderBy('id','DESC')->first();
        $hotel_id = $conUnit->guestbadges->unites->hotel_id;
        $badges = HotelUnites::select('id')->where('hotel_id',$hotel_id)->get();
        foreach($badges as $badge){
            $unit_ids[] = $badge->id;
        }
        $get_badge_id = HotelBadges::whereIn('unit_id',$unit_ids)->select('id')->get();
        foreach($get_badge_id as $badge){
            $badge_ids[] = $badge->id;
        }
        // dd($selectedReward);
        $get_guest_points = TravelTourismSettings::where('id',$hotel_id)->select('guest_of_week_point')->first();
        $points = $get_guest_points->guest_of_week_point;
        $guest_recognization = TravelTourism::select('show_guest_recognition')->where('id',$hotel_id)->first();
        if ($guest_recognization->show_guest_recognition == 1) {
            
            if ($selectedReward == 'guest_of_the_week') {
                $week_badge_count = HotelGuestBadges::whereIn('badges_id', $badge_ids)->where('reward_active_on', '>', Carbon::now()->subDays(7)->format('Y-m-d'))->count();

                $this->guest_success_message = 'Guest of The Week has been awarded to ' . $user_details->full_name . ' along with ' . $points . ' points';
                $this->guest_error_message = 'Reward unavailable. There is a one reward per member per booking limit.';
               
                if ($week_badge_count > 0) {
                    $this->emit('guestRecognitionError');
                    // return response()->json(['status' => 0, 'message' => $guest_error_message]);

                } else {
                    $hotelBadgeStatus = HotelGuestBadges::where('user_id',$userId)->first();
                    // dd($hotelBadgeStatus);

                    $travel_tourism = TravelTourism::find($hotel_id);

                    /**Add point in point table */
                    $point = new Point();
                    $point->user_id = $hotelBadgeStatus->user_id;
                    $point->point = $points;
                    $point->came_from = Auth::id();
                    $point->save();

                    /**Add point to user table*/
                    $user = User::find($hotelBadgeStatus->user_id);
                    $totalPoint = $user->point + $points;
                    $user->point =  $totalPoint;
                    $user->save();

                    /**Add point to badge table*/
                    $hotelBadgeStatus->point = $totalPoint;
                    $hotelBadgeStatus->reward_active_on = Carbon::now();
                    $hotelBadgeStatus->save();

                    /**deduct point from travel tourism*/
                    $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $points;
                    $travel_tourism->save();

                    $this->emit('guestRecognitionSuccess');
                    // return response()->json(['status' => 1, 'message' => $guest_success_message]);

                }
            } elseif ($selectedReward == 'family_friend') {
                // dd($points);
                $get_badge = HotelGuestBadges::where('user_id',$userId)->select('badges_id')->first(); 
                // dd($get_badge);
                $same_family_badges = HotelGuestBadges::where('badges_id', $get_badge->badges_id)->where('status',1)
                ->get();

                $already_rewards_count = HotelGuestBadges::where('badges_id', $get_badge->badges_id)->where('status',1)
                    ->where('is_friend_and_family_badge_active',1)
                    ->count();
                // dd( $already_rewards_count);

                if ($already_rewards_count > 0) {
                    $this->guest_error_message = 'Reward unavailable. There is a two reward per booking limit.';
                    $this->emit('guestRecognitionError');
                    // return response()->json(['status' => 0, 'message' => $guest_error_message]);
                } else {
                    foreach ($same_family_badges as $user) {
                        $hotelBadgeStatus = HotelGuestBadges::find($user->id);
                        $travel_tourism = TravelTourism::find($hotel_id);

                        /**Add point in point table */
                        $point = new Point();
                        $point->user_id = $hotelBadgeStatus->user_id;
                        $point->point = $points;
                        $point->came_from = Auth::id();
                        $point->save();

                        /**Add point to user table*/
                        $user = User::find($hotelBadgeStatus->user_id);
                        $totalPoint = $user->point + $points;
                        $user->point =  $totalPoint;
                        $user->save();

                        /**Add point to badge table*/
                        $hotelBadgeStatus->point = $totalPoint;
                        $hotelBadgeStatus->is_friend_and_family_badge_active = 1;
                        $hotelBadgeStatus->save();

                        /**deduct point from travel tourism*/
                        $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $points;
                        $travel_tourism->save();
                    }
                    $this->guest_success_message = 'Friends and Family Reward has been awarded to all members in this booking with active badges along with ' . $points . ' points. If a new member is added later during their stay, they will automatically have the reward in the Badges section of their wallet.';
                    $this->emit('guestRecognitionSuccess');
                    // return response()->json(['status' => 1, 'message' => $guest_success_message]);
                }
            }
        } else {
            $this->guest_error_message = 'Guest recognition is not active';
            $this->emit('guestRecognitionError');
            // return response()->json(['status' => 0, 'message' => $guest_error_message]);
        }


        
    }

    public function closeRecognition(){
        $this->emit('disableguestRecognitionpopup');
    }

    public function tenantReward(){
        // dd($this->guest_reward_value);
        $previous_date = date('Y-m-d', strtotime('-30 days'));
        $today = date('Y-m-d');
        $thismonth = date('m');
        if ($this->guest_reward_value != '') {
            if($this->guest_reward_value == 'resident_of_month'){
                if(($this->guest != '') && ($this->guest->user_id != '')){
                    
                    $reward_count = HotelGuestBadges::where('reward_type','resident_of_month')->whereMonth('reward_active_on',$thismonth)->count();
                    // dd($reward_count);
                    if($reward_count >= 10){
                        $this->emit('termError',['text' => "Reward unavailable. There is ten reward per month."]);
                    }
                    else{
                        $resident_exist = HotelGuestBadges::where('user_id',$this->guest->user_id)->where('reward_type','resident_of_month')->whereMonth('reward_active_on',$thismonth)->first();
                        $family_exist = HotelGuestBadges::where('user_id',$this->guest->user_id)->where('reward_type','family_friend')->whereBetween('reward_active_on',[$previous_date,$today])->first();
                        // dd($family_exist);
                        if($resident_exist){
                            $this->emit('termError',['text' => $this->guest->user->full_name.' has already received Resident of The Month for the month of '.date('F').'. The member will be eligible to receive Resident of the month again in '.date("F", strtotime("next month"))]);
                        }
                        
                        else{
                            $this->guest->reward_type = 'resident_of_month';
                            $this->guest->reward_active_on = date('Y-m-d');
                            $this->guest->save();
                            if($this->points != ''){
                                $this->guest->point = $this->guest->point+$this->points;
                                $this->guest->save();
    
                                 /**Add point in point table */
                                $point = new Point();
                                $point->user_id = $this->guest->user_id;
                                $point->point = $this->points;
                                $point->came_from = auth()->user()->id;
                                $point->save();
    
                                /**Add point to user table*/
                                $user = User::find($this->guest->user_id);
                                $totalPoint = $user->point + $this->points;
                                $user->point =  $totalPoint;
                                $user->save();
    
                                 /**deduct point from travel tourism*/
                                 $property = TravelTourism::find($this->hotel_id);
                                 $property->points_to_distribute = $property->points_to_distribute - $this->points;
                                 $property->save();
                                 $this->emit('termError',['text' => 'Resident of The Month has been awarded to ' . $this->guest->user->full_name . ' along with ' . $this->points . ' points']);
                            }else{
                                $this->emit('termError',['text' => "Please add tenant of the month reward point to give reward in settings"]);
                            }
                        }

                    }
                }
                else{
                    $this->emit('termError',['text' => "For 'Resident Of The Month' reward, you have to select any one guest"]);
                }
            }
            else{
                if($this->selected_badge != ''){
                    $thismonth = date('m');
                    // dd($this->selected_badge->badgesguest);
                    $userids = $this->selected_badge->badgesguest->where('user_id','!=',null)->pluck('user_id');
                    $resident_count = HotelGuestBadges::where('reward_type','resident_of_month')->whereMonth('reward_active_on',$thismonth)->whereIn('user_id',$userids)->count();
                    // dd($resident_count);
                    $reward_exist = HotelGuestBadges::where('reward_type','family_friend')->where('badges_id',$this->selected_badge->id)->whereBetween('reward_active_on',[$previous_date,$today])->first();
                    if($reward_exist){
                        $date1=date_create($reward_exist->reward_active_on);
                        $date2=date_create($today);
                        $diff=date_diff($date1,$date2);
                        $difference = $diff->format("%a");
                        $remain_days = (30 -$difference);

                        $this->emit('termError',['text' => $this->selected_badge->unites->unit_name.' has already received Family and Friends reward within the last 30 days. The unit this resident resides in will be eligible again to receive the Family and Friends reward again in '.$remain_days.' days.']);
                    }
                    // else if($resident_count > 0){
                    //     $resident_reward = ApartmentGuestBadge::where('reward_type','resident_of_month')->whereMonth('reward_active_on',$thismonth)->whereIn('user_id',$userids)->get();
                    //     foreach($resident_reward as $reward){
                    //         $user_name = $reward->user->full_name;
                    //     }
                    //     $this->emit('termError',['text' => $user_name.' has already received Resident of The Month for the month of '.date('F').'. The member will be eligible to receive Resident of the month again in '.date("F", strtotime("next month"))]);
                    // }
                    else{
                        $guest_badge = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->where('user_id','!=','')->get();
                        if(count($guest_badge) > 0){
                            foreach($guest_badge as $guest){
                                $guest_unit = HotelGuestBadges::find($guest->id);
                                $guest_unit->reward_type = 'family_friend';
                                $guest_unit->reward_active_on = date('Y-m-d');
                                $guest_unit->point = $guest_unit->point+$this->points;
                                $guest_unit->save();
                                /**Add point in point table */
                                $point = new Point();
                                $point->user_id = $guest_unit->user_id;
                                $point->point = $this->points;
                                $point->came_from = auth()->user()->id;
                                $point->save();

                                /**Add point to user table*/
                                $user = User::find($guest_unit->user_id);
                                $totalPoint = $user->point + $this->points;
                                $user->point =  $totalPoint;
                                $user->save();

                                /**deduct point from travel tourism*/
                                // $property = Provider::find($this->selected_badge->building->provider_type_id);
                                $property = TravelTourism::find($this->hotel_id);
                                $property->points_to_distribute = $property->points_to_distribute - $this->points;
                                $property->save();

                            }
                            $this->emit('termError',['text' => "Friends and Family Reward has been awarded to all members in this booking with active badges along with " . $this->points . " points. If a new member is added later during their stay, they will automatically have the reward in the Badges section of their wallet."]);
                        }
                        else{
                            $this->emit('termError',['text' => "No active resident is there"]);
                        }

                    }
                }
                else{
                    $this->emit('termError',['text' => "For 'Family and Friends Rewards', you have to select any one unit badge"]);
                }
            }
        }
        else{
            $this->emit('termError',['text' => "Select any one option"]);
        }
    }
    

    public function addBadgeTerm(){
        if($this->selected_badge != ''){
            //$hotel_id = HotelBuildings::select('hotel_id')->where('id',$this->selected_badge->id)->first();
            $property_limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
            if($property_limit){
                if ($property_limit->term_limit != null){
                    $start_Date = date('Y-m-d');
                    $end_date = date('Y-m-d', strtotime('+'.$property_limit->term_limit));
                    $badge = HotelBadges::find($this->selected_badge->id);
                    $badge->start_date = $start_Date;
                    $badge->end_date = $end_date;
                    $badge->save();
                    $this->emit('termError',['text' => "Term Added Successfully"]);
                }
                else{
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

    // public function resendBadge(){
    //     $this->unit_id = $this->selected_badge->unit_id;
    //     //dd($this->unit_id);
    //     if($this->selected_badge != ''){
    //         $this->badgeDates = [];
    //         $this->email_addresses = [];
    //         $this->checkin_date = '';
    //         $this->checkout_date = '';
    //         $this->guest_count = 0;
    //             $this->unit_id = $this->selected_badge->unit_id;
    //             $this->unit_name = HotelUnites::find($this->unit_id)->unit_name;
    //             $this->checkin_date = date_format(date_create($this->selected_badge->start_date),'m/d/Y');
    //             $this->checkout_date = date_format(date_create($this->selected_badge->end_date),'m/d/Y');
    //             $badges = HotelBadges::where('unit_id',$this->unit_id)->get();
    //             if(count($badges) > 0){
    //                 foreach($badges as $data_badge){
    //                     $this->badgeDates = array('startDate' => $data_badge->start_date, 'endDate' => $data_badge->end_date);
    //                 }
    //             }
               
    //             $this->guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
    //             if(count($this->guests) > 0){
    //                 $this->remaining_count = $this->badge_count - count($this->guests);
    //                 $this->guest_count = count($this->guests);
    //             }
    //             else{
    //                 $this->remaining_count = 10;
    //             }
    //             $this->emit('resend_badge',['date_range' => $this->badgeDates ]);
            
    //             $this->globalSelected = $this->guests->where('status', 0)->pluck('id');
    //     }
    // }

    

    public function updatedSelectAll($value)
    {   
        //    dd($value);
        if ($value) {
            $this->bulkIds = $this->globalSelected;
            // dd($this->bulkIds);
        } else {
            $this->bulkIds = [];
        }
    }

    public function selectSingle($id)
    {
        // dd($this->not_accept_badges);
        if (!in_array($id, $this->bulkIds)) {
            $this->selectAll = false;
        } else {
            $this->selectAll = (count($this->globalSelected) == count($this->bulkIds)) ? true : false;
            // dd($this->selectAll);
        }
    }

    public function resendBadge()
    {
        // dd($this->selected_badge);

        if($this->selected_badge){
            $this->badge_id = $this->selected_badge->id;
            $this->unit_id = $this->selected_badge->unit_id;
        
            $this->selectAll = false;
            $this->shortBadgeStatus = HotelBadges::where('id',$this->badge_id)->first();
            // dd($this->shortBadgeStatus);
            $this->bulkIds = [];
            if ($this->shortBadgeStatus != '') {
                $checkindate = $this->shortBadgeStatus->start_date;
                $checkoutdate = $this->shortBadgeStatus->end_date;
                $this->resend_checkin_date = date_format(date_create($checkindate), 'm/d/Y');
                $this->resend_checkout_date = date_format(date_create($checkoutdate), 'm/d/Y');
                $this->not_accept_badges = HotelGuestBadges::where('badges_id',$this->badge_id)
                                        ->where('guest_email','!=',null)
                                        ->whereIn('status', [0, 1])
                                        ->get();

                    // HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                    // ->where('hotel_guest_badges.guest_email','!=',null)
                    // ->where('hotel_badges.start_date', $checkindate)
                    // ->where('hotel_badges.end_date', $checkoutdate)
                    // ->where('hotel_badges.unit_id', $this->unit_id)
                    // ->whereIn('hotel_guest_badges.status', [0, 1])
                    // ->get();
                
                $this->guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
                //dd($this->guests) ;
                $this->guest_count = count($this->guests);

                $this->listing = TravelTourismSettings::where('travel_tourism_id',$this->hotel_id)->first();
                $this->listing_guests = 10;
                $this->badgeid = $this->shortBadgeStatus->id;
                if($checkoutdate < date('Y-m-d')){
                    $this->globalSelected = [];
                }else{
                    $this->globalSelected = $this->not_accept_badges->where('status', 0)->pluck('id');
                }
                
                // dd($this->not_accept_badges);   
                $this->emit('guestbadge');
            }

        }elseif($this->badge){

            $this->badge_id = $this->badge->id;
            $this->unit_id = $this->badge->unit_id;

            $this->selectAll = false;
            $this->shortBadgeStatus = HotelBadges::where('id',$this->badge_id)->first();
            // dd($this->shortBadgeStatus);
            $this->bulkIds = [];
            if ($this->shortBadgeStatus != '') {
                $checkindate = $this->shortBadgeStatus->start_date;
                $checkoutdate = $this->shortBadgeStatus->end_date;
                $this->resend_checkin_date = date_format(date_create($checkindate), 'm/d/Y');
                $this->resend_checkout_date = date_format(date_create($checkoutdate), 'm/d/Y');
                // $this->not_accept_badges = HotelBadges::join('hotel_guest_badges','hotel_guest_badges.badges_id','=','hotel_badges.id')
                //     ->where('hotel_guest_badges.guest_email','!=',null)
                //     ->where('hotel_badges.start_date', $checkindate)
                //     ->where('hotel_badges.end_date', $checkoutdate)
                //     ->where('hotel_badges.unit_id', $this->unit_id)
                //     ->whereIn('hotel_guest_badges.status', [0, 1])
                //     ->get();

                $this->not_accept_badges = HotelGuestBadges::where('badges_id',$this->badge_id)
                                        ->where('guest_email','!=',null)
                                        ->whereIn('status', [0, 1])
                                        ->get();
                
                $this->guests = HotelGuestBadges::where('badges_id',$this->badge->id)->get();
                //dd($this->guests);
                $this->guest_count = count($this->guests);

                $this->listing = TravelTourismSettings::where('travel_tourism_id',$this->hotel_id)->first();
                $this->listing_guests = 10;
                $this->badgeid = $this->shortBadgeStatus->id;

                // $this->globalSelected = $this->not_accept_badges->where('status', 0)->pluck('id');
                if($checkoutdate < date('Y-m-d')){
                    $this->globalSelected = [];
                }else{
                    $this->globalSelected = $this->not_accept_badges->where('status', 0)->pluck('id');
                }

                $this->emit('guestbadge');
            }
        }else{
            $this->emit('termError', ['text' => 'Please Select badge first.']);
        }
        
    }

    // public function resend_pending_badge()
    // {
    //     // dd($this->selected_badge->id);
    //     // dd($this->bulkIds);
    //     if (count($this->bulkIds) > 0) {
    //         foreach ($this->bulkIds as $id) {
    //             $badge = HotelGuestBadges::find($id);
    //             if ($badge) {
    //                 $limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
    //                 if ($limit) {
    //                     $point = $limit->badge_bonus_point;
    //                 } else {
    //                     $point = 0;
    //                 }
    //                 $arrival_date = date_format(date_create($badge->start_date), 'm/d/Y');
    //                 $badge->is_resend = 1;
    //                 $badge->save();
    //                 //dd($arrival_date);
    //                 $hotel_name = TravelTourism::select('name')->where('id',$this->hotel_id)->first();
    //                 $details = array(
    //                     'company_name' => $hotel_name->name,
    //                     'point' => $point,
    //                     'arrival_date' => $arrival_date,
    //                     'request_id' => $id
    //                 );
    //                 //dd($details);
    //                 Mail::to($badge->guest_email)->send(new HotelGuestBadges($details));
    //             }
    //         }
    //         $this->selectAll = false;
    //         $this->bulkIds = [];
    //         $this->emit('badgeSuccessPopup', ['text' => 'This badge has been successfully resent to the selected user']);
    //     } else { 

    //         $this->emit('resend_error_popup', ['text' => 'Please select an email address(es) to resend invite.']);
    //     }
    // }
    public function hideErrorModal()
    {
        $this->emit('resend_error_popup');
    }

    // public function guest_Recognition_success(){
    //     $this->emit('resend_error_popup');
    // }
   

    public function resend_pending_badge(){
        $limit_setting = TravelTourismSettings::where('travel_tourism_id',$this->hotel_id)->first();
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
            if($this->selected_badge){
                foreach ($this->bulkIds as $id) {
                    if ($this->selected_badge != '') {
                       
                        $arrival_date = date_format(date_create($this->selected_badge->start_date), 'm/d/Y');
                       
                        $guest_badge = HotelGuestBadges::find($id);
                        $guest_badge->is_resend = 1;
                        $guest_badge->updated_at = date('Y-m-d H:i:s');
                        $guest_badge->save();
                        $get_building_name = HotelBuildings::select('building_name')->where('id',$this->selected_badge->building_id)->first();
                        $hotel_name = TravelTourism::select('name')->where('id',$this->hotel_id)->first();
                        $details = array(
                            'company_name' => $hotel_name->name,
                            'building' => $get_building_name->building_name,
                            'point' => $point,
                            'arrival_date' => $arrival_date,
                            'request_id' => $guest_badge->id
                        );
                        // dd($details);
                        Mail::to($guest_badge->guest_email)->queue(new HotelBadgeSentEmail($details));
                    }
                }
                $this->selectAll = false;
                $this->bulkIds = [];
                $this->guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
                $this->emit('termError', ['text' => 'This badge has been successfully resent to the selected user']);
            }else{
                foreach ($this->bulkIds as $id) {
                    if ($this->badge != '') {
                       
                        $arrival_date = date_format(date_create($this->badge->start_date), 'm/d/Y');
                       
                        $guest_badge = HotelGuestBadges::find($id);
                        $guest_badge->is_resend = 1;
                        $guest_badge->save();
                        $get_building_name = HotelBuildings::select('building_name')->where('id',$this->badge->building_id)->first();
                        $hotel_name = TravelTourism::select('name')->where('id',$this->hotel_id)->first();
                        $details = array(
                            'company_name' =>$hotel_name->name,
                            'building' => $get_building_name->building_name,
                            'point' => $point,
                            'arrival_date' => $arrival_date,
                            'request_id' => $guest_badge->id
                        );
                        Mail::to($guest_badge->guest_email)->queue(new HotelBadgeSentEmail($details));
                    }
                }
                $this->selectAll = false;
                $this->bulkIds = [];
                $this->guests = HotelGuestBadges::where('badges_id',$this->badge->id)->get();
                $this->emit('termError', ['text' => 'This badge has been successfully resent to the selected user']);
            }
            
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
               $badge_guest = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
                if($badge_guest){
                    $badge_guest->each->delete();
                }
                $this->selected_badge->delete();

            }
            $this->emit('deactivateError',['text' => 'Badge deactivated successfully']);
        }
        // $this->emit('successDeactivateBadges'); termError
    }

    public function addPoint(){
        if ($this->selected_badge) {
            if($this->guest != ''){
                if($this->guest->status == 1){
                    $travel_setting = TravelTourismSettings::where('travel_tourism_id',$this->hotel_id)->first();
                    if($travel_setting){
                        if($travel_setting->add_point != null){
                            $setting_point = $travel_setting->add_point;
                            //dd($setting_point);
                             $get_distribute_points = TravelTourism::select('points_to_distribute')->where('id',$this->hotel_id)->first();
                             $distribute_points = $get_distribute_points->points_to_distribute;
                            if($distribute_points > $setting_point ){
                                $user = User::find($this->guest->user_id);
                                //Add point in point table
                                $point = new Point;
                                $point->user_id = $this->guest->user_id;
                                $point->point = $setting_point;
                                $point->came_from = auth()->user()->id;
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
                                $property = TravelTourism::find($this->hotel_id);
                                $property->points_to_distribute = $distribute_points - $setting_point;
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
                $guests = HotelGuestBadges::where('badges_id',$this->selected_badge->id)->get();
                if(count($guests) > 0){
                    foreach($guests as $badge_guest){
                        if($badge_guest->status == 1){
                            $travel_setting = TravelTourismSettings::where('travel_tourism_id',$this->hotel_id)->first();
                            if($travel_setting){
                                if($travel_setting->add_point != null){
                                    $setting_point = $travel_setting->add_point;
                                    $get_distribute_points = TravelTourism::select('points_to_distribute')->where('id',$this->hotel_id)->first();
                                    $distribute_points = $get_distribute_points->points_to_distribute;
                                    if($distribute_points > $setting_point ){
                                        $user = User::find($badge_guest->user_id);
                                        //Add point in point table
                                        $point = new Point;
                                        $point->user_id = $badge_guest->user_id;
                                        $point->point = $setting_point;
                                        $point->came_from = auth()->user()->id;
                                        $point->save();
                                        //Add point to user table
                                        $userpoint = $user->point;
                                        $totalPoint = $userpoint + $setting_point;
                                        $user->point =  $totalPoint;
                                        $user->save();
                                        //Add point to badge table
                                        $badge_data = HotelGuestBadges::find($badge_guest->id);
                                        $badge_data->point = $totalPoint;
                                        $badge_data->save();
        
                                        //desuct point from travel tourism
                                        $property = TravelTourism::find($this->hotel_id);
                                        $property->points_to_distribute = $distribute_points - $setting_point;
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
        $this->guest = HotelGuestBadges::find($guestid);
        $this->selected_badge = HotelBadges::find($this->guest->badges_id);
     
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

    public function blankUnit(){
        if($this->select_building === 'all'){
            $this->select_unit_id ='';
            $this->search_text='';
        }
    }

    public function viewconsumerProfile(){
        // dd($this->guest->user_id);
        if($this->guest  != '' && $this->guest != null){
            if($this->guest->status == 1){
                redirect()->route('frontend.hotel.users.view.profile',$this->guest->user_id);
            }else{
                $this->emit('termError', ['text' => 'This user has not accepted the badge request']);
            }
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function badgeFilter($value)
    {
        $this->filterValue = $value;
    }

    public function render()
    {
        //   dd($this->filterValue); 
        $new_start_date = Carbon::now()->format('Y-m-d'); // Today's date
        $new_end_date = Carbon::now()->addDays(30)->format('Y-m-d'); // 30 days after
        $sixtyDaysAgo = Carbon::now()->subDays(60)->format('Y-m-d');
        $today = Carbon::now()->subDays(1)->format('Y-m-d');
        // dd($today,$sixtyDaysAgo,$this->select_building,$this->select_unit_id,$new_start_date, $new_end_date);

        $mergedData = [];
        $units = null;
        if($this->select_building != ''){
            if($this->select_building == 'all'){
                if($this->select_unit_id != ''){

                    $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) use ($new_start_date, $new_end_date, $sixtyDaysAgo, $today) {
                        if ($this->filterValue == 'ACTIVE') {
                            $q->whereBetween('end_date', [$new_start_date, $new_end_date]);
                        } elseif ($this->filterValue == 'INACTIVE') {
                            $q->whereBetween('end_date', [$sixtyDaysAgo, $today]);
                        }
                    }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                    ->where('hotel_id', $this->hotel_id)
                    ->where('id',$this->select_unit_id) 
                    ->orderBy($this->order_column, $this->order_as)
                    ->get();
                            
                }else{
                    

                    $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) {
                        if ($this->filterValue === 'ACTIVE') {
                            $q->where('end_date', '>=', now());
                        } elseif ($this->filterValue === 'INACTIVE') {
                            $q->where('end_date', '<', now()); 
                        }
                    }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                    ->where('hotel_id', $this->hotel_id)
                    ->orderBy($this->order_column, $this->order_as)
                    ->get();
                            
                }
            }else{
                if($this->select_unit_id != ''){
                   
                    $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) use ($new_start_date, $new_end_date, $sixtyDaysAgo, $today) {
                        if ($this->filterValue == 'ACTIVE') {
                            $q->whereBetween('end_date', [$new_start_date, $new_end_date]);
                        } elseif ($this->filterValue == 'INACTIVE') {
                            $q->whereBetween('end_date', [$sixtyDaysAgo, $today]);
                        }
                    }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                    ->where('hotel_id', $this->hotel_id)
                    ->where('building_id',$this->select_building)
                    ->where('id',$this->select_unit_id) 
                    ->orderBy($this->order_column, $this->order_as)
                    ->get();
                    
                }else{


                    $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) use ($new_start_date, $new_end_date, $sixtyDaysAgo, $today) {
                        if ($this->filterValue == 'ACTIVE') {
                            $q->whereBetween('end_date', [$new_start_date, $new_end_date]);
                        } elseif ($this->filterValue == 'INACTIVE') {
                            $q->whereBetween('end_date', [$sixtyDaysAgo, $today]);
                        }
                    }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                    ->where('hotel_id', $this->hotel_id)
                    ->where('building_id', $this->select_building)
                    ->orderBy($this->order_column, $this->order_as)
                    ->get();

                }
            }
        }else{
            if($this->select_unit_id != ''){
                   

                    $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) use ($new_start_date, $new_end_date, $sixtyDaysAgo, $today) {
                        if ($this->filterValue == 'ACTIVE') {
                            $q->whereBetween('end_date', [$new_start_date, $new_end_date]);
                        } elseif ($this->filterValue == 'INACTIVE') {
                            $q->whereBetween('end_date', [$sixtyDaysAgo, $today]);
                        }
                    }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                    ->where('hotel_id', $this->hotel_id)
                    ->where('id',$this->select_unit_id)
                    ->orderBy($this->order_column, $this->order_as)
                    ->get();

            }else{
                

                $units = HotelUnites::with(['unitbuildings', 'unitbadges' => function ($q) use ($new_start_date, $new_end_date, $sixtyDaysAgo, $today) {
                    if ($this->filterValue == 'ACTIVE') {
                        $q->whereBetween('end_date', [$new_start_date, $new_end_date]);
                    } elseif ($this->filterValue == 'INACTIVE') {
                        $q->whereBetween('end_date', [$sixtyDaysAgo, $today]);
                    }
                }, 'unitbadges.badgesguest', 'unitbadges.badgesguest.user'])
                ->where('hotel_id', $this->hotel_id)
                // ->where('building_id', $this->select_building)
                ->orderBy($this->order_column, $this->order_as)
                ->get();
                
            

            }
        }
        
        //  dd($units->toArray());
        
        if($units){
            $mergedData = array_merge($mergedData, $units->toArray());
        }else{
            $mergedData = $mergedData;
        }
        
        // $dddd = User::where('email', 'howard@yopmail.com')->first();
        // dd($mergedData,$dddd->role_name);
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($mergedData, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($mergedData), $perPage, $currentPage);
        $this->user = Auth::user();

        return view('livewire.frontend.travel-tourism.hotel-resort.smart-guest-database',[
            'units' => $data,
        ]);
    }
}
