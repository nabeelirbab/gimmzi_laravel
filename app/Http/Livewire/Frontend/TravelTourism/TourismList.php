<?php

namespace App\Http\Livewire\Frontend\TravelTourism;

use App\Http\Livewire\Traits\AlertMessage;
use Livewire\Component;
use App\Models\TravelTourism;
use App\Models\ListingType;
use App\Models\ShortTermRentalListing;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShareListingByEmail;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\ProviderAmenity;
use App\Models\ProviderFeature;
use App\Rules\MultipleEmails;

class TourismList extends Component
{
    public $travels, $types, $search_travel_tourism;
    public $showdiv = false, $result = [], $type_ids = [], $state_travels = [], $listing_states = [];
    public $encryptid, $rental_listing, $stateList;
    public $guest_email_address, $searchByLocation;

    public $name, $email, $r_emails, $message, $features, $amenities, $travel_tourism;

    use AlertMessage;
    public function mount()
    {
        $this->state_travels[] = TravelTourism::with(['listing' => function ($q) {
            $q->where('status', 1);
        }])->where("travel_tourism_type", 'Short Rental')->get();

        $this->state_travels[] = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->get();

        $this->listing_states[] = TravelTourism::with(['listing' => function ($q) {
            $q->where('status', 1)->groupBy('state_id');
        }])->where("travel_tourism_type", 'Short Rental')->get();

        $this->listing_states[] = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->groupBy('state_id')->get();

        $this->travels = [];
        $this->types = ListingType::where('status', 1)->get();
        // $this->type_ids =ListingType::where('status', 1)->pluck('id');
        // dd($this->type_ids);
        $this->stateList = State::all();
    }

    public function autocompleteTravelTourism()
    {
        //dd($this->search_travel_tourism);
        if (!empty($this->search_travel_tourism)) {
            if ($this->search_travel_tourism != null) {
                $this->result = [];
                $travelData = TravelTourism::where('name', 'like', '%' . trim($this->search_travel_tourism) . '%')
                    ->where('status', 1)
                    ->where('travel_tourism_type', 'Hotel-Resort')
                    ->orderBy('id', 'desc')
                    ->get();
                if (count($travelData)) {
                    foreach ($travelData as $data) {
                        $type = "hotel";
                        $this->result[] = array('id' => $data->id, 'name' => $data->name, 'type' => $type);
                    }
                }

                $shorttermData = ShortTermRentalListing::where('name', 'like', '%' . trim($this->search_travel_tourism) . '%')
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
                if (count($shorttermData)) {
                    foreach ($shorttermData as $rental_data) {
                        $type = "shortterm";
                        $this->result[] = array('id' => $rental_data->id, 'name' => $rental_data->name, 'type' => $type);
                    }
                }
                //dd($this->result);
                $this->showdiv = true;
            } else {
                $this->result = [];
                $this->showdiv = false;
            }
        } else {
            $this->travels = TravelTourism::with('listing')->where('status', 1)->get();
            $this->result = [];
            $this->showdiv = false;
        }
        $this->emit('imageslick');
    }

    public function selectType($typeid)
    {
        $this->search_travel_tourism = '';
        $this->searchByLocation = '';
        if (count($this->type_ids) > 0) {
            if (($key = array_search($typeid, $this->type_ids)) !== false) {
                unset($this->type_ids[$key]);
            } else {
                $this->type_ids[] = $typeid;
            }
        } else {
            $this->type_ids[] = $typeid;
        }

        $this->state_travels = [];
        $types = $this->type_ids;

        if (count($types) > 0) {

            $this->state_travels[] = TravelTourism::with(['listing' => function ($q) use ($types) {
                $q->whereNotIn('type_id', $types)->where('status', 1);
            }])->where("travel_tourism_type", 'Short Rental')->get();
            // dd($this->state_travels);
        } else {

            $this->state_travels[] = TravelTourism::with(['listing' => function ($q) {
                $q->where('status', 1);
            }])->where("travel_tourism_type", 'Short Rental')->get();
            $this->state_travels[] = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->get();
        }


        $this->emit('imageslick');
    }

    public function filterTravelTourism($id, $traveltype)
    {
        $this->type_ids = [];
        $this->search_travel_tourism = '';
        $this->searchByLocation = '';
        if ($traveltype == 'shortterm') {
            $this->state_travels = [];
            $listing = ShortTermRentalListing::find($id);
            if ($listing) {
                $travel_id = $listing->travel_tourism_id;
                $this->search_travel_tourism = $listing->name;

                $this->state_travels[] = TravelTourism::with(['listing' => function ($q) use ($id) {
                    $q->where('status', 1)->where('id', '=', $id);
                }])->Where("travel_tourism_type", 'Short Rental')->get();

                // $this->travels = TravelTourism::where('id', $travel_id)->with(['listing' => function ($q) use ($id) {
                //     $q->where('id', '=', $id);
                // }])->get();
            }
            $this->showdiv = false;
        } else {
            $this->state_travels = [];
            $travel = TravelTourism::find($id);
            if ($travel) {
                $this->search_travel_tourism = $travel->name;
                $this->state_travels[] = TravelTourism::where('id', $id)->get();
            }
            $this->showdiv = false;
        }
        $this->emit('imageslick');
    }

    public function shareListing($id)
    {
        $this->rental_listing = ShortTermRentalListing::find($id);

        $this->features = ProviderFeature::where('listing_id', $id)->get()->pluck('feature_text')->toArray();
        $this->amenities = ProviderAmenity::where('listing_id', $id)->get()->pluck('amenity_text')->toArray();

        $travel_id = $this->rental_listing->travel_tourism_id;
        $this->travel_tourism = TravelTourism::with('listing')->find($travel_id);
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

    public function copyPageLink()
    {
        $link = url('/short-term-rental-website/' . $this->encrypt_id);
        $this->emit('copy_page_link', ['link' => $link]);
    }

    public function mailBox()
    {
        $this->emit('mail_box', [
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

    public function shareByEmail()
    {
        $mail_data = [
            'listing_name' => $this->rental_listing->name,
            'travel_tourism_name'=>$this->travel_tourism->name,
            'city' => $this->rental_listing->city,
            'state' => $this->rental_listing->states->name,
            'type' => $this->rental_listing->type->name,
            'bedroom' => $this->rental_listing->no_of_bedrooms,
            'bathroom' => $this->rental_listing->no_of_baths,
            'guests' => $this->rental_listing->no_of_guests,
            'main_image' => $this->rental_listing->main_img,
            'short_term_logo' => $this->travel_tourism->short_term_logo,
            'encrypt_id' => $this->encryptid,
            'url' => url('/short-term-rental-website/' . $this->encryptid),
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'features' => implode(", ", $this->features),
            'amenities' => implode(", ", $this->amenities)
        ];   


        $this->emit('mail_box', [
            'listing_name' => $this->rental_listing->name,
            'city' => $this->rental_listing->city,
            'state' => $this->rental_listing->states->name,
            'type' => $this->rental_listing->type->name,
            'bedroom' => $this->rental_listing->no_of_bedrooms,
            'bathroom' => $this->rental_listing->no_of_baths,
            'guests' => $this->rental_listing->no_of_guests,
            'main_image' => $this->rental_listing->main_img,
            'short_term_logo' => $this->rental_listing->short_term_logo,
            'encrypt_id' => $this->encryptid,
            'url' => url('/short-term-rental-website/' . $this->encryptid),
        ]);



        $this->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'max:255', 'email', 'regex:/(.+)@(.+)\.(.+)/i'],
                'r_emails' => ['required', 'max:255', new MultipleEmails],
                'message' => ['nullable', 'max:255'],
            ],
            ['r_emails.required' => 'This field is required.']
        );
        $emails = preg_split('/[,\s]+/', $this->r_emails);
        $emails = array_filter($emails);

        // $details = array('link' => url('/short-term-rental-website/' . $this->encryptid), 'short_term' => $this->rental_listing->name);

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

    public function searchListByLocation()
    {
        // dd($this->searchByLocation);
        $this->type_ids = [];
        $this->search_travel_tourism = '';
        if (!empty($this->searchByLocation)) {
            $location = $this->searchByLocation;


            $this->state_travels = [];


            $this->state_travels[] = TravelTourism::with(['listing' => function ($q) use ($location) {
                $q->where('state_id', $location);
            }])->Where("travel_tourism_type", 'Short Rental')->get();

            $this->state_travels[] = TravelTourism::where("state_id", $this->searchByLocation)
                ->Where("travel_tourism_type", 'Hotel-Resort')->get();
        } else {
            $this->state_travels = [];


            $this->state_travels[] = TravelTourism::with(['listing' => function ($q) {
                $q->where('status', 1);
            }])->where("travel_tourism_type", 'Short Rental')->get();
            $this->state_travels[] = TravelTourism::where("travel_tourism_type", 'Hotel-Resort')->get();
        }

        $this->emit('imageslick');
    }

    public function loginForFavorite()
    {
        $this->emit('favoriteLogin');
    }

    public function render()
    {

        return view('livewire.frontend.travel-tourism.tourism-list');
    }
}
