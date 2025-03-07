<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Badge extends Model implements HasMedia 
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['title', 'description','badge_point' ,'badge_type', 'badge_image', 'status'];
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function boost()
    {
        return $this->hasMany(BadgeBoost::class,'badges_id','id');
    }
    public function consumerBadge()
    {
        return $this->hasMany(ConsumerBadge::class);
    }

    public function point()
    {
        return $this->hasMany(Point::class);
    }

    public function consumerWallet(){
        return $this->hasMany(ConsumerWallet::class);
    }
}
