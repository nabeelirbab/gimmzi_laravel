<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class MerchantExternalManage extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = 
    ['business_id ', 
    'location_id', 
    'order_online_url',
    'order_online_display', 
    'carrer_url', 
    'carrer_display', 
    'direct_website_url', 
    'direct_website_display', 
    'view_menu_display', 
    'view_flyer_display'];

    protected $appends = ['menu_image1','menu_image2','menu_image3','flyer_image1','flyer_image2'];

    public function getMenuImage1Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'menuImage1'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getMenuImage2Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'menuImage2'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getMenuImage3Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'menuImage3'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getFlyerImage1Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'flyerImage1'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getFlyerImage2Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'flyerImage2'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }
}
