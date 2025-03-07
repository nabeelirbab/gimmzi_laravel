<?php

namespace App\Http\Livewire\Frontend\TravelTourism\ShortTermRental;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ShortTermGuestBadge;
use Illuminate\Support\Facades\Auth;
use App\Models\ShortTermRentalListing;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BadgeSentEmail;
use App\Models\TravelTourismSettings;
use App\Mail\BadgeRequestCancelByProvider;
use App\Models\Point;
use App\Models\TravelTourism;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\HotelUnites;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;


class SmartGuestDatabase extends Component
{
    use WithPagination;
    public $user, $shortTerm, $shortlistingId, $listing, $badge_checkin_date, $badge_checkout_date, $listing_guests, $shortBadgeStatus;
    public $showFilledList = [];
    public $showFilledDefault = [];
    public $showFilledOpenUnit = [];
    public $badgeDates = [], $dates = [], $not_accept_badges = [];
    public $selectedOption = 'default';
    public $perPage = 5; // Number of items to display per page
    public $currentPage = 1, $remaining_guest = 0; // Current page number
    public $email_addresses = [], $guests = [], $keyArr = [], $guest_count, $result = [];
    public $checkin_date, $checkout_date, $showdiv = false, $search_name;
    protected $listeners = ['fetchGuestBadge', 'dateCheckDateRange', 'checkEmail'];
    public $selected_email, $badgeid, $badge, $cancel_checkin_Date, $cancel_checkout_Date;
    public $current_month, $monthyear, $year, $month, $current_year, $monthly_scheduled = [];
    public $resend_checkin_date, $resend_checkout_date, $remaining_count = 0, $bulkIds = [], $selectAll = false, $globalSelected = [], $filterValue = 'ACTIVE', $guest_reward_value = 'guest_of_the_week', $points, $guest_success_message, $guest_error_message;
    public $listing_id, $guestBadge_id, $consumerid;

    public function mount()
    {
        $this->user = Auth::user();
        $this->shortTerm = $this->user->travelType;
        $this->month = date('m');
        $this->monthyear = date('M Y');
        $this->current_month = date('m', strtotime("-1 month"));
        $this->current_year = date('Y');
        $this->year = date('Y');
        
    }

    

    final public function paginationView(): string
    {
        return 'livewire.frontend.travel-tourism.short-term-rental.livewire-piganation';
    }

    final public function updatedPage(): void
    {
        $this->emit('paginationChanged');
    }

    final public function updatingName(): void
    {
        $this->resetPage();
    }


    public function updatingSelectedOption()
    {
        $this->resetPage();
    }

    public function ListingBadgeModal($id)
    {
        $this->dates = [];
        $this->badgeDates = [];
        $this->listing = ShortTermRentalListing::find($id);
        $this->listing_guests = $this->listing->no_of_guests;
        $this->checkin_date = '';
        $this->checkout_date = '';
        $badges = ShortTermGuestBadge::where('listing_id', $id)->groupBy('checkin_date')->get();
        if (count($badges) > 0) {
            foreach ($badges as $badgedata) {
                $this->badgeDates[] = array('startDate' => $badgedata->checkin_date, 'endDate' => $badgedata->checkout_date);
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
        $this->emit('openListingBadge', ['listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
    }

    public function checkEmail()
    {

        $checkindate = date_format(date_create($this->badge_checkin_date), 'Y-m-d');
        $checkoutdate = date_format(date_create($this->badge_checkout_date), 'Y-m-d');
        $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
            ->whereBetween('checkin_date', [$checkindate, $checkoutdate])
            ->count();
        if (count($this->email_addresses) > 0) {
            // dd(count($this->email_addresses));
            //foreach($this->email_addresses as $key=>$data){
            $email = end($this->email_addresses);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $email)->role('CONSUMER')->first();
                if ($user) {
                    $this->emit('memberSuccessPopup', ['type' => 'member_found', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'badges' => $exist_badge, 'dates' => $this->dates]);
                } else {
                    $this->emit('memberSuccessPopup', ['type' => 'member_not_found', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'badges' => $exist_badge, 'dates' => $this->dates]);
                }
            } else {
                $this->emit('memberSuccessPopup', ['type' => 'wrong_email', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'badges' => $exist_badge, 'dates' => $this->dates]);
            }

            //}

        }
    }

    public function hideSuccessModal()
    {

        if ($this->badge_checkin_date != '') {
            if ($this->badge_checkout_date != '') {
                // dd($this->badge_checkout_date);
                $checkindate = date_format(date_create($this->badge_checkin_date), 'Y-m-d');
                $checkoutdate = date_format(date_create($this->badge_checkout_date), 'Y-m-d');
                $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                    ->whereBetween('checkin_date', [$checkindate, $checkoutdate])
                    ->count();
                // dd($exist_badge);
                $this->emit('hideSuccessPopup', ['listing' => $this->listing, 'checkin_dates' => $this->badge_checkin_date, 'checkout_dates' => $this->badge_checkout_date, 'badges' => $exist_badge]);
            } else {
                $this->emit('hideSuccessPopup', ['listing' => $this->listing, 'checkin_dates' => $this->badge_checkin_date]);
            }
        } elseif ($this->listing != '') {
            $this->emit('hideSuccessPopup', ['listing' => $this->listing]);
        } else {
            $this->badge = '';
            $this->emit('hideSuccessPopup', []);
        }
    }

    public function fetchGuestBadge($id)
    {
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                if (strtotime($this->checkout_date) > strtotime($this->checkin_date)) {
                    $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
                    $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
                    $this->guests = ShortTermGuestBadge::where('listing_id', $id)
                        ->where('guest_email', '!=', null)
                        ->where('checkin_date', $checkindate)
                        ->where('checkout_date', $checkoutdate)
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
                    $this->emit('resetBadgeForm', ['listing' => $this->listing, 'badge_guest_count' => count($this->guests)]);
                } elseif (strtotime($this->checkin_date) > strtotime($this->checkout_date)) {
                    $this->emit('memberSuccessPopup', ['text' => 'Check-out date must not be greater than check-in date', 'listing' => $this->listing, 'checkin_dates' => $this->badge_checkin_date, 'checkout_dates' => $this->badge_checkout_date]);
                } else {
                    $this->emit('memberSuccessPopup', ['text' => 'Check-out date must not be greater than check-in date', 'listing' => $this->listing, 'checkin_dates' => $this->badge_checkin_date, 'checkout_dates' => $this->badge_checkout_date]);
                }
            } else {
                //$this->emit('memberSuccessPopup',['text'=>'Give a check-out date','listing' => $this->listing,'checkin_dates' => $this->badge_checkin_date,'checkout_dates' => $this->badge_checkout_date]);
            }
        } else {
            $this->emit('memberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing, 'checkin_dates' => $this->badge_checkin_date, 'checkout_dates' => $this->badge_checkout_date]);
        }
    }

    public function dateCheckDateRange($id)
    {
        if ($this->checkin_date != '') {
            if ($this->checkout_date != '') {
                if (strtotime($this->checkout_date) > strtotime($this->checkin_date)) {
                    $this->badge_checkout_date = $this->checkout_date;
                    $this->badge_checkin_date = $this->checkin_date;
                    $checkindate =  date('Y-m-d', strtotime('+1 days', strtotime($this->checkin_date)));
                    $checkin_date = date_format(date_create($this->checkin_date), 'Y-m-d');
                    $checkout_date = date_format(date_create($this->checkout_date), 'Y-m-d');
                    $checkoutdate =  date('Y-m-d', strtotime('-1 days', strtotime($this->checkout_date)));
                    $exist_badge = ShortTermGuestBadge::where('listing_id', $id)
                        ->where('checkin_date', '>=', $checkin_date)->where('checkout_date', '<=', $checkout_date)
                        ->count();
                    // dd($exist_badge);
                    // if ($exist_badge > 0) {
                    //     $this->emit('memberSuccessPopup', ['text' => 'There is another badges','listing' => $this->listing, 'badges' => $exist_badge,'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                    // } else {
                    // }
                } elseif (strtotime($this->checkin_date) > strtotime($this->checkout_date)) {
                    $this->emit('memberSuccessPopup', ['text' => 'Check-out date must not be greater than check-in date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                } else {
                    $this->emit('memberSuccessPopup', ['text' => 'Check-out date must not be greater than check-in date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                }
            }
        }
    }

    public function sendBadge()
    {

        // dd($this->checkin_date,$this->checkout_date);

        
        $badges = ShortTermGuestBadge::where('listing_id', $this->listing->id)->groupBy('checkin_date')->get();
        if (count($badges)) {
            foreach ($badges as $badgedata) {
                $this->badgeDates[] = array('startDate' => $badgedata->checkin_date, 'endDate' => $badgedata->checkout_date);
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

                // $check_already_exist = ShortTermGuestBadge::where('short_term_id',$this->listing->travel_tourism_id)
                // ->where('checkin_date',$checkindate)
                // ->where('checkout_date',$checkoutdate)
                // ->where('listing_id',$this->listing->id)
                // ->first();
                // if($check_already_exist){
                //     $this->emit('memberSuccessPopup', ['text' => 'Please change the badge datesd', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                // }
                // ->exists();
                //dd($check_already_exist);
                // $this->emit('memberSuccessPopup', ['text' => 'Please change the badge dates', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);


                
                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toDateTimeString();
                $datetime_utc = new DateTime($formattedTime, new DateTimeZone('UTC'));
                $datetime_utc->setTimezone(new DateTimeZone('America/New_York'));
                $timestamp_in_est = $datetime_utc->format('Y-m-d H:i:s');
                $est_time = $datetime_utc->format('H:i:s');
                
                $current_date = date('Y-m-d');
                if($current_date > $checkoutdate){
                    // dd('fddf');
                    $this->emit('badgeSent', ['text' => 'Unable to send badge invites after checkout date.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]); 
                    return;
                }
                
                $i = 1;

                if (count($this->email_addresses) > 0) {

                    foreach ($this->email_addresses as $key => $emails) {

                        if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                           
                            $newchekindate = Carbon::parse($checkindate)->addDay()->format('Y-m-d');// 1 day add
                            // dd($newchekindate);

                            $from_short_term_guest = ShortTermGuestBadge::where('badge_status',1)
                                                    ->where('guest_email','like', '%' . trim($emails) . '%')
                                                    ->where('checkout_date','>=',$checkindate)
                                                    ->first();
                            if($from_short_term_guest){
                                $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                                    break;
                                
                            }
                           

                            $find_from_hotel = HotelGuestBadges::where('guest_email',trim($emails))->where('status',1)->first();
                            if($find_from_hotel){
                                $hotel_badge = HotelBadges::where('id',$find_from_hotel->badges_id)->where('end_date','>',$checkindate)->where('status',1)->first();
                                if($hotel_badge){
                                    $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                                break;
                                }
                            }

                            $find_from_apartment = ApartmentGuestBadge::where('guest_email',trim($emails))->where('status',1)->first();
                            if($find_from_apartment){
                                $apart_badge = Apartmentbadge::where('id',$find_from_apartment->badges_id)->where('end_date','>',$checkindate)->where('status',1)->first();
                                if($apart_badge){
                                    $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                                break;
                                }
                            }

                            $check_another_badge = ShortTermGuestBadge::where('guest_email', $emails)->where('badge_status',1)->where('checkout_date', '>',$checkindate)->first();
                            // dd($check_another_badge);
                            if($check_another_badge){
                                $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                            break;
                            }
                    
                            // dd($getchkoutDates,$getchkinDates);
                            $user = User::where('email', $emails)->role('CONSUMER')->first();
                            if ($user) {
                                $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                                    ->where('checkin_date', $checkindate)
                                    ->where('checkout_date', $checkoutdate)
                                    ->where('guest_email', $emails)
                                    ->first();
                                if ($exist_badge) {

                                    $this->emit('memberSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                                    break;
                                } else {
                                    
                                    $guest_badge = new ShortTermGuestBadge;
                                    $guest_badge->short_term_id = $this->listing->travel_tourism_id;
                                    $guest_badge->listing_id = $this->listing->id;
                                    $guest_badge->guest_id = $user->id;
                                    $guest_badge->checkin_date = $checkindate;
                                    $guest_badge->checkin_time = $est_time;
                                    $guest_badge->checkout_date = $checkoutdate;
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                }
                            } else {
                                // dd('fsfsdf');
                                $get_role_name = User::where('email', $emails)->first();
                                if($get_role_name){
                                    if($get_role_name->role_name){
                                        $role_name = $get_role_name->role_name;
                                        if($role_name != "CONSUMER"){
                                            $this->emit('selectedSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);
                                            break;
                                            $this->emit('memberSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                                    break;
                                        }
                                    }
                                }
                                $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                                    ->where('checkin_date', $checkindate)
                                    ->where('checkout_date', $checkoutdate)
                                    ->where('guest_email', $emails)
                                    ->first();
                                if ($exist_badge) {

                                    $this->emit('memberSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                                    break;
                                } else {
                                    
                                    $guest_badge = new ShortTermGuestBadge;
                                    $guest_badge->short_term_id = $this->listing->travel_tourism_id;
                                    $guest_badge->listing_id = $this->listing->id;
                                    // $guest_badge->guest_id = $user->id;
                                    $guest_badge->checkin_date = $checkindate;
                                    $guest_badge->checkin_time = $est_time;
                                    $guest_badge->checkout_date = $checkoutdate;
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                }
                            }
                            $limit = TravelTourismSettings::where('travel_tourism_id', $this->listing->travel_tourism_id)->first();
                            if ($limit) {
                                $point = $limit->badge_bonus_point;
                            } else {
                                $point = 0;
                            }
                            $arrival_date = date_format(date_create($this->checkin_date), 'm/d/Y');
                            //dd($arrival_date);
                            $details = array(
                                'company_name' => $this->listing->travel_tourism->name,
                                'point' => $point,
                                'arrival_date' => $arrival_date,
                                'request_id' => $guest_badge->id
                            );
                            //dd($details);
                            Mail::to($emails)->queue(new BadgeSentEmail($details));
                            $i++;
                        }
                        array_push($this->keyArr, $key);
                    }
                    $guestcount = ShortTermGuestBadge::where('listing_id', $this->listing->id)->where('checkin_date', $checkindate)->where('checkout_date', $checkoutdate)->count();
                    if ($i > 1) {
                        //dd($this->keyArr);
                        $this->emit('badgeSent', ['text' => 'Invite Sent Successfully', 'listing' => $this->listing, 'membercount' => $i, 'guest_badge_count' => $guestcount, 'key_arr' => $this->keyArr]);
                    }
                } else {
                    if(ShortTermGuestBadge::where('short_term_id',$this->listing->travel_tourism_id)
                                            ->where('checkin_date',$checkindate)
                                            ->where('checkout_date',$checkoutdate)
                                            ->where('listing_id',$this->listing->id)
                                            ->exists()){

                        $this->emit('memberSuccessPopup', ['text' => 'Please change the badge dates', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
                    }
                    else{
                        $guest_badge = new ShortTermGuestBadge;
                        $guest_badge->short_term_id = $this->listing->travel_tourism_id;
                        $guest_badge->listing_id = $this->listing->id;
                        $guest_badge->checkin_date = $checkindate;
                        $guest_badge->checkin_time = $est_time;
                        $guest_badge->checkout_date = $checkoutdate;
                        $guest_badge->save();
                        $this->emit('badgeSent', ['text' => 'Badge Create Successfully', 'listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                    }
                    
                }
            } else {
                $this->emit('memberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
            }
        } else {
            $this->emit('memberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing, 'daterange' => $this->badgeDates, 'dates' => $this->dates]);
        }
    }

    public function closebadgePopup()
    {

        $this->emit('closeBadgePopup');
    }

    public function closeRecentPopup()
    {
        $this->selectAll = false;
        $this->bulkIds = [];
        $this->emit('guestbadgeClose');
    }

    public function refreshForm()
    {
        $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
        $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');
        $this->guests = ShortTermGuestBadge::where('guest_email', '!=', null)
            ->where('listing_id', $this->listing->id)
            ->where('checkin_date', $checkindate)
            ->where('checkout_date', $checkoutdate)
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

        $this->emit('resetBadgeForm', ['listing' => $this->listing, 'badge_guest_count' => count($this->guests)]);
    }

    public function clearBadgeDates()
    {

        if ($this->checkin_date != '') {
            if ($this->checkin_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                //dd($checkoutdate);
                $this->emit('clearBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('memberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing]);
            }
        } else {
            $this->emit('memberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing]);
        }
    }

    public function clearRecendBadgeDates()
    {

        if ($this->resend_checkin_date != '') {
            if ($this->resend_checkin_date != '') {
                $checkindate = date_format(date_create($this->resend_checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->resend_checkout_date), 'm/d/Y');
                //dd($checkoutdate);
                $this->emit('clearBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('memberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing]);
            }
        } else {
            $this->emit('memberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing]);
        }
    }

    public function removeBadgeDates()
    {
        $checkindate = date_format(date_create($this->checkin_date), 'Y-m-d');
        $checkoutdate = date_format(date_create($this->checkout_date), 'Y-m-d');

        if ($this->checkin_date == null && $this->checkout_date == null) {

            $checkindate = date_format(date_create($this->resend_checkin_date), 'Y-m-d');
            $checkoutdate = date_format(date_create($this->resend_checkout_date), 'Y-m-d');
        }

        $badge_guests = ShortTermGuestBadge::where('listing_id', $this->listing->id)->where('checkin_date', $checkindate)->where('checkout_date', $checkoutdate)->get();


        if (count($badge_guests) > 0) {
            foreach ($badge_guests as $badges) {
                ShortTermGuestBadge::where('id', $badges->id)->delete();
            }
            $this->checkin_date = '';
            $this->checkout_date = '';
            $this->guests = [];
            //dd($this->badgeid);
            if ($this->badgeid != null) {
                $this->monthly_scheduled = [];
                $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                    // ->whereMonth('checkout_date',$this->month)
                    ->groupBy('checkin_date')
                    ->groupBy('checkout_date')->get();
                //dd($badgedate);
                if (count($badgedate) > 0) {
                    foreach ($badgedate as $badgeValue) {
                        $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                            ->where('checkout_date', $badgeValue->checkout_date)
                            ->groupBy('listing_id')->get();
                    }
                } else {
                    $this->monthly_scheduled = [];
                }
                // dd($this->monthly_scheduled);
                $this->emit('removeBadgeDate', ['listing' => $this->listing, 'hide_popup' => true]);
            } else {
                $this->emit('removeBadgeDate', ['listing' => $this->listing]);
            }
        } else {


            $this->emit('removeBadgeDate', ['listing' => $this->listing]);
        }
    }

    public function checkListingStatus($id)
    {   
        $this->guestBadge_id = $id;
        $this->shortBadgeStatus = ShortTermGuestBadge::find($id);
        if ($this->shortBadgeStatus) {
            if ($this->shortBadgeStatus->badge_status == 1) {
                $this->emit('enableActionBtns');
            } else {
                $this->emit('enableResendBtn');
            }
        }
    }

    public function viewconsumerProfile(){
            if($this->shortBadgeStatus->guest_id === null){
                $this->emit('sucesspopup',['msg' => 'The Consumer is not accepted yet.']); 
            }else{
                $this->consumerid = $this->shortBadgeStatus->guest_id;
                redirect()->route('frontend.short.users.view.profile',$this->consumerid);
            }
    }

    public function cancelBadgeRequest($badgeid)
    {
        $this->badgeid = $badgeid;
        $this->badge = ShortTermGuestBadge::find($this->badgeid);
        // dd($this->badge);
        $this->badge_checkin_date = '';
        $this->badge_checkout_date = '';
        $this->listing = '';
        $this->cancel_checkin_Date = date_format(date_create($this->badge->checkin_date), 'm/d/Y');
        $this->cancel_checkout_Date = date_format(date_create($this->badge->checkout_date), 'm/d/Y');
        $this->emit('cancelBadgePopup', ['badge' => $this->badge]);
    }

    public function deleteGuestBadge()
    {
        $this->badge = ShortTermGuestBadge::find($this->badgeid);
        if ($this->badge) {
            //dd($this->badge);
            Mail::to($this->badge->guest_email)->queue(new BadgeRequestCancelByProvider());
            $this->badge->delete();
            $this->emit('successPopup', ['text' => 'Badge request is cancelled successfully']);
        } else {
            $this->emit('successPopup', ['text' => 'Badge request not found']);
        }
    }

    public function addPoint()
    {
        if ($this->shortBadgeStatus != '') {
            if ($this->shortBadgeStatus->badge_status == 1) {
                $travel_tourism_setting = TravelTourismSettings::where('travel_tourism_id', $this->shortBadgeStatus->short_term_id)->first();
                if ($travel_tourism_setting) {
                    if ($travel_tourism_setting->add_point != '') {
                        $travel_tourism = TravelTourism::find($this->shortBadgeStatus->short_term_id);
                        if ($travel_tourism_setting->add_point < $travel_tourism->points_to_distribute) {
                            $setting_point = $travel_tourism_setting->add_point;
                            $user = User::find($this->shortBadgeStatus->guest_id);
                            //Add point in point table
                            $point = new Point;
                            $point->user_id = $this->shortBadgeStatus->guest_id;
                            $point->point = $setting_point;
                            $point->came_from = auth()->user()->id;
                            $point->save();
                            //Add point to user table
                            $userpoint = $user->point;
                            $totalPoint = $userpoint + $setting_point;
                            $user->point =  $totalPoint;
                            $user->save();
                            //Add point to badge table
                            $this->shortBadgeStatus->points = $totalPoint;
                            $this->shortBadgeStatus->save();

                            //desuct point from travel tourism
                            $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $setting_point;
                            $travel_tourism->save();

                            $this->emit('pointAddPopup', ['message' => "Points have been added to this member’s account", 'status' => 1]);
                        } else {
                            $setting_point = 0;
                            $this->emit('pointAddPopup', ['message' => $travel_tourism->name . "'s point should be greater than added points", 'status' => 0]);
                        }
                    } else {
                        $setting_point = 0;
                        $this->emit('pointAddPopup', ['message' => 'There is not updated the add point in settings', 'status' => 0]);
                    }
                } else {
                    $setting_point = 0;
                    $this->emit('pointAddPopup', ['message' => 'There is not updated the add point in settings', 'status' => 0]);
                }
                // $this->emit('pointAddPopup');
            } else {
                $this->emit('pointAddPopup', ['message' => 'This user has not accepted the badge request', 'status' => 0]);
            }
        } else {
            $this->emit('pointAddPopup', ['message' => 'No badge is selected', 'status' => 0]);
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
        $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
            ->whereYear('checkin_date',$this->year)
            ->groupBy('checkin_date')
            ->groupBy('checkout_date')->get();
             //dd($badgedate);
        if (count($badgedate) > 0) {
            foreach ($badgedate as $badgeValue) {
                $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                    ->where('checkout_date', $badgeValue->checkout_date)
                    ->groupBy('listing_id')->get();
            }
        }
        //  dd($this->monthly_scheduled);
        $this->emit('scheduledBadgesPopup');
    }

    public function changeMonth($type)
    {

        $this->monthly_scheduled = [];
        //dd($type);
        if ($type == 'max') {

            if ($this->month != '') {
                $dt = strtotime($this->monthyear);
                $this->monthyear = date("M Y", strtotime("+1 month", $dt));
                // dd($this->current_month );
                $this->month  = date("m", strtotime("+1 month", $dt));
                $this->year  = date("Y", strtotime("+1 month", $dt));
                if($this->listing_id){
                    $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                                ->whereYear('checkin_date',$this->year)
                                ->where('listing_id',$this->listing_id)
                                ->groupBy('checkin_date')
                                ->groupBy('checkout_date')->get();
                }
                else{
                    $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                                ->whereYear('checkin_date',$this->year)
                                ->groupBy('checkin_date')
                                ->groupBy('checkout_date')->get();
                }
                
                //dd($badgedate);
                if (count($badgedate) > 0) {
                    foreach ($badgedate as $badgeValue) {
                        $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                            ->where('checkout_date', $badgeValue->checkout_date)
                            ->groupBy('listing_id')->get();
                    }
                } else {
                    $this->monthly_scheduled = [];
                }
            }
        } elseif ($type == 'min') {

            if ($this->month != '') {
                $dt = strtotime($this->monthyear);
                $this->monthyear = date("M Y", strtotime("-1 month", $dt));
                // dd($this->current_month );
                $this->month  = date("m", strtotime("-1 month", $dt));
                $this->year  = date("Y", strtotime("-1 month", $dt));
                if($this->listing_id){
                $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                            ->whereYear('checkin_date',$this->year)
                            ->where('listing_id',$this->listing_id)
                            ->groupBy('checkin_date')
                            ->groupBy('checkout_date')->get();
                }
                else{
                    $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                                ->whereYear('checkin_date',$this->year)
                                ->groupBy('checkin_date')
                                ->groupBy('checkout_date')->get();
                }
                //dd($badgedate);
                if (count($badgedate) > 0) {
                    foreach ($badgedate as $badgeValue) {
                        $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                            ->where('checkout_date', $badgeValue->checkout_date)
                            ->groupBy('listing_id')->get();
                    }
                } else {
                    $this->monthly_scheduled = [];
                }
            }
        }
    }

    public function selectBadge($badgeid)
    {

        $this->badgeid = $badgeid;
    }

    public function click_date_badge($badgeid){
        $this->badgeid = $badgeid;
        $this->show_selected_badge();
    }

    public function show_selected_badge()
    {
        // $this->badgeid = $badgeid;
        // dd($this->badgeid);
        if ($this->badgeid != null) {
            // dd($this->shortBadgeStatus);
            $this->badge = $this->shortBadgeStatus = ShortTermGuestBadge::with('listing')->find($this->badgeid);
            // dd($this->badge);
            $this->badge_checkin_date = $this->badge->checkin_date;
            $this->badge_checkout_date = $this->badge->checkout_date;
            $this->checkin_date = date_format(date_create($this->badge->checkin_date), 'm/d/Y');
            $this->checkout_date = date_format(date_create($this->badge->checkout_date), 'm/d/Y');
            $this->guest_count = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
                ->where('guest_email', '!=', null)
                ->where('checkin_date', $this->badge->checkin_date)
                ->where('checkout_date', $this->badge->checkout_date)->count();
            $this->listing = ShortTermRentalListing::find($this->badge->listing_id);
            $this->listing_guests = $this->listing->no_of_guests;
            $this->guests = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
                ->where('guest_email', '!=', null)
                ->where('checkin_date', $this->badge->checkin_date)
                ->where('checkout_date', $this->badge->checkout_date)->get();
            if ($this->guest_count < $this->listing_guests) {
                $this->remaining_count = ($this->listing_guests - $this->guest_count);
            } else {
                $this->remaining_count = 0;
            }

            $this->emit('selectedScheduledBadgesPopup');
        } else {
            $this->emit('successPopup', ['text' => 'please select a badge']);
        }
    }

    public function sendSelectedBadge()
    {
        // dd('cscsd');
        $i = 1;
        if (count($this->email_addresses) > 0) {

            foreach ($this->email_addresses as $key => $emails) {

                //dd($emails);
                if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                    $user = User::where('email', $emails)->role('CONSUMER')->first();
                    $find_from_hotel = HotelGuestBadges::where('guest_email',trim($emails))->where('status',1)->first();
                    if($find_from_hotel){
                        $hotel_badge = HotelBadges::where('id',$find_from_hotel->badges_id)->where('end_date','>',$this->badge_checkin_date)->where('status',1)->first();
                        if($hotel_badge){
                            $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                        break;
                        }
                    }

                    $find_from_apartment = ApartmentGuestBadge::where('guest_email',trim($emails))->where('status',1)->first();
                    if($find_from_apartment){
                        $apart_badge = Apartmentbadge::where('id',$find_from_apartment->badges_id)->where('end_date','>',$this->badge_checkin_date)->where('status',1)->first();
                        if($apart_badge){
                            $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                        break;
                        }
                    }

                    $check_another_badge = ShortTermGuestBadge::where('guest_email', $emails)->where('checkout_date', '>',$this->badge_checkin_date)->first();
                    if($check_another_badge){
                        $this->emit('badgeSent', ['text' => 'Member already active on another badge.','listing' => $this->listing, 'membercount' => 0, 'guest_badge_count' => 0, 'key_arr' => []]);
                    break;
                    }

                    if ($user) {
                        $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                            ->where('checkin_date', $this->badge_checkin_date)
                            ->where('checkout_date', $this->badge_checkout_date)
                            ->where('guest_email', $emails)
                            ->first();
                        if ($exist_badge) {
                            $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->listing]);
                            break;
                        } else {
                            $guest_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                                                ->where('checkin_date', $this->badge_checkin_date)
                                                ->where('checkout_date', $this->badge_checkout_date)->where('guest_email',null)->orderBy('id','asc')->first();
                            if($guest_badge){
                                $guest_badge->guest_email = $emails;
                                $guest_badge->guest_id = $user->id;
                                $guest_badge->save();
                            }
                            else{
                                $guest_badge = new ShortTermGuestBadge;
                                $guest_badge->short_term_id = $this->listing->travel_tourism_id;
                                $guest_badge->listing_id = $this->listing->id;
                                $guest_badge->guest_id = $user->id;
                                $guest_badge->checkin_date = $this->badge_checkin_date;
                                $guest_badge->checkout_date = $this->badge_checkout_date;
                                $guest_badge->guest_email = $emails;
                                $guest_badge->save();
                            }
                            
                        }
                    } else {
                        $get_role_name = User::where('email', $emails)->first();
                        if($get_role_name){
                            if($get_role_name->role_name){
                                $role_name = $get_role_name->role_name;
                                if($role_name != "CONSUMER"){
                                    // $this->emit('selectedSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.']);
                                    // break;

                                    $this->emit('selectedSuccessPopup', ['text' => 'Member already assigned as a '.$role_name.'. You can not send request as a Consumer.', 'listing' => $this->listing]);
                                    break;
                                }
                            }
                        }
                        $exist_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                            ->where('checkin_date', $this->badge_checkin_date)
                            ->where('checkout_date', $this->badge_checkout_date)
                            ->where('guest_email', $emails)
                            ->first();
                        if ($exist_badge) {

                            $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->listing]);
                            break;
                        } else {
                            $guest_badge = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                                                ->where('checkin_date', $this->badge_checkin_date)
                                                ->where('checkout_date', $this->badge_checkout_date)->where('guest_email',null)->orderBy('id','asc')->first();
                            if($guest_badge){
                                $guest_badge->guest_email = $emails;
                                $guest_badge->save();
                            }
                            else{
                                $guest_badge = new ShortTermGuestBadge;
                                $guest_badge->short_term_id = $this->listing->travel_tourism_id;
                                $guest_badge->listing_id = $this->listing->id;
                                $guest_badge->checkin_date = $this->badge_checkin_date;
                                $guest_badge->checkout_date = $this->badge_checkout_date;
                                $guest_badge->guest_email = $emails;
                                $guest_badge->save();
                            }
                            
                        }
                    }

                    $limit = TravelTourismSettings::where('travel_tourism_id', $this->listing->travel_tourism_id)->first();
                    if ($limit) {
                        $point = $limit->badge_bonus_point;
                    } else {
                        $point = 0;
                    }
                    $arrival_date = date_format(date_create($this->checkin_date), 'm/d/Y');
                    //dd($arrival_date);
                    $details = array(
                        'company_name' => $this->listing->travel_tourism->name,
                        'point' => $point,
                        'arrival_date' => $arrival_date,
                        'request_id' => $guest_badge->id
                    );
                    //dd($details);
                    Mail::to($emails)->queue(new BadgeSentEmail($details));
                    $i++;
                }
                array_push($this->keyArr, $key);
            }
            $this->guest_count = ShortTermGuestBadge::where('listing_id', $this->listing->id)->where('checkin_date', $this->badge_checkin_date)->where('checkout_date', $this->badge_checkout_date)->count();
            $this->guests = ShortTermGuestBadge::where('listing_id', $this->listing->id)
                ->where('guest_email', '!=', null)
                ->where('checkin_date', $this->badge_checkin_date)
                ->where('checkout_date', $this->badge_checkout_date)
                ->get();
            $this->remaining_count = ($this->listing_guests - $this->guest_count);
            $this->keyArr = [];
            if ($i > 1) {
                $this->email_addresses = [];
                $this->emit('badgeSent', ['listing' => $this->listing, 'membercount' => $i, 'guest_badge_count' => $this->guest_count, 'text' => 'Invite Sent Successfully', 'key_arr' => $this->keyArr]);
            }
        } else {
            $this->emit('selectedSuccessPopup', ['text' => 'Give valid email address', 'listing' => $this->listing]);
        }
    }

    public function closeSelectedBadge()
    {
        // $this->badge = '';
        // $this->checkin_date = '';
        // $this->checkout_date = '';
        // $this->guest_count = '';
        // $this->listing = '';
        // $this->listing_guests  = '';
        // $this->guests = [];
        $this->emit('closeSelectedScheduledBadges');
    }

    public function clearSelectedBadgeDates()
    {
        //dd($this->checkin_date);
        if ($this->checkin_date != '') {
            if ($this->checkin_date != '') {
                $checkindate = date_format(date_create($this->checkin_date), 'm/d/Y');
                $checkoutdate = date_format(date_create($this->checkout_date), 'm/d/Y');
                $this->emit('clearSelectBadgeDate', ['checkindate' => $checkindate, 'checkoutdate' => $checkoutdate]);
            } else {
                $this->emit('memberSuccessPopup', ['text' => 'Give a check-out date', 'listing' => $this->listing]);
            }
        } else {
            $this->emit('memberSuccessPopup', ['text' => 'Give a check-in date', 'listing' => $this->listing]);
        }
    }

    public function searchListing()
    {
        if (!empty($this->search_name)) {
            $this->result = ShortTermRentalListing::where('status', 1)
                ->where('name', 'like', '%' . trim($this->search_name) . '%')
                ->orderBy('id', 'desc')
                ->get();
            $this->showdiv = true;
            // dd($this->result);
        } else {
            $this->monthly_scheduled = [];
            $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
                ->whereMonth('checkout_date', $this->month)
                ->groupBy('checkin_date')
                ->groupBy('checkout_date')->get();
            if (count($badgedate) > 0) {
                foreach ($badgedate as $badgeValue) {
                    $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                        ->where('checkout_date', $badgeValue->checkout_date)
                        ->groupBy('listing_id')->get();
                }
            }
            $this->showdiv = false;
        }
    }

    public function selectlisting($id)
    {
        $this->monthly_scheduled = []; 
        $listng = ShortTermRentalListing::find($id);
        $this->search_name =  $listng->name;
        $this->listing_id = $id;
        $badgedate = ShortTermGuestBadge::whereMonth('checkin_date', $this->month)
            ->where('listing_id', $id)
            ->groupBy('checkin_date')
            ->get();
        // dd($badgedate);
        if (count($badgedate) > 0) {
            foreach ($badgedate as $badgeValue) {
                $this->monthly_scheduled[] = ShortTermGuestBadge::where('checkin_date', $badgeValue->checkin_date)
                    ->where('checkout_date', $badgeValue->checkout_date)->where('listing_id', $id)
                    ->groupBy('listing_id')->get();
            }
            // dd($this->monthly_scheduled);
        } else {
            $this->monthly_scheduled = [];
        }
        $this->showdiv = false;
    }

    public function deactivateBadge()
    {
        if ($this->shortBadgeStatus) {
            $today = date('Y-m-d');
            if ($today > $this->shortBadgeStatus->checkin_date) {
                $this->emit('deactivateBadges', ['type' => 1]);
            } else {
                $this->emit('deactivateBadges', ['type' => 0]);
            }
        }
    }

    public function yesDeacivateBadge()
    {   
        // dd($this->shortBadgeStatus->id);
        if ($this->shortBadgeStatus) {
            $this->shortBadgeStatus->badge_status = 3;
            $this->shortBadgeStatus->deleted_at = now();
            $this->shortBadgeStatus->save();
        }
        $this->emit('successDeactivateBadges');
    }

    public function resendBadge($id)
    {
        $this->selectAll = false;
        $this->bulkIds = [];
        
        $this->shortBadgeStatus = ShortTermGuestBadge::find($id);
        
        // 
            $checkindate = $this->shortBadgeStatus->checkin_date;
            $checkoutdate = $this->shortBadgeStatus->checkout_date;
            $this->resend_checkin_date = date_format(date_create($checkindate), 'm/d/Y');
            $this->resend_checkout_date = date_format(date_create($checkoutdate), 'm/d/Y');
            //dd($this->checkin_date);
            $this->not_accept_badges = ShortTermGuestBadge::where('checkin_date', $checkindate)
                ->where('checkout_date', $checkoutdate)
                ->where('guest_email','!=',null)
                ->where('listing_id', $this->shortBadgeStatus->listing_id)
                ->whereIn('badge_status', [0, 1])
                ->get();
                // dd($this->not_accept_badges);

            $this->guest_count = ShortTermGuestBadge::where('listing_id', $this->shortBadgeStatus->listing_id)
                ->where('guest_email', '!=', null)
                ->where('checkin_date', $checkindate)
                ->where('checkout_date', $checkoutdate)->count();
            $this->listing = ShortTermRentalListing::find($this->shortBadgeStatus->listing_id);
            $this->listing_guests = $this->listing->no_of_guests;
            $this->badgeid = $this->shortBadgeStatus->id;
            if($checkoutdate < date('Y-m-d')){
                $this->globalSelected = [];
            }
            else{
                $this->globalSelected = $this->not_accept_badges->where('badge_status', 0)->pluck('id');
            }

            

            $this->emit('guestbadge');
        
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


    public function selectPendingUser($id)
    {
        $this->badgeid = $id;
    }

    public function resend_pending_badge()
    {
        if (count($this->bulkIds) > 0) {
            foreach ($this->bulkIds as $id) {
                $badge = ShortTermGuestBadge::find($id);
                if ($badge) {
                    $limit = TravelTourismSettings::where('travel_tourism_id', $badge->travel_tourism_id)->first();
                    if ($limit) {
                        $point = $limit->badge_bonus_point;
                    } else {
                        $point = 0;
                    }
                    $arrival_date = date_format(date_create($badge->checkin_date), 'm/d/Y');
                    $badge->is_resend = 1;
                    $badge->updated_at = date('Y-m-d H:i:s');
                    $badge->save();
                    //dd($arrival_date);
                    $details = array(
                        'company_name' => $badge->shortterm->name,
                        'point' => $point,
                        'arrival_date' => $arrival_date,
                        'request_id' => $id
                    );
                    //dd($details);
                    Mail::to($badge->guest_email)->queue(new BadgeSentEmail($details));
                }
            }
            $this->selectAll = false;
            $this->bulkIds = [];
            $this->emit('badgeSuccessPopup', ['text' => 'This badge has been successfully resent to the selected user']);
        } else {

            $this->emit('resend_error_popup', ['text' => 'Please select an email address(es) to resend invite.']);
        }
    }

    public function hideErrorModal()
    {
        $this->emit('resend_error_popup');
    }

    public function badgeFilter($value)
    {
        $this->filterValue = $value;
    }

    public function guestRecognition()
    {
        $this->points = TravelTourismSettings::where('travel_tourism_id', $this->shortBadgeStatus->short_term_id)->first()->guest_of_week_point;
        // dd($this->points);
        $this->emit('guestRecognition');
    }

    public function guestReward()
    {
        //dd($this->shortBadgeStatus);
        if ($this->shortBadgeStatus->shortterm->show_guest_recognition == 1) {
            if ($this->guest_reward_value == 'guest_of_the_week') {
                $week_badge_count = ShortTermGuestBadge::where('short_term_id', $this->shortBadgeStatus->short_term_id)->where('guest_badge_point_date', '>', Carbon::now()->subDays(7)->format('Y-m-d'))->count();

                $this->guest_success_message = 'Guest of The Week has been awarded to ' . $this->shortBadgeStatus->guest->full_name . ' along with ' . $this->points . ' points';
                $this->guest_error_message = 'Reward unavailable. There is a one reward per member per booking limit.';
                if ($week_badge_count > 0) {
                    $this->emit('guestRecognitionError');
                } else {
                    $shortBadgeStatus = ShortTermGuestBadge::find($this->shortBadgeStatus->id);
                    $travel_tourism = TravelTourism::find($shortBadgeStatus->short_term_id);

                    /**Add point in point table */
                    $point = new Point();
                    $point->user_id = $shortBadgeStatus->guest_id;
                    $point->point = $this->points;
                    $point->came_from = Auth::id();
                    $point->save();

                    /**Add point to user table*/
                    $user = User::find($shortBadgeStatus->guest_id);
                    $totalPoint = $user->point + $this->points;
                    $user->point =  $totalPoint;
                    $user->save();

                    /**Add point to badge table*/
                    $shortBadgeStatus->points = $totalPoint;
                    $shortBadgeStatus->guest_badge_point_date = Carbon::now();
                    $shortBadgeStatus->save();

                    /**deduct point from travel tourism*/
                    $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $this->points;
                    $travel_tourism->save();

                    $this->emit('guestRecognitionSuccess');
                }
            } elseif ($this->guest_reward_value == 'family_friend') {
                $same_family_badges = ShortTermGuestBadge::where('listing_id', $this->shortBadgeStatus->listing_id)
                    ->where(['checkin_date' => $this->shortBadgeStatus->checkin_date, 'checkout_date' => $this->shortBadgeStatus->checkout_date, 'badge_status' => 1])
                    ->get();

                $already_rewards_count = ShortTermGuestBadge::where('listing_id', $this->shortBadgeStatus->listing_id)
                    ->where(['checkin_date' => $this->shortBadgeStatus->checkin_date, 'checkout_date' => $this->shortBadgeStatus->checkout_date])
                    ->where('is_friend_and_family_badge_active', 1)
                    ->count();


                if ($already_rewards_count > 0) {
                    $this->guest_error_message = 'Reward unavailable. There is a two reward per booking limit.';
                    $this->emit('guestRecognitionError');
                } else {
                    foreach ($same_family_badges as $user) {
                        $shortBadgeStatus = ShortTermGuestBadge::find($user->id);
                        $travel_tourism = TravelTourism::find($shortBadgeStatus->short_term_id);

                        /**Add point in point table */
                        $point = new Point();
                        $point->user_id = $shortBadgeStatus->guest_id;
                        $point->point = $this->points;
                        $point->came_from = Auth::id();
                        $point->save();

                        /**Add point to user table*/
                        $user = User::find($shortBadgeStatus->guest_id);
                        $totalPoint = $user->point + $this->points;
                        $user->point =  $totalPoint;
                        $user->save();

                        /**Add point to badge table*/
                        $shortBadgeStatus->points = $totalPoint;
                        $shortBadgeStatus->is_friend_and_family_badge_active = 1;
                        $shortBadgeStatus->save();

                        /**deduct point from travel tourism*/
                        $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $this->points;
                        $travel_tourism->save();
                    }
                    $this->guest_success_message = 'Friends and Family Reward has been awarded to all members in this booking with active badges along with ' . $this->points . ' points. If a new member is added later during their stay, they will automatically have the reward in the Badges section of their wallet.';
                    $this->emit('guestRecognitionSuccess');
                }
            }
        } else {
            $this->guest_error_message = 'Guest recognition is not active';
            $this->emit('guestRecognitionError');
        }
    }

    public function render()
    {
        /**  1. Active: From today to 30 days.
         *   2. Inactive: From 30 days.
         *   3. All: No condition has applied in this condition.
         */
        $start_date = Carbon::now()->format('Y-m-d'); // Today's date
        $end_date = Carbon::now()->addDays(30)->format('Y-m-d'); // 30 days after

        $query1 = null;
        $mergedData = [];

        if ($this->selectedOption === 'filledunit') {

            $query1 = ShortTermGuestBadge::with('shortterm', 'listing', 'guest')
                ->where('short_term_id', $this->shortTerm->id)
                ->whereIn('badge_status', [0, 1])
                ->orderBy('id', 'asc');

            if ($this->filterValue == 'ACTIVE') {

                $query1 = $query1->whereBetween('checkout_date',  [$start_date, $end_date])
                    ->get();
            } elseif ($this->filterValue == 'INACTIVE') {

                $query1 = $query1->whereDate('checkout_date', '<', $start_date)->get();
            } else {

                $query1 = $query1->get();
            }
        } elseif ($this->selectedOption === 'openunits') {

            $query1 = ShortTermRentalListing::where('travel_tourism_id', $this->shortTerm->id)
                ->orderBy('id', 'asc');

            if ($this->filterValue == 'ACTIVE') {

                $query1 = $query1->with(['badges' => function ($badges) use ($start_date, $end_date) {
                    $badges->whereBetween('checkout_date',  [$start_date, $end_date]);
                }])->get();
            } elseif ($this->filterValue == 'INACTIVE') {

                $query1 = $query1->with(['badges' => function ($badges) use ($start_date) {
                    $badges->whereDate('checkout_date', '<', $start_date);
                }])->get();
            } else {

                $query1 = $query1->get();
            }
        } else {
            $query1 = ShortTermRentalListing::with('badges', 'badges.guest', 'badges.listing')
                ->where('travel_tourism_id', $this->shortTerm->id)
                ->orderBy('id', 'asc');

            if ($this->filterValue == 'ACTIVE') {
                $query1 = $query1->with(['badges' => function ($badges) use ($start_date, $end_date) {
                    $badges->whereBetween('checkout_date',  [$start_date, $end_date]);
                }])->get();
            } elseif ($this->filterValue == 'INACTIVE') {
                $query1 = $query1->with(['badges' => function ($badges) use ($start_date) {
                    $badges->whereDate('checkout_date', '<', $start_date);
                }])->get();
            } else {
                $query1 = $query1->get();
            }
        }
        $mergedData = array_merge($mergedData, $query1->toArray());
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($mergedData, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($mergedData), $perPage, $currentPage);
        $this->user = Auth::user();

        return view('livewire.frontend.travel-tourism.short-term-rental.smart-guest-database', [
            'data' => $data,
        ]);
    }
}
