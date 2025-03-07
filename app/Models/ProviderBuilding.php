<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderBuilding extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','provider_type_id', 'building_name', 'unit','address1','address2','city','state','zip_code','consumer_id','status','BuildingId'];

    public function user(){
        return $this->belongsTo(User::class,'provider_id','id');
    }
    public function providers(){
        return $this->belongsTo(Provider::class,'provider_type_id','id');
    }
    public function units(){
        return $this->hasMany(BuildingUnit::class,'building_id','id');
    }
}
