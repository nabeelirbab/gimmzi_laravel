<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $fillable = [ 'code', 'name'];

    public function location(){
        return $this->hasMany(BusinessLocation::class);
    }

    public function business(){
        return $this->hasOne(BusinessProfile::class);
    }
   
    public function prospective(){
        return $this->hasMany(ProspectiveAppartmentList::class);
    }

    public function events(){
        return $this->hasOne(Events::class, 'event_state_id', 'id');
    }
}
