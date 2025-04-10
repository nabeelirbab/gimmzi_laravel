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
        left: 0;
        right: 0;
        width: auto;
        max-width: 100%;
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
    }

    /* Add to your CSS file */
    .modal-backdrop {
        display: none !important;
    }

    /* Loading and error states */
    .search-loading,
    .no-results,
    .search-error {
        padding: 15px;
        text-align: center;
        color: #666;
    }

    .travel_auth_popup .cmn_close_popup_btn {
        /* background-color: #182230 !important; */
        /* color: #fff; */
    }

    .close-btn-img img {
        max-width: 100%;
    }

    .travel_auth_popup .cmn_close_popup_btn {
        background-color: #182230 !important;
        /* color: #fff; */
    }

    .close-btn-img {
        width: 17px;
        filter: brightness(0) invert(1);
        line-height: 0;
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: .3rem;
        outline: 0;
    }

    .cmn_close_popup_btn {
        position: absolute;
        top: 16px;
        right: 16px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        width: 48px;
        height: 48px;
        right: 16px;
        top: 16px;
        background: #F2F4F7 !important;
        border-radius: 70px;
        border: 0px;
        z-index: 1;
    }

    .travel_auth_popup .modal_main_logo {
        margin: 0 auto;
    }

    .login_popup_body .form_grp_submit button {
        height: 60px;
        font-size: 32px;
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
                    <span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
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
                                                    <a style="mouse-pointer:none">Browse All Travel & Tourism Listings
                                                        <span style="color:rgb(238, 77, 77)">(Coming soon)</span> </a>
                                                </li>
                                                <li><a>Browse Vacation Homes<span style="color:rgb(238, 77, 77)">(Coming
                                                            soon)</span> </a></li>
                                                <li>
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
                                                    <a>Browse Apartment Communities <span
                                                            style="color:rgb(238, 77, 77)">(Coming
                                                            soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Browse Student Housing Communities <span
                                                            style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Check to see if my Apartment Community is in the Gimmzi Network
                                                        <span style="color:rgb(238, 77, 77)">(Coming soon)</span></a>
                                                </li>
                                                <li>
                                                    <a>Check to see if my COA or HOA is in the Gimmzi Network <span
                                                            style="color:rgb(238, 77, 77)">(Coming
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
                                <div class="col-lg-12">
                                    <div class="hdr-submenu-blk-lft">
                                        <div class="hdr-sub-head">Small Business Partner</div>
                                        <ul class="submenu-list2">
                                            <li><a href="javascript:void(0)">Pricing</a></li>
                                            <li><a href="javascript:void(0)">Schedule a Demo</a></li>
                                        </ul>
                                        <div class="log-blk">
                                            <p>Existing Small Business Partner? <a class="login-button"
                                                    data-bs-toggle="modal" data-bs-target="#businessLoginModal"
                                                    href="javascript:void(0)">Log in</a></p>
                                        </div>
                                    </div>
                                </div>
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
                                </div>
                                <a href="javascript:void(0)" class="search-btn">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/srch.svg') }}"
                                        alt="search icon" class="search-icon">
                                </a>
                            </form>
                            <div id="searchResultsModal" class="search-modal" style="display: none;">
                                <div class="search-modal-content mt-2">
                                    <div class="search-modal-body" id="resultContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="hdr-ul">
                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard', ['active_tab' => 'user']) }}"
                                    class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/user.svg') }}"
                                        alt="user icon">
                                </a>
                            @else
                                <a href="{{ route('frontend.consumer-dashboard', ['active_tab' => 'user']) }}"
                                    class="hdr-ul-anchor" data-bs-toggle="modal"
                                    data-bs-target="#consumerLoginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/user.svg') }}"
                                        alt="user icon">
                                </a>
                            @endif
                        </li>
                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard', ['active_tab' => 'favourite']) }}"
                                    class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/favourite.svg') }}"
                                        alt="favourite icon">
                                </a>
                            @else
                                <a href="javascript:void(0);" class="hdr-ul-anchor login-required"
                                    data-bs-toggle="modal" data-bs-target="#consumerLoginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/favourite.svg') }}"
                                        alt="favourite icon">
                                </a>
                            @endif
                        </li>

                        <li class="hdr-li">
                            @if (Auth::check())
                                <a href="{{ route('frontend.consumer-dashboard', ['active_tab' => 'wallet']) }}"
                                    class="hdr-ul-anchor">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/wallet.svg') }}"
                                        alt="wallet icon">
                                </a>
                            @else
                                <a href="{{ route('frontend.consumer-dashboard', ['active_tab' => 'wallet']) }}"
                                    class="hdr-ul-anchor" data-bs-toggle="modal"
                                    data-bs-target="#consumerLoginModal">
                                    <img loading="lazy" src="{{ asset('frontend_assets/images/wallet.svg') }}"
                                        alt="wallet icon">
                                </a>
                            @endif
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

    {{-- Business Owner Login Modal --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="businessLoginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logo-marchant.png') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt="close-btn"></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        {{ Form::open(['route' => 'frontend.merchant.login', 'method' => 'POST', 'class' => 'kt-form parsley-validate']) }}
                        <div class="">
                            <div class="title_h1">Log in</div>
                            <div class="form_grp">
                                <label style="color:black;">Your email address <span class="reqrd">*</span></label>
                                <input type="text" class="form_input" placeholder="Enter your Email"
                                    name="email" id="email-input">
                            </div>
                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Next</button>
                            </div>
                            <div class="form_grp form_grp_dcl_text">
                                By creating an account, you agree to our <a href="#">Privacy policy</a> and <a
                                    href="#">Terms of use</a>.
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Business Owner Password Modal --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="businessPasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logo-marchant.png') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt=""></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        {{ Form::open(['route' => 'frontend.merchant.login_password', 'method' => 'POST', 'class' => 'kt-form parsley-validate']) }}
                        <div class="">
                            <a href="#" class="back_btn prev-step"> <span id="m_email">
                                    @if (!empty(Session::get('email_address')))
                                        {{ Session::get('email_address') }}
                                    @endif
                                </span></a>
                            <div class="title_h1">Enter your password</div>
                            <div class="form_grp">
                                <label style="color:black;">Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{ asset('frontend_assets/images/eye-show.png') }}" alt=""
                                            class="pass-icon-eye">
                                        <img src="{{ asset('frontend_assets/images/eye-hidden.png') }}"
                                            alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input" placeholder="Password"
                                        name="password">
                                </div>
                            </div>
                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Log in</button>
                            </div>
                            <div class="form_grp form_grp_dcl_text form_frgt_pass_link" id="businessForgetPassword">
                                <a href="javascript:void(0)">Forgot your password?</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Consumer Login Modal --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="consumerLoginModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt=""></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        {{ Form::open(['route' => 'frontend.consumer-login', 'method' => 'POST', 'class' => 'kt-form parsley-validate']) }}
                        <div class="">
                            <div class="title_h1">Log in</div>
                            <div class="form_grp">
                                <label style="color:black;">Your email address <span class="reqrd">*</span></label>
                                <input type="text" class="form_input" placeholder="Enter your Email"
                                    name="email" id="consumer-email">
                            </div>
                            <div class="form_grp">
                                <label style="color:black;">Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{ asset('frontend_assets/images/eye-show.png') }}" alt=""
                                            class="pass-icon-eye">
                                        <img src="{{ asset('frontend_assets/images/eye-hidden.png') }}"
                                            alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input" placeholder="Password"
                                        name="password">
                                </div>
                            </div>
                            <div class="form_grp form_grp_dcl_text form_frgt_pass_link" id="consumerForgetPassword">
                                <a href="javascript:void(0)">Forgot your password?</a>
                            </div>
                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Log in</button>
                            </div>
                            <div class="form_grp form_grp_dcl_text">
                                By creating an account, you agree to our <a href="#">Privacy policy</a> and <a
                                    href="#">Terms of use</a>.
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Forgot Password Modal --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="forgetPasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt=""></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        <div>
                            <form id="forgetPasswordForm" name="forgetPasswordForm">
                                @csrf
                                <input type="hidden" name="user_type" id="forgetPasswordUserType" value="">
                                <div class="title_h1">Forgot your password?</div>
                                <div class="imp_text">Enter your email address and we'll send you a link to reset your
                                    password.</div>
                                <div class="form_grp">
                                    <label>Your email address</label>
                                    <input type="text" class="form_input" placeholder="Enter your Email"
                                        name="email" id="forgetPasswordEmail" required>
                                </div>
                                <div class="form_grp form_grp_submit pw-submit-btn">
                                    <button type="submit" class="cmn_theme_btn" id="sendResetLink">Send reset
                                        link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Error Modals --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="loginErrorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt=""></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        <div>
                            <div class="step_msg"><strong id="errorMessage">Unable to log in. Please try
                                    again.</strong></div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button class="cmn_theme_btn" id="retryLogin">Try again</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Reset Password Modal --}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="resetPasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-head">
                    <div class="modal_main_logo"><a href="#"><img
                                src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" alt=""></a>
                    </div>
                    <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="close-btn-img"><img src="{{ asset('frontend_assets/images/close.png') }}"
                                alt=""></i></button>
                </div>
                <div class="modal-body">
                    <div class="login_popup_body">
                        <form id="resetPasswordForm" name="resetPasswordForm" method="post">
                            @csrf
                            <input type="hidden" name="token" id="resetPasswordToken">
                            <div class="title_h1">Reset Your Password</div>
                            <div class="form_grp">
                                <label>New Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{ asset('frontend_assets/images/eye-show.png') }}" alt=""
                                            class="pass-icon-eye">
                                        <img src="{{ asset('frontend_assets/images/eye-hidden.png') }}"
                                            alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input"
                                        placeholder="New Password" name="new_password" id="newPassword" required>
                                </div>
                            </div>
                            <div class="form_grp">
                                <label>Confirm Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{ asset('frontend_assets/images/eye-show.png') }}" alt=""
                                            class="pass-icon-eye">
                                        <img src="{{ asset('frontend_assets/images/eye-hidden.png') }}"
                                            alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input"
                                        placeholder="Confirm Password" name="confirm_password" id="confirmPassword"
                                        required>
                                </div>
                            </div>
                            <div id="resetPasswordMessage" class="form_grp" style="color: red; display: none;"></div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button type="submit" class="cmn_theme_btn">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize all modals
            const businessLoginModal = new bootstrap.Modal(document.getElementById('businessLoginModal'));
            const businessPasswordModal = new bootstrap.Modal(document.getElementById('businessPasswordModal'));
            const consumerLoginModal = new bootstrap.Modal(document.getElementById('consumerLoginModal'));
            const forgetPasswordModal = new bootstrap.Modal(document.getElementById('forgetPasswordModal'));
            const loginErrorModal = new bootstrap.Modal(document.getElementById('loginErrorModal'));
            const resetPasswordModal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));

            // Handle forget password links
            $(document).on('click', '#businessForgetPassword, #consumerForgetPassword', function(e) {
                e.preventDefault();
                const userType = $(this).is('#businessForgetPassword') ? 'business' : 'consumer';

                // Close current modal
                if (userType === 'business') {
                    businessPasswordModal.hide();
                } else {
                    consumerLoginModal.hide();
                }

                // Set user type and show forget password modal
                $('#forgetPasswordUserType').val(userType);
                forgetPasswordModal.show();
            });

            // Handle forget password form submission
            $("#forgetPasswordForm").submit(function(e) {
                e.preventDefault();
                const email = $("#forgetPasswordEmail").val();
                const userType = $("#forgetPasswordUserType").val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: userType === 'business' ?
                        "{{ route('frontend.business_owner.merchant-forget-password') }}" :
                        "{{ route('frontend.consumer-forget-password') }}",
                    type: 'POST',
                    data: {
                        'email': email
                    },
                    beforeSend: function() {
                        $('#sendResetLink').prop('disabled', true).text('Sending...');
                    },
                    success: function(response) {
                        if (response.status == 2) {
                            $('#forgetPasswordForm')[0].reset();
                            forgetPasswordModal.hide();
                            toastr.success('Reset link sent to your email address');
                        } else {
                            $('#errorMessage').text(response.message || 'An error occurred');
                            loginErrorModal.show();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong! Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#errorMessage').text(errorMessage);
                        loginErrorModal.show();
                    },
                    complete: function() {
                        $('#sendResetLink').prop('disabled', false).text('Send reset link');
                    }
                });
            });

            // Handle reset password form submission
            $("#resetPasswordForm").submit(function(e) {
                e.preventDefault();
                const newPassword = $("#newPassword").val();
                const confirmPassword = $("#confirmPassword").val();
                const token = $("#resetPasswordToken").val();

                if (newPassword !== confirmPassword) {
                    $('#resetPasswordMessage').text('Passwords do not match').show();
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "",
                    type: 'POST',
                    data: {
                        'token': token,
                        'new_password': newPassword,
                        'confirm_password': confirmPassword
                    },
                    beforeSend: function() {
                        $('#resetPasswordForm button[type="submit"]').prop('disabled', true)
                            .text('Processing...');
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#resetPasswordForm')[0].reset();
                            resetPasswordModal.hide();
                            toastr.success(response.message);

                            // Show appropriate login modal based on user type
                            if (response.user_type === 'business') {
                                businessLoginModal.show();
                            } else {
                                consumerLoginModal.show();
                            }
                        } else {
                            $('#resetPasswordMessage').text(response.message).show();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Something went wrong! Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#resetPasswordMessage').text(errorMessage).show();
                    },
                    complete: function() {
                        $('#resetPasswordForm button[type="submit"]').prop('disabled', false)
                            .text('Reset Password');
                    }
                });
            });

            // Handle retry login button
            $('#retryLogin').click(function() {
                loginErrorModal.hide();
                consumerLoginModal.show();
            });

            // Search functionality
            let searchTimer;
            const searchDelay = 500;

            $('input[name="search"]').on('keyup', function(e) {
                clearTimeout(searchTimer);
                const searchQuery = $(this).val().trim();

                if (searchQuery.length < 3) {
                    $('#searchResultsModal').hide();
                    return;
                }

                if (e.key === 'Enter') {
                    performSearch(searchQuery);
                    return;
                }

                searchTimer = setTimeout(() => {
                    performSearch(searchQuery);
                }, searchDelay);
            });

            $('.search-btn').click(function(e) {
                e.preventDefault();
                const searchQuery = $('input[name="search"]').val().trim();
                performSearch(searchQuery);
            });

            $('#searchForm').submit(function(e) {
                e.preventDefault();
                $('.search-btn').click();
            });

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
                        $('#resultContainer').html('<div class="search-loading">Searching...</div>');
                        $('#searchResultsModal').show();
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            let html = '';
                            response.data.forEach(business => {
                                html += `
                                <a href="/merchant/${business.id}" class="search-result-item">
                                    <div class="business-image">
                                        <img src="${business.logo_image || business.main_image_url || '{{ asset('frontend_assets/images/default-business.png') }}'}" 
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

            // Close search modal when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('#searchForm, #searchResultsModal').length) {
                    $('#searchResultsModal').hide();
                }
            });

            // Handle password visibility toggle
            $('.pass-icon-set').click(function() {
                const input = $(this).siblings('.pass-input-field');
                const eye = $(this).find('.pass-icon-eye');
                const eyeOff = $(this).find('.pass-icon-eye-off');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    eye.hide();
                    eyeOff.show();
                } else {
                    input.attr('type', 'password');
                    eye.show();
                    eyeOff.hide();
                }
            });

            // Check for password reset token on page load
            @if (!empty(Session::get('reset_token')))
                $('#resetPasswordToken').val('{{ Session::get('reset_token') }}');
                resetPasswordModal.show();
            @endif
        });
    </script>
@endpush
