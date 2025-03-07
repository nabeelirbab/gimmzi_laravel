<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestInfoForListing extends Model
{
    use HasFactory;
    protected $fillable = 
    ['short_term_id', 
    'listing_id', 
    'guest_name',
    'guest_phone',
    'guest_email', 
    'adult',
    'children',
    'arrive_date',
    'departure_date'.
    'comment',
    'is_flexible'];
}
