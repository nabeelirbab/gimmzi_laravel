<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Auth;

class BusinessLocation extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasFactory;
    protected $fillable = 
    [
     'business_profile_id',
     'location_name',
     'address',
     'city',
     'state',
     'latitude',
     'longitude',
     'state_id',
     'zip_code',
     'locationId',
     'status',
     'location_type',
     'business_phone',
     'business_email',
     'business_fax_number',
     'participating_type'
    ];

    protected $appends = ['location_manager_count','location_manager','location_associate_count','location_associate','main_location','full_location'];

    public function business()
    {
        return $this->belongsTo(BusinessProfile::class,'business_profile_id','id');
    }

    public function states(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function merchantLocation(){
        return $this->hasMany(MerchantLocation::class, 'location_id');
    }

    public function dealLocation(){
        return $this->hasMany(DealLocation::class);
    }

    public function itemLocation(){
        return $this->hasMany(ItemServiceLocation::class);
    }

    public function merchantboard(){
        return $this->hasMany(MerchantDisplayBoard::class);
    }
    public function getLocationManagerCountAttribute(){
        $managercount = 0;
        $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->id)->where('status',1)->get();
        
        if(count($merchant_location) > 0){
            foreach($merchant_location as $locations){
                if(($locations->merchantUser->title_id == 2) || ($locations->merchantUser->title_id == 3) || ($locations->merchantUser->title_id == 4) || ($locations->merchantUser->title_id == 5)){
                    $managercount = $managercount+1;
                }
                else{
                    $managercount = $managercount;
                }
            }
        }
        return $managercount;
    }

    public function getLocationManagerAttribute(){
        $managers = array();
        $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->id)->where('status',1)->get();
        if(count($merchant_location) > 0){
            foreach($merchant_location as $locations){
                if(($locations->merchantUser->title_id == 2) || ($locations->merchantUser->title_id == 3) || ($locations->merchantUser->title_id == 4) ||
                ($locations->merchantUser->title_id == 5)){
                    array_push($managers,$locations);
                }
                else{
                    $managers;
                }
            }
        }
        return $managers;
    }

    public function getLocationAssociateCountAttribute(){
        $associatecount = 0;
        $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->id)->where('status',1)->get();
        if(count($merchant_location) > 0){
            foreach($merchant_location as $locations){
                if(($locations->merchantUser->title_id == 1)){
                    $associatecount = $associatecount+1;
                }
                else{
                    $associatecount = $associatecount;
                }
            }
        }
        return $associatecount;
    }

    public function getLocationAssociateAttribute(){
        $associates = array();
        $merchant_location = MerchantLocation::with('merchantUser')->where('location_id',$this->id)->where('status',1)->get();
        if(count($merchant_location) > 0){
            foreach($merchant_location as $locations){
                if(($locations->merchantUser->title_id == 1) ){
                    array_push($associates,$locations);
                }
            }
        }
        return $associates;
    }

    public function getMainLocationAttribute(){
        if(Auth::check()){
            $merchant_location = MerchantLocation::where('location_id',$this->id)->where('user_id',auth()->user()->id)->where('status',1)->first();
            if($merchant_location){
                
                if($merchant_location->is_main == 1){
                    return true;
                }
                else{
                    return false;
                }
                
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
        
    }

    public function getFullLocationAttribute(){
        $address ="";
        if($this->address != ''){
            $address = $this->address;
        }
        if($this->city != ''){
            $address = $address.', '.$this->city;
        }
        if($this->state != ''){
            $address = $address.', '.$this->state;
        }
        else{
            if($this->state_id){
                $state = State::find($this->state_id);
                $address = $address.', '.$state->name;
            }
        }
        if($this->zip_code != ''){
            $address = $address.', '.$this->zip_code;
        }
        return $address;
    }

    public function consumerWallet(){
        return $this->hasMany(ConsumerWallet::class);
    }

}
