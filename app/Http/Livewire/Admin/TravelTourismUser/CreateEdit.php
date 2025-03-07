<?php

namespace App\Http\Livewire\Admin\TravelTourismUser;

use App\Http\Livewire\Traits\AlertMessage;
use Livewire\Component;
use App\Models\Title;
use App\Models\User;
use App\Models\TravelTourism;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;

class CreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $titleList = [], $user, $blankArr = [], $typeList = [], $statusList = [], $travel_type, $isEdit = false, $providerArr = [];
    public $model_image, $imgId, $title_id, $showpassfield;
    public $first_name, $last_name, $email, $phone, $phone_ext, $password, $active, $password_confirmation, $photo, $travel_tourism_id,$hidepassfield;


    public function mount($user = null)
    {
        $this->showpassfield = false;
        if ($user) {
            $this->user = $user;
            $this->fill($this->user);
            $this->isEdit = true;
            if ($this->user->travel_type == '') {
                $this->providerArr = [];
            } else if ($this->user->travel_type == 'short-rental') {
                $this->providerArr = TravelTourism::where('travel_tourism_type', 'Short Rental')->where('status', 1)->get();
            } else {
                $this->providerArr = TravelTourism::where('travel_tourism_type', 'Hotel-Resort')->where('status', 1)->get();
            }
        } else {
            $this->user = new User;
            $this->providerArr = [];
        }
        $this->blankArr = [
            "value" => "", "text" => "== Select One =="
        ];
        $this->typeList = [
            ["value" => "", "text" => "== Select One =="],
            ["value" => "short-rental", "text" => "Short Term Rental"],
            ["value" => "hotel-resort", "text" => "Hotel/Resort"]
        ];
        $this->statusList = [
            ['value' => 0, 'text' => "Choose User"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];
        $this->titleList = Title::where('status', 1)->where('title_name', '!=', 'Lead Manager')->get();

        $this->model_image = Media::where(['model_id' => $this->user->id, 'collection_name' => 'travelTourismUser'])->first();
        if (!$this->model_image == null) {
            $this->imgId = $this->model_image->id;
        }
    }

    public function changeType()
    {
        if ($this->travel_type == '') {
            $this->providerArr = [];
        } else if ($this->travel_type == 'short-rental') {
            $this->providerArr = TravelTourism::where('travel_tourism_type', 'Short Rental')->where('status', 1)->get();
        } else {
            $this->providerArr = TravelTourism::where('travel_tourism_type', 'Hotel-Resort')->where('status', 1)->get();
        }
    }

    public function validationRuleForSave(): array
    {

        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users'), 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable', Rule::unique('users'), 'max:12', 'min:10'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6', 'same:password'],
                'active' => ['required'],
                'photo' => ['nullable'],
                'phone_ext' => ['nullable'],
                'title_id' => ['required'],
                'travel_type' => ['required'],
                'travel_tourism_id' => ['required'],

            ];
    }

    public function validationRuleForUpdate(): array
    {

        if($this->showpassfield == false){
            return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id), 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable', Rule::unique('users')->ignore($this->user->id), 'max:12', 'min:10'],

                'active' => ['required'],
                'photo' => ['nullable'],
                'phone_ext' => ['nullable'],
                'title_id' => ['required'],
                'travel_type' => ['required'],
                'travel_tourism_id' => ['required'],

            ];
        }else{
            return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id), 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable', Rule::unique('users')->ignore($this->user->id), 'max:12', 'min:10'],

                'active' => ['required'],
                'photo' => ['nullable'],
                'phone_ext' => ['nullable'],
                'title_id' => ['required'],
                'travel_type' => ['required'],
                'travel_tourism_id' => ['required'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6', 'same:password'],

            ];
        }
        
    }

    protected $messages = [
        'first_name.required' => 'The First Name field is required',
        'last_name.required' => 'The Last Name field is required',
        'email.required' => 'The Email field is required',
        // 'phone.required' => 'The Phone field is required',
        'password.required' => 'The Password field is required',
        'password_confirmation.required' => 'The Confirm Password field is required',
        'active.required' => 'The Status field is required',
        // 'photo.required' => 'The Profile Image field is required',
        'email.email' => 'The Email must be a valid email address',
        'email.unique' => 'The Email has already been taken',
        'email.regex' => 'The Email format is invalid',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
        'phone.unique' => 'The Phone has already been taken',
        'password.min' => 'The Password must be at least 6 characters',
        'password_confirmation.min' => 'The Confirm Password must be at least 6 characters',
        'password_confirmation.same' => 'The Confirm Password does not match with Password',
        'title_id.required' => 'Please select one Title',
        'travel_type.required' => 'Please select Travel tourism type',
        'travel_tourism_id.required' => 'Please select one short term rental or hotels',

    ];



    public function saveOrUpdate()
    {
        if (!$this->isEdit) {
            if (($this->title_id == 3) || ($this->title_id == 4)) {
                $usertitle = User::where('travel_tourism_id', $this->travel_tourism_id)->where('title_id', $this->title_id)->first();
                if ($usertitle) {
                    $title = Title::find($this->title_id);
                    $travel = TravelTourism::find($this->travel_tourism_id);
                    $msgAction = $travel->name . ' has already one ' . $title->title_name;
                    $this->showToastr("error", $msgAction);
                    return redirect()->route('admin.travel_tourism.usercreate');
                } else {
                    $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                    if ($this->photo) {
                        if ($this->imgId) {
                            $item = Media::find($this->imgId);
                            $item->delete(); // delete previous image in the database

                            $this->user->addMedia($this->photo->getRealPath())
                                ->usingName($this->photo->getClientOriginalName())
                                ->toMediaCollection('travelTourismUser');
                        } else {
                            $this->user->addMedia($this->photo->getRealPath())
                                ->usingName($this->photo->getClientOriginalName())
                                ->toMediaCollection('travelTourismUser');
                        }
                    }
                    if (!$this->isEdit) {
                        if ($this->travel_type == 'short-rental') {
                            $this->user->travel_type = $this->travel_type;
                            $this->user->assignRole('SHORT TERM RENTAL PROVIDER');
                        } else {
                            $this->user->travel_type = $this->travel_type;
                            $this->user->assignRole('HOTEL RESORT PROVIDER');
                        }
                    }
                    $this->user->save();
                }
            } else {
                $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                if ($this->photo) {
                    if ($this->imgId) {
                        $item = Media::find($this->imgId);
                        $item->delete(); // delete previous image in the database

                        $this->user->addMedia($this->photo->getRealPath())
                            ->usingName($this->photo->getClientOriginalName())
                            ->toMediaCollection('travelTourismUser');
                    } else {
                        $this->user->addMedia($this->photo->getRealPath())
                            ->usingName($this->photo->getClientOriginalName())
                            ->toMediaCollection('travelTourismUser');
                    }
                }
                if (!$this->isEdit) {
                    if ($this->travel_type == 'short-rental') {
                        $this->user->travel_type = $this->travel_type;
                        $this->user->assignRole('SHORT TERM RENTAL PROVIDER');
                    } else {
                        $this->user->travel_type = $this->travel_type;
                        $this->user->assignRole('HOTEL RESORT PROVIDER');
                    }
                }
                $this->user->save();
            }
        } else {
            if (($this->title_id == 3) || ($this->title_id == 4)) {
                $usertitle = User::where('id', $this->user->id)->where('travel_tourism_id', $this->travel_tourism_id)->where('title_id', $this->title_id)->first();
                // dd($usertitle);
                if (!$usertitle) {
                    $alreadyadded = User::where('travel_tourism_id', $this->travel_tourism_id)->where('title_id', $this->title_id)->first();
                    if ($alreadyadded) {
                        $title = Title::find($this->title_id);
                        $travel = TravelTourism::find($this->travel_tourism_id);
                        $msgAction = $travel->name . ' has already one ' . $title->title_name;
                        $this->showToastr("error", $msgAction);
                        return redirect()->route('admin.travel_tourism.useredit', $this->user->id);
                    } else {
                        $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                        if ($this->photo) {
                            if ($this->imgId) {
                                $item = Media::find($this->imgId);
                                $item->delete(); // delete previous image in the database

                                $this->user->addMedia($this->photo->getRealPath())
                                    ->usingName($this->photo->getClientOriginalName())
                                    ->toMediaCollection('travelTourismUser');
                            } else {
                                $this->user->addMedia($this->photo->getRealPath())
                                    ->usingName($this->photo->getClientOriginalName())
                                    ->toMediaCollection('travelTourismUser');
                            }
                        }
                    }
                } else {
                    // dd($this->title_id);
                    $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                    if ($this->photo) {
                        if ($this->imgId) {
                            $item = Media::find($this->imgId);
                            $item->delete(); // delete previous image in the database

                            $this->user->addMedia($this->photo->getRealPath())
                                ->usingName($this->photo->getClientOriginalName())
                                ->toMediaCollection('travelTourismUser');
                        } else {
                            $this->user->addMedia($this->photo->getRealPath())
                                ->usingName($this->photo->getClientOriginalName())
                                ->toMediaCollection('travelTourismUser');
                        }
                    }
                }
            } else {
                $this->user->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()))->save();
                if ($this->photo) {
                    if ($this->imgId) {
                        $item = Media::find($this->imgId);
                        $item->delete(); // delete previous image in the database

                        $this->user->addMedia($this->photo->getRealPath())
                            ->usingName($this->photo->getClientOriginalName())
                            ->toMediaCollection('travelTourismUser');
                    } else {
                        $this->user->addMedia($this->photo->getRealPath())
                            ->usingName($this->photo->getClientOriginalName())
                            ->toMediaCollection('travelTourismUser');
                    }
                }
            }
        }


        $msgAction = 'Travel & Tourism user was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('admin.travel_tourism.userlist');
    }

    public function render()
    {
        return view('livewire.admin.travel-tourism-user.create-edit');
    }

    public function showpasswordfield(){
        $this->showpassfield = true;
    }
    public function hidepasswordfield(){
        $this->hidepassfield = true;
        $this->showpassfield = false;
    }
}
