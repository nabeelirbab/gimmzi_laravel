<?php

namespace App\Http\Livewire\Admin\Business;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class BusinessEdit extends Component
{

    use AlertMessage;
    use WithFileUploads;
    public $category_name,$status, $terms_conditions, $icon;
    public $isEdit = false;
    public $model_image1, $imgId1;
    public $statusList = [];

    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($business = null)
    {
        if ($business) {
            $this->business = $business;
            $this->fill($this->business);
            $this->isEdit = true;
        } else
            $this->business = new BusinessCategory();

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ]; 

        $this->model_image1 = Media::where(['model_id' => $this->business->id, 'collection_name' => 'categoryIcon'])->first();
        if (!$this->model_image1 == null) {
            $this->imgId1 = $this->model_image1->id;
        }
        $this->icon = '';
        // dd($this->icon);
    }

    public function validationRuleForSave(): array
    {
        return
            [
                'category_name' => ['required', 'max:255'],
                'status' => ['required'],
                'terms_conditions' => ['required'],
                

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'category_name' => ['required', 'max:255'],
                'status' => ['required'],
                'terms_conditions' => ['required'],
                'icon' => ['nullable']
            ];
    }

    protected $messages = [
        'category_name.required' => 'The Category Name Field is required',
        'status.required' => 'The Status Field is required',
        'terms_conditions' => 'The Terms And Condition Field is required',
    ];

    public function saveOrUpdate()
    {
        // dd($this->title_name);
        
        $this->business->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        if ($this->icon) {
            if ($this->imgId1) {
                $item = Media::find($this->imgId1);
                $item->delete(); // delete previous image in the database

                $this->business->addMedia($this->icon->getRealPath())
                    ->usingName($this->icon->getClientOriginalName())
                    ->toMediaCollection('categoryIcon');
            } else {
         
                $this->business->addMedia($this->icon->getRealPath())
                    ->usingName($this->icon->getClientOriginalName())
                    ->toMediaCollection('categoryIcon');
            }
        }
        $msgAction = 'Business Category was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('business-category.index');
    }
    public function render()
    {
        return view('livewire.admin.business.business-edit');
    }
}
