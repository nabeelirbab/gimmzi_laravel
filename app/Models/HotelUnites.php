<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelUnites extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'unit_name',
        'unitId',
        'hotel_id',
        'status'
    ];

    public function unitbuildings(){
        return $this->belongsTo(HotelBuildings::class,'building_id','id');
    }

    public function unitbadges(){
        return $this->hasMany(HotelBadges::class,'unit_id','id');
    }

    public function travelturism(){
        return $this->HasMany(TravelTourism::class, 'hotel_id','id');
    }
}
