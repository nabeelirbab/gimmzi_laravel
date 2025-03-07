<x-layouts.explore-layout title="Explore">
    <div class="explore-new-banner cmn-gap">
        <div class="container">
            <div class="row rowspan">
                <div class="col-md-7">
                    <div class="explore-new-banner-lft">
                        <h1 class="h1-title">{{ $page->title ?? '' }}</h1>
                        <h2 class="h2-title">{{ $page->subtitle ?? '' }}</h2>
                        {!! $page->content ?? '--' !!}
                        <a href="{{ route('frontend.travel-tourism.list') }}" class="explore-btn">Browse Travel Partners
                            <span>
                                <img loading="lazy" src="{{ asset('frontend_assets/images/btnarws.svg') }}"
                                    alt="">
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="explore-slider">
                        <div class="explore-item">
                            <div class="explore-box">
                                    {{-- <video src="{{  asset($page->slide_one) }}" controls muted></video> --}}
                                <iframe width="560" height="315" src="{{  asset($page->slide_one) }}&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                            </div>
                        </div>
                        <div class="explore-item">
                            <div class="explore-box">
                                <iframe width="560" height="315" src="{{  asset($page->slide_two) }}&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    {{-- <video src="{{  asset($page->slide_two) }}" controls muted></video> --}}
                            </div>
                        </div>
                        <div class="explore-item">
                            <div class="explore-box">
                                {{-- <video src="{{  asset($page->slide_three) }}" controls muted></video> --}}
                                <iframe width="560" height="315" src="{{  asset($page->slide_three) }}&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="features-sectionss">
        <div class="container">
            <div class="new-features-slider">
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t1.svg') }}" alt="food iamge">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find a Place to Eat</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t2.svg') }}"
                                    alt="dessert image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find a Place For Dessert</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t3.svg') }}" alt="fun image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find a Place to Have Fun</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t4.svg') }}"
                                    alt="attractions image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find Local Attractions</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t5.svg') }}"
                                    alt="wellness image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find Health and Wellness</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t6.svg') }}"
                                    alt="store image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find Retail Stores</a>
                        </div>
                    </div>
                </div>
                <div class="new-features-item">
                    <div class="new-features-box">
                        <i class="new-features-icon">
                            <a href="javascript:void(0)">
                                <img loading="lazy" src="{{ asset('frontend_assets/images/t7.svg') }}"
                                    alt="shop image">
                            </a>
                        </i>
                        <div class="features-head">
                            <a href="javascript:void(0)">Find Automotive Shops</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Deasl Listing page Copmponent --}}
    @livewire('frontend.deal-listing')


    {{-- start provider Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-sec">

                    <div class="modal-cancel">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                                src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                                class="cancell-one11"></button>

                    </div>
                    <div class="modal-body">
                        <div class="modal-heading">
                            <img src="{{ asset('frontend_assets/images/logo-apartment.png') }}"
                                class="logo-img provider_logo">
                        </div>
                        <div class="modal-inner-heading">
                            <h2>What would you like to do?</h2>
                        </div>
                        <div class="modal-button-sec">
                            <a href="{{ route('frontend.apartment.list') }}" class="brows-btn"
                                target="_blank">Browse
                                for an
                                Apartment</a>
                            <button class="reward-btn" id="login_smart_account">Log in to my smart rewards
                                account</button>
                            <button class="reward-btn provider_title" id="login_property_manager">Log in to the
                                property
                                manager
                                portal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end provider Modal --}}


    <div class="modal prrprty_tab_mdl fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal"
        aria-hidden="true">
        <div class="modal-dialog homemodal">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
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

    <div class="modal fade" id="forgetpasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog homemodal">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="property-manager property-manager-con">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <form id="forgetpassword">
                                    <div class="email-text-one">
                                        <input type="email" placeholder="Email" id="consumer_email"
                                            name="consumer_email" required />
                                    </div>
                                    <span id="linksent"></span>
                                    <div class="login-top-one1">
                                        <button class="login-button-one" type="submit">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resetpasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog homemodal">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> <img
                            src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="property-manager property-manager-con">

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <form id="resetpassword">
                                    <div class="email-text-one">
                                        <input type="password" placeholder="New Password" id="new_password"
                                            name="new_password" required />
                                    </div>
                                    <div class="email-text-one">
                                        <input type="password" placeholder="Confirm Password" id="confirm_password"
                                            name="confirm_password" required />
                                    </div>
                                    <input type="hidden" name="user_token" id="user_token">
                                    <span id="resetpasswordmessage"></span>
                                    <div class="login-top-one1">
                                        <button class="login-button-one" type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Join-Today" tabindex="-1" aria-labelledby="Join-TodayLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close join-today-close" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Complete the below. We will keep you updated on the
                        status.
                    </p>
                    <div class="main-form">
                        <form id="signup-step1" method="post" action="">
                            <div class="row">
                                <div class="col-sm-6 form-select1">
                                    <input type="text" name="first_name" placeholder="First name"
                                        id="first_name" />

                                    <span class="error"></span>
                                </div>

                                <div class="col-sm-6 form-select1">
                                    <input type="text" name="last_name" id="last_name" placeholder="Last name" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-select1">
                                    <input type="text" name="email" id="email" placeholder="email" />
                                    <span id="sameemailerror"></span>
                                </div>

                                <div class="col-sm-6 form-select1">
                                    <input type="text" name="phone" id="phone" placeholder="phone" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-select1">
                                    <input type="text" name="zip_code" id="zip_code"
                                        onkeypress="return isNumber(event);" placeholder="zip code" />
                                </div>

                                <div class="col-sm-4 form-select1">
                                    <input type="text" name="city" id="city" placeholder="City" />
                                </div>
                                <div class="col-sm-4 form-select1">
                                    <select name="state" id="state" class="p-top-space">
                                        <option value=""disabled selected>State</option>
                                        @foreach ($states as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="unit_incorrect_count">
                            <div class="row">
                                <div class="col-sm-12 birthday-optional-text1">
                                    Birthday (Optional)
                                </div>
                                <div class="col-sm-4 form-select1">
                                    <select name="birth_month" id="birth_month">
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
                                    <select name="birth_day" id="birth_day">
                                        <option value=""disabled selected>Day</option>
                                        @foreach ($day as $dayvalue)
                                            <option value="{{ $dayvalue['value'] }}">{{ $dayvalue['number'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4 form-select1">
                                    <select name="birth_year" id="birth_year">
                                        <option value=""disabled selected>Year</option>
                                        @foreach ($year as $yearvalue)
                                            <option value="{{ $yearvalue['value'] }}">{{ $yearvalue['number'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12 birthday-optional-text1">
                                    Receive additional points and deals on your birthday. We wanna
                                    celebrate with you!
                                </div>
                                <div class="col-sm-12 birthday-optional-text2">
                                    <p>Do you Live in an Apartment?
                                        <input type="radio" name="lives_an_apartment" id="lives_an_apartment"
                                            value="yes" /> Yes
                                        <input type="radio" name="lives_an_apartment" id="lives_an_apartment"
                                            value="no" /> No
                                    </p>
                                    <span id=""></span>
                                </div>
                                <div class="col-sm-12 birthday-optional-text2 apartmenttext" style="display:none;">
                                    See List below to see if your apartment is a part of the Gimmzi
                                    Smart Rewards Network
                                </div>

                                <div class="col-sm-12 form-select1 mb-2 mt-2 apartmentlist" style="display:none;">
                                    <select id="provider_id" name="provider_id">
                                        <option value="" selected disabled>Select Apartment</option>
                                        <option value="add_new">No, My Apartment is not Included in this list</option>

                                        @if ($provider)
                                            @foreach ($provider as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }},
                                                    {{ $data->address }}, {{ $data->city }},
                                                    {{ $data->states->name }}, {{ $data->zip_code }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <input type="hidden" id="get_link">
                                <div class="col-sm-12 birthday-optional-text2" id="congratulationshow"
                                    style="display:none;">
                                    <h2>Congratulations!</h2>
                                    <p>It looks like you have already earned your resident badge with a Gimmzi
                                        Provider</p>
                                    <p>Please confirm the address information below is accurate by entering your
                                        unit number</p>
                                </div>
                                <div class="col-sm-12 birthday-optional-text2 " id="unitaddress"
                                    style="display:none;">
                                    <p id="propertyText" style="font-style: oblique;font-weight: 900;"></p>
                                    <p id="unitText" style="font-style: oblique;font-weight: 900;"></p>

                                    <input type="text" placeholder="Enter Unit Number To Confirm"
                                        class="form-control" id="unit_one_name" name="unit_one_name">
                                    <span id="unitnameerror"></span>
                                </div>

                                <input type="hidden" id="get_link_2">
                                <div class="col-sm-12 birthday-optional-text2" id="congratulationshow2"
                                    style="display:none;">
                                    <h2>Congratulations!</h2>
                                    <p>It looks like you have already earned your resident badge with a Gimmzi
                                        Provider</p>
                                    <p>Please confirm the address information below is accurate by entering your
                                        unit number</p>
                                </div>
                                <div class="col-sm-12 birthday-optional-text2 " id="unitaddress2"
                                    style="display:none;">
                                    <p id="propertyText2" style="font-style: oblique;font-weight: 900;"></p>
                                    <p id="unitText2" style="font-style: oblique;font-weight: 900;"></p>
                                    <input type="text" placeholder="Enter Unit Number To Confirm"
                                        class="form-control" id="unit_two_name" name="unit_two_name">
                                    <span id="unitnameerror"></span>
                                </div>

                                <span id="signup1error"></span>
                                <div class="col-sm-4 login-top-one1">
                                    <button class="login-button-one" type="submit" name="stepone"
                                        id="signupstep1">Confirm Now</button>
                                </div>
                                <div class="col-sm-4 login-top-one1">
                                    <button class="login-button-one" type="button" name="stepone"
                                        id="signupstep1">Confirm Later</button>
                                </div>
                                <div class="col-sm-4 login-top-one1">
                                    <button class="btn_table_s rdd login-button-one" type="button" name="stepone"
                                        id="dismissaccount" style="line-height: 20px; !important">Dismiss</button>
                                </div>
                                <div class="already-text-one4">Already a Smart Rewards Member ?
                                    <a href="#">Log In</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- New regisration modal start --}}

    @if (Session::has('register_data'))
        <div class="modal fade new_registration_badge_modal" id="new-registration-modal" tabindex="-1"
            aria-labelledby="new-registration-modalLabel" aria-hidden="true">
            <div class="modal-dialog homemodal modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close new-registration-modal-close" aria-label="Close">
                            <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                                class="cancell-one11"></button>
                        <div class="mt-5 mb-3 popup-logo">

                            <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                        </div>
                        <p class="by-continue-text">Claim your {{ $register_data['sort_term_name'] }} badge to unlock
                            special deals and discounts in the local area
                        </p>
                        <div class="main-form">
                            <form id="new_registration_submit" method="post" action="">
                                <div class="row">
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Your email address <span>*</span></label>
                                        <input type="text" disabled value="{{ $register_data['email'] }}"
                                            name="email_address" placeholder="" id="consumer_email_address" />

                                        <span class="error"></span>
                                    </div>

                                    <div class="col-sm-12 form-select1">
                                        <label for="">Your booking dates <span>*</span></label>
                                        <input type="text" disabled value="{{ $register_data['booking_date'] }}"
                                            name="booking_date" placeholder="" id="booking_date" />

                                        <span class="error"></span>
                                    </div>
                                    <div class="registration_input">
                                        <div class="col-sm-12 form-select1">
                                            <label for="">First Name <span>*</span></label>
                                            <input type="text" name="consumer_first_name" placeholder="First name"
                                                id="consumer_first_name" />

                                            <span class="error"></span>
                                        </div>

                                        <div class="col-sm-12 form-select1">
                                            <label for="">Last Name <span>*</span></label>
                                            <input type="text" name="consumer_last_name" id="consumer_last_name"
                                                placeholder="Last name" />
                                        </div>
                                        <div class="col-sm-12 form-select1">
                                            <label for="">Phone Number <span>*</span></label>
                                            <input type="text" name="consumer_phone" id="consumer_phone"
                                                placeholder="Phone Number" />
                                        </div>

                                        <div class="col-sm-12 birthday-optional-text1">
                                            Birthday (Optional)
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 form-select1">
                                                <select name="consumer_birth_month" id="consumer_birth_month">
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
                                                <select name="consumer_birth_day" id="consumer_birth_day">
                                                    <option value=""disabled selected>Day</option>
                                                    @foreach ($day as $dayvalue)
                                                        <option value="{{ $dayvalue['value'] }}">
                                                            {{ $dayvalue['number'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4 form-select1">
                                                <select name="consumer_birth_year" id="consumer_birth_year">
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
                                        <span id="signup2error"></span>

                                        <div class="col-sm-12 login-top-one1">
                                            <button class="reg_btn login-button-one" type="submit" name="stepone"
                                                id="signupstep1">Claim Gimmzi Badge</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 login-top-one1 next-btn">
                                        <button class="reg_btn login-button-one" type="button" name="stepone"
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
    @endif

    {{-- New regisration modal End --}}

    <div class="modal fade" id="contactmodal" tabindex="-1" aria-labelledby="contactmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="active-contain-top">
                        <button type="button" class="btn-close cancelregistration">
                            <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                                class="cancell-one11"></button>
                        <div class="text-center mt-4 mb-4 popup-logo">
                            <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                        </div>
                    </div>
                    <div class="active-text1">
                        <h2>To Activate Your Resident Badge</h2>
                    </div>
                    <div class="contact-provider-main">
                        <h2 id="providername"></h2>
                        <p id="alertprovider"></p>
                        <p>Once you receive it, Simply go to Badges in your Smart Rewards account.
                            Enter the correct access code and number to activate the Resident Badge.
                        </p>
                        <input type="hidden" id="consumerid" name="consumerid">
                        <div class="continue-button">
                            <button class="cancelregistration">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unitmodal" tabindex="-1" aria-labelledby="unitmodalLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="active-contain-main main-form" style="display:block">
                        <div class="active-contain-top">
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"> <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                                    class="cancell-one11"></button> --}}
                            <div class="text-center mt-4 mb-4 popup-logo">

                                <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                            </div>
                        </div>
                        <div class="active-text1">
                            <h2>To Activate Your Resident Badge</h2>
                            <p>Find <?php echo strtolower('the activation email or text that was sent to you by your apartment and enter your access code and unit number below.'); ?>
                                If <?php echo strtolower('you did not yet receive it or cannot locate it, please contact your apartment office to resend the invite.'); ?></p>
                        </div>
                        <form id="signup-step2" method="post" action="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="position-relative enter-acess-code-text1">
                                        Enter Access code
                                        <input type="text" class="enter-code-1" name="access_code"
                                            id="access_code">
                                        <!-- <img class="unit-img-one" src="{{ asset('frontend_assets/images/unit-code-bg.svg') }}" /> -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="position-relative enter-acess-code-text1">
                                        Enter Unit Number
                                        <input type="text" class="enter-code-1" name="unit" id="unit">
                                        <!-- <img class="unit-img-one" src="{{ asset('frontend_assets/images/unit-code-bg.svg') }}" /> -->
                                    </div>
                                </div>
                                <input type="hidden" id="unit_incorrect_count2">
                            </div>
                            <input type="hidden" name="consumerid" id="consumerid">
                            <input type="hidden" name="password" id="password">
                            <input type="hidden" name="property_id" id="property_id">
                            <span id="unitaccesserror"></span>
                            <div class="complete-text-one">
                                <button class="login-button-one" type="submit" name="steptwo"
                                    id="signupstep2">Complete</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="propertyModal" tabindex="-1" aria-labelledby="contactmodalLabel"
        aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="we-want-con main-form">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                                class="cancell-one11"></button>
                        <div class="text-center mt-4 mb-4 popup-logo">

                            <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                        </div>
                        <p class="by-continue-text">We want to get your apartment community added to the Gimmzi Smart
                            Rewards Provider Network. You can earn up to 500+ extra points a month by simply being a
                            tenant at a community that is on our network.
                        </p>
                        <p class="by-continue-text">Complete the below. We will keep you updated on the status.</p>
                        <form id="propertyForm" method="post">
                            <div class="row we-want-text1">
                                <div class="col-sm-6">
                                    <label>Apartment Name</label>
                                    <input type="text" name="apartment_name" id="consumerPropertyApartment" />
                                    <div id="list"></div>
                                </div>

                                <div class="col-sm-3">
                                    <label>City</label>
                                    <input type="text" name="apartment_city" id="consumerPropertyCity"
                                        placeholder="" readonly />
                                </div>

                                <div class="col-sm-3 form-select1">
                                    <label>State</label>
                                    <select name="apartment_state" id="consumerPropertyState" class="p-top-space"
                                        readonly>
                                        <option value=""disabled selected>State</option>
                                        @foreach ($states as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row we-want-text1">
                                <div class="col-sm-9 mt-2">
                                    <label>Property Management Name</label>
                                    <input type="text" name="property_management_name"
                                        id="consumerPropertyManagement" placeholder="" />
                                </div>
                                <div class="col-sm-3 mt-2">
                                    <label>Zip Code</label>
                                    <input type="text" name="apartment_zipcode" id="consumerPropertyCode"
                                        placeholder="" readonly />
                                    <input type="hidden" name="apartment_user" id="consumerPropertyId"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 in-house-property-text2">
                                    <input type="checkbox" class="form-check-input" id="same_apartment" /> In house
                                    property management (Same
                                    as Apartment
                                    Name)
                                </div>
                            </div>
                            <span id="apartmentError"></span>
                            <div class="next-main">
                                <button class="login-button-one" type="submit">Next</button>
                            </div>
                        </form>
                        <p class="all-ready-text1">Already a Smart Rewards Member ? <a href="#"
                                id="memberLogin">Log
                                In</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Reset of Forget password modal --}}
    <div class="modal fade merchent-main-madal" id="resetpasswordModal" tabindex="-1"
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
    </div>

</x-layouts.explore-layout>
