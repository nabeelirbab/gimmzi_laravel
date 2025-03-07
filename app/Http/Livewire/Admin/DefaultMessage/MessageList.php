<?php

namespace App\Http\Livewire\Admin\DefaultMessage;

use Livewire\Component;
use App\Models\RecognitionMessage;
use App\Models\RecognitionType;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class MessageList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $SearchName, $searchCategory, $searchDiscount = -1, $searchStatus = -1, $perPage = 5;
    protected $listeners = ['changeStatus'];

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
        $this->SearchName = "";
        $this->searchCategory = "";
        $this->searchDiscount = -1;
        $this->searchStatus = -1;
    }
    public function render()
    {
        $messageQuery = RecognitionMessage::query();

        // if ($this->searchCategory)
        //     $dealQuery->whereHas('category', function ($q) {
        //         $q->WhereRaw("category_name like '%" . trim($this->searchCategory) . "%' ");
        //     });
        // if ($this->SearchName)
        //     $dealQuery->where('suggested_description', 'like', '%' . trim($this->SearchName) . '%');
        // if ($this->searchDiscount >= 0)
        //     $dealQuery->where('discount_type', $this->searchDiscount);
        // if ($this->searchStatus >= 0)
        //     $dealQuery->where('status', $this->searchStatus);
        return view('livewire.admin.default-message.message-list', [
            'messages' => $messageQuery
                ->with('type')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)

        ]);
        return view('livewire.admin.deal.deal-list');
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(RecognitionMessage $message)
    {
        $message->fill(['status' => ($message->status == 1) ? 0 : 1])->save();
        $this->showModal('success', 'Success', 'Message status has been changed successfully');
    }
   
}
