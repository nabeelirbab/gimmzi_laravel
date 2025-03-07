<?php

namespace App\Http\Livewire\Admin\Provider;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Provider;
use App\Models\ProviderSubType;
use App\Models\ProviderType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\State;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class ProviderCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $address, $city, $state, $zip_code, $business_website, $points_to_distribute , $status, $points_cycle_date,$join_date, $provider, $business_logo_path, $photo_path,$name,$providerId;
    public $isEdit = false, $phone, $latitude, $longitude;
    public $statusList = [], $typeList = [], $subTypeList = [], $blankArr = [], $numberList = [];
    public $arrayList = [];
    public $photos = [];
    public $photo,$logo,$provider_sub_type_id,$provider_type_id;
    public $model_image1, $model_image2, $imgId, $state_id;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($provider = null)
    {
        if ($provider) {
            $this->provider = $provider;
            $this->fill($this->provider);
            $this->isEdit = true;
        } else
            $this->provider = new Provider();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->model_image1 = Media::where(['model_id' => $this->provider->id, 'collection_name' => 'businessLogo'])->first();
        if (!$this->model_image1 == null) {
            $this->imgId = $this->model_image1->id;
        }
        $this->model_image2 = Media::where(['model_id' => $this->provider->id, 'collection_name' => 'businessPhoto'])->get();
        //dd($this->model_image2);

        $this->typeList = ProviderType::whereIn('id',[1,2])->get();
        $this->subTypeList = ProviderSubType::whereIn('provider_type_id',[1,2])->get();
        $this->stateList = State::get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
        for($i = 1; $i<=28 ; $i++){
            array_push($this->numberList,[ "value"=> $i , "text"=> $i]) ;
        }
      //  dd($this->numberList);
        
    }
    public function validationRuleForSave(): array
    {
       
        return
            [
                'provider_sub_type_id' => ['required'],
                'address' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'zip_code' => ['required','min:5','max:5'],
                'business_website' => ['nullable','url'],
                'points_to_distribute' => ['required','numeric'],
                'points_cycle_date' => ['required'],
                'join_date' => ['required'],
                'logo' => ['required'],
                'photos' => ['required'],                
                'status' => ['required'],
                'name' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'phone' => ['nullable',Rule::unique('providers'),'max:12','min:10'],
               
            ];
      
    }
    public function validationRuleForUpdate(): array
    {
       
            return
                [
                'provider_sub_type_id' => ['required'],
                'address' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'zip_code' => ['required','min:5','max:5'],
                'business_website' => ['nullable','url'],
                'points_to_distribute' => ['required','numeric'],
                'points_cycle_date' => ['required'],
                'join_date' => ['required'],
                'logo' => ['nullable'],
                'photos' => ['nullable'],                
                'status' => ['required'],
                'name' => ['required'],
                'latitude' => ['required'],
                'longitude' => ['required'],
                'phone' => ['nullable',Rule::unique('providers')->ignore($this->provider->id),'max:12','min:10'],
                ];
            
    }
    protected $messages = [


        'provider_sub_type_id.required' => 'Please Select one Provider Type atleast',
        'address.required' => 'The Address field is required',
        'city.required' => 'The City field is required',
        'state.required' => 'The State field is required',
        'zip_code.required' => 'The Zip Code field is required',
        'zip_code.min' => 'The Zip Code must be at least 5 characters.',
        'zip_code.max' => 'The Zip Code may not be greater than 5 characters.',
        // 'business_website.required' => 'The Businness Website field is required',
        'business_website.url' => 'The Businness Website field must be a url',
        'points_to_distribute.required' => 'The Points To Distribute field is required',
        'points_to_distribute.numeric' => 'The Point To Distribute must be number',
        'points_cycle_date.required' => 'Please Select a Point Cycle Date',
        'join_date.required' => 'The Join Date field is required',
        'logo.required' => 'The Business Logo field is required',
        'photos.required' => 'The Photo field is required ',
        'status.required' => 'The Status field is required',
        'name.required' => 'The Name field is required',
        'phone.unique' => 'The Phone field has already been taken',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
    ];
    public function saveOrUpdate()
    {
        // dd($this->logo);
        $this->provider->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $provider_type = ProviderSubType::find($this->provider_sub_type_id);
        $type_id = $provider_type->provider_type_id;
        $providerid = strtoupper(substr($this->provider->name,0,3)).'/0'.$this->provider->id;
        $this->provider->providerId = $providerid;
        $this->provider->provider_type_id= $type_id;
        $this->provider->save();
        if ($this->logo) {
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->provider->addMedia($this->logo->getRealPath())
                    ->usingName($this->logo->getClientOriginalName())
                    ->toMediaCollection('propertyLogo');
            } else {
                //dd($this->logo);
                $this->provider->addMedia($this->logo->getRealPath())
                    ->usingName($this->logo->getClientOriginalName())
                    ->toMediaCollection('propertyLogo');
            }
        }
       
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $this->provider->addMedia($photo->getRealPath())
                    ->usingName($photo->getClientOriginalName())
                    ->toMediaCollection('propertyPhoto');
            }
        }

       // $this->provider->fill($validatedData)->save();
        
        $msgAction = 'Provider was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('providers.index');
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
        return view('livewire.admin.provider.provider-create-edit');
    }
}
