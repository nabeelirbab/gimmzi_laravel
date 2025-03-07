<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Faq;
use Livewire\Component;
use Illuminate\Validation\Rule;


class FaqCreateEdit extends Component
{

    use AlertMessage;
    public $question, $answer, $status, $faq;
    public $isEdit = false;
    public $statusList = [];
    protected $listeners = ['refreshProducts' => '$refresh'];
    public function mount($faq = null)
    {
        if ($faq) {
            $this->faq = $faq;
            $this->fill($this->faq);
            $this->isEdit = true;
        } else
            $this->faq = new Faq;

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
    }
    public function validationRuleForSave(): array
    {
        return
            [
                'question' => ['required'],
                'answer' => ['required'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'question' => ['required'],
                'answer' => ['required'],
                'status' => ['required']
            ];
    }
    protected $messages = [
        'question.required' => 'The Question field is required',
        'answer.required' => 'The Answer field is required',
        'status.required' => 'The Status field is required'
    ];
    public function saveOrUpdate()
    {
        $validatedData = $this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave());

        $this->faq->fill($validatedData)->save();

        $msgAction = 'Faq was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('cms.faq.list');
    }
    public function render()
    {
        return view('livewire.admin.cms.faq-create-edit');
    }
}
