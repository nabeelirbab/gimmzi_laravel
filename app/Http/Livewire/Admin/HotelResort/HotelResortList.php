<?php

namespace App\Http\Livewire\Admin\HotelResort;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\TravelTourism;
use Livewire\Component;
use Livewire\WithPagination;

class HotelResortList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchName, $searchAddress, $searchStatus = -1, $perPage = 5;
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
        $this->searchAddress = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $travelQuery = TravelTourism::query();
       
        if ($this->searchName)
            $travelQuery->WhereRaw("name like '%" . trim($this->searchName) . "%' ");
        if ($this->searchAddress)
            $travelQuery->where('address', 'like', '%' . trim($this->searchAddress) . '%');
        if ($this->searchStatus >= 0)
            $travelQuery->where('status', $this->searchStatus);
            
            return view('livewire.admin.hotel-resort.hotel-resort-list', [
            'hotels' => $travelQuery
                ->where('travel_tourism_type','Hotel-Resort')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }

    public function deleteConfirm($id)
    {
        TravelTourism::destroy($id);
        $this->showModal('success', 'Success', 'Hotel/Resort has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Hotel/Resort!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(TravelTourism $rental)
    {
        $rental->fill(['status' => ($rental->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Hotel/Resort status has been changed successfully');
    }
   
}
