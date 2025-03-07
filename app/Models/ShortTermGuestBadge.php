<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortTermGuestBadge extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'short_term_id',
        'listing_id',
        'guest_id',
        'checkin_date',
        'checkout_date',
        'badge_status',
        'points',
        'guest_email',
        'is_resend',
        'guest_badge_point_date', 
        'is_friend_and_family_badge_active'
    ];


    /**
     * Belongs To A Short Terms.
     */
    public function shortterm(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TravelTourism::class, 'short_term_id');
    }

    /**
     * Belongs To A Short Terms.
     */
    public function listing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ShortTermRentalListing::class, 'listing_id');
    }


    /**
     * Belongs To A Guest.
     */

    public function guest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }
}
