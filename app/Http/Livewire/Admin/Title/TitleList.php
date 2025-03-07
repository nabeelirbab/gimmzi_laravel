<?php

namespace App\Http\Livewire\Admin\Title;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Title;

class TitleList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $titleColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchTitleName,$searchStatus = -1, $perPage = 5;
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
        $arrIndex = array_rand($this->titleColors);
        return $this->titleColors[$arrIndex];
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
        $this->searchTitleName = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $titleQuery = Title::query();
        if ($this->searchTitleName)
            $titleQuery->orWhere('title_name', 'like', '%' . $this->searchTitleName . '%');
        if ($this->searchStatus >= 0)
            $titleQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.title.title-list', [
            'titles' => $titleQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
       
    }
    public function deleteConfirm($id)
    {
        Title::destroy($id);
        $this->showModal('success', 'Success', 'Title has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Badge!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(Title $title)
    {
        $title->fill(['status' => ($title->status == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Title status has been changed successfully');
    }

}
