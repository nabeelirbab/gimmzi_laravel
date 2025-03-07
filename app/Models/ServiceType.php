<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'service_name','status'];

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'category_id','id');
    }

    public function Business()
    {
        return $this->hasMany(BusinessProfile::class);
    }

}
