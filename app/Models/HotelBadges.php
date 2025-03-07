<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBadges extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'unit_id',
        'start_date',
        'end_date',
        'expected_end_date',
        'checkin_time',
    ];

    public function badgesguest()
    {
        return $this->hasMany(HotelGuestBadges::class,'badges_id','id');
    }

    public function buildings()
    {
        return $this->belongsTo(HotelBuildings::class.'building_id','id');
    }

    public function unites()
    {
        return $this->belongsTo(HotelUnites::class,'unit_id','id');
    }

}


