<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'point', 'description','sign','came_from','badge_id','boost_id','added_for','property_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function userCameFrom()
    {
        return $this->belongsTo(User::class, 'came_from');
    }
    public function badge()
    {
        return $this->belongsTo(Badge::class, 'badge_id');
    }
    public function boost()
    {
        return $this->belongsTo(BadgeBoost::class, 'boost_id');
    }

    public function property()
    {
        return $this->belongsTo(Provider::class, 'property_id');
    }
}
