<?php

namespace App\Http\Livewire\Frontend\TravelTourism\ShortTermRental;

use Livewire\Component;
use App\Models\ShortTermGuestBadge;
use App\Models\User;
use App\Models\TravelTourismSettings;
use Illuminate\Support\Facades\Mail;
use App\Mail\BadgeSentEmail;
use App\Models\ApartmentGuestBadge;
use App\Models\TravelTourism;
use Carbon\Carbon;
use App\Models\Point;

class ConsumerProfile extends Component
{

    public $guest_id,$listing, $badge, $anotherbadge, $checkin_date, $checkout_date, $listing_guests, $guest_count, $guests = [], $remaining_count, $badge_checkin_date, $badge_checkout_date, $email_addresses=[] ;
    public $keyArr=[], $points, $guest_reward_value, $guest_success_message, $guest_error_message;
    protected $listeners = ['checkEmail'];

    public function mount($guestid){
        $this->guest_id = $guestid;
        $this->badge = ShortTermGuestBadge::with('guest','listing')->where('guest_id',$this->guest_id)->orderBy('id','DESC')->first();
        $this->anotherbadge = ShortTermGuestBadge::with('guest','listing')
                            ->where('checkin_date',$this->badge->checkin_date)
                            ->where('checkout_date',$this->badge->checkout_date)
                            ->where('listing_id',$this->badge->listing_id)
                            ->whereNotIn('guest_id',[$this->guest_id])
                            ->get();
        $this->badge_checkin_date = $this->badge->checkin_date;
        $this->badge_checkout_date = $this->badge->checkout_date;

    }

    public function addBadgeGuest(){
        
        $this->checkin_date = date_format(date_create($this->badge->checkin_date), 'm/d/Y');
        $this->checkout_date = date_format(date_create($this->badge->checkout_date), 'm/d/Y');
        $this->listing_guests = $this->badge->listing->no_of_guests;
        $this->guest_count = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
                                ->where('guest_email', '!=', null)
                                ->where('checkin_date', $this->badge->checkin_date)
                                ->where('checkout_date', $this->badge->checkout_date)->count();

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
    }

    public function closeSelectedBadge(){
        $this->emit('closeSelectedScheduledBadges');
    }

    public function clearBadge(){
        $this->emit('clearbadge');
    }

    public function checkEmail()
    {

        $checkindate = date_format(date_create($this->badge_checkin_date), 'Y-m-d');
        $checkoutdate = date_format(date_create($this->badge_checkout_date), 'Y-m-d');
        $exist_badge = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
            ->whereBetween('checkin_date', [$checkindate, $checkoutdate])
            ->count();
        if (count($this->email_addresses) > 0) {
           
            //foreach($this->email_addresses as $key=>$data){
            $email = end($this->email_addresses);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $email)->role('CONSUMER')->first();
                // dd($user);
                if ($user) {
                    $this->emit('memberSuccessPopup', ['type' => 'member_found', ]);
                } else {
                    $this->emit('memberSuccessPopup', ['type' => 'member_not_found', ]);
                }
            } else {
                $this->emit('memberSuccessPopup', ['type' => 'wrong_email', ]);
            }

            //}

        }
    }

    public function hideSuccessModal(){
        $this->emit('hideSuccessPopup');
    }

    public function sendSelectedBadge()
    {
        $i = 1;
        $exist_email = 0;
        $checkindate = $this->badge_checkin_date;
        $checkoutdate = $this->badge_checkout_date;
        if (count($this->email_addresses) > 0) {
            foreach ($this->email_addresses as $key => $emails) {
                $exist_badge = ShortTermGuestBadge::
                                where([['checkin_date','<',$this->badge_checkin_date],['checkout_date','>',$this->badge_checkin_date]])
                              ->orWhere([['checkin_date','<',$this->badge_checkout_date],['checkout_date','>',$this->badge_checkout_date]])
                              ->orWhere([['checkin_date','<',$this->badge_checkin_date],['checkout_date','>',$this->badge_checkout_date]])
                              ->pluck('guest_email')->toArray();
                
                if(count($exist_badge) > 0){
                    if(in_array($emails, $exist_badge)){
                        $exist_email = $exist_email + 1;
                        $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->badge->listing]);
                        break;
                    }
                    else{
                        $exist_apt_badge = ApartmentGuestBadge::whereHas('badge',function($q) use ($checkindate,$checkoutdate){
                                        $q-> where([['start_date','<',$checkindate],['end_date','>',$checkindate]])
                                        ->orWhere([['start_date','<',$checkoutdate],['end_date','>',$checkoutdate]])
                                        ->orWhere([['start_date','<',$checkindate],['end_date','>',$checkoutdate]]);
                                    })->pluck('guest_email')->toArray();
                        if(count($exist_apt_badge) > 0){
                            if(in_array($emails, $exist_apt_badge)){
                                $exist_email = $exist_email + 1;
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->badge->listing]);
                                break;
                            }
                        }
                    }
                    
                }
                else{
                    
                    $ $exist_apt_badge = ApartmentGuestBadge::whereHas('badge',function($q) use ($checkindate,$checkoutdate){
                                            $q-> where([['start_date','<',$checkindate],['end_date','>',$checkindate]])
                                            ->orWhere([['start_date','<',$checkoutdate],['end_date','>',$checkoutdate]])
                                            ->orWhere([['start_date','<',$checkindate],['end_date','>',$checkoutdate]]);
                                        })->pluck('guest_email')->toArray();
                    if(count($exist_apt_badge) > 0){
                        if(in_array($emails, $exist_apt_badge)){
                            $exist_email = $exist_email + 1;
                            $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->badge->listing]);
                            break;
                        }
                    }
                }
            }
            if($exist_email == 0){
                foreach ($this->email_addresses as $key => $emails) {

                    //dd($emails);
                    if (filter_var($emails, FILTER_VALIDATE_EMAIL)) {
                        $user = User::where('email', $emails)->role('CONSUMER')->first();
                        if ($user) {
                            $exist_badge = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)
                                ->where('checkin_date', $this->badge_checkin_date)
                                ->where('checkout_date', $this->badge_checkout_date)
                                ->where('guest_email', $emails)
                                ->first();
                            if ($exist_badge) {
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->badge->listing]);
                                break;
                            } else {
                                $guest_badge = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)
                                                    ->where('checkin_date', $this->badge_checkin_date)
                                                    ->where('checkout_date', $this->badge_checkout_date)->where('guest_email',null)->orderBy('id','asc')->first();
                                if($guest_badge){
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->guest_id = $user->id;
                                    $guest_badge->save();
                                }
                                else{
                                    $guest_badge = new ShortTermGuestBadge;
                                    $guest_badge->short_term_id = $this->badge->listing->travel_tourism_id;
                                    $guest_badge->listing_id = $this->badge->listing->id;
                                    $guest_badge->guest_id = $user->id;
                                    $guest_badge->checkin_date = $this->badge_checkin_date;
                                    $guest_badge->checkout_date = $this->badge_checkout_date;
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                }
                                
                            }
                        } else {
                            $exist_badge = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)
                                ->where('checkin_date', $this->badge_checkin_date)
                                ->where('checkout_date', $this->badge_checkout_date)
                                ->where('guest_email', $emails)
                                ->first();
                            if ($exist_badge) {
    
                                $this->emit('selectedSuccessPopup', ['text' => $emails . ' is already exist for this badge', 'listing' => $this->badge->listing]);
                                break;
                            } else {
                                $guest_badge = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)
                                                    ->where('checkin_date', $this->badge_checkin_date)
                                                    ->where('checkout_date', $this->badge_checkout_date)->where('guest_email',null)->orderBy('id','asc')->first();
                                if($guest_badge){
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                }
                                else{
                                    $guest_badge = new ShortTermGuestBadge;
                                    $guest_badge->short_term_id = $this->badge->listing->travel_tourism_id;
                                    $guest_badge->listing_id = $this->badge->listing->id;
                                    $guest_badge->checkin_date = $this->badge_checkin_date;
                                    $guest_badge->checkout_date = $this->badge_checkout_date;
                                    $guest_badge->guest_email = $emails;
                                    $guest_badge->save();
                                }
                                
                            }
                        }
    
                        $limit = TravelTourismSettings::where('travel_tourism_id', $this->badge->listing->travel_tourism_id)->first();
                        if ($limit) {
                            $point = $limit->badge_bonus_point;
                        } else {
                            $point = 0;
                        }
                        $arrival_date = date_format(date_create($this->checkin_date), 'm/d/Y');
                        //dd($arrival_date);
                        $details = array(
                            'company_name' => $this->badge->listing->travel_tourism->name,
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
                $this->guest_count = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)->where('checkin_date', $this->badge_checkin_date)->where('checkout_date', $this->badge_checkout_date)->count();
                $this->guests = ShortTermGuestBadge::where('listing_id', $this->badge->listing->id)
                    ->where('guest_email', '!=', null)
                    ->where('checkin_date', $this->badge_checkin_date)
                    ->where('checkout_date', $this->badge_checkout_date)
                    ->get();
                $this->remaining_count = ($this->listing_guests - $this->guest_count);
                $this->keyArr = [];
                if ($i > 1) {
                    $this->email_addresses = [];
                    $this->emit('badgeSent', ['listing' => $this->badge->listing, 'membercount' => $i, 'guest_badge_count' => $this->guest_count, 'text' => 'Invite Sent Successfully', 'key_arr' => $this->keyArr]);
                }
            }
            
        } else {
            $this->emit('selectedSuccessPopup', ['text' => 'Give valid email address', 'listing' => $this->listing]);
        }
    }


    public function addPoint()
    {
        if ($this->badge != '') {
            if ($this->badge->badge_status == 1) {
                $travel_tourism_setting = TravelTourismSettings::where('travel_tourism_id', $this->badge->short_term_id)->first();
                if ($travel_tourism_setting) {
                    if ($travel_tourism_setting->add_point != '') {
                        $travel_tourism = TravelTourism::find($this->badge->short_term_id);
                        if ($travel_tourism_setting->add_point < $travel_tourism->points_to_distribute) {
                            $setting_point = $travel_tourism_setting->add_point;
                            $user = User::find($this->badge->guest_id);
                            //Add point in point table
                            $point = new Point;
                            $point->user_id = $this->badge->guest_id;
                            $point->point = $setting_point;
                            $point->came_from = auth()->user()->id;
                            $point->save();
                            //Add point to user table
                            $userpoint = $user->point;
                            $totalPoint = $userpoint + $setting_point;
                            $user->point =  $totalPoint;
                            $user->save();
                            //Add point to badge table
                            $this->badge->points = $totalPoint;
                            $this->badge->save();

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



    public function guestRecognition()
    {
        $this->points = TravelTourismSettings::where('travel_tourism_id', $this->badge->short_term_id)->first()->guest_of_week_point;
        // dd($this->points);
        $this->emit('guestRecognition');
    }

    public function guestReward()
    {
        //dd($this->shortBadgeStatus);
        if ($this->badge->shortterm->show_guest_recognition == 1) {
            if ($this->guest_reward_value == 'guest_of_the_week') {
                $week_badge_count = ShortTermGuestBadge::where('short_term_id', $this->badge->short_term_id)->where('guest_badge_point_date', '>', Carbon::now()->subDays(7)->format('Y-m-d'))->count();

                $this->guest_success_message = 'Guest of The Week has been awarded to ' . $this->badge->guest->full_name . ' along with ' . $this->points . ' points';
                $this->guest_error_message = 'Reward unavailable. There is a one reward per member per booking limit.';
                if ($week_badge_count > 0) {
                    $this->emit('guestRecognitionError');
                } else {
                    $shortBadgeStatus = ShortTermGuestBadge::find($this->badge->id);
                    $travel_tourism = TravelTourism::find($shortBadgeStatus->short_term_id);

                    /**Add point in point table */
                    $point = new Point();
                    $point->user_id = $shortBadgeStatus->guest_id;
                    $point->point = $this->points;
                    $point->came_from = auth()->user()->id;
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
                $same_family_badges = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
                    ->where(['checkin_date' => $this->badge->checkin_date, 'checkout_date' => $this->badge->checkout_date, 'badge_status' => 1])
                    ->get();

                $already_rewards_count = ShortTermGuestBadge::where('listing_id', $this->badge->listing_id)
                    ->where(['checkin_date' => $this->badge->checkin_date, 'checkout_date' => $this->badge->checkout_date])
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
                        $point->came_from = auth()->user()->id;
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
        return view('livewire.frontend.travel-tourism.short-term-rental.consumer-profile');
    }
}
