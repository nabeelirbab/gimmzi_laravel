<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerBadge extends Model
{
    use HasFactory;
    protected $table='consumer_badges';
    protected $fillable=['user_id','badges_id','badge_activate_date','status','boost_id','point'];  
    public function badge()
    {
        return $this->belongsTo(Badge::class,'badges_id','id');
    }  
    public function boost()
    {
        return $this->belongsTo(BadgeBoost::class,'boost_id','id');
    } 
}
