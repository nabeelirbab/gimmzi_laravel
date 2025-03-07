<?php

namespace App\Http\Livewire\Admin\Cms;

use Livewire\Component;
use App\Models\Faq;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class FaqList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchQuestion, $searchStatus = -1, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount()
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
    }
    public function getRandomColor()
    {
        $arrIndex = array_rand($this->badgeColors);
        return $this->badgeColors[$arrIndex];
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function search()
    {
        $this->resetPage();
    }
    public function resetSearch()
    {
        $this->searchQuestion = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $faqQuery = Faq::query();
        
        if ($this->searchQuestion)
            $faqQuery->Where('question', 'like', '%' . trim($this->searchQuestion) . '%');
        if ($this->searchStatus >= 0)
            $faqQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.cms.faq-list', [
            'faqs' => $faqQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Faq::destroy($id);
        $this->showModal('success', 'Success', 'Faq has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Faq!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(Faq $faq)
    {
        $faq->fill(['status' => ($faq->status == 1) ? 0 : 1])->save();
       
        $this->showModal('success', 'Success', 'Faq status has been changed successfully');
    }
}
