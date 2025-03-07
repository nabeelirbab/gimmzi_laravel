<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantHoursOperation extends Model
{
    use HasFactory;
    protected $fillable = ['business_id ', 'day', 'is_closed', 'is_open','is_open_24_hours','location_id'];

    public function location_hours(){
        return $this->hasMany(HoursOperationTime::class,'hour_operation_id');
    }
}
