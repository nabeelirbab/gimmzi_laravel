<x-layouts.frontend-layout title="Business Owners Page">
    @push('style')
        <style>
            .loginclass button {
                background: #26A7DF !important;
            }

            .loginclass button:hover {
                background: #8EC64E !important;
            }
        </style>
    @endpush

    @if (Auth::check() == false)
        <header class="main-head">
            <div class="container top-header">

                <nav class="navbar navbar-expand-lg header-m">

                    <a class="navbar-brand" href="{{ route('frontend.business_owner.index') }}"><img
                            src="{{ asset('frontend_assets/images/logo-marchant.png') }}"></a>
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
                        <ul class="navbar-nav ms-auto top-navication1">
                            @if (Auth::check())
                                <div class="dropdown custom-menu-one1">
                                    <button class="dropdown-toggle select-business-category" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false">{{ Auth::user()->full_name }}</button>
                                    <ol class="dropdown-menu select-business-category-droup-down droupdown-custom-menu"
                                        aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item"
                                                href="{{ route('frontend.business_owner.account') }}">Account</a></li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('frontend.business_owner.logout') }}">Logout</a></li>

                                    </ol>
                                </div>
                            @else
                                <li class="goback-to-home-page-btn-smart-rental loginclass">
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"> Login </button>
                                </li>
                                <li class="goback-to-home-page-btn-smart-rental">
                                    <a href="{{ route('frontend.business_owner.login') }}"> Register Now </a>
                                </li>
                            @endif
                        </ul>

                    </div>

                </nav>

            </div>


            <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"></button>

        </header>

    @endif

    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="marchant-body-cont">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 merchent-home">
                        <div class="content-area ">
                            <h2>Grow Your Business With Gimmzi Smart Rewards</h2>
                            <p>We can help you increase your revenue, lower advertising costs, and grow your
                                business.<br><br>
                                Create custom deals for your business using Smart Rewards easy-to-use deal wizard. Using
                                the highly effective niche marketing strategy, your business deals will be made
                                available to 500,000+ apartment units and many other customer databases.
                                <br><br>Join today for free and get started building your deals. Smart Rewards smart
                                technology will do the rest by placing your brand and deals in front of your customers
                                that
                                you may have not been able to reach before across various industries. The Gimmzi
                                Smart Rewards point system will exponentially increase your brand's awareness.
                            </p>
                            <a href="#">Check Providers that are using Smart Rewards in your area</a>
                        </div>
                    </div>
                    <div class="col-md-6 merchent-back-top">
                        <div class="marchant-img m-mobile-baner1">
                            <img src="{{ asset('frontend_assets/images/merchant-banner.svg') }}">
                            <div class="content-sec">
                                <h2>Grow Your <br>Business With </h2>
                                <h3>Smart Rewards</h3>
                            </div>

                        </div>
                        <div class="m-mobile-baner">
                            <img src="{{ asset('frontend_assets/images/img-baner1.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="marchant-body-cont-baner1">
                <img src="{{ asset('frontend_assets/images/m-baner.png') }}">
            </div>
        </div>
    </div>
    {{-- <div class="modal fade merchent-main-madal" id="exampleModal-ORIGINAL" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Log In to Gimmzi Smart Rewards for business Owners</h2>
                    </div>

                    {{ Form::open(['route' => 'frontend.merchant.login', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}
                    <div class="merchent-input">
                        <input type="text" placeholder="Email or Username" name="email" />
                        @if ($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="merchent-input">
                        <input type="password" placeholder="Password" name="password" />
                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="forgot-password-text" id="forget_password"><a href="#">Forgot password ?</a></div>
                    <div class="green-login-button">
                        <button>Login</button>
                    </div>
                    {{ Form::close() }}


                    <p class="register-now-bottom-text">Is your business new to Gimmzi Smart Rewards? <a
                            href="{{ route('frontend.business_owner.login') }}">Register Now</a></p>

                </div>
            </div>
        </div>
    </div> --}}

    {{--NEW LOGIN MODAL START--}}

    <div class="modal fade userLoginPopup travel_auth_popup lg" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    {{-- <form action="#"> --}} 
                    {{ Form::open(['route' => 'frontend.merchant.login', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}
                        <div class="">
                            <div class="title_h1">Log in</div>

                            
                            <div class="form_grp">
                                <label style="color:black;">Your email address <span class="reqrd">*</span></label>
                                <input type="text" class="form_input" placeholder="Enter your Email" name="email" id="email-input">
                            </div>

                            {{-- <div class="form_grp form_grp_submit">
                                <button typr ="submit" class="cmn_theme_btn next-step">Next</button>
                            </div> --}}

                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Next</button>
                            </div> 
                            <div class="form_grp form_grp_dcl_text">
                                By creating an account, you agree to our <a href="#">Privacy
                                    policy</a> and <a href="#">Terms of use</a>.
                            </div>
                        </div>

                        {{-- <div class="">
                            <a href="#" class="back_btn prev-step"> </a>
                            <div class="title_h1">Enter your password</div>

                            <div class="form_grp">
                                <label style="color:black;">Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{asset('frontend_assets/images/eye-show.png')}}" alt="" class="pass-icon-eye">
                                        <img src="{{asset('frontend_assets/images/eye-hidden.png')}}" alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input" placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Log in</button>
                            </div> 
                            <div class="form_grp form_grp_dcl_text form_frgt_pass_link " id="forget_password">
                                <a href="javascript:void(0)">Forgot your password?</a>
                            </div>
                        </div> --}}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade userLoginPopup travel_auth_popup lg" id="exampleModal1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    {{-- <form action="#"> --}} 
                        {{ Form::open(['route' => 'frontend.merchant.login_password', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}
                        <div class="">
                            <a href="#" class="back_btn prev-step"> <span id="m_email">@if (!empty(Session::get('email_address')))
                                {{ Session::get('email_address') }}
                            @endif
                            </span></a>
                            <div class="title_h1">Enter your password</div>

                            <div class="form_grp">
                                <label style="color:black;">Password</label>
                                <div class="pasrwd-field">
                                    <div class="pass-icon-set">
                                        <img src="{{asset('frontend_assets/images/eye-show.png')}}" alt="" class="pass-icon-eye">
                                        <img src="{{asset('frontend_assets/images/eye-hidden.png')}}" alt="" class="pass-icon-eye-off">
                                    </div>
                                    <input type="password" class="pass-input-field form_input" placeholder="Password" name="password">
                                </div>
                            </div>

                            <div class="form_grp form_grp_submit">
                                <button class="cmn_theme_btn">Log in</button>
                            </div> 
                            <div class="form_grp form_grp_dcl_text form_frgt_pass_link " id="forget_password">
                                <a href="javascript:void(0)">Forgot your password?</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                </div>
            </div>
        </div>
        </div>
    </div>

    {{--NEW LOGIN MODAL END--}}

    {{--NEW FORGET PASSWORD MODAL START--}}

    <div class="modal fade userLoginPopup travel_auth_popup lg" id="forgetpasswordmodal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    <div>
                        <form id="forgetpassword" name="forgetpassword" >
                            @csrf
                            {{-- <a href="#" class="back_btn prev-step"> <i>&lt;</i> Back</a> --}}
                            <div class="title_h1">Forgot your password?</div>
                            <div class="imp_text">Enter your email address and will send you a link
                                for the password reset.</div>

                            <div class="form_grp ">
                                <label>Your email address</label>
                                <input type="text" class="form_input" placeholder="Enter your Email" name="merchant_email" id="merchant_email" >
                                {{-- <span id="linksent"></span> --}}
                            </div>

                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button type="submit" class="cmn_theme_btn"  id="get_forget_link">Send reset link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{--NEW FORGET PASSWORD MODAL END--}}

    {{--NEW ERROR MODAL START--}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="login_error_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    <div>
                            <div class="step_msg"><strong>Unable to log in. Username not found.</strong></div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button class="cmn_theme_btn" id="login_modal_open">Try another Email</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade userLoginPopup travel_auth_popup lg" id="login_error_passwod_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    <div>
                            <div class="step_msg"><strong>Unable to log in. Please contact your system administrator.</strong></div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button class="cmn_theme_btn" id="example_modal_open">Try another Email</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade userLoginPopup travel_auth_popup lg" id="forget_password_error_modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    <div>
                        <div class="cmn_secthd_modals" style="text-align: center;">
                            <h3 id="forget_password_message"></h3>
                        </div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button class="cmn_theme_btn" id="forget_password_close">Try another Email</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{--NEW ERROR MODAL END--}}

    {{--NEW CHANGE PASSWORD MODAL START--}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="changepasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                    <form id="changepassword" method="post">
                        @csrf
                        <input type="hidden" name="token" id="token">                        
                        <div class="form_grp merchent-input">
                            <input style="color:black;" type="password" placeholder="New Password" id="new_password" name="new_password" />
                            <span class="newerror"></span>
                        </div>
                        <div class="form_grp merchent-input">
                            <input style="color:black;" type="password" placeholder="Confirm Password" id="confirm_password"
                                name="confirm_password" />
                            <span class="confirmerror"></span>
                        </div>
                        <div class="form_grp form_grp_submit pw-submit-btn">
                            <button type="submit" class="password_save cmn_theme_btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{--NEW CHANGE PASSWORD MODAL END--}}

    {{--NEW RESET PASSWORD MODEL START--}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="resetpasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                        <form id="resetpassword1"  name="resetpassword1" method="post">
                            <input type="hidden" name="user_token" id="user_token">
                            <div class="form_grp merchent-input">
                                <input style="color:black;" type="password" placeholder="New Password" id="new_reset_password" name="new_reset_password" />
                                {{-- <span class="newerror"></span> --}}
                            </div>
                            <div class="form_grp merchent-input">
                                <input style="color:black; "type="password" placeholder="Confirm Password" id="confirm_reset_password"
                                    name="confirm_reset_password" />
                                {{-- <span class="confirmerror"></span> --}}
                            </div>
                            <span id="resetpasswordmessage1"></span>

                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button type="submit" class="password_save cmn_theme_btn">Reset Password</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{--NEW RESET PASSWORD MODEL END--}}

    {{-- reset password link modal --}}
    {{-- <div class="modal fade merchent-main-madal" id="changepasswordModal-ORIGINAL" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Change Your Password cdc</h2>
                    </div>
                    <form id="changepassword" method="post">
                        @csrf
                        <input type="hidden" name="token" id="token">
                        <div class="merchent-input">
                            <input type="password" placeholder="New Password" id="new_password"
                                name="new_password" />
                            <span class="newerror"></span>
                        </div>
                        <div class="merchent-input">
                            <input type="password" placeholder="Confirm Password" id="confirm_password"
                                name="confirm_password" />
                            <span class="confirmerror"></span>
                        </div>
                        <div class="green-login-button">
                            <button type="submit" class="password_save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{--Forget password email modal--}}

    {{-- <div class="modal fade merchent-main-madal" id="forgetpasswordmodal-ORIGINAL" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Enter Your Email or Username</h2>
                    </div>
                    <form id="forgetpassword" name="forgetpassword" >
                        @csrf
                        <div class="merchent-input">
                            <input type="text" placeholder="Email or Username" name="merchant_email" id="merchant_email" required />
                            <span id="linksent"></span>
                        </div>
                        <div class="green-login-button">
                            <button type="submit" id="get_forget_link">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    {{--Reset of Forget password modal--}}
    {{-- <div class="modal fade merchent-main-madal" id="resetpasswordModal1" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Reset Your Password</h2>
                    </div>
                    <form id="resetpassword" name="resetpassword" method="post">
                        @csrf
                        <input type="hidden" name="user_token" id="user_token">
                        <div class="merchent-input">
                            <input type="password" placeholder="New Password" id="new_reset_password"
                                name="new_reset_password" />
                        </div>
                        <div class="merchent-input">
                            <input type="password" placeholder="Confirm Password" id="confirm_reset_password"
                                name="confirm_reset_password" />
                        </div>
                        <span id="resetpasswordmessage"></span>
                        <div class="green-login-button">
                           <button class="login-button-one" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


    

    @push('scripts')

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        @if(Session::has('valid_email'))
            $(document).ready(function() {
                $('#exampleModal').modal('hide');
                $('#exampleModal1').modal('show');
            });
        @else
                
        @endif
    </script>

        <script>
            @if (Session::has('merchant_error_code'))
              @if(Session::get('merchant_error_code') == 'open modal')
              

              @else
                // toastr.error("{{ Session::get('merchant_error_code') }}");
                $(document).ready(function() {
                    $('#exampleModal').modal('hide');
                    $('#login_error_modal').modal('show');
                });
              @endif
            @endif
        </script>
    @endpush

    @push('scripts') 
        <script>
            // @if (!empty(Session::get('email_address')))

            // @endif

            @if ($errors->any())
                $(window).on('load', function() {
                    $('#exampleModal').modal('show');
                });
            @endif

            @if (!empty(Session::get('merchant_error')))
                $(window).on('load', function() {
                    $('#exampleModal').modal('hide');
                    // toastr.error("{{ Session::get('merchant_error') }}"); login_error_passwod_modal
                    $('#login_error_passwod_modal').modal('show');
                });
            @endif

            @if (!empty(Session::get('token')) && (Session::get('user_type') == 'merchant'))
                $(window).on('load', function() {
                    console.log('<?php echo Session::get('token'); ?>');
                    $('#changepasswordModal').modal('show');
                    $("#changepassword").on('submit', function(e) {
                        e.preventDefault();
                        var token = '<?php echo Session::get('token'); ?>';
                        var new_password = $("#new_password").val();
                        var confirm_password = $("#confirm_password").val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/reset-user-password',
                            type: 'post',
                            data: {
                                'token': token,
                                'new_password': new_password,
                                'confirm_password': confirm_password
                            },
                            success: function(response) {
                                // alert('saved');
                                if (response.status == 4) {
                                    $('#changepassword')[0].reset();
                                    $('#changepasswordModal').modal('hide');
                                    toastr.success(
                                        'Password updated successfully but mail not sent');

                                } else if (response.status == 1) {
                                    $('#changepassword')[0].reset();
                                    $('#changepasswordModal').modal('hide');
                                    toastr.success(
                                        'Password updated successfully and mail sent to your email address'
                                        );
                                } else if (response.status == 0) {
                                    $(".confirmerror").html(
                                            'New password and confirm password does not matched')
                                        .css('color', 'red');
                                } else if (response.status == 2) {
                                    $(".confirmerror").html('Confirm password field is required..')
                                        .css('color', 'red');
                                } 
                            }
                        });
                    });
                })
            @endif
            @if (Session::has('merchant_token'))
                @if (Session::get('merchant_token') != '')
                        $(window).on('load', function() {
                            var merchant_token = '<?php echo Session::get('merchant_token'); ?>';
                            console.log(merchant_token +'-------------');
                            $("#user_token").val(merchant_token);
                            $('#resetpasswordModal').modal('show');

                        });
                   
                @else
                        $(window).on('load', function() {
                            $('#resetpasswordModal').modal('hide');
                        });
                @endif
            @endif

            $(document).ready(function () {
                // $("#forget_password").on('click', function(){
                // $("#forget_password").on('click', function(e){
                $(document).on('click', '#forget_password', function(e) {
                    e.preventDefault();
                    console.log('click');
                    $("#exampleModal").modal('hide');
                    $('#exampleModal1').modal('hide')
                    $("#forgetpasswordmodal").modal('show');
                });

                $(document).on('click', '#login_modal_open', function(e) {
                    e.preventDefault();
                    $("#login_error_modal").modal('hide');
                    $("#exampleModal").modal('show');
                });
                $(document).on('click', '#example_modal_open', function(e) {
                    e.preventDefault();
                    $("#login_error_passwod_modal").modal('hide');
                    $("#exampleModal").modal('show');
                });

                $("#forgetpassword").submit(function(e) {
                    e.preventDefault();
                    var email = $("#merchant_email").val();
                    // console.log(email);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('frontend.business_owner.merchant-forget-password') }}",
                        type: 'POST',
                        data: {
                            'email': email,
                        },
                        success: function(result) {
                            if (result.status == 2) {
                                // $('#linksent').css('color', 'green').fadeIn().html(
                                //     'Reset link sent to your email address');
                                // setTimeout(function() {
                                //     $('#linksent').fadeOut("slow");
                                //     location.reload();
                                // }, 3000);
                                $('#forgetpassword')[0].reset();
                                    $('#forgetpasswordmodal').modal('hide');
                                toastr.success(
                                    'Reset link sent to your email address');
                            } else if (result.status == 1) {
                                // $('#linksent').css('color', 'red').fadeIn().html('Mail not sent');
                                $("#forgetpasswordmodal").modal('hide');
                                $("#forget_password_error_modal").modal('show');
                                $("#forget_password_message").text(result.message);
                            } else if (result.status == 0) {
                                // $('#linksent').css('color', 'red').fadeIn().html('User not found');
                                $("#forgetpasswordmodal").modal('hide');
                                $("#forget_password_error_modal").modal('show');
                                $("#forget_password_message").text(result.message);;
                            }
                            else if (result.status == 3) {
                                // $('#linksent').css('color', 'red').fadeIn().html(result.validation_errors);
                                $("#forgetpasswordmodal").modal('hide');
                                $("#forget_password_error_modal").modal('show');
                                $("#forget_password_message").text(result.validation_errors);
                                // $("#forget_password_message").text(result.message);
                            }
                        }
                    });
                });

                $(document).on('click', '#forget_password_close', function(e) {
                    e.preventDefault();
                    $("#forget_password_error_modal").modal('hide');
                    $("#exampleModal").modal('hide');
                    $("#forgetpasswordmodal").modal('show');

                });
                $("#resetpassword1").submit(function(e) {
                    e.preventDefault();
                    var new_password = $("#new_reset_password").val();
                    var user_token = $("#user_token").val();
                    var confirm_password = $("#confirm_reset_password").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); 
                    $.ajax({
                        url: "{{ route('frontend.merchant-reset-password.store') }}",
                        type: 'POST',
                        data: {
                            'new_password': new_password,
                            'user_token': user_token,
                            'confirm_password': confirm_password,
                        },
                        success: function(result) {
                            if (result.status == 3) {
                                $('#resetpassword1')[0].reset();
                                    $('#resetpasswordModal').modal('hide');
                                toastr.success(
                                    'Password updated successfully & mail sent');
                            } else if (result.status == 0) {
                                $('#resetpasswordmessage1').css('color', 'red').fadeIn().html(
                                    'Confirm password does not matched with new password');
                               
                            } else if (result.status == 1) {
                                $('#resetpasswordmessage1').css('color', 'red').fadeIn().html(
                                    'New password should not be blank');
                                
                            } else if (result.status == 2) {
                                $('#resetpasswordmessage1').css('color', 'red').fadeIn().html(
                                    'User not found');
                               
                            } else if (result.status == 4) {
                                $('#resetpassword1')[0].reset();
                                    $('#resetpasswordModal').modal('hide');
                                toastr.success(
                                    'Password updated successfully but mail not sent');
                               
                            }
                            else if (result.status == 5) {
                                $('#resetpasswordmessage1').css('color', 'red').fadeIn().html(result.validation_errors);
                                
                            }
                        }
                    });
                });
            });
           
        </script>

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Reference the next step button and email input
    //     const nextStepBtn = document.querySelector('.next-step');
    //     const emailInput = document.getElementById('email-input');
    //     const emailDisplay = document.querySelector('.prev-step');

    //     nextStepBtn.addEventListener('click', function(event) {
    //         event.preventDefault(); // Prevent form submission
    //         const email = emailInput.value;

    //         if (email.trim() !== '') {
    //             // Display the email in the step2 section
    //             emailDisplay.innerHTML = `<i>&lt;</i> ${email}`;
    //         } else {
    //             alert('Please enter a valid email.');
    //         }
    //     });
    // });
</script>
    @endpush

</x-layouts.frontend-layout>
