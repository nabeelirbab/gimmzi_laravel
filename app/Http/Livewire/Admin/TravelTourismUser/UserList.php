<?php

namespace App\Http\Livewire\Admin\TravelTourismUser;

use Livewire\Component;
use App\Models\User;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class UserList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchName, $searchTitle, $searchType, $searchTravelName, $searchStatus = -1, $perPage = 5;
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
        $this->searchType = "";
        $this->searchTitle = "";
        $this->searchTravelName = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $userQuery = User::query();
        if ($this->searchName)
            $userQuery->WhereRaw(
                "concat(first_name,' ', last_name) like '%" . trim($this->searchName) . "%' "
            );

        if ($this->searchTravelName)
            $userQuery->whereHas('travelType', function ($q) {
                $q->WhereRaw("name like '%" . trim($this->searchTravelName) . "%' ");
            });

        if ($this->searchTitle != null)
            $userQuery->whereHas('title', function ($q) {
                $q->WhereRaw("title_name like '%" . trim($this->searchTitle) . "%' ");
            });

        if ($this->searchType >= 0) {
            if ($this->searchType == 1) {
                $userQuery->role('SHORT TERM RENTAL PROVIDER');
            } else if ($this->searchType == 2) {
                $userQuery->role('HOTEL RESORT PROVIDER');
            }
        }

        if ($this->searchStatus >= 0)
            $userQuery->where('active', $this->searchStatus);

        return view('livewire.admin.travel-tourism-user.user-list', [
            'users' => $userQuery
                ->with('title')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->role(['SHORT TERM RENTAL PROVIDER', 'HOTEL RESORT PROVIDER'])
                ->paginate($this->perPage)
        ]);
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(User $user)
    {
        $user->fill(['active' => ($user->active == 1) ? 0 : 1])->save();
        if ($user->active != 1) {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        $this->showModal('success', 'Success', 'Travel & Tourism user status has been changed successfully');
    }
}
