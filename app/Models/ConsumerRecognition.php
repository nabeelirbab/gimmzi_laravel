<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerRecognition extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'badge_id', 'provider_id', 'reward_type', 'guest_email', 'start_date','end_date', 'reward_given_date', 'points_given'];
}
