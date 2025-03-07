<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelBuildings extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'building_name',
        'buildingId',
        'status'
    ];

    public function buildingunits(){
        return $this->hasMany(HotelUnites::class, 'building_id','id');
    }

    public function buildingbadges(){
        return $this->hasMany(HotelBadges::class,'building_id','id');
    }

    public function travel(){
        return $this->HasMany(TravelTourism::class, 'hotel_id','id');
    }
}
