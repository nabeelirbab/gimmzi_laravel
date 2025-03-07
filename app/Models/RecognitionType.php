<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecognitionType extends Model
{
    use HasFactory;
    protected $fillable = ['type_name', 'status'];

    public function message(){
        return $this->hasOne(RecognitionMessage::class);
    }
    public function tenant(){
        return $this->hasMany(ProviderTenantRecognition::class);
    }
}
