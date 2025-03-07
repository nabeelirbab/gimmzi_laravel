<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'status'
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

}
