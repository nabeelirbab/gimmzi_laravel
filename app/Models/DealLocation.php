<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MerchantLocation;

class DealLocation extends Model
{
    use HasFactory;
    protected $fillable = ['deal_id', 'location_id', 'participating_type', 'status'];
    // protected $appends = ['deal_manager_count','deal_manager','deal_associate_count','deal_associate'];

    public function location()
    {
        return $this->belongsTo(BusinessLocation::class, 'location_id', 'id');
    }

    public function deal()
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }

    // public function getDealManagerCountAttribute(){
    //     $managercount = 0;
    //     $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->location_id)->where('status',1)->get();
    //     if(count($merchant_location) > 0){
    //         foreach($merchant_location as $locations){
    //             if(($locations->merchantUser->title_id == 2) || ($locations->merchantUser->title_id == 3) || ($locations->merchantUser->title_id == 4) ||
    //             ($locations->merchantUser->title_id == 5)){
    //                 $managercount = $managercount+1;
    //             }
    //         }
    //     }
    //     return $managercount;
    // }
    // public function getDealManagerAttribute(){
    //     $managers = array();
    //     $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->location_id)->where('status',1)->get();
    //     if(count($merchant_location) > 0){
    //         foreach($merchant_location as $locations){
    //             if(($locations->merchantUser->title_id == 2) || ($locations->merchantUser->title_id == 3) || ($locations->merchantUser->title_id == 4) ||
    //             ($locations->merchantUser->title_id == 5)){
    //                 array_push($managers,$locations);
    //             }
    //         }
    //     }
    //     return $managers;
    // }

    // public function getDealAssociateCountAttribute(){
    //     $associatecount = 0;
    //     $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->location_id)->where('status',1)->get();
    //     if(count($merchant_location) > 0){
    //         foreach($merchant_location as $locations){
    //             if(($locations->merchantUser->title_id == 1)){
    //                 $associatecount = $associatecount+1;
    //             }
    //         }
    //     }
    //     return $associatecount;
    // }

    // public function getDealAssociateAttribute(){
    //     $associates = array();
    //     $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->location_id)->where('status',1)->get();
    //     if(count($merchant_location) > 0){
    //         foreach($merchant_location as $locations){
    //             if(($locations->merchantUser->title_id == 1) ){
    //                 array_push($associates,$locations);
    //             }
    //         }
    //     }
    //     return $associates;
    // }
}
