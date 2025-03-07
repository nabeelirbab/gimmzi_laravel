<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BusinessProfile extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable =
    [
        'business_category_id',
        'business_name',
        'street_address',
        'city',
        'state',
        'zip_code',
        'type_of_service',
        'business_page_link',
        'number_of_location',
        'business_logo',
        'business_image',
        'allow_notification',
        'status',
        'merchant_id',
        'service_type_id',
        'merchant_type',
        'business_type',
        'businessId',
        'state_id',
        'business_phone',
        'business_email',
        'business_fax_number',
        'solution_type',
        'mailing_address',
        'mailing_city',
        'mailing_zipcode',
        'mailing_state_id',
        'same_address',
        'no_physical_address',
        'main_image',
        'video',
        'business_overview',
        'business_story'
    ];
    protected $appends = ['logo_image', 'head_location', 'main_image_url', 'formatted_location', 'is_favourite', 'multiple_images', 'story_image_url', 'main_location'];

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id', 'id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'business_id', 'id');
    }
    public function loyalty()
    {
        return $this->hasMany(MerchantLoyaltyProgram::class, 'business_profile_id', 'id');
    }

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id', 'id');
    }

    public function locations()
    {
        return $this->hasMany(BusinessLocation::class, 'business_profile_id', 'id');
    }

    public function merchantUser()
    {
        return $this->hasMany(User::class);
    }

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function businessvideo()
    {
        return $this->hasMany(BusinessVideo::class);
    }

    public function consumerWallet()
    {
        return $this->hasMany(ConsumerWallet::class);
    }


    public function getLogoImageAttribute()
    {

        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'businessProfileLogo'])->first();
        if ($photo) {
            $imageurl = url($photo->getUrl());
        } else {
            $imageurl = asset('frontend_assets/images/samplelogo.png');
        }
        return $imageurl;
    }

    public function getMainImageUrlAttribute()
    {
        // $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'businessProfileLogo'])->first();
        if ($this->main_image !== NULL) {
            $imageurl = url($this->main_image);
        } else {
            $imageurl = asset('frontend_assets/images/pp1.jpg');
        }
        return $imageurl ?? '';
    }

    public function mailingstates()
    {
        return $this->belongsTo(State::class, 'mailing_state_id', 'id');
    }

    public function getHeadLocationAttribute()
    {
        $location =  $this->locations->where('location_type', 'Headquarters')->where('status', 1)->first();
        if ($location) {
            return $location->address . ', ' . $location->city . ', ' . $location->zip_code;
        }
    }

    public function getFormattedLocationAttribute()
    {
        // $location =  $this->locations->where('location_type', 'Headquarters')->where('status', 1)->first();
        $location =  $this->locations->where('status', 1)->where('participating_type', 'Participating')->whereNotNull('latitude')->whereNotNull('longitude')->first();
        if ($location) {
            return $location->address;
        }
    }

    public function travelMerchant($travel_id, $profile_id)
    {
        $profile = TravelTourismMerchant::where('travel_tourism_id', $travel_id)->where('business_profile_id', $profile_id)->first();
        if ($profile) {
            return true;
        } else {
            return false;
        }
    }

    public function reportRequest()
    {
        return $this->hasMany(GeneratedReport::class, 'business_id', 'id');
    }

    public function merchantBoard()
    {
        return $this->hasMany(MerchantDisplayBoard::class, 'business_id', 'id');
    }

    public function consumerFavourite(){
        return $this->hasMany(ConsumerFavouriteTravelTourism::class, 'business_id', 'id');
    }

    public function getIsFavouriteAttribute()
    {
        $favourite = ConsumerFavouriteTravelTourism::where('business_id', $this->id)->where('consumer_id', Auth::id())->first();
        if ($favourite) {
            if ($favourite->is_favourite == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function getMultipleImagesAttribute()
    {
        $images = array();
        $photos = Media::where(['model_id' => $this->id, 'collection_name' => 'businessProfilePhoto'])->get();
        if (count($photos) > 0) {
            foreach ($photos as $data) {
                $imageurl = url($data->getUrl());
                array_push($images, $imageurl);
            }
        } else {
            $images = array();
        }
        return $images;
    }

    public function getStoryImageUrlAttribute(){
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'BusinessStoryImage'])->first();
        if ($photo) {
            $imageurl = url($photo->getUrl());
        } else {
            $imageurl = asset('frontend_assets/images/samplelogo.png');
        }
        return $imageurl;
    }

    public function getMainLocationAttribute(){
        $location =  $this->locations->where('status', 1)->where('participating_type', 'Participating')->whereNotNull('latitude')->whereNotNull('longitude')->first();
        if ($location) {
            return $location;
        }else{
            return null;
        }

    }

}
