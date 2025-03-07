<x-layouts.frontend-layout title="Explore">
    <div class="allen-park-apartments-main-sec">
        <div class="allen-part-apartments-sec">
            <div class="first-goback-search-sec">
                <div class="container">
                    <div class="btn-go-search-apartments">
                        <a href="{{ route('frontend.index') }}"><button><img
                                    src="{{ asset('frontend_assets/images/go-back-icon-1.svg') }}" alt="">Go
                                Back to search</button></a>
                    </div>
                </div>
            </div>

            <div class="middle-park-main-middle-sec">
                <div class="container">
                    <div class="middle-park-apartments-sec-main">
                        <div class="left-middle-park-main-sec">
                            <div class="left-middle-park-sec left-middle-park-sec">
                                <figure>
                                    @if ($business->logo_image)
                                        <img src="{{ $business->logo_image }}" style="width: 100px;" alt="">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/allen-park-icon-11.png') }}"
                                            alt="">
                                    @endif
                                </figure>
                            </div>
                            <div class="right-middle-park-sec">
                                <h2>{{ $business->business_name }}</h2>
                                <ul>
                                    @if ($business->street_address != '')
                                        <li><span><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt=""></span>
                                            {{ $business->street_address }}, {{ $business->city }},
                                            {{ $business->states->name }}, {{ $business->zip_code }}
                                        </li>
                                    @elseif($business->mailing_address != '')
                                        <li><span><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt=""></span>
                                            {{ $business->mailing_address }}, {{ $business->mailing_city }},
                                            {{ $business->mailingstates->name }}, {{ $business->mailing_zipcode }}
                                        </li>
                                    @else
                                        <li></li>
                                    @endif
                                    <li><span><img src="{{ asset('frontend_assets/images/allen-park-icon-2.svg') }}"
                                                alt=""></span>
                                        {{ $business->business_phone }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-middle-park-main-sec map-it-button">
                            <button><img src="{{ asset('frontend_assets/images/map-icon-allen.svg') }}" alt="">
                                Map it</button>
                        </div>
                    </div>
                    <div class="allen-part-tab-one-main">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Home</button>
                                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Order Online</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">View Menu</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact" type="button" role="tab"
                                    aria-controls="nav-contact" aria-selected="false">Careers</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact1" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">View Event Flyer</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-contact2" type="button" role="tab"
                                    aria-controls="nav-contact" aria-selected="false">Visit Direct Website</button>
                            </div>
                        </nav>
                        <div class="tab-content allen-container-mid" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="allen-container-mid">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row allen-container-mid-one">
                                                <div class="col-sm-5 allen-img-first1">
                                                    <img src="{{ asset('frontend_assets/images/r-allen.png') }}"
                                                        class="allen-img-first" alt="">
                                                </div>
                                                <div class="col-sm-7 allen-small-img">
                                                    <div class="row">
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen1.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen2.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen3.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen4.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen5.png') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="col-sm-4 col-4"><img
                                                                src="{{ asset('frontend_assets/images/r-allen6.png') }}"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="move-in-Special">
                                                <div class="move-in-Special-heading bg-color-special-one">move-in
                                                    Special</div>
                                                <div class="move-spa-con">
                                                    <h2>From 08-01-2020 to 09-30-2020 </h2>
                                                    <p>No Application fee </p>
                                                    <p>if Approved, 1st month of rent free</p>
                                                </div>
                                            </div>
                                            @if ($message_board && $message_board->status == 1)
                                                @if ($message_board->display_board_id != '')
                                                    <div class="move-in-Special">
                                                        <div class="move-in-Special-heading bg-color-special-ten"
                                                            style="background: #F39D1C;">
                                                            {{ $message_board->boardone->title }}
                                                        </div>
                                                        <div class="move-spa-con">
                                                            <?php
                                                            if ($message_board->start_date != '') {
                                                                $startdate1 = date_format(date_create($message_board->start_date), 'm-d-Y');
                                                            } else {
                                                                $startdate1 = '';
                                                            }
                                                            if ($message_board->end_date != '') {
                                                                $enddate1 = date_format(date_create($message_board->end_date), 'm-d-Y');
                                                            } else {
                                                                $enddate1 = 'Open';
                                                            }
                                                            ?>
                                                            @if ($startdate1 != '')
                                                                <h2>From {{ $startdate1 }} to {{ $enddate1 }}
                                                                </h2>
                                                            @endif
                                                            <p>{{ $message_board->description }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($message_board->display_board_id2 != '')
                                                    <div class="move-in-Special">
                                                        <div class="move-in-Special-heading bg-color-special-ten"
                                                            style="background: #F39D1C;">
                                                            {{ $message_board->boardtwo->title }}
                                                        </div>
                                                        <div class="move-spa-con">
                                                            <?php
                                                            if ($message_board->start_date2 != '') {
                                                                $startdate2 = date_format(date_create($message_board->start_date2), 'm-d-Y');
                                                            } else {
                                                                $startdate2 = '';
                                                            }
                                                            if ($message_board->end_date2 != '') {
                                                                $enddate2 = date_format(date_create($message_board->end_date2), 'm-d-Y');
                                                            } else {
                                                                $enddate2 = 'Open';
                                                            }
                                                            ?>
                                                            @if ($startdate2 != '')
                                                                <h2>From {{ $startdate2 }} to {{ $enddate2 }}
                                                                </h2>
                                                            @endif
                                                            <p>{{ $message_board->description2 }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <p><strong>Comming Soon</strong></p>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <p><strong>Comming Soon</strong></p>
                            </div>
                            <div class="tab-pane fade" id="nav-contact1" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <p><strong>Comming Soon</strong></p>
                            </div>
                            <div class="tab-pane fade" id="nav-contact2" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <p><strong>Comming Soon</strong></p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>


</x-layouts.frontend-layout>
