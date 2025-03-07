<?php

namespace App\Http\Livewire\Frontend\TravelTourism\HotelResort;

use Livewire\Component;
use App\Models\PropertyUnderProviderUser;
use App\Models\BuildingUnit;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderBuilding;
use App\Models\ProviderLimitSetting;

use App\Models\HotelUnites;
use App\Models\HotelBadges;
use App\Models\HotelBuildings;
use App\Models\HotelGuestBadges;
use App\Models\TravelTourismSettings;
use App\Models\TravelTourism;

use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\HotelBadgeSentEmail;
use App\Mail\BadgeRequestCancelByProvider;
use App\Models\Provider;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LowPointMember extends Component
{
    public $provider_settings,$propertyDetails,$user,$address, $point, $property_id,$unit_name,$unit_id, $buldingList;
    public $alldatas=[], $property_name,$property, $point_status,$mergedData;
    public  $message1,$message2,$message3,$count_member,$amount,$consumerid;
    protected $listeners = ['checkEmail','datepickerEnable','adjustdatepickerEnable'];

    public function mount(){
        $this->user = Auth::user();
        $this->hotel_id = Auth::user()->travel_tourism_id;
        // dd($this->user);
        // $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$this->user->id)->get();
        // $this->property_id = $this->propertyDetails->first()->provider_id;
        // $this->address = $this->propertyDetails->first()->provider->address ;
        // $this->property_name = $this->propertyDetails->first()->provider->name ;
        // $this->point = number_format($this->propertyDetails->first()->provider->points_to_distribute);
        $this->property = TravelTourism::find($this->hotel_id);
        $this->unit_name = '';
        $this->hotel_id = Auth::user()->travel_tourism_id;
        // dd($this->propertyDetails->pluck('provider_id'));
        // $this->buldingList = ProviderBuilding::where('provider_type_id',$this->property_id)->get();
        $this->message1 = '';
        $this->message2 = '';
        $this->message3 = '';
        // dd($this->buldingList);
        $this->mergedData = [];
        $this->consumerid = '';
    }

    public function changePointStatus(){
        $this->point_status = $this->point_status;
    }

    public function addPoint($amount){
        $this->amount = $amount;
        $this->message1 = 'Are you sure you would like to <span style="font-weight: 800;"> Add '.$this->amount.' points </span> to each of these members?';
        $this->message2 = 'Total Members: '.$this->count_member .' members'; 
        $point = number_format($this->count_member * $this->amount);
        $this->message3 = 'Total points to be added: '.$point.' points';
        $this->emit('pointAddPopup');
    }

    public function yesAddPointToMember(){
        // dd($this->count_member);
        if($this->count_member > 0){
            $provider = TravelTourism::find($this->hotel_id);
            if($provider->points_to_distribute > ($this->count_member * $this->amount)){
                //dd($this->mergedData);
                foreach($this->mergedData as $data){
                    $badge_guest = HotelGuestBadges::where('user_id',$data['consumer_id'])->get();
                    foreach($badge_guest as $guest){
                        $apartment_guest = HotelGuestBadges::find($guest->id);
                        $apartment_guest->point = $apartment_guest->point + $this->amount;
                        $apartment_guest->save();
                    }
                    $point = new Point;
                    $point->user_id = $data['consumer_id'];
                    $point->point = $this->amount;
                    $point->sign = '+';
                    $point->save();
                    $user = User::find($data['consumer_id']);
                    $totalpoint = $user->point+$this->amount;
                    $user->point = $totalpoint;
                    $user->save();
                    $provider = TravelTourism::find($this->hotel_id);
                    $provider->points_to_distribute = $provider->points_to_distribute - $this->amount;
                    $provider->save();
                }
                $this->emit('sucesspopup',['msg' => 'Points successfully added to members profiles']);
            }
            else{
                $this->emit('sucesspopup',['msg' => 'No suficient point to distribute point']);
            }
            
        }
    }

    public function selectUser($userid){
        $this->consumerid = $userid;
    }

    public function addPointToConsumer(){
        //dd($this->property);
        if($this->consumerid  != ''){
            $provider_setting = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                if($provider_setting){
                    if($provider_setting->add_point != null){
                        $setting_point = $provider_setting->add_point;
                        // dd($this->point);
                        if($this->property->points_to_distribute > $setting_point ){
                            $user = User::find($this->consumerid);
                            $totalpoint = $user->point+$setting_point;
                            $user->point = $totalpoint;
                            $user->save();
                            $point = new Point;
                            $point->user_id = $this->consumerid;
                            $point->point = $setting_point;
                            $point->sign = '+';
                            $point->save();
                            $badge_guest = HotelGuestBadges::where('user_id',$this->consumerid)->get();
                            foreach($badge_guest as $guest){
                                $apartment_guest = HotelGuestBadges::find($guest->id);
                                $apartment_guest->point = $apartment_guest->point + $setting_point;
                                $apartment_guest->save();
                            }
                            $this->emit('sucesspopup',['msg' => 'Point have been added to this member’s account']); 
                        }
                        else{
                            $this->emit('sucesspopup',['msg' => 'No suficient point to distribute point']); 
                        }
                    }
                    else{
                        $this->emit('sucesspopup',['msg' => 'There is not updated the add point']); 
                    }
                }
                else{
                    $this->emit('sucesspopup',['msg' => 'Property settings not updated']); 
                }
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function addTermToConsumer(){
        if($this->consumerid  != ''){
            $provider_setting = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                if($provider_setting){
                    if($provider_setting->term_limit != null){
                        $term_limit = $provider_setting->term_limit;
                        // dd($this->point);
                            $user = User::find($this->consumerid);
                            if($user){
                                if($user->expiry_date != null){
                                    $termdate =  date('Y-m-d', strtotime($user->expiry_date . " +".$term_limit));
                                    //dd($termdate);
                                    $user->expiry_date = $termdate;
                                    $user->save();
                                    $message = 'success';
                                }
                                elseif($user->join_date != null){
                                    $termdate =  date('Y-m-d', strtotime($user->join_date . " +".$term_limit));
                                    $user->expiry_date = $termdate;
                                    $user->save();
                                    $message = 'success';
                                }
                                else{
                                    $termdate =  date('Y-m-d', strtotime($user->created_at . " +".$term_limit) ); 
                                    $user->expiry_date = $termdate;
                                    $user->save();
                                    $message = 'success';
                                }
                        
                                $this->emit('sucesspopup',['msg' => 'Term have been added to this member’s account']); 
                            }
                    }
                    else{
                        $this->emit('sucesspopup',['msg' => 'There is not updated the term limit']); 
                    }
                }
                else{
                    $this->emit('sucesspopup',['msg' => 'Property settings not updated']); 
                }
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function viewconsumerProfile(){
        if($this->consumerid  != ''){
            redirect()->route('frontend.hotel.users.view.profile',$this->consumerid);
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function getpropertyDetail($propertyid){
        $this->propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$this->user->id)->get();
        $this->property = Provider::find($propertyid);
        $this->property_id = $propertyid;
        $this->address = $this->property->address ;
        $this->property_name = $this->property->name ;
        $this->point = number_format($this->property->points_to_distribute);
        $this->unit_name = '';
        $this->buldingList = ProviderBuilding::where('provider_type_id',$this->property_id)->get();
        
    }

    public function render()
    {
        $this->mergedData = [];
        // $this->provider_settings = ProviderLimitSetting::where('property_id',$this->property_id)->first();
        $this->provider_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
        
        $units = HotelUnites::where('hotel_id',$this->hotel_id)->pluck('id');
        //dd($units);
        $today = date('Y-m-d');
        $allbadge = HotelBadges::with('badgesguest','badgesguest.user')->whereIn('unit_id',$units)->where('end_date','>=',$today)->get();
        //dd($allbadge);
        if(count($allbadge) > 0){
            foreach($allbadge as $badges){
                if(count($badges->badgesguest) > 0){
                    foreach($badges->badgesguest as $guests){
                        if($guests->user_id != null){
                            if($guests->user->point <= $this->provider_settings->low_point_balance){
                                //dd($guests->badges_id);
                                 $get_badges = HotelBadges::select('id','end_date')->where('id',$guests->badges_id)->first();
                                //  dd($get_badges);
                                 if(isset($get_badges->id)){
                                    $end_date = $get_badges->end_date;
                                 }else{
                                    $end_date = '';
                                 }
                                 
                                
                                $this->mergedData[] = [
                                                'consumer_id'=>$guests->user_id,
                                                'unitid'=>$guests->guestbadges->id,
                                                'building_name'=>$guests->guestbadges->unites->unitbuildings->building_name,
                                                'unit'=>$guests->guestbadges->unites->unit_name,
                                                'primary_member'=>$guests->user->full_name,
                                                'signed_up'=>$guests->user->created_at->format('m-d-Y'),
                                                // 'account_term_date'=>$guests->user->expiry_date ? date('m-d-Y', strtotime($guests->user->expiry_date)) : '',
                                                'account_term_date'=>$end_date,
                                                'point'=>$guests->user->point
                                                    
                                            ];
                            }
                        }
                        
                    }
                }
                else{
                    // $this->mergedData = [];
                }
                
            }
            
        }
        //dd($this->mergedData);
        $this->count_member = count($this->mergedData);
        if($this->point_status == 'low_to_high'){
            array_multisort(array_column($this->mergedData, 'point'), SORT_ASC,$this->mergedData);
            
        }
        elseif($this->point_status == 'high_to_low'){
            array_multisort(array_column($this->mergedData, 'point'), SORT_DESC,$this->mergedData);
        }
        else{
            $this->mergedData = $this->mergedData;
        }
        
        
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($this->mergedData, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($this->mergedData), $perPage, $currentPage);
         //dd($this->mergedData);
        return view('livewire.frontend.travel-tourism.hotel-resort.low-point-member',[
            'users' => $data,
        ]);

        // return view('livewire.frontend.travel-tourism.hotel-resort.low-point-member');
    }
}
