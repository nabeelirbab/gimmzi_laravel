<?php

namespace App\Http\Livewire\Frontend\TravelTourism;

use Livewire\Component;
use App\Models\ShortTermRentalListing;

class RequestInfo extends Component
{
    public $shortTermRentalList = [];

    public function mount()
    {
        $this->shortTermRentalList = ShortTermRentalListing::get();
        // $this->emit('viewRequstInfo');
    }
    public function render()
    {
        return view('livewire.frontend.travel-tourism.request-info');
    }
}
