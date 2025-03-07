<?php

namespace App\Http\Livewire\Frontend\TravelTourism\ShortTermRental;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\ListingType;
use App\Models\ShortTermRentalListing;
use App\Models\State;
use App\Models\TravelTourism;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\MediaLibrary\Models\Media;
use App\Models\ProviderExternalManage;
use App\Models\TravelTourismFormSubmitAddress;
use App\Models\ProviderAmenity;
use App\Models\ProviderFeature;
use App\Models\User;

class ShortTermRentalDashboard extends Component
{

    use AlertMessage;
    use WithFileUploads;
    use WithPagination;
    public $is_modal_open = false, $is_add_model_open = false, $is_success_modal = false, $is_deactivate_modal = false, $user, $shortTerm, $listing, $shortlisting, $change_status;
    public $name, $street_address, $room_number, $city, $state_id, $state, $no_of_bedrooms, $no_of_baths, $no_of_half_baths, $no_of_guests, $type_id, $zip_code, $description, $model_images, $model_video, $main_image, $listing_images, $listing_video, $listing_id, $stateList, $is_check = false;
    public $mediaImg, $list_img, $state_name, $lat, $long, $emails, $created_password;
    public $searchListing, $result, $searchName, $first_email_address, $second_email_address, $third_email_address, $fourth_email_address, $fifth_email_address;
    public $search = '', $external_manage, $book_online, $book_online_check, $request_info_check, $guest_portal, $guest_portal_check, $location_check, $direct_website_check, $direct_website;
    public $features = [], $amenities = [], $provider_feature, $feature_id, $provider_amenity, $amenity_id;
    public $new_password, $confirm_password, $email_count = 0, $travel_tourism, $add_main_image, $main_photo;
    public $uploaded_images = [], $photo, $listing_videos;

    protected $listeners = [
        'refreshProducts' => '$refresh', 'openListingModal', 'hideModal', 'openAddModal', 'hideListModal',
        'openDeactivateModal', 'hideStatusModal', 'yesDeactivate', 'openEditModal', 'hideEditModal', 'deleteEditListPhoto',
        'hideConfirmModal', 'imageDeleteConfirm', 'searchList', 'mediaDeleteConfirm', 'checkState', 'featureDeleteConfirm', 'amenityDeleteConfirm'
    ];

    public function mount()
    {
        $this->user = Auth::user();
        $this->shortTerm = $this->user->travelType;
        $this->travel_tourism = TravelTourism::find($this->shortTerm->id);
        $this->listing = ListingType::where('status', 1)->get();
        $this->shortlisting = ShortTermRentalListing::where('travel_tourism_id', $this->shortTerm->id)->orderBy('id', 'desc')->get();
        $this->stateList = State::get();
        $this->is_check = true;
        $this->lat = '';
        $this->long = '';
        $this->created_password = Auth::user()->created_password;
        //dd($this->encoded_listing_id);
        //dd($this->lat);

    }

    public function updatedPhoto()
    {
        // dd($this->photo);
        if ($this->photo) {
            $this->validate([
                'photo.*' => 'image|max:25600', // 25MB Max
            ]);
            foreach ($this->photo as $photos) {
                array_push($this->uploaded_images, $photos);
            }
        }
        //dd($this->uploaded_images);

    }

    public function photoMakeMain($id)
    {
        if (count($this->uploaded_images) > 0) {
            foreach ($this->uploaded_images as $key => $images) {
                if ($key == $id) {
                    $this->add_main_image =  $images;
                    $this->main_photo =  $images;
                }
            }
        }
    }

    public function deleteAddMainPhoto()
    {
        if ($this->add_main_image) {
            $this->add_main_image = '';
            $this->main_photo =  '';
        }
    }

    public function photoDelete($id)
    {
        if (count($this->uploaded_images) > 0) {
            foreach ($this->uploaded_images as $key => $images) {
                if ($key == $id) {
                    if ($images == $this->add_main_image) {
                        $this->add_main_image = '';
                        $this->main_photo =  '';
                    }
                    unset($this->uploaded_images[$key]);
                }
            }
        }
    }

    public function updatedListingVideo()
    {
        // dd($this->photo);
        if ($this->listing_video) {
            $this->validate([
                'listing_video' => 'max:25600', // 25MB Max
            ]);
        }
        //dd($this->uploaded_images);

    }

    public function deleteAddMedia()
    {
        $this->listing_video = '';
    }

    public function updatedListingImages()
    {
        // dd($this->photo);
        if ($this->listing_images) {
            $this->validate([
                'listing_images.*' => 'image|max:25600', // 25MB Max
            ]);
            foreach ($this->listing_images as $photos) {
                $getList = ShortTermRentalListing::find($this->listing_id);
                $getList->addMedia($photos->getRealPath())
                    ->usingName($photos->getClientOriginalName())
                    ->toMediaCollection('ShortTermListingImages');
                // array_push($this->uploaded_images,$photos);
            }
            $this->model_images = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingImages'])->get();
        }
        //dd($this->model_images);

    }

    public function updatedListingVideos()
    {
        if ($this->listing_videos) {
            $getList = ShortTermRentalListing::find($this->listing_id);
            if ($this->listing_videos != 'string') {
                $model_video = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();
                if ($model_video) {
                    $model_video->delete();
                    $getList->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('ShortTermListingVideo');
                } else {
                    $getList->addMedia($this->listing_videos->getRealPath())
                        ->usingName($this->listing_videos->getClientOriginalName())
                        ->toMediaCollection('ShortTermListingVideo');
                }
            }
        }
        $this->model_video = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();
    }

    public function changeUserPassword()
    {
        $this->validate(
            [
                'new_password' => ['required', 'min:8'],
                'confirm_password' => ['required', 'same:new_password', 'min:8'],
            ],
            [
                'new_password.required' => "New Password field is required",
                'new_password.required' => "New Password must be at least 8 characters",
                'confirm_password.required' => "Confirm Password field is required",
                'confirm_password.same' => "New password and Confirm Password should be same",
                'confirm_password.min' => "Confirm Password must be at least 8 characters",
            ]
        );
        $user = User::find(Auth::user()->id);
        $user->created_password = null;
        $user->password = $this->new_password;
        $user->save();

        $msgAction = 'New Password has been updated successfully';
        $this->showToastr("success", $msgAction);
        return redirect()->route('frontend.short_term.dashboard');
    }

    public function openListingModal()
    {

        $this->emit('openManageList');
        // $this->is_modal_open = true;
    }

    public function hideModal()
    {
        $this->is_modal_open = false;
        $this->resetForm();
    }

    public function hideListModal()
    {

        $this->emit('closeAddManage');
        // $this->is_add_model_open = false;
        $this->resetForm();
    }

    public function openAddModal()
    {
        // dd(123);
        // $this->resetForm();
        $this->emit('openAddManage');
        // $this->is_add_model_open = true;
    }



    public function addShortListing()
    {

        // dd($this->add_main_image);
        $this->validate(
            [
                'name' => ['required'],
                'street_address' => ['required'],
                'room_number' => ['nullable'],
                'city' => ['required'],
                'state_id' => ['required'],
                // 'state' => ['required'],
                'no_of_bedrooms' => ['required'],
                'no_of_baths' => ['required'],
                'no_of_half_baths' => ['nullable'],
                'no_of_guests' => ['required'],
                'type_id' => ['required'],
                'zip_code' => ['required'],
                'description' => ['nullable'],
                'uploaded_images.*' => ['nullable', 'mimes:jpg,jpeg,png,svg'],
                'listing_video' => ['nullable', 'mimes:mp4'],
                'add_main_image' => ['nullable'],
            ],
            [
                'name.required' => "The name field is required",
                'state_id.required' => "The state field is required",
                'type_id.required' => "The listing type field is required",
                'uploaded_images.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg",
                'listing_video.mimes' => "The Upload File must be a file type of:mp4",
            ]
        );

        $shortTerm = $this->user->travelType;
        if ($shortTerm) {
            $shortTermList = new ShortTermRentalListing();
            $shortTermList->travel_tourism_id = $shortTerm->id;
            $shortTermList->type_id = $this->type_id;
            $shortTermList->name = $this->name;
            $shortTermList->street_address = $this->street_address;
            $shortTermList->room_number = $this->room_number;
            $shortTermList->city = $this->city;
            $shortTermList->zip_code = $this->zip_code;
            $shortTermList->state_id = $this->state_id;
            $shortTermList->description = $this->description;
            $shortTermList->no_of_bedrooms = $this->no_of_bedrooms;
            $shortTermList->no_of_baths = $this->no_of_baths;
            $shortTermList->no_of_half_baths = $this->no_of_half_baths;
            $shortTermList->no_of_guests = $this->no_of_guests;
            $shortTermList->lat = $this->lat;
            $shortTermList->long = $this->long;
            $shortTermList->status = 1;
            $shortTermList->save();

            if ($this->uploaded_images) {
                foreach ($this->uploaded_images as $photo) {
                    if ($this->add_main_image != '') {
                        if ($this->add_main_image == $photo) {
                            $media = $shortTermList->addMedia($photo->getRealPath())
                                ->usingName($photo->getClientOriginalName())
                                ->toMediaCollection('ShortTermListingImages');
                            $shortTermList->main_image = $media->geturl();
                            $shortTermList->save();
                            $this->add_main_image = '';
                            $this->main_photo =  '';
                        } else {
                            $shortTermList->addMedia($photo->getRealPath())
                                ->usingName($photo->getClientOriginalName())
                                ->toMediaCollection('ShortTermListingImages');
                        }
                    } else {
                        $shortTermList->addMedia($photo->getRealPath())
                            ->usingName($photo->getClientOriginalName())
                            ->toMediaCollection('ShortTermListingImages');
                    }
                }
            }
            unset($this->uploaded_images);
            if ($this->listing_video) {
                if ($this->listing_video != 'string') {
                    // $name = time() . rand(1, 100) . '.' . $this->listing_video->extension();
                    // $path = $this->listing_video->storeAs('public/listing_video', $name);
                    // $shortTermList->listing_video = 'listing_video/' . $name;
                    // $shortTermList->save();

                    $shortTermList->addMedia($this->listing_video->getRealPath())
                        ->usingName($this->listing_video->getClientOriginalName())
                        ->toMediaCollection('ShortTermListingVideo');
                }
            }
            $this->shortlisting = ShortTermRentalListing::where('travel_tourism_id', $this->shortTerm->id)->orderBy('id', 'desc')->get();
            $this->showSuccessModal('Listing has been added successfully');
        }
    }
    public function openDeactivateModal($id)
    {

        $listing = ShortTermRentalListing::find($id);
        if ($listing) {
            $this->listing_id = $listing->id;
            $this->emit('showDeactivateModal', [
                'listing_id' => $id
            ]);


            // $this->is_deactivate_modal = true;
        }
    }

    public function yesDeactivate()
    {

        $shortTerm = $this->user->travelType;
        $shortList = ShortTermRentalListing::find($this->listing_id);
        if ($shortList) {
            $shortList->status = 0;
            $shortList->save();
            $this->showSuccessModal('Listing has been deactivated successfully');
        }
    }

    public function activateList($id)
    {
        $shortList = ShortTermRentalListing::find($id);
        if ($shortList) {
            $shortList->status = 1;
            $shortList->save();
            $this->showSuccessModal('Listing has been activated successfully');
        }
    }
    public function hideStatusModal()
    {
        $this->is_deactivate_modal = false;
    }

    public function openEditModal($id)
    {
        $editlListing = ShortTermRentalListing::find($id);
        if ($editlListing) {
            $this->listing_id = $editlListing->id;
            $this->fill($editlListing);
            $this->lat = $editlListing->lat;
            $this->long = $editlListing->long;
            $this->model_images = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingImages'])->get();
            $this->model_video = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();

            $this->main_image = $editlListing->main_image;

            // url($photo->getUrl())
            // dd($this->model_video);
            $this->emit('showEditModal', [
                'listing_id' => $id
            ]);
            // $this->is_deactivate_modal = true;
        }
    }
    public function updateShortListing()
    {
        // dd($this->listing_images);
        $this->validate(
            [
                'name' => ['required'],
                'street_address' => ['required'],
                'room_number' => ['nullable'],
                'city' => ['required'],
                'state_id' => ['required'],
                // 'state' => ['required'],
                'no_of_bedrooms' => ['required'],
                'no_of_baths' => ['required'],
                'no_of_half_baths' => ['nullable'],
                'no_of_guests' => ['required'],
                'type_id' => ['required'],
                'zip_code' => ['required'],
                'description' => ['nullable'],


            ],
            [
                'name.required' => "The name field is required",
                'state_id.required' => "The state field is required",
                'type_id.required' => "The listing type field is required",

            ]
        );
        //   dd($this->listing_video);
        $shortTerm = $this->user->travelType;
        $getList = ShortTermRentalListing::find($this->listing_id);
        $listing = ShortTermRentalListing::where('id', $this->listing_id)->update([
            'travel_tourism_id' => $shortTerm->id,
            'type_id' => $this->type_id,
            'name' => $this->name,
            'street_address' => $this->street_address,
            'room_number' => $this->room_number,
            'city' => $this->city,
            'state_id' => $this->state_id,
            'no_of_bedrooms' => $this->no_of_bedrooms,
            'no_of_baths' => $this->no_of_baths,
            'no_of_half_baths' => $this->no_of_half_baths,
            'no_of_guests' => $this->no_of_guests,
            'zip_code' => $this->zip_code,
            'description' => $this->description
        ]);
        // if ($this->listing_images) {
        //     foreach ($this->listing_images as $photo) {

        //         $getList->addMedia($photo->getRealPath())
        //             ->usingName($photo->getClientOriginalName())
        //             ->toMediaCollection('ShortTermListingImages');
        //     }
        // }
        if ($this->listing_video) {
            if ($this->listing_video != 'string') {
                $model_video = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();
                if ($model_video) {
                    $model_video->delete();
                    $getList->addMedia($this->listing_video->getRealPath())
                        ->usingName($this->listing_video->getClientOriginalName())
                        ->toMediaCollection('ShortTermListingVideo');
                } else {
                    $getList->addMedia($this->listing_video->getRealPath())
                        ->usingName($this->listing_video->getClientOriginalName())
                        ->toMediaCollection('ShortTermListingVideo');
                }
            }
        }
        $this->showSuccessModal('Listing has been updated successfully');
    }

    public function hideEditModal()
    {
        // dd(123);
        // $this->name = '';
        // $this->type_id = '';
        // $this->street_address = '';
        // $this->room_number = '';
        // $this->city = '';
        // $this->state_id = '';
        // $this->no_of_bedrooms = '';
        // $this->no_of_baths = '';
        // $this->no_of_half_baths = '';
        // $this->no_of_guests = '';
        // $this->zip_code = '';
        // $this->description = '';
        // $this->listing_images = '';
        // $this->listing_videos = '';
        $this->emit('closeEditManage');
        // $this->is_add_model_open = false;
        $this->resetForm();
    }


    public function deleteEditListPhoto($image_id)
    {

        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this image!", 'Yes, delete!', 'imageDeleteConfirm', ['id' => $image_id]); //($type,$title,$text,$confirmText,$method)

    }

    public function imageDeleteConfirm($id)
    {

        $getmediaImg = Media::find($id);
        // dd($getmediaImg[0]->getUrl());
        $shortList = ShortTermRentalListing::find($this->listing_id);
        if ($shortList->main_image == $getmediaImg[0]->getUrl()) {
            $shortList->main_image = '';
            $shortList->save();
            $this->main_image = '';
        }
        Media::destroy($id);
        $this->model_images = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingImages'])->get();
    }



    public function makeEditMainPhoto($image_id)
    {

        $mediaImg = Media::find($image_id);
        if ($mediaImg) {
            $url = $mediaImg->getUrl();
            $shortList = ShortTermRentalListing::find($this->listing_id);
            if ($shortList) {
                $shortList->main_image = $url;
                $shortList->save();
            }
            $this->reset('main_image');
            $this->main_image = $url;
            //    $mediaImg->delete();
            //    $this->showSuccessModal('Listing Main Photo has been updated successfully');
        }
    }

    public function deleteEditMainPhoto($image_id)
    {
        //dd($image_id);
        $shortMainImg = ShortTermRentalListing::find($image_id);
        // dd($shortMainImg);
        if ($shortMainImg) {
            $shortMainImg->main_image = null;
            $shortMainImg->save();
            $this->reset('main_image');
        }
    }

    public function showSuccessModal($text)
    {
        $this->emit('successModal', [
            'text'  => $text,
        ]);
    }
    public function showFeatureSuccessModal($text)
    {
        $this->emit('featureSuccessModal', [
            'text'  => $text,
        ]);
    }
    public function hideSuccessModal()
    {
        $this->emit('hidesuccessModal');
    }
    public function hideFeatureSuccessModal()
    {
        $this->emit('hidefeaturesuccessModal');
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

    private function resetForm()
    {
        $this->resetErrorBag();
    }
    public function resetSearch()
    {
        $this->searchName = "";
    }
    public function searchList()
    {

        $shortLIst = ShortTermRentalListing::query();
        if ($this->searchName) {
            $shortLIst->Where('name', 'like', '%' . trim($this->searchName) . '%');
        }
        $this->shortlisting = $shortLIst->get();
        $this->resetPage();
    }

    public function deleteEditMedia()
    {

        $this->showConfirmation("warning", 'Are you sure?', "You won't be able to recover this media!", 'Yes, delete!', 'mediaDeleteConfirm', ['listing_id' => $this->listing_id]); //($type,$title,$text,$confirmText,$method)

    }

    public function mediaDeleteConfirm($listing_id)
    {
        //dd($listing_id);
        $video = Media::where(['model_id' => $listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();
        if ($video) {
            $video->delete();
        }
        $this->model_video = Media::where(['model_id' => $this->listing_id, 'collection_name' => 'ShortTermListingVideo'])->first();
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
        $this->external_manage = ProviderExternalManage::where('travel_tourism_id', $this->shortTerm->id)->where('listing_id', $this->listing_id)->first();
        if ($this->external_manage) {
            $this->external_manage = $this->external_manage;
        } else {
            $this->external_manage = new ProviderExternalManage;
            $this->external_manage->travel_tourism_id = $this->shortTerm->id;
            $this->external_manage->listing_id = $this->listing_id;
            $this->external_manage->save();
        }
        $this->book_online = $this->external_manage->book_online_url;
        $this->book_online_check = $this->external_manage->book_online_display;
        $this->request_info_check = $this->external_manage->request_info_display;
        $this->guest_portal = $this->external_manage->guest_portal_url;
        $this->guest_portal_check = $this->external_manage->guest_portal_display;
        $this->location_check = $this->external_manage->location_display;
        $this->direct_website = $this->external_manage->visit_website_url;
        $this->direct_website_check = $this->external_manage->visit_website_display;
        $this->emit(
            'openExternalLinkModal',
            [
                'listing_name'  => $this->name,
                'address' => $address,
            ]
        );
    }

    public function updateExternalLink()
    {
        //dd($this->book_online_check);
        if ($this->external_manage != '') {
            if (($this->book_online != null) || ($this->book_online_check != 0) || ($this->request_info_check != 0) ||
                ($this->guest_portal != null) || ($this->guest_portal_check != 0) || ($this->location_check != 0) || ($this->direct_website != null)
                || ($this->direct_website_check  != 0)
            ) {

                if ($this->book_online != null) {
                    $this->validate(
                        [
                            'book_online' => ['url'],
                        ],
                        [
                            'book_online.url' => "Book Online Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );
                    $this->external_manage->book_online_url = $this->book_online;
                    $this->external_manage->save();
                } else {
                    $this->external_manage->book_online_url = null;
                    $this->external_manage->save();
                }
                if ($this->book_online_check == true) {
                    if ($this->external_manage->book_online_url != null) {
                        $this->external_manage->book_online_display = true;
                        $this->external_manage->save();
                    } else {
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
                        $this->external_manage->save();
                    }
                } else {
                    $this->external_manage->book_online_display = false;
                    $this->external_manage->save();
                }
                if ($this->request_info_check == true) {
                    $this->external_manage->request_info_display = true;
                    $this->external_manage->save();
                } else {
                    $this->external_manage->request_info_display = false;
                    $this->external_manage->save();
                }
                // dd($this->guest_portal);
                if ($this->guest_portal != null) {
                    $this->validate(
                        [
                            'guest_portal' => ['url'],
                        ],
                        [
                            'guest_portal.url' => "Guest Portal Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );
                    $this->external_manage->guest_portal_url = $this->guest_portal;
                    $this->external_manage->save();
                } else {
                    $this->external_manage->guest_portal_url = null;
                    $this->external_manage->save();
                }
                if ($this->guest_portal_check == true) {

                    if ($this->external_manage->guest_portal_url != null) {
                        $this->external_manage->guest_portal_display = true;
                        $this->external_manage->save();
                    } else {
                        //dd($this->external_manage->guest_portal_url);
                        $this->validate(
                            [
                                'guest_portal' => ['required', 'url'],
                            ],
                            [
                                'guest_portal.required' => "The Guest Portal Url field is required when Display is true.",
                                'guest_portal.url' => "Guest Portal Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                            ]
                        );
                        $this->external_manage->guest_portal_url = $this->guest_portal;
                        $this->external_manage->save();
                    }
                } else {
                    $this->external_manage->guest_portal_display = false;
                    $this->external_manage->save();
                }
                if ($this->location_check == true) {
                    $this->external_manage->location_display = true;
                    $this->external_manage->save();
                } else {
                    $this->external_manage->location_display = false;
                    $this->external_manage->save();
                }
                if ($this->direct_website != null) {
                    $this->validate(
                        [
                            'direct_website' => ['url'],
                        ],
                        [
                            'direct_website.url' => "Website Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                        ]
                    );
                    $this->external_manage->visit_website_url = $this->direct_website;
                    $this->external_manage->save();
                } else {
                    $this->external_manage->visit_website_url = null;
                    $this->external_manage->save();
                }
                if ($this->direct_website_check == true) {
                    if ($this->external_manage->visit_website_url != null) {
                        $this->external_manage->visit_website_display = true;
                        $this->external_manage->save();
                    } else {
                        $this->validate(
                            [
                                'direct_website' => ['required', 'url'],
                            ],
                            [
                                'direct_website.required' => "The Website Url field is required when Display is true.",
                                'direct_website.url' => "Website Url format is invalid. Include http:// or https:// in front of URL, whichever is applicable",
                            ]
                        );
                        $this->external_manage->visit_website_url = $this->direct_website;
                        $this->external_manage->save();
                    }
                } else {
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

    public function openSetLocation()
    {
        $shortList = ShortTermRentalListing::find($this->listing_id);
        $this->state_name =  $shortList->state_name;
        $this->state_id =  $shortList->state_id;
        $this->lat = $shortList->lat;
        $this->long = $shortList->long;
        $this->emit('openSetLocation', ['lat' => $this->lat, 'long' => $this->long]);
    }

    public function checkState($statename)
    {
        if ($statename) {
            $state = State::where('name', $this->state_name)->first();
            if ($state) {
                $this->state_id = $state->id;
            } else {
                $this->state_id = '';
            }
        }
    }

    public function updateLocation()
    {
        $this->validate(
            [
                'street_address' => ['required'],
                'zip_code' => ['required'],
                'city' => ['required'],
                'state_name' => ['required'],
                'state_id'  => ['required'],
            ],
            [
                'street_address.required' => "Address field is required",
                'zip_code.required' => "Zip Code field is required",
                'city.required' => "City field is required",
                'state_name.required' => "State field is required",
                'state_id.required' => "State is not valid",
            ]
        );
        $state = State::where('name', $this->state_name)->first();
        //dd($state );
        if ($state) {
            $this->state_id = $state->id;
            $shortList = ShortTermRentalListing::find($this->listing_id);
            $shortList->street_address = $this->street_address;
            $shortList->city = $this->city;
            $shortList->zip_code = $this->zip_code;
            $shortList->state_id = $this->state_id;
            $shortList->lat = $this->lat;
            $shortList->long = $this->long;
            $shortList->save();
            $this->showExternalModal('Listing Location has been updated successfully');
        }
    }

    public function openFormEmails()
    {
        $this->email_count = 0;
        $this->emails = TravelTourismFormSubmitAddress::where('listing_id', $this->listing_id)->first();
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
            $this->emails->listing_id = $this->listing_id;
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

        $this->emit('viewRequstInfo', ['name' => $this->travel_tourism->name]);
    }

    public function featureView()
    {
        $this->features = ProviderFeature::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->emit('featureList');
    }

    public function amenityView()
    {
        $this->features = ProviderFeature::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->amenities = ProviderAmenity::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->emit('amenityList');
    }

    public function featureManage()
    {
        $this->features = ProviderFeature::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->provider_feature = '';
        $this->feature_id = '';
        $this->emit('featureManageOpen');
    }

    public function editFeature($featureid)
    {
        $feature = ProviderFeature::find($featureid);
        if ($feature) {
            $this->provider_feature = $feature->feature_text;
            $this->feature_id = $feature->id;
            //dd($this->provider_feature);
            $this->emit('featureManageOpen');
        }
    }

    public function updateFeature()
    {
        $this->validate(
            [
                'provider_feature' => ['required'],
            ],
            [
                'provider_feature.required' => "Feature field is required",
            ]
        );
        if ($this->feature_id != '') {
            $feature = ProviderFeature::find($this->feature_id);
            if ($feature) {
                $feature->feature_text = $this->provider_feature;
                $feature->save();
            }
            $this->provider_feature = '';
            $this->feature_id = '';
            $this->resetForm();
            $this->features = ProviderFeature::where('listing_id', $this->listing_id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been updated successfully');
        } else {
            $feature = new ProviderFeature;
            $feature->listing_id = $this->listing_id;
            $feature->feature_text = $this->provider_feature;
            $feature->status = true;
            $feature->save();
            $this->resetForm();
            $this->features = ProviderFeature::where('listing_id', $this->listing_id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Feature has been added successfully');
        }
    }

    public function closeFeatureManage()
    {
        $this->resetForm();
        $this->provider_feature = '';
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
        $this->amenities = ProviderAmenity::where('listing_id', $this->listing_id)->where('status', 1)->get();
        $this->provider_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageOpen');
    }

    public function editAmenities($amenityid)
    {
        $amenity = ProviderAmenity::find($amenityid);
        if ($amenity) {
            $this->provider_amenity = $amenity->amenity_text;
            $this->amenity_id = $amenity->id;
            //dd($this->provider_feature);
            $this->emit('amenityManageOpen');
        }
    }



    public function updateAmenity()
    {
        $this->validate(
            [
                'provider_amenity' => ['required'],
            ],
            [
                'provider_amenity.required' => "Amenity field is required",
            ]
        );
        if ($this->amenity_id != '') {
            $amenity = ProviderAmenity::find($this->amenity_id);
            if ($amenity) {
                $amenity->amenity_text = $this->provider_amenity;
                $amenity->save();
            }
            $this->provider_amenity = '';
            $this->amenity_id = '';
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('listing_id', $this->listing_id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been updated successfully');
        } else {
            $amenity = new ProviderAmenity;
            $amenity->listing_id = $this->listing_id;
            $amenity->amenity_text = $this->provider_amenity;
            $amenity->status = true;
            $amenity->save();
            $this->resetForm();
            $this->amenities = ProviderAmenity::where('listing_id', $this->listing_id)->where('status', 1)->get();
            $this->showFeatureSuccessModal('Amenities has been added successfully');
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
        $this->provider_amenity = '';
        $this->amenity_id = '';
        $this->emit('amenityManageClose');
    }


    public function render()
    {

        return view('livewire.frontend.travel-tourism.short-term-rental.short-term-rental-dashboard');
    }
}
