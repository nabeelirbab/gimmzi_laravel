<?php

namespace App\Http\Livewire\Frontend\MarketUniverse;

use App\Models\BusinessCategory;
use App\Models\BusinessProfile;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
class Index extends Component
{
    public $category_lists = [], $category = [], $deals = [];
    public $allCategory = false, $allType = false;
    public $current_lat, $current_long;

    public function mount()
    {

        $this->category_lists = BusinessCategory::where('status', 1)->get();

        if (request()->category) {
            $this->category[0] = base64_decode(request()->category);
        }
        if (request()->category == 'all') {
            $this->allCategory = true;
        }
        if ($this->allCategory == true) {
            foreach ($this->category_lists as $category) {
                $this->category[] = $category->id;
            }
        }

        if (request()->type == 'loyaltyRewards') {
            $this->deals['loyaltyRewards'] = true;
        } elseif (request()->type == 'gimmziDeals') {
            $this->deals['gimmziDeals'] = true;
        }
    }

    public function updatedAllCategory($value)
    {
        if ($value) {
            foreach ($this->category_lists as $category) {
                $this->category[] = $category->id;
            }
        } else {
            $this->category = [];
        }
    }

    public function haversineDistance($lat2, $lon2)
    {
        $earthRadius = 3959; // in miles

        $dLat = deg2rad($lat2 - $this->current_lat);
        $dLon = deg2rad($lon2 - $this->current_long);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($this->current_lat)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return round($distance, 2);
    }

    public function updatedCategory()
    {
        $selectedCount = count($this->category);
        $categoryCount =  $this->category_lists->count();
        if ($selectedCount < $categoryCount) {
            $this->allCategory = false;
        } else {
            $this->allCategory = true;
        }
    }
    public function updatedAllType()
    {
        $this->deals['loyaltyRewards'] = $this->allType == true ? true : false;
        $this->deals['gimmziDeals'] = $this->allType == true ? true : false;
    }

    public function updatedDeals()
    {
        if (array_key_exists('loyaltyRewards', $this->deals) && $this->deals['loyaltyRewards'] && array_key_exists('gimmziDeals', $this->deals) && $this->deals['gimmziDeals'] == true) {
            $this->allType = true;
        } else {
            $this->allType = false;
        }
    }

    public function resetFilter(){
        $this->allType = true;
        $this->allCategory = true;
        $this->deals['loyaltyRewards'] = true;
        $this->deals['gimmziDeals']  = true;
        foreach ($this->category_lists as $category) {
            $this->category[] = $category->id;
        }
    }

    public function CheckConsumer(){
        if(Auth::check()){
            if(auth()->user()->role_name == 'CONSUMER'){
                
            }
            else{
                $this->emit('messageModal', [
                    'text'  => 'Please you have to login first as consumer',
                ]);
            }
        }
        else{
            $this->emit('messageModal', [
                'text'  => 'Please you have to login first as consumer',
            ]);
        }
    }

    public function render()
    {
        $business_profiles = BusinessProfile::query();
        if ($this->category) {
            $business_profiles = $business_profiles->whereIn('business_category_id', $this->category);
        }
        if (array_key_exists('loyaltyRewards', $this->deals) && $this->deals['loyaltyRewards'] && array_key_exists('gimmziDeals', $this->deals) && $this->deals['gimmziDeals']) {
            $business_profiles = $business_profiles;
        } elseif ($this->deals && array_key_exists('loyaltyRewards', $this->deals) && $this->deals['loyaltyRewards']) {
            $business_profiles = $business_profiles->whereHas('loyalty', function ($loyalty) {
                $loyalty->where('status', 1);
            });
        } elseif ($this->deals && array_key_exists('gimmziDeals', $this->deals) && $this->deals['gimmziDeals']) {
            $business_profiles = $business_profiles->whereHas('deals', function ($deals) {
                $deals->where('status', 1);
            });
        }
        return view('livewire.frontend.market-universe.index', [
            'business_profiles' => $business_profiles
                ->with(['states', 'deals', 'loyalty'])
                ->where('status', 1)
                ->get()
        ]);
    }
}
