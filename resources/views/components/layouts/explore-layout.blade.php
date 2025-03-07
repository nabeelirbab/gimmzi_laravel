<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gimmzi - {{ $title }}</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="images/x-icon" href="{{ asset('frontend_assets/images/favicon.ico') }}" />
    <!-- All CSS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/parsley/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/new-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/custom-style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.theme.default.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/modal-one.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="rental.css" /> -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/wizard.css') }}" />

    @livewireStyles
    <style>
        .carousel-wrapper {
            width: 1200px;
            margin: auto;
            position: relative;
            text-align: center;
            font-family: sans-serif;
        }

        .owl-carousel .owl-nav {
            overflow: hidden;
            height: 0px;
        }

        .owl-theme .owl-dots .owl-dot.active span,
        .owl-theme .owl-dots .owl-dot:hover span {
            background: #5110e9;
        }

        .owl-carousel .item {
            text-align: center;
        }

        .owl-carousel .nav-button {
            height: 50px;
            width: 25px;
            cursor: pointer;
            position: absolute;
            top: 110px !important;
        }

        .owl-carousel .owl-prev.disabled,
        .owl-carousel .owl-next.disabled {
            pointer-events: none;
            opacity: 0.25;
        }

        .owl-carousel .owl-prev {
            left: -35px;
        }

        .owl-carousel .owl-next {
            right: -35px;
        }

        .owl-theme .owl-nav [class*=owl-] {
            color: #ffffff;
            font-size: 39px;
            background: #000000;
            border-radius: 3px;
        }

        .owl-carousel .prev-carousel:hover {
            background-position: 0px -53px;
        }

        .owl-carousel .next-carousel:hover {
            background-position: -24px -53px;
        }

        .errorMsq {
            color: red !important;
            display: block;
        }

        .error {
            color: red !important;
            display: block;
        }

        .parsley-required {
            color: red !important;
            display: block;
        }

        .select2-container {
            z-index: 100000;
        }
    </style>

    <!-- <link rel="stylesheet" href="custom.css"> </head> -->
    @stack('style')
</head>


<body class="bodycls">
    {{-- Header start --}}
    <x-frontend.explore-header />
    {{-- Header end --}}

    {{ $slot }}

    {{-- Footer start --}}
    <x-frontend.explore-footer />
    {{-- Footer end --}}

    <div class="modal prrprty_tab_mdl fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog homemodal">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}" class="cancell-one11"></button>
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
                                    aria-selected="false"> <span class="tab_ttle">My Smart Rewards</span></a>
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

    {{-- Consumer login start --}}
    <div class="modal fade new_registration_badge_modal" id="consumer_login_modal" tabindex="-1"
        aria-labelledby="consumer_login_modalLabel" aria-hidden="true" data-bs-backdrop = 'static'
        keyboard = "false">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>


                    <div class="mt-5 mb-3 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Log in or create an account
                    </p>
                    <div class="main-form">
                        <form id="consumer_login_email" method="post" action="">
                            <div class="row">
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your email address <span>*</span></label>
                                    <input type="text" name="email_address" placeholder="" id="consm_email" />

                                    <span class="error"></span>
                                    <span id="signup2error"></span>
                                </div>
                                <div class="col-sm-12 login-top-one1">
                                    <button class="reg_btn login-button-one" type="submit" name="stepone"
                                        id="signupstep1">Next</button>
                                </div>
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
    {{-- Consumer login end --}}



    {{-- Consumer password start --}}
    <div class="modal fade new_registration_badge_modal" id="consumer_login_modal_password" tabindex="-1"
        aria-labelledby="consumer_login_modal_passwordLabel" aria-hidden="true" data-bs-backdrop = 'static'
        keyboard = "false">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="mt-5 mb-3 popup-logo">
                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Enter your password
                    </p>
                    <div class="main-form">
                        <form id="consumer_login_password" method="post" action="">
                            <div class="row">
                                <div class="col-sm-12 form-select1">
                                    <label for="">Password <span>*</span></label>
                                    <input type="password" name="password" placeholder="" id="consm_password" />
                                    <span class="error"></span>
                                </div>
                                <span id="message"></span>

                                <div class="col-sm-12 login-top-one1">
                                    <button class="reg_btn login-button-one" type="submit" name="stepone"
                                        id="signupstep1">Login</button>
                                    <a href="#" style="padding-left: 310px; margin-left:56px;"
                                        id="consForgetPassword">Forgot
                                        Password?</a>
                                </div>
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
    {{-- Consumer password end --}}


    {{-- Consumer register password start --}}
    <div class="modal fade new_registration_badge_modal" id="consumer_registration_password_modal" tabindex="-1"
        aria-labelledby="consumer_registration_password_modalLabel" aria-hidden="true" data-bs-backdrop = 'static'
        keyboard = "false">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="mt-5 mb-3 popup-logo">
                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Create a password for your new account
                    </p>
                    <div class="main-form">
                        <form id="consumer_create_password" method="post" action="">
                            <div class="row">
                                <div class="col-sm-12 form-select1">

                                    <label for="">Password <span>*</span></label>
                                    <input type="password" name="password" placeholder=""
                                        id="consm_create_password" />
                                    <span class="error"></span>
                                </div>
                                <span id="valiMessage"></span>


                                <p>Your password should have at least:</p>
                                <table>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>
                                                    8 Charecters
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            0/8
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>
                                                    1 uppercase letter
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            0/1
                                        </td>
                                    </tr>
                                </table>

                                <div class="col-sm-12 login-top-one1">
                                    <button class="reg_btn login-button-one" type="submit" name="stepone"
                                        id="signupstep1">Create Account</button>
                                </div>
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
    {{-- Consumer register password end --}}



    {{-- New Consumer Registration start --}}
    <div class="modal fade new_registration_badge_modal" id="consumer_new_registration_form" tabindex="-1"
        aria-labelledby="consumer_new_registration_formLabel" aria-hidden="true" data-bs-backdrop = 'static'
        keyboard = "false">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="mt-5 mb-3 popup-logo">
                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Claim your badge to unlock
                        special deals and discounts in the local area. Complete form below.
                    </p>
                    <div class="main-form">
                        <form id="new_consumer_registration_submit" method="post" action="">
                            @php
                                $i = 1;
                                $day = [];
                                if ($i >= 1 && $i <= 31) {
                                    for ($i = 1; $i <= 31; $i++) {
                                        array_push($day, ['value' => $i, 'number' => $i]);
                                    }
                                }
                                $year = [];
                                $i = 1970;
                                if ($i >= 1970 && $i <= date('Y')) {
                                    for ($i = 1970; $i <= date('Y'); $i++) {
                                        array_push($year, ['value' => $i, 'number' => $i]);
                                    }
                                }
                            @endphp
                            <div class="row">
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your email address <span>*</span></label>
                                    <input type="text" disabled value="{{ Session::get('unwanted_email') }}"
                                        name="consm_email_address" placeholder="" id="consm_email_address"
                                        disabled />

                                    <span class="error"></span>
                                </div>
                                <div class="registration_input">
                                    <div class="col-sm-12 form-select1">
                                        <label for="">First Name <span>*</span></label>
                                        <input type="text" name="consm_first_name" placeholder="First name"
                                            id="consm_first_name" />

                                        <span class="error"></span>
                                    </div>

                                    <div class="col-sm-12 form-select1">
                                        <label for="">Last Name <span>*</span></label>
                                        <input type="text" name="consm_last_name" id="consm_last_name"
                                            placeholder="Last name" />
                                    </div>
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Phone Number <span>*</span></label>
                                        <input type="text" name="consm_phone" id="consm_phone"
                                            placeholder="Phone Number" />
                                    </div>

                                    <div class="col-sm-12 birthday-optional-text1">
                                        Birthday (Optional)

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-select1">
                                            <select name="consm_birth_month" id="consm_birth_month">
                                                <option value=""disabled selected>Month</option>
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
                                            <select name="consm_birth_day" id="consm_birth_day">
                                                <option value=""disabled selected>Day</option>
                                                @foreach ($day as $dayvalue)
                                                    <option value="{{ $dayvalue['value'] }}">
                                                        {{ $dayvalue['number'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-select1">
                                            <select name="consm_birth_year" id="consm_birth_year">
                                                <option value=""disabled selected>Year</option>
                                                @foreach ($year as $yearvalue)
                                                    <option value="{{ $yearvalue['value'] }}">
                                                        {{ $yearvalue['number'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <p class="p_text">Recieve additional points and deals on your birthday, We
                                        wanna celebrate with
                                        you!
                                    </p>
                                    <span id="message1"></span>


                                    <div class="col-sm-12 login-top-one1">
                                        <button class="reg_btn login-button-one" type="submit" name="stepone"
                                            id="signupstep1">Claim Gimmzi Badge</button>
                                    </div>
                                </div>
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
    {{-- New Consumer Registration end --}}



    {{-- Successfully mail send pop up start --}}
    <div class="modal fade" id="mailSendSuccess" tabindex="-1" aria-labelledby="mailSendSuccessLabel"
        aria-hidden="true" data-bs-backdrop = 'static' keyboard = "false">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="main-form">
                        <div class="all-done-one">
                            <h4>All done!</h4>
                            <div class="go-out-text smart-reward-text">
                                <p> An email sent to complete account setup. Please check your Spam Folder if you do not
                                    see it in your inbox</p>
                                <a href="" class="deals-button" id="deals-button"
                                    style="color: #fff!important;">Ok</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Successfully mail send pop up end --}}

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

</body>

@livewireScripts
<!-- <span id="scroll" style="display: none;"><i class="fas fa-angle-up"></i></span> -->

<!-- Jquery-->
<script src="{{ asset('frontend_assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend_assets/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend_assets/parsley/parsley.min.js') }}"></script>

<script src="{{ asset('frontend_assets/js/common.js') }}"></script>
<script src="{{ asset('frontend_assets/js/new-common.js') }}"></script>
<script src="{{ asset('frontend_assets/js/toastr.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('frontend_assets/js/toastr.min.css') }}">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    jQuery(document).ready(function() {
        var owl = jQuery('.owl-carousel');
        owl.owlCarousel({
            margin: 15,
            nav: true,
            navText: ["<div class='nav-button owl-prev1'>‹</div>",
                "<div class='nav-button owl-next1'>›</div>"
            ],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 5
                }
            }
        })
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
{{-- <script src="{{asset('frontend_assets/js/owl.carousel.js')}}"></script> --}}
<script>
    function isNumber(evt) {
        console.log(evt);
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    $(".allow_decimal").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
</script>


<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif


    @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if (Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif
</script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.parsley-validate').parsley({});

    });

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>



@if (!empty(Session::get('error_code')))
    <script>
        $(window).on('load', function() {
            $('#loginModal').modal('show');
        });
    </script>
@endif
<script>
    @if (!empty(Session::get('token')))
        $(window).on('load', function() {
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
</script>

@if (Session::has('error'))
    @if (Session::has('isRegistered'))
        <script>
            $(function() {
                $('#new-registration-modal').modal('show');
                $('.registration_input').css('display', 'none')

            });
        </script>
    @elseif(Session::has('type'))
        @if (Session::get('type') == 'consumer')
            <script>
                $(function() {
                    $('#loginModal').modal('show');
                    $("#nav-home-tab").removeClass("active");
                    $("#nav-profile-tab").addClass("active");
                    $("#user_type").val('My Smart Rewards');
                    $("#nav-home").removeClass("active show");
                    $("#nav-profile").addClass("active show");
                });
            </script>
        @elseif (Session::get('type') == 'login_consumer')
            <script>
                $(function() {
                    $('#consumer_login_modal').modal('show');
                });
            </script>
        @elseif(Session::get('type') == 'register_password')
            <script>
                $(function() {
                    $('#consumer_registration_password_modal').modal('show');
                });
            </script>
        @else
            <script>
                $(function() {
                    $('#loginModal').modal('show');
                });
            </script>
        @endif
    @else
        <script>
            $(function() {
                $('#loginModal').modal('show');
            });
        </script>
    @endif
@endif
@if (Session::has('link'))
    <script>
        $(function() {
            $('#Join-Today').modal('show');
        });
    </script>
@else
    <script>
        $(function() {
            $('#Join-Today').modal('hide');

        });
    </script>
@endif
@if (Session::has('token'))
    @if (Session::get('token') != '')
        <script>
            $(function() {
                var token = '<?php echo Session::get('token'); ?>';
                $("#user_token").val(token);
                $('#resetpasswordModal').modal('show');

            });
        </script>
    @else
        <script>
            $(function() {
                $('#resetpasswordModal').modal('hide');

            });
        </script>
    @endif
@endif

<script>
    var path = "{{ route('frontend.apartment-autocomplete') }}";

    $("#consumerPropertyApartment").autocomplete({

        source: function(request, response) {
            if (request.term != '') {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        if (data != '') {
                            $('#list').fadeIn();
                            $('#list').html(data);
                        } else {
                            $('#list').fadeOut();
                        }
                    }
                });
            } else {
                $('#list').fadeOut();
            }

        },
        // select: function (event, ui) {
        //     $('#first_name').val(ui.item.first_name);
        //     console.log(ui.item); 
        //     return false;
        // }
    });
    $(document).on('click', 'ul.dropdown-menu li', function() {
        $('#consumerPropertyApartment').val($(this).text());
        $('#list').fadeOut();
    });
    $(document).ready(function() {
        $(".join-today-button").click(function() {
            $('#Join-Today').modal('show');
            if ((window.location.pathname == '/travel-and-tourism') || (window.location.pathname.split(
                    '/').slice(-2, -1)[0] == 'short-term-rental-website') || (window.location.pathname
                    .split('/').slice(-2, -1)[0] == 'other-short-term-rental-listing')) {
                $('#consumer_login_modal').modal('show');
            }
            $('#Join-Today').find('form').trigger('reset');
        });
        $(".btn-close").click(function() {
            $('#Join-Today').modal('hide');
            $('#new-registration-modal').modal('hide');
            $('#consumer_login_modal').modal('hide');
            $('#consumer_login_modal_password').modal('hide');
            $('#consumer_registration_password_modal').modal('hide');
            $('#consumer_new_registration_form').modal('hide');

            $('#Join-Today').find('form').trigger('reset');
            $('#new-registration-modal').find('form').trigger('reset');
        });

        $(".deals-button").click(function() {
            $('#mailSendSuccess').modal('hide');
        });
    });
    $(document).ready(function() {
        $("#consumerforgetpassword").click(function() {
            $("#forgetpasswordModal").modal('show');
            $('#loginModal').modal('hide');
        });
        $('#thanksmodal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $('.next-btn').click(function() {
            $('.next-btn').css('display', 'none');
            // $('.registration_input').css('display', 'block');
            $('.registration_input').slideToggle();
        });
        $('#login_smart_account').click(function() {
            $('#exampleModal').modal('hide');
            $('#loginModal').modal('show');
            $("#nav-home-tab").removeClass("active");
            $("#nav-profile-tab").addClass("active");
            $("#user_type").val('My Smart Rewards');
            $("#nav-home").removeClass("active show");
            $("#nav-profile").addClass("active show");
        })

        $('#login_property_manager').click(function() {
            $('#exampleModal').modal('hide');
            $('#loginModal').modal('show');
            $("#nav-profile-tab").removeClass("active");
            $("#nav-home-tab").addClass("active");
            $("#user_type").val('Property Manager');
            $("#nav-home").addClass("active show");
            $("#nav-profile").removeClass("active show");

        })

    });
    $(document).on('click', '.user_type', function() {
        if ($('#nav-profile-tab').hasClass('active')) {
            $("#user_type").val('My Smart Rewards');
        } else {
            $("#user_type").val('');
        }
    });
    $(document).ready(function() {
        $('#contactmodal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $(document).ready(function() {
        $('#unitmodal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $(document).ready(function() {
        var validator = $("#signup-step1").validate({
            rules: {
                first_name: "required",
                last_name: "required",

                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                },
                zip_code: {
                    required: true,
                    minlength: 5,
                    maxlength: 5
                },
                city: "required",
                state: "required",
                lives_an_apartment: "required",
                provider_id: {
                    required: {
                        depends: function(elem) {
                            if ($("#lives_an_apartment").val() == 'yes') {
                                if (($("#get_link").val() == 1) || ($("#get_link_2").val() == 1)) {
                                    return false;
                                } else {
                                    return true;
                                }
                            }

                        }
                    }
                },

                unit_one_name: {
                    required: {
                        depends: function(elem) {
                            return $("#get_link").val() == 1
                        }
                    }
                },

                unit_two_name: {
                    required: {
                        depends: function(elem) {
                            return $("#get_link_2").val() == 1
                        }
                    }
                },

            },
            messages: {
                first_name: " Please enter your First Name",
                last_name: " Please enter your Last Name",
                email: {
                    required: " Please enter your Email Address ",
                    email: " Email address should be a valid address"
                },

                phone: {
                    required: " Please enter your Phone number",
                },
                zip_code: {
                    required: " Please enter your Zip Code",
                    minlength: " Your Zip Code  must be consist of at least 5 characters",
                    maxlength: " Your Zip Code  must be consist of at most 5 characters"
                },
                city: " Please enter your City",
                state: " Please select your State",
                lives_an_apartment: " Please select any of the options",
                provider_id: {
                    required: " Please Select Your Apartment"
                },
                unit_one_name: {
                    required: " Please Enter Unit Number"
                },
                unit_two_name: {
                    required: " Please Enter Unit Number"
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });


        $("#new_registration_submit").validate({
            rules: {
                consumer_first_name: "required",
                consumer_last_name: "required",

                consumer_email_address: {
                    required: true,
                    email: true
                },
                consumer_phone: {
                    required: true,
                },
            },
            messages: {
                consumer_first_name: "Please enter your First Name",
                consumer_last_name: "Please enter your Last Name",
                consumer_email_address: {
                    required: "Please enter your Email Address ",
                    email: " Email address should be a valid address"
                },

                consumer_phone: {
                    required: "Please enter your Phone number",
                }
            },

            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });

        $("#consumer_login_email").validate({
            rules: {
                email_address: "required",

                email_address: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email_address: {
                    required: "Please enter your Email Address ",
                    email: " Email address should be a valid address"
                }
            },

            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });

        $("#consumer_login_password").validate({
            rules: {
                password: "required",
            },
            messages: {
                password: {
                    required: "Please enter your password ",
                }
            },

            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });

        $("#consumer_create_password").validate({
            rules: {
                password: {
                    required: true,
                    // pattern: /^(?=.*[A-Z]).{8,}$/ // Add a custom pattern rule for password
                }
            },
            messages: {
                password: {
                    required: "Please enter your password",
                    pattern: "Password must be at least 8 characters with at least 1 uppercase letter"
                }
            },

            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });

        $("#new_consumer_registration_submit").validate({
            rules: {
                consm_first_name: "required",
                consm_last_name: "required",

                consm_email_address: {
                    required: true,
                    email: true
                },
                consm_phone: {
                    required: true,
                },
            },
            messages: {
                consm_first_name: "Please enter your First Name",
                consm_last_name: "Please enter your Last Name",
                consm_email_address: {
                    required: "Please enter your Email Address ",
                    email: " Email address should be a valid address"
                },

                consm_phone: {
                    required: "Please enter your Phone number",
                }
            },

            errorPlacement: function(label, element) {
                label.addClass('errorMsq');
                element.parent().append(label);
            },
        });


        $("#signup-step2").validate({
            rules: {
                unit: "required",
                access_code: "required",
            },
            messages: {
                unit: " Please enter unit number",
                access_code: " Please enter access code",
            }
        });

        $("#forgetpassword").validate({
            rules: {
                consumer_email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                consumer_email: {
                    required: " Please enter your Email Address ",
                    email: " Email address should be a valid address"
                },
            }
        });

        $("#resetpassword").validate({
            rules: {
                new_password: {
                    required: true,
                    minlength: 6,
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#new_password"
                },
            },
            messages: {
                new_password: {
                    required: "Please enter a New password ",
                    minlength: "Password minimum length should be 6"
                },
                confirm_password: {
                    required: "Please enter Confirm password ",
                    minlength: "Password minimum length should be 6",
                    equalTo: "Confirm password should be equal to New password"
                },
            }
        });

        // $("#loginFormid").submit(function (e) {
        //     e.preventDefault();
        //   })

        $("#signup-step1").submit(function(e) {
            e.preventDefault();
            // $("#signup-step1").validate();
            //console.log($("#signup-step1").serialize())
            if ($("#lives_an_apartment").val() == 'yes') {
                var provider_id = $("#provider_id").val();

            } else {
                var provider_id = '';
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-signup-step1') }}",
                type: 'POST',
                data: {
                    first_name: $("#first_name").val(),
                    last_name: $("#last_name").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    zip_code: $("#zip_code").val(),
                    city: $("#city").val(),
                    state: $("#state").val(),
                    birth_month: $("#birth_month").val(),
                    birth_day: $("#birth_day").val(),
                    birth_year: $("#birth_year").val(),
                    lives_an_apartment: $("#lives_an_apartment:checked").val(),
                    provider_id: provider_id,
                    unit_one_name: $("#unit_one_name").val(),
                    unit_two_name: $("#unit_two_name").val(),
                    get_link: $("#get_link").val(),
                    get_link_2: $("#get_link_2").val(),


                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 0) {
                        $('#Join-Today').find('form').trigger('reset');
                        $("#Join-Today").modal('hide');
                        $("#thanksmodal").modal('show');
                        $("#thanks_message1").html(result.message1);
                        $("#thanks_message2").html(result.message2);
                    } else if (result.status == 2) {
                        if ($("#unit_incorrect_count").val() == '') {
                            $("#unit_incorrect_count").val(1);
                            $("#unitnameerror").html('Please check unit number').css(
                                'color', 'red');
                        } else if (($("#unit_incorrect_count").val() != '') && ($(
                                "#unit_incorrect_count").val() != 3)) {
                            var value = parseInt($("#unit_incorrect_count").val()) +
                                parseInt(1);
                            $("#unit_incorrect_count").val(value);
                            $("#unitnameerror").html('Please check unit number').css(
                                'color', 'red');
                        } else {
                            $('#Join-Today').find('form').trigger('reset');
                            $("#Join-Today").modal('hide');
                            $("#contactmodal").modal('show');
                            $("#providername").html('Contact ' + result.data);
                            //$("#consumerid").val($("#consumerid").val());
                            $("#alertprovider").html(
                                'The access code and/or unit number was incorrect or is no longer valid.' +
                                'Please reach out to ' + result.data +
                                ' office and request a new member link be sent to you via email or text.'
                            );
                        }

                    } else if (result.status == 1) {
                        $("#sameemailerror").html('Email has already been used');
                    } else if (result.status == 3) {
                        $('#Join-Today').find('form').trigger('reset');
                        $("#Join-Today").modal('hide');
                        $("#consumerid").val(result.consumer);
                        $("#password").val(result.password);
                        $("#property_id").val(result.provider_id);
                        $("#unitmodal").modal('show');
                    } else if (result.status == 5) {
                        $("#sameemailerror").html('Email has already been used');
                    } else if (result.status == 9) {
                        $("#signup1error").html(result.validation_errors).css('color',
                            'red');
                    } else if (result.status == 10) {
                        console.log(result.state_id);
                        $('#consumerPropertyCode').val(result.zipcode);
                        $('#consumerPropertyCity').val(result.city);
                        $('#consumerPropertyState').val(result.state_id);
                        $('#consumerPropertyId').val(result.consumer);
                        $("#Join-Today").modal('hide');
                        $("#propertyModal").modal('show');
                    }

                }
            });
        })

        $("#new_registration_submit").submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                // url: "{{ route('frontend.consumer-signup-step1') }}",
                url: "{{ route('frontend.new-registration') }}",
                type: 'POST',
                data: {
                    first_name: $("#consumer_first_name").val(),
                    last_name: $("#consumer_last_name").val(),
                    email: $("#consumer_email_address").val(),
                    phone: $("#consumer_phone").val(),
                    birth_month: $("#consumer_birth_month").val(),
                    birth_day: $("#consumer_birth_day").val(),
                    birth_year: $("#consumer_birth_year").val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 0) {
                        $('#new-registration-modal').find('form').trigger('reset');
                        $("#new-registration-modal").modal('hide');
                        $("#thanksmodal").modal('show');
                        $("#thanks_message1").html(result.message1);
                        $("#thanks_message2").html(result.message2);
                    } else if (result.status == 1) {
                        $("#sameemailerror").html('Email has already been used');
                    } else if (result.status == 3) {
                        $('#new-registration-modal').find('form').trigger('reset');
                        $("#new-registration-modal").modal('hide');
                        $("#consumerid").val(result.consumer);
                        $("#password").val(result.password);
                        $("#property_id").val(result.provider_id);
                        $("#unitmodal").modal('show');
                    } else if (result.status == 5) {
                        $("#sameemailerror").html('Email has already been used');
                    } else if (result.status == 9) {
                        $("#signup2error").html(result.validation_errors).css('color',
                            'red');
                    }

                }
            });
        })

        $("#consumer_login_email").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-login-email-check') }}",
                type: 'POST',
                data: {
                    email: $("#consm_email").val()
                },
                success: function(result) {
                    if (result.status == 1) {
                        $("#consumer_login_modal").modal('hide');
                        $("#consumer_login_modal_password").modal('show');
                        setTimeout(() => {
                            toastr.success(result.message);
                        }, 100)
                    } else if (result.status == 2) {
                        $("#consumer_login_modal").modal('hide');
                        $("#mailSendSuccess").modal('show');
                    } else if (result.status == 9) {
                        $("#signup2error").html(result.validation_errors).css('color',
                            'red');
                    } else if (result.status == 5) {
                        $("#signup2error").html(result.message).css('color',
                            'red');
                    }


                }
            });


        })

        $("#consumer_login_password").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-login-password-check') }}",
                type: 'POST',
                data: {
                    password: $("#consm_password").val()
                },
                success: function(result) {
                    console.log(result.status);
                    if (result.status == 5) {
                        $("#message").html(result.message).css('color',
                            'red');
                    } else if (result.status == 1) {
                        setTimeout(() => {
                            toastr.success(result.message);
                            window.location.href =
                                "{{ route('frontend.consumer-dashboard') }}";
                        }, 100)
                    }
                }
            });


        })

        $("#consumer_create_password").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-login-password-create') }}",
                type: 'POST',
                data: {
                    password: $("#consm_create_password").val()
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 5) {
                        $("#message").html(result.message).css('color',
                            'red');
                    } else if (result.status == 1) {
                        $("#consumer_registration_password_modal").modal('hide');
                        $("#consumer_new_registration_form").modal('show');
                    } else if (result.status == 9) {
                        $("#valiMessage").html(result.validation_errors).css('color',
                            'red');
                    }
                }
            });


        })

        $("#new_consumer_registration_submit").submit(function(e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.new-registration-consumer') }}",
                type: 'POST',
                data: {
                    first_name: $("#consm_first_name").val(),
                    last_name: $("#consm_last_name").val(),
                    email: $("#consm_email_address").val(),
                    phone: $("#consm_phone").val(),
                    birth_month: $("#consm_birth_month").val(),
                    birth_day: $("#consm_birth_day").val(),
                    birth_year: $("#consm_birth_year").val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 9) {
                        $("#message1").html(result.validation_errors).css('color',
                            'red');
                    } else if (result.status == 10) {
                        $("#message1").html(result.message).css('color',
                            'red');
                    } else if (result.status == 0) {
                        $('#new_consumer_registration_submit').find('form').trigger(
                            'reset');
                        $("#consumer_new_registration_form").modal('hide');
                        $("#thanksmodal").modal('show');
                        $("#thanks_message1").html(result.message1);
                        $("#thanks_message2").html(result.message2);



                    }


                }
            });


        })

        $('#consForgetPassword').on('click', function() {
            window.location.href =
                "{{ route('frontend.index', ['q' => 'consumer_forget_password']) }}";
        });

        $("#signup-step2").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-signup-step2') }}",
                type: 'POST',
                data: {
                    'consumerid': $("#consumerid").val(),
                    'unit': $("#unit").val(),
                    'access_code': $("#access_code").val(),
                    'password': $("#password").val(),
                    'property_id': $("#property_id").val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 2) {

                        if ($("#unit_incorrect_count2").val() == '') {
                            $("#unit_incorrect_count2").val(1);
                            $("#unitaccesserror").html(
                                'Please check unit number & access code').css('color',
                                'red');
                        } else if (($("#unit_incorrect_count2").val() != '') && ($(
                                "#unit_incorrect_count2").val() != 3)) {
                            var value = parseInt($("#unit_incorrect_count2").val()) +
                                parseInt(1);
                            $("#unit_incorrect_count2").val(value);
                            $("#unitaccesserror").html(
                                'Please check unit number & access code').css('color',
                                'red');
                        } else {

                            $('#unitmodal').find('form').trigger('reset');
                            $("#unitmodal").modal('hide');
                            $("#unitaccesserror").html('');
                            $("#contactmodal").modal('show');
                            if (result.data == '') {
                                $("#providername").html('Contact Provider');
                                $("#alertprovider").html(
                                    'The access code and/or unit number was incorrect or is no longer valid.' +
                                    'Please reach out to provider office and request a new member link be sent to you via email or text.'
                                );
                            } else {
                                $("#providername").html('Contact ' + result.data);
                                $("#alertprovider").html(
                                    'The access code and/or unit number was incorrect or is no longer valid.' +
                                    'Please reach out to ' + result.data +
                                    ' office and request a new member link be sent to you via email or text.'
                                );
                            }

                            $("#consumerid").val($("#consumerid").val());

                        }
                    } else if (result.status == 3) {

                    }
                }
            });
        });

        $("#forgetpassword").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-forget-password') }}",
                type: 'POST',
                data: {
                    'email': $("#consumer_email").val(),
                },
                success: function(result) {
                    if (result.status == 2) {
                        $('#linksent').css('color', 'green').fadeIn().html(
                            'Reset link sent to your email address');
                        setTimeout(function() {
                            $('#linksent').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 0) {
                        $('#linksent').css('color', 'red').fadeIn().html('User not found');
                        setTimeout(function() {
                            $('#linksent').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 1) {
                        $('#linksent').css('color', 'red').fadeIn().html('Mail not sent');
                        setTimeout(function() {
                            $('#linksent').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    }
                }
            });
        });

        $("#resetpassword").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.consumer-reset-password.store') }}",
                type: 'POST',
                data: {
                    'new_password': $("#new_password").val(),
                    'user_token': $("#user_token").val(),
                    'confirm_password': $("#confirm_password").val(),
                },
                success: function(result) {
                    if (result.status == 3) {
                        $('#resetpasswordmessage').css('color', 'green').fadeIn().html(
                            'Password updated successfully & mail sent');
                        setTimeout(function() {
                            $('#resetpasswordmessage').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 0) {
                        $('#resetpasswordmessage').css('color', 'red').fadeIn().html(
                            'Confirm password does not matched with new password');
                        setTimeout(function() {
                            $('#resetpasswordmessage').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 1) {
                        $('#resetpasswordmessage').css('color', 'red').fadeIn().html(
                            'New password should not be blank');
                        setTimeout(function() {
                            $('#resetpasswordmessage').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 2) {
                        $('#resetpasswordmessage').css('color', 'red').fadeIn().html(
                            'User not found');
                        setTimeout(function() {
                            $('#resetpasswordmessage').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else if (result.status == 4) {
                        $('#resetpasswordmessage').css('color', 'green').fadeIn().html(
                            'Password updated successfully but mail not sent');
                        setTimeout(function() {
                            $('#resetpasswordmessage').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    }
                }
            });
        });

        $("#dismissaccount").on('click', function() {
            validator.resetForm();
            if (($("#first_name").val() != '') && ($("#last_name").val() != '') && ($("#email").val() !=
                    '') && ($("#phone").val() != '') && ($("#zip_code").val() != '') && ($("#city")
                    .val() != '') && ($("#state").val() != '') && ($("#lives_an_apartment:checked")
                    .val() !=
                    '')) {
                if ($("#lives_an_apartment").val() == 'yes') {
                    var provider_id = $("#provider_id").val();
                } else {
                    var provider_id = '';
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('frontend.dismiss-registration') }}",
                    type: 'POST',
                    data: {
                        first_name: $("#first_name").val(),
                        last_name: $("#last_name").val(),
                        email: $("#email").val(),
                        phone: $("#phone").val(),
                        zip_code: $("#zip_code").val(),
                        city: $("#city").val(),
                        state: $("#state").val(),
                        birth_month: $("#birth_month").val(),
                        birth_day: $("#birth_day").val(),
                        birth_year: $("#birth_year").val(),
                        lives_an_apartment: $("#lives_an_apartment:checked").val(),
                        provider_id: provider_id,
                        unit_one_name: $("#unit_one_name").val(),
                        unit_two_name: $("#unit_two_name").val(),
                        get_link: $("#get_link").val(),
                        get_link_2: $("#get_link_2").val(),


                    },
                    success: function(result) {
                        console.log(result);
                        setTimeout(() => {
                            toastr.error(
                                'Your registration have not successfully done.');
                        }, 500)

                    }
                });
            } else {
                $('#Join-Today').find('form').trigger('reset');
                $('#Join-Today').modal('hide');
            }

        })
        $(".join-today-close").on('click', function() {
            validator.resetForm();
        });

    });


    $(".cancelregistration").on('click', function() {
        var consumerid = $("#consumerid").val();
        $.ajax({
            url: "{{ route('frontend.cancel-registration') }}",
            type: 'get',
            data: {
                'consumerid': consumerid
            },
            success: function(result) {
                //console.log(result.data);
                if (result.status == 1) {
                    location.reload();

                } else if (result.status == 0) {
                    setTimeout(() => {
                        toastr.error('User not found');
                        location.reload();
                    }, 500)

                } else {
                    setTimeout(() => {
                        toastr.error('User not found');
                        location.reload();
                    }, 500)
                }

            }
        });
    })

    $("#zip_code").on('keyup', function() {
        var zipcode = $(this).val();
        if (zipcode.length == 5) {
            $.ajax({
                url: "{{ route('frontend.ajax.get_city') }}",
                type: 'get',
                data: {
                    'zipcode': zipcode
                },
                success: function(result) {
                    //console.log(result.data);
                    if (result.success == 1) {
                        $("#city").val(result.data.City);
                        $("#ziperror").html('');
                        $("#state").val(result.state_name);

                    } else {
                        $("#ziperror").html(result.data[0]);
                        $("#ziperror").css('color', 'red');
                    }

                }
            });
        } else {
            $("#city").val('');
            $("#state").val('');
        }

    });

    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    $('input[name="lives_an_apartment"]').on('click', function() {
        var apartmentvalue = $(this).val();
        if (apartmentvalue == 'yes') {
            if (($('#get_link').val() == 1) || ($('#get_link_2').val() == 1)) {
                $("#congratulationshow").css('display', 'block');
                $("#unitaddress").css('display', 'block');
                $(".apartmenttext").css('display', 'none');
                $(".apartmentlist").css('display', 'none');
            } else {
                $(".apartmenttext").css('display', 'block');
                $(".apartmentlist").css('display', 'block');
            }

        } else {
            if (($('#get_link').val() == 1) || ($('#get_link_2').val() == 1)) {
                $(".apartmenttext").css('display', 'none');
                $(".apartmentlist").css('display', 'none');
                $("#congratulationshow").css('display', 'none');
                $("#unitaddress").css('display', 'none');
            } else {
                $(".apartmenttext").css('display', 'none');
                $(".apartmentlist").css('display', 'none');
            }

        }
    })
    $(document).ready(function() {

        $('#email').on('blur', function() {
            if (($('#get_link_2').val() == 0) || ($('#get_link_2').val() == '')) {
                var email = $(this).val();
                $.ajax({
                    url: "{{ route('frontend.consumer-email-check') }}",
                    type: 'get',
                    data: {
                        'email': email
                    },
                    success: function(result) {
                        if (result.success == true) {
                            var property = result.data.providers.name + ', ' + result.data
                                .providers.address + ', ' + result.data.providers.city +
                                ', ' +
                                result.data.providers.states.name + ', ' + result.data
                                .providers
                                .zip_code;
                            $('#get_link').val(1);
                            $("#congratulationshow").css('display', 'block');
                            $("#unitaddress").css('display', 'block');
                            $("#propertyText").css('display', 'block');
                            $("#unitText").css('display', 'block');
                            $("#unitText").text(result.data.building_name);
                            $("#propertyText").text(property);

                        } else {
                            $('#get_link').val(0);
                            $("#congratulationshow").css('display', 'none');
                            $("#unitaddress").css('display', 'none');
                            $("#propertyText").css('display', 'none');
                            $("#unitText").css('display', 'none');
                            console.log('no');
                        }

                    }
                });
            }

        });
        $('#phone').on('blur', function() {
            if (($('#get_link').val() != 1) || ($('#get_link_2').val() == '')) {
                var phone = $(this).val();
                $.ajax({
                    url: "{{ route('frontend.consumer-phone-check') }}",
                    type: 'get',
                    data: {
                        'phone': phone
                    },
                    success: function(result) {
                        if (result.success == true) {
                            var property = result.data.providers.name + ', ' + result.data
                                .providers.address + ', ' + result.data.providers.city +
                                ', ' +
                                result.data.providers.states.name + ', ' + result.data
                                .providers
                                .zip_code;
                            console.log(property);
                            $('#get_link_2').val(1);
                            $("#congratulationshow2").css('display', 'block');
                            $("#unitaddress2").css('display', 'block');
                            $("#propertyText2").css('display', 'block');
                            $("#unitText2").css('display', 'block');
                            $("#unitText2").text(result.data.building_name);
                            $("#propertyText2").text(property);
                        } else {
                            $('#get_link_2').val(0);
                            $("#congratulationshow2").css('display', 'none');
                            $("#unitaddress2").css('display', 'none');
                            $("#propertyText2").css('display', 'none');
                            $("#unitText2").css('display', 'none');

                        }
                    }
                });
            }

        });

        $('#same_apartment').change(function() {
            if (this.checked) {
                let apartment = $('#consumerPropertyApartment').val();
                $('#consumerPropertyManagement').val(apartment);
                if (apartment != '') {
                    $('#consumerPropertyManagement-error').hide();
                }
            } else {
                $('#consumerPropertyManagement').val('');
            }
        });
        $('#memberLogin').click(function() {
            $("#propertyModal").modal('hide');
            $('#loginModal').modal('show');
        });
        // $("#propertyForm").validate({
        //     rules: {
        //         apartment_name: "required",
        //         city: "required",
        //         state_id: "required",
        //     },
        //     messages: {
        //         apartment_name: " Please enter your Apartment Name", 
        //         city: "Please enter your apartment City Name", 
        //         state_id:  "Please enter your apartment State", 
        //     }
        // });

        $("#propertyForm").submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('frontend.add-property') }}",
                type: 'POST',
                data: {
                    user_id: $('#consumerPropertyId').val(),
                    apartment_name: $("#consumerPropertyApartment").val(),
                    property_management_name: $("#consumerPropertyManagement").val(),
                    city: $('#consumerPropertyCity').val(),
                    zip_code: $("#consumerPropertyCode").val(),
                    state_id: $('#consumerPropertyState').val(),
                },
                success: function(result) {
                    console.log(result);
                    if (result.status == 1) {
                        $("#propertyModal").modal('hide');
                        $("#Join-Today").modal('hide');
                        $("#thanksmodal").modal('show');
                        $("#thanks_message1").html(result.message1);
                        $("#thanks_message2").html(result.message2);
                        //$('#Join-Today').find('form').trigger('reset');
                        $('#propertyModal').find('form').trigger('reset');
                    } else if (result.status == 0) {
                        $("#propertyModal").modal('show');
                    } else if (result.status == 9) {
                        $("#propertyModal").modal('show');
                        $("#apartmentError").css('color', 'red').html(
                            'Please enter your Apartment Name with city and state to submit your request. Our team will reach out to your property manager to be added to the Gimmzi Network.'
                        );
                    }
                }
            });

        })
    });

    $(document).on('click', '.browserProvider', function() {
        // console.log($(this).children('h4.community_name').text());
        if ($(this).children('h4.community_name').text() == 'Apartment Community') {
            $(".provider_logo").attr('src', "{{ asset('frontend_assets/images/logo-apartment.png') }}");
            $(".brows-btn").text('Browse for an Apartment');
            $(".brows-btn").attr('href', "{{ route('frontend.apartment.list') }}");
            $(".provider_title").text('Log in to the property manager portal');
        }
        if ($(this).children('h4.community_name').text() == 'Travel and Tourism') {
            $(".provider_logo").attr('src', "{{ asset('frontend_assets/images/logo-travel-tourism.jpeg') }}");
            $(".brows-btn").text('Browse for Travel and Tourism');
            $(".brows-btn").attr('href', "{{ route('frontend.travel-tourism.list') }}");
            $(".provider_title").text('Travel and Tourism Provider Portal Access');
        }
        $("#exampleModal").modal('show');
    });

    $(document).on('click', '.caret_dwn', function() {
        if ($(".provider_type_lstng").css('display') == 'none') {
            $(".provider_type_lstng").css('display', 'block');
        } else {
            $(".provider_type_lstng").css('display', 'none');
        }

    })
    $(document).on('click', '.portalName', function() {
        //console.log($(this).text());
        $("#provider_user_type").val($(this).text());
        $("#nav-home-tab").children('span.tab_ttle').text($(this).text());
        $(".provider_type_lstng").css('display', 'none');
    });

</script>
@stack('scripts')
</body>

</html>
