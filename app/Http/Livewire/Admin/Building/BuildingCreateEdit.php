<?php

namespace App\Http\Livewire\Admin\Building;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use Livewire\Component;
use App\Models\User;

class BuildingCreateEdit extends Component
{
    use AlertMessage;
    public $status,$building_name,$building,$provider_id,$BuildingId,$provider_type_id,$user_name;
    public $providerList = [];
    public $providerTypeList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($building = null)
    {
        if ($building) {
            $this->building = $building;
            $this->fill($this->building);
            $this->isEdit = true;
            $this->user_name = $this->building->user->full_name;
            
        } else
            $this->building = new ProviderBuilding();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->providerTypeList = Provider::where('status',1)->get();
        $this->providerList = User::role('PROVIDER')->where('active',1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'building_name' => ['required', 'max:255'],
                'provider_id' => ['nullable'],
                'provider_type_id' => ['required'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'building_name' => ['required', 'max:255'],
                'provider_id' => ['nullable'],
                'provider_type_id' => ['required'],
                'status' => ['required']
            ];
    }

    protected $messages = [
        'building_name.required' => 'The Building Name Field is required',
        // 'provider_id.required' => 'Please select one Provider User',
        'provider_type_id.required' => 'Please give one Provider',
        'status.required' => 'The Status Field is required'];


    public function saveOrUpdate()
    {
       $user = User::where('provider_id', $this->provider_type_id)->first();
       $this->provider_id = $user->id;
        // dd($this->provider_id);
        
        $this->building->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $provider = Provider::find($this->building->provider_type_id);
        $name = $provider->name;
        $buildingid = strtoupper(substr($this->building->building_name,0,3)).'/'.strtoupper(substr($name,0,3)).'/0'.$this->building->id;
        $this->building->BuildingId = $buildingid;
        $this->building->save();
        $msgAction = 'Building was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('buildings.index');
    }
    public function render()
    {
        return view('livewire.admin.building.building-create-edit');
    }
}
