<?php

namespace App\Http\Livewire\Frontend\TravelTourism\MyProfile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ImageHelper;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Http\Livewire\Traits\AlertMessage;
use App\Models\User;


class ProfileSettings extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $user, $name_readonly,$email_readonly, $password_readonly, $phone_readonly, $user_photo, $imgId;
    public $full_name,$email,$phone,$password,$communication_setting,$newsletter,$unsubscribe_from_all,$gimmzi_upcoming_event,$special_promotion_offer,$gimmzi_update;

    public function mount(){
        if(Auth::user()){
            $this->user = Auth::user();
        }
        $this->name_readonly = 'readonly';
        $this->email_readonly = 'readonly';
        $this->phone_readonly = 'readonly';
        $this->password_readonly = 'readonly';
        $this->full_name = $this->user->full_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->communication_setting = $this->user->communication_setting;
        $this->newsletter = $this->user->newsletter;
        $this->unsubscribe_from_all = $this->user->unsubscribe_from_all;
        $this->gimmzi_upcoming_event = $this->user->gimmzi_upcoming_event;
        $this->special_promotion_offer = $this->user->special_promotion_offer;
        $this->gimmzi_update = $this->user->gimmzi_update;
        $this->imgId = $this->user->profile_photo_path;
    }

    public function removeReadonly($attribute){
        if($attribute == 'name'){
            $this->name_readonly = '';
        }
        if($attribute == 'email'){
            $this->email_readonly = '';
        }
        if($attribute == 'phone'){
            $this->phone_readonly = '';
        }
        if($attribute == 'password'){
            $this->password_readonly = '';
        }
        
    }

    public function updatedUserPhoto(){
        if ($this->user_photo != null) {
            $this->validate(
                [
                    'user_photo' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
                ],
                [
                    'user_photo.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
                ]
            );
            if (gettype($this->user_photo) != 'string') {
                if (file_exists($this->imgId)) {
                    @unlink($this->imgId);
                }
                $file = $this->user_photo;
                $path = 'travel-tourism-users';
                $final_image_url = ImageHelper::customSaveImage($file, $path);
                $input['profile_photo_path'] = $final_image_url;
            } else {
                $input['profile_photo_path'] = $this->imgId;
            }
            $this->user->fill($input)->save();
        }
        $this->imgId = $this->user->profile_photo_path;
    }

    public function updateProfile(){
        $input =  $this->validate(
            [
                'full_name' => ['required'],
                'password' => ['nullable','min:6'],
                'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'phone' => ['required', Rule::unique('users')->ignore($this->user->id), 'digits_between:8,15', 'numeric'],
                'communication_setting' => ['nullable'],
                'newsletter' => ['nullable'],
                'gimmzi_update' => ['nullable'],
                'special_promotion_offer' => ['nullable'],
                'gimmzi_upcoming_event' => ['nullable'],
                'unsubscribe_from_all' => ['nullable'],
            ],
            [
                'full_name.required' => "The Full Name field is required",
                'password.required' => "The password field is required",
                'password.min' => "The Password field must be minimum 6 characters",
                'email.required' => "The Email field is required",
                'email.email' => "The email field must be a valif email address",
                'phone.required' => "The phone field is required",
                'phone.numeric' => "The phone field should be a valid number",
            ]
        );
        //dd($this->full_name, $this->password);
        
        $name_parts = explode(" ", $this->full_name); 
        $first_name = $name_parts[0];
        $last_name = $name_parts[1];

        $this->user->first_name = $first_name;
        $this->user->last_name = $last_name;
        $this->user->last_name = $last_name;
        if($this->password != ''){
            $this->user->password = $this->password;
        }
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;
        if($this->newsletter == '1'){
            $this->user->newsletter = 1;
        }else{
            $this->user->newsletter = 0;
        }
        if($this->gimmzi_update == '1'){
            $this->user->gimmzi_update = 1;
        }else{
            $this->user->gimmzi_update = 0;
        }
        //dd($this->special_promotion_offer);
        if($this->special_promotion_offer == '1'){
            $this->user->special_promotion_offer = 1;
        }else{
            $this->user->special_promotion_offer = 0;
        }
        if($this->gimmzi_upcoming_event == '1'){
            $this->user->gimmzi_upcoming_event = 1;
        }else{
            $this->user->gimmzi_upcoming_event = 0;
        }
        if($this->unsubscribe_from_all == '1'){
            $this->user->unsubscribe_from_all = 1;
        }else{
            $this->user->unsubscribe_from_all = 0;
        }

        if($this->communication_setting == 'email_and_text'){
            $this->user->communication_setting = 'email_and_text';
        }elseif($this->communication_setting == 'email_only'){
            $this->user->communication_setting = 'email_only';
        }elseif($this->communication_setting == 'text_only'){
            $this->user->communication_setting = 'text_only';
        }else{
            $this->user->communication_setting = ' ';
        }

        $this->user->save();

        $msgAction = 'Profile has been updated successfully';
        $this->showToastr("success", $msgAction);
        if(Auth::user()->role_name == 'SHORT TERM RENTAL PROVIDER'){
            return redirect()->route('frontend.short_term.get_provider_profile');
        }else{
            return redirect()->route('frontend.hotel.get_provider_profile');
        }

    }
    public function render()
    {
        //dd(Auth::user());
        return view('livewire.frontend.travel-tourism.my-profile.profile-settings');
    }
}
