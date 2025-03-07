<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderRecognitionUser extends Model
{
    use HasFactory;

    protected $fillable = ['provider_recognition_id', 'tenant_id'];

    public function provider_recognition(){
        return $this->belongsTo(ProviderTenantRecognition::class, 'provider_recognition_id', 'id');
    }
}
