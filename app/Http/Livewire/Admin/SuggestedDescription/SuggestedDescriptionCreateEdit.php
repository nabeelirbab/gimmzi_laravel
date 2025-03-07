<?php

namespace App\Http\Livewire\Admin\SuggestedDescription;

use Livewire\Component;
use App\Models\SuggestedDescription;
use App\Models\State;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class SuggestedDescriptionCreateEdit extends Component
{  
    use AlertMessage;
    public $business_id ,$suggested_description,$status,$category_name,$description;
    public $isEdit = false;
    public $statusList = [];
    public $categoryList = [];
    public $blankArr =[];
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($suggested_description= null)
    {    

        if ($suggested_description) {
            $this->suggested_description = $suggested_description;
            $this->fill($this->suggested_description);
            $this->isEdit = true;
        } else
            $this->suggested_description = new SuggestedDescription;
             

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
                
                  'business_id' => ['required'],
                 'description' =>['required'],
                'status' => ['required'],
                
                

            ];
      
    }
    public function validationRuleForUpdate(): array
    {
        return      
            [     
                   'business_id' => ['required'],
                   'description' => ['required'],
                    'status' => ['required']
            ];
    }

    protected $messages = [

        'business_id.required'=>'The Business Category field is required' ,
        'description.required' => 'The Suggested Description field is required',
        'status.required' => 'The Status Field is required'
    ];

    public function saveOrUpdate()
    {    
        
        $this->suggested_description->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
    
        $msgAction = 'Suggested description was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);
        

        return redirect()->route('suggested-description.index');
    }
    public function render()
    {
        return view('livewire.admin.suggested-description.suggested-description-create-edit');
    }
   
}
