<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyFamilyFriend extends Model
{
    use HasFactory;
    protected $fillable = [
        'consumer_id',
        'invited_by',
        'type',
        'getting_point',
    ];

}
