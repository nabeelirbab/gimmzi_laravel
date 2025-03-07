<?php

namespace App\Http\Livewire\Frontend\PropertyManager;

use Livewire\Component;
use App\Models\Provider;
use App\Models\ProviderExternalManage;
use App\Models\ProviderMessageBoard;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderAmenity;
use App\Models\ProviderFeature;


class ApartmantWebsites extends Component
{
    public $provider,$provider_phone_number,$get_message,$get_tanent_reward,$badge, $contact_community, $lease_online, $direct_website, $resident_portal;
    public $badge_dates = [];
    public $amenities = [];
    public $features = [];
    public $showMap = false;


    public function mount($providerid,$unitid){
        $providerid = base64_decode($providerid);
        $unitid = base64_decode($unitid);
        $this->provider = Provider::find($providerid);
        $external_manage = ProviderExternalManage::where('property_id',$providerid)->first();
        if(isset($external_manage->id)){
            $this->provider_phone_number = $external_manage->phone;

            $this->contact_community = $external_manage->contact_community_url;
            $this->lease_online = $external_manage->lease_online_url;
            $this->resident_portal = $external_manage->resident_portal_url;
            $this->direct_website = $external_manage->visit_website_url;

        }else{
            $this->provider_phone_number = '';
            $this->contact_community = '';
            $this->lease_online = '';
            $this->resident_portal = '';
            $this->direct_website = '';
        }

        $this->amenities = ProviderAmenity::where('property_id', $providerid)->get();
        $this->features = ProviderFeature::where('property_id', $providerid)->get();

        // dd($this->provider->units->badges);
        // dd($this->provider->photo_img);
        // dd($providerid,$unitid,'ddddddd');
        
        if($unitid){
            
            
            $this->get_message = ProviderMessageBoard::where('provider_id',$providerid)->where('status',1)->first();

            $this->badge = Apartmentbadge::where('unit_id',$unitid)->first();
            $currentMonth = date('m');
            $currentYear = date('Y');
            $this->get_tanent_reward = ApartmentGuestBadge::where('badges_id',$this->badge->id)->whereMonth('reward_active_on', $currentMonth)->whereYear('reward_active_on', $currentYear)->first();
            $today = date('Y-m-d');
            $badges = Apartmentbadge::where('unit_id', $unitid)
                                            ->where('end_date', '>', $today)
                                            ->where('start_date','<=',$today)
                                            ->get();
            session()->put('apartmentbadge', $badges);
            foreach ($badges as $badgedata) {
                $guests = ApartmentGuestBadge::where('badges_id', $badgedata->id)->where('status',1)
                                ->count();
                                // $guests  = 9;
                if($guests == 10){
                    
                }elseif($guests < 10){
                    $this->badge_dates[] = array('start_date' => date_format(date_create($badgedata->start_date), 'm/d/Y'), 'end_date' => date_format(date_create($badgedata->end_date), 'm/d/Y'), 'id' => $badgedata->id);
                }else{
                    // $this->badge_dates[] = array('start_date' => $badgedata->start_date, 'end_date' => $badgedata->end_date, 'id' => $badgedata->id);
                }

            }
        }else{
            if(session()->has('uid')){
                $untid = session()->get('uid');
                $uid = base64_decode($untid);
                // dd($uid);
                $currentMonth = date('m');
                $currentYear = date('Y');
                $this->badge = Apartmentbadge::where('unit_id',$uid)->first();
                $this->get_tanent_reward = ApartmentGuestBadge::where('badges_id',$this->badge->id)->whereMonth('reward_active_on', $currentMonth)->whereYear('reward_active_on', $currentYear)->first(); 
            }
            // $this->provider = Provider::find($providerid);
            // $get_phon_number = ProviderExternalManage::where('property_id',$providerid)->first();
            // if(isset($get_phon_number->id)){
            //     $this->provider_phone_number = $get_phon_number->phone;
            // }else{
            //     $this->provider_phone_number = '';
            // }
            $this->get_message = ProviderMessageBoard::where('provider_id',$providerid)->where('status',1)->first();
        }
        
        // dd($this->badge_dates);
    }

    public function toggleMap()
    {
        $this->showMap = !$this->showMap;
        $this->emit('openLocation');
    }

    public function showFeature()
    {
        $this->emit('showListingFeature');
    }

    public function showAmenity()
    {
        $this->emit('showListingAmenity');
    }

    public function render()
    {
        return view('livewire.frontend.property-manager.apartmant-websites');
    }
}
