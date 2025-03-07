<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderTenantRecognition extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 'provider_id', 'recognition_option', 'system_message', 'custom_message', 'tenant_only', 'make_public', 'status','is_published','month'];

    public function type(){
        return $this->belongsTo(RecognitionType::class, 'type_id', 'id');
    }

    public function provider_recognition_user(){
        return $this->hasMany(ProviderRecognitionUser::class,'provider_recognition_id');
    }

    public function property(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

}
