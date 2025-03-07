<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsumerWallet extends Model
{
    use HasFactory;
    protected $fillable=['consumer_id','business_id','deal_id','loyalty_id','badge_id', 'location_id', 'points', 'is_redeemed']; 

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'consumer_id');
    }

    public function business(): BelongsTo 
    {
        return $this->belongsTo(BusinessProfile::class, 'business_id');
    }

    public function deal(): BelongsTo 
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }

    public function loyalty(): BelongsTo 
    {
        return $this->belongsTo(MerchantLoyaltyProgram::class, 'loyalty_id');
    }

    public function badge(): BelongsTo 
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }

    public function location(): BelongsTo 
    {
        return $this->belongsTo(BusinessLocation::class, 'location_id');
    }

}
