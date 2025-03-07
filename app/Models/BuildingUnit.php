<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingUnit extends Model
{
    use HasFactory;
    protected $fillable = ['consumer_id','building_id','provider_id','unit','status','access_code'];

    public function buildings(){
        return $this->belongsTo(ProviderBuilding::class, 'building_id','id');
    }

    public function providers(){
        return $this->belongsTo(Provider::class, 'provider_id','id');
    }

    public function consumerunits(){
        return $this->hasMany(ConsumerUnit::class,'unit_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'consumer_id');
    }

    public function sendRegistration(){
        return $this->hasMany(SendRegistrationLink::class);
    }

    public function badges(){
        return $this->hasMany(Apartmentbadge::class,'unit_id','id');
    }
}
