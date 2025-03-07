<div>
    <div>


        <div id="property-manage-search" class="all-smart-rental-database-main-sec">
            <div class="property-manage-search">
                <div class="container">
                    <h2>Search Smart Travel Database</h2>
                    <div class="propert-search-main">
                        <input type="text" class="search-input dropdown-toggle custom-droup-down search"
                            placeholder="Search tenant using First Name, Last Name, or Unit Number....."
                            id="autocomplete" />
                        <input type='hidden' id='selectitem_id' />
                        <button class="search-button searchConsumer"></button>
                    </div>
                </div>
            </div>
        </div>
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
                                    <label>{{$user->travelType->address}},
                                        {{$user->travelType->city}}, {{$user->travelType->state->name}},
                                        {{$user->travelType->zip_code}}</label>
                                </span>

                                <span class="p-responsive-main">
                                    <span class="mail-image-icon"></span> <label><strong>Mail:</strong></label>&nbsp;<a
                                        href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </span>
                            </p>
                            <p class="alen-park-text1 alen-park-text1 star-image-icon"><label><strong>Total Points to
                                    Distribute:</strong></label>&nbsp;<span
                                    class="alen-park-text1">{{number_format($user->travelType->points_to_distribute)}} Points</span>

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
                                <a href="{{ route('frontend.short_term.message_board') }}"> <img
                                        src="{{ asset('frontend_assets/images/icon10.svg') }}" class="cat-left-icon" />
                                    Message Boards </a>

                            </li>
                            <li>
                                <a href="{{route('frontend.low-point-balance-member')}}"> <img
                                        src="{{ asset('frontend_assets/images/icon11.svg') }}" class="cat-left-icon" />
                                    <span>Low Point Balance Member Search</span> </a>
                            </li>

                            <li>
                                <a href="{{route('frontend.smart-rental-access-management')}}"> <img
                                        src="{{ asset('frontend_assets/images/icon13.svg') }}" class="cat-left-icon" />
                                    Smart Rental Access Management</a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" wire:click="openListingModal">
                                    <img style="width: 36px;"
                                        src="{{ asset('frontend_assets/images/manage-listing.svg') }}"
                                        class="cat-left-icon" />
                                    Manage Listing</a>
                            </li>


                            <li>
                                <a href="{{ route('frontend.corporate-settings') }}"> <img
                                        src="{{ asset('frontend_assets/images/icon14.svg') }}" class="cat-left-icon" />
                                    Settings</a>
                            </li>

                        </ul>
                    </div>
                    <div class="have-text-one">
                        <a href="#">Having Technical issues? Submit a Trouble ticket here </a>
                    </div>
                </div>
            </div>

        </div>

        <div>



            <div wire:ignore.self class="modalOpa new_modal_participate modal fade " id="manageList" tabindex="-1"
                aria-labelledby="participatingLocationLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
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
                                                            placeholder="Search tenant using First Name, Last Name, or Unit Number....."
                                                            id="autocomplete" />
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
                                                <label>Location Street Address*</label>
                                                <input type="text" wire:model.defer="street_address">
                                                @error('street_address')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
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
                                            <div class="add_listing_col">
                                                <label>City*</label>
                                                <input type="text" wire:model.defer="city" id="profilecity">
                                                @error('city')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="add_listing_col">
                                                <label>State*</label>
                                                {{-- <input type="text" id="profileState"> --}}
                                                <select wire:model.defer="state_id" id="profileState">
                                                    <option value="">Select state</option>
                                                    @foreach ($stateList as $states)
                                                    <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                    @endforeach
                                                </select>
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
                                            <div class="add_listing_bottom_con">
                                                <ul class="add_listing_list">
                                                    <li><a href="#url">Features</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                    <li><a href="#url">Amenities</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                </ul>
                                            </div>
                                            <p>
                                                External links connected to buttons on <strong>listing</strong> page <a
                                                    href="#url" data-bs-toggle="modal"
                                                    data-bs-target="#managemodal">Manage</a>
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
                                            <div class="add_listing_col">
                                                <label>Location Zip Code*</label>
                                                <input type="text" wire:model.defer="zip_code" id="zipCode"
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
                                            <!-- <div class="uplode_file_box">
                                        <input type="file">
                                    </div> -->
                                            {{-- <div class="provider_setting_upload_wrap"> --}}
                                                <div class="row add_img_part">
                                                    <div class="col-sm-5">
                                                        <div class="uploard-logo-one">
                                                            <input type="file" class="uploard-file-one" multiple
                                                                id="list_photos" wire:model='listing_images' />

                                                            <img
                                                                src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                            <h4>Upload Photos</h4>
                                                            <h5>25 MB Maximum</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <div class="add_main_photo">
                                                            <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" alt="">
                                                            <div class="delete_button">
                                                                <a style="color:red;" href="javascript:void(0);">Delete</a>
                                                                {{-- <a href="javascript:void(0);">Make Main Photo</a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">

                                                        <div class="" wire:ignore>
                                                            <output id='result' />

                                                            {{-- <img id="preview_img"
                                                                style="width: 230px;height: 147px;border-radius: 7%;"
                                                                src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                                            --}}
                                                        </div>

                                                    </div>
                                                    @error('listing_images')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror


                                                </div>
                                                <!-- <label>
                                            <input type="file">
                                            <span>
                                                <i><img src="images/upload-icon.svg" alt=""></i>
                                                Uplode Media
                                                <i>25 MB Maximum</i>
                                            </span>
                                        </label> -->
                                                {{--
                                            </div> --}}

                                            {{-- <div class="add_listing_col uplode_file_wpr"> --}}
                                                <div class="uploard-top-one">
                                                    Upload Media
                                                </div>
                                                <!-- <div class="uplode_file_box">
                                        <input type="file">
                                    </div> -->
                                                {{-- <div class="provider_setting_upload_wrap">
                                                    <div class="upload__box">
                                                        <div class="upload__btn-box">
                                                            <label class="upload__btn">
                                                                <span>
                                                                    <i><img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"
                                                                            alt=""></i>
                                                                    Uplode Media
                                                                    <i>25 MB Maximum</i>
                                                                </span>
                                                                <input type="file" data-max_length="20"
                                                                    class="upload__inputfile"
                                                                    wire:model='listing_video'>
                                                            </label>
                                                        </div>
                                                        <div class="upload__img-wrap"></div>

                                                    </div>
                                                    <!-- <label>
                                            <input type="file">
                                            <span>
                                                <i><img src="images/upload-icon.svg" alt=""></i>
                                                Uplode Media
                                                <i>25 MB Maximum</i>
                                            </span>
                                        </label> -->
                                                </div> --}}

                                                <div class="row" style="margin-bottom: 31px;">
                                                    <div class="col-sm-5">
                                                        <div class="uploard-logo-one">
                                                            <input type="file" class="uploard-file-one" id="list_video"
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
                                                    <div class="col-sm-5">
                                                        <div class="" wire:ignore>
                                                            <video id="preview_media" width="200" height="147" 
                                                                controls>
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="btn_foot_end">

                                        <button class="btn_table_s blu addusersubmit" type="submit"
                                            name="submit">Add</button>
                                        <button type="button" class="btn_table_s rdd addUserClose"
                                            wire:click='hideListModal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- add listing modal -->

            <!-- manage listing checkbox modal -->
            <div wire:ignore.self class="modal checkbox_modal_popup fade" id="CheckBoxpopup" tabindex="-1"
                aria-labelledby="CheckBoxpopup" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body checkbox_modal_popup_inner">
                            <h4 class="manage-title">By deactivating this Listing</h4>
                            <ul class="popup_listing">
                                <li>
                                    The gimmzi page of this listing will be offline, which means it would not be
                                    accessible
                                    to
                                    guest or public viewing.
                                </li>
                                <li>
                                    Any badges that have already been accepted for this listing will still be honored
                                    and
                                    guest
                                    will receive the agreed sign up point bonuses on the click-in date unless the badges
                                    has
                                    been deactivated on an individual basis in the Smart guest database.
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

                                        <a href="javascript:void(0);" class="page_btn2"
                                            wire:click.prevent='yesDeactivate' id="yeschange">Yes</a>
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
            <div wire:ignore.self class="modal modalOpa common-border-modal addlisting_popup_modal fade"
                id="EditListing" tabindex="-1" aria-labelledby="AddListing" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form wire:submit.prevent="updateShortListing">
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
                                                <label>Location Street Address*</label>
                                                <input type="text" wire:model.defer="street_address">
                                                @error('street_address')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
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
                                            <div class="add_listing_col">
                                                <label>City*</label>
                                                <input type="text" wire:model.defer="city" id="editprofilecity">
                                                @error('city')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="add_listing_col">
                                                <label>State*</label>
                                                {{-- <input type="text" id="profileState"> --}}
                                                <select wire:model.defer="state_id" id="editprofileState">
                                                    <option value="">Select state</option>
                                                    @foreach ($stateList as $states)
                                                    <option value="{{ $states->id }}">{{ $states->name }}</option>
                                                    @endforeach
                                                </select>
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
                                                    <li><a href="#url">Features</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                    <li><a href="#url">Amenities</a></li>
                                                    <li class="active"><a href="#url">View</a></li>
                                                    <li class="active"><a href="#url">Manage</a></li>
                                                </ul>
                                            </div>
                                            <p>
                                                External links connected to buttons on <strong>listing</strong> page <a
                                                    href="#url" data-bs-toggle="modal"
                                                    data-bs-target="#managemodal">Manage</a>
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
                                            <div class="add_listing_col">
                                                <label>Location Zip Code*</label>
                                                <input type="text" wire:model.defer="zip_code" id="editzipCode"
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
                                            <!-- <div class="uplode_file_box">
                         <input type="file">
                     </div> -->
                                            {{-- <div class="provider_setting_upload_wrap"> --}}
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="uploard-logo-one">
                                                            <input type="file" class="uploard-file-one" multiple
                                                                id="edit_photos" wire:model='listing_images' />
                                                            <img
                                                                src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                            <h4>Upload Photos</h4>
                                                            <h5>25 MB Maximum</h5>
                                                        </div>
                                                    </div>
                                             
                                                    <div class="col-sm-12">
                                                        <div class="editImage_clss">
                                                            @if($model_images)
                                                            @foreach ($model_images as $image )
                                                            <div class="edit_img_wrapper">
                                                                <div class="editmake_photo_button">
                                                                    <img id="" style="
                                                                    height: 109px;
                                                                    padding: 10px;" src="{{ $image->getUrl() }}" />
                                                                </div>
                                                              
                                                                 <div class="delete_button button_for_edit">
                                                                    <a style="color:red;" href="javascript:void(0);">Delete</a>
                                                                    <a href="javascript:void(0);">Make Main Photo</a>
                                                                </div>
                                                            </div>
                                                           
                                                            @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="editImgPreview_class" wire:ignore>
                                                                <output id='result2' />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    @error('listing_images')
                                                    <span class="invalid-message" role="alert"
                                                        style="font-size: 12px; color:red;">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror


                                                </div>
                                                <!-- <label>
                             <input type="file">
                             <span>
                                 <i><img src="images/upload-icon.svg" alt=""></i>
                                 Uplode Media
                                 <i>25 MB Maximum</i>
                             </span>
                         </label> -->
                                                {{--
                                            </div> --}}

                                            {{-- <div class="add_listing_col uplode_file_wpr"> --}}
                                                <div class="uploard-top-one">
                                                    Upload Media
                                                </div>
                                                <!-- <div class="uplode_file_box">
                         <input type="file">
                     </div> -->
                                                {{-- <div class="provider_setting_upload_wrap">
                                                    <div class="upload__box">
                                                        <div class="upload__btn-box">
                                                            <label class="upload__btn">
                                                                <span>
                                                                    <i><img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"
                                                                            alt=""></i>
                                                                    Uplode Media
                                                                    <i>25 MB Maximum</i>
                                                                </span>
                                                                <input type="file" data-max_length="20"
                                                                    class="upload__inputfile"
                                                                    wire:model='listing_video'>
                                                            </label>
                                                        </div>
                                                        <div class="upload__img-wrap"></div>

                                                    </div>
                                                    <!-- <label>
                             <input type="file">
                             <span>
                                 <i><img src="images/upload-icon.svg" alt=""></i>
                                 Uplode Media
                                 <i>25 MB Maximum</i>
                             </span>
                         </label> -->
                                                </div> --}}

                                                <div class="row" style="margin-bottom: 31px;">
                                                    <div class="col-sm-5">
                                                        <div class="uploard-logo-one">
                                                            <input type="file" class="uploard-file-one" id="edit_list_video"
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
                                                    <div class="col-sm-5">


                                                        <div class="" wire:ignore>
                                                            <video id="edit_preview_media" width="200" height="147" 
                                                                controls>
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>


                                                    </div>
                                                    <div class="col-sm-5">
                                                        @if($model_video)

                                                        <video id="edit_video" width="230" height="147" controls
                                                            src="{{ $model_video->getUrl() }}" type="video/mp4">
                                                            {{--
                                                            <source src=""> --}}
                                                        </video>
                                                        @endif
                                                    </div>
                                                    {{-- <div class="col-sm-5">
                                                        <div class="uploard-logo-one">
                                                            <video id="preview_media" width="230" height="147"
                                                                style="display:none" controls>
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                        <div class="btn_grp">
                                                            <a class="dlt_btn removeMerchantMedia" href="#"
                                                                style="margin-left: 98px;color: red;">Delete</a>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="btn_foot_end">

                                        <button class="btn_table_s blu addusersubmit" type="submit"
                                            name="submit">Add</button>
                                        <button type="button" class="btn_table_s rdd addUserClose"
                                            wire:click='hideEditModal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end edit listing modal -->

            <!-- success modal  -->
            <div class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="wrap_modal_cntntr">
                                <div class="cmn_secthd_modals">
                                    <h3 id="errormsg"></h3>
                                </div>

                                <div class="cmn_secthd_modals_btnnn">
                                    <div class="btn_foot_end centr">
                                        <button class="btn_table_s blu auto_wd"
                                            onclick="window.location.reload()">ok</button>
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
    <script>
        document.addEventListener('livewire:load', function (event) {
                @this.on('openManageList', function () {
                        $('#manageList').modal('show');
                    });
                @this.on('openAddManage', function () {
                    $("#AddListing").find('form').trigger('reset');
                    //  $("#EditListing").find('form').trigger('reset');
                        $('#AddListing').modal('show');
                    });

                @this.on('closeAddManage', function () {
                    document.querySelector("#preview_media").src = "";
                    let element = document.querySelector('#result');
                    element.innerHTML = "";
                    $('#AddListing').modal('hide');

                    });

                @this.on('showDeactivateModal', function () {
                        $('#CheckBoxpopup').modal('show');
                        @this.get('id');
                       
                    });
                @this.on('successModal', data =>{
                        $('#CheckBoxpopup').hide();
                        $('#manageList').hide();
                        $('#AddListing').hide();
                        $('#EditListing').hide();
                        $('#error_modal').modal('show');
                        //  console.log(data.text);
                        $("#errormsg").html(data.text);
                        
                    })
                @this.on('showEditModal', function () {     
                    $('#EditListing').modal('show');
                });
                   
                @this.on('closeEditManage', function () {
                    document.querySelector("#edit_preview_media").src = "";
                    let element = document.querySelector('#result2');
                    element.innerHTML = "";
                    // document.querySelector("#edit_video").src = "";
                    $('#EditListing').modal('hide');
                        
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
                                    "title='" + picFile.name + "'/></div><div class='delete_button button_for_edit'><a href='' style='color:red;'>Delete</a> <a href=''>Make Main Photo</a></div>";
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
                    document.getElementById("list_video")
                        .onchange = function(event) {
                        let file = event.target.files[0];
                        let blobURL = URL.createObjectURL(file);
                        document.querySelector("#preview_media").src = blobURL;
                        }

                        document.getElementById("edit_list_video")
                        .onchange = function(event) {
                        let file = event.target.files[0];
                        let blobURL = URL.createObjectURL(file);
                        document.querySelector("#edit_preview_media").src = blobURL;
                        }



 

          });
          

        $(document).ready(function () {
          
            // $('input[id="list_photos"]').change(function(e) {
            //         var fileName = e.target.files[0].name;
            //         $("#file").val(fileName);

            //       if(fileName) {
            //         var reader = new FileReader();
            //         reader.onload = function(e) {
            //             // get loaded data and render thumbnail.
            //             document.getElementById("preview_img").src = e.target.result;
            //             $("#preview_img").css('opacity' , '1.6');
                       
            //         };
            //         // read the image file as a data URL.
            //         reader.readAsDataURL(this.files[0]);
            //       }

            //       $("#list_photos").click(function () {    
            //         $('#preview_img').prop('src','{{ asset('admin_assets/media/icon-uploard1.svg') }}');
            //         });
            //     });


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

  
        });
        
    </script>
    @endpush
</div>