<?php

namespace App\Http\Livewire\Admin\ShortRental;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\State;
use App\Models\TravelTourism;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class ShortRentalCreateEdit extends Component
{

    
    use WithFileUploads;
    use AlertMessage;
    public $address, $city, $state, $zip_code, $points_to_distribute , $status,$name, $short_rental;
    public $isEdit = false, $phone;
    public $statusList = [], $blankArr = [],$stateList = [];
    public $photo,$logo,$provider_sub_type_id;
    public $model_image,  $imgId, $state_id;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($short_rental = null)
    {
        
        if ($short_rental) {
            $this->short_rental = $short_rental;
            $this->fill($this->short_rental);
            $this->isEdit = true;
        } else
      
            $this->short_rental = new TravelTourism();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

       
        
        $this->model_image = Media::where(['model_id' => $this->short_rental->id, 'collection_name' => 'shortRentalPhoto'])->first();
        if (!$this->model_image == null) {
            $this->imgId = $this->model_image->id;
        }
       

     
        $this->stateList = State::get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
       
      //  dd($this->numberList);
        
    }
    public function validationRuleForSave(): array
    {
       
        return
            [
                'address' => ['required'],
                'city' => ['required'],
                'state_id' => ['required'],
                'zip_code' => ['required','min:5','max:5'],
                'points_to_distribute' => ['required','numeric'],
                'photo' => ['required'],                
                'status' => ['required'],
                'name' => ['required'],
                'phone' => ['nullable',Rule::unique('travel_tourisms'),'max:12','min:10'],
               
            ];
      
    }
    public function validationRuleForUpdate(): array
    {
       
            return
                [
                    'address' => ['required'],
                    'city' => ['required'],
                    'state_id' => ['required'],
                    'zip_code' => ['required','min:5','max:5'],
                    'points_to_distribute' => ['required','numeric'],
                    'photo' => ['nullable'],                
                    'status' => ['required'],
                    'name' => ['required'],
                    'phone' => ['nullable',Rule::unique('travel_tourisms')->ignore($this->short_rental->id),'max:12','min:10'],
                   
                ];
            
    }
    protected $messages = [


        'address.required' => 'The Address field is required',
        'city.required' => 'The City field is required',
        'state_id.required' => 'The State field is required',
        'zip_code.required' => 'The Zip Code field is required',
        'zip_code.min' => 'The Zip Code must be at least 5 characters.',
        'zip_code.max' => 'The Zip Code may not be greater than 5 characters.',
        'points_to_distribute.required' => 'The Points To Distribute field is required',
        'points_to_distribute.numeric' => 'The Point To Distribute must be number',
        'photo.required' => 'The Photo field is required ',
        'status.required' => 'The Status field is required',
        'name.required' => 'The Name field is required',
        'phone.unique' => 'The Phone field has already been taken',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
    ];
    public function saveOrUpdate()
    {

        $this->short_rental->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $this->short_rental->travel_tourism_type = 'Short Rental';
        $this->short_rental->save();
        if ($this->photo) {
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->short_rental->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('shortRentalPhoto');
            } else {
                //dd($this->logo);
                $this->short_rental->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('shortRentalPhoto');
            }
        }

        $msgAction = 'Short Term Rental was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('short-rentals.index');
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
        return view('livewire.admin.short-rental.short-rental-create-edit');
    }
}
