<?php

namespace App\Http\Livewire\Admin\BusinessLocation;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use Livewire\Component;
use App\Models\State;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class BusinessLocationCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $business_profile_id, $location_name, $address, $city, $state, $zip_code, $locationId, $status, $location_type, $state_id;
    public $model_image,$photo,$imgId, $message = '', $businessmessage = '';
    public $isEdit = false;
    public $statusList = [], $stateList = [], $business_phone,$business_email,$business_fax_number, $lat, $long, $latitude, $longitude ;
    public $blankArr = [],$businessList=[], $typeList = [];
    public $photos = [];
    protected $listeners = ['refreshProducts' => '$refresh'];
    public function mount($business_location = null)
    {
        if ($business_location) {
            $this->business_location = $business_location;
            $this->fill($this->business_location);
            $this->isEdit = true;
            //this profile already have location
            $basicid = BusinessLocation::whereHas('business', function( $query ){
                $query->where('merchant_type', 'Basic')->where('status',1);
            })->where('business_profile_id','!=',$this->business_location->business_profile_id)->pluck('business_profile_id')->toArray();
            $plusprofile = BusinessProfile::where('merchant_type', 'Plus')->where('status',1)->get();
            $plusid = array();
            if($plusprofile){
                foreach($plusprofile as $profiledata){
                    $location_no = $profiledata->number_of_location;
                    $businesscount = BusinessLocation::where('business_profile_id',$profiledata->id)->where('status',1)->where('id','!=',$this->business_location->id)->count();
                    if($businesscount == $location_no){
                        array_push($plusid,$profiledata->id);
                    }
                }
            }
        } else{

            //this profile already have location
            $basicid = BusinessLocation::whereHas('business', function( $query ){
                $query->where('merchant_type', 'Basic')->where('status',1);
            })->pluck('business_profile_id')->toArray();
            $plusprofile = BusinessProfile::where('merchant_type', 'Plus')->where('status',1)->get();
            $plusid = array();
            if($plusprofile){
                foreach($plusprofile as $profiledata){
                    $location_no = $profiledata->number_of_location;
                    $businesscount = BusinessLocation::where('business_profile_id',$profiledata->id)->where('status',1)->count();
                    if($businesscount == $location_no){
                        array_push($plusid,$profiledata->id);
                    }
                }
            }
           
            $this->business_location = new BusinessLocation;
        }
        $ids = array();
        $ids = array_merge($plusid,$basicid);
        $this->businessList=BusinessProfile::where('status',1)->whereNotIn('id',$ids)->get();
       // dd($this->businessList);
            
        $this->stateList = State::get();
        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

        $this->typeList = [
            ['value' => 0, 'text' => "Choose Type"],
            ['value' => 'Headquarters', 'text' => "Headquarters"],
            ['value' => 'Not Headquarters', 'text' => "Non Headquarters"]
        ];

        $this->model_image = Media::where(['model_id' => $this->business_location->id, 'collection_name' => 'locationBusinessPhoto'])->get();
        
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
       
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'business_profile_id' => ['required'],
                'location_name' => ['required'],
                'address' => ['required'],
                'city' => ['required'],
                // 'state_id' => ['required'],
                'zip_code' => ['required'],
                'status' => ['required'],
                'photo' => ['nullable'],
                'location_type' => ['required'],
                'business_phone' => ['required',Rule::unique('business_locations'), 'max:12', 'min:10'],
                'business_email' => ['required','email', Rule::unique('business_locations'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                // 'business_fax_number' => ['required',Rule::unique('business_locations'),'min:6'],
                'business_fax_number' => ['nullable'],

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'business_profile_id' => ['required'],
                'location_name' => ['required'],
                'address' => ['required'],
                'city' => ['required'],
                // 'state_id' => ['required'],
                'zip_code' => ['required'],
                'status' => ['required'],
                'photo' => ['nullable'],
                'location_type' => ['required'],
                'business_phone' => ['required',Rule::unique('business_locations')->ignore($this->business_location->id), 'max:12', 'min:10'],
                'business_email' => ['required','email', Rule::unique('business_locations')->ignore($this->business_location->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                // 'business_fax_number' => ['required',Rule::unique('business_locations')->ignore($this->business_location->id),'min:6'],
                'business_fax_number' => ['nullable'],
            ];
    }

    protected $messages = [
        'business_profile_id.required' => 'The Select Business field is required',
        'location_name.required' => 'The Location Name field is required',
        'address.required' => 'The Address field is required',
        'city.required' => 'The City field is required',
        'state_id.required' => 'The State field is required',
        'zip_code.required' => 'The Zip Code field is required',
        'status.required' => 'The Status field is required',
        'location_type.required' => 'The Location Type field is required',
        'business_phone.required' => 'The Business Phone Number field is required',
        'business_phone.max' => 'The Business Phone Number may not be greater than 12 characters',
        'business_phone.min' => 'The Business Phone Number must be at least 10 characters',
        'business_phone.unique' => 'The Business Phone Number has already been taken',
        'business_email.required' => 'The Business Email field is required',
        'business_email.email' => 'The Business Email must be a valid email address',
        'business_email.unique' => 'The Business Email has already been taken',
        'business_email.regex' => 'The Business Email format is invalid',
        'business_fax_number.required' => 'The Business Fax Number field is required',
        'business_fax_number.unique' => 'The Business Fax Number has already been taken',
        'business_fax_number.min' => 'The Business Fax Number must be at least 6 characters',
    ]; 

    public function changeType($value){
        //dd($value);
        $this->message = '';
        $this->businessmessage = '';
        if($this->business_profile_id == ''){
            $this->location_type = '';
            return $this->businessmessage = 'The Select Business field is required';
        }
        else{
            if($value == 'Headquarters'){
                $locationC = BusinessLocation::where('business_profile_id',$this->business_profile_id )->where('location_type','Headquarters')->where('status',1)->count();
                if($locationC > 0){
                    return $this->message = 'For this business, Headquarters is already entered';
                }
            }
        }

    }
    public function saveOrUpdate()
    {
        if(!$this->isEdit){
            if(($this->business_profile_id != '') && ($this->location_type == 'Headquarters')){
                $headquarterscount = BusinessLocation::where('business_profile_id',$this->business_profile_id)->where('location_type','Headquarters')->where('status',1)->count();
                if($headquarterscount == 1){
                    $msgAction = 'You have already one headquarter location for this business profile';
                    $this->showToastr("error", $msgAction);
                    if(!$this->isEdit)
                    return redirect()->route('business-location.create');
                    else
                    return redirect()->route('business-location.edit',$this->business_location->id);
                }
            }
        }

        if(!$this->isEdit){
            if($this->business_profile_id != ''){
                $profile = BusinessProfile::find($this->business_profile_id);
                $location_number = $profile->number_of_location;
                if($profile->merchant_type == "Basic"){
                    $basiclocationcount = BusinessLocation::where('business_profile_id',$this->business_profile_id)->count();
                    if($basiclocationcount == 1){
                        $msgAction = 'You have already one location for this basic business profile';
                        $this->showToastr("error", $msgAction);
                        return redirect()->route('business-location.create');
                    }
                    
                }
                else{
                    $locationcount = BusinessLocation::where('business_profile_id',$this->business_profile_id)->count();
                    if(($locationcount == $location_number) || ($locationcount > $location_number)){
                        $msgAction = 'Please increase the "Number of Location" of this business profile. Otherwise you can not add another location..';
                        $this->showToastr("error", $msgAction);
                        return redirect()->route('business-location.create');
                    }
                }
               
            }
        }     

        if($this->state != ''){
            $get_state = State::where('name',$this->state)->first();
            if($get_state){
               $state_id = $get_state->id;
            }
            else{
                $state_id = null;
            }
        }
        $this->business_location->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $business_profile = BusinessProfile::find($this->business_profile_id);
        $locationid = strtoupper(substr($business_profile->business_name,0,3)).'/'.strtoupper(substr($this->business_location->location_name,0,3)).'/0'.$this->business_location->id;
        $this->business_location->locationId = $locationid;
        $this->business_location->state_id = $state_id;
        $this->business_location->state = $this->state;
        if($this->lat){
            $this->business_location->latitude = $this->lat;
        }
        if($this->long){
            $this->business_location->longitude = $this->long;
        }
        $this->business_location->participating_type = "Participating"; 
        $this->business_location->save();

        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $this->business_location->addMedia($photo->getRealPath())
                    ->usingName($photo->getClientOriginalName())
                    ->toMediaCollection('locationBusinessPhoto');
            }
        }

        $msgAction = 'Business Location was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('business-location.index');
    }

    public function deleteImages($id)
    {
        $item = Media::find($id);
        $item->delete(); // delete previous image in the database
        $this->showModal('success', 'Success', 'Photo deleted successfully');
        $this->emit('refreshProducts');
    }
    
    public function render()
    {
        return view('livewire.admin.business-location.business-location-create-edit');
    }
}
