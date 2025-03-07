<x-layouts.business-signup-layout title="Create Your Business User Login">
    @push('style')
        <style>
            .points_add_modal .modal-content h5 {
                font-style: normal;
                font-weight: 600;
                font-size: 28px;
                line-height: 26px;
                text-align: center;
                letter-spacing: 0.01em;
                text-transform: capitalize;
                color: #FFFFFF;
                margin-bottom: 11px;
            }
        </style>
    @endpush

    <livewire:frontend.merchant.business-registration/>

    {{-- <header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m">
                <a class="navbar-brand" href="{{ route('frontend.business_owner.index') }}"><img
                        src="{{ asset('frontend_assets/images/logo-marchant.png') }}" /></a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication">
                        <li class="header_close_btn"> <a href="{{ route('frontend.business_owner.close_button') }}">
                                Close</a> </li>
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    </header> --}}
    {{-- <div class="wizard-body">
        <div class="container">
            <div class="row">


                <div class="col-lg-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"> </div>
                                    <div>
                                        <h6>Step One</h6>
                                        <p>Create your user login and tell us about your business</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"></div>
                                    <div>
                                        <h6>Step Two</h6>
                                        <p>Upload your company logo and photos so your business can stand out</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"></div>
                                    <div>
                                        <h6>Step Three</h6>
                                        <p>Create first deal using Deal Wizard</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"></div>
                                    <div>
                                        <h6>Step Four</h6>
                                        <p>Choose and activate plan. Access profile on vour new Business Profile Page
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn" style="background: #93DA42;">My
                                Business Profile Page</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="right_box_section create_user_box_sec">
                        <div class="heading_sec">
                            <h1>Create Your Business User Login</h1>
                        </div>
                        <div class="form-section headline-sec">
                            <h6> Your Contact Details </h6>
                            <p>Tell us how can Smart Rewards Team reach you</p>
                            {{ Form::open(['route' => 'frontend.business_owner.login.create', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}

                            <div class="row">
                                
                                <div class="col-md-12 form_mid_crt_acc">
									<div class="row">
                                        <div class="col-md-6 margin-top">
                                            <input type="text" placeholder="First & Last Name*" name="name"
                                                value="{{ old('name') }}" />
                                            @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 margin-top">
                                            <input type="text" placeholder="Preferred Email*" name="email"
                                                value="{{ old('email') }}" />
                                            @if ($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                       
                                        <div class="col-md-6 margin-top">
                                            <input type="text" placeholder="Preferred Phone*"
                                                onkeypress="return isNumber(event);" value="{{ old('phone') }}"
                                                name="phone" />
                                            @if ($errors->has('phone'))
                                                <div class="error">{{ $errors->first('phone') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 margin-top">
                                            <input type="text" placeholder="Phone Ext" name="phone_ext"
                                                value="{{ old('phone_ext') }}" />
                                            @if ($errors->has('phone_ext'))
                                                <div class="error">{{ $errors->first('phone_ext') }}</div>
                                            @endif
                                        </div>
                                        
                                
                                    </div>
                                </div>
                                
                                <div class="col-md-12 margin-top">
                                    <div class="custom-checkbox">

                                        <input type="checkbox" name="mail_receive" <?php if (old('mail_receive') == 'on') {
                                            echo 'checked';
                                        } ?> />
                                        <p> Yes, I want to receive Gimmzi emails on the latest merchant news, events,
                                            and products, I can unsubcribe at any time. </p>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 margin-top">
                                    <div class="btn_section btn-box">
                                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                                            <div>
                                                <button class="btn next_btn">Next</button>
                                            </div>
                                            <h6>Profile Completion :<span>0%</span> </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <div class="modal fade points_add_modal"id="success_reg" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <h5>Email Sent</h5>
                        <?php 
                        //Session::forget('merchant_id');
                        if (Session::has('merchant_id')) {
                                $user = DB::table('users')->find(Session::get('merchant_id'));
                                $userEmail = $user->email;
                                $userName = $user->first_name.' '. $user->last_name;
                            } else {
                                $userEmail = '';
                                $userName = '';
                            } ?>
                        <h6>To: {{$userName}} ({{ $userEmail }}) </h6>
                        <p>Check your email and use the link provided to validate and retrieve your user login.
                            Then use our guided <b>Deal Wizard</b> to create smart rewards deals.</p>
                        <br />
                        <p>Be sure to double-check your spam folder if you didn't receive this email</p>
                    </div>
                   
                    <button type="button" class="btn close_btn" onclick="window.location='{{ url('validate-business-account') }}'"
                        data-bs-dismiss="modal"aria-label="Close">Close</button>

                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#success_reg').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                @if (!empty(Session::get('succes_merchant_reg')))

                    $(document).ready(function() {
                        console.log('hello');
                        $('#success_reg').modal('toggle');
                    });
                @endif

                

            });
            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
        </script>
    @endpush --}}


</x-layouts.business-signup-layout>
