<?php

namespace App\Http\Livewire\Admin\Support;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\TroubleTicket;
use App\Models\User;

class TroubleTicketList extends Component
{

    use WithPagination;
    use WithSorting;
    use AlertMessage;
    public $perPageList = [];
    public $badgeColors = ['info', 'success', 'brand', 'dark', 'primary', 'warning'];

    protected $paginationTheme = 'bootstrap';
    public $searchUserName, $searchSubject, $searchIsClosed = -1, $perPage = 5;
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
        $this->searchUserName = "";
        $this->searchSubject = "";
        $this->searchIsClosed = -1;
    }

    public function render()
    {
        $TroubleTicketQuery = TroubleTicket::query();

        if ($this->searchUserName)
            $TroubleTicketQuery->whereHas('user', function ($q) {
                $q->WhereRaw("concat(first_name,' ', last_name) like '%" . trim($this->searchUserName) . "%' ");
            });
        if ($this->searchSubject)
            $TroubleTicketQuery->where('subject', 'like', '%' . trim($this->searchSubject) . '%');

        if ($this->searchIsClosed >= 0)
            $TroubleTicketQuery->where('is_closed', $this->searchIsClosed);

        if ($this->sortBy == 'user_name') {
            return view('livewire.admin.support.trouble-ticket-list', [
                'troubleTickets' => $TroubleTicketQuery
                    ->orderBy(User::select('first_name')->whereColumn('trouble_tickets.user_id', 'users.id'), $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        } else {
            return view('livewire.admin.support.trouble-ticket-list', [
                'troubleTickets' => $TroubleTicketQuery
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage)
            ]);
        }
    }

    public function changeStatusConfirm($id)
    {
        $ticket = TroubleTicket::find($id);
        if ($ticket->is_closed == 1) {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to close the Ticket?", 'Yes, Close!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        } elseif ($ticket->is_closed == 0) {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to reopen the Ticket?", 'Yes, Reopen!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        } else {
            $this->showConfirmation("warning", 'Are you sure?', "Do you want to close the Ticket?", 'Yes, Close!', 'changeStatus', ['id' => $id]); //($type,$title,$text,$confirmText,$method)
        }
    }

    public function changeStatus(TroubleTicket $ticket)
    {
        if ($ticket->is_closed == 1) {
            $ticket->fill(['is_closed' => 0, 'closed_on' => date('Y-m-d')])->save();
        } elseif ($ticket->is_closed == 0) {
            $ticket->fill(['is_closed' => 2, 'closed_on' => null])->save();
        } else {
            $ticket->fill(['is_closed' => 0, 'closed_on' => date('Y-m-d')])->save();
        }


        $this->showModal('success', 'Success', 'Status has been changed successfully');
    }
}
