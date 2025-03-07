<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConsumerLoyaltyReward;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
 
class MerchantLoyaltyProgram extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['merchant_id', 'business_profile_id', 'purchase_goal', 'items', 'have_to_buy', 'free_item_no', 'start_on', 'end_on', 'spend_amount', 'discount_amount', 'when_order', 'program_name', 'status','main_photo','off_percentage', 'points'];
    protected $appends = ['consumer_count', 'loyalty_image', 'is_added_wallet','redeem_details', 'consumer_redemption', 'is_favourite', 'program_type'];

    public function item()
    {
        return $this->hasMany(LoyaltyProgramItem::class,'loyalty_program_id','id');
    }
    public function consumerLoyalty()
    {
        return $this->hasMany(ConsumerLoyaltyReward::class, 'loyalty_reward_id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }
    
    public function loyaltylocations()
    {
        return $this->hasMany(LoyaltyRewardLocation::class, 'loyalty_program_id');
    }

    public function businessProfile(){
        return $this->belongsTo(BusinessProfile::class, 'business_profile_id');
    }
    public function getConsumerCountAttribute()
    {
        return ConsumerLoyaltyReward::where('loyalty_reward_id', $this->id)->where('consumer_id', Auth::id())->count();
    }

    public function consumerWallet(){
        return $this->hasMany(ConsumerWallet::class);
    }

    public function getLoyaltyImageAttribute()
    {
        // $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'mainDealPhoto'])->first();
        if ($this->main_photo != null) {
            $photo = $this->main_photo;
            $imageurl = url($photo);
        } else {
            // $imageurl = asset('frontend_assets/images/business_image.png');
            $imageurl = '';
        }
        return $imageurl;
    }


    public function getIsAddedWalletAttribute()
    {
        $addedWallet = ConsumerWallet::where('loyalty_id', $this->id)->where('consumer_id', Auth::id())->first();
        if ($addedWallet) {
            return true;
        } else {
            return false;
        }
    }

    public function getRedeemDetailsAttribute(){
        $is_redeemed = ConsumerLoyaltyReward::where('loyalty_reward_id', $this->id)->where('consumer_id', Auth::id())->select('id','loyalty_reward_id', 'program_process', 'program_process_percentage', 'is_complete_redeemed', 'remaining_balance')->first();
        if($is_redeemed){
            return $is_redeemed;
        }else{
            return null;
        }
    }

    public function getConsumerRedemptionAttribute(){
        $is_redeemed = ConsumerLoyaltyReward::where('loyalty_reward_id', $this->id)->where('consumer_id', Auth::id())->select('id','loyalty_reward_id', 'program_process', 'program_process_percentage', 'is_complete_redeemed')->first();
        if($is_redeemed){
            $redemption = ConsumerLoyaltyRewardRedemption::where('consumer_reward_id', $is_redeemed->id)->latest('id')->first();
            if($redemption){
                return $redemption;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public function getIsFavouriteAttribute()
    {
        $favourite = ConsumerFavouriteTravelTourism::where('consumer_id', Auth::id())->where('loyalty_id', $this->id)->first();
        if ($favourite) {
            if ($favourite->is_favourite == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getProgramTypeAttribute(){
        if($this->discount_amount != ""){
            $currency = substr($this->discount_amount, 0, 1);
        }
        if(($this->purchase_goal != "") && ($this->purchase_goal == "free") && ($this->off_percentage == "Free")){
            return "Purchase Goal (Free)";
        }elseif(($this->purchase_goal != "") && ($this->purchase_goal == "free") && ($this->off_percentage != "Free") && ($this->off_percentage != null)){
            return "Purchase Goal (Percentage Discount)";
        }elseif(($this->purchase_goal != "") && ($this->purchase_goal == "deal_discount") && ($this->discount_amount != null) && ($currency == "$")){
            return "Spend Goal (Dollar Discount)";
        }elseif(($this->purchase_goal != "") && ($this->purchase_goal == "deal_discount") && ($this->discount_amount != null) && ($currency != "$")){
            return "Spend Goal (Percentage Discount)";
        }else{
           return $this->purchase_goal;
        }

    }
    
    
}
