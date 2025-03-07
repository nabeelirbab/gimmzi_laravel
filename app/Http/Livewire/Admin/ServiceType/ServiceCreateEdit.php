<?php

namespace App\Http\Livewire\Admin\ServiceType;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use App\Models\ServiceType;
use Livewire\Component;

class ServiceCreateEdit extends Component
{
    use AlertMessage;
    public $status,$category_id,$service_name;
    public $service_type;
    public $categoryList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($service_type = null)
    {
        if ($service_type) {
            $this->service_type = $service_type;
            $this->fill($this->service_type);
            $this->isEdit = true;
            
        } else
            $this->service_type = new ServiceType();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->categoryList = BusinessCategory::where('status',1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'category_id' => ['required'],
                'service_name' => ['required'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'category_id' => ['required'],
                'service_name' => ['required'],
                'status' => ['required']
            ];
    }

    protected $messages = [
        'category_id.required' => ' The Select Business Category field is required',
        'service_name.required' => 'The Service Name Field is required',
        'status.required' => 'The Status Field is required'
    ];


    public function saveOrUpdate()
    {  
        $this->service_type->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $msgAction = 'Service Type was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('service-type.index');
    }
    public function render()
    {
        return view('livewire.admin.service-type.service-create-edit');
    }
}
