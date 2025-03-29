<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BusinessProfile;

class SearchDropdown extends Component
{
    public $query = '';
    public $results = [];
    public $highlightIndex = 0;
    public $showDropdown = false;

    protected $listeners = ['resetSearch'];

    public function resetSearch()
    {
        $this->query = '';
        $this->results = [];
        $this->highlightIndex = 0;
        $this->showDropdown = false;
    }

    public function updatedQuery()
    {
        if (strlen($this->query) > 2) {
            $this->results = BusinessProfile::where('business_name', 'like', '%' . $this->query . '%')
                ->orWhere('street_address', 'like', '%' . $this->query . '%')
                ->take(5)
                ->get()
                ->toArray();
            
            $this->showDropdown = true;
            // dd($this->results);
        } else {
            $this->results = [];
            $this->showDropdown = false;
        }
    }

    public function selectResult($id)
    {
        $businessProfile = BusinessProfile::find($id);
        $this->emit('showBusinessProfileModal', $businessProfile);
        $this->resetSearch();
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
