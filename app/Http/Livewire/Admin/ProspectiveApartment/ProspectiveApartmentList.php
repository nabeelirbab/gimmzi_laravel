<?php

namespace App\Http\Livewire\Admin\ProspectiveApartment;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ProspectiveAppartmentList;
use App\Models\ProspectiveApartmentUser;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ProspectiveApartmentList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchAction,$searchApartment, $searchContact, $searchDate, $searchUserCount, $searchStatus = -1, $perPage = 5;
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
        $this->searchApartment = "";
        $this->searchStatus = -1;
        $this->searchAction = "";
        $this->searchContact = "";
        $this->searchDate = "";
        $this->searchUserCount = "";
    }
    public function render()
    {
        // if ($this->searchUserCount != ''){
        //     dd($this->searchUserCount);
        // }
        
        $prospectiveQuery = ProspectiveAppartmentList::query();
        $prospectiveQuery->select('*', DB::raw("(select COUNT(id) from prospective_apartment_users where `prospective_apartment_users`.`prospective_apartment_id` =`prospective_appartment_lists`.`id` group by `prospective_apartment_id`) as user_count"));
        if ($this->searchApartment)
        $prospectiveQuery->where('apartment_name', 'like', '%' . trim($this->searchApartment) . '%');
        if ($this->searchStatus >= 0)
            $prospectiveQuery->orWhere('status', $this->searchStatus);
        if ($this->searchAction)
            $prospectiveQuery->whereHas('propertyNote', function($query) {
                return $query->where('action_taken', trim($this->searchAction))->latest()->take(1);
            });
        if ($this->searchContact)
            $prospectiveQuery->whereHas('propertyNote', function($query){
                    $query->whereHas('user', function($subquery) {
                        return $subquery->whereRaw("concat(first_name,' ', last_name) like '%" . $this->searchContact . "%' ");
                    })->latest()->take(1);
            });
        if ($this->searchDate)
            $prospectiveQuery->whereHas('propertyNote', function($query) {
                return $query->whereDate('created_at', trim($this->searchDate))->latest()->take(1);
            });
        if ($this->searchUserCount != '')
        
            $prospectiveQuery->having('user_count',  $this->searchUserCount);
            
            if($this->sortBy == 'consumer_count'){
                return view('livewire.admin.prospective-apartment.prospective-apartment-list', [
                    'prospectives' => $prospectiveQuery
                        ->orderBy('user_count', $this->sortDirection)
                        ->with('prospectiveApartmentUser')
                        ->paginate($this->perPage)
                ]);
            }
            else{
                return view('livewire.admin.prospective-apartment.prospective-apartment-list', [
                    'prospectives' => $prospectiveQuery
                        ->orderBy($this->sortBy, $this->sortDirection)
                        ->with('prospectiveApartmentUser')
                        ->paginate($this->perPage)
                ]);
            }
            
    }

    public function deleteConfirm($id)
    {
        ProspectiveAppartmentList::destroy($id);
        $this->showModal('success', 'Success', 'Provider has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Provider!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    

}
