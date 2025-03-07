<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentGuestBadge extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','badges_id', 'is_resend','status' ,'point', 'guest_email','guest_first_name','guest_last_name'];

    public function badge(){
        return $this->belongsTo(Apartmentbadge::class,'badges_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
