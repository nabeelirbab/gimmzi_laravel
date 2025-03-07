<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftItemValue extends Model
{
    use HasFactory;
    protected $fillable = ['price', 'gift_id','item_id','merchant_id'];

    public function item()
    {
        return $this->belongsTo(ItemOrService::class,'item_id','id');
        
    }
    public function gift()
    {
        return $this->belongsTo(GiftManage::class,'gift_id','id');
    }
}
