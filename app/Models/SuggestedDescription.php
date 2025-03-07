<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedDescription extends Model
{
    use HasFactory;
    protected $fillable = ['description','status','business_id'];


    public function deal(){
        return $this->hasMany(Deal::class);
    }
    
   public function businessCategory()
   {
    return $this->belongsTo(BusinessCategory::class,'business_id','id');
   }

}
