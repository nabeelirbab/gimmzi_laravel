<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class BusinessCategory extends Model implements HasMedia
{
    use HasFactory;
    use HasMediaTrait;
    protected $fillable = ['category_name', 'status', 'terms_conditions' , 'icon'];
    protected $appends = ['icon_url'];

    public function business()
    {
        return $this->hasMany(BusinessProfile::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceType::class);
    }
    
    public function description()
    {
        return $this->hasMany(SuggestedDescription::class);
    }

    public function item()
    {
        return $this->hasMany(ItemOrService::class);
    }

    public function gift()
    {
        return $this->hasMany(GiftManage::class);
    }

    public function getIconUrlAttribute(){
        $photo = Media::where(['model_id' => $this->id, 'collection_name' => 'categoryIcon'])->first();
        if ($photo) {
            $imageurl = url($photo->getUrl());
        } else {
            $imageurl = asset('frontend_assets/images/samplelogo.png');
        }
        return $imageurl;
    }
}
