<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ShortTermRentalListing extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $appends = ['full_address', 'state_name','main_img','photo_img','favourite_travel'];
    protected $fillable = [
        'travel_tourism_id',
        'type_id',
        'name',
        'street_address',
        'room_number',
        'city',
        'zip_code',
        'state_id',
        'description',
        'no_of_bedrooms',
        'no_of_baths',
        'no_of_half_baths',
        'no_of_guests',
        'listing_images',
        'listing_video',
        'status',
        'state',
        'is_free',
        'main_image',
        'lat',
        'long'
    ];

    public function states(){
        return $this->belongsTo(State::class,'state_id','id');
    }

    public function travel_tourism(){
        return $this->belongsTo(TravelTourism::class,'travel_tourism_id','id');
    }

    public function type(){
        return $this->belongsTo(ListingType::class,'type_id');
    }

    public function getFullAddressAttribute(){
        if($this->street_address != null){
            $address = $this->street_address.', '.$this->city.', '.$this->states->name.', '.$this->zip_code;
            return $address;
        }
        else{
            return null;
        }
        
    }

    public function getStateNameAttribute(){
        if($this->state_id != null){
            return $this->states->name;
        }
        else{
            return null;
        }
        
    }

    public function getMainImgAttribute(){

        if($this->main_image != null){
            $mainiamge = url($this->main_image);
        }
        else{
            $mainiamge = asset('frontend_assets/images/sampleimage.jpg');
        }
        return $mainiamge;
    }

    public function getPhotoImgAttribute(){

        $arrimage = [];
        $image = Media::where(['model_id' => $this->id, 'collection_name' => 'ShortTermListingImages'])->get();
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

    public function getFavouriteTravelAttribute(){
        if(auth()->check()){
           
            if(auth()->user()->hasRole('CONSUMER')){
                if(ConsumerFavouriteTravelTourism::where('consumer_id',auth()->user()->id)
                ->where('travel_tourism_id',$this->travel_tourism_id)
                ->where('short_rental_id',$this->id)->exists()){
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

    public function badges(){
        return $this->hasMany(ShortTermGuestBadge::class,'listing_id','id')->whereIn('badge_status',[0,1]);
    }
    
}
