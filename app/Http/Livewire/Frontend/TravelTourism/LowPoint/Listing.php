<?php

namespace App\Http\Livewire\Frontend\TravelTourism\LowPoint;

use App\Models\Point;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ShortTermGuestBadge;
use App\Models\TravelTourism;
use App\Models\TravelTourismSettings;
use DB;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class Listing extends Component
{
    use WithPagination;
    public $user, $shortTerm, $points, $members, $total_points, $success_message, $query1,$consumerid,$point_status,$mergedData;

    public function mount()
    {
        $this->user = Auth::user();
        $this->shortTerm = $this->user->travelType;
        $this->mergedData = [];
        // $this->property = TravelTourism::find($this->shortTerm->id);
        // dd($this->property,$this->shortTerm);
        //dd($this->shortTerm->name,$this->shortTerm);
        $get_low_point = TravelTourismSettings::where('id',$this->shortTerm->id)->select('low_point_balance')->first();
        $this->query1 = ShortTermGuestBadge::with('shortterm', 'listing', 'guest')
            ->join('users', 'users.id', '=', 'short_term_guest_badges.guest_id')
            ->select(DB::raw('short_term_guest_badges.*',DB::raw('users.id','users.point')))
            ->where('short_term_guest_badges.short_term_id', $this->shortTerm->id)
            ->whereIn('short_term_guest_badges.badge_status', [0, 1])
            ->where('users.point', '<=', $get_low_point->low_point_balance)
            ->orderBy('short_term_guest_badges.id', 'asc')
            ->get();
            // dd($this->query1);

           
    }

    public function selectUser($userid){
        //dd($userid);
        $this->consumerid = $userid;
    }
    public function changePointStatus(){
        //dd($this->point_status);
        $this->point_status = $this->point_status;
    }
    final public function paginationView(): string
    {
        return 'livewire.frontend.travel-tourism.short-term-rental.livewire-piganation';
    }

    final public function updatedPage(): void
    {
        $this->emit('paginationChanged');
    }

    public function addPoint($points)
    {
        $this->points = $points;
        $this->members = $this->query1->count();
        $this->total_points = $this->points * $this->members;
        $this->emit('add_point');
    }

    public function viewconsumerProfile(){
        if($this->consumerid  != ''){
            //dd($this->consumerid);
            redirect()->route('frontend.short.users.view.profile',$this->consumerid);
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }
    public function addPointPost()
    {
        $sortTermIds = $this->query1->pluck('id');
        foreach ($sortTermIds as $key => $id) {
            $shortBadgeStatus = ShortTermGuestBadge::find($id);
            $travel_tourism = TravelTourism::find($shortBadgeStatus->short_term_id);
            $user = User::find($shortBadgeStatus->guest_id);
            /**Add point in point table */
            $point = new Point();
            $point->user_id = $shortBadgeStatus->guest_id;
            $point->point = $this->points;
            $point->came_from = Auth::id();
            $point->save();
            /**Add point to user table*/
            $totalPoint = $user->point + $this->points;
            $user->point =  $totalPoint;
            $user->save();
            /**Add point to badge table*/
            $shortBadgeStatus->points = $totalPoint;
            $shortBadgeStatus->save();

            /**deduct point from travel tourism*/
            $travel_tourism->points_to_distribute = $travel_tourism->points_to_distribute - $this->points;
            $travel_tourism->save();
        }

        $this->success_message = "Points successfully added to members profiles";
        $this->emit('add_point_modal');
    }

    public function addPointToConsumer(){
        //dd($this->property);
        // dd($this->consumerid);
        if($this->consumerid  != ''){
            $provider_setting = TravelTourismSettings::where('travel_tourism_id', $this->shortTerm->id)->first();
                if($provider_setting){
                    if($provider_setting->add_point != null){
                        $setting_point = $provider_setting->add_point;
                        // dd($this->point);
                        if($this->shortTerm->points_to_distribute > $setting_point ){
                            $user = User::find($this->consumerid);
                            $totalpoint = $user->point+$setting_point;
                            $user->point = $totalpoint;
                            $user->save();
                            $point = new Point;
                            $point->user_id = $this->consumerid;
                            $point->point = $setting_point;
                            $point->sign = '+';
                            $point->save();
                            $badge_guest = ShortTermGuestBadge::where('guest_id',$this->consumerid)->get();
                            foreach($badge_guest as $guest){
                                $apartment_guest = ShortTermGuestBadge::find($guest->id);
                                $apartment_guest->points = $apartment_guest->points + $setting_point;
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
                    $this->emit('sucesspopup',['msg' => 'settings not updated']); 
                }
        }
        else{
            $this->emit('sucesspopup',['msg' => 'Please select a consumer first']); 
        }
    }

    public function render()
    {
        $mergedData = [];
        $mergedData = array_merge($mergedData, $this->query1->toArray());

        $this->count_member = count($mergedData);
        // dd($mergedData);
        if($this->point_status == 'low_to_high'){
            //array_multisort(array_column($mergedData, 'point'), SORT_ASC,$mergedData);
            usort($mergedData, function($a, $b) {
                return $a['guest']['point'] <=> $b['guest']['point'];
            });
            
        }
        elseif($this->point_status == 'high_to_low'){
            // array_multisort(array_column($mergedData->guest, 'point'), SORT_DESC,$mergedData->guest);
            usort($mergedData, function($a, $b) {
                return $b['guest']['point'] <=> $a['guest']['point'];
            });
        }
        else{
            $mergedData = $mergedData;
        }
        // dd($mergedData);
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = array_slice($mergedData, ($currentPage - 1) * $perPage, $perPage);
        $data = new LengthAwarePaginator($currentPageItems, count($mergedData), $perPage, $currentPage);
        $this->user = Auth::user();
        return view('livewire.frontend.travel-tourism.low-point.listing', [
            'data' => $data,
        ]);
    }
}
