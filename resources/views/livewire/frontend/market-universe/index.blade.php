<div>
    @php
        $lat_long_array = [];
    @endphp
    <div class="filter-sec cmn-gap">
        <div class="container">
            <div class="filter-top-wrap">
                <ul class="breadcrumb">
                    <li>
                        <a href="/explore">Explore</a>
                    </li>
                    <li>Gimmzi Market Universe</li>
                </ul>
                <h1 class="h1-title">Explore Gimmzi Market Universe</h1>
            </div>
            <div class="filter-rows">
                <div class="filter-sec-col-lft">
                    <a href="javascript:void(0)" class="fltr-btnclose">
                        <img loading="lazy" src="{{ asset('frontend_assets/images/close.svg') }}" alt=""
                            class="fltrsic1">
                    </a>
                    <div class="category_lft_clm_main">
                        <div class="category_lft_clm_wpr" wire:ignore>
                            <div class="filter-head">Category</div>
                            <div class="filter-content">
                                <div class="form_input_check cstmchkbx">
                                    <label>
                                        <input type="checkbox" wire:model='allCategory'>
                                        <span>All Categories</span>
                                    </label>
                                    @foreach ($category_lists as $item)
                                        <label>
                                            <input type="checkbox" value="{{ $item->id }}" wire:model='category'>
                                            <span>{{ $item->category_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="category_lft_clm_wpr" wire:ignore>
                            <div class="filter-head">Types</div>
                            <div class="filter-content">
                                <div class="form_input_check cstmchkbx">
                                    <label>
                                        <input type="checkbox" wire:model='allType'>
                                        <span>Show All</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model='deals.loyaltyRewards'>
                                        <span>Show only Loyalty Rewards</span>
                                    </label>
                                    <label>
                                        <input type="checkbox" wire:model='deals.gimmziDeals'>
                                        <span>Show only Gimmzi Deals</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="category_lft_clm_wpr">
                            <div class="filter-head">Distance</div>
                            <div class="filter-content">
                                <div class="form_input_radio cstmchbox2">
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Any Distance</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 5.0 mi (&lt;10)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 10.0 mi (&lt;10)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 20.0 mi (&lt;10+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 50.0 mi (&lt;20+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 100.0 mi (&lt;30+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="name">
                                        <span>Within 250.0 mi (&lt;30+)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filter-sec-col-rit">
                    <div class="filter-sec-rit">
                        <div class="filter-sec-rit-top">
                            <div class="filter-sec-rit-top-lft">
                                <div class="filter-sec-rit-top-lft-innr">
                                    <p>{{ count($business_profiles) }} Results Found</p>
                                    {{-- <a href="javascript:void(0)" class="reset-filter"
                                        onclick="window.location.href='{{ route('frontend.market-universe') }}'">Reset
                                        Filter</a> --}}
                                    <a href="javascript:void(0)" class="reset-filter"wire:click="resetFilter">Reset
                                        Filter</a>
                                </div>
                                <button class="fltrbtncls">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/fltr.png') }}"
                                        alt="">
                                    <span>Filter</span>
                                </button>
                            </div>
                            <div class="sort-divss">
                                <select name="cars" id="cars">
                                    <option value="vl1">Sort By</option>
                                    <option value="vl2">Category</option>
                                    <option value="vl2">Types</option>
                                    <option value="vl2">Distance</option>

                                </select>
                                <button class="mapbtn">
                                    <img loading="lazy" class="mapbtn-img"
                                        src="{{ asset('frontend_assets/images/map-ic.svg') }}" alt="">
                                    <span class="mapbtn-hide">View Map</span>
                                </button>
                            </div>
                        </div>
                        <div class="filter-mdl-blk" wire:ignore style="display: none;">
                            <div class="map">
                                {{-- <img src="{{ asset('website_assets/images/map.png') }}" alt=""> --}}
                                <div class="col-lg-12 form-item" wire:ignore>
                                    <div wire:ignore id="map-canvas" class="google-map"
                                        style="width:100%; height:500px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-sec-rit-btm">
                            <div class="row rowspan">
                                @forelse ($business_profiles as $business)
                                    <div class="col-xxl-4 col-lg-6 filcols">
                                        <div class="filter-card">
                                            <div class="universe-figs">
                                                <div class="purchase-wishlst">
                                                    <a href="javascript:void(0)" class="cmn-purchase">
                                                        <img loading="lazy"
                                                            src="{{ asset('frontend_assets/images/hrtss.svg') }}"
                                                            alt="save icon">
                                                    </a>
                                                    <span>Save</span>
                                                </div>
                                                <div class="purchase-wishlst share-blkss" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal">
                                                    <a href="javascript:void(0)" class="cmn-purchase">
                                                        <img loading="lazy"
                                                            src="{{ asset('frontend_assets/images/shrss.svg') }}"
                                                            alt="share info1 icon">
                                                    </a>
                                                    <span>Share</span>
                                                </div>
                                                <figure class="purchase-fig">
                                                    <a href="{{ route('frontend.merchant.website', $business->id) }}">
                                                        <img loading="lazy" src="{{ $business->main_image_url }}"
                                                            alt="fruits1 image">
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="universe-con">
                                                <div class="universe-top-con">
                                                    <div class="universe-top-head">
                                                        <a
                                                            href="{{ route('frontend.merchant.website', $business->id) }}">{{ $business->business_name }}</a>
                                                    </div>
                                                    <div class="universe-top-btm-head">
                                                        @if ($business->formatted_location)
                                                            <p>{{ $business->formatted_location }}</p>
                                                            @if ($business->locations->where('location_type', 'Headquarters')->where('status', 1)->first()->latitude ?? '')
                                                                @php
                                                                    $lat_long_array[] = [
                                                                        $business->locations
                                                                            ->where('location_type', 'Headquarters')
                                                                            ->where('status', 1)
                                                                            ->first()->latitude,
                                                                        $business->locations
                                                                            ->where('location_type', 'Headquarters')
                                                                            ->where('status', 1)
                                                                            ->first()->longitude,
                                                                        $business->locations
                                                                            ->where('location_type', 'Headquarters')
                                                                            ->where('status', 1)
                                                                            ->first()->location_name,
                                                                        $business->locations
                                                                            ->where('location_type', 'Headquarters')
                                                                            ->where('status', 1)
                                                                            ->first()->address,
                                                                    ];

                                                                @endphp
                                                                <span>{{ $this->haversineDistance($business->locations->where('location_type', 'Headquarters')->where('status', 1)->first()->latitude, $business->locations->where('location_type', 'Headquarters')->where('status', 1)->first()->longitude) }}
                                                                    mi</span>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>

                                                @if ($business->loyalty->where('status', 1)->where('end_on', '>', Carbon\Carbon::today()->format('Y-m-d'))->isNotEmpty())
                                                    @foreach ($business->loyalty->where('status', 1)->where('end_on', '>', Carbon\Carbon::today()->format('Y-m-d')) as $key => $item)
                                                        <div class="universe-mdl-con universe-btm-con">
                                                            <form>
                                                                <label>
                                                                    <input type="radio">
                                                                    <div class="universe-con-radio">
                                                                        <p> {{ $item->program_name }}</p>
                                                                        <span>Earn up to 20 points per purchase</span>
                                                                    </div>
                                                                </label>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if ($business->deals->where('status', 1)->where('end_Date', '>', Carbon\Carbon::today()->format('Y-m-d'))->isNotEmpty())
                                                    @foreach ($business->deals->where('status', 1)->where('end_Date', '>', Carbon\Carbon::today()->format('Y-m-d')) as $key2 => $item)
                                                        @if ($loop->iteration <= 2)
                                                            <div class="universe-btm-con">
                                                                <form>
                                                                    <label>
                                                                        <input type="radio">
                                                                        <div class="universe-con-radio">
                                                                            <p><strong>{{ $item->suggested_description ?? '-' }}</strong>
                                                                            </p>
                                                                            <p>{{ $item->point }} points to redeem</p>
                                                                        </div>
                                                                    </label>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif

                                                <div class="universe-btn-grp">
                                                    @if ($business->loyalty->where('status', 1)->where('end_on', '>', Carbon\Carbon::today()->format('Y-m-d'))->isNotEmpty())
                                                        <a href="javascript:void(0)"
                                                            class="enroll-btn universebtn">Enroll</a>
                                                    @endif
                                                    @if ($business->deals->where('status', 1)->where('end_Date', '>', Carbon\Carbon::today()->format('Y-m-d'))->isNotEmpty())
                                                        <a href="javascript:void(0)" wire:click='CheckConsumer'
                                                            class="wallet-btn universebtn">Add to
                                                            Wallet</a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Social Sharing Modal -->
                                    <div class="modal fade" id="shareModal" tabindex="-1"
                                        aria-labelledby="shareModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered custom-modal">
                                            <div class="modal-content">
                                                <!-- Close Button at Top-Right -->
                                                <button type="button" class="btn-close position-absolute"
                                                    style="top: 10px; right: 10px; z-index: 1050;"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>

                                                <div class="modal-body text-center">
                                                    <span>{{ $business->business_name }}</span><br>
                                                    <span>
                                                        @if ($business->street_address != '')
                                                            {{ $business->street_address }}, {{ $business->city }},
                                                            {{ $business->states->name }}, {{ $business->zip_code }}
                                                        @endif
                                                    </span><br>
                                                    <span>{{ $business->business_phone }}</span>

                                                    <hr>
                                                    <small>Share this business, earn points!</small>
                                                    Start Earning Points and make every share count!
                                                    <div class="row align-items-center">
                                                        <!-- Left Side - Image -->
                                                        <div class="col-md-5 text-center">
                                                            <img loading="lazy"
                                                                src="{{ asset($business->main_image_url) }}"
                                                                alt="{{ $business->business_name }}" width="234"
                                                                height="166" class="img-fluid rounded">

                                                        </div>
                                                        <!-- Right Side - Text and Share Buttons -->
                                                        <div class="col-md-7">
                                                            <!-- Share Buttons -->
                                                            <div class="row text-center my-3">
                                                                <!-- Facebook -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                                        target="_blank"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/facebook.svg') }}"
                                                                            alt="Facebook"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>Facebook</span>
                                                                    </a>
                                                                </div>
                                                                <!-- X (Example: Custom Social Network or Function) -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="https://x.com/intent/tweet?text={{ urlencode(url()->current()) }}"
                                                                        target="_blank"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/X.svg') }}"
                                                                            alt="X"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>X</span>
                                                                    </a>
                                                                </div>
                                                                <!-- LinkedIn -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title=YourPageTitle&summary=YourSummaryHere"
                                                                        target="_blank"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/linkedin.svg') }}"
                                                                            alt="LinkedIn"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>LinkedIn</span>
                                                                    </a>
                                                                </div>
                                                                <!-- WhatsApp -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"
                                                                        target="_blank"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/whatsapp.svg') }}"
                                                                            alt="WhatsApp"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>WhatsApp</span>
                                                                    </a>
                                                                </div>
                                                                <!-- Email -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#shareSocialModal"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/email.svg') }}"
                                                                            alt="Email"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>Email</span>
                                                                    </a>
                                                                </div>
                                                                <!-- Copy Link -->
                                                                <div class="col-6 mb-3">
                                                                    <a href="#"
                                                                        onclick="copyToClipboard('{{ url()->current() }}'); return false;"
                                                                        class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                        <img src="{{ asset('frontend_assets/images/copy.svg') }}"
                                                                            alt="Copy Link"
                                                                            style="height: 30px; margin-right: 8px;">
                                                                        <span>Copy Link</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <p class="mt-3" style="background-color: #f2f4f7">Earn 1 point
                                                        for each
                                                        listing you share on
                                                        Facebook, X
                                                        (formerly Twitter)
                                                        , and LinkedIn (10 point limit per day).</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="universe-top-head d-flex justify-content-center">No Result found</p>
                                @endforelse


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" wire:model="current_lat" id="current_lat">
        <input type="hidden" wire:model="current_long" id="current_long">

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
    </div>

    <!-- Share social Modal -->
    <div class="modal fade" id="shareSocialModal" tabindex="-1" aria-labelledby="shareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- Modal Header with Close Button -->
                <button type="button" class="btn-close position-absolute"
                    style="top: 10px; right: 10px; z-index: 1050;" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <!-- Modal Body with Form -->
                <div class="modal-body">
                    <div class="text-center">
                        <span class="d-block">Share this Listing.</span>
                        <small class="d-block">Share this Listing on any device.</small>
                    </div>
                    <hr class="mt-3">
                    <form>
                        <div class="row mb-3">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <label for="yourName" class="form-label">Your name*</label>
                                <input type="text" class="form-control" id="yourName"
                                    placeholder="Enter your name" required>
                            </div>

                            <!-- Email Field -->
                            <div class="col-md-6">
                                <label for="yourEmail" class="form-label">Your Email*</label>
                                <input type="email" class="form-control" id="yourEmail"
                                    placeholder="Write your email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="recipientEmail" class="form-label">Recipient Email(s)*</label>
                            <input type="email" class="form-control" id="recipientEmail"
                                placeholder="Write your recipient email" required>
                            <small class="form-text" style="color:red">Enter one or more recipient email addresses
                                separated
                                by commas or space.</small>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="2" placeholder="Enter your message or notes here"></textarea>
                            <small class="form-text" style="color:red">Enter your message or notes here to
                                include in the
                                email.</small>
                        </div>
                        <small style="color: #667085">
                            By clicking Share Now, I confirm I am permitted to send this email
                            The recipient's email address will only be used to send this email to
                            them and will not be collected or be available to anyone else.
                        </small>
                        <div class="text-center">
                            <button type="submit" class="btn w-100"
                                style="background-color: #26a1d6;color:white;margin-top:0px;">Share
                                Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://maps.google.com/maps/api/js?sensor=true&key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"
            type="text/javascript"></script>
        <script>
            if (navigator.geolocation) {

                // Geolocation is supported
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // Success callback
                        let current_lat = position.coords.latitude
                        let current_long = position.coords.longitude
                        $('#current_lat').val(current_lat);
                        $('#current_long').val(current_long);
                        @this.set('current_lat', current_lat);
                        @this.set('current_long', current_long);

                    },
                    function(error) {
                        // Error callback
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                console.log("User denied the request for Geolocation.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                console.log("Location information is unavailable.");
                                break;
                            case error.TIMEOUT:
                                console.log("The request to get user location timed out.");
                                break;
                            case error.UNKNOWN_ERROR:
                                console.log("An unknown error occurred.");
                                break;
                        }
                    }
                );
            } else {
                // Geolocation is not supported
                console.log("Geolocation is not supported by this browser.");
            }

            function copyToClipboard(url) {
                navigator.clipboard.writeText(url).then(function() {
                    alert('URL copied to clipboard');
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                //to prevent enter form submit
                $(window).keydown(function(event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                window.addEventListener('load', initialize);
            });

            var map;
            var locations;
            var circle;
            //var new_icon = '<?= asset('website_assets/images/locationicon.svg') ?>';



            locations = [<?php foreach ($lat_long_array as $value) {
                echo "['" . $value[0] . "','" . $value[1] . "','" . $value[2] . "','" . $value[3] . "'],";
            } ?>]




            function initialize() {

                let point_lt = {{ isset($latitude) ? $latitude : '37.0902' }};
                let point_ln = {{ isset($longitude) ? $longitude : '-95.7129' }};
                // let point_lt = {{ isset($latitude) ? $latitude : '22.589380' }};
                // let point_ln = {{ isset($longitude) ? $longitude : '88.410072' }};

                var thePoint = new google.maps.LatLng(point_lt, point_ln);

                var mapOptions = {
                    zoom: 10,
                    center: thePoint
                };

                map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);



                var infowindow = new google.maps.InfoWindow({
                    maxWidth: 500
                });
                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    console.log(locations[i][0]);
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                        map: map,
                        animation: google.maps.Animation.DROP,
                        //icon: new_icon
                    });
                    const contentString = `<a style="color:#141313;"` +
                        locations[i][3] +
                        `">
                            <div id="content">
                                <h4 id="firstHeading" class="firstHeading" style="margin-bottom:5px;text-transform: uppercase;">` +
                        locations[i][2] + `</h4>
                                <div id="bodyContent" class="row" style="margin:0px;">
                                        
                                        <div class="col-md-10">
                                            <p><b>` + locations[i][2] + `</b> is a ` + locations[i][3] +
                        ` <br>Address: ` + locations[i][3] + `</p>
                                        </div>
                                    </div>
                            </div>
                        </a>`;

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {

                        return function() {
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                            infowindow.open({
                                anchor: marker,
                                map,
                            });
                        }
                    })(marker, i));

                    map.setCenter(marker.getPosition());
                    map.setZoom(10);
                }

            }

            $(".closeModal").on('click', function() {
                $('#message_modal').modal('hide');
                $("#textmsg").html('');
            })
            window.livewire.on('messageModal', data => {
                $('#message_modal').modal('show');
                $("#textmsg").html(data.text);
            });
        </script>
    @endpush
</div>
