<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['coupon_code', 'category_id', 'used_by', 'point', 'expired_at', 'is_used'];

    
    public function category()
    {
        return $this->belongsTo(CouponCategory::class, 'category_id','id');
    }
}
