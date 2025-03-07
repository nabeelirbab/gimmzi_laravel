<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecognitionMessage extends Model
{
    use HasFactory;
    protected $fillable = ['type_id', 'message', 'status'];

    public function type(){
        return $this->belongsTo(RecognitionType::class,'type_id','id');
    }
}
