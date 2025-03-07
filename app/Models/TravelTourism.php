<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class TravelTourism extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = [
        'name',
        'travel_tourism_type',
        'address',
        'city',
        'zip_code',
        'state_id',
        'phone',
        'points_to_distribute',
        'image',
        'status',
        'show_message_board',
        'show_listing_website',
        'show_guest_recognition',
        'email_address',
        'qr_code_png',
        'description',
        'lat',
        'long'
    ];

    protected $appends = ['short_term_logo','hotel_image','favourite_tourism','hotel_photos'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function state()
    {
        return $this->belongsto(State::class);
    }

    public function getShortTermLogoAttribute()
    {
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'shortRentalPhoto'])->first();
        if ($photo) {
            $imageurl = url($photo->getUrl());
        } else {
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function listing()
    {
        return $this->hasMany(ShortTermRentalListing::class,'travel_tourism_id','id');
    }

    public function getHotelImageAttribute()
    {
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'hotelResortPhoto'])->first();

        if ($photo) {
            $imageurl = url($photo->getUrl());
        } else {
            $imageurl = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $imageurl;
    }

    public function getFavouriteTourismAttribute(){
        if(auth()->check()){
           
            if(auth()->user()->hasRole('CONSUMER')){
                if(ConsumerFavouriteTravelTourism::where('consumer_id',auth()->user()->id)
                ->where('travel_tourism_id',$this->id)->where('short_rental_id',null)->exists()){
                    return 1;
                }
                else{
                    return 0;
                }
            }
            else{
                return 0;
            }
            
        }
        else{
            return 0;
        }
    }

    public function getHotelPhotosAttribute(){
        $images = [];
        $photos = Media::where(['model_id' => $this->id, 'collection_name' => 'HotelImages'])->get();

        if ($photos) {
            foreach($photos as $data){
                $images[] = url($data->getUrl());
            }
        } else {
            $images = [];
        }
        return $images;
    }
}
