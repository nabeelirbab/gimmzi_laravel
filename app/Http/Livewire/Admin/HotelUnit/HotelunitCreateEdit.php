<?php

namespace App\Http\Livewire\Admin\HotelUnit;

use Livewire\Component;
use App\Models\HotelUnites;
use App\Models\HotelBuildings;
use App\Models\TravelTourism;
use App\Models\User;
use App\Models\BuildingUnit;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use Illuminate\Support\Str;
use App\Http\Livewire\Traits\AlertMessage;

class HotelunitCreateEdit extends Component
{
    use AlertMessage;
    public $status,$building_id,$hotel_unit,$hotel_id,$unit_name;
    public $buildingList = [];
    public $providerList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($hotel_unit = null)
    {
        // dd($this->hotel_unit->hotel_id);
        if ($hotel_unit) {
            $this->hotel_unit = $hotel_unit;
            $this->fill($this->hotel_unit);
            // dd($this->unit_name);
            $this->isEdit = true;
            $this->buildingList = HotelBuildings::where('hotel_id',$this->hotel_unit->hotel_id)->get();
            
        } else
            $this->hotel_unit = new HotelUnites();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->buildingList = HotelBuildings::where('status',1)->get();
        $this->providerList = TravelTourism::where('status',1)->where('travel_tourism_type','Hotel-Resort')->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit_name' => ['required'],
                'status' => ['required'],
                'hotel_id' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit_name' => ['required'],
                'status' => ['required'],
                'hotel_id' => ['required']
            ];
    }

    protected $messages = [
        'building_id.required' => 'Please Select One Building atleast',
        'unit_name.required' => 'The Building Unit Field is required',
        'status.required' => 'The Status Field is required',
        'hotel_id.required' => 'Please Select One hotel'
    ];


    public function saveOrUpdate()
    {
        // dd($this->title_name);
        
        $this->hotel_unit->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $code = strtoupper(substr($this->hotel_unit->unit_name,0,3)).'/NEW/'.Str::random(2).'/0'.$this->hotel_unit->id;
        // $code = Str::random(6);
        $this->hotel_unit->unitId = $code;
        $this->hotel_unit->save();
        $msgAction = 'Building Unit was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('hotel-unit.index');
    }

    public function render()
    {
        return view('livewire.admin.hotel-unit.hotelunit-create-edit');
    }
}
