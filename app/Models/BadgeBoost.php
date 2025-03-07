<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class BadgeBoost extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['badges_id', 'boost_description', 'boost_name', 'point', 'status','boost_image'];


    public function badges()
    {
        return $this->belongsTo(Badge::class);
    }

    public function consumer()
    {
        return $this->hasMany(ConsumerBadge::class);
    }
    public function point()
    {
        return $this->hasMany(Point::class);
    }
}
