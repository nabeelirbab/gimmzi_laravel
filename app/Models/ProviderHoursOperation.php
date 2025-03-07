<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderHoursOperation extends Model
{
    use HasFactory;
    protected $fillable = 
    [
    'property_id',
    'is_closed', 
    'is_open', 
    'day',
    'open_time_hour',
    'open_time_minute',
    'open_time',
    'close_time_hour',
    'close_time_minute',
    'close_time'
    ];
}
