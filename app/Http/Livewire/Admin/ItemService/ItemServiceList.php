<?php

namespace App\Http\Livewire\Admin\ItemService;

use App\Http\Livewire\Traits\AlertMessage;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ItemOrService;
use Livewire\Component;
use Livewire\WithPagination;

class ItemServiceList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
    protected $paginationTheme = 'bootstrap';
    public $searchItemServiceName, $searchBusinessCategory, $searchStatus = -1, $perPage = 10;
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
        $this->searchItemServiceName = "";
        $this->searchBusinessCategory = "";
        $this->searchStatus = -1;
       
    }

    public function render()
    {
        $itemQuery = ItemOrService::query();

        if ($this->searchItemServiceName)
            $itemQuery->where('item_name', 'like', '%' . trim($this->searchItemServiceName) . '%');

        if ($this->searchBusinessCategory)
        $itemQuery->whereHas('category', function($q) {
        $q->WhereRaw("category_name like '%" . trim($this->searchBusinessCategory) . "%' ");
    });
        
        if ($this->searchStatus >= 0)
            $itemQuery->where('status', $this->searchStatus); 
     
            return view('livewire.admin.item-service.item-service-list', [
                'items' => $itemQuery
                    ->with('category')
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        }
        
    

    public function deleteConfirm($id)
    {
        ItemOrService::destroy($id);
        $this->showModal('success', 'Success', 'Item Or Service has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this Item Or Service!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(ItemOrService $item)
    {
        $item->fill(['status' => ($item->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Item Or Service status has been changed successfully');
    }
    
 
}
