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
                            <form>
                                <input type="text" placeholder="Find on Gimmzi">
                                <input type="submit" value="">
                            </form>
                        </div>
                        <a href="javascript:void(0)" class="search-btn">
                            <img loading="lazy" src="{{ asset('frontend_assets/images/srch.svg') }}" alt="search icon"
                                class="search-icon">
                        </a>
                    </div>
                    <ul class="hdr-ul">
                        <li class="hdr-li">
                            <a href="javascript:void(0)" class="hdr-ul-anchor">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/user.svg') }}"
                                    alt="user icon">
                            </a>
                        </li>
                        <li class="hdr-li">
                            <a href="javascript:void(0)" class="hdr-ul-anchor">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/favourite.svg') }}"
                                    alt="favourite icon">
                            </a>
                        </li>
                        <li class="hdr-li">
                            <a href="javascript:void(0)" class="hdr-ul-anchor">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/wallet.svg') }}"
                                    alt="wallet icon">
                            </a>
                        </li>

                    </ul>
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
</header>
