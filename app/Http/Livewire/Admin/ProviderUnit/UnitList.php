<?php

namespace App\Http\Livewire\Admin\ProviderUnit;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\BuildingUnit;
use Livewire\Component;
use Livewire\WithPagination;

class UnitList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchBuilding, $searchUnit, $searchStatus = -1, $perPage = 5;
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
        $this->searchBuilding = "";
        $this->searchUnit = "";
        $this->searchStatus = -1;
       
    }

    public function render()
    {
        $unitQuery = BuildingUnit::query();
        if ($this->searchBuilding)
        $unitQuery->whereHas('buildings', function($q) {
        $q->WhereRaw("building_name like '%" . trim($this->searchBuilding) . "%' ");
    });
        if ($this->searchUnit)
            $unitQuery->where('unit', 'like', '%' . trim($this->searchUnit) . '%');
        if ($this->searchStatus >= 0)
            $unitQuery->where('status', $this->searchStatus);
        // if ($this->searchProvider)
        //     $buildingQuery->whereHas('user', function($q) {
        //         $q->WhereRaw("concat(first_name,' ', last_name) like '%". trim($this->searchProvider) . "%' ");
        //     }); 
            return view('livewire.admin.provider-unit.unit-list', [
            'units' => $unitQuery
                ->with('buildings')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
        
    }

    public function deleteConfirm($id)
    {
        BuildingUnit::destroy($id);
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

    public function changeStatus(BuildingUnit $unit)
    {
        $unit->fill(['status' => ($unit->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Building Unit status has been changed successfully');
    }
}
   

