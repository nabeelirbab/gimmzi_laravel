<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantLocation extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id', 
        'location_id',
        'status',
        'is_main'
    ];

    public function merchantUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function businessLocation(){
        return $this->belongsTo(BusinessLocation::class, 'location_id', 'id');
    }
}
