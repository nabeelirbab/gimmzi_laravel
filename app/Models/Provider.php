<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Provider extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['provider_sub_type_id','address','city','state','zip_code','business_website','points_to_distribute','points_cycle_date','business_logo_path','photo_path','status',
                            'name','providerId','provider_type_id','join_date','phone','state_id','property_video','display_tenant_recognition','display_message_board','thumbnail_image', 'description','latitude', 'longitude'];

    protected $appends = ['logo_img','photo_img'];

    public function sub_type(){
        return $this->belongsTo(ProviderSubType::class,'provider_sub_type_id','id');
    }
    public function type(){
        return $this->belongsTo(ProviderType::class,'provider_type_id','id');
    }
    public function buildings(){
        return $this->hasMany(ProviderBuilding::class);
    }
    public function units(){
        return $this->hasMany(BuildingUnit::class);
    }
    public function users(){
        return $this->hasOne(User::class);
    }

    public function consumerProvider(){
        return $this->hasMany(ConsumerUnit::class);
    }

    public function states(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function sendRegistration(){
        return $this->hasMany(SendRegistrationLink::class);
    }

    public function getLogoImgAttribute(){

        $logo = Media::where(['model_id' => $this->id, 'collection_name' => 'propertyLogo'])->first();
        if($logo){
            $logourl = url($logo->getUrl());
            // dd($logourl);
        }
        else{
            $logourl = asset('frontend_assets/images/samplelogo.png');
        }
        return $logourl;
    }

    public function getPhotoImgAttribute(){

        $arrimage = [];
        $image = Media::where(['model_id' => $this->id, 'collection_name' => 'propertyPhoto'])->get();
        if (count($image) > 0){
            foreach($image as $img){
                if($img){

                    $imageurl = url($img->getUrl());
                }
                else{
                    $imageurl = asset('frontend_assets/images/cam-img7.png');
                }
                array_push($arrimage, $imageurl);
            }

        }

        return $arrimage;
    }



    public function  property_message_board(){
        return $this->hasOne(ProviderMessageBoard::class, 'provider_id', 'id');
    }

    public function  property_limit(){
        return $this->hasOne(ProviderLimitSetting::class, 'property_id', 'id');
    }

    public function floor_plans(){
        return $this->hasOne(ProviderFloorPlan::class,'property_id');
    }

    public function reportRequest(){
        return $this->hasMany(GeneratedReport::class,'property_id','id');
    }

    public function amenity(){
        return $this->hasMany(ProviderAmenity::class, 'property_id','id');
    }

    public function features(){
        return $this->hasMany(ProviderFeature::class, 'property_id', 'id');
    }
    public function consumerFavourite(){
        return $this->hasMany(ConsumerFavouriteTravelTourism::class, 'property_id', 'id');
    }
}
