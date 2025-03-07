<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantAutomaticGiftSetting extends Model
{
    use HasFactory;
    protected $fillable=
    ['business_id',

    'progress_status',
    'progress_gift_id',
    'program_progress',

    'completion_status',
    'completion_gift_id',
    'program_number',
    'program_within',
    'program_timeframe',

    'birthday_incentive_status',
    'birthday_gift_id'];  

    public function business(){
        return $this->belongsTo(BusinessProfile::class,'business_id','id');
    }

    public function progress_gift(){
        return $this->belongsTo(GiftManage::class,'progress_gift_id','id');
    }

    public function completion_gift(){
        return $this->belongsTo(GiftManage::class,'completion_gift_id','id');
    }

    public function birthday_gift(){
        return $this->belongsTo(GiftManage::class,'birthday_gift_id','id');
    }

}
