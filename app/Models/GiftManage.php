<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GiftItemValue;
use Auth;

class GiftManage extends Model
{
    use HasFactory;
    protected $fillable = ['gift_name', 'gift_value','business_category_id', 'note', 'status', 'item_id', 'merchant_id'];
    protected $appends = ['gift_price'];
    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'business_category_id','id');
    }

    public function value()
    {
        return $this->hasMany(GiftItemValue::class);
    }

    public function items()
    {
        return $this->belongsTo(ItemOrService::class,'item_id','id');
    }


    public function getGiftPriceAttribute()
    {
        if(Auth::check() == true){
            return GiftItemValue::where('gift_id',$this->id)->where('merchant_id',auth()->user()->id)->first();
        }
        else{
            $adminitemvalue = GiftItemValue::where('gift_id',$this->id)->where('merchant_id',1)->first();
            if($adminitemvalue){
                return $adminitemvalue->price;
            }
            else{
                $ownitemvalue = GiftItemValue::where('gift_id',$this->id)->first();
                if($ownitemvalue){
                    return $ownitemvalue->price;
                }
            }
        }
            
    }

}
