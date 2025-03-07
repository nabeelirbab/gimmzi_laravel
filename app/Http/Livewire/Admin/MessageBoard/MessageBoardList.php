<?php

namespace App\Http\Livewire\Admin\MessageBoard;

use Livewire\Component;
use App\Models\MessageBoard;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;

class MessageBoardList extends Component
{
    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];
   

    protected $paginationTheme = 'bootstrap';

    public $searchTitle, $searchStatus=-1 , $perPage = 5;
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
        $this->searchTitle ="";
        // $this->searchMakePublic = "";
        // $this->searchTenantOnly = "";
        $this->searchStatus = -1;
    }

    public function render()
    {
        $messageboardQuery = MessageBoard::query();
        
        if ($this->searchTitle)
            $messageboardQuery->orWhere('title', 'like', '%' . trim($this->searchTitle) . '%');
             
            
            // if ($this->searchMakePublic)
            // $messageboardQuery->whereHas('make_public', function($q) {
            //     $q->WhereRaw("make_public like '%". trim($this->searchMakePublic) . "%' ");
            // }); 


        // if ($this->searchTenantOnly )
        // $messageboardQuery->whereHas('tenant_only', function($q) {
        //     $q->WhereRaw("tenant_only like '%". trim($this->searchTenantOnly ) . "%' ");
        // });     

        if ($this->searchStatus >= 0)
            $messageboardQuery->orWhere('status', $this->searchStatus);
        return view('livewire.admin.message-board.message-board-list', [
            'messageboard' => $messageboardQuery
                ->orderBy($this->sortBy, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }
    public function deleteConfirm($id)
    {
        MessageBoard::destroy($id);
        $this->showModal('success', 'Success', 'Message from board has been deleted successfully');
    }
    public function deleteAttempt($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this user!", 'Yes, delete!', 'deleteConfirm', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatusConfirm($id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "Do you want to change this status?", 'Yes, Change!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
    }

    public function changeStatus(MessageBoard $messageboard)
    {    
        // dd($description);
        $messageboard->fill(['status' => ($messageboard->status == 1) ? 0 : 1])->save();
        
        $this->showModal('success', 'Success', 'User status has been changed successfully');
    }
    


}
