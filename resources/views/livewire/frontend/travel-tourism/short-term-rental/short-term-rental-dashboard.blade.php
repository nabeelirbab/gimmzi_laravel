
<div>


    <div>
        <div id="alen-park-contain">
            <div class="container">
                <div class="alen-park-contain">
                    <div class="allen-img-main">
                        <img src="{{ $user->travelType->short_term_logo }}" class="alen-img" />
                    </div>
                    <div class="middle-smart-rental-sec">
                        <div class="right-sec-rental">
                            <h3>
                                <span class="dropdown top-droup-down-menu">
                                    <button class="dropdown-toggle custom-droup-down" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <!-- <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                    class="" /> -->
                                    </button>
                                    
                                    <h1>{{$user->travelType->name}}</h1>
                                </span>
                            </h3>


                            <p class="alen-park-text1 img-b-space1">
                                <span class="p-responsive-main location-image-icon img-b-space1">
                                    <label><strong>Address: </strong></label>&nbsp;
                                    <label>{{$user->travelType->address}}</label>
                                </span>

                                <span class="p-responsive-main">
                                    <span class="mail-image-icon"></span> <label><strong>Mail:</strong></label>&nbsp;<a
                                        href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </span>
                            </p>
                            <p class="alen-park-text1 alen-park-text1 star-image-icon"><label><strong>Total Points to
                                        Distribute:</strong></label>&nbsp;<span
                                    class="alen-park-text1">{{number_format($user->travelType->points_to_distribute)}}
                                    Points</span>

                        </div>
                        </p>
                    </div>

                </div>

            </div>
        </div>
        <div id="section3">

            <div class="smart-contain-main">
                <div class="container">
                    <div class="smart-rental-button">
                        <ul>
                            <li>
                                <a href="{{route('frontend.smart_guest_database') }}">
                                    <img src="{{ asset('frontend_assets/images/icon9.svg') }}" class="cat-left-icon" />
                                    Smart Guest Database
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.short_term.low_point') }}"> <img
                                        src="{{ asset('frontend_assets/images/icon11.svg') }}" class="cat-left-icon" />
                                    <span>Low Point Balance Member Search</span> </a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" wire:click="openListingModal">
                                    <img style="width: 36px;"
                                        src="{{ asset('frontend_assets/images/manage-listing.svg') }}"
                                        class="cat-left-icon" />
                                    Manage Listing</a>
                            </li>

                            <li>
                                <a href="{{ route('frontend.short_term.message_board') }}"> <img
                                        src="{{ asset('frontend_assets/images/icon10.svg') }}" class="cat-left-icon" />
                                    Message Boards </a>

                            </li>
                            
                            <li>
                                <a href="{{route('frontend.short_term.smart_rental_access_management')}}"> <img
                                        src="{{ asset('frontend_assets/images/icon13.svg') }}" class="cat-left-icon" />
                                    User Access Management</a>
                            </li>

                            <li>
                                <a href="{{route('frontend.short_term.create-travel-report')}}" >
                                    <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                    Reports</a>
                            </li>

                            <li>
                                <a href="#"> <img src="{{ asset('frontend_assets/images/b.svg')}}" class="cat-left-icon" />
                                    <span> Gimmzi Gift pack <br />
                                    <span class="text-one11">(Coming Soon)</span> </span> </a>
                            </li>

                            <li>
                                <a href="{{route('frontend.short_term.settings')}}"> <img
                                        src="{{ asset('frontend_assets/images/icon14.svg') }}" class="cat-left-icon" />
                                    Settings</a>
                            </li>

                        </ul>
                    </div>
                    <div class="have-text-one">
                        <a href="javascript:void(0);">Having Technical issues? Submit a Trouble ticket here </a>
                    </div>
                </div>
            </div>

        </div>

        <div>

            <div wire:ignore.self class="modalOpa new_modal_participate modal fade " id="manageList" tabindex="-1"
                aria-labelledby="participatingLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content" style="border: 2px solid #000;">
                        <div class="modal-body">
                            <div class="modal-deal-management-top">
                                <h2>Manage Listings</h2>
                                <button data-bs-dismiss="modal" wire:click="hideModal">Close</button>
                            </div>
                            <div class="text-left add_location_button"><button class="add-participating-location"
                                    id="add_location_modal" wire:click="openAddModal">Add listing</button>
                            </div>

                            <div class="travel-tourism-listing">
                                <div class="row participate_loctn_rowws gy-4">
                                    <div class="col-xl-12">
                                        <div class="participating-location-main-respnsv-table">
                                            <table id="deals">
                                                <tr>

                                                    <th>
                                                        <input type="text"
                                                            class="search-input dropdown-toggle custom-droup-down search"
                                                            placeholder="Search By Listing Name"
                                                            id="autocomplete"  wire:keydown.enter="searchList"  wire:model.defer="searchName" />
                                                        <input type='hidden' id='selectitem_id' />

                                                    </th>
                                                    <th class="new-select1">
                                                        Active

                                                    </th>
                                                    <th>
                                                        Live Badges
                                                    </th>
                                                    <th>
                                                        Go to Database
                                                    </th>
                                                </tr>
                                                <tbody id="deallocation">
                                                    @forelse ($shortlisting as $list)
                                                    <tr>
                                                        <td>
                                                            <div style="" class="manageList_info_wrap">
                                                                <strong> {{ $list->name }}</strong>
                                                                <div class="manage_details_wpr">
                                                                    <a class="sky-text edit" href="javascript:void(0);"
                                                                        wire:click="openEditModal({{ $list->id }})">Edit</a>
                                                                    <p>{{ $list->street_address }}</p>
                                                                </div>

                                                            </div>

                                                        </td>

                                                        <td>
                                                            <div class="text-center assign-one4">
                                                                @if($list->status == 1)
                                                                @if($is_check == true)
                                                                <input type="checkbox"
                                                                    class="assign-one1 all_deal_location_assigned"
                                                                    data-id="" checked
                                                                    wire:click='openDeactivateModal({{ $list->id }})' />
                                                                @endif
                                                                @else
                                                                <input type="checkbox"
                                                                    class="assign-one1 all_deal_location_assigned"
                                                                    wire:click='activateList({{ $list->id }})'
                                                                    data-id="" />
                                                                @endif
                                                            </div>

                                                        </td>
                                                        <td class="dealvoucher">
                                                            <div class="text-center assign-one4 assignedVoucher ">
                                                                0
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center assign-one4">
                                                                <a class="database_play"
                                                                    href="{{ route('frontend.smart_guest_database') }}"><img
                                                                        src="{{ asset('frontend_assets/images/play-icon.svg') }}"
                                                                        alt=""></a>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                No listing found
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- add listing modal -->
            <div wire:ignore.self class="modal modalOpa common-border-modal addlisting_popup_modal fade" id="AddListing"
                tabindex="-1" aria-labelledby="AddListing" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form wire:submit.prevent="addShortListing">
                            <div class="modal-body addlisting_popup_modal_inner common-modal-body">
                                <div class="add_listing_header">
                                    <h4 class="manage-title">Add Listing</h4>
                                </div>
                                <div class="add_listing_form">

                                    <div class="row add_listing_row">
                                        <div class="col-lg-6 add_listing_left_column">
                                            <div class="add_listing_col">
                                                <label>Listing Name</label>
                                                <input type="text" wire:model.defer="name">
                                                @error('name')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="add_listing_col">
                                                <label>Enter Street Address*</label>
                                                <input type="text" wire:model.defer="street_address" id="add_listing_address">
                                                @error('street_address')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <input type="hidden" wire:model.defer="lat" id="latitude" >
                                                <input type="hidden" wire:model.defer="long" id="longitude" >
                                            </div>
                                            <div class="add_listing_col">
                                                <label>Room/Unit/Suite Number</label>
                                                <input type="text" wire:model.defer="room_number">
                                                @error('room_number')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="add_listing_col" style="display:none">
                                                <label>City*</label>
                                                <input type="hidden" wire:model.defer="city" id="profilecity">
                                                @error('city')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="add_listing_col" style="display:none">
                                                <label>State*</label>
                                                {{-- <input type="text" id="profileState"> --}}
                                                <input type="hidden" wire:model.defer="state_name" id="state_name" readonly>
                                            
                                                <input type="hidden" wire:model.defer="state_id" id="state_id" readonly>
                                                @error('state')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="row add_listing_inner_row">
                                                <div class="col-lg-3 add_listing_col">
                                                    <label>Bedrooms*</label>
                                                    <input type="text" wire:model.defer="no_of_bedrooms">
                                                    @error('no_of_bedrooms')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3 add_listing_col">
                                                    <label>Baths*</label>
                                                    <input type="text" wire:model.defer="no_of_baths">
                                                    @error('no_of_baths')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3 add_listing_col">
                                                    <label>Half Baths</label>
                                                    <input type="text" wire:model.defer="no_of_half_baths">
                                                    @error('no_of_half_baths')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3 add_listing_col">
                                                    <label>Guests*</label>
                                                    <input type="text" wire:model.defer="no_of_guests">
                                                    @error('no_of_guests')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="add_listing_bottom_con">
                                                <ul class="add_listing_list">
                                                    <li><a href="#url">Features</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                    <li><a href="#url">Amenities</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                </ul>
                                            </div> --}}
                                            {{-- <p>
                                                External links connected to buttons on <strong>listing</strong> page <a
                                                    href="#url" data-bs-toggle="modal"
                                                    data-bs-target="#managemodal">Manage</a>
                                            </p> --}}
                                        </div>
                                        <div class="col-lg-6 add_listing_right_column">
                                            <div class="add_listing_col">
                                                <label>Listing Type*</label>
                                                <select wire:model.defer="type_id">
                                                    <option value="">Select Listing Type</option>
                                                    @foreach ($listing as $lists)
                                                    <option value="{{ $lists->id }}">{{ $lists->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('type_id')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="add_listing_col" style="display:none">
                                                <label>Location Zip Code*</label>
                                                <input type="hidden" wire:model.defer="zip_code" id="zipCode"
                                                    wire:keydown.enter='testMethod'>
                                                @error('zip_code')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <span id="ziperror"></span>
                                            <div class="add_listing_col">
                                                <label>Listing Description</label>
                                                <textarea wire:model.defer="description"></textarea>
                                                @error('description')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="uploard-top-one">
                                                Upload Photos
                                            </div>
                                            <div class="row add_img_part">
                                                <div class="col-sm-5">
                                                    <div class="uploard-logo-one">
                                                        <input type="file" class="uploard-file-one" 
                                                            id="list_photos" wire:model.defer='photo' multiple/>

                                                        <img
                                                            src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                        <h4>Upload Photos</h4>
                                                        <h5>25 MB Maximum</h5>
                                                    </div>
                                                </div>
                                                @error('photo')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <div class="col-sm-5">
                                                    @if($main_photo)
                                                    <div class="uploard-logo-one">
                                                          <input type="hidden" class="uploard-file-one" wire:model='add_main_image' />
                                                          <img style=" height: 125px; padding: 10px;" src="{{ asset('storage/tmp/'.$main_photo->getFilename())}}" id="main_photo" />
                                                        
                                                    </div>
                                                    <div class="delete_button" style="display: block;">
                                                        <a style="color:red;" href="javascript:void(0);" wire:click='deleteAddMainPhoto'>Delete</a>
                                                    </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <div class="editImage_clss">
                                                        @if($uploaded_images)
                                                        
                                                            @foreach ($uploaded_images as $key=>$image)
                                                            <div class="edit_img_wrapper">
                                                                <div class="editmake_photo_button">
                                                                    <img class='thumbnail'  style="height: 109px;padding: 10px;" src="{{ asset('storage/tmp/'.$image->getFilename()) }}" />
                                                                </div>

                                                                <div class="delete_button button_for_edit">
                                                                    <a style="color:red;" href="javascript:void(0);" wire:click="photoDelete({{$key}})">Delete</a>
                                                                    <a href="javascript:void(0);" wire:click="photoMakeMain({{$key}})">Make Main Photo</a>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                @error('listing_images')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror


                                            </div>
                                            {{-- <div class="uploard-top-one">
                                                Upload Media
                                            </div>
                                            <div class="row" style="margin-bottom: 31px;">
                                                <div class="col-sm-5">
                                                    <div class="uploard-logo-one">
                                                        <input type="file" class="uploard-file-one"
                                                            wire:model='listing_video' accept="video/mp4" />
                                                        <img
                                                            src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                        <h4>Upload Media</h4>
                                                        <h5>25 MB Maximum</h5>
                                                    </div>
                                                    @error('listing_video')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                @if($listing_video)
                                                <div class="col-sm-5">
                                                    <div class="" >
                                                        <video id="preview_media" width="200" height="147" src="{{$listing_video->temporaryUrl()}}" controls>
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                    <div class="add_delete_button">
                                                        <a style="color:red;margin: 69px;" href="javascript:void(0);" wire:click='deleteAddMedia'>Delete</a>
                                                    </div>
                                                </div>
                                                @endif
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer-gap-none">
                                <div class="new-gm-btn-wrap">
                                    <div class="new-gm-btn-wrap-left">
                                        <button type="button" class="btn-blue-outline">Preview Gimmzi Site</button>
                                    </div>
                                    <div class="btn_foot_end">
                                        <button class="btn_table_s blu addusersubmit" type="submit"
                                            name="submit">Add</button>
                                        <button type="button" class="btn_table_s rdd addUserClose"
                                            wire:click='hideListModal'>Close</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- manage listing checkbox modal -->
        <div wire:ignore.self class="modal checkbox_modal_popup fade" id="CheckBoxpopup" tabindex="-1"
            aria-labelledby="CheckBoxpopup" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body checkbox_modal_popup_inner">
                        <h4 class="manage-title">By deactivating this Listing</h4>
                        <ul class="popup_listing">
                            <li>
                                The Gimmzi Page of this listing will be offline, which means it won't be
                                accessible
                                to
                                guests or public viewing.
                            </li>
                            <li>
                                Any badges that have already been accepted for this listing will still be honored
                                and
                                guests
                                will receive the agreed sign up point bonuses on the check-in date unless the badge
                                has
                                been deactivated on an individual basis in the Smart Guest Database.
                            </li>
                            <li>
                                Both future and past guests who have not accepted the badges will not be able to
                                access
                                then
                                at this listing.
                            </li>
                        </ul>
                        <p>
                            Additionally, if the listing is deactivated, it can be reactivated in future by checking
                            the
                            active checkbox.
                        </p>
                        <div>
                            <div class="checkbox_modal_bottom">
                                <h5 class="checkboxpopup_subtitle">
                                    Would you like to proceed with deactivating this listing?
                                </h5>
                                <div class="checkbox_bottom_btn">

                                    <a href="javascript:void(0);" class="page_btn2" wire:click.prevent='yesDeactivate'
                                        id="yeschange">Yes</a>
                                    <a href="javascript:void(0);" class="page_btn2" wire:click='hideStatusModal'
                                        data-bs-dismiss="modal" onclick="window.location.reload()"
                                        id="closeactive">No</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- manage listing checkbox modal -->

        <!-- edit listing modal -->
        <div wire:ignore.self class="modal modalOpa common-border-modal addlisting_popup_modal fade" id="EditListing"
            tabindex="-1" aria-labelledby="AddListing" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form wire:submit.prevent="updateShortListing" id="editListId">
                        <div class="modal-body addlisting_popup_modal_inner common-modal-body">
                            <div class="add_listing_header">
                                <h4 class="manage-title">Edit Listing</h4>
                            </div>
                            <div class="add_listing_form">

                                <div class="row add_listing_row">
                                    <div class="col-lg-6 add_listing_left_column">
                                        <div class="add_listing_col">
                                            <label>Listing Name</label>
                                            <input type="text" wire:model.defer="name">
                                            @error('name')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="add_listing_col">
                                            <label>Enter Listing Address*</label>
                                            <input type="text" wire:model.defer="street_address" id="listing_address">
                                            @error('street_address')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                            <input type="hidden" wire:model.defer="lat" id="latitude" >
                                            <input type="hidden" wire:model.defer="long" id="longitude" >
                                        </div>
                                        <div class="add_listing_col">
                                            <label>Room/Unit/Suite Number</label>
                                            <input type="text" wire:model.defer="room_number">
                                            @error('room_number')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="add_listing_col"  style="display:none;">
                                            <label>City*</label>
                                            <input type="hidden" wire:model.defer="city" id="editprofilecity" readonly>
                                            @error('city')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="add_listing_col"  style="display:none;">
                                            <label>State*</label>
                                            {{-- <input type="text" id="profileState"> --}}
                                            <input type="hidden" wire:model.defer="state_name" id="state_name" readonly>
                                            
                                            <input type="hidden" wire:model.defer="state_id" id="state_id" readonly>
                                            @error('state_id')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="row add_listing_inner_row">
                                            <div class="col-lg-3 add_listing_col">
                                                <label>Bedrooms*</label>
                                                <input type="text" wire:model.defer="no_of_bedrooms">
                                                @error('no_of_bedrooms')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 add_listing_col">
                                                <label>Baths*</label>
                                                <input type="text" wire:model.defer="no_of_baths">
                                                @error('no_of_baths')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 add_listing_col">
                                                <label>Half Baths</label>
                                                <input type="text" wire:model.defer="no_of_half_baths">
                                                @error('no_of_half_baths')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 add_listing_col">
                                                <label>Guests*</label>
                                                <input type="text" wire:model.defer="no_of_guests">
                                                @error('no_of_guests')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="add_listing_bottom_con">
                                            <ul class="add_listing_list">
                                                <li><a href="javascript:void(0);">Features</a></li>
                                                <li class="active"><a href="javascript:void(0);" wire:click="featureView">View</a></li>
                                                <li class="active"><a href="javascript:void(0);" wire:click="featureManage">Manage</a></li>
                                                <li><a href="javascript:void(0);">Amenities</a></li>
                                                <li class="active"><a href="javascript:void(0);" wire:click="amenityView">View</a></li>
                                                <li class="active"><a href="javascript:void(0);" wire:click="amenityManage">Manage</a></li>
                                            </ul>
                                        </div>
                                        <p>
                                            External links connected to buttons on <strong>listing</strong> page 
                                            <a href="javascript:void(0);" wire:click='externalLinkModal'>Manage</a>
                                        </p>
                                    </div>
                                    <div class="col-lg-6 add_listing_right_column">
                                        <div class="add_listing_col">
                                            <label>Listing Type*</label>
                                            <select wire:model.defer="type_id">
                                                <option value="">Select Listing Type</option>
                                                @foreach ($listing as $lists)
                                                <option value="{{ $lists->id }}">{{ $lists->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('type_id')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="add_listing_col" style="display:none;">
                                            <label>Location Zip Code*</label>
                                            <input type="hidden" wire:model.defer="zip_code" id="editzipCode"
                                                wire:keydown.enter='testMethod' readonly>
                                            @error('zip_code')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <span id="ziperror"></span>
                                        <div class="add_listing_col">
                                            <label>Listing Description</label>
                                            <textarea wire:model.defer="description"></textarea>
                                            @error('description')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="uploard-top-one">
                                            Upload Photos
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one" multiple
                                                        id="edit_photos" wire:model.defer='listing_images' />
                                                    <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                    <h4>Upload Photos</h4>
                                                    <h5>25 MB Maximum</h5>
                                                </div>
                                            </div>


                                            <div class="col-sm-5">
                                                @if($main_image)
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one" multiple
                                                        wire:model='photo' />
                                                    <img style="height: 125px;padding: 10px;" src="{{ asset($main_image) }}" id="main_photo" />
                                                </div>
                                                <div class="delete_button" style="display: block;">
                                                    <a style="color:red;" href="javascript:void(0);"
                                                        wire:click='deleteEditMainPhoto({{ $listing_id }})'>Delete</a>
                                                </div>
                                                @endif
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="editImage_clss" id="photo_preview">
                                                    @if($model_images)
                                                        @foreach ($model_images as $image)
                                                        <div class="edit_img_wrapper">
                                                            <div class="editmake_photo_button">
                                                                <img id="" style="height: 109px;padding: 10px;" src="{{ $image->getUrl() }}" />
                                                            </div>

                                                            <div class="delete_button button_for_edit">
                                                                <a style="color:red;" href="javascript:void(0);"
                                                                    wire:click="deleteEditListPhoto({{ $image->id }})">Delete</a>
                                                                <a href="javascript:void(0);" wire:click="makeEditMainPhoto({{ $image->id }})">Make
                                                                    Main Photo</a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            @error('listing_images')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror


                                        </div>
                                        {{-- <div class="uploard-top-one">
                                            Upload Media
                                        </div>
                                        <div class="row" style="margin-bottom: 31px;">
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one" id="edit_list_video"
                                                        wire:model.defer='listing_videos' accept="video/mp4" />
                                                    <img
                                                        src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                    <h4>Upload Media</h4>
                                                    <h5>25 MB Maximum</h5>
                                                </div>

                                                @error('listing_video')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-5">

                                                <div class="" wire:ignore>
                                                    <video style="display:none;" id="edit_preview_media" width="200" height="147" controls>
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>


                                            </div>
                                            <div class="col-sm-5">
                                                @if($model_video)

                                                <video id="edit_video" width="230" height="147" controls
                                                    src="{{ $model_video->getUrl() }}" type="video/mp4">
                                                    
                                                </video>
                                                <div class="delete_button" style="display: block;">
                                                    <a style="color:red;" href="javascript:void(0);"
                                                        wire:click='deleteEditMedia()'>Delete</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer-gap-none">
                            <div class="new-gm-btn-wrap">
                                <div class="new-gm-btn-wrap-left">
                                    <a target="_blank" href="{{route('frontend.short-term-website',base64_encode($listing_id))}}" class="btn-blue-outline">Preview Gimmzi Site</a>
                                </div>
                                <div class="btn_foot_end">
                                    <button class="btn_table_s blu addusersubmit" type="submit"
                                        name="submit">Update</button>
                                    <button type="button" class="btn_table_s rdd addUserClose"
                                        wire:click='hideEditModal'>Close</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
        <!--end edit listing modal -->

        <!-- change password modal -->
        <div wire:ignore.self class="modal fade merchent-main-madal" id="changepasswordModal" tabindex="-1"
            aria-labelledby="changepasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body position-relative">
                        <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                                src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                        <div class="border_bottom">
                            <h2>Change Your Password</h2>
                        </div>
                        <form wire:submit.prevent = "changeUserPassword">
                            <div class="merchent-input">
                                <input type="password" placeholder="New Password" wire:model.defer="new_password" name="new_password" />
                                @error('new_password')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="merchent-input">
                                <input type="password" placeholder="Confirm Password" wire:model.defer="confirm_password" name="confirm_password" />
                                @error('confirm_password')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="green-login-button">
                                <button type="submit" class="password_save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <!-- end change password modal -->
    </div>
    

    <!-- external link manage modal -->
    <div wire:ignore.self class="modal fade cmn_modal_designs" id="external_link_modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border:2px solid #000;" >
                <form wire:submit.prevent="updateExternalLink" id="editListId">
                    <div class="modal-body">
                        <div class="table_user_top_sec_col_lft new">
                            <h3 id="listingName"></h3>
                        </div>

                        <div class="table_cmn_part_sgn">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="text-align: center;">URL/Source/Destination</th>
                                        <th style="text-align: center;">Display On Landing Page</th>
                                    </tr>
                                </thead>
                                <tbody id="external_Data">
                                    <tr>
                                        <td>Book Online</td>
                                        <td style="text-align: center;"><input type="text" wire:model.defer="book_online" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                        <br>
                                            @error('book_online')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1" wire:model.defer="book_online_check" ></td>
                                    </tr>
                                    <tr>
                                        <td>Request Info</td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu" wire:click = "openFormEmails" >Add/Edit Email</a>
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1" wire:model.defer="request_info_check" ></td>
                                    </tr>
                                    <tr>
                                        <td>Guest Portal</td>
                                        <td style="text-align: center;"><input type="text" wire:model.defer="guest_portal" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br>
                                            @error('guest_portal')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1" wire:model.defer="guest_portal_check" ></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu"  wire:click = "openSetLocation">Set Location</a>
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1" wire:model.defer="location_check" ></td>
                                    </tr>
                                    <tr>
                                        <td>Visit Direct Website</td>
                                        <td style="text-align: center;"><input type="text" wire:model.defer="direct_website" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br> 
                                            @error('direct_website')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1" wire:model.defer="direct_website_check" ></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer not_last">
                        <div class="modal-footer-gap-none">
                            <div class="row option_avlbl_row align-items-center gy-2">
                                <div class="col-lg-6 option_avlbl_col_lft">
                                </div>
                                <div class="col-lg-6 option_avlbl_col_rght">
                                
                                    <div class="btn_foot_end">
                                        <button type="submit" class="btn_table_s grn" >Save</button>
                                        <a href="javascript:void(0)" class="btn_table_s rdd"
                                            data-bs-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end external link manage modal -->

    {{-- Set location modal --}}
    <div wire:ignore.self class="modal common-border-modal Setlocation-modal fade" id="SetLocation" tabindex="-1"
        aria-labelledby="SetLocation" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1100px;">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body common-modal-body">
                    <h4 class="manage-title">Listing Address</h4>
                    <form wire:submit.prevent="updateLocation">
                        <div class="row list-address-row">
                            <div class="col-lg-6 list-address-column">
                                    <div class="list-address-col-form" >
                                        <label>Enter Listing Address*</label>
                                        <input wire:ingore type="text" wire:model.defer="street_address" id="autocomplete1" autocomplete="off" >
                                    </div>
                                    <input type="hidden" wire:model.defer="lat" id="latitude" >
                                    <input type="hidden" wire:model.defer="long" id="longitude" >
                                    @error('street_address')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <div class="list-address-col-form" style="display:none;">
                                        <label>Zip Code*</label>
                                        <input type="hidden" wire:model.defer="zip_code" id="zipcode" readonly>
                                    </div>
                                    @error('zip_code')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <div class="list-address-col-form"  style="display:none;">
                                        <label>City*</label>
                                        <input type="hidden" wire:model.defer="city" id="city"readonly>
                                    </div>
                                    @error('city')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <div class="list-address-col-form"  style="display:none;">
                                        <label>State*</label>
                                        <input type="hidden" wire:model.defer="state_name" id="state" readonly>
                                        <input type="hidden" wire:model.defer="state_id" id="state_id" readonly>
                                    </div>
                                    @error('state_name')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    @error('state_id')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                
                            </div>
                            <div class="col-lg-6 list-address-column">
                                <div class="list-address-map">
                                    <figure id="location_map" class="edt_map"></figure>
                                </div>
                            </div>
                        </div>
                        <div class="common-modal-close" style="padding-top: 40px;text-align: right;">
                            <a href="#url" class="page-btn page-btn-red" data-bs-dismiss="modal">Close</a>
                            <button type="submit" class="page-btn page-btn-green-peas" >Save</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end Set location modal --}}

    {{-- Add/edit emails for request info --}}

    <div wire:ignore.self class="modal common-border-modal AddEditEmail fade" id="emailAddressModal" tabindex="-1"
        aria-labelledby="AddEditEmail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 634px;">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body common-modal-body">
                    <h4 class="manage-title">Enter Email(s) to send completed Request Info forms</h4>
                    <a class="common-modal-btn" href="javascript:void(0);" wire:click="viewrequestInfo">View sample Request info Form</a>
                    <form wire:submit.prevent="addEditEmail">
                        <div class="dolphing_cove_form">
                        
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <h4 class="dolphin_sub_title">Email Address ({{$email_count}}/5)</h4>
                                </div>
                            </div>
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <div class="dolphin_input">
                                        <input type="text" wire:model.defer="first_email_address">
                                    </div>
                                </div>
                                @error('first_email_address')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <div class="dolphin_input">
                                        <input type="text" wire:model.defer="second_email_address">
                                    </div>
                                </div>
                                @error('second_email_address')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <div class="dolphin_input">
                                        <input type="text" wire:model.defer="third_email_address">
                                    </div>
                                </div>
                                @error('third_email_address')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <div class="dolphin_input">
                                        <input type="text" wire:model.defer="fourth_email_address">
                                    </div>
                                </div>
                                @error('fourth_email_address')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="row dolphin_row">
                                <div class="col-lg-7 dolphin_column">
                                    <div class="dolphin_input">
                                        <input type="text" wire:model.defer="fifth_email_address">
                                    </div>
                                </div>
                                @error('fifth_email_address')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        {{--  --}}
                        </div>
                        <div class="common-modal-close">
                            <a href="javascript:void(0);" wire:click="closeEmailAddressModal" class="page-btn page-btn-red" >Close</a>
                            <button type="submit" class="page-btn page-btn-green-peas" >Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end Add/edit emails for request info --}}

    {{-- request info form --}}
    <div wire:ignore.self class="modal common-border-modal requestinfoform-modal  fade" id="requestinfoform" tabindex="-1"
        aria-labelledby="requestinfoform" aria-hidden="true" style="padding-left: 0px;">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 743px;">
            <div class="modal-content request_info_content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-header request_info_header">
                    <a href="javascript:void(0);" class="btn-close request_info_close" data-bs-dismiss="modal" aria-label="Close">X</a>
                </div>
                <div class="modal-body common-modal-body">
                    <div class="navigate-panel" style="padding-top: 0;">
                        <div class="request-info-topper">
                            <img class="itrip-logo-img" src="{{$this->shortTerm->short_term_logo}}" alt="title">
                            <span class="cmn-sub-ttile">Request Info on Listing</span>
                        </div>
                        <div class="request-info-form">
                            <p class="request_info_para">
                                Please fill out the form below and we will forward it to <span style="font-weight: 700;
                                font-style: oblique;"id="shortTermname"></span> to get back to you as soon as possible
                            </p>
                            <form>
                                <div class="row request-info-row">
                                    <div class="col-lg-12 request-col" style="margin-bottom: 20px;">
                                        <label>Name*</label>
                                        <input type="text">
                                    </div>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <label>Email*</label>
                                        <input type="email">
                                    </div>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <label>Phone*</label>
                                        <input type="tel">
                                    </div>
                                    <fieldset class="fieldset-col" >
                                        <div class=" request-col input-date" style="width: 48.7%;margin-bottom: 0;">
                                            <label>Arrive Date</label>
                                            <input type="text" class="custmDatePicker">
                                        </div>
                                        <div class="request-col input-date" style="width: 48.7%;margin-bottom: 0;">
                                            <label>Departure Date</label>
                                            <input type="text" class="custmDatePicker">
                                        </div>
                                        <span class="date-filed-para">
                                            Please note that the dates you select are not guaranteed availability through Gimmzi Smart Rewards. For accurate and up-to-date information on the availability of the listing, we recommend visiting the direct website.
                                        </span>
                                    </fieldset>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <label>Adults</label>
                                        <input type="text">
                                    </div>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <label>Children</label>
                                        <input type="text">
                                    </div>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <div class="form_input_check">
                                            <label>
                                                <input type="checkbox">
                                                <span>My Travel Dates are flexible</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 request-col" style="margin-bottom: 20px;">
                                        <label>Listings</label>
                                        <div class="multiSelect_wrap">
                                            <select class="multiSelect2" data-placeholder="Choose anything" multiple>
                                                <option selected>Sunset Place</option>
                                                <option>By the Beach</option>
                                                <option>Hilton Hotels & Resorts</option>
                                                <option>Wave Lane</option>
                                                <option>Green Village</option>
                                                <option>Sky View Paris</option>
                                            </select>

                                            <!-- <select class="form-select multiSelect2" data-placeholder="Choose anything" multiple>
                                                <option>Christmas Island</option>
                                                <option>South Sudan</option>
                                                <option>Jamaica</option>
                                                <option>Kenya</option>
                                                <option>French Guiana</option>
                                                <option>Mayotta</option>
                                                <option>Liechtenstein</option>
                                                <option>Denmark</option>
                                                <option>Eritrea</option>
                                                <option>Gibraltar</option>
                                                <option>Saint Helena, Ascension and Tristan da Cunha</option>
                                                <option>Haiti</option>
                                                <option>Namibia</option>
                                                <option>South Georgia and the South Sandwich Islands</option>
                                                <option>Vietnam</option>
                                                <option>Yemen</option>
                                                <option>Philippines</option>
                                                <option>Benin</option>
                                                <option>Czech Republic</option>
                                                <option>Russia</option>
                                            </select> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-12 request-col" style="margin-bottom: 20px;">
                                        <label>Comments / Request</label>
                                        <textarea></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end request info form --}}

    {{-- Feature & amenities list modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="featureAmenityModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                      <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"  href="javascript:void(0);">Amenities</a>
                                    </li>
                                </ul>   
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @if(count($features) > 0)
                                            @foreach($features as $feature_data)
                                            <div class="feature-list">
                                                <p>{{$feature_data->feature_text}}</p>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="feature-list">
                                                <p>There are no features</p>
                                            </div>
                                            @endif
                                           
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if(count($amenities) > 0)
                                            @foreach($amenities as $amenity_data)
                                            <div class="feature-list">
                                                <p>{{$amenity_data->amenity_text}}</p>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="feature-list">
                                                <p>There are no amenities</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <div class="f-btm-outr">
                                <form class="feature-form">
                                   
                                </form>
                                <div class="btn-wrap">
                                    {{-- <button type="submit" class="btn_table_s grn addUpdateFeature" name="submit">Add</button> --}}
                                    <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- end Feature & amenities list modal --}}

    {{-- Feature add-edit modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="featureManageModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                      <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                    {{-- <li class="nav-item" disabled>
                                      <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"  href="javascript:void(0);">Amenities</a>
                                    </li> --}}
                                </ul>   
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @if(count($features) > 0)
                                            @foreach($features as $feature_data)
                                            <div class="feature-list">
                                                <p>{{$feature_data->feature_text}}</p>
                                                <div class="feaure-btn">
                                                    <a href="javascript:void(0);" class="edit-btn" wire:click="editFeature({{$feature_data->id}})" >Edit</a>|
                                                    <a href="javascript:void(0);" class="rmve-btn" wire:click="removeFeature({{$feature_data->id}})">Remove</a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="feature-list">
                                                <p>There are no features</p>
                                            </div>
                                            @endif
                                           
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if(count($amenities) > 0)
                                            @foreach($amenities as $amenity_data)
                                            <div class="feature-list">
                                                <p>{{$amenity_data->amenity_text}}</p>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="feature-list">
                                                <p>There are no amenities</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <form class="feature-form" wire:submit.prevent="updateFeature">
                                <div class="f-btm-outr">
                                    <div class="form-group">                         
                                        <input type="text" placeholder="Enter text" wire:model.defer="provider_feature">
                                        <input type = "hidden" wire:model.defer = "feature_id">
                                    </div>
                                    
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd" wire:click="closeFeatureManage">Close</button>
                                    </div>
                                </div>
                                @error('provider_feature')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end Feature add-edit modal --}}

    {{-- amenities add-edit modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="amenitiesManageModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                      <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="javascript:void(0);">Amenities</a>
                                    </li>
                                    {{-- <li class="nav-item" disabled>
                                      <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"  href="javascript:void(0);">Amenities</a>
                                    </li> --}}
                                </ul>   
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if(count($amenities) > 0)
                                            @foreach($amenities as $amenity_data)
                                            <div class="feature-list">
                                                <p>{{$amenity_data->amenity_text}}</p>
                                                <div class="feaure-btn">
                                                    <a href="javascript:void(0);" class="edit-btn" wire:click="editAmenities({{$amenity_data->id}})" >Edit</a>|
                                                    <a href="javascript:void(0);" class="rmve-btn" wire:click="removeAmenities({{$amenity_data->id}})">Remove</a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="feature-list">
                                                <p>There are no amenities</p>
                                            </div>
                                            @endif                                           
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <form class="feature-form" wire:submit.prevent="updateAmenity">
                                <div class="f-btm-outr">
                                    <div class="form-group">                         
                                        <input type="text" placeholder="Enter text" wire:model.defer="provider_amenity">
                                        <input type = "hidden" wire:model.defer = "amenity_id">
                                    </div>
                                    
                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd" wire:click="closeAmenityManage">Close</button>
                                    </div>
                                </div>
                                @error('provider_amenity')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end amenities add-edit modal --}}

    <!-- success modal  -->
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="errormsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click.prevent="hideSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    You will not be able to recover this record!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="deleteConfirm()" data-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="img_delete_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmessage">Photo has been deleted successfully</h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- success modal  -->
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="feature_success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="featuremsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click.prevent="hideFeatureSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="external_success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="externalmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click.prevent="hideExternalSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
@push('scripts')
<script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>
<script>

            @if(Auth::user()->created_password != '')
                $(window).on('load', function() {
                    $('#changepasswordModal').modal('show');
                });
            @endif
    document.addEventListener('livewire:load', function (event) {
               
                
                @this.on('openManageList', function () {
                        $('#manageList').modal('show');
                        //$('#error_modal').modal('hide');
                    });
                @this.on('openAddManage', function () {
                    $("#AddListing").find('form').trigger('reset');
                    //  $("#EditListing").find('form').trigger('reset');
                        $('#AddListing').modal('show');
                    });

                @this.on('closeAddManage', function () {
                    
                    $('#AddListing').modal('hide');

                    });

                @this.on('showDeactivateModal', function () {
                        $('#CheckBoxpopup').modal('show');
                        @this.get('id');
                       
                       
                    });
                @this.on('successModal', data =>{
                    const lat = '<?php echo $lat;?>';
                    const long = '<?php echo $long;?>';
                    console.log(lat);
                    setTimeout(function(){
                        var mapOptions2 = { zoom: 10 };
                        promap = new google.maps.Map(document.getElementById('location_map'),
                        mapOptions2);
                        var promarker;

                        promarker = new google.maps.Marker({
                            position: new google.maps.LatLng(lat,long),
                            map: promap,
                            animation: google.maps.Animation.DROP,
                        });
                        promap.setCenter(promarker.getPosition());
                        promap.setZoom(10);
                    },200);
                        $('#error_modal').modal('show');
                        //  console.log(data.text);
                        $("#errormsg").html(data.text);
                        
                })

                @this.on('showEditModal', function () {     
                    $('#EditListing').modal('show');
                    var frm = $('#editListId');
                    // frm.serialize();
                });
                   
                @this.on('closeEditManage', function () {
                   
                    $('#EditListing').modal('hide');
                        
                });

                @this.on('showConfirmModal', data =>{
                    $('#confirm_modal').modal('show');
                    $("#removeid").val(data.id);
                    $("#listid").val(data.list_id);
                 
                });
                @this.on('hideConfirmModal', function () {
                    // alert(123);
                    $('#confirm_modal').modal('hide');
                   //$('#img_delete_success_modal').modal('show');
                });
                function imageDeleteConfirm(){
			        window.livewire.emit('imageDeleteConfirm')
		        }
                window.addEventListener('modal-open', event  => {
                    $('#delete_confirm_modal').modal('show');
		        });

                function mediaDeleteConfirm(){
			        window.livewire.emit('mediaDeleteConfirm')
		        }

               
                @this.on('openExternalLinkModal', data =>{
                    $('#external_link_modal').modal('show');
                    $("#listingName").html(data.listing_name+' - '+data.address);

                });

                @this.on('openSetLocation', data =>{
                    $('#SetLocation').modal('show');
                    setTimeout(function(){
                        var mapOptions2 = { zoom: 10 };
                        promap = new google.maps.Map(document.getElementById('location_map'),
                        mapOptions2);
                        var promarker;

                        promarker = new google.maps.Marker({
                            position: new google.maps.LatLng(data.lat, data.long),
                            map: promap,
                            animation: google.maps.Animation.DROP,
                        });
                        promap.setCenter(promarker.getPosition());
                        promap.setZoom(10);
                    },200);

                });

                $("#autocomplete1").on('keyup', function(){
                   
                    var input = document.getElementById('autocomplete1');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.setComponentRestrictions({'country': ['us']});
                    google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                        var place = autocomplete.getPlace();
                        console.log(place);
                        
                        $('#latitude').val(place.geometry['location'].lat());
                        $('#longitude').val(place.geometry['location'].lng());
                        @this.set('lat', place.geometry['location'].lat());
                        @this.set('long', place.geometry['location'].lng());
                        @this.set('street_address', place.formatted_address);
                        
                        setTimeout(function(){
                            var mapOptions ={ zoom: 10};
                            map = new google.maps.Map(document.getElementById('location_map'),
                            mapOptions);
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(place.geometry['location'].lat(), place.geometry['location'].lng()),
                                map: map,
                                animation: google.maps.Animation.DROP,
                            //icon: new_icon
                            });
                        
                            map.setCenter(marker.getPosition());
                            map.setZoom(10);
                        },200);
                        for(var i = 0; i < place.address_components.length; i++){
                            console.log(place.address_components[i]);
                            for (var j = 0; j < place.address_components[i].types.length; j++) {
                                if (place.address_components[i].types[j] == "postal_code") {
                                
                                    $("#zipcode").val(place.address_components[i].long_name);
                                    @this.set('zip_code', place.address_components[i].long_name);
                                }
                                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                    window.livewire.emit('checkState',[place.address_components[i].long_name]);
                                    
                                    $("#state").val(place.address_components[i].long_name);
                                    @this.set('state_name', place.address_components[i].long_name);
                                    
                                    
                                }
                                if (place.address_components[i].types[j] == "locality") {
                                  
                                    $("#city").val(place.address_components[i].long_name);
                                    @this.set('city', place.address_components[i].long_name);
                                }

                            }

                        }
                       
                    });
                });

                @this.on('openFromEmail', data =>{
                    $('#emailAddressModal').modal('show');

                });
                @this.on('closeFromEmailAddress',function(){
                    $('#emailAddressModal').modal('hide');
                });
                @this.on('viewRequstInfo',data =>{
                    $('#requestinfoform').modal('show');
                    $('#shortTermname').html(data.name);
                    $('.multiSelect2' ).select2( {
                        theme: "bootstrap-5",
                        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                        placeholder: $( this ).data( 'placeholder' ),
                        closeOnSelect: false,
                    } );
                });

                @this.on('featureSuccessModal', data =>{
                    $('#feature_success_modal').modal('show');
                    //  console.log(data.text);
                    $("#featuremsg").html(data.text);
                        
                })

                @this.on('featureList', data =>{
                    $('#featureAmenityModal').modal('show');
                });

                @this.on('amenityList', data =>{
                    $('#featureAmenityModal').modal('show');
                    $('#home-tab').removeClass('active');
                    $('#about-tab').addClass('active');
                    $('#about-tab').addClass('show');
                    $('#home').removeClass('active');
                    $('#home').removeClass('show');
                    $('#about').addClass('active');
                    $('#about').addClass('show');
                    
                });

                @this.on('featureManageOpen',function(){
                    $('#featureManageModal').modal('show');
                });

                @this.on('featureManageClose',function(){
                    $('#featureManageModal').modal('hide');
                });

                @this.on('amenityManageOpen',function(){
                    $('#amenitiesManageModal').modal('show');
                });

                @this.on('amenityManageClose',function(){
                    $('#amenitiesManageModal').modal('hide');
                });
               
                @this.on('hidesuccessModal', function () {
                    $('#error_modal').modal('hide');
                    $('#EditListing').modal('hide');
                    $('#CheckBoxpopup').modal('hide');
                    $('#AddListing').modal('hide');
                    $("#external_link_modal").modal('hide');
                    $('#emailAddressModal').modal('hide');
                    $("#SetLocation").modal('hide');
                    $('#featureManageModal').modal('hide');
                    $("#amenitiesManageModal").modal('hide');
                    window.livewire.emit('openListingModal')
                });

                @this.on('hidefeaturesuccessModal', function () {
                    $('#feature_success_modal').modal('hide');
                });

                @this.on('exteralSuccessModal', data =>{
                    $('#external_success_modal').modal('show');
                    $("#externalmsg").html(data.text);
                        
                });

                @this.on('hideExternalsuccessModal', function () {
                    $('#external_success_modal').modal('hide');
                    $('#SetLocation').modal('hide');
                    $("#emailAddressModal").modal('hide');
                });
                    
                $("#editzipCode").on('keyup', function(){
                        var zipcode = $(this).val();
                        // console.log(zipcode);
                        if(zipcode.length == 5){
                            $.ajax({
                                url: '{{ route('get.city') }}',
                                type: 'get',
                                data: {
                                    'zipcode' : zipcode
                                },
                                success: function(result) {
                                    console.log(result);
                                    if(result.success == 1){
                                        $("#editprofilecity").val(result.data.City);
                                        $("#ziperror").html('');
                                        @this.set('city',result.data.City);
                                        $("#editprofileState").val(result.state_name);
                                        @this.set('state_id',result.state_name);
                                    }
                                    else{
                                        $("#ziperror").html(result.data[0]);
                                        $("#ziperror").css('color','red');
                                    }
                                        
                                }
                            });
                        }
                        else{
                            //$("#profilecity").val('');
                        }
                })
                  


                window.onload = function() {
                    //Check File API support
                    if (window.File && window.FileList && window.FileReader) {
                        var filesInput = document.getElementById("list_photos");
                        filesInput.addEventListener("change", function(event) {
                        var files = event.target.files; //FileList object
                        var output = document.getElementById("result");
                        
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            //Only pics
                            if (!file.type.match('image'))
                            continue;
                            var picReader = new FileReader();
                            picReader.addEventListener("load", function(event) {
                            var picFile = event.target;
                            
                            var div = document.createElement("div");
                            div.setAttribute('id', 'divId');
                            div.innerHTML = "<div class='editmake_photo_button'><img class='thumbnail' src='" + picFile.result + "'" +
                                "title='" + picFile.name + "'/>"+
                                "</div>"+
                                
                                "<div class='delete_button button_for_edit'>"+
                                    "<a style='color:red;' href='javascript:void(0);' >Delete</a>"+
                                    "<a href='javascript:void(0);' class='make_main' data = '"+i+"' >Make Main Photo</a>"+
                                   
                                "</div>";
                            output.insertBefore(div, null);
                            @this.set('listing_images', event.target);
                            });
                            //Read the image
                            picReader.readAsDataURL(file);
                        }
                        setTimeout(function(){
                            
                            $(".make_main").on('click',function(){
                                var src = $(this).parent().parent().find('.editmake_photo_button').find('.thumbnail').attr('src');
                                // var data = $(this).attr('data');
                                // var url = picReader.readAsDataURL(data);
                                // console.log(url);
                                $("#main_photo").prop('src',src);
                                //@this.set('add_main_image',number);
                               
                            })
                        },200);
                        
                        });
                    } else {
                        console.log("Your browser does not support File API");
                    }

                    if (window.File && window.FileList && window.FileReader) {
                        var filesInput = document.getElementById("edit_photos");
                        filesInput.addEventListener("change", function(event) {
                        var files = event.target.files; //FileList object
                        var output = document.getElementById("result2");
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            //Only pics
                            if (!file.type.match('image'))
                            continue;
                            var picReader = new FileReader();
                            picReader.addEventListener("load", function(event) {
                            var picFile = event.target;
                            var div = document.createElement("div");
                            div.setAttribute('id', 'divId2');
                            div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                "title='" + picFile.name + "'/>";
                            output.insertBefore(div, null);
                            @this.set('listing_images', event.target);
                            });
                            //Read the image
                            picReader.readAsDataURL(file);
                        }
                        });
                    } else {
                        console.log("Your browser does not support File API");
                    }
                }
                document.getElementById("list_video").onchange = function(event) {
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("#preview_media").src = blobURL;
                    //$(".add_delete_button").css('display','block');
                }

                document.getElementById("edit_list_video").onchange = function(event) {
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("#edit_preview_media").src = blobURL;
                    //$("#edit_preview_media").css('display','block');
                }

                

                // document.getElementById("make_main").onchange = function(event){
                //     let file = event.target.files[0];
                //     let blobURL = URL.createObjectURL(file);
                //     document.querySelector("#preview_memain_photodia").src = blobURL;
                //     //$("#main_photo").attr('src',);
                // }

    });
          

    $(document).ready(function () {
       

        $("#zipCode").on('keyup',function() {
           var zipcode = $(this).val();
           console.log(zipcode);
            if(zipcode.length == 5){
                $.ajax({
                   url: '{{ route('get.city') }}',
                   type: 'get',
                   data: {
                       'zipcode' : zipcode
                   },
                   success: function(result) {
                       console.log(result);
                       if(result.success == 1){
                           $("#profilecity").val(result.data.City);
                           $("#ziperror").html('');
                           @this.set('city',result.data.City);
                           $("#profileState").val(result.state_name);
                           @this.set('state_id',result.state_name);
                       }
                       else{
                           $("#ziperror").html(result.data[0]);
                           $("#ziperror").css('color','red');
                       }
                         
                   }
                });
            }
           else{
               //$("#profilecity").val('');
           }
       
        });

        $("#listing_address").on('keyup',function() {
            var input = document.getElementById('listing_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions({'country': ['us']});
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place);
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                @this.set('lat', place.geometry['location'].lat());
                @this.set('long', place.geometry['location'].lng());
                @this.set('street_address', place.formatted_address);


                
                for(var i = 0; i < place.address_components.length; i++){
                    console.log(place.address_components[i]);
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                        
                            $("#zipcode").val(place.address_components[i].long_name);
                            @this.set('zip_code', place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_1") {
                            window.livewire.emit('checkState',[place.address_components[i].long_name]);
                            
                            $("#state").val(place.address_components[i].long_name);
                            @this.set('state_name', place.address_components[i].long_name);
                            
                            
                        }
                        if (place.address_components[i].types[j] == "locality") {
                            
                            $("#city").val(place.address_components[i].long_name);
                            @this.set('city', place.address_components[i].long_name);
                        }

                    }

                }
               
            });
        });

        $("#add_listing_address").on('keyup',function() {
            var input = document.getElementById('add_listing_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions({'country': ['us']});
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place);
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                @this.set('lat', place.geometry['location'].lat());
                @this.set('long', place.geometry['location'].lng());
                @this.set('street_address', place.formatted_address);


                
                for(var i = 0; i < place.address_components.length; i++){
                    console.log(place.address_components[i]);
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                        
                            $("#zipcode").val(place.address_components[i].long_name);
                            @this.set('zip_code', place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_1") {
                            window.livewire.emit('checkState',[place.address_components[i].long_name]);
                            
                            $("#state").val(place.address_components[i].long_name);
                            @this.set('state_name', place.address_components[i].long_name);
                            
                            
                        }
                        if (place.address_components[i].types[j] == "locality") {
                            
                            $("#city").val(place.address_components[i].long_name);
                            @this.set('city', place.address_components[i].long_name);
                        }

                    }

                }
               
            });
        });


        $(document).on('show.bs.modal', '.modal', function() {
            const zIndex = 1040 + 10 * $('.modal:visible').length;
            $(this).css('z-index', zIndex);
            setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
        });

    });

    
        
</script>
@endpush
</div>