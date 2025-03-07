<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelTourismSettings extends Model
{
    use HasFactory;
    protected $fillable = [
    'travel_tourism_id',
    'badge_bonus_point',
    'add_point',
    'guest_of_week_point',
    'double_booker_point',
    'triple_booker_point',
    'local_reward_point',
    'check_in_hour',
    'check_in_min',
    'check_in_time',
    'check_out_hour',
    'check_out_min',
    'check_out_time',
    'selected_merchant_number',
    'status'];
}
