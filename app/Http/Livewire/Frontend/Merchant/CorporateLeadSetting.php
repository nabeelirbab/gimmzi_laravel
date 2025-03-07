<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use App\Models\Title;
Use App\Models\MerchantLocation;
use Illuminate\Support\Facades\Auth;
use App\Models\DisplayBoard;
use App\Models\MerchantDisplayBoard;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\State;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class CorporateLeadSetting extends Component
{
    use WithFileUploads;
    public $getusers, $adduser, $merchant_location, $business_locations, $main_location, $location;
    public $participating_location, $participating_address, $participating_city, $participating_zipcode, $participating_state, $participating_website, $participating_phone;
    public $states, $boards, $business, $story_image, $show_story_image, $logo_image, $show_logo_image, $merchant_photos=[], $show_photos=[], $main_photo, $state_name;
    public $display_status = '', $board_one, $board_two, $message_one, $message_two, $business_overview,$business_story, $state_id, $lat,$long;
    public $photo_title = '', $main_image, $photo_id, $business_video, $show_video;
    protected $listeners = ['checkState','pageSettings'];
    public function mount(){
      
        $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $location = MerchantLocation::where('user_id',Auth::user()->id)->where('is_main',1)->first();

        $this->business = BusinessProfile::find(Auth::user()->business_id);
        $this->business_story = $this->business->business_story;
        $this->business_overview = $this->business->business_overview;
        $this->show_story_image = Media::where(['model_id' => $this->business->id, 'collection_name' => 'BusinessStoryImage'])->first();
        $this->show_logo_image = Media::where(['model_id' => $this->business->id, 'collection_name' => 'businessProfileLogo'])->first();
        $this->show_photos = Media::where(['model_id' => Auth::user()->business_id, 'collection_name' => 'businessProfilePhoto'])->get();
        $this->main_photo =  $this->business->main_image;
        $this->show_video =  $this->business->video;

        $this->getusers = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
            $query->with('title')->where('active', 1)->whereIn('title_id', $usertitle); })->where('location_id',$location->location_id)->get();
          //  dd($getusers);
        $this->boards = DisplayBoard::all();
        $this->adduser = MerchantLocation::with('merchantUser')->whereHas('merchantUser', function($query) use ($usertitle) {
            $query->with('title')->where('active', 0)->whereIn('title_id', $usertitle); })->where('location_id',$location->location_id)->get();
        $this->merchant_location = MerchantLocation::with('businessLocation.states', 'merchantUser')->where('user_id', Auth::user()->id)->get();
        $this->business_locations = BusinessLocation::with('states')->where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type','Participating')->get();
        $this->participating_location = $this->business_locations[0]->id;
        foreach ($this->merchant_location as $locations){
            if($locations->is_main == 1){
                if($locations->businessLocation->state_id){
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->states->name.', '.$locations->businessLocation->zip_code;
                }
                else{
                    $this->location = $locations->businessLocation->address.', '.$locations->businessLocation->city.', '.$locations->businessLocation->zip_code;
                }
                
                $this->main_location = $locations->businessLocation->id ;
                $this->participating_location = $locations->businessLocation->id ;

            }
            
        }

        $participating = BusinessLocation::find($this->participating_location);
        if($participating){
            $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
            // dd($merchant_display,$this->participating_location);
            if($merchant_display){
                $this->display_status = $merchant_display->status;
                $this->board_one = $merchant_display->display_board_id;
                $this->message_one = $merchant_display->description;
                $this->board_two = $merchant_display->display_board_id2;
                $this->message_two = $merchant_display->description2;
            }
           
            $this->participating_address = $participating->address;
            $this->participating_city = $participating->city;
            $this->participating_zipcode = $participating->zip_code;
            // $this->participating_state = $participating->states->name;
            
            if($participating->state_id != null){
                $this->participating_state = $participating->state_id;
            }
            else{
                $state = State::where('name',$participating->state)->first();
                if($state){
                    $this->participating_state = $state->id;
                }
                else{
                    $this->participating_state = '';
                }
                
            }
            $this->participating_website = $participating->business_fax_number;
            $this->participating_phone = $participating->business_phone;
        }

        $this->states = State::get();
    

    }

    public function locationChange(){
        if($this->main_location){
            $get_location = BusinessLocation::with('states')->find($this->main_location);
            if($get_location){
                if($get_location->states){
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->states->name.', '.$get_location->zip_code;
                }
                else{
                    $this->location = $get_location->address.', '.$get_location->city.', '.$get_location->state_name.', '.$get_location->zip_code;
                }
                
            }
            
        }

    }

    public function changeParticipatingLocation(){
        if($this->participating_location){
            $get_location = BusinessLocation::with('states')->find($this->participating_location);
            if($get_location){
                $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
                // dd($merchant_display);
                if($merchant_display){
                    $this->display_status = $merchant_display->status;
                    $this->board_one = $merchant_display->display_board_id;
                    $this->message_one = $merchant_display->description;
                    $this->board_two = $merchant_display->display_board_id2;
                    $this->message_two = $merchant_display->description2;
                }
                else{
                    $this->display_status = '';
                    $this->board_one = $this->boards[0]->id;
                    $this->message_one = '';
                    $this->board_two = $this->boards[0]->id;
                    $this->message_two = '';
                }
                $this->participating_address = $get_location->address;
                $this->participating_city = $get_location->city;
                $this->participating_zipcode = $get_location->zip_code;
                if($get_location->state_id != null){
                    $this->participating_state = $get_location->states->name;
                }
                else{
                    $state = State::where('name',$get_location->state_name)->first();
                    if($state){
                        $this->participating_state = $state->id;
                    }else{
                        $this->participating_state = '';
                    }
                }
                $this->participating_website = $get_location->business_fax_number;
                $this->participating_phone = $get_location->business_phone;
                $this->resetValidation();
            }
            else{
                $this->participating_address = '';
                $this->participating_city = '';
                $this->participating_zipcode = '';
                $this->participating_state = '';
                $this->participating_website = '';
                $this->participating_phone = '';
                $this->resetValidation();
                
            }
        }
    }
    public function pageSettings(){
        // dd(123);
        $this->emit('pageSettingsModal');
    }

    public function removeMessageOne(){
        $this->message_one = null;
        $this->board_one = '';
        $this->emit('clear_message');
    }
    public function removeMessageTwo(){
        $this->message_two = null;
        $this->board_two = '';
        $this->emit('clear_message2');
    }

    public function savePageSettings(){
    //    dd($this->lat);
        if($this->business_overview){
            $this->business->business_overview = $this->business_overview;
            $this->business->save();
        }
        if($this->business_story){
            $this->business->business_story = $this->business_story;
            $this->business->save();
        }
        if($this->participating_location){
            $get_location = BusinessLocation::with('states')->find($this->participating_location);
           
            if($get_location){
              
                $this->validate(
                    [
                        'participating_website' => ['nullable','url'],
                        'participating_phone' => ['numeric'],
                        'participating_address' => ['required'],
                        'participating_city' => ['required'],
                        'participating_zipcode' => ['required'],
                        'participating_state' => ['required'],
                    ],
                    [
                        'participating_website.url' => "Website url must be a valid url",
                        'participating_phone.numeric' => "Phone number should be a number",
                        'participating_address.required' => "Street address is required",
                        'participating_city.required' => "City is required",
                        'participating_zipcode.required' => "Zipcode is required",
                        'participating_state.required' => "State is required"
                    ]
                );

                if($this->participating_zipcode == ''){
                    $this->validate(
                        [
                            'participating_zipcode' => ['required'],
        
                        ],
                        [
                            'participating_zipcode.required' => "Enter a correct provider zipcode",
                        ]
                    );
                }
                if($this->state_id == ''){
                    $this->validate(
                        [
                            'participating_state' => ['required'],
        
                        ],
                        [
                            'participating_state.required' => "Enter a correct provider state",
                        ]
                    );
                }
                // $state = State::where('name',$this->participating_state)->first();
                // $this->state_id = $state->id;
                $get_location->address = $this->participating_address;
                $get_location->city = $this->participating_city;
                $get_location->zip_code = $this->participating_zipcode;
                // $get_location->state_id =  $this->participating_state;
                $get_location->business_fax_number =$this->participating_website ;
                $get_location->business_phone = $this->participating_phone;
                $get_location->state_id = $this->participating_state;
                if($this->lat){
                    $get_location->latitude = $this->lat;
                }
                if($this->long){
                    $get_location->longitude = $this->long;
                }
                $get_location->save();
            }
            
            // dd($this->message_one);
            if($this->message_one != ''){
                $this->validate(
                    [
                        'display_status' => ['required'],
                        'board_one' => ['required'],
                    ],
                    [
                        'display_status.required' => "Select any display status",
                        'board_one.required' => "Select Display message board status"
                    ]
                );
                $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
                if($merchant_display){
                    $merchant_display->display_board_id = $this->board_one;
                    $merchant_display->description = $this->message_one;
                    $merchant_display->status = $this->display_status;
                    $merchant_display->save();
                }
                else{
                    $display = new MerchantDisplayBoard;
                    $display->display_board_id = $this->board_one;
                    $display->description = $this->message_one;
                    $display->status = $this->display_status;
                    $display->location_id = $this->participating_location;
                    $display->business_id =  Auth::user()->business_id;
                    $display->save();
                } 

            }
            else{
                $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
                if($merchant_display){
                    $merchant_display->display_board_id = null;
                    $merchant_display->description = $this->message_one;
                    $merchant_display->status = $this->display_status;
                    $merchant_display->save();
                }
            }
            if($this->message_two != ''){
                $this->validate(
                    [
                        'board_two' => ['required'],
                        'display_status' => ['required'],
                    ],
                    [
                        'board_two.required' => "Selct a Message type",
                        'display_status.required' => "Select Display message board status",
                    ]
                );
                $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
                if($merchant_display){
                    $merchant_display->display_board_id2 = $this->board_two;
                    $merchant_display->description2 = $this->message_two;
                    $merchant_display->status = $this->display_status;
                    $merchant_display->save();
                }
                else{
                    $display = new MerchantDisplayBoard;
                    $display->display_board_id2 = $this->board_two;
                    $display->description2 = $this->message_two;
                    $display->status = $this->display_status;
                    $display->location_id = $this->participating_location;
                    $display->business_id =  Auth::user()->business_id;
                    $display->save();
                } 
            }
            else{
                 
                $merchant_display = MerchantDisplayBoard::where('location_id',$this->participating_location)->first();
                if($merchant_display){
                    $merchant_display->display_board_id2 = null;
                    $merchant_display->description2 = $this->message_two;
                    $merchant_display->status = $this->display_status;
                    $merchant_display->save();
                }
            }

            $this->emit('successModal',['text'=>'Gimmzi page Settings detail updated successfully']);
            
        }
    }

    public function updatedStoryImage()
    {
        if ($this->story_image) {
            $this->validate([
                'story_image' => 'image|max:25600', // 25MB Max
            ]);
            if($this->show_story_image ){
                $this->show_story_image->delete();
            }
                $this->business->addMedia($this->story_image->getRealPath())
                    ->usingName($this->story_image->getClientOriginalName())
                    ->toMediaCollection('BusinessStoryImage');
               
            $this->show_story_image = Media::where(['model_id' => $this->business->id, 'collection_name' => 'BusinessStoryImage'])->first();
        }

    }

    public function removeStoryImage(){
        if($this->show_story_image ){
            $this->photo_title = 'story';
            $this->emit('confirmModal',['text'=>'Are you sure you want to delete this photo']);
        }
        else{
            $this->emit('successModal',['text'=>'There is no story image']);
        }
        
    }

    public function deleteStoryImage(){
        $this->photo_title = '';
        if($this->show_story_image ){
            $this->show_story_image->delete();
        }
        $this->show_story_image = '';
        $this->emit('successModal',['text'=>'Story image deleted successfully']);

    }

    public function updatedLogoImage(){
        if ($this->logo_image) {
            $this->validate([
                'logo_image' => 'image|max:25600', // 25MB Max
            ]);
            $photo = Media::where(['model_id' => $this->business->id, 'collection_name' => 'businessProfileLogo'])->first();
            if($photo){
                $photo->delete();
            }
                $this->business->addMedia($this->logo_image->getRealPath())
                    ->usingName($this->logo_image->getClientOriginalName())
                    ->toMediaCollection('businessProfileLogo');
               
            $this->show_logo_image = Media::where(['model_id' => $this->business->id, 'collection_name' => 'businessProfileLogo'])->first();
        }
    }

    public function removeLogoImage(){
        if($this->show_logo_image ){
            $this->photo_title = 'logo';
            $this->emit('confirmModal',['text'=>'Are you sure you want to delete this logo']);
        }
        else{
            $this->emit('successModal',['text'=>'There is no logo image']);
        }
        
    }

    public function deleteLogoImage(){
        $this->photo_title = '';
        if($this->show_logo_image ){
            $this->show_logo_image->delete();
        }
        $this->show_logo_image = '';
        $this->emit('successModal',['text'=>'Logo image deleted successfully']);

    }

    public function updatedMerchantPhotos(){
        if(count($this->merchant_photos) > 0){
            $this->validate([
                'merchant_photos.*' => 'image|max:25600', // 25MB Max
            ]);
            foreach($this->merchant_photos as $photo){
                $this->business->addMedia($photo->getRealPath())
                ->usingName($photo->getClientOriginalName())
                ->toMediaCollection('businessProfilePhoto');
            }

            $this->show_photos = Media::where(['model_id' => Auth::user()->business_id, 'collection_name' => 'businessProfilePhoto'])->get();
        }
    }

    public function MakeMainPhoto($id){
        $mediaImg = Media::find($id);
        if ($mediaImg) {
            $url = $mediaImg->getUrl();
            
            if ($this->business) {
                $this->business->main_image = $url;
                $this->business->save();
            }
            // $this->reset('main_image');
            $this->main_photo = $url;
            //    $mediaImg->delete();
            //    $this->showSuccessModal('Listing Main Photo has been updated successfully');
        }
    }

    public function removeProfilePhoto($id){
        $mediaImg = Media::find($id);
        if($mediaImg ){
            $this->photo_title = 'profile_photo';
            $this->photo_id = $id;
            $this->emit('confirmModal',['text'=>'Are you sure you want to delete this photo']);
        }
        else{
            $this->emit('successModal',['text'=>'There is no business photos']);
        }
    }

    public function deleteProfileImage(){
        $mediaImg = Media::find($this->photo_id);
        if($mediaImg ){
            if($mediaImg->getUrl() ==  $this->main_photo){
                $this->main_photo = '';
                $this->business->main_image = '';
                $this->business->save();
            }
            $mediaImg->delete();
        }
        $this->photo_id = '';
        $this->photo_title = '';
        $this->show_photos = Media::where(['model_id' => Auth::user()->business_id, 'collection_name' => 'businessProfilePhoto'])->get();
        $this->emit('successModal',['text'=>'Photo deleted successfully']);

    }

    public function removeMainPhoto(){
        if($this->main_photo){
            $this->photo_title = 'main_photo';
            $this->emit('confirmModal',['text'=>'Are you sure you want to delete this photo']);
        }
        else{
            $this->emit('successModal',['text'=>'There is no main business photo']);
        }
    }

    public function deleteMainPhoto(){
        if($this->main_photo){
            $this->photo_title = '';
            $this->business->main_image = '';
            $this->business->save();
            $this->main_photo = '';
        }
        $this->emit('successModal',['text'=>'Main Photo deleted successfully']);
    }

    public function updatedBusinessVideo(){
        //dd('123');
        if ($this->business_video) {
            $this->validate([
                'business_video' => 'mimes:mp4| max:20000', // 25MB Max
            ]);
            if($this->show_video){
                unlink('storage/public/'.$this->show_video);
                $this->business->video = '';
                $this->business->save();
            }
            $name = time() . rand(1, 100) . '.' . $this->business_video->extension();
            $path = $this->business_video->storeAs('public/merchant_video', $name);
           
            $this->business->video = 'merchant_video/'.$name;
            $this->business->save();
               
            $this->show_video = $this->business->video;
        }
    }

    public function removeBusinessVideo(){
        if($this->show_video ){
            $this->photo_title = 'video';
            $this->emit('confirmModal',['text'=>'Are you sure you want to delete this video']);
        }
        else{
            $this->emit('successModal',['text'=>'There is no video']);
        }
    }

    public function deleteVideo(){
        $this->photo_title = '';
        if($this->show_video ){
            unlink('storage/public/'.$this->show_video);
                $this->business->video = '';
                $this->business->save();
        }
        $this->show_video = '';
        $this->emit('successModal',['text'=>'Business media deleted successfully']);
    }

    public function checkState($statename){
       
        if($statename){
            $state = State::where('name',$statename)->first();
            
            if($state){
                $this->state_id = $state->id;
            }
            else{
                $this->state_id = '';
            }
        }
    }
    // public function participatingAddress(){
    //     dd(123);
    //     $this->emit('autoCompleteAddress');
    // }

    public function render()
    {
        return view('livewire.frontend.merchant.corporate-lead-setting');
    }


}
