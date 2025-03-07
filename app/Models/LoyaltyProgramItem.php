<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyProgramItem extends Model
{
    use HasFactory;
    protected $fillable = ['loyalty_program_id ','item_name','item_id'];

    public function program(){
        return $this->belongsTo(MerchantLoyaltyProgram::class, 'loyalty_program_id', 'id');
    }

    public function itemservice(){
        return $this->belongsTo(ItemOrService::class, 'item_id', 'id');
    }
}
