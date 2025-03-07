<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Point;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\User;

class UserPoint extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];


    protected $paginationTheme = 'bootstrap';

    public $point_id, $searchPoint, $searchDescription, $searchAdded, $searchCameFrom, $searchbadge, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];

    public function mount($point_id)
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->point_id = $point_id;
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
        $this->searchPoint = "";
        $this->searchAdded = "";
        $this->searchCameFrom = "";
        $this->searchbadge = "";
    }

    public function render()
    {
        $pointQuery = Point::query();
        if ($this->searchPoint)
            $pointQuery->where('point', 'like', '%' . trim($this->searchPoint) . '%');
        if ($this->searchAdded)
            $pointQuery->where('created_at', 'like', '%' . trim($this->searchAdded) . '%');
        // if ($this->searchType >= 0)
        //     $pointQuery->where('badge_type',  $this->searchType);
        if ($this->searchCameFrom)
            $pointQuery->whereHas('userCameFrom', function ($q) {
                $q->WhereRaw("concat(first_name,' ',last_name) like '%" . trim($this->searchCameFrom) . "%' ");
            });

        if ($this->searchbadge){
            $pointQuery->whereHas('badge', function ($q) use ($pointQuery){
                $q->Where("title", "like" ,"%" . trim($this->searchbadge) . "%");
            })->orWhereHas('boost', function ($q) use ($pointQuery){
                $q->Where("boost_name", "like" ,"%" . trim($this->searchbadge) . "%");
            });
        }
            

        return view('livewire.admin.user-point', [
            'points' => $pointQuery
                ->where('user_id', $this->point_id)
                ->orderBy('id', 'asc')
                ->paginate($this->perPage)
        ]);
    }


    public function deleteConfirm($id)
    {
        
       $pointRow = Point::where('id',$id)->first();
    //    dd($point->user_id);
       $user = User::where('id',$pointRow->user_id)->first();   
       if($user){ 
                $nowpoint = $user->point;
                $totalpoint = $nowpoint-($pointRow->point);
                $user->point= $totalpoint;
                $user->update();
       }
        Point::destroy($id);
        $this->showModal('success', 'Success', 'Point has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Point!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }
}
