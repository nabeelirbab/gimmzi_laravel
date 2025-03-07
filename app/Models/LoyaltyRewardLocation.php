<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyRewardLocation extends Model
{
    use HasFactory;
    protected $fillable = ['loyalty_program_id ','location_id','end_date','status'];

    public function loyaltyprogram(){
        return $this->belongsTo(MerchantLoyaltyProgram::class,'loyalty_program_id','id');
    }

    public function locations(){
        return $this->belongsTo(BusinessLocation::class,'location_id','id');
    }
}
