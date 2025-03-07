<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderSubType extends Model
{
    use HasFactory;
    protected $fillable = ['provider_type_id','name'];

    public function type(){
        return $this->belongsTo(ProviderType::class, 'provider_type_id', 'id');
    }
    public function provider(){
        return $this->hasMany(Provider::class);
    }
}
