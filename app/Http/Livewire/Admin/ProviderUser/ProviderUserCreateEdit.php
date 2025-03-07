<?php

namespace App\Http\Livewire\Admin\ProviderUser;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Provider;
use App\Models\User;
use App\Models\ProviderType;
use App\Models\ProviderSubType;
use App\Models\Title;
use App\Models\PropertyUnderProviderUser;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class ProviderUserCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $first_name, $last_name, $email, $password, $phone, $phone_ext, $active, $password_confirmation, $provider_user, $profile_photo_path,$title_id;
    public $isEdit = false, $property_under_provider_user,$showpassfield,$hidepassfield;
    public $statusList = [], $typeList = [], $subTypeList = [], $blankArr = [],$titleList = [],$providerList = [];
    public $photo,$provider_sub_type_id,$provider_id,$provider_ids = [];
    public $model_image,$imgId;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($provider_user = null)
    {
        $this->showpassfield = false;
        if ($provider_user) {
            $this->provider_user = $provider_user;
            $this->fill($this->provider_user);
            $this->isEdit = true;
            $this->property_under_provider_user = PropertyUnderProviderUser::where('provider_user_id',$this->provider_user->id)->get();
            
            foreach($this->property_under_provider_user as $data){
                if(($this->provider_user->title_id == 3) || ($this->provider_user->title_id == 4)){
                    array_push($this->provider_ids,$data->provider_id);
                   
                }
                else{
                    $this->provider_id = $data->provider_id;
                }
            }
            //dd($this->provider_ids);
        }
        else{
            $this->provider_user = new User;
            $this->property_under_provider_user = new PropertyUnderProviderUser;
        }
            

        $this->statusList = [
            ['value' => 0, 'text' => "Choose User"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
       
        $this->model_image = Media::where(['model_id' => $this->provider_user->id, 'collection_name' => 'providerImages'])->first();
        if (!$this->model_image == null) {
            $this->imgId = $this->model_image->id;
        }
        else{
            $this->model_image = Media::where(['model_id' => $this->provider_id, 'collection_name' => 'businessLogo'])->first();
            if (!$this->model_image == null) {
                $this->imgId = $this->model_image->id;
            }
        }
        $this->typeList = ProviderType::all();
        $this->subTypeList = ProviderSubType::all();
        $this->providerList = Provider::where('status', 1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
        $this->titleList=Title::where('status',1)->where('title_name','!=','Lead Manager')->get();
    }
    public function validationRuleForSave(): array
    {
       
        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => [ 'nullable',Rule::unique('users'),'max:12','min:10'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6','same:password'],
                'active' => ['required'],
                'photo' => ['nullable'],
                'phone_ext' => ['nullable'],
                'title_id' => ['required'],
              
            ];
      
    }
    public function validationRuleForUpdate(): array
    {
        if($this->showpassfield == false){
            return
                [
                    'first_name' => ['required', 'max:255'],
                    'last_name' => ['required', 'max:255'],
                    'active' => ['required'],
                    'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->provider_user->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                    'phone' => ['nullable', Rule::unique('users')->ignore($this->provider_user->id),'max:12','min:10'],
                    // 'photo' => ['nullable'],
                    'phone_ext' => ['nullable'],
                    'title_id' => ['required'],
    
                ];
        }
    
        else{
                return
                    [
                        'first_name' => ['required', 'max:255'],
                        'last_name' => ['required', 'max:255'],
                        'active' => ['required'],
                        'email' => ['required','email', 'max:255', Rule::unique('users')->ignore($this->provider_user->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                        'phone' => ['nullable', Rule::unique('users')->ignore($this->provider_user->id),'max:12','min:10'],
                        // 'photo' => ['nullable'],
                        // 'provider_sub_type_id' => ['required'],
                        'phone_ext' => ['nullable'],
                        'title_id' => ['required'],
                        'password' => ['required', 'max:255', 'min:6'],
                        'password_confirmation' => ['required', 'max:255', 'min:6', 'same:password']
                    ];
        }
       
    }
    protected $messages = [
        'first_name.required' => 'The First Name field is required',
        'last_name.required' => 'The Last Name field is required',
        'email.required' => 'The Email field is required',
        // 'phone.required' => 'The Phone field is required',
        'password.required' => 'The Password field is required',
        'password_confirmation.required' => 'The Confirm Password field is required',
        'active.required' => 'The Status field is required',
        // 'photo.required' => 'The Profile Image field is required',
        'email.email' => 'The Email must be a valid email address',
        'email.unique' => 'The Email has already been taken',
        'email.regex' => 'The Email format is invalid',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
        'phone.unique' => 'The Phone has already been taken',
        'password.min' => 'The Password must be at least 6 characters',
        'password_confirmation.min' => 'The Confirm Password must be at least 6 characters',
        'password_confirmation.same' => 'The Confirm Password does not match with Password',
        'title_id.required' => 'Please select one Title',
        'provider_id.required' => 'Please select one Provider',
        'provider_id.unique' => 'This provider is already assigned under another Provider-User',


        

    ];
    public function saveOrUpdate()
    {
        $this->provider_user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $providerid = strtoupper(substr($this->provider_user->first_name,0,3)).'/PRO/0'.$this->provider_user->id;
        $this->provider_user->userId = $providerid;
        $this->provider_user->save();
        if(!$this->isEdit){
            if(($this->title_id == 3) || ($this->title_id == 4)){
                if(count($this->provider_ids) > 0){
                    foreach($this->provider_ids as $property){
                        $providertitle = PropertyUnderProviderUser::where('provider_id',$property)->where('title_id',$this->title_id)->first();
                        if($providertitle){
                            $title = Title::find($this->title_id);
                            $provider = Provider::find($property);
                            $msgAction = $provider->name.'('.$provider->providerId.')'.' has already one '.$title->title_name;
                            $this->showToastr("error", $msgAction);
                            return redirect()->route('provider-user.create');
                        }
                    }
                }
                else{
                    $this->validate(
                        [
                            'provider_ids' => ['required']
                        ],
                        [
                            'provider_ids.required' => 'Please select atleast one Provider',
                    
                        ]);
                }
                
            }
            else{
                if($this->provider_id != ''){
                    // $providertitle = PropertyUnderProviderUser::where('provider_id',$this->provider_id)->where('title_id',$this->title_id)->first();
                    //     if($providertitle){
                    //         $title = Title::find($this->title_id);
                    //         $msgAction = 'This property has already one '.$title->title_name;
                    //         $this->showToastr("error", $msgAction);
                    //         return redirect()->route('provider-user.create');
                    //     }
                }
                else{
                    $this->validate(
                        [
                            'provider_id' => ['required']
                        ],
                        [
                            'provider_id.required' => 'Please select one Provider',
                    
                        ]);
                }
            }
           
        }
        else{
            if($this->provider_user->title_id != $this->title_id){
                
                foreach($this->property_under_provider_user as $data){
                    $property = PropertyUnderProviderUser::find($data->id);
                    $property->title_id = $this->title_id;
                    $property->save();
                }
            }
            if(($this->title_id == 3) || ($this->title_id == 4)){
                //dd($this->provider_ids);
                if(count($this->provider_ids) > 0){
                    foreach($this->provider_ids as $property){
                        $providertitle1= PropertyUnderProviderUser::where('provider_id',$property)->where('title_id',$this->title_id)->where('provider_user_id','!=',$this->provider_user->id)->first();
                        if($providertitle1){
                            $title = Title::find($this->title_id);
                            $provider = Provider::find($property);
                            $msgAction = $provider->name.'('.$provider->providerId.')'.' has already one '.$title->title_name;
                            $this->showToastr("error", $msgAction);
                            return redirect()->route('provider-user.edit',$this->provider_user->id);
                        }
                        else{
                            $providertitle2 = PropertyUnderProviderUser::where('provider_id',$property)->where('title_id',$this->title_id)->where('provider_user_id',$this->provider_user->id)->first();
                            if($providertitle2 == null){
                                $data = array('provider_id' => $property,'provider_user_id' => $this->provider_user->id,'title_id' => $this->title_id);
                                PropertyUnderProviderUser::create($data);
                            }
                        }
                    }
                }
                else{
                    $this->validate(
                        [
                            'provider_ids' => ['required']
                        ],
                        [
                            'provider_ids.required' => 'Please select atleast one Provider',
                    
                        ]);
                    // $providertitle = PropertyUnderProviderUser::where('provider_id',$this->provider_id)->where('title_id',$this->title_id)->where('provider_user_id','!=',$this->provider_user->id)->first();
                    //     if($providertitle){
                    //         $title = Title::find($this->title_id);
                    //         $provider = Provider::find($property);
                    //         $msgAction = $provider->name.'('.$provider->providerId.')'.' has already one '.$title->title_name;
                    //         $this->showToastr("error", $msgAction);
                    //         return redirect()->route('provider-user.edit',$this->provider_user->id);
                    //     }
                }
                

            }
            else{
                
                if($this->provider_id != ''){
                    
                        // $providertitle1 = PropertyUnderProviderUser::where('provider_id',$property)->where('title_id',$this->title_id)->where('provider_user_id','!=',$this->provider_user->id)->first();
                        // if($providertitle1){
                        //     $title = Title::find($this->title_id);
                        //     $provider = Provider::find($property);
                        //     $msgAction = $provider->name.'('.$provider->providerId.')'.' has already one '.$title->title_name;
                        //     $this->showToastr("error", $msgAction);
                        //     return redirect()->route('provider-user.edit',$this->provider_user->id);
                        // }
                        // else{
                            
                            $providertitle2 = PropertyUnderProviderUser::where('provider_id',$this->provider_id)->where('title_id',$this->title_id)->where('provider_user_id',$this->provider_user->id)->first();
                            if($providertitle2 == null){
                                $data = array('provider_id' => $this->provider_id,'provider_user_id' => $this->provider_user->id,'title_id' => $this->title_id);
                                PropertyUnderProviderUser::create($data);
                                $providertitle3 = PropertyUnderProviderUser::where('provider_user_id',$this->provider_user->id)->where('provider_id','!=',$this->provider_id)->delete();
                                // if(count($providertitle3) > 0){
                                //     $providertitle3->each->delete();
                                // }
                            }
                            
                        //}
                    
                }
                else{
                    $this->validate(
                        [
                            'provider_id' => ['required']
                        ],
                        [
                            'provider_id.required' => 'Please select one Provider',
                    
                        ]);
                }
            }
        }

        if($this->isEdit){
            if(($this->title_id == 3) || ($this->title_id == 4)){
                if(count($this->property_under_provider_user) > 0){
                    foreach($this->property_under_provider_user as $value){
                        if(!in_array($value->provider_id,$this->provider_ids)){
                            $property = PropertyUnderProviderUser::where('provider_id',$value->provider_id)->where('provider_user_id',$this->provider_user->id)->where('title_id',$this->title_id)->first();
                            $property->delete();
                           
                        }
                    }
                }
            }
            
           
        }
       
        if(!$this->isEdit){
            $data = array('provider_id' => $this->provider_id,'provider_user_id' => $this->provider_user->id,'title_id' => $this->title_id);
            $this->property_under_provider_user->create($data);
        }
        
        if ($this->photo) {
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->provider_user->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('providerImages');
            } else {
                $this->provider_user->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('providerImages');
            }
        }
        else{
            
        }
       // $this->provider->fill($validatedData)->save();
        
        if (!$this->isEdit)
            $this->provider_user->assignRole('PROVIDER');
            $msgAction = 'Provider-user was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
            $this->showToastr("success", $msgAction);

        return redirect()->route('provider-user.index');
    }
    public function render()
    {
        return view('livewire.admin.provider-user.provider-user-create-edit');
    }

    public function showpasswordfield(){
        $this->showpassfield = true;
    }
    public function hidepasswordfield(){
        $this->hidepassfield = true;
        $this->showpassfield = false;
    }
    
}
