<?php

namespace App\Http\Livewire\Admin\Merchant;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Title;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use App\Models\MerchantLocation;

class MerchantCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $first_name, $last_name, $email,$title_id, $password, $phone, $phone_ext, $active, $password_confirmation, $merchant, $profile_photo_path,$userId;
    public $isEdit = false, $business_id,$location_type, $mainlocation, $showpassfield,$hidepassfield;
    public $merchant_id,$location,$locations = [], $data = [], $locationList = [], $multipleLocationList = [], $singleLocation;
    public $statusList = [],$merchant_location;
    public $typeList = [],$blankArr = [],$titleList=[],$businessList=[];
    public $photo, $is_regular, $point;
    public $model_image,$imgId;
    public $location_ids = [], $location_id;
    protected $listeners = ['refreshProducts' => '$refresh','updateGimmziId'];
    public function mount($merchant = null)
    {
        $this->showpassfield = false;
        if ($merchant) {
            $this->merchant = $merchant;
            $this->fill($this->merchant);
            $this->isEdit = true;
        } else
            $this->merchant = new User;

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->typeList = [
            ['value' => 0, 'text' => "Choose Type"],
            ['value' => 'single', 'text' => "Single"],
            ['value' => 'multiple', 'text' => "Multiple"]
            
        ];
       
        
        $this->model_image = Media::where(['model_id' => $this->merchant->id, 'collection_name' => 'merchantImages'])->first();
        if (!$this->model_image == null) {
            $this->imgId = $this->model_image->id;
        }
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
        $this->titleList=Title::where('status',1)->get();
        $this->businessList=BusinessProfile::where('status',1)->get();
        if($this->isEdit){
            // $this->userId = '';
            $this->merchant_location = $this->merchant->location;
            $this->fill($this->merchant_location);
            if(count($this->merchant_location) > 0)
          
            $this->locationList = BusinessLocation::where('business_profile_id',$this->business_id)->get();
            $this->multipleLocationList = MerchantLocation::with('businessLocation')->where('user_id', $this->merchant->id)->get();
            $this->singleLocation = MerchantLocation::with('businessLocation')->where('user_id', $this->merchant->id)->first();
            if($this->location_type == 'multiple'){
                foreach($this->merchant_location as $values){
                    if($values->is_main == 1){
                        $this->mainlocation = $values->location_id;
                    }
                    array_push($this->locations,$values->location_id);
                }
                $this->location = '';
            }
            else{
                foreach($this->merchant_location as $values){
                    $this->location = $values->location_id;
                }
                $this->locations = [];
            }
            
            //dd($this->location);
        }

        
    }

    public function updateGimmziId($gimmziId)
    {
        $this->userId = $gimmziId;
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['required', Rule::unique('users'),'max:12','min:10'],
                'phone_ext' => ['nullable'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                'active' => ['required'],
                'photo' => ['nullable'],
                'title_id' => ['required'],
                'business_id' => ['required'],
                'userId' => ['required',Rule::unique('users')],
                
            ];
           
    }
    public function validationRuleForUpdate(): array
    {
        
            return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'active' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                'phone_ext' => ['nullable'],
                'photo' => ['nullable'],
                'is_regular' => ['nullable'],
                'title_id' => ['required'],
                'business_id' => ['nullable'],
                'userId' => ['required',Rule::unique('users')],
            ];
        
        
    }


    
    protected $messages = [
        'first_name.required' => 'The First Name Field is required',
        'last_name.required' => 'The Last Name Field is required',
        'email.required' => 'The Email Field is required',
        'phone.required' => 'The Phone Field is required',
        'password.required' => 'The Password Field is required',
        'password_confirmation.required' => 'The Confirm Password Field is required',
        'active.required' => 'The Status field is required',
        // 'photo.required' => 'The Profile Image Field is required',
        'email.email' => 'The Email must be a valid email address',
        'email.unique' => 'The Email has already been taken',
        'email.regex' => 'The Email format is invalid',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
        'phone.unique' => 'The Phone has already been taken',
        'password.min' => 'The Password must be at least 6 characters',
        'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
        'password_confirmation.same' => 'The Confirm Password does not match with Password',
        'title_id.required' => 'Please select one Title atleast',
        'business_id.required' => 'Please select one Merchant Business atleast',
        'userId.required' => 'Gimmzi Id field is required.'

    ];
    public function saveOrUpdate()
    {

        // dd($this->userId);
        if(!$this->isEdit){
            if($this->business_id != ''){
                $business = BusinessProfile::find($this->business_id);
                $type = $business->merchant_type;
                if($type == 'Plus'){
                    if($this->location_type == 'single'){
                      //  dd($this->location);
                      if($this->showpassfield == false){
                        $this->validate(
                        
                            [
                                'first_name' => ['required', 'max:255'],
                                'last_name' => ['required', 'max:255'],
                                'active' => ['required'],
                                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                'photo' => ['nullable'],
                                'phone_ext' => ['nullable'],
                                // 'password' => ['required', 'max:255', 'min:6'],
                                // 'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                'is_regular' => ['nullable'],
                                'title_id' => ['required'],
                                'business_id' => ['required'],
                                'location_type' => ['required'],
                                'location' => ['required'],
                                'mainlocation' => ['required'],
                                'userId' => ['required'],

                            ],
                            [
                                'first_name.required' => 'The First Name Field is required',
                                'last_name.required' => 'The Last Name Field is required',
                                'email.required' => 'The Email Field is required',
                                'phone.required' => 'The Phone Field is required',
                                'password.required' => 'The Password Field is required',
                                'password_confirmation.required' => 'The Confirm Password Field is required',
                                'active.required' => 'The Status field is required',
                                // 'photo.required' => 'The Profile Image Field is required',
                                'email.email' => 'The Email must be a valid email address',
                                'email.unique' => 'The Email has already been taken',
                                'email.regex' => 'The Email format is invalid',
                                'phone.max' => 'The Phone may not be greater than 12 characters',
                                'phone.min' => 'The Phone must be at least 10 characters',
                                'phone.unique' => 'The Phone has already been taken',
                                'password.min' => 'The Password must be at least 6 characters',
                                'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                'title_id.required' => 'The Title field is required',
                                'business_id.required' => 'The Merchant Business field is required',
                                'location_type.required' => 'The Location Type field is required',
                                'location.required' => 'The Single Location field is required',
                                'mainlocation.required' => 'Please select one main location',
                                'userId.required' => 'Gimmzi Id field is required.'
                        
                            ]
                        );
                      }else{
                        $this->validate(
                        
                            [
                                'first_name' => ['required', 'max:255'],
                                'last_name' => ['required', 'max:255'],
                                'active' => ['required'],
                                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                'photo' => ['nullable'],
                                'phone_ext' => ['nullable'],
                                'password' => ['required', 'max:255', 'min:6'],
                                'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                'is_regular' => ['nullable'],
                                'title_id' => ['required'],
                                'business_id' => ['required'],
                                'location_type' => ['required'],
                                'location' => ['required'],
                                'mainlocation' => ['required'],
                                'userId' => ['required'],

                            ],
                            [
                                'first_name.required' => 'The First Name Field is required',
                                'last_name.required' => 'The Last Name Field is required',
                                'email.required' => 'The Email Field is required',
                                'phone.required' => 'The Phone Field is required',
                                'password.required' => 'The Password Field is required',
                                'password_confirmation.required' => 'The Confirm Password Field is required',
                                'active.required' => 'The Status field is required',
                                // 'photo.required' => 'The Profile Image Field is required',
                                'email.email' => 'The Email must be a valid email address',
                                'email.unique' => 'The Email has already been taken',
                                'email.regex' => 'The Email format is invalid',
                                'phone.max' => 'The Phone may not be greater than 12 characters',
                                'phone.min' => 'The Phone must be at least 10 characters',
                                'phone.unique' => 'The Phone has already been taken',
                                'password.min' => 'The Password must be at least 6 characters',
                                'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                'title_id.required' => 'The Title field is required',
                                'business_id.required' => 'The Merchant Business field is required',
                                'location_type.required' => 'The Location Type field is required',
                                'location.required' => 'The Single Location field is required',
                                'mainlocation.required' => 'Please select one main location',
                                'userId.requred' => 'Gimmzi Id field is required'
                        
                            ]
                        );
                      }
                        
                            $this->data = array('first_name' => $this->first_name,
                                                'last_name' => $this->last_name,
                                                'email' => $this->email,
                                                'phone' => $this->phone,
                                                'phone_ext' => $this->phone_ext,
                                                'password' => $this->password,
                                                'active' => $this->active,
                                                'title_id' => $this->title_id,
                                                'business_id' => $this->business_id,
                                                'location_type' => $this->location_type,
                                                'userId' => $this->userId,
                            );
                        $this->merchant->fill($this->data)->save();
                        $location = new MerchantLocation;
                        $location->user_id = $this->merchant->id;
                        $location->location_id = $this->location;
                        $location->status = true;
                        $location->save();
                 
                        // $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                        // if($mainloc){
                        //     $mainloc->is_main = 1;
                        //     $mainloc->save();
                        // }
                        
                    }
                    elseif($this->location_type == 'multiple'){
                      //  dd(count($this->locations));
                      if($this->showpassfield == false){
                        $this->validate(
                            [
                                'first_name' => ['required', 'max:255'],
                                'last_name' => ['required', 'max:255'],
                                'active' => ['required'],
                                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                'photo' => ['nullable'],
                                'phone_ext' => ['nullable'],
                                // 'password' => ['required', 'max:255', 'min:6'],
                                // 'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                'is_regular' => ['nullable'],
                                'title_id' => ['required'],
                                'business_id' => ['required'],
                                'location_type' => ['required'],
                                'locations' => ['required'],
                                'mainlocation' => ['required'],
                                'userId' => ['required'],

                            
                            ],
                            [
                                'first_name.required' => 'The First Name Field is required',
                                'last_name.required' => 'The Last Name Field is required',
                                'email.required' => 'The Email Field is required',
                                'phone.required' => 'The Phone Field is required',
                                'password.required' => 'The Password Field is required',
                                'password_confirmation.required' => 'The Confirm Password Field is required',
                                'active.required' => 'The Status field is required',
                                // 'photo.required' => 'The Profile Image Field is required',
                                'email.email' => 'The Email must be a valid email address',
                                'email.unique' => 'The Email has already been taken',
                                'email.regex' => 'The Email format is invalid',
                                'phone.max' => 'The Phone may not be greater than 12 characters',
                                'phone.min' => 'The Phone must be at least 10 characters',
                                'phone.unique' => 'The Phone has already been taken',
                                'password.min' => 'The Password must be at least 6 characters',
                                'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                'title_id.required' => 'The Title field is required',
                                'business_id.required' => 'The Merchant Business field is required',
                                'location_type.required' => 'The Location Type field is required',
                                'locations.required' => 'The Multiple Location field is required',
                                'mainlocation.required' => 'Please select one main location',
                                'userId.required' =>'Gimmzi Id field is required',

                                // 'locations.array' => 'The Multiple Location field should be multiple select',
                                // 'locations.*.required' => 'The Multiple Location field should be multiple select',

                            ]);
                      }else{
                        $this->validate(
                            [
                                'first_name' => ['required', 'max:255'],
                                'last_name' => ['required', 'max:255'],
                                'active' => ['required'],
                                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                'photo' => ['nullable'],
                                'phone_ext' => ['nullable'],
                                'password' => ['required', 'max:255', 'min:6'],
                                'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                'is_regular' => ['nullable'],
                                'title_id' => ['required'],
                                'business_id' => ['required'],
                                'location_type' => ['required'],
                                'locations' => ['required'],
                                'mainlocation' => ['required'],
                                'userId' => ['required'],

                            
                            ],
                            [
                                'first_name.required' => 'The First Name Field is required',
                                'last_name.required' => 'The Last Name Field is required',
                                'email.required' => 'The Email Field is required',
                                'phone.required' => 'The Phone Field is required',
                                'password.required' => 'The Password Field is required',
                                'password_confirmation.required' => 'The Confirm Password Field is required',
                                'active.required' => 'The Status field is required',
                                // 'photo.required' => 'The Profile Image Field is required',
                                'email.email' => 'The Email must be a valid email address',
                                'email.unique' => 'The Email has already been taken',
                                'email.regex' => 'The Email format is invalid',
                                'phone.max' => 'The Phone may not be greater than 12 characters',
                                'phone.min' => 'The Phone must be at least 10 characters',
                                'phone.unique' => 'The Phone has already been taken',
                                'password.min' => 'The Password must be at least 6 characters',
                                'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                'title_id.required' => 'The Title field is required',
                                'business_id.required' => 'The Merchant Business field is required',
                                'location_type.required' => 'The Location Type field is required',
                                'locations.required' => 'The Multiple Location field is required',
                                'mainlocation.required' => 'Please select one main location',
                                'userId.required' => 'Gimmzi Id field is required',
                                // 'locations.array' => 'The Multiple Location field should be multiple select',
                                // 'locations.*.required' => 'The Multiple Location field should be multiple select',

                            ]);
                      }
                            
                            
                            
                            $this->data = array('first_name' => $this->first_name,
                                                'last_name' => $this->last_name,
                                                'email' => $this->email,
                                                'phone' => $this->phone,
                                                'phone_ext' => $this->phone_ext,
                                                'password' => $this->password,
                                                'active' => $this->active,
                                                'title_id' => $this->title_id,
                                                'business_id' => $this->business_id,
                                                'location_type' => $this->location_type,
                                                'userId'=>$this->userId
                            );
                            $this->merchant->fill($this->data)->save();
                            if(count($this->locations) > 0){
                                for($i = 0; $i < count($this->locations); $i++){
                                    $location = new MerchantLocation;
                                    $location->user_id = $this->merchant->id;
                                    $location->location_id = $this->locations[$i];
                                    $location->status = true;
                                    $location->save();
                                }
                            }
                    }
                    else{
                        if($this->showpassfield == false){
                            $this->validate(
                                [
                                    'first_name' => ['required', 'max:255'],
                                    'last_name' => ['required', 'max:255'],
                                    'active' => ['required'],
                                    'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                    'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                    'photo' => ['nullable'],
                                    'phone_ext' => ['nullable'],
                                    // 'password' => ['required', 'max:255', 'min:6'],
                                    // 'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                    'is_regular' => ['nullable'],
                                    'title_id' => ['required'],
                                    'business_id' => ['required'],
                                    'location_type' => ['required'],
                                    'userId' => ['required'],

                                    
                                ],
                                [
                                    'first_name.required' => 'The First Name Field is required',
                                    'last_name.required' => 'The Last Name Field is required',
                                    'email.required' => 'The Email Field is required',
                                    'phone.required' => 'The Phone Field is required',
                                    'password.required' => 'The Password Field is required',
                                    'password_confirmation.required' => 'The Confirm Password Field is required',
                                    'active.required' => 'The Status field is required',
                                    // 'photo.required' => 'The Profile Image Field is required',
                                    'email.email' => 'The Email must be a valid email address',
                                    'email.unique' => 'The Email has already been taken',
                                    'email.regex' => 'The Email format is invalid',
                                    'phone.max' => 'The Phone may not be greater than 12 characters',
                                    'phone.min' => 'The Phone must be at least 10 characters',
                                    'phone.unique' => 'The Phone has already been taken',
                                    'password.min' => 'The Password must be at least 6 characters',
                                    'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                    'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                    'title_id.required' => 'The Title field is required',
                                    'business_id.required' => 'The Merchant Business field is required',
                                    'location_type.required' => 'The Location Type field is required',
                                    'userId.required'=>'Gimmzi Id field is required'
    
                                ]);
                        }else{
                            $this->validate(
                                [
                                    'first_name' => ['required', 'max:255'],
                                    'last_name' => ['required', 'max:255'],
                                    'active' => ['required'],
                                    'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                                    'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                                    'photo' => ['nullable'],
                                    'phone_ext' => ['nullable'],
                                    'password' => ['required', 'max:255', 'min:6'],
                                    'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                                    'is_regular' => ['nullable'],
                                    'title_id' => ['required'],
                                    'business_id' => ['required'],
                                    'location_type' => ['required'],
                                    'userId' => ['required'],

                                    
                                ],
                                [
                                    'first_name.required' => 'The First Name Field is required',
                                    'last_name.required' => 'The Last Name Field is required',
                                    'email.required' => 'The Email Field is required',
                                    'phone.required' => 'The Phone Field is required',
                                    'password.required' => 'The Password Field is required',
                                    'password_confirmation.required' => 'The Confirm Password Field is required',
                                    'active.required' => 'The Status field is required',
                                    // 'photo.required' => 'The Profile Image Field is required',
                                    'email.email' => 'The Email must be a valid email address',
                                    'email.unique' => 'The Email has already been taken',
                                    'email.regex' => 'The Email format is invalid',
                                    'phone.max' => 'The Phone may not be greater than 12 characters',
                                    'phone.min' => 'The Phone must be at least 10 characters',
                                    'phone.unique' => 'The Phone has already been taken',
                                    'password.min' => 'The Password must be at least 6 characters',
                                    'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                                    'password_confirmation.same' => 'The Confirm Password does not match with Password',
                                    'title_id.required' => 'The Title field is required',
                                    'business_id.required' => 'The Merchant Business field is required',
                                    'location_type.required' => 'The Location Type field is required',
                                    'userId.required' => 'Gimmzi Id field is required'
    
                                ]);
                        }
                        
                    }
                    
                   
                }
                else{
                        $this->merchant->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                }
            }
            else{
                $this->merchant->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
            }
        }
        else{
            // dd($this->userId);
            $business = BusinessProfile::find($this->business_id);
            $type = $business->merchant_type;
            if($type == 'Basic'){
                $this->merchant->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                $this->merchant->location_type = NULL;
                $this->merchant->save();
                if(count($this->merchant_location) > 0){
                    for($i = 0; $i < count($this->merchant_location); $i++){
                        $loc = MerchantLocation::find($this->merchant_location[$i]->id);
                        $loc->delete();
                    }
                }
                
            }
            else{
                if($this->location_type == 'single'){
                    $this->validate(
                        [
                            'first_name' => ['required', 'max:255'],
                            'last_name' => ['required', 'max:255'],
                            'active' => ['required'],
                            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                            'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                            'photo' => ['nullable'],
                            'phone_ext' => ['nullable'],
                            'title_id' => ['required'],
                            'business_id' => ['required'],
                            'location_type' => ['required'],
                            'location' => ['required'],
                            'mainlocation' => ['required'],
                            'userId' => ['required'],

                        ],
                        [
                            'first_name.required' => 'The First Name Field is required',
                            'last_name.required' => 'The Last Name Field is required',
                            'email.required' => 'The Email Field is required',
                            'phone.required' => 'The Phone Field is required',
                            'password.required' => 'The Password Field is required',
                            'password_confirmation.required' => 'The Confirm Password Field is required',
                            'active.required' => 'The Status field is required',
                            // 'photo.required' => 'The Profile Image Field is required',
                            'email.email' => 'The Email must be a valid email address',
                            'email.unique' => 'The Email has already been taken',
                            'email.regex' => 'The Email format is invalid',
                            'phone.max' => 'The Phone may not be greater than 12 characters',
                            'phone.min' => 'The Phone must be at least 10 characters',
                            'phone.unique' => 'The Phone has already been taken',
                            'title_id.required' => 'The Title field is required',
                            'business_id.required' => 'The Merchant Business field is required',
                            'location_type.required' => 'The Location Type field is required',
                            'location.required' => 'The Single Location field is required',
                            'mainlocation.required' => 'Please select one main location',
                            'userId.required' => 'Gimmzi Id field is required.'
                    
                        ]);
                        
                        $this->data = array('first_name' => $this->first_name,
                                            'last_name' => $this->last_name,
                                            'email' => $this->email,
                                            'phone' => $this->phone,
                                            'phone_ext' => $this->phone_ext,
                                            'password' => $this->password,
                                            'active' => $this->active,
                                            'title_id' => $this->title_id,
                                            'business_id' => $this->business_id,
                                            'location_type' => $this->location_type,
                                            'userId' => $this->userId
                        );
                        $this->merchant->fill($this->data)->save();
                        // $merchantid = strtoupper(substr($this->merchant->first_name,0,3)).'/MER/0'.$this->merchant->id;
                        // $this->merchant->userId = $merchantid;
                        $this->merchant->save();
                        if(count($this->merchant_location) > 1){
                            for($i = 0; $i< count($this->merchant_location); $i++){
                                $loc = MerchantLocation::find($this->merchant_location[$i]->id);
                                if($i == 0){
                                    $loc->location_id = $this->location;
                                    $loc->is_main = 1;
                                    $loc->save();
                                }
                                else{
                                    $loc->delete();
                                }
                            }
                        }
                        elseif(count($this->merchant_location) == 1){
                            foreach($this->merchant_location as $merchantloc){
                                $loc = MerchantLocation::find($merchantloc->id);
                                $loc->location_id = $this->location;
                                $loc->is_main = 1;
                                $loc->save();

                            } 

                        }
                        else{
                            $mlocation = new MerchantLocation;
                            $mlocation->location_id = $this->location;
                            $mlocation->user_id = $this->merchant->id;
                            $mlocation->status = true;
                            $mlocation->is_main = 1;
                            $mlocation->save();
                        }
                }
                elseif($this->location_type == 'multiple'){
                    $this->validate(
                        [
                            'first_name' => ['required', 'max:255'],
                            'last_name' => ['required', 'max:255'],
                            'active' => ['required'],
                            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                            'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                            'title_id' => ['required'],
                            'phone_ext' => ['nullable'],
                            'business_id' => ['required'],
                            'location_type' => ['required'],
                            'locations' => ['required'],
                            'mainlocation' => ['required'],
                            'userId' => ['required'],

                        ],
                        [
                            'first_name.required' => 'The First Name Field is required',
                            'last_name.required' => 'The Last Name Field is required',
                            'email.required' => 'The Email Field is required',
                            'phone.required' => 'The Phone Field is required',
                            'active.required' => 'The Status field is required',
                            // 'photo.required' => 'The Profile Image Field is required',
                            'email.email' => 'The Email must be a valid email address',
                            'email.unique' => 'The Email has already been taken',
                            'email.regex' => 'The Email format is invalid',
                            'phone.max' => 'The Phone may not be greater than 12 characters',
                            'phone.min' => 'The Phone must be at least 10 characters',
                            'phone.unique' => 'The Phone has already been taken',
                            'title_id.required' => 'The Title field is required',
                            'business_id.required' => 'The Merchant Business field is required',
                            'location_type.required' => 'The Location Type field is required',
                            'locations.required' => 'The Multiple Location field is required',
                            'mainlocation.required' => 'Please select one main location',
                            'userId.required'=>'Gimmzi Id field is required'
                           
                    
                        ]);
                        $this->data = array('first_name' => $this->first_name,
                                            'last_name' => $this->last_name,
                                            'email' => $this->email,
                                            'phone' => $this->phone,
                                            'phone_ext' => $this->phone_ext,
                                            'password' => $this->password,
                                            'active' => $this->active,
                                            'title_id' => $this->title_id,
                                            'business_id' => $this->business_id,
                                            'location_type' => $this->location_type,
                                            'userId'=>$this->userId
                        );
                        $this->merchant->fill($this->data)->save();
                        // $merchantid = strtoupper(substr($this->merchant->first_name,0,3)).'/MER/0'.$this->merchant->id;
                        // $this->merchant->userId = $merchantid;
                        $this->merchant->save();
                        if(count($this->merchant_location) ==  count($this->locations)){
                            for($i = 0; $i < count($this->merchant_location); $i++){
                                $loc = MerchantLocation::find($this->merchant_location[$i]->id);
                                $loc->location_id = $this->locations[$i];
                                $loc->save();
                            }
                            $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                            if($mainloc){
                                $mainloc->is_main = 1;
                                $mainloc->save();
                            }
                        }
                        elseif(count($this->merchant_location) > count($this->locations)){
                            for($i = 0; $i < count($this->merchant_location); $i++){
                                $loc = MerchantLocation::find($this->merchant_location[$i]->id);
                                if(isset($this->locations[$i])){
                                    $loc->location_id = $this->locations[$i];
                                    $loc->save();
                                    $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                                    if($mainloc){
                                        $mainloc->is_main = 1;
                                        $mainloc->save();
                                    }
                                }
                                else{
                                    $loc->delete();
                                }
                                
                            }
                        }
                        elseif(count($this->merchant_location) < count($this->locations)){
                          
                            for($i = 0; $i < count($this->locations); $i++){
                                if(isset($this->merchant_location[$i])){
                                    $loc = MerchantLocation::find($this->merchant_location[$i]->id);
                                    $loc->location_id = $this->locations[$i];
                                    $loc->save();
                                    $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                                    if($mainloc){
                                        $mainloc->is_main = 1;
                                        $mainloc->save();
                                    }
                                }
                                else{
                                    $mlocation = new MerchantLocation;
                                    $mlocation->location_id = $this->locations[$i];
                                    $mlocation->user_id = $this->merchant->id;
                                    $mlocation->status = true;
                                    $mlocation->save();
                                    $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                                    if($mainloc){
                                        $mainloc->is_main = 1;
                                        $mainloc->save();
                                    }
                                }
                            }
                        }
                        else{
                            for($i = 0; $i < count($this->locations); $i++){
                                $mlocation = new MerchantLocation;
                                $mlocation->location_id = $this->locations[$i];
                                $mlocation->user_id = $this->merchant->id;
                                $mlocation->status = true;
                                $mlocation->save();
                                $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
                                    if($mainloc){
                                        $mainloc->is_main = 1;
                                        $mainloc->save();
                                    }
                            }
                        }
                        
                }
                else{
                    $this->validate(
                        [
                            'first_name' => ['required', 'max:255'],
                            'last_name' => ['required', 'max:255'],
                            'active' => ['required'],
                            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->merchant->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                            'phone' => ['required', Rule::unique('users')->ignore($this->merchant->id),'max:12','min:10'],
                            'photo' => ['nullable'],
                            'phone_ext' => ['nullable'],
                            'password' => ['required', 'max:255', 'min:6'],
                            'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                            'is_regular' => ['nullable'],
                            'title_id' => ['required'],
                            'business_id' => ['required'],
                            'location_type' => ['required'],
                            'userId' => ['required'],
                            
                        ],
                        [
                            'first_name.required' => 'The First Name Field is required',
                            'last_name.required' => 'The Last Name Field is required',
                            'email.required' => 'The Email Field is required',
                            'phone.required' => 'The Phone Field is required',
                            'password.required' => 'The Password Field is required',
                            'password_confirmation.required' => 'The Confirm Password Field is required',
                            'active.required' => 'The Status field is required',
                            // 'photo.required' => 'The Profile Image Field is required',
                            'email.email' => 'The Email must be a valid email address',
                            'email.unique' => 'The Email has already been taken',
                            'email.regex' => 'The Email format is invalid',
                            'phone.max' => 'The Phone may not be greater than 12 characters',
                            'phone.min' => 'The Phone must be at least 10 characters',
                            'phone.unique' => 'The Phone has already been taken',
                            'password.min' => 'The Password must be at least 6 characters',
                            'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
                            'password_confirmation.same' => 'The Confirm Password does not match with Password',
                            'title_id.required' => 'The Title field is required',
                            'business_id.required' => 'The Merchant Business field is required',
                            'location_type.required' => 'The Location Type field is required',
                            'userId.required' => 'Gimmzi Id field is required.'

                        ]);
                    
                }
            }
        }
                
        // $this->merchant->business_id = $this->business_id;
        // $this->merchant->save();
        if ($this->photo) {
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->merchant->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('merchantImages');
            } else {
                $this->merchant->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('merchantImages');
            }
        }        
        if (!$this->isEdit){
            $this->merchant->assignRole('MERCHANT');
            // $merchantid = strtoupper(substr($this->merchant->first_name,0,3)).'/MER/0'.$this->merchant->id;
            // $this->merchant->userId = $merchantid;
            $this->merchant->userId = $this->userId;
            $this->merchant->save();
            $mainloc = MerchantLocation::where('location_id',$this->mainlocation)->where('user_id', $this->merchant->id)->first();
            if($mainloc){
                $mainloc->is_main = 1;
                $mainloc->save();
            }
        }
            
        $msgAction = 'Merchant was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('merchants.index');
    }
    public function render()
    {
        return view('livewire.admin.merchant.merchant-create-edit');
    }

    public function showpasswordfield(){
        $this->showpassfield = true;
    }
    public function hidepasswordfield(){
        $this->hidepassfield = true;
        $this->showpassfield = false;
    }
}
