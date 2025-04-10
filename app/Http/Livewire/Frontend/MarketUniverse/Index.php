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
    public $search = '';
    public $location = ''; 
    public $searchLat = ''; 
    public $searchLng = '';
  
    public $radius = 50; 

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
        $this->searchLat ='';
        $this->searchLng ='';
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

    public function updatedSearch()
    {
        $this->render(); 
        dd($this->search); // This will stop execution and show the search text
    }

    public function updatedLocation($value)
    {   // Debugging line to check the value of location
        if (!empty($value)) {
            try {
                $apiKey = 'AIzaSyBNL_1BSqiKF5qf0WqLbMT4xF1dB1Aux1M'; // Your existing key
                $address = urlencode($value);
                $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";
                
                $response = file_get_contents($url);
                $data = json_decode($response);
                // dd($data); 
                if ($data->status === 'OK') {
                    $this->searchLat = $data->results[0]->geometry->location->lat;
                    $this->searchLng = $data->results[0]->geometry->location->lng;
                } else {
                    // Fallback to default coordinates
                    $this->searchLat = '37.5433';
                    $this->searchLng = '-77.4360';
                }
                
            } catch (\Exception $e) {
                // Fallback to default coordinates
                $this->searchLat = '37.5433';
                $this->searchLng = '-77.4360';
            }
        } else {
            $this->searchLat = null;
            $this->searchLng = null;
        }
        
        $this->render(); // Refresh the component with new coordinates
    }

    public function render()
    {
        $business_profiles = BusinessProfile::query();

        // Search by business name if search term exists
        if (!empty($this->search)) {
            $business_profiles = $business_profiles->where('business_name', 'LIKE', '%' . $this->search . '%');
        }

        // Location-based search with proper distance calculation
        if($this->searchLat && $this->searchLng) {
            $business_profiles = BusinessProfile::query()
                ->select('business_profiles.*')
                ->join('business_locations', 'business_profiles.id', '=', 'business_locations.business_profile_id')
                ->selectRaw(
                    "(3959 * acos(cos(radians(?)) * 
                    cos(radians(latitude)) * 
                    cos(radians(longitude) - radians(?)) + 
                    sin(radians(?)) * 
                    sin(radians(latitude)))) AS distance",
                    [$this->searchLat, $this->searchLng, $this->searchLat]
                )
                ->having('distance', '<', $this->radius)
                ->orderBy('distance', 'asc')
                ->groupBy('business_profiles.id');
        }

        // Category filter
        if ($this->category) {
            $business_profiles = $business_profiles->whereIn('business_category_id', $this->category);
        }

        // Deals conditions
        if (array_key_exists('loyaltyRewards', $this->deals) && $this->deals['loyaltyRewards'] && 
            array_key_exists('gimmziDeals', $this->deals) && $this->deals['gimmziDeals']) {
            // No additional conditions needed
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
                ->with(['states', 'deals', 'loyalty', 'locations'])
                ->where('business_profiles.status', 1) // Specify table name to resolve ambiguity
                ->get()
        ]);
    }
}
