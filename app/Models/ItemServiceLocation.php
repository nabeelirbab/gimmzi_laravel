<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemServiceLocation extends Model
{
    use HasFactory;
    protected $fillable = ['merchant_id ','location_id', 'item_id', 'status', 'is_checked'];

    public function itemservice(){
        return $this->belongsTo(ItemOrService::class, 'item_id', 'id');
    }
    public function location(){
        return $this->belongsTo(BusinessLocation::class, 'location_id', 'id');
    }
    public function merchant(){
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }
}
