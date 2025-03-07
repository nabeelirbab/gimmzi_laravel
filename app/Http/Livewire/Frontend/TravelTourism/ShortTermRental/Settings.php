<?php

namespace App\Http\Livewire\Frontend\TravelTourism\ShortTermRental;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ShortTermRentalListing;
use App\Models\TravelTourism;
use App\Models\ProviderMessageBoard;
use App\Models\User;
use App\Models\Title;
use App\Http\Livewire\Traits\AlertMessage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use App\Models\TravelTourismSettings;
use App\Models\BusinessProfile;
use App\Models\State;
use App\Models\BusinessCategory;
use App\Models\TravelTourismMerchant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Log;

class Settings extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $user, $shortTerm, $travel_tourism,$travel_message_board,$short_term_listing,$listing_id,$searchName,$usertitle=[],$managers,$deactive_managers = [];
    public $listing_website = false,$message_board = false,$guest_recognition = false,$listing_status = -1; 
    public $user_id,$manager_user,$manager_id;
    public $provider_name,$provider_address,$provider_email,$provider_city,$provider_state,$provider_phone,$logo,$provider_logo, $provider_settings,$lat,$long,$zip_code,$city,$state_name,$state_id;
    public $badge_point, $add_point,$guest_point,$double_point,$triple_point,$local_point;
    public $merchants=[],$business_type=[];
    public $checkin_hour,$checkin_min,$checkin_time,$checkout_hour,$checkout_min,$checkout_time;
    public $search_text,$search_filter,$result,$showdiv=false,$search_listing,$qr_image;
    public $travel_merchant_count,$business_count,$data,$encode_id,$text, $selected_listing_name,$selected_listing_city,$selected_listing_state,$low_point;
    protected $listeners = ['checkState'];


    public function mount()
    {
        $this->user = Auth::user();
        $this->shortTerm = $this->user->travelType;
        $this->travel_tourism = TravelTourism::find($this->shortTerm->id);
        $this->listing_website = $this->travel_tourism->show_listing_website;
        $this->message_board = $this->travel_tourism->show_message_board;
        $this->guest_recognition = $this->travel_tourism->show_guest_recognition;
        $this->travel_message_board = ProviderMessageBoard::where('travel_tourism_id',$this->shortTerm->id)->where('provider_type','for_short_term_rental')->first();
        $this->short_term_listing = ShortTermRentalListing::where('travel_tourism_id',$this->shortTerm->id)->get();
        $this->usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $this->managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
        $this->deactive_managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
        //set provider details
        $this->provider_name = $this->travel_tourism->name;
        $this->provider_address = $this->travel_tourism->address;
        $this->lat = '';
        $this->long = '';
        $this->provider_phone = $this->travel_tourism->phone;
        $this->provider_email = $this->travel_tourism->email_address;
        $this->logo = $this->travel_tourism->short_term_logo;
        $this->provider_city = $this->travel_tourism->city;
        $this->provider_state = $this->travel_tourism->state->name;
        $this->state_id = $this->travel_tourism->state_id;
        $this->zip_code = $this->travel_tourism->zip_code;

        $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
        $this->merchants = BusinessProfile::where('status',1)->orderBy('id','desc')->get();
        $this->business_count = BusinessProfile::where('status',1)->orderBy('id','desc')->count();
        if($this->provider_settings){
            $this->checkin_hour = $this->provider_settings->check_in_hour;
            $this->checkin_min = $this->provider_settings->check_in_min;
            $this->checkin_time = $this->provider_settings->check_in_time;
            $this->checkout_hour = $this->provider_settings->check_out_hour;
            $this->checkout_min = $this->provider_settings->check_out_min;
            $this->checkout_time = $this->provider_settings->check_out_time;
        }
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->count();
        //dd($this->merchants[0]->head_location);
        $this->encode_id = base64_encode($this->travel_tourism->id);
        $this->text = url('short-term-rental/'.$this->encode_id );
        $this->business_type= BusinessCategory::where('status',1)->get();
        $this->selected_listing_name = '---'; 
        $this->selected_listing_city = '--'; 
        $this->selected_listing_state = '--'; 
    }

    public function listingSettings(){
        $this->emit('showListingSettings');
    }

    public function updateListingWebsiteStatus($status){
        if($this->travel_tourism){
            $this->travel_tourism->show_listing_website = $status;
            $this->travel_tourism->save();
        }
        $this->listing_website = $this->travel_tourism->show_listing_website;
    }

    public function updateMessageBoardStatus($board_status){
        if($this->travel_tourism){
            $this->travel_tourism->show_message_board = $board_status;
            $this->travel_tourism->save();
        }
        if($this->travel_message_board ){
            $this->travel_message_board->status = $board_status;
            $this->travel_message_board->save();
        }

        $this->message_board = $this->travel_tourism->show_message_board;
    }

    public function updateGuestRecognitionStatus($recognition_status){
        if($this->travel_tourism){
            $this->travel_tourism->show_guest_recognition = $recognition_status;
            $this->travel_tourism->save();
        }
        $this->guest_recognition = $this->travel_tourism->show_guest_recognition;
    }

    public function mainListingWebsite(){
        $this->emit('viewMainListingWebsite');
    }

    public function statusWiseListing(){
        if($this->listing_status == 0){
            $this->short_term_listing = ShortTermRentalListing::where('status',0)->where('travel_tourism_id',$this->shortTerm->id)->get();
        }
        elseif($this->listing_status == 1){
            $this->short_term_listing = ShortTermRentalListing::where('status',1)->where('travel_tourism_id',$this->shortTerm->id)->get();
        }
        else{
            $this->short_term_listing = ShortTermRentalListing::where('travel_tourism_id',$this->shortTerm->id)->get();
        }
    }

    public function showSuccessModal($text)
    {
        $this->emit('successModal', [
            'text'  => $text,
        ]);
    }

    public function showUserModal($text){
        $this->emit('userSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideSuccessModal(){
        $this->emit('hideUserSuccessModal');
    }

    public function showLimitSuccessModal($text){
        $this->emit('limitSuccessModal', [
            'text'  => $text,
        ]);
    }
    public function hideLimitSuccessModal(){
        $this->emit('hideLimitSuccessModal');
    }

    public function showMerchantSuccessModal($text){
        $this->emit('merchantSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideCountModal(){
        $this->emit('hideCountModal');
    }

    public function activateListing($id)
    {
        $shortList = ShortTermRentalListing::find($id);
        if ($shortList) {
            $shortList->status = 1;
            $shortList->save();
            $this->showSuccessModal('Listing has been activated successfully');
        }
    }

    public function listingStatusChange($id){
        $listing = ShortTermRentalListing::find($id);
        if ($listing) {
            $this->listing_id = $listing->id;
            $this->emit('showDeactivateModal', [
                'listing_id' => $id
            ]);
        }
    }

    public function yesDeactivate(){
        $shortTerm = $this->user->travelType;
        $shortList = ShortTermRentalListing::find($this->listing_id);
        if ($shortList) {
            $shortList->status = 0;
            $shortList->save();
            $this->showSuccessModal('Listing has been deactivated successfully');
        }
    }

    public function searchList(){
        
        $this->short_term_listing = ShortTermRentalListing::query();
        if ($this->searchName){
            $this->short_term_listing->Where('name' , 'like' ,'%' . trim($this->searchName) . '%');
        }
        $this->short_term_listing = $this->short_term_listing->get();
        //$this->resetPage();
    }

    public function showLeadManager(){
        $this->emit('showLeadManager');
    }

   
    public function showRemoveManager($id){
        $this->user_id = $id;
        $this->manager_user = User::find($this->user_id);
        $this->emit('showRemoveModal',['name' => $this->manager_user->full_name]);
    }

    public function removeManager(){
        $manageruser = User::find($this->user_id);
        if($manageruser){
            $manageruser->active = false;
            $manageruser->save();
            $this->showUserModal('Manager Removed Successfully');
            $this->managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
            $this->deactive_managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
        }
        else{
            $this->showUserModal('Manager Not Found');
        }
    }


    public function activeManager(){
        $this->validate(
            [
                'manager_id' => ['required'],
            ],
            [
                'manager_id.required' => "Please select a Manager",
            ]
        );
        $manager = User::find($this->manager_id);
        if($manager){
            $manager->active = true;
            $manager->save();
            $this->showUserModal('Manager Added Successfully');
            $this->managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
            $this->deactive_managers = User::where('travel_tourism_id',$this->shortTerm->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
            
        }
        else{
            $this->showUserModal('Manager Not Found');
        }
    }

    public function editProviderDetail(){
        $this->emit('showProviderDetail');
    }

    public function editProvidername(){
        $this->emit('editProviderName');
    }

    public function editProvideraddress(){
        $this->emit('editProviderAddress');
    }

    public function editProvideremail(){
        $this->emit('editProviderEmail');
    }

    public function editProviderphone(){
        $this->emit('editProviderPhone');
    }

    public function checkState($statename){
        if($statename){
            $state = State::where('name',$this->state_name)->first();
            if($state){
                $this->state_id = $state->id;
            }
            else{
                $this->state_id = '';
            }
        }
    }

    public function UpdateProviderDetail(){
        // dd($this->state_name);
        $this->validate(
            [
                'provider_name' => ['required'],
                'provider_address' => ['required'],
                'provider_email' => ['nullable','email', Rule::unique('travel_tourisms','email_address')->ignore($this->travel_tourism->id)],
                'provider_phone' => ['nullable',Rule::unique('travel_tourisms','phone')->ignore($this->travel_tourism->id),'numeric','digits_between:8,15'],
               
            ],
            [
                'provider_name.required' => "Provider Name field is required",
                'provider_address.required' => "Provider Address field is required",
                'provider_email.required' => "Provider Email field is required",
                'provider_email.email' => "Provider Email must be a valid email address",
                'provider_phone.required' => "Provider Phone field is required",
                'provider_phone.numeric' => "Provider Phone must be a number",
                'provider_phone.regex' => "Provider Phone must be a valid phone number",
                'provider_phone.digits_between' => "Provider Phone should be between 8 to 15 digits",

            ]
        );
        if($this->zip_code == ''){
            $this->validate(
                [
                    'zip_code' => ['required'],

                ],
                [
                    'zip_code.required' => "Enter a correct provider address",
                ]
            );
        }
        if($this->state_id == ''){
            $this->validate(
                [
                    'state_id' => ['required'],

                ],
                [
                    'state_id.required' => "Enter a correct provider address",
                ]
            );
        }
        // // dd($this->provider_address);
        // $splitaddress = explode(", ",$this->provider_address, 3);
    
        // // dd($splitaddress[2]);
        $this->travel_tourism->name = $this->provider_name;
        $this->travel_tourism->address = $this->provider_address;
        $this->travel_tourism->email_address = $this->provider_email;
        $this->travel_tourism->phone = $this->provider_phone;
        $this->travel_tourism->city = $this->city;
        $this->travel_tourism->zip_code = $this->zip_code;
        $this->travel_tourism->state_id = $this->state_id;
        $this->travel_tourism->lat = $this->lat;
        $this->travel_tourism->long = $this->long;
        $saved = $this->travel_tourism->save();
        
        if($this->provider_logo){
            $photo = Media::where(['model_id' => $this->travel_tourism->id, 'collection_name' => 'shortRentalPhoto'])->first();
           // dd($photo);
            if($photo){
                $photo->delete();
                $this->travel_tourism->addMedia($this->provider_logo->getRealPath())
                ->usingName($this->provider_logo->getClientOriginalName())
                ->toMediaCollection('shortRentalPhoto');
            }
            else{
                $this->travel_tourism->addMedia($this->provider_logo->getRealPath())
                ->usingName($this->provider_logo->getClientOriginalName())
                ->toMediaCollection('shortRentalPhoto');
            }
        }
        if($saved){
            $msgAction = 'Provider Detail has been updated successfully';
            $this->showToastr("success", $msgAction);
            
        }
        return redirect()->route('frontend.short_term.settings');
    }

    public function manageLimit(){
        $this->emit('manageLimit');
    }

    public function updateBadge(){
        $this->validate(
            [
                'badge_point' => ['required','gt:24']
            ],
            [
                'badge_point.required' => "Field is required",
                'badge_point.gt' => " This point must be greater than 24"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->badge_bonus_point = $this->badge_point;
            $this->provider_settings->save();
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->badge_point = '';
            $this->showLimitSuccessModal('Badge bonus point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->badge_bonus_point = $this->badge_point;
            $this->provider_settings->save();
            $this->badge_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Badge bonus point has been updated successfully');
        }
    }

    public function updateAddPoint(){
        $this->validate(
            [
                'add_point' => ['required','gt:24']
            ],
            [
                'add_point.required' => "Field is required",
                'add_point.gt' => " This point must be greater than 24"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->add_point = $this->add_point;
            $this->provider_settings->save();
            $this->add_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Add point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->add_point = $this->add_point;
            $this->provider_settings->save();
            $this->add_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Add point has been updated successfully');
        }
    }

    public function updateGuest(){
        $this->validate(
            [
                'guest_point' => ['required','gt:24']
            ],
            [
                'guest_point.required' => "Field is required",
                'guest_point.gt' => " This point must be greater than 24"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->guest_of_week_point = $this->guest_point;
            $this->provider_settings->save();
            $this->guest_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Guest of week point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->guest_of_week_point = $this->guest_point;
            $this->provider_settings->save();
            $this->guest_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Guest of week point has been updated successfully');
        }
    }
    
    public function updateDouble(){
        $this->validate(
            [
                'double_point' => ['required','gt:49']
            ],
            [
                'double_point.required' => "Field is required",
                'double_point.gt' => " This point must be greater than 49"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->double_booker_point = $this->double_point;
            $this->provider_settings->save();
            $this->double_point = '';
            $msgAction = 'Double booker point has been updated successfully';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Double booker point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->double_booker_point = $this->double_point;
            $this->provider_settings->save();
            $this->double_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Double booker point has been updated successfully');
        }
    }

    public function updateTriple(){
        $this->validate(
            [
                'triple_point' => ['required','gt:74']
            ],
            [
                'triple_point.required' => "Field is required",
                'triple_point.gt' => " This point must be greater than 74"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->triple_booker_point = $this->triple_point;
            $this->provider_settings->save();
            $this->triple_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Triple booker point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->triple_booker_point = $this->triple_point;
            $this->provider_settings->save();
            $this->triple_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Triple booker point has been updated successfully');
        }
    }

    public function updateLowPoint(){
        
        $this->validate(
            [
                'low_point' => ['required','gt:74']
            ],
            [
                'low_point.required' => "Field is required",
                'low_point.gt' => " This point must be greater than 74"
               
            ]
        );
        //dd($this->low_point);
        if($this->provider_settings){
            $this->provider_settings->low_point_balance = $this->low_point;
            $this->provider_settings->save();
            $this->low_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Low point has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->low_point_balance = $this->low_point;
            $this->provider_settings->save();
            $this->low_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Low point has been updated successfully');
        }
    }


    public function updateLocal(){
        $this->validate(
            [
                'local_point' => ['required','gt:199']
            ],
            [
                'local_point.required' => "Field is required",
                'local_point.gt' => " This point must be greater than 199"
               
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->local_reward_point = $this->local_point;
            $this->provider_settings->save();
            $this->local_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Live Like A Local Reward points has been updated successfully');
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->local_reward_point = $this->local_point;
            $this->provider_settings->save();
            $this->local_point = '';
            $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
            $this->showLimitSuccessModal('Act Like A Local Reward point has been updated successfully');
        }
    }

    public function updateCheckinTime(){

        $this->validate(
            [
                'checkin_hour' => ['required','gt:00','lt:13'],
                'checkin_min' => ['required','gt:-01','lt:60'],
                'checkin_time' => ['required']
            ],
            [
                'checkin_hour.required' => "Check in hour is required",
                'checkin_hour.gt' => "Check in hour must be greater than 0",
                'checkin_hour.lt' => "Check in hour must be less than 13" ,
                'checkin_min.required' => "Check in minute is required",
                'checkin_min.gt' => "Check in minute must be greater than 0",
                'checkin_min.lt' => "Check in minute must be less than 60" ,
                'checkin_time.required' => "Please select a check in time",
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->check_in_hour = $this->checkin_hour;
            $this->provider_settings->check_in_min = $this->checkin_min;
            $this->provider_settings->check_in_time = $this->checkin_time;
            $this->provider_settings->save();
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->check_in_hour = $this->checkin_hour;
            $this->provider_settings->check_in_min = $this->checkin_min;
            $this->provider_settings->check_in_time = $this->checkin_time;
            $this->provider_settings->save();
        }
        $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
        $this->showLimitSuccessModal('Checkin time has been updated successfully');
    }

    public function updateCheckoutTime(){
        $this->validate(
            [
                'checkout_hour' => ['required','gt:00','lt:13'],
                'checkout_min' => ['required','gt:-01','lt:60'],
                'checkout_time' => ['required']
            ],
            [
                'checkout_hour.required' => "Check in hour is required",
                'checkout_hour.gt' => "Check in hour must be greater than 0",
                'checkout_hour.lt' => "Check in hour must be less than 13" ,
                'checkout_min.required' => "Check in minute is required",
                'checkout_min.gt' => "Check in minute must be greater than 0",
                'checkout_min.lt' => "Check in minute must be less than 60" ,
                'checkout_time.required' => "Please select a check in time",
            ]
        );
        if($this->provider_settings){
            $this->provider_settings->check_out_hour = $this->checkout_hour;
            $this->provider_settings->check_out_min = $this->checkout_min;
            $this->provider_settings->check_out_time = $this->checkout_time;
            $this->provider_settings->save();
        }
        else{
            $this->provider_settings = new TravelTourismSettings;
            $this->provider_settings->travel_tourism_id = $this->shortTerm->id;
            $this->provider_settings->check_out_hour = $this->checkout_hour;
            $this->provider_settings->check_out_min = $this->checkout_min;
            $this->provider_settings->check_out_time = $this->checkout_time;
            $this->provider_settings->save();
        }
        $this->provider_settings = TravelTourismSettings::where('travel_tourism_id',$this->shortTerm->id)->first();
        $this->showLimitSuccessModal('Checkout time has been updated successfully');
    }

    public function settingCancel(){
        

        $merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->count();
        if($merchant_count == 0){
            $msgAction = 'Provider Settings has been updated successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('frontend.short_term.settings');
        }
        else{
            if($merchant_count < 5){
                $this->showMerchantSuccessModal('A minimum of 5 merchants is required');
            }
            elseif($merchant_count > 10){
                $this->showMerchantSuccessModal('A maximum of 10 merchants can be selected');
            }
            else{
                $msgAction = 'Provider Settings has been updated successfully';
                $this->showToastr("success", $msgAction);
                return redirect()->route('frontend.short_term.settings');
            }
        }
        
    }

    public function searchResult(){
        if(!empty($this->search_text)){
            if(($this->search_filter == null) || ($this->search_filter == 'all')){
                $this->result = BusinessProfile::where('status',1)
                                ->where('business_name','like','%'.trim($this->search_text).'%')
                                ->orderBy('id','desc')
                                ->get();
                
            }
            else{
                $this->result = BusinessProfile::where('business_category_id',$this->search_filter)
                                ->where('status',1)
                                ->where('business_name','like','%'.trim($this->search_text).'%')
                                ->orderBy('id','desc')
                                ->get();
            }
           
            $this->showdiv = true;
        }
        else{
            $this->showdiv = false;
        }
    }

    public function filterWiseBusiness(){
        if($this->search_filter == 'all'){
            $this->merchants = BusinessProfile::where('status',1)->get();
            $ids = BusinessProfile::where('status',1)->pluck('id');
            $this->business_count = BusinessProfile::where('status',1)->count();
            $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->whereIn('business_profile_id',$ids)->count();
        }
        else{
            $this->merchants = BusinessProfile::where('status',1)->where('business_category_id',$this->search_filter)->get();
            $ids = BusinessProfile::where('status',1)->where('business_category_id',$this->search_filter)->pluck('id');
            $this->business_count = BusinessProfile::where('status',1)->where('business_category_id',$this->search_filter)->count();
            $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->whereIn('business_profile_id',$ids)->count();
        }
        
        
    }

    public function searchListing(){
        if(!empty($this->search_listing)){
            
            $this->result = ShortTermRentalListing::where('status',1)
                                ->where('name','like','%'.trim($this->search_listing).'%')
                                ->orderBy('id','desc')
                                ->get();
                
            $this->showdiv = true;
        }
        else{
            $this->showdiv = false;
        }
    }

    public function autocompleteListingSelect($id){
        $listing = ShortTermRentalListing::find($id);
        if($listing->name != null){
            $this->selected_listing_name = $listing->name;
        }
        else{
            $this->selected_listing_name = $listing->street_address;
        }
        
        $this->selected_listing_city = $listing->city;
        $this->selected_listing_state = $listing->states->name;
        $this->search_listing = $listing->name;
        $this->showdiv = false;
        $encode_id = base64_encode($id);
        $this->text = url('short-term-rental/'.$encode_id );
            
        $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($this->text);
        $this->qr_image = base64_encode($image);
    }

    public function resetListing(){
        $this->selected_listing_city = '--';
        $this->selected_listing_state = '--';
        $this->search_listing = '';
        $this->selected_listing_name = '---';
        $this->qr_image = '';
    }

    public function merchantBusiness($id){
        $this->merchants = BusinessProfile::where('id',$id)->get();
        $this->search_text = $this->merchants[0]->business_name;
        $this->showdiv = false;
        $this->business_count = BusinessProfile::where('id',$id)->count();
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->where('business_profile_id',$id)->count();
    }

    public function checkMerchant($id){
        //dd($id);
        $merchant = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->where('business_profile_id',$id)->first();
        if($merchant){
            $merchant->delete();
        }
        else{
            if(TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->exists()){

                if(TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->count() > 10){
                    $this->showSuccessModal('You can select only 5 to 10 merchants');
                }
                else{
                    $merchant = new TravelTourismMerchant;
                    $merchant->travel_tourism_id = $this->shortTerm->id;
                    $merchant->business_profile_id = $id;
                    $merchant->is_checked = true;
                    $merchant->save();
                }
            }
            else{
                $merchant = new TravelTourismMerchant;
                $merchant->travel_tourism_id = $this->shortTerm->id;
                $merchant->business_profile_id = $id;
                $merchant->is_checked = true;
                $merchant->save();
            }
            
        }
        $this->merchants = BusinessProfile::where('status',1)->orderBy('id','desc')->get();
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id',$this->shortTerm->id)->count();
    }

    public function showQrCode(){
        if($this->travel_tourism->qr_code_png == null){
            $encode_id = base64_encode($this->travel_tourism->id);
            $text = url('short-term-rental/'.$encode_id );
            
            $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($text);
            $encodeimage = base64_encode($image);
            // dd($image);
            $this->emit('openQrCode',['png'=>$encodeimage]);
            
        }
    }

    

    public function downloadQRCode(){
        $html = [];
        // $myFile = public_path("frontend_assets/sample.pdf");
        // $data['city'] = $this->provider_city;
        // $data['state'] = $this->provider_state;
        // //dd($data);
        // //$headers = ['Content-Type: application/pdf'];
       
        $pdf = PDF::loadView('frontend.pdf_blade.index',$html);
        // dd($pdf);
	     return $pdf->download('file.pdf');
        //  dd($ff);
        //return $pdf->stream();
        
        // $headers = ['Content-Type: application/pdf'];
        // $newName = 'qr-code-pdf-file-'.time().'.pdf';
        // return response()->download($myFile, $newName, $headers);
        //     $view = view('frontend/pdf_blade/index')->with(compact('data'));
        //     $html .= $view->render();
        
        //     $pdf = PDF::loadHTML($html);            
        //     $sheet = $pdf->setPaper('a4', 'landscape');
        //    // dd($sheet);
        //     return response()->$sheet->download('qr-code-pdf-file-'.time().'.pdf')->header('Content-Type','application/pdf');;
    }

    public function copyQRCode(){
        if($this->travel_tourism->qr_code_png == null){
            $encode_id = base64_encode($this->travel_tourism->id);
            $text = url('short-term-rental/'.$encode_id );
            
            $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($text);
            $encodeimage = base64_encode($image);
            // dd($image);
            $this->emit('openQrCode',['png'=>$encodeimage]);
            
        }
    }

    public function printFunc(){
        $this->emit('printQrCode');
    }


    public function render()
    {
        return view('livewire.frontend.travel-tourism.short-term-rental.settings');
    }
}
