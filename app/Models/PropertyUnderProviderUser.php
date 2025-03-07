<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUnderProviderUser extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','provider_user_id','title_id'];

    public function title(){
        return $this->belongsTo(Title::class,'title_id','id');
    }

    public function provider(){
        return $this->belongsTo(Provider::class,'provider_id','id');
    }

    public function providerbuilding(){
        return $this->hasMany(ProviderBuilding::class,'provider_type_id','provider_id');
    }

    public function provideruser(){
        return $this->belongsTo(User::class,'provider_user_id','id');
    }
    
}
