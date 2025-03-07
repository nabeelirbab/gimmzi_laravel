<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;
    protected $fillable = ['cms_id','description'];

    public function cms(){
        return $this->belongsTo(Cms::class, 'cms_id');
    }
}
