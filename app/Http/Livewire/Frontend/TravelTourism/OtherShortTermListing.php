<?php

namespace App\Http\Livewire\Frontend\TravelTourism;

use App\Mail\ShareListingByEmail;
use App\Models\ListingType;
use App\Models\ProviderMessageBoard;
use App\Models\ShortTermRentalListing;
use App\Models\State;
use App\Models\TravelTourism;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ProviderAmenity;
use App\Models\ProviderFeature;
use App\Models\TravelTourismSettings;
use App\Rules\MultipleEmails;
use Illuminate\Support\Facades\Log;

class OtherShortTermListing extends Component
{
    public $travel_short_term_id, $short_rental, $travel_tourism, $another_listings, $message_board, $listType = [], $guest = [], $searchByType, $searchByguest, $searchListName, $listingforSearch, $stateList, $searchByLocation, $travel_short;
    public $encrypt_id, $guest_email_address, $listing_states = [];
    public $rental_listing, $encryptid;
    public $name, $email, $r_emails, $message, $features_lists, $amenities_lists, $badge_bonus_point;


    public function mount($travel_short_term_id)
    {
        if ($travel_short_term_id) {

            $this->encrypt_id = base64_encode($this->travel_short_term_id);
            $this->encryptid = base64_encode($this->travel_short_term_id);
            $this->travel_short_term_id = $travel_short_term_id;
            $this->travel_tourism = TravelTourism::find($this->travel_short_term_id);

            // $this->short_rental = ShortTermRentalListing::find($this->short_term_list_id);
            $travel_id = $this->travel_tourism->id;

            $this->short_rental = ShortTermRentalListing::find($this->travel_short_term_id);
            $this->features_lists = ProviderFeature::where('listing_id', $this->travel_short_term_id)->get()->pluck('feature_text')->toArray();
            $this->amenities_lists = ProviderAmenity::where('listing_id', $this->travel_short_term_id)->get()->pluck('amenity_text')->toArray();

            $this->another_listings = ShortTermRentalListing::where('travel_tourism_id', $travel_id)->where('status', 1)->get();

            $this->listingforSearch = ShortTermRentalListing::where('travel_tourism_id', $travel_id)->where('status', 1)->get();

            $this->message_board = ProviderMessageBoard::with('messageBoard', 'messageBoardtwo')->where('status', 1)->where('travel_tourism_id', $travel_id)->where('provider_type', 'for_short_term_rental')->first();

            // $this->stateList = State::all();
            $this->listing_states[] = TravelTourism::with(['listing' => function ($q) {
                $q->where('status', 1)->groupBy('state_id');
            }])->where("travel_tourism_type", 'Short Rental')->get();

            $this->listing_states[] = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->groupBy('state_id')->get();

            $this->listType = ListingType::where('status', 1)->get();
            $this->badge_bonus_point = TravelTourismSettings::find($travel_short_term_id)->badge_bonus_point;
        }
    }

    public function searchListing()
    {
        $this->searchListName = "";

        $shortList = ShortTermRentalListing::query();
        if ($this->searchByType) {
            $shortList = $shortList->whereHas('type', function ($q) {
                $q->Where("type_id", $this->searchByType);
            });
        }
        if ($this->searchByguest) {
            if ($this->searchByguest != '10+') {
                $shortList->Where('no_of_guests', $this->searchByguest);
            } else {
                $shortList->Where('no_of_guests', '>', 10);
            }
        }

        if ($this->searchByLocation) {
            $shortList = $shortList->whereHas('states', function ($q) {
                $q->Where("state_id", $this->searchByLocation);
            });
        }

        $this->another_listings = $shortList->where('travel_tourism_id', $this->travel_tourism->id)->where('status', 1)->get();
        $this->emit('imageslick');
    }

    public function searchByListing()
    {
        $this->searchByType = "";
        $this->searchByguest = "";
        $this->searchByLocation = "";

        $shortList = ShortTermRentalListing::query();
        if ($this->searchListName) {
            $shortList->Where('name', $this->searchListName);
        }
        $this->another_listings = $shortList->where('travel_tourism_id', $this->travel_tourism->id)->where('status', 1)->get();
        $this->emit('imageslick');
    }

    public function copyPageLink()
    {
        $link = url('/other-short-term-rental-listing/' . $this->encrypt_id);
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
            'travel_tourism_name' => $this->travel_tourism->name,
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
                'message' => ['required', 'max:500'],
            ],
            ['r_emails.required' => 'This field is required.']
        );
        $emails = preg_split('/[,\s]+/', $this->r_emails);
        $emails = array_filter($emails);

        // $details = array('link' => url('/short-term-rental-website/' . $this->encrypt_id), 'short_term' => $this->short_rental->name);
        // Mail::to($this->guest_email_address)->send(new ShareListingByEmail($details));


        foreach ($emails as $key => $email) {
            Mail::to($email)->queue(new ShareListingByEmail($mail_data, $email));
        }
        if (!Mail::failures()) {
            $this->emit(
                'mailSuccess',
                ['message' => 'Short term listing shared by email successfully.']
            );
        }
    }

    public function shareListing($id)
    {
        $this->rental_listing = ShortTermRentalListing::find($id);
        $this->encryptid = base64_encode($id);
        $this->emit('shareOnSocialMedia', [
            'listing_name' => $this->rental_listing->name,
            'city' => $this->rental_listing->city,
            'state' => $this->rental_listing->states->name,
            'type' => $this->rental_listing->type->name,
            'bedroom' => $this->rental_listing->no_of_bedrooms,
            'bathroom' => $this->rental_listing->no_of_baths,
            'main_image' => $this->rental_listing->main_img,
            'encrypt_id' => $this->encryptid,
            'url' => url('/short-term-rental-website/' . $this->encryptid),
        ]);
    }

    public function listingMailBox()
    {
        $this->emit('listing_mail_box', [
            'listing_name' => $this->rental_listing->name,
            'city' => $this->rental_listing->city,
            'state' => $this->rental_listing->states->name,
            'type' => $this->rental_listing->type->name,
            'bedroom' => $this->rental_listing->no_of_bedrooms,
            'bathroom' => $this->rental_listing->no_of_baths,
            'main_image' => $this->rental_listing->main_img,
            'encrypt_id' => $this->encryptid,
            'url' => url('/short-term-rental-website/' . $this->encryptid),
        ]);
    }

    public function shareListingByEmail()
    {
        $this->validate(
            [
                'guest_email_address' => ['required', 'email'],
            ],
            [
                'guest_email_address.required' => "The Email Address field is required",
                'guest_email_address.email' => "The Email Address should be valid",
            ]
        );
        $details = array('link' => url('/short-term-rental-website/' . $this->encryptid), 'short_term' => $this->rental_listing->name);
        Mail::to($this->guest_email_address)->queue(new ShareListingByEmail($details));
        if (!Mail::failures()) {
            $this->emit(
                'mailSuccess',
                ['message' => 'Short term listing shared by email successfully.']
            );
        }
    }


    public function saveList($id, $type)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('CONSUMER')) {
                if ($type == 'short_term_type') {
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
                        $this->emit('imageslick');
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
                        $this->emit('imageslick');
                    }
                } elseif ($type == 'travel_type') {
                    $short_term = TravelTourism::find($id);
                    if (ConsumerFavouriteTravelTourism::where('consumer_id', auth()->user()->id)
                        ->where('travel_tourism_id', $id)->where('short_rental_id', null)->exists()
                    ) {
                        ConsumerFavouriteTravelTourism::where('consumer_id', auth()->user()->id)
                            ->where('travel_tourism_id', $id)->where('short_rental_id', null)->delete();
                        $this->emit(
                            'successPopup',
                            ['message' => 'Remove from favorite']
                        );
                        $this->emit('imageslick');
                    } else {
                        $favourite = new ConsumerFavouriteTravelTourism;
                        $favourite->consumer_id = auth()->user()->id;
                        $favourite->travel_tourism_id = $id;
                        $favourite->is_favourite = true;
                        $favourite->save();
                        $this->emit(
                            'successPopup',
                            ['message' => 'Added into favorite']
                        );
                        $this->emit('imageslick');
                    }
                }
            } else {
                $this->emit(
                    'loginMessagePopup',
                    ['message' => 'Please login as consumer before adding as Favorite.']
                );
                $this->emit('imageslick');
            }
        } else {
            $this->emit(
                'loginMessagePopup',
                ['message' => 'Please login before adding as Favorite.']
            );
            $this->emit('imageslick');
        }
    }

    public function loginForFavorite()
    {
        $this->emit('favoriteLogin');
    }


    public function render()
    {
        return view('livewire.frontend.travel-tourism.other-short-term-listing');
    }
}
