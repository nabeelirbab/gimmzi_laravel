<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectiveApartmentUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'prospective_apartment_id'];

    public function prospectiveApartment(){
        return $this->belongsTo(ProspectiveAppartmentList::class,'prospective_apartment_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
