<x-layouts.consumer-layout title="Consumer Residential profile">
    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="first-smart-rental-sec">
            <div class="container">
                <div class="col-sm-12 browse-market-universe-text">
                    <a href="#">Browse Market Universe</a>
                </div>
                <div class="form-group-rental-input">
                    <input type="text" placeholder="Search businesses, brands, or keywords for deals" />
                    <button> <img src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}" alt="" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="resident-profile-mid">
        <div class="container resident-top-mid-main">
            <div class="row">
                <div class="col-lg-8">
                    <div class="resident-top-mid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="resident-top-mid-left">
                                    <figure> <img src="{{ asset('frontend_assets/images/icon-25.svg') }}"
                                            alt="" /> </figure>
                                    <div class="smart-reward-con">
                                        <h4><label><img src="{{ asset('frontend_assets/images/icon-114.svg') }}"
                                                    class="img-r-one" alt="" /></label>Currently in Wallet:
                                            <span>{{ $user->point }} (2 Deals)</span>
                                        </h4>
                                        <h4><label><img src="{{ asset('frontend_assets/images/icon-115.svg') }}"
                                                    class="img-r-one" alt="" /></label> Total Points Available:
                                            <b></b>
                                        </h4>
                                        <div class="smart-reward-button-one">
                                            <button data-bs-toggle="modal" data-bs-target="#exampleModal">Smart Rewards
                                                Family and Friends</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 Smart-Rewards-member-since">
                                @php $memberdate = date_format(date_create($user->created_at),'d-m-Y'); @endphp

                                <h4 class="smart-img-cal-icon">Smart Rewards member since:
                                    <span>{{ $memberdate }}</span>
                                </h4>
                                <h4 class="smart-img-cal-icon">Email: <a href="#">{{ $user->email }}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 Quick-Provider-Classifieds">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Quick Provider Classifieds
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">

                                   <ul><li class="merchent-provider-text"><a href="#">Residential Providers</a></li></ul> 
                                    <ul>
                                        @foreach ($providerTypeName1 as $data)
                                            <li class="merchent-outline-button"><button>{{ $data->name }}
                                                    ({{ $data->provider->count() }}) </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                   <ul><li class="merchent-provider-text"><a href="#">Merchant+ Providers</a></li></ul> 
                                    <ul>
                                        @foreach ($providerTypeName3 as $data)
                                            <li class="merchent-outline-button"><button>{{ $data->name }}
                                                    ({{ $data->provider->count() }})</button>
                                            </li>
                                        @endforeach
                                        <li class="merchent-blue-button"><button data-bs-toggle="modal"
                                                data-bs-target="#exampleModal2">Show All</button></li>
                                    </ul>
                                    <div class="modal fade" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content quick-provider-modal">

                                                <div class="modal-body">
                                                    <h2 class="text-center">Quick Provider Classifieds</h2>
                                                    <h4>Go to provider page</h4>

                                                    <div class="quick-provider-main">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <h6>Residential Providers</h6>
                                                                @foreach ($providerTypeName1 as $data)
                                                                    {{-- @dd($data->provider->count()) --}}
                                                                    <button
                                                                        class="quick-provider-apartment-button">{{ $data->name }}
                                                                        ({{ $data->provider->count() }})</button>
                                                                @endforeach
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <h6>Merchant + Providers</h6>

                                                                @foreach ($providerTypeName3 as $data)
                                                                    <button
                                                                        class="quick-provider-apartment-button">{{ $data->name }}
                                                                        ({{ $data->provider->count() }})</button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="quick-provider-main">
                                                        <div class="row">
                                                            <div class="col-sm-6">

                                                                <h6>Employer providers</h6>
                                                                @foreach ($providerTypeName2 as $data)
                                                                    <button
                                                                        class="quick-provider-apartment-button">{{ $data->name }}
                                                                        ({{ $data->provider->count() }})</button>
                                                                @endforeach
                                                            </div>
                                                            {{-- <div class="col-sm-6">
                                                                <h6>&nbsp;</h6>
                                                                <button class="employer-outline-button1">Auto shops
                                                                    (108)</button>
                                                                <button class="employer-outline-button1">mattresses &
                                                                    Furniture (45)</button>
                                                                <button class="employer-outline-button1">Other
                                                                    (1,058)</button>
                                                            </div>
                                                        </div> --}}

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="allen-part-tab-one-main">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active show_reward" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Smart Rewards Deals
                            In Your Area</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">My
                            Wallet</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                            aria-selected="false">Point
                            Badges</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-contact1" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">Point
                            providers</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade active show b-part-one" id="nav-home" role="tabpanel"
                        aria-labelledby="nav-home-tab">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-9 p-right-sapce">
                                    <div class="col-mid-con-one">
                                        <h4>Smart Rewards Deals </h4>
                                        <div class="col-mid-con-one-right">
                                            <button class="button-one11 show_map" data-bs-toggle="modal">Gimmzi Smart
                                                Rewards Map</button>
                                            <span class="filter-droup-down-one-button">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected="">Filter</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="resident-mid-con-one smart_reward_deal">
                                        <div class="resident-mid-con-one-top">
                                            <ul>
                                                <li>
                                                    <div class="left-first-con1">
                                                        <figure> <img
                                                                src="{{ asset('frontend_assets/images/img-one470.png') }}"
                                                                class="" alt="" /> </figure>
                                                        <div>
                                                            <h2>Tequila comida & Cantina</h2>
                                                            <h4>$2.00 Off <span>ALL FAJITAS</span></h4>
                                                        </div>
                                                    </div>
                                                    <div class="right-img-one14">
                                                        <figure class="right-img-one142"> <img
                                                                src="{{ asset('frontend_assets/images/img401.png') }}"
                                                                class="" alt="" /> </figure>
                                                        <figure> <img
                                                                src="{{ asset('frontend_assets/images/img402.png') }}"
                                                                class="" alt="" /> </figure>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="text445">Needed to Redeem Deal: <span
                                                            class="text446">200</span> <span
                                                            class="point-text11">points</span></div>
                                                    <div class="d-flex11"> <span class="Deal-Expires-text">Deal
                                                            Expires:
                                                            12/31/2024</span>
                                                        <button class="Add-to-my-wallet">Add to my wallet</button>
                                                    </div>
                                                </li>
                                                <li>
                                                    {{-- @if ($location->businessLocation != '')
                                                        <div class="text-one4 w-100"> <img
                                                                src="{{ asset('frontend_assets/images/location-icon.svg') }}"
                                                                class="" alt="" /> Address:
                                                            <span>{{ $location->businessLocation->address }}</span>
                                                        </div>
                                                    @else --}}
                                                        <div class="text-one4 w-100"> <img
                                                                src="{{ asset('frontend_assets/images/location-icon.svg') }}"
                                                                class="" alt="" /> Address:
                                                            <span>---</span>
                                                        </div>
                                                    

                                                    <div class="w-100 mb-2"> <img
                                                            src="{{ asset('frontend_assets/images/call-16.svg') }}" />
                                                        Phone: <span>910-399-1643</span></div>
                                                    <div class="w-100">
                                                        <Button class="get-direction-button">Get Directions</Button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="gimmzi-main-smart-rewards-map smart_reward_map"
                                        style="display: none;">

                                        <div class="result-82"><a href="#">82 Results</a></div>

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <img src="{{ asset('frontend_assets/images/map-one.png') }}"
                                                    class="map-img1" alt="" />
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="Smart-Rewards-Map-right mb-top-space11">
                                                    <div class="Smart-Rewards-Map-deals-bg">5 deals available</div>
                                                    <div class="Smart-Rewards-Map-right-top">
                                                        <img src="./images/image-one.png" class=""
                                                            alt="" />
                                                        <h2>Tequila comida & Cantina23</h2>
                                                    </div>

                                                    <div class="deals-address-text">
                                                        5607 Carolina beach Road <br /> Wilmington, NC 28412
                                                    </div>
                                                    <div class="phone-text11">
                                                        Phone:<a href="#">910-399-1643</a>
                                                    </div>
                                                    <div class="aw-text">
                                                        3.4 mi away
                                                    </div>
                                                    <div class="gimizi-smart-text"><a href="#">Gimmzi Smart
                                                            Rewards
                                                            Merchant</a></div>
                                                </div>
                                                <div class="Smart-Rewards-Map-right">
                                                    <div class="Smart-Rewards-Map-deals-bg">5 deals available</div>
                                                    <div class="Smart-Rewards-Map-right-top">
                                                        <img src="./images/image-one.png" class=""
                                                            alt="" />
                                                        <h2>Tequila comida & Cantina23</h2>
                                                    </div>

                                                    <div class="deals-address-text">
                                                        5607 Carolina beach Road <br /> Wilmington, NC 28412
                                                    </div>
                                                    <div class="phone-text11">
                                                        Phone:<a href="#">910-399-1643</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-lg-3 point-and-reward">
                                    <h2>Points And Rewards Feed</h2>
                                    <div class="sort-by-text">
                                        <button>SORT BY</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">Points added</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">Points added</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade b-part-one" id="nav-profile" role="tabpanel"
                        aria-labelledby="nav-profile-tab">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-9 p-right-sapce">
                                    <div class="col-mid-con-one">
                                        <h4>My Wallet </h4>
                                        <div class="col-mid-con-one-right">
                                            <button class="button-one11">Gimmzi Smart Rewards Map</button> <span
                                                class="filter-droup-down-one-button">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected="">Filter</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="resident-mid-con-one">
                                        <div class="resident-mid-con-one-top">
                                            <ul>
                                                <li>
                                                    <div class="left-first-con1">
                                                        <figure> <img
                                                                src="{{ asset('frontend_assets/images/image-one.png') }}"
                                                                class="" alt="" /> </figure>
                                                        <div>
                                                            <h5>Crown lake Seafood Restaurant</h5>
                                                            <h6>50% OFF Appetizer</h6>
                                                        </div>
                                                    </div>
                                                    <div class="right-img-one14">
                                                        <figure class="right-img-one142"> <img
                                                                src="{{ asset('frontend_assets/images/wall-img1.png') }}"
                                                                class="" alt="" /> </figure>
                                                        <figure class="right-img-one142"> <img
                                                                src="{{ asset('frontend_assets/images/wall-img2.png') }}"
                                                                class="" alt="" /> </figure>
                                                        <figure> <img
                                                                src="{{ asset('frontend_assets/images/wall-img3.png') }}"
                                                                class="" alt="" /> </figure>
                                                    </div>
                                                </li>
                                                <li class="top-one-4">
                                                    <div class="wallet-left-one">
                                                        <h2 class="w-100">Used for deal: 550 Points</h2>
                                                        <h4 class="w-100">Deal Expires: 12/20/2020</h4>
                                                    </div>
                                                    <div class="wall-right-m USE-deal-NOW-button">
                                                        <button>USE deal NOW</button>
                                                        <button>Remove from wallet</button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="text-one4 w-100"> <img
                                                            src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                            class="" alt="" /> Address: <span>5607
                                                            Carolina
                                                            Beach Road Wilmington, NC 28412</span></div>
                                                    <div class="w-100 mb-2"> <img
                                                            src="{{ asset('frontend_assets/images/call-16.svg') }}" />
                                                        Phone: <span>910-399-1643</span></div>
                                                    <div class="w-100 mt-4">
                                                        <Button class="get-direction-button">Get Directions</Button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 point-and-reward">
                                    <h2>Points And Rewards Feed</h2>
                                    <div class="sort-by-text">
                                        <button>SORT BY</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">Points added</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">Points added</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade b-part-one" id="nav-contact" role="tabpanel"
                        aria-labelledby="nav-contact-tab">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-9 p-right-sapce">
                                    <div class="col-mid-con-one">
                                        <div class="My-Point-Badges">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name=""
                                                    id="">
                                                <label class="form-check-label"> My Point Badges </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name=""
                                                    id="">
                                                <label class="form-check-label"> Point Badges To Earn </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name=""
                                                    id="">
                                                <label class="form-check-label"> Activate Point Badges </label>
                                            </div>
                                        </div>
                                        <div class="col-mid-con-one-right"> <span
                                                class="filter-droup-down-one-button">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected="">Filter</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </span> </div>
                                    </div>
                                    <div class="Point-Badges-mid-con">
                                        <p>Review your point badges and ways to increase its power levels.</p>
                                    </div>
                                    <div class="my-point-first-con">
                                        <div class="row m-0">
                                            <div class="col-md-4 pl-01">
                                                <div class="my-point-main-con">
                                                    <ul>
                                                        <li><img src="{{ asset('frontend_assets/images/review-img1.svg') }}"
                                                                alt=""></li>
                                                        <li>
                                                            <h4>Gimmzi Access <br />
                                                                Point Badges</h4>
                                                        </li>
                                                        <li>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                                                pendisse maximus ultrices mauris ut facilisis. Nunc
                                                                congue
                                                                molestie dictum.</p>
                                                        </li>
                                                        <li class="d-flex justify-content-space-between">
                                                            <div class="w-50 b-point-b">
                                                                <h2>Best Point <br />
                                                                    Badges Level</h2> <span
                                                                    class="r-text-one justify-content-start">
                                                                    Pellentesque lacinia
                                                                </span>
                                                            </div>
                                                            <div class="w-50"> <span class="rewards-bg1">
                                                                    20
                                                                </span> <span class="r-text-one">
                                                                    Rewards points
                                                                </span> </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="my-point-main-con">
                                                    <ul>
                                                        <li><img src="{{ asset('frontend_assets/images/review-img2.svg') }}"
                                                                alt=""></li>
                                                        <li>
                                                            <h4>Resident Access<br />
                                                                Point Badges</h4>
                                                        </li>
                                                        <li>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                                                pendisse maximus ultrices mauris ut facilisis. Nunc
                                                                congue
                                                                molestie dictum.</p>
                                                        </li>
                                                        <li class="d-flex justify-content-space-between">
                                                            <div class="w-50 b-point-b">
                                                                <h2>Best Point <br />
                                                                    Badges Level</h2> <span
                                                                    class="r-text-one justify-content-start">
                                                                    Pellentesque lacinia
                                                                </span>
                                                            </div>
                                                            <div class="w-50"> <span class="rewards-bg1">
                                                                    20
                                                                </span> <span class="r-text-one">
                                                                    Rewards points
                                                                </span> </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 point-and-reward">
                                    <h2>Points And Rewards Feed</h2>
                                    <div class="sort-by-text">
                                        <button>SORT BY</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">NEW BADGE</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">DEAL REDEEMED</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> Congratulations! You’ve earned a network badge. Your
                                                badge has increased it’s point power by 1.5x
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact1" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-9 p-right-sapce">
                                    <div class="col-mid-con-one">
                                        <div class="My-Point-Badges">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name=""
                                                    id="">
                                                <label class="form-check-label"> My Registered Point Providers </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name=""
                                                    id="">
                                                <label class="form-check-label"> Available Point Providers </label>
                                            </div>
                                        </div>
                                        <div class="col-mid-con-one-right"> <span
                                                class="filter-droup-down-one-button">
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected="">Filter</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </span> </div>
                                    </div>
                                    <div class="residential-point-providers-mid-con">
                                        <p>Residential Point providers (1)</p>
                                    </div>
                                    <div class="residential-point-providers-mid-con-main-one40">
                                        <div class="residential-point-providers-mid-con-main-one4">
                                            <div class="residential-point-providers-left">
                                                <figure> <img
                                                        src="{{ asset('frontend_assets/images/point-provider-one.png') }}" />
                                                </figure>
                                                <div
                                                    class="residential-point-providers-left-contain windfall-Lakes-Apartment">
                                                    <div class="">
                                                        <ul>
                                                            <li>
                                                                <h2> LakeWindfalls Apartment</h2>
                                                            </li>
                                                            <li>
                                                                <h4><img src="{{ asset('frontend_assets/images/location-icon44.svg') }}"
                                                                        class="img-44" /> 90381 vahlen street Charlotte
                                                                    NC
                                                                    28422</h4>
                                                            </li>
                                                            <li>
                                                                <ul class="w-100 justify-content-center d-flex ">
                                                                    <li class="b-text-one110 w-one4"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44') }}.svg"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                    <li class="b-text-one110 w-one5"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44') }}.svg"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resdncial-poinr-right-one">
                                                <ul>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>East Tower Building</h5>
                                                        <h2>Unit 44-B</h2>
                                                    </li>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>Family & Friends Bonus List</h5>
                                                        <h6>2 of 3 used</h6>
                                                    </li>
                                                    <li class="col-sm-one44">
                                                        <ul class="d-flex justify-content-space-between">
                                                            <li class="w-50 top-77 mb-0"> <img
                                                                    src="{{ asset('frontend_assets/images/r-777.png') }}"
                                                                    class="img-44" /> Resident
                                                                <br /> Access badge
                                                            </li>
                                                            <li class="w-50 mb-0"> <span class="rewards-bg1">
                                                                    20
                                                                </span> <span class="r-text-one">
                                                                    Rewards points
                                                                </span> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="residential-point-providers-mid-con12">
                                        <p><a href="#">Merchant + Point Provider</a></p>
                                    </div>
                                    <div class="residential-point-providers-mid-con-main-one40">
                                        <div class="residential-point-providers-mid-con-main-one4">
                                            <div class="residential-point-providers-left">
                                                <figure> <img
                                                        src="{{ asset('frontend_assets/images/point-provider-one.png') }}" />
                                                </figure>
                                                <div
                                                    class="residential-point-providers-left-contain windfall-Lakes-Apartment">
                                                    <div class="">
                                                        <ul>
                                                            <li>
                                                                <h2>Grand avenue hospital</h2>
                                                            </li>
                                                            <li>
                                                                <h4><img src="{{ asset('frontend_assets/images/location-icon44') }}.svg"
                                                                        class="img-44" /> 90381 vahlen street Charlotte
                                                                    NC
                                                                    28422</h4>
                                                            </li>
                                                            <li>
                                                                <ul class="w-100 justify-content-center d-flex ">
                                                                    <li class="b-text-one110 w-one4"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44') }}.svg"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                    <li class="b-text-one110 w-one5"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44') }}.svg"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resdncial-poinr-right-one">
                                                <ul>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>East Tower Building</h5>
                                                        <h2>Unit 44-B</h2>
                                                    </li>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>Family & Friends Bonus List</h5>
                                                        <h6>2 of 3 used</h6>
                                                    </li>
                                                    <li class="col-sm-one44">
                                                        <ul class="d-flex justify-content-space-between">
                                                            <li class="w-50 top-77 mb-0"> <img
                                                                    src="{{ asset('frontend_assets/images/r-777.png') }}"
                                                                    class="img-44" /> Resident
                                                                <br /> Access badge
                                                            </li>
                                                            <li class="w-50 mb-0"> <span class="rewards-bg1">
                                                                    20
                                                                </span> <span class="r-text-one">
                                                                    Rewards points
                                                                </span> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="residential-point-providers-mid-con11">
                                        <p><a href="#">EmployeR PoInt providers (1)</a></p>
                                    </div>
                                    <div class="residential-point-providers-mid-con-main-one40">
                                        <div class="residential-point-providers-mid-con-main-one4">
                                            <div class="residential-point-providers-left">
                                                <figure> <img
                                                        src="{{ asset('frontend_assets/images/point-provider-one.png') }}" />
                                                </figure>
                                                <div
                                                    class="residential-point-providers-left-contain windfall-Lakes-Apartment">
                                                    <div class="">
                                                        <ul>
                                                            <li>
                                                                <h2>Grand avenue hospital</h2>
                                                            </li>
                                                            <li>
                                                                <h4><img src="{{ asset('frontend_assets/images/location-icon44.svg') }}"
                                                                        class="img-44" /> 90381 vahlen street Charlotte
                                                                    NC
                                                                    28422</h4>
                                                            </li>
                                                            <li>
                                                                <ul class="w-100 justify-content-center d-flex ">
                                                                    <li class="b-text-one110 w-one4"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44.svg') }}"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                    <li class="b-text-one110 w-one5"><img
                                                                            src="{{ asset('frontend_assets/images/calendar-dates44.svg') }}"
                                                                            class="img-44" />Member Since:
                                                                        <span>01/19/2021</span>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="resdncial-poinr-right-one">
                                                <ul>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>East Tower Building</h5>
                                                        <h2>Unit 44-B</h2>
                                                    </li>
                                                    <li class="ellipse-one1-bh14">
                                                        <h5>Family & Friends Bonus List</h5>
                                                        <h6>2 of 3 used</h6>
                                                    </li>
                                                    <li class="col-sm-one44">
                                                        <ul class="d-flex justify-content-space-between">
                                                            <li class="w-50 top-77 mb-0"> <img
                                                                    src="{{ asset('frontend_assets/images/r-777.png') }}"
                                                                    class="img-44" /> Resident
                                                                <br /> Access badge
                                                            </li>
                                                            <li class="w-50 mb-0"> <span class="rewards-bg1">
                                                                    20
                                                                </span> <span class="r-text-one">
                                                                    Rewards points
                                                                </span> </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 point-and-reward">
                                    <h2>Points And Rewards Feed</h2>
                                    <div class="sort-by-text">
                                        <button>SORT BY</button>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">NEW BADGE</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> <span>J. Holden </span> of <span>Apartment
                                                    ABC</span>,
                                                awarded you <b>200 Points</b> for a 100% passed inspection. </p>
                                        </li>
                                        <li>
                                            <div class="point-and-reward-top-part"> <span
                                                    class="point-and-reward-top-part-left">DEAL REDEEMED</span> <a
                                                    href="#" class="three-days-ago">3 days ago</a> </div>
                                            <p class="p-text111"> Congratulations! You’ve earned a network badge. Your
                                                badge has increased it’s point power by 1.5x
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade family-friends-modal" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Smart Rewards Family and Friends</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table_section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Provider</th>
                                                    <th scope="col">Family and Friend Reward</th>
                                                    <th scope="col">Send To Existing Members</th>
                                                    <th scope="col">Send to New Members</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Account term Date</th>
                                                    <th scope="col">Points</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($consumerBuilding as $data)
                                                    <tr>
                                                        <td>{{ $data->buildings->building_name }}</td>
                                                        @if($data->user->badge)
                                                          <td>{{ $data->user->badge->title }}</td>
                                                        @else
                                                          <td>-</td>
                                                        @endif
                                                        <td>{{ $data->user->total_point_to_distribute }} Pts/Month On
                                                            Access Badge</td>
                                                        <td>{{ $data->user->total_point_to_distribute }} Pts/Month On
                                                            Access Badge</td>
                                                        <td> {{ $data->status == 1 ? 'Ready For Use' : 'Invite Expired' }}
                                                        </td>
                                                        <td>12/04/2021</td>
                                                        <td>{{ $data->user->point }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><a href="#">Add New Member</a></td>
                                                        <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                                alt="img" /></td>
                                                        <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                                alt="img" /></td>
                                                        <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                                alt="img" /></td>
                                                    </tr>
                                                @empty
                                                @endforelse


                                                {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#">Add New Member</a></td>
                                                <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                        alt="img" /></td>
                                                <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                        alt="img" /></td>
                                                <td><img src="{{ asset('frontend_assets/images/dashed.svg') }}"
                                                        alt="img" /></td>
                                            </tr> --}}


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-3">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog homemodal">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('frontend_assets/images/cancell-one.svg')}}" class="cancell-one11"></button>
                        <div class="text-center mt-4 mb-4 popup-logo">

                            <img src="{{ asset('frontend_assets/images/logosmart-reward.svg')}}" />
                        </div>
                        <div class="enter-crown-l">
                            <h2>Enter Crown Lake Seafood’s Smart Rewards GIMMZI ID</h2>
                        </div>
                        <div class="enter-main-one4">
                            <input type="number" /> <input type="number" /> <input type="number" /> <input
                                type="number" />
                        </div>
                    </div>
                    <div class="redom-and-show1">
                        <button>Redeem and Show</button>
                    </div>
                </div>
            </div>
        </div> --}}
        @push('scripts')
            <script>
                $(document).ready(function() {
                   
                    if(sessionStorage.getItem("get_page") == 'travel_website_page'){
                        sessionStorage.removeItem("get_page");
                        location.href = "<?php echo url('/travel-and-tourism');?>";
                    }
                    if(sessionStorage.getItem("get_page") == 'short_term_website_page'){
                        sessionStorage.removeItem("get_page");
                        var pageid = sessionStorage.getItem("get_page_id");
                        location.href = "<?php echo url('/short-term-rental-website/"+pageid+"');?>";
                    }
                    
                    $(".show_map").on('click', function() {
                        // console.log('hi');
                        $('.smart_reward_deal').hide();
                        $('.smart_reward_map').show();
                    });

                    $(".show_reward").on('click', function() {
                        // console.log('hi');
                        $('.smart_reward_deal').show();
                        $('.smart_reward_map').hide();
                    });

                });
            </script>
        @endpush
</x-layouts.consumer-layout>
