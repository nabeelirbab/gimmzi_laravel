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
                        <li class="header_close_btn"> <a href="{{route('frontend.business_owner.close_button')}}"> Close</a>
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
                                    <div class="green_tick green_line grey_circle margin-right">
                                        <img src="{{asset('frontend_assets/images/steptick.svg')}}" alt="img" />
                                    </div>
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
                                @endif
                                    <div>
                                        <h6>Step Four</h6>
                                        <p> Choose and activate plan. Access profile on vour new Business Profile Page
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn blue-button">Deal Management</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="right_box_section step-2">

                        <div class="form-section border-0">
                            <div>
                                <div class="con-img text-center"><img src="{{asset('frontend_assets/images/congracuation1.png')}}" alt="img" />
                                </div>
                            </div>
                            <div class="con-text11">
                                <h2>Congratulations!</h2>
                                <!-- <p class="text-center">Review and fully manage your coupon(s) by selecting coupon management at the bottom left of the sceen.</p> -->
                            </div>
                            <div class="consuation-top11">
                                <h2>You have successfully created your first deal. Your deal has been saved and stored.</h2>
                                <p>A Gimmzi staff member will reach out to you via email within the next 24-48 hours to complete the setup.
                                </p>
                                
                            </div>
                            {{-- <p class="congrats-center">To add additional features such as Loyalty Reward Programs,
                                upgrade to Merchant Plus <a href="#">Here</a></p> --}}
                            <div class="text17"> Profile Completion : <b>100%</b></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</x-layouts.frontend-layout>