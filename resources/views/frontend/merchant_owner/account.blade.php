<x-layouts.frontend-layout title="Business Owners Account Page">
    @push('style')
    <style>
        .smart-rental-button ul li:hover {
            color: #fff;
        }

        .errorMsq {
            color: red !important;
            display: block;
        }
        .select2-container {
            z-index: 100000;
        }
        div.pac-container {
            z-index: 1000000 !important;
        }
        </style>
        
    @endpush

    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex">
                                <div class="left-sec-home">
                                    <span>
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                    </span>
                                </div>

                                <div class="right-sec-rental">
                                    <h3>{{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <select name="main_location" class="form-control" id="main_location"
                                        style="width: 50%;">
                                        @if ($merchant_location)
                                        @foreach ($merchant_location as $locations)

                                        @if($locations->merchantUser->location_type == 'multiple')
                                        <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{
                                            $locations->businessLocation->id }}" >{{
                                            $locations->businessLocation->location_name }}
                                        </option>
                                        @else
                                        <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{
                                            $locations->businessLocation->id }}">{{
                                            $locations->businessLocation->location_name }}
                                        </option>
                                        @endif

                                        @endforeach
                                        @endif
                                    </select>
                                    <div class="apartments-sec" style="margin-top: 25px;">
                                        <ul>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                                alt="" /></span>
                                                        Address:
                                                        <span class="points-distributed-txt" id="change_address">

                                                            @foreach ($merchant_location as $locations)
                                                            @if($locations->is_main == 1)
                                                            {{$locations->businessLocation->address}},
                                                            {{$locations->businessLocation->city}},
                                                            @if($locations->businessLocation->state_id == null)
                                                            {{$locations->businesslocation->state_name }},
                                                            @else
                                                            {{$locations->businesslocation->states->name }},
                                                            @endif
                                                            {{$locations->businessLocation->zip_code}}
                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                                <div class="apartment-right-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                                alt="" /></span>Mail:<span
                                                            class="points-distributed-txt" id="change_email">
                                                            @foreach ($merchant_location as $locations)
                                                            @if($locations->is_main == 1)
                                                            {{$locations->businessLocation->business_email}}

                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt" id="change_phone">
                                                            @foreach ($merchant_location as $locations)
                                                            @if($locations->is_main == 1)
                                                            {{$locations->businessLocation->business_phone}}
                                                            @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="right-sec-account-status-lead-setting-1">
                                <figure>
                                    @if(auth()->user()->profile_image)
                                        <img src="{{auth()->user()->profile_image}}" alt="">
                                    @else
                                       <img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}" alt="">
                                    @endif
                                </figure>
                                <h3>Account Status</h3>
                                @if (Auth::user()->merchantBusiness->status == 1)
                                <p style="color: green;"><i style="background: green;"></i>Active</p>
                                @elseif(Auth::user()->merchantBusiness->status == 0)
                                <p style="color: red;"><i style="background: red;"></i>Inactive</p>
                                @elseif(Auth::user()->merchantBusiness->status == 2)
                                <p style="color: #ffb822;"><i style="background: #ffb822;"></i>Pending</p>
                                @elseif(Auth::user()->merchantBusiness->status == 3)
                                <p style="color: #5578eb;"><i style="background: #5578eb;"></i>Does Not Meet Merchant Guidelines</p>
                                @elseif(Auth::user()->merchantBusiness->status == 4)
                                <p style="color: #b80abb;"><i style="background: #b80abb;"></i>Saved</p>
                                @else
                                <p style="color: red;"><i style="background: red;"></i>Pending</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <p class="to-add-aditional-loyality-txt">To add additional features such as Loyalty Reward Programs,
                        upgrade to Merchant Plus <a href="">Here</a></p> -->
                </div>

                <div id="section3">

                    <div class="smart-contain-main">
                        <div class="container1">
                            <div class="smart-rental-button">
                                {{-- <li>
                                    <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                            src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                            class="cat-left-icon" />
                                        Loyalty Rewards Programs</a>
                                </li> --}}
                                @if (Auth::user()->user_title == 'Associate')
                                {{-- <ul class="p-0 border-0">
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#dealManagement">
                                            <img src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                            Deal Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and service Database</a>
                                    </li>


                                </ul> --}}
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>
                                </ul>
                                @elseif(Auth::user()->user_title == 'Manager')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{route('frontend.business_owner.create_campaign')}}" >
                                            <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                           Create A New Campaign</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                            src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                            class="cat-left-icon" />
                                            @if($is_mobile_business == 1)
                                                Add/Manage Upcoming Event and Serving Areas
                                            @else
                                                Add/Manage Participating Location
                                            @endif
                                        </a>
                                       
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.merchant_message_board')}}"> <img src="{{ asset('frontend_assets/images/icon10.svg') }}"
                                                class="cat-left-icon" />
                                            Message Boards</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.business_report') }}"> <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                           Reports</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li> --}}
                                    
                                    
                                    
                                   
                                   

                                </ul>
                                @elseif(Auth::user()->user_title == 'Corporate Lead')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{route('frontend.business_owner.create_campaign')}}" >
                                            <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                           Create A New Campaign</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                                @if($is_mobile_business == 1)
                                                    Add/Manage Upcoming Event and Serving Areas
                                                @else
                                                    Add/Manage Participating Location
                                                @endif
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.merchant_message_board')}}"> <img src="{{ asset('frontend_assets/images/icon10.svg') }}"
                                                class="cat-left-icon" />
                                            Message Boards</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.business_report') }}"> <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                           Reports</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li> --}}
                                    
                                    
                                    
                                   
                                   

                                </ul>
                                {{-- <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{route('frontend.business_owner.create_campaign')}}" >
                                            <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                           Create A New Campaign</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                            Add/Manage Participating Location</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.merchant_message_board')}}"> <img src="{{ asset('frontend_assets/images/icon10.svg') }}"
                                                class="cat-left-icon" />
                                            Message Boards</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.business_report') }}"> <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                           Reports</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>
                                </ul> --}}
                                @elseif(Auth::user()->user_title == 'Corporate System Admin')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{route('frontend.business_owner.create_campaign')}}" >
                                            <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                           Create A New Campaign</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />

                                            @if($is_mobile_business == 1)
                                                Add/Manage Upcoming Event and Serving Areas
                                            @else
                                                Add/Manage Participating Location
                                            @endif
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.merchant_message_board')}}"> <img src="{{ asset('frontend_assets/images/icon10.svg') }}"
                                                class="cat-left-icon" />
                                            Message Boards</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.business_report') }}"> <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                           Reports</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li> --}}
                                    
                                    
                                    
                                   
                                   

                                </ul>
                                @elseif(Auth::user()->user_title == 'Lead Manager')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="{{route('frontend.business_owner.create_campaign')}}" >
                                            <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                           Create A New Campaign</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.campaign_managament') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                                Campaign Management
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                                @if($is_mobile_business == 1)
                                                    Add/Manage Upcoming Event and Serving Areas
                                                @else
                                                    Add/Manage Participating Location
                                                @endif
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.item_service_list')}}">
                                            <img height="44" src="{{ asset('frontend_assets/images/icon9.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and Service Database</a>
                                    </li>

                                    <li>
                                        <a href="{{route('frontend.business_owner.merchant_message_board')}}"> <img src="{{ asset('frontend_assets/images/icon10.svg') }}"
                                                class="cat-left-icon" />
                                            Message Boards</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.business_report') }}"> <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                           Reports</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>

                                    {{-- <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li> --}}
                                    
                                    
                                    
                                   
                                   

                                </ul>
                                @endif

                            </div>
                            <div class="have-text-one">
                                <a href="#">Having Technical issues? Submit a Trouble ticket here </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- Deal management modal --}}
    <div class="modal fade" id="dealManagement" tabindex="-1" aria-labelledby="dealManagementLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="width: 106%;">

                <div class="modal-body manage-program-tab-content-main-sec">
                    <div class="modal-deal-management-top">
                        <h2>Deal Management</h2>
                        <button data-bs-dismiss="modal">Close</button>
                    </div>
                    
                    <div class="table-manage-program-sec">
                    
                        <table class="gift-table-main table">
                          
                            <thead>
                                <tr>
                                    <td>Status</td>
                                    <td>Deal Preview</td>
                                    <td>Deal Type</td>
                                    <td>Description of Deal</td>
                                    <td>Participating Location</td>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <td>Action</td>
                                   
                                </tr>
                            </thead>

                            <tbody class="merchantItemList">
                            @forelse ($dealManage as $data)
                                <tr>
                                    @if($data->status == 1)
                                        <td style="color: #42ac04;">Active</td>
                                    @else
                                        <td style="color: #e61717;">Inactive</td>
                                    @endif
                                    <td> <a href="#" style="color: #1f8ac9;" data-id="{{ $data->id }}" class="preview_deal">Preview deal</a></td>                     
                                    <td>{{$data->discount_type}}</td>
                                    <td>{{$data->suggested_description}}</td>
                                    <td><a href="#" class="view_location" style="color: #1f8ac9;"
                                        data-id="{{ $data->id }}">View Locations</a></td>
                                        @php $startdate =
                                        date_format(date_create($data->start_Date),'m-d-Y'); @endphp
                                    <td>{{$startdate}}</td>
                                    @if ($data->end_Date != '')
                                        @php $enddate = date_format(date_create($data->end_Date),'m-d-Y');
                                        @endphp
                                        <td id="endOn{{ $data->id }}">{{$enddate}}</td>
                                    @else
                                        <td>N/A</td>
                                    @endif
                                    <td>
                                        @php
                                            $today = date('Y-m-d');
                                            $enddate = date_create($data->end_Date);
                                            $todaydate = date_create($today);
                                            $diff = date_diff($enddate, $todaydate);
                                            $days = $diff->format('%a');
                                            // dd($days);
                                        @endphp
                                        @if($data->end_Date == null)
                                            <button class="end-program-btn-sec end_deal" type="button" data-id="{{$data->id}}" style="margin-bottom: 10px; width:100%;letter-spacing: 0.0em;font-size: 18px;">
                                                End Deal
                                            </button>
                                        @elseif($days > 14)
                                            <button class="end-program-btn-sec end_deal" data-id="{{ $data->id }}" style="margin-bottom: 10px;">End Deal
                                            </button>
                                            <button class="extend-program-btn-sec extend_deal" data-id="{{ $data->id }}">Extend Deal
                                            </button>
                                        @elseif($days < 14)
                                            <button class="extend-program-btn-sec schedule_to_end"
                                                    data-id="{{ $data->id }}" style="margin-bottom: 10px; background-color: #d70303;
                                                    border-color: #d70303;">Scheduled To End
                                            </button>
                                            <button class="extend-program-btn-sec extend_deal" data-id="{{ $data->id }}">Extend Deal
                                            </button>
                                        @endif
                                        {{-- <button class="extend-program-btn-sec extend_program"
                                        data-id="" style="margin-bottom: 10px; background-color: #d70303;
                                        border-color: #d70303;">Scheduled to end
                                        </button> 
                                        <button class="extend-program-btn-sec extend_program"
                                        data-id="">Extend Program
                                        </button> --}}
                                    </td>
      
                                </tr>
                            @empty
                                <td>No record</td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

   
    {{-- Add participating location modal --}} 
    <div class="new_modal_participate modal fade" id="participatingLocation" tabindex="-1" aria-labelledby="participatingLocationLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-deal-management-top">
                        @if($is_mobile_business == 1)
                        <h2>Serving Areas</h2>
                        @else
                        <h2>Participating Locations</h2>
                        @endif
                        <button data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="tab_partcipate_part">
                        <ul>
                            <li><button class="tab_partcipate_part_btnn active deal" type="button">For Deals</button>
                            </li>
                            <li><button class="tab_partcipate_part_btnn loyalty_reward" type="button">Loyalty Rewards
                                    Programs</button></li>
                        </ul>
                    </div>
                    <div class="participating-location-main">
                        <div class="row participate_loctn_rowws gy-4">
                            <div class="col-xl-8">
                                <div class="participating-location-main-respnsv-table">
                                    <table id="deals">
                                        <tr>
                                        <?php $locations = Auth::user()->merchantBusiness->locations;?>
                                            <th>
                                                <select class="two-hours-text select_deal">
                                                    @if(count($dealManage) > 0)
                                                    @foreach ($dealManage as $deals)
                                                    <option value="{{ $deals->id }}">
                                                        {{ $deals->suggested_description }}</option>
                                                    @endforeach
                                                    @else
                                                    <option value="">Select deal</option>
                                                    @endif
                                                </select>
                                                <div class="" id="preview-deal-text">

                                                    @if(count($dealManage) > 0)
                                                    <a href="javascript:void(0);" data-id="{{$dealManage[0]->id}}"
                                                        class="p-deal-one preview_deal_participating">Preview Deal</a>
                                                    @endif
                                                </div>
                                            </th>
                                            <th class="new-select1">
                                                Assign to all locations
                                                <div class="text-center assign-one4">
                                                @if(count($dealManage) > 0)
                                                    @if(count($locations) > 0)
                                                        @if(count($dealManage[0]->dealLocation) == count($locations))
                                                        <input type="checkbox" class="assign-one1 all_deal_location_assigned" data-id = "{{$dealManage[0]->id}}" checked/>
                                                        @else
                                                        <input type="checkbox" class="assign-one1 all_deal_location_assigned" data-id = "{{$dealManage[0]->id}}" />
                                                        @endif
                                                    @else
                                                      <input type="checkbox" class="assign-one1 all_deal_location_assigned" data-id = "{{$dealManage[0]->id}}" />
                                                   @endif
                                                @else
                                                 <input type="checkbox" class="assign-one1 all_deal_location_assigned" data-id = "" />
                                                @endif
                                                    
                                                </div>
                                            </th>
                                            <th>
                                                Total Vouchers
                                                <div class="text-center assign-one4 deal_voucher">
                                                    @if(count($dealManage) > 0)
                                                    @if($dealManage[0]->voucher_unlimited == 0)
                                                    {{$dealManage[0]->voucher_number}}
                                                    @else
                                                    Unlimited
                                                    @endif
                                                    @endif
                                                </div>
                                            </th>
                                            <th>Used Vouchers
                                                <div class="text-center assign-one4">
                                                    0%
                                                </div>
                                            </th>
                                        </tr>
                                        <tbody id="deallocation">
                                            {{-- @dd(count($locations)); --}}
                                            @if($is_mobile_business != 1)
                                                @if(count($locations) > 0)
                                                @foreach($locations as $businesslocation)
                                                <tr>
                                                    <td>
                                                        <b>{{$businesslocation->location_name}}</b><br>
                                                        {{$businesslocation->address }}, {{$businesslocation->city}},
                                                        @if($businesslocation->state_id == null)
                                                            {{$businesslocation->state_name }},
                                                        @else
                                                            {{$businesslocation->states->name }},
                                                        @endif
                                                        {{$businesslocation->zip_code}}
                                                        <div class="" id="preview-deal-text">
                                                            <a href="javascript:void(0)" data-id="{{$businesslocation->id}}"
                                                                class="p-deal-one edit_participating">Edit</a>
                                                        </div>
                                                    </td>
                                                    <?php 
                                                                $location = '';
                                                                $checked = '';
                                                                if(count($dealManage) > 0) {
                                                                    
                                                                    if(count($dealManage[0]->dealLocation) > 0) {
                                                                        foreach($dealManage[0]->dealLocation as $deallocation){
                                                                            if($deallocation->location_id == $businesslocation->id){
                                                                                $location = 'yes';
                                                                                $checked = 'checked';
                                                                                break;
                                                                            }
                                                                            else{
                                                                                $location = 'no';
                                                                                $checked = '';
                                                                            }
                                                                        }
                                                                        if( $location === 'yes'){
                                                                            if($dealManage[0]->is_split != 0){
                                                                                if($dealManage[0]->voucher_unlimited == 0){
                                                                                    $voucher =  intval(($dealManage[0]->voucher_number)/count($dealManage[0]->dealLocation));
                                                                                }
                                                                                else{
                                                                                    $voucher = 'Unlimited';
                                                                                }
                                                                            }
                                                                            else{
                                                                                $voucher = $dealManage[0]->voucher_number;
                                                                            }
                                                                        }
                                                                        else{
                                                                            $voucher = '';
                                                                        }
                                                                        
                                                                    }
                                                                    else{
                                                                        $voucher = '';
                                                                        
                                                                    }
                                                                }
                                                                else{
                                                                    $voucher = '';
                                                                
                                                                }

                                                            ?>
                                                    <td>
                                                        <div class="text-center assign-one4">
                                                            <input type="checkbox" class="assign-one1 locationAssigned"
                                                                data-id="{{$businesslocation->id}}" <?php echo $checked;?>/>
                                                        </div>

                                                    </td>
                                                    <td class="dealvoucher">
                                                        <div class="text-center assign-one4 assignedVoucher <?php if($checked == 'checked'){echo 'checked_location';}else{ echo '';} ?>"
                                                            data-id="{{$businesslocation->id}}">
                                                            {{$voucher}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center assign-one4">
                                                            0%
                                                        </div>
                                                    </td>

                                                </tr>
                                                @endforeach
                                                @endif
                                            @else
                                                @if(count($locations) > 0)
                                                    @foreach($locations as $businesslocation)
                                                    <tr>
                                                        <td>
                                                            <b>{{$businesslocation->city}}, </b>
                                                            @if($businesslocation->state_id == null)
                                                            <b>{{$businesslocation->state_name }}</b>
                                                            @else
                                                            <b>{{$businesslocation->states->name }}</b>
                                                            @endif
                                                            
                                                            {{-- <div class="" id="preview-deal-text">
                                                                <a href="javascript:void(0)" data-id="{{$businesslocation->id}}"
                                                                    class="p-deal-one edit_participating">Edit</a>
                                                            </div> --}}
                                                        </td>
                                                        
                                                        <?php 
                                                                    $location = '';
                                                                    $checked = '';
                                                                    if(count($dealManage) > 0) {
                                                                        
                                                                        if(count($dealManage[0]->dealLocation) > 0) {
                                                                            foreach($dealManage[0]->dealLocation as $deallocation){
                                                                                if($deallocation->location_id == $businesslocation->id){
                                                                                    $location = 'yes';
                                                                                    $checked = 'checked';
                                                                                    break;
                                                                                }
                                                                                else{
                                                                                    $location = 'no';
                                                                                    $checked = '';
                                                                                }
                                                                            }
                                                                            if( $location === 'yes'){
                                                                                if($dealManage[0]->is_split != 0){
                                                                                    if($dealManage[0]->voucher_unlimited == 0){
                                                                                        $voucher =  intval(($dealManage[0]->voucher_number)/count($dealManage[0]->dealLocation));
                                                                                    }
                                                                                    else{
                                                                                        $voucher = 'Unlimited';
                                                                                    }
                                                                                }
                                                                                else{
                                                                                    $voucher = $dealManage[0]->voucher_number;
                                                                                }
                                                                            }
                                                                            else{
                                                                                $voucher = '';
                                                                            }
                                                                            
                                                                        }
                                                                        else{
                                                                            $voucher = '';
                                                                            
                                                                        }
                                                                    }
                                                                    else{
                                                                        $voucher = '';
                                                                    
                                                                    }

                                                                ?>
                                                        <td>
                                                            <div class="text-center assign-one4">
                                                                <input type="checkbox" class="assign-one1 locationAssigned"
                                                                    data-id="{{$businesslocation->id}}" <?php echo $checked;?>/>
                                                            </div>

                                                        </td>
                                                        <td class="dealvoucher">
                                                            <div class="text-center assign-one4 assignedVoucher <?php if($checked == 'checked'){echo 'checked_location';}else{ echo '';} ?>"
                                                                data-id="{{$businesslocation->id}}">
                                                                {{$voucher}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center assign-one4">
                                                                0%
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    
                                                    @endforeach
                                                @endif
                                                    @if(count($locations) < 3)
                                                    <tr>
                                                        <td>
                                                            <br>
                                                            <a  lass="add-participating-location" id="add_location_modal" style="color:#1f8ac9; cursor:pointer;">Add Service Location</a> 
                                                            <br><br>
                                                        </td>
                                                        <td></td><td></td><td></td>
                                                    </tr>
                                                    @endif
                                                <tr>
                                                    <td>
                                                        <br>
                                                        <p style="color:#1f8ac9;">No Event Scheduled </p>
                                                    </td>
                                                    <td style="padding-left: 61px;">
                                                        <br>
                                                        @if(count($active_event) > 0)
                                                        <input type="checkbox"  checked style=" width: 25px; height: 25px; pointer-events: none;" />
                                                        @else
                                                        <input type="checkbox" style=" width: 24px; height: 24px; pointer-events: none;" />
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table><br>


                                    <table id="loyalty_programs" style="display:none;">
                                        <tr>
                                        <?php $locations = Auth::user()->merchantBusiness->locations;?>
                                            <th style="padding: 21px;">
                                                <select class="two-hours-text select_program" style="width:120%;">
                                                    @if(count($loyaltyManage) > 0)
                                                    @foreach ($loyaltyManage as $loyalties)
                                                    <option value="{{ $loyalties->id }}">
                                                        {{ $loyalties->program_name }}</option>
                                                    @endforeach
                                                    @else
                                                    <option value="">Select Loyalty Reward Program</option>
                                                    @endif
                                                </select>
                                            </th>
                                            <th class="new-select1" style="padding: 19px;">
                                                Assign to all locations
                                                <div class="text-center assign-one4">
                                                    {{-- @dd($loyaltyManage) --}}
                                                @if(count($loyaltyManage) > 0)
                                                    @if(count($locations) > 0)
                                                        @if(count($loyaltyManage[0]->loyaltylocations) == count($locations))
                                                          <input type="checkbox" class="assign-one1 all_reward_location_assigned" data-id = "{{$loyaltyManage[0]->id}}" checked/>
                                                        @else
                                                          <input type="checkbox" class="assign-one1 all_reward_location_assigned" data-id = "{{$loyaltyManage[0]->id}}" />
                                                        @endif
                                                    @else
                                                      <input type="checkbox" class="assign-one1 all_reward_location_assigned" data-id = "{{$loyaltyManage[0]->id}}" />
                                                   @endif
                                                @else
                                                    <input type="checkbox" class="assign-one1 all_reward_location_assigned" data-id = "" />
                                                @endif
                                                </div>
                                            </th>
                                            <th style="padding: 18px;">
                                                Total Members
                                                <div class="text-center assign-one4 program_consumer">
                                                    @if(count($loyaltyManage) > 0)
                                                    @if(count($loyaltyManage[0]->consumerLoyalty) > 0)
                                                    {{count($loyaltyManage[0]->consumerLoyalty)}}
                                                    @else
                                                    {{0}}
                                                    @endif
                                                    @endif
                                                </div>
                                            </th>
                                            <th style="padding: 18px;">Completion %
                                                <div class="text-center assign-one4">
                                                    0%
                                                </div>
                                            </th>
                                        </tr>
                                        <tbody id="loyaltylocation">

                                            @if(count($locations) > 0)
                                            @foreach($locations as $businesslocation)
                                            <tr>
                                                <td>
                                                    <b>{{$businesslocation->location_name}}</b><br>
                                                    {{$businesslocation->address }}, {{$businesslocation->city}},
                                                    @if($businesslocation->state_id == null)
                                                        {{$businesslocation->state_name }},
                                                    @else
                                                        {{$businesslocation->states->name }},
                                                    @endif
                                                    
                                                    {{$businesslocation->zip_code}}
                                                    <div class="" id="preview-deal-text">
                                                        <a href="javascript:void(0)" data-id="{{$businesslocation->id}}"
                                                            class="p-deal-one edit_participating">Edit</a>
                                                    </div>
                                                </td>
                                                <?php 
                                                    // dd(count($loyaltyManage));
                                                    $location = '';
                                                    $checked = '';
                                                    if(count($loyaltyManage) > 0){
                                                       // if($loyaltyManage[0]) {
                                                            if(count($loyaltyManage[0]->loyaltylocations) > 0) {
                                                                foreach($loyaltyManage[0]->loyaltylocations as $reward_location){
                                                                    if($reward_location->location_id == $businesslocation->id){
                                                                        $location = 'yes';
                                                                        $checked = 'checked';
                                                                        $voucher = '';
                                                                        break;
                                                                    }
                                                                    else{
                                                                        $location = 'no';
                                                                        $checked = '';
                                                                        $voucher = '';
                                                                    }
                                                                }                                                                    
                                                            }
                                                            else{
                                                                $voucher = '';
                                                                
                                                            }
                                                        }
                                                        // else{
                                                        //     $voucher = '';
                                                            
                                                        // }

                                                    else{
                                                        $location = 'no';
                                                        $checked = '';
                                                        $voucher = '';
                                                    }
                                                    

                                                ?>
                                                <td>
                                                    <div class="text-center assign-one4">
                                                        <input type="checkbox" class="assign-one1 rewardlocationAssigned"
                                                            data-id="{{$businesslocation->id}}" <?php echo $checked;?>/>
                                                    </div>

                                                </td>
                                                <td class="totalmember">
                                                    <div class="text-center assign-one4 " data-id="{{$businesslocation->id}}">
                                                        {{$voucher}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center assign-one4">
                                                        0%
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="for_deals_rt_sd rewardSection" style="display: none;">
                                    <div class="active_date_prt_top">
                                        <ul>

                                            <li>
                                                <div class="active_date_prt_top_li">
                                                    <h5>Active Date Span</h5>
                                                    <?php  
                                                    if (count($loyaltyManage) > 0){
                                                        $starton = date_create($loyaltyManage[0]->start_on);
                                                        $rewardstart = date_format($starton, 'm/d/Y');
                                                        if($loyaltyManage[0]->end_on != ''){
                                                         $endon = date_create($loyaltyManage[0]->end_on);
                                                         $rewardend = date_format($endon, 'm/d/Y');
                                                        }
                                                        else{
                                                         $rewardend = 'Open';
                                                        }
                                                    }
                                                    else{
                                                        $rewardstart = 'mm-dd-YYYY';
                                                        $rewardend = 'mm-dd-YYYY';
                                                    }
                                                 ?>
                                                    <p id="reward_datespan">{{$rewardstart}} - {{$rewardend}}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                   
                                    <div class="purchase_rcv_ordr_box">
                                        <div class="purchase_rcv_ordr_box_row row gy-4">
                                         @if (count($loyaltyManage) > 0)
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <textarea class="program_description"
                                                    placeholder="Purchase $150 or more and receive $5 off next order"
                                                    readonly>{{$loyaltyManage[0]->program_name}}</textarea>
                                            </div>
                                        @else
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <textarea class="program_description"
                                                    placeholder="Purchase $150 or more and receive $5 off next order"
                                                    readonly></textarea>
                                            </div>
                                        @endif
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <button type="button" class="btn_table_s blu go_to_manage_program">Loyalty Rewards
                                                    Management</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="for_loyalty_rt_side dealSection">
                                    <div class="active_date_prt_top">
                                        <ul>
                                            <li>
                                                <div class="active_date_prt_top_li">
                                                    <h5>Split Vouchers</h5>
                                                    <div class="text-center assign-one4">
                                                        @if(count($dealManage) > 0)
                                                        @if($dealManage[0]->is_split != 0)
                                                        <input type="checkbox" class="assign-one1 split_voucher"
                                                            checked>
                                                        @else
                                                        <input type="checkbox" class="assign-one1 split_voucher">
                                                        @endif
                                                        @else
                                                        <input type="checkbox" class="assign-one1 split_voucher">
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="active_date_prt_top_li">
                                                    <h5>Active Date Span</h5>
                                                    <?php  
                                                    if (count($dealManage) > 0){
                                                        $startdate = date_create($dealManage[0]->start_Date);
                                                        $sDate = date_format($startdate, 'm/d/Y');
                                                        if($dealManage[0]->end_Date != ''){
                                                         $enddate = date_create($dealManage[0]->end_Date);
                                                         $eDate = date_format($enddate, 'm/d/Y');
                                                        }
                                                        else{
                                                         $eDate = 'Open';
                                                        }
                                                    }
                                                    else{
                                                        $sDate = 'mm-dd-YYYY';
                                                        $eDate = 'mm-dd-YYYY';
                                                    }
                                                 ?>


                                                    <p id="deal_date_span">{{$sDate}} - {{$eDate}}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                 

                                    <div class="purchase_rcv_ordr_box">
                                        <div class="active_date_prt_top_li newww">
                                            @if(count($dealManage) > 0)
                                            @if($dealManage[0]->point != '')
                                            <h5 id="pointtitle">Point Calc.</h5>
                                            <p id="dealpoint">{{$dealManage[0]->point}} pts</p>
                                            @endif
                                            @else
                                            <h5 id="pointtitle">Point Calc.</h5>
                                            <p id="dealpoint">0 pts</p>
                                            @endif
                                        </div>
                                        <div class="purchase_rcv_ordr_box_row row gy-4">
                                            <div class="col-lg-6 purchase_rcv_ordr_box_col">
                                                <h5>Original Sales Price</h5>
                                                @if(count($dealManage) > 0)
                                                <input type="text" placeholder="${{$dealManage[0]->sales_amount}}"
                                                    id="sales_price" readonly>
                                                @else
                                                <input type="text" placeholder="" id="sales_price" readonly>
                                                @endif
                                            </div>
                                            <div class="col-lg-6 purchase_rcv_ordr_box_col">
                                                <h5>Discount Amount</h5>
                                                @if(count($dealManage) > 0)
                                                @if($dealManage[0]->discount_type == 'free')
                                                <input type="text" placeholder="${{$dealManage[0]->discount_amount}}" id="discount_price"
                                                    readonly>
                                                @elseif($dealManage[0]->discount_type == 'discount')
                                                <input type="text" placeholder="${{$dealManage[0]->discount_amount}}" id="discount_price"
                                                    readonly>
                                                @elseif($dealManage[0]->discount_type == 'percentage')
                                                <input type="text" placeholder="{{$dealManage[0]->discount_amount}}%"
                                                    id="discount_price" readonly>
                                                @endif
                                                @else
                                                <input type="text" placeholder="" id="discount_price" readonly>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                @if(count($dealManage) > 0)
                                                <textarea placeholder="{{$dealManage[0]->suggested_description}}"
                                                    id="description" readonly></textarea>
                                                @else
                                                <textarea placeholder="" id="description" readonly></textarea>
                                                @endif
                                            </div>
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <button type="button" class="btn_table_s blu go_to_deal_management">Deal
                                                    Management</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($is_mobile_business != 1)
                            <div class="text-left add_location_button"><button class="add-participating-location"
                                    id="add_location_modal">ADD PARTICIPATING LOCATION</button>
                            </div>
                        @endif
                    </div>
                </div>



                @if($is_mobile_business == 1)
                    @if(count($active_event) == 0)
                        <form id="eventForm">
                            <div class ="container">
                                <div class ="row" style="padding-left: 35px;padding-right: 35px;padding-bottom: 90px;"> 
                                    <div class="col-lg-12">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" id="advertise_event" class="gimigi-checkbok ifcheck" name="advertise_event" style="top: 28px; height: 19px;">
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
                                                <input type="text" placeholder="Event Name" name="event_name">
                                                <span>
                                                    @if ($errors->has('event_name'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_name') }}</div>
                                                    @endif
                                                </span>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <label>Event Start Date</label>
                                                <input type="text" class="start_event_datepicker" placeholder="mm/dd/yyyy" name="event_start_date" onfocus="disableAutocomplete(this)">
                                                <span>
                                                    @if ($errors->has('event_start_date'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_start_date') }}</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Event End Date</label>
                                                <input type="text" class="end_event_datepicker" id= "end_event_datepicker" placeholder="mm/dd/yyyy" name="event_end_date" onfocus="disableAutocomplete(this)">
                                                <span>
                                                    @if ($errors->has('event_end_date'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_end_date') }}</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                                <input type="checkbox" id="one_day_event" class="gimigi-checkbok ifcheck" name="one_day_event" style="top:24px; height: 15px;">
                                                <span>1 Day Event</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p><p>
                                    <div class="col-md-12 field_col_d">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Address of Event</label>
                                                {{-- <input type="text" placeholder="Enter Address" name="event_address"> --}}
                                                <input type="text" placeholder="Street" name="event_address"  id="event_address" autocomplete="new-address" onfocus="disableAutocomplete(this)">
                                                <span>
                                                    @if ($errors->has('event_address'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_address') }}</div>
                                                    @endif
                                                </span>   
                                            </div>

                                            <input type="hidden" name="event_latitude" id="event_latitude">

                                            <input type="hidden" name="event_longitude" id="event_longitude">
                                            
                                            <div class="col-md-3">
                                                <label>City</label>
                                                <input type="text" placeholder="City" name="event_city">
                                                <span>
                                                    @if ($errors->has('event_city'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_city') }}</div>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-md-3">
                                                <label>State</label>
                                                {{-- <input type="text" placeholder="State" name="event_state"> --}}
                                                <select class="select-business-category" name="event_state" id="event_state">
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
                                                <input type="text" placeholder="Enter Zip Code" name="event_zip">
                                                <span>
                                                    @if ($errors->has('event_zip'))
                                                        <div class="error" style="color:red;">{{ $errors->first('event_zip') }}</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="add-participating-location" id="submitEvent" style="float:right;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        @php
                            $event = $active_event->first();
                            // dd($event->states->name);
                        @endphp
                        <div class ="container">
                            <div class ="row" style="padding-left: 35px;padding-right: 35px;padding-bottom: 90px;"> 
                                <div class="col-lg-12">
                                    <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                        <input type="checkbox"  class="gimigi-checkbok ifcheck" style="top: 28px; height: 19px;pointer-events: none;" value="1"
                                        {{ isset($event) && $event->is_event_advertise == 1 ? 'checked' : '' }} >
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
                                            <input type="text" value="{{ $event->event_name ?? '' }}" disabled>  
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Event Start Date</label>
                                            <input type="text"  value="{{ isset($event) ? \Carbon\Carbon::parse($event->event_start_date)->format('m/d/Y') : '' }}" disabled>

                                        </div>
                                        <div class="col-md-4">
                                            <label>Event End Date</label>
                                            <input type="text" value="{{ isset($event) ? \Carbon\Carbon::parse($event->event_end_date)->format('m/d/Y') : '' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group position-relative  gimmzi-will-use d-flex select-catagory1-main">
                                            <input type="checkbox" class="gimigi-checkbok ifcheck" style="top:24px; height: 15px; pointer-events: none;" value="1"
                                            {{ isset($event) && $event->one_day_event == 1 ? 'checked' : '' }}>
                                            <span>1 Day Event</span>
                                        </div>
                                    </div>
                                </div>
                                <p><p>
                                <div class="col-md-12 field_col_d">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Address of Event</label>
                                            <input type="text" value="{{ $event->event_street_address ?? '' }}" disabled>  
                                        </div>
                                        <div class="col-md-3">
                                            <label>City</label>
                                            <input type="text" value="{{ $event->event_city ?? '' }}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label>State</label>
                                            <input type="text" value="{{ $event->states->name ?? '' }}" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Zip Code</label>
                                            <input type="text" value="{{ $event->event_zip ?? '' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif




            </div>
        </div>
    </div>

    {{-- change password modal --}}
    {{-- <div class="modal fade merchent-main-madal" id="changepasswordModal1" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Change Your Password</h2>
                    </div>
                    <form id="changepassword">
                        <div class="merchent-input">
                            <input type="password" placeholder="New Password" id="new_password" name="new_password" />
                            <span class="newerror"></span>
                        </div>
                        <div class="merchent-input">
                            <input type="password" placeholder="Confirm Password" id="confirm_password"
                                name="confirm_password" />
                            <span class="confirmerror"></span>
                        </div>
                        <div class="green-login-button">
                            <button type="submit" class="password_save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
{{-----------------------------------------}}
    <div class="modal fade userLoginPopup travel_auth_popup lg" id="changepasswordModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-head">
                <div class="modal_main_logo"><a href="#"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}" alt=""></a></div>
                <button type="button" class="cmn_close_popup_btn" data-bs-dismiss="modal" aria-label="Close"><i class="close-btn-img"><img src="{{asset('frontend_assets/images/close.png')}}" alt=""></i></button>
            </div>
            <div class="modal-body">
                <div class="login_popup_body">
                        <form id="changepassword">
                            <div class="form_grp merchent-input">
                                <input style="color:black;" type="password" placeholder="New Password" id="new_password" name="new_password" />
                                <span class="newerror"></span>
                            </div>
                            <div class="form_grp merchent-input">
                                <input style="color:black;" type="password" placeholder="Confirm Password" id="confirm_password"
                                    name="confirm_password" />
                                <span class="confirmerror"></span>
                            </div>
                            <div class="form_grp form_grp_submit pw-submit-btn">
                                <button type="submit" class="password_save cmn_theme_btn">Save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        </div>
    </div>

    {{-- Add participating location--}}
    <div class="modal fade cmn_modal_designs" id="add_participating_location_modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Participating location</h5>
                </div>
                <form id="add_participating_location" name="add_participating_location" method="post">
                    <!-- <input type="hidden" id="deal_id" name="deal_id"> -->

                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Select manager for this location *</h5>
                                    <select name="manager_id" id="managers">
                                        <option value="" disabled selected>--select--</option>
                                        @if ($getmanager)
                                        @foreach ($getmanager as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->full_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p class="add-part">No Managers assigned to this location</p>
                                    <span id="managers_error"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Add more user for this location</h5>
                                    <select name="associate_user_id" id="associate_user_id">
                                        <option value="" disabled selected>--select--</option>
                                        @if ($getuser)
                                        @foreach ($getuser as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p class="add-part">No Additional users assigned to this location</p>
                                    <span id="associate_user_error"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Name *</h5>
                                    <input type="text" name="location_name" id="location_name">
                                    <span id="locationnameerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Phone Number *</h5>
                                    <input type="text" name="location_phone" id="location_phone">
                                    <span id="phoneerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Website</h5>
                                    <input type="text" name="location_website" id="location_website">
                                    <span id="faxerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Email</h5>
                                    <input type="text" name="location_email" id="location_email">
                                    <span id="emailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Street Address *</h5>
                                    <input type="text" name="address" id="location_address">
                                    <span id="addresserror"></span>
                                    <input type="hidden" name="location_latitude" id="add_latitude">
                                    <input type="hidden" name="location_longitude" id="add_longitude">
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Zip Code *</h5>
                                    <input type="text" name="zip_code" id="zip_code">
                                    <span id="ziperror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>City *</h5>
                                    <input type="text" name="city" id="city">
                                    <span id="cityerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>State *</h5>
                                    <input type="text" name="state" id="state">
                                    {{-- <select name="state_id" id="state">
                                        <option value=""> Select State </option>
                                        @if ($stateList)
                                        @foreach ($stateList as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                        @endforeach
                                        @endif
                                    </select> --}}
                                    <span id="stateerror"></span>
                                </div>
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Website</h5>
                                    <input type="text" name="website" id="website">
                                    <span id="websiteerror"></span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            <div class="btn_foot_end">
                                <button type="submit" name="submit" class="btn_table_s grn">Add</button>
                                <button class="btn_table_s rdd close_modal" type="button">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Preview deal --}}
    <div class="modal fade preview-modal" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel"
        aria-hidden="true" name="preview">
        <div class="modal-dialog modal-xl deal-management-modal">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="close-button-one11 close_btn" data-bs-dismiss="modal" id="">

                        <img src="{{ asset('frontend_assets/images/cross-icon.svg') }}" alt="img" />
                    </button>

                    <div class="preview-deal-modal-main">
                        <div class="preview-deal-modal-top d-flex justify-content-space-between modal-space1">
                            <div class="preview-deal-modal-top-left">
                                <figutre class="figure-img1">
                                    <img src="{{ Auth::user()->merchantBusiness->logo_image }}"
                                        style="width: 102px;height: 87px; border-radius: 5px" alt="img" />
                                </figutre>
                                <div>
                                    <h2>{{ Auth::user()->merchantBusiness->business_name }}
                                    </h2>
                                    <p><span class="description"></span></p>
                                </div>
                            </div>
                            <div class="preview-deal-modal-top-right">
                                <ul>
                                    <li>
                                        <img src="" style="border-radius: 10px;" alt="img" id="imgDisplay" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row modal-space1">
                            <div class="col-sm-6 deal-point-text">
                                <h2>Used for deal: <span class="point"></span>
                                    Points</h2>

                                <h3> Deal Expires: <span class="expire_date"></span> </h3>

                                {{-- <h3>Deal Expires: --------------</h3> --}}

                            </div>

                        </div>


                        <div class="bottom-location-main">

                            @if (count(Auth::user()->location) > 0)
                            @php $location = Auth::user()->location->first()->businessLocation;@endphp
                            <p style="color: black;"><img
                                    src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" />
                                {{ $location->address }},
                                {{ $location->city }},
                                @if($location->state_id == null)
                                    {{$location->state_name }},
                                @else
                                    {{$location->states->name }},
                                @endif
                                -{{ $location->zip_code }}
                            </p>
                            @else
                            <p style="color: black;"><img
                                    src="{{ asset('frontend_assets/images/location-icon44.svg') }}" alt="img" /> No
                                address </p>
                            @endif

                            @if (Auth::user()->merchantBusiness->business_phone != '')
                            <p style="color: black;"><img src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                    alt="img" /> Phone:
                                {{ Auth::user()->merchantBusiness->business_phone }}
                            </p>
                            @endif
                            <button class="get-direction-text1">Get
                                Directions</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--edit participating modal--}}

    <div class="modal fade cmn_modal_designs" id="edit_participating_location_modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Participating location</h5>
                </div>
                <form id="edit_participating_location" name="edit_participating_location" method="post">
                    {{-- <input type="hidden" id="edit_deal_id" name="edit_deal_id">
                    <input type="hidden" id="deal_location_id" name="deal_location_id"> --}}
                    <input type="hidden" id="edit_location_id" name="edit_location_id">

                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Select manager for this location *</h5>
                                    <select name="edit_location_manager" id="edit_location_manager">
                                        <option value="" disabled selected>--select--</option>
                                        @if ($getmanager)
                                        @foreach ($getmanager as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->full_name }} -
                                            {{$manager->title->title_name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p style="cursor: pointer;" class="add-part" id="edit_manager_count"></p>
                                    <span id="edit_managers_error"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Add more user for this location</h5>
                                    <select name="edit_location_associate" id="edit_location_associate">
                                        <option value="" disabled selected>--select--</option>
                                        @if ($getuser)
                                        @foreach ($getuser as $user)
                                        <option value="{{ $user->id }}">{{ $user->full_name }} -
                                            {{$user->title->title_name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p style="cursor: pointer;" class="add-part" id="edit_associate_count"></p>
                                    <span id="edit_associate_user_error"></span>
                                </div>
                                {{-- <input type="hidden" id="location_id" name="location_id"> --}}
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Name *</h5>
                                    <input type="text" name="edit_location_name" id="edit_location_name">
                                    <span id="edit_locationnameerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Phone Number *</h5>
                                    <input type="text" name="edit_location_phone" id="edit_location_phone">
                                    <span id="edit_phoneerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Website</h5>
                                    <input type="text" name="edit_location_website" id="edit_location_website">
                                    <span id="edit_faxerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Email</h5>
                                    <input type="text" name="edit_location_email" id="edit_location_email">
                                    <span id="edit_emailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Street Address *</h5>
                                    <input type="text" name="edit_address" id="edit_address">
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <span id="edit_addresserror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Zip Code *</h5>
                                    <input type="text" name="edit_zip_code" id="edit_zip_code">
                                    <span id="edit_ziperror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>City *</h5>
                                    <input type="text" name="edit_city" id="edit_city">
                                    <span id="edit_cityerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>State *</h5>
                                    <input type="text" name="edit_state" id="edit_state">
                                    {{-- <select name="edit_state_id" id="edit_state_id">
                                        <option value=""> Select State </option>
                                        @if ($stateList)
                                        @foreach ($stateList as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                        @endforeach
                                        @endif
                                    </select> --}}
                                    <span id="edit_stateerror"></span>
                                </div>
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Website</h5>
                                    <input type="text" name="website" id="website">
                                    <span id="websiteerror"></span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            <div class="btn_foot_end">
                                <button type="submit" name="submit" class="btn_table_s grn">Update</button>
                                <button class="btn_table_s rdd edit_close_modal" type="button">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--participating location user list--}}
    <div class="modal fade cmn_modal_designs" id="manager_associate_list" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title locationname" style="font-size:27px;"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
                <div class="modal-body">
                    <div class="table_cmn_part_sgn">
                        <div class="table_user_top_sec_col_lft new">
                            <h3>Management Level</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Access</th>
                                    <th>Home Location</th>
                                </tr>
                            </thead>

                            <tbody id="manager_level_list">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="table_cmn_part_sgn">
                        <div class="table_user_top_sec_col_lft new">
                            <h3>Associate Level</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Access</th>
                                    <th>Home Location</th>
                                </tr>
                            </thead>

                            <tbody id="associate_level_list">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <div class="selctd_table_sec large">
                                    <select id="another_user_list" name="another_user_list">

                                    </select>
                                    <span id="managererror"></span>
                                </div>
                                <div class="cmn_links_clkd">
                                    <a href="javascript:void(0)" id="addanotheruser">Add User</a>
                                </div>
                                <span id="erroraccess"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- user reset password --}}
    <!--<div class="modal fade merchent-main-madal" id="resetpasswordModal" tabindex="-1" aria-labelledby="resetpasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Change Your Password</h2>
                    </div>
                    <form id="resetpassword">
                    <div class="merchent-input">
                        <input type="password" placeholder="New Password" id="new_password" name="new_password" />
                            <span class="newerror"></span>
                    </div>
                    <div class="merchent-input">
                        <input type="password" placeholder="Confirm Password" id="confirm_password"  name="confirm_password" />
                            <span class="confirmerror"></span>
                    </div>
                    <div class="green-login-button">
                        <button type="submit" class="password_save">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    {{-- view and add location modal --}}
    <div class="modal fade cmn_modal_designs gap_sec_modal1" id="location_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title new" id="deal_name"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                
                <div class="modal-body manage-program-tab-content-main-sec">
                {{-- <span id="showProgramEndDate">Program End Date:</span> --}}
                    <div class="table_user_top_sec_col_lft new">
                        <h3 id="mainlocation"></h3>
                    </div>
                    <div class="table_cmn_part_sgn table-manage-program-sec">
                        <input type="hidden" id="location_deal_id" name="location_deal_id">
                        <table>
                            <thead>
                                <tr>
                                    <th>Participating Locations</th>
                                    <th style="font-size: 13px;">Action</th>
                                    <th style="font-size: 13px;">Used Vouchers</th>
                                    <th>Vouchers left</th>
                                </tr>
                            </thead>

                            <tbody id="get_dealLocation">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <div class="selctd_table_sec large">
                                    <select id="business_location" name="business_location">

                                    </select>
                                </div>
                                <div class="cmn_links_clkd">
                                    <a href="javascript:void(0)" id="addlocationtoprogram">Add deal to this
                                        location</a>
                                </div>
                                <span id="erroraccess"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- deal end date button click modal --}}
    <div class="modal fade merchent-main-madal" id="clickEndDateModal" tabindex="-1" aria-labelledby="clickEndDateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Deal</h1>
                    </div>

                    <div class="row">
                        <input type="hidden" id="end_date_deal_id" name="end_date_deal_id">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the deal can be ended in 7 days from time of request.</p>
                            <p style="color: #fff;">If deal was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>

                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one deal_schedule_end_date" type="button"
                                style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                End Date</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one yes_set_deal_end_date" type="button" name="stepone"
                                style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- deal 'schedule end date' button click & set end date modal --}}
    <div class="modal fade merchent-main-madal" id="scheduleEndDateSetModal" tabindex="-1"
       aria-labelledby="scheduleEndDateSetModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body position-relative">
                   <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                           src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                   <div class="border_bottom">
                       <h2>Select a date to end this Deal</h2>
                   </div>
                   <form id="dateSet" name="dateSet" method="post">
                       @csrf
                       <div class="row">
                           {{-- <input type="hidden" id="extend_type" name="extend_type"> --}}
                           <input type="hidden" id="select_deal_id" name="select_deal_id">
                           <div class="merchent-input">
                               <input type="text" placeholder="" id="schedule_end_date" name="schedule_end_date" class="datepicker"
                                   style="margin:10px; padding:10px;" />
                           </div>
                           <span id="scheduleenddaterror"></span>

                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                   aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                           </div>
                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" name="stepone" id="setDealEndDate"
                                   style="width:81%;">Set End Date</button>
                           </div>
                       </div>

                   </form>
               </div>
           </div>
       </div>
    </div>
    {{-- When user select 'Yes' but end date set after 30 days by system --}}
    <div class="modal fade merchent-main-madal" id="yesEndDateSetModal" tabindex="-1"
        aria-labelledby="yesenddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;">To allow participating consumers enough notice, the earliest the deal can be ended is 14 days from time of request</h3>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            <p style="font-size: 23px;color: #fff;margin-top: 22px;">Deal End Date: <span id="setenddate"></span></p>

                            <input type="hidden" id="extend_date" name="extend_date">
                            <input type="hidden" id="enddeal_id" name="enddeal_id">
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="yesDealEndDate"
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- deal 'extend deal' button click & set end date modal --}}
    <div class="modal fade merchent-main-madal" id="extendEndDateSetModal" tabindex="-1"
       aria-labelledby="scheduleEndDateSetModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-body position-relative">
                   <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                           src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                   <div class="border_bottom">
                       <h2>Select a date to extend this Deal</h2>
                   </div>
                   <form id="dateSet" name="dateSet" method="post">
                       @csrf
                       <div class="row">
                           {{-- <input type="hidden" id="extend_type" name="extend_type"> --}}
                           <input type="hidden" id="extend_deal_id" name="extend_deal_id">
                           <div class="merchent-input">
                               <input type="text" placeholder="" id="extend_end_date" name="extend_end_date" class="datepicker"
                                   style="margin:10px; padding:10px;" />
                           </div>
                           <span id="scheduleenddaterror"></span>

                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                   aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                           </div>
                           <div class="col-sm-6 login-top-one1">
                               <button class="login-button-one" type="button" name="stepone" id="extendDealEndDate"
                                   style="width:81%;">Extend</button>
                           </div>
                       </div>

                   </form>
               </div>
           </div>
       </div>
    </div>

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" onclick="window.location.reload();">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- participating loaction success modal --}}
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="location_success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="locationsuccessmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd close_success_modal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>
    <script>
            @if (Auth::user()->created_password != '')
                $(window).on('load', function() {
                    $('#changepasswordModal').modal('show');
                });
            @endif
            @if (!empty(Session::get('token')))
                $(window).on('load', function() {
                    $('#changepasswordModal').modal('show');
                });
            @endif

            $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
            });
            $(function() {
                if (sessionStorage.getItem("openModal")){
                    if (sessionStorage.getItem("openModal") == 'deal_management'){
                        $('#dealManagement').modal('show');
                        sessionStorage.removeItem("openModal");
                    }
                }
                   

            });
            $(document).ready(function() {
                $(document).on('click',".loyalty_reward", function(){
                    $("#deals").css('display','none');
                    $("#loyalty_programs").css('display','block');
                    $(".dealSection").css('display','none');
                    $(".rewardSection").css('display','block');

                });
                $(document).on('click',".deal", function(){
                    $("#deals").css('display','block');
                    $("#loyalty_programs").css('display','none');
                    $(".dealSection").css('display','block');
                    $(".rewardSection").css('display','none');

                });

                $('#changepasswordModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $("button[data-bs-dismiss=modal2]").click(function() {
                    $('#exampleModal2').modal('hide');
                });

                $(".collapsebutton").on('click', function(){
                    if ($('#itemserviceform').css('display') == 'none') {
                        $('#itemserviceform').show();
                        $("#collapsetitle").text('');
                        $("#collapsetitle").text('Collapse Entry');
                        $("#collapseimage").attr('src',"{{ asset('frontend_assets/images/left_arrow.png') }}");
                    }
                    else{
                        $('#itemserviceform').hide();
                        $("#collapsetitle").text('');
                        $("#collapsetitle").text('Add an item or service to database');
                        $("#collapseimage").attr('src',"{{ asset('frontend_assets/images/right_arrow.png') }}");
                    }
                })


                $(".preview_deal").on('click', function() {
                    var deal_Id = $(this).data('id');
                    console.log(deal_Id);
                    $.ajax({
                        url: '{{ route('frontend.business_owner.preview.deal') }}',
                        type: 'GET',
                        data: {
                            'deal_Id': deal_Id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                $("#previewModal").modal('show');
                                $(".point").text(response.data.point);
                                $(".description").text(response.data.suggested_description);
                                $("#imgDisplay").attr('src',response.data.deal_image);
                                if (response.data.end_Date != null) {
                                    $(".expire_date").text(response.data.end_Date);
                                } else {
                                    $(".expire_date").html('Open');
                                }

                            }

                        }
                    });
                });
                //deal description update
                $(".update_btn").on('click', function() {
                    var description_Id = $(this).data('id');
                    var description = $('.modify_description' + description_Id).val();
                    // console.log($('.modify_description'+description_Id).val());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.description.edit') }}',
                        type: 'POST',
                        data: {
                            'description_Id': description_Id,
                            'description': description
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {
                                toastr.success('Deal Description updated successfully');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            }
                        }
                    });

                });


                //$("input[type='checkbox']").on('click', function() {
                
            });
            $("#edit_address").on('keyup', function(){ 
                // console.log(123);
                   var input = document.getElementById('edit_address');
                   var autocomplete = new google.maps.places.Autocomplete(input);
                   autocomplete.setComponentRestrictions({'country': ['us']});
                   google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                       var place = autocomplete.getPlace();
                       console.log( autocomplete.getPlace());
                       
                       $('#latitude').val(place.geometry['location'].lat());
                       $('#longitude').val(place.geometry['location'].lng());

                       console.log(place.geometry['location'].lat());
            
                       for(var i = 0; i < place.address_components.length; i++){
                           console.log(place.address_components[i]);
                           for (var j = 0; j < place.address_components[i].types.length; j++) {
                               if (place.address_components[i].types[j] == "postal_code") {
                               
                                   $("#edit_zip_code").val(place.address_components[i].long_name);
                               }
                              
                               if (place.address_components[i].types[j] == "locality") {
                                   $("#edit_city").val(place.address_components[i].long_name);
                               }

                               if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                   $("#edit_state").val(place.address_components[i].long_name);
                               }
                           }
                       }
                   });
            });
            $("#location_address").on('keyup', function(){
                var input = document.getElementById('location_address');
                   var autocomplete = new google.maps.places.Autocomplete(input);
                   autocomplete.setComponentRestrictions({'country': ['us']});
                   google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                       var place = autocomplete.getPlace();
                       console.log(place);
                       
                       $('#add_latitude').val(place.geometry['location'].lat());
                       $('#add_longitude').val(place.geometry['location'].lng());

                       console.log(place.geometry['location'].lat());
            
                       for(var i = 0; i < place.address_components.length; i++){
                           console.log(place.address_components[i]);
                           for (var j = 0; j < place.address_components[i].types.length; j++) {
                               if (place.address_components[i].types[j] == "postal_code") {
                               
                                   $("#zip_code").val(place.address_components[i].long_name);
                               }
                              
                               if (place.address_components[i].types[j] == "locality") {
                                   $("#city").val(place.address_components[i].long_name);
                               }
                               if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                   $("#state").val(place.address_components[i].long_name);
                               }
                           }
                       }
                   });
            });
            $(document).ready(function() {

                $("#changepassword").on('submit', function(e) {
                    e.preventDefault();
                    console.log($("#new_password").val());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.change-password') }}',
                        type: "POST",
                        data: {
                            new_password: $("#new_password").val(),
                            confirm_password: $("#confirm_password").val(),
                        },
                        success: function(response) {
                            if (response.status == 4) {
                                setTimeout(() => {
                                    toastr.success(
                                        'Password updated successfully but mail not sent'
                                        );
                                    location.reload();
                                }, 500);
                                $(".newerror").html('');
                            } else if (response.status == 1) {
                                $(".confirmerror").html('');
                                setTimeout(() => {
                                    $('#changepasswordModal').modal('hide');
                                    toastr.success(
                                        'Password updated successfully and mail sent to your email address'
                                        );
                                }, 500);
                            } else if (response.status == 0) {
                                $(".confirmerror").html(
                                    'New password and confirm password does not matched').css(
                                    'color', 'red');
                            } else if (response.status == 2) {
                                $(".confirmerror").html('Confirm password field is required..').css(
                                    'color', 'red');
                            } else if (response.status == 3) {
                                $(".newerror").html('New password field is required..').css('color',
                                    'red');
                            }
                        }
                    });
                });

                $(document).on('keyup','#zip_code,#edit_zip_code', function() {
                    var zipcode = $(this).val();
                    var id = $(this).attr('id');
                    if (zipcode.length == 5) {
                        $.ajax({
                            url: '{{ route('frontend.ajax.get_city') }}',
                            type: 'get',
                            data: {
                                'zipcode': zipcode
                            },
                            success: function(response) {
                                // console.log(response);
                                // console.log(id);
                                if(id === 'zip_code'){
                                    
                                    if (response.success == 1) {
                                        console.log(response.state_name);
                                    $("#city").val(response.data.City);
                                    $("#ziperror").html('');
                                    $("#state").val(response.state_name);

                                    } else {
                                        $("#ziperror").html(response.data[0]);
                                        $("#ziperror").css('color', 'red');
                                    }
                                }
                                else{
                                    //console.log(response.data);
                                    if (response.success == 1) {
                                    $("#edit_city").val(response.data.City);
                                    $("#ziperror").html('');
                                    $("#edit_state_id").val(response.state_name);

                                    } else {
                                        $("#ziperror").html(response.data[0]);
                                        $("#ziperror").css('color', 'red');
                                    }
                                }
                                

                            }
                        });
                    } else {
                        //$("#profilecity").val('');
                    }

                });

                var addvalidator = $("#add_participating_location").validate({
                    rules: {
                        manager_id: {
                            required:true,
                        },
                        location_name: "required",
                        location_phone: {
                            required: true,
                            digits: true,
                        },
                        location_email: {
                            email: true,
                        },
                        location_website: {
                            url: true,
                        },
                        address: {
                            required: true,
                        },
                        zip_code: {
                            required: true,
                        },
                        city: {
                            required: true,
                        },
                        state: {
                            required: true,
                        },
                        state: {
                            required: true,
                        },
                        state: {
                            required: true,
                        },

                    },
                    messages: {
                        manager_id: {
                            required: "Please select manager",
                           
                        },
                        location_name: "Please enter location name",
                        location_phone: {
                            required: "Please enter location phone number ",
                            digits: "Phone number must be a number"
                            
                        },
                        location_email: {
                            email: "Please enter a valid email address",
                        },
                        location_fax: {
                            minlength: "Please enter at least 10 characters.",
                        },
                        address: {
                            required: "Please enter location address ",
                            
                        },
                        zip_code: {
                            required: "Please enter location zip code",
                           
                        },
                        city: {
                            required : "Please enter location city"
                        },
                        state_id: {
                            required: "Please enter location state",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                var editvalidator = $("#edit_participating_location").validate({
                    rules: {
                        edit_location_name: "required",
                        edit_location_phone: {
                            required: true,
                            digits: true,
                        },
                        edit_location_email: {
                            email: true,
                        },
                        edit_location_website: {
                            url: true,
                        },
                        edit_address: {
                            required: true,
                        },
                        edit_zip_code: {
                            required: true,
                        },
                        edit_city: {
                            required: true,
                        },
                        edit_state: {
                            required: true,
                        },

                    },
                    messages: {
                        
                        edit_location_name: "Please enter location name",
                        edit_location_phone: {
                            required: "Please enter location phone number ",
                            digits: "Phone number must be a number"
                            
                        },
                        edit_location_email: {
                            email: "Please enter a valid email address",
                        },
                        edit_address: {
                            required: "Please enter location address ",
                            
                        },
                        edit_zip_code: {
                            required: "Please enter location zip code",
                           
                        },
                        edit_city: {
                            required : "Please enter location city"
                        },
                        edit_state: {
                            required: "Please enter location state",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                $("#add_location_modal").click(function(){
                    $('#add_participating_location_modal').modal('show');
                    //$('#deal_id').val($('.select_deal :selected').val()); 
                    $('#add_participating_location').find('form').trigger('reset');
                });

                $(".another_location_modal").click(function(){
                    $('#add_participating_location_modal').modal('show');
                    $('#deal_id').val($(this).data('id')); 
                    $('#add_participating_location').find('form').trigger('reset');
                });

                $(".close_modal").click(function(){
                   
                    $('#managers_error').html('');
                    $('#locationnameerror').html('');
                    $('#phoneerror').html('');
                    $('#faxerror').html('');
                    $('#emailerror').html('');
                    $('#addresserror').html('');
                    $('#ziperror').html('');
                    $('#cityerror').html('');
                    $('#stateerror').html('');
                    addvalidator.resetForm();

                    $('#add_participating_location_modal').modal('hide');
                    $('#add_participating_location_modal').find('form').trigger('reset');
                });

                $(".edit_close_modal").click(function(){
                   
                   $('#edit_managers_error').html('');
                   $('#edit_locationnameerror').html('');
                   $('#edit_phoneerror').html('');
                   $('#edit_faxerror').html('');
                   $('#edit_emailerror').html('');
                   $('#edit_addresserror').html('');
                   $('#edit_ziperror').html('');
                   $('#edit_cityerror').html('');
                   $('#edit_stateerror').html('');
                   editvalidator.resetForm();

                   $('#edit_participating_location_modal').modal('hide');
                   $('#edit_participating_location_modal').find('form').trigger('reset');
                });


                $("#add_participating_location").submit(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var form = $('#add_participating_location')[0];
                    var formdata = new FormData(form);
              
                    

                    $.ajax({
                        url: "{{ route('frontend.business_owner.add_new_participating_location') }}",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        success: function(result) {
                            console.log(result);
                            if (result.status == 10) {
                                $("#add_participating_location_modal").modal('hide');
                                $("#location_success_modal").modal('show');
                                $("#locationsuccessmsg").html('Participating Location has been added successfully.');

                            } else if (result.status == 9) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#managers_error').html('Please select manager').css('color',
                                //     'red');
                            } else if (result.status == 8) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#locationnameerror').html('Location name field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 7) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#phoneerror').html('Location phone field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 0) {
                                console.log('123');
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#faxerror').html('');
                                $('#phoneerror').html('');
                                $('#emailerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#phoneerror').html(result.validation_errors).css('color', 'red');

                            } else if (result.status == 2) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#emailerror').html('');
                                $('#faxerror').html('');
                                $('#phoneerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#emailerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 1) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#emailerror').html('');
                                $('#phoneerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#faxerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 6) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#addresserror').html('Location address field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 5) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#ziperror').html('Location zip code field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 4) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#cityerror').html('Location city field is required').css('color',
                                //     'red');

                            } else if (result.status == 3) {
                                $('#managers_error').html('');
                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#stateerror').html('Location state field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 11) {
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Business Location not saved.');
                            }
                        }
                    });
                });

                $("#edit_participating_location").submit(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    
                    var form = $('#edit_participating_location')[0];
                    var formdata = new FormData(form);
                    console.log(formdata);
                    $.ajax({
                        url: "{{ route('frontend.business_owner.update_participating_location') }}",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        success: function(result) {
                            console.log(result);
                            if (result.status == 10) {
                                $("#add_participating_location_modal").modal('hide');
                                $("#location_success_modal").modal('show');
                                $("#locationsuccessmsg").html('Participating Location has been updated successfully.');

                            }  else if (result.status == 8) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#locationnameerror').html('Location name field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 7) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#phoneerror').html('Location phone field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 0) {
                                console.log('123');
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                $('#edit_phoneerror').html(result.validation_errors).css('color', 'red');

                            } else if (result.status == 2) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                $('#edit_emailerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 1) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                $('#edit_faxerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 6) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#addresserror').html('Location address field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 5) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#ziperror').html('Location zip code field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 4) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#cityerror').html('Location city field is required').css('color',
                                //     'red');

                            } else if (result.status == 3) {
                                $('#edit_managers_error').html('');
                                $('#edit_locationnameerror').html('');
                                $('#edit_phoneerror').html('');
                                $('#edit_faxerror').html('');
                                $('#edit_emailerror').html('');
                                $('#edit_addresserror').html('');
                                $('#edit_ziperror').html('');
                                $('#edit_cityerror').html('');
                                $('#edit_stateerror').html('');
                                // $('#stateerror').html('Location state field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 11) {
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Business Location not updated.');
                            }
                        }
                    });
                });

                $(document).on('change', '.select_deal', function() {

                   var dealid =  $(this).val();
                   //console.log(dealid);
                   $(".preview_deal").attr('data-id',dealid)
                   $.ajax({
                            url: "{{ route('frontend.business_owner.get_deal') }}",
                            type: 'GET',
                            data: {
                                'deal_Id': dealid,

                            },
                            success: function(response) {
                                if(response.success == 1){
                                    if($(".all_deal_location_assigned").is(':checked')){
                                        $(".all_deal_location_assigned").prop('checked',false);
                                    }
                                    
                                    $(".all_deal_location_assigned").attr('data-id',dealid);
                                    if(response.data.voucher_unlimited == 0){
                                        var voucher = response.data.voucher_number;
                                    }
                                    else{
                                        var voucher = 'Unlimited';
                                    }
                                    $('.deal_voucher').html(voucher);
                                    $('#deallocation').html('');
                                    if(response.data.is_split != 0){
                                        $(".split_voucher").attr('checked','checked');
                                        if(response.data.deal_location.length > 0){
                                            if(voucher != 'Unlimited'){
                                                //console.log(response.data.deal_location.length);
                                                var divide = parseInt(voucher / response.data.deal_location.length);
                                            }
                                            else{
                                                var divide = voucher;
                                            }

                                        }
                                    }
                                    else{
                                        var divide = voucher;
                                        $(".split_voucher").attr('checked',false);
                                    }
                                    // console.log(response.data.deal_location );

                                    if(response.data.physical_location === response.data.deal_location.length){
                                        $(".add_location_button").css('display','none');
                                    }
                                    else{
                                        $(".add_location_button").css('display','flex');
                                    }

                                   // console.log(response.locations.length);
                                   var deal_location_count = 0;
                                    if(response.locations.length > 0){
                                        for(var i = 0 ; i < response.locations.length ; i++){
                                            var location = '';
                                            var checked = '';
                                            
                                            if(response.data.deal_location.length > 0) {
                                                for(var j = 0 ; j < response.data.deal_location.length ; j++){
                                                    if(response.data.deal_location[j].location_id == response.locations[i].id){
                                                            location = 'yes';
                                                            checked = 'checked';
                                                            var checked_location = 'checked_location';
                                                            deal_location_count = parseInt(deal_location_count+1);
                                                            break;
                                                    }
                                                    else{
                                                        location = 'no';
                                                        checked = '';
                                                        var checked_location = '';
                                                    }

                                                }
                                                if( location === 'yes'){
                                                    if(response.data.is_split != 0){
                                                        if(response.data.voucher_unlimited == 0){
                                                            //console.log(voucher);
                                                            var splitvoucher =  parseInt(voucher / response.data.deal_location.length);
                                                        }
                                                        else{
                                                            
                                                            var splitvoucher = 'Unlimited';
                                                            
                                                        }
                                                    }
                                                    else{
                                                        
                                                        if(response.data.voucher_unlimited == 0){
                                                            //console.log(voucher);
                                                            var splitvoucher = response.data.voucher_number;
                                                        }
                                                        else{
                                                            
                                                            var splitvoucher = 'Unlimited';
                                                            
                                                        }
                                                       
                                                    }
                                                }
                                                    else{
                                                        var splitvoucher = '';
                                                        
                                                    }
                                                    
                                            }
                                            else{
                                                var splitvoucher = '';
                                               
                                            }
                                     
                                            if(response.locations[i].states) {
                                                var locationData = '<tr>'+
                                                        '<td><b>'+response.locations[i].location_name+'</b><br>'+
                                                        response.locations[i].address +', '+ response.locations[i].city + ', '+
                                                        response.locations[i].states.name +', '+ response.locations[i].zip_code +' '+
                                                            '<div class="" id="preview-deal-text">'+
                                                                '<a href="javascript:void(0)" data-id = "'+response.locations[i].id+'" class="p-deal-one edit_participating">Edit</a>'+
                                                            '</div>'+
                                                        '</td>'+
                                                        '<td>'+
                                                            '<div class="text-center assign-one4">'+
                                                                '<input type="checkbox" class="assign-one1 locationAssigned " '+checked+' data-id = "'+response.locations[i].id+'"/>'+
                                                            '</div>'+
                                                        '</td>'+
                                                        '<td class="dealvoucher">'+
                                                            '<div class="text-center assign-one4 assignedVoucher '+checked_location+'" data-id = "'+response.locations[i].id+'">'+splitvoucher+'</div>'+
                                                        '</td>'+
                                                        '<td><div class="text-center assign-one4">0%</div></td>'+
                                                    '</tr>';
                                            } 
                                            else{
                                                var locationData = '<tr>'+
                                                        '<td><b>'+response.locations[i].location_name+'</b><br>'+
                                                        response.locations[i].address +', '+ response.locations[i].city + ', '+
                                                        response.locations[i].state_name +', '+ response.locations[i].zip_code +' '+
                                                            '<div class="" id="preview-deal-text">'+
                                                                '<a href="javascript:void(0)" data-id = "'+response.locations[i].id+'" class="p-deal-one edit_participating">Edit</a>'+
                                                            '</div>'+
                                                        '</td>'+
                                                        '<td>'+
                                                            '<div class="text-center assign-one4">'+
                                                                '<input type="checkbox" class="assign-one1 locationAssigned " '+checked+' data-id = "'+response.locations[i].id+'"/>'+
                                                            '</div>'+
                                                        '</td>'+
                                                        '<td class="dealvoucher">'+
                                                            '<div class="text-center assign-one4 assignedVoucher '+checked_location+'" data-id = "'+response.locations[i].id+'">'+splitvoucher+'</div>'+
                                                        '</td>'+
                                                        '<td><div class="text-center assign-one4">0%</div></td>'+
                                                    '</tr>';
                                            }             
                                            
                                            $('#deallocation').append(locationData);
                                        }
                                    }
                                    // console.log(response.locations.length);
                                    // console.log(deal_location_count);
                                    if(response.locations.length == deal_location_count){
                                        $(".all_deal_location_assigned").prop('checked',true);
                                    }
                                    else{
                                        $(".all_deal_location_assigned").prop('checked',false);
                                    }
                                    $("#deal_date_span").html('');
                                    var start_date  = new Date(response.data.start_Date);
                                    var s_Date = ((start_date.getMonth() > 8) ? (start_date.getMonth() + 1) : ('0' + (start_date.getMonth() + 1))) + '/' + ((start_date.getDate() > 9) ? start_date.getDate() : ('0' + start_date.getDate())) + '/' + start_date.getFullYear();
                                    if(response.data.end_Date != null){
                                        var end_date  = new Date(response.data.end_Date);
                                        var e_Date = ((end_date.getMonth() > 8) ? (end_date.getMonth() + 1) : ('0' + (end_date.getMonth() + 1))) + '/' + ((end_date.getDate() > 9) ? end_date.getDate() : ('0' + end_date.getDate())) + '/' + end_date.getFullYear();
                                    }
                                    else{
                                        var e_Date = 'Open';
                                    }
                                    $("#deal_date_span").html(s_Date +' - '+ e_Date);
                                    
                                    if(response.data.point != null){
                                        $("#dealpoint").html(response.data.point+' pts');
                                    }
                                    else{
                                        $("#pointtitle").html('');
                                        $("#dealpoint").html('');
                                    }
                                    $("#sales_price").val('');
                                    $("#sales_price").val('$'+response.data.sales_amount);
                                    $("#discount_price").val('');
                                    if(response.data.discount_type == 'free'){
                                        $("#discount_price").val('$'+response.data.discount_amount);
                                    }
                                    else if(response.data.discount_type == 'discount'){
                                        console.log(response.data.discount_amount);
                                        $("#discount_price").val('$'+response.data.discount_amount);
                                    }
                                    else if(response.data.discount_type == 'percentage'){
                                        $("#discount_price").val(Math.floor(response.data.discount_amount)+'%');
                                    }
                                    $("#description").val('');
                                    $("#description").val(response.data.suggested_description);
                                }
                                
                            }
                        });
                });

                $(document).on('change', '.select_program', function() {

                    var programid =  $(this).val();
                    // $(".preview_deal").attr('data-id',dealid)
                    $.ajax({
                            url: "{{ route('frontend.business_owner.get_loyalty_program') }}",
                            type: 'GET',
                            data: {
                                'program_id': programid,

                            },
                            success: function(response) {
                                if(response.success == 1){
                                    if($(".all_reward_location_assigned").is(':checked')){
                                        $(".all_reward_location_assigned").prop('checked',false);
                                    }
                                    
                                    $(".all_reward_location_assigned").attr('data-id',programid);
                                    var totalConsumer = response.data.consumer_count;
                                    $('.program_consumer').html(totalConsumer);
                                    $('#loyaltylocation').html('');
                                    var reward_location_count = 0;
                                    $(".all_reward_location_assigned").attr('checked',false);
                                    if(response.locations.length > 0){
                                        for(var i = 0 ; i < response.locations.length ; i++){
                                            var rewardlocation = '';
                                            var rewardchecked = '';
                                            var reward_checked_location = '';
                                            if(response.data.loyaltylocations.length > 0) {
                                                for(var j = 0 ; j < response.data.loyaltylocations.length ; j++){
                                                    if(response.data.loyaltylocations[j].location_id == response.locations[i].id){
                                                        rewardlocation = 'yes';
                                                        rewardchecked = 'checked';
                                                        reward_checked_location = 'checked_location';
                                                        reward_location_count = parseInt(reward_location_count+1);
                                                            break;
                                                    }
                                                    else{
                                                        rewardlocation = 'no';
                                                        rewardchecked = '';
                                                        reward_checked_location = '';
                                                    }
                                                }      
                                            }   
                                            // console.log(response.locations[i].id); 
                                            // console.log(reward_checked_location); 
                                            if(response.locations[i].states) {                             
                                                var locationData = '<tr>'+
                                                            '<td><b>'+response.locations[i].location_name+'</b><br>'+
                                                            response.locations[i].address +', '+ response.locations[i].city + ', '+
                                                            response.locations[i].states.name +', '+ response.locations[i].zip_code +' '+
                                                                '<div class="" id="preview-deal-text">'+
                                                                    '<a href="javascript:void(0)" data-id = "'+response.locations[i].id+'" class="p-deal-one edit_participating">Edit</a>'+
                                                                '</div>'+
                                                            '</td>'+
                                                            '<td>'+
                                                                '<div class="text-center assign-one4">'+
                                                                    '<input type="checkbox" class="assign-one1 rewardlocationAssigned "'+rewardchecked+' data-id = "'+response.locations[i].id+'"/>'+
                                                                '</div>'+
                                                            '</td>'+
                                                            '<td class="totalmember">'+
                                                                '<div class="text-center assign-one4" data-id = "'+response.locations[i].id+'"></div>'+
                                                            '</td>'+
                                                            '<td><div class="text-center assign-one4">0%</div></td>'+
                                                        '</tr>';
                                            }
                                            else{
                                                var locationData = '<tr>'+
                                                            '<td><b>'+response.locations[i].location_name+'</b><br>'+
                                                            response.locations[i].address +', '+ response.locations[i].city + ', '+
                                                            response.locations[i].state_name +', '+ response.locations[i].zip_code +' '+
                                                                '<div class="" id="preview-deal-text">'+
                                                                    '<a href="javascript:void(0)" data-id = "'+response.locations[i].id+'" class="p-deal-one edit_participating">Edit</a>'+
                                                                '</div>'+
                                                            '</td>'+
                                                            '<td>'+
                                                                '<div class="text-center assign-one4">'+
                                                                    '<input type="checkbox" class="assign-one1 rewardlocationAssigned "'+rewardchecked+' data-id = "'+response.locations[i].id+'"/>'+
                                                                '</div>'+
                                                            '</td>'+
                                                            '<td class="totalmember">'+
                                                                '<div class="text-center assign-one4" data-id = "'+response.locations[i].id+'"></div>'+
                                                            '</td>'+
                                                            '<td><div class="text-center assign-one4">0%</div></td>'+
                                                        '</tr>';
                                            }
                                            $('#loyaltylocation').append(locationData);
                                        }
                                    }
                                    if(response.locations.length == reward_location_count){
                                        $(".all_reward_location_assigned").prop('checked',true);
                                    }
                                    else{
                                        $(".all_reward_location_assigned").prop('checked',false);
                                    }
                                    $("#reward_datespan").html('');
                                    $(".program_description").html('');
                                    var start_date  = new Date(response.data.start_on);
                                    var s_Date = ((start_date.getMonth() > 8) ? (start_date.getMonth() + 1) : ('0' + (start_date.getMonth() + 1))) + '/' + ((start_date.getDate() > 9) ? start_date.getDate() : ('0' + start_date.getDate())) + '/' + start_date.getFullYear();
                                    if(response.data.end_on != null){
                                        var end_date  = new Date(response.data.end_on);
                                        var e_Date = ((end_date.getMonth() > 8) ? (end_date.getMonth() + 1) : ('0' + (end_date.getMonth() + 1))) + '/' + ((end_date.getDate() > 9) ? end_date.getDate() : ('0' + end_date.getDate())) + '/' + end_date.getFullYear();
                                    }
                                    else{
                                        var e_Date = 'Open';
                                    }
                                    $("#reward_datespan").html(s_Date +' - '+ e_Date);
                                    
                                    if(response.data.program_name != null){
                                        $(".program_description").val(response.data.program_name);
                                    }
                                    else{
                                        $(".program_description").val('');
                                    }
                                   
                                }
                                
                            }
                        });
                });

                $(document).on('click','.split_voucher', function(){
                   
                    if($('.deal_voucher').text().trim() != 'Unlimited'){
                        if($('.split_voucher').is(':checked') == true){
                            var split = 'yes';
                            var voucher = $('.deal_voucher').text().trim();
                            var deal_id = $(".select_deal").val();
                            var trCount = $('#deallocation tr').find('div.checked_location').length;
                            var divide = parseInt(voucher / trCount);
                            $('.dealvoucher').find('div').html('');
                            $('.dealvoucher').find('div.checked_location').html(divide);
                        }
                        else{
                            var split = 'no';
                            var deal_id = $(".select_deal").val();
                            $('.dealvoucher').find('div').html('');
                            $('.dealvoucher').find('div.checked_location').html($('.deal_voucher').text().trim());
                        }
                        $.ajax({
                                url: "{{ route('frontend.business_owner.update_deal_voucher') }}",
                                type: 'GET',
                                cache: false,
                                data: {
                                    'deal_id': deal_id,
                                    'split' :split
                                },
                                success: function(response) {
                                    if(response.status == 1){
                                        console.log(response);
                                        
                                    }
                                }

                            });
                        
                    }
                    
                });

                $(document).on('click','.edit_participating',function(){
                    $("#edit_participating_location_modal").modal('show');
                    var edit_location_id = $(this).data('id');
                    // console.log(edit_location_id);
                    // $("#edit_deal_id").val($(".select_deal").val());
                    // $("#deal_location_id").val($(this).data('id'));
                    $.ajax({
                            url: "{{ route('frontend.business_owner.get_participating_location') }}",
                            type: 'GET',
                            data: {
                                'edit_location_id': edit_location_id,

                            },
                            success: function(response) {
                                console.log(response);
                                if(response.status == 1){
                                    if(response.data.location_manager_count > 0){
                                        if(response.data.location_manager_count == 1){
                                            $("#edit_manager_count").html(response.data.location_manager_count+' manager assigned to this location');
                                        }
                                        else{
                                            $("#edit_manager_count").html(response.data.location_manager_count+' managers assigned to this location');
                                        }
                                    }
                                    else{
                                        $('#edit_location_manager').prop('disabled', 'disabled');
                                        $("#edit_manager_count").html('No managers assigned to this location');
                                    }
                                    if(response.data.location_associate_count > 0){
                                        if(response.data.location_associate_count == 1){
                                            $("#edit_associate_count").html(response.data.location_associate_count+' additional user assigned to this location');
                                        }
                                        else{
                                            $("#edit_associate_count").html(response.data.location_associate_count+' additional users assigned to this location');
                                        }
                                        
                                    }
                                    else{
                                        $('#edit_location_associate').prop('disabled', 'disabled');
                                        $("#edit_associate_count").html('No additional users assigned to this location');
                                    }
                                    $("#edit_location_name").val(response.data.location_name);
                                    $("#edit_location_phone").val(response.data.business_phone);
                                    $("#edit_location_website").val(response.data.business_fax_number);
                                    $("#edit_location_email").val(response.data.business_email);
                                    $("#edit_address").val(response.data.address);
                                    $("#edit_zip_code").val(response.data.zip_code);
                                    $("#edit_city").val(response.data.city);
                                    $("#edit_state").val(response.data.state);
                                    $(".locationname").html('Location: '+response.data.address+', '+response.data.city+', '+response.data.zip_code);
                                    $("#manager_level_list").html('');
                                    $("#associate_level_list").html('');
                                    $("#edit_location_id").val(response.data.id);
                                    
                                    if(response.data.location_manager.length > 0){
                                        const locationManager = response.data.location_manager;
                                        const [firstManager] = locationManager;
                                        console.log(firstManager);
                                        $("#edit_location_manager").val(firstManager.merchant_user.id);
                                      
                                        for(var i = 0; i < response.data.location_manager.length; i++){
                                            if(response.data.location_manager[i].is_main == 0){
                                                var checked = '';
                                            }
                                            else{
                                                var checked = 'checked';
                                            }
                                            // console.log(response.data.location_manager[i]);
                                            var managerdata = '<tr><td></td>'+
                                                              '<td>'+response.data.location_manager[i].merchant_user.full_name+
                                                              '</td>'+
                                                              '<td>'+response.data.location_manager[i].merchant_user.title.title_name+
                                                              '</td>'+
                                                              '<td><a href="javascript:void(0);" class="remove_access" data-id = "'+response.data.location_manager[i].merchant_user.id+'">Remove Access</a>'+
                                                              '</td>'+
                                                              '<td><input type="checkbox" class="assign-one1" '+checked+'></td>'+
                                                              '</tr>';
                                           $("#manager_level_list").append(managerdata);
                                        }
                                    }
                                    if(response.data.location_associate.length > 0){
                                        const locationAssociate = response.data.location_associate;
                                        const [firstAssociate] = locationAssociate;
                                        //console.log(firstAssociate.merchant_user.full_name);
                                        $("#edit_location_associate").val(firstAssociate.merchant_user.id);
                                        
                                        for(var j = 0; j < response.data.location_associate.length; j++){
                                            if(response.data.location_associate[j].is_main == 0){
                                                var checked = '';
                                            }
                                            else{
                                                var checked = 'checked';
                                            }
                                            var associatedata = '<tr><td></td>'+
                                                              '<td>'+response.data.location_associate[j].merchant_user.full_name+
                                                              '</td>'+
                                                              '<td>'+response.data.location_associate[j].merchant_user.title.title_name+
                                                              '</td>'+
                                                              '<td><a href="javascript:void(0);" class="remove_access" data-id = "'+response.data.location_associate[j].merchant_user.id+'">Remove Access</a>'+
                                                              '</td>'+
                                                              '<td><input type="checkbox" class="assign-one1" '+checked+'></td>'+
                                                              '</tr>';
                                           $("#associate_level_list").append(associatedata);
                                        }
                                    }
                                   
                                    
                                    if(response.users.length > 0){
                                        $("#another_user_list").html('');
                                        $("#another_user_list").html('<option value="">--Choose Available User--</option>');
                                        for(var x = 0; x < response.users.length; x++ ){
                                            //console.log(response.users[x]);
                                            var add_user_data  = '<option value="'+response.users[x].id+'">'+response.users[x].full_name+' - '+ response.users[x].title.title_name +'</option>';
                                            $("#another_user_list").append(add_user_data);   
                                        }
                                    }
                                    else{
                                        $("#another_user_list").html('');
                                        var add_user_data = '<option value="">--No User Available--</option>';
                                        $("#another_user_list").append(add_user_data);   
                                    }
                                }
                                else{
                                    $("#successmsg").html('Location Not Found');
                                    $("#success_modal").modal('show');
                                }
                            }
                        });
                })

                $(document).on('click','#edit_manager_count,#edit_associate_count', function(){
                    $("#manager_associate_list").modal('show');
                   
                    var edit_location_id = $("#edit_location_id").val();
                    $.ajax({
                            url: "{{ route('frontend.business_owner.get_participating_location') }}",
                            type: 'GET',
                            data: {
                                'edit_location_id': edit_location_id,

                            },
                            success: function(response) {
                                if(response.status == 1){
                                    $("#manager_level_list").html('');
                                    if(response.data.location_manager.length > 0){
                                        for(var i = 0; i < response.data.location_manager.length; i++){
                                            if(response.data.location_manager[i].is_main == 0){
                                                var checked = '';
                                            }
                                            else{
                                                var checked = 'checked';
                                            }
                                            // console.log(response.data.location_manager[i]);
                                            var managerdata = '<tr><td></td>'+
                                                              '<td>'+response.data.location_manager[i].merchant_user.full_name+
                                                              '</td>'+
                                                              '<td>'+response.data.location_manager[i].merchant_user.title.title_name+
                                                              '</td>'+
                                                              '<td><a href="javascript:void(0);" class="remove_access" data-id = "'+response.data.location_manager[i].merchant_user.id+'">Remove Access</a>'+
                                                              '</td>'+
                                                              '<td><input type="checkbox" class="assign-one1" '+checked+'></td>'+
                                                              '</tr>';
                                           $("#manager_level_list").append(managerdata);
                                        }
                                    }
                                    $("#associate_level_list").html('');
                                    if(response.data.location_associate.length > 0){
                                        for(var j = 0; j < response.data.location_associate.length; j++){
                                            if(response.data.location_associate[j].is_main == 0){
                                                var checked = '';
                                            }
                                            else{
                                                var checked = 'checked';
                                            }
                                            var associatedata = '<tr><td></td>'+
                                                              '<td>'+response.data.location_associate[j].merchant_user.full_name+
                                                              '</td>'+
                                                              '<td>'+response.data.location_associate[j].merchant_user.title.title_name+
                                                              '</td>'+
                                                              '<td><a href="javascript:void(0);" class="remove_access" data-id = "'+response.data.location_associate[j].merchant_user.id+'">Remove Access</a>'+
                                                              '</td>'+
                                                              '<td><input type="checkbox" class="assign-one1" '+checked+'></td>'+
                                                              '</tr>';
                                           $("#associate_level_list").append(associatedata);
                                        }
                                    }
                                    if(response.users.length > 0){
                                        $("#another_user_list").html('');
                                        $("#another_user_list").html('<option value="">--Choose Available User--</option>');
                                        for(var x = 0; x < response.users.length; x++ ){
                                            //console.log(response.users[x]);
                                            var add_user_data  = '<option value="'+response.users[x].id+'">'+response.users[x].full_name+' - '+ response.users[x].title.title_name +'</option>';
                                            $("#another_user_list").append(add_user_data);   
                                        }
                                    }
                                    else{
                                        $("#another_user_list").html('');
                                        var add_user_data = '<option value="">--No User Available--</option>';
                                        $("#another_user_list").append(add_user_data);   
                                    }
                                }
                            }

                        });

                })

                $(document).on('click','#addanotheruser',function(){
                    $("#managererror").html(' ');
                    if($("#another_user_list").val() != ''){
                     var locationid = $("#edit_location_id").val();
                     var userid = $("#another_user_list").val();
                    //    console.log(userid);
                        $.ajax({
                                url: "{{ route('frontend.business_owner.add_location_user') }}",
                                type: 'get',
                                cache: false,
                                data: {
                                    'location_id': locationid,
                                    'userid' : userid,
                                },
                                success: function(response) {
                                    console.log(response);
                                    if(response.status == 1){
                                        $("#edit_manager_count").html('');
                                        $("#edit_associate_count").html('');
                                        if(response.data.location_manager_count > 0){
                                            const dealManager = response.data.location_manager;
                                            const [firstManager] = dealManager;
                                            $("#edit_location_manager").val(firstManager.merchant_user.id);
                                            if(response.data.location_manager_count == 1){
                                                $("#edit_manager_count").html(response.data.location_manager_count+' manager assigned to this location');
                                            }
                                            else{
                                                $("#edit_manager_count").html(response.data.location_manager_count+' managers assigned to this location');
                                            }
                                        }
                                        if(response.data.location_associate_count > 0){
                                            if(response.data.location_associate_count == 1){
                                                $("#edit_associate_count").html(response.data.location_associate_count+' additional user assigned to this location');
                                            }
                                            else{
                                                $("#edit_associate_count").html(response.data.location_associate_count+' additional users assigned to this location');
                                            }
                                            const dealAssociate = response.data.location_associate;
                                            const [firstAssociate] = dealAssociate;
                                            $("#edit_location_associate").val(firstAssociate.merchant_user.id);
                                        }
                                        $("#manager_associate_list").modal('hide');
                                        toastr.success(
                                            'User added to this location successfully'
                                            );
                                    }
                                }
                            });
                        }
                        else{
                            $("#managererror").html('Select a user first').css('color','red');
                        }
                });

                $(document).on('click','.remove_access',function(){
                    var location_id = $("#edit_location_id").val();
                    var userid = $(this).data('id');
                   // console.log(location_id);
                    $.ajax({
                            url: "{{ route('frontend.business_owner.remove_location_access') }}",
                            type: 'GET',
                            data: {
                                'location_id': location_id,
                                'userid' : userid

                            },
                            success: function(response) {
                                //console.log(response);
                                if(response.status == 1){
                                    $("#successmsg").html('Access removed successfully');
                                    $("#success_modal").modal('show');
                                }
                                else{
                                    $("#successmsg").html('Access not found');
                                    $("#success_modal").modal('show');
                                }
                            }
                        });
                })
                
                $(document).on('click','.locationAssigned',function(){
                    var locationid = $(this).data('id');
                    var dealid = $(".select_deal").val();
                    var myVar = $(this);
                    if($(this).is(':checked')){
                        var checked = 'yes';
                    }
                    else{
                        var checked = 'no';
                    }

                    $.ajax({
                            url: "{{ route('frontend.business_owner.update_location_access_for_deal') }}",
                            type: 'GET',
                            data: {
                                'location_id': locationid,
                                'deal_id' : dealid,
                                'checked' : checked

                            },
                            success: function(response) {
                                
                                if(response.status == 1){
                                    if(response.all_location == 1){
                                        $(".all_deal_location_assigned").prop('checked','checked');
                                    }
                                    else{
                                        $(".all_deal_location_assigned").prop('checked',false);
                                        if(checked == 'yes'){
                                            $(this).attr('checked',true);
                                            myVar.parent().parent().next('.dealvoucher').find("div.assignedVoucher").addClass('checked_location');
                                            if($('.split_voucher').is(':checked')){
                                                if($('.deal_voucher').text().trim() != 'Unlimited'){
                                                    var voucher = $('.deal_voucher').text().trim();
                                                    var checkedLocation = $('.checked_location').length;
                                                    var splited_voucher = parseInt(voucher/checkedLocation);
                                                    //console.log(splited_voucher);
                                                    $('.checked_location').text('');
                                                    $('.checked_location').text(splited_voucher);
                                                }
                                                else{
                                                    $('.checked_location').text('');
                                                    $('.checked_location').text(splited_voucher);
                                                }
                                            }
                                            else{
                                                var voucher = $('.deal_voucher').text().trim();
                                                $('.checked_location').text('');
                                                $('.checked_location').text(voucher);
                                            }
                                            
                                        }
                                        else{
                                            $(this).attr('checked',false);
                                            myVar.parent().parent().next('.dealvoucher').find("div.assignedVoucher").removeClass('checked_location');
                                            myVar.parent().parent().next('.dealvoucher').find("div.assignedVoucher").text('');
                                            if($('.split_voucher').is(':checked')){
                                                if($('.deal_voucher').text().trim() != 'Unlimited'){
                                                    var voucher = $('.deal_voucher').text().trim();
                                                    var checkedLocation = $('.checked_location').length;
                                                    var splited_voucher = parseInt(voucher/checkedLocation);
                                                    console.log(splited_voucher);
                                                    $('.checked_location').text('');
                                                    $('.checked_location').text(splited_voucher);
                                                }
                                                else{
                                                    $('.checked_location').text('');
                                                    $('.checked_location').text(splited_voucher);
                                                }
                                            }
                                            else{
                                                var voucher = $('.deal_voucher').text().trim();
                                                $('.checked_location').text('');
                                                $('.checked_location').text(voucher);
                                            } 
                                        }
                                    }
                                }
                                else if(response.status == 3){
                                    myVar.prop('checked','checked');
                                    toastr.error('Can not remove access from all location');
                                    $(".all_deal_location_assigned").prop('checked',false);
                                }
                                else{
                                    $(".all_deal_location_assigned").prop('checked',false);
                                }
                                //$(this).attr('checked',true);

                            }
                        
                    });

                });

                $(document).on('click','.rewardlocationAssigned',function(){
                    var locationid = $(this).data('id');
                    var rewardid = $(".select_program").val();
                    var myVar = $(this);
                    if($(this).is(':checked')){
                        var checked = 'yes';
                    }
                    else{
                        var checked = 'no';
                    }

                    $.ajax({
                            url: "{{ route('frontend.business_owner.update_location_access_for_reward') }}",
                            type: 'GET',
                            data: {
                                'location_id': locationid,
                                'reward_id' : rewardid,
                                'checked' : checked

                            },
                            success: function(response) {
                                console.log(response);
                                if(response.status == 1){
                              
                                    if(response.all_location == 1){
                                        $(".all_reward_location_assigned").prop('checked','checked');
                                    }
                                    else{
                                        $(".all_reward_location_assigned").prop('checked',false);
                                    }
                                        
                                }
                                else if(response.status == 3){
                                    myVar.prop('checked','checked');
                                    toastr.error('Can not remove access from all location');
                                    $(".all_reward_location_assigned").prop('checked',false);
                                }
                                //$(this).attr('checked',true);

                            }
                    });
                })

                $(".preview_deal_participating").on('click', function() {
                    var deal_Id = $(".select_deal").val();
                    console.log(deal_Id);
                    $.ajax({
                        url: '{{ route('frontend.business_owner.preview.deal') }}',
                        type: 'GET',
                        data: {
                            'deal_Id': deal_Id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                $("#previewModal").modal('show');
                                $(".point").text(response.data.point);
                                $(".description").text(response.data.suggested_description);
                                $("#imgDisplay").attr('src',response.data.deal_image);
                               // console.log();
                                if (response.data.end_Date != null) {
                                    $(".expire_date").text(response.data.end_Date);
                                } else {
                                    $(".expire_date").html('Open');
                                }

                            }

                        }
                    });
                });

                $(document).on('change', '#main_location', function(){
                 var location_id = $(this).val();
                   //  console.log(location_id);
                    $.ajax({
                            url: '{{ route('frontend.business_owner.user_management_merchant_business_location') }}',
                            type: 'GET',
                            data: {
                                'location_id': location_id
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    $('#change_address').html('');
                                    $('#change_email').html('');
                                    $('#change_phone').html('');
                                    var address = response.data.address+','+response.data.city+','+response.data.states.name+','+response.data.zip_code;
                                    $('#change_address').append(address);
                                    var email = response.data.business_email;
                                    $('#change_email').html(email);
                                    var phone = response.data.business_phone;
                                    $('#change_phone').html(phone);
                                }

                            }
                    });
                
                });

                $(document).on('click','.go_to_deal_management',function(){
                    $('#participatingLocation').modal('hide');
                    $('#dealManagement').modal('show');
                });

                $(document).on('click','.go_to_manage_program',function(){
                    $('#participatingLocation').modal('hide');
                    var url = "{{ route('frontend.business_owner.loyal_reward_program') }}";
                    sessionStorage.setItem("openTab", "manage_program");
                    window.location = url;
                });

                $(document).on('click','.all_deal_location_assigned',function(){
                    var dealid = $(this).data('id');
                    $(this).prop('checked',true);
                    if($(this).is(':checked')){
                        var checked = 'yes';
                    }
                    else{
                        var checked = 'no';
                    }
                    var myVar = $(this);
                    $.ajax({
                        url: "{{ route('frontend.business_owner.update_all_location_access_for_deal') }}",
                        type: 'GET',
                        data: {
                            'deal_id' : dealid,
                            'checked' : checked

                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 0) {
                                toastr.error('Can not remove access from all location');
                            }
                            else{
                                toastr.success('Assign all location for this deal');
                                $("#deallocation").find('tr').each(function() {
                                    if($(this).children("td").next("td").find('input.locationAssigned').not(':checked')){
                                        $(this).children("td").next("td").find('input.locationAssigned').prop('checked',true);
                                        $(this).children("td").next("td").next("td.dealvoucher").find("div.assignedVoucher").addClass('checked_location');
                                        if($('.split_voucher').is(':checked')){
                                            if($('.deal_voucher').text().trim() != 'Unlimited'){
                                                var voucher = $('.deal_voucher').text().trim();
                                                var checkedLocation = $('.checked_location').length;
                                                var splited_voucher = parseInt(voucher/checkedLocation);
                                                //console.log(splited_voucher);
                                                $('.checked_location').text('');
                                                $('.checked_location').text(splited_voucher);
                                            }
                                            else{
                                                $('.checked_location').text('');
                                                $('.checked_location').text(splited_voucher);
                                            }
                                        }
                                        else{
                                            var voucher = $('.deal_voucher').text().trim();
                                            $('.checked_location').text('');
                                            $('.checked_location').text(voucher);
                                        }
                                    }
                                    
                                });

                            }
                        }
                    });
                });

                $(document).on('click','.all_reward_location_assigned',function(){
                    var rewardid = $(this).data('id');
                    $(this).prop('checked',true);
                    if($(this).is(':checked')){
                        var checked = 'yes';
                    }
                    else{
                        var checked = 'no';
                    }
                    var myVar = $(this);
                    $.ajax({
                        url: "{{ route('frontend.business_owner.update_all_location_access_for_reward') }}",
                        type: 'GET',
                        data: {
                            'reward_id' : rewardid,
                            'checked' : checked

                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 0) {
                                toastr.error('Someting went wrong');
                            }
                            else{
                                toastr.success('Assign all location for this deal');
                                $("#loyaltylocation").find('tr').each(function() {
                                    if($(this).children("td").next("td").find('input.rewardlocationAssigned').not(':checked')){
                                        $(this).children("td").next("td").find('input.rewardlocationAssigned').prop('checked',true);
                                    }
                                    
                                });

                            }
                        }
                    });
                })

                $(document).on('click', '.view_location', function() {
                    deal_id = $(this).data('id');
                    $.ajax({
                            url: '{{ route("frontend.business_owner.deal.location") }}',
                            type: 'GET',
                            data: {
                                'deal_id': deal_id,

                            },
                            success: function(response) {
                                // $("#location_modal").modal('show');
                                if (response.success == 1) {
                                    $("#location_modal").modal('show');
                                    $("#get_dealLocation").html("");
                                    if(response.data.length > 0){
                                        // if(response.deal.is_split == 1){
                                        //     if(response.deal.voucher_unlimited == 1){
                                        //         var usedvoucher = '<td>Unlimited</td>';
                                        //     }
                                        //     else{
                                        //         var divide = parseInt(response.deal.voucher_number / response.data.length);
                                        //         var usedvoucher = '<td>'+divide+'</td>';
                                        //     }
                                        // }
                                        for(var x = 0; x < response.data.length; x++ ){
                                            
                                            $('#deal_name').html(response.data[x].deal.suggested_description);
                                        var get_location  = '<tr>'+
                                                            '<td>'+response.data[x].location.location_name+
                                                            '</td>'+
                                                            '<td> <button class="extend-program-btn-sec extend_program" style="margin-bottom: 10px; background-color: #d70303; border-color: #d70303;">Scheduled to end</button></td>'+
                                                            '<td>00</td>'+
                                                            '<td>00</td>'+
                                                            '</tr>';
                                                $("#get_dealLocation").append(get_location);   
                                        }
                                    }

                                    if (response.other_location.length > 0) {
                                        $('#business_location').html(
                                            '<option value = "">Choose Location </option>');
                                        for (var i = 0; i < response.other_location.length; i++) {
                                            var locations = '<option value="' + response.other_location[i].id + '">' + response.other_location[i].location_name + '</option>';
                                            $("#business_location").append(locations);
                                        }
                                    } else {
                                        $('#business_location').html(
                                            '<option value = "">No Location is there</option>');
                                    }
                                    
                                    // console.log(response.data[0].deal);
                                    // $("#deal_name").html(response.data.discount_type);
                            }
                        }
                        });
                
                });

                $(document).on('click','.end_deal',function(){
                    $("#clickEndDateModal").modal('show');
                    $("#end_date_deal_id").val($(this).data('id'))
                });

                $(document).on('click','.deal_schedule_end_date',function(){
                    var today = new Date();
                    today.setDate(today.getDate() + parseInt(8));
                    var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();
                    $("#schedule_end_date").datepicker("option",{"minDate" : new Date(setdate)});
                    $("#schedule_end_date").datepicker("setDate" , new Date(setdate));  
                    //$("#clickEndDateModal").modal('hide'); 
                    $("#scheduleEndDateSetModal").modal('show');    
                    $("#select_deal_id").val($("#end_date_deal_id").val());                     
                });

                $(document).on('click','#setDealEndDate',function(){
                    var dealid = $('#select_deal_id').val();
                    var schedule_end_date = $('#schedule_end_date').val();
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.set_deal_end_Date") }}',
                        type: 'POST',
                        data: {
                            'dealid': dealid,
                            'schedule_end_date': schedule_end_date,
                            'extend_type': 'schedule'
                        },
                        success: function(response) {
                            if(response.status == 0){
                                $("#scheduleenddaterror").html(response.validation_errors).css('color','red');
                            }
                            else if(response.status == 1){
                                sessionStorage.setItem("openModal", "deal_management");
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Deal end date set successfully');
                            }
                        }
                    });
                });

                $(document).on('click','.yes_set_deal_end_date',function(){
                    $("#yesEndDateSetModal").modal('show');
                    $("#enddeal_id").val($("#end_date_deal_id").val());
                    var today = new Date();
                    today.setDate(today.getDate() + parseInt(14));
                    var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear(); 
                    $("#setenddate").html(setdate);   
                    $("#extend_date").val(setdate);                          
                });

                $(document).on('click','#yesDealEndDate',function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.set_deal_end_Date") }}',
                        type: 'POST',
                        data: {
                            'dealid': $("#enddeal_id").val(),
                            'schedule_end_date': $("#extend_date").val(),
                            'extend_type': 'enddate'
                        },
                        success: function(response) {
                            if(response.status == 0){
                                toastr.error(response.message);
                            }
                            else if(response.status == 1){
                                sessionStorage.setItem("openModal", "deal_management");
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Deal end date set successfully');
                            }
                        }
                    });
                });

                $(document).on('click','.extend_deal',function(){
                    $("#extendEndDateSetModal").modal('show');
                    var dealid = $(this).data('id');
                    $("#extend_deal_id").val(dealid);
                    var enddate = $(this).parent().prev('td#endOn'+dealid).text();
                    var end_date = new Date(enddate);
                    end_date.setDate(end_date.getDate() + parseInt(1));
                    var setdate = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                   // $("#extend_end_date").val(setdate);
                    $("#extend_end_date").datepicker("option",{"minDate" : new Date(setdate)});
                    $("#extend_end_date").datepicker("setDate" , new Date(setdate));  
                });

                $(document).on('click','#extendDealEndDate',function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.set_deal_end_Date") }}',
                        type: 'POST',
                        data: {
                            'dealid': $("#extend_deal_id").val(),
                            'schedule_end_date': $("#extend_end_date").val(),
                            'extend_type': 'extend'
                        },
                        success: function(response) {
                            if(response.status == 0){
                                $("#scheduleenddaterror").html(response.validation_errors).css('color','red');
                            }
                            else if(response.status == 1){
                                sessionStorage.setItem("openModal", "deal_management");
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Deal end date extend successfully');
                            }
                        }
                    });
                });

                $(document).on('click','.schedule_to_end',function(){
                    $("#extendEndDateSetModal").modal('show');
                    var dealid = $(this).data('id');
                    $("#extend_deal_id").val(dealid);
                    var enddate = $(this).parent().prev('td#endOn'+dealid).text();
                    var end_date = new Date(enddate);
                    end_date.setDate(end_date.getDate());
                    var setdate = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                   // $("#extend_end_date").val(setdate);
                    $("#extend_end_date").datepicker("option",{"minDate" : new Date(setdate)});
                    $("#extend_end_date").datepicker("setDate" , new Date(setdate));  
                })
                
            });
            $(document).on('click','.close_success_modal',function(){
                $("#location_success_modal").modal('hide');
                $("#edit_participating_location_modal").modal('hide');
                $("#add_participating_location_modal").modal('hide');
                $('.select_deal').val($('.select_deal :selected').val()).change();
                $('.select_program').val($('.select_program :selected').val()).change();

                    
            })
            
            // EVENT LOGIC
            $(document).ready(function() {
                let maxDateLimit = new Date();
                maxDateLimit.setMonth(maxDateLimit.getMonth() + 8);

                $(".start_event_datepicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    maxDate: maxDateLimit,
                    onSelect: function (selectedDate) {
                        let startDate = $(this).datepicker("getDate");
                        $(".end_event_datepicker").datepicker("option", "minDate", startDate); 
                    }
                });

                $(".end_event_datepicker").datepicker({
                    dateFormat: "mm/dd/yy",
                    changeMonth: true,
                    changeYear: true,
                    minDate: 0,
                    maxDate: maxDateLimit,
                    onSelect: function (selectedDate) {
                        let endDate = $(this).datepicker("getDate");
                        $(".start_event_datepicker").datepicker("option", "maxDate", endDate);
                    }
                });

                $("#eventForm").submit(function (e) {
                    e.preventDefault(); 

                    let formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('frontend.business_owner.save_event') }}",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") 
                        },
                        success: function (response) {
                            if (response.success) {
                                alert("Event submitted successfully!");
                                $("#eventForm")[0].reset(); 
                            } else {
                                alert("Error: " + response.message);
                            }
                        },
                        error: function (xhr) {
                            alert("An error occurred!");
                            console.log(xhr.responseText);
                        }
                    });
                });

            });

            function disableAutocomplete(el) {
                el.setAttribute("readonly", true);
                setTimeout(() => {
                    el.removeAttribute("readonly");
                }, 100); 
            }

            $("#event_address").on('keyup', function(){
                var input = document.getElementById('event_address');
                   var autocomplete = new google.maps.places.Autocomplete(input);
                   autocomplete.setComponentRestrictions({'country': ['us']});
                   google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                       var place = autocomplete.getPlace();
                       console.log(place,'-----');
                       $('#event_latitude').val(place.geometry['location'].lat());
                       $('#event_longitude').val(place.geometry['location'].lng());

            
                       for(var i = 0; i < place.address_components.length; i++){
                        //    console.log(place.address_components[i]);
                    //    console.log(place.address_components[i]);

                           for (var j = 0; j < place.address_components[i].types.length; j++) {
                               if (place.address_components[i].types[j] == "postal_code") {

                                   $("#event_zip").val(place.address_components[i].long_name);
                               }
                              
                               if (place.address_components[i].types[j] == "locality") {
                                   $("#event_city").val(place.address_components[i].long_name);
                               }
                               if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                   $("#event_state").val(place.address_components[i].long_name);
                               }
                           }
                       }
                   });
            });

    </script>
    @endpush
</x-layouts.frontend-layout>