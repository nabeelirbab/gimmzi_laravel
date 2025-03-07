<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerUnit extends Model
{
    use HasFactory;
    protected $fillable=['provider_type_id','provider_user_id','provider_building_id','unit_id','consumer_id']; 
    
    public function consumers(){
        return $this->belongsTo(User::class,'consumer_id','id');
    }
    public function provider(){
        return $this->belongsTo(Provider::class,'provider_type_id','id');
    }

    public function providerUser(){
        return $this->belongsTo(User::class,'provider_user_id','id');
    }

    public function providerBuilding(){
        return $this->belongsTo(ProviderBuilding::class,'provider_building_id','id');
    }

    public function buildingunit(){
        return $this->belongsTo(BuildingUnit::class,'unit_id','id');
    }



}
