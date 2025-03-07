<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderLimitSetting extends Model
{
    use HasFactory;
    protected $fillable = 
    ['property_id',
    'term_limit', 
    'frequency', 
    'current_allowance_point_limit',
    'sign_up_bonus_point',
    'low_point_balance',
    'add_point',
    'tenant_of_the_month_Reward',
    'pass_inspection_reward',
    'great_tenant_reward',
    'community_helper_reward',
    'good_samaritan_reward',
    'status',
    'community_leader_reward'];

    public function  property(){
        return $this->belongsTo(ProviderLimitSetting::class, 'property_id', 'id');
    }

}
