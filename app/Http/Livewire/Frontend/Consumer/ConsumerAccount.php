<?php

namespace App\Http\Livewire\Frontend\Consumer;

use Livewire\Component;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Hash;
use App\Models\ApartmentGuestBadge;
use App\Models\ConsumerWallet;
use App\Models\ShortTermGuestBadge;
use App\Models\HotelGuestBadges;



class ConsumerAccount extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $user, $first_name, $last_name, $phone, $email, $birthdate, $profile_picture, $new_password, $current_password, $user_photo,$communication_setting,$newsletter,$unsubscribe_from_all,$gimmzi_upcoming_event,$special_promotion_offer,$gimmzi_update;
    public $info_readonly, $password_readonly, $info_disabled;
    public $deal_count, $loyalty_count, $travel_badge_count, $community_badge_count;

    public function mount()
    {
        // dd($travel_badge_count);
        $this->info_readonly = 'readonly';
        $this->info_disabled = 'disabled';
        $this->password_readonly = 'readonly';
        $this->user = Auth::user();
        // dd($this->user->password);
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
        if($this->user->date_of_birth){
            $this->birthdate = date('m-d-Y',strtotime($this->user->date_of_birth));
        }else{
            $this->birthdate = ''; 
        }
        // dd($this->birthdate);
        $this->profile_picture = $this->user->profile_photo_path;

        if( $this->user->communication_setting == null){
            $this->communication_setting = 'email_and_text';
        }else{
            $this->communication_setting = $this->user->communication_setting;
        }
        
        if($this->user->unsubscribe_from_all == 0){

            if($this->user->newsletter == 0 && $this->user->gimmzi_upcoming_event == 0 && $this->user->special_promotion_offer == 0 && $this->user->gimmzi_update == 0){
                $this->newsletter = 1;
                $this->gimmzi_upcoming_event = 1;
                $this->special_promotion_offer = 1;
                $this->gimmzi_update = 1;
            }else{
                $this->newsletter = $this->user->newsletter;
                $this->gimmzi_upcoming_event = $this->user->gimmzi_upcoming_event;
                $this->special_promotion_offer = $this->user->special_promotion_offer;
                $this->gimmzi_update = $this->user->gimmzi_update;
            }
            
            // if( $this->user->newsletter == 0){
            //     $this->newsletter = 1;
            // }else{
            //     $this->newsletter = $this->user->newsletter;
            // }
            // if( $this->user->gimmzi_upcoming_event == 0){
            //     $this->gimmzi_upcoming_event = 1;
            // }else{
            //     $this->gimmzi_upcoming_event = $this->user->gimmzi_upcoming_event;
            // }
            // if( $this->user->special_promotion_offer == 0){
            //     $this->special_promotion_offer = 1;
            // }else{
            //     $this->special_promotion_offer = $this->user->special_promotion_offer;
            // }
            // if( $this->user->gimmzi_update == 0){
            //     $this->gimmzi_update = 1;
            // }else{
            //     $this->gimmzi_update = $this->user->gimmzi_update;
            // }

        }else{
            $this->newsletter = $this->user->newsletter;
            $this->gimmzi_upcoming_event = $this->user->gimmzi_upcoming_event;
            $this->special_promotion_offer = $this->user->special_promotion_offer;
            $this->gimmzi_update = $this->user->gimmzi_update;
            $this->unsubscribe_from_all = $this->user->unsubscribe_from_all;
        }
        

        // dd($this->newsletter);

        // $this->newsletter = $this->user->newsletter;
        // $this->gimmzi_upcoming_event = $this->user->gimmzi_upcoming_event;
        // $this->special_promotion_offer = $this->user->special_promotion_offer;
        // $this->gimmzi_update = $this->user->gimmzi_update;
    }

    public function UpdatedUserPhoto(){
        // dd($this->user_photo);
        $this->validate([
            'user_photo' => ['nullable', 'mimes:jpg,jpeg,png,svg'],      
        ], [
            'user_photo.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
        ]);
    }
    public function removeReadonly($attribute){
        if($attribute == 'personal_info'){
            $this->info_readonly = '';
            $this->info_disabled = '';
        }
    }

    public function removeReadonlyPassword($attribute){
        if($attribute == 'password_change'){
            $this->password_readonly = '';
        }
    }

    public function details_submit(){
        // dd('sdcsdc');
        
        $input =  $this->validate(
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'new_password' => ['nullable','min:6'],
                'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'max:255', Rule::unique('users')->ignore($this->user->id)],
                'phone' => ['required', Rule::unique('users')->ignore($this->user->id), 'digits_between:8,15', 'numeric'],
                'communication_setting' => ['nullable'],
                'birthdate' => ['nullable'],
                'user_photo' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
            ],
            [
                'full_name.required' => "The Full Name field is required",
                'new_password.required' => "The password field is required",
                'new_password.min' => "The Password field must be minimum 6 characters",
                'email.required' => "The Email field is required",
                'email.email' => "The email field must be a valif email address",
                'phone.required' => "The phone field is required",
                'phone.numeric' => "The phone field should be a valid number",
                'birthdate.required' => "The Date Of Birth field is required",
                'user_photo.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
            ]
        );

        // dd($this->unsubscribe_from_all, $this->newsletter, $this->gimmzi_update,$this->special_promotion_offer,$this->gimmzi_upcoming_event );

        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        if($this->birthdate){
            $this->user->date_of_birth = Carbon::createFromFormat('m-d-Y', $this->birthdate)->format('Y-m-d');
        }
        // dd($this->current_password);
        if($this->new_password != ''){
            if (Hash::check($this->current_password, $this->user->password)) {
                $this->user->password = $this->new_password;
            }else{
                $this->showToastr("error", 'Your current password did not match your original password');
                return;
            }
        }
        $this->user->email = $this->email;
        $this->user->phone = $this->phone;

        
        
        if($this->unsubscribe_from_all == '1'){
            $this->user->unsubscribe_from_all = 1;
            $this->user->gimmzi_upcoming_event = 0;
            $this->user->special_promotion_offer = 0;
            $this->user->gimmzi_update = 0;
            $this->user->newsletter = 0;
        }else{
            $this->user->unsubscribe_from_all = 0;
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

        // dd($this->user_photo);

        if ($this->user_photo != null) {
            if (gettype($this->user_photo) != 'string') {
                if (file_exists($this->profile_picture)) {
                    @unlink($this->profile_picture);
                }
                $file = $this->user_photo;
                $path = 'consumer';
                $final_image_url = ImageHelper::customSaveImage($file, $path);
                $this->user->profile_photo_path = $final_image_url;
            } else {
                $this->user->profile_photo_path = $this->profile_picture;
            }
        }
        // dd($this->user->profile_photo_path);
        $this->profile_picture = $this->user->profile_photo_path;

        if ($this->user->isDirty()) {
            $this->user->save();
            $msgAction = 'Profile has been updated successfully';
            // $this->showToastr("success", $msgAction);
            $this->emit('popUp',['text' => $msgAction]);
        }

    }
    
    public function render()
    {
        return view('livewire.frontend.consumer.consumer-account');
    }
}
