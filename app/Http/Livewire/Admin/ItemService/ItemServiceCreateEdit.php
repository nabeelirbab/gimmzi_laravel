<?php

namespace App\Http\Livewire\Admin\ItemService;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use App\Models\ItemOrService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ItemServiceCreateEdit extends Component
{
    use AlertMessage;
    public $status,$business_category_id,$item_name, $note, $item_value, $added_by;
    public $item_service;
    public $businessCategoryList = [];
    public $isEdit = false;
    public $statusList = [];
    public $blankArr = [];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($item_service = null)
    {
        if ($item_service) {
            $this->item_service = $item_service;
            $this->fill($this->item_service);
            $this->isEdit = true;
            
        } else
            $this->item_service = new ItemOrService();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->businessCategoryList = BusinessCategory::where('status',1)->get();
        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'business_category_id' => ['required'],
                'item_name' => ['required'],
                'item_value' => ['nullable'],
                'note' => ['nullable'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'business_category_id' => ['required'],
                'item_name' => ['required'],
                'item_value' => ['nullable'],
                'note' => ['nullable'],
                'status' => ['required']
            ];
    }

    protected $messages = [
        'business_category_id.required' => ' The Select Business Category field is required',
        'item_name.required' => 'The Item Or Service Name Field is required',
        'status.required' => 'The Status Field is required'
    ];


    public function saveOrUpdate()
    {  
        $this->item_service->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $this->item_service->added_by = Auth::user()->id;
        $this->item_service->save();
        $msgAction = 'The Item Or Service was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('item-service.index');
    }
    public function render()
    {
        return view('livewire.admin.item-service.item-service-create-edit');
    }
}
