<?php

namespace App\Http\Livewire\Admin\Badge;

use Livewire\Component;
use App\Models\Badge;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;


class BadgeList extends Component
{

    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchTitle, $searchType = -1, $searchPoint, $searchStatus = -1, $perPage = 5;
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
        $this->searchTitle = "";
        $this->searchType = -1;
        $this->searchPoint = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $badgeQuery = Badge::query();
        if ($this->searchTitle)
            $badgeQuery->where('title', 'like', '%' . trim($this->searchTitle) . '%');
        if ($this->searchType >= 0)
            $badgeQuery->where('badge_type',  $this->searchType);
        if ($this->searchPoint)
            $badgeQuery->where('point', 'like', '%' . $this->searchPoint . '%');
        if ($this->searchStatus >= 0)
            $badgeQuery->where('status', $this->searchStatus);
        return view('livewire.admin.badge.badge-list', [
            'badges' => $badgeQuery
                ->orderBy('id', 'asc')
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        Badge::destroy($id);
        $this->showModal('success', 'Success', 'Badge has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Badge!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(Badge $badge)
    {

        $badge->fill(['status' => ($badge->status == 1) ? 0 : 1])->save();

        $this->showModal('success', 'Success', 'Badge status has been changed successfully');
    }
}
