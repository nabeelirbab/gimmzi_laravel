<style>
    .search-result-item {
        display: flex;
        padding: 12px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .search-result-item:hover {
        background-color: #f9f9f9;
    }

    .business-image {
        width: 60px;
        height: 60px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .business-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    .business-info {
        flex: 1;
    }

    .business-name {
        margin: 0 0 5px 0;
        font-size: 16px;
        color: #333;

    }

    .business-info .business-name {
        color: #666;
        background: none;
    }

    .business-location {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .business-distance {
        font-size: 13px;
        color: #888;
    }

    /* Update your modal CSS */
    #searchResultsModal {
        position: absolute;
        top: 100%;
        /* Position directly below search input */
        left: 0;
        right: 0;
        width: auto;
        /* Or set specific width */
        max-width: 100%;
        /* Prevent exceeding header width */
        margin: 0 auto;
        background: white;
        border: 1px solid #ddd;
        border-top: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    /* Ensure parent has relative positioning */
    #searchForm {
        position: relative;
        width: 100%;
        /* Match header width */
        max-width:
            /* your header's max width */
        ;
    }

    /* Add to your CSS file */
    .modal-backdrop {
        display: none !important;
    }
</style>
<header class="new-main-head inner-headers">
    <div class="top-hdr">
        <div class="top-hdr-wraps">
            <div class="container">
                <div class="top-heading">Small Businesses, Big Rewards!</div>

            </div>
        </div>
    </div>
    <div class="top-btm">
        <div class="container">

            <nav class="navbar navbar-expand-lg">

                <a class="navbar-brand" href="/explore" target="_blank">
                    <img loading="lazy" src="{{ asset('frontend_assets/images/newlogo.png') }}" alt="logo">
                </a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                        <span class="stick"></span>
                    </button>
                    <ul class="navbar-nav m-auto">
                        <li class="menu-item-has-children">
                            <a href="{{ route('frontend.market-universe') }}">Gimmzi Universe</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Loyalty Rewards</a>
                            <div class="hdr-submenu sub-menu">
                                <div class="hdr-sub-head">Gimmzi Market Universe</div>
                                <ul class="submenu-list">

                                    <li><a target="_blank"
                                            href="{{ route('frontend.market-universe', ['category' => 'all', 'type' => 'loyaltyRewards']) }}">All
                                            Categories</a></li>
                                    @foreach (App\Models\BusinessCategory::where('status', 1)->get() as $category)
                                        <li><a target="_blank"
                                                href="{{ route('frontend.market-universe', ['category' => base64_encode($category->id), 'type' => 'loyaltyRewards']) }}">{{ $category->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Gimmzi Deals</a>
                            <div class="hdr-submenu sub-menu">
                                <div class="hdr-sub-head">Gimmzi Market Universe</div>
                                <ul class="submenu-list">
                                    <li><a target="_blank"
                                            href="{{ route('frontend.market-universe', ['category' => 'all', 'type' => 'gimmziDeals']) }}">All
                                            Categories</a></li>
                                    @foreach (App\Models\BusinessCategory::where('status', 1)->get() as $category)
                                        <li><a target="_blank"
                                                href="{{ route('frontend.market-universe', ['category' => base64_encode($category->id), 'type' => 'gimmziDeals']) }}">{{ $category->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Earn More Points</a>
                            <div class="hdr-submenu2 sub-menu">
                                <div class="row rowspan">
                                    <div class="col-lg-6 hdr-submenu2-lft">
                                        <div class="hdr-submenu-blk-lft">
                                            <div class="hdr-sub-head">Book a stay with a Travel & Tourism
                                                Partner</div>
                                            <ul class="submenu-list2">
                                                <li>
                                                    {{-- <a target="_blank" href="{{ route('frontend.travel-tourism.list') }}">Browse All
                                                        Travel & Tourism Listings</a> --}}
                                                    <a style="mouse-pointer:none">Browse All Travel & Tourism Listings
                                                        <span style="color:rgb(238, 77, 77)">(Coming soon)</span> </a>

                                                </li>
                                                <li><a>Browse Vacation Homes<span style="color:rgb(238, 77, 77)">(Coming
                                                            soon)</span> </a></li>
                                                <li>
                                                    {{-- <a target="_blank" href="{{ route('frontend.travel-tourism.list') }}">Browse Hotels
                                                        and Resorts</a> --}}
                                                    <a>Browse Hotels and Resorts <span
                                                            style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 hdr-submenu2-rit">
                                        <div class="hdr-submenu-blk-lft">
                                            <div class="hdr-sub-head">Join a Community Partner</div>
                                            <ul class="submenu-list2">
                                                <li>
                                                    <a>Browse All Community Listings <span
                                                            style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                                <li>
                                                    {{-- <a target="_blank" href="{{ route('frontend.apartment.list') }}">Browse Apartment
                                                        Communities <span style="color:rgb(238, 77, 77)">(Coming soon)</span></a> --}}
                                                    <a>Browse Apartment
                                                        Communities <span style="color:rgb(238, 77, 77)">(Coming
                                                            soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Browse Student Housing Communities <span
                                                            style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Check to see if my Apartment Community
                                                        is
                                                        in the Gimmzi Network <span
                                                            style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Check to see if my COA or HOA is in the
                                                        Gimmzi Network <span style="color:rgb(238, 77, 77)">(Coming
                                                            soon)</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0)">Become a Partner</a>
                            <div class="hdr-submenu2 sub-menu">
                                {{-- <div class="row rowspan"> --}}
                                <div class="col-lg-12">
                                    <div class="hdr-submenu-blk-lft">
                                        <div class="hdr-sub-head">Small Business Partner</div>
                                        <ul class="submenu-list2">
                                            <li><a href="javascript:void(0)">Pricing</a></li>
                                            <li><a href="javascript:void(0)">Schedule a Demo</a></li>
                                        </ul>
                                        <div class="log-blk">
                                            <p>Existing Small Business Partner? <a class="login-button"
                                                    data-bs-toggle="modal" data-bs-target="#loginModal"
                                                    href="javascript:void(0)">Log in</a></p>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-4">
                                        <div class="hdr-submenu-blk-lft">
                                            <div class="hdr-sub-head">Travel & Tourism Partner</div>
                                            <ul class="submenu-list2">
                                                <li>
                                                    <a href="javascript:void(0)">Pricing</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Schedule a Demo</a>
                                                </li>
                                            </ul>
                                            <div class="log-blk">
                                                <p>Existing Travel & Tourism Partner? <a class="login-button"
                                                        data-bs-toggle="modal" data-bs-target="#loginModal"
                                                        href="javascript:void(0)">Log
                                                        in</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="hdr-submenu-blk-lft">
                                            <div class="hdr-sub-head">Community Partner</div>
                                            <ul class="submenu-list2">
                                                <li>
                                                    <a href="javascript:void(0)">Pricing</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">Schedule a Demo</a>
                                                </li>
                                            </ul>
                                            <div class="log-blk">
                                                <p>Existing Community Partner? <a class="login-button"
                                                        data-bs-toggle="modal" data-bs-target="#loginModal"
                                                        href="javascript:void(0)">Log in</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- </div> --}}
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="hdr-rit">
                    <div class="hdr-frm">
                        <div class="hdr-frm-innr">
                            <form id="searchForm">
                                <div class="hdr-frm-innr">
                                    <input type="text" name="search" placeholder="Find on Gimmzi" required>
                                    {{-- <input type="submit" value="" class="search-submit"> --}}
                                </div>
                                <a href="javascript:void(0)" class="search-btn">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/srch.svg') }}"
                                        alt="search icon" class="search-icon">
                                </a>
                            </form>
                            <div id="searchResultsModal" class="search-modal" style="display: none;">
                                <div class="search-modal-content mt-2">

                                    <div class="search-modal-body" id="resultContainer">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="javascript:void(0)" class="search-btn">
                            <img loading="lazy" src="{{ asset('frontend_assets/images/srch.svg') }}" alt="search icon"
                                class="search-icon">
                        </a> --}}
                    </div>
                    <ul class="hdr-ul">
                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard') }}" class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/user.svg') }}"
                                        alt="user icon">
                                </a>
                            @else
                                <a href="{{ route('frontend.consumer-dashboard') }}" class="hdr-ul-anchor"
                                    data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/user.svg') }}"
                                        alt="user icon">
                                </a>
                            @endif
                        </li>
                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard') }}" class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/favourite.svg') }}"
                                        alt="favourite icon">
                                </a>
                            @else
                                <a href="javascript:void(0);" class="hdr-ul-anchor login-required"
                                    data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/favourite.svg') }}"
                                        alt="favourite icon">
                                </a>
                            @endif
                        </li>

                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard') }}" class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/wallet.svg') }}"
                                        alt="wallet icon">
                                </a>
                            @else
                                <a href="{{ route('frontend.consumer-dashboard') }}" class="hdr-ul-anchor"
                                    data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/wallet.svg') }}"
                                        alt="wallet icon">
                                </a>
                            @endif
                        </li>
                    </ul>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('.add-to-wallet').click(function() {
                                let businessId = $(this).data('business-id');
                                let type = $(this).data('type');
                                let dealId = $(this).data('deal-id');

                                $.ajax({
                                    url: "{{ route('wallet.add') }}", // Laravel route
                                    type: "POST",
                                    data: {
                                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                                        business_id: businessId,
                                        type: type,
                                        deal_id: dealId
                                    },
                                    success: function(response) {
                                        if (response.status) { // Check if the response status is true
                                            toastr.success(response
                                                .message); // Show success message from response
                                        } else {
                                            toastr.warning(response.message); // Show warning message if needed
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

            </nav>

        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    </div>
    <div class="search-wpr">
        <div class="search-wpr-in">
            <form>
                <input type="text" placeholder="Find on Gimmzi">
                <input type="submit" value="">
            </form>
            <a href="javascript:void(0)" class="search-btn-cls">
                <img loading="lazy" src="{{ asset('frontend_assets/images/close.svg') }}" alt=""
                    class="search-close-icon">
            </a>
        </div>
    </div>

    <div class="modal prrprty_tab_mdl fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog homemodal">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}" class="cancell-one11">
                    </button>
                    <div class="text-center mt-4 mb-4 popup-logo">
                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="property-manager property-manager-con">
                        <nav>
                            <div class="nav nav-tabs property-manager-tab" id="nav-tab" role="tablist">
                                <a class="nav-link active user_type" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" role="tab" aria-controls="nav-home"
                                    aria-selected="true">
                                    <span class="tab_ttle">Provider Portal</span>
                                    <ul class="provider_type_lstng" style="display:none;">
                                        <li class="portalName" style="cursor: default">Apartment portal</li>
                                        <li class="portalName" style="cursor: default">Travel & Tourism Portal</li>
                                    </ul>
                                    <span class="caret_dwn"></span>
                                </a>
                                <a class="nav-link user_type" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" role="tab" aria-controls="nav-profile"
                                    aria-selected="false">
                                    <span class="tab_ttle">My Smart Rewards</span>
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                {{ Form::open([
                                    'route' => 'frontend.property-manager-login',
                                    'method' => 'POST',
                                    'class' => 'kt-form parsley-validate',
                                    'style' => 'color:red;',
                                    'id' => 'loginFormid',
                                ]) }}
                                <input type="hidden" name="user_type" value="" id="provider_user_type">
                                <div class="email-text-one">
                                    <input type="email" placeholder="Email or Username" name="email" required />
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="email-text-one">
                                    <input type="password" placeholder="Password" name="password" required />
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                @if ($errors->has('user_type'))
                                    <div class="error">{{ $errors->first('user_type') }}</div>
                                @endif
                                <div class="login-top-one1">
                                    <button class="login-button-one" type="submit">LOGIN</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                {{ Form::open([
                                    'route' => 'frontend.consumer-login',
                                    'method' => 'POST',
                                    'class' => 'kt-form parsley-validate',
                                    'style' => 'color:red;',
                                ]) }}
                                <input type="hidden" name="user_type" value="My Smart Reward" id="user_type">
                                <div class="email-text-one">
                                    <input type="email" placeholder="Email or Username" name="email" required />
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="email-text-one">
                                    <input type="password" placeholder="Password" name="password" required />
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <a href="#" style="padding-left: 310px;" id="consumerforgetpassword">Forgot
                                    Password?</a>
                                <div class="login-top-one1">
                                    <button class="login-button-one" type="submit">LOGIN</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('.login-required').click(function(e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(document.getElementById('loginModal'));
                modal.show();
            });

            let searchTimer;
            const searchDelay = 500; // milliseconds delay after typing stops

            // Key-up event handler for live search
            $('input[name="search"]').on('keyup', function(e) {
                clearTimeout(searchTimer);

                const searchQuery = $(this).val().trim();

                // Only search if query has at least 3 characters
                if (searchQuery.length < 3) {
                    $('#searchResultsModal').hide();
                    return;
                }

                // If Enter key is pressed, submit immediately
                if (e.key === 'Enter') {
                    performSearch(searchQuery);
                    return;
                }

                // Set timer for delayed search
                searchTimer = setTimeout(() => {
                    performSearch(searchQuery);
                }, searchDelay);
            });

            // Search button click handler
            $('.search-btn').click(function(e) {
                e.preventDefault();
                const searchQuery = $('input[name="search"]').val().trim();
                performSearch(searchQuery);
            });

            // Form submission handler
            $('#searchForm').submit(function(e) {
                e.preventDefault();
                $('.search-btn').click();
            });

            // Function to perform the search
            function performSearch(query) {
                if (!query) {
                    $('#searchResultsModal').hide();
                    return;
                }

                $.ajax({
                    url: "{{ route('frontend.search-business-profile') }}",
                    type: 'GET',
                    data: {
                        name: query
                    },
                    beforeSend: function() {
                        // Show loading indicator
                        $('#resultContainer').html('<div class="search-loading">Searching...</div>');
                        $('#searchResultsModal').show();
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            let html = '';

                            response.data.forEach(business => {
                                html += `
                                <a href="/merchant/${business.id}" class="search-result-item">
                                    <div class="search-result-item">
                                        <div class="business-image">
                                            <img src="${business.logo_image || business.main_image_url || 'default-image.jpg'}" 
                                                alt="${business.business_name}">
                                        </div>
                                        <div class="business-info">
                                            <h4 class="business-name">${business.business_name}</h4>
                                            ${business.main_location ? `
                                                                                                                                                                                        <div class="business-location">
                                                                                                                                                                                            <span class="location-address">${business.main_location.address}</span>,
                                                                                                                                                                                            <span class="location-city">${business.main_location.city}</span>
                                                                                                                                                                                        </div>
                                                                                                                                                                                        ` : ''}
                                            ${business.distance ? `
                                                                                                                                                                                        <div class="business-distance">
                                                                                                                                                                                            ${Math.round(business.distance)} meters away
                                                                                                                                                                                        </div>
                                                                                                                                                                                        ` : ''}
                                        </div>
                                    </div>
                                </a>
                                `;
                            });

                            $('#resultContainer').html(html);
                            $('#searchResultsModal').show();
                        } else {
                            $('#resultContainer').html(
                                '<div class="no-results">No businesses found</div>');
                            $('#searchResultsModal').show();
                        }
                    },
                    error: function(xhr) {
                        $('#resultContainer').html(
                            '<div class="search-error">Error loading results</div>');
                        console.error('Search error:', xhr.responseText);
                    }
                });
            }

            // Close modal handlers (keep your existing ones)
            $('.close-search-modal').click(function() {
                $('#searchResultsModal').hide();
            });

            $(window).click(function(e) {
                if ($(e.target).is('#searchResultsModal')) {
                    $('#searchResultsModal').hide();
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginTriggers = document.querySelectorAll('.trigger-login-modal');

            loginTriggers.forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Bootstrap 5 modal trigger
                    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                    loginModal.show();
                });
            });
        });
    </script>

</header>
