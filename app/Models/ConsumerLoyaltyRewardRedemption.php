<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerLoyaltyRewardRedemption extends Model
{
    use HasFactory;
    protected $fillable = ['consumer_reward_id', 'loyalty_reward_id', 'given_amount', 'total_earning', 'points', 'remaining_point'];

    public function consumer_reward(){
        return $this->belongsTo(ConsumerLoyaltyReward::class, 'consumer_reward_id', 'id');
    }
}
