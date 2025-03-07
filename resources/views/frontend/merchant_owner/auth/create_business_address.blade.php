<x-layouts.frontend-layout title="Create Your Business Profile">
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
                        <li class="header_close_btn closebtn"> <a>Close</a>
                        </li>
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
                <div class="col-sm-3">
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
                <div class="col-sm-9">
                    <div class="right_box_section">
                        <div class="pf-title">
                            <h2>Let’s get your business address added to your profile</h2>
                        </div>
                        <div class="search-business">
                           
                            <!-- <div class="form-group-rental-input">
                                <input type="text" placeholder="Business Name ">
                                <button>
                                    <img src="./images/search-icon-rental.svg" alt="">
                                </button>
                            </div> -->
                        </div>
                        <div class="business-pf-form">
                            {{ Form::open(['route' => 'frontend.business_owner.store_business_address', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}
                            
                            @if($profile != '')
                                <div class="row">
                                    @if($profile->business_type == 'Online Only' || $profile->business_type == 'Mobile Business')
                                    <div class="col-lg-12">
                                        <div
                                            class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="no_physical_address" class="gimigi-checkbok ifcheck"
                                                name="no_physical_address" <?php if($profile->no_physical_address == 1){echo 'checked';}?>>
                                            <label for="no_physical_address" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">
                                            You selected mobile or online only as your business type on the previous screen. Checking this box, you confirm you do not have a physical business address. However a mailing address is required for all businesses.</label>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                           
                                            <input type="text" placeholder="Street Address" class=""  id="streetaddress" name="street_address"
                                               value="{{ $profile->street_address }}">
                                        </div>
                                        @if ($errors->has('street_address'))
                                            <div class="error">{{ $errors->first('street_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="zip_code"
                                                value="{{ $profile->zip_code }}" id="zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="city"
                                                value="{{ $profile->city }}" id="profilecity">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="state_id" id="profileState">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if ($profile->state_id == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    

                                    <div class="col-lg-6">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="same_address" class="gimigi-checkbok ifcheck"
                                                name="same_address" <?php if($profile->same_address == 1){echo 'checked';}?>>
                                            <label for="html" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">Same as address listed above</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Mailing Address" class=""
                                                id="mailingaddress" name="mailing_address"
                                                value="{{ $profile->mailing_address }}">
                                        </div>
                                        @if ($errors->has('mailing_address'))
                                            <div class="error">{{ $errors->first('mailing_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="mailing_zip_code"
                                                value="{{ $profile->mailing_zipcode }}" id="mailing_zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="mailing_city"
                                                value="{{ $profile->mailing_city }}" id="mailing_city">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="mailing_state_id"
                                                id="mailing_state_id">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if ( $profile->mailing_state_id  == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <p class="by-click-text">By clicking ‘Submit’, I confirm that I agree to
                                                the
                                                Smart Rewards Merchant Terms of use, and have read the Privacy
                                                Statement.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                            <button class="submit-green-button" id="submit_id">Submit</button>
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
                                    
                                    @else
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                           
                                            <input type="text" placeholder="Street Address" class=""  id="streetaddress" name="street_address"
                                               value="{{ $profile->street_address }}">
                                        </div>
                                        @if ($errors->has('street_address'))
                                            <div class="error">{{ $errors->first('street_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="zip_code"
                                                value="{{ $profile->zip_code }}" id="zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="city"
                                                value="{{ $profile->city }}" id="profilecity">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="state_id" id="profileState">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if ($profile->state_id == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    

                                    <div class="col-lg-6">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="same_address" class="gimigi-checkbok ifcheck"
                                                name="same_address" <?php if($profile->same_address == 1){echo 'checked';}?>>
                                            <label for="html" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">Same as address listed above</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Mailing Address" class=""
                                                id="mailingaddress" name="mailing_address"
                                                value="{{ $profile->mailing_address }}">
                                        </div>
                                        @if ($errors->has('mailing_address'))
                                            <div class="error">{{ $errors->first('mailing_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="mailing_zip_code"
                                                value="{{ $profile->mailing_zipcode }}" id="mailing_zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="mailing_city"
                                                value="{{ $profile->mailing_city }}" id="mailing_city">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="mailing_state_id"
                                                id="mailing_state_id">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if ( $profile->mailing_state_id  == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <p class="by-click-text">By clicking ‘Submit’, I confirm that I agree to
                                                the
                                                Smart Rewards Merchant Terms of use, and have read the Privacy
                                                Statement.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="btn_section_btns_wr">
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                    <div>
                                           <a class="back-button-one"
                                        href="{{ route('frontend.business_owner.create_business_profile') }}">Back</a>
                                                <button class="submit-green-button" id="submit_id">Submit</button>
                                    </div> 
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @else
                                <div class="row">
                                    @if($profile->business_type == 'Online Only' || $profile->business_type == 'Mobile Business')
                                    <div class="col-lg-12">
                                        <div
                                            class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="no_physical_address" class="gimigi-checkbok ifcheck"
                                                name="no_physical_address" >
                                            <label for="no_physical_address" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">
                                            You selected mobile or online only as your business type on the previous screen. Checking this box, you confirm you do not have a physical business address. However a mailing address is required for all businesses.</label>
                                        </div>

                                    </div>
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                           
                                            <input type="text" placeholder="Street Address" class=""  id="streetaddress" name="street_address"
                                                    value="{{ old('street_address') }}">
                                        </div>
                                        @if ($errors->has('street_address'))
                                            <div class="error">{{ $errors->first('street_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="zip_code"
                                                value="{{ old('zip_code') }}" id="zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="city"
                                                value="{{ old('city') }}" id="profilecity">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="state_id" id="profileState">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if (old('state_id') == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    

                                    <div class="col-lg-6">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="same_address" class="gimigi-checkbok ifcheck"
                                                name="same_address" checked>
                                            <label for="html" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">Same as address listed above</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Mailing Address" class=""
                                                id="mailingaddress" name="mailing_address"
                                                value="{{ old('street_address') }}">
                                        </div>
                                        @if ($errors->has('mailing_address'))
                                            <div class="error">{{ $errors->first('mailing_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="mailing_zip_code"
                                                value="{{ old('zip_code') }}" id="mailing_zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="mailziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="mailing_city"
                                                value="{{ old('city') }}" id="mailing_city">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="mailing_state_id"
                                                id="mailing_state_id">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if (old('state_id') == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
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
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                            <button class="submit-green-button" id="submit_id">Submit</button>
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                           
                                            <input type="text" placeholder="Street Address" class=""  id="streetaddress" name="street_address"
                                                    value="{{ old('street_address') }}">
                                        </div>
                                        @if ($errors->has('street_address'))
                                            <div class="error">{{ $errors->first('street_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="zip_code"
                                                value="{{ old('zip_code') }}" id="zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="ziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="city"
                                                value="{{ old('city') }}" id="profilecity">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="state_id" id="profileState">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if (old('state_id') == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
                                        @endif
                                    </div>

                                    

                                    <div class="col-lg-6">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="same_address" class="gimigi-checkbok ifcheck"
                                                name="same_address" checked>
                                            <label for="html" class="gimmzi-will-use" style="padding-left: 22px;line-height: 28px;">Same as address listed above</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Mailing Address" class=""
                                                id="mailingaddress" name="mailing_address"
                                                value="{{ old('street_address') }}">
                                        </div>
                                        @if ($errors->has('mailing_address'))
                                            <div class="error">{{ $errors->first('mailing_address') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Zip Code" name="mailing_zip_code"
                                                value="{{ old('zip_code') }}" id="mailing_zipCode">
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                        <span id="mailziperror"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="City" name="mailing_city"
                                                value="{{ old('city') }}" id="mailing_city">
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group business-profile-started-main-input">
                                            <!-- <input type="text" placeholder="State"> -->
                                            <select class="select-business-category" name="mailing_state_id"
                                                id="mailing_state_id">
                                                <option value=""> Select State </option>
                                                @if ($stateList)
                                                    @foreach ($stateList as $states)
                                                        <option value="{{ $states->id }}" <?php if (old('state_id') == $states->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $states->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('state_id'))
                                            <div class="error">{{ $errors->first('state_id') }}</div>
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
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                            <button class="submit-green-button" id="submit_id">Submit</button>
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            @endif
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade points_add_modal"id="notclosemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">

                        <p>Please create business profile to complete your registration process</p>
                        <br />
                    </div>
                    <button type="button" class="btn close_btn" onclick="window.location.reload"
                        data-bs-dismiss="modal"aria-label="Close">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('.closebtn').click(function() {
                $('#notclosemodal').modal('show');
            })

            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
            $(document).ready(function() {
                // $("#category_id").on('change', function() {
                //     var category_id = $(this).val();
                //     $.ajax({
                //         url: '{{ route('frontend.ajax.service_type_list') }}',
                //         type: 'get',
                //         data: {
                //             'category_id': category_id
                //         },
                //         success: function(result) {
                //             if (result.success == 1)
                //                 $('#service_id').html('<option>Select Service Type</option>');
                //             $.each(result.data, function(id, value) {
                //                 $("#service_id").append('<option value="' + value.id +
                //                     '">' + value.service_name + '</option>');
                //             });
                //         }
                //     });
                // });
                $("#zipCode").on('keyup', function() {
                    var zipcode = $(this).val();
                    if (zipcode.length == 5) {
                        $.ajax({
                            url: '{{ route('frontend.ajax.get_city') }}',
                            type: 'get',
                            data: {
                                'zipcode': zipcode
                            },
                            success: function(result) {
                                //console.log(result.data);
                                if (result.success == 1) {
                                    $("#profilecity").val(result.data.City);
                                    $("#ziperror").html('');
                                    $("#profileState").val(result.state_name);
                                    if($('#same_address').is(':checked')){
                                        $("#mailing_city").val(result.data.City);
                                        $("#mailing_state_id").val(result.state_name);
                                        $("#mailing_zipCode").val(zipcode);
                                    }
                                    else{
                                        $("#mailing_city").val('');
                                        $("#mailing_state_id").val('');
                                        $("#mailing_zipCode").val('');
                                    }
                                    

                                } else {
                                    $("#ziperror").html(result.data[0]);
                                    $("#ziperror").css('color', 'red');
                                }

                            }
                        });
                    } else {
                        //$("#profilecity").val('');
                    }

                });

                $("#mailing_zipCode").on('keyup', function() {
                    var zipcode = $(this).val();
                    if (zipcode.length == 5) {
                        $.ajax({
                            url: '{{ route('frontend.ajax.get_city') }}',
                            type: 'get',
                            data: {
                                'zipcode': zipcode
                            },
                            success: function(result) {
                                //console.log(result.data);
                                if (result.success == 1) {
                                    $("#mailziperror").html('');
                                    $("#mailing_city").val(result.data.City);
                                    $("#mailing_state_id").val(result.state_name);

                                } else {
                                    $("#mailziperror").html(result.data[0]);
                                    $("#mailziperror").css('color', 'red');
                                }

                            }
                        });
                    } else {
                        //$("#profilecity").val('');
                    }
                });

                $('#same_address').on('change', function(){
                    if ($(this).is(':checked')) {
                        $("#mailingaddress").val($("#streetaddress").val());
                        $("#mailing_zipCode").val($("#zipCode").val());
                        $('#if-profilecity').val($('#profilecity').val());
                        $('#if-profileState').val($('#profileState').val());
                        $("#mailing_city").val($('#profilecity').val());
                        $("#mailing_state_id").val($('#profileState').val());
                    }else{
                        $('#if-address').val("");
                        $('#if-zipCode').val("");
                        $('#if-profilecity').val("");
                        $('#if-profileState').val("");
                    }
                });
                $('#same_address').on('change', function(){
                    if (!$(this).is(':checked')) {
                        $("#mailingaddress").val('');
                        $("#mailing_zipCode").val('');
                        $("#mailing_city").val('');
                        $("#mailing_state_id").val('');
                    }
                });
                // $("#business_type").on('click', function() {
                //     // console.log('hello');
                //     if ($('#business_type').val() == "Mobile Business" || $(
                //             '#business_type').val() == "Online Only") {
                //         // console.log('hello');
                //         $('#address').attr('placeholder',
                //             'Mailing Address');
                //         $('#number_location').prop('disabled', true);
                //     } else {
                //         $('#address').attr('placeholder',
                //             'Street Address');
                //         $('#number_location').prop('disabled', false);
                //     }
                // });

                $(document).on('click','#no_physical_address',function(){
                    if($('#no_physical_address').is(':checked') == true){
                        $("#streetaddress").val('');
                        $("#streetaddress").prop('disabled',true);
                        $("#zipCode").val('');
                        $("#zipCode").prop('disabled',true);
                        $("#profilecity").val('');
                        $("#profilecity").prop('disabled',true);
                        $("#profileState").val('');
                        $("#profileState").prop('disabled',true);
                        $("#same_address").prop('checked',false);
                        $("#same_address").prop('disabled',true);
                    }
                    else{
                        $("#streetaddress").prop('disabled',false);
                        $("#zipCode").prop('disabled',false);
                        $("#profilecity").prop('disabled',false);
                        $("#profileState").prop('disabled',false);
                        $("#same_address").prop('disabled',false);
                        $("#same_address").prop('checked',true);
                    }
                });

                $(document).on('blur',"#streetaddress",function(){
                    if($("#same_address").is(':checked')){
                        $("#mailingaddress").val($("#streetaddress").val());
                    }
                    else{
                        $("#mailingaddress").val();  
                    }
                })
            });
        </script>
    @endpush
</x-layouts.frontend-layout>
