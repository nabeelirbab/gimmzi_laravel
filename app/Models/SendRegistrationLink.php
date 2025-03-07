<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendRegistrationLink extends Model
{

    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'provider_user_id', 'provider_id', 'is_email', 'is_phone', 'access_code', 'link_send_on', 'unit_id'];

    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id','id');
    }

    public function unit()
    {
        return $this->belongsTo(BuildingUnit::class,'unit_id','id');
    }

    public function provideruser()
    {
        return $this->belongsTo(User::class,'provider_user_id','id');
    }
}
