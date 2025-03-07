<?php

namespace App\Http\Livewire\Frontend\Consumer;

use Livewire\Component;
use App\Models\Deal;
use App\Models\MerchantLoyaltyProgram;
use App\Models\ShortTermGuestBadge;
use App\Models\ConsumerFavouriteTravelTourism;
use App\Models\User;

class ConsumerProfileFevorites extends Component
{
    public $filterVal = 'all';
    public $user;

    public function mount(){
        $this->user = auth()->user();

    }
    public function setfilterValue($filter1)
    {
        $this->filterVal = $filter1;
        // dd($this->filterVal);
    }
    public function render()
    {
        $get_business = ConsumerFavouriteTravelTourism::with('business','business.deals')->where('is_favourite', 1)->where('consumer_id',$this->user->id)->get()->toArray(); 
        // dd($get_business);
        return view('livewire.frontend.consumer.consumer-profile-fevorites');
    }
}
