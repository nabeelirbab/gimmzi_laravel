<?php

namespace App\Http\Livewire\Admin\Hotelbuilding;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\HotelBuildings;
use App\Models\User;
use App\Models\TravelTourism;


class HotelbuildingCreateEdit extends Component
{
    use AlertMessage;
    public $status,$building_name,$building,$provider_id,$BuildingId,$hotel_id,$user_name;
    public $providerList = [];
    public $providerTypeList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($hotel_building = null)
    {
        if ($hotel_building) {
            $this->building = $hotel_building;
            $this->fill($this->building);
            $this->isEdit = true;
            // $this->user_name = $this->building->user->full_name;
            
        } else
            $this->building = new HotelBuildings();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->providerTypeList = TravelTourism::where('status',1)->where('travel_tourism_type','Hotel-Resort')->get();
        // $this->providerList = User::role('PROVIDER')->where('active',1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'building_name' => ['required', 'max:255'],
                // 'provider_id' => ['nullable'],
                'hotel_id' => ['required'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'building_name' => ['required', 'max:255'],
                // 'provider_id' => ['nullable'],
                'hotel_id' => ['required'],
                'status' => ['required']
            ];
    }

    protected $messages = [
        'building_name.required' => 'The Building Name Field is required',
        // 'provider_id.required' => 'Please select one Provider User',
        'hotel_id.required' => 'Please give one Hotel',
        'status.required' => 'The Status Field is required'];


    public function saveOrUpdate()
    {
    //    $user = User::where('provider_id', $this->hotel_id)->first();
    //    $this->provider_id = $user->id;
        // dd($this->provider_id);
        
        $this->building->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $provider = TravelTourism::find($this->building->hotel_id);
        $name = $provider->name;
        $buildingid = strtoupper(substr($this->building->building_name,0,3)).'/'.strtoupper(substr($name,0,3)).'/0'.$this->building->id;
        $this->building->BuildingId = $buildingid;
        $this->building->save();
        $msgAction = 'Building was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('hotel-buildings.index');
    }
    public function render()
    {
        return view('livewire.admin.hotelbuilding.hotelbuilding-create-edit');
    }
}
