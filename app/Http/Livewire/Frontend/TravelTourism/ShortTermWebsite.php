<?php

namespace App\Http\Livewire\Frontend\TravelTourism;

use Livewire\Component;
use App\Models\TravelTourism;
use App\Models\ShortTermRentalListing;
use App\Models\ProviderExternalManage;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\RequestInfoForListing;
use Illuminate\Support\Facades\Mail;
use App\Mail\BadgeRequestInfoMail;
use App\Models\TravelTourismFormSubmitAddress;
use App\Mail\ShareListingByEmail;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ProviderAmenity;
use Illuminate\Validation\Rule;
use App\Models\ProviderFeature;
use App\Models\ShortTermGuestBadge;
use App\Models\TravelTourismSettings;
use App\Rules\MultipleEmails;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class ShortTermWebsite extends Component
{
    use AlertMessage;
    public $short_term_id, $short_rental, $travel_tourism, $external_manage;
    public $defaultTab = true, $bookOnlineTab = false, $requestInfotab = false, $guestPortalTab = false, $locationTab = false, $directWebsite = false;
    public $listing_id, $guest_name, $guest_email, $guest_phone, $arrive_date, $departure_date, $adult, $children, $is_flexible, $comment;
    public $request_info, $emails, $mail_address = [];
    public $another_listings = [];
    public $shareComponent, $encrypt_id;
    public $guest_email_address;
    public $amenities = [];
    public $features = [], $badges = [], $badge_dates = [];
    public $remaining_guest = 0;
    public $booking_first_name, $booking_last_name, $booking_email, $booking_phone, $booking_checkin_date, $booking_checkout_date, $bookig_listing_name;
    public $name, $email, $r_emails, $message, $features_lists, $amenities_lists, $encryptid,$badge_bonus_point;

    // Protected $listeners = ['openForm'];

    public function mount($short_term_id)
    {
        if ($short_term_id) {
            $this->short_term_id = $short_term_id;
        }
        $this->encrypt_id = base64_encode($this->short_term_id);
        $this->short_rental = ShortTermRentalListing::find($this->short_term_id);
        $travel_id = $this->short_rental->travel_tourism_id;
        $this->travel_tourism = TravelTourism::with('listing')->find($travel_id);
        $this->external_manage = ProviderExternalManage::where('listing_id', $this->short_term_id)->first();
        $this->features_lists = ProviderFeature::where('listing_id', $this->short_term_id)->get()->pluck('feature_text')->toArray();
        $this->amenities_lists = ProviderAmenity::where('listing_id', $this->short_term_id)->get()->pluck('amenity_text')->toArray();
        $this->encryptid = base64_encode($short_term_id);
        $setting = TravelTourismSettings::where('travel_tourism_id',$travel_id)->first();
        if($setting){
            $this->badge_bonus_point = $setting->badge_bonus_point;

        }
        else{
            $this->badge_bonus_point = '';
        }
        

        $this->listing_id = $short_term_id;
        if ($this->external_manage) {
            $this->emails = TravelTourismFormSubmitAddress::where('listing_id', $this->short_term_id)->first();
        } else {
            $this->emails = '';
        }
        $today = date('Y-m-d');
        $this->amenities = ProviderAmenity::where('listing_id', $this->short_term_id)->get();
        $this->features = ProviderFeature::where('listing_id', $this->short_term_id)->get();
        $this->badges = ShortTermGuestBadge::where('listing_id', $this->short_term_id)
            ->groupBy('checkin_date')
            ->where('checkout_date', '>', $today)
            ->where('checkin_date', '<=', $today)
            ->get();
        

            
        if (count($this->badges) > 0) {
            foreach ($this->badges as $badgedata) {
                //dd($badgedata->checkin_time);           
                if($badgedata->checkin_time != null){
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

                if($badgedata->checkin_date == $today){
                    if($est_time < $chkin_time){
                        $guests = 0;
                    }else{
                        $guests = ShortTermGuestBadge::where('listing_id', $this->short_term_id)
                            ->where('checkin_date', $badgedata->checkin_date)
                            ->where('checkout_date', $badgedata->checkout_date)
                            ->count();
                    }
                }else{
                    $guests = ShortTermGuestBadge::where('listing_id', $this->short_term_id)
                            ->where('checkin_date', $badgedata->checkin_date)
                            ->where('checkout_date', $badgedata->checkout_date)
                            ->count();
                }

                // $guests = ShortTermGuestBadge::where('listing_id', $this->short_term_id)
                //     ->where('checkin_date', $badgedata->checkin_date)
                //     ->where('checkout_date', $badgedata->checkout_date)
                //     ->get();
                //dd($guests);
                if ($guests > 0) {
                    if ($guests == $this->short_rental->no_of_guests) {
                    } elseif ($guests < $this->short_rental->no_of_guests) {
                        $this->badge_dates[] = array('start_date' => date_format(date_create($badgedata->checkin_date), 'm/d/Y'), 'end_date' => date_format(date_create($badgedata->checkout_date), 'm/d/Y'), 'id' => $badgedata->id);
                    } else {
                        $this->badge_dates[] = array('start_date' => $badgedata->checkin_date, 'end_date' => $badgedata->checkout_date, 'id' => $badgedata->id);
                    }
                } else {
                    $this->remaining_guest = 0;
                }
            }
        }
        // if(count($guests) > 0){
        //     if(count($guests) == $listing->no_of_guests){
        //         $remaining_guest = 0;
        //     }
        //     elseif(count($guests) < $listing->no_of_guests){
        //         $remaining_guest = $listing->no_of_guests - count($guests);
        //     }
        //     else{
        //         $remaining_guest =  $listing->no_of_guests;
        //     }
        // }

    }

    public function showHome()
    {
        $this->defaultTab = true;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->guestPortalTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showBookOnline()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = true;
        $this->requestInfotab = false;
        $this->guestPortalTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showRequestInfo()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = true;
        $this->guestPortalTab = false;
        $this->locationTab = false;
        $this->directWebsite = false;
        $this->emit('openSelect2');
    }

    public function showGuestPortal()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->guestPortalTab = true;
        $this->locationTab = false;
        $this->directWebsite = false;
    }

    public function showLocation()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->guestPortalTab = false;
        $this->locationTab = true;
        $this->directWebsite = false;
        $this->emit('openLocation');
    }

    public function showDirectWebsite()
    {
        $this->defaultTab = false;
        $this->bookOnlineTab = false;
        $this->requestInfotab = false;
        $this->guestPortalTab = false;
        $this->locationTab = false;
        $this->directWebsite = true;
    }

    public function sendRequestForListing()
    {
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
        $this->request_info->short_term_id = $this->short_rental->travel_tourism_id;
        $this->request_info->listing_id = $this->short_term_id;
        $this->request_info->save();
        $this->request_info->name = $this->short_rental->name;
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

    public function saveList($id)
    {


        if (Auth::check()) {
            if (Auth::user()->hasRole('CONSUMER')) {
                $short_term = ShortTermRentalListing::find($id);
                if (ConsumerFavouriteTravelTourism::where('consumer_id', auth()->user()->id)
                    ->where('travel_tourism_id', $short_term->travel_tourism_id)
                    ->where('short_rental_id', $id)->exists()
                ) {
                    ConsumerFavouriteTravelTourism::where('consumer_id', auth()->user()->id)
                        ->where('travel_tourism_id', $short_term->travel_tourism_id)
                        ->where('short_rental_id', $id)->delete();
                    $this->emit(
                        'successPopup',
                        ['message' => 'Remove from favorite']
                    );
                } else {
                    $favourite = new ConsumerFavouriteTravelTourism;
                    $favourite->consumer_id = auth()->user()->id;
                    $favourite->travel_tourism_id = $short_term->travel_tourism_id;
                    $favourite->short_rental_id = $id;
                    $favourite->is_favourite = true;
                    $favourite->save();
                    $this->emit(
                        'successPopup',
                        ['message' => 'Added into favorite']
                    );
                }
            } else {
                $this->emit(
                    'loginMessagePopup',
                    ['message' => 'Please login as consumer before adding as Favorite.']
                );
            }
        } else {
            $this->emit(
                'loginMessagePopup',
                ['message' => 'Please login before adding as Favorite.']
            );
        }
    }

    public function loginForFavorite()
    {
        $this->emit('favoriteLogin', ['id' => base64_encode($this->short_term_id)]);
    }

    public function sharePage()
    {

        $this->emit('shareListingDetail');
    }

    public function copyPageLink()
    {
        $link = url('/short-term-rental-website/' . $this->encrypt_id);
        $this->emit('copy_page_link', ['link' => $link]);
    }

    public function mailBox()
    {
        $this->emit('mail_box');
    }

    public function shareByEmail()
    {
        $mail_data = [
            'listing_name' => $this->short_rental->name,
            'travel_tourism_name'=>$this->travel_tourism->name,
            'city' => $this->short_rental->city,
            'state' => $this->short_rental->states->name,
            'type' => $this->short_rental->type->name,
            'bedroom' => $this->short_rental->no_of_bedrooms,
            'bathroom' => $this->short_rental->no_of_baths,
            'guests' => $this->short_rental->no_of_guests,
            'main_image' => $this->short_rental->main_img,
            'short_term_logo' => $this->travel_tourism->short_term_logo,
            'encrypt_id' => $this->encryptid,
            'url' => url('/short-term-rental-website/' . $this->encryptid),
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
            Mail::to($email)->queue(new ShareListingByEmail($mail_data,$email));
        }
        if (!Mail::failures()) {
            $this->emit(
                'mailSuccess',
                ['message' => 'Short term listing shared by email successfully.']
            );
        }
    }

    public function moreListings()
    {
        $travel_id = $this->short_rental->travel_tourism_id;
        $this->another_listings = ShortTermRentalListing::where('travel_tourism_id', $travel_id)->whereNotIn('id', [$this->short_term_id])->get();
        // dd($this->another_listings);
    }

    public function showFeature()
    {
        $this->emit('showListingFeature');
    }

    public function showAmenity()
    {
        $this->emit('showListingAmenity');
    }

    public function listingBooking()
    {
        //dd($this->booking_first_name);
        $this->validate(
            [
                'booking_first_name' => ['required'],
                'booking_last_name' => ['required'],
                'booking_email' => ['required', 'email', Rule::unique('users', 'email')],
                'booking_phone' => ['required', Rule::unique('users', 'phone'), 'regex:/^\+(?:[0-9] ?){6,14}[0-9]$/'],
                'booking_checkin_date' => ['required'],
                'booking_checkout_date' => ['required', 'gt:booking_checkin_date'],

            ],
            [
                'booking_first_name.required' => "The first name field is required",
                'booking_last_name.required' => "The last name field is required",
                'booking_email.required' => "The email field is required",
                'booking_phone.required' => "The phone field is required",
            ]
        );
    }

    public function render()
    {
        // if(session()->has('listingid')){
        //     //dd(session()->get('listing_name'));
        //     $this->bookig_listing_name = session()->get('listing_name');
        //     $this->emit('openForm');
        // }
        return view('livewire.frontend.travel-tourism.short-term-website');
    }
}
