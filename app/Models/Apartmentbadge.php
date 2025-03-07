<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartmentbadge extends Model
{
    use HasFactory;
    protected $fillable = ['unit_id','building_id', 'start_date','end_date' ,'expected_end_date', 'status'];
    protected $appends = ['guest_count'];

    public function badge_guest(){
        return $this->hasMany(ApartmentGuestBadge::class,'badges_id','id');
    }

    public function getGuestCountAttribute(){
        return count($this->badge_guest);
    }

    public function building(){
        return $this->belongsTo(ProviderBuilding::class,'building_id','id');
    }

    public function buildingunit(){
        return $this->belongsTo(BuildingUnit::class,'unit_id','id');
    }
}
