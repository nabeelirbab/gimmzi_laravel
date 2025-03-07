<?php

namespace App\Http\Livewire\Admin\ProviderUnit;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BuildingUnit;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use Livewire\Component;
use Illuminate\Support\Str;

class UnitCreateEdit extends Component
{
    use AlertMessage;
    public $status,$building_id,$provider_unit,$provider_id,$unit;
    public $buildingList = [];
    public $providerList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($provider_unit = null)
    {
        if ($provider_unit) {
            $this->provider_unit = $provider_unit;
            $this->fill($this->provider_unit);
            $this->isEdit = true;
            $this->buildingList = ProviderBuilding::where('provider_type_id',$this->provider_unit->provider_id)->get();
            
        } else
            $this->provider_unit = new BuildingUnit();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->buildingList = ProviderBuilding::where('status',1)->get();
        $this->providerList = Provider::where('status',1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit' => ['required'],
                'status' => ['required'],
                'provider_id' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit' => ['required'],
                'status' => ['required'],
                'provider_id' => ['required']
            ];
    }

    protected $messages = [
        'building_id.required' => 'Please Select One Building atleast',
        'unit.required' => 'The Building Unit Field is required',
        'status.required' => 'The Status Field is required',
        'provider_id.required' => 'Please Select One Provider'
    ];


    public function saveOrUpdate()
    {
        // dd($this->title_name);
        
        $this->provider_unit->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $code = Str::random(6);
        $this->provider_unit->access_code = $code;
        $this->provider_unit->save();
        $msgAction = 'Building Unit was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('provider-unit.index');
    }
    public function render()
    {
         return view('livewire.admin.provider-unit.unit-create-edit');
    }
}
