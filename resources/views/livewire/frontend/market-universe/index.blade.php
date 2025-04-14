<div>
    <style>
        .modal-content {
            border-radius: 24px;
            overflow: hidden;
        }

        .business_name {
            font-size: 32px;
            font-weight: 700;
            color: #000;
            line-height: 42px;
        }

        .social-modal-header {
            right: 32px;
            bottom: 32px;
            left: 32px;
            margin: 0px 0px 32px 0px;
        }

        .business_address {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin-top: 6px;
        }

        .social-share-small {
            font-size: 16px;
            color: #000;
        }

        .small-text {
            font-size: 12px;
            margin-top: 10px;
        }

        .social-share-margin {
            /* margin-bottom: 40px; */
        }

        .img-equal {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .equal-height-container {
            display: flex;
            align-items: stretch;
            height: 250px;
            max-width: 700px;
            margin: auto;
        }

        .equal-height-container>div {
            flex: 1;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 8px;
            width: 100%;
            gap: 10px;
        }

        .social-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #000;
        }

        .icon-img {
            width: 40px;
            height: 40px;
        }

        @media (max-width: 768px) {
            .social-btn {
                justify-content: flex-start;
                text-align: left;
            }

            .icon-img {
                width: 24px;
                height: 24px;
            }
        }

        .social-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .social-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            flex-grow: 1;
        }

        .social-row:first-child {
            align-self: flex-start;
        }

        .social-row:nth-child(2) {
            align-self: center;
            margin-top: 40px;
        }

        .social-row:last-child {
            align-self: flex-end;
            margin-top: 40px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            gap: 8px;
            font-size: 14px;
        }

        .icon-img {
            width: 28px;
            height: 28px;
        }

        @media (max-width: 768px) {
            .business_name {
                font-size: 16px;
            }

            .business_address,
            .small-text,
            .social-share-small {
                font-size: 12px;
            }

            .social-btn span {
                font-size: 12px;
            }

            .icon-img {
                width: 24px;
                height: 24px;
            }

            .footer-text {
                font-size: 12px;
            }
        }

        .email-sharing-modal {
            border-radius: 24px !important;
        }

        .search-location {
            margin-right: 10px;
        }

        #search-location {
            margin-right: 15px;
            border-radius: 100px;
            border: 1px solid var(--body-clr);
            height: 40px;
            width: 100%;
            padding: 8px 15px;
        }

        /* Map container styles */
        #map {
            height: 400px;
            width: 100%;
            margin-top: 15px;
            border-radius: 8px;
            display: none;
            /* Hidden by default */
        }

        #map-canvas {
            width: 100%;
            height: 500px;
            display: none;
            /* Hidden by default */
        }

        .mapbtn.active {
            background-color: #f0f0f0;
        }

        .pac-container {
            z-index: 1051 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style-new.css') }}">

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
                                        <input type="radio" name="distance" value="any" wire:model="distance">
                                        <span>Any Distance</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="5" wire:model="distance">
                                        <span>Within 5.0 mi (&lt;10)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="10" wire:model="distance">
                                        <span>Within 10.0 mi (&lt;10)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="20" wire:model="distance">
                                        <span>Within 20.0 mi (&lt;10+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="50" wire:model="distance">
                                        <span>Within 50.0 mi (&lt;20+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="100" wire:model="distance">
                                        <span>Within 100.0 mi (&lt;30+)</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="distance" value="250" wire:model="distance">
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
                                    <a href="javascript:void(0)" class="reset-filter" wire:click="resetFilter">Reset
                                        Filter</a>
                                </div>
                                <button class="fltrbtncls">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/fltr.png') }}"
                                        alt="">
                                    <span>Filter</span>
                                </button>
                            </div>

                            <div class="sort-divss">
                                <div class="filter-mdl-blk">
                                    <div class="search-location">
                                        <input type="text" id="search-location" class="form-control"
                                            placeholder="Search by a location">

                                    </div>
                                </div>

                                <select name="sort_by" id="sort_by" wire:model="sortBy">
                                    <option value="">Sort By</option>
                                    <option value="category">Category</option>
                                    <option value="distance">Distance</option>
                                    <option value="name">Name</option>
                                </select>
                                <button class="mapbtn" id="toggleMapBtn">
                                    <img loading="lazy" class="mapbtn-img"
                                        src="{{ asset('frontend_assets/images/map-ic.svg') }}" alt="">
                                    <span class="mapbtn-hide">View Map</span>
                                </button>
                            </div>
                        </div>
                        <div class="filter-mdl-blk" wire:ignore style="display: none;">
                            <div class="map">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="filter-sec-rit-btm">
                            <div class="row rowspan">
                                @forelse ($business_profiles as $business)
                                    @foreach ($business->locations->where('status', 1) as $location)
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
                                                        data-bs-target="#shareModal{{ $business->id }}-{{ $location->id }}">
                                                        <a href="javascript:void(0)" class="cmn-purchase">
                                                            <img loading="lazy"
                                                                src="{{ asset('frontend_assets/images/shrss.svg') }}"
                                                                alt="share info1 icon">
                                                        </a>
                                                        <span>Share</span>
                                                    </div>
                                                    <figure class="purchase-fig">
                                                        @php
                                                            $location_slug = implode('|', [
                                                                Str::slug($location->location_name ?? ''),
                                                                Str::slug($location->address ?? ''),
                                                                $location->latitude ?? '0',
                                                                $location->longitude ?? '0',
                                                            ]);
                                                        @endphp
                                                        <a
                                                            href="{{ route('frontend.merchant.website', [
                                                                'id' => $business->id,
                                                                'location_id' => $location->id,
                                                            ]) }}">
                                                            <img loading="lazy" src="{{ $business->logo_image }}"
                                                                alt="fruits1 image">
                                                        </a>
                                                    </figure>
                                                </div>
                                                <div class="universe-con">
                                                    <div class="universe-top-con">
                                                        <div class="universe-top-head">
                                                            {{-- <a
                                                                href="{{ route('frontend.merchant.website', $business->id) }}">
                                                                {{ $business->business_name }}
                                                            </a> --}}
                                                            @php
                                                                $location_slug = implode('|', [
                                                                    Str::slug($location->location_name ?? ''),
                                                                    Str::slug($location->address ?? ''),
                                                                    $location->latitude ?? '0',
                                                                    $location->longitude ?? '0',
                                                                ]);
                                                            @endphp
                                                            <a
                                                                href="{{ route('frontend.merchant.website', [
                                                                    'id' => $business->id,
                                                                    'location_id' => $location->id,
                                                                ]) }}">
                                                                {{ $business->business_name }}
                                                            </a>
                                                        </div>
                                                        <div class="universe-top-btm-head">
                                                            <p>{{ $location->location_name }} -
                                                                {{ $location->address }}
                                                            </p>
                                                            {{-- @if ($location->latitude)
                                                                <span>{{ $this->haversineDistance($location->latitude, $location->longitude) }}
                                                                    mi</span>
                                                            @endif --}}
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
                                                                            <span>Earn up to 20 points per
                                                                                purchase</span>
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
                                                                                <p>{{ $item->point }} points to redeem
                                                                                </p>
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
                                        <div class="modal fade"
                                            id="shareModal{{ $business->id }}-{{ $location->id }}" tabindex="-1"
                                            aria-labelledby="shareModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered custom-modal"
                                                style="max-width: 900px; width: 90%;">
                                                <div class="modal-content container-fluid position-relative">

                                                    <div class="modal-body text-center">
                                                        <button type="button"
                                                            class="btn-close position-absolute top-0 end-0 mt-3"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>

                                                        <div
                                                            class="row align-items-center social-modal-header text-center text-md-start">
                                                            <div class="col-12 col-md-3 text-center mb-2 mb-md-0">
                                                                <img src="{{ $business->logo_image }}"
                                                                    alt="Business Logo" class="img-fluid"
                                                                    style="width: 160px; height: auto;border-radius: 7px">
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="business_name fw-bold">
                                                                    {{ $business->business_name }}</div>
                                                                <div class="business_address">
                                                                    {{ $location->address }}
                                                                </div>
                                                                <div class="mt-2">{{ $location->business_phone }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <small class="social-share-small text-muted">Share this
                                                            business,
                                                            earn
                                                            points!</small>
                                                        <p class="small-text text-secondary">Start Earning Points and
                                                            make
                                                            every share
                                                            count!</p>

                                                        <div class="row g-0">
                                                            <div
                                                                class="col-12 col-md-5 d-flex align-items-center justify-content-center p-2 bg-light">
                                                                <img loading="lazy"
                                                                    src="{{ asset($business->main_image_url) }}"
                                                                    alt="{{ $business->business_name }}"
                                                                    width="234" height="166"
                                                                    class="img-fluid rounded">
                                                            </div>

                                                            <div
                                                                class="col-12 col-md-7 d-flex flex-column social-container p-3">
                                                                <div class="social-row">
                                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('frontend.merchant.website', ['id' => $business->id, 'location_id' => $location->id])) }}"
                                                                        target="_blank" class="social-btn">
                                                                        <img src="{{ asset('frontend_assets/images/facebook.svg') }}"
                                                                            alt="Facebook" class="icon-img">
                                                                        <span>Facebook</span>
                                                                    </a>
                                                                    <a href="https://x.com/intent/tweet?text={{ urlencode(route('frontend.merchant.website', ['id' => $business->id, 'location_id' => $location->id])) }}"
                                                                        target="_blank" class="social-btn">
                                                                        <img src="{{ asset('frontend_assets/images/X.svg') }}"
                                                                            alt="X" class="icon-img">
                                                                        <span>X</span>
                                                                    </a>
                                                                </div>

                                                                <div class="social-row">
                                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('frontend.merchant.website', ['id' => $business->id, 'location_id' => $location->id])) }}"
                                                                        target="_blank" class="social-btn">
                                                                        <img src="{{ asset('frontend_assets/images/linkedin.svg') }}"
                                                                            alt="LinkedIn" class="icon-img">
                                                                        <span>LinkedIn</span>
                                                                    </a>

                                                                    <a href="https://api.whatsapp.com/send?text={{ urlencode(route('frontend.merchant.website', ['id' => $business->id, 'location_id' => $location->id])) }}"
                                                                        target="_blank" class="social-btn">
                                                                        <img src="{{ asset('frontend_assets/images/whatsapp.svg') }}"
                                                                            alt="WhatsApp" class="icon-img">
                                                                        <span>WhatsApp</span>
                                                                    </a>
                                                                </div>

                                                                <div class="social-row">
                                                                    <a href="#" data-bs-toggle="modal"
                                                                        data-bs-target="#shareSocialModal"
                                                                        class="social-btn email-share-btn"
                                                                        data-link="{{ url('merchant/' . $business->id . '/' . $location->id) }}">
                                                                        <img src="{{ asset('frontend_assets/images/email.svg') }}"
                                                                            alt="Email" class="icon-img">
                                                                        <span>Email</span>
                                                                    </a>

                                                                    <a href="#"
                                                                        onclick="copyToClipboard('{{ url('merchant/' . $business->id . '/' . $location->id) }}'); return false;"
                                                                        class="social-btn">
                                                                        <img src="{{ asset('frontend_assets/images/copy.svg') }}"
                                                                            alt="Copy Link" class="icon-img">
                                                                        <span>Copy Link</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="bg-light text-secondary text-center py-2 mt-3 rounded footer-text">
                                                            Earn 1 point for each listing you share on Facebook, X
                                                            (formerly
                                                            Twitter)
                                                            ,
                                                            and LinkedIn (10 point limit per day).
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

    <!-- Share social Modal via email -->
    <div class="modal fade" id="shareSocialModal" tabindex="-1" aria-labelledby="shareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content email-sharing-modal">
                <button type="button" class="btn-close position-absolute"
                    style="top: 10px; right: 10px; z-index: 1050;" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <div class="modal-body">
                    <div class="text-center">
                        <span class="d-block">Share this Listing.</span>
                        <small class="d-block">Share this Listing on any device.</small>
                    </div>
                    <hr class="mt-3">
                    <form action="{{ route('share-business.email') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="yourName" class="form-label">Your name*</label>
                                <input type="text" name="yourName" class="form-control" id="yourName"
                                    placeholder="Enter your name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="yourEmail" class="form-label">Your Email*</label>
                                <input type="email" name="yourEmail" class="form-control" id="yourEmail"
                                    placeholder="Write your email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="recipientEmail" class="form-label">Recipient Email(s)*</label>
                            <input type="text" name="recipientEmail" class="form-control" id="recipientEmail"
                                placeholder="Write your recipient email" required>
                            <small class="form-text" style="color:red">Enter one or more recipient email addresses
                                separated
                                by commas or space.</small>
                        </div>
                        <div class="mb-3">
                            <label for="emailSubject" class="form-label">Email Subject</label>
                            <input type="text" name="emailSubject" class="form-control" id="emailSubject"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="message" rows="2"
                                placeholder="Enter your message or notes here"></textarea>
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
        <input type="hidden" id="pageLink">
    </div>

    @push('scripts')
        <script
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places&callback=initMap"
            async defer></script>
        <script>
            // Global variables
            let map, autocomplete, marker;
            let mapViewActive = false;

            // Initialize Google Maps
            function initMap() {
                console.log('Initializing Google Maps...');

                // Try to get current position first
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const currentLat = position.coords.latitude;
                            const currentLng = position.coords.longitude;
                            initMapWithLocation(currentLat, currentLng);
                        },
                        function(error) {
                            console.warn("Geolocation error:", error);
                            // Default to New York if geolocation fails
                            initMapWithLocation(40.730610, -73.935242);
                        }
                    );
                } else {
                    console.log("Geolocation is not supported by this browser.");
                    // Default to New York if geolocation not supported
                    initMapWithLocation(40.730610, -73.935242);
                }
            }

            function initMapWithLocation(lat, lng) {
                // Create map
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 12,
                });

                // Create autocomplete
                autocomplete = new google.maps.places.Autocomplete(
                    document.getElementById("search-location"), {
                        types: ['geocode'],
                        fields: ['geometry', 'name', 'formatted_address']
                    }
                );

                // Bind autocomplete to map bounds
                autocomplete.bindTo('bounds', map);

                // Create marker
                marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29)
                });

                // Handle place selection
                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();

                    if (!place.geometry) {
                        console.log("No details available for input: " + place.name);
                        return;
                    }

                    // Update map view
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(21);
                    }

                    // Update marker position
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                    // Update Livewire component with new location
                    @this.set('location', place.formatted_address || place.name);

                    // Update hidden fields with coordinates
                    @this.set('current_lat', place.geometry.location.lat());
                    @this.set('current_long', place.geometry.location.lng());
                });

                console.log('Google Maps initialized successfully');
            }

            // Toggle map view
            document.getElementById('toggleMapBtn').addEventListener('click', function(e) {
                e.preventDefault();
                mapViewActive = !mapViewActive;

                if (mapViewActive) {
                    document.getElementById('map').style.display = 'block';
                    this.classList.add('active');
                    // Recenter map if needed
                    if (map && autocomplete) {
                        const place = autocomplete.getPlace();
                        if (place && place.geometry) {
                            map.setCenter(place.geometry.location);
                        }
                    }
                } else {
                    document.getElementById('map').style.display = 'none';
                    this.classList.remove('active');
                }
            });

            // Copy to clipboard function
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    toastr.success('URL copied to clipboard');
                }).catch(function(err) {
                    toastr.error('Could not copy text: ' + err);
                });
            }

            // Close modal handler
            document.querySelectorAll(".closeModal").forEach(btn => {
                btn.addEventListener('click', function() {
                    $('#message_modal').modal('hide');
                    $("#textmsg").html('');
                });
            });

            // Livewire event listeners
            window.livewire.on('messageModal', data => {
                $('#message_modal').modal('show');
                $("#textmsg").html(data.text);
            });

            // Email share button handler
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".social-btn.email-share-btn").forEach(button => {
                    button.addEventListener("click", function(event) {
                        event.preventDefault();
                        let pageLink = this.getAttribute("data-link");

                        // Set default message with subject and link
                        document.getElementById("emailSubject").value = "Check out this Gimmzi Pages";
                        document.getElementById("pageLink").value = pageLink;
                        document.getElementById("message").value = pageLink;
                    });
                });
            });

            // Prevent form submit on enter key
            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        </script>
    @endpush
</div>
