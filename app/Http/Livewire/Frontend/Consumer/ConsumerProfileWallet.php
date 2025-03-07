<?php

namespace App\Http\Livewire\Frontend\Consumer;

use Livewire\Component;
use App\Models\ConsumerWallet;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\ConsumerLoyaltyReward;
use App\Models\ConsumerLoyaltyRewardRedemption;
use App\Models\Deal;
use App\Models\MerchantLoyaltyProgram;
use App\Models\ShortTermGuestBadge;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class ConsumerProfileWallet extends Component
{
    public $user,$deal_count, $loyalty_count, $all_count;
    public $selectedFilter = 'all';
    public $deal_id,$selected_deal,$business_info,$deal_business_name,$deal_info,$deal_name,$deal_business_locations;
    public $loyalty_business_info,$loyalty_info, $loyalty_name, $loyalty_business_name, $loyalty_business_locations,$haveToBuy;
    public $selectedCount = 0,$imageSelectCounter;
    public $type,$program_process,$location_id,$selected_location_id,$receipt_no,$gimmzi_id,$number1,$number2,$number3,$number4,$number5,$number6,$number7;

    public $loyalty_id,$loyalty_spend_amount,$loyalty_discount_amount;

    // protected $listeners = ['updateSelectedCount'];

    public function mount(){
        $this->user = auth()->user();
        $this->deal_count = ConsumerWallet::where('consumer_id',auth()->user()->id)->where('deal_id','!=',null)->count();
        $this->loyalty_count = ConsumerWallet::where('consumer_id',auth()->user()->id)->where('loyalty_id','!=',null)->count();
        $this->all_count = $this->deal_count + $this->loyalty_count;

        // $today = date('Y-m-d');
        

        // dd($all_deals->get()->toArray());
        
    }

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
        // dd($this->selectedFilter);
    }

    // public function updateSelectedCount($count)
    // {
    //     // dd('scscsc',$count);
    //     $this->selectedCount = $count;
    // }
    
    public function all_deal_redeem($id){
        $this->deal_id = $id;
        $this->selected_deal = ConsumerWallet::query()
        ->where('id',$this->deal_id)
        ->where('consumer_id', Auth::id())
        ->with(['deal', 'deal.dealLocation.location','business','business.locations','deal.consumerLoyalty'])
        ->whereHas('deal', function ($query) {
            $query->where('status', 1);
        })->get();
        if($this->selected_deal->isNotEmpty()){
            $this->business_info = $this->selected_deal->first()->business;
            $this->deal_info = $this->selected_deal->first()->deal;

            $this->deal_name = $this->deal_info->suggested_description;
            $this->deal_business_name = $this->business_info->business_name;
            $this->deal_business_locations = $this->business_info->locations;
        }
        $this->emit('redeemedOpenModalOpen');
    }

    public function all_free_loyalty_redeem($id){
        
        $this->loyalty_id = $id;

        // dd($this->loyalty_id);
        $selected_loyalty = ConsumerWallet::query()
            ->where('id',$this->loyalty_id)
            ->where('consumer_id', Auth::id())
            ->with(['loyalty', 'loyalty.loyaltylocations.locations','business','business.locations'])
            ->whereHas('loyalty', function ($query) {
                $query->where('status', 1);
            })->get();
        if($selected_loyalty->isNotEmpty()){
            $this->loyalty_business_info = $selected_loyalty->first()->business;
            $this->loyalty_info = $selected_loyalty->first()->loyalty;

            $this->loyalty_name = $this->loyalty_info->program_name;
            $this->loyalty_business_name = $this->loyalty_business_info->business_name;
            $this->loyalty_business_locations = $this->loyalty_business_info->locations;
            $this->haveToBuy = $this->loyalty_info->have_to_buy;
            // dd($this->haveToBuy);

        }
        // dd($selected_loyalty,$this->loyalty_business_locations);
        $this->emit('punchOpenModalOpen');
    }

    public function all_discount_loyalty_redeem($id){
        $this->loyalty_id = $id;
        $selected_loyalty = ConsumerWallet::query()
            ->where('id',$this->loyalty_id)
            ->where('consumer_id', Auth::id())
            ->with(['loyalty', 'loyalty.loyaltylocations.locations','business','business.locations'])
            ->whereHas('loyalty', function ($query) {
                $query->where('status', 1);
            })->get();
        if($selected_loyalty->isNotEmpty()){
            $this->loyalty_business_info = $selected_loyalty->first()->business;
            $this->loyalty_info = $selected_loyalty->first()->loyalty;

            $this->loyalty_name = $this->loyalty_info->program_name;
            $spend_am = str_replace('$', '',$this->loyalty_info->spend_amount);
            $dis_am = str_replace('$', '',$this->loyalty_info->discount_amount);
            $this->loyalty_spend_amount = str_replace('.00', '',$spend_am);
            $this->loyalty_discount_amount = str_replace('.00', '',$dis_am);
            $this->loyalty_business_name = $this->loyalty_business_info->business_name;
            $this->loyalty_business_locations = $this->loyalty_business_info->locations;
            // dd($this->loyalty_spend_amount);

        }
        // dd($selected_loyalty,$this->loyalty_business_locations);
        $this->emit('discountPunchModalOpen');
    }


    public function all_free_loyalty(){
       $this->type = 'loyaltyRewards';
       $this->loyalty_id = $this->loyalty_id;
    //    $this->program_process = $this->$selectedCount ;
       $this->location_id = $this->selected_location_id;
       $this->receipt_no = '123456';

       $this->gimmzi_id = $this->number1.$this->number2.$this->number3.$this->number4.$this->number5.$this->number6.$this->number7;

       //dd($this->type,$this->loyalty_id,$this->selectedCount ,$this->selected_location_id,$this->receipt_no,$this->gimmzi_id,$this->number1);
    }
    public function render()
    {
        // $this->emit('redeemedOpenModalOpen');


        $today = date('Y-m-d');
        $dealQuery = ConsumerWallet::query()
        ->where('consumer_id', Auth::id())
        ->with(['deal', 'deal.dealLocation.location','business','deal.consumerLoyalty'])
        ->whereHas('deal', function ($query) {
            $query->where('status', 1);
        })
        ->withCount([
            'deal as expired_deals_count' => function ($query) use ($today) {
                $query->where('status', 1)
                    ->whereDate('end_Date', '<', $today);
            },
            'deal as redeemed_deals_count' => function ($q) {
                $q->whereHas('consumerLoyalty', function ($subq) {
                    $subq->where('is_complete_redeemed', 1)
                        ->where('consumer_id', Auth::id());
                });
            },
            'deal as active_deals_count' => function ($query) use ($today) {
                $query->where('status', 1)
                    ->whereDate('end_Date', '>=', $today)
                    ->orWhereNull('end_Date')
                    ->whereDoesntHave('consumerLoyalty', function ($subq) {
                        $subq->where('is_complete_redeemed', 1)
                            ->where('consumer_id', Auth::id());
                    });
            },
        ]);
        $deals = $dealQuery->get();

        // dd($deals->toArray());

        $loyaltyQuery = ConsumerWallet::query()
            ->where('consumer_id', Auth::id())
            ->with(['loyalty', 'loyalty.loyaltylocations.locations','business'])
            ->whereHas('loyalty', function ($query) {
                $query->where('status', 1);
            })
            ->withCount([
                'loyalty as expired_loyalty_count' => function ($query) use ($today) {
                    $query->where('status', 1)
                        ->whereDate('end_on', '<', $today);
                },
                'loyalty as redeemed_loyalty_count' => function ($q) {
                    $q->whereHas('consumerLoyalty', function ($subq) {
                        $subq->where('is_complete_redeemed', 1)
                            ->where('consumer_id', Auth::id());
                    });
                },
                'loyalty as active_loyalty_count' => function ($query) use ($today) {
                    $query->where('status', 1)
                        ->where(function ($subquery) use ($today) {
                            $subquery->whereDate('end_on', '>=', $today)
                                ->orWhereNull('end_on');
                        })
                        ->whereDoesntHave('consumerLoyalty', function ($subq) {
                            $subq->where('is_complete_redeemed', 1)
                                ->where('consumer_id', Auth::id());
                        });
                },
            ]);
        $loyalties = $loyaltyQuery->get();
        // dd($loyalties);
        $active_loyalty_count = $loyaltyQuery->count();



        $dealRedeemed = ConsumerWallet::query()
            ->where('consumer_id', Auth::id())
            ->whereHas('deal.consumerLoyalty', function ($subQuery) {
                $subQuery->where('is_complete_redeemed', 1)
                        ->where('consumer_id', Auth::id());
            })
            ->with(['deal', 'deal.dealLocation.location', 'business'])
            ->whereHas('deal', function ($query) {
                $query->where('status', 1);
            });

        $dealRedeemedQuery = $dealRedeemed->get();
        $deal_redeemed_count = $dealRedeemed->count();

        $firstQueryIds = $deals->pluck('id')->toArray();
        $secondQueryIds = $dealRedeemedQuery->pluck('id')->toArray();
        $onlyInFirstQueryIds = array_diff($firstQueryIds, $secondQueryIds);
        $finalDeals = $deals->whereIn('id', $onlyInFirstQueryIds);
            // dd($finalDeals->toArray());
        $loyaltyExpire =  ConsumerWallet::query()
            ->where('consumer_id', Auth::id())
            ->with(['loyalty', 'loyalty.loyaltylocations.locations', 'business'])
            ->whereHas('loyalty', function ($query) use ($today) {
                $query->where('status', 1)
                    ->whereDate('end_on', '<', $today);
            });

        $loyaltyExpireQuery = $loyaltyExpire->get();
        $loyaltyExpireCount = $loyaltyExpire->count();
        $active_loyalty_count = $loyaltyQuery->count() - $loyaltyExpire->count();
        $active_deal_count = $dealQuery->count() - $dealRedeemed->count();

        return view('livewire.frontend.consumer.consumer-profile-wallet',compact('deals','loyalties','dealRedeemedQuery','loyaltyExpireQuery','deal_redeemed_count','loyaltyExpireCount','today','active_loyalty_count','active_deal_count','finalDeals'));
    }
}
