<div>
    @push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endpush
<div class="notification-area">
    <div class="container">
        <a href="{{ route('frontend.travel-tourism.list') }}" class="nti-btn">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 20C4.5 20 0 15.5 0 10C0 4.5 4.5 0 10 0C15.5 0 20 4.5 20 10C20 15.5 15.5 20 10 20ZM10 1.25C5.1875 1.25 1.25 5.1875 1.25 10C1.25 14.8125 5.1875 18.75 10 18.75C14.8125 18.75 18.75 14.8125 18.75 10C18.75 5.1875 14.8125 1.25 10 1.25Z"
                    fill="currentColor" />
                <path
                    d="M14.4375 10.625H7.375L9.8125 12.625C10.0625 12.875 10.125 13.25 9.875 13.5C9.625 13.75 9.25 13.8125 9 13.5625L5.1875 10.4375C5.0625 10.375 5 10.1875 5 10C5 9.81253 5.0625 9.62503 5.25 9.50003L9.0625 6.37503C9.1875 6.25003 9.3125 6.25003 9.4375 6.25003C9.625 6.25003 9.8125 6.31253 9.9375 6.50003C10.1875 6.75003 10.125 7.18753 9.875 7.37503L7.375 9.37503H14.4375C14.8125 9.37503 15.0625 9.62503 15.0625 10C15.0625 10.375 14.75 10.625 14.4375 10.625Z"
                    fill="currentColor" />
            </svg>
            Go Back to search
        </a>
    </div>
</div>
<section class="hotel-portal">
    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <figure>
                            <img src="{{ $travel_tourism->hotel_image }}" alt="" />
                        </figure>
                    </div>
                    <div class="right-sec-rental">
                        <div class="settings_title">
                            <h3 style="margin: 0 0 2px; line-height: 3.23em;">{{ $travel_tourism->name }}</h3>
                            
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
                                                    style="padding-left: 5px;">{{ $travel_tourism->address }}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span>Mail:<span class="points-distributed-txt"><a
                                                    href="mailto:{{ $travel_tourism->email_address }}">{{ $travel_tourism->email_address }}</a></span>
                                        </h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="hotel-portal-navigate">
    <div class="container">
        <ul class="hotel-portal-navigate-nav">
            <li class="nav-item @if ($defaultTab == true) active @endif">
                <a href="javascript:void(0);" wire:click="showHome">home</a>
            </li>
            @if ($external_manage)
                @if ($external_manage->book_online_display == 1)
                    <li class="nav-item @if ($bookOnlineTab == true) active @endif">
                        <a href="javascript:void(0);" wire:click="showBookOnline">Book Online</a>
                    </li>
                @endif

                @if ($external_manage->contact_community_display == 1)
                    <li class="nav-item @if ($contactTab == true) active @endif">
                        <a href="javascript:void(0);" wire:click="showContact">Contact Host</a>
                    </li>
                @endif

                @if ($external_manage->request_info_display == 1)
                    <li class="nav-item @if ($requestInfotab == true) active @endif">
                        <a href="javascript:void(0);" wire:click="showRequestInfo">Request Info</a>
                    </li>
                @endif

                @if ($external_manage->location_display == 1)
                    <li class="nav-item @if ($locationTab == true) active @endif">
                        <a href="javascript:void(0);" wire:click="showLocation">Location</a>
                    </li>
                @endif
                @if ($external_manage->visit_website_display == 1)
                    <li class="nav-item @if ($directWebsite == true) active @endif">
                        <a href="javascript:void(0);" wire:click="showDirectWebsite">Visit Direct Website</a>
                    </li>
                @endif
            @else
            @endif
        </ul>
        <div class="navigate-panel">
            @if ($defaultTab == true)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navigate-panel-left">
                            <div class="qs-result">
                                <div class="qs-result-scroll lg">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- <div class="big-media-box">
                                            <img src="images/garden-house-image.jpeg" alt="">
                                        </div> -->
                                            <div class="small_media_list_slider">
                                                <div class="small-media-divide-col">
                                                    <div class="small-media-box">
                                                        <a href="{{ $travel_tourism->image }}"
                                                            data-fancybox="gallery">
                                                            <img src="{{ $travel_tourism->image }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 featured-amenties-button">
                                                    <button class="features-m"
                                                        wire:click="showFeature">Features</button>
                                                    <button class="features-a"
                                                        wire:click="showAmenity">Amenities</button>
                                                </div>
                                            </div>
                                            <div class="qs-media-share-wrap">

                                                <ul class="media-list">
                                                    <li>
                                                        <a href="Javascript:void(0);" wire:click="sharePage"
                                                            class="cmn-share-btn" >
                                                            <svg width="338" height="438" viewBox="0 0 338 438"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M289.256 131.938H245.587C241.343 131.938 237.274 133.624 234.273 136.625C231.272 139.625 229.587 143.695 229.587 147.938C229.587 152.182 231.272 156.251 234.273 159.252C237.274 162.253 241.343 163.938 245.587 163.938H289.267C298.088 163.938 305.267 171.117 305.267 179.938V389.176C305.267 397.997 298.088 405.176 289.267 405.176H48.744C39.9227 405.176 32.744 397.997 32.744 389.176V179.938C32.744 171.117 39.9227 163.938 48.744 163.938H92.424C96.6675 163.938 100.737 162.253 103.738 159.252C106.738 156.251 108.424 152.182 108.424 147.938C108.424 143.695 106.738 139.625 103.738 136.625C100.737 133.624 96.6675 131.938 92.424 131.938H48.744C36.018 131.952 23.8172 137.014 14.8185 146.013C5.81979 155.011 0.758135 167.212 0.744019 179.938V389.176C0.744019 415.64 22.28 437.176 48.744 437.176H289.267C315.731 437.176 337.267 415.64 337.267 389.176V179.938C337.25 167.211 332.186 155.011 323.185 146.012C314.185 137.014 301.983 131.952 289.256 131.938ZM109.341 99.6397L153.533 55.4477V266.093C153.533 268.194 153.947 270.275 154.751 272.216C155.555 274.157 156.734 275.921 158.22 277.407C159.705 278.892 161.469 280.071 163.41 280.875C165.352 281.679 167.432 282.093 169.533 282.093C171.635 282.093 173.715 281.679 175.656 280.875C177.598 280.071 179.361 278.892 180.847 277.407C182.333 275.921 183.511 274.157 184.315 272.216C185.12 270.275 185.533 268.194 185.533 266.093V55.4477L229.725 99.6397C232.851 102.765 236.947 104.322 241.043 104.322C245.139 104.322 249.235 102.765 252.36 99.6397C255.36 96.6392 257.045 92.5703 257.045 88.3277C257.045 84.085 255.36 80.0161 252.36 77.0157L180.861 5.50632C179.375 4.0195 177.611 2.84003 175.669 2.03531C173.727 1.2306 171.646 0.816406 169.544 0.816406C167.442 0.816406 165.361 1.2306 163.419 2.03531C161.477 2.84003 159.713 4.0195 158.227 5.50632L86.7173 77.0157C85.1892 78.4916 83.9703 80.2571 83.1317 82.2092C82.2932 84.1612 81.8518 86.2608 81.8333 88.3852C81.8149 90.5097 82.2197 92.6166 83.0242 94.5829C83.8287 96.5493 85.0168 98.3357 86.519 99.838C88.0213 101.34 89.8077 102.528 91.7741 103.333C93.7404 104.137 95.8473 104.542 97.9718 104.524C100.096 104.505 102.196 104.064 104.148 103.225C106.1 102.387 107.865 101.168 109.341 99.6397Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                            Share this page
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <label class="media-save-lbl">
                                                            <input type="checkbox" >
                                                            <span wire:click='saveList({{ $travel_tourism->id }})'>
                                                                <svg width="438" height="360"
                                                                    viewBox="0 0 438 360" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M412.28 45.4597C396.633 24.9023 374.531 10.2009 349.523 3.71724C324.515 -2.76639 298.054 -0.65589 274.39 9.7097C253.21 18.8497 234.32 34.2597 219 54.7597C203.68 34.2597 184.79 18.8497 163.61 9.7597C139.951 -0.611191 113.494 -2.72953 88.4864 3.74492C63.479 10.2194 41.3734 24.9108 25.72 45.4597C9.22 67.0797 0.5 94.0997 0.5 123.59C0.5 166.03 25.81 212.59 75.72 262.03C116.39 302.3 164.45 335.28 189.47 351.35C198.286 356.992 208.533 359.99 219 359.99C229.467 359.99 239.714 356.992 248.53 351.35C273.53 335.28 321.61 302.3 362.28 262.03C412.19 212.61 437.5 166.03 437.5 123.59C437.5 94.0997 428.78 67.0797 412.28 45.4597Z"
                                                                        fill="black" />
                                                                    <path class="heart-fill"
                                                                        d="M412.5 123.59C412.5 159.11 389.69 199.71 344.69 244.27C305.69 282.93 259.22 314.77 235.02 330.27C230.242 333.322 224.69 334.944 219.02 334.944C213.35 334.944 207.798 333.322 203.02 330.27C178.82 314.73 132.39 282.89 93.35 244.27C48.35 199.71 25.54 159.11 25.54 123.59C25.54 99.5898 32.54 77.8498 45.63 60.5898C57.7039 44.8054 74.6164 33.4111 93.78 28.1498C101.415 26.0845 109.291 25.042 117.2 25.0498C147.68 25.0498 182.84 40.2898 208.26 83.6298C209.361 85.5115 210.935 87.0721 212.827 88.1566C214.718 89.2412 216.86 89.8118 219.04 89.8118C221.22 89.8118 223.362 89.2412 225.253 88.1566C227.145 87.0721 228.719 85.5115 229.82 83.6298C262.12 28.5698 310.13 18.8698 344.3 28.1498C363.464 33.4111 380.376 44.8054 392.45 60.5898C405.55 77.8498 412.5 99.6298 412.5 123.59Z"
                                                                        fill="#ffffff" />
                                                                </svg>
                                                                Save this page
                                                            </span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="small-media">
                                                <div class="small_media_list">
                                                    @if (count($travel_tourism->hotel_photos) > 0)
                                                        @foreach ($travel_tourism->hotel_photos as $image)
                                                            <div class="small-media-divide">
                                                                <div class="small-media-box">
                                                                    <a href="{{ $image }}"
                                                                        data-fancybox="gallery">
                                                                        <img src="{{ $image }}"
                                                                            alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
            @endif
            @if ($bookOnlineTab == true)
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 170px;">
                        <div class="navigate-panel-left">
                            @if ($external_manage->book_online_url != '')
                                <p class="websitebutton"><strong> </strong><a
                                        href="{{ $external_manage->book_online_url }}" target="_blank">Book
                                        Online</a></p>
                            @else
                                <p><strong>Coming Soon</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            @if ($contactTab == true)
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 170px;">
                        <div class="navigate-panel-left">
                            @if ($external_manage->contact_community_url != '')
                                <p class="websitebutton"><strong> </strong>{{ $external_manage->contact_community_url }}</p>
                            @else
                                <p><strong>Coming Soon</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if ($requestInfotab == true)
                <div class="request-info-topper">
                    <img class="itrip-logo-img" src="{{ $travel_tourism->image }}" alt="title">
                    <span class="cmn-sub-ttile">Request Info on Listing</span>
                </div>
                <div class="request-info-form">
                    <p>
                        Please fill out the form below and we will forward it to {{ $travel_tourism->name }} to get
                        back to you as soon as possible
                    </p>
                    <form wire:submit.prevent="sendRequestForListing">
                        <div class="row request-info-row">
                            <div class="col-md-12 request-col">
                                <label>Name*</label>
                                <input type="text" wire:model.defer="guest_name">
                                @error('guest_name')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 request-col">
                                <label>Email*</label>
                                <input type="text" wire:model.defer="guest_email">
                                @error('guest_email')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 request-col">
                                <label>Phone*</label>
                                <input type="text" wire:model.defer="guest_phone"
                                    onkeypress="return isNumber(event);">
                                @error('guest_phone')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 request-col">
                                <div class="input-date" wire:ignore>
                                    <label>Arrive Date</label>
                                    <input type="text" class="custmArriveDatePicker"
                                        wire:model.defer="arrive_date">

                                </div>
                                @error('arrive_date')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 request-col">
                                <div class="input-date" wire:ignore>
                                    <label>Departure Date</label>
                                    <input type="text" class="custmDatePicker"
                                        wire:model.defer="departure_date">

                                </div>
                                @error('departure_date')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            {{-- <fieldset class="fieldset-col">
                                    
                                
                                </fieldset> --}}
                            <div class="col-md-12 mb-3">
                                <span class="date-filed-para">
                                    Please note that the dates you select are not guaranteed availability through
                                    Gimmzi
                                    Smart Rewards. For accurate and up-to-date information on the availability of
                                    the listing,
                                    we recommend visiting the direct website.
                                </span>
                            </div>


                            <div class="col-md-6 request-col">
                                <label>Adults</label>
                                <input type="text" wire:model.defer="adult"
                                    onkeypress="return isNumber(event);">
                                @error('adult')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 request-col">
                                <label>Children</label>
                                <input type="text" wire:model.defer="children"
                                    onkeypress="return isNumber(event);">
                                @error('children')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 request-col">
                                <div class="form_input_check">
                                    <label>
                                        <input type="checkbox" checked="" wire:mode.defer="is_flexible">
                                        <span>My Travel Dates are flexible</span>
                                    </label>
                                </div>
                            </div>
                            
                           
                            <div class="col-md-12 request-col">
                                <label>Comments / Request</label>
                                <textarea wire:mode.defer="comment"></textarea>
                            </div>
                            <div class="col-md-12 request-col submit-btn-wrp">
                                <!-- <input type="submit" value="Send"> -->
                                <!-- <button data-bs-toggle="modal" data-bs-target="#formsubmitpopup"
                                    type="submit">Send</button> -->
                                <button type="submit" class="page-btn page-btn-green-peas">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif

            @if ($locationTab == true)
                <div class="location-map">
                    <span class="location-title">{{ $travel_tourism->address }}</span>
                    <figure id="short_term_location" style="padding-top: 75%;margin: 0;" width="600"
                        height="450"></figure>
                    {{-- <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.1576394410413!2d-78.1290506253971!3d33.91134217321035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8900a7e9c1fb73d1%3A0xd70bce7bf0b4d914!2s3515%20E%20Beach%20Dr%2C%20Oak%20Island%2C%20NC%2028465%2C%20USA!5e0!3m2!1sen!2sin!4v1690441837208!5m2!1sen!2sin"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                </div>
                <div class="derication-btn">
                    <a class="page-btn blue-btn" href="javascript:void(0);">Get Directions</a>
                </div>
            @endif
            @if ($directWebsite == true)
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom: 170px;">
                        <div class="navigate-panel-left">
                            @if ($external_manage->visit_website_url != '')
                                <p class="websitebutton"><strong></strong><a
                                        href="{{ $external_manage->visit_website_url }}" target="_blank">Visit
                                        Direct Website</a></p>
                            @else
                                <p><strong>Coming Soon</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>


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
                                            @if (count($features) > 0)
                                                @foreach ($features as $feature_data)
                                                    <div class="feature-list">
                                                        <p>{{ $feature_data->feature_text }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="feature-list">
                                                    <p>There are no features</p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if (count($amenities) > 0)
                                                @foreach ($amenities as $amenity_data)
                                                    <div class="feature-list">
                                                        <p>{{ $amenity_data->amenity_text }}</p>
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

     <!-- share modal -->
    <div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="shareModal" tabindex="-1"
     aria-labelledby="shareModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" style="max-width: 85%;">
         <div class="modal-content">
             <div class="modal-header">
                 <div class="modal-header-left">
                     <h2 class="modal-title" id="shareModalLabel">Share this Listing</h2>
                     <p>Share this listing on any device</p>
                 </div>
                 <a href="#" class="btn-close shareClose" data-bs-dismiss="modal" aria-label="Close">x</a>
             </div>
             <div class="modal-body">
                 <div class="share-property">
                     <div class="share-property-image">
                         <img src="{{ $travel_tourism->image }}" alt="">
                     </div>
                     <div class="share-property-intro">
                         <h3 class="share-property-title">{{ $travel_tourism->name }}</h3>
                         <p class="share-property-location">{{ $travel_tourism->address ?? '' }}</p>
                     </div>
                 </div>

                 <div class="share-property-option">
                     <div class="row">
                         <div class="col-sm-6">
                             <div class="share-property-option-box">
                                 <input type="hidden"
                                     value="{{ url('/hotel-resort/' . $encrypt_id) }}"
                                     id="myInput">
                                 <a href="javascript:void(0);" wire:click="copyPageLink">
                                     <svg width="352" height="416" viewBox="0 0 352 416" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M304 416H112C99.2696 416 87.0606 410.943 78.0589 401.941C69.0571 392.939 64 380.73 64 368V112C64 99.2696 69.0571 87.0606 78.0589 78.0589C87.0606 69.0571 99.2696 64 112 64H304C316.73 64 328.939 69.0571 337.941 78.0589C346.943 87.0606 352 99.2696 352 112V368C352 380.73 346.943 392.939 337.941 401.941C328.939 410.943 316.73 416 304 416ZM112 96C107.757 96 103.687 97.6857 100.686 100.686C97.6857 103.687 96 107.757 96 112V368C96 372.243 97.6857 376.313 100.686 379.314C103.687 382.314 107.757 384 112 384H304C308.243 384 312.313 382.314 315.314 379.314C318.314 376.313 320 372.243 320 368V112C320 107.757 318.314 103.687 315.314 100.686C312.313 97.6857 308.243 96 304 96H112Z"
                                             fill="black" />
                                         <path
                                             d="M16 256C11.7565 256 7.68688 254.314 4.68629 251.314C1.68571 248.313 0 244.243 0 240V48C0 35.2696 5.05713 23.0606 14.0589 14.0589C23.0606 5.05713 35.2696 0 48 0H208C212.243 0 216.313 1.68571 219.314 4.68629C222.314 7.68687 224 11.7565 224 16C224 20.2435 222.314 24.3131 219.314 27.3137C216.313 30.3143 212.243 32 208 32H48C43.7565 32 39.6869 33.6857 36.6863 36.6863C33.6857 39.6869 32 43.7565 32 48V240C32 244.243 30.3143 248.313 27.3137 251.314C24.3131 254.314 20.2435 256 16 256Z"
                                             fill="black" />
                                     </svg>

                                     Copy Link
                                 </a>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="share-property-option-box">
                                 <a href="javascript:void(0);" wire:click="mailBox">
                                     <svg width="512" height="384" viewBox="0 0 512 384" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M464 0H48.0003C21.5313 0 0 21.5313 0 48.0003V336C0 362.469 21.5313 384.001 48.0003 384.001H464C490.469 384.001 512 362.469 512 336V48.0003C512 21.5313 490.469 0 464 0ZM464 31.9999C466.174 31.9999 468.242 32.4509 470.132 33.2386L256 218.828L41.8667 33.2386C43.8089 32.4243 45.8933 32.0032 47.9993 31.9999H464ZM464 352H48.0003C39.1723 352 31.9999 344.828 31.9999 335.999V67.0468L245.515 252.094C248.531 254.703 252.266 256 256 256C259.734 256 263.469 254.704 266.485 252.094L480 67.0468V336C479.999 344.828 472.828 352 464 352Z"
                                             fill="black" />
                                     </svg>
                                     Email
                                 </a>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="share-property-option-box">

                                 <a href="javascript:void(0);" class="whatsapp_link" target="_blank">
                                     <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M442.182 0H69.8182C31.2587 0 0 31.2587 0 69.8182V442.182C0 480.741 31.2587 512 69.8182 512H442.182C480.741 512 512 480.741 512 442.182V69.8182C512 31.2587 480.741 0 442.182 0Z"
                                             fill="#29A71A" />
                                         <path
                                             d="M368.873 143.128C342.238 116.227 306.867 99.7301 269.14 96.612C231.414 93.4938 193.814 103.96 163.125 126.122C132.435 148.285 110.675 180.685 101.77 217.478C92.865 254.271 97.401 293.035 114.56 326.779L97.7163 408.553C97.5415 409.367 97.5366 410.208 97.7018 411.024C97.867 411.84 98.1987 412.613 98.6763 413.295C99.3759 414.33 100.375 415.126 101.539 415.579C102.703 416.031 103.978 416.117 105.193 415.826L185.338 396.83C218.987 413.554 257.477 417.798 293.961 408.807C330.445 399.816 362.556 378.173 384.58 347.729C406.605 317.285 417.114 280.014 414.237 242.548C411.361 205.083 395.286 169.853 368.873 143.128ZM343.884 342.575C325.455 360.952 301.725 373.082 276.037 377.258C250.349 381.433 223.998 377.442 200.698 365.848L189.527 360.32L140.393 371.957L140.538 371.346L150.72 321.891L145.251 311.099C133.346 287.717 129.146 261.168 133.253 235.254C137.361 209.34 149.564 185.391 168.116 166.837C191.427 143.533 223.039 130.442 256 130.442C288.961 130.442 320.573 143.533 343.884 166.837C344.082 167.064 344.296 167.278 344.524 167.477C367.545 190.84 380.397 222.358 380.277 255.158C380.157 287.958 367.075 319.38 343.884 342.575Z"
                                             fill="white" />
                                         <path
                                             d="M339.52 306.298C333.498 315.782 323.985 327.389 312.029 330.269C291.084 335.331 258.938 330.444 218.938 293.149L218.444 292.713C183.273 260.102 174.138 232.96 176.349 211.433C177.571 199.215 187.753 188.16 196.334 180.946C197.691 179.788 199.3 178.963 201.033 178.538C202.765 178.113 204.573 178.099 206.311 178.498C208.05 178.897 209.671 179.697 211.045 180.834C212.42 181.971 213.509 183.414 214.225 185.047L227.171 214.138C228.012 216.025 228.324 218.104 228.073 220.154C227.822 222.204 227.017 224.147 225.745 225.775L219.2 234.269C217.795 236.023 216.948 238.157 216.767 240.397C216.585 242.637 217.078 244.879 218.182 246.837C221.847 253.266 230.633 262.72 240.378 271.477C251.316 281.367 263.447 290.415 271.127 293.498C273.182 294.338 275.442 294.543 277.614 294.086C279.787 293.63 281.773 292.534 283.316 290.938L290.909 283.287C292.374 281.843 294.196 280.812 296.189 280.301C298.182 279.79 300.275 279.817 302.254 280.378L333.004 289.106C334.7 289.626 336.255 290.527 337.549 291.741C338.843 292.954 339.843 294.447 340.472 296.106C341.101 297.765 341.342 299.546 341.177 301.313C341.012 303.079 340.445 304.784 339.52 306.298Z"
                                             fill="white" />
                                     </svg>
                                     WhatsApp
                                 </a>

                             </div>
                         </div>

                         <div class="col-sm-6">
                             <div class="share-property-option-box">
                                 <a href="javascript:void(0);" class="facebook_link" target="_blank">
                                     <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                         <path
                                             d="M448 0H64C28.704 0 0 28.704 0 64V448C0 483.296 28.704 512 64 512H448C483.296 512 512 483.296 512 448V64C512 28.704 483.296 0 448 0Z"
                                             fill="#1976D2" />
                                         <path
                                             d="M432 256H352V192C352 174.336 366.336 176 384 176H416V96H352C298.976 96 256 138.976 256 192V256H192V336H256V512H352V336H400L432 256Z"
                                             fill="#FAFAFA" />
                                     </svg>
                                     Facebook
                                 </a>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="share-property-option-box">
                                 <a href="javascript:void(0);" class="twitter_link" target="_blank">
                                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="100px"
                                         height="100px">
                                         <path
                                             d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z" />
                                     </svg>
                                     X
                                 </a>
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="share-property-option-box">
                                 <a href="javascript:void(0);" class="linkedin_link" target="_blank">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                                         viewBox="0 0 40 40">
                                         <path fill="#0078d4"
                                             d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z">
                                         </path>
                                         <path
                                             d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z"
                                             opacity=".05"></path>
                                         <path
                                             d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z"
                                             opacity=".07"></path>
                                         <path fill="#fff"
                                             d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z">
                                         </path>
                                     </svg>
                                     LinkedIn
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
   </div>
   <!-- share modal -->

    <div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="mailBoxModal" tabindex="-1"
    aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 37%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-header-left">
                        <h2 class="modal-title" id="shareModalLabel" style="font-size: 40px;">Share this Listing</h2>
                        <p>Share this Listing on any device. </p>
                    </div>
                    <a href="javascript:void(0);" class="btn-close shareClose" data-bs-dismiss="modal"
                        aria-label="Close">x</a>
                </div>
                <div class="modal-body">
                    <form class="form-inline" wire:submit.prevent="shareByEmail">
                        {{-- <div class="form-group mb-2">
                        <label for="staticEmail2" class="sr-only">Email</label>
                        <input type="text" class="form-control-plaintext" id="staticEmail2" wire:model.defer = "guest_email_address">
                        </div>
                    <div>
                        @error('guest_email_address')
                            <span class="invalid-message" role="alert"
                                style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div> --}}

                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Your Name *</h5>
                                    <input type="text" name="name" wire:model.defer='name'>
                                    @error('name')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Your Email *</h5>
                                    <input type="email" name="email" wire:model.defer='email'>
                                    @error('email')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 custom_form_dsgn_pop_col mb-2">
                                    <h5>Recipient Email(s) *</h5>
                                    <input type="text" name="r_emails" wire:model.defer='r_emails'>
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        <i>Enter one or more recipient email address separeted by commas or space.</i>
                                    </span>
                                    <br>
                                    @error('r_emails')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Message</h5>
                                    <textarea class="form-control" name="message" rows="5" wire:model.defer='message'></textarea>
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        <i>Enter your message or notes here to be include in the email.</i>
                                    </span>
                                    @error('message')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="popup-form-submit text-center">
                            <p>By clicking Share Now, I confirm I am permitted to send this email</p>
                            <p>The recipient's email address will only be used to send this email to them and will not
                                be collected or be available to anyone else. </p>
                            <div class="form-submit-btn">
                                <button type="submit" class="btn btn-primary">Share Now</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1"
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
                                <button class="btn_table_s blu auto_wd"
                                    onclick="window.location.reload();">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade cmn_modal_designs gap_sec_modal2" data-bs-backdrop = 'static' keyboard = "false"
        id="registration_form_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <p class="by-continue-text">Complete the below. We will keep you updated on the status.</p>
                            <div class="main-form">
                                <form id="badgeForm" method="post">
                                    <div class="row">
                                        <div class="col-sm-12 form-select1">
                                            <input type="text" name="booking_email" class="booking_email"
                                                placeholder="Email Address*" />
                                        </div>
                                        <span class="email_error" style="color: red;"></span>

                                        <div class="col-sm-12 form-select1">
                                            <select style="margin-top: 10px !important;" class="badge_id">
                                                @if (count($badge_dates) > 0)
                                                    <option value="">Please choose a schedule</option>
                                                    @foreach ($badge_dates as $badge_data)
                                                        <option value="{{ $badge_data['id'] }}">check-In
                                                            :-{{ $badge_data['start_date'] }} - check-Out
                                                            :-{{ $badge_data['end_date'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <span class="badge_error" style="color: red;"></span>
                                        <input type="hidden" class="guest_id">

                                    </div>

                                    <div class="row registerForm" style="display: none">
                                        <div class="col-sm-12 form-select1">
                                            <input type="text" class="booking_first_name"
                                                placeholder="First name*" />
                                            <span class="first_name_error" style="color: red;"></span>
                                        </div>


                                        <div class="col-sm-12 form-select1">
                                            <input type="text" class="booking_last_name"
                                                placeholder="Last name*" />
                                        </div>
                                        <span class="last_name_error" style="color: red;"></span>

                                        <div class="col-sm-12 form-select1">
                                            <input type="text" class="booking_phone"
                                                placeholder="Phone Number*" />
                                        </div>
                                        <span class="phone_error" style="color: red;"></span>

                                        <div class="col-sm-12 form-select1">
                                            <input type="text" class="zip_code"
                                                placeholder="Zip Code*" />
                                        </div>
                                        <span class="zip_error" style="color: red;"></span>

                                        <div class="row">
                                            <div class="col-sm-4 form-select1">
                                                <select name="consumer_birth_month" class="consumer_birth_month">

                                                    <option value=" " selected>Month</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-4 form-select1">
                                                <select name="consumer_birth_month" class="consumer_birth_day">

                                                    <option value=" " disabled selected>Day</option>
                                                    @for($i = 1; $i < 31; $i++)
                                                        <option value="{{$i}}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-4 form-select1">
                                                <select name="consumer_birth_month" class="consumer_birth_year">

                                                    <option value=" " disabled selected>Year</option>
                                                    @for($i = 1970; $i < date('Y'); $i++)
                                                        <option value="{{$i}}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row submitForm" style="display: none">
                                        <div class="btn_foot_end centr">
                                            <button class="login-button-one" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="modal fade new_registration_badge_modal" data-bs-backdrop = 'static' keyboard = "false" id="registration_form_modal" tabindex="-1" aria-labelledby="new-registration-modalLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close new-registration-modal-close" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="mt-5 mb-3 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Claim your {{ $travel_tourism->name }} badge to unlock
                        special deals and discounts in the local area
                    </p>
                    <div class="main-form">
                        <form id="badgeForm" method="post">
                            <div class="row">
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your email address <span>*</span></label>
                                    <input type="text" name="booking_email" class="booking_email"
                                            placeholder="Email Address*" />

                                    <span class="email_error" style="color: red;"></span>
                                </div> 
                                {{-- {{$register_data['type']}} --}}
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your booking dates <span>*</span></label>
                                    <select style="margin-top: 10px !important;" class="badge_id">
                                        @if (count($badge_dates) > 0)
                                            <option value="">Please choose a schedule</option>
                                            @foreach ($badge_dates as $badge_data)
                                                <option value="{{ $badge_data['id'] }}">check-In
                                                    :-{{ $badge_data['start_date'] }} - check-Out
                                                    :-{{ $badge_data['end_date'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="badge_error" style="color: red;"></span>
                                    <input type="hidden" class="guest_id">
                                </div>
                                <!-- dd($register_data['first_name']); -->
                                <div class="registration_input registerForm" style="display: none">
                                    <div class="col-sm-12 form-select1">
                                        <label for="">First Name <span>*</span></label>
                                        <input type="text" class="booking_first_name"
                                            placeholder="First name*" />
                                        <span class="first_name_error" style="color: red;"></span>
                                    </div>

                                    <div class="col-sm-12 form-select1">
                                        <label for="">Last Name <span>*</span></label>
                                        <input type="text" class="booking_last_name"
                                            placeholder="Last name*" />
                                    </div>
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Phone Number <span>*</span></label>
                                        <input type="text" class="booking_phone"
                                        placeholder="Phone Number*" />
                                    </div>
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Zip Code  <span>*</span</label>
                                            <input type="text" class="zip_code"
                                            placeholder="Zip Code*" />
                                        <span class="error"></span>
                                    </div>


                                    <div class="col-sm-12 birthday-optional-text1">
                                        Birthday (Optional)
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_month" class="consumer_birth_month">

                                                <option value=" " selected>Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_day" class="consumer_birth_day">
                                                <option value=" " disabled selected>Day</option>
                                                @for($i = 1; $i < 31; $i++)
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_year" class="consumer_birth_year">
                                                <option value=" " disabled selected>Year</option>
                                                @for($i = 1970; $i < date('Y'); $i++)
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <p class="p_text">Recieve additional points and deals on your birthday, We
                                        wanna celebrate with
                                        you!
                                    </p>
                                    <span id="signup2error"></span>

                                    <div class="col-sm-12 login-top-one1">
                                        <button class="reg_btn login-button-one" type="submit" >Claim Gimmzi Badge</button>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12 login-top-one1 next-btn" style="display: none">
                                    <button class="reg_btn login-button-one" type="button" name="stepone"
                                        id="signupstep1">Next</button>

                                </div> --}}
                                <div class="trm_info">
                                    <p>By creating an accoun, you agree to our <a target="_blank"
                                            href="{{ route('frontend.privacy-policy') }}"> Privacy policy</a> and
                                        <a target="_blank" href="{{ route('frontend.terms-of-use') }}"> Terms of
                                            use</a>
                                    </p>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div data-bs-backdrop = 'static'  class="modal fade password_badge_modal" id="passwordModal" tabindex="-1"
        aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" />
                    </div>
                    <div class="mt-5 mb-3 popup-logo">
                    <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>                                                              
                    <div class="main-form">
                    <form id="guest_password_submit" method="post" action="">
                        <div class="row">
                            <div class="col-sm-12 form-select1">
                            <label for="">Password <span>*</span></label>
                                <input type="password" name="consumer_password" id="consumer_password" placeholder="Password" />
                            </div>
                            <div class="col-sm-12 form-select1">
                                <label for="">Confirm Password <span>*</span></label>
                                <input type="password" name="consumer_confirm_password" id="consumer_confirm_password" placeholder="Confirm Password" />
                            </div>
                            <span id="guest_password_error"></span>
                            <div class="col-sm-12 login-top-one1">
                                <button class="reg_btn login-button-one" type="submit" name=""  id="">Next</button>
                            </div>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    {{-- Thank You modal start --}}
    <div class="modal fade" id="thanksmodal" tabindex="-1" aria-labelledby="thanksmodalLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="main-form">
                        <div class="all-done-one">
                            <h4>All done!</h4>
                            <p id="thanks_message1"></p>
                            <h5 id="thanks_message2"></h5>
                            <div class="go-out-text smart-reward-text">
                                <p> Go out on the town and use them at your favorite places to eat, have fun, shop and
                                    more</p>
                                <a href="" class="deals-button" style="color: #fff!important;">Start using
                                    Smart Rewards</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Thank You modal end --}}

@push('scripts')
    @if (session()->has('listingid'))
        <script>
            $(function() {
                $("#registration_form_modal").modal('show');
            });
        </script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script async defer type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>
    <script>
        function isNumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        
        
        

        $(document).ready(function() { //Add this line (and it's closing line)
            var isGuestEmailValid = false; 
            var badgeSelected = false; 
           
            
            $('.booking_email').on('blur', function() {
                $(".email_error").text('');
                $('.guest_id').val('');
                var email = $(this).val();
                $.ajax({
                    url: "{{ route('travel.guest_email_check') }}",
                    type: 'get',
                    data: {
                        'email': email
                    },
                    success: function(result) {
                        console.log(result.success);
                        $(".registerForm").css('display', 'none');
                        $(".submitForm").css('display', 'none');
                        if (result.success == true) {
                            $('.guest_id').val(result.data);
                            isGuestEmailValid = true;
                            if (isGuestEmailValid && badgeSelected) {
                                $("#registration_form_modal").modal('hide');
                                $("#passwordModal").modal('show'); // Open modal if both are true
                            }
                            // 

                            // $("#passwordModal").modal('show');
                        } else {
                            if (result.text == 'user_not_found') {
                                $(".registerForm").css('display', 'block');
                                $(".submitForm").css('display', 'block');
                            } else {
                                $(".email_error").text(result.text);
                            }
                        }
                    }
                });
            });

            $('.badge_id').on('change', function() {
                var badgeId = $(this).val();
                
                if (badgeId) {
                    badgeSelected = true; // Mark badge as selected
                    // Check if both conditions are met
                    if (isGuestEmailValid && badgeSelected) {
                        $("#registration_form_modal").modal('hide');
                        $("#passwordModal").modal('show'); // Open modal if both are true
                    }
                } else {
                    badgeSelected = false; // Reset if no badge is selected
                }
            });

        });
        $("#badgeForm").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.badge_error').text('');
            $(".phone_error").text('');
            $(".last_name_error").text('');
            $(".first_name_error").text('');

            if ($('.guest_id').val() != '') {
                if ($('.badge_id').val() != '') {

                    $.ajax({
                        url: "{{ route('travel.guest_add_to_scheduled_badge') }}",
                        type: 'POST',
                        data: {
                            guest_id: $('.guest_id').val(),
                            email: $('.booking_email').val(),
                            badge_id: $('.badge_id').val(),
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.status == true) {
                                $("#registration_form_modal").modal('hide');
                                $("#badge_success_modal").modal('show');
                                $("#badgesuccessmsg").text('Badge Accepted Successfully');
                            }
                        }
                    });
                } else {
                    $('.badge_error').text('Please select a scheduled date');
                }
            } else {
                if ($('.badge_id').val() != '') {
                    if ($(".booking_first_name").val() != '') {
                        if ($(".booking_last_name").val() != '') {
                            if ($(".booking_phone").val() != '') {
                                $.ajax({
                                    url: "{{ route('travel.guest_add_to_scheduled_badge') }}",
                                    type: 'POST',
                                    data: {
                                        guest_id: $('.guest_id').val(),
                                        email: $('.booking_email').val(),
                                        badge_id: $('.badge_id').val(),
                                        booking_first_name: $('.booking_first_name').val(),
                                        booking_last_name: $('.booking_last_name').val(),
                                        booking_phone: $('.booking_phone').val(),

                                    },
                                    success: function(result) {
                                        console.log(result);
                                        if (result.status == true) {
                                            $("#registration_form_modal").modal('hide');
                                            $("#passwordModal").modal('show');
                                            // $("#badge_success_modal").modal('show');
                                            // $("#badgesuccessmsg").text('Badge Accepted Successfully');
                                        } else if (result.status == 0) {
                                            $('.phone_error').text(result.validation_errors);
                                        }
                                    }
                                });
                            } else {
                                $('.phone_error').text('Give your phone number');
                            }
                        } else {
                            $('.last_name_error').text('Give your last name');
                        }
                    } else {
                        $('.first_name_error').text('Give your first name');
                    }

                } else {
                    $('.badge_error').text('Please select a scheduled date');
                }
            }

        });

        $("#guest_password_submit").validate({
                rules: {
                        consumer_password: {
                        required: true,
                        minlength: 8,
                    },
                    consumer_confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#consumer_password"
                    },
                },
                messages: {
                    consumer_password: {
                        required: "Please enter a New password ",
                        minlength: "Password minimum length should be 8"
                    },
                    consumer_confirm_password: {
                        required: "Please enter Confirm password ",
                        minlength: "Password minimum length should be 8",
                        equalTo: "Confirm password should be equal to New password"
                    },
                }
        });

        $("#guest_password_submit").submit(function(e) {
            e.preventDefault();
            if($("#consumer_password").val() != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('travel.hotel_guest_password_submit') }}",
                    type: 'POST',
                    data: {
                        'guest_id': $('.guest_id').val(),
                        'email': $('.booking_email').val(),
                        'badge_id': $('.badge_id').val(),
                        'consumer_password': $("#consumer_password").val(),
                        // 'user_token': $("#user_token").val(),
                        'consumer_confirm_password': $("#consumer_confirm_password").val(),
                    },
            
                    success: function(result)
                    {
                        if (result.status == 0) {
                            // $('#passwordModal').find('form').trigger(
                            //     'reset');
                            $('#passwordModal').modal('hide');
                            $("#thanksmodal").modal('show');
                            $("#thanks_message1").html(result.message1);
                            $("#thanks_message2").html(result.message2);
                            
                        }
                        else if(result.status == 1){
                            $("#guest_password_error").html(result.validation_errors).css('color',
                                'red');
                        }
                        
                    }

                });
            }
            
        });

        document.addEventListener('livewire:load', function(event) {


            @this.on('openLocation', function() {
                setTimeout(function() {
                    var propertylat = '<?php echo $travel_tourism->lat; ?>';
                    var propertylong = '<?php echo $travel_tourism->long; ?>';
                    var mapOptions2 = {
                        zoom: 10
                    };
                    promap = new google.maps.Map(document.getElementById('short_term_location'),
                        mapOptions2);
                    var promarker;

                    promarker = new google.maps.Marker({
                        position: new google.maps.LatLng(propertylat, propertylong),
                        map: promap,
                        animation: google.maps.Animation.DROP,
                    });
                    promap.setCenter(promarker.getPosition());
                    promap.setZoom(10);
                }, 200);

            });

            @this.on('openSelect2', function() {
                // $( '.multiSelect2' ).select2( {
                //     theme: "bootstrap-5",
                //     width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                //     placeholder: $( this ).data( 'placeholder' ),
                //     closeOnSelect: false,
                // } );
                //if ($('.custmDatePicker').length) {

                $(".custmDatePicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    setdate: new Date()
                }).on('change', function(e) {
                    @this.set('departure_date', e.target.value);

                });
                //}
                //if($('.custmArriveDatePicker').length){
                $(".custmArriveDatePicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    setdate: new Date()
                }).on('change', function(e) {
                    @this.set('arrive_date', e.target.value);

                });
                //}

            });

            @this.on('mailSuccess', data => {
                $("#success_modal").modal('show');
                $("#successmsg").html(data.message);
            });

            @this.on('shareListingDetail', function() {
                $("#shareModal").modal('show');
                var id = "{{ $encrypt_id }}";
                var url = "<?php echo url('/hotel-resort/"+id+"'); ?>";
                $(".whatsapp_link").attr('href', 'https://wa.me/?text=' + url);
                $(".facebook_link").attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + url);
                $(".twitter_link").attr('href', 'https://twitter.com/intent/tweet?text=' + url);
                $(".linkedin_link").attr('href',
                    'https://www.linkedin.com/sharing/share-offsite?mini=true&url=' + url +
                    '&title=&summary=');
            });

            @this.on('copy_page_link', data => {
                navigator.clipboard.writeText(data.link);
                alert('Link Copied');
            });

            @this.on('mail_box', function() {
                $("#mailBoxModal").modal('show');
            });

            @this.on('loginMessagePopup', data => {
                $("#favourite_modal").modal('show');
                $("#loginmsg").html(data.message);
            });

            @this.on('favoriteLogin', data => {
                $("#loginModal").modal('show');
                $("#favourite_modal").modal('hide');
                sessionStorage.setItem("get_page", "short_term_website_page");
                sessionStorage.setItem("get_page_id", data.id);
                $("#nav-home-tab").removeClass('active');
                $("#nav-profile-tab").addClass('active');
                $("#nav-home").removeClass('show');
                $("#nav-home").removeClass('active');
                $("#nav-profile").addClass('show');
                $("#nav-profile").addClass('active');
            });

            @this.on('showListingFeature', function() {
                $("#featureAmenityModal").modal('show');
            });

            @this.on('showListingAmenity', function() {
                $("#featureAmenityModal").modal('show');
                $("#home-tab").removeClass('active');
                $("#home").removeClass('active');
                $("#home").removeClass('show');
                $("#about-tab").addClass('active');
                $("#about").addClass('active');
                $("#about").addClass('show');
            });



        });

        $(document).ready(function() {
            $(document).on('show.bs.modal', '.modal', function() {
                const zIndex = 1040 + 10 * $('.modal:visible').length;
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1)
                    .addClass('modal-stack'));
            });
        });
    </script>
@endpush
</div>
