<?php
namespace App\Http\Livewire\Admin\Title;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Title;
use Livewire\Component;
use Illuminate\Validation\Rule;

class TitleCreateEdit extends Component
{
    use AlertMessage;
    public $title_name,$status, $title;
    public $isEdit = false;
    public $statusList = [];

    protected $listeners = ['refreshProducts' => '$refresh'];



    public function mount($title = null)
    {
        if ($title) {
            $this->title = $title;
            $this->fill($this->title);
            $this->isEdit = true;
        } else
            $this->title = new Title();

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
                'title_name' => ['required', 'max:255'],
                'status' => ['required']

            ];
    }
    public function validationRuleForUpdate(): array
    {
        return
            [
                'title_name' => ['required', 'max:255'],
                'status' => ['required']
            ];
    }

    public function saveOrUpdate()
    {
        // dd($this->title_name);
        
        $this->title->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
        $msgAction = 'Title was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('titles.index');
    }
    public function render()
    {
        return view('livewire.admin.title.title-create-edit');
    }
}
