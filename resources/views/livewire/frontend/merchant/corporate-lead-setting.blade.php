<div>
    @push('style')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @endpush
    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="row gy-4">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex neww">
                                <div class="left-sec-home">
                                    <span>
                                        @if (Auth::user()->merchantBusiness->logo_image)
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                        @else
                                        <img src="{{ asset('frontend_assets/images/lead-setting-1-icon-1.svg') }}"
                                            alt="" />
                                        @endif
                                    </span>
                                </div>
                                <div class="right-sec-rental">
                                    <h3> {{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <select wire:model="main_location" class="form-control" style="width: 50%;"
                                        wire:change='locationChange'>
                                        @if ($merchant_location)
                                        @foreach ($merchant_location as $locations)
                                        <option value="{{ $locations->businessLocation->id }}">
                                            {{ $locations->businessLocation->location_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="apartments-sec" style="margin-top: 25px;">
                                        <ul>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                                alt="" /></span>Address:
                                                        <span class="points-distributed-txt" id="change_address">
                                                            {{ $location }}
                                                        </span>
                                                    </h6>
                                                </div>
                                                <div class="apartment-right-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                                alt="" /></span>Mail:<span
                                                            class="points-distributed-txt" id="change_email">
                                                            @foreach ($merchant_location as $locations)
                                                            @if ($locations->is_main == 1)
                                                            {{ $locations->businessLocation->business_email }}
                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt" id="change_phone">
                                                            @foreach ($merchant_location as $locations)
                                                            @if ($locations->is_main == 1)
                                                            {{ $locations->businessLocation->business_phone }}
                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="right-sec-account-status-lead-setting-1">
                                <figure>
                                    @if(auth()->user()->profile_image)
                                        <img src="{{auth()->user()->profile_image}}" alt="">
                                    @else
                                       <img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}" alt="">
                                    @endif
                                </figure>
                                <h3>Account Status</h3>
                                @if (Auth::user()->merchantBusiness->status == 1)
                                <p style="color: green;"><i style="background: green;"></i>Active</p>
                                @elseif(Auth::user()->merchantBusiness->status == 0)
                                <p style="color: red;"><i style="background: red;"></i>Inactive</p>
                                @elseif(Auth::user()->merchantBusiness->status == 2)
                                <p style="color: #ffb822;"><i style="background: #ffb822;"></i>Pending</p>
                                @elseif(Auth::user()->merchantBusiness->status == 3)
                                <p style="color: #5578eb;"><i style="background: #5578eb;"></i>Does Not Meet
                                    Merchant Guidelines</p>
                                @elseif(Auth::user()->merchantBusiness->status == 4)
                                <p style="color: #b80abb;"><i style="background: #b80abb;"></i>Saved</p>
                                @else
                                <p style="color: red;"><i style="background: red;"></i>Pending</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="common_inner_wrappr_pg">
                <div class="common_inner_wrappr_pg_top gap_cmnn">
                    <div class="container">
                        <!-- <p>To add additional features such as <strong>Loyalty Reward Programs,</strong> upgrade to
                            <strong>Merchant Plus</strong> <a href="#url">Here.</a> -->
                        </p>
                        <div class="setting_pg_gimmziw">
                            <div class="setting_pg_gimmziw_top">
                                <div class="sec_heading_stng">
                                    <h2>Main Settings</h2>
                                </div>
                                <div class="row setting_pg_gimmziw_top_row gy-4">
                                    <div class="col-lg-3 setting_pg_gimmziw_top_col">
                                        <div class="gimmzi_section_bxss">
                                            <h3><span class="mrchnt_sp_gmz">GiMMZI ID <a href="javascript:void(0)"
                                                        class="mrchnt_sp_gmz_tltp" data-bs-toggle="modal"
                                                        data-bs-target="#tooltip_modal_edit"><i
                                                            class="fas fa-question-circle"></i></a></span></h3>
                                            <div class="custom_grn_radiobxs">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" checked="" name="name">
                                                        <span>On</span>
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="name">
                                                        <span>Off</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 setting_pg_gimmziw_top_col">
                                        <div class="gimmzi_section_bxss">
                                            <h3>Item & Service Database Copy</h3>
                                            <a href="{{ route('frontend.business_owner.item_service_copy') }}"
                                                class="btn_table_s blu autowdth">Manage</a>

                                            {{-- <a href="#" class="btn_table_s blu autowdth" data-bs-toggle="modal"
                                                data-bs-target="#manages_modal">Manage</a> --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-3 setting_pg_gimmziw_top_col">
                                        <div class="gimmzi_section_bxss">
                                            <h3 style="height: 62.5px;">Bill Management</span></h3>
                                            <a href="{{ route('frontend.business_owner.billing-management') }}"
                                                class="btn_table_s blu autowdth">Manage</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 setting_pg_gimmziw_top_col">
                                        <div class="gimmzi_section_bxss">
                                            <h3 style="height: 64.5px;">Merchant Account Details</span></h3>
                                            <a href="{{ route('frontend.business_owner.merchant_account_details') }}"
                                                class="btn_table_s blu autowdth">Manage</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="space_gap_bt"></span>
                        <div class="merchant-page-lead-setting-1-sec last-sec-merchant-lead btm_top_none">
                            <h4>Gimmzi Page <a target="_blank"
                                    href="{{ route('frontend.business_owner.merchant_website') }}">View
                                    your page</a> </h4>
                            <p>Landing homepage for your business listing. What customers will see. These customers
                                include registered and non-registered Smart Rewards users.</p>
                            <button class="manage-id-btn" wire:click='pageSettings' id="merchant_site_setting">Gimmzi
                                page Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Page Settings modal --}}
    <div wire:ignore.self class="modal fade new-fade-modal-property-site-setting page-settings-modal white-modal"
        id="merchant_site_setting_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-heading-property-site-setting w-100">
                        <h2>Gimmzi Page Settings</h2>
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="property-site-setting-website">
                        <div class="row">
                            <div class="col-md-4 field-blk">
                                <label>Business Overview</label>
                                <textarea class="form-control" rows="5" wire:model.defer='business_overview' id="business_overview"></textarea>
                            </div> 

                            <div class="col-md-4 field-blk">
                                <label>Our Story</label>
                                <textarea class="form-control" rows="5" wire:model.defer='business_story' id="business_story"></textarea>
                            </div>

                            <div class="col-md-4 field-blk">
                                <label class="label-blue">Our story photo</label>
                                <div class="uploard-photo-main">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="uploard-logo-one">
                                                <input type="file" class="uploard-file-one" wire:model='story_image' />
                                                <img
                                                    src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                <h4>Upload logo</h4>
                                                <h5>25 MB Maximum</h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="uploard-logo-one">
                                                @if ($show_story_image)
                                                <img id="preview_logo"
                                                    style="width: 230px;height: 147px;border-radius: 7%;"
                                                    src="{{ $show_story_image->getUrl() }}" />
                                                @else
                                                <img id="preview_logo"
                                                    style="width: 230px;height: 147px;border-radius: 7%;"
                                                    src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                                @endif
                                            </div>
                                            <div class="btn_grp">
                                                <a class="dlt_btn" href="javascript:void(0);"
                                                    wire:click='removeStoryImage'>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 field-blk">
                                <select class="form-control" wire:model='participating_location'
                                    wire:change='changeParticipatingLocation'>
                                    @if ($business_locations)
                                    @foreach ($business_locations as $location_data)
                                    @if ($location_data->main_location == true)
                                    <option value="{{ $location_data->id }}">
                                        {{ $location_data->location_name }}(Main)</option>
                                    @else
                                    <option value="{{ $location_data->id }}">
                                        {{ $location_data->location_name }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>
                        {{-- @dd($merchant_location) --}}
                        {{-- <input type="hidden" id="location_id" value="{{$location->location_id}}"> --}}
                        <div class="row m-0">
                            <div class="col-md-6 property-site-setting-website11">
                                <div class="row">

                                    <div class="col-md-6 field-blk">
                                        <label>Location Street Address *</label>
                                        <input type="text" class="form-control" id="autocomplete1"
                                            wire:model.defer='participating_address' autocomplete="off">
                                        @error('participating_address')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 field-blk">
                                        <label>Location Zip Code *</label>
                                        <input type="text" class="form-control" wire:model.defer='participating_zipcode'
                                            id="zipcode">
                                        @error('participating_zipcode')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 field-blk">
                                        <label>City *</label>
                                        <input type="text" class="form-control" wire:model='participating_city'
                                            id="city">
                                        @error('participating_city')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 field-blk">
                                        <label>State *</label>
                                        {{-- <input type="text" class="form-control" wire:model='participating_state'
                                            id="state"> --}}
                                            <select class="form-control" wire:model='participating_state'>
                                                @foreach ($states as $state_data)
                                                    <option value="{{$state_data->id}}">{{$state_data->name}}</option>
                                                @endforeach
                                            </select>
                                        @error('participating_state')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 field-blk">
                                        <label>Website</label>
                                        <input type="text" class="form-control"
                                            wire:model.defer='participating_website'>
                                        @error('participating_website')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 field-blk">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" wire:model.defer='participating_phone'>
                                        @error('participating_phone')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="merchent-website-con1 col-md-6 field-blk">
                                        <h4>Display Message Boards</h4>
                                        <div class="property-contain-r">
                                            <span class="form-select-box1">
                                                <input class="form-check-input" type="radio" wire:model="display_status"
                                                    id="flexRadioDefault1" value="1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    On
                                                </label>
                                            </span>
                                            <span class="form-select-box1">
                                                <input class="form-check-input" type="radio" wire:model="display_status"
                                                    id="flexRadioDefault1" value="0">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Off
                                                </label>
                                            </span>

                                        </div>

                                    </div>
                                    @error('display_status')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    <div class="col-md-12 field-blk">
                                        <p>Display to be viewed by Smart Rewards users and all traffic that comes to
                                            your Gimmzi page. Add notes for users to view on your merchant site such as
                                            upcoming events, newly added locations and weekly specials.</p>
                                    </div>
                                    <div class="col-md-12 field-blk">
                                        <select class="form-control" wire:model="board_one" id="board_one">
                                            @if ($boards)
                                            <option value="">Select Message Type</option>
                                            <option value="0">None (This option will not display a message board)</option>

                                            @foreach ($boards as $board_data)
                                            <option value="{{ $board_data->id }}">{{ $board_data->title }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12 field-blk" wire:ignore>
                                        <textarea class="form-control" wire:model.defer="message_one" id="merchant_message"
                                            rows="5"></textarea>
                                        
                                        <div class="cmn-txtarea-reset-btn">
                                            <a href="javascript:void(0);" wire:click.prevent='removeMessageOne'>Clear and
                                                remove message</a>
                                        </div>
                                    </div>
                                    @if ($errors->has('message_one'))
                                            <div class="error" style="color:red;">
                                                {{ $errors->first('message_one') }}</div>
                                    @endif
                                    <div class="col-md-12 field-blk">
                                        <select class="form-control" wire:model="board_two" id="board_two">
                                            @if ($boards)
                                            <option value="">Select Message Type</option>
                                            <option value="0">None (This option will not display a message board)</option>
                                            @foreach ($boards as $board_data)
                                            <option value="{{ $board_data->id }}">{{ $board_data->title }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12 field-blk" wire:ignore>
                                        <textarea class="form-control" wire:model="message_two" id="merchant_message2"
                                            rows="5"></textarea>
                                        
                                        <div class="cmn-txtarea-reset-btn">
                                            <a href="javascript:void(0);" wire:click.prevent='removeMessageTwo'>Clear and
                                                remove message</a>
                                        </div>
                                    </div>
                                    @if ($errors->has('message_two'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('message_two') }}</div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="pst-stng-btns">
                                            <a target="_blank"
                                                href="{{ route('frontend.business_owner.merchant_website') }}"
                                                class="btn-blue-outline">Preview gimmzi site</a>
                                            <div class="btn-flex">
                                                {{-- <button type="button" class="btn preview_btn" id="preview"
                                                    style="display:block;">Preview</button> --}}
                                                <button class="btn publish_btn" wire:click="savePageSettings"
                                                    type="submit" name="submit">Publish</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="col-md-6 property-left-right-space">
                                <div class="merchant-site-settings-right">
                                    <div class="row">
                                        {{-- <div class="col-md-5 contact-info-con-top">
                                            Contact info <a href="#view_contact_info_modal" data-bs-toggle="modal"
                                                role="button">View</a> <a href="#manage_contact_info_modal"
                                                data-bs-toggle="modal" role="button">manage</a>
                                        </div>
                                        <div class="col-md-7 contact-info-con-top property-left-right-space">
                                            Current Plan: {{Auth::user()->merchantBusiness->merchant_type}}<a
                                                href="{{route('frontend.business_owner.billing-management')}}">Change</a>
                                        </div> --}}
                                    </div>
                                    <div class="label-blue">
                                        Upload Merchant Logo
                                    </div>
                                    <div class="uploard-photo-main">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one"
                                                        wire:model='logo_image' />
                                                    <img
                                                        src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                    <h4>Upload logo</h4>
                                                    <h5>25 MB Maximum</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    @if ($show_logo_image)
                                                    <img style="width: 230px;height: 158px;border-radius: 7%;"
                                                        src="{{ $show_logo_image->getUrl() }}" />
                                                    @else
                                                    <img style="width: 230px;height: 147px;border-radius: 7%;"
                                                        src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                                    @endif
                                                </div>
                                                <div class="btn_grp">
                                                    <a class="dlt_btn" href="javascript:void(0);"
                                                        wire:click='removeLogoImage'>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="label-blue">
                                        Upload Photos
                                    </div>
                                    <div class="uploard-photo-main">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one" multiple
                                                        wire:model="merchant_photos" />
                                                    <img
                                                        src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                    <h4>Upload Photos</h4>
                                                    <h5>25 MB Maximum</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    @if ($main_photo)
                                                    <img style="width: 230px;height: 158px;border-radius: 7%;"
                                                        src="{{ url($main_photo) }}" />
                                                    @else
                                                    <img style="width: 230px;height: 158px;border-radius: 7%;"
                                                        src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                                    @endif
                                                </div>
                                                <div class="btn_grp">
                                                    <a class="dlt_btn" href="javascript:void(0);"
                                                        wire:click='removeMainPhoto'>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if (count($show_photos) > 0)
                                            @foreach ($show_photos as $key => $value)
                                            <div class="col-md-3 item imageclass">
                                                <div class="inner">
                                                    <img width="175" height="130" class="merchantimage"
                                                        src="{{ $value->getUrl() }}" alt="" />
                                                    <div class="btn_grp">
                                                        <a class="dlt_btn"
                                                            wire:click='removeProfilePhoto({{ $value->id }})'
                                                            href="javascript:void(0);"
                                                            style="font-size: 10px;color: red;">Delete</a>
                                                        <a class="mkm_pht_btn make_main_photo"
                                                            href="javascript:void(0);"
                                                            wire:click='MakeMainPhoto({{ $value->id }})'
                                                            style="font-size: 10px;margin-left: 14px;">Make
                                                            Main Photo</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="label-blue">
                                        Upload Media
                                    </div>
                                    <div class="uploard-photo-main">
                                        <div class="row" style="margin-bottom: 31px;">
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one"
                                                        wire:model='business_video' accept="video/*" />
                                                    <img
                                                        src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                                    <h4>Upload Media dd</h4>
                                                    <h5>25 MB Maximum</h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="uploard-logo-one">
                                                    @if ($show_video)
                                                    <video width="230" height="147"
                                                        src="{{ asset('storage/public/' . $show_video) }}" controls>
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    @endif
                                                </div>
                                                <div class="btn_grp">
                                                    <a class="dlt_btn" href="javascript:void(0);"
                                                        wire:click='removeBusinessVideo'>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Page Settings modal --}}

    {{-- start confirm modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="confirm_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="confirmmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                @if ($photo_title == 'story')
                                <button class="btn_table_s blu auto_wd" wire:click='deleteStoryImage'>Yes</button>
                                @elseif($photo_title == 'logo')
                                <button class="btn_table_s blu auto_wd" wire:click='deleteLogoImage'>Yes</button>
                                @elseif($photo_title == 'profile_photo')
                                <button class="btn_table_s blu auto_wd" wire:click='deleteProfileImage'>Yes</button>
                                @elseif($photo_title == 'main_photo')
                                <button class="btn_table_s blu auto_wd" wire:click='deleteMainPhoto'>Yes</button>
                                @elseif($photo_title == 'video')
                                <button class="btn_table_s blu auto_wd" wire:click='deleteVideo'>Yes</button>
                                @endif
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end confirm modal --}}

    {{-- start success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="textmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd closeModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end success modal --}}

    <div data-backdrop="static" data-keyboard="false" class="modal fade cmn_modal_designs gap_sec_modal2" id="tooltip_modal_edit" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-header">
                    <div class="modal-heading-property-site-setting w-100">
                        <h3>What is Gimmzi ID?</h3>
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <div class="cmn_secthd_modals">
                            <h2 style="font-size: 19px; font-weight:500;">Code customers use to redeem deal at time of purchase. This is confirmation
                                your establishment's location is offering
                                the deal that is redeemed. This code can be changed by you at any time per employee. If
                                the GimmziD is turned off, the customer will show the deal on their mobile device at checkout without the deal being connected to an associate. We recommend keeping it on for your business reporting purposes and to confirm the integrity of every deal. 
                            </h2>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script async defer type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        document.addEventListener('livewire:load', function (event) {
            
            window.livewire.on('pageSettingsModal', function() {
                $('#merchant_site_setting_modal').modal('show');
                // console.log('12xyz3');
                $('#merchant_message').summernote({height: 300,}).summernote('code', @this.get('message_one'));
                $('#merchant_message2').summernote({height: 300,}).summernote('code', @this.get('message_two'));

                $('#business_story').summernote({height: 300,}).summernote('code', @this.get('business_story'));
                $('#business_overview').summernote({height: 300,}).summernote('code', @this.get('business_overview'));
            });

            window.livewire.on('clear_message', () => {           
                $('#merchant_message').summernote('code', ''); // Clear the content in Summernote
                $('#merchant_message').summernote('reset'); // Ensure placeholder appears
                document.getElementById('board_one').value = '';
            });
            window.livewire.on('clear_message2', () => {
             
                $('#merchant_message2').summernote('code',''); // Clear the content in Summernote
                $('#merchant_message2').summernote('reset'); // Ensure placeholder appears
                document.getElementById('board_two').value = '';
            });

           

        });

            window.livewire.on('successModal', data => {
                $('#confirm_modal').modal('hide');
                $('#message_modal').modal('show');
                $('#textmsg').text(data.text);
            });
            window.livewire.on('confirmModal', data => {
                $('#message_modal').modal('hide');
                $('#confirm_modal').modal('show');
                $('#confirmmsg').text(data.text);
            });

            $(".closeModal").on('click', function() {
                $('#confirm_modal').modal('hide');
                $('#message_modal').modal('hide');
                $('#textmsg').text('');
            })

            // window.livewire.on('autoCompleteAddress', function() {
            //     console.log(true);
            // })


            $("#autocomplete1").on('keyup', function() {
                    var input = document.getElementById('autocomplete1');
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.setComponentRestrictions({
                        'country': ['us']
                    });
                    console.log(autocomplete);
                    google.maps.event.addListener(autocomplete, "place_changed", function(d) {
                    var place = autocomplete.getPlace();
                    console.log(place);
                    
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                    @this.set('lat', place.geometry['location'].lat());
                    @this.set('long', place.geometry['location'].lng());
                    @this.set('participating_address', place.formatted_address);
      

                    for(var i = 0; i < place.address_components.length; i++){
                        console.log(place.address_components[i]);
                        for (var j = 0; j < place.address_components[i].types.length; j++) {
                            if (place.address_components[i].types[j] == "postal_code") {
                            
                                $("#zipcode").val(place.address_components[i].long_name);
                                @this.set('participating_zipcode', place.address_components[i].long_name);
                            }
                            if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                window.livewire.emit('checkState',[place.address_components[i].long_name]);
                               
                                $("#state").val(place.address_components[i].long_name);
                                @this.set('participating_state', place.address_components[i].long_name);
                                
                                
                            }
                            if (place.address_components[i].types[j] == "locality") {
                                
                                $("#city").val(place.address_components[i].long_name);
                                @this.set('participating_city', place.address_components[i].long_name);
                            }

                        }

                    }
                });
            });
         
   
        
    </script>
    @endpush

</div>