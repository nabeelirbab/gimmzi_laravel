<?php

namespace App\Http\Livewire\Admin\Loyalty;

use Livewire\Component;
use App\Models\Deal;
use App\Models\MerchantLoyaltyProgram;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class LoyaltyList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    public $SearchName, $searchBusiness, $searchPurchaseGoal = -1, $searchStatus = -1, $perPage = 5;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['changeStatus'];

    public function mount(){
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
        $this->SearchName = "";
        $this->searchBusiness = "";
        $this->searchPurchaseGoal = -1;
        $this->searchStatus = -1;
    }

    public function render()
    {
        // dd($this->SearchName);
        $loyaltyQuery = MerchantLoyaltyProgram::query();
        if ($this->searchBusiness)
            $loyaltyQuery->whereHas('businessProfile', function ($q) {
                $q->WhereRaw("business_name like '%" . trim($this->searchBusiness) . "%' ");
            });
        if ($this->SearchName)
            $loyaltyQuery->where('program_name', 'like', '%' . trim($this->SearchName) . '%');
        if ($this->searchPurchaseGoal >= 0)
            $loyaltyQuery->where('purchase_goal', $this->searchPurchaseGoal);
        if ($this->searchStatus >= 0)
            $loyaltyQuery->where('status', $this->searchStatus);
        return view('livewire.admin.loyalty.loyalty-list', [
            'loyalty' => $loyaltyQuery
                ->with('businessProfile')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)

        ]);

        return view('livewire.admin.loyalty.loyalty-list');
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(MerchantLoyaltyProgram $loyalty)
    {
        $loyalty->fill(['status' => ($loyalty->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Loyalty reward Program status has been changed successfully');
    }
}
