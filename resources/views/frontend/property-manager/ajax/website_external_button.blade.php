<div class="allen-part-tab-one-main externalButtonList">
    <nav>
        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
            aria-selected="true">Home</button>
            @if(@$external_manage)
              @if(@$external_manage->event_flyer_display != 0)
                <button class="nav-link" id="nav-flyer-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-flyer" type="button" role="tab" aria-controls="nav-flyer"
                    aria-selected="true">View Event Flyer</button>
               @endif
            @else
                <button class="nav-link" id="nav-flyer-tab" data-bs-toggle="tab"
                data-bs-target="#nav-flyer" type="button" role="tab" aria-controls="nav-flyer"
                aria-selected="true">View Event Flyer</button>
            @endif
            @if(@$external_manage)
              @if(@$external_manage->contact_community_display != 0)
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                    aria-selected="true">Contact Community</button>
              @endif
            @else
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                aria-selected="true">Contact Community</button>
            @endif
            @if(@$external_manage)
              @if(@$external_manage->floor_plan_display != 0)
                    <button class="nav-link" id="nav-floor-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-floor" type="button" role="tab" aria-controls="nav-floor"
                        aria-selected="false">Floor Plans</button>
              @endif
            @else
                    <button class="nav-link" id="nav-floor-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-floor" type="button" role="tab" aria-controls="nav-floor"
                    aria-selected="false">Floor Plans</button>
            @endif
            @if(@$external_manage)
              @if(@$external_manage->lease_online_display != 0)
                    <button class="nav-link" id="nav-lease-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-lease" type="button" role="tab" aria-controls="nav-lease"
                        aria-selected="false">Lease Online</button>
              @endif
            @else
                    <button class="nav-link" id="nav-lease-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-lease" type="button" role="tab" aria-controls="nav-lease"
                    aria-selected="false">Lease Online</button>
            @endif
            @if(@$external_manage)
              @if(@$external_manage->resident_portal_display != 0)
                    <button class="nav-link" id="nav-resident-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-resident" type="button" role="tab" aria-controls="nav-resident"
                        aria-selected="false">Resident Portal</button>
              @endif
            @else
                    <button class="nav-link" id="nav-resident-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-resident" type="button" role="tab" aria-controls="nav-resident"
                    aria-selected="false">Resident Portal</button>
            @endif
            @if(@$external_manage)
              @if(@$external_manage->visit_website_display != 0)
                    <button class="nav-link" id="nav-direct-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-direct" type="button" role="tab" aria-controls="nav-direct"
                        aria-selected="false">Visit Direct Website</button>
              @endif
            @else
                    <button class="nav-link" id="nav-direct-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-direct" type="button" role="tab" aria-controls="nav-direct"
                    aria-selected="false">Visit Direct Website</button>
            @endif
        </div>
    </nav>
    <div class="tab-content allen-container-mid" id="nav-tabContent">
        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
            aria-labelledby="nav-home-tab">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-md-5">
                                @if(@$provider != '')
                               
                                  @if(@$provider->main_image != '')
                                    <img src="{{url(@$provider->main_image)}}" class="allen-img-first" alt="">
                                  @else
                                    <img src="{{ asset('frontend_assets/images/r-allen.png')}}" class="allen-img-first" alt="">
                                  @endif
                                @else
                                  <img src="{{ asset('frontend_assets/images/r-allen.png')}}" class="allen-img-first" alt="">
                                @endif
                                
                            </div>
                            <div class="col-md-7 allen-small-img scroll_area_panel">
                                <div class="row">
                                    @if(@$provider->thumbnail_image != null)
                                        <div class="col-lg-4 col-md-6 hm_tab_img_grps_items">
                                        <a href="{{url('storage/'.$provider->property_video)}}" data-fancybox="lgtkk-video">
                                            <img src="{{url('storage/'.$provider->thumbnail_image)}}" alt="">
                                        </div>
                                        @if(count(@$provider->photo_img) > 0)
                                            @foreach(@$provider->photo_img as $photo)
                                            <div class="col-lg-4 col-md-6 hm_tab_img_grps_items">
                                                <a href="{{$photo}}" data-lightbox="lgt0" >
                                                <img src="{{$photo}}" alt="">
                                                </a>
                                            </div>
                                            @endforeach
                                        @endif
                                    @else
                                        @if(count(@$provider->photo_img) > 0)
                                            @foreach(@$provider->photo_img as $photo)
                                            <div class="col-lg-4 col-md-6 hm_tab_img_grps_items">
                                                <a href="{{$photo}}" data-lightbox="lgt0" >
                                                <img src="{{$photo}}" alt="">
                                                </a>
                                            </div>
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-flyer" role="tabpanel" aria-labelledby="nav-flyer-tab">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-sm-12 allen-small-img">
                                <div class="row vw_item_rows">
                                    @if($external_manage)
                                        @if($external_manage->event_flyer_display != 0)
                                            @if($external_manage->flyer_image1 != '')
                                                <?php $image1 = $external_manage->flyer_image1;?>
                                            @endif
                                            @if($external_manage->flyer_image2 != '')
                                               <?php $image2 = $external_manage->flyer_image2;?>
                                            @endif
                                        @else
                                            <?php   $image1 = asset('frontend_assets/images/sampleimage.jpg');
                                                    $image2 = asset('frontend_assets/images/sampleimage.jpg');
                                                    $image3 = asset('frontend_assets/images/sampleimage.jpg');?>
                                        @endif
                                    @else
                                            <?php   $image1 = asset('frontend_assets/images/sampleimage.jpg');
                                                    $image2 = asset('frontend_assets/images/sampleimage.jpg');
                                                    $image3 = asset('frontend_assets/images/sampleimage.jpg');?>
                                    @endif
                                   
                                    <div class="col-lg-4 col-md-6 vw_item">
                                        <div class="vw_item_img">
                                            <a href="{{$image1}}" data-lightbox="lgt1" >
                                                <img id="flyer1image" src="{{$image1}}" alt="">
                                            </a>
                                        </div>
                                        <div class="vw_item_text">
                                            <a href="{{$image1}}" data-lightbox="lgt2" >View</a>
                                            <a href="#">Download</a>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-4 col-md-6  vw_item">
                                        <div class="vw_item_img">
                                            <a href="{{$image2}}" data-lightbox="lgt1" >
                                              <img id="flyer2image"  src="{{$image2}}" alt="">
                                            </a>
                                        </div>
                                        <div class="vw_item_text">
                                            <a href="{{$image2}}" data-lightbox="lgt2">View</a>
                                            <a href="#">Download</a>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab1">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-sm-12">
                                @if($external_manage)
                                @if($external_manage->contact_community_display != 0)
                                    @if($external_manage->contact_community_url != '')
                                        <?php $contact = $external_manage->contact_community_url;?>
                                        <p class="websitebutton" id="contactLink"><strong>Click On: </strong><a href="{{$contact}}" target="_blank">Contact Community</a></p>
                                    @else
                                        <?php $contact = '';?>
                                        <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                    @endif
                                @else
                                   <?php $contact = '';?>
                                   <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                @endif
                            @else
                                <?php $contact = '';?>
                                <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                            @endif
                            
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-floor" role="tabpanel"
            aria-labelledby="nav-profile-tab">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one cus-row">

                            @if($external_manage->property->floor_plans != null)
                                @if($external_manage->property->floor_plans->bedroom_1 != null)
                                    <div class="col-lg-4 col-md-6 cus-col">
                                        <div class="foor-wrap floor_plan_modal" id="{{$external_manage->property->floor_plans->property_id}}" value="1">
                                            <div class="floor-img-wrp">
                                                <figure class="floor-fig">
                                                    <img src="{{ $external_manage->property->floor_plans->floor_image1}}" class="allen-img-first" alt="">
                                                </figure>
                                            </div>
                                            <div class="foor-txt-outr">
                                                <strong>1</strong>
                                                <p><span>{{$external_manage->property->floor_plans->bedroom_1}} Bedroom</span>|<span>{{$external_manage->property->floor_plans->bathroom_1}} Bathroom</span></p>
                                                <p>{{$external_manage->property->floor_plans->total_1}} sq.ft</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($external_manage->property->floor_plans->bedroom_2 != null)
                                <div class="col-lg-4 col-md-6 cus-col">
                                    <div class="foor-wrap floor_plan_modal" id="{{$external_manage->property->floor_plans->property_id}}" value="2">
                                        <div class="floor-img-wrp">
                                            <figure class="floor-fig">
                                                <img src="{{ $external_manage->property->floor_plans->floor_image2}}" class="allen-img-first" alt="">
                                            </figure>
                                        </div>
                                        <div class="foor-txt-outr">
                                            <strong>2</strong>
                                            <p><span>{{$external_manage->property->floor_plans->bedroom_2}} Bedroom</span>|<span>{{$external_manage->property->floor_plans->bathroom_2}} Bathroom</span></p>
                                            <p>{{$external_manage->property->floor_plans->total_2}} sq.ft</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($external_manage->property->floor_plans->bedroom_3 != null)
                                <div class="col-lg-4 col-md-6 cus-col">
                                    <div class="foor-wrap floor_plan_modal" id="{{$external_manage->property->floor_plans->property_id}}" value="3">
                                        <div class="floor-img-wrp">
                                            <figure class="floor-fig">
                                                <img src="{{ $external_manage->property->floor_plans->floor_image3}}" class="allen-img-first" alt="">
                                            </figure>
                                        </div>
                                        <div class="foor-txt-outr">
                                            <strong>3</strong>
                                            <p><span>{{$external_manage->property->floor_plans->bedroom_3}} Bedroom</span>|<span>{{$external_manage->property->floor_plans->bathroom_3}} Bathroom</span></p>
                                            <p>{{$external_manage->property->floor_plans->total_3}} sq.ft</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            @else
                            <div class="col-lg-4 col-md-6 cus-col">No floor plan is there</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-lease" role="tabpanel" aria-labelledby="nav-lease-tab1">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-sm-12">
                                @if($external_manage)
                                @if($external_manage->lease_online_display != 0)
                                    @if($external_manage->lease_online_url != '')
                                        <?php $lease = $external_manage->lease_online_url;?>
                                        <p class="websitebutton" id="contactLink"><strong>Click On: </strong><a href="{{$lease}}" target="_blank">Apply Online</a></p>
                                    @else
                                        <?php $contact = '';?>
                                        <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                    @endif
                                @else
                                   <?php $contact = '';?>
                                   <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                @endif
                            @else
                                <?php $contact = '';?>
                                <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                            @endif
                            
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-resident" role="tabpanel" aria-labelledby="nav-resident-tab1">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-sm-12">
                                @if($external_manage)
                                @if($external_manage->resident_portal_display != 0)
                                    @if($external_manage->resident_portal_url != '')
                                        <?php $resident = $external_manage->resident_portal_url;?>
                                        <p class="websitebutton" id="contactLink"><strong>Click On: </strong><a href="{{$resident}}" target="_blank">Resident Portal</a></p>
                                    @else
                                        <?php $contact = '';?>
                                        <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                    @endif
                                @else
                                   <?php $contact = '';?>
                                   <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                @endif
                            @else
                                <?php $contact = '';?>
                                <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                            @endif
                            
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-direct" role="tabpanel" aria-labelledby="nav-direct-tab1">
            <div class="allen-container-mid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row allen-container-mid-one">
                            <div class="col-sm-12">
                                @if($external_manage)
                                @if($external_manage->visit_website_display != 0)
                                    @if($external_manage->visit_website_url != '')
                                        <?php $website = $external_manage->visit_website_url;?>
                                        <p class="websitebutton" id="contactLink"><strong>Click On: </strong><a href="{{$website}}" target="_blank">Direct Website</a></p>
                                    @else
                                        <?php $contact = '';?>
                                        <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                    @endif
                                @else
                                   <?php $contact = '';?>
                                   <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                                @endif
                            @else
                                <?php $contact = '';?>
                                <p class="websitebutton" id="contactLink"><strong>Coming Soon</strong></p>
                            @endif
                            
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 featured-amenties-button">
                                <button class="features-m">Features</button>
                                <button class="features-a">Amenities</button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-one">move-in
                                Special</div>
                            <div class="move-spa-con">
                                <h2>From 08-01-2020 to 09-30-2020 </h2>
                                <p>No Application fee </p>
                                <p>if Approved, 1st month of rent free</p>
                            </div>
                        </div>
                        <div class="move-in-Special">
                            <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                month</div>
                            <div class="move-spa-con">
                                <div class="tenant-top-one">
                                    <span>Month of December</span>
                                    <a href="#">Congratulations!</a>
                                </div>
                                <div class="tenant-month-bottom-con">
                                    <img src="{{ asset('frontend_assets/images/images/trent-one1.png')}}" alt="">
                                    <span>Trey Mantha</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>