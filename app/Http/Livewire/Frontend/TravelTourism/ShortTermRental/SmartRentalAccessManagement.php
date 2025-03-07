<?php

namespace App\Http\Livewire\Frontend\TravelTourism\ShortTermRental;

use App\Models\User;
use App\Models\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Livewire\Traits\AlertMessage;
use App\Mail\InvitationToTravelTourismMail;
use App\Mail\ShortTermChangePasswordLinkMail;

class SmartRentalAccessManagement extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $user, $providers, $pending_users, $userid, $remove_user;
    public $first_name, $last_name, $email, $phone, $phone_ext, $image, $role_id, $resend_user;
    public $imgId, $status = 1, $edit_user;
    protected $listeners = ['openAddUserModal', 'closeAdduser', 'openRemoveConfirmModal', 'closeRemoveModal', 'removePendingUser', 'openResendConfirmModal', 'showEditRequestUserModal'];
    public $selectedUserId, $selected_provider, $search_user;
    public function mount()
    {
        $this->user = Auth::user();
        $this->providers = User::where('travel_tourism_id', $this->user->travel_tourism_id)
            ->where('travel_type', 'short-rental')
            ->where('created_password', null)
            ->whereNotIn('id', [$this->user->id])
            // ->where('active', true)
            ->orderBy('first_name','asc')
            ->get();
        $this->pending_users = User::where('travel_tourism_id', $this->user->travel_tourism_id)
            ->where('travel_type', 'short-rental')
            ->where('created_password', '!=', null)
            ->whereNotIn('id', [$this->user->id])
            ->get();
        $this->remove_user = '';
    }

    public function showSuccessModal($text)
    {
        $this->emit('successModal', [
            'text'  => $text,
        ]);
    }

    public function hideSuccessModal()
    {
        $this->emit('hidesuccessModal');
    }

    public function openAddUserModal()
    {
        $this->emit('showAddUserModal');
    }

    public function addNewUser()
    {

        $this->validate(
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'max:255', Rule::unique('users')],
                'phone' => ['required', Rule::unique('users'), 'digits_between:8,15', 'numeric'],
                'phone_ext' => ['nullable'],
                'image' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
            ],
            [
                'name.required' => "The name field is required",
                'image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
            ]
        );
        $this->resetForm();
        $this->emit('hideAddUserModal');
        $this->emit('showAddUserRoleModal');
    }



    public function selectedUserId($id)
    {
        $this->selectedUserId = $id;
        $this->selected_provider = User::find($this->selectedUserId);
    }


    public function editRentalAccessUser()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->phone_ext = $user->phone_ext;
            $this->imgId = $user->profile_photo_path;
            $this->emit('showRentalAccessModel');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Please select a user']);
        }
    }


    public function pendingUser()
    {
        $this->selectedUserId = null;
        $this->emit('showPendingUserModal');
    }

    public function updateRentalAccessUser()
    {
        try {
            // dd($this->selectedUserId , $this->edit_user);
            if($this->selectedUserId != null){

            
            $user = User::find($this->selectedUserId);
            $input =  $this->validate(
                [
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'max:255', Rule::unique('users')->ignore($user->id)],
                    'phone' => ['required', Rule::unique('users')->ignore($user->id), 'digits_between:8,15', 'numeric'],
                    'phone_ext' => ['nullable'],
                    'image' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
                ],
                [
                    'name.required' => "The name field is required",
                    'image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
                ]
            );
            if ($this->image != null) {
                if (gettype($this->image) != 'string') {
                    if (file_exists($this->imgId)) {
                        @unlink($this->imgId);
                    }
                    $file = $this->image;
                    $path = 'travel-tourism-users';
                    $final_image_url = ImageHelper::customSaveImage($file, $path);
                    $input['profile_photo_path'] = $final_image_url;
                } else {
                    $input['profile_photo_path'] = $this->imgId;
                }
            }
            $user->fill($input)->save();
            $msgAction = 'Short term rental user has been updated successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
            // $this->emit('hideEditRequestModal');
            // $this->dispatchBrowserEvent('success', ['message' => 'Pending User updated successfully.']);
        }else{
            
            $user = User::find($this->edit_user->id);
            $input =  $this->validate(
                [
                    'first_name' => ['required'],
                    'last_name' => ['required'],
                    'email' => ['required', 'email', 'regex:/(.+)@(.+)\.(.+)/i', 'max:255', Rule::unique('users')->ignore($user->id)],
                    'phone' => ['required', Rule::unique('users')->ignore($user->id), 'digits_between:8,15', 'numeric'],
                    'phone_ext' => ['nullable'],
                    'image' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
                ],
                [
                    'name.required' => "The name field is required",
                    'image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
                ]
            );
            if ($this->image != null) {
                if (gettype($this->image) != 'string') {
                    if (file_exists($this->imgId)) {
                        @unlink($this->imgId);
                    }
                    $file = $this->image;
                    $path = 'travel-tourism-users';
                    $final_image_url = ImageHelper::customSaveImage($file, $path);
                    $input['profile_photo_path'] = $final_image_url;
                } else {
                    $input['profile_photo_path'] = $this->imgId;
                }
            }
            $user->fill($input)->save();

            $this->pending_users = User::where('travel_tourism_id', $user->travel_tourism_id)
            ->where('travel_type', 'short-rental')
            ->where('created_password', '!=', null)
            ->get();
          
            // dd( $this->pending_users);
            $this->emit('hideEditRequestModal');
            $this->dispatchBrowserEvent('success', ['message' => 'Pending User updated successfully.']);
        }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error', ['message' => $th->getMessage()]);
        }
    }



    public function sendUserInvite()
    {
        try {
            if ($this->role_id != null) {
                $shortTerm = $this->user->travelType;
                $title = Title::find($this->role_id);
                $password = Str::random(8);
                $today = date('Y-m-d');
                $expiry_date = date('Y-m-d', strtotime($today . ' + 14 days'));
                if ($shortTerm) {
                    $newUser = new User();
                    $newUser->first_name = $this->first_name;
                    $newUser->last_name = $this->last_name;
                    $newUser->email = $this->email;
                    $newUser->phone = $this->phone;
                    $newUser->phone_ext = $this->phone_ext;
                    $newUser->travel_tourism_id = $shortTerm->id;
                    $newUser->active = true;
                    $newUser->invited_by = $this->user->id;
                    $newUser->title_id = $this->role_id;
                    $newUser->password = $password;
                    $newUser->created_password = $password;
                    $newUser->travel_type = 'short-rental';
                    $newUser->expiry_date = $expiry_date;
                    if ($this->image) {
                        $file = $this->image;
                        $path = 'travel-tourism-users';
                        $final_image_url = ImageHelper::customSaveImage($file, $path);
                    }
                    $newUser->profile_photo_path = $final_image_url ?? NULL;
                    $newUser->assignRole('SHORT TERM RENTAL PROVIDER');
                    $newUser->save();
                    $url = url('/property-login-modal');
                    if ($newUser->role_name == 'SHORT TERM RENTAL PROVIDER') {
                        $portalType = 'Short Term Rental';
                    }
                    $details = [
                        'role' => $title->title_name,
                        'travel_type' => $shortTerm->name,
                        'email'  =>  $newUser->email,
                        'password' => $password,
                        'name' => $newUser->full_name,
                        'url' => $url,
                        'portalType' => $portalType,
                        'sender_name' => Auth::user()->full_name
                    ];
                    Mail::to($newUser->email)->queue(new InvitationToTravelTourismMail($details));
                    $msgAction = 'Short term rental user has been added successfully';
                    $this->showToastr("success", $msgAction);
                    return redirect()->route('frontend.short_term.smart_rental_access_management');
                }
            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'Please select user role']);
            }
        } catch (\Exception $th) {
            $this->dispatchBrowserEvent('error', ['message' => $th->getMessage()]);
        }
    }


    public function editRentalAccessRoleUser()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
            $this->role_id = $user->title_id;
            $this->emit('showRentalAccessRoleModel');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Please select a user']);
        }
    }


    public function updateRentalAccessRoleUser()
    {
        $user = User::find($this->selectedUserId);
        $user->title_id = $this->role_id;
        $user->save();
        $msgAction = 'Short term rental user role chnage has been successfully updated.';
        $this->showToastr("success", $msgAction);
        return redirect()->route('frontend.short_term.smart_rental_access_management');
    }

    public function changePassword()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
            $created_token = Str::random(6);
            $user->remember_token = $created_token;
            $user->save();
            $url = url('reset-short-term-rental-provider-password/' . $created_token);
            $details = [
                'name' => $user->full_name,
                'url' => $url
            ];
            Mail::to($user->email)->queue(new ShortTermChangePasswordLinkMail($details));
            if (!Mail::failures()) {
                $msgAction = 'A password reset link has been sent to the email address';
                $this->showToastr("success", $msgAction);
                return redirect()->route('frontend.short_term.smart_rental_access_management');
            } else {
                $msgAction = 'Mail not sent';
                $this->showToastr("error", $msgAction);
                return redirect()->route('frontend.short_term.smart_rental_access_management');
            }
        } else {
            $msgAction = 'user not found';
            $this->showToastr("error", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        }
    }

    public function deactivateUser()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
            $this->emit('showRemoveModal', ['name' => $user->full_name]);
        } else {
            $msgAction = 'User not found';
            $this->showToastr("error", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        }
    }

    public function removeUser()
    {
        $user = User::find($this->selectedUserId);
        // dd($user);
        if ($user) {
            // $user->active = false;
            $user->delete();
            $msgAction = 'User deactivated successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        } else {
            $msgAction = 'User not found';
            $this->showToastr("error", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        }
    }

    public function activateUser()
    {
        $user = User::find($this->selectedUserId);
        if ($user) {
            $user->active = true;
            $user->save();
            $msgAction = 'User activated successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        } else {
            $msgAction = 'User not found';
            $this->showToastr("error", $msgAction);
            return redirect()->route('frontend.short_term.smart_rental_access_management');
        }
    }

    public function StatusWiseUser()
    {
        $user = User::query();
        if ($this->status != '') {
            if ($this->status == 'name(A-Z)') {
                $this->providers = $user->with('title')
                                    ->join('titles', 'titles.id', '=', 'users.title_id')
                                    ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                    ->where('users.travel_type', 'short-rental')
                                    ->whereNotIn('users.id', [$this->user->id])
                    // ->where('created_password', null)
                    // ->where('active', false)
                                    ->orderBy('users.first_name','asc')
                                    ->get();
            } elseif ($this->status == 'name(Z-A)') {
                $this->providers = $user->with('title')
                                    ->join('titles', 'titles.id', '=', 'users.title_id')
                                    ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                    ->where('users.travel_type', 'short-rental')
                                    ->whereNotIn('users.id', [$this->user->id])
                    // ->where('created_password', null)
                    // ->where('active', true)
                                    ->orderBy('users.first_name','desc')
                                    ->get();
            }
            elseif ($this->status == 'role(A-Z)') {
                $this->providers = $user->with('title')
                                    ->join('titles', 'titles.id', '=', 'users.title_id')
                                    ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                    ->where('users.travel_type', 'short-rental')
                                    ->whereNotIn('users.id', [$this->user->id])
                    // ->where('created_password', null)
                    // ->where('active', true)
                                    ->orderBy('titles.title_name','asc')
                                    ->get();
            }
            elseif ($this->status == 'role(Z-A)') {
                $this->providers = $user->with('title')
                                    ->join('titles', 'titles.id', '=', 'users.title_id')
                                    ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                    ->where('users.travel_type', 'short-rental')
                                    ->whereNotIn('users.id', [$this->user->id])
                    // ->where('created_password', null)
                    // ->where('active', true)
                                    ->orderBy('titles.title_name','desc')
                                    ->get();
            } else {
                $this->providers = $user->with('title')
                                    ->join('titles', 'titles.id', '=', 'users.title_id')
                                    ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                    ->where('users.travel_type', 'short-rental')
                                    ->whereNotIn('users.id', [$this->user->id])
                                    ->orderBy('users.first_name','asc')
                                    ->get();
            }
        } else {
            $this->providers = $user->with('title')
                                ->join('titles', 'titles.id', '=', 'users.title_id')
                                ->where('users.travel_tourism_id', $this->user->travel_tourism_id)
                                ->where('users.travel_type', 'short-rental')
                                ->whereNotIn('users.id', [$this->user->id])
                                ->orderBy('users.first_name','asc')
                                ->get();
        }
    }

    public function searchProvider()
    {
        if ($this->search_user != '') {
            $this->providers = User::with('title')->where('travel_tourism_id', $this->user->travel_tourism_id)
                ->where('travel_type', 'short-rental')
                ->whereNotIn('id', [$this->user->id])
                // ->where('created_password', null)
                ->WhereRaw(
                    "concat(first_name,' ', last_name) like '%" . trim($this->search_user) . "%' "
                )
                ->get();
        } else {
            $this->providers = User::with('title')->where('travel_tourism_id', $this->user->travel_tourism_id)
                ->where('travel_type', 'short-rental')
                ->whereNotIn('id', [$this->user->id])
                // ->where('created_password', null)
                ->get();
        }
    }

    


    public function openResendConfirmModal($userid)
    {
        // dd(1234);
        $this->userid = $userid;
        $this->resend_user = User::where('id', $this->userid)->first();
        // dd($this->resend_user);
        $this->emit('openResendModal');
    }

    public function closeResendModal()
    {
        $this->emit('hideResendModal');
    }

    public function resendPendingUser()
    {
        if ($this->resend_user) {
            // dd($this->resend_user->user_title);
            
            $hotel = $this->resend_user->travelType;
            if ($this->resend_user->created_password != null) {
                $url = url('/property-login-modal');
                if ($this->resend_user->role_name == 'SHORT TERM RENTAL PROVIDER') {
                    $portalType = 'Short Term Rental';
                }
                $details = [
                    'role' => $this->resend_user->user_title,
                    'travel_type' => $hotel->name,
                    'email'  =>  $this->resend_user->email,
                    'password' => $this->resend_user->created_password,
                    'name' => $this->resend_user->full_name,
                    'url' => $url,
                    'portalType' => $portalType,
                    'sender_name' => Auth::user()->full_name

                ];
                Mail::to($this->resend_user->email)->queue(new InvitationToTravelTourismMail($details));
                $this->showSuccessModal('Resend invite Successfully');
            }
        } else {
            $this->showSuccessModal('User Not Found');
        }
    }

    public function openRemoveConfirmModal($userid)
    {
        // dd($userid);
        $this->userid = $userid;
        $this->remove_user = User::where('id', $this->userid)->first();
        //dd($this->remove_user);
        $this->emit('openRemoveModal');
    }

    public function removePendingUser()
    {

        // dd($this->remove_user);
        if ($this->remove_user) {
            $this->remove_user->invited_by = '';
            $this->remove_user->save();
            $user = User::where('id', $this->userid)->delete();
            //$user->delete();

            $this->userid = '';
            $this->remove_user = '';
            $this->showSuccessModal('User Removed Successfully');
        } else {
            $this->showSuccessModal('User Not Found');
        }
    }

    public function showEditRequestUserModal($userid){
        $this->userid = $userid;
        $this->edit_user = User::where('id', $this->userid)->first();
        // dd($this->edit_user);
        if ($this->edit_user) {
            // $this->first_name =  $this->selected_provider->first_name;
            // $this->last_name = $this->selected_provider->last_name;
            // $this->email = $this->selected_provider->email;
            // $this->phone = $this->selected_provider->phone;
            // $this->phone_ext = $this->selected_provider->phone_ext;
            // $this->imgId = $this->selected_provider->profile_photo_path;
            // $this->emit('showRentalAccessModel');
            $this->first_name =  $this->edit_user->first_name;
            $this->last_name = $this->edit_user->last_name;
            $this->email = $this->edit_user->email;
            $this->phone = $this->edit_user->phone;
            $this->phone_ext = $this->edit_user->phone_ext;
            $this->imgId = $this->edit_user->profile_photo_path;
            $this->emit('showRentalAccessModel');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Please select a user']);
        }
    }


    public function closeAdduser()
    {
        $this->emit('hideAddUserModal');
        $this->resetForm();
    }
    public function closeAddRole()
    {
        $this->emit('hideUserRoleModal');
        $this->resetForm();
    }
    public function closeRemoveModal()
    {
        $this->emit('hideRemoveModal');
    }

    public function closeEditRqstModal(){
        $this->emit('hideEditRequestModal');
    }


    private function resetForm()
    {
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.frontend.travel-tourism.short-term-rental.smart-rental-access-management');
    }
}
