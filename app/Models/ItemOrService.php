<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GiftItemValue;
use Illuminate\Support\Facades\Auth;

class ItemOrService extends Model
{
    use HasFactory;

    protected $fillable = ['item_name', 'item_value','business_category_id', 'note', 'status', 'merchant_id', 'is_checked','added_by'];
    protected $appends = ['item_price'];
    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'business_category_id','id');
    }

    public function useradded()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function value()
    {
        return $this->hasMany(GiftItemValue::class,'item_id');
    }

    public function gifts()
    {
        return $this->hasMany(GiftManage::class,'item_id');
    }
    public function itemLocation(){
        return $this->hasMany(ItemServiceLocation::class,'item_id','id');
    }

    public function getItemPriceAttribute()
    {
        if(Auth::check() == true){
            return GiftItemValue::where('item_id',$this->id)->where('merchant_id',auth()->user()->id)->first();
        }
        else{
            $adminitemvalue = GiftItemValue::where('item_id',$this->id)->where('merchant_id',1)->first();
            if($adminitemvalue){
                return $adminitemvalue->price;
            }
            else{
                $ownitemvalue = GiftItemValue::where('item_id',$this->id)->first();
                if($ownitemvalue){
                    return $ownitemvalue->price;
                }
            }
        }
            
    }

}
