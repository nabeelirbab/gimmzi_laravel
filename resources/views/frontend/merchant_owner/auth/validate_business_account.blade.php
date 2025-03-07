<x-layouts.frontend-layout title="Create Your Business User Login">
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
    <header class="main-head">
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
    </header>
    <div class="wizard-body">
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
                            <button class="deal_btn btn" style="background: #93DA42;">My Business Profile Page</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="right_box_section create_user_box_sec">
                        <div class="heading_sec">
                            <h1>Create Your Business User Login</h1>
                            <h4><strong>Your Username:</strong> {{$user->email}}</h4>
                        </div>
                        <div class="form-section headline-sec">
                            <h6> Your Contact Details </h6>
                            <p>Tell us how can Smart Rewards Team reach you</p>
                            {{ Form::open(['route' => 'frontend.business_owner.save_business_validation','files' => true, 'method' => 'POST', 'class' => 'kt-form ']) }}
                           
                            <div class="row">
                                <div class="col-md-12 form_top_crt_acc validateArea" >
                                    <div class="row">
                                        <div class="col-md-4 margin-top">
                                            <input type="text" placeholder="Enter Validation Code" name= "validation_code" value="{{old('validation_code')}}" > 
                                            @if ($errors->has('validation_code'))
                                              <div class="error" style="color:red;">{{ $errors->first('validation_code') }}</div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-4 margin-top">
                                            <input type="password" placeholder="New Password" name= "new_password" value="{{old('new_password')}}" > 
                                            @if ($errors->has('new_password'))
                                              <div class="error" style="color:red;">{{ $errors->first('new_password') }}</div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-4 margin-top">
                                            <input type="password" placeholder="Confirm Password" name= "confirm_password" value="{{old('confirm_password')}}" >
                                            @if ($errors->has('confirm_password'))
                                              <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                            @endif
                                        </div>
                                       
                                    </div>
								</div>
                                <div class="col-md-12 form_mid_crt_acc">
									<div class="row">
                                        <div class="col-md-4 margin-top">
                                            <input type="text" placeholder="First & Last Name*" name="name"
                                                value="{{$user->full_name}}" disabled/>
                                            
                                        </div>
                                        <div class="col-md-4 margin-top">
                                            <input type="text" placeholder="Preferred Email*" name="email"
                                                value="{{$user->email}}" disabled/>
                                           
                                        </div>
                                        <div class="col-md-4 margin-top">
                                            <select name="merchant_title_id" id="merchant_title_id">
                                                <option selected disabled>Select Your Title</option>
                                                @if($merchant_titles)
                                                    @foreach($merchant_titles as $data)
                                                <option value="{{$data->id}}"<?php if (old('merchant_title_id') == $data->id) {
                                                            echo 'selected';
                                                        } ?>>{{$data->business_title}}</option>
                                                    @endforeach
                                                    <option value="not_owner"<?php if (old('merchant_title_id') == 'not_owner') {
                                                            echo 'selected';
                                                        } ?>>Above Regional Manager but not Owner</option>
                                                @endif
                                                
                                            </select> 
                                            @if ($errors->has('merchant_title_id'))
                                                <div class="error" style="color:red;">{{ $errors->first('merchant_title_id') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 margin-top">
                                            <input type="text" placeholder="Preferred Phone*" value="{{$user->phone}}"
                                                name="phone" disabled/>
                                        </div>
                                        <div class="col-md-4 margin-top">
                                            <input type="text" placeholder="Phone Ext" name="phone_ext"
                                                value="{{$user->phone_ext}}"  disabled/>
                                        </div>
                                        @if ($errors->has('official_title'))
                                        <div class="col-md-4 margin-top official_title_div" style="display:block;">
                                            <input type="text" placeholder="Type Your Official Title Here" value="{{old('official_title')}}" name="official_title" /> 
                                        @if ($errors->has('official_title'))
                                            <div class="error" style="color:red;">{{ $errors->first('official_title') }}</div>
                                        @endif
                                        </div>
                                        @else
                                        <div class="col-md-4 margin-top official_title_div" style="display:none;">
                                            <input type="text" placeholder="Type Your Official Title Here"  value="{{old('official_title')}}" name="official_title" /> 
                                        @if ($errors->has('official_title'))
                                            <div class="error" style="color:red;">{{ $errors->first('official_title') }}</div>
                                        @endif
                                        </div>
                                        @endif

                                        
                                    </div>
                                </div>
                                <div class="col-md-12 form_end_crt_acc">
                                    <h5>Business Verification</h5>
                                    <p>Upload a copy of documentation that verifies your connection to this company. For example, an employee ID card, business license, or TIN Letter.</p>
                                    <input type="file" id="files" name="verification_file" >
								</div>
                                @if ($errors->has('verification_file'))
                                    <div class="error" style="color:red;">{{ $errors->first('verification_file') }}</div>
                                @endif
                                <div class="col-md-12 margin-top">
                                    <div class="custom-checkbox">
                                        <input type="checkbox" name="not_verified" id="not_verified"<?php if(old('not_verified') == 'on'){echo 'checked';}?>/>
                                        <p> <b>I do not have the documentation to verify right now.</b> <br>
                                            Verification is required to complete account activation. <br>
                                            Pending verification statuses will expire and delete in 45 days.
                                        </p>
                                    </div>
                                    @if ($errors->has('not_verified'))
                                            <div class="error" style="color:red;">{{ $errors->first('not_verified') }}</div>
                                    @endif
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
  
    @push('scripts')
        <script>
            $(document).ready(function() {
              $(document).on('change','#merchant_title_id',function(){
                var titleid = $('#merchant_title_id').val();
                if(titleid == 'not_owner'){
                    $(".official_title_div").show();
                }
                else{
                    $(".official_title_div").hide();
                }
               
              })

               

            });
        </script>
    @endpush
</x-layouts.frontend-layout>
