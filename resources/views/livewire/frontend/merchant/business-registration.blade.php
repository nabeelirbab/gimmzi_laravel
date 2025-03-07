<div>
    <div class="cus_page_cont cmn_gap">
        <div class="container">
            <div class="cus_page_row">
                <div class="cus_sidebar_col">
                    <div class="cus_sidebar">
                        <ul>
                            <li class="completed">
                                <div class="icon_wrap"><img src="{{asset('frontend_assets/images/step-one-icon-d.svg')}}" alt="step icon"></div>
                                <div class="content_wrap">
                                    <span>Step one</span>
                                    <p>Create your user login and tell
                                        us about your business</p>
                                </div>
                            </li>
                            <li class="active">
                                <div class="icon_wrap"><img src="{{asset('frontend_assets/images/step-two-icon-d.svg')}}" alt="step icon"></div>
                                <div class="content_wrap">
                                    <span>Step two</span>
                                    <p>Upload your company logo and photos so your business can stand out</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon_wrap"><img src="{{asset('frontend_assets/images/step-three-d.svg')}}" alt="step icon"></div>
                                <div class="content_wrap">
                                    <span>Step three</span>
                                    <p>Add locations and create deal and loyalty rewards program using Deal Wizard</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon_wrap"><img src="{{asset('frontend_assets/images/step-four-d.svg')}}" alt="step icon"></div>
                                <div class="content_wrap">
                                    <span>Step four</span>
                                    <p>Checkout to complete account
                                        setup. Access profile on your
                                        new Business Profile Page</p>
                                </div>
                            </li>
                        </ul>
                        <div class="btn_wrap">
                            <a href="#" class="cmn_theme_btn">My Business Profile Page</a>
                        </div>
                        <div class="prof_stats">
                            <span>Profile Completion</span>
                            <div class="circle_progress" data-value="{{$profile_complete_value}}">
                                <svg width="154" height="154" viewBox="0 0 154 154" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <circle cx="77" cy="77" r="71" stroke="#fff" opacity="1" stroke-width="10"></circle>
                                  <circle class="pr_cls1" cx="77" cy="77" r="71" stroke="currentColor" stroke-width="10"></circle>
                                </svg>
                                <span class="pr_text">{{$complete_percent}}%</span>
                              </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="cus_cont_bar_col"> --}}
                    @if($step1 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar step1">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Create Your Business User Login</h1>
                        </div>
                        <form wire:submit.prevent="personal_info_submit">
                            <div class="cus_cnt_body">
                                <h2 class="title_h3">Your Contact Details</h2>
                                <p>Tell us how can Smart Rewards Team reach you</p>
                                <div class="row fld_blk_gap_lw">
                                        <div class="col-md-6 fld_blk">
                                            <label>First & Last name <span class="ast">*</span></label>
                                            <input type="text" placeholder="Enter your first & last name" wire:model.defer="name">
                                            @error('name')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Preferred Email <span class="ast">*</span></label>
                                            <input type="email" placeholder="Enter your preferred email" wire:model.defer="email">
                                            @error('email')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Preferred Phone <span class="ast">*</span></label>
                                            <input type="text" placeholder="Enter your preferred phone" wire:model.defer="phone" onkeypress="return isNumber(event);">
                                            @error('phone')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Phone Ext </label>
                                            <input type="text" placeholder="Enter your phone Ext" wire:model.defer="phone_ext">
                                            @error('phone_ext')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 fld_blk_chk">
                                            <label> <input type="checkbox" wire:model.defer="mail_receive" checked> <span></span> Yes, I want to receive Gimmzi emails on the latest merchant news, events, and products, I can unsubcribe at any time.</label>
                                        </div>
                                </div>
                                
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    <button class="cmn_theme_btn">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    @endif

                    @if($step2 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar step2">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Create Your Business User Login</h1>
                            <h3>Your Username: {{$email}}</h3>
                        </div>
                        <form wire:submit.prevent="personal_contact_submit">
                            <div class="cus_cnt_body">
                                <h2 class="title_h3">Your Contact Details</h2>
                                <p>Tell us how can Smart Rewards Team reach you</p>
                                <div class="row fld_blk_gap_lw">
                                    <div class="row">
                                        <div class="col-md-6 fld_blk">
                                            <input type="text" placeholder="Enter Validation Code" wire:model.defer="validation_code" autocomplete="off">
                                            @if ($errors->has('validation_code'))
                                                <div class="error" style="coloe:red;">{{ $errors->first('validation_code') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-md-6 fld_blk"></div>
                                        <div class="col-md-6 fld_blk">
                                            <input type="password" placeholder="New Password" wire:model.defer="new_password" autocomplete="off">
                                            @if ($errors->has('new_password'))
                                                <div class="error" style="color:red;">{{ $errors->first('new_password') }}</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <input type="password" placeholder="Confirm Password " wire:model.defer="confirm_password" autocomplete="off">
                                            @if ($errors->has('confirm_password'))
                                                <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}</div>
                                            @endif
                                        </div>
                                    </div><br><br>
                                    <div  class="row">
                                        <div class="col-md-6 fld_blk">
                                            <label>First & Last name <span class="ast">*</span></label>
                                            <input type="text" placeholder="Enter your first & last name" wire:model.defer="name" readonly> 
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Preferred Email <span class="ast">*</span></label>
                                            <input type="email" placeholder="Enter your preferred email" wire:model.defer="email" readonly>
                                            
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Preferred Phone <span class="ast">*</span></label>
                                            <input type="text" placeholder="Enter your preferred phone" wire:model.defer="phone" readonly>
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Phone Ext </label>
                                            <input type="text" placeholder="Enter your phone Ext" wire:model.defer="phone_ext" readonly>
                                            {{-- @if ($errors->has('phone_ext'))
                                                <div class="error">{{ $errors->first('phone_ext') }}</div>
                                            @endif --}}
                                        </div>
                                        {{-- <div class="col-md-6 fld_blk">
                                            <select wire:model.defer="merchant_title_id"  wire:change="merchantTitleChange">
                                                <option selected disabled value=''>Select Your Title</option>
                                                @if($merchant_titles)
                                                    @foreach($merchant_titles as $index => $data)
                                                    <option value="{{$data->id}}" {{ $loop->first ? 'selected' : '' }}>{{$data->business_title}}</option>
                                                    @endforeach
                                                    <option value="not_owner">Above Regional Manager but not Owner</option>
                                                @endif
                                                
                                            </select> 
                                            @if ($errors->has('merchant_title_id'))
                                                    <div class="error" style="color:red;">{{ $errors->first('merchant_title_id') }}</div>
                                                @endif
                                        </div> --}}
                                        <div class="col-md-6 fld_blk">
                                            <select wire:model.defer="merchant_title_id" wire:change="merchantTitleChange">
                                                <option disabled value=''>Select Your Title</option>
                                                @if($merchant_titles)
                                                    @foreach($merchant_titles as $index => $data)
                                                        <option value="{{ $data->id }}" 
                                                            {{ $loop->first && !$merchant_title_id ? 'selected' : '' }}>
                                                            {{ $data->business_title }}
                                                        </option>
                                                    @endforeach
                                                    <option value="not_owner">Above Regional Manager but not Owner</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('merchant_title_id'))
                                                <div class="error" style="color:red;">{{ $errors->first('merchant_title_id') }}</div>
                                            @endif
                                        </div>
                                        
                                        @if($offic_ttle_div == true)
                                            <div class="col-md-6 fld_blk">
                                                <input type="text" placeholder="Type Your Official Title Here" wire:model.defer="official_title" /> 
                                                @if ($errors->has('official_title'))
                                                    <div class="error" style="color:red;">{{ $errors->first('official_title') }}</div>
                                                @endif
                                            </div>
                                        
                                        @endif
                                        <div class="col-md-12 form_end_crt_acc">
                                            <h5>Business Verification</h5>
                                            <p>Upload a copy of documentation that verifies your connection to this company. For example, an employee ID card, business license, or TIN Letter.</p>
                                            {{-- <input type="file" id="files" name="verification_file" > --}}
                                            <input type="file" wire:model.defer="verification_file" id="file-up" class="file_up_input">
                                            <label for="file-up" class="file_up_label">
                                                @if($verification_file == '')
                                                    <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                                    <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                                    <span  class="file_up_text2">docx, pdf</span>
                                                @else
                                                    @if ($errors->has('verification_file'))
                                                        <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                                        <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                                        <span  class="file_up_text2">docx, pdf</span>
                                                    @else
                                                        <span class="file_up_icon"><img src="{{asset('frontend_assets/images/file.png')}}" alt="upload icon"></span>
                                                        <span style="color:rgb(9, 95, 35)">File Uploaded</span>
                                                    @endif
                                                @endif
                                                
                                            </label>
                                            @if ($errors->has('verification_file'))
                                                <div class="error" style="color:red;">{{ $errors->first('verification_file') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 margin-top">
                                        <div class="custom-checkbox">
                                            <p> <input type="checkbox"  wire:model.defer="not_verified"/>
                                             <b>I do not have the documentation to verify right now.</b> <br>
                                                Verification is required to complete account activation.
                                                Pending verification statuses will expire and delete in 45 days.
                                            </p>
                                        </div>
                                        @if ($errors->has('not_verified'))
                                                <div class="error" style="color:red;">{{ $errors->first('not_verified') }}</div>
                                        @endif
                                    </div>
                                    {{-- @dd($offic_ttle_div) --}}
                                   
                                </div>
                                
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    <button class="cmn_theme_btn">Next</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    @endif

                    @if($step3 == true)  
                    <div class="cus_cont_bar_col">    
                    <div class="cus_cont_bar">
                        {{-- <div class="cus_cnt_hd">
                            <h1 class="title_h1">Create Your Business User Login</h1>
                            <h3>Your Username: {{$email}}</h3>
                        </div>
                        step three --}}
                        <div class="cus_cnt_body">
                            <div class="col-sm-12">
                                <div class="right_box_section">
                                    <div class="heading_sec">
                                        <h1 style="text-align: center;">Select a Solution to get started</h1>
                                    </div>
                                    <div class="select-solution-sec">
                                        <div class="row">
                                            <div class="col-md-6" wire:click="solutionClick('localdeal')">
                                                <div class="solution-sec">
                                                    <img src="{{asset('frontend_assets/images/icon1.svg')}}">
                                                    <h2>Local Deals</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6" wire:click="solutionClick('traveldiscount')">
                                                <div class="solution-sec">
                                                    <img src="{{asset('frontend_assets/images/icon2.svg')}}">
                                                    <h2>Travel Discounts</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6" wire:click="solutionClick('liveevent')">
                                                <div class="solution-sec">
                                                    <img src="{{asset('frontend_assets/images/icon3.svg')}}">
                                                    <h2>Live Events</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6" wire:click="solutionClick('corporatedeal')">
                                                <div class="solution-sec">
                                                    <img src="{{asset('frontend_assets/images/icon4.svg')}}">
                                                    <h2>Corporate and<br> Franchise Deals</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <span id="typeerror"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    @endif

                    @if($step4 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar"> 
                        {{-- <div class="cus_cnt_hd">
                            <h1 class="title_h1">Create Your Business User Login</h1>
                        </div> --}}
                        <div class="cus_cnt_body">
                            <h2 class="title_h3">Let’s get your business profile started</h2>
                                <p>Tell us about your business</p>
                                <form wire:submit.prevent="business_profile_submit">
                            <div class="row">
                            
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <select class="select-business-category" wire:model.defer="business_type"
                                            id="business_type">
                                            <option value="" selected disabled> Select Business Type</option>
                                            <option value="Store Front">Store Front</option>
                                            <option value="Store Front and Online">Store Front and Online</option>
                                            <option value="Mobile Business">Mobile Business</option>
                                            <option value="Online Only" id="online_only">Online Only</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('business_type'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_type') }}</div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <select class="select-business-category" wire:model.defer="business_category_id"
                                            id="category_id"  wire:change="fetchSubcategories" >
                                            <option value="" selected disabled> Select Business Category
                                            </option>
                                            @if ($category)
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if ($errors->has('business_category_id'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_category_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <select class="select-business-category" wire:model.defer="service_type_id"
                                            id="service_id">
                                            <option value="" selected disabled> Select Service Type</option>
                                            @if ($services)
                                                @foreach ($services as $serv)
                                                    <option value="{{ $serv->id }}">{{ $serv->service_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if ($errors->has('service_type_id'))
                                        <div class="error" style="color:red;">{{ $errors->first('service_type_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <input type="text" placeholder="Business Name" class=""
                                        wire:model.defer="business_name" >
                                    </div>
                                    @if ($errors->has('business_name'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_name') }}</div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <input type="text" placeholder="Business Phone Number" class=""
                                            onkeypress="return isNumber(event);" wire:model.defer="business_phone">
                                    </div>
                                    @if ($errors->has('business_phone'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_phone') }}</div>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group business-profile-started-main-input">
                                        <input type="text" placeholder="Business Fax Number" class=""
                                        wire:model.defer="business_fax_number" onkeypress="return isNumber(event);">
                                    </div>
                                    @if ($errors->has('business_fax_number'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_fax_number') }}</div>
                                    @endif
                                </div>
                                <p>
                                <div class="col-12">
                                    <div class="form-group business-profile-started-main-input">
                                        <input type="email" placeholder="Business Email" class=""
                                        wire:model.defer="business_email">
                                    </div>
                                    @if ($errors->has('business_email'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_email') }}</div>
                                    @endif
                                </div>
                                <div class="col-lg-12 business-profile-started-main-input">
                                    <div class="form-group">
                                        <input type="text" placeholder="Business Website"
                                        wire:model.defer="business_page_link">
                                    </div>
                                    @if ($errors->has('business_page_link'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_page_link') }}</div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div
                                        class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                        <input type="checkbox" id="html" class="gimigi-checkbok"
                                        wire:model.defer="allow_notification"><p>
                                        <label for="html" class="gimmzi-will-use">Gimmzi will use your contact
                                            details
                                            to send you personalised email messages about the latest merchant news,
                                            events and products. If you do not wish to recive these messages, please
                                            check this box.</label>
                                    </div>

                                </div>
                                <p>
                                <div class="btn_section">
                                    <div class="pf-completion d-flex justify-content-between align-items-center">
                                        <div>
                                            {{-- <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepThree'>Back</a> --}}

                                                    <button class="cmn_theme_btn">Next</button>
                                               
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    @endif

                    @if($step5 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_body">
                            <h2 class="title_h3">Let’s get your business address added to your profile</h2>
                            <form wire:submit.prevent="business_address_submit">
                                <div class="row">
                                    @if($business_type == 'Online Only' || $business_type == 'Mobile Business')
                                        <div class="col-lg-12">
                                            <div
                                                class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                                <input type="checkbox" id="no_physical_address" class="gimigi-checkbok ifcheck"
                                                wire:model.live="no_physical_address" >
                                                <label for="no_physical_address" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">
                                                You selected mobile or online only as your business type on the previous screen. Checking this box, you confirm you do not have a physical business address. However a mailing address is required for all businesses.</label>
                                            </div>

                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                        
                                            <input type="text" placeholder="Street Address" class="business-address-input"  id="add_listing_address" wire:model.defer="street_address" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="initAutocomplete()" @if($no_physical_address == true) disabled @endif>
                                            {{-- <input type="text" placeholder="Street Address" class=""  id="add_listing_address" wire:model.defer="street_address"> --}}
                                            <input type="hidden" wire:model.defer="listing_location_latitude" id="listing_location_latitude">
                                            <input type="hidden" wire:model.defer="listing_location_longitude" id="listing_location_longitude">
                                        </div>
                                        @if ($errors->has('street_address'))
                                            <div class="error" style="color:red;">{{ $errors->first('street_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" class="business-address-input" placeholder="Zip Code" wire:model.defer="zip_code"
                                                id="zipCode" onkeypress="return isNumber(event);" @if($no_physical_address == true) disabled @endif>
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error" style="color:red;">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        {{-- <span id="ziperror"></span> --}}
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" class="business-address-input" placeholder="City" wire:model.defer="city" id="profilecity" @if($no_physical_address == true) disabled @endif>
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error" style="color:red;">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category business-address-input" wire:model.defer="state_id" id="profileState" @if($no_physical_address == true) disabled @endif>
                                                <option selected disabled value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" >
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error" style="color:red;">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    

                                    <div class="col-lg-12">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="same_address" class="gimigi-checkbok ifcheck"
                                            wire:model.defer="same_address" wire:click="toggleSameAddress">
                                            <label for="html" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">Same as address listed above</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Mailing Address" class=""
                                                id="mailingaddress" wire:model.defer="mailing_address" autocomplete="new-address" onfocus="disableAutocomplete(this)" 
                                                onkeyup="mailinitAutocomplete()">
                                        </div>
                                        @if ($errors->has('mailing_address'))
                                            <div class="error" style="color:red;">{{ $errors->first('mailing_address') }}</div>
                                        @endif

                                        <input type="hidden" wire:model.defer="mailing_listing_location_latitude" id="mailing_listing_location_latitude">
                                        <input type="hidden" wire:model.defer="mailing_listing_location_longitude" id="mailing_listing_location_longitude">
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" wire:model.defer="mailing_zip_code"
                                                id="mailing_zipCode">
                                        </div>
                                        @if ($errors->has('mailing_zip_code'))
                                            <div class="error" style="color:red;">{{ $errors->first('mailing_zip_code') }}</div>
                                        @endif
                                        {{-- <span id="mailziperror"></span> --}}
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" wire:model.defer="mailing_city"
                                                id="mailing_city">
                                        </div>
                                        @if ($errors->has('mailing_city'))
                                            <div class="error" style="color:red;">{{ $errors->first('mailing_city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" wire:model.defer="mailing_state_id"
                                                id="mailing_state_id">
                                                <option selected disabled value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}">
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('mailing_state_id'))
                                            <div class="error" style="color:red;">{{ $errors->first('mailing_state_id') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <p class="by-click-text">By clicking ‘Submit’, I confirm that I agree to
                                                the
                                                Smart Rentals Merchant <a>Terms of use</a>, and have read the <a>Privacy
                                                Statement</a>.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                            <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepFour'>Back</a>
                                            <button class="cmn_theme_btn">Next</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    @endif


                    @if($business_story == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_body">
                                <h1 style="text-align:center;">Business profile</h1>
                                <form wire:submit.prevent="business_story_submit">
                                    <h3 class="title_h3">Our Story Section</h3>
                                    <p style="color:#979595">
                                        Use this section to share your business journey to establish an even more meaningful connection with your customer. The more connected your customer is to your brand. The more likely they will want to buy your products and services, highlight the founders. your origin and what sets your business apart from the rest.
                                    </p>

                                    <div class="col-md-12 field-blk" wire:ignore>
                                        <textarea class="form-control" wire:model.defer="story_message" id="merchant_story" rows="5"></textarea>
                                    </div>
                                    @if ($errors->has('story_message'))
                                        <div class="error" style="color:red;">{{ $errors->first('story_message') }}</div>
                                    @endif
                                    <p></p>
                                    <h3 class="title_h3">Upload Photo of Team and/or Founders</h3>
                                    <div class="col-md-12 form_end_crt_acc">
                                        <input type="file" wire:model.defer="business_story_image" id="file-up" class="file_up_input">
                                        <label for="file-up" class="file_up_label">
                                            <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                            <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                            <span  class="file_up_text2">jpg, jpeg, png</span>
                                        </label>
                                        @if ($errors->has('business_story_image'))
                                        <div class="error" style="color:red;">{{ $errors->first('business_story_image') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 form_end_crt_acc">
                                        @if($business_story_image != '')
                                            <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$business_story_image->getFilename()) }}" alt="">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview" style="height:200px;border-radius: 5%;">
                                        @endif
                                    </div>
                                    <div class="cus_link_btn_cont">
                                        <a href="javascript:void(0);" class="theme_link_text" wire:click='skipStoryPhoto'>Skip This Step for later</a>
                                    </div>
                                    <p></p><p></p>

                                    <div class="col-12 ">
                                        <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepFive'>Back</a>
                                        <button type="submit" class="cmn_theme_btn">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($business_overview == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_body">
                                <h1 style="text-align:center;">Business profile</h1>
                                <form wire:submit.prevent="business_overview_submit">
                                    <h3 class="title_h3">Overview Section</h3>
                                    <p style="color:#979595">
                                        Introduce your business to potential customers! Share details about the products and services you offer. Highlight what sets your business apart and describe it as if you were speaking to a customer encountering it for the first time.
                                    </p>

                                    <div class="col-md-12 field-blk" id="business_o_id" wire:ignore>
                                        <textarea class="form-control" wire:model.defer="overview_message" id="b_overview" rows="5"></textarea>
                                    </div>
                                    
                                    {{-- <div class="col-md-6 form_end_crt_acc">
                                        @if($business_story_image != '')
                                            <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$business_story_image->getFilename()) }}" alt="">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview" style="height:200px;border-radius: 5%;">
                                        @endif
                                    </div> --}}
                                    {{-- <div class="cus_link_btn_cont">
                                        <a href="javascript:void(0);" class="theme_link_text" wire:click='skipStoryPhoto'>Skip This Step for later</a>
                                    </div> --}}
                                    <p></p><p></p>

                                    <div class="col-12 ">
                                        <a class="cmn_theme_btn bordered" wire:click.prevent='goToStory'>Back</a>
                                        <button class="cmn_theme_btn">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif



                    @if($step6 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_body">
                            <h2 class="title_h3">Upload Business Logo</h2>
                            <form wire:submit.prevent="business_photo_submit">
                            {{-- <div class="row"> --}}
                                <div class="col-md-12 form_end_crt_acc">
                                    <input type="file" wire:model.defer="business_logo" id="file-up" class="file_up_input">
                                    <label for="file-up" class="file_up_label">
                                        <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                        <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                        <span  class="file_up_text2">jpg, jpeg, png</span>
                                    </label>
                                    @if ($errors->has('business_logo'))
                                    <div class="error" style="color:red;">{{ $errors->first('business_logo') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form_end_crt_acc">
                                    @if($business_logo != '')
                                        <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$business_logo->getFilename()) }}" alt="">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview" style="height:200px;border-radius: 5%;">
                                    @endif
                                </div>
                                
                            {{-- </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-6 form_end_crt_acc">
                                    <input type="file" wire:model.defer="business_image" id="file-up" class="file_up_input">
                                    <label for="file-up" class="file_up_label">
                                        <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                        <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                        <span  class="file_up_text2">jpg, jpeg, png</span>
                                    </label>
                                    @if ($errors->has('business_image'))
                                    <div class="error" style="color:red;">{{ $errors->first('business_image') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form_end_crt_acc">
                                    @if($business_image != '')
                                        <img class='thumbnail1'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$business_image->getFilename()) }}" alt="">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview1" style="height:200px;border-radius: 5%;">
                                    @endif
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col-md-6 form_end_crt_acc">
                                    <input type="file" wire:model.defer="business_media" id="file-up" class="file_up_input">
                                    <label for="file-up" class="file_up_label">
                                        <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                        <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                        <span  class="file_up_text2">pm4, flv, mov, wmv</span>
                                    </label>
                                    @if ($errors->has('business_media'))
                                    <div class="error" style="color:red;">{{ $errors->first('business_media') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 form_end_crt_acc">
                                    @if($business_media != '')
                                        <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$business_media->getFilename()) }}" alt="">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview" style="height:200px;border-radius: 5%;">
                                    @endif
                                </div>
                            </div> --}}
                            <p></p>
                            <div class="col-12 ">
                                {{-- <a href="#" class="btn back-button-one11" wire:click="goToStepFive" style="color: white;">Back</a> --}}
                                {{-- <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepFive'>Back</a> --}}

                                {{-- <div class="cus_cnt_ft">
                                    <div class="cus_cnt_ft_lt"> --}}
                                        <button class="cmn_theme_btn">Next</button>
                                    {{-- </div>
                                </div> --}}
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                    @endif

                    @if($step7 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Deals & Loyalty Rewards Program</h1>
                        </div>
                        {{-- <form action="#"> --}}
                            <div class="cus_cnt_body">

                                <div class="lot_items">
                                    <div class="lot_item_list">
                                        <label>
                                            <input type="radio" name="loyalty" wire:click="deal_create">
                                            <img src="{{asset('frontend_assets/images/loyalty-bg1.png')}}" alt="">
                                        </label>
                                        <label>
                                            <input type="radio" name="loyalty" wire:click="loyalty_create">
                                            <img src="{{asset('frontend_assets/images/loyalty-bg2.png')}}" alt="">
                                            <span>(Gimmzi Boost Plan or higher)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="cus_link_btn_cont">
                                    {{-- <a href="#" class="theme_link_text">Skip this Step and have your Gimmzi Community Advocate complete for you</a> --}}
                                </div>
                            
                            
                            <p></p>
                            <div class="col-12 ">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepSix'>Back</a>
                                {{-- <button class="cmn_theme_btn">Next</button> --}}
                            </div>
                        </div>
                        {{-- </form> --}}
                    </div>
                    </div>
                    @endif

                    @if($loyalty_step == true)
                        <div class="cus_cont_bar_col">
                            <div class="cus_cont_bar">
                                <div class="cus_cnt_hd">
                                    <h1 class="title_h1">Upload Loyalty Reward Image</h1>
                                </div>
                                <form wire:submit.prevent="loyalty_step_submit">
                                    <div class="cus_cnt_body">
                                    <h2 class="title_h2">Upload Loyalty Image</h2>
                                    
                                        <input type="file" wire:model.defer="loyalty_image" id="file-up" class="file_up_input">
                                        <label for="file-up" class="file_up_label">
                                            <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                            <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                            <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                                        </label>

                                        @error('loyalty_image')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    
                                    <div class="cus_link_btn_cont">
                                        <a href="javascript:void(0);" class="theme_link_text" wire:click='skipLoyaltyPhoto'>Skip This Step for later</a>
                                    </div>
                                
                                    <div class="col-md-6 form_end_crt_acc">
                                        @if($loyalty_image != '')
                                            <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$loyalty_image->getFilename()) }}" alt="">
                                        @endif
                                    </div>
                                    <p></p>
                                    <div class="col-12 ">
                                        {{-- <a href="#" class="btn back-button-one11" wire:click="goToStepDealStep" style="color: white;">Back</a> --}}
                                        <a class="cmn_theme_btn bordered" wire:click.prevent='goToStep7'>Back</a>
        
                                        <button class="cmn_theme_btn">Next</button>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($loyalty_step1 == true)
                        <div class="cus_cont_bar_col">
                            <div class="cus_cont_bar">
                                <div class="cus_cnt_hd">
                                    <h1 class="title_h1">Enter Participating Location(s)</h1>
                                </div>
                                <form wire:submit.prevent="loyalty_step1_submit">
                                <div class="cus_cnt_body">
                                    
                                    <div class="fld_blk">
                                        <div class="row">
                                            <div class="col-md-6 field_col_d">
                                                <label>Number of physical location</label>
                                                <input type="text" placeholder="Enter of locations" wire:model.live= "loyalty_location_number">
                                                <span>@if ($errors->has('loyalty_location_number'))
                                                    <div class="error" style="color:red;">{{ $errors->first('loyalty_location_number') }}</div>
                                                @endif</span>
                                            </div>
                                            <div class="col-md-6 field_col_d">
                                                <label>Location added</label>
                                                <input type="text" placeholder="0 of 0 locations" wire:model.defer="loyalty_location_added">
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="fld_blk">
                                        <div class="title_h4">Will your customer go to the address below to redeem
                                        this deal? <span class="ast">*</span></div>
                                        <label class="address-label">{{$primary_business_address}}</label>
                                        <div class="rad_grp">
                                            <label><input type="radio" name="location_radio" id="yes"  wire:model="loyalty_selected_option" value="for_yes"> <span></span> Yes</label>
                                        <label><input type="radio" name="location_radio" id="no"  wire:model="loyalty_selected_option" value="for_no"> <span></span> No</label>
                                        </div>
                                    </div>
                                    <span>@if ($errors->has('loyalty_selected_option'))
                                        <div class="error" style="color:red;">{{ $errors->first('loyalty_selected_option') }}</div>
                                    @endif</span>
        
                                    {{-- <div class="fld_blk">
                                        <div class="cus_link_btn_cont">
                                            <a href="#" class="theme_link_text">Skip this Step and have your Gimmzi Community Advocate complete for you</a>
                                        </div>
                                    </div> --}}
                                
                                    
                                </div>

                                <div class="cus_cnt_ft">
                                    <div class="cus_cnt_ft_lt">
                                        <a class="cmn_theme_btn bordered" wire:click.prevent='goToLoyaltyStep'>Back</a>
                                        <button class="cmn_theme_btn">Next</button>
        
                                    </div>
                                    {{-- <div class="cus_cnt_ft_rt">
                                        <a class="cmn_theme_btn btn2" >Add Location</a>
                                    </div> --}}
                                </div>
                                
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($loyalty_step2 == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_hd">
                                <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                            </div>
                            <form method="post" wire:submit.prevent='selectLoyaltyType' class="cmn_form_elem">
                            <div class="cus_cnt_body">
    
                                <div class="fld_blk">
                                    <div class="row align-items-center">
                                        <div class="col-md-9">
                                            <label>Select the date you would like to start your Loyalty Rewards Program</label>
                                            <input type="text" class="start_lotalty_datepicker" wire:model='loyalty_start_date' placeholder="mm/dd/YYYY">
                                        </div>
                                        
                                        <div class="col-md-3 fld_blk_chk">
                                            <label class="pt-md-4"> <input type="checkbox" wire:model='no_end' checked> <span></span> No End Date</label>
                                        </div>
                                        @error('loyalty_start_date')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        @if($yes_end == true)
                                        <div class="col-md-9">
                                            <label>Select the date you would like to end your Loyalty Rewards Program</label>
                                            <input type="text" class="end_loyalty_datepicker" wire:model='loyalty_end_date' placeholder="mm/dd/YYYY">
                                        </div>
                                        @endif
                                        @error('loyalty_end_date')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="fld_blk">
                                    <div class="row">
                                        <div class="col-md-12 multi-select">
                                            <label>Participating Location(s)</label>
                                                <select wire:model='loyalty_location_ids' class="select_loyalty_location" >
                                                    
                                                    @if(count($locations) > 0)
                                                    <option value="" selected disabled> Please select location</option>
                                                        @foreach($locations as $location_data)
                                                            <option value="{{$location_data->id}}">{{$location_data->full_location}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                        </div>
                                        @error('loyalty_location_ids')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="fld_blk">
                                    <div class="lot_items">
                                        <h2 class="title_h3">Select the type of <strong>Loyalty Rewards Program</strong> you would like to build.</h2>
                                        <div class="lot_item_list">
                                            <label class="lot_half">
                                                <input type="radio" wire:model='purchase_goal' value="free">
                                                <img src="{{ asset('frontend_assets/images/purchase-goal-d.jpeg')}}" alt="">
                                                <span>Set a number of purchases for a specific item or item
                                                    type and reward the customer with a discount once the goal is met.
                                                    For example, Purchase 10 Tacos and get 11th FREE</span>
                                            </label>
                                            <label class="lot_half">
                                                <input type="radio" wire:model='purchase_goal' value="deal_discount">
                                                <img src="{{ asset('frontend_assets/images/spend-goal-d.jpeg')}}" alt="">
                                                <span>Set a dollar spend limit of purchases and reward
                                                    the customer with a discount once the goal is met.
                                                    For example, Spend $150 and get $15 OFF next purchase</span>
                                            </label>
                                        </div>
                                        @error('purchase_goal')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    {{-- <a wire:click.prevent='backToPrevious("step_two_loyalty")' class="cmn_theme_btn bordered">Back</a> --}}
                                    {{-- <a class="cmn_theme_btn bordered" wire:click.prevent='goToLoyaltyStep1'>Back</a> --}}

                                    <button type="submit" class="cmn_theme_btn">Next</button>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    @if($loyalty_step3 == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_hd">
                                <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                            </div>
                            <form method = "post" wire:submit.prevent='createLoyaltyProgram' class="cmn_form_elem">
                            <div class="cus_cnt_body">
    
                                <div class="fld_blk">
                                    <div class="row">
                                        {{-- @dd($loyalty_item_select_display) --}}
                                        @if($loyalty_item_select_display == true)
                                            <div class="col-md-12  multi-select " >
                                        @else
                                            <div class="col-md-12  multi-select " style="display:none;">
                                            {{-- <div class="col-md-12  multi-select "> --}}

                                        @endif
                                            
                                            <label>What Item or items would you like to use for this loyalty program?</label>
                                            <div >
                                            <select wire:model.defer='loyalty_item_id' multiple class="select_loyalty_item">
                                                @if(count($items) > 0)
                                                    @foreach($items as $itemdata)
                                                        <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            </div>
                                            
                                            <div class="tip_link">
                                                <a href="javascripe:void(0);" id="for_loyalty1" wire:click='openModalAddItam'>Add Item or Services</a>
                                            </div>
                                            @error('loyalty_item_id')
                                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                @if($showModal)
                                <div id="itemserviceshowhide" style="box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);">
                                <div class="container">
                                    <br>
                                    <div class="col-md-12 d-flex align-items-center justify-content-between" >
                                        <h1>Item And Service Database</h1>  
                                        <a href="javascript:void(0);" id="closeLink"
                                        class="cancel-link-button">CANCEL</a>
                                    </div>
                                    
                                    <div class="Gimmzi-Gift-Manager ">
                                        <div class="btn_title">
                                            <h2 id="collapsetitle">Add an item or service to database</h2>
                                        </div>
                                    </div>

                                    <div id="itemserviceform" >
                                            <div class="Gimmzi-Gift-Manager">
                                                <h2>Enter the name of item or service below</h2>
                                                <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                                    wire:model="item_service_name" />
                                            </div>
                                            @error('item_service_name')
                                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <div class="row value-of-this-gift">
                                                <div class="col-sm-12">
                                                    <h3>Enter the Value of this Item</h3>
                                                    <h4>the amount the customer would normally pay</h4>
                                                    <div class="customer-input">
                                                        $ <input type="text" wire:model="value_one" id="value_one" class="value-input-text" onkeypress="return isNumber(event);"/> . 
                                                        <input type="text" wire:model="value_two" id="value_two" class="value-input-text" onkeypress="return isNumber(event);"/>
                                                    </div>
                                                    @error('value_one')
                                                        <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                    <br>
                                                    @error('value_two')
                                                        <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <h3>Notes (Optional)</h3>
                                                    <textarea class="note-text" wire:model="note" id="note"></textarea>
                                                    @error('note')
                                                        <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="ajax_response" style="float:left">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="gift-database-main">
                                                <div class="d-flex justify-content-between">
                                                    <h3></h3>
                                                    <div class="filter-sec-manage-programs">
                                                        <a href="javascript:void(0);" wire:click="addItemService" class="styled-button">Add To Database</a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <br>
                                </div>
                                <br><br>
                                @endif

                                @if($item_service_modal_open)
                                {{-- pro start --}}
                                    <div id="itemservicesprice">
                                        <div class="item-serv-dtl">
                                            <h5 class="modal-title" id="staticBackdropLabel" >Item & Services</h5>
                                            <p >Review the original prices listed below.</p>
                                            <p >if a price is missing, please enter a value. Update any price as needed.</p>
                                            <p >These can be estimates and will be used to determine point values for the loyalty reward program.</p><hr>
                                            <div class="row item-serv-dtl-row">
                                                @if($get_items)
                                                @foreach($get_items as $index => $item)
                                                    <div class="col-md-6">
                                                        {{$item['item_name']}}
                                                    </div>
                                                    <div class="col-md-6" style="text-align:right;">
                                                        <input type="text" wire:model.live="selected_item_value.{{ $item['id'] }}" id="selected_item_value_{{ $item['id'] }}">
                                                        @error("selected_item_value.$item[id]") 
                                                            <span class="text-danger">{{ $message }}</span> 
                                                        @enderror
                                                    </div> <br>
                                                @endforeach
                                                @endif
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary" wire:click.prevent='submitNewItemPrice'>Confirm</button>
                                            </div> 
                                            <div class="col-12">
                                                <button type="button" class="btn btn-dark" wire:click.prevent='closeSubmitNewItemPrice'>Go Back</button>
                                            </div>
                                            <br><br>
                                            </div>
                                        </div>
                                    </div>
                                {{-- pro end --}}

                                    <br><br>
                                @endif

                                <div class="fld_blk">
                                    <div class="row">
                                        <div class="col-md-12" >
                                            <label>How many of these does your customer have to buy before they can earn the reward?</label>
                                            <input type="text" wire:model='have_to_buy' id="how_much" placeholder="Enter the number of the items needed">
                                        </div>
                                    </div>
                                    <br>
                                    @error('have_to_buy')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
    
                                <div class="fld_blk">
                                    <div class="row align-items-center">
                                        <label>And the customer get the</label>
                                        <div class="col-md-9">
                                            <input type="text" placeholder="Enter here" class="get_free" wire:model='free_item' readonly>
                                            <input type="hidden" wire:model='free_item_no' >
                                            @error('free_item')
                                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 fld_blk_chk">
                                            <select wire:model.defer='off_percentage'>
                                                @foreach ($percentages as $data)
                                                    <option value="{{$data['value']}}" > {{$data['text']}}</option>
                                                @endforeach
                                            </select>
                                            @error('off_percentage')
                                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> 
                                <div class="fld_blk fld_blk_txt_shwcase">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="title_h4">About this program</div>
                                            <div class="fld_textarea">{{$loyalty_about}}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="title_h4">Terms and condition</div>
                                            <div class="fld_textarea">{!! $loyalty_terms !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    <a   class="cmn_theme_btn bordered" wire:click.prevent='goToLoyaltyStep2'>Cancel</a>
                                    <button type="submit" class="cmn_theme_btn">Publish</button>
                                </div>
                                <div class="cus_cnt_ft_rt">
                                    {{-- <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewProgram'>Preview</button> --}}
                                </div>
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    @endif


                    @if($loyalty_step4 == true)
                        <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                                <div class="cus_cnt_hd">
                                    <h1 class="title_h1">Build Your Digital Loyalty Punch Card</h1>
                                </div>
                                <form method="post" wire:submit.prevent='createLoyaltyProgram' class="cmn_form_elem">
                                <div class="cus_cnt_body">

                                    <div class="fld_blk">
                                        <div class="row">
                                            @if($loyalty_item_select_display == true)
                                                <div class="col-md-12 multi-select sngl_select">
                                            @else
                                                <div class="col-md-12 multi-select" style="display:none;">
                                                {{-- <div class="col-md-12 multi-select sngl_select"> --}}

                                            @endif
                                                <label>What Item or items would you like to use for this loyalty program?</label>
                                                {{-- <div wire:ignore> --}}
                                                <div>
                                                <select wire:model.defer='loyalty_item_id' multiple class="select_loyalty_item">
                                                    @if(count($items) > 0)
                                                        @foreach($items as $itemdata)
                                                            <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                </div>
                                                <div class="tip_link">
                                                    <a href="javascripe:void(0);" id="for_loyalty2" wire:click='openModalAddItam'>Add Item or Services</a>
                                                </div>
                                                @error('loyalty_item_id')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    @if($showModal)
                                        <div id="itemserviceshowhide" style="box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);">
                                            <div class="container">
                                                <br>
                                                <div class="col-md-12 d-flex align-items-center justify-content-between" >
                                                    <h1>Item And Service Database</h1>  
                                                    <a href="javascript:void(0);" id="closeLink"
                                                    class="cancel-link-button">CANCEL</a>
                                                </div>
                                                
                                                <div class="Gimmzi-Gift-Manager ">
                                                    <div class="btn_title">
                                                        <h2 id="collapsetitle">Add an item or service to database</h2>
                                                    </div>
                                                </div>

                                                <div id="itemserviceform" >
                                                        <div class="Gimmzi-Gift-Manager">
                                                            <h2>Enter the name of item or service below</h2>
                                                            <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                                                wire:model="item_service_name" />
                                                        </div>
                                                        @error('item_service_name')
                                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                        <div class="row value-of-this-gift">
                                                            <div class="col-sm-12">
                                                                <h3>Enter the Value of this Item</h3>
                                                                <h4>the amount the customer would normally pay</h4>
                                                                <div class="customer-input">
                                                                    $ <input type="text" wire:model="value_one" id="value_one" class="value-input-text" onkeypress="return isNumber(event);"/> . 
                                                                    <input type="text" wire:model="value_two" id="value_two" class="value-input-text" onkeypress="return isNumber(event);"/>
                                                                </div>
                                                                @error('value_one')
                                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                                <br>
                                                                @error('value_two')
                                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <h3>Notes (Optional)</h3>
                                                                <textarea class="note-text" wire:model="note" id="note"></textarea>
                                                                @error('note')
                                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="ajax_response" style="float:left">
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="gift-database-main">
                                                            <div class="d-flex justify-content-between">
                                                                <h3></h3>
                                                                <div class="filter-sec-manage-programs">
                                                                    <a href="javascript:void(0);" wire:click="addItemService" class="styled-button">Add To Database</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <br><br>
                                    @endif
                                    
                                    @if($item_service_modal_open)
                                        {{-- <div id="itemservicesprice" style="box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); width:80%;">
                                            <div class="container">
                                                    <h5 class="modal-title" id="staticBackdropLabel" style="text-align:center;">Item & Services</h5>
                                                    <p style="color:#797575">Review the original prices listed below.</p>
                                                    <p style="color:#797575">if a price is missing, please enter a value. Update any price as needed.</p>
                                                    <p style="color:#797575">These can be estimates and will be used to determine point values for the loyalty reward program.</p><hr>
                                                    <div class="row">
                                                        @if($get_items)
                                                        @foreach($get_items as $index => $item)
                                                            <div class="col-md-6">
                                                                {{$item['item_name']}}
                                                            </div>
                                                            <div class="col-md-6" style="text-align:right;">
                                                                <input type="text" wire:model.live="selected_item_value.{{ $item['id'] }}" id="selected_item_value_{{ $item['id'] }}">
                                                                @error("selected_item_value.$item[id]") 
                                                                    <span class="text-danger">{{ $message }}</span> 
                                                                @enderror
                                                            </div> <br>
                                                        @endforeach
                                                        @endif
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-primary" wire:click.prevent='submitNewItemPrice'>Confirm</button>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-dark" wire:click.prevent='closeSubmitNewItemPrice'>Go Back</button>
                                                    </div>
                                                    <br><br>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div id="itemservicesprice">
                                            <div class="item-serv-dtl">
                                                <h5 class="modal-title" id="staticBackdropLabel" >Item & Services</h5>
                                                <p >Review the original prices listed below.</p>
                                                <p >if a price is missing, please enter a value. Update any price as needed.</p>
                                                <p >These can be estimates and will be used to determine point values for the loyalty reward program.</p><hr>
                                                <div class="row item-serv-dtl-row">
                                                    @if($get_items)
                                                    @foreach($get_items as $index => $item)
                                                        <div class="col-md-6">
                                                            {{$item['item_name']}}
                                                        </div>
                                                        <div class="col-md-6" style="text-align:right;">
                                                            <input type="text" wire:model.live="selected_item_value.{{ $item['id'] }}" id="selected_item_value_{{ $item['id'] }}">
                                                            @error("selected_item_value.$item[id]") 
                                                                <span class="text-danger">{{ $message }}</span> 
                                                            @enderror
                                                        </div> <br>
                                                    @endforeach
                                                    @endif
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary" wire:click.prevent='submitNewItemPrice'>Confirm</button>
                                                </div> 
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-dark" wire:click.prevent='closeSubmitNewItemPrice'>Go Back</button>
                                                </div>
                                                <br><br>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                        @endif



                                    <div class="fld_blk fld_blk_rd_grp">
                                        <label>What kind of discount are you offering? <span class="ast">*</span></label>
                                        <div class="rad_grp">
                                            <label><input type="radio" wire:model="loyalty_discount_type" id="loyalty_discount_type" value="dollar"> <span></span> Dollar</label>
                                            <label><input type="radio" wire:model="loyalty_discount_type" id="loyalty_discount_type" value="percentage"> <span></span> Percentage</label>
                                        </div> 
                                    </div>
                                    <br>
                                    @error('loyalty_discount_type')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                    <div class="fld_blk">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>How much (dollar amount) does your customer have to spend before they receive this deal discount?</label>
                                                <input type="text" wire:model='spend_amount' id="spend_amount" placeholder="Enter the dollar amount needed to spend" onkeypress="return isNumber(event);">
                                                <input type="hidden" wire:model = "program_amount" id="program_amount">
                                            </div>
                                            @error('program_amount')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="fld_blk">
                                        <div class="row align-items-center">
                                            <div class="cmn_multi_fld_grp">
                                                <label>And the customer get the</label>
                                                <input type="text" id="discount_amount" wire:model='loyalty_discount_amount' placeholder="Enter discount" onkeypress="return isNumber(event);">
                                                <input type="hidden" wire:model = "dscnt_amount" id="dscnt_amount"><br>
                                                {{-- @error('dscnt_amount')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                @error('disAmount')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror --}}
                                                <span>To</span>
                                                <select wire:model='when_order'>
                                                    <option value="">When?</option>
                                                    <option value="current">Current</option>
                                                    <option value="next">Next</option>
                                                </select>
                                                <span class="badge_stat_tag">Purchase</span>
                                                {{-- @error('when_order')
                                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror --}}
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        @error('dscnt_amount')
                                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                        @error('disAmount')
                                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-5">
                                                        @error('when_order')
                                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
        
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                </div>
                                <div class="cus_cnt_ft">
                                    <div class="cus_cnt_ft_lt">
                                        <a wire:click.prevent='goToLoyaltyStep2' class="cmn_theme_btn bordered">Cancel</a>
                                        <button type="submit" class="cmn_theme_btn">Publish</button>
                                    </div>
                                    <div class="cus_cnt_ft_rt">
                                        {{-- <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewProgram'>Preview</button> --}}
                                    </div>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>

                    @endif


                    @if($loyalty_step5 == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <form wire:submit.prevent='completeLoyalty' class="cmn_form_elem">
                            <div class="cus_cnt_body tp_adj_to_eq text-center">
    
                                <div class="succ_msg_wrapper">
                                    <div class="success_msg_pic">
                                        <img src="{{ asset('frontend_assets/images/congt-pic2.svg')}}" alt="">
                                    </div>
                                    <h1 class="succ_text title_h1">Congratulations!</h1>
                                    <h2 class="title_h3">Your Loyalty Rewars Program</h2>
                                </div>
                                
                            </div>
                            <div class="cus_cnt_ft">
                                <div class="cus_cnt_ft_lt">
                                    <button type="submit" class="cmn_theme_btn">Next</button>
                                </div>
                                {{-- <div class="cus_cnt_ft_rt">
                                    <a wire:click='goToCampaignManagement' class="cmn_theme_btn btn2">Manage Programs</a>
                                </div> --}}
                            </div>
                            </form>
                        </div>
                    </div>
                    @endif



                    @if($deal_step == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Let's create your first discount voucher Deal Wizard</h1>
                        </div>
                        <form wire:submit.prevent="deal_step_submit">
                        <div class="cus_cnt_body">
                            
                            <label>What date span would you like this deal to be active for customer use?<span class="ast">*</span></label>
                            <div class="date_filed_range">
                                <input type="text" wire:model.defer="start_date" class="start_datepicker">
                                <span>To</span>
                                <input type="text" wire:model.defer="end_date" class="end_datepicker">
                            </div>
                            @error('start_date')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                            @enderror

                            @error('end_date')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            <small>Note : Expiration date cannot be less than 30 days from the start date. If expiration date is left blank, the deal will remain active unless Merchant edits the deal and adds an expiration date.</small>
                                <p></p>
                            <div class="col-12 ">
                                {{-- <a href="#" class="btn back-button-one11" wire:click="goToStepSeven" style="color: white;">Back</a> --}}
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepSeven'>Back</a>
                                
                                 <button class="cmn_theme_btn">Next</button>
                            </div>
                            
                        </div>
                        {{-- <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <button class="cmn_theme_btn bordered">Back</button>
                                <button class="cmn_theme_btn">Next</button>
                            </div>
                        </div> --}}
                        
                        </form>
                        <p></p>
                    </div>
                    </div>
                    @endif

                    @if($deal_step1 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Upload Deal Photo</h1>
                        </div>
                        <form wire:submit.prevent="deal_step1_submit">
                            <div class="cus_cnt_body">
                            <h2 class="title_h2">Upload Deal Image</h2>
                            
                                <input type="file" wire:model.defer="deal_image" id="file-up" class="file_up_input">
                                <label for="file-up" class="file_up_label">
                                    <span class="file_up_icon"><img src="{{asset('frontend_assets/images/cloud-computing.png')}}" alt="upload icon"></span>
                                    <span class="file_up_text1"><span>Click to upload</span> or drag and drop</span>
                                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                                </label>
                            
                            <div class="cus_link_btn_cont">
                                <a href="javascript:void(0);" class="theme_link_text" wire:click='skipDealPhoto'>Skip This Step for later</a>
                            </div>
                        
                            <div class="col-md-6 form_end_crt_acc">
                                @if($deal_image != '')
                                    <img class='thumbnail'  style="height: 180px; padding: 10px;" src="{{ asset('storage/tmp/'.$deal_image->getFilename()) }}" alt="">
                                @endif
                            </div>
                            <p></p>
                            <div class="col-12 ">
                                {{-- <a href="#" class="btn back-button-one11" wire:click="goToStepDealStep" style="color: white;">Back</a> --}}
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepDealStep'>Back</a>

                                <button class="cmn_theme_btn">Next</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    @endif


                    @if($deal_event_step == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_hd">
                                <h1 class="title_h1">Serving Area Locations and Events</h1>
                            </div>
                            <form wire:submit.prevent="deal_event_step_submit">
                                <p style="padding:15px; color:#5a5757">Add up to three areas you serve to help customers find you also include event details to highlight your temporary locations if you are going to be selling you product and/or service at an upcoming event. </p>
                                <div class="cus_cnt_body" style="padding: 10px 30px;">
                                    <div class="fld_blk">
                                        <div class="row">
                                            <div class="col-md-12 field_col_d">
                                                <label>Serving Area #1</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Street" wire:model.defer="serving_area1_street"  id="serving_area1_street" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="servingArea1Autocomplete()">

                                                        @if ($errors->has('serving_area1_street'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area1_street') }}
                                                            </div>
                                                        @endif
                                                        @if ($errors->has('serving_area1_latitude'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area1_latitude') }}
                                                            </div>
                                                        @endif
                                                        
                                                    </div>

                                                    <input type="hidden" wire:model.defer="serving_area1_latitude" id="serving_area1_latitude">

                                                    <input type="hidden" wire:model.defer="serving_area1_longitude" id="serving_area1_longitude">

                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="City" wire:model.defer="serving_area1_city">
                                                        @if ($errors->has('serving_area1_city'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area1_city') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="select-business-category" wire:model.defer="serving_area1_state" id="serving_area1_state">
                                                            <option selected disabled value=""> Select State </option>
                                                            @if ($stateList)
                                                                @foreach ($stateList as $states)
                                                                    <option value="{{ $states->id }}">
                                                                        {{ $states->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('serving_area1_state'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area1_state') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="hidden" placeholder="Zip" wire:model.defer="serving_area1_zip">
                                                    </div>
                                                </div>
                                                
                                                {{-- <span>
                                                    @if ($errors->has('serving_area1_street'))
                                                        <div class="error" style="color:red;">{{ $errors->first('serving_area1_street') }}</div>
                                                    @endif
                                                </span> --}}
                                            </div>
                                            <p></p>
                                            <div class="col-md-12 field_col_d">
                                                <label>Serving Area #2</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Street" wire:model.defer="serving_area2_street"  id="serving_area2_street" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="servingArea2Autocomplete()">
                                                        @if ($errors->has('serving_area2_street'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area2_street') }}
                                                            </div>
                                                        @endif
                                                        @if ($errors->has('serving_area2_latitude'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area2_latitude') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <input type="hidden" wire:model.defer="serving_area2_latitude" id="serving_area2_latitude">

                                                    <input type="hidden" wire:model.defer="serving_area2_longitude" id="serving_area2_longitude">

                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="City" wire:model.defer="serving_area2_city">
                                                        @if ($errors->has('serving_area2_city'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area2_city') }}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-4">
                                                        <select class="select-business-category" wire:model.defer="serving_area2_state" id="serving_area2_state">
                                                            <option selected disabled value=""> Select State </option>
                                                            @if ($stateList)
                                                                @foreach ($stateList as $states)
                                                                    <option value="{{ $states->id }}">
                                                                        {{ $states->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('serving_area2_state'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area2_state') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="hidden" placeholder="Zip" wire:model.defer="serving_area2_zip">
                                                    </div>
                                                </div>
                                                
                                                {{-- <span>
                                                    @if ($errors->has('serving_area2_street'))
                                                        <div class="error" style="color:red;">{{ $errors->first('serving_area2_street') }}</div>
                                                    @endif
                                                </span> --}}
                                            </div>
                                            <p></p>
                                            <div class="col-md-12 field_col_d">
                                                <label>Serving Area #3</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Street" wire:model.defer="serving_area3_street"  id="serving_area3_street" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="servingArea3Autocomplete()">
                                                        @if ($errors->has('serving_area3_street'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area3_street') }}
                                                            </div>
                                                        @endif
                                                        @if ($errors->has('serving_area3_latitude'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area3_latitude') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <input type="hidden" wire:model.defer="serving_area3_latitude" id="serving_area3_latitude">

                                                    <input type="hidden" wire:model.defer="serving_area3_longitude" id="serving_area3_longitude">
                                                    
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="City" wire:model.defer="serving_area3_city">
                                                        @if ($errors->has('serving_area3_city'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area3_city') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{-- <input type="text" placeholder="State" wire:model.defer="serving_area3_state"> --}}

                                                        <select class="select-business-category" wire:model.defer="serving_area3_state" id="serving_area3_state">
                                                            <option selected disabled value=""> Select State </option>
                                                            @if ($stateList)
                                                                @foreach ($stateList as $states)
                                                                    <option value="{{ $states->id }}">
                                                                        {{ $states->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @if ($errors->has('serving_area3_state'))
                                                            <div class="error" style="color:red;">{{ $errors->first('serving_area3_state') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="hidden" placeholder="Zip" wire:model.defer="serving_area3_zip">
                                                    </div>
                                                </div>
                                                
                                                {{-- <span>
                                                    @if ($errors->has('serving_area3_street'))
                                                        <div class="error" style="color:red;">{{ $errors->first('serving_area3_street') }}</div>
                                                    @endif
                                                </span> --}}
                                            </div>
                                            <p><p><p>
                                            <div class="col-lg-12">
                                                <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                                    <input type="checkbox" id="advertise_event" class="gimigi-checkbok ifcheck" wire:model.live="advertise_event" style="top: 28px; height: 19px;">
                                                    <h3>Advertise Event</h3>
                                                </div>
                                                <p style="padding-top: 6px; color:#5a5757">
                                                    Check the "Advertise Event" box to promote an event where your business will be a vendor. During the event, the event information will replace your Serving Locations on the app. If 1 Day Event is checked. only the start date will be displayed on the app. After the event ends, your Serving Locations will be displayed again.
                                                </p>
                                            </div>
                                            <p><p>
                                            <div class="col-md-12 field_col_d">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Event Name</label>
                                                        <input type="text" placeholder="Event Name" wire:model.defer="event_name">
                                                        <span>
                                                            @if ($errors->has('event_name'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_name') }}</div>
                                                            @endif
                                                        </span>   
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <label>Event Start Date</label>
                                                        <input type="text" class="start_event_datepicker" placeholder="mm/dd/yyyy" wire:model.defer="event_start_date" onfocus="disableAutocomplete(this)">
                                                        <span>
                                                            @if ($errors->has('event_start_date'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_start_date') }}</div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Event End Date</label>
                                                        <input type="text" class="end_event_datepicker" id= "end_event_datepicker" placeholder="mm/dd/yyyy" wire:model.defer="event_end_date" onfocus="disableAutocomplete(this)">
                                                        <span>
                                                            @if ($errors->has('event_end_date'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_end_date') }}</div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                                        <input type="checkbox" id="one_day_event" class="gimigi-checkbok ifcheck" wire:model.live="one_day_event" style="top:24px; height: 15px;">
                                                        <span>1 Day Event</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p><p>
                                            <div class="col-md-12 field_col_d">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Address of Event</label>
                                                        {{-- <input type="text" placeholder="Enter Address" wire:model.defer="event_address"> --}}
                                                        <input type="text" placeholder="Street" wire:model.defer="event_address"  id="event_address" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="eventAddressAutocomplete()">
                                                        <span>
                                                            @if ($errors->has('event_address'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_address') }}</div>
                                                            @endif
                                                        </span>   
                                                    </div>

                                                    <input type="hidden" wire:model.defer="event_latitude" id="event_latitude">

                                                    <input type="hidden" wire:model.defer="event_longitude" id="event_longitude">
                                                    
                                                    <div class="col-md-3">
                                                        <label>City</label>
                                                        <input type="text" placeholder="City" wire:model.defer="event_city">
                                                        <span>
                                                            @if ($errors->has('event_city'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_city') }}</div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>State</label>
                                                        {{-- <input type="text" placeholder="State" wire:model.defer="event_state"> --}}
                                                        <select class="select-business-category" wire:model.defer="event_state" id="event_state">
                                                            <option selected disabled value=""> Select State </option>
                                                            @if ($stateList)
                                                                @foreach ($stateList as $states)
                                                                    <option value="{{ $states->id }}">
                                                                        {{ $states->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <span>
                                                            @if ($errors->has('event_state'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_state') }}</div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Zip Code</label>
                                                        <input type="text" placeholder="Enter Zip Code" wire:model.defer="event_zip">
                                                        <span>
                                                            @if ($errors->has('event_zip'))
                                                                <div class="error" style="color:red;">{{ $errors->first('event_zip') }}</div>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="cus_cnt_ft_lt">
                                        <a class="cmn_theme_btn bordered" wire:click.prevent='previousstep'>Back</a>
                                        <button class="cmn_theme_btn">Next</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif




                    @if($deal_step2 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Enter Participating Location(s)</h1>
                        </div>
                        <form wire:submit.prevent="deal_step2_submit">
                            <div class="cus_cnt_body">
                                
                                <div class="fld_blk">
                                    <div class="row">
                                        <div class="col-md-6 field_col_d">
                                            <label>Number of physical location</label>
                                            <input type="text" placeholder="Enter of locations" wire:model.live="physical_location" >
                                            <span>@if ($errors->has('physical_location'))
                                                <div class="error" style="color:red;">{{ $errors->first('physical_location') }}</div>
                                            @endif</span>
                                        </div>
                                        <div class="col-md-6 field_col_d">
                                            <label>Location added</label>
                                            <input type="text" placeholder="0 of 0 locations" wire:model.defer="added_physical_location" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="fld_blk">
                                <div class="title_h4">Will your customer go to the address below to redeem
                                    this deal? <span class="ast">*</span></div>
                                    <label class="address-label">{{$primary_business_address}}</label>
                                    <div class="rad_grp">
                                        <label><input type="radio" name="location_radio" id="yes"  wire:model="selected_option" value="for_yes"> <span></span> Yes</label>
                                        <label><input type="radio" name="location_radio" id="no"  wire:model="selected_option" value="for_no"> <span></span> No</label>
                                        
                                    </div>
                                    <span>@if ($errors->has('selected_option'))
                                        <div class="error" style="color:red;">{{ $errors->first('selected_option') }}</div>
                                    @endif</span>
                                </div>

                                <div class="fld_blk">
                                    {{-- <div class="cus_link_btn_cont">
                                        <a href="#" class="theme_link_text">Skip this Step and have your Gimmzi Community Advocate complete for you</a>
                                    </div> --}}
                                </div>
                                <p></p>
                                
                            
                            <div class="cus_cnt_ft_lt">
                                {{-- <a href="#" class="btn back-button-one11" wire:click="goToStepDealStep1" style="color: white;">Back</a> --}}
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepDealStep1'>Back</a>

                                <button class="cmn_theme_btn">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                    @endif

                    @if($deal_step3 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Add Deal Description</h1>
                        </div>
                        <form method="post" wire:submit.prevent='createDealDescription' class="cmn_form_elem">
                        <div class="cus_cnt_body">
                            
                            <div class="fld_blk">
                                <div class="row">
                                    @if($item_select_display == true)
                                        <div class="col-md-6 field_col_d multi-select sngl_select">
                                    @else
                                        <div class="col-md-6 field_col_d multi-select sngl_select">
                                    @endif
                                        <label>Item or Service</label>
                                        <select wire:model.live='item_id' class="select_item">
                                           
                                            @if(count($items) > 0)
                                            <option value="">Select Item or Service</option>
                                                @foreach($items as $key => $itemdata)
                                                    <option value="{{$itemdata->id}}">{{$itemdata->item_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="tip_link">
                                            <a href="javascript:void(0);" id="for_deal"  wire:click="openModalAddItam">Add Item or Services</a> 
                                            
                                        </div>
                                        @error('item_id')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 field_col_d">
                                        <label>How much is the original sales price of this item($)? <span class="ast">*</span></label>
                                        <input type="text" wire:model.defer='item_price' id='itm_price' > 
                                        @error('real_item_price')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            @if($showModal)
                            <div id="itemserviceshowhide" style="box-shadow: 0px 8px 20px rgba(58, 207, 13, 0.2);">
                            <div class="container">
                                <br>
                                <div class="col-md-12 d-flex align-items-center justify-content-between" >
                                    <h1>Item And Service Database</h1>  
                                    <a href="javascript:void(0);" id="closeLink" wire:model="value_one" class="cancel-link-button">CANCEL</a>
                                </div>
                                
                                <div class="Gimmzi-Gift-Manager ">
                                    <div class="btn_title">
                                        <h2 id="collapsetitle">Add an item or service to database</h2>
                                    </div>
                                </div>

                                <div id="itemserviceform" >
                                        <div class="Gimmzi-Gift-Manager">
                                            <h2>Enter the name of item or service below</h2>
                                            <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                                wire:model="item_service_name" />
                                        </div>
                                        @error('item_service_name')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <div class="row value-of-this-gift">
                                            <div class="col-sm-12">
                                                <h3>Enter the Value of this Item</h3>
                                                <h4>the amount the customer would normally pay</h4>
                                                <div class="customer-input">
                                                    $ <input type="text" wire:model="value_one" id="value_one" class="value-input-text" onkeypress="return isNumber(event);"/> . 
                                                    <input type="text" wire:model="value_two" id="value_two" class="value-input-text" onkeypress="return isNumber(event);"/>
                                                </div>
                                                @error('value_one')
                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                <br>
                                                @error('value_two')
                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12">
                                                <h3>Notes (Optional)</h3>
                                                <textarea class="note-text" wire:model="note" id="note"></textarea>
                                                @error('note')
                                                    <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="ajax_response" style="float:left">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="gift-database-main">
                                            <div class="d-flex justify-content-between">
                                                <h3></h3>
                                                <div class="filter-sec-manage-programs">
                                                    <a href="javascript:void(0);" wire:click="addItemService" class="styled-button">Add To Database</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <br>
                            </div>
                            @endif
                            <br><br>
                            <div class="fld_blk fld_blk_rd_grp">
                                <label>What kind of discount are you offering on this item? <span class="ast">*</span></label>
                                <div class="rad_grp">
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Free"> <span></span> Free</label>
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Dollar"> <span></span> Dollar($)</label>
                                    <label><input type="radio" wire:model="deal_discount" class="discount_type" value="Percentage"> <span></span> Percentage(%)</label>
                                </div>
                            </div>
                            <br>
                            @error('deal_discount')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror

                            <div class="fld_blk">
                                <label>Enter the discount {{$discount_type}} <span class="ast">*</span></label>
                                <input type="text" wire:model='show_discount_amount' id="deal_discount_amount" onkeypress="return isNumber(event);">
                                <input type="hidden" wire:model = "discount_amount" id="hide_discount_amount">
                                <span class="fld_help_text">For the most attractive deal. We recommend at least half off the original sales price.</span>
                                <br>
                                @error('discount_amount')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                               
                            </div>
                        

                            <div class="fld_blk fld_blk_rd_grp">
                                <label>Is this a bogo (Buy One Get One) ? <span class="ast">*</span></label>
                                <div class="rad_grp">
                                    <label><input type="radio" wire:model="is_bogo" value="no"> <span></span> No</label>
                                    <label><input type="radio" wire:model="is_bogo" value="yes"> <span></span> Yes</label>
                                </div>
                                
                            </div>
                            <br>
                            @error('is_bogo')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror
                            


                            <div class="fld_blk">
                                <label>Required <span class="ast">*</span></label>
                                <textarea placeholder="Enter Description" wire:model='deal_description'></textarea>
                                <span class="fld_help_text">Next, we will help you calculate the Smart Rewards point value</span>
                                <br>
                                @error('deal_description')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            

                            <div class="fld_blk">
                                <div class="points_rdb_wrap">
                                    <div class="points_icon_wrap">
                                        <img src="{{ asset('frontend_assets/images/points-icon-d.svg')}}" alt="">
                                    </div>
                                    <div class="points_cont_wrap">
                                        <div class="title title_h3">
                                            @if ($deal_point)
                                                {{$deal_point}}
                                            @endif
                                            Points</div>
                                        <p>Amount of points customer need to redeem this deal.
                                            ( Based on original sales price of {{$item_price}})</p>
                                    </div>
                                </div>
                            </div>

                            <div class="fld_blk fld_blk_txt_shwcase">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="title_h4">About this program</div>
                                        <div class="fld_textarea">{{$about_program}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="title_h4">Terms and condition</div>
                                        <div class="fld_textarea">{!! $terms_condition !!}</div>
                                    </div>
                                </div>
                            </div>
                        
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepDealStep2'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                    </div>
                    @endif

                    @if($deal_step4 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Number of Deal Vouchers</h1>
                        </div>
                        <form wire:submit.prevent='addVoucher' class="cmn_form_elem">
                        <div class="cus_cnt_body">

                            <div class="fld_blk">
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <label>How many of these vouchers would you like to offer, in total, to your customer base, per month? <span class="ast">*</span></label>
                                        <input type="text" wire:model='voucher_limit'>
                                        <span class="fld_help_text">Minimum of 15</span>
                                    </div>
                                    <div class="col-md-2 fld_blk_chk">
                                        <label> <input type="checkbox" wire:model='voucher_unlimited'> <span></span> Unlimited</label>
                                    </div>
                                </div>
                            </div>
                            @error('voucher_limit')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                @error('voucher_unlimited')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror

                            <div class="fld_blk fld_blk_rd_grp">
                                <div class="nov_text">
                                    <p>Note: This amount will determine the amiability of this
                                        coupon to your customer base. Voucher limit set 30
                                        or less will be labeled as a <strong>LIMITED TIME OFFER</strong>
                                        deal.</p>
                                    <p>For example, if you enter 100, only 100 of these deals
                                        will be available for use on a first come, first serve basis.</p>
                                </div>
                            </div>

                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToStepDealStep3'>Back</a>
                                <button class="cmn_theme_btn" type="submit">Next</button>
                            </div>
                            {{-- <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn ylw" type="button" wire:click.prevent='PreviewDeal'>Preview deal</button>
                            </div> --}}
                        </div>
                        </form>
                    </div>
                    </div>
                    @endif

                    @if($deal_step5 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <form wire:submit.prevent='goToUserEdit'>
                        <div class="cus_cnt_body tp_adj_to_eq text-center">

                            <div class="succ_msg_wrapper">
                                <div class="success_msg_pic">
                                    <img src="{{ asset('frontend_assets/images/congrats-msg-pic.svg')}}" alt="">
                                </div>
                                <h1 class="succ_text title_h1">Congratulations!</h1>
                                <h2 class="title_h3">You have successfully created your first deal. Your deal has been
                                    saved and stored.</h2>
                                <p>A Gimmzi staff member will reach out to you via email within the next 24-48 hours to complete the setup.</p>
                            </div>
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn">Next</button>
                            </div>
                            {{-- <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn btn2">save</button>
                            </div> --}}
                        </div>
                        </form>
                    </div>
                    </div>
                    @endif

                    @if($step8 == true)
                    <div class="cus_cont_bar_col">
                    <div class="cus_cont_bar">
                        <div class="cus_cnt_hd">
                            <h1 class="title_h1">Gimmzi Advocate Assistance</h1>
                        </div>
                        <form wire:submit.prevent='submitUserPhone'>
                        <div class="cus_cnt_body">
                            <h2 class="title_h3">Gimmzi Advocate Assistance</h2>
                            <p>You have chosen to have a Gimmzi Advocate assist you on one or more of the steps. We would love to help get
                                you all set up! So we will have a Gimmzi Community Advocate reach out to you with the email and number below
                                after checkout.</p>
                            

                            <div class="edt_card">
                                <p class="title_h4">Confirm you can be reached using the info below:</p>
                                <div class="edt_row">
                                    <div class="edit_item_full flex-column justify-content-left">
                                        <label class="w-100">Name</label>
                                        <input type="text" placeholder="John Howard" wire:model.defer="user_name" readonly>
                                    </div>
                                    <div class="edit_item_50">
                                        <label>Email</label>
                                        <input type="email" placeholder="jhoward@hoa.com"  wire:model.defer="user_email" readonly>
                                    </div>
                                    <div class="edit_item_50">
                                        <label>Phone Number</label>
                                        <input type="tel" placeholder="(910) 555-5555" wire:model.defer="user_phone" {{$info_readonly}}>
                                    </div>
                                    <div class="edit_item_full">
                                        <div class="icon"><img src="{{asset('frontend_assets/images/icon-phone-d.svg')}}" alt="user"></div>
                                        Please reach me <a href="#url" class="edt_txt_link">as soon as possible after checkout</a>
                                    </div>
                                    <div class="edit_item_full">
                                        <div class="icon"><img src="{{asset('frontend_assets/images/calendar-icon-d.svg')}}" alt="user"></div>
                                        At  <a href="#url" class="edt_txt_link">as soon as possible after checkout</a>
                                    </div>
                                    <div class="edit_item_full end">
                                        To make changes <a href="Javascript:void(0);" wire:click='removeReadonly("personal_info")'><span>Edit</span> <div class="icon"><img src="{{asset('frontend_assets/images/edit-icon-d.svg')}}" alt="user"></div></a>
                                    </div>
                                </div>
                            </div>
                
                            
                        </div>
                        <div class="cus_cnt_ft">
                            <div class="cus_cnt_ft_lt">
                                {{-- <button class="cmn_theme_btn bordered">Back</button> --}}
                                {{-- <button class="cmn_theme_btn">Next</button> --}}
                                <a class="cmn_theme_btn btn2" wire:click.prevent='savePhoneNumber'>Save</a>

                            </div>
                            <div class="cus_cnt_ft_rt">
                                <button class="cmn_theme_btn">Next</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                    @endif
                {{-- </div> --}}

                    @if($pyamentPage == true)
                    {{-- <form wire:submit.prevent='paymentInfoSubmit'> --}}
                    <div class="cus_cont_bar_col split_9">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_hd">
                                <h1 class="title_h1">Enter Your Payment Info</h1>
                            </div>
                            
                            <div class="cus_cnt_body fld_blk_gap_lw">
                                <div class="pay_card_part">
                                    <div class="pay_hd">
                                        <h2 class="title_h3">Billing Address</h2>
                                        {{-- <a href="#" class="link_rd">Clear Form</a> --}}
                                    </div>
                                    <div class="fld_blk">
                                        <label>Street</label>
                                        <input type="text" placeholder="82 Main Street" wire:model.defer="payment_street">
                                        @error('payment_street')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        @enderror

                                    </span>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 fld_blk">
                                            <label>Country</label>
                                            <select wire:model.defer="payment_country">
                                                <option value="United States" selected>United States</option>
                                                <option value="New York">New York</option>
                                                <option value="London">London</option>
                                            </select>
                                            @error('payment_country')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>
                                        
                                        <div class="col-md-6 fld_blk">
                                            <label>City</label>
                                            <input type="text" placeholder="Charlotte" wire:model.defer="payment_city" >
                                            @error('payment_city')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>
                                       
                                        <div class="col-md-6 fld_blk">
                                            <label>State</label>
                                            <input type="text" placeholder="North Carolina" value="{{$payment_state}}">
                                            {{-- <select class="select-business-category" wire:model.defer="payment_state"
                                                id="mailing_state_id">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}">
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select> --}}

                                            @error('payment_state')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>
                                        
                                        <div class="col-md-6 fld_blk">
                                            <label>Zip code</label>
                                            <input type="text" placeholder="282222" onkeypress="return isNumber(event);" wire:model.defer="payment_zip">
                                            @error('payment_zip')
                                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        </div>
                                        
                                    </div>
    
                                </div>
    
                                <div class="pay_card_part">
                                    <div class="pay_hd">
                                        <h2 class="title_h3">Payment Information</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 fld_blk">
                                            <label>First name</label>
                                            <input type="text" placeholder="Joe" autocomplete="off" wire:model.defer="payment_user_f_name" >
                                        </div>
                                        <div class="col-md-6 fld_blk">
                                            <label>Last name</label>
                                            <input type="text" placeholder="Simmons" autocomplete="off" wire:model.defer="payment_user_l_name">
                                        </div>
                                        <div class="col-md-12 fld_blk">
                                            <label>Email address</label>
                                            <input type="text" placeholder="js@email.com"  autocomplete="off" wire:model.defer="payment_user_email">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="pay_card_part">
                                    <div class="pay_hd">
                                        <h2 class="title_h3">Payment Method</h2>
                                    </div>
                                    <div class="row">
                                        <div id="card-element">
                                        {{-- <div class="col-md-6 fld_blk" wire:ignore>
                                            <label>Card number</label>
                                            <input type="text"   maxlength="19" placeholder="4444-5555-0000-0000" wire:model.defer="card_number">
                                        </div>
                                        
                                        <div class="col-md-6 fld_blk">
                                            <label>CVC/CVV</label>
                                            <input type="text" placeholder="123" wire:model.defer="card_cvv">
                                        </div>
                                        <div class="col-md-12 fld_blk">
                                            <label>Expiry date</label>
                                            <input type="text" placeholder="10/2029" wire:model.defer="card_expiry_date">
                                        </div> --}}
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
    
                    <div class="cus_cont_bar_col split_3">
                        <div class="cus_cont_bar">
                            <div class="cus_cnt_hd">
                                <h2 class="title_h1">Intro Plan</h2>
                                <div class="title_h3">$27/month</div>
                                <hr>
                            </div>
                            <div class="cus_cnt_body">
                                
                                <table>
                                    <tr>
                                        <td><strong>Up to 10 Access Users</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Deal Campaign</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gimmzi Page</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Digital Loyalty Punch Card</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Loyalty Spend Goal Program</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gift Manager</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>100 Enrolled Members</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Point Earning Purchases</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Performance Reports</strong></td>
                                        <td>Included</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dedicated Gimmzi Advocate
                                            Support Member</strong></td>
                                        <td>Included</td>
                                    </tr>
                                </table>
                               
                               
                               
                                
                            </div>
                            <div class="cus_cnt_ft">
                                {{-- <button wire:click="paymentInfoSubmit" class="cmn_theme_btn full" id="submit-button">Pay now</button> --}}
                                <form id='paymentInfoSubmit'>
                                    <input type="hidden" id="crd_no" value="{{$card_number}}">
                                    <input type="hidden" id="cvv" value="{{$card_cvv}}">
                                    <input type="hidden" id="expiry"  value="{{$card_expiry_date}}">
                                    <button class="cmn_theme_btn full" wire:loading.attr="disabled" wire:loading.class="loading" id="submit-button">Pay now</button>
                                </form>
                                <div class="dclm_text">Please contact customer service at
                                    844-4GlMMZl (844-444-6694) to adjust
                                    or cancel your plan. No refunds apply. By
                                    clicking below, you are agreeing to
                                    Gimmzi's <a href="#">Privacy Policy</a>. <a href="#">Terms of Use</a> and
                                    <a href="#">Spam Policy</a></div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                    <div class="col-12 ">
                        <a class="cmn_theme_btn bordered" wire:click.prevent='goToCongrax'>Back to account Setup</a>
                    </div>
                    
                    @endif

                    @if($step9 == true)
                    <div class="cus_cont_bar_col">
                        <div class="cus_cont_bar">
                            <div class="col-12 ">
                                <a class="cmn_theme_btn bordered" wire:click.prevent='goToPayment'>Back</a>
                            </div>
                        </div>
                    </div>
                    @endif

                
            </div>
        </div>
    </div>


    

    <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="stripe_new_popup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="stripe_new_popup_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd " wire:click="stripe_new_popup_close">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="stripe_error_popup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="stripe_error_popup_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd " wire:click="stripe_error_popup_close">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal emailSentModal fade" id="emailSentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
            <div class="icon_back_cov"><img src="{{asset('frontend_assets/images/icon-email-send-d.svg')}}" alt=""></div>
            <p class="title_h1"> Email Sent To: {{$name}}<br>( {{$email}} )</p>

            <p>Check your email and use the link provided to validate and retrieve
                your user login.</p>
            <p class="ems_last_para"><em>Be sure to double-check your spam folder if you didn't receive this
                email</em></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="cmn_theme_btn" wire:click.prevent='close_email_send_popup'>Close</button>

            </div>
        </div>
        </div>
    </div>

    <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="new_popup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="new_popup_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd new_popup_close" >ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self class="modal fade cmn_modal" data-bs-backdrop = 'static' id="Add_Item_Service" tabindex="-1" aria-labelledby="Add-Item-ServiceLable" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal text-left">
                    <div class="d-flex justify-content-between">
                        <h1>Item And Service Database</h1>
                        <button class="cancel-button" wire:click='cancelAddItem'>CANCEL</button>
                    </div>

                        <div class="Gimmzi-Gift-Manager ">
                            <div class="btn_title">
                                <h2 id="collapsetitle">Add an item or service to database</h2>
                            </div>
                        </div>
                        <div id="itemserviceform" >
                            <form  wire:submit.prevent='addItemService'>

                                <div class="Gimmzi-Gift-Manager ">
                                    <h2>Enter the name of item or service below</h2>
                                    <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                        wire:model="item_service_name" />
                                </div>
                                @error('item_service_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="row value-of-this-gift">
                                    <div class="col-sm-6">
                                        <h3>Enter the Value of this Item</h3>
                                        <h4>the amount the customer would normally pay</h4>
                                        <div class="customer-input">
                                            <label>$</label>
                                            <input type="text" wire:model="value_one" id="value_one" class="value-input-text" />
                                            <label>.</label>
                                            <input type="text" wire:model="value_two" id="value_two" class="value-input-text" />
                                        </div>
                                        @error('value_one')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <br>
                                        @error('value_two')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <h3>Notes (Optional)</h3>
                                        <textarea class="note-text" wire:model="note" id="note"></textarea>
                                        @error('note')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="ajax_response" style="float:left">
                                        
                                    </div>
                                </div>
                                
                                <div class="gift-database-main">
                                    <div class="d-flex justify-content-between">
                                        <h3></h3>
                                        
                                        <div class="filter-sec-manage-programs">
                                    
                                            <button type="submit" id="submit_item">Add To Database</button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

    {{---PARTICIPATING LOCATION MODAL START----}}
    <div wire:ignore.self class="modal fade cmn_modal" id="addpartloc" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="deal_participating_location">
                <div class="modal-header">
                <div class="modal-title title_h1">Add New Participating location</div>
                </div>
                <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Name <span class="ast">*</span></label>
                                <input type="text" wire:model.defer= "business_location_name" placeholder="Enter your business location name">
                                {{-- @dd($errors) --}}
                                <span>@if ($errors->has('business_location_name'))
                                    <div class="error" style="color:red;">{{ $errors->first('business_location_name') }}</div>
                                @endif</span>
                        </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Phone Number <span class="ast">*</span></label>
                                <input type="text" wire:model.defer= "business_location_phone" placeholder="Enter your business location phone number" onkeypress="return isNumber(event);">
                            
                        <span> @if ($errors->has('business_location_phone'))
                            <div class="error" style="color:red;">{{ $errors->first('business_location_phone') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>Business Location Fax Number</label>
                                <input type="text" wire:model.defer="business_location_fax" placeholder="Enter your business location fax number" onkeypress="return isNumber(event);">
                            </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Email</label>
                                <input type="email" wire:model.defer="business_location_email" placeholder="Enter your business location email">
                            </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Location Street Address <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="business_location_street" placeholder="Enter your location street address" id="add_business_address" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="NewinitAutocomplete()">

                                <input type="hidden" wire:model.defer="location_latitude" id="add_latitude">
                                <input type="hidden" wire:model.defer="location_longitude" id="add_longitude">
                            <span> @if ($errors->has('business_location_street'))
                            <div class="error" style="color:red;" >{{ $errors->first('business_location_street') }}</div>
                            @endif </span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>Location Zip Code <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="business_location_zip" placeholder="Enter your location zip code" onkeypress="return isNumber(event);">
                            
                            <span>@if ($errors->has('business_location_zip'))
                            <div class="error" style="color:red;">{{ $errors->first('business_location_zip') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>City <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="business_location_city" placeholder="Enter your location city">
                            
                            <span>@if ($errors->has('business_location_city'))
                            <div class="error" style="color:red;">{{ $errors->first('business_location_city') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>State <span class="ast">*</span></label>
                                <select class="select-business-category" wire:model.defer="business_location_state" id="profileState">
                                    <option value=""> Select State </option>
                                    @if ($stateList)
                                        @foreach ($stateList as $states)
                                            <option value="{{ $states->id }}" >
                                                {{ $states->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            
                            <span>@if ($errors->has('business_location_state'))
                            <div class="error" style="color:red;">{{ $errors->first('business_location_state') }}</div>
                            @endif</span>
                        </div>
                            <div class="col-md-12 fld_blk fld_blk_chk">
                                <label> <input type="checkbox"> <span></span> This deal will be available at this location. By unchecking you are not connecting this deal to this location. However, you can add this deal or any new deals to this location later using Add/Manage Participating locations in your business profile.</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer left">
                <button type="button" class="cmn_theme_btn close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="cmn_theme_btn">Add</button>
                </div>
            </form>
        </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade cmn_modal" id="editmodal" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="save_participating_location">
                <div class="modal-header">
                <div class="modal-title title_h1">Edit Participating location</div>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <input type="hidden" wire:model.defer="lctn_id">
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Name <span class="ast">*</span></label>
                                <input type="text" wire:model.defer= "edit_business_location_name" placeholder="Enter your business location name">
                                {{-- @dd($errors) --}}
                                <span>@if ($errors->has('edit_business_location_name'))
                                    <div class="error" style="color:red;">{{ $errors->first('edit_business_location_name') }}</div>
                                @endif</span>
                        </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Phone Number <span class="ast">*</span></label>
                                <input type="text" wire:model.defer= "edit_business_location_phone" placeholder="Enter your business location phone number" onkeypress="return isNumber(event);">
                            
                        <span> @if ($errors->has('edit_business_location_phone'))
                            <div class="error" style="color:red;">{{ $errors->first('edit_business_location_phone') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>Business Location Fax Number</label>
                                <input type="text" wire:model.defer="edit_business_location_fax" placeholder="Enter your business location fax number" onkeypress="return isNumber(event);">
                            </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Business Location Email</label>
                                <input type="email" wire:model.defer="edit_business_location_email" placeholder="Enter your business location email">
                            </div>
                            
                            <div class="col-md-6 fld_blk">
                                <label>Location Street Address <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="edit_business_location_street" id="edit_business_location_street" placeholder="Enter your location street address" autocomplete="new-address" onfocus="disableAutocomplete(this)" onkeyup="editinitAutocomplete()">
                                <input type="hidden" wire:model.defer="edit_location_latitude" id="edit_add_latitude">
                                <input type="hidden" wire:model.defer="edit_location_longitude" id="edit_add_longitude">
                            
                            <span> @if ($errors->has('edit_business_location_street'))
                            <div class="error" style="color:red;" >{{ $errors->first('edit_business_location_street') }}</div>
                            @endif </span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>Location Zip Code <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="edit_business_location_zip" placeholder="Enter your location zip code" onkeypress="return isNumber(event);">
                            
                            <span>@if ($errors->has('edit_business_location_zip'))
                            <div class="error" style="color:red;">{{ $errors->first('edit_business_location_zip') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>City <span class="ast">*</span></label>
                                <input type="text" wire:model.defer="edit_business_location_city" placeholder="Enter your location city">
                            
                            <span>@if ($errors->has('edit_business_location_city'))
                            <div class="error" style="color:red;">{{ $errors->first('edit_business_location_city') }}</div>
                            @endif</span>
                        </div>

                            <div class="col-md-6 fld_blk">
                                <label>State <span class="ast">*</span></label>
                                <select class="select-business-category" wire:model.defer="edit_business_location_state" id="profileState">
                                    <option value=""> Select State </option>
                                    @if ($stateList)
                                        @foreach ($stateList as $states)
                                            <option value="{{ $states->id }}" >
                                                {{ $states->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            
                            <span>@if ($errors->has('edit_business_location_state'))
                            <div class="error" style="color:red;">{{ $errors->first('edit_business_location_state') }}</div>
                            @endif</span>
                        </div>
                            <div class="col-md-12 fld_blk fld_blk_chk">
                                <label> <input type="checkbox"> <span></span> This deal will be available at this location. By unchecking you are not connecting this deal to this location. However, you can add this deal or any new deals to this location later using Add/Manage Participating locations in your business profile.</label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer left">
                <button type="button" class="cmn_theme_btn close" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="cmn_theme_btn">Save</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    {{---PARTICIPATING LOCATION MODAL START----}} 

    <div wire:ignore.self class="modal fade cmn_modal" id="editpartloc" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form wire:submit.prevent="participating_location_add">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 fld_blk">
                        <label>Number of physical location</label>
                        <input type="text" placeholder="02" wire:model.defer="edit_physical_address">
                    </div>
                    <div class="col-md-6 fld_blk">
                        <label>Location added</label>
                        <input type="text" placeholder="1 of 2 locations" wire:model.defer="edit_added_location">
                    </div>
                </div>
                @if($get_all_location)
                @foreach($get_all_location as $location)
                <div class="fld_blk fld_table">
                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th>Participating Locations</th>
                            <th>For This Deal</th>
                            <th>Manage</th>
                        </tr>
                        <tr>
                            <td>{{$location->location_name}},{{$location->city}},{{$location->state}},{{$location->zip_code}}</td>
                            <td>Yes</td>
                            <td><a href="javascript:void(0);" wire:click="EditLocation" class="table_text_link">Edit Location</a></td>
                        </tr>
                        </table>
                    </div>
                </div>
                @endforeach
                @endif
                {{-- <div class="fld_blk fld_table">
                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th>Non Participating Locations</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>{{$primary_business_address}}</td>
                        </tr>
                        </table>
                    </div>
                </div> --}}

                <div class="re_add_loc_wrap">
                    <p>At least one Participating Location for this deal is required to complete
                        this deal creation.</p>
                    <button class="cmn_theme_btn">ADD PARTICIPATING LOCATION</button>
                    {{-- <button type="button" class="cmn_theme_btn close" data-bs-dismiss="modal">Close</button> --}}
                </div>
                    
            </div>
            </form>
        </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal" id="nonpartloc" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <form wire:submit.prevent="deal_non_participating_location">
            <div class="modal-header">
            <div class="modal-title title_h1">Is this a Non-participating Location?</div>
            </div>
            <div class="modal-body text-center">
                    <div class="title_h2">{{$primary_business_address}}</div>
                    <div class="lg_popup_para">
                        <p>Select Yes, if this location is not a location where customers purchase products
                            and/or staff process transactions with your customers.</p>
                        <p>Examples include headquarters, mailing address and/or a billing address only.
                            Limit 1 non-participating location per account</p>
                        <p>Select No, if you will be using this location for other deals but you do not wish to use
                            the deal being created at this location as of today.</p>
                        <p>Note: You can add this deal to this location at anytime in your merchant portal later</p>
                    </div>
            </div>
            <div class="modal-footer center">
            <button type="button" class="cmn_theme_btn close" data-bs-dismiss="modal">No</button>
            
            <a class="cmn_theme_btn" wire:click.prevent='clickToOpenPerticipatingModal'>Yes</a>

            </div>
        </form>
        </div>
        </div>
    </div>

    <div wire:ignore.self  data-bs-backdrop = 'static' class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="textmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd " type="button" wire:click.prevent='closeMessageModal'>Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade voucherModal default-modal" id="voucherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                    @if($voucher_limit != '')
                        @if($voucher_limit <= 30)
                            <div class="voucher_tag_offer">limited time offer</div>
                        @endif
                    @endif

                    @if($main_deal_image_upload != '')
                        <img src="{{ asset('storage/tmp/'.$main_deal_image_upload->getFilename()) }}" alt="">
                    @else
                        @if($deal_image != '')
                            <img src="{{ asset('storage/tmp/'.$deal_image->getFilename()) }}" alt="">
                        @else
                            @if($business_logo != '')
                                <img src="{{ asset('storage/tmp/'.$business_logo->getFilename()) }}" alt="">
                            @endif
                        @endif
                    @endif
                    
                    
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                    <div class="title_h2">{{$business_name}}</div>
                    @if($deal_address)
                        <p>{{$deal_address}}</p>
                    @else
                        <p>10 Main Street, Wilmington NC • 2.3 mi</p>
                    @endif

                    <div class="vou_succ_text">
                        @if($deal_description)
                            {{$deal_description}} 
                        @endif
                        <br>
                        @if($deal_point)
                            {{$deal_point}} Points to redeem
                        @endif
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add to wallet</button>
                    </div>
                </div>

            </div>

            <div class="def-modal-upload">
                <input type="file" id="file-up-loyalty" wire:model.live="main_deal_image_upload" class="file_up_input">
                <label for="file-up-loyalty" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('main_deal_image_upload')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>

        </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade voucherModal default-modal" data-bs-backdrop = 'static' id="programpreviewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close closeprogramPreview" aria-label="Close"><img src="{{ asset('frontend_assets/images/close-error-x.svg')}}" alt="close icon"></button>
            <div class="modal-body">
                <div class="voucher_card_top">
                    @if($this->purchase_goal == 'free')
                        @if($this->off_percentage != '')
                        <div class="voucher_tag_sale">{{$this->off_percentage}}</div>
                        @endif
                    @endif


                        @if($main_image_upload_loyalty != '')
                            <img src="{{ asset('storage/tmp/'.$main_image_upload_loyalty->getFilename()) }}" alt="">
                        @else
                            @if($loyalty_single_photo != '')
                                <img src="{{ asset('storage/tmp/'.$loyalty_single_photo->getFilename()) }}" alt="">
                            @else
                                @if($business_logo !='')
                                    <img src="{{ asset('storage/tmp/'.$business_logo->getFilename()) }}" alt="">
                                @endif
                            @endif
                        @endif                
                    
                    <div class="voucher_list">
                        <ul>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-share-icon.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void(0);"><img src="{{ asset('frontend_assets/images/vou-wishlist-icon.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="voucher_card_btm">
                    {{-- <div class="title_h2">{{Auth::user()->merchantBusiness->business_name}}</div> --}}
                    @if($loyalty_address)
                        <p>{{$loyalty_address}}</p>
                    @else
                        <p>10 Main Street, Wilmington NC • 2.3 mi</p>
                    @endif
                    
                    <div class="vou_succ_text">
                        @if($progameName)
                            {{$progameName}} 
                        @endif
                        <br>
                        @if($program_point)
                            Earn up to {{$program_point}}  loyalty points
                        @endif
                    </div>
                    <div class="voucher_card_btn_cont">
                        <button class="cmn_theme_btn">Add To Wallet</button>
                    </div>
                </div>

            </div>

            <div class="def-modal-upload">
                <input type="file" id="file-up-from-loyalty" wire:model.live="main_image_upload_loyalty" class="file_up_input" >
                <label for="file-up-from-loyalty" class="file_up_label">
                    <span class="file_up_icon"><img src="{{ asset('frontend_assets/images/upload-icon-d.svg')}}" alt="upload icon"></span>
                    <span class="file_up_text1"><span>Click to upload</span></span>
                    <span  class="file_up_text2">PNG, JPG (25 MB Maximum)</span>
                    @error('main_image_upload_loyalty')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>
        </div>
        </div>
    </div>

    <div wire:ignore.self  data-bs-backdrop = 'static' class="modal fade cmn_modal_designs gap_sec_modal2" id="advertise_model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="textmsg">Do you want to publist yout Event on the app?</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd " type="button" wire:click.prevent='YesAdvertiseModel'>Yes</button>
                                <button class="btn_table_s blu auto_wd " type="button" wire:click.prevent='NoAdvertiseModel'>No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self  class="modal fade" id="itemPriceEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
                <h5 class="modal-title" id="staticBackdropLabel" style="text-align:center;">Item & Services</h5>
                <p style="color:#797575">Review the original prices listed below.</p>
                <p style="color:#797575">if a price is missing, please enter a value. Update any price as needed.</p>
                <p style="color:#797575">These can be estimates and will be used to determine point values for the loyalty reward program.</p><hr>
                <div class="row">
                    @if($get_items)
                    @foreach($get_items as $index => $item)
                        <div class="col-md-6">
                            {{$item['item_name']}}
                        </div>
                        <div class="col-md-6" style="text-align:right;">
                            <input type="text" wire:model.live="selected_item_value.{{ $item['id'] }}" id="selected_item_value_{{ $item['id'] }}">
                            @error("selected_item_value.$item[id]") 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            {{-- @error('selected_item_value')
                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    {{ $message }}
                                </span>
                            @enderror --}}
                        </div> <br>
                    @endforeach
                    @endif
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" wire:click.prevent='submitNewItemPrice'>Confirm</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Go Back</button>
            </div>
          </div>
        </div>
    </div>

<style>
 
    .business-address-input:disabled {
        background-color: #e0e0e0 !important; /* Light gray */
        color: #7a7a7a !important; /* Darker gray text */
        cursor: not-allowed;
        border: 1px solid #d6d6d6;
    }
    .loading {
        opacity: 0.7;
        pointer-events: none;
        /* color:#979595; */
    }
</style>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>


<script>

    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (event) {
            const target = event.target;
            if (target && target.id === 'closeLink') {
                const itemServiceDiv = document.getElementById('itemserviceshowhide');
                Livewire.emit('closeitemservice');
                if (itemServiceDiv) {
                    itemServiceDiv.style.display = 'none';
                }
            }
        });
    });

    function disableAutocomplete(input) {
        input.setAttribute('autocomplete', 'new-password');
    }


    $(document).ready(function () {

        $(document).on('keyup', '#how_much', function() {  
                var amount = $(this).val();
                var free = 1;
                var total = parseInt(amount) + parseInt(free);
                console.log($(this).val());
                var a = amount % 10;
                var b = amount % 100;
                if (a == 1 && b != 11) {
                    totals = total + "nd";
                    console.log(totals);
                } else if (a == 2 && b != 12) {
                    totals = total + "rd";
                    console.log(totals);
                } else if (a == 0 && b != 10) {
                    totals = total + "st";
                    console.log(totals);
                } else {
                    totals = total + "th";
                    console.log(totals);
                }

                if (amount != "") {
                    $(".get_free").val(totals);
                    @this.set('free_item',totals);
                    @this.set('free_item_no',total);

                } else {
                    $(".get_free").val("");
                    @this.set('free_item','');
                    @this.set('free_item_no','');
                }
        });

        $(document).ready(function() {
            $(document).on('focus', '#spend_amount', function() {
                var price = $(this).val();
                if(price === ''){
                    $(this).val('$');
                }
            });

            $(document).on('blur', '#spend_amount', function() {
                var price = $(this).val();
                price = price.substr(1); // Remove the dollar sign from the value
                if (!isNaN(price)) {
                    $("#program_amount").val(price);
                    @this.set('program_amount', price);
                }
            });
        });


        $(document).ready(function() {
            $(document).on('focus', '#itm_price', function() {
                var price = $(this).val();
                console.log(price+'-------');
                if(price === ''){
                    $(this).val('$');
                }
            });

            $(document).on('blur', '#itm_price', function() {
                var price = $("#itm_price").val();
                
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#itm_price").val(USDollar.format(price));
                    @this.set('item_price',USDollar.format(price));
                }
            });
        });

        $(document).on('blur', '#spend_amount',function(){
            var price = $("#spend_amount").val();
            price.substr(1);
            if(price[0] == '$'){
                price = price.replace('$', '');
                $("#program_amount").val(price);
                @this.set('program_amount',price);
            }
            else{
                $("#program_amount").val(price);
                @this.set('program_amount',price);
            }
        
            if($("#loyalty_discount_type:checked").val() == 'dollar'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#spend_amount").val(USDollar.format(price));
                    @this.set('spend_amount',USDollar.format(price));
                }
            }
            else if($("#loyalty_discount_type:checked").val() == 'percentage'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#spend_amount").val(USDollar.format(price));
                    @this.set('spend_amount',USDollar.format(price));
                }
            }
            else{

            }
        });

        $(document).on('blur', '#discount_amount',function(){

            var price = $("#discount_amount").val();
            console.log('****>>'+price);
                //   price.substr(1);
                //   if(price[0] == '$'){
                //      price = price.replace('$', '');
                //      console.log('****'+price);
                //      $("#dscnt_amount").val(price);
                //      @this.set('dscnt_amount',price);
                //   }
                //   else if($("#discount_amount").val().substr($("#discount_amount").val().length - 1) == '%'){
                //      var price1 = $("#discount_amount").val().replace('%', '');
                //      console.log('%%%-=-->> '+price1);
                        
                //      $("#dscnt_amount").val(price1);
                //      console.log('%%%-=-->>-- '+("#dscnt_amount").val(price1));
                //      @this.set('dscnt_amount',price1);
                //   }
                //   else{
                //      console.log('else---'+$("#dscnt_amount").val(price));
                //      $("#dscnt_amount").val(price);
                //   }


                //  console.log('===='+price); 

                //  $("#dscnt_amount").val(price);
                //  @this.set('dscnt_amount',price);

            if (price.startsWith('$')) {
                price = price.replace('$', '').replace(/,/g, '');
            }
            else if (price.slice(-1) === '%') {
                price = price.replace('%', '').replace(/,/g, ''); 
            }
            else {
                price = price.replace(/,/g, '');
            }

            // price = parseFloat(price).toFixed(2);

            console.log('Final price -> ' + price);

            $("#dscnt_amount").val(price);
            @this.set('dscnt_amount', price);


            if($("#loyalty_discount_type:checked").val() == 'dollar'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#discount_amount").val(USDollar.format(price));
                    @this.set('loyalty_discount_amount',USDollar.format(price));
                    
                }
            }
            else if($("#loyalty_discount_type:checked").val() == 'percentage'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    new_price = price;
                    price = price+'%';
                    $("#discount_amount").val(price);
                    @this.set('loyalty_discount_amount',price);
                }
            }
            else{

            }
        })

        $(document).on('click', '#loyalty_discount_type',function(){
            if($("#program_amount").val() != ''){
                var price = $("#program_amount").val();
            }
            else{
                var price = $("#spend_amount").val();
            }
            if($("#dscnt_amount").val() != ''){
                var dis_price = $("#dscnt_amount").val();
            }
            else{
                var dis_price = $("#discount_amount").val();
            }
            if($(this).val() == 'dollar'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#spend_amount").val(USDollar.format(price));
                    @this.set('spend_amount',USDollar.format(price));
                }
                console.log('dis_price'+dis_price);
                if(/^[+-]?\d+(\.\d+)?$/.test(dis_price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                                console.log('dis_price--'+USDollar.format(dis_price));
                    $("#discount_amount").val(USDollar.format(dis_price));
                    @this.set('loyalty_discount_amount',USDollar.format(dis_price));
                }
            }
            else if($(this).val() == 'percentage'){
                if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                    let USDollar = new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD',
                                });
                    $("#spend_amount").val(USDollar.format(price));
                    @this.set('spend_amount',USDollar.format(price));
                }

                if(/^[+-]?\d+(\.\d+)?$/.test(dis_price) == true){
                    new_dis_price = dis_price+'%';
                    console.log('__'+new_dis_price);
                    $("#discount_amount").val(new_dis_price);
                    @this.set('loyalty_discount_amount',new_dis_price);
                }
            }
            else{

            }
        });

        $(document).on('blur', '#deal_discount_amount',function(){
            console.log($(".discount_type:checked").val());
            var price = $("#deal_discount_amount").val();
            price.substr(1);
            if(price[0] == '$'){
                price = price.replace('$', '');
                console.log(price);
                $("#hide_discount_amount").val(price);
                @this.set('discount_amount',price);
            }
            else if($("#deal_discount_amount").val().substr($("#deal_discount_amount").val().length - 1) == '%'){
                var price1 = $("#deal_discount_amount").val().replace('%', '');
                $("#hide_discount_amount").val(price1);
                @this.set('discount_amount',price1);
            }
            else{
                $("#hide_discount_amount").val(price);
                @this.set('discount_amount',price);
            }

            
            console.log($("#hide_discount_amount").val());
            if($(".discount_type:checked").val() != ''){
                if($(".discount_type:checked").val() != 'Percentage'){
                    var price = $("#deal_discount_amount").val();
                    if(/^[+-]?\d+(\.\d+)?$/.test(price) == true){
                        let USDollar = new Intl.NumberFormat('en-US', {
                                        style: 'currency',
                                        currency: 'USD',
                                    });
                        console.log(USDollar.format(price));
                        $("#deal_discount_amount").val(USDollar.format(price));
                        @this.set('show_discount_amount',USDollar.format(price));
                    }
                }
                else{
                    price = $("#hide_discount_amount").val()+'%'; 
                    $("#deal_discount_amount").val(price); 
                    @this.set('show_discount_amount',price);
                }
            }

            else{
                
            }

        })

        $(document).on('click',".getprofile",function(){
            // console.log(123);
            window.location.href =  "{{ route('frontend.business_owner.account') }}";
        })

        window.initTicketTypesDrop = () => {

            $(".select_loyalty_location")({
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
            }).on('change', function(e) {
                var itemdata = $('.select_loyalty_location')("val");
                console.log(itemdata);
                // localStorage.setItem('itemid', itemdata);
                @this.set('loyalty_location_ids', itemdata);
            });
            // console.log('select_loyalty_item')
            // $(".select_loyalty_item")({
            //     width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            //     placeholder: $( this ).data( 'placeholder' ),
            // }).on('change', function(e) {
            //     var itemdata = $('.select_loyalty_item')("val");
            //     console.log(itemdata);
            //     // localStorage.setItem('itemid', itemdata);
            //     @this.set('loyalty_item_id', itemdata);
            // });

            $(".select_item")({
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
            }).on('change', function(e) {
                var itemdata = $('.select_item')("val");
                console.log(itemdata);
                localStorage.setItem('itemid', itemdata);
                @this.set('item_id', itemdata);
            });

            $(".select_location")({
                // theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
            }).on('change', function(e) {
                
                    var data = $('.select_location')("val");
                    console.log(data);
                    localStorage.setItem('locationids', data);
                    @this.set('location_ids', data);
                
                
            });

        }
        initTicketTypesDrop();

    });
//----------------------------------------------------------

function initSelect2() {
    $('.select_loyalty_item').select2({
        width: '100%',
        placeholder: "Select Item or Service",
        allowClear: true
    });

    $('.select_loyalty_item').on('change', function () {
        let selectedItems = $(this).val();
        @this.set('loyalty_item_id', selectedItems);
    });
}

// Ensure Select2 initializes when Step 3 becomes visible
document.addEventListener("DOMContentLoaded", function () {
    initSelect2(); // Initialize Select2

    // Watch for Livewire DOM updates
    Livewire.hook('message.processed', () => {
        initSelect2(); // Reinitialize after Livewire updates
    });

    // Reinitialize when moving to Step 3
    document.addEventListener("stepChanged", function (event) {
        if (event.detail.step === 3) { // When Step 3 is shown
            initSelect2();
        }
    });
});






  //--------------------------------------------------------  
    // document.addEventListener("DOMContentLoaded", function() {
    //     $('.select_loyalty_item').select2();

    //     $('.select_loyalty_item').on('change', function() {
    //         @this.set('loyalty_item_id', $(this).val());
    //     });
        
    //     initSelect2();

    //     Livewire.hook('message.processed', () => {
    //         initSelect2();
    //     });
    // });
//---------------------------------------------------

    // window.livewire.on('select2', () => {
    //             initTicketTypesDrop();
    //         });

    document.addEventListener('livewire:load', function(event) {
        //----------------
        @this.on('openItemPriceModal',function() {
            console.log('$loyalty_step3 == true');
            $("#itemPriceEditModal").modal('show');
            // $(".multi-select").css('display','none');
        });

        // @this.on('hideStyle',function() {
        //     $(".multi-select").css('display','none');
        // });

        // @this.on('hideStyleoff',function() {
        //     $(".multi-select").css('display','block');
        // });

        @this.on('closeOpenItemPriceModal',function() {
            $("#itemPriceEditModal").modal('hide');
        });
        //-----------------
        

        @this.on('mailSendPopup', data => {
            $("#emailSentModal").modal('show');
            $("#emailSendMsg").text(data.text);
        });

        @this.on('closeSuccessPopup',function(){
            $("#emailSentModal").modal('hide');
            $("#emailSendMsg").text('');
        });

        @this.on('popUp', data => {
            $("#new_popup").modal('show');
            $("#new_popup_msg").text(data.text);
        });

        @this.on('stripePopUp', data => {
            $("#stripe_new_popup").modal('show');
            $("#stripe_new_popup_msg").text(data.text);
        });

        @this.on('errorPopUp', data => {
            $("#stripe_error_popup").modal('show');
            $("#stripe_error_popup_msg").text(data.text);
        });

        @this.on('OpenAdvertiseModel', data => {
            $("#advertise_model").modal('show'); 
        });
        @this.on('offAdvertiseModel', data => {
            $("#advertise_model").modal('hide');
        });

        

        @this.on('closeprogramPreview', data => {
            console.log('close preview model');
                //$(".multi-select").css('display','block');
                $("#programpreviewModal").modal('hide');
        });



        @this.on('summernoteOn', data => {
            
            $('#merchant_story').summernote({
                height: 150,
                callbacks: {
                    onChange: function (contents) {
                        @this.set('story_message', contents);
                        @this.emit('business_story_message');

                    }
                }
            });
        });

        @this.on('summernoteOver', data => {
            
            $('#b_overview').summernote({
                height: 150,
                callbacks: {
                    onChange: function (contents) {
                        @this.set('overview_message', contents);
                        @this.emit('business_overview_message');

                    }
                }
            });
        });

        $(document).on('click', '.new_popup_close', function() {
            $("#new_popup").modal('hide');
            $("#new_popup_msg").text('');
        });


        @this.on('participatingLocationPopup', data => {
            $("#nonpartloc").modal('hide');
            $("#editpartloc").modal('hide');
            $("#addpartloc").modal('show');
        });

        @this.on('CloseNonParticipatingLocationPopup', data => {
            $("#nonpartloc").modal('hide');
            $("#addpartloc").modal('hide');
        });

        @this.on('participatingLocationClosePopup', data => {
            $("#addpartloc").modal('hide');
            $("#editpartloc").modal('show');
        });

        @this.on('participatingLocationEditClosePopup', data => {
            $("#addpartloc").modal('hide');
            $("#editpartloc").modal('hide');
        });

        @this.on('nonParticipatingLocationPopup', data => {
            console.log('000000000000');
            $("#nonpartloc").modal('show');
        });

        @this.on('nonParticipatingLocationClosePopup', data => {
            console.log('++++++');
            $("#nonpartloc").modal('hide');
            $("#addpartloc").modal('show');
        });

        @this.on('openeditModal', data => {
            $("#editmodal").modal('show');
            $("#editpartloc").modal('hide');
        });

        @this.on('closeditModal', data => {
            $("#editmodal").modal('hide');
            // $("#editpartloc").modal('hide');
        });

        @this.on('openAddItemModal',function() {
            console.log('******************');
            $("#Add_Item_Service").modal('show');
            console.log("Open Modal");
            // $('#Add_Item_Service').css('display', 'block').addClass('show');
        });
        @this.on('add_item_cancel',function() {
            $("#Add_Item_Service").modal('hide');
        });

        
            @this.on('dealDatepicker', function() {
            console.log('datepicker');
                $(".start_datepicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    setdate: new Date()
                }).on('change', function(e) {
                    console.log(e.target.value);
                    @this.set('start_date', e.target.value);
                    @this.emit('dealDatepickerEnable');
                });

                $(".end_datepicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    setdate: new Date()
                }).on('change', function(e) {
                    console.log(e.target.value);
                    @this.set('end_date', e.target.value);
                    @this.emit('dealDatepickerEnable');

                });

        });

    

        @this.on('enableparticipatinglocation',function() {
            $("#addpartloc").modal('show');
            // $(".multi-select").css('display','none');
        
        });
        @this.on('disableparticipatinglocation',function() {
            $("#addpartloc").modal('hide');
            $("#success_modal").modal('hide');
            $(".multi-select").css('display','block');
        
        });

        @this.on('participatinglocationsuccess',data=> {
            $("#success_modal").modal('show');
            $("#addpartloc").modal('hide');
            // $('.select_location').html('');
            if(data.location != ''){
            console.log(data.location_id);
            //    $('.select_location').trigger('change');
            $('.select_location').val(data.location_id);
                
                var option = '<option value='+data.location.id+'>'+data.location.address+'</option>';
                $('.select_location').append(option);
            }
        
        });

        @this.on('enablepreviewdeal',function() {
            $("#voucherModal").modal('show');
        });

        @this.on('enablepreviewprogram',function() {
        //  $(".multi-select").css('display','none');
        // console.log('casc-----');
            $("#programpreviewModal").modal('show');
        });


        @this.on('enableloyaltydatepicker', function() {

            $(".start_lotalty_datepicker").datepicker({
                dateFormat: "mm/dd/yy",
                changeMonth: true,
                changeYear: true,
                minDate: 0,
                setdate: new Date()
            }).on('change', function(e) {
                //console.log(e.target.value);
                @this.set('loyalty_start_date', e.target.value);
                @this.emit('dealDatepickerEnable');

            });

            $(".end_loyalty_datepicker").datepicker({
                dateFormat: "mm/dd/yy",
                changeMonth: true,
                changeYear: true,
                minDate: 0,
                setdate: new Date()
            }).on('change', function(e) {
                console.log(e.target.value);
                @this.set('loyalty_end_date', e.target.value);
                @this.emit('dealDatepickerEnable');


            });

        });

        @this.on('enableeventdatepicker', function() {
        let maxDateLimit = new Date();
        maxDateLimit.setMonth(maxDateLimit.getMonth() + 8);
        console.log('maxDateLimit-',maxDateLimit);
        $(".start_event_datepicker").datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            maxDate: maxDateLimit,
            setdate: new Date()
        }).on('change', function(e) {
            @this.set('event_start_date', e.target.value);
            @this.emit('dealDatepickerEnable');

            let startDate = $.datepicker.parseDate("mm/dd/yy", e.target.value);
            console.log("startDate", startDate);
            setTimeout(() => {
                $(".end_event_datepicker").datepicker("option", "minDate", startDate);
            }, 100);
        });

        $(".end_event_datepicker").datepicker({
            dateFormat: "mm/dd/yy",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            maxDate: maxDateLimit,
            setdate: new Date()
        }).on('change', function(e) {
            // console.log(e.target.value,'--end--');
            @this.set('event_end_date', e.target.value);
            @this.emit('dealDatepickerEnable');
        });

        });
    

        @this.on('messageModal',data=> {
        console.log('message modal');
            // $(".sngl_select").css('display','none');
        //  $("#Add_Item_Service").modal('hide');
            $("#message_modal").modal('show');
            $('#textmsg').text(data.text);
        });

        @this.on('offmessagemodal',function() {
            @this.set('item_id', '');
            $("#Add_Item_Service").modal('hide');
            $("#message_modal").modal('hide');
            $('#textmsg').text('');
        });

        @this.on('executeJS',function (){
        $("#stripe_error_popup").modal('hide');
        $("#stripe_error_popup_msg").text('');
        console.log('11111111111111111');
        var stripe = Stripe('pk_test_51QRq50KSRycFM4otlb7G5sWgm3vQHyV0mzwCsHU0jRZe3j7SoT3ylLj4GI3EqRAGPYaCn0kfnnw3hvrNdUqoTOkn00LhcGJggi'); 
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        console.log(cardElement);
        // Handle form submission
        document.getElementById('paymentInfoSubmit').addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function (result) {
                if (result.error) {
                    console.log(result.error.message); // Handle the error
                } else {
                    console.log(result.token.id);
                    Livewire.emit('createCardToken', result.token.id);
                }
            });
        });
        });

    });


    $(document).on('show.bs.modal', '.modal', function() {
        const zIndex = 1040 + 10 * $('.modal:visible').length;
        $(this).css('z-index', zIndex);
        setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
    });

    function openModalAddItem() {
        console.log('js additemmodal open');
        Livewire.emit('openModalAddItam');
        // $("#Add_Item_Service").modal('show');
    }
     
    let autocomplete;
    function initAutocomplete() {
        const input = document.getElementById('add_listing_address');
        console.log(input);
        console.log('//////////');
        console.log(autocomplete);
        if (!autocomplete) {
            console.log('0000');
            // Initialize Google Places Autocomplete
            autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" }, // Restrict to your desired country
            });

            // Listen for the place selection event
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('updateStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('updateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('updateLatLng', { lat, lng });
                }
            });
        }
        console.log('1111');
    }

    //mailingaddress
    let mailautocomplete;
    function mailinitAutocomplete(){
        const input = document.getElementById('mailingaddress');

        if (!mailautocomplete) {
            mailautocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            mailautocomplete.addListener('place_changed', () => {
                const place = mailautocomplete.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('mailupdateStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('mailupdateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('mailupdateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('mailupdateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('mailupdateLatLng', { lat, lng });
                }
            });
        }
        console.log('1111');
    }


    let autocomplete1;
    function NewinitAutocomplete() {
        const input = document.getElementById('add_business_address');
        console.log(input);
        console.log('//////////');
        console.log(autocomplete1);
        if (!autocomplete1) {
            console.log('0000');
            // Initialize Google Places Autocomplete
            autocomplete1 = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" }, // Restrict to your desired country
            });

            // Listen for the place selection event
            autocomplete1.addListener('place_changed', () => {
                const place = autocomplete1.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('updateStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('updateZipCode', component.long_name); // Zip Code
                    }
                });

                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('updateLatLng', { lat, lng });
                }

            });
        }
        console.log('1111');
    }

    let autocomplete2;
    function editinitAutocomplete(){
        const input = document.getElementById('edit_business_location_street');
        console.log(input);
        console.log('//////////');
        console.log(autocomplete2);
        if (!autocomplete2) {
            console.log('0000');
            // Initialize Google Places Autocomplete
            autocomplete2 = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" }, // Restrict to your desired country
            });

            // Listen for the place selection event
            autocomplete2.addListener('place_changed', () => {
                const place = autocomplete2.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('updateStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('updateZipCode', component.long_name); // Zip Code
                    }
                });

                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('updateLatLng', { lat, lng });
                }

            });
        }
        console.log('1111');
    }
    
    let autocompleteServing1;
    function servingArea1Autocomplete(){
        console.log('enter----');
        const input = document.getElementById('serving_area1_street');

        if (!autocompleteServing1) {
            autocompleteServing1 = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            autocompleteServing1.addListener('place_changed', () => {
                const place = autocompleteServing1.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('serving1StreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('serving1updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('serving1updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('serving1updateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('serving1updateLatLng', { lat, lng });
                }
            });
        }
    }

    let autocompleteServing2;
    function servingArea2Autocomplete(){
        const input = document.getElementById('serving_area2_street');

        if (!autocompleteServing2) {
            autocompleteServing2 = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            autocompleteServing2.addListener('place_changed', () => {
                const place = autocompleteServing2.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('serving2StreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('serving2updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('serving2updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('serving2updateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('serving2updateLatLng', { lat, lng });
                }
            });
        }
    }

    let autocompleteServing3;
    function servingArea3Autocomplete(){
        const input = document.getElementById('serving_area3_street');

        if (!autocompleteServing3) {
            autocompleteServing3 = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            autocompleteServing3.addListener('place_changed', () => {
                const place = autocompleteServing3.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('serving3StreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('serving3updateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('serving3updateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('serving3updateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('serving3updateLatLng', { lat, lng });
                }
            });
        }
    }

    let autocompleteEvent;
    function eventAddressAutocomplete(){
        const input = document.getElementById('event_address');

        if (!autocompleteEvent) {
            autocompleteEvent = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            autocompleteEvent.addListener('place_changed', () => {
                const place = autocompleteEvent.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('eventStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('eventupdateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('eventupdateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('eventupdateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('eventupdateLatLng', { lat, lng });
                }
            });
        }
    }

 </script>
@endpush
</div>