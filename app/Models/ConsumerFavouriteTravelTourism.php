<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerFavouriteTravelTourism extends Model
{
    use HasFactory;
    protected $fillable=['consumer_id','travel_tourism_id','short_rental_id','is_favourite', 'business_id', 'hotel_id', 'provider_id', 'deal_id','loyalty_id'];  

    public function short_rentals(){
        return $this->belongsTo(ShortTermRentalListing::class,'short_rental_id','id');
    }

    public function consumer(){
        return $this->belongsTo(User::class,'consumer_id','id');
    }

    public function travelTourism(){
        return $this->belongsTo(TravelTourism::class,'travel_tourism_id','id');
    }

    public function business(){
        return $this->belongsTo(BusinessProfile::class,'business_id','id');
    }

    public function provider(){
        return $this->belongsTo(Provider::class,'provider_id','id');
    }
    public function deal(){
        return $this->belongsTo(Deal::class,'deal_id','id');
    }

    public function loyalty(){
        return $this->belongsTo(MerchantLoyaltyProgram::class,'loyalty_id','id');
    }
}
