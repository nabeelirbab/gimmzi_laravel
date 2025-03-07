<?php

namespace App\Http\Livewire\Admin\Hotelbuilding;

use Livewire\Component;
use App\Models\HotelBuildings;
use App\Models\User;
use App\Models\TravelTourism;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class HotelbuildingList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchName, $searchId, $searchProviderUser, $searchStatus = -1, $perPage = 5;
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
        $this->searchName = "";
        $this->searchId = "";
        $this->searchProviderUser = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $buildingQuery = HotelBuildings::query();
        if ($this->searchName)
            $buildingQuery->Where('building_name' ,'like', '%' . trim($this->searchName) . '%');
        if ($this->searchId)
            $buildingQuery->where('buildingId', 'like', '%' . trim($this->searchId) . '%');
        // if ($this->searchProviderUser)
        //     $buildingQuery->whereHas('user', function($q) {
        //         $q->WhereRaw("concat(first_name,' ', last_name) like '%". trim($this->searchProviderUser) . "%' ");
        //     }); 
        if ($this->searchStatus >= 0)
            $buildingQuery->where('status', $this->searchStatus);
        return view('livewire.admin.hotelbuilding.hotelbuilding-list', [
            'buildings' => $buildingQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                // ->with('user')
                ->paginate($this->perPage)
        ]);
        
    }

    public function deleteConfirm($id)
    {
        User::destroy($id);
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

    public function changeStatus(HotelBuildings $hotel_building)
    {
        $hotel_building->fill(['status' => ($hotel_building->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Building status has been changed successfully');
    }
    
}
