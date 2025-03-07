<?php

namespace App\Http\Livewire\Admin\SuggestedDescription;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\SuggestedDescription;
use Livewire\WithPagination;
use Livewire\Component;

class SuggestedDescriptionList extends Component
{   

    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
   

    protected $paginationTheme = 'bootstrap';

    public $searchDescription, $searchBusinessCategoryName, $searchStatus = -1 , $perPage = 5;
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
        $this->searchDescription = "";
        $this->searchBusinessCategoryName = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $descriptionQuery = SuggestedDescription::query();
        
        if ($this->searchDescription)
            $descriptionQuery->orWhere('description', 'like', '%' . trim($this->searchDescription) . '%');
       
        if ($this->searchBusinessCategoryName)
        $descriptionQuery->whereHas('businessCategory', function($q) {
            $q->WhereRaw("category_name like '%". trim($this->searchBusinessCategoryName) . "%' ");
        });     

        if ($this->searchStatus >= 0)
            $descriptionQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.suggested-description.suggested-description-list', [
            'description' => $descriptionQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        SuggestedDescription::destroy($id);
        $this->showModal('success', 'Success', 'Description has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this user!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(SuggestedDescription $description)
    {    
        // dd($description);
        $description->fill(['status' => ($description->status == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'User status has been changed successfully');
    }
   
}
