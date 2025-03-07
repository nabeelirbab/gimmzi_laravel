<?php

namespace App\Http\Livewire\Frontend\PropertyManager;

use Livewire\Component;
use App\Models\ApartmentGuestBadge;
use App\Models\RecognitionType;
use App\Models\ProviderLimitSetting;
use App\Models\User;
use App\Models\Point;
use App\Models\Provider;
use App\Models\Apartmentbadge;

use App\Models\ConsumerRecognition;

use DateTime;
use DateInterval;

class ConsumerProfile extends Component
{
    public $guest_id, $apt_badge, $other_guest, $recognitions = [], $property, $provider_setting;
    public $select_list,$tenant_reward,$community_helper_reward,$pass_inspection_reward,$great_tenant_reward,$community_leader_reward,$good_samaritan_reward,$points;
    public function mount($guestid){
        $this->guest_id = $guestid;
        $this->apt_badge = ApartmentGuestBadge::with('user','badge.building','badge.buildingunit')->where('user_id',$this->guest_id)->orderBy('id','DESC')->first();
        $this->other_guest = ApartmentGuestBadge::with('user')->where('badges_id',$this->apt_badge->badges_id)->whereNotIn('user_id',[$this->guest_id])->get();
        $this->property = $this->apt_badge->badge->building->providers;
        $this->provider_setting = ProviderLimitSetting::where('property_id',$this->property->id)->first();
        // dd($this->provider_setting);
        if($this->provider_setting ){
            if($this->provider_setting->tenant_of_the_month_Reward){
                $tenant_reward = $this->provider_setting->tenant_of_the_month_Reward;
            }
            else{
                $tenant_reward = 0;
            }
            if($this->provider_setting->community_helper_reward){
                $community_helper_reward = $this->provider_setting->community_helper_reward;
            }
            else{
                $community_helper_reward = 0;
            }
            if($this->provider_setting->pass_inspection_reward){
                $pass_inspection_reward = $this->provider_setting->pass_inspection_reward;
            }
            else{
                $pass_inspection_reward = 0;
            }
            if($this->provider_setting->great_tenant_reward){
                $great_tenant_reward = $this->provider_setting->great_tenant_reward;
            }
            else{
                $great_tenant_reward = 0;
            }
            if($this->provider_setting->community_leader_reward){
                $community_leader_reward = $this->provider_setting->community_leader_reward;
            }
            else{
                $community_leader_reward = 0;
            }
            if($this->provider_setting->good_samaritan_reward){
                $good_samaritan_reward = $this->provider_setting->good_samaritan_reward;
            }
            else{
                $good_samaritan_reward = 0;
            }
        }
        $this->tenant_reward = $tenant_reward;
        $this->community_helper_reward = $community_helper_reward;
        $this->pass_inspection_reward = $pass_inspection_reward;
        $this->great_tenant_reward = $great_tenant_reward;
        $this->community_leader_reward = $community_leader_reward;
        $this->good_samaritan_reward = $good_samaritan_reward;
        // $price_value = 0;
        // dd($this->pass_inspection_reward);
        $this->recognitions = [
            ['value'=>'resident_of_the_month', 'text' => 'Resident of The Month - ['.$tenant_reward.']'],
            ['value'=>'community_helper', 'text' => 'Community Helper - ['.$community_helper_reward.']'],
            ['value'=>'pass_inspection', 'text' => '100% Pass Inspection - ['.$pass_inspection_reward.']'],
            ['value'=>'great_resident', 'text' => 'Because you are a great Resident - ['.$great_tenant_reward.']'],
            ['value'=>'community_leader', 'text' => 'Community Leader - ['.$community_leader_reward.']'],
            ['value'=>'good_samaritan', 'text' => 'Good Samaritan - ['.$good_samaritan_reward.']'],
        ];
        // dd($this->property);
        
    }
    public function send_list(){
        if($this->select_list === 'resident_of_the_month'){
            $price_value= $this->tenant_reward;
        }elseif($this->select_list === 'community_helper'){
            $price_value=$this->community_helper_reward;
        }elseif($this->select_list === 'pass_inspection'){
            $price_value= $this->pass_inspection_reward;
        }elseif($this->select_list === 'great_resident'){
            $price_value= $this->great_tenant_reward;
        }elseif($this->select_list === 'community_leader'){
            $price_value= $this->community_leader_reward;
        }elseif($this->select_list === 'good_samaritan'){
            $price_value= $this->good_samaritan_reward;
        }elseif($this->select_list === null){
            $price_value = null;
            $this->emit('recogError',['text' => "Please select reward type dd."]);
            return;
        }else{
            $price_value = null;
        }
        if($price_value === null){
            $this->emit('recogError',['text' => "Please select reward type ff."]);
            return;
        }
        
        // dd($price_value);
        if($this->select_list === null){
            $this->emit('recogError',['text' => "Please select reward type sadfc."]);
        }
        $this->points = $price_value;

        $guests = ApartmentGuestBadge::with('user')->where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->first();
        if($guests->reward_active_on !=null){
            if($guests->reward_type === $this->select_list){
                $today = date('Y-m-d');
                $date = $guests->reward_active_on;
                $interval = new DateInterval('P30D');
                $dateTime = new DateTime($date);
                $dateTime->add($interval);
                $newDate = $dateTime->format('m-d-Y');
                $dateformat = date('m-d-Y',strtotime($guests->reward_active_on));
                $end_recog_date = $dateTime->format('Y-m-d');
                if($today <= $end_recog_date){
                    $this->emit('recogError',['text'=> $guests->user->full_name.' has already received Resident of The Month for the month of '.date('F').'. The member will be eligible to receive Resident of the month again in '.$newDate]);
                    return;
                }
            }
        }

       
        $get_consumer_recog = ConsumerRecognition::where('user_id',$this->guest_id)->where('badge_id',$this->apt_badge->badges_id)
        ->where('reward_type',$this->select_list)
        ->orderBy('id','DESC')->first();
        // dd($get_consumer_recog);
        if(!$get_consumer_recog){
            $get_date = Apartmentbadge::where('id',$this->apt_badge->badges_id)->where('status',1)->first();
            if(!$get_date){
                $this->emit('recogError',['text'=> 'Badge not found!']);
                return;
            }
            $insert_recog = ConsumerRecognition::insert([
                'user_id' => $this->guest_id,
                'badge_id'=> $this->apt_badge->badges_id,
                'provider_id' => $this->property->id,
                'reward_type' => $this->select_list,
                'guest_email' => $guests->user->email,
                'start_date' => $get_date->start_date,
                'end_date'=> $get_date->end_date,
                'reward_given_date' => date('Y-m-d'),
                'points_given' => $this->points
            ]);
            if($this->select_list === "resident_of_the_month"){
                $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
                    'point'=>$guests->point + $this->points,
                    'reward_active_on' => date('Y-m-d'),
                    'reward_type' => $this->select_list
                ]);
            }else{
                $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
                    'point'=>$guests->point + $this->points
                ]);
            }
            $point = new Point();
            $point->user_id = $guests->user->id;
            $point->point = $this->points;
            $point->came_from = auth()->user()->id;
            $point->added_for = 'resident_recognition';
            $point->property_id = $this->property->id;
            $point->save();

            /**Add point to user table*/
            $user = User::find($guests->user->id);
            $totalPoint = $user->point + $this->points;
            $user->point =  $totalPoint;
            $user->save();

            /**deduct point from provider*/
            $property = Provider::find($this->property->id);
            $property->points_to_distribute = $property->points_to_distribute - $this->points;
            $property->save();
            
            if($this->select_list === 'resident_of_the_month'){
                $list_name = 'Resident of The Month';
            }elseif($this->select_list === 'community_helper'){
                $list_name = 'Community Helper';
            }elseif($this->select_list === 'pass_inspection'){
                $list_name = '100% Pass Inspection';
            }elseif($this->select_list === 'great_resident'){
                $list_name = 'Great Resident';
            }elseif($this->select_list === 'community_leader'){
                $list_name = 'Community Leader';
            }elseif($this->select_list === 'good_samaritan'){
                $list_name = 'Good Samaritan';
            }

            $this->emit('recogError',['text' => $list_name.' has been awarded to ' . $guests->user->full_name . ' along with ' . $this->points . ' points']);
            return;
        }else{
            // dd($get_consumer_recog->reward_given_date);
            $today = date('Y-m-d');
            $thismonth = date('m');
            $dateformat = date('m-d-Y',strtotime($get_consumer_recog->reward_given_date));
            $date = $get_consumer_recog->reward_given_date;
            $dateTime = new DateTime($date);

            if($this->select_list === "community_helper"){
                $interval = new DateInterval('P14D');
            }else{
                $interval = new DateInterval('P30D');
            }

            if($get_consumer_recog->reward_type === "community_helper"){
                $interval = new DateInterval('P14D');
                $dateTime->add($interval);
                $newDate = $dateTime->format('m-d-Y');
            }else{
                $interval = new DateInterval('P30D');
                $dateTime->add($interval);
                $newDate = $dateTime->format('m-d-Y');
            }
            $from_active = $dateTime->format('Y-m-d');
            // dd($newDate,$from_active,$date);
            if($today > $from_active){
                $get_date = Apartmentbadge::where('id',$this->apt_badge->badges_id)->where('status',1)->first();
                if(!$get_date){
                    $this->emit('recogError',['text'=> 'Badge not found!']);
                    return;
                }
                $insert_recog = ConsumerRecognition::insert([
                    'user_id' => $this->guest_id,
                    'badge_id'=> $this->apt_badge->badges_id,
                    'provider_id' => $this->property->id,
                    'reward_type' => $this->select_list,
                    'guest_email' => $guests->user->email,
                    'start_date' => $get_date->start_date,
                    'end_date'=> $get_date->end_date,
                    'reward_given_date' => date('Y-m-d'),
                    'points_given' => $this->points
                ]);
                if($this->select_list === "resident_of_the_month"){
                    $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
                        'point'=>$guests->point + $this->points,
                        'reward_active_on' => date('Y-m-d'),
                        'reward_type' => $this->select_list
                    ]);
                }else{
                    $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
                        'point'=>$guests->point + $this->points
                    ]);
                }
                $point = new Point();
                $point->user_id = $guests->user->id;
                $point->point = $this->points;
                $point->came_from = auth()->user()->id;
                $point->added_for = 'resident_recognition';
                $point->property_id = $this->property->id;
                $point->save();
    
                /**Add point to user table*/
                $user = User::find($guests->user->id);
                $totalPoint = $user->point + $this->points;
                $user->point =  $totalPoint;
                $user->save();
    
                /**deduct point from provider*/
                $property = Provider::find($this->property->id);
                $property->points_to_distribute = $property->points_to_distribute - $this->points;
                $property->save();
                
                if($this->select_list === 'resident_of_the_month'){
                    $list_name = 'Resident of The Month';
                }elseif($this->select_list === 'community_helper'){
                    $list_name = 'Community Helper';
                }elseif($this->select_list === 'pass_inspection'){
                    $list_name = '100% Pass Inspection';
                }elseif($this->select_list === 'great_resident'){
                    $list_name = 'Great Resident';
                }elseif($this->select_list === 'community_leader'){
                    $list_name = 'Community Leader';
                }elseif($this->select_list === 'good_samaritan'){
                    $list_name = 'Good Samaritan';
                }
    
                $this->emit('recogError',['text' => $list_name.' has been awarded to ' . $guests->user->full_name . ' along with ' . $this->points . ' points']);
                return; 
            }else{
                if($this->select_list === 'resident_of_the_month'){
                    $this->emit('recogError',['text'=> $guests->user->full_name.' has already received Resident of The Month for the month of '.date('F').'. The member will be eligible to receive Resident of the month again in '.$newDate]);
                    return;
                }elseif($this->select_list === 'community_helper'){
                    $this->emit('recogError',['text'=> 'Member has received Community Helper on '.$dateformat.'. The member will be eligible for another  Community Helper reward on '.$newDate.'.']);
                }elseif($this->select_list === 'pass_inspection'){
                    $this->emit('recogError',['text'=> 'Member has received 100% Pass Inspection reward on '.$dateformat.'. The member will be eligible for another 100% Pass Inspection reward on '.$newDate.'.']);
                }elseif($this->select_list === 'great_resident'){
                    $this->emit('recogError',['text'=> 'Member has received Because you are a great Resident reward on '.$dateformat.'. The member will be eligible for another Because you are a great Resident reward on '.$newDate.'.']);
                    
                }elseif($this->select_list === 'community_leader'){
                    $this->emit('recogError',['text'=> 'Member has received Community Leader reward on '.$dateformat.'. The member will be eligible for another Community Leader reward on '.$newDate.'.']);
                }elseif($this->select_list === 'good_samaritan'){
                    $this->emit('recogError',['text'=> 'Member has received Good Samaritan reward on '.$dateformat.'. The member will be eligible for another Good Samaritan reward on '.$newDate.'.']);
                }
            }

        }
        







        // if($guests->reward_active_on == null){
           

        //     if($this->points != 0){
        //         $dt = date('Y-m-d');
        //         $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
        //             'point'=>$guests->point + $this->points,
        //             'reward_active_on' => $dt,
        //             'reward_type' => $this->select_list
        //         ]);
    
        //          /**Add point in point table */
        //         $this->guest = ApartmentGuestBadge::find($guests->id);
        //         // dd($this->guest);
        //         $point = new Point();
        //         $point->user_id = $this->guest->user_id;
        //         $point->point = $this->points;
        //         $point->came_from = auth()->user()->id;
        //         $point->added_for = 'resident_recognition';
        //         $point->property_id = $this->property->id;
        //         $point->save();
    
        //         /**Add point to user table*/
        //         $user = User::find($this->guest->user_id);
        //         $totalPoint = $user->point + $this->points;
        //         $user->point =  $totalPoint;
        //         $user->save();
    
        //          /**deduct point from provider*/
        //          $property = Provider::find($this->property->id);
        //          $property->points_to_distribute = $property->points_to_distribute - $this->points;
        //          $property->save();
        //          $this->emit('recogError',['text' => 'Resident of The Month has been awarded to ' . $this->guest->user->full_name . ' along with ' . $this->points . ' points']);
        //     }else{
        //         $this->emit('recogError',['text' => "Please add reward point to give reward in settings"]);
        //     }
        // }else{
        //     // dd($this->select_list);
        //     $today = date('Y-m-d');
        //     $thismonth = date('m');
        //     $dateformat = date('m-d-Y',strtotime($guests->reward_active_on));
        //     $date = $guests->reward_active_on;
        //     $dateTime = new DateTime($date);

        //     if($this->select_list === "community_helper"){
        //         $interval = new DateInterval('P14D');
        //     }else{
        //         $interval = new DateInterval('P30D');
        //     }

        //     if($guests->reward_type === "community_helper"){
        //         $interval = new DateInterval('P14D');
        //         $dateTime->add($interval);
        //         $newDate = $dateTime->format('m-d-Y');
        //     }else{
        //         $interval = new DateInterval('P30D');
        //         $dateTime->add($interval);
        //         $newDate = $dateTime->format('m-d-Y');
        //     }
            
            
        //     // dd($newDate);
        //     $from_active = $dateTime->format('Y-m-d');
        //     $today = date('Y-m-d');
        //     // dd($from_active);
        //     if($today > $from_active){
        //         if($this->points != 0){
        //             $dt = date('Y-m-d');
        //             $updte = ApartmentGuestBadge::where('badges_id',$this->apt_badge->badges_id)->where('user_id',$this->guest_id)->update([
        //                 'point'=>$guests->point + $this->points,
        //                 'reward_active_on' => $dt,
        //                 'reward_type' => $this->select_list
        //             ]);
        
        //              /**Add point in point table */
        //             $this->guest = ApartmentGuestBadge::find($guests->id);
        //             // dd($this->guest);
        //             $point = new Point();
        //             $point->user_id = $this->guest->user_id;
        //             $point->point = $this->points;
        //             $point->came_from = auth()->user()->id;
        //             $point->added_for = 'resident_recognition';
        //             $point->property_id = $this->property->id;
        //             $point->save();
        
        //             /**Add point to user table*/
        //             $user = User::find($this->guest->user_id);
        //             $totalPoint = $user->point + $this->points;
        //             $user->point =  $totalPoint;
        //             $user->save();
        
        //              /**deduct point from travel tourism*/
        //              $property = Provider::find($this->property->id);
        //              $property->points_to_distribute = $property->points_to_distribute - $this->points;
        //              $property->save();
        //              $this->emit('recogError',['text' => 'Resident of The Month has been awarded to ' . $this->guest->user->full_name . ' along with ' . $this->points . ' points']);
        //         }else{
        //             $this->emit('recogError',['text' => "Please add reward point to give reward in settings"]);
        //         }
        //     }else{
        //         // dd('sdcsdc');
        //         if($guests->reward_type === 'resident_of_the_month'){
        //             $list_name = 'Resident of The Month';
        //         }elseif($guests->reward_type === 'community_helper'){
        //             $list_name = 'Community Helper';
        //         }elseif($guests->reward_type === 'pass_inspectionh'){
        //             $list_name = '100% Pass Inspection';
        //         }elseif($guests->reward_type === 'great_resident'){
        //             $list_name = 'Great Resident';
        //         }elseif($guests->reward_type === 'community_leader'){
        //             $list_name = 'Community Leader';
        //         }elseif($guests->reward_type === 'good_samaritan'){
        //             $list_name = 'Good Samaritan';
        //         }

        //         if($this->select_list === $guests->reward_type){
        //             $this->emit('recogError',['text'=> 'Member has received '.$list_name.' on '.$dateformat.'. The member will be eligible for another '.$list_name.' reward on '.$newDate]);
        //         }else{
        //             $this->emit('recogError',['text'=> 'Member has received '.$list_name.' reward on '.$dateformat.'. The member will be eligible for another reward on '.$newDate]);
        //         }
                
        //     }
        // }
        
        

        // dd($price_value,$this->guest_id);
    }

    public function addPoint(){
        if ($this->apt_badge) {
                if($this->apt_badge->status == 1){
                    $provider_setting = ProviderLimitSetting::where('property_id', $this->property->id)->first();
                    if($provider_setting){
                        if($provider_setting->add_point != null){
                            $setting_point = $provider_setting->add_point;
                            // dd($this->point);
                            if($this->property->points_to_distribute > $setting_point ){
                                $user = User::find($this->guest_id);
                                //Add point in point table
                                $point = new Point;
                                $point->user_id = $this->guest_id;
                                $point->point = $setting_point;
                                $point->came_from = auth()->user()->id;
                                $point->added_for = 'add_point';
                                $point->property_id = $this->property->id;
                                $point->save();
                                //Add point to user table
                                $userpoint = $user->point;
                                $totalPoint = $userpoint + $setting_point;
                                $user->point =  $totalPoint;
                                $user->save();
                                //Add point to badge table
                                $this->apt_badge->point = $totalPoint;
                                $this->apt_badge->save();

                                //desuct point from travel tourism
                                $property = Provider::find($this->property->id);
                                $property->points_to_distribute = $this->property->points_to_distribute - $setting_point;
                                $property->save();
                                $this->emit('termError',['text' => 'Points have been added to this member’s account']);
                            }
                            else{
                                $this->emit('termError',['text' => $this->property->name . "'s point should be greater than added points"]);
                            }
                        }
                        else{
                            $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                        }
                    }
                    else{
                        $this->emit('termError', ['text' => 'There is not updated the add point in settings']);
                    }
                }
                else{
                    $this->emit('termError', ['text' => 'This user has not accepted the badge request']);
                }
            
            
        }
    }

    public function guestRecognition(){
        $this->emit('recognitionModal');
    } 

    public function render()
    {
        return view('livewire.frontend.property-manager.consumer-profile');
    }
}
