<?php

namespace App\Http\Livewire\Admin\BusinessProfile;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use App\Models\BusinessProfile;
use App\Models\ServiceType;
use App\Models\State;
use App\Models\BusinessLocation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Validation\Rule;

class BusinessProfileCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $business_name,$business_category_id,$street_address, $city, $state, $zip_code, $business_page_link, $number_of_location, $status, $service_type_id,$merchant_type,$business_type, $businessId, $state_id;
    public $isEdit = false;
    public $statusList = [], $merchantType = [], $businessType = [], $categoryList = [],$serviceList = [], $blankArr = [], $stateList = [];
    public $business_profile, $photo,$logo,$business_phone,$business_email,$business_fax_number;
    public $photos = [], $location, $latitude, $longitude;
    public $model_image1, $model_image2, $imgId1,$imgId2;
    protected $listeners = [
        'refreshProducts' => '$refresh',
        'mailupdateStreetAddress'=>'mailsetStreetAddress',
        'mailupdateCity' => 'mailsetCity',
        'mailupdateState' => 'mailsetState',
        'mailupdateZipCode' => 'mailsetZipCode',
        'mailupdateLatLng' => 'mailsetLatLng',
    ];

    public function mount($business_profile = null)
    {
        if ($business_profile) {
            $this->business_profile = $business_profile;
            $this->fill($this->business_profile);
            $this->isEdit = true;
        } else
            $this->business_profile = new BusinessProfile();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"],
            ['value' => 2, 'text' => "Pending Approval"],
            ['value' => 3, 'text' => "Does not meet Merchant Guidelines"],
            ['value' => 4, 'text' => "Saved"]
        ];
        $this->merchantType = [
            ['value' => 'null', 'text' => "Choose Merchant Type"],
            ['value' => 'Plus', 'text' => "Plus"],
            ['value' => 'Basic', 'text' => "Basic"],
            ['value' => 'Intro', 'text' => "Intro"],
            ['value' => 'G1 Bundle', 'text' => "G1 Bundle"],
            ['value' => 'G2 Bundle', 'text' => "G2 Bundle"]
        ];
        $this->businessType = [
            ['value' => 'null', 'text' => "Choose Busniess Type"],
            ['value' => 'Store Front', 'text' => "Store Front"],
            ['value' => 'Store Front and Online', 'text' => "Store Front and Online"],
            ['value' => 'Mobile Business', 'text' => "Mobile Business"],
            ['value' => 'Online Only', 'text' => "Online Only"],
        ];
        $this->model_image1 = Media::where(['model_id' => $this->business_profile->id, 'collection_name' => 'businessProfileLogo'])->first();
        if (!$this->model_image1 == null) {
            $this->imgId1 = $this->model_image1->id;
        }
        $this->model_image2 = Media::where(['model_id' => $this->business_profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
        

        $this->categoryList = BusinessCategory::where('status', 1)->get();
        $this->serviceList = ServiceType::where('status', 1)->get();
        $this->stateList = State::get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
        $PublicIP = '14.97.180.194';
        //$PublicIP = $_SERVER['REMOTE_ADDR'];
        $details = file_get_contents("http://ipinfo.io/$PublicIP/geo");
        $json = json_decode($details,true);
        $this->location = $json['city'];
        
    }

    public function mailsetStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        // dd($value);
        $this->street_address = $get_street;
    }

    public function mailsetState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->state_id = $get_state_value->id;
        }else{
            $this->state_id = $value;
        }
        
    }

    public function mailsetZipCode($value)
    {
        $this->zip_code = $value;
    }

    public function mailsetCity($value)
    {
        $this->city = $value;
    }

    public function mailsetLatLng($data){
        $this->latitude = $data['lat'];
        $this->longitude = $data['lng'];
    }

    public function validationRuleForSave(): array
    {
       
        return
            [
                'business_category_id' => ['required'],
                'business_name' => ['required'],
                'service_type_id' => ['required'],
                'street_address' => ['required'],
                'city' => ['required'],
                'state_id' => ['required'],
                'zip_code' => ['required','min:5','max:5'],
                'business_page_link' => ['nullable'],
                'number_of_location' => ['required','numeric','gt:0'],  
                'status' => ['required'],
                'merchant_type' => ['required'],
                'business_type' => ['required'],
                'business_phone' => ['required',Rule::unique('business_profiles'), 'max:12', 'min:10'],
                'business_email' => ['required','email', Rule::unique('business_profiles'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'business_fax_number' => ['nullable',Rule::unique('business_profiles'),'min:6'],
                // 'latitude' => ['required'],
                // 'latitude' => ['longitude'],
            ];
      
    }
    public function validationRuleForUpdate(): array
    {
       
            return
                [
                    'business_category_id' => ['required'],
                    'business_name' => ['required'],
                    'service_type_id' => ['required'],
                    'street_address' => ['required'],
                    'city' => ['required'],
                    'state_id' => ['required'],
                    'zip_code' => ['required','min:5','max:5'],
                    'business_page_link' => ['nullable'],
                    'number_of_location' => ['required','numeric','gt:0'],
                    'status' => ['required'],
                    // 'merchant_type' => ['required'],
                    'business_type' => ['required'],
                    'business_phone' => ['required',Rule::unique('business_profiles')->ignore($this->business_profile->id), 'max:12', 'min:10'],
                    'business_email' => ['required','email', Rule::unique('business_profiles')->ignore($this->business_profile->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                    'business_fax_number' => ['nullable',Rule::unique('business_profiles')->ignore($this->business_profile->id),'min:6'],
                ];
            
    }
   
    protected $messages = [


        'business_category_id.required' => 'The Business Category field is required',
        'business_name.required' => 'The Business Name field is required',
        'service_type_id.required' => 'The Service Type field is required',
        'street_address.required' => 'The Street Address field is required',
        'city.required' => 'The City field is required',
        'state_id.required' => 'The State field is required',
        'zip_code.required' => 'The Zip Code field is required',
        'zip_code.min' => 'The Zip Code must be at least 5 characters.',
        'zip_code.max' => 'The Zip Code may not be greater than 5 characters.',
        // 'business_website.required' => 'The Businness Website field is required',
        'business_page_link' => 'The Business Website field must be a url',
        'number_of_location.required' => 'The Number of Location field is required',
        'number_of_location.numeric' => 'The Number of Location must be number',
        'status.required' => 'The Status field is required',
        'merchant_type.required' => 'The Merchant Type field is required',
        'business_type.required' => 'The Business Type field is required',
        'number_of_location.gt' => 'The Number of Location field must be grater than 0',
        'business_phone.required' => 'The Business Phone Number field is required',
        'business_phone.max' => 'The Business Phone Number may not be greater than 12 characters',
        'business_phone.min' => 'The Business Phone Number must be at least 10 characters',
        'business_phone.unique' => 'The Business Phone Number has already been taken',
        'business_email.required' => 'The Business Email field is required',
        'business_email.email' => 'The Business Email must be a valid email address',
        'business_email.unique' => 'The Business Email has already been taken',
        'business_email.regex' => 'The Business Email format is invalid',
        
        'business_fax_number.unique' => 'The Business Fax Number has already been taken',
        'business_fax_number.min' => 'The Business Fax Number must be at least 6 characters',
        
    ];
    public function saveOrUpdate()
    {
        

        if(!$this->isEdit){
            if($this->merchant_type == 'Basic'){
                if($this->number_of_location > 1){
                    $this->validate([
                        'number_of_location' => ['lt:2']
                    ], [
                        'number_of_location.lt' => 'The Number of Location field must be 1 for basic merchant type'
                    ]);
                   
                }

            }
        }
        

        $this->business_profile->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $businessid = strtoupper(substr($this->business_profile->business_name,0,3)).'/0'.$this->business_profile->id;
        $this->business_profile->businessId = $businessid;
        $this->business_profile->save();
        if ($this->logo) {
            if ($this->imgId1) {
                $item = Media::find($this->imgId1);
                $item->delete(); // delete previous image in the database

                $this->business_profile->addMedia($this->logo->getRealPath())
                    ->usingName($this->logo->getClientOriginalName())
                    ->toMediaCollection('businessProfileLogo');
            } else {
                // dd($this->business_logo);
                $this->business_profile->addMedia($this->logo->getRealPath())
                    ->usingName($this->logo->getClientOriginalName())
                    ->toMediaCollection('businessProfileLogo');
            }
        }

            // $this->business_location = new BusinessLocation;
            // $this->business_location->business_profile_id =  $this->business_profile->id;
            // $this->business_location->location_name =  $this->street_address;
            // $this->business_location->address =  $this->street_address;
            // $this->business_location->city =  $this->city;
            // $state_name = State::where('id',$this->state_id)->first();
            // $this->business_location->state =  $state_name->name;
            // $this->business_location->state_id = $this->state_id;
            // $this->business_location->zip_code =  $this->zip_code;
            // $this->business_location->location_type = 'Not Headquarters';
            // $this->business_location->participating_type = 'Participating';
            // if($this->latitude){
            //     $this->business_location->latitude = $this->latitude;
            // }
            // if($this->longitude){
            //     $this->business_location->longitude = $this->longitude;
            // }
            // $this->business_location->business_phone = $this->business_phone;
            // $this->business_location->business_email = $this->business_email;
            // $this->business_location->save();

            // $locationId =strtoupper(substr($this->business_profile->business_name,0,3)).'/'.strtoupper(substr($this->street_address,0,3)).'/0'.$this->business_location->id;
            // $this->business_location->locationId = $locationId; 
            // $this->business_location->save();


        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $this->business_profile->addMedia($photo->getRealPath())
                    ->usingName($photo->getClientOriginalName())
                    ->toMediaCollection('businessProfilePhoto');
            }
        }
       

       // $this->provider->fill($validatedData)->save();
    //    dd($this->business_profile);
        $msgAction = 'Business Profile was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('business-profile.index');
    }

    public function deleteImages($id)
    {
        $item = Media::find($id);
        $item->delete(); // delete previous image in the database
        $this->showModal('success', 'Success', 'Business profile photo deleted successfully');
        $this->emit('refreshProducts');
    }

    public function render()
    {
        return view('livewire.admin.business-profile.business-profile-create-edit');
    }
}
