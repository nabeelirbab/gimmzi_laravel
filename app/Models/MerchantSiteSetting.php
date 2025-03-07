<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantSiteSetting extends Model
{
    use HasFactory;
    protected $fillable=['board_title','board_details','board_status','merchant_website_status','business_hour_status'];
}
