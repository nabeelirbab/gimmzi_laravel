<?php

namespace App\Http\Livewire\Admin\Merchant;

use Livewire\Component;
use App\Models\User;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\MerchantLocation;

class LocationList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $id, $searchName,$searchTitle, $searchEmail, $searchPhone, $searchStatus = -1, $searchType = -1, $perPage = 5;
    protected $listeners = ['deleteConfirm', 'changeStatus'];
    public function mount($id)
    {
        $this->perPageList = [
            ['value' => 5, 'text' => "5"],
            ['value' => 10, 'text' => "10"],
            ['value' => 20, 'text' => "20"],
            ['value' => 50, 'text' => "50"],
            ['value' => 100, 'text' => "100"]
        ];
        $this->id = $id;
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
        $this->searchTitle = "";
        $this->searchEmail = "";
        $this->searchPhone = "";
        $this->searchStatus = -1;
        $this->searchType = -1;
    }

    public function render()
    {
        $locationQuery = MerchantLocation::query();
        // if ($this->searchName)
        //     $userQuery->WhereRaw(
        //         "concat(first_name,' ', last_name) like '%" . $this->searchName . "%' "
        //     );
        // if ($this->searchTitle)
        //     $userQuery->whereHas('title', function($q) {
        //     $q->WhereRaw("title_name like '%" . trim($this->searchTitle) . "%' ");
        //     });
        // if ($this->searchEmail)
        //     $userQuery->orWhere('email', 'like', '%' . $this->searchEmail . '%');
        // if ($this->searchPhone)
        //     $userQuery->orWhere('phone', 'like', '%' . $this->searchPhone . '%');
        // if ($this->searchStatus >= 0)
        //     $userQuery->orWhere('active', $this->searchStatus);
        // if ($this->searchType >= 0)
        //     $userQuery->orWhere('is_regular', $this->searchType);
        return view('livewire.admin.merchant.location-list', [
            'locations' => $locationQuery
                ->where('merchant_id',$this->id)
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
        
    }
   
}
