<?php

namespace App\Http\Livewire\Frontend\Consumer;

use App\Models\ApartmentGuestBadge;
use Livewire\Component;
use App\Models\ConsumerWallet;
use App\Models\ShortTermGuestBadge;
use App\Models\HotelGuestBadges;
use DateTime;

class Dashboard extends Component
{
    public $user,$deal_count, $loyalty_count, $travel_badge_count,$community_badge_count, $member_since, $point_cycle;
    public function mount(){
        $this->user = auth()->user();
        $this->deal_count = ConsumerWallet::where('consumer_id',auth()->user()->id)->where('deal_id','!=',null)->count();
        $this->loyalty_count = ConsumerWallet::where('consumer_id',auth()->user()->id)->where('loyalty_id','!=',null)->count();
        $short_term_badge_count = ShortTermGuestBadge::where('guest_id',auth()->user()->id)->count();
        $hotel_badge_count = HotelGuestBadges::where('user_id',auth()->user()->id)->count();
        $this->travel_badge_count = $short_term_badge_count+$hotel_badge_count;
        $this->community_badge_count = ApartmentGuestBadge::where('user_id',auth()->user()->id)->count();
        $this->member_since = date_format(date_create(auth()->user()->created_at),'m-d-Y');

        $currentDate = new DateTime();
        $currentMonth = $currentDate->format('m');
        $currentYear = $currentDate->format('Y');
        $currentDate->modify('+1 month');
        $nextMonth = $currentDate->format('m');
        $this->point_cycle = $nextMonth.'/1';
    }

    public function render()
    {
        return view('livewire.frontend.consumer.dashboard');
    }
}
