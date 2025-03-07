<?php

namespace App\Http\Livewire\Admin\Page;

use App\Helpers\ImageHelper;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Page;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $isEdit = false;
    protected $listeners = ['refreshProducts' => '$refresh'];
    public $title, $subtitle, $content, $imgId1, $imgId2, $imgId3, $photo_one, $photo_two, $photo_three, $page;
    public function mount()
    {
        $page = Page::first();

        if ($page) {
            $this->page = $page;
            $this->fill($this->page);
            $this->isEdit = true;
            $this->photo_one = $this->page->slide_one;
            $this->photo_two = $this->page->slide_two;
            $this->photo_three = $this->page->slide_three;
        } else {
            $this->page = new Page();
        }
    }

    public function validationRuleForSave(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'subtitle' => ['required', 'max:255'],
            'content' => ['required'],
            'photo_one' => ['required', 'url'],
            'photo_two' => ['required', 'url'],
            'photo_three' => ['required', 'url'],
        ];
    }

    public function validationRuleForUpdate(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'subtitle' => ['required', 'max:255'],
            'content' => ['required'],
            'photo_one' => ['required', 'url'],
            'photo_two' => ['required', 'url'],
            'photo_three' => ['required', 'url']
        ];
    }

    protected $messages = [
        'photo_one.required' => 'The First banner video link field is required.',
        'photo_two.required' => 'The Second banner video link field is required.',
        'photo_three.required' => 'The Third banner video link field is required.',
        'photo_one.url' => 'The First banner video link format is invalid',
        'photo_two.url' => 'The Second banner video link format is invalid',
        'photo_three.url' => 'The Third banner video link format is invalid',
    ];

    public function saveOrUpdate()
    {
        
        //try {
            // if ($this->photo_one) {
            //     if (file_exists($this->imgId1)) {
            //         @unlink($this->imgId1);
            //     }
            //     $file = $this->photo_one;
            //     $path = 'banner-image';
            //     $final_image_url = ImageHelper::customSaveImage($file, $path);
            //     $dataVal['slide_one'] = $final_image_url;
            // }

            // if ($this->photo_two) {
            //     if (file_exists($this->imgId2)) {
            //         @unlink($this->imgId2);
            //     }
            //     $file = $this->photo_two;
            //     $path = 'banner-image';
            //     $final_image_url = ImageHelper::customSaveImage($file, $path);
            //     $dataVal['slide_two'] = $final_image_url;
            // }

            // if ($this->photo_three) {
            //     if (file_exists($this->imgId3)) {
            //         @unlink($this->imgId3);
            //     }
            //     $file = $this->photo_three;
            //     $path = 'banner-image';
            //     $final_image_url = ImageHelper::customSaveImage($file, $path);
            //     $dataVal['slide_three'] = $final_image_url;
            // }
            $dataVal = $this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave());
            $dataVal['slide_one'] = $this->photo_one;
            $dataVal['slide_two'] = $this->photo_two;
            $dataVal['slide_three'] =$this->photo_three;
            $this->page->fill($dataVal)->save();
            $msgAction = 'Page has been ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('admin.page-edit');
        // } catch (\Throwable $th) {
        //     Log::error(" :: EXCEPTION :: " . $th->getMessage() . "\n" . $th->getTraceAsString());
        // }
    }

    public function render()
    {
        return view('livewire.admin.page.create-edit');
    }
}
