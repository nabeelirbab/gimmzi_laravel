<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerGift extends Model
{
    use HasFactory;
    protected $fillable=['consumer_id','consumer_loyalty_id','program_progress','gift_id','send_on','expire_on','send_by','send_user_by'];  

    public function consumer_loyalty(){
        return $this->belongsTo(ConsumerLoyaltyReward::class,'consumer_loyalty_id','id');
    }

    public function consumer(){
        return $this->belongsTo(User::class,'consumer_id','id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'send_user_by','id');
    }

    public function gift(){
        return $this->belongsTo(GiftManage::class,'gift_id','id');
    }
}
