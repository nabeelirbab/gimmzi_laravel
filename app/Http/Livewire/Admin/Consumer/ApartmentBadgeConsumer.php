<?php

namespace App\Http\Livewire\Admin\Consumer;

use Livewire\Component;
use App\Models\User;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class ApartmentBadgeConsumer extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchApartment, $searchUnit, $searchEmail, $searchStatus = -1, $perPage = 15;
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
        $this->searchUnit = "";
        $this->searchEmail = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $userQuery = ApartmentGuestBadge::query();
        if ($this->searchApartment)
            $userQuery->whereHas('badge', function($q) {
                $q->whereHas('building', function($query) {
                    $query->WhereRaw("building_name like '%" . trim($this->searchApartment) . "%' ");
                });
                
            });
        if ($this->searchUnit)
            $userQuery->whereHas('badge', function($q) {
                $q->whereHas('buildingunit', function($query) {
                    $query->WhereRaw("unit like '%" . trim($this->searchUnit) . "%' ");
                });
                
            });
        if ($this->searchEmail)
            $userQuery->orWhere('guest_email', 'like', '%' . trim($this->searchEmail) . '%');
        if ($this->searchStatus >= 0)
            $userQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.consumer.apartment-badge-consumer', [
            'users' => $userQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->with('badge')
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

    public function changeStatus(User $user)
    {
        $user->fill(['active' => ($user->active == 1) ? 0 : 1])->save();
        if ($user->active != 1) {
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        $this->showModal('success', 'Success', 'Consumer status has been changed successfully');
    }

}
