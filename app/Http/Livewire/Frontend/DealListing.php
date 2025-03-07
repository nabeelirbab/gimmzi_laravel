<?php

namespace App\Http\Livewire\Frontend;

use App\Models\BusinessProfile;
use Livewire\Component;

class DealListing extends Component
{
    public $latitude, $longitude, $location;

    public function updatedLocation($value)
    {
        if (!$value) {
            $this->latitude = '';
            $this->longitude = '';
        }
    }

    public function render()
    {
        $businesses = BusinessProfile::query();
        if ($this->latitude && $this->longitude) {
            $haversine = "(
                3959 * acos(
                    cos(radians(" . $this->latitude . "))
                    * cos(radians(`latitude`))
                    * cos(radians(`longitude`) - radians(" . $this->longitude . "))
                    + sin(radians(" . $this->latitude . ")) * sin(radians(`latitude`))
                )
            )";

            $businesses = $businesses->whereHas('locations', function ($locations) use ($haversine) {
                $locations->selectRaw("$haversine AS distance")
                    ->having("distance", "<=", 600);
            });
        }

        return view('livewire.frontend.deal-listing', [
            'businesses' => $businesses
                ->withCount('deals')
                ->with('states')
                ->where('status', 1)
                ->get()
        ]);
    }
}
