<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelTourismFormSubmitAddress extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'first_email_address',
        'second_email_address',
        'third_email_address',
        'fourth_email_address',
        'fifth_email_address',
        'listing_id',
        'travel_tourism_id',
        'status'
    ];
}
