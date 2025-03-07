<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPlan extends Model
{
    use HasFactory;
    protected $fillable = ['plan_name','plan_title', 'plan_color','active_deal_number','access_user_number',
                            'location_number','loyalty_program_number','item_services_number','is_free','monthly_amount',
                            'yearly_amount','discount','free_trial_Days','status'];
}
