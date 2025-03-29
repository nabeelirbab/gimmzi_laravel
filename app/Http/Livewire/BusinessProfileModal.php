<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BusinessProfileModal extends Component
{
    public $showModal = false;
    public $businessProfile;

    protected $listeners = ['showBusinessProfileModal'];

    public function showBusinessProfileModal($businessProfile)
    {
        // dd($businessProfile);
        $this->businessProfile = $businessProfile;
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.business-profile-modal');
    }
}
