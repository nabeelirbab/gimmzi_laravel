<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelGuestBadges extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'badges_id',
        'is_resend',
        'point',
        'reward_type',
        'reward_active_on',
        'guest_email',
        'guest_first_name',
        'guest_last_name',
        'zip_code',
        'date_of_birth',
        'is_friend_and_family_badge_active',
    ];

    public function guestbadges()
    {
        return $this->belongsTo(HotelBadges::class,'badges_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
