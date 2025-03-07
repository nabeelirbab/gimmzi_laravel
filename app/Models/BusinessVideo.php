<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessVideo extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'business_profile_id',
        'video_path'
    ];

    public function businessprofile(){
        return $this->belongsTo(BusinessProfile::class,'business_profile_id','id');
    }
}
