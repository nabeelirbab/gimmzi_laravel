<?php

namespace App\Http\Livewire\Frontend\TravelTourism\HotelResort;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HotelResortDashboard extends Component
{
    use AlertMessage;
    public $user, $new_password, $confirm_password;
    public function mount(){
        $this->user = Auth::user();
    }

    public function changeUserPassword(){
        // dd(124);
        $this->validate(
            [
                'new_password' => ['required','min:8'],
                'confirm_password' => ['required','same:new_password','min:8'],
            ],
            [
                'new_password.required' => "New Password field is required",
                'new_password.required' => "New Password must be at least 8 characters",
                'confirm_password.required' => "Confirm Password field is required",
                'confirm_password.same' => "New password and Confirm Password should be same",
                'confirm_password.min' => "Confirm Password must be at least 8 characters",
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->created_password = null;
        $user->password = $this->new_password;
        $user->save();

        $msgAction = 'New Password has been updated successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('frontend.hotel_resort.dashboard');
    }
    public function render()
    {
        return view('livewire.frontend.travel-tourism.hotel-resort.hotel-resort-dashboard');
    }
}
