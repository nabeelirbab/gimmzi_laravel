<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerLoyaltyReward extends Model
{
    use HasFactory;
    protected $fillable = ['consumer_id', 'loyalty_reward_id', 'join_date', 'program_process', 'program_process_percentage', 'status','location_id', 'deal_id', 'is_complete_redeemed', 'remaining_balance' ];

    public function consumers(){
        return $this->belongsTo(User::class,'consumer_id','id');
    }

    public function loyalty(){
        return $this->belongsTo(MerchantLoyaltyProgram::class,'loyalty_reward_id','id');
    }

    public function location(){
        return $this->belongsTo(BusinessLocation::class,'location_id','id');
    }

    public function loyaltyitem(){
        return $this->hasMany(LoyaltyProgramItem::class, 'loyalty_reward_id','loyalty_program_id');
    }

    public function deal(){
        return $this->belongsTo(Deal::class,'deal_id','id');
    }

    public function redemptions(){
        return $this->hasMany(ConsumerLoyaltyRewardRedemption::class, 'id', 'consumer_reward_id');
    }
}
