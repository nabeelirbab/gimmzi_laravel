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
                            <h2>Let’s get your business profile started</h2>
                        </div>
                        <div class="search-business">
                            <label>Tell us about your business</label>
                            <!-- <div class="form-group-rental-input">
                                <input type="text" placeholder="Business Name ">
                                <button>
                                    <img src="./images/search-icon-rental.svg" alt="">
                                </button>
                            </div> -->
                        </div>
                        <div class="business-pf-form">
                            {{ Form::open(['route' => 'frontend.business_owner.store_business_profile', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;']) }}
                            @if ($profile == '')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="business_type"
                                                id="business_type">
                                                <option value="" selected disabled> Select Business Type</option>
                                                <option value="Store Front" <?php if (old('business_type') == 'Store Front') {
                                                    echo 'selected';
                                                } ?>>
                                                    Store Front</option>
                                                <option value="Store Front and Online" <?php if (old('business_type') == 'Store Front and Online') {
                                                    echo 'selected';
                                                } ?>>
                                                    Store Front and Online</option>
                                                <option value="Mobile Business" <?php if (old('business_type') == 'Mobile Business') {
                                                    echo 'selected';
                                                } ?>>
                                                    Mobile Business</option>
                                                <option value="Online Only" <?php if (old('business_type') == 'Online Only') {
                                                    echo 'selected';
                                                } ?> id="online_only">
                                                    Online Only</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('business_type'))
                                            <div class="error">{{ $errors->first('business_type') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="business_category_id"
                                                id="category_id">
                                                <option value="" selected disabled> Select Business Category
                                                </option>
                                                @if ($category)
                                                    @foreach ($category as $data)
                                                        <option value="{{ $data->id }}" <?php if (old('business_category_id') == $data->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $data->category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('business_category_id'))
                                            <div class="error">{{ $errors->first('business_category_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="service_type_id"
                                                id="service_id">
                                                <option value="" selected disabled> Select Service Type</option>
                                                @if ($services)
                                                    @foreach ($services as $serv)
                                                        <option value="{{ $serv->id }}" <?php if (old('service_type_id') == $serv->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $serv->service_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('service_type_id'))
                                            <div class="error">{{ $errors->first('service_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Name" class=""
                                                name="business_name" value="{{ old('business_name') }}">
                                        </div>
                                        @if ($errors->has('business_name'))
                                            <div class="error">{{ $errors->first('business_name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Phone Number" class=""
                                                onkeypress="return isNumber(event);" name="business_phone"
                                                value="{{ old('business_phone') }}">
                                        </div>
                                        @if ($errors->has('business_phone'))
                                            <div class="error">{{ $errors->first('business_phone') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Fax Number" class=""
                                                name="business_fax_number" onkeypress="return isNumber(event);"
                                                value="{{ old('business_fax_number') }}">
                                        </div>
                                        @if ($errors->has('business_fax_number'))
                                            <div class="error">{{ $errors->first('business_fax_number') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Email" class=""
                                                name="business_email" value="{{ old('business_email') }}">
                                        </div>
                                        @if ($errors->has('business_email'))
                                            <div class="error">{{ $errors->first('business_email') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Business Website"
                                                name="business_page_link" value="{{ old('business_page_link') }}">
                                        </div>
                                        @if ($errors->has('business_page_link'))
                                            <div class="error">{{ $errors->first('business_page_link') }}</div>
                                        @endif
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            @if (old('business_type') == 'Mobile Business' || old('business_type') == 'Online Only')
                                                <input type="text" placeholder="Mailing Address" class=""
                                                    id="address" name="street_address"
                                                    value="{{ old('street_address') }}">
                                            @else
                                                <input type="text" placeholder="Street Address" class=""
                                                    id="address" name="street_address"
                                                    value="{{ old('street_address') }}">
                                            @endif
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
                                            <select class="select-business-category" name="state_id"
                                                id="profileState">
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

                                    <div class="col-lg-6 business-profile-started-main-input">
                                        @if (old('business_type') == 'Mobile Business' || old('business_type') == 'Online Only')
                                            <input type="text" placeholder="Number of Locations"
                                                name="number_of_location" id="number_location" value=""
                                                onkeypress="return isNumber(event);">
                                        @else
                                            <input type="text" placeholder="Number of Locations"
                                                name="number_of_location" id="number_location"
                                                value="{{ old('number_of_location') }}"
                                                onkeypress="return isNumber(event);">
                                        @endif
                                        @if ($errors->has('number_of_location'))
                                            <div class="error">{{ $errors->first('number_of_location') }}</div>
                                        @endif
                                    </div> --}}

                                    <div class="col-lg-12">
                                        <div
                                            class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="html" class="gimigi-checkbok"
                                                name="allow_notification" <?php if (old('allow_notification') == 'on') {
                                                    echo 'checked';
                                                } ?>>
                                            <label for="html" class="gimmzi-will-use">Gimmzi will use your contact
                                                details
                                                to send you personalised email messages about the latest merchant news,
                                                events and products. If you do not wish to recive these messages, please
                                                check this box.</label>
                                        </div>

                                    </div>
                                    {{-- <div class="col-sm-7">
                                        <div class="form-group">
                                            <p class="by-click-text">By clicking ‘Submit’, I confirm that I agree to
                                                the
                                                Smart Rewards Merchant Terms of use, and have read the Privacy
                                                Statement.
                                            </p>
                                        </div>
                                    </div> --}}
                                    <div class="btn_section">
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="{{route('frontend.business_owner.select_solution')}}"
                                                class="btn profile_btn back-button-one11" style="color: white;">Back</a>
                                                <button class="btn next_btn" id="submit_id">Next</button>
                                            </div>
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="business_type"
                                                id="business_type">
                                                <option value="" selected disabled> Select Business Type</option>
                                                <option value="Store Front" <?php if ($profile->business_type == 'Store Front') {
                                                    echo 'selected';
                                                } ?>>
                                                    Store Front</option>
                                                <option value="Store Front and Online" <?php if ($profile->business_type == 'Store Front and Online') {
                                                    echo 'selected';
                                                } ?>>
                                                    Store Front and Online</option>
                                                <option value="Mobile Business" <?php if ($profile->business_type == 'Mobile Business') {
                                                    echo 'selected';
                                                } ?>>
                                                    Mobile Business</option>
                                                <option value="Online Only" <?php if ($profile->business_type == 'Online Only') {
                                                    echo 'selected';
                                                } ?> id="online_only">
                                                    Online Only</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('business_type'))
                                            <div class="error">{{ $errors->first('business_type') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="business_category_id"
                                                id="category_id">
                                                <option value="" selected disabled> Select Business Category
                                                </option>
                                                @if ($category)
                                                    @foreach ($category as $data)
                                                        <option value="{{ $data->id }}" <?php if ($profile->business_category_id == $data->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $data->category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('business_category_id'))
                                            <div class="error">{{ $errors->first('business_category_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <select class="select-business-category" name="service_type_id"
                                                id="service_id">
                                                <option value="" selected disabled> Select Service Type</option>
                                                @if ($services)
                                                    @foreach ($services as $serv)
                                                        <option value="{{ $serv->id }}" <?php if ($profile->service_type_id == $serv->id) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $serv->service_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('service_type_id'))
                                            <div class="error">{{ $errors->first('service_type_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Name" class=""
                                                name="business_name" value="{{ $profile->business_name }}">
                                        </div>
                                        @if ($errors->has('business_name'))
                                            <div class="error">{{ $errors->first('business_name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Phone Number" class=""
                                                onkeypress="return isNumber(event);" name="business_phone"
                                                value="{{ $profile->business_phone }}">
                                        </div>
                                        @if ($errors->has('business_phone'))
                                            <div class="error">{{ $errors->first('business_phone') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Fax Number" class=""
                                                name="business_fax_number" onkeypress="return isNumber(event);"
                                                value="{{ $profile->business_fax_number }}">
                                        </div>
                                        @if ($errors->has('business_fax_number'))
                                            <div class="error">{{ $errors->first('business_fax_number') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            <input type="text" placeholder="Business Email" class=""
                                                name="business_email" value="{{ $profile->business_email }}">
                                        </div>
                                        @if ($errors->has('business_email'))
                                            <div class="error">{{ $errors->first('business_email') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 business-profile-started-main-input">
                                        <div class="form-group">
                                            <input type="text" placeholder="Business Website"
                                                name="business_page_link" value="{{ $profile->business_page_link }}">
                                        </div>
                                        @if ($errors->has('business_page_link'))
                                            <div class="error">{{ $errors->first('business_page_link') }}</div>
                                        @endif
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-group business-profile-started-main-input">
                                            @if (old('business_type') == 'Mobile Business' || old('business_type') == 'Online Only')
                                                <input type="text" placeholder="Mailing Address" class=""
                                                    id="address" name="street_address"
                                                    value="{{ $profile->street_address }}">
                                            @else
                                                <input type="text" placeholder="Street Address" class=""
                                                    id="address" name="street_address"
                                                    value="{{ $profile->street_address }}">
                                            @endif
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
                                            <select class="select-business-category" name="state_id"
                                                id="profileState">
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

                                    <div class="col-lg-6 business-profile-started-main-input">
                                        @if ($profile->number_of_location == 'Mobile Business' || $profile->number_of_location == 'Online Only')
                                            <input type="text" placeholder="Number of Locations"
                                                name="number_of_location" id="number_location" value=""
                                                onkeypress="return isNumber(event);">
                                        @else
                                            <input type="text" placeholder="Number of Locations"
                                                name="number_of_location" id="number_location"
                                                value="{{ old('number_of_location') }}"
                                                onkeypress="return isNumber(event);">
                                        @endif
                                        @if ($errors->has('number_of_location'))
                                            <div class="error">{{ $errors->first('number_of_location') }}</div>
                                        @endif
                                    </div> --}}

                                    <div class="col-lg-6">
                                        <div
                                            class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="html" class="gimigi-checkbok"
                                                name="allow_notification" <?php if ($profile->allow_notification == '1') {
                                                    echo 'checked';
                                                } ?>>
                                            <label for="html" class="gimmzi-will-use">Gimmzi will use your contact
                                                details
                                                to send you personalised email messages about the latest merchant news,
                                                events and products. If you do not wish to receive these messages, please
                                                check this box.</label>
                                        </div>

                                    </div>
                                    <!-- <div class="col-sm-7">
                                        <div class="form-group">
                                            <p class="by-click-text">By clicking ‘Submit’, I confirm that I agree to
                                                the
                                                Smart Rewards Merchant Terms of use, and have read the Privacy
                                                Statement.
                                            </p>
                                        </div>
                                    </div> -->
                                     <div class="btn_section">
                                        <div class="pf-completion d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="{{route('frontend.business_owner.select_solution')}}"
                                                class="btn profile_btn back-button-one11" style="color: white;">Back</a>
                                                <button class="btn next_btn" id="submit_id">Next</button>
                                            </div>
                                            <p class="p-text11">Profile Completion : <span>15%</span></p>
                                        </div>
                                    </div>
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
                $("#category_id").on('change', function() {
                    var category_id = $(this).val();
                    $.ajax({
                        url: '{{ route('frontend.ajax.service_type_list') }}',
                        type: 'get',
                        data: {
                            'category_id': category_id
                        },
                        success: function(result) {
                            if (result.success == 1)
                                $('#service_id').html('<option>Select Service Type</option>');
                            $.each(result.data, function(id, value) {
                                $("#service_id").append('<option value="' + value.id +
                                    '">' + value.service_name + '</option>');
                            });
                        }
                    });
                });
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
                $("#business_type").on('click', function() {
                    // console.log('hello');
                    if ($('#business_type').val() == "Mobile Business" || $(
                            '#business_type').val() == "Online Only") {
                        // console.log('hello');
                        $('#address').attr('placeholder',
                            'Mailing Address');
                        $('#number_location').prop('disabled', true);
                    } else {
                        $('#address').attr('placeholder',
                            'Street Address');
                        $('#number_location').prop('disabled', false);
                    }
                });
            });
        </script>
    @endpush
</x-layouts.frontend-layout>
