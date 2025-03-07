<?php

namespace App\Http\Livewire\Admin\Consumer;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\Badge;
use App\Models\BadgeBoost;
use App\Models\ConsumerBadge;
use App\Models\Title;
use App\Models\User;
use App\Models\Point;
use Livewire\Component;

use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use App\Models\ShortTermGuestBadge;
use App\Models\TravelTourismSettings;
use Carbon\Carbon;

class ConsumerCreateEdit extends Component
{
    use WithFileUploads;
    use AlertMessage;
    public $first_name, $last_name, $email, $password, $phone, $active, $profile_photo_path, $password_confirmation, $join_date, $consumer,$badge_id,$consumer_badge,$showpassfield, $created,$hidepassfield, $dob;
    
    public $isEdit = false;
    public $date_of_birth,$parent_id, $point;
    public $statusList = [];
    public $blankArr = [],$badgeList=[];
    public $photo;
    public $model_image, $imgId;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function mount($consumer = null)
    {
        $this->showpassfield = false;
        if ($consumer) {
            // dd($consumer->userId);
            $this->consumer = $consumer;
            $this->created = Carbon::parse($this->consumer->created_at)->format('m/d/Y');
            $this->fill($this->consumer);
            if ($this->consumer->date_of_birth) {
                $this->date_of_birth = Carbon::createFromFormat('Y-m-d', $this->consumer->date_of_birth)->format('m/d/Y');
            }
            $this->isEdit = true;
        } else
            $this->consumer = new User;
            

        $this->statusList = [
            ['value' => 0, 'text' => "Choose Status"],
            ['value' => 1, 'text' => "Active"],
            ['value' => 0, 'text' => "Inactive"]
        ];

        $this->model_image = Media::where(['model_id' => $this->consumer->id, 'collection_name' => 'consumerImages'])->first();
        if ($this->model_image != null) {
            $this->imgId = $this->model_image->id;
        }

        $this->blankArr = [
            "value"=> "", "text"=> "== Select One =="
        ];

        $this->badgeList=Badge::where('status',1)->get();
    }

    // public function updatedDateOfBirth($value)
    // {
    //     // Store the date in the desired format
    //     if ($value) {
    //         $this->date_of_birth = Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y');
    //     }
    // }




    public function validationRuleForSave(): array
    {
        return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable',Rule::unique('users'), 'max:12', 'min:10'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6', 'same:password'],
                'active' => ['required'],
                'photo' => ['required'],
                'date_of_birth' => ['nullable'],
                'join_date' => ['required'],
              
               
               
            ];
    }
    public function validationRuleForUpdate(): array
    {
        if($this->showpassfield == false){
            return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'active' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->consumer->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable',Rule::unique('users')->ignore($this->consumer->id), 'max:12', 'min:10'],
                'photo' => ['nullable'],
                'date_of_birth' => ['nullable'],
                // 'join_date' => ['required'],
            
                
            ];
        }else{
            return
            [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'active' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->consumer->id),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                'phone' => ['nullable',Rule::unique('users')->ignore($this->consumer->id), 'max:12', 'min:10'],
                'photo' => ['nullable'],
                'date_of_birth' => ['nullable'],
                // 'join_date' => ['required'],
                'password' => ['required', 'max:255', 'min:6'],
                'password_confirmation' => ['required', 'max:255', 'min:6', 'same:password']
            
                
            ];
        }

       
    }
    protected $messages = [
        'first_name.required' => 'The First Name field is required',
        'last_name.required' => 'The Last Name field is required',
        'email.required' => 'The Email field is required',
        'phone.required' => 'The Phone field is required',
        'password.required' => 'The Password field is required',
        'password_confirmation.required' => 'The Confirm Password field is required',
        'active.required' => 'The Status field is required',
        'photo.required' => 'The Profile Image field is required',
        'email.email' => 'The Email must be a valid email address',
        'email.unique' => 'The Email has already been taken',
        'email.regex' => 'The Email format is invalid',
        'phone.max' => 'The Phone may not be greater than 12 characters',
        'phone.min' => 'The Phone must be at least 10 characters',
        'phone.unique' => 'The Phone has already been taken',
        'password.min' => 'The Password must be at least 6 characters',
        'password_confirmation.min' => 'The Password Confirmation must be at least 6 characters',
        'password_confirmation.same' => 'The Confirm Password does not match with Password',
        // 'date_of_birth.required' => 'The Date of Birth field is required',
        'join_date.required' => 'The Joining Date field is required',
       
       

    ];
    public function saveOrUpdate()
    {
        
        $this->consumer->fill($this->validate($this->isEdit ? $this->validationRuleForUpdate() : $this->validationRuleForSave()));   
        if(!$this->isEdit){
            $rand = rand(1000,9999);
            $consumerid = $rand.substr($this->consumer->first_name, 0, 3);
            // $consumerid = strtoupper(substr($this->consumer->first_name,0,3)).'/CON/0'.$this->consumer->id;
            $this->consumer->userId = $consumerid;
            if ($this->consumer->date_of_birth) {
                $this->consumer->date_of_birth = Carbon::createFromFormat('m/d/Y', $this->consumer->date_of_birth)->format('Y-m-d');
            }
            $this->consumer->save();                       
        }
        else{
            if($this->consumer->userId == ''){
                // $consumerid = strtoupper(substr($this->consumer->first_name,0,3)).'/CON/0'.$this->consumer->id;
                $rand = rand(1000,9999);
                $consumerid = $rand.substr($this->consumer->first_name, 0, 3);
            }
            else{
                if(strlen($this->consumer->userId) > 7){
                    $rand = rand(1000,9999);
                    $consumerid = $rand.substr($this->consumer->first_name, 0, 3);
                }else{
                    $consumerid = $this->consumer->userId;
                }
                
            }
            if ($this->consumer->date_of_birth) {
                $this->consumer->date_of_birth = Carbon::createFromFormat('m/d/Y', $this->consumer->date_of_birth)->format('Y-m-d');
            }
            $this->consumer->userId = $consumerid;
            $this->consumer->save();                     
        }
          
        if ($this->photo) {
            if ($this->imgId) {
                $item = Media::find($this->imgId);
                $item->delete(); // delete previous image in the database

                $this->consumer->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('consumerImages');
            } else {
                $this->consumer->addMedia($this->photo->getRealPath())
                    ->usingName($this->photo->getClientOriginalName())
                    ->toMediaCollection('consumerImages');
            }
        }
        if (!$this->isEdit){
            //if ($this->consumer->badge_id != ''){
                $badgeData = Badge::where('status',1)->where('badge_type','Gimmzi')->first();
                $point = $badgeData->badge_point;
                //$boostid = $badgeData->id;
                Point::create([
                    'user_id'=>$this->consumer->id,
                    'point'=> $point,
                    'badge_id'=>$badgeData->id,
                    'sign'=>'+'
                ]);
                $this->consumer->point = $point;
                $this->consumer->save();
                
                $this->consumer_badge=ConsumerBadge::create([
                    'user_id'=>$this->consumer->id,
                    'badges_id'=>$badgeData->id,
                    'point'=>$point,
                    'badge_activate_date'=>date('Y-m-d')
                ]);
            //}
            $today = date('Y-m-d');
            $travel_badges = ShortTermGuestBadge::where('guest_email',$this->consumer->email)->where('checkin_date','>=',$today)->where('badge_status',0)->get();
            if(count($travel_badges) > 0){
                foreach($travel_badges as $travel){
                    $short_term = ShortTermGuestBadge::find($travel->id);
                    $short_term->guest_id = $this->consumer->id;
                    $short_term->badge_status = 1;
                    $short_term->save();
                    if($short_term->checkin_date >= $today){
                        $setting = TravelTourismSettings::where('travel_tourism_id',$travel->short_term_id)->first();
                        if($setting){
                            if($setting->badge_bonus_point != null){
                                $date1=date_create($short_term->checkin_date);
                                $date2=date_create($short_term->checkout_date);
                                $diff=date_diff($date1,$date2);
                                $days = $diff->format("%a");
                                $badge_point = ((int)$days * $setting->badge_bonus_point);
                                $total_point = $this->consumer->point + $badge_point;
                                $this->consumer->point = $total_point;
                                $this->consumer->save();
                                $short_term->points = $badge_point;
                                $short_term->save();
                                $badgeData = Badge::where('status', 1)->where('title', 'Travel & tourism Badge')->first();
                                Point::create([
                                    'user_id' => $this->consumer->id,
                                    'point' => $badge_point,
                                    'badge_id' => $badgeData->id,
                                    'sign' => '+'
                                ]);
                                ConsumerBadge::create([
                                    'user_id' => $this->consumer->id,
                                    'badges_id' => $badgeData->id,
                                    'point' => $badge_point,
                                    'badge_activate_date' => date('Y-m-d')
                                ]);
                            }
                        }
                    }
                }
            }
        }
        

         // $this->consumer->fill($validatedData)->save();

        if (!$this->isEdit)
            $this->consumer->assignRole('CONSUMER');
        $msgAction = 'Consumer was ' . ($this->isEdit ? 'updated' : 'added') . ' successfully';
        $this->showToastr("success", $msgAction);

        return redirect()->route('consumers.index');
    }
    public function render()
    {
        return view('livewire.admin.consumer.consumer-create-edit');
    }
    public function showpasswordfield(){
        $this->showpassfield = true;
    }
    public function hidepasswordfield(){
        $this->hidepassfield = true;
        $this->showpassfield = false;
    }
}
