<?php

namespace App\Http\Livewire\Frontend\Consumer;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Deal;
use App\Models\ConsumerWallet;
use App\Models\Apartmentbadge;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use App\Models\HotelGuestBadges;
use App\Models\ShortTermGuestBadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ConsumerLoyaltyReward;
use App\Models\MerchantLoyaltyProgram;
use App\Models\ConsumerLoyaltyRewardRedemption;

class ConsumerProfileBadges extends Component
{
    public $item_image,$active_apartment_count,$active_hotel_count,$active_short_term,$hotel_short_total_count,$overall_count,$hotel_count;
    public $BadgeselectedFilter = 'all_badge';

    public function mount(){
        $this->emitSelf('refreshImages');
        $this->item_image = 'frontend_assets/images/badge-gimmzi.png';
        $this->active_apartment_count = ApartmentGuestBadge::where('status',1)->where('user_id', auth()->user()->id)->count();
        $this->active_hotel_count = HotelGuestBadges::where('status',1)
        ->where('user_id', auth()->user()->id)
        ->whereHas('guestbadges', function ($query) {
            $query->whereDate('start_date', '<=', now())
                ->whereDate('end_date', '>=', now());
        })
        ->count();

        
        $this->active_short_term = ShortTermGuestBadge::where('guest_id',auth()->user()->id)->where('badge_status',1)->count();

        $this->hotel_count = HotelGuestBadges::where('status',1)->where('user_id', auth()->user()->id)->count();
        $this->hotel_short_total_count = $this->active_hotel_count + $this->active_short_term;
        $this->overall_count = $this->hotel_short_total_count + $this->active_apartment_count;
        // dd($this->active_apartment_count,$this->active_hotel_count,$this->active_short_term,$this->hotel_short_total_count);
    }

    public function badgeSetFilter($filter)
    {
        $this->BadgeselectedFilter = $filter;
        // dd($this->selectedFilter);
    }

    public function render()
    {
        return view('livewire.frontend.consumer.consumer-profile-badges');
    }
}
