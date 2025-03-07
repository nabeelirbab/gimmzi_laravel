<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Deal extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable =
    [
        'merchant_id',
        'business_id',
        'category_id',
        'start_Date',
        'end_Date',
        'suggested_description',
        'description',
        'sales_amount',
        'discount_type',
        'discount_amount',
        'point',
        'voucher_number',
        'voucher_unlimited',
        'available_location',
        'deal_location',
        'status',
        'description_id',
        'is_complete',
        'item_id',
        'is_bogo',
        'terms_conditions',
        'is_split',
        'main_image',
        'consumer_id',
        'loyalty_id'
    ];
    protected $appends = ['deal_image', 'is_added_wallet', 'redeem_details', 'is_favourite'];

    public function businessProfile()
    {
        return $this->belongsTo(BusinessProfile::class, 'business_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CouponCategory::class, 'category_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    public function sugestDescription()
    {
        return $this->belongsTo(SuggestedDescription::class, 'description_id', 'id');
    }

    public function items()
    {
        return $this->belongsTo(ItemOrService::class, 'item_id', 'id');
    }

    public function getDealImageAttribute()
    {
        // $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'mainDealPhoto'])->first();
        if ($this->main_image != null) {
            $photo = $this->main_image;
            $imageurl = url($photo);
        } else {
            // if($this->businessProfile->logo_image != ''){
            //     $imageurl = $this->businessProfile->logo_image;
            // }
            // else{
            //    $imageurl = asset('frontend_assets/images/business_image.png');
            // }
            $imageurl = '';
        }
        return $imageurl;
    }


    public function dealLocation()
    {
        return $this->hasMany(DealLocation::class, 'deal_id');
    }

    public function consumerWallet()
    {
        return $this->hasMany(ConsumerWallet::class, 'deal_id');
    }

    public function getIsAddedWalletAttribute()
    {
        $addedWallet = ConsumerWallet::where('deal_id', $this->id)->where('consumer_id', Auth::id())->first();
        if ($addedWallet) {
            return true;
        } else {
            return false;
        }
    }

    public function getRedeemDetailsAttribute()
    {
        $is_redeemed = ConsumerLoyaltyReward::where('deal_id', $this->id)->where('consumer_id', Auth::id())->select('id', 'deal_id', 'is_complete_redeemed')->first();
        if ($is_redeemed) {
            return $is_redeemed;
        } else {
            return null;
        }
    }

    public function consumerLoyalty()
    {
        return $this->hasMany(ConsumerLoyaltyReward::class);
    }


    public function getIsFavouriteAttribute()
    {
        $favourite = ConsumerFavouriteTravelTourism::where('consumer_id', Auth::id())->where('deal_id', $this->id)->first();
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

    public function dealLoyalty(){
        return $this->belongsTo(MerchantLoyaltyProgram::class, 'loyalty_id', 'id');
    }


}
