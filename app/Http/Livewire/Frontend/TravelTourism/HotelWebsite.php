<?php

namespace App\Http\Livewire\Frontend\TravelTourism;

use Livewire\Component;
use App\Models\TravelTourism;
use App\Models\ProviderExternalManage;
use App\Models\ProviderFeature;
use App\Models\ProviderAmenity;
use App\Rules\MultipleEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShareHotelByEmail;
use App\Models\RequestInfoForListing;
use App\Mail\BadgeRequestInfoMail;
use App\Models\TravelTourismFormSubmitAddress;
use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class HotelWebsite extends Component
{
    public $travel_tourism, $external_manage, $encrypt_id, $features=[], $amenities=[], $emails, $mail_address=[];
    public $defaultTab = true, $bookOnlineTab = false, $requestInfotab = false, $contactTab = false, $locationTab = false, $directWebsite = false;
    public $name,$email,$r_emails,$message, $features_lists,$amenities_lists;
    public $guest_name,$guest_email,$guest_phone,$arrive_date,$departure_date,$adult,$children,$is_flexible,$comment, $request_info;
    public $badges = [], $badge_dates = [];

    // public function mount($hotelid,$unitid){
    public function mount($hotelid){
        // dd($hotelid,$unitid);
        $this->travel_tourism = TravelTourism::find($hotelid);
        $this->external_manage = ProviderExternalManage::where('travel_tourism_id',$hotelid)->first();
        $this->encrypt_id = base64_encode($hotelid);
        $this->features = ProviderFeature::where('travel_tourism_id', $hotelid)->get();
        $this->amenities = ProviderAmenity::where('travel_tourism_id', $hotelid)->get();
        $this->features_lists = ProviderFeature::where('travel_tourism_id', $hotelid)->get()->pluck('feature_text')->toArray();
        $this->amenities_lists = ProviderAmenity::where('travel_tourism_id', $hotelid)->get()->pluck('amenity_text')->toArray();
        if ($this->external_manage) {
            $this->emails = TravelTourismFormSubmitAddress::where('travel_tourism_id', $hotelid)->first();
        } else {
            $this->emails = '';
        }
        $today = date('Y-m-d');
        $unit_ids = [];
        $this->features = ProviderFeature::where('listing_id', $hotelid)->get();
        $badges = HotelUnites::select('id')->where('hotel_id',$hotelid)->get();
        foreach($badges as $badge){
            $unit_ids[] = $badge->id;
        }
        // if($unitid){
        //     $this->badges = HotelBadges::where('unit_id',$unitid)
        //     ->where('end_date', '>', $today)
        //     ->where('start_date', '<=', $today)
        //     ->get();
        // }else{
            $this->badges = HotelBadges::whereIn('unit_id',$unit_ids)
            ->where('end_date', '>', $today)
            ->where('start_date', '<=', $today)
            ->get();
        // }
        
        
        // dd($this->badges);
        if (count($this->badges) > 0) {
            foreach ($this->badges as $badgedata) {
                //dd($badgedata->checkin_time);           
                if($badgedata->start_date != null){
                    $chkin_time = $badgedata->checkin_time;
                }else{
                    $chkin_time = '00:00:01';
                }

                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toDateTimeString();
                $datetime_utc = new DateTime($formattedTime, new DateTimeZone('UTC'));
                $datetime_utc->setTimezone(new DateTimeZone('America/New_York'));
                $timestamp_in_est = $datetime_utc->format('Y-m-d H:i:s');
                $est_time = $datetime_utc->format('H:i:s');
                // dd( $est_time,$chkin_time);
                if($badgedata->start_date == $today){
                    if($est_time < $chkin_time){
                        $guests = 0;
                    }else{
                        $guests = HotelGuestBadges::where('badges_id', $badgedata->id)
                            ->count();
                        
                    }
                }else{
                    $guests = HotelGuestBadges::where('badges_id', $badgedata->id)
                            ->count();
                }
                // dd($guests);
                // if ($guests > 0) {
                    if ($guests == 10) {
                    } elseif ($guests < 10) {
                        $this->badge_dates[] = array('start_date' => date_format(date_create($badgedata->start_date), 'm/d/Y'), 'end_date' => date_format(date_create($badgedata->end_date), 'm/d/Y'), 'id' => $badgedata->id);
                    } else {
                        $this->badge_dates[] = array('start_date' => $badgedata->start_date, 'end_date' => $badgedata->end_date, 'id' => $badgedata->id);
                    }
                // } else {
                //     $this->remaining_guest = 0;
                // }

            }
        }

        // dd($this->badge_dates);
    }

    public function showHome()
    {
        $this->defaultTab = true;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->contactTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showBookOnline(){
        $this->defaultTab = false;
        $this->bookOnlineTab = true;
        $this->requestInfotab = false;
        $this->contactTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showContact(){
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->contactTab = true;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showRequestInfo(){
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = true;
        $this->contactTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
        $this->emit('openSelect2');
    }

    public function showLocation()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->contactTab = false;
        $this->locationTab = true;
        $this->directWebsite = false;
        $this->emit('openLocation');
    }
    public function showDirectWebsite()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->contactTab = false;
        $this->locationTab = false;
        $this->directWebsite = true;
    }
    public function showFeature()
    {
        $this->emit('showListingFeature');
    }
    public function showAmenity()
    {
        $this->emit('showListingAmenity');
    }

    public function sharePage()
    {

        $this->emit('shareListingDetail');
    }

    public function copyPageLink()
    {
        $link = url('/hotel-resort/' . $this->encrypt_id);
        $this->emit('copy_page_link', ['link' => $link]);
    }

    public function mailBox()
    {
        $this->emit('mail_box');
    }

    public function shareByEmail()
    {
        
        $mail_data = [
            'hotel_name'=>$this->travel_tourism->name,
            'address' => $this->travel_tourism->address,
            'main_image' => url($this->travel_tourism->image),
            'hotel_logo' => $this->travel_tourism->hotel_image,
            'encrypt_id' => $this->encrypt_id,
            'url' => url('/hotel-resort/' . $this->encrypt_id),
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'features' => implode(", ", $this->features_lists),
            'amenities' => implode(", ", $this->amenities_lists)
        ];

        $this->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'max:255', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
                'r_emails' => ['required', 'max:255', new MultipleEmails],
                'message' => ['nullable', 'max:500'],
            ],
            ['r_emails.required' => 'This field is required.']
        );
        $emails = preg_split('/[,\s]+/', $this->r_emails);
        $emails = array_filter($emails);

        // $details = array('link' => url('/short-term-rental-website/' . $this->encrypt_id), 'short_term' => $this->short_rental->name);
        // Mail::to($this->guest_email_address)->send(new ShareListingByEmail($details));


        foreach ($emails as $key => $email) {
            Mail::to($email)->queue(new ShareHotelByEmail($mail_data,$email));
        }
        if (!Mail::failures()) {
            $this->emit(
                'mailSuccess',
                ['message' => 'Hotel-resort shared by email successfully.']
            );
        }
    }

    public function sendRequestForListing(){
        // $this->listing_id = $this->short_term_id;
        $this->emit('openSelect2');
        // dd($this->departure_date);
        $this->validate(
            [
                'guest_name' => ['required'],
                'guest_email' => ['required', 'email'],
                'guest_phone' => ['required'],
                'arrive_date' => ['required', 'date', 'before:departure_date'],
                'departure_date' => ['required', 'date', 'after:arrive_date'],
                'adult' => ['nullable', 'numeric', 'max:99'],
                'children' => ['nullable', 'numeric', 'max:99'],
                'is_flexible' => ['nullable'],
                'comment' => ['nullable'],
            ],
            [
                'guest_name.required' => "The name field is required",
                'guest_email.required' => "The email field is required",
                'guest_phone.required' => "The phone field is required",
            ]
        );
        $this->request_info = new RequestInfoForListing;
        $this->request_info->guest_name = $this->guest_name;
        $this->request_info->guest_email = $this->guest_email;
        $this->request_info->guest_phone = $this->guest_phone;
        $this->request_info->arrive_date = $this->arrive_date;
        $this->request_info->departure_date = $this->departure_date;
        $this->request_info->adult = $this->adult;
        $this->request_info->children = $this->children;
        if ($this->is_flexible != '') {
            $this->request_info->is_flexible = $this->is_flexible;
        }

        $this->request_info->comment = $this->comment;
        $this->request_info->short_term_id = $this->travel_tourism->id;
        $this->request_info->save();
        $this->request_info->name = $this->travel_tourism->name;
        if ($this->emails) {
            if ($this->emails->first_email_address != null) {
                array_push($this->mail_address, $this->emails->first_email_address);
            }
            if ($this->emails->second_email_address != null) {
                array_push($this->mail_address, $this->emails->second_email_address);
            }
            if ($this->emails->third_email_address != null) {
                array_push($this->mail_address, $this->emails->third_email_address);
            }
            if ($this->emails->fourth_email_address != null) {
                array_push($this->mail_address, $this->emails->fourth_email_address);
            }
            if ($this->emails->fifth_email_address != null) {
                array_push($this->mail_address, $this->emails->fifth_email_address);
            }
            //dd($this->mail_address);
            if (count($this->mail_address) > 0) {
                Mail::to($this->mail_address)->bcc('brandon.hill@gimmzi.com')->queue(new BadgeRequestInfoMail($this->request_info));
                if (!Mail::failures()) {
                    $this->emit(
                        'mailSuccess',
                        ['message' => 'Your Request for Info form has been submitted successfully. ' . $this->travel_tourism->name . ' will reach out to you soon.']
                    );
                }
            } else {
                Mail::to('brandon.hill@gimmzi.com')->queue(new BadgeRequestInfoMail($this->request_info));
                if (!Mail::failures()) {
                    $this->emit(
                        'mailSuccess',
                        ['message' => 'Your Request for Info form has been submitted successfully. ' . $this->travel_tourism->name . ' will reach out to you soon.']
                    );
                }
            }
        } else {
            Mail::to('brandon.hill@gimmzi.com')->queue(new BadgeRequestInfoMail($this->request_info));
            if (!Mail::failures()) {
                $this->emit(
                    'mailSuccess',
                    ['message' => 'Your Request for Info form has been submitted successfully. ' . $this->travel_tourism->name . ' will reach out to you soon.']
                );
            }
        }
    }

    public function render()
    {
        return view('livewire.frontend.travel-tourism.hotel-website');
    }
}
