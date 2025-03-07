<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayDay extends Model
{
    use HasFactory;
    protected $fillable = ['display_board_id ', 'days','merchant_board_id'];

    public function board()
    {
        return $this->belongsTo(DisplayBoard::class,'display_board_id','id');
        
    }

    public function merchantDisplay(){
        return $this->belongsTo(MerchantDisplayBoard::class,'merchant_board_id','id');
    }
}
