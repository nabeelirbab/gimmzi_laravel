<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MerchantMessageBoard;

class MessageBoard extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'make_public',
        'tenant_only',
        'status',
        'travel_tourism_type'
    ];

    public function providerMessageBoard()
    {
        return $this->hasMany(ProviderMessageBoard::class);
    }
}
