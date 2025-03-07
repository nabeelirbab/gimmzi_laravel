<?php

namespace App\Http\Livewire\Admin\ProviderUser;

use Livewire\Component;
use App\Models\User;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class ProviderUserList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchName,$searchTitle, $searchUserId, $searchStatus = -1, $perPage = 5;
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
        $this->searchUserId = "";
        $this->searchTitle = "";
        $this->searchPhone = "";
        $this->searchTotalConsumer = "";
        $this->searchStatus = -1;
    }
    public function render()
    {
        $userQuery = User::query();
        if ($this->searchName)
            $userQuery->WhereRaw(
                "concat(first_name,' ', last_name) like '%" . trim($this->searchName) . "%' "
            );
        if ($this->searchUserId)
            $userQuery->where('userId', 'like', '%' . trim($this->searchUserId) . '%');

        if ($this->searchTitle)
            $userQuery->whereHas('title', function($q) {
            $q->WhereRaw("title_name like '%" . trim($this->searchTitle) . "%' ");
        });
        
        // if ($this->searchEmail)
        //     $userQuery->orWhere('email', 'like', '%' . $this->searchEmail . '%');
        // if ($this->searchPhone)
        //     $userQuery->orWhere('phone', 'like', '%' . $this->searchPhone . '%');
        if ($this->searchStatus >= 0)
            $userQuery->where('active', $this->searchStatus);
            
        return view('livewire.admin.provider-user.provider-user-list', [
            'users' => $userQuery
                ->with('title')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->role('PROVIDER')
                ->paginate($this->perPage)
        ]);
    }

    public function deleteConfirm($id)
    {
        User::destroy($id);
        $this->showModal('success', 'Success', 'Provider-user user has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Provider-user!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
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
        $this->showModal('success', 'Success', 'Provider-user status has been changed successfully');
    }
}
