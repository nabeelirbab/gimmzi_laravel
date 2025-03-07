<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelTourismMerchant extends Model
{
    use HasFactory;
    protected $fillable = [
    'travel_tourism_id',
    'business_profile_id',
    'is_checked'];
}
