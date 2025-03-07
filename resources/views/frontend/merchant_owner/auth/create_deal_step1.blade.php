<x-layouts.frontend-layout title="Business Owners Create Deal Page">
    <header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m">
                <a class="navbar-brand" href="{{route('frontend.business_owner.index')}}"><img
                        src="{{asset('frontend_assets/images/logo-marchant.png')}}" /></a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication">
                        <li class="header_close_btn"> <a href="{{route('frontend.business_owner.close_button')}}">
                                Close</a>
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
        <div class="container ">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    @if($profile != '')
                                    <div class="green_tick green_line grey_circle margin-right">
                                        <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                                    </div>
                                    @else
                                    <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step One</h6>
                                        <p>Create your user login and tell us about your business</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if($photos != '')
                                    <div class="green_tick green_line grey_circle margin-right">
                                        <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                                    </div>
                                    @else
                                    <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Two</h6>
                                        <p>Upload your company logo and photos so your business can stand out</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                  
                                    @if($deal != '')
                                        @if($deal->available_location != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                                        </div>
                                        @else
                                        <div class="grey_circle margin-right"></div>
                                        @endif
                                        @else
                                         <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Three</h6>
                                        <p>Create first deal using Deal Wizard</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if($deal != '')
                                    @if($deal->is_complete == 1)
                                    <div class="green_tick green_line grey_circle margin-right">
                                        <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                                    </div>
                                    @else
                                    <div class="grey_circle margin-right"></div>
                                    @endif
                                    @else
                                    <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Four</h6>
                                        <p>Choose and activate plan. Access profile on vour new Business Profile Page
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn" style="background: #93DA42;">Deal Management</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="right_box_section">
                        <div class="heading_sec">
                            <h1>Let’s create your first discount voucher <br> <span class="d-text18">Deal Wizard</span>
                            </h1>
                        </div>
                        <div class="form-section">
                            <h6>
                                What date span would you like this deal to be active for 
                                customer use?*
                            </h6>
                            {{Form::open(['route'=>'frontend.business_owner.deal_save_step1','method'=>'POST','class'=>'kt-form parsley-validate','style'=>'color:red;'])}}
                            <div class="d-flex justify-content-between">
                                <div class="width_90">
                                    @if($deal != '')
                                    <input type="date" id="start_on" name="start_on" value="{{$deal->start_Date}}" />
                                    @else
                                    <input type="date" id="start_on" name="start_on" value="{{old('start_on')}}" />
                                    @endif

                                    @if($errors->has('start_on'))
                                    <div class="error">{{ $errors->first('start_on') }}</div>
                                    @endif
                                </div>
                                <div class="width_10">
                                    <small>to</small>
                                </div>
                                <div class="width_90">
                                    @if($deal != '')
                                    <input type="date" id="start_on" name="end_on" value="{{$deal->end_Date}}" />
                                    @else
                                    <input type="date" id="start_on" name="end_on" value="{{old('end_on')}}" />
                                    @endif
                                    @if($errors->has('end_on'))
                                    <div class="error">{{ $errors->first('end_on') }}</div>
                                    @endif
                                    @if($deal != '')
                                    <input type="hidden" name="id" value="{{$deal->id}}" />
                                    @else
                                    <input type="hidden" name="id" />
                                    @endif
                                </div>
                            </div>
                            <p>
                                <b>Note :</b> Expiration date cannot be less than 30 days from the start
                                date. If expiration date is left blank, the deal will remain
                                active unless Merchant edits the deal and adds an expiration
                                date.
                            </p>
                        </div>
                        <div class="btn_section">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <a href="{{route('frontend.business_owner.upload_business_photo')}}"
                                        class="btn profile_btn back-button-one11">Back</a>
                                    <button class="btn next_btn" type="submit">Next</button>
                                </div>
                                <h6>Profile Completion :<span>50%</span> </h6>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.frontend-layout>