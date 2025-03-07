<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Events extends Model
{
    use HasFactory;
    use HasMediaTrait;

    protected $fillable =
    [
        'business_id',
        'deal_id',
        'loyalty_id',
        'event_name',
        'is_event_advertise',
        'event_start_date',
        'event_end_date',
        'one_day_event',
        'event_street_address',
        'event_city',
        'event_state_id',
        'event_zip',
        'event_lat',
        'event_long',
        'event_status'
    ];

    public function states()
    {
        return $this->belongsTo(State::class, 'event_state_id', 'id');
    }
}
