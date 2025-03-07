<?php

namespace App\Http\Livewire\Admin\ServiceType;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ServiceType;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessCategory;

class ServiceList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchServiceName, $searchCategory, $searchStatus = -1, $perPage = 10;
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
        $this->searchServiceName = "";
        $this->searchCategory = "";
        $this->searchStatus = -1;
       
    }

    public function render()
    {
        $typeQuery = ServiceType::query();

        if ($this->searchServiceName)
            $typeQuery->where('service_name', 'like', '%' . trim($this->searchServiceName) . '%');

        if ($this->searchCategory)
        $typeQuery->whereHas('category', function($q) {
        $q->WhereRaw("category_name like '%" . trim($this->searchCategory) . "%' ");
    });
        
        if ($this->searchStatus >= 0)
            $typeQuery->where('status', $this->searchStatus); 
        if ($this->sortBy == 'category_name') {
            return view('livewire.admin.service-type.service-list', [
                'types' => $typeQuery
                    ->with('category')
                    ->orderBy(BusinessCategory::select('category_name')->whereColumn('service_types.category_id', 'business_categories.id'), $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        }
        else{
            return view('livewire.admin.service-type.service-list', [
                'types' => $typeQuery
                    ->with('category')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        }
        
    }

    public function deleteConfirm($id)
    {
        ServiceType::destroy($id);
        $this->showModal('success', 'Success', 'Building Unit has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Building unit!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(ServiceType $type)
    {
        $type->fill(['status' => ($type->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Building Unit status has been changed successfully');
    }
    
  
}
