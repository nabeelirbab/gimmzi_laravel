<?php

namespace App\Http\Livewire\Admin\Business;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BusinessCategory;

class BusinessList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchCategoryName,$searchStatus = -1, $perPage = 5;
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
        $this->searchCategoryName = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $businessCategoryQuery = BusinessCategory::query();
        if ($this->searchCategoryName)
            $businessCategoryQuery->orWhere('category_name', 'like', '%' . trim($this->searchCategoryName) . '%');
        if ($this->searchStatus >= 0)
            $businessCategoryQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.business.business-list', [
            'categories' => $businessCategoryQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
       
    }

  
    
    public function deleteConfirm($id)
    {
        BusinessCategory::destroy($id);
        $this->showModal('success', 'Success', 'Consumer has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Consumer!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(BusinessCategory $category)
    {
        $category->fill(['status' => ($category->status == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'Consumer status has been changed successfully');
    }
}
