<?php

namespace App\Http\Livewire\Frontend\TravelTourism\HotelResort;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\BusinessCategory;
use App\Models\BusinessProfile;
use App\Models\ProviderAmenity;
use App\Models\ProviderExternalManage;
use App\Models\ProviderFeature;
use App\Models\TravelTourism;
use App\Models\TravelTourismSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\Models\Media;
use App\Models\User;
use App\Models\HotelUnites;
use App\Models\HotelBuildings;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Title;
use App\Models\ProviderMessageBoard;
use App\Models\State;
use App\Models\TravelTourismMerchant;
use Illuminate\Support\Facades\Validator;
use App\Models\TravelTourismFormSubmitAddress;

class Setting extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $user, $hotel, $hotel_name, $travel_tourism, $hotel_settings, $logo, $provider_name, $provider_address, $lat, $long, $provider_phone, $provider_email, $provider_city, $city, $provider_state, $state_id, $zip_code, $provider_logo, $managers = [], $usertitle = [], $deactive_managers = [], $user_id, $manager_user, $manager_id, $listing_website, $message_board, $hotel_message_board, $tenant_recognition, $features = [], $amenities = [], $hotel_feature, $feature_id, $hotel_amenity, $amenity_id, $photo, $main_image, $model_images = [], $listing_images, $uploaded_images = [], $model_video, $listing_videos, $external_manage, $book_online, $book_online_check, $request_info_check, $guest_portal, $guest_portal_check, $location_check, $direct_website, $direct_website_check, $street_address, $contact_community_url, $contact_community_check, $event_flyer_display, $flyer_image1, $flyer_image2, $model_flyer_image1, $model_flyer_image2, $showdiv = false, $buildingShowdiv = false, $business_type = [], $merchants = [], $travel_merchant_count, $business_count, $search_filter, $search_text, $result, $buildingResult, $checkin_hour, $checkin_min, $checkin_time, $checkout_hour, $checkout_min, $checkout_time, $badge_point, $add_point, $guest_point, $double_point, $triple_point, $local_point,$term_limit,$low_point,$buldingList, $select_building;

    protected $listeners = ['featureDeleteConfirm', 'amenityDeleteConfirm', 'deleteEditListPhoto', 'imageDeleteConfirm', 'mediaDeleteConfirm', 'imageFlyerDeleteConfirm'];
    public $email_count, $emails, $first_email_address, $second_email_address, $third_email_address, $fourth_email_address, $fifth_email_address;
    public $state_name, $address, $description, $is_readonly = 'readonly', $edit_text = 'Edit';
    public $search_listing,$qr_image,$selected_listing_name,$text, $search_building, $selected_building_name, $selected_building_id;


    public function mount()
    {
        $this->user = Auth::user();
        $this->hotel = $this->user->travelType;
        $this->hotel_id = $this->hotel->id;
        $this->travel_tourism = TravelTourism::find($this->hotel->id);
        $this->logo = $this->travel_tourism->hotel_image;
        $this->provider_name = $this->travel_tourism->name;
        $this->provider_address = $this->travel_tourism->address;
        $this->lat = '';
        $this->long = '';

        $this->provider_email = $this->travel_tourism->email_address;
        $this->provider_city = $this->travel_tourism->city;
        $this->provider_state = $this->travel_tourism->state->name;
        $this->state_id = $this->travel_tourism->state_id;
        $this->zip_code = $this->travel_tourism->zip_code;
        $this->usertitle = Title::where('title_name', '!=', 'Associate')->pluck('id')->toArray();
        $this->managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
        $this->deactive_managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
        $this->listing_website = $this->hotel->show_listing_website;
        $this->hotel_message_board = ProviderMessageBoard::where('travel_tourism_id', $this->hotel->id)->where('provider_type', 'for_hotel')->first();
        $this->message_board = $this->hotel->show_message_board;
        $this->tenant_recognition = $this->hotel->show_guest_recognition;
        $this->business_type = BusinessCategory::where('status', 1)->get();
        $this->merchants = BusinessProfile::where('status', 1)->orderBy('id', 'desc')->get();
        $this->business_count = BusinessProfile::where('status', 1)->orderBy('id', 'desc')->count();
        $this->hotel_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
        if ($this->hotel_settings) {
            $this->checkin_hour = $this->hotel_settings->check_in_hour;
            $this->checkin_min = $this->hotel_settings->check_in_min;
            $this->checkin_time = $this->hotel_settings->check_in_time;
            $this->checkout_hour = $this->hotel_settings->check_out_hour;
            $this->checkout_min = $this->hotel_settings->check_out_min;
            $this->checkout_time = $this->hotel_settings->check_out_time;
        }
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->count();

        $this->external_manage = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
        if ($this->external_manage) {
            $this->external_manage = $this->external_manage;
        } else {
            $this->external_manage = new ProviderExternalManage;
            $this->external_manage->travel_tourism_id = $this->hotel->id;
            $this->external_manage->save();
        }
        $this->contact_community_url = $this->external_manage->contact_community_url;
        $this->book_online = $this->external_manage->book_online_url;
        $this->direct_website = $this->external_manage->visit_website_url;

        $this->description = $this->hotel->description;

        $this->property_limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
        if($this->property_limit){
            if ($this->property_limit->term_limit != null){
                $this->term_limit = $this->property_limit->term_limit;
            }
            if ($this->property_limit->frequency != null){
                $this->frequency_limit = $this->property_limit->frequency;
            }
        }

        $this->buldingList = HotelBuildings::with('buildingunits')->where('hotel_id',$this->hotel_id)->get();
    }
    public function editProviderDetail()
    {
        $this->provider_phone = $this->travel_tourism->phone;
        $this->emit('showProviderDetailModal');
    }

    public function editProvidername()
    {
        $this->emit('editProviderName');
    }
    public function editProvideraddress()
    {
        $this->emit('editProviderAddress');
    }

    public function editProvideremail()
    {
        $this->emit('editProviderEmail');
    }

    public function editProviderphone()
    {
        $this->emit('editProviderPhone');
    }

    public function UpdateProviderDetail()
    {
        // dd($this->state_name);
        $this->validate(
            [
                'provider_name' => ['required'],
                'provider_address' => ['required'],
                'provider_email' => ['nullable', 'email', Rule::unique('travel_tourisms', 'email_address')->ignore($this->travel_tourism->id)],
                'provider_phone' => ['nullable', Rule::unique('travel_tourisms', 'phone')->ignore($this->travel_tourism->id)],

            ],
            [
                'provider_name.required' => "Provider Name field is required",
                'provider_address.required' => "Provider Address field is required",
                'provider_email.required' => "Provider Email field is required",
                'provider_email.email' => "Provider Email must be a valid email address",
                'provider_phone.required' => "Provider Phone field is required",
                'provider_phone.numeric' => "Provider Phone must be a number",
                'provider_phone.regex' => "Provider Phone must be a valid phone number",
                'provider_phone.digits_between' => "Provider Phone should be between 8 to 15 digits",

            ]
        );
        if ($this->zip_code == '') {
            $this->validate(
                [
                    'zip_code' => ['required'],

                ],
                [
                    'zip_code.required' => "Enter a correct provider address",
                ]
            );
        }
        if ($this->state_id == '') {
            $this->validate(
                [
                    'state_id' => ['required'],

                ],
                [
                    'state_id.required' => "Enter a correct provider address",
                ]
            );
        }
        // // dd($this->provider_address); 
        // $splitaddress = explode(", ",$this->provider_address, 3);

        // // dd($splitaddress[2]);
        $this->travel_tourism->name = $this->provider_name;
        $this->travel_tourism->address = $this->provider_address;
        $this->travel_tourism->email_address = $this->provider_email;
        $this->travel_tourism->phone = $this->provider_phone;
        $this->travel_tourism->city = $this->city;
        $this->travel_tourism->zip_code = $this->zip_code;
        $this->travel_tourism->state_id = $this->state_id;
        $this->travel_tourism->lat = $this->lat;
        $this->travel_tourism->long = $this->long;
        $saved = $this->travel_tourism->save();
        $this->external_manage->contact_community_url = $this->provider_phone;
        $this->external_manage->save();
        if ($this->provider_logo) {
            $photo = Media::where(['model_id' => $this->travel_tourism->id, 'collection_name' => 'hotelResortPhoto'])->first();
            // dd($photo);
            if ($photo) {
                $photo->delete();
                $this->travel_tourism->addMedia($this->provider_logo->getRealPath())
                    ->usingName($this->provider_logo->getClientOriginalName())
                    ->toMediaCollection('hotelResortPhoto');
            } else {
                $this->travel_tourism->addMedia($this->provider_logo->getRealPath())
                    ->usingName($this->provider_logo->getClientOriginalName())
                    ->toMediaCollection('hotelResortPhoto');
            }
        }
        if ($saved) {
            $msgAction = 'Provider Detail has been updated successfully';
            $this->showToastr("success", $msgAction);
        }
        return redirect()->route('frontend.hotel_resort.settings');
    }

    public function showLeadManager()
    {
        $this->emit('showLeadManager');
    }

    public function showRemoveManager($id)
    {
        $this->user_id = $id;
        $this->manager_user = User::find($this->user_id);
        $this->emit('showRemoveModal', ['name' => $this->manager_user->full_name]);
    }

    public function removeManager()
    {
        $manageruser = User::find($this->user_id);
        if ($manageruser) {
            $manageruser->active = false;
            $manageruser->save();
            $this->showUserModal('Manager Removed Successfully');
            $this->managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
            $this->deactive_managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
        } else {
            $this->showUserModal('Manager Not Found');
        }
    }

    public function showUserModal($text)
    {
        $this->emit('userSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideSuccessModal()
    {
        $this->emit('hideUserSuccessModal');
    }

    public function activeManager()
    {
        $this->validate(
            [
                'manager_id' => ['required'],
            ],
            [
                'manager_id.required' => "Please select a Manager",
            ]
        );
        $manager = User::find($this->manager_id);
        if ($manager) {
            $manager->active = true;
            $manager->save();
            $this->showUserModal('Manager Added Successfully');
            $this->managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 1)->get();
            $this->deactive_managers = User::where('travel_tourism_id', $this->hotel->id)->whereIn('title_id', $this->usertitle)->where('active', 0)->get();
        } else {
            $this->showUserModal('Manager Not Found');
        }
    }

    public function openSiteSettings()
    {
        $editlListing = TravelTourism::find($this->hotel->id);
        if ($editlListing) {
            $this->model_images = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelImages'])->get();
            $this->model_video = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelVideos'])->first();
            $this->main_image = $editlListing->image;
        }
        $this->emit('siteSettingsModal');
    }

    public function updateListingWebsiteStatus($status)
    {
        if ($this->hotel) {
            $this->hotel->show_listing_website = $status;
            $this->hotel->save();
        }
        //dd($this->hotel);
        $this->listing_website = $this->hotel->show_listing_website;
    }

    public function updateTermLimit($limit){
       
        if($limit){
           // dd($limit);
            if($this->hotel->id){
                //$limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
                $limit_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();

                if($limit_settings){
                    $limit_settings->term_limit = $limit;
                    $limit_settings->save();
                    $this->term_limit = $limit;
                }
                else{
                    $limit_settings = new TravelTourismSettings;
                    $limit_settings->term_limit = $limit;
                    $limit_settings->travel_tourism_id = $this->hotel->id;
                    $limit_settings->save();
                    $this->term_limit = $limit;
                }
            }
        }
    }

    public function updateMessageBoardStatus($board_status)
    {
        if ($this->hotel) {
            $this->hotel->show_message_board = $board_status;
            $this->hotel->save();
        }
        if ($this->hotel_message_board) {
            $this->hotel_message_board->status = $board_status;
            $this->hotel_message_board->save();
        }

        $this->message_board = $this->hotel->show_message_board;
    }

    public function updateRecognitionStatus($status)
    {
        if ($this->hotel) {
            $this->hotel->show_guest_recognition = $status;
            $this->hotel->save();
        }
        //dd($this->hotel);
        $this->tenant_recognition = $this->hotel->show_guest_recognition;
    }
    private function resetForm()
    {
        $this->resetErrorBag();
    }

    public function featureView()
    {
        $this->features = ProviderFeature::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->emit('featureList');
    }

    public function amenityView()
    {
        $this->features = ProviderFeature::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->emit('amenityList');
    }

    public function featureManage()
    {
        $this->features = ProviderFeature::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->hotel_feature = '';
        $this->feature_id = '';
        $this->emit('featureManageOpen');
    }

    public function editFeature($featureid)
    {
        $feature = ProviderFeature::find($featureid);
        if ($feature) {
            $this->hotel_feature = $feature->feature_text;
            $this->feature_id = $feature->id;
            $this->emit('featureManageOpen');
        }
    }

    public function updateFeature()
    {
        $this->validate(
            [
                'hotel_feature' => ['required'],
            ],
            [
                'hotel_feature.required' => "Feature field is required",
            ]
        );
        if ($this->feature_id != '') {
            $feature = ProviderFeature::find($this->feature_id);
            if ($feature) {
                $feature->feature_text = $this->hotel_feature;
                $feature->save();
            }
            $this->hotel_feature = '';
            $this->feature_id = '';
            $this->resetForm();
            $this->features = ProviderFeature::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been updated successfully');
            $this->reset('hotel_feature');
        } else {
            $feature = new ProviderFeature;
            $feature->travel_tourism_id = $this->hotel->id;
            $feature->feature_text = $this->hotel_feature;
            $feature->status = true;
            $feature->save();
            $this->resetForm();
            $this->features = ProviderFeature::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been added successfully');
            $this->reset('hotel_feature');
        }
    }

    public function closeFeatureManage()
    {
        $this->resetForm();
        $this->hotel_feature = '';
        $this->feature_id = '';
        $this->emit('featureManageClose');
    }

    public function removeFeature($featureid)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this feature!", 'Yes, delete!', 'featureDeleteConfirm', ['feature_id' => $featureid]); //($type,$title,$text,$confirmText,$method)
    }

    public function featureDeleteConfirm($feature_id)
    {
        $feature = ProviderFeature::where('id', $feature_id)->first();
        if ($feature) {
            $feature->delete();
        }
        $this->showFeatureSuccessModal('Feature has been removed successfully');
    }

    public function amenityManage()
    {
        $this->amenities = ProviderAmenity::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
        $this->hotel_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageOpen');
    }

    public function editAmenities($amenityid)
    {
        $amenity = ProviderAmenity::find($amenityid);
        if ($amenity) {
            $this->hotel_amenity = $amenity->amenity_text;
            $this->amenity_id = $amenity->id;
            $this->emit('amenityManageOpen');
        }
    }



    public function updateAmenity()
    {
        $this->validate(
            [
                'hotel_amenity' => ['required'],
            ],
            [
                'hotel_amenity.required' => "Amenity field is required",
            ]
        );
        if ($this->amenity_id != '') {
            $amenity = ProviderAmenity::find($this->amenity_id);
            if ($amenity) {
                $amenity->amenity_text = $this->hotel_amenity;
                $amenity->save();
            }
            $this->hotel_amenity = '';
            $this->amenity_id = '';
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been updated successfully');
            $this->reset('hotel_amenity');
        } else {
            $amenity = new ProviderAmenity;
            $amenity->travel_tourism_id = $this->hotel->id;
            $amenity->amenity_text = $this->hotel_amenity;
            $amenity->status = true;
            $amenity->save();
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('travel_tourism_id', $this->hotel->id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been added successfully');
            $this->reset('hotel_amenity');
        }
    }

    public function removeAmenities($amenityid)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this amenities!", 'Yes, delete!', 'amenityDeleteConfirm', ['amenity_id' => $amenityid]); //($type,$title,$text,$confirmText,$method)
    }

    public function amenityDeleteConfirm($amenity_id)
    {
        $amenity = ProviderAmenity::where('id', $amenity_id)->first();
        if ($amenity) {
            $amenity->delete();
        }
        $this->showFeatureSuccessModal('Amenities has been removed successfully');
    }

    public function closeAmenityManage()
    {
        $this->resetForm();
        $this->hotel_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageClose');
    }

    public function showFeatureSuccessModal($text)
    {
        $this->emit('featureSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideFeatureSuccessModal()
    {
        $this->emit('hidefeaturesuccessModal');
    }

    public function updatedListingImages()
    {
        
        if ($this->listing_images) {
            $this->validate([
                'listing_images.*' => 'image|mimes:jpg,jpeg,png|max:10240', // 25MB Max
            ]);
            foreach ($this->listing_images as $photos) {
                $getList = TravelTourism::find($this->hotel->id);
                $getList->addMedia($photos->getRealPath())
                    ->usingName($photos->getClientOriginalName())
                    ->toMediaCollection('HotelImages');
            }
            $this->model_images = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelImages'])->get();
        }
    }

    public function makeEditMainPhoto($image_id)
    {
        $mediaImg = Media::find($image_id);
        if ($mediaImg) {
            $url = $mediaImg->getUrl();
            $shortList = TravelTourism::find($this->hotel->id);
            if ($shortList) {
                $shortList->image = $url;
                $shortList->save();
            }
            $this->reset('main_image');
            $this->main_image = $url;
        }
    }


    public function deleteEditMainPhoto($hotel_id)
    {
        //dd($hotel_id);
        $shortMainImg = TravelTourism::find($hotel_id);
        // dd($shortMainImg);
        if ($shortMainImg) {
            $shortMainImg->image = null;
            $shortMainImg->save();
            $this->reset('main_image');
        }
    }

    public function deleteEditListPhoto($image_id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'imageDeleteConfirm', ['id' => $image_id]); //($type,$title,$text,$confirmText,$method)
    }

    public function imageDeleteConfirm($id)
    {
        $getmediaImg = Media::find($id);
        // dd($getmediaImg[0]->getUrl());
        $shortList = TravelTourism::find($this->hotel->id);
        if ($shortList->image == $getmediaImg[0]->getUrl()) {
            $shortList->image = '';
            $shortList->save();
            $this->main_image = '';
        }
        Media::destroy($id);
        $this->model_images = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelImages'])->get();
    }

    public function updatedListingVideos()
    {
        $this->validate([
            'listing_videos' => 'max:10240', // 25MB Max
        ], [
            'listing_videos.max' => 'The upload media may not be greater than 25 MB'
        ]);
        if ($this->listing_videos) {

            $getList = TravelTourism::find($this->hotel->id);
            if ($this->listing_videos != 'string') {
                $model_video = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelVideos'])->first();
                if ($model_video) {
                    $model_video->delete();
                    $getList->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('HotelVideos');
                } else {
                    $getList->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('HotelVideos');
                }
            }
        }
        $this->model_video = Media::where(['model_id' => $this->hotel->id, 'collection_name' => 'HotelVideos'])->first();
    }



    public function deleteEditMedia()
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this media!", 'Yes, delete!', 'mediaDeleteConfirm', ['hotel_id' => $this->hotel->id]); //($type,$title,$text,$confirmText,$method)
    }

    public function mediaDeleteConfirm($hotel_id)
    {
        //dd($hotel_id);
        $video = Media::where(['model_id' => $hotel_id, 'collection_name' => 'HotelVideos'])->first();
        if ($video) {
            $video->delete();
        }
        $this->model_video = Media::where(['model_id' => $this->hotel_id, 'collection_name' => 'HotelVideos'])->first();
    }

    public function externalLinkModal()
    {
        $this->resetForm();
        if ($this->street_address != null) {
            $state = State::find($this->state_id);
            $address = $this->street_address . ', ' . $this->city . ', ' . $state->name . ', ' . $this->zip_code;
        } else {
            $address = '';
        }
        $this->external_manage = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
        if ($this->external_manage) {
            $this->external_manage = $this->external_manage;
        } else {
            $this->external_manage = new ProviderExternalManage;
            $this->external_manage->travel_tourism_id = $this->hotel->id;
            $this->external_manage->save();
        }
        $this->contact_community_url = $this->external_manage->contact_community_url;
        $this->contact_community_check = $this->external_manage->contact_community_display;
        $this->book_online = $this->external_manage->book_online_url;
        $this->book_online_check = $this->external_manage->book_online_display;
        $this->guest_portal = $this->external_manage->guest_portal_url;
        $this->guest_portal_check = $this->external_manage->guest_portal_display;
        $this->direct_website = $this->external_manage->visit_website_url;
        $this->direct_website_check = $this->external_manage->visit_website_display;
        $this->event_flyer_display = $this->external_manage->event_flyer_display;
        $this->emit('openExternalLinkModal', ['listing_name'  => $this->travel_tourism->name]);
    }

    public function updateExternalLink()
    {
        //dd('123');
        if ($this->external_manage != '') {
            if (($this->contact_community_url != null) || ($this->book_online != null) || ($this->direct_website != null)) {
                if ($this->contact_community_url != null) {
                    if($this->hotel->phone != null){
                        // $this->validate(
                        //     [
                        //         'contact_community_url' => ['numeric'],
                        //     ],
                        //     [
                        //         'contact_community_url.numeric' => "Contact Host Should be A number",
                        //     ]
                        // );
                        $this->external_manage->contact_community_url = $this->contact_community_url;
                        $this->external_manage->contact_community_display = true;
                        $this->external_manage->save();
                        $this->travel_tourism->phone = $this->contact_community_url;
                        $this->travel_tourism->save();
                    }
                    else{
                        $this->external_manage->contact_community_url = $this->contact_community_url;
                        $this->external_manage->contact_community_display = true;
                        $this->external_manage->save();
                    }
                    
                } else {
                    $this->external_manage->contact_community_url = null;
                    $this->external_manage->contact_community_display = false;
                    $this->external_manage->save();
                }
                if ($this->book_online != null) {
                    $this->validate(
                        [
                            'book_online' => ['required', 'url'],
                        ],
                        [
                            'book_online.required' => "The Book Online Url field is required when Display is true.",
                            'book_online.url' => "Book Online Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );
                    
                    $this->external_manage->book_online_url = $this->book_online;
                    $this->external_manage->book_online_display = true;
                    $this->external_manage->save();
                } else {
                        
                    $this->external_manage->book_online_url = null;
                    $this->external_manage->book_online_display = false;
                    $this->external_manage->save();
                }
                if ($this->direct_website != null) {
                    $this->validate(
                        [
                            'direct_website' => ['required', 'url'],
                        ],
                        [
                            'direct_website.required' => "The Direct website Url field is required when Display is true.",
                            'direct_website.url' => "Direct website Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );
                    
                    $this->external_manage->visit_website_url = $this->direct_website;
                    $this->external_manage->visit_website_display = true;
                    $this->external_manage->save();
                } else {
                        
                    $this->external_manage->visit_website_url = null;
                    $this->external_manage->visit_website_display = false;
                    $this->external_manage->save();
                }
               
                $this->showExternalModal('External Link has been updated successfully');
            } else {
                $this->external_manage->book_online_url = null;
                $this->external_manage->book_online_display = false;
                $this->external_manage->request_info_display = false;
                $this->external_manage->guest_portal_url = null;
                $this->external_manage->guest_portal_display = false;
                $this->external_manage->location_display = false;
                $this->external_manage->visit_website_url = null;
                $this->external_manage->visit_website_display = false;
                $this->external_manage->save();
                $this->showExternalModal('There are no External Link');
            }
        } else {
            $this->showExternalModal('There are no External Link');
        }
    }
    public function showExternalModal($text)
    {
        $this->emit('exteralSuccessModal', [
            'text'  => $text,
        ]);
    }
    public function hideExternalSuccessModal()
    {
        $this->emit('hideExternalsuccessModal');
    }

    public function viewEventFlyerImages()
    {
        $externalData = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
        $this->model_flyer_image1 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage1'])->first();
        $this->model_flyer_image2 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage2'])->first();

        $this->emit('viewEventFlyerImages');
    }

    public function uploadFlyerManager()
    {
        $this->validate([
            'flyer_image1' => 'required|mimes:jpg,jpeg,png|max:10240',
            'flyer_image2' => 'required|mimes:jpg,jpeg,png|max:10240',
        ]);
        if ($this->flyer_image1) {
            $externalData = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
            if ($externalData) {
                $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage1'])->first();
                if ($image) {
                    $image->delete();
                }
                $externalData->addMedia($this->flyer_image1->getRealPath())
                    ->usingName($this->flyer_image1->getClientOriginalName())
                    ->toMediaCollection('propertyFlyerImage1');
            } else {
                $external_data = new ProviderExternalManage;
                $external_data->travel_tourism_id = $this->hotel->id;
                $external_data->save();
                $externalData->addMedia($this->flyer_image1->getRealPath())
                    ->usingName($this->flyer_image1->getClientOriginalName())
                    ->toMediaCollection('propertyFlyerImage1');
            }
        }
        if ($this->flyer_image2) {
            $externalData = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
            if ($externalData) {
                $image = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage2'])->first();
                if ($image) {
                    $image->delete();
                }
                $externalData->addMedia($this->flyer_image2->getRealPath())
                    ->usingName($this->flyer_image2->getClientOriginalName())
                    ->toMediaCollection('propertyFlyerImage2');
            } else {
                $external_data = new ProviderExternalManage;
                $external_data->travel_tourism_id = $this->hotel->id;
                $external_data->save();
                $externalData->addMedia($this->flyer_image2->getRealPath())
                    ->usingName($this->flyer_image2->getClientOriginalName())
                    ->toMediaCollection('propertyFlyerImage2');
            }
        }
        $this->flyer_image1 = '';
        $this->flyer_image2 = '';
        $externalData = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
        $this->model_flyer_image1 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage1'])->first();
        $this->model_flyer_image2 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage2'])->first();
        $this->emit('flyerImageSaveSuccess', [
            'text' => 'You have successfully updated the Flyer Image Manager',

        ]);
    }

    public function flyerImageDelete($model_id)
    {
        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this media!", 'Yes, delete!', 'imageFlyerDeleteConfirm', ['model_id' => $model_id]); //($type,$title,$text,$confirmText,$method)
    }
    public function imageFlyerDeleteConfirm($model_id)
    {
        Media::destroy($model_id);
        $externalData = ProviderExternalManage::where('travel_tourism_id', $this->hotel->id)->first();
        $this->model_flyer_image1 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage1'])->first();
        $this->model_flyer_image2 = Media::where(['model_id' => $externalData->id, 'collection_name' => 'propertyFlyerImage2'])->first();
    }

    public function manageLimit()
    {
        $this->emit('manageLimit');
    }
    public function checkMerchant($id)
    {
        $merchant = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)
            ->where('business_profile_id', $id)
            ->first();

        if ($merchant) {
            $merchant->delete();
        } else {
            if (TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->exists()) {

                if (TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->count() > 10) {

                    $this->showSuccessModal('You can select only 5 to 10 merchants');
                } else {

                    $merchant = new TravelTourismMerchant;
                    $merchant->travel_tourism_id = $this->hotel->id;
                    $merchant->business_profile_id = $id;
                    $merchant->is_checked = true;
                    $merchant->save();
                }
            } else {

                $merchant = new TravelTourismMerchant;
                $merchant->travel_tourism_id = $this->hotel->id;
                $merchant->business_profile_id = $id;
                $merchant->is_checked = true;
                $merchant->save();
            }
        }
        $this->merchants = BusinessProfile::where('status', 1)->orderBy('id', 'desc')->get();
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->count();
    }
    public function filterWiseBusiness()
    {
        if ($this->search_filter == 'all') {
            $this->merchants = BusinessProfile::where('status', 1)->orderBy('id', 'desc')->get();
            $ids = BusinessProfile::where('status', 1)->pluck('id');
            $this->business_count = BusinessProfile::where('status', 1)->count();
            $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)
                ->whereIn('business_profile_id', $ids)
                ->count();
        } else {
            $this->merchants = BusinessProfile::where('status', 1)
                ->where('business_category_id', $this->search_filter)
                ->orderBy('id', 'desc')
                ->get();
            $ids = BusinessProfile::where('status', 1)
                ->where('business_category_id', $this->search_filter)
                ->orderBy('id', 'desc')
                ->pluck('id');
            $this->business_count = BusinessProfile::where('status', 1)
                ->where('business_category_id', $this->search_filter)
                ->orderBy('id', 'desc')
                ->count();
            $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)
                ->whereIn('business_profile_id', $ids)
                ->orderBy('id', 'desc')
                ->count();
        }
    }

    // public function searchResult()
    // {
    //     // dd('csdc');
    //     if (!empty($this->search_text)) {
    //         if (($this->search_filter == null) || ($this->search_filter == 'all')) {
    //             $this->result = BusinessProfile::where('status', 1)
    //                 ->where('business_name', 'like', '%' . trim($this->search_text) . '%')
    //                 ->orderBy('id', 'desc')
    //                 ->get();
    //         } else {
    //             $this->result = BusinessProfile::where('business_category_id', $this->search_filter)
    //                 ->where('status', 1)
    //                 ->where('business_name', 'like', '%' . trim($this->search_text) . '%')
    //                 ->orderBy('id', 'desc')
    //                 ->get();
    //         }
    //         $this->showdiv = true;
    //     } else {
    //         $this->showdiv = false;
    //     }
    // }

    public function merchantBusiness($id)
    {
        $this->merchants = BusinessProfile::where('id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $this->search_text = $this->merchants[0]->business_name;
        $this->showdiv = false;
        $this->business_count = BusinessProfile::where('id', $id)->count();
        $this->travel_merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->where('business_profile_id', $id)->count();
    }

    public function settingCancel()
    {
        $merchant_count = TravelTourismMerchant::where('travel_tourism_id', $this->hotel->id)->count();
        if ($merchant_count == 0) {
            $msgAction = 'Hotel Settings has been updated successfully';
            $this->showToastr("success", $msgAction);
            return redirect()->route('frontend.hotel_resort.settings');
        } else {
            if ($merchant_count < 5) {
                $this->showMerchantSuccessModal('A minimum of 5 merchants is required');
            } elseif ($merchant_count > 10) {
                $this->showMerchantSuccessModal('A maximum of 10 merchants can be selected');
            } else {
                $msgAction = 'Hotel Settings has been updated successfully';
                $this->showToastr("success", $msgAction);
                return redirect()->route('frontend.hotel_resort.settings');
            }
        }
    }

    public function showMerchantSuccessModal($text)
    {
        $this->emit('merchantSuccessModal', [
            'text'  => $text,
        ]);
    }

    public function hideCountModal()
    {
        $this->emit('hideCountModal');
    }

    public function updateCheckinTime()
    {

        $this->validate(
            [
                'checkin_hour' => ['required', 'gt:00', 'lt:13'],
                'checkin_min' => ['required', 'gt:-01', 'lt:60'],
                'checkin_time' => ['required']
            ],
            [
                'checkin_hour.required' => "Check in hour is required",
                'checkin_hour.gt' => "Check in hour must be greater than 0",
                'checkin_hour.lt' => "Check in hour must be less than 13",
                'checkin_min.required' => "Check in minute is required",
                'checkin_min.gt' => "Check in minute must be greater than 0",
                'checkin_min.lt' => "Check in minute must be less than 60",
                'checkin_time.required' => "Please select a check in time",
            ]
        );
        if ($this->hotel_settings) {
            $this->hotel_settings->check_in_hour = $this->checkin_hour;
            $this->hotel_settings->check_in_min = $this->checkin_min;
            $this->hotel_settings->check_in_time = $this->checkin_time;
            $this->hotel_settings->save();
        } else {
            $this->hotel_settings = new TravelTourismSettings;
            $this->hotel_settings->travel_tourism_id = $this->hotel->id;
            $this->hotel_settings->check_in_hour = $this->checkin_hour;
            $this->hotel_settings->check_in_min = $this->checkin_min;
            $this->hotel_settings->check_in_time = $this->checkin_time;
            $this->hotel_settings->save();
        }
        $this->hotel_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
        $this->showLimitSuccessModal('Checkin time has been updated successfully');
    }

    public function updateCheckoutTime()
    {
        $this->validate(
            [
                'checkout_hour' => ['required', 'gt:00', 'lt:13'],
                'checkout_min' => ['required', 'gt:-01', 'lt:60'],
                'checkout_time' => ['required']
            ],
            [
                'checkout_hour.required' => "Check in hour is required",
                'checkout_hour.gt' => "Check in hour must be greater than 0",
                'checkout_hour.lt' => "Check in hour must be less than 13",
                'checkout_min.required' => "Check in minute is required",
                'checkout_min.gt' => "Check in minute must be greater than 0",
                'checkout_min.lt' => "Check in minute must be less than 60",
                'checkout_time.required' => "Please select a check in time",
            ]
        );
        if ($this->hotel_settings) {
            $this->hotel_settings->check_out_hour = $this->checkout_hour;
            $this->hotel_settings->check_out_min = $this->checkout_min;
            $this->hotel_settings->check_out_time = $this->checkout_time;
            $this->hotel_settings->save();
        } else {
            $this->hotel_settings = new TravelTourismSettings;
            $this->hotel_settings->travel_tourism_id = $this->hotel->id;
            $this->hotel_settings->check_out_hour = $this->checkout_hour;
            $this->hotel_settings->check_out_min = $this->checkout_min;
            $this->hotel_settings->check_out_time = $this->checkout_time;
            $this->hotel_settings->save();
        }
        $this->hotel_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
        $this->showLimitSuccessModal('Checkout time has been updated successfully');
    }

    public function updateBadge()
    {
        $this->validate(
            [
                'badge_point' => ['required', 'gt:24']
            ],
            [
                'badge_point.required' => "Field is required",
                'badge_point.gt' => " This point must be greater than 24"
            ]
        );

        $this->updateSetting(
            $this->badge_point,
            'badge_bonus_point',
            'Badge bonus point has been updated successfully'
        );
        $this->badge_point = '';
    }

    public function updateAddPoint()
    {
        $this->validate(
            [
                'add_point' => ['required', 'gt:24']
            ],
            [
                'add_point.required' => "Field is required",
                'add_point.gt' => " This point must be greater than 24"
            ]
        );
        $this->updateSetting(
            $this->add_point,
            'add_point',
            'Add point has been updated successfully'
        );
        $this->add_point = '';
    }

    public function updateGuest()
    {
        $this->validate(
            [
                'guest_point' => ['required', 'gt:24']
            ],
            [
                'guest_point.required' => "Field is required",
                'guest_point.gt' => " This point must be greater than 24"
            ]
        );

        $this->updateSetting(
            $this->guest_point,
            'guest_of_week_point',
            'Guest of week point has been updated successfully'
        );
        $this->guest_point = '';
    }

    public function updateDouble()
    {
        $this->validate(
            [
                'double_point' => ['required', 'gt:49']
            ],
            [
                'double_point.required' => "Field is required",
                'double_point.gt' => " This point must be greater than 49"
            ]
        );
        $this->updateSetting(
            $this->double_point,
            'double_booker_point',
            'Double booker point has been updated successfully'
        );
        $this->double_point = '';
    }

    public function updateTriple()
    {
        $this->validate(
            [
                'triple_point' => ['required', 'gt:74']
            ],
            [
                'triple_point.required' => "Field is required",
                'triple_point.gt' => "This point must be greater than 74"
            ]
        );

        $this->updateSetting(
            $this->triple_point,
            'triple_booker_point',
            'Triple booker point has been updated successfully'
        );
        $this->triple_point = '';
    }

    public function updateLocal()
    {
        $this->validate(
            [
                'local_point' => ['required', 'gt:199']
            ],
            [
                'local_point.required' => "Field is required",
                'local_point.gt' => " This point must be greater than 199"

            ]
        );

        $this->updateSetting(
            $this->local_point,
            'local_reward_point',
            'Live Like A Local Reward points has been updated successfully'
        );
        $this->local_point = '';
    }

    private function updateSetting($update_value, $field, $success_message)
    {
        if ($this->hotel_settings) {
            $this->hotel_settings->$field = $update_value;
            $this->hotel_settings->save();
            $this->hotel_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
            $this->showLimitSuccessModal($success_message);
        } else {
            $this->hotel_settings = new TravelTourismSettings;
            $this->hotel_settings->travel_tourism_id = $this->hotel->id;
            $this->hotel_settings->$field = $update_value;
            $this->hotel_settings->save();
            $this->hotel_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel->id)->first();
            $this->showLimitSuccessModal($success_message);
        }
    }

    public function showLimitSuccessModal($text)
    {
        $this->emit('limitSuccessModal', [
            'text'  => $text,
        ]);
    }
    public function hideLimitSuccessModal()
    {
        $this->emit('hideLimitSuccessModal');
    }

    public function multiplePhotoUpload($file){
        dd($file);
    }

    public function openFormEmails()
    {
        $this->email_count = 0;
        $this->emails = TravelTourismFormSubmitAddress::where('travel_tourism_id', $this->hotel->id)->first();
        if ($this->emails) {
            $this->fill($this->emails);
            if ($this->emails->first_email_address != null) {
                $this->email_count = $this->email_count + 1;
            }
            if ($this->emails->second_email_address != null) {
                $this->email_count = $this->email_count + 1;
            }
            if ($this->emails->third_email_address != null) {
                $this->email_count = $this->email_count + 1;
            }
            if ($this->emails->fourth_email_address != null) {
                $this->email_count = $this->email_count + 1;
            }
            if ($this->emails->fifth_email_address != null) {
                $this->email_count = $this->email_count + 1;
            }
        }

        $this->emit('openFromEmail');
    }

    public function addEditEmail()
    {
        if ($this->emails) {
            if (($this->first_email_address != null) || ($this->second_email_address != null) || ($this->third_email_address != null) ||
                ($this->fourth_email_address != null) || ($this->fifth_email_address != null)
            ) {
                // dd($this->first_email_address);
                if ($this->first_email_address != '') {
                    $this->validate(
                        [
                            'first_email_address' => ['email'],
                        ],
                        [
                            'first_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->first_email_address = $this->first_email_address;
                    $this->emails->save();
                } else {
                    $this->emails->first_email_address = '';
                    $this->emails->save();
                }
                if ($this->second_email_address != '') {
                    $this->validate(
                        [
                            'second_email_address' => ['email'],
                        ],
                        [
                            'second_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->second_email_address = $this->second_email_address;
                    $this->emails->save();
                } else {
                    $this->emails->second_email_address = '';
                    $this->emails->save();
                }
                if ($this->third_email_address != '') {
                    $this->validate(
                        [
                            'third_email_address' => ['email'],
                        ],
                        [
                            'third_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->third_email_address = $this->third_email_address;
                    $this->emails->save();
                } else {
                    $this->emails->third_email_address = '';
                    $this->emails->save();
                }
                if ($this->fourth_email_address != '') {
                    $this->validate(
                        [
                            'fourth_email_address' => ['email'],
                        ],
                        [
                            'fourth_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->fourth_email_address = $this->fourth_email_address;
                    $this->emails->save();
                } else {
                    $this->emails->fourth_email_address = '';
                    $this->emails->save();
                }
                if ($this->fifth_email_address != '') {
                    $this->validate(
                        [
                            'fifth_email_address' => ['email'],
                        ],
                        [
                            'fifth_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->fifth_email_address = $this->fifth_email_address;
                    $this->emails->save();
                } else {
                    $this->emails->fifth_email_address = '';
                    $this->emails->save();
                }
                $this->showExternalModal('Email Addresses has been updated successfully');
            } else {
                $this->emails->first_email_address = null;
                $this->emails->second_email_address = null;
                $this->emails->third_email_address = null;
                $this->emails->fourth_email_address = null;
                $this->emails->fifth_email_address = null;
                $this->emails->save();

                $this->showExternalModal('There are no Email addresses');
            }
        } else {
            $this->emails = new TravelTourismFormSubmitAddress;
            $this->emails->travel_tourism_id = $this->hotel->id;
            $this->emails->save();
            //dd($this->first_email_address);
            if (($this->first_email_address != null) || ($this->second_email_address != null) || ($this->third_email_address != null) ||
                ($this->fourth_email_address != null) || ($this->fifth_email_address != null)
            ) {
                if ($this->first_email_address != '') {
                    $this->validate(
                        [
                            'first_email_address' => ['email'],
                        ],
                        [
                            'first_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->first_email_address = $this->first_email_address;
                    $this->emails->save();
                }
                if ($this->second_email_address != '') {
                    $this->validate(
                        [
                            'second_email_address' => ['email'],
                        ],
                        [
                            'second_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->second_email_address = $this->second_email_address;
                    $this->emails->save();
                }
                if ($this->third_email_address != '') {
                    $this->validate(
                        [
                            'third_email_address' => ['email'],
                        ],
                        [
                            'third_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->third_email_address = $this->third_email_address;
                    $this->emails->save();
                }
                if ($this->fourth_email_address != '') {
                    $this->validate(
                        [
                            'fourth_email_address' => ['email'],
                        ],
                        [
                            'fourth_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->fourth_email_address = $this->fourth_email_address;
                    $this->emails->save();
                }
                if ($this->fifth_email_address != '') {
                    $this->validate(
                        [
                            'fifth_email_address' => ['email'],
                        ],
                        [
                            'fifth_email_address.email' => "Email address format is invalid",
                        ]
                    );
                    $this->emails->fifth_email_address = $this->fifth_email_address;
                    $this->emails->save();
                }
                $this->showExternalModal('Email Addresses has been updated successfully');
            } else {
                $this->showExternalModal('There is no Email addresses');
            }
        }
    }

    public function closeEmailAddressModal()
    {
        $this->resetForm();
        $this->emit('closeFromEmailAddress');
    }

    public function viewrequestInfo()
    {

        $this->emit('viewRequstInfo', ['name' => $this->hotel->name]);
    }

    public function openSetLocation()
    {
        $state = State::find($this->hotel->state_id);
        $this->state_name =  $state->name;
        $this->state_id =   $this->hotel->state_id;
        $this->city =   $this->hotel->city;
        $this->zip_code =   $this->hotel->zip_code;
        $this->lat = $this->hotel->lat;
        $this->long = $this->hotel->long;
        $this->address = $this->hotel->address;
        //dd($this->address);
        $this->emit('openSetLocation', ['lat' => $this->lat, 'long' => $this->long]);
    }


    public function updateLocation()
    {
        $this->validate(
            [
                'address' => ['required'],
            ],
            [
                'address.required' => "Address field is required",
            ]
        );
        $state = State::where('name', $this->state_name)->first();
        //dd($state );
        if ($state) {
            $this->state_id = $state->id;
            // $shortList = $this->hotel;
            $this->hotel->address = $this->address;
            $this->hotel->city = $this->city;
            $this->hotel->zip_code = $this->zip_code;
            $this->hotel->state_id = $this->state_id;
            $this->hotel->lat = $this->lat;
            $this->hotel->long = $this->long;
            $this->hotel->save();
            $this->external_manage->location_display = true;
            $this->external_manage->save();
            $this->showExternalModal('Hotel Location has been updated successfully');
        }
    }

    public function editHotelDescription(){
        if($this->edit_text == 'Edit'){
            $this->is_readonly = '';
            $this->edit_text = 'Update';
        }
        else{
            $this->is_readonly = 'readonly';
            $this->edit_text = 'Edit';
            $this->hotel->description = $this->description;
            $this->hotel->save();
        }
        
    }

    public function updateLimitSettings($type){
        if($this->hotel_id){
            // if($type == 'current_allowance'){
            //     $this->validate(
            //         [
            //             'current_point' => ['required','gt:99'],
            //         ],
            //         [
            //             'current_point.required' => "Field is required",
            //             'current_point.gt' => "Point must be greater than or equal 100"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->hotel_id)->first();
            //     if($limit_settings){
            //         $limit_settings->current_allowance_point_limit = $this->current_point;
            //         $limit_settings->save();
            //         $this->current_point="";
            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->current_allowance_point_limit = $this->current_point;
            //         $limit_settings->property_id = $this->hotel_id;
            //         $limit_settings->save();
            //         $this->current_point="";
            //     }
            // }
            if($type == 'signup_bonus'){
                $this->validate(
                    [
                        'signup_point' => ['required','gt:99'],
                    ],
                    [
                        'signup_point.required' => "Field is required",
                        'signup_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                if($limit_settings){
                    $limit_settings->badge_bonus_point = $this->signup_point;
                    $limit_settings->save();
                    $this->signup_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->sign_up_bonus_point = $this->signup_point;
                    $limit_settings->travel_tourism_id = $this->hotel_id;
                    $limit_settings->save();
                    $this->signup_point="";
                }
            }
            elseif($type == 'low_point'){
                $this->validate(
                    [
                        'low_point' => ['required','gt:99'],
                    ],
                    [
                        'low_point.required' => "Field is required",
                        'low_point.gt' => "Point must be greater than or equal 100"
                    ]
                );
                $limit_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                if($limit_settings){
                    $limit_settings->low_point_balance = $this->low_point;
                    $limit_settings->save();
                    $this->low_point="";

                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->low_point_balance = $this->low_point;
                    $limit_settings->travel_tourism_id = $this->hotel_id;
                    $limit_settings->save();
                    $this->low_point="";
                }
            }
            elseif($type == 'add_point'){
                $this->validate(
                    [
                        'add_point' => ['required','gt:24'],
                    ],
                    [
                        'add_point.required' => "Field is required",
                        'add_point.gt' => "Point must be greater than or equal 25"
                    ]
                );
                $limit_settings = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();
                if($limit_settings){
                    $limit_settings->add_point = $this->add_point;
                    $limit_settings->save();
                    $this->add_point="";
                }
                else{
                    $limit_settings = new ProviderLimitSetting;
                    $limit_settings->add_point = $this->add_point;
                    $limit_settings->travel_tourism_id = $this->hotel_id;
                    $limit_settings->save();
                    $this->add_point=null;
                }
            }
            // elseif($type == 'tenant_Reward'){
            //     $this->validate(
            //         [
            //             'tenant_point' => ['required','gt:99'],
            //         ],
            //         [
            //             'tenant_point.required' => "Field is required",
            //             'tenant_point.gt' => "Point must be greater than or equal 100"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->hotel_id)->first();
            //     if($limit_settings){
            //         $limit_settings->tenant_of_the_month_Reward = $this->tenant_point;
            //         $limit_settings->save();
            //         $this->tenant_point=null;

            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->tenant_of_the_month_Reward = $this->tenant_point;
            //         $limit_settings->property_id = $this->hotel_id;
            //         $limit_settings->save();
            //         $this->hotel_id="";
            //     }
            // }
            // elseif($type == 'inspection_Reward'){
            //     $this->validate(
            //         [
            //             'inspection_point' => ['required','gt:99'],
            //         ],
            //         [
            //             'inspection_point.required' => "Field is required",
            //             'inspection_point.gt' => "Point must be greater than or equal 100"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->hotel_id)->first();
            //     if($limit_settings){
            //         $limit_settings->pass_inspection_reward = $this->inspection_point;
            //         $limit_settings->save();
            //         $this->inspection_point="";

            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->pass_inspection_reward = $this->inspection_point;
            //         $limit_settings->property_id = $this->hotel_id;
            //         $limit_settings->save();
            //         $this->inspection_point="";
            //     }
            // }
            // elseif($type == 'great_tenant'){
            //     $this->validate(
            //         [
            //             'great_tenant_point' => ['required','gt:49'],
            //         ],
            //         [
            //             'great_tenant_point.required' => "Field is required",
            //             'great_tenant_point.gt' => "Point must be greater than or equal 50"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->hotel_id)->first();
            //     if($limit_settings){
            //         $limit_settings->great_tenant_reward = $this->great_tenant_point;
            //         $limit_settings->save();
            //         $this->great_tenant_point="";

            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->great_tenant_reward = $this->great_tenant_point;
            //         $limit_settings->property_id = $this->hotel_id;
            //         $limit_settings->save();
            //         $this->great_tenant_point="";
            //     }
            // }
            // elseif($type == 'community_helper'){
            //     $this->validate(
            //         [
            //             'helper_point' => ['required','gt:49'],
            //         ],
            //         [
            //             'helper_point.required' => "Field is required",
            //             'helper_point.gt' => "Point must be greater than or equal 50"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
            //     if($limit_settings){
            //         $limit_settings->community_helper_reward = $this->helper_point;
            //         $limit_settings->save();
            //         $this->helper_point="";
            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->community_helper_reward = $this->helper_point;
            //         $limit_settings->property_id = $this->propertyid;
            //         $limit_settings->save();
            //         $this->helper_point="";
            //     }
            // }
            // elseif($type == 'good_samaritan'){
            //     $this->validate(
            //         [
            //             'samaritan_point' => ['required','gt:49'],
            //         ],
            //         [
            //             'samaritan_point.required' => "Field is required",
            //             'samaritan_point.gt' => "Point must be greater than or equal 50"
            //         ]
            //     );
            //     $limit_settings = ProviderLimitSetting::where('property_id',$this->propertyid)->first();
            //     if($limit_settings){
            //         $limit_settings->good_samaritan_reward = $this->samaritan_point;
                    
            //         $limit_settings->save();
            //         $this->samaritan_point="";
                   


            //     }
            //     else{
            //         $limit_settings = new ProviderLimitSetting;
            //         $limit_settings->good_samaritan_reward = $this->samaritan_point;
            //         $limit_settings->property_id = $this->propertyid;
            //         $limit_settings->save();
            //         $this->samaritan_point="";

            //     }
            // }
            $this->property_limit = TravelTourismSettings::where('travel_tourism_id', $this->hotel_id)->first();

        }
    }

    public function showQrCode(){
        if($this->travel_tourism->qr_code_png == null){
            $encode_id = base64_encode($this->hotel->id);
            $text = url('short-term-rental/'.$encode_id );
            
            $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($text);
            $encodeimage = base64_encode($image);
            // dd($image);
            $this->emit('openQrCode',['png'=>$encodeimage]);
            
        }
    }
    public function searchBuilding(){
        if(!empty($this->search_building)){
            
            $this->buildingResult = HotelBuildings::where('status',1)
                                ->where('building_name','like','%'.trim($this->search_building).'%')
                                ->orderBy('id','desc')
                                ->get();
                
            $this->buildingShowdiv = true;
        }
        else{
            $this->buildingShowdiv = false;
        }
    }
    public function autocompleteBuildingSelect($id){
        // dd($id);
        $this->selected_building_id = $id;
        
        
        $listBuilding = HotelBuildings::find($id);
        if($listBuilding->building_name != null){
            $this->selected_building_name = $listBuilding->building_name;
        }
        else{
            $this->selected_building_name = '---';
        }

        $this->search_building = $listBuilding->building_name;
        $this->buildingShowdiv = false;

        $unit_available_check = HotelUnites::where('building_id',$id)->where('status',1)->first();
        if(!isset($unit_available_check->id)){
                
                $this->emit('openQrSuccess',['text'=>'No Unit available on '.$listBuilding->building_name]);
                $this->search_building= '';
        }
    }  

    public function select_building(){
        // dd($this->search_building);
    }


    public function searchListing(){
        // dd($this->search_building);
        if($this->search_building == ''){
            $this->emit('openQrSuccess',['text'=>'Please select the building first.']);
        }elseif($this->search_building == 'all'){
            $this->emit('openQrSuccess',['text'=>'Please select the building first.']);
        }else{
            if(!empty($this->search_listing)){
            
                $this->result = HotelUnites::where('status',1)
                                    ->where('unit_name','like','%'.trim($this->search_listing).'%')
                                    ->where('building_id',$this->search_building)
                                    ->orderBy('id','desc')
                                    ->get();
                                                  
                    
                $this->showdiv = true;
            }
            else{
                $this->showdiv = false;
            }
        }
        
    }

    public function autocompleteListingSelect($id){
        // if(empty($this->result)){
        //     $this->emit('openQrSuccess',['text'=>'No Unit available on this building now.']);
        // }
        $listing = HotelUnites::find($id);
        if($listing->unit_name != null){
            $this->selected_listing_name = $listing->unit_name;
        }
        else{
            $this->selected_listing_name = '---';
        }
        
        // $this->selected_listing_city = $listing->city;
        // $this->selected_listing_state = $listing->states->name;
        $this->hotel_name = $this->hotel->name;
        $this->search_listing = $listing->unit_name;
        $this->showdiv = false;
        $encode_id = base64_encode($id);
        $this->text = url('hotel-resorts/'.$encode_id );
            
        $image = QrCode::format('png')
                         ->size(500)
                         ->errorCorrection('H')
                         ->generate($this->text);
        $this->qr_image = base64_encode($image);
    }

    public function resetListing(){
        $this->selected_listing_city = '--';
        $this->selected_listing_state = '--';
        $this->search_listing = '';
        $this->selected_listing_name = '---';
        $this->qr_image = '';
        $this->hotel_name = '';
        $this->showdiv = false;
    }

    public function resetBuilding(){
        $this->search_listing = '';
        $this->selected_building_name = '';
        $this->search_building = '';
    }

    public function hide_qr_success_model()
    {
        $this->search_listing = '';
        $this->emit('hide_qr_success_model');
    }
    public function render()
    {
        return view('livewire.frontend.travel-tourism.hotel-resort.setting');
    }
}
