<?php

namespace App\Http\Livewire\Admin\Provider;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Provider;
use Livewire\Component;
use Livewire\WithPagination;

class ProviderList extends Component
{
    
        use WithPagination;
        use WithSorting;
        use AlertMessage;
        public $perPageList = [];
        public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    
        protected $paginationTheme = 'bootstrap';
        public $searchType,$searchName, $searchId, $searchStatus = -1, $perPage = 5;
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
            $this->searchType = "";
            $this->searchName = "";
            $this->searchId = "";
            $this->searchStatus = -1;
        }
        public function render()
        {
            $providerQuery = Provider::query();
            if ($this->searchType)
            $providerQuery->whereHas('sub_type', function($q) {
                $q->WhereRaw("name like '%" . trim($this->searchType) . "%' ");
            });
            if ($this->searchName)
                $providerQuery->WhereRaw("name like '%" . trim($this->searchName) . "%' ");
            if ($this->searchId)
                $providerQuery->where('providerId', 'like', '%' . trim($this->searchId) . '%');
            if ($this->searchStatus >= 0)
                $providerQuery->where('status', $this->searchStatus);
                
                return view('livewire.admin.provider.provider-list', [
                'providers' => $providerQuery
                    ->with('sub_type')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        }
    
        public function deleteConfirm($id)
        {
            Provider::destroy($id);
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
    
        public function changeStatus(Provider $provider)
        {
            $provider->fill(['status' => ($provider->status == 1) ? 0 : 1])->save();
            $this->showModal('success', 'Success', 'Provider status has been changed successfully');
        }
       
    
}
