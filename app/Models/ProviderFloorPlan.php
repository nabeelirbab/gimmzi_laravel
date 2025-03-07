<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class ProviderFloorPlan extends Model implements HasMedia
{
    use HasMediaTrait;
    use HasFactory;

    protected $fillable = [
        'property_id',
        'bedroom_1',
        'bathroom_1',
        'total_1',
        'bedroom_2',
        'bathroom_2',
        'total_2',
        'bedroom_3',
        'bathroom_3',
        'total_3',
        'status',
    ];
    protected $appends = ['floor_image1','floor_image2','floor_image3'];

    public function getFloorImage1Attribute(){

        $photo1 = Media::where(['model_id' => $this->id, 'collection_name' => 'floorImage1'])->first();
        if($photo1){
            $image1url = url($photo1->getUrl());
        }
        else{
            $image1url = asset('frontend_assets/images/samplelogo.png');
        }
        
        return $image1url;
    }

    public function getFloorImage2Attribute(){

        $photo2 = Media::where(['model_id' => $this->id, 'collection_name' => 'floorImage2'])->first();
        if($photo2){
            $image2url = url($photo2->getUrl());
            //dd($logourl);
        }
        else{
            $image2url = asset('frontend_assets/images/samplelogo.png');
        }
        return $image2url;
    }

    public function getFloorImage3Attribute(){

        $photo3 = Media::where(['model_id' => $this->id, 'collection_name' => 'floorImage3'])->first();
        if($photo3){
            $image3url = url($photo3->getUrl());
            //dd($logourl);
        }
        else{
            $image3url = asset('frontend_assets/images/samplelogo.png');
        }
        return $image3url;
    }

    public function external_manage(){
        return $this->belongsTo(Provider::class,'property_id');
    }

}
