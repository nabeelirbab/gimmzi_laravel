<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;
    protected $fillable = ['name','slug'];

    public function privacyPolicy()
    {
        return $this->hasOne(PrivacyPolicy::class);
    }

    public function termsCondition()
    {
        return $this->hasOne(TermsAndCondition::class);
    }

}
