<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderFeature extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'property_id ',
        'travel_tourism_id ',
        'feature_text',
        'status',
        'listing_id'
    ];

    public function provider(){
        return $this->belongsTo(Provider::class,'property_id','id');
    }
}
