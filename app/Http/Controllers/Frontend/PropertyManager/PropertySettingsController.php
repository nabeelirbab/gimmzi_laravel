<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\BuildingUnit;
use Illuminate\Http\Request;
use App\Models\PropertyUnderProviderUser;
use Illuminate\Support\Facades\Auth;
use App\Models\Title;
use App\Models\User;
use App\Models\Provider;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Validator;
use App\Models\ProviderExternalManage;
use App\Models\ProviderFeature;
use App\Models\ProviderAmenity;
use App\Models\ProviderFloorPlan;
use Illuminate\Support\Facades\Storage;
use App\Models\ProviderLimitSetting;
use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use PDF;

class PropertySettingsController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        $propertyDetails = PropertyUnderProviderUser::where('provider_user_id', $user->id)->with('provider')->get();
        $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $propertyid = $propertyDetails->first()->provider_id;
        // dd($propertyid);
        $getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $propertyid)->whereIn('title_id', $usertitle)
            ->whereHas('provideruser', function ($q) {
                $q->where('active', 1);
            })->get();
        $adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $propertyid)->whereIn('title_id', $usertitle)
            ->whereHas('provideruser', function ($q) {
                $q->where('active', 0);
            })->get();
        $property_limit = ProviderLimitSetting::where('property_id', $propertyid)->first();
        return view('frontend.property-manager.settings', compact('propertyDetails', 'user', 'getusers', 'adduser', 'property_limit'));
    }

    public function getRemoveProviderUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userId);
            if ($user) {
                return response()->json(['success' => 1, 'data' => $user]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function removeProviderUser(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->userRemove);
            if ($user) {
                $user->active = 0;
                $user->save();
                $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
                $adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $request->propertyid)->whereIn('title_id', $usertitle)
                    ->whereHas('provideruser', function ($q) {
                        $q->where('active', 0);
                    })->get();
                return response()->json(['success' => 1, 'data' => $adduser]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function addProviderUser(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $adduser = User::find($request->user);
            if ($adduser) {
                $adduser->active = 1;
                $adduser->save();
                $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
                $getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $request->propertyid)->whereIn('title_id', $usertitle)
                    ->whereHas('provideruser', function ($q) {
                        $q->where('active', 1);
                    })->get();

                $adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $request->propertyid)->whereIn('title_id', $usertitle)
                    ->whereHas('provideruser', function ($q) {
                        $q->where('active', 0);
                    })->get();
                return response()->json(['success' => 1, 'data' => $getusers, 'user' => $user, 'adduser' => $adduser]);
            }
        }
    }

    public function getPropertyDetail(Request $request)
    {
        if ($request->ajax()) {
            $photos = array();
            $property = Provider::with('property_limit')->find($request->property_id);
            $property_logo = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyLogo'])->first();
            if ($property_logo) {
                $property_logo = $property_logo->getUrl();
            } else {
                $property_logo = '';
            }
            $property_photos = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyPhoto'])->get();
            if (count($property_photos) > 0) {
                foreach ($property_photos as $images) {
                    array_push($photos, array('image' => $images->getUrl(), 'id' => $images->id));
                }
            }
            if ($property) {
                return response()->json(['status' => 1, 'message' => 'Property found', 'data' => $property, 'logo' => $property_logo, 'photos' => $photos]);
            } else {
                return response()->json(['status' => 0, 'message' => 'Property not found']);
            }
        }
    }

    public function savePropertyLogo(Request $request)
    {
        // return response()->json(['status' => 1, 'data' => $request->all()]);
        if ($request->hasFile('logo')) {
            $property = Provider::find($request->property_id);
            $old_property_logo = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyLogo'])->first();
            if ($old_property_logo) {
                $old_property_logo->delete();
            }
            $fileAdders = $property->addMedia($request->logo->getRealPath())
                ->usingName($request->logo->getClientOriginalName())
                ->toMediaCollection('propertyLogo');
            if ($fileAdders) {
                $property_logo = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyLogo'])->first();
                return response()->json(['status' => 1, 'message' => 'image uploaded', 'data' => $property_logo->getUrl()]);
            } else {
                return response()->json(['status' => 0, 'message' => 'something went wrong']);
            }
        } else {
            return response()->json(['status' => 2, 'message' => 'something went wrong']);
        }
    }

    public function removePropertyLogo(Request $request)
    {
        if ($request->ajax()) {
            $property_logo = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyLogo'])->first();
            if ($property_logo) {
                $property_logo->delete();
                return response()->json(['status' => 1, 'message' => 'logo deleted']);
            } else {
                return response()->json(['status' => 0, 'message' => 'logo mot found']);
            }
        }
    }

    public function savePropertyVideo(Request $request)
    {

        $validator  =   Validator::make($request->all(), [
            "media"  =>  "mimes:mp4| max:25000"
        ]);
        if ($validator->fails()) {
            return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
        } else {
            if ($request->hasFile('media')) {
                $property = Provider::find($request->property_id);
                if ($property->property_video != '') {
                    Storage::delete($property->property_video);
                    $property->property_video = '';
                    $property->save();
                }
                $name = time() . rand(1, 100) . '.' . $request->media->extension();
                $path = $request->media->storeAs('public/property_video', $name);

                //create thumbnail//
                $videoFile = $request->file('media');
                // Set the path for storing the thumbnail
                $thumbnailPath = public_path('storage/thumbnails');
                // Create an instance of FFmpeg
                $ffmpeg = FFMpeg\FFMpeg::create();
                // Open the video file
                $video = $ffmpeg->open($videoFile);
                // Set the time to capture the thumbnail (e.g., 5 seconds)
                //dd($thumbnailPath . '/'.$request->property_id.'-thumbnail.png');
                $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));
                //dd($frame);
                $frame->save($thumbnailPath . '/' . $request->property_id . '-thumbnail.png');
                // $time = new TimeCode(5);
                // Capture the thumbnail
                //$video->frame($time)->save($thumbnailPath . '/'.$request->property_id.'thumbnail.jpg');
                //thumbnail create end//

                $imagename = 'thumbnails/' . $request->property_id . '-thumbnail.png';
                $property->property_video = 'property_video/' . $name;
                $property->thumbnail_image = $imagename;
                $property->save();
                if ($property) {
                    return response()->json(["status" => 1, "message" => 'video saved', "data" => $property->property_video]);
                } else {
                    return response()->json(["status" => 2, "message" => 'property not found']);
                }
            } else {
                return response()->json(["status" => 3, "message" => 'property not found']);
            }
            //$file = $request->file('media');


        }
    }

    public function removePropertyMedia(Request $request)
    {
        if ($request->ajax()) {
            $property = Provider::find($request->property_id);
            if ($property->property_video != '') {
                Storage::delete($property->property_video);
                $property->property_video = '';
                $property->save();
                return response()->json(['status' => 1, 'message' => 'media deleted']);
            } else {
                return response()->json(['status' => 0, 'message' => 'media mot found']);
            }
        }
    }

    public function savePropertyPhoto(Request $request)
    {
        // return response()->json(['message' => $request->all()]);
        if ($request->TotalFiles > 0) {
            $photoArray = array();
            $property = Provider::find($request->property_id);
            if ($property) {
                $fileAdders = $property->addMultipleMediaFromRequest(['files'])
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('propertyPhoto');
                    });
                $photos = Media::where(['model_id' => $request->property_id, 'collection_name' => 'propertyPhoto'])->get();
                if (count($photos) > 0) {
                    foreach ($photos as $data) {
                        array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                    }
                }

                return response()->json(['status' => 1, 'message' => 'photo uploaded successfully', "data" => $photoArray]);
            } else {
                return response()->json(['status' => 0, 'message' => 'property not found']);
            }
        }
    }

    public function makeMainPropertyPhoto(Request $request)
    {
        if ($request->ajax()) {
            $media =  Media::find($request->photoid);
            if ($media) {
                $url = $media->getUrl();
                $propertyid = $media->model_id;
                $property = Provider::find($propertyid);
                if ($property) {
                    $property->main_image = $url;
                    $property->save();
                    return response()->json(['status' => 1, 'message' => 'main image saved']);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Property not found']);
                }
            } else {
                return response()->json(['status' => 0, 'message' => 'Image not found']);
            }
        }
    }

    public function removePropertyMainPhoto(Request $request)
    {
        if ($request->ajax()) {
            $photoArray = array();
            $media =  Media::find($request->photoid);
            $propertyid = $media->model_id;
            $property = Provider::find($propertyid);
            if ($property) {
                $property->main_image = '';
                $property->save();
            }
            $media->delete();
            $photos = Media::where(['model_id' => $propertyid, 'collection_name' => 'propertyPhoto'])->get();
            if (count($photos) > 0) {
                foreach ($photos as $data) {
                    array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                }
            }
            return response()->json(['status' => 1, 'message' => 'main image deleted', 'data' => $photoArray]);
        }
    }

    public function removePropertyPhoto(Request $request)
    {
        if ($request->ajax()) {
            $photoArray = array();
            $media =  Media::find($request->photoid);
            if ($media) {
                $propertyid = $media->model_id;
                $property = Provider::find($propertyid);
                if ($property) {
                    if ($property->main_image == $media->getUrl()) {
                        $property->main_image = '';
                        $property->save();
                        $media->delete();
                        $photos = Media::where(['model_id' => $property->id, 'collection_name' => 'propertyPhoto'])->get();
                        if (count($photos) > 0) {
                            foreach ($photos as $data) {
                                array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                            }
                        }
                        return response()->json(['status' => 1, 'message' => 'image deleted', 'data' => $photoArray]);
                    } else {
                        $media->delete();
                        $photos = Media::where(['model_id' => $property->id, 'collection_name' => 'propertyPhoto'])->get();
                        if (count($photos) > 0) {
                            foreach ($photos as $data) {
                                array_push($photoArray, array('image' => $data->getUrl(), 'id' => $data->id));
                            }
                        }
                        return response()->json(['status' => 2, 'message' => 'image deleted', 'data' => $photoArray]);
                    }
                }
            }
        }
    }

    public function updateExternalManage(Request $request)
    {
        if ($request->ajax()) {
            //return response()->json(["status" => $request->resident_portal_check]);
            if ($request->contact_community_text != '') {
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "contact_community_text"  =>  "url"
                    ],
                    ['contact_community_text.url' => 'Contact Community Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable']
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                }
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->contact_community_url = $request->contact_community_text;
                    if ($request->contact_community_check != 0) {
                        $externalData->contact_community_display = 1;
                    } else {
                        $externalData->contact_community_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->contact_community_url = $request->contact_community_text;
                    if ($request->contact_community_check != 0) {
                        $external_data->contact_community_display = 1;
                    } else {
                        $external_data->contact_community_display = 0;
                    }
                    $external_data->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->contact_community_url = $request->contact_community_text;
                    if ($request->contact_community_check != 0) {
                        $externalData->contact_community_display = 1;
                    } else {
                        $externalData->contact_community_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->contact_community_url = $request->contact_community_text;
                    if ($request->contact_community_check != 0) {
                        $external_data->contact_community_display = 1;
                    } else {
                        $external_data->contact_community_display = 0;
                    }
                    $external_data->save();
                }
            }


            if ($request->lease_online_text != '') {
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "lease_online_text"  =>  "url"
                    ],
                    ['lease_online_text.url' => 'Lease Online Url format is invalid. Include Include http:// or https:// in front of URL, whichever is applicable']
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                }
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->lease_online_url = $request->lease_online_text;
                    if ($request->lease_online_check != 0) {
                        $externalData->lease_online_display = 1;
                    } else {
                        $externalData->lease_online_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->lease_online_url = $request->lease_online_text;
                    if ($request->lease_online_check != 0) {
                        $external_data->lease_online_display = 1;
                    } else {
                        $external_data->lease_online_display = 0;
                    }
                    $external_data->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->lease_online_url = $request->lease_online_text;
                    if ($request->lease_online_check != 0) {
                        $externalData->lease_online_display = 1;
                    } else {
                        $externalData->lease_online_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->lease_online_url = $request->lease_online_text;
                    if ($request->lease_online_check != 0) {
                        $external_data->lease_online_display = 1;
                    } else {
                        $external_data->lease_online_display = 0;
                    }
                    $external_data->save();
                }
            }


            if ($request->resident_portal_text != '') {
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "resident_portal_text"  =>  "url"
                    ],
                    ['resident_portal_text.url' => 'Resident Portal URL format is invalid. Include Include http:// or https:// in front of URL, whichever is applicable']
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                }

                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->resident_portal_url = $request->resident_portal_text;
                    if ($request->resident_portal_check != 0) {
                        $externalData->resident_portal_display = 1;
                    } else {
                        $externalData->resident_portal_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->resident_portal_url = $request->resident_portal_text;
                    if ($request->resident_portal_check != 0) {
                        $external_data->resident_portal_display = 1;
                    } else {
                        $external_data->resident_portal_display = 0;
                    }
                    $external_data->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->resident_portal_url = $request->resident_portal_text;
                    if ($request->resident_portal_check != 0) {
                        $externalData->resident_portal_display = 1;
                    } else {
                        $externalData->resident_portal_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->resident_portal_url = $request->resident_portal_text;
                    if ($request->resident_portal_check != 0) {
                        $external_data->resident_portal_display = 1;
                    } else {
                        $external_data->resident_portal_display = 0;
                    }
                    $external_data->save();
                }
            }


            if ($request->visit_website_text != '') {
                $validator  =   Validator::make(
                    $request->all(),
                    [
                        "visit_website_text"  =>  "url"
                    ],
                    ['visit_website_text.url' => 'Visit Direct Website URL format is invalid. Include Include http:// or https:// in front of URL, whichever is applicable']
                );
                if ($validator->fails()) {
                    return response()->json(["status" => 3, "validation_errors" => $validator->errors()->first()]);
                }
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->visit_website_url = $request->visit_website_text;
                    if ($request->visit_website_check != 0) {
                        $externalData->visit_website_display = 1;
                    } else {
                        $externalData->visit_website_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->visit_website_url = $request->visit_website_text;
                    if ($request->visit_website_check != 0) {
                        $external_data->visit_website_display = 1;
                    } else {
                        $external_data->visit_website_display = 0;
                    }
                    $external_data->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->visit_website_url = $request->visit_website_text;
                    if ($request->visit_website_check != 0) {
                        $externalData->visit_website_display = 1;
                    } else {
                        $externalData->visit_website_display = 0;
                    }
                    $externalData->save();
                } else {
                    $external_data = new ProviderExternalManage;
                    $external_data->property_id = $request->propertyid;
                    $external_data->visit_website_url = $request->visit_website_text;
                    if ($request->visit_website_check != 0) {
                        $external_data->visit_website_display = 1;
                    } else {
                        $external_data->visit_website_display = 0;
                    }
                    $external_data->save();
                }
            }

            if (($request->floor_plan_check != 0)) {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->floor_plan_display = 1;
                    $externalData->save();
                } else {
                    $externalData = new ProviderExternalManage;
                    $externalData->property_id = $request->propertyid;
                    $externalData->floor_plan_display = 1;
                    $externalData->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->floor_plan_display = 0;
                    $externalData->save();
                } else {
                    $externalData = new ProviderExternalManage;
                    $externalData->property_id = $request->propertyid;
                    $externalData->floor_plan_display = 0;
                    $externalData->save();
                }
            }

            if (($request->event_flyer_check != 0)) {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->event_flyer_display = 1;
                    $externalData->save();
                } else {
                    $externalData = new ProviderExternalManage;
                    $externalData->property_id = $request->propertyid;
                    $externalData->event_flyer_display = 1;
                    $externalData->save();
                }
            } else {
                $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                if ($externalData) {
                    $externalData->event_flyer_display = 0;
                    $externalData->save();
                } else {
                    $externalData = new ProviderExternalManage;
                    $externalData->property_id = $request->propertyid;
                    $externalData->event_flyer_display = 0;
                    $externalData->save();
                }
            }

            $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
            if ($externalData) {
                return response()->json(["status" => 4, "message" => 'External link updated successfully']);
            } else {
                return response()->json(["status" => 5, "message" => 'External link not updated']);
            }
        }
    }

    public function getExternalManage(Request $request)
    {
        if ($request->ajax()) {
            $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
            if ($externalData) {
                return response()->json(['status' => 1, 'data' => $externalData]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function storeFloorPlan(Request $request)
    {
        if ($request->ajax()) {
            if ($request->floor_image1 != '') {
                $validator  =   Validator::make($request->all(), [
                    "floor_image1"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 5, "validation_errors" => $validator->errors()->first()]);
                }
            }
            if ($request->floor_image2 != '') {
                $validator  =   Validator::make($request->all(), [
                    "floor_image2"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 6, "validation_errors" => $validator->errors()->first()]);
                }
            }
            if ($request->floor_image3 != '') {
                $validator  =   Validator::make($request->all(), [
                    "floor_image3"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 7, "validation_errors" => $validator->errors()->first()]);
                }
            }
            if ($request->id_edit1 != 1) {
                if (($request->floor_image1 != '') && ($request->bedroom1 != '') && ($request->bathroom1 != '') && ($request->total1 != '')) {
                    $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                    if ($provider_plan) {
                        $provider_plan->property_id = $request->propertyid;
                        $provider_plan->bedroom_1 = $request->bedroom1;
                        $provider_plan->bathroom_1 = $request->bathroom1;
                        $provider_plan->total_1 = $request->total1;
                        $provider_plan->save();
                        $photo1 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage1'])->first();
                        if ($photo1) {
                            $photo1->delete();
                        }
                        if ($request->hasFile('floor_image1')) {
                            $provider_plan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                        }
                    } else {
                        $floorplan = new ProviderFloorPlan();
                        $floorplan->property_id = $request->propertyid;
                        $floorplan->bedroom_1 = $request->bedroom1;
                        $floorplan->bathroom_1 = $request->bathroom1;
                        $floorplan->total_1 = $request->total1;
                        $floorplan->save();
                        if ($request->hasFile('floor_image1')) {
                            $floorplan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                        }
                    }
                } else {
                    if ($request->row1 == 1) {
                        return response()->json(['status' => 1]);
                    } else {
                        $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                        if ($provider_plan) {
                            $provider_plan->bedroom_1 = '';
                            $provider_plan->bathroom_1 = '';
                            $provider_plan->total_1 = '';
                            $provider_plan->save();
                            $photo1 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage1'])->first();
                            if ($photo1) {
                                $photo1->delete();
                            }
                        }
                    }
                }
            } else {
                $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                if ($provider_plan) {
                    $provider_plan->bedroom_1 = $request->bedroom1;
                    $provider_plan->bathroom_1 = $request->bathroom1;
                    $provider_plan->total_1 = $request->total1;
                    $provider_plan->save();

                    if ($request->hasFile('floor_image1')) {
                        $photo1 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage1'])->first();
                        if ($photo1) {
                            $photo1->delete();
                        }
                        $provider_plan->addMediaFromRequest('floor_image1')->toMediaCollection('floorImage1');
                    }
                }
            }

            if ($request->id_edit2 != 1) {
                if (($request->floor_image2 != '') && ($request->bedroom2 != '') && ($request->bathroom2 != '') && ($request->total2 != '')) {
                    $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                    if ($provider_plan) {
                        $provider_plan->bedroom_2 = $request->bedroom2;
                        $provider_plan->bathroom_2 = $request->bathroom2;
                        $provider_plan->total_2 = $request->total2;
                        $provider_plan->save();
                        $photo2 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage2'])->first();
                        if ($photo2) {
                            $photo2->delete();
                        } else {
                            if ($request->hasFile('floor_image2')) {
                                $provider_plan->addMediaFromRequest('floor_image2')->toMediaCollection('floorImage2');
                            }
                        }
                    } else {
                        $floorplan = new ProviderFloorPlan();
                        $floorplan->property_id = $request->propertyid;
                        $floorplan->bedroom_2 = $request->bedroom2;
                        $floorplan->bathroom_2 = $request->bathroom2;
                        $floorplan->total_2 = $request->total2;
                        $floorplan->save();
                        if ($request->hasFile('floor_image2')) {
                            $floorplan->addMediaFromRequest('floor_image2')->toMediaCollection('floorImage2');
                        }
                    }
                } else {
                    if ($request->row2 == 1) {
                        return response()->json(['status' => 2]);
                    } else {
                        $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                        if ($provider_plan) {
                            $provider_plan->bedroom_2 = '';
                            $provider_plan->bathroom_2 = '';
                            $provider_plan->total_2 = '';
                            $provider_plan->save();
                            $photo2 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage2'])->first();
                            if ($photo2) {
                                $photo2->delete();
                            }
                        }
                    }
                }
            } else {
                $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                if ($provider_plan) {
                    $provider_plan->bedroom_2 = $request->bedroom2;
                    $provider_plan->bathroom_2 = $request->bathroom2;
                    $provider_plan->total_2 = $request->total2;
                    $provider_plan->save();
                    if ($request->hasFile('floor_image2')) {
                        $photo2 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage2'])->first();
                        if ($photo2) {
                            $photo2->delete();
                        }
                        $provider_plan->addMediaFromRequest('floor_image2')->toMediaCollection('floorImage2');
                    }
                }
            }

            if ($request->id_edit3 != 1) {
                if (($request->floor_image3 != '') && ($request->bedroom3 != '') && ($request->bathroom3 != '') && ($request->total3 != '')) {
                    $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                    if ($provider_plan) {
                        $provider_plan->bedroom_3 = $request->bedroom3;
                        $provider_plan->bathroom_3 = $request->bathroom3;
                        $provider_plan->total_3 = $request->total3;
                        $provider_plan->save();
                        $photo3 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage3'])->first();
                        if ($photo3) {
                            $photo3->delete();
                        } else {
                            if ($request->hasFile('floor_image3')) {
                                $provider_plan->addMediaFromRequest('floor_image3')->toMediaCollection('floorImage3');
                            }
                        }
                    } else {
                        $floorplan = new ProviderFloorPlan();
                        $floorplan->property_id = $request->propertyid;
                        $floorplan->bedroom_3 = $request->bedroom3;
                        $floorplan->bathroom_3 = $request->bathroom3;
                        $floorplan->total_3 = $request->total3;
                        $floorplan->save();
                        if ($request->hasFile('floor_image3')) {
                            $floorplan->addMediaFromRequest('floor_image3')->toMediaCollection('floorImage3');
                        }
                    }
                } else {
                    if ($request->row3 == 1) {
                        return response()->json(['status' => 3]);
                    } else {
                        $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                        if ($provider_plan) {
                            $provider_plan->bedroom_3 = '';
                            $provider_plan->bathroom_3 = '';
                            $provider_plan->total_3 = '';
                            $provider_plan->save();
                            $photo3 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage3'])->first();
                            if ($photo3) {
                                $photo3->delete();
                            }
                        }
                    }
                }
            } else {
                $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                if ($provider_plan) {
                    $provider_plan->bedroom_3 = $request->bedroom3;
                    $provider_plan->bathroom_3 = $request->bathroom3;
                    $provider_plan->total_3 = $request->total3;
                    $provider_plan->save();
                    if ($request->hasFile('floor_image3')) {
                        $photo3 = Media::where(['model_id' => $provider_plan->id, 'collection_name' => 'floorImage3'])->first();
                        if ($photo3) {
                            $photo3->delete();
                        }
                        $provider_plan->addMediaFromRequest('floor_image3')->toMediaCollection('floorImage3');
                    }
                }
            }

            if (($request->row1 == 1) || ($request->row2 == 1) || ($request->row3 == 1)) {
                return response()->json(['status' => 0]);
            } else {
                $provider_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
                if ($provider_plan) {
                    if (($provider_plan->bedroom_1 == '') && ($provider_plan->bedroom_2 == '') && ($provider_plan->bedroom_3 == '')) {
                        $provider_plan->delete();
                        return response()->json(['status' => 8]);
                    } else {
                        return response()->json(['status' => 0]);
                    }
                } else {
                    return response()->json(['status' => 4]);
                }
            }
        }
    }

    public function saveEventFlyerImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('flyer_image1')) {
                $validator  =   Validator::make($request->all(), [
                    "flyer_image1"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                    if ($externalData) {
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage1'])->first();
                        if ($image) {
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('flyer_image1')->toMediaCollection('propertyFlyerImage1');
                    } else {
                        $external_data = new ProviderExternalManage;
                        $external_data->property_id = $request->propertyid;
                        $external_data->save();
                        $external_data->addMediaFromRequest('flyer_image1')->toMediaCollection('propertyFlyerImage1');
                    }
                }
            }
            if ($request->hasFile('flyer_image2')) {
                $validator  =   Validator::make($request->all(), [
                    "flyer_image2"  =>  "mimes:jpg,jpeg,png"
                ]);
                if ($validator->fails()) {
                    return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                } else {
                    $externalData = ProviderExternalManage::where('property_id', $request->propertyid)->first();
                    if ($externalData) {
                        $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage2'])->first();
                        if ($image) {
                            $image->delete();
                        }
                        $externalData->addMediaFromRequest('flyer_image2')->toMediaCollection('propertyFlyerImage2');
                    } else {
                        $external_data = new ProviderExternalManage;
                        $external_data->property_id = $request->propertyid;
                        $external_data->save();
                        $external_data->addMediaFromRequest('flyer_image2')->toMediaCollection('propertyFlyerImage2');
                    }
                }
            }
            return response()->json(["status" => 3, "message" => 'image saved']);
        }
    }

    public function deleteEventFlyerImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->image_number == 1) {
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'propertyFlyerImage1'])->first();
                if ($image) {
                    $image->delete();
                    return response()->json(["status" => 0, "message" => 'image deleted']);
                }
            }

            if ($request->image_number == 2) {
                $image = Media::where(['model_id' => $request->imageid, 'collection_name' => 'propertyFlyerImage2'])->first();
                if ($image) {
                    $image->delete();
                    return response()->json(["status" => 1, "message" => 'image deleted']);
                }
            }
        }
    }


    public function getProviderFeature(Request $request)
    {

        if ($request->ajax()) {
            $features = ProviderFeature::where('property_id', $request->propertyid)->get();
            $amenities = ProviderAmenity::where('property_id', $request->propertyid)->get();
            if (count($features) > 0) {
                if (count($amenities) > 0) {
                    return response()->json(['status' => 1, 'data' => $features, 'dataAmenity' => $amenities]);
                } else {
                    return response()->json(['status' => 2, 'data' => $features]);
                }
            } else {
                if (count($amenities) > 0) {
                    return response()->json(['status' => 3, 'dataAmenity' => $amenities]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
        }
    }

    public function updateProviderFeature(Request $request)
    {
        if ($request->ajax()) {
            if ($request->featuretype == 'update') {
                $features = ProviderFeature::find($request->featureid);
                if ($features) {
                    $features->feature_text = $request->feature_text;
                    $features->save();
                    $provider_feature = ProviderFeature::where('property_id', $features->property_id)->get();
                    return response()->json(['status' => 1, 'data' => $provider_feature]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
            if ($request->featuretype == 'add') {
                $new_feature = new ProviderFeature;
                $new_feature->property_id = $request->propertyid;
                $new_feature->feature_text = $request->feature_text;
                $new_feature->status = true;
                $new_feature->save();
                if ($new_feature) {
                    $provider_feature = ProviderFeature::where('property_id', $request->propertyid)->get();
                    return response()->json(['status' => 1, 'data' => $provider_feature]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
        }
    }

    public function removeProviderFeature(Request $request)
    {
        if ($request->ajax()) {
            $feature = ProviderFeature::find($request->featureid);
            if ($feature) {
                $feature->delete();
                $provider_feature = ProviderFeature::where('property_id', $request->propertyid)->get();
                if ($provider_feature) {
                    return response()->json(['status' => 1, 'data' => $provider_feature]);
                } else {
                    return response()->json(['status' => 0]);
                }
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function updateProviderAmenity(Request $request)
    {
        if ($request->ajax()) {
            if ($request->amenitytype == 'update') {
                $amenities = ProviderAmenity::find($request->amenityid);
                if ($amenities) {
                    $amenities->amenity_text = $request->amenity_text;
                    $amenities->save();
                    $provider_amenity = ProviderAmenity::where('property_id', $amenities->property_id)->get();
                    return response()->json(['status' => 1, 'data' => $provider_amenity]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
            if ($request->amenitytype == 'add') {
                $new_amenity = new ProviderAmenity;
                $new_amenity->property_id = $request->propertyid;
                $new_amenity->amenity_text = $request->amenity_text;
                $new_amenity->status = true;
                $new_amenity->save();
                if ($new_amenity) {
                    $provider_amenity = ProviderAmenity::where('property_id', $request->propertyid)->get();
                    return response()->json(['status' => 1, 'data' => $provider_amenity]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
        }
    }

    public function removeProviderAmenity(Request $request)
    {
        if ($request->ajax()) {
            $amenity = ProviderAmenity::find($request->amenityid);
            if ($amenity) {
                $amenity->delete();
                $provider_amenity = ProviderAmenity::where('property_id', $request->propertyid)->get();
                if ($provider_amenity) {
                    return response()->json(['status' => 1, 'data' => $provider_amenity]);
                } else {
                    return response()->json(['status' => 0]);
                }
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function getFloorPlan(Request $request)
    {
        if ($request->ajax()) {
            $floor_plan = ProviderFloorPlan::where('property_id', $request->propertyid)->first();
            if ($floor_plan) {
                $photo1 = Media::where(['model_id' => $floor_plan->id, 'collection_name' => 'floorImage1'])->first();
                if ($photo1) {
                    $photo1 = $photo1->getUrl();
                } else {
                    $photo1 = '';
                }
                $photo2 = Media::where(['model_id' => $floor_plan->id, 'collection_name' => 'floorImage2'])->first();
                if ($photo2) {
                    $photo2 = $photo2->getUrl();
                } else {
                    $photo2 = '';
                }
                $photo3 = Media::where(['model_id' => $floor_plan->id, 'collection_name' => 'floorImage3'])->first();
                if ($photo3) {
                    $photo3 = $photo3->getUrl();
                } else {
                    $photo3 = '';
                }
                return response()->json(['status' => 1, 'data' => $floor_plan, 'image1' => $photo1, 'image2' => $photo2, 'image3' => $photo3]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function userListByProperty(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
            $getusers = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $request->propertyId)->whereIn('title_id', $usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 1);
                })->get();

            $adduser = PropertyUnderProviderUser::with('provideruser', 'title')->where('provider_id', $request->propertyId)->whereIn('title_id', $usertitle)
                ->whereHas('provideruser', function ($q) {
                    $q->where('active', 0);
                })->get();

            if (count($getusers) > 0) {
                return response()->json(['status' => 1, 'data' => $getusers, 'user' => $user, 'adduser' => $adduser]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function getProviderLimit(Request $request)
    {
        if ($request->ajax()) {
            $limit_setting = ProviderLimitSetting::where('property_id', $request->property_id)->first();
            if ($limit_setting) {
                return response()->json(['status' => 1, 'data' => $limit_setting]);
            } else {
                return response()->json(['status' => 0]);
            }
        }
    }

    public function updateProviderLimit(Request $request)
    {
        if ($request->ajax()) {
            $limit_setting = ProviderLimitSetting::where('property_id', $request->property_id)->first();
            if ($request->limit_type == 'term_limit') {
                if ($limit_setting) {
                    $limit_setting->term_limit = $request->value;
                    $limit_setting->save();
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    $limit_setting->term_limit = $request->value;
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                }
                return response()->json(['status' => 1]);
            }
            if ($request->limit_type == 'frequency') {
                if ($limit_setting) {
                    $limit_setting->frequency = $request->value;
                    $limit_setting->save();
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    $limit_setting->frequency = $request->value;
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                }
                return response()->json(['status' => 1]);
            }
            if ($request->limit_type == 'current_allowance') {
                if ($limit_setting) {
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->current_allowance_point_limit = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->current_allowance_point_limit = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'signup_point') {
                if ($limit_setting) {
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->sign_up_bonus_point = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->sign_up_bonus_point = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'low_point') {
                if ($limit_setting) {
                    if ($request->value >= 100) {
                        if ($request->value <= 250) {
                            $limit_setting->low_point_balance = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 100) {
                        if ($request->value <= 250) {
                            $limit_setting->low_point_balance = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'point') {
                if ($limit_setting) {
                    if ($request->value >= 25) {
                        if ($request->value <= 250) {
                            $limit_setting->add_point = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 25) {
                        if ($request->value <= 250) {
                            $limit_setting->add_point = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'tenant_point') {
                if ($limit_setting) {
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->tenant_of_the_month_Reward = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 100) {
                        if ($request->value <= 500) {
                            $limit_setting->tenant_of_the_month_Reward = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'inspection_reward') {
                if ($limit_setting) {
                    if ($request->value >= 100) {
                        if ($request->value <= 400) {
                            $limit_setting->pass_inspection_reward = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 100) {
                        if ($request->value <= 400) {
                            $limit_setting->pass_inspection_reward = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'great_tenant') {
                if ($limit_setting) {
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->great_tenant_reward = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->great_tenant_reward = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'community_helper') {
                if ($limit_setting) {
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->community_helper_reward = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->community_helper_reward = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }

            if ($request->limit_type == 'good_samaritan') {
                if ($limit_setting) {
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->good_samaritan_reward = $request->value;
                            $limit_setting->save();
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                } else {
                    $limit_setting = new ProviderLimitSetting;
                    if ($request->value >= 50) {
                        if ($request->value <= 250) {
                            $limit_setting->good_samaritan_reward = $request->value;
                        } else {
                            return response()->json(['status' => 2]);
                        }
                    } else {
                        return response()->json(['status' => 3]);
                    }
                    $limit_setting->property_id = $request->property_id;
                    $limit_setting->save();
                    return response()->json(['status' => 1]);
                }
            }
        }
    }

    public function viewPropertyWebsite()
    {
        $user = Auth::user();
        $propertyDetails = PropertyUnderProviderUser::where('provider_user_id', $user->id)->with('provider')->get();
        $propertyid = $propertyDetails->first()->provider_id;
        $provider = Provider::find($propertyid);
        $external_manage = ProviderExternalManage::where('property_id', $propertyid)->first();
        $floor_plan = ProviderFloorPlan::where('property_id', $propertyid)->first();
        // dd($external_manage);
        return view('frontend.property-manager.view_website', compact('provider', 'propertyDetails', 'user', 'external_manage', 'floor_plan'));
    }

    public function getExternalButton(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            //$propertyDetails = PropertyUnderProviderUser::with('provider')->where('provider_user_id',$user->id)->with('provider')->get();
            $external_manage = ProviderExternalManage::with('property')->where('property_id', $request->providerid)->first();
            $provider = Provider::find($request->providerid);
            $rendered = view('frontend.property-manager.ajax.website_external_button', compact('external_manage', 'provider'))->render();
            return response()->json(['status' => 1, 'html' => $rendered, 'data' => $provider]);
        }
    }

    public function updateDescription(Request $request)
    {
        if ($request->ajax()) {
            $provider = Provider::find($request->propertyId);
            
            if ($provider) {
                $provider->description = $request->description;
                $provider->save();
                return response()->json(['status' => 1]);
            }else{
                return response()->json(['status' => 0]);
            }
        }
    }


    public function download_pdf_apartment($unit_id)
    {

        $building_unit = BuildingUnit::find($unit_id);
        $data['unit_name'] = $building_unit->unit;
        $data['text'] = url('apartment/'.$building_unit->buildings->provider_type_id);

        $pdf = PDF::loadView('frontend/property-manager/index_pdf', $data);
        //dd($pdf);
        return $pdf->download('qr-code-pdf-file-' . time() . '.pdf');
    }
}
