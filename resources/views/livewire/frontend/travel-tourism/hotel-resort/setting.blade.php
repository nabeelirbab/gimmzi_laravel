<div>
    @push('style')
    <style>
        .inputSelect_main ul {
            list-style: none;
            padding: 0px;
            width: 250px;
            position: relative;
            margin: 0;
            background: white;
        }

        .inputSelect_main ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .inputSelect_main ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .inputSelect_main ul li:hover {
            cursor: pointer;
        }
        .selectedlisting ul {
            list-style: none;
            padding: 0px;
            width: 250px;
            position: relative;
            margin: 0;
            background: white;
        }
        .selectedlisting ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .selectedlisting ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .selectedlisting ul li:hover {
            cursor: pointer;
        }
    </style>
    @endpush

    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        {{-- <div class="first-smart-rental-sec">
            <div class="container">
                <h2>Search Smart Rental Database</h2>
                <div class="form-group-rental-input">
                    <input type="text" placeholder="Search tenant using First Name, Last Name, or Unit Number....." />
                    <button class="search">
                        <img src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}" alt="" />
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <figure>
                            <img src="{{ $user->travelType->hotel_image }}" alt="" />
                        </figure>
                    </div>
                    <div class="right-sec-rental">
                        <div class="settings_title">
                            <h3 style="margin: 0 0 2px; line-height: 3.23em;">{{ $user->travelType->name }}</h3>
                            <a href="javascript:void(0);" class="edit_provider_btn"
                                wire:click.prevent="editProviderDetail">edit provider details</a>
                        </div>

                        <div class="apartments-sec">
                            <ul>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt="" /></span>Address:
                                            <span><label
                                                    style="padding-left: 5px;">{{ $user->travelType->address }}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span>Mail:<span class="points-distributed-txt"><a
                                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                        </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/star-icon-rental.svg') }}"
                                                    alt="" /></span>Total Points to Distribute:
                                            <span class="points-distributed-txt-new" id="distributePoint"
                                                style="margin-left: 4px;">
                                                {{ number_format($user->travelType->points_to_distribute) }} Points
                                            </span>
                                        </h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="Corporate-Lead_Setting-mid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="corporate-left-mid">
                            <ul>
                                <li class="property-text-one11">Gimmzi Page <a target="_blank" href="{{route('frontend.hotel_resort.hotel-resort-website',base64_encode($this->hotel->id))}}">View your page</a></li>
                                <li class="property-text12">Landing homepage for property listing.</li>
                                <li>
                                    <button class="property-site-text border-0" wire:click.prevent="openSiteSettings"
                                        type="button">Gimmzi Page Settings</button>

                                    <button class="leads-managers" id="manage_contact_id"
                                        wire:click.prevent="showLeadManager" type="button" style="border: none;">Leads
                                        &
                                        managers</button>

                                    <button class="leads-managers"
                                        style="background:#d69414!important;border: none;width: 27.33%;"
                                        wire:click.prevent="showQrCode" type="button" style="border: none;"> QR Code
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="corporate-bottom">
                            <label>About {{$this->hotel->name}}</label>
                            <div class="setting_search_wrap">
                               
                                <div class="setting_search_field" style="width: 100%;">
                                    <textarea wire:model.defer="description"
                                        placeholder="Write about your hotel here" {{$is_readonly}}></textarea>
                                        <div class="edit-textarea" >
                                            <button class="edit-textarea-btn" type="button" wire:click='editHotelDescription'>{{$edit_text}} <img src="{{ asset('frontend_assets/images/edit-icon.svg') }}" alt=""></button>
                                        </div>
                                        <div class="rd-text">
                                            <p>To Add Display Message Board Go To: <a href="{{route('frontend.hotel_resort.message_board')}}">Mesage Board page</a></p>
                                        </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 corporate-right-text">
                        <div class="limit_head" style="margin-left: 30px;">
                            <p style="font-size: 36px;">Limits</p>
                        </div>
                        <ul>

                            <li>Per Day Badge Bonus:
                                <span class="property_term_limit">
                                    {{ $hotel_settings && $hotel_settings->badge_bonus_point ? $hotel_settings->badge_bonus_point : 0 }}

                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive each day of their reservation</li>
                            <li>Add Points:
                                <span class="property_frequency">
                                    {{ $hotel_settings && $hotel_settings->add_point ? $hotel_settings->add_point : 0 }}
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points that are sent when using Add points button</li>
                            <li>Guest Of The Week:
                                <span class="property_current_allowance">
                                    {{ $hotel_settings && $hotel_settings->guest_of_week_point ? $hotel_settings->guest_of_week_point : 0 }}

                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever you recognize them as the guest of
                                the week </li>
                            <li>Double Booker Reward:
                                <span class="property_sign_up">
                                    {{ $hotel_settings && $hotel_settings->double_booker_point ? $hotel_settings->double_booker_point : 0 }}

                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever booking twice in one year</li>
                            <li>Triple Booker Reward:
                                <span class="property_low_point">
                                    {{ $hotel_settings && $hotel_settings->triple_booker_point ? $hotel_settings->triple_booker_point : 0 }}
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever booking three times in one year
                            </li>
                            <li>Live Like A Local Reward:
                                <span class="property_add_point">

                                    {{ $hotel_settings && $hotel_settings->local_reward_point ? $hotel_settings->local_reward_point : 0 }}
                                    Points
                                </span>
                                <a href="javascript:void(0);"
                                    style="text-decoration: underline !important;
                                margin-left: 10px;
                                font-size: 20px;
                                font-weight: 500;color:#26a7df;"
                                    data-backdrop="static" data-keyboard="false" wire:click="manageLimit">Setup</a>
                            </li>
                            <li>This is the number of points a guest receive whenever redeeming a discount or actively
                                enrolling in select merchant's loyal reward program</li>
                            <li class="manage-limits"><button data-backdrop="static" data-keyboard="false"
                                    class="limitModal" wire:click="manageLimit">Manage limits</button></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- provider edit --}}
    <div wire:ignore.self class="modal manage_listing_popup provider_setting_popUp fade" id="provider_detail"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-header detail">
                <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</a>
            </div>
            <div class="modal-content">
                <div class="modal-body manage_listing_popup_body">
                    <form wire:submit.prevent="UpdateProviderDetail">
                        <div class="row provider_setting_rw">
                            <div class="col-lg-8 provider_setting_frm_col">
                                <div class="provider_setting_cmn_wpr">
                                    <div class="provider_setting_frm_head">
                                        <h2>Provider Settings</h2>
                                    </div>
                                    <div class="provider_setting_frm_gruop provider_name_wrap">
                                        <label>Provider name</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_name"
                                                class="provider_name" readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProvidername"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg') }}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_name')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="provider_setting_frm_gruop">

                                        <label>Provider Address</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_address"
                                                class="provider_address" id="autocomplete1" readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click="editProvideraddress"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg') }}"
                                                        alt=""></a>
                                            </div>
                                            <input type="hidden" wire:model.defer="lat" id="latitude">
                                            <input type="hidden" wire:model.defer="long" id="longitude">
                                            <div class="list-address-col-form" style="display:none;">
                                                <label>Zip Code*</label>
                                                <input type="hidden" wire:model.defer="zip_code" id="zipcode"
                                                    readonly>
                                            </div>

                                            <div class="list-address-col-form" style="display:none;">
                                                <label>City*</label>
                                                <input type="hidden" wire:model.defer="provider_city" id="city"
                                                    readonly>
                                            </div>

                                            <div class="list-address-col-form" style="display:none;">
                                                <label>State*</label>
                                                <input type="text" wire:model.defer="provider_state"
                                                    id="state" readonly>
                                                <input type="text" wire:model.defer="state_id" id="state_id"
                                                    readonly>
                                            </div>
                                        </div>
                                        @error('provider_address')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span><br>
                                        @enderror
                                        @error('zip_code')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span><br>
                                        @enderror
                                        @error('state_id')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror


                                    </div>

                                    <div class="provider_setting_frm_gruop">
                                        <label>Provider Email Address</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_email"
                                                class="provider_email" readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProvideremail"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg') }}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_email')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="provider_setting_frm_gruop">
                                        <label>Provider Phone number</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" id="provider_phone"
                                                wire:model.defer="provider_phone" class="provider_phone" readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProviderphone"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg') }}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_phone')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="provider_submitBtn_wrap">
                                        <button type="submit" class="save_provider">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 provider_setting_img_col">
                                <div class="provider_setting_cmn_wpr provider_setting_img_main">

                                    <label>Provider Logo</label>
                                    <div class="provider_setting_large_img">
                                        <img src="{{ $logo }}" alt="" id="previous_logo">
                                    </div>
                                    <div id="shownewlogo" wire:ignore style="display:none;">
                                        <label>Provider New Logo</label>
                                        <div class="provider_setting_large_img">
                                            <img id="new_logo">
                                        </div>
                                    </div>

                                    <div class="provider_setting_upload_wrap">
                                        <label>
                                            <input type="file" id="logoupload" wire:model.defer="provider_logo">
                                            <span>
                                                <i><img src="{{ asset('frontend_assets/images/upload-icon.svg') }}"
                                                        alt=""></i>
                                                Upload Logo
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end provider edit --}}

    {{-- lead manager --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs" id="view_contact_info_modal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">

                <div class="modal-body">
                    <div class="table_user_top_sec_col_lft new">

                        <h3></h3>

                    </div>

                    <div class="table_cmn_part_sgn">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Ext</th>
                                    <th>Email Address</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($managers as $user)
                                    <tr id="removeuser_id{{ $user->id }}">
                                        <td></td>
                                        <td id="">{{ $user->full_name }}</td>
                                        <td>{{ $user->title->title_name }}</td>
                                        @if ($user->phone != '')
                                            <td>{{ $user->phone }}</td>
                                        @else
                                            <td>---</td>
                                        @endif
                                        @if ($user->phone_ext != '')
                                            <td>{{ $user->phone_ext }}</td>
                                        @else
                                            <td>---</td>
                                        @endif
                                        <td>{{ $user->email }}</td>
                                        @if ($user->id != Auth::user()->id)
                                            <td>
                                                <div class="selctd_table_sec">
                                                    <button class="btn btn-danger"
                                                        wire:click.prevent="showRemoveManager({{ $user->id }})">Remove</button>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="selctd_table_sec">
                                                    ---
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <td>No User found</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <form wire:submit.prevent="activeManager">
                                    <div class="selctd_table_sec large">
                                        <select id="available_user" wire:model="manager_id">
                                            <option value="">Choose Available Management Level User</option>
                                            @foreach ($deactive_managers as $deactives)
                                                <option value="{{ $deactives->id }}">{{ $deactives->full_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('manager_id')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="cmn_links_clkd">
                                        <input type="hidden" id="add_user_id">
                                        <button type="submit" class="btn"
                                            style="text-decoration: underline !important;color: #208ccb;"
                                            id="adduser">Add User</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6 option_avlbl_col_rght">
                                <div class="btn_foot_end">
                                    <a href="javascript:void(0)" class="btn_table_s rdd"
                                        data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- lead manager --}}

    {{-- remove lead manager --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeuser_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">
                            <h4>By removing, the user below will no longer have access to your provider portal</h4>
                            <h3 id="user_name"></h3>
                            <h4>Do you want to continue?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="removeManager">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- remove lead manager --}}

    {{-- Listing site settings --}}

    <div wire:ignore.self class="modal fade new-fade-modal-property-site-setting md-modal-property-site-setting white-modal"
        id="property_settingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-header">
                    <div class="modal-heading-property-site-setting w-100">
                        <h1>Gimmzi Page Settings</h1>
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="property-site-setting-website">
                        <div class="row">
                            <h3 style="margin-left: 17px;">{{ $travel_tourism->name }}</h3>
                        </div>
                        <div class="row m-0">
                            <div class="col-lg-6 property-site-setting-website11">
                                <div class="">
                                    <div class="property-website-con">
                                        <h4>Gimmzi Page</h4>
                                        <div class="property-contain-r">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    wire:model.defer="listing_website"
                                                    wire:click.prevent="updateListingWebsiteStatus(1)" value="1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    wire:model.defer="listing_website"
                                                    wire:click.prevent="updateListingWebsiteStatus(0)" value="0">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="external-links-text1">External links connected to buttons on <b>Listing</b>
                                        page
                                        <a href="javascript:void(0);" class="external_manage"
                                            wire:click='externalLinkModal'>Manage</a>
                                    </div> --}}
                                    <div class="featured-mid-con">
                                        <span>Features</span>
                                        <a href="javascript:void(0);" wire:click="featureView"
                                            class="feature_view">View</a>
                                        <a href="javascript:void(0);" class="feature_manage"
                                            wire:click="featureManage">Manage</a>
                                        <span>Amenities</span>
                                        <a href="javascript:void(0);" class="amenity_view"
                                            wire:click='amenityView'>View</a>
                                        <a href="javascript:void(0);" class="amenity_manage"
                                            wire:click="amenityManage">Manage</a>
                                    </div>
                                    <div class="featured-mid-con bd-none" style="border-bottom: none;">
                                        {{-- <span>External links connected to buttons</span> --}}
                                    </div>



                                    <form wire:submit.prevent="updateExternalLink" id="editListId">
                                        <div class="modal-body">
                                            <div class="table_user_top_sec_col_lft new">
                                                <h3>External links connected to buttons</h3>
                                            </div>
                    
                                            <div class="table_cmn_part_sgn">
                                                <table>
                                                    <thead>
                                                        {{-- <tr>
                                                            <th>Name</th>
                                                            <th style="text-align: center;">URL/Source/Destination</th>
                                                            
                                                        </tr> --}}
                                                    </thead>
                                                    <tbody id="external_Data">

                                                        <tr>
                                                            <td>Book Online/Check Availability</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="book_online" class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('book_online')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Contact Host</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="contact_community_url" id="contact_host" class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('contact_community_url')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                           
                                                        </tr>

                                                        <tr>
                                                            <td>Request Info</td>
                                                            <td style="text-align: center;">
                                                                <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu" wire:click = "openFormEmails" >Add/Edit Email</a>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Location</td>
                                                            <td style="text-align: center;">
                                                                <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu" wire:click = "openSetLocation">Set Location</a>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Visit Direct Website</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="direct_website" class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('direct_website')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer not_last">
                                            <div class="modal-footer-gap-none">
                                                <div class="new-gm-btn-wrap">
                                                    <div class="new-gm-btn-wrap-left">
                                                        <a target="_blank" href="{{route('frontend.hotel_resort.hotel-resort-website',base64_encode($this->hotel->id))}}" class="btn-blue-outline">Preview Gimmzi Site</a>
                                                    </div>
                                                    <div class="btn_foot_end">
                                                        <button type="submit" class="btn_table_s grn">Save</button>
                                                        {{-- <a href="javascript:void(0)" class="btn_table_s rdd"
                                                            data-bs-dismiss="modal">Close</a> --}}
                                                    </div>
                                                </div>
                                                {{-- <div class="row option_avlbl_row align-items-center gy-2">
                                                    <div class="col-lg-6 option_avlbl_col_lft">
                                                    </div>
                                                    <div class="col-lg-6 option_avlbl_col_rght">
                    
                                                        <div class="btn_foot_end">
                                                            <button type="submit" class="btn_table_s grn">Save</button>
                                                            <a href="javascript:void(0)" class="btn_table_s rdd"
                                                                data-bs-dismiss="modal">Close</a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                            <div class="col-lg-6 property-left-right-space">
                                <div class="row">
                                    <div class="col-md-5 contact-info-con-top">
                                        {{-- Contact info <a href="#view_contact_info_modal" data-bs-toggle="modal"
                                                role="button">View</a> <a href="#manage_contact_info_modal"
                                                data-bs-toggle="modal" role="button">Manage</a> --}}
                                    </div>
                                    <!-- <div class="col-md-7 contact-info-con-top property-left-right-space">
                                        Property Type Currnet : Standard <a href="#">Change</a>
                                    </div> -->
                                </div>

                                <div class="uploard-top-one">
                                    Upload Photos
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="uploard-logo-one">
                                            <input type="file" class="uploard-file-one" multiple id="edit_photos"
                                                wire:model.defer='listing_images' accept="image/*" />
                                            <img
                                                src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                            <h4>Upload Photos</h4>
                                            <h5>10 MB Maximum</h5>
                                        </div>
                                    </div>


                                    <div class="col-sm-5">
                                        @if ($main_image)
                                            <div class="uploard-logo-one">
                                                <input type="file" class="uploard-file-one" />
                                                <img style="height: 125px;padding: 10px;"
                                                    src="{{ asset($main_image) }}" id="main_photo" />
                                            </div>
                                            <div class="delete_button" style="display: block;">
                                                <a style="color:red;" href="javascript:void(0);"
                                                    wire:click='deleteEditMainPhoto({{ $hotel->id }})'>Delete</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="editImage_clss" id="photo_preview">
                                            @if ($model_images)
                                                @foreach ($model_images as $image)
                                                    <div class="edit_img_wrapper">
                                                        <div class="editmake_photo_button">
                                                            <img id="" style="height: 109px;padding: 10px;"
                                                                src="{{ $image->getUrl() }}" />
                                                        </div>

                                                        <div class="delete_button button_for_edit">
                                                            <a style="color:red;" href="javascript:void(0);"
                                                                wire:click="deleteEditListPhoto({{ $image->id }})">Delete</a>
                                                            <a href="javascript:void(0);"
                                                                wire:click="makeEditMainPhoto({{ $image->id }})">Make
                                                                Main Photo</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @error('listing_images')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                </div>
                                <div class="uploard-top-one">
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
                                            <h5>10 MB Maximum</h5>
                                        </div>

                                        @error('listing_videos')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">

                                        <div class="" wire:ignore>
                                            <video style="display:none;" id="edit_preview_media" width="200"
                                                height="147" controls>
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>


                                    </div>
                                    <div class="col-sm-5">
                                        @if ($model_video)
                                            <video id="edit_video" width="230" height="147" controls
                                                src="{{ $model_video->getUrl() }}" type="video/mp4">
                                                {{--
                                            <source src=""> --}}
                                            </video>
                                            <div class="delete_button" style="display: block;">
                                                <a style="color:red;" href="javascript:void(0);"
                                                    wire:click='deleteEditMedia()'>Delete</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- success modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="user_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="hideSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- success modal end --}}


    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="feature_success_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="featuremsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideFeatureSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab"
                                            data-bs-target="#about" href="javascript:void(0);">Amenities</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @forelse ($features as $feature_data)
                                                <div class="feature-list">
                                                    <p>{{ $feature_data->feature_text }}</p>
                                                </div>

                                            @empty
                                                <div class="feature-list">
                                                    <p>There are no features</p>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @forelse ($amenities as $amenity_data)
                                                <div class="feature-list">
                                                    <p>{{ $amenity_data->amenity_text }}</p>
                                                </div>
                                            @empty
                                                <div class="feature-list">
                                                    <p>There are no amenities</p>
                                                </div>
                                            @endforelse
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
                                    <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Feature add-edit modal start --}}
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
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @if (count($features) > 0)
                                                @foreach ($features as $feature_data)
                                                    <div class="feature-list">
                                                        <p>{{ $feature_data->feature_text }}</p>
                                                        <div class="feaure-btn">
                                                            <a href="javascript:void(0);" class="edit-btn"
                                                                wire:click="editFeature({{ $feature_data->id }})">Edit</a>|
                                                            <a href="javascript:void(0);" class="rmve-btn"
                                                                wire:click="removeFeature({{ $feature_data->id }})">Remove</a>
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
                                         @if (count($amenities) > 0)
                                         @foreach ($amenities as $amenity_data)
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
                                        <input type="text" placeholder="Enter text"
                                            wire:model.defer="hotel_feature">
                                        <input type = "hidden" wire:model.defer = "feature_id">
                                    </div>

                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd"
                                            wire:click="closeFeatureManage">Close</button>
                                    </div>
                                </div>
                                @error('hotel_feature')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
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
    {{-- end Feature add-edit modal end --}}

    {{-- amenities add-edit modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="amenitiesManageModal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Amenities</a>
                                    </li>
                                    {{-- <li class="nav-item" disabled>
                                   <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"  href="javascript:void(0);">Amenities</a>
                                 </li> --}}
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if (count($amenities) > 0)
                                                @foreach ($amenities as $amenity_data)
                                                    <div class="feature-list">
                                                        <p>{{ $amenity_data->amenity_text }}</p>
                                                        <div class="feaure-btn">
                                                            <a href="javascript:void(0);" class="edit-btn"
                                                                wire:click="editAmenities({{ $amenity_data->id }})">Edit</a>|
                                                            <a href="javascript:void(0);" class="rmve-btn"
                                                                wire:click="removeAmenities({{ $amenity_data->id }})">Remove</a>
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
                                        <input type="text" placeholder="Enter text"
                                            wire:model.defer="hotel_amenity">
                                        <input type = "hidden" wire:model.defer = "amenity_id">
                                    </div>

                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd"
                                            wire:click="closeAmenityManage">Close</button>
                                    </div>
                                </div>
                                @error('hotel_amenity')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
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
    {{-- end amenities add-edit modal end --}}


    <!-- external link manage modal -->
    {{-- <div wire:ignore.self class="modal fade cmn_modal_designs" id="external_link_modal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border:2px solid #000;">
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
                                        <td>Contact Us</td>
                                        <td style="text-align: center;"><input type="text"
                                                wire:model.defer="contact_community_url" class="form-control"
                                                style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br>
                                            @error('contact_community_url')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1"
                                                wire:model.defer="contact_community_check"></td>
                                    </tr>
                                    <tr>
                                        <td>View Event Flyer</td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu"
                                                wire:click='viewEventFlyerImages'>Manage Event Flyer Images</a>
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1"
                                                id="event_flyer_check" wire:model.defer="event_flyer_display"></td>
                                    </tr>

                                    <tr>
                                        <td>Book Online</td>
                                        <td style="text-align: center;"><input type="text"
                                                wire:model.defer="book_online" class="form-control"
                                                style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br>
                                            @error('book_online')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1"
                                                wire:model.defer="book_online_check"></td>
                                    </tr>

                                    <tr>
                                        <td>Guest Portal</td>
                                        <td style="text-align: center;"><input type="text"
                                                wire:model.defer="guest_portal" class="form-control"
                                                style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br>
                                            @error('guest_portal')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1"
                                                wire:model.defer="guest_portal_check"></td>
                                    </tr>
                                    <tr>
                                        <td>Visit Direct Website</td>
                                        <td style="text-align: center;"><input type="text"
                                                wire:model.defer="direct_website" class="form-control"
                                                style="width: 100%;border: 1px solid #b7aeae!important;">
                                            <br>
                                            @error('direct_website')
                                                <span class="invalid-message" role="alert"
                                                    style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </td>
                                        <td style="text-align: center;"><input type="checkbox" class="assign-one1"
                                                wire:model.defer="direct_website_check"></td>
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
                                        <button type="submit" class="btn_table_s grn">Save</button>
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
    </div> --}}
    <!-- end external link manage modal -->

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="external_success_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="externalmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideExternalSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Event flyer start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs" id="EventFlyerimageModal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 45%!important;">
            <div class="modal-content" style="background-color:#d6d5d5!important;">
                <form wire:submit.prevent='uploadFlyerManager'>
                    <div class="modal-body">
                        <div class="table_user_top_sec_col_lft new">
                            <h3>Event Flyer Manager</h3>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="uploard-logo-one">
                                    <input type="file" class="uploard-file-one" id="flyer_image1"
                                        name="flyer_image1" wire:model='flyer_image1' accept="image/*" />
                                    @if ($flyer_image1)
                                        <img src="{{ $flyer_image1->temporaryUrl() }}" alt=""
                                            id="flyerimage1_preview" height="149" width="140">
                                    @elseif ($model_flyer_image1)
                                        <img src="{{ $model_flyer_image1->getUrl() }}" alt=""
                                            id="flyerimage1_preview" height="149" width="140">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"
                                            id="flyerimage1_preview" />
                                        {{-- <h4 id="flyerimage1_title">Flyer Image #1</h4> --}}
                                    @endif
                                </div>
                                <div class="btn_grp" style="text-align: center;">
                                    @if ($model_flyer_image1)
                                        <a class="dlt_btn removeFlyerImage2" style="color: #ff2719;"
                                            href="javascript:void(0);"
                                            wire:click='flyerImageDelete({{ $model_flyer_image1->id }})'>Delete</a>
                                    @endif
                                </div>
                                @error('flyer_image1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="uploard-logo-one">
                                    <input type="file" class="uploard-file-one" id="flyer_image2"
                                        name="flyer_image2" wire:model='flyer_image2' accept="image/*" />
                                    @if ($flyer_image2)
                                        <img src="{{ $flyer_image2->temporaryUrl() }}" alt=""
                                            id="flyerimage1_preview" height="149" width="140">
                                    @elseif ($model_flyer_image2)
                                        <img src="{{ $model_flyer_image2->getUrl() }}" alt=""
                                            id="flyerimage1_preview" height="149" width="140">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"
                                            id="flyerimage1_preview" />
                                        {{-- <h4 id="flyerimage1_title">Flyer Image #1</h4> --}}
                                    @endif
                                </div>
                                <div class="btn_grp" style="text-align: center;">
                                    @if ($model_flyer_image2)
                                        <a class="dlt_btn removeFlyerImage2" style="color: #ff2719;"
                                            href="javascript:void(0);"
                                            wire:click='flyerImageDelete({{ $model_flyer_image2->id }})'>Delete</a>
                                    @endif

                                </div>
                                @error('flyer_image2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer not_last">
                        <div class="modal-footer-gap-none">
                            <div class="row option_avlbl_row align-items-center gy-2">

                                <div class="col-lg-12 option_avlbl_col_rght">

                                    <div class="btn_foot_end">
                                        <button type="submit" class="btn_table_s grn" name="submit">Save</button>
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
    {{-- Event flyer end --}}


    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="img_delete_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmessage"></h3>
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

    {{-- Limit setting modal start --}}

    <div data-bs-backdrop='static' wire:ignore.self class="modal common-border-modal limitSetting-modal fade"
        id="limitSetting_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Limit Settings</h5>
                    <a href="javascript:void(0);" class="page-btn page-btn-red"
                        wire:click.prevent="settingCancel">CLOSE</a>
                </div>
                <div class="modal-body common-modal-body">
                    <div class="row limitSetting_rw">
                        <div class="col-md-6 limitSetting_col">
                            <div class="limitTime_main">
                                <div class="limitTime_innr">
                                    <label>Check In Time:</label>
                                    <div class="limitTime_field_wrap">
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkin_hour">
                                        <p>:</p>
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkin_min">
                                        <select wire:model.defer="checkin_time">
                                            <option value="">--</option>
                                            <option value="PM">PM</option>
                                            <option value="AM">AM</option>
                                        </select>
                                    </div>
                                    <a href="javascript:void(0);" wire:click="updateCheckinTime"
                                        class="setting_timing">Update</a>
                                </div>
                                @error('checkin_hour')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                                @error('checkin_min')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                                @error('checkin_time')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                                <div class="limitTime_innr">
                                    <label>Check Out Time:</label>
                                    <div class="limitTime_field_wrap">
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkout_hour">
                                        <p>:</p>
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkout_min">
                                        <select wire:model.defer="checkout_time">
                                            <option value="">--</option>
                                            <option value="PM">PM</option>
                                            <option value="AM">AM</option>
                                        </select>
                                    </div>
                                    <a href="javascript:void(0);" wire:click="updateCheckoutTime"
                                        class="setting_timing">Update</a>
                                </div>
                                @error('checkout_hour')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                                @error('checkout_min')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                                @error('checkout_time')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span><br>
                                @enderror
                            </div>

                            {{-- <div class="point-about-con limit-setting-top">

                                <div class="curent-text1">
                                    Current term limit: {{$this->term_limit}}
                                </div>
                                <div class="point-minium point-top-one14">
                                    <span class="form-check">
                                        <input class="form-check-input update_term_limit" type="radio"
                                            wire:model.defer="term_limit" value="1 year"  wire:click.prevent = "updateTermLimit('1 year')">
                                        <label class="form-check-label" for="1_year">
                                            1 Year
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <input class="form-check-input update_term_limit" type="radio"
                                        wire:model.defer="term_limit"  value="2 year"  wire:click.prevent = "updateTermLimit('2 year')">
                                        <label class="form-check-label" for="2_year">
                                            2 Year
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <input class="form-check-input update_term_limit" type="radio"
                                        wire:model.defer="term_limit"  value="3 year"  wire:click.prevent = "updateTermLimit('3 year')">
                                        <label class="form-check-label" for="3_year">
                                            3 Year
                                        </label>
                                    </span>
                                    <span class="form-check">
                                        <input class="form-check-input update_term_limit" type="radio"
                                        wire:model.defer="term_limit" wire:click.prevent = "updateTermLimit('5 year')" value="5 year">
                                        <label class="form-check-label" for="5_year">
                                            5 Year
                                        </label>
                                    </span>
                                </div>
                            </div> --}}
                            <p></p>

                            <div class="cmnLimit_setting_main">
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Per Day Badge</strong>
                                        points:
                                        {{ $hotel_settings && $hotel_settings->badge_bonus_point ? $hotel_settings->badge_bonus_point : 0 }}
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="badge_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click="updateBadge"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('badge_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p>Add points:

                                        {{ $hotel_settings && $hotel_settings->add_point ? $hotel_settings->add_point : 0 }}
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="add_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateAddPoint"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('add_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Guest of The Week</strong>:
                                        {{ $hotel_settings && $hotel_settings->guest_of_week_point ? $hotel_settings->guest_of_week_point : 0 }}
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="guest_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateGuest"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('guest_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Double Booker</strong>:
                                        {{ $hotel_settings && $hotel_settings->double_booker_point ? $hotel_settings->double_booker_point : 0 }}
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="double_point"
                                            onkeypress="return isNumber(event);">
                                        <p>50 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateDouble"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('double_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Triple Booker</strong>:
                                        {{ $hotel_settings && $hotel_settings->triple_booker_point ? $hotel_settings->triple_booker_point : 0 }}
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="triple_point"
                                            onkeypress="return isNumber(event);">
                                        <p>75 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateTriple"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('triple_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Low Point Balance </strong>:<span class="low_point"></span>  @if($property_limit){{ $property_limit->low_point_balance }} points @endif
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="low_point"
                                            onkeypress="return isNumber(event);">
                                        <p>100 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent='updateLimitSettings("low_point")'
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('low_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 limitSetting_col">
                            <div class="cmnLimit_setting_inner">
                                <p><strong>Live like a local</strong> points:
                                    {{ $hotel_settings && $hotel_settings->local_reward_point ? $hotel_settings->local_reward_point : 0 }}
                                    points
                                </p>
                                <div class="cmnLimit_setting_field_wrap">
                                    <input type="text" wire:model.defer="local_point"
                                        onkeypress="return isNumber(event);">
                                    <p>200 points minimum</p>
                                    <a href="javascript:void(0);" wire:click.prevent="updateLocal"
                                        class="blue_btn">update</a>
                                </div>
                                @error('local_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <p>From the list below, you must select at least 5 and up to 10 merchants. If a member who
                                has been awarded a badge
                                uses a Gimmzi Smart Rewards discount or enrolls in an active loyalty plan with at least
                                5 of the selected merchants during their stay
                                they will receive an Live Like a Local Reward</p>
                            <div class="inputSelect_main">
                                <div class="inner_input_sec">
                                    <input type="text" placeholder="Search using marchant name"
                                        wire:model.defer="search_text" wire:keyup="searchResult">
                                    @if ($showdiv)
                                        <ul>
                                            @if (!empty($result))
                                                @foreach ($result as $result_data)
                                                    <li wire:click="merchantBusiness({{ $result_data->id }})"
                                                        style="cursor:pointer;">
                                                        {{ $result_data->business_name }}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                                <select wire:model.defer="search_filter" wire:change="filterWiseBusiness">
                                    <option value="all">All</option>
                                    @foreach ($business_type as $type)
                                        <option value="{{ $type->id }}">{{ $type->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="limitSetting_table_wrap new_table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Marchant ({{ $travel_merchant_count ?? 0 }}/{{ $business_count }}
                                                selected)
                                            </th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($merchants) > 0)
                                            @foreach ($merchants as $business)
                                                <tr>
                                                    <td>
                                                        <p><strong>{{ $business->business_name }}</strong></p>
                                                        <p>{{ $business->head_location }}</p>
                                                    </td>
                                                    <td>
                                                        <div class="form_input_check mange_check_box">
                                                            <label>
                                                                @if ($business->travelMerchant($hotel->id, $business->id) == true)
                                                                    <input type="checkbox" value="1"
                                                                        name="tableOne"
                                                                        wire:click.prevent="checkMerchant({{ $business->id }})"
                                                                        checked>
                                                                @else
                                                                    <input type="checkbox" value="1"
                                                                        name="tableOne"
                                                                        wire:click.prevent="checkMerchant({{ $business->id }})">
                                                                @endif
                                                                <span></span>
                                                            </label>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2">No businesses in this category in your area, please
                                                    select a different category</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Limit setting modal end --}}


    {{-- Merchant count modal start --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="merchant_count_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="merchantmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="hideCountModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Merchant count modal end --}}

        {{-- Add/edit emails for request info --}}

        <div wire:ignore.self class="modal common-border-modal AddEditEmail fade" id="emailAddressModal" tabindex="-1"aria-labelledby="AddEditEmail" aria-hidden="true">
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
                            <img class="itrip-logo-img" src="{{$this->hotel->hotel_image}}" alt="title">
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
    
        {{-- Set location modal --}}
        <div wire:ignore.self class="modal common-border-modal Setlocation-modal fade" id="SetLocation" tabindex="-1"
        aria-labelledby="SetLocation" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1100px;">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body common-modal-body">
                    <h4 class="manage-title">Hotel Address</h4>
                    <form wire:submit.prevent="updateLocation">
                        <div class="row list-address-row">
                            <div class="col-lg-6 list-address-column">
                                    <div class="list-address-col-form" >
                                        <label>Enter Hotel Address*</label>
                                        <input wire:ingore type="text" wire:model.defer="address" id="hotel_location" autocomplete="off" >
                                    </div>
                                    <input type="hidden" wire:model.defer="lat" id="latitude" >
                                    <input type="hidden" wire:model.defer="long" id="longitude" >
                                    <input type="hidden" wire:model.defer="zip_code" id="zipcode" readonly>
                                    <input type="hidden" wire:model.defer="city" id="city"readonly>
                                    <input type="hidden" wire:model.defer="state_name" id="state" readonly>
                                    <input type="hidden" wire:model.defer="state_id" id="state_id" readonly>
                                    @error('address')
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


    {{-- Limit success modal start --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="limit_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="limitsuccessmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="hideLimitSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Limit success modal end --}}

     {{-- QR modal start --}}
        <div wire:ignore.self class="modal qrscanModal_popUp fade" id="qrscanModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="closeBtn_wrap">
                            <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal"
                                aria-label="Close">cancel</a>
                        </div>

                        <div class="new_col">
                            <label>Select Building</label>
                            <select wire:model.live='search_building' wire:click="select_building">
                                <option value="all">Select Building</option>
                                @if($buldingList)
                                    @foreach ($buldingList as $building_result_data)
                                        <option value="{{$building_result_data->id}}">{{$building_result_data->building_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div><br>                        {{-- <div class="closeBtn_wrap d-flex gap-2 ">
                            <input type="text" placeholder="Search building for building name."
                            wire:model.defer="search_building" wire:keyup="searchBuilding">
                            
                            <a href="javascript:void(0);" class="setting_timing d-flex align-items-center" wire:click="resetBuilding">Reset</a>
                            
                        </div>
                        <div class="selectedlisting">
                        @if($buildingShowdiv)
                            <ul>
                                @if(!empty($buildingResult))
                                @foreach($buildingResult as $building_result_data)

                                <li wire:click="autocompleteBuildingSelect({{ $building_result_data->id }})">{{$building_result_data->building_name}}</li>

                                @endforeach
                                @endif
                            </ul>
                        @endif
                        </div> --}}
                        <div class="closeBtn_wrap d-flex gap-2 selectedlisting">
                            {{-- <label>Search Unit</label> --}}
                            <input type="text" placeholder="Search for unit using unit name"
                            wire:model.defer="search_listing" wire:keyup="searchListing">
                            
                            <a href="javascript:void(0);" class="setting_timing d-flex align-items-center" wire:click="resetListing">Reset</a>
                            
                        </div>
                        <div class="selectedlisting">
                        @if($showdiv)
                            <ul>
                                @if(!empty($result))
                                @foreach($result as $result_data)

                                <li wire:click="autocompleteListingSelect({{ $result_data->id }})">{{$result_data->unit_name}}</li>

                                @endforeach
                                @endif
                            </ul>
                        @endif
                        </div>
                        <div class="qrscanModal_body_innr">
                            {{-- <h2>Welcome to {{$selected_listing_city}},{{$selected_listing_state}}!</h2> --}} 
                            <p class="subtitle"><strong>We're excited to have you as our guest at {{$hotel_name}}!
                                </strong>
                            </p>
                            <p>As a thank you for staying with us, we'd like to introduce you
                                to <a href="javascript:void(0);">Gimmzi Smart Rewards</a>– a new way to discover
                                local attractions and businesses while earning rewards.
                            </p>
                            <p>Simply scan the QR code with your smartphone and you'll be directed
                                to the Gimmzi app. From there, you can browse through a list of local
                                businesses that participate in our rewards program. By checking in, making a
                                purchase, or referring a friend, you'll earn points that you can
                                redeem for discounts, freebies, and more.</p>
                            <p>Here are just a few examples of the rewards you can earn:</p>
                            <div class="qrCode_rw">
                                <div class="qrTxt_col">
                                    <p>Free coffee at a nearby café</p>
                                    <p>10% off your bill at a popular restaurant</p>
                                    <p>A free mini-golf game at a local attraction</p>
                                    <p>A discount on a spa treatment at a nearby resort</p>
                                    <span class="partner_logo_wrap"><img
                                            src="{{ asset('frontend_assets/images/gimmzilogo.jpg')}}" alt=""></span>
                                </div>
                                <div class="qaCode_col">
                                    <div class="qrCode_wrap">
                                        @if($qr_image)
                                        <span>
                                            <img id="qr_img" src="data:image/png;base64, {{$qr_image}}">
                                            {{-- <img id="qr_img" src="{{ asset('frontend_assets/images/qr-code.png')}}"
                                                alt=""> --}}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="print_dwnlad_wrap">
                                <input type="hidden" value="{{$text}}" id="myInput">
                                {{-- <a href="{{route('printPdf',$hotel->id)}}" class="btnprn">[Print]<span><img
                                            src="{{ asset('frontend_assets/images/print-icon.svg')}}" alt=""></span></a>
                                --}}
                                {{-- <a href="javascript:void(0);" onclick="printFunction()">[Print]<span><img
                                            src="{{ asset('frontend_assets/images/print-icon.svg')}}" alt=""></span></a>
                                --}}
                                @if($selected_listing_name != '---')
                                    <a href="{{route('downloadPdf',$hotel->id)}}">[Download]<span><img
                                                src="{{ asset('frontend_assets/images/download.svg')}}" alt=""></span></a>
                                    <a href="javascript:void(0);" onclick="myFunction()">[Copy Link]<span><img
                                                src="{{ asset('frontend_assets/images/copy_link.svg')}}" alt=""></span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- QR modal end --}}

    {{-- Success model QR--}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="qr_success_model" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="qrMessage"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd hide_qr_success_model" wire:click="hide_qr_success_model">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--end--}}



    @push('scripts')
    <script async defer type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>
    <script>
        function isNumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        function myFunction(){
            var copyText = document.getElementById("myInput");
            console.log(copyText);
            navigator.clipboard.writeText(copyText.value);
            alert('Link Copied');
            
        }
        
        // $(".hide_qr_success_model").click(function() {
        //     $('#qr_success_model').modal('hide');
        // })

        document.addEventListener('livewire:load', function(event) {

            window.livewire.on('openQrCode', data => {
                $('#qrscanModal').modal('show');
                $("#qr_img").attr('src','data:image/png;base64, '+data.png);
            
            });
            window.livewire.on('openQrSuccess', data => {
                $('#qr_success_model').modal('show');
                $("#qrMessage").html(data.text);      
            });

            window.livewire.on('showProviderDetailModal', function() {
                $('#provider_detail').modal('show');
            });
            window.livewire.on('editProviderName', function() {
                $('.provider_name').removeAttr('readonly', false);
            });
            window.livewire.on('editProviderAddress', function() {
                $('.provider_address').removeAttr('readonly', false);
            });

            window.livewire.on('editProviderEmail', function() {
                $('.provider_email').removeAttr('readonly', false);
            });

            window.livewire.on('editProviderPhone', function() {
                $('.provider_phone').removeAttr('readonly', false);
            });

            window.livewire.on('showLeadManager', function() {
                $('#view_contact_info_modal').modal('show');
            });

            window.livewire.on('showRemoveModal', data => {
                $('#removeuser_modal').modal('show');
                $("#user_name").html(data.name);
            });

            window.livewire.on('userSuccessModal', data => {
                $('#user_success_modal').modal('show');
                $("#successmsg").html(data.text);
            });


            window.livewire.on('hideUserSuccessModal', function() {
                $('#user_success_modal').modal('hide');
                $('#removeuser_modal').modal('hide');
            });

            window.livewire.on('siteSettingsModal', function() {
                $('#property_settingModal').modal('show');
            });

            @this.on('featureList', data => {
                $('#featureAmenityModal').modal('show');
            });

            @this.on('amenityList', data => {
                $('#featureAmenityModal').modal('show');
                $('#home-tab').removeClass('active');
                $('#about-tab').addClass('active');
                $('#about-tab').addClass('show');
                $('#home').removeClass('active');
                $('#home').removeClass('show');
                $('#about').addClass('active');
                $('#about').addClass('show');

            });
            @this.on('featureManageOpen', function() {
                $('#featureManageModal').modal('show');
            });

            @this.on('featureManageClose', function() {
                $('#featureManageModal').modal('hide');
            });

            @this.on('amenityManageOpen', function() {
                $('#amenitiesManageModal').modal('show');
            });

            @this.on('amenityManageClose', function() {
                $('#amenitiesManageModal').modal('hide');
            });

            @this.on('featureSuccessModal', data => {
                $('#feature_success_modal').modal('show');
                //  console.log(data.text);
                $("#featuremsg").html(data.text);

            });
            @this.on('featureManageClose', function() {
                $('#featureManageModal').modal('hide');
            });
            @this.on('hidefeaturesuccessModal', function() {
                $('#feature_success_modal').modal('hide');
            });

            @this.on('openExternalLinkModal', data => {
                $('#external_link_modal').modal('show');
                $("#listingName").html(data.listing_name);

            });

            @this.on('exteralSuccessModal', data => {
                $('#external_success_modal').modal('show');
                $("#externalmsg").html(data.text);

            });
            @this.on('hideExternalsuccessModal', function() {
                $('#external_success_modal').modal('hide');
                $('#SetLocation').modal('hide');
                $("#emailAddressModal").modal('hide');
            });

            @this.on('openFromEmail', data => {
                $('#emailAddressModal').modal('show');

            });
            @this.on('viewRequstInfo', data => {
                $('#requestinfoform').modal('show');
                $('#shortTermname').html(data.name);
                $('.multiSelect2').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    closeOnSelect: false,
                });
            });
            @this.on('viewEventFlyerImages', data => {
                $('#EventFlyerimageModal').modal('show');
            });

            @this.on('flyerImageSaveSuccess', data => {
                $('#img_delete_success_modal').modal('show');
                $('#successmessage').html(data.text);
            });
            @this.on('manageLimit', data => {
                $('#limitSetting_modal').modal('show');

            });
            @this.on('merchantSuccessModal', data => {
                $('#merchant_count_modal').modal('show');
                $("#merchantmsg").html(data.text);
            });
            @this.on('hideCountModal', data => {
                $('#merchant_count_modal').modal('hide');
            });

            @this.on('openFromEmail', data =>{
                $('#emailAddressModal').modal('show');
            });
            @this.on('limitSuccessModal', data => {
                $('#limit_success_modal').modal('show');
                $("#limitsuccessmsg").html(data.text);
            });
            @this.on('hideLimitSuccessModal', data => {
                $('#limit_success_modal').modal('show');
                $('#limit_success_modal').modal('hide');
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

            @this.on('hide_qr_success_model', data => {
                $('#qr_success_model').modal('hide');
            });

            @this.on('closeFromEmailAddress',function(){
                $('#emailAddressModal').modal('hide');
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

            $("#hotel_location").on('keyup', function(){
                   
                   var input = document.getElementById('hotel_location');
                   var autocomplete = new google.maps.places.Autocomplete(input);
                   autocomplete.setComponentRestrictions({'country': ['us']});
                   google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                       var place = autocomplete.getPlace();
                       console.log(place);
                       
                       $('#latitude').val(place.geometry['location'].lat());
                       $('#longitude').val(place.geometry['location'].lng());
                       @this.set('lat', place.geometry['location'].lat());
                       @this.set('long', place.geometry['location'].lng());
                       @this.set('address', place.formatted_address);
                       
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

            window.onload = function() {
                if (window.File && window.FileList && window.FileReader) {
                    var filesInput = document.getElementById("property_photos");
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
                                div.innerHTML =
                                    "<div class='editmake_photo_button'><img class='thumbnail' src='" +
                                    picFile.result + "'" +
                                    "title='" + picFile.name + "'/>" +
                                    "</div>" +

                                    "<div class='delete_button button_for_edit'>" +
                                    "<a style='color:red;' href='javascript:void(0);' >Delete</a>" +
                                    "<a href='javascript:void(0);' class='make_main' data = '" +
                                    i + "' >Make Main Photo</a>" +

                                    "</div>";
                                output.insertBefore(div, null);
                                @this.set('listing_images', event.target);
                            });
                            //Read the image
                            picReader.readAsDataURL(file);
                        }
                        setTimeout(function() {

                            $(".make_main").on('click', function() {
                                var src = $(this).parent().parent().find(
                                        '.editmake_photo_button').find('.thumbnail')
                                    .attr('src');
                                // var data = $(this).attr('data');
                                // var url = picReader.readAsDataURL(data);
                                // console.log(url);
                                $("#main_photo").prop('src', src);
                                //@this.set('add_main_image',number);

                            })
                        }, 200);

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
                                div.innerHTML = "<img class='thumbnail' src='" + picFile
                                    .result + "'" +
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

                document.getElementById("edit_list_video").onchange = function(event) {
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("#edit_preview_media").src = blobURL;
                    //$("#edit_preview_media").css('display','block');
                }
            }
        });



        $("#autocomplete1").on('keyup', function() {

            var input = document.getElementById('autocomplete1');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions({
                'country': ['us']
            });
            google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                var place = autocomplete.getPlace();
                console.log(place);

                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                @this.set('lat', place.geometry['location'].lat());
                @this.set('long', place.geometry['location'].lng());
                @this.set('provider_address', place.formatted_address);


                for (var i = 0; i < place.address_components.length; i++) {
                    console.log(place.address_components[i]);
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {

                            $("#zipcode").val(place.address_components[i].long_name);
                            @this.set('zip_code', place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_1") {
                            window.livewire.emit('checkState', [place.address_components[i].long_name]);

                            $("#state").val(place.address_components[i].long_name);
                            @this.set('provider_state', place.address_components[i].long_name);


                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_2") {

                            $("#city").val(place.address_components[i].long_name);
                            @this.set('provider_city', place.address_components[i].long_name);
                        }

                    }

                }
            });
        });

        $(document).ready(function() {
            $(document).on('show.bs.modal', '.modal', function() {
                const zIndex = 1040 + 10 * $('.modal:visible').length;
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1)
                    .addClass('modal-stack'));
            });

            $('#contact_host').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                    event.preventDefault();
                }
                else{
                    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));
                    //@this.set('contact_community_url', event.target);
                }
            });

            $('#provider_phone').keypress(function(event){
                if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                    event.preventDefault();
                }
                else{
                    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));
                    //@this.set('contact_community_url', event.target);
                }
            });

        });
    </script>
@endpush
</div>
