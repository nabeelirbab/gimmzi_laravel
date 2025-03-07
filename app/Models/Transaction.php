<?php

namespace App\Models;

use App\Http\Livewire\Frontend\Merchant\ItemService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['receipt_no','type','date','location','item_id','purchase_amount','user_name','member_name','status','consumer_loyalty_reward_id'];

    public function consumerloyalty(){
        return $this->belongsTo(ConsumerLoyaltyReward::class, 'consumer_loyalty_reward_id', 'id');
    }
}

