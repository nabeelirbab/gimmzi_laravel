<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function subType(){
        return $this->hasMany(ProviderSubType::class);
    }

    public function type(){
        return $this->hasMany(Provider::class);
    }
}
