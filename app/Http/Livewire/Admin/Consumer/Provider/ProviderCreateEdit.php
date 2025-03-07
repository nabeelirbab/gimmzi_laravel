<?php

namespace App\Http\Livewire\Admin\Consumer\Provider;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BuildingUnit;
use App\Models\ConsumerUnit;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use App\Models\ProviderType;
use Livewire\Component;
use App\Models\PropertyUnderProviderUser;

class ProviderCreateEdit extends Component
{
    use AlertMessage;
    public $status,$building_id,$provider_unit,$provider_id,$unit_id,$type_id,$user_id;
    public $buildingList = [];
    public $providerList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    public $typeList = [];
    public $providernameList = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($consumer_unit = null,$user_id = null)
    {
    
        if ($consumer_unit) {
            $this->provider_unit = $consumer_unit;
            $this->fill($this->provider_unit);
            $this->isEdit = true;
            $this->providernameList = Provider::find($this->provider_unit->provider_type_id);
            $this->user_id = $user_id;
            $this->type_id = $this->providernameList->provider_type_id;
            $this->provider_id = $this->provider_unit->provider_type_id;
            $this->providerList = Provider::where('provider_type_id',$this->type_id)->where('status',1)->get();
            
            if($this->provider_unit->provider_building_id != ''){
                //dd($this->provider_unit->provider_building_id);
                $this->building_id = $this->provider_unit->provider_building_id;
                $this->buildingList = ProviderBuilding::where('status',1)->where('provider_type_id',$this->provider_id)->get();
                
            }
            if($this->provider_unit->unit_id != ''){
                $this->unit_id = $this->provider_unit->unit_id;
                $this->unitList = BuildingUnit::where('status',1)->where('building_id',$this->building_id)->get();
            }
            
            
        } else{
            $this->provider_unit = new ConsumerUnit();
            $this->user_id = $user_id;
            $this->buildingList = ProviderBuilding::where('status',1)->get();
            $this->providerList = Provider::where('status',1)->get();
            $this->unitList = BuildingUnit::where('status', 1)->get();
            
        }
            
        $this->typeList = ProviderType::get();
        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'building_id' => ['nullable'],
                'unit_id' => ['nullable'],
                'provider_id' => ['required'],
                'type_id'=> ['required'],

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'building_id' => ['nullable'],
                'unit_id' => ['nullable'],
                'provider_id' => ['required'],
                'type_id'=> ['required'],
            ];
    }
    public function validationRuleForResidentialSave(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit_id' => ['required'],
                'provider_id' => ['required'],
                'type_id'=> ['required'],

            ];
    }
    public function validationRuleForResidentialUpdate(): array
    {
        return
            [
                'building_id' => ['required'],
                'unit_id' => ['required'],
                'provider_id' => ['required'],
                'type_id'=> ['required'],
            ];
    }

    protected $messages = [
        'building_id.required' => 'Please select one Provider Building atleast',
        'unit_id.required' => 'Please select one  Building Unit',
        'type_id.required' => 'Please select one Provider Type',
        'provider_id.required' => 'Please Select One Provider'
    ];


    public function saveOrUpdate()
    {
        if($this->type_id == 1){
            $this->validate($this->isEdit ? $this->validationRuleForResidentialUpdate() : $this->validationRuleForResidentialSave());
        }
        else{
            $this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave());
        }
        //dd($this->user_id);
        if(!$this->isEdit){
            $provider = ProviderBuilding::find($this->building_id);
            
            if($this->unit_id != ''){
                $existing_unit = BuildingUnit::where('consumer_id',$this->user_id)->count();
                if($existing_unit > 0){
                    $this->showToastr("error", "This consumer is already added to building unit");
                    return redirect()->route('consumer.providers.create',$this->user_id);
                }
                else{
                    
                    $this->provider_unit->provider_type_id = $this->provider_id;
                    $this->provider_unit->provider_building_id = $this->building_id;
                    $this->provider_unit->unit_id = $this->unit_id;
                    $this->provider_unit->consumer_id = $this->user_id;
                    $this->provider_unit->save();
                    // $buildingUnit = BuildingUnit::find($this->unit_id);
                    // $buildingUnit->consumer_id = $this->user_id;
                    // $buildingUnit->save();
                }
            }
            else{
                    $this->provider_unit->provider_type_id = $this->provider_id;
                    $this->provider_unit->consumer_id = $this->user_id;
                    $this->provider_unit->save();
            }
        }
        
        
        
        $msgAction = 'Building Unit was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('admin.consumer.providers',$this->user_id);
    }

    public function render()
    {
        return view('livewire.admin.consumer.provider.provider-create-edit');
    }
}
