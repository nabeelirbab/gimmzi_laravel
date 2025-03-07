<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectiveAppartmentList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'apartment_name', 'property_management_name', 'city', 'state_id', 'zip_code', 'contact_name', 'contact_email', 'contact_phone'];
    
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
 
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function propertyNote()
    {
        return $this->hasMany(PropertyNote::class, 'prospective_id', 'id');
    }

    public function prospectiveApartmentUser(){
        return $this->hasMany(ProspectiveApartmentUser::class,'prospective_apartment_id', 'id');
    }

    
}
