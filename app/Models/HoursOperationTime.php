<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoursOperationTime extends Model
{
    use HasFactory;
    protected $fillable = ['hour_operation_id ', 'open_time_hour', 'open_time_minute', 'open_time','close_time_hour','close_time_minute','close_time'];

    public function merchant_hours(){
        return $this->belongsTo(MerchantHoursOperation::class,'hour_operation_id','id');
    }
}
