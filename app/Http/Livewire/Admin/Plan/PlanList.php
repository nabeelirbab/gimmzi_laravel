<?php

namespace App\Http\Livewire\Admin\Plan;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\MerchantPlan;
use Livewire\Component;
use Livewire\WithPagination;

class PlanList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchName,$searchAmount, $searchIsFree = -1, $searchStatus = -1, $perPage = 5;
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
        $this->searchAmount = "";
        $this->searchIsFree = -1;
        $this->searchStatus = -1;
    }
    public function render()
    {
        $planQuery = MerchantPlan::query();
            if ($this->searchAmount)
                $planQuery->WhereRaw("monthly_amount like '%" . trim($this->searchAmount) . "%' ");
            if ($this->searchName)
                $planQuery->WhereRaw("plan_name like '%" . trim($this->searchName) . "%' ");
            if ($this->searchIsFree >= 0)
                $planQuery->where('is_free', $this->searchIsFree);
            if ($this->searchStatus >= 0)
                $planQuery->where('status', $this->searchStatus);
                
                return view('livewire.admin.plan.plan-list', [
                'plans' => $planQuery
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
    }

    public function deleteConfirm($id)
        {
            MerchantPlan::destroy($id);
            $this->showModal('success', 'Success', 'Provider has been deleted successfully');
        }
        public function deleteAttempt($id)
        {
            $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Provider!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        }
    
        public function changeStatusConfirm($id)
        {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        }
    
        public function changeStatus(MerchantPlan $merchant_plan)
        {
            $merchant_plan->fill(['status' => ($merchant_plan->status == 1) ? 0 : 1])->save();
            $this->showModal('success', 'Success', 'Provider status has been changed successfully');
        }
}
