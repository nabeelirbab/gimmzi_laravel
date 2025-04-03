<x-layouts.univers-layout title="Explore">
    <style type="text/css">
        .custom-image {
            /* Ensures the image is responsive on mobile */
            width: 100%;
            /* This is redundant because img-fluid already sets width to 100% */
            height: auto;
            /* This is redundant because img-fluid already sets height to auto */
        }

        /* Media query for desktops and larger devices */
        @media (min-width: 992px) {

            /* Adjust this breakpoint to suit your design */
            .custom-image {
                width: 900px;
                /* Fixed width for desktop */
                height: 600px;
                /* Fixed height for desktop */
            }
        }

        .custom-modal-content {
            background-color: transparent;
            border: none;
        }

        .custom-modal-header {
            border: none;
            padding: 0;
        }

        .custom-close-button {
            z-index: 9;
            border-radius: 20px;
            line-height: 1;
            color: orange;
            /* Ensure the close button color is clearly visible */
        }

        .business-name {
            background-color: blue;
            color: white;
            /* Ensure text is visible */
        }

        .business-address {
            background-color: green;
            color: white;
            /* Ensure text is visible */
        }

        .business-phone {
            background-color: yellow;
            color: black;
            /* Black text for contrast */
        }

        /* Remove the background color from the tab buttons */
        .nav-link {
            color: #808080;
        }

        .nav-link.active {
            color: #26a1d6;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #26a1d6;
            background-color: transparent;
            text-decoration: none;
            border-bottom: 2px solid #26a1d6;
        }

        .nav-pills .nav-link:hover {
            background-color: #f8f9fa;
            color: #26a1d6;
        }

        hr {
            border: 1px solid #ddd;
            margin-top: -3px;
            margin-bottom: 20px;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "\00bb";
            /* Unicode for right chevron (›) */
            padding: 0 8px;
        }

        a {
            color: #26a1d6;
        }

        /* Remove the default radio button appearance */
        .styled-radio {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        /* Default state */
        .styled-radio:checked {
            background-color: #26a1d6;
            border-color: #26a1d6;
        }

        /* Hover state */
        .styled-radio:hover {
            border-color: #26a1d6;
        }

        .btn.btn-primary:hover {
            background: #fff;
            color: #fff;
        }

        /* General styles for the radio buttons */
        .form-check-input2 {
            appearance: none;
            /* Removes default styles */
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        /* Default state */
        .form-check-input2:not(:checked) {
            background-color: #fff;
        }

        /* Checked state */
        .form-check-input2:checked {
            background-color: #26a1d6;
            /* Desired color for selected radio */
            border-color: #26a1d6;
            /* Matches the color */
        }

        /* Add a hover effect (optional) */
        .form-check-input2:hover {
            border-color: #26a1d6;
        }

        .carousel-inner img {
            width: 100%;
            /* Make the image span the full width of the container */
            height: 400px;
            /* Set a fixed height for all images */
            object-fit: cover;
            /* This will maintain the aspect ratio and fill the image */
        }

        .modal-dialog.custom-modal {
            max-width: 600px;
            /* Adjust width as needed */
        }

        #map {
            width: 100%;
            height: 400px;
        }

        /* Move carousel controls outside the modal */
        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1050;
            /* Ensures it sits above modal content */
        }

        /* Move the previous button to the left outside the modal */
        .carousel-control-prev {
            left: -30px;
            /* Adjust this value to move it more or less outside */
        }

        /* Move the next button to the right outside the modal */
        .carousel-control-next {
            right: -30px;
            /* Adjust this value to move it more or less outside */
        }

        #shareModal .modal-content {
            border-radius: 24px;
            /* Adjust this value (e.g., 20px, 25px) for more rounding */
            overflow: hidden;
            /* Ensures content respects the rounded corners */
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
            /* Ensures equal height */
            height: 250px;
            /* Reduced height */
            max-width: 700px;
            /* Adjust width for a compact design */
            margin: auto;
            /* Center alignment */
        }

        .equal-height-container>div {
            flex: 1;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            /* Align items properly */
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-radius: 8px;

            width: 100%;
            gap: 10px;
            /* Adds spacing between icon and text */
        }

        .social-btn:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #000;
        }

        .icon-img {
            width: 40px;
            /* Ensure proper icon size */
            height: 40px;
        }

        @media (max-width: 768px) {
            .social-btn {
                justify-content: flex-start;
                /* Ensure alignment remains left */
                text-align: left;
            }

            .icon-img {
                width: 24px;
                /* Slightly smaller icons on mobile */
                height: 24px;
            }
        }

        .social-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Distributes rows evenly */
            height: 100%;
            /* Match the height of the image */
        }

        .social-row {
            display: flex;
            justify-content: space-between;
            /* Ensures spacing between icons */
            align-items: center;
            width: 100%;
            flex-grow: 1;
            /* Ensures equal spacing */
        }

        /* Individual row alignment */
        .social-row:first-child {
            align-self: flex-start;
            /* Align top */
        }

        .social-row:nth-child(2) {
            align-self: center;
            margin-top: 40px;
            /* Align middle */
        }

        .social-row:last-child {
            align-self: flex-end;
            margin-top: 40px;
            /* Align bottom */
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
                /* Reduce business name font size */
            }

            .business_address,
            .small-text,
            .social-share-small {
                font-size: 12px;
                /* Reduce other text sizes */
            }

            .social-btn span {
                font-size: 12px;
                /* Reduce button text size */
            }

            .icon-img {
                width: 24px;
                /* Reduce icon size */
                height: 24px;
            }

            .footer-text {
                font-size: 12px;
            }
        }

        .email-sharing-modal {
            border-radius: 24px !important;
        }

        body {
            color: #000;

        }

        .carousel-control-next,
        .carousel-control-prev {
            background-color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel-control-next {
            right: -60px;
        }

        .carousel-control-prev {
            left: -60px;
        }

        .carousel-control-next img,
        .carousel-control-prev img {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 450px) {

            .carousel-control-prev,
            .carousel-control-next {
                margin-left: 0;
                margin-right: 0;
            }
        }
    </style>
    <div class="allen-park-apartments-main-sec">
        <div class="allen-part-apartments-sec">
            <div class="first-goback-search-sec">
                <div class="container mx-4 d-flex align-items-center">
                    {{-- <div class="btn-go-search-apartments">
                            <a href="{{ route('frontend.index') }}"><button><img
                                        src="{{ asset('frontend_assets/images/go-back-icon-1.svg') }}" alt="">Go
                                    Back to search</button>
                            </a>
                        </div> --}}
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Explore</a></li>
                            <li class="breadcrumb-item"><a href="#">Gimmzi Market Universe</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $business->category->category_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="middle-park-main-middle-sec">
                <div class="container">
                    <div class="row p-4">
                        <!-- Left Section: Image -->
                        <div class="col-md-6 col-12 mb-4 mb-md-0 ps-0"> <!-- Change here for mobile-first approach -->
                            <div class="d-flex flex-column">
                                <h2>{{ $business->business_name }}</h2>
                                @if ($business->street_address != '')
                                    <p style="margin-top: 10px;">
                                        <img src="{{ asset('frontend_assets/images/location.svg') }}" alt="icon">
                                        {{ $business->street_address }}, {{ $business->city }},
                                        {{ $business->states->name }}, {{ $business->zip_code }}
                                    </p>
                                @elseif($business->mailing_address != '')
                                    <p style="margin-top: 10px;">
                                        <img src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                            alt="icon">
                                        {{ $business->mailing_address }}, {{ $business->mailing_city }},
                                        {{ $business->mailingstates->name }}, {{ $business->mailing_zipcode }}
                                    </p>
                                @else
                                    <li></li>
                                @endif
                            </div>
                        </div>
                        <!-- Social Sharing Modal -->

                        <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered custom-modal"
                                style="max-width: 900px; width: 90%;">
                                <div class="modal-content container-fluid position-relative">
                                    <!-- Close Button -->
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>

                                    <div class="modal-body text-center">
                                        <!-- Business Info -->
                                        <div
                                            class="row align-items-center social-modal-header text-center text-md-start">
                                            <div class="col-12 col-md-3 text-center mb-2 mb-md-0">
                                                <img src="{{ asset('frontend_assets/images/modal_logo.png') }}"
                                                    alt="Business Logo" class="img-fluid"
                                                    style="max-width: 60px; height: auto;">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="business_name fw-bold">{{ $business->business_name }}</div>
                                                <div class="business_address">
                                                    @if (!empty($business->street_address))
                                                        {{ $business->street_address }}, {{ $business->city }},
                                                        {{ $business->states->name }}, {{ $business->zip_code }}
                                                    @endif
                                                </div>
                                                <div class="mt-2">{{ $business->business_phone }}</div>
                                            </div>
                                        </div>

                                        <hr>

                                        <small class="social-share-small text-muted">Share this business, earn
                                            points!</small>
                                        <p class="small-text text-secondary">Start Earning Points and make every share
                                            count!</p>

                                        <!-- Social Sharing Content -->
                                        <div class="row g-0">
                                            <!-- Business Image -->
                                            <div
                                                class="col-12 col-md-5 d-flex align-items-center justify-content-center p-2 bg-light">
                                                @foreach ($business_photos as $index => $photo)
                                                    @if ($index == 0)
                                                        <img src="{{ asset($photo->getUrl()) }}" alt="Business Image"
                                                            class="img-fluid rounded w-100" style="max-height: 250px;">
                                                    @endif
                                                @endforeach
                                            </div>

                                            <!-- Social Media Share Buttons -->
                                            <div class="col-12 col-md-7 d-flex flex-column social-container p-3">
                                                <!-- Top Row -->
                                                <div class="social-row">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/facebook.svg') }}"
                                                            alt="Facebook" class="icon-img">
                                                        <span>Facebook</span>
                                                    </a>
                                                    <a href="https://x.com/intent/tweet?text={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/X.svg') }}"
                                                            alt="X" class="icon-img">
                                                        <span>X</span>
                                                    </a>
                                                </div>

                                                <!-- Middle Row -->
                                                <div class="social-row">
                                                    {{-- <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn"> --}}
                                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/linkedin.svg') }}"
                                                            alt="LinkedIn" class="icon-img">
                                                        <span>LinkedIn</span>
                                                    </a>
                                                    <a href="https://api.whatsapp.com/send?text={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/whatsapp.svg') }}"
                                                            alt="WhatsApp" class="icon-img">
                                                        <span>WhatsApp</span>
                                                    </a>
                                                </div>

                                                <!-- Bottom Row -->
                                                <div class="social-row">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#shareSocialModal" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/email.svg') }}"
                                                            alt="Email" class="icon-img">
                                                        <span>Email</span>
                                                    </a>
                                                    {{-- <a href="https://mail.google.com/mail/?view=cm&fs=1&to=&su=Check%20out%20this%20Gimmzi%20page&body={{ urlencode(request()->fullUrl()) }}"
                                                        target="_blank" class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/email.svg') }}"
                                                            alt="Email" class="icon-img">
                                                        <span>Email</span>
                                                    </a> --}}


                                                    <a href="#"
                                                        onclick="copyToClipboard('{{ url()->current() }}'); return false;"
                                                        class="social-btn">
                                                        <img src="{{ asset('frontend_assets/images/copy.svg') }}"
                                                            alt="Copy Link" class="icon-img">
                                                        <span>Copy Link</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Points Information -->
                                        <div class="bg-light text-secondary text-center py-2 mt-3 rounded footer-text">
                                            Earn 1 point for each listing you share on Facebook, X (formerly Twitter),
                                            and LinkedIn (10 point limit per day).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Buttons -->
                        <div class="col-md-6 col-12">
                            <div class="d-flex flex-md-row flex-column justify-content-md-end justify-content-center map-it-buttons"
                                style="gap: 24px; margin-right:20px;">
                                <div class="d-flex align-items-center"
                                    style="background-color: #F2F4F7; padding: 8px; border-radius: 8px; cursor: pointer;">
                                    <img src="{{ asset('frontend_assets/images/phone-icon.svg') }}" alt="phone-icon">
                                    <p id="phone-number" style="margin-left: 7px;"
                                        data-phone="{{ $business->business_phone }}">
                                        @auth
                                            @php
                                                $businessProfileId = \App\Models\BusinessProfile::where(
                                                    'merchant_id',
                                                    Auth::user()->id,
                                                )->pluck('id');
                                                $businessLocation = \App\Models\BusinessLocation::where(
                                                    'business_profile_id',
                                                    $businessProfileId,
                                                )->first();
                                            @endphp
                                        @endauth
                                        {{ $businessLocation->business_phone ?? $business->business_phone }}
                                    </p>
                                </div>

                                <div class="d-flex align-items-center rounded-2"
                                    style="background-color: #F2F4F7; padding: 10px;">
                                    <a href="{{ $businessLocation->business_fax_number ?? 'https://gimmzi-smart.dedicateddevelopers.us/' }}"
                                        target="_blank">
                                        <img src="{{ asset('frontend_assets/images/global-icon.png') }}"
                                            alt="global-icon" style="width:24px !important;height:24px !important;">
                                        <p style="margin-left: 7px;">visit website
                                    </a>
                                </div>

                                <div class="d-flex align-items-center" style="cursor: pointer;"
                                    data-bs-toggle="modal" data-bs-target="#shareModal">
                                    <img src="{{ asset('frontend_assets/images/share.svg') }}" alt="">
                                    <p style="margin-left: 7px; text-decoration: underline">share</p>
                                </div>

                                <div class="d-flex align-items-center">
                                    @if ($alreadyFav)
                                        <img src="{{ asset('frontend_assets/images/wishlist-filled.svg') }}"
                                            alt="wishlist-icon" style="width: 24px;height: 24px;">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/wishlist.svg') }}"
                                            alt="wishlist-icon" style="width: 24px;height: 24px;">
                                    @endif
                                    <p class="save-favourite" data-business-id="{{ $business->id }}"
                                        style="margin-left: 7px; text-decoration: underline; cursor: pointer;">Save
                                    </p>
                                </div>

                                <!-- Include jQuery -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <script>
                                    $(document).ready(function() {
                                        $(".save-favourite").click(function() {
                                            var businessId = $(this).data("business-id");
                                            var heartIcon = $(this).closest('.d-flex').find('img');
                                            console.log('businessId:', businessId);

                                            $.ajax({
                                                url: "{{ route('wishlist.save') }}", // Ensure route exists in web.php
                                                type: "POST",
                                                data: {
                                                    business_id: businessId,
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                success: function(response) {
                                                    if (response.status) { // Check if the response status is true
                                                        toastr.success(response
                                                            .message); // Show success message from response
                                                    } else {
                                                        toastr.warning(response.message); // Show warning message if needed
                                                    }
                                                    // Toggle the heart icon color
                                                    if (heartIcon.attr("src") ===
                                                        "{{ asset('frontend_assets/images/wishlist.svg') }}") {
                                                        heartIcon.attr("src",
                                                            "{{ asset('frontend_assets/images/wishlist-filled.svg') }}"
                                                        );
                                                    } else {
                                                        heartIcon.attr("src",
                                                            "{{ asset('frontend_assets/images/wishlist.svg') }}");
                                                    }
                                                },
                                                error: function(xhr) {
                                                    let errorMessage =
                                                        'Something went wrong! Please try again.'; // Default error message
                                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                                        errorMessage = xhr.responseJSON
                                                            .message; // Use server-provided error message
                                                    }
                                                    toastr.error(errorMessage);
                                                }
                                            });
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="row">
                            <!-- Left Content (60%) -->
                            <div class="col-md-7 col-12">
                                <!-- First Image -->
                                @foreach ($business_photos as $index => $photo)
                                    @if ($index == 0)
                                        <!-- Display first image -->
                                        <img src="{{ $photo->getUrl() }}" alt="image"
                                            class="img-fluid mb-3 custom-image rounded-3" data-bs-toggle="modal"
                                            data-bs-target="#imageCarouselModal" onclick="setActiveSlide(0)">
                                    @endif
                                @endforeach

                                <!-- Second Row with 5 rounded images -->
                                <div class="row mt-3">
                                    @foreach ($business_photos as $index => $photo)
                                        @if ($index > 0 && $index < 6)
                                            <!-- Only show the first 5 images for the second row -->
                                            <div class="col-6 col-md-2">
                                                <img src="{{ $photo->getUrl() }}" alt="image {{ $index }}"
                                                    class="img-fluid rounded-3 mb-3" data-bs-toggle="modal"
                                                    data-bs-target="#imageCarouselModal"
                                                    onclick="setActiveSlide({{ $index }})">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right Content (40%) -->
                            <div class="col-12 col-md-5 d-flex justify-content-end">
                                <div class="rounded p-1 p-md-4" style="width: 100%;">
                                    <div class="">
                                        <div class="card p-1 p-md-4">

                                            <!-- deals -->
                                            @foreach (collect($data['deals'])->take(3) as $deal)
                                                <div class="form-check mt-3" data-bs-toggle="modal"
                                                    data-business-id="{{ $business->id }}"
                                                    data-deal-id="{{ $deal->id }}"
                                                    data-business-id="{{ $deal->business_id }}"
                                                    data-title="Deal Detail {{ $deal->id }}"
                                                    data-description="{{ $deal->description }}"
                                                    data-termsAndConditions="{{ $deal->terms_conditions }}"
                                                    style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; display: flex; align-items: center; position: relative;">
                                                    <input class="form-check-input2" type="radio" name="offer"
                                                        id="offer1" value="25-off-all-products"
                                                        style="margin-right: 10px;width:20px;">
                                                    <div style="flex: 1; width: calc(100% - 35px);">
                                                        <label class="form-check-label" for="offer1"
                                                            style="display: block; color:#000">
                                                            <p style="line-height: 30px;width:80%;">
                                                                {{ $deal->suggested_description }}</p>
                                                        </label>
                                                        <small class="d-block text-muted"
                                                            style="display: block; color:#26a1d6 !important; line-height: 18px;">
                                                            Earn up to {{ $deal->off_percentage }} on your purchase
                                                        </small>
                                                    </div>
                                                    <img src="{{ asset('frontend_assets/images/tooltip.svg') }}"
                                                        style="position: absolute; top: 0px; right: 0px; border-radius: 5px;"
                                                        data-bs-toggle="modal" data-bs-target="#offerDetailsModal"
                                                        data-id="{{ $deal->id }}">
                                                </div>
                                            @endforeach

                                            <!-- loyalty -->
                                            @foreach (collect($data['loyalty'])->take(2) as $loyalty)
                                                <div class="form-check mt-3" data-loyalty-id="{{ $loyalty->id }}"
                                                    data-business-id="{{ $business->id }}"
                                                    data-title="{{ $loyalty->program_name }}"
                                                    data-description="{{ $loyalty->about_program }}"
                                                    data-termsAndConditions='{{ $loyalty->terms_conditions }}'
                                                    style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; display: flex; align-items: center; position: relative;">
                                                    <input class="form-check-input2" type="radio" name="offer"
                                                        id="offer1" value="25-off-all-products"
                                                        style="margin-right: 10px;width:20px">
                                                    <div style="flex: 1; width: calc(100% - 35px);">
                                                        <label class="form-check-label" for="offer1"
                                                            style="display: block; color:#000">
                                                            <p style="line-height: 30px;">{{ $loyalty->program_name }}
                                                            </p>
                                                        </label>
                                                        <small class="d-block text-muted"
                                                            style="display: block; color:#26a1d6 !important; line-height: 18px;">
                                                            Earn up to {{ $loyalty->off_percentage }} on your purchase
                                                        </small>
                                                    </div>
                                                    <img src="{{ asset('frontend_assets/images/tooltip.svg') }}"
                                                        style="position: absolute; top: 0px; right: 0px; border-radius: 5px;"
                                                        data-bs-toggle="modal" data-bs-target="#offerLoyaltyModal"
                                                        data-id="{{ $loyalty->id }}">
                                                </div>
                                            @endforeach

                                            @if (empty(collect($data['deals'])) || empty(collect($data['loyalty'])))
                                                <!-- Add to Wallet Button -->
                                                <div class="mt-4">
                                                    <button class="btn btn-primary btn-block w-100"
                                                        style="background-color: #26a1d6" id="addToWalletBtn">
                                                        Add to My Wallet {{ collect($data['deals']) }}</button>
                                                </div>
                                            @else
                                                <div class="mt-4">
                                                    <button class="btn btn-primary btn-block w-100"
                                                        style="background-color: #26a1d6">
                                                        No deal and loyalty found</button>
                                                </div>
                                            @endif

                                            <!-- Card with List -->
                                            @php
                                                $groupedBoards = $message_boards
                                                    ->filter(function ($message_board) {
                                                        return !empty($message_board->displayBoard->title);
                                                    })
                                                    ->groupBy(function ($message_board) {
                                                        return $message_board->displayBoard->title;
                                                    });
                                            @endphp
                                            <div class="card mt-4" style="width: 100%;">
                                                <ul class="list-group list-group-flush">
                                                    @foreach ($groupedBoards as $title => $boards)
                                                        <li class="list-group-item">
                                                            <p style="color:#17B26A !important;">{{ $title }}
                                                            </p>
                                                            @foreach ($boards as $message_board)
                                                                <p>{!! $message_board->description !!}</p>
                                                            @endforeach
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            {{-- <div class="card mt-4" style="width: 100%;">
                                                <ul class="list-group list-group-flush">
                                                    @if (!empty($message_board->boardone))
                                                        <li class="list-group-item">
                                                            <p style="color:#17B26A; margin-bottom: 1px">
                                                                {{ $message_board->board_one_title }}</p>
                                                            <span style="color: #98A2B3; font-size: 12px">
                                                                {{ $message_board->boardone->active_description }}</span>
                                                        </li>
                                                    @endif

                                                    @if (!empty($message_board->boardtwo))
                                                        <li class="list-group-item">
                                                            <p style="color:#17B26A; margin-bottom: 1px">
                                                                {{ $message_board->board_two_title }}</p>
                                                            <span style="color: #98A2B3; font-size: 12px">
                                                                {{ $message_board->boardtwo->active_description }}</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div> --}}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="container mt-5 border rounded-3">
                    <!-- Rounded Container -->
                    <div class="rounded p-4">
                        <ul class="nav nav-pills" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="false">Location</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="pill" href="#contact"
                                    role="tab" aria-controls="contact" aria-selected="false">Our Story</a>
                            </li>
                        </ul>
                        <hr>
                        <!-- Tab Content -->
                        @php
                            $ourStory = \App\Models\BusinessProfile::find(optional(Auth::user())->business_id);
                            $storyImage = Spatie\MediaLibrary\Models\Media::where([
                                'model_id' => optional(Auth::user())->business_id,
                                'collection_name' => 'BusinessStoryImage',
                            ])->first();
                            // dd($storyImage, $ourStory);
                        @endphp
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <p class="color:#475467;">
                                    @if ($ourStory)
                                        {!! $ourStory->business_overview !!}
                                    @else
                                        No data found
                                    @endif
                                </p>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div id="map"></div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <p id="contactContent" style="color: #000">
                                    @if ($storyImage)
                                        <img src="{{ $storyImage->getUrl() }}" alt="business-img"
                                            style="width: 890px;height:450px;margin-bottom:20px;">
                                    @endif
                                    <br>

                                    @if ($ourStory)
                                        {!! $ourStory->business_story !!}
                                    @else
                                        No data found
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @if ($data['deals']->isNotEmpty())
                <div class="container mt-5">
                    <!-- Header Row with H1 and Controls -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6">
                            <h1 class="h2">Other {{ $business->business_name }} Deals Locations</h1>

                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-info me-2" type="button" data-bs-target="#locationCarousel"
                                data-bs-slide="prev">
                                <!-- SVG for left arrow -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L6.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </button>
                            <button class="btn btn-info" type="button" data-bs-target="#locationCarousel"
                                data-bs-slide="next">
                                <!-- SVG for right arrow -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L9.293 8 4.646 3.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Carousel -->

                    <div id="locationCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Carousel Items -->
                        <div class="carousel-inner">
                            @foreach ($data['deals']->chunk(4) as $index => $deal)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($deal as $d)
                                            <div class="col-12 col-sm-6 col-md-3 mb-4 mb-md-0">
                                                <div class="card h-100" style="border-radius: 1rem">
                                                    @if (empty($d->main_image))
                                                        <img src="{{ env('APP_URL') . '/frontend_assets/images.bkup/dummy.png' }}"
                                                            alt="dummy-img" style="height: 200px;">
                                                    @else
                                                        <img src="{{ env('APP_URL') . $d->main_image }}"
                                                            alt="Business Image" class="card-img-top"
                                                            alt="Provider Image" style="height: 200px;">
                                                    @endif
                                                    <div class="card-body">
                                                        <p class="card-text">
                                                            {{ Str::limit($d->suggested_description, 50) ?? '' }} <br>
                                                            <img src="{{ asset('frontend_assets/images/location-icon44.svg') }}"
                                                                alt="icon"
                                                                style=" width: 23px;height: 23px; background-color: #80808047; padding: 3px;border-radius: 5px;">

                                                            {{ $d->available_location ?? 'address not found' }} <br>
                                                            {{ $d->physical_location ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Indicators (Circles Below the Carousel) -->
                        <!-- Indicators (Circles Below the Carousel) -->
                        <div class="mt-3 d-flex justify-content-center mb-3" style="margin-bottom: 20px !important;">
                            @php
                                $chunks =
                                    isset($data['deals']) && $data['deals']->isNotEmpty()
                                        ? $data['deals']->chunk(4)
                                        : $allLocations->chunk(4);
                            @endphp

                            @foreach ($chunks as $index => $chunk)
                                <button type="button" data-bs-target="#locationCarousel"
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index == 0 ? 'active ' : '' }}btn btn-info rounded-circle p-2 mx-2 circular-button"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                    </div>

                </div>
            @else
                <div class="container mt-5">
                    <!-- Header Row with H1 and Controls -->
                    <div class="row align-items-center mb-4">
                        <div class="col-6">
                            <h1 class="h2">Other Businesses Locations</h1>

                        </div>
                        <div class="col-6 text-end">
                            <button class="btn btn-info me-2" type="button" data-bs-target="#locationCarousel"
                                data-bs-slide="prev">
                                <!-- SVG for left arrow -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.354 1.646a.5.5 0 0 1 0 .708L6.707 7l4.647 4.646a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 0 1 .708 0z" />
                                </svg>
                            </button>
                            <button class="btn btn-info" type="button" data-bs-target="#locationCarousel"
                                data-bs-slide="next">
                                <!-- SVG for right arrow -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l5 5a.5.5 0 0 1 0 .708l-5 5a.5.5 0 0 1-.708-.708L9.293 8 4.646 3.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Carousel -->

                    <div id="locationCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Carousel Items -->
                        <div class="carousel-inner">
                            @foreach ($allLocations->chunk(4) as $chunkIndex => $chunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($chunk as $business)
                                            <div class="col-12 col-sm-6 col-md-3 mb-4 mb-md-0">
                                                <div class="card h-100" style="border-radius: 1rem">
                                                    @if (empty($d->main_image))
                                                        <img src="{{ env('APP_URL') . '/frontend_assets/images.bkup/dummy.png' }}"
                                                            alt="Business Image" class="card-img-top"
                                                            alt="Provider Image" style="height: 200px;">
                                                    @else
                                                        <img src="{{ env('APP_URL') . $d->main_image }}"
                                                            alt="Business Image" class="card-img-top"
                                                            alt="Provider Image" style="height: 200px;">
                                                    @endif
                                                    <div class="card-body">
                                                        <p class="card-text">
                                                            <img src="{{ asset('frontend_assets/images/location-icon44.svg') }}"
                                                                alt="icon"
                                                                style=" width: 23px;height: 23px; background-color: #80808047; padding: 3px;border-radius: 5px;">
                                                            @if (
                                                                !empty($business->location_name) ||
                                                                    !empty($business->city) ||
                                                                    !empty($business->state) ||
                                                                    !empty($business->zip_code))
                                                                {{ $business->location_name ?? '' }}
                                                                {{ $business->city ?? '' }}
                                                                {{ $business->state ?? '' }}
                                                                {{ $business->zip_code ?? '' }}
                                                            @else
                                                                <span>No address found</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Indicators (Circles Below the Carousel) -->
                        <!-- Indicators (Circles Below the Carousel) -->
                        <div class="mt-3 d-flex justify-content-center mb-3" style="margin-bottom: 20px !important;">
                            @php
                                $chunks =
                                    isset($data['deals']) && $data['deals']->isNotEmpty()
                                        ? $data['deals']->chunk(4)
                                        : $allLocations->chunk(4);
                            @endphp

                            @foreach ($chunks as $index => $chunk)
                                <button type="button" data-bs-target="#locationCarousel"
                                    data-bs-slide-to="{{ $index }}"
                                    class="{{ $index == 0 ? 'active ' : '' }}btn btn-info rounded-circle p-2 mx-2 circular-button"
                                    aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                    </div>

                </div>
            @endif

        </div>
    </div>
    </div>
    </div>


    <div class="modal fade" id="imageCarouselModal" tabindex="-1" aria-labelledby="imageCarouselModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content custom-modal-content">
                <div class="modal-header custom-modal-header">
                    <button type="button" class="btn-close custom-close-button" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <!-- Carousel -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <!-- Dynamic Carousel Indicators -->
                        <div class="carousel-indicators">
                            @foreach ($business_photos as $index => $photo)
                                @if ($index < 5)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index == 0 ? 'active' : '' }}"
                                        aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endif
                            @endforeach
                        </div>

                        <!-- Dynamic Carousel Items -->
                        <div class="carousel-inner">
                            @foreach ($business_photos as $index => $photo)
                                @if ($index < 5)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                                        id="slide-{{ $index }}">
                                        <img src="{{ $photo->getUrl() }}" class="d-block w-100"
                                            alt="Image {{ $index + 1 }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- Carousel Navigation -->
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <img src="{{ asset('frontend_assets/images/left-arrow.svg') }}" alt="Previous">
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <img src="{{ asset('frontend_assets/images/right-arrow.svg') }}" alt="Next">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal for loyalty Details -->
    <div class="modal fade" id="offerLoyaltyModal" tabindex="-1" aria-labelledby="offerLoyaltyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="modalTitle"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <label for="modalDescription" class="form-label"><strong>About Program</strong></label>
                    <textarea id="modalDescription" class="form-control" style="height: 200px; overflow-y: auto;" readonly></textarea>
                    <label for="modalTermsConditions" class="form-label mt-3"><strong>Terms and
                            Conditions</strong></label>
                    <textarea id="modalTermsConditions" class="form-control mt-3" style="height: 200px; overflow-y: auto;" readonly></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Offer Details -->
    <div class="modal fade" id="offerDetailsModal" tabindex="-1" aria-labelledby="offerDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <span id="modalTitle"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <!-- Description Section -->
                    <label for="modalDescription" class="form-label"><strong>Offer Description</strong></label>
                    <textarea id="modalDescription" class="form-control" style="height: 200px; overflow-y: auto;" readonly></textarea>

                    <!-- Terms and Conditions Section -->
                    <label for="modalTermsConditions" class="form-label mt-3"><strong>Terms and
                            Conditions</strong></label>
                    <textarea id="modalTermsConditions" class="form-control mt-3" style="height: 200px; overflow-y: auto;" readonly></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Share social Modal via email -->
    <div class="modal fade" id="shareSocialModal" tabindex="-1" aria-labelledby="shareModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content email-sharing-modal">
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
                    <form action="{{ route('share-business.email') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <label for="yourName" class="form-label">Your name*</label>
                                <input type="text" name="yourName" class="form-control" id="yourName"
                                    placeholder="Enter your name" required>
                            </div>

                            <!-- Email Field -->
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Add an event listener when the modal is about to be shown
                document.getElementById("shareSocialModal").addEventListener("show.bs.modal", function() {
                    let pageLink = window.location.href; // Get current page URL

                    let openModals = document.querySelectorAll(".modal.show");
                    openModals.forEach(modal => {
                        let modalInstance = bootstrap.Modal.getInstance(modal);
                        modalInstance.hide();
                    });
                    // Set the default message with subject and link
                    document.getElementById("emailSubject").value = "Check out this Gimmzi Pages";
                    document.getElementById("message").value = pageLink;
                });
            });
        </script>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Would you like to call us?</p>
                    <p id="modal-phone"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="tel:" id="call-link" class="btn btn-primary">Call Now</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // When an offer is clicked, update the modal content
        document.querySelectorAll('.form-check').forEach(function(offerDiv) {
            offerDiv.addEventListener('click', function() {
                // Get the data attributes of the clicked offer
                var title = offerDiv.getAttribute('data-title');
                var description = offerDiv.getAttribute('data-description');
                var termsAndConditions = offerDiv.getAttribute('data-termsAndConditions');

                // Set the values in the modal
                document.getElementById('modalTitle').innerText = title;
                document.getElementById('modalDescription').innerHTML = description;
                document.getElementById('termsAndConditions').innerText = termsAndConditions;
            });
        });

        function copyToClipboard(url) {
            navigator.clipboard.writeText(url).then(function() {
                toastr.success('URL copied to clipboard');
            }).catch(function(err) {
                toastr.error('Could not copy text: ', err);
            });
        }

        // Listen for the modal show event
        document.addEventListener('DOMContentLoaded', function() {
            var offerDetailsModal = document.getElementById('offerDetailsModal');
            offerDetailsModal.addEventListener('show.bs.modal', function(event) {
                // Get the element that triggered the modal
                var triggerElement = event.relatedTarget;

                // If the trigger is the <img>, get the parent <div> that has the data-* attributes
                var dataElement = triggerElement.closest('div');

                // Extract data from the data-* attributes of the parent div
                var title = dataElement.getAttribute('data-title');
                var description = dataElement.getAttribute('data-description');
                var terms = dataElement.getAttribute('data-termsAndConditions');

                // Update the modal content
                var modalTitle = offerDetailsModal.querySelector('#modalTitle');
                var modalDescription = offerDetailsModal.querySelector('#modalDescription');
                var modalTerms = offerDetailsModal.querySelector('#modalTermsConditions');

                modalTitle.textContent = title;
                modalDescription.innerHTML = description; // Use innerHTML for <br> tags
                modalTerms.textContent = terms;
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var offerLoyaltyModal = document.getElementById('offerLoyaltyModal');
            offerLoyaltyModal.addEventListener('show.bs.modal', function(event) {
                // Get the element that triggered the modal
                var triggerElement = event.relatedTarget;

                // If the trigger is the <img>, get the parent <div> that has the data-* attributes
                var dataElement = triggerElement.closest('div');

                // Extract data from the data-* attributes of the parent div
                var title = dataElement.getAttribute('data-title');
                var description = dataElement.getAttribute('data-description');
                var terms = dataElement.getAttribute('data-termsAndConditions');

                // Update the modal content
                var modalTitle = offerLoyaltyModal.querySelector('#modalTitle');
                var modalDescription = offerLoyaltyModal.querySelector('#modalDescription');
                var modalTerms = offerLoyaltyModal.querySelector('#modalTermsConditions');

                modalTitle.textContent = title;
                modalDescription.innerHTML = description; // Use innerHTML for <br> tags
                modalTerms.textContent = terms;
            });
        });

        document.getElementById("addToWalletBtn").addEventListener("click", function() {
            const selectedOffer = document.querySelector('input[name="offer"]:checked');

            if (selectedOffer) {
                let loyaltyId = null;
                let dealId = null;
                let businessId = selectedOffer.closest('.form-check').getAttribute('data-business-id');

                // Check if the selected offer is a loyalty program or a deal
                if (selectedOffer.closest('.form-check').hasAttribute('data-loyalty-id')) {
                    loyaltyId = selectedOffer.closest('.form-check').getAttribute('data-loyalty-id');
                } else if (selectedOffer.closest('.form-check').hasAttribute('data-deal-id')) {
                    dealId = selectedOffer.closest('.form-check').getAttribute('data-deal-id');
                }

                // Send Ajax request with either loyalty_id or deal_id
                fetch('{{ route('wallet.add') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            loyalty_id: loyaltyId,
                            deal_id: dealId,
                            business_id: businessId
                        })
                    })
                    .then(response => response.json()) // Convert the response to JSON
                    .then(data => {
                        if (data.status) { // Check if the response status is true
                            toastr.success(data.message); // Show success message from response
                        } else {
                            toastr.error('Something went wrong: ' + data
                                .message); // Error message from response
                        }
                    })
                    .catch(error => {
                        toastr.error('Something went wrong', error);
                    });
            } else {
                alert("Please select a loyalty program or deal.");
            }
        });


        // Initialize the map when the page loads
        // function initMap() {
        //     // Define the map center (latitude and longitude)
        //     const center = {
        //         lat: 40.730610,
        //         lng: -73.935242
        //     }; // Example: New York City

        //     // Create a new map centered at the specified location
        //     const map = new google.maps.Map(document.getElementById("map"), {
        //         center: center,
        //         zoom: 12,
        //     });

        //     // Add a marker at the center of the map
        //     const marker = new google.maps.Marker({
        //         position: center,
        //         map: map,
        //         title: "Hello, Google Maps!",
        //     });
        // }
        var businessLocations = @json($businessLocations);

        function initMap() {
            // Check if businessLocations is populated
            console.log("businessLocations:", businessLocations);

            // Create a map object and specify the DOM element for display
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 40.730610, // Default center, adjust later based on locations
                    lng: -73.935242
                },
                zoom: 4
            });

            // Array to store all markers
            var markers = [];

            // Dynamically add markers with info windows based on businessLocations array
            var markers = {}; // Object to store markers with location.id as keys

            businessLocations.forEach(function(location) {
                var lat = parseFloat(location.latitude);
                var lng = parseFloat(location.longitude);

                if (!isNaN(lat) && !isNaN(lng)) {
                    markers[location.id] = new google.maps.Marker({
                        position: {
                            lat: lat,
                            lng: lng
                        },
                        map: map,
                        title: location.location_name
                    });


                    console.log(`Added marker for ${location.location_name} with ID ${location.id}`);
                } else {
                    console.error(`Invalid latitude or longitude for ${location.location_name}`);
                }
            });

            // Adjust map to fit all markers
            if (markers.length > 0) {
                var bounds = new google.maps.LatLngBounds();
                markers.forEach(function(marker) {
                    bounds.extend(marker.getPosition());
                });
                map.fitBounds(bounds);
            }
        }

        // Call the initMap function once the script is loaded
        google.maps.event.addDomListener(window, 'load', initMap);

        document.getElementById('phone-number').addEventListener('click', function() {
            var phoneNumber = this.getAttribute('data-phone'); // Get the phone number from the data attribute
            document.getElementById('modal-phone').innerText = 'Phone: ' + phoneNumber; // Display it in the modal
            document.getElementById('call-link').setAttribute('href', 'tel:' + phoneNumber); // Set the call link
            var myModal = new bootstrap.Modal(document.getElementById('contactModal'));
            myModal.show();
        });

        $(document).ready(function() {
            lightbox.option({
                disableScrolling: true
            });

            var location_id = $("#main_location").val();
            $.ajax({
                url: '{{ route('frontend.business_owner.account_setting_merchant_location') }}',
                type: 'GET',
                data: {
                    'location_id': location_id
                },
                success: function(response) {
                    if (response.success == 1) {
                        $('#change_address').html('');
                        $('#change_phone').html('');
                        var address = response.data.address + ',' + response.data.city + ',' + response
                            .data.states.name + ',' + response.data.zip_code;
                        $('#change_address').append(address);
                        var phone = response.data.business_phone;
                        $('#change_phone').html(phone);
                        $("#orderOnlineLink").html('');
                        $("#menu1image").attr('src', '');
                        $("#menu2image").attr('src', '');
                        $("#menu3image").attr('src', '');
                        $("#careerLink").html('');
                        $("#directLink").html('');
                        $(".boardDisplay").html('');
                        $(".loyalty_program").html('');

                        console.log(response.loyalty_reward.length);
                        var url = '{{ asset('frontend_assets/images/sampleimage.jpg') }}';
                        if (response.external != null) {
                            if (response.external.order_online_display != 0) {
                                if (response.external.order_online_url != '') {
                                    $("#orderOnlineLink").append(
                                        '<strong>Click On: </strong><a href="' + response.external
                                        .order_online_url + '" target="_blank">Order Online</a>');
                                } else {
                                    $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                                }
                            } else {
                                $("#orderOnlineLink").append(
                                    '<strong>Order Online Display Off</strong>');
                            }
                            if (response.external.view_menu_display != 0) {
                                //console.log(response.external.menu_image1);
                                $("#menu1image").attr('src', response.external.menu_image1);
                                $("#menu2image").attr('src', response.external.menu_image2);
                                $("#menu3image").attr('src', response.external.menu_image3);
                            } else {
                                $("#menu1image").attr('src', url);
                                $("#menu2image").attr('src', url);
                                $("#menu3image").attr('src', url);
                            }
                            if (response.external.view_flyer_display != 0) {
                                $("#flyer1image").attr('src', response.external.flyer_image1);
                                $("#flyer2image").attr('src', response.external.flyer_image2);
                            } else {
                                $("#flyer1image").attr('src', url);
                                $("#flyer2image").attr('src', url);
                            }
                            if (response.external.carrer_display != 0) {
                                if (response.external.carrer_url != '') {
                                    $("#careerLink").append('<strong>Click On: </strong><a href="' +
                                        response.external.carrer_url +
                                        '" target="_blank">Careers</a>');
                                } else {
                                    $("#careerLink").append('<strong>Comming Soon</strong>');
                                }
                            } else {
                                $("#careerLink").append('<strong>Comming Soon</strong>');
                            }
                            if (response.external.direct_website_display != 0) {
                                if (response.external.direct_website_url != '') {
                                    $("#directLink").append('<strong>Click On: </strong><a href="' +
                                        response.external.direct_website_url +
                                        '" target="_blank">Direct Website</a>');
                                } else {
                                    $("#directLink").append('<strong>Comming Soon</strong>');
                                }
                            } else {
                                $("#directLink").append('<strong>Comming Soon</strong>');
                            }
                        } else {
                            $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                        }
                        if (response.message_board.status != 0) {

                            if (response.message_board.display_board_id != 0) {
                                if (response.message_board.display_board_id != null) {
                                    var display = '<table><tr>' +
                                        '<th>' + response.message_board.boardone.title + '</th>' +
                                        '</tr>';
                                    // $(".boardDisplay").html(display);
                                    //    console.log(response.message_board.display_board_id +'--------');
                                } else {
                                    var display = '';
                                }
                                // if(response.message_board.add_message_date != 0){
                                //     if(response.message_board.start_date != null){
                                //         var startdate1 = new Date(response.message_board.start_date),
                                //             startdate1yr = startdate1.getFullYear(),
                                //             startdate1month = ("0" + (startdate1.getMonth() + 1)).slice(-2),
                                //             startdate1day = startdate1.getDate() < 10 ? '0' + startdate1
                                //             .getDate() : startdate1.getDate(),
                                //             start1Date = startdate1month + '-' + startdate1day + '-' + startdate1yr;
                                //     }
                                //     if(response.message_board.end_date != null){
                                //         var enddate1 = new Date(response.message_board.end_date),
                                //         enddate1yr = enddate1.getFullYear(),
                                //         enddate1month = ("0" + (enddate1.getMonth() + 1)).slice(-2),
                                //         enddate1day = enddate1.getDate() < 10 ? '0' + enddate1
                                //         .getDate() : enddate1.getDate(),
                                //         end1Date = enddate1month + '-' + enddate1day + '-' + enddate1yr;
                                //     }
                                //     else{
                                //         var end1Date = 'Open';
                                //     }
                                //     // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                //     var display2 =  '<tr>'+
                                //                         '<td>'+
                                //                             '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                //                             // '<p>From bbbbbbbbbb</p>'+

                                //                         '</td>'+
                                //                     '</tr>';

                                //     //$(".boardDisplay").append(display2);
                                // }else{
                                //     var display2 = '';
                                // }
                                if (response.message_board.description != null) {
                                    var display3 = '<tr>' +
                                        '<td>' +
                                        '<p>' + response.message_board.description + '</p>' +
                                        '</td>' +
                                        '</tr></table>';
                                } else {
                                    var display3 = '';
                                }
                            } else {
                                var display = '';
                                var display2 = '';
                                var display3 = '';
                            }
                            // console.log(display);
                            // console.log(display2);
                            // console.log(display3+'--3');

                            $(".boardDisplay").append(display + display3);

                            console.log(response.message_board.display_board_id2);
                            if (response.message_board.display_board_id2 != 0) {
                                if (response.message_board.display_board_id2 != null) {
                                    var display4 = '<table><tr>' +
                                        '<th>' + response.message_board.boardtwo.title + '</th>' +
                                        '</tr>';
                                    //$(".boardDisplay").append(display4);

                                }
                                // if(response.message_board.add_message_date2 != 0){
                                //     if(response.message_board.start_date2 != null){
                                //         var startdate2 = new Date(response.message_board.start_date2),
                                //             startdate2yr = startdate2.getFullYear(),
                                //             startdate2month = ("0" + (startdate2.getMonth() + 1)).slice(-2),
                                //             startdate2day = startdate2.getDate() < 10 ? '0' + startdate2
                                //             .getDate() : startdate2.getDate(),
                                //             start2Date = startdate2month + '-' + startdate2day + '-' + startdate2yr;
                                //     }
                                //     if(response.message_board.end_date2 != null){
                                //         var enddate2 = new Date(response.message_board.end_date2),
                                //         enddate2yr = enddate2.getFullYear(),
                                //         enddate2month = ("0" + (enddate2.getMonth() + 1)).slice(-2),
                                //         enddate2day = enddate2.getDate() < 10 ? '0' + enddate2
                                //         .getDate() : enddate2.getDate(),
                                //         end2Date = enddate2month + '-' + enddate2day + '-' + enddate2yr;
                                //     }
                                //     else{
                                //         var end2Date = 'Open';
                                //     }
                                //     // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                //     var display5 =  '<tr>'+
                                //                         '<td>'+
                                //                             '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                //                         '</td>'+
                                //                     '</tr>';
                                //     //$(".boardDisplay").append(display5);


                                // }

                                if (response.message_board.description2 != null) {
                                    var display6 = '<tr>' +
                                        '<td>' +
                                        '<p>' + response.message_board.description2 + '</p>' +
                                        '</td>' +
                                        '</tr></table>';
                                    // $(".boardDisplay").append(display6);
                                }
                            } else {
                                var display4 = '';
                                var display6 = '';
                            }
                            $(".boardDisplay").append(display4 + display6);
                        } else {
                            $(".boardDisplay").html('');
                        }


                        if (response.loyalty_reward.length > 0) {
                            var loyaltyTable = '<tr>' +
                                '<th>' +
                                '<button class="ltr_p_toggler" data-bs-toggle="collapse" href="#ltr_p_body" role="button">Loyalty Reward Program' +
                                '<img src="{{ asset('frontend_assets/images/icon-caret-dw.png') }}" alt="">' +
                                '</button>' +
                                '</th>' +
                                '<th>Expires On</th>' +
                                '<th></th>' +
                                '</tr>';
                            $(".loyalty_program").html(loyaltyTable);

                            for (var i = 0; i < response.loyalty_reward.length; i++) {

                                if (response.loyalty_reward[i].end_date != null) {
                                    var enddate = new Date(response.loyalty_reward[i].end_date),
                                        enddateyr = enddate.getFullYear(),
                                        enddatemonth = ("0" + (enddate.getMonth() + 1)).slice(-2),
                                        enddateday = enddate.getDate() < 10 ? '0' + enddate
                                        .getDate() : enddate.getDate(),
                                        endDate = enddatemonth + '-' + enddateday + '-' + enddateyr;
                                    var today = new Date();
                                    if (response.loyalty_reward[i].end_date > today) {
                                        var join = 'See Progress';
                                    } else {
                                        var join = 'Join Now';
                                    }
                                } else {
                                    // console.log(response.loyalty_reward[i].end_date);
                                    var endDate = 'No End Date';
                                    var join = 'Join Now';
                                }
                                //console.log(endDate);
                                var loyaltytr = '<tr id="ltr_p_body" class="collapse show">' +
                                    '<td>' +
                                    ' <p>' + response.loyalty_reward[i].loyaltyprogram.program_name +
                                    '</p>' +
                                    '</td>' +
                                    '<td>' +
                                    '<h6>' + endDate + '</h6>' +
                                    '</td>' +
                                    '<td><a href="">' + join + '</a></td>' +
                                    '</tr>';
                                $(".loyalty_program").append(loyaltytr);

                            }
                        }

                    }

                }
            });

            $(document).on('change', '#main_location', function() {
                var location_id = $(this).val();
                console.log(location_id);
                $.ajax({
                    url: '{{ route('frontend.business_owner.account_setting_merchant_location') }}',
                    type: 'GET',
                    data: {
                        'location_id': location_id
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            $('#change_address').html('');
                            $('#change_phone').html('');
                            var address = response.data.address + ',' + response.data.city +
                                ',' + response.data.states.name + ',' + response.data.zip_code;
                            $('#change_address').append(address);
                            var phone = response.data.business_phone;
                            $('#change_phone').html(phone);
                            $("#orderOnlineLink").html('');
                            $("#menu1image").attr('src', '');
                            $("#menu2image").attr('src', '');
                            $("#menu3image").attr('src', '');
                            $("#careerLink").html('');
                            $("#directLink").html('');
                            $(".boardDisplay").html('');
                            $(".loyalty_program").html('');
                            console.log(response.message_board);
                            var url = '{{ asset('frontend_assets/images/sampleimage.jpg') }}';
                            if (response.external != null) {
                                if (response.external.order_online_display != 0) {
                                    if (response.external.order_online_url != '') {
                                        $("#orderOnlineLink").append(
                                            '<strong>Click On: </strong><a href="' +
                                            response.external.order_online_url +
                                            '" target="_blank">Order Online</a>');
                                    } else {
                                        $("#orderOnlineLink").append(
                                            '<strong>Comming Soon</strong>');
                                    }
                                } else {
                                    $("#orderOnlineLink").append(
                                        '<strong>Order Online Display Off</strong>');
                                }
                                if (response.external.view_menu_display != 0) {
                                    console.log(response.external.menu_image1);
                                    $("#menu1image").attr('src', response.external.menu_image1);
                                    $("#menu2image").attr('src', response.external.menu_image2);
                                    $("#menu3image").attr('src', response.external.menu_image3);
                                } else {
                                    $("#menu1image").attr('src', url);
                                    $("#menu2image").attr('src', url);
                                    $("#menu3image").attr('src', url);
                                }
                                if (response.external.view_flyer_display != 0) {
                                    $("#flyer1image").attr('src', response.external
                                        .flyer_image1);
                                    $("#flyer2image").attr('src', response.external
                                        .flyer_image2);
                                } else {
                                    $("#flyer1image").attr('src', url);
                                    $("#flyer2image").attr('src', url);
                                }
                                if (response.external.carrer_display != 0) {
                                    if (response.external.carrer_url != '') {
                                        $("#careerLink").append(
                                            '<strong>Click On: </strong><a href="' +
                                            response.external.carrer_url +
                                            '" target="_blank">Careers</a>');
                                    } else {
                                        $("#careerLink").append(
                                            '<strong>Comming Soon</strong>');
                                    }
                                } else {
                                    $("#careerLink").append('<strong>Comming Soon</strong>');
                                }
                                if (response.external.direct_website_display != 0) {
                                    if (response.external.direct_website_url != '') {
                                        $("#directLink").append(
                                            '<strong>Click On: </strong><a href="' +
                                            response.external.direct_website_url +
                                            '" target="_blank">Direct Website</a>');
                                    } else {
                                        $("#directLink").append(
                                            '<strong>Comming Soon</strong>');
                                    }
                                } else {
                                    $("#directLink").append('<strong>Comming Soon</strong>');
                                }
                            } else {
                                $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                            }

                            if (response.message_board.status != 0) {

                                if (response.message_board.display_board_id != null) {
                                    var display = '<table><tr>' +
                                        '<th>' + response.message_board.boardone.title +
                                        '</th>' +
                                        '</tr>';
                                    // console.log(response.message_board.boardone.title);
                                } else {
                                    var display = '';
                                }
                                if (response.message_board.add_message_date != 0) {
                                    if (response.message_board.start_date != null) {
                                        var startdate1 = new Date(response.message_board
                                                .start_date),
                                            startdate1yr = startdate1.getFullYear(),
                                            startdate1month = ("0" + (startdate1.getMonth() +
                                                1)).slice(-2),
                                            startdate1day = startdate1.getDate() < 10 ? '0' +
                                            startdate1
                                            .getDate() : startdate1.getDate(),
                                            start1Date = startdate1month + '-' + startdate1day +
                                            '-' + startdate1yr;
                                    }
                                    if (response.message_board.end_date != null) {
                                        var enddate1 = new Date(response.message_board
                                                .end_date),
                                            enddate1yr = enddate1.getFullYear(),
                                            enddate1month = ("0" + (enddate1.getMonth() + 1))
                                            .slice(-2),
                                            enddate1day = enddate1.getDate() < 10 ? '0' +
                                            enddate1
                                            .getDate() : enddate1.getDate(),
                                            end1Date = enddate1month + '-' + enddate1day + '-' +
                                            enddate1yr;
                                    } else {
                                        var end1Date = 'Open';
                                    }
                                    var display2 = '<tr>' +
                                        '<td>' +
                                        '<p>From ' + start1Date + ' To ' + end1Date + '</p>' +
                                        '</td>' +
                                        '</tr>';
                                } else {
                                    var display2 = '';
                                }
                                if (response.message_board.description != null) {
                                    var display3 = '<tr>' +
                                        '<td>' +
                                        '<p>' + response.message_board.description + '</p>' +
                                        '</td>' +
                                        '</tr></table>';

                                } else {
                                    var display3 = '';
                                }
                                $(".boardDisplay").append(display + display2 + display3);

                                if (response.message_board.display_board_id2 != null) {
                                    var display4 = '<table><tr>' +
                                        '<th>' + response.message_board.boardtwo.title +
                                        '</th>' +
                                        '</tr>';

                                } else {
                                    var display4 = '';
                                }
                                if (response.message_board.add_message_date2 != 0) {
                                    if (response.message_board.start_date2 != null) {
                                        var startdate2 = new Date(response.message_board
                                                .start_date2),
                                            startdate2yr = startdate2.getFullYear(),
                                            startdate2month = ("0" + (startdate2.getMonth() +
                                                1)).slice(-2),
                                            startdate2day = startdate2.getDate() < 10 ? '0' +
                                            startdate2
                                            .getDate() : startdate2.getDate(),
                                            start2Date = startdate2month + '-' + startdate2day +
                                            '-' + startdate2yr;
                                    }
                                    if (response.message_board.end_date2 != null) {
                                        var enddate2 = new Date(response.message_board
                                                .end_date2),
                                            enddate2yr = enddate2.getFullYear(),
                                            enddate2month = ("0" + (enddate2.getMonth() + 1))
                                            .slice(-2),
                                            enddate2day = enddate2.getDate() < 10 ? '0' +
                                            enddate2
                                            .getDate() : enddate2.getDate(),
                                            end2Date = enddate2month + '-' + enddate2day + '-' +
                                            enddate2yr;
                                    } else {
                                        var end2Date = 'Open';
                                    }
                                    // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                    var display5 = '<tr>' +
                                        '<td>' +
                                        '<p>From ' + start1Date + ' To ' + end1Date + '</p>' +
                                        '</td>' +
                                        '</tr>';

                                } else {
                                    var display5 = '';
                                }

                                if (response.message_board.description2 != null) {
                                    var display6 = '<tr>' +
                                        '<td>' +
                                        '<p>' + response.message_board.description2 + '</p>' +
                                        '</td>' +
                                        '</tr></table>';


                                } else {
                                    var display6 = '';
                                }
                                $(".boardDisplay").append(display4 + display5 + display6);
                            } else {
                                $(".boardDisplay").html('');
                            }

                            if (response.loyalty_reward.length > 0) {
                                var loyaltyTable = '<tr>' +
                                    '<th>' +
                                    '<button class="ltr_p_toggler" data-bs-toggle="collapse" href="#ltr_p_body" role="button">Loyalty Reward Program' +
                                    '<img src="{{ asset('frontend_assets/images/icon-caret-dw.png') }}" alt="">' +
                                    '</button>' +
                                    '</th>' +
                                    '<th>Expires On</th>' +
                                    '<th></th>' +
                                    '</tr>';
                                $(".loyalty_program").html(loyaltyTable);
                                for (var i = 0; i < response.loyalty_reward.length; i++) {
                                    if (response.loyalty_reward[i].end_date != null) {
                                        var enddate = new Date(response.loyalty_reward[i]
                                                .end_date),
                                            enddateyr = enddate.getFullYear(),
                                            enddatemonth = ("0" + (enddate.getMonth() + 1))
                                            .slice(-2),
                                            enddateday = enddate.getDate() < 10 ? '0' + enddate
                                            .getDate() : enddate.getDate(),
                                            endDate = enddatemonth + '-' + enddateday + '-' +
                                            enddateyr;
                                        var today = new Date();
                                        if (response.loyalty_reward[i].end_date > today) {
                                            var join = 'See Progress';
                                        } else {
                                            var join = 'Join Now';
                                        }
                                    } else {
                                        var date = 'No End Date';
                                        var join = 'Join Now';
                                    }
                                    var loyaltytr =
                                        '<tr id="ltr_p_body" class="collapse show">' +
                                        '<td>' +
                                        ' <p>' + response.loyalty_reward[i].loyaltyprogram
                                        .program_name + '</p>' +
                                        '</td>' +
                                        '<td>'
                                    '<h6>' + endDate + '</h6>' +
                                        '</td>' +
                                        '<td><a href="">' + join + '</a></td>' +
                                        '</tr>';
                                    $(".loyalty_program").append(loyaltytr);
                                }
                            }

                        }

                    }
                });
            });
        });
    </script>
    <script>
        function setActiveSlide(slideIndex) {
            // Remove active class from all slides and indicators
            document.querySelectorAll('.carousel-item').forEach(item => {
                item.classList.remove('active');
            });

            document.querySelectorAll('.carousel-indicators button').forEach(button => {
                button.classList.remove('active');
                button.removeAttribute('aria-current');
            });

            // Add active class to the selected slide and indicator
            const slide = document.getElementById(`slide-${slideIndex}`);
            if (slide) {
                slide.classList.add('active');
            }

            const indicator = document.querySelector(`.carousel-indicators button[data-bs-slide-to="${slideIndex}"]`);
            if (indicator) {
                indicator.classList.add('active');
                indicator.setAttribute('aria-current', 'true');
            }

            // Initialize the carousel if not already initialized
            const carousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'));
            carousel.to(slideIndex);
        }
    </script>
    </x-layouts.frontend-layout>
