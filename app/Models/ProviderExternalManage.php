<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProviderExternalManage extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = 
    ['property_id ', 
    'contact_community_url', 
    'contact_community_display',
    'lease_online_url', 
    'lease_online_display', 
    'resident_portal_url', 
    'resident_portal_display', 
    'visit_website_url', 
    'visit_website_display', 
    'floor_plan_display',
    'event_flyer_display',
    'book_online_url',
    'book_online_display',
    'guest_portal_url',
    'guest_portal_display',
    'location_display',
    'request_info_display',
    'travel_tourism_id',
    'listing_id', 
    'phone'
    ];
    protected $appends = ['flyer_image1','flyer_image2'];

    public function getFlyerImage1Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'propertyFlyerImage1'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getFlyerImage2Attribute(){
       
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'propertyFlyerImage2'])->first();
        if($photo){
            $imageurl = url($photo->getUrl());
        }
        else{
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function property(){
        return $this->belongsTo(Provider::class,'property_id');
    }
    public function travel_tourism(){
        return $this->belongsTo(TravelTourism::class,'travel_tourism_id');
    }
}
