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
                                        @dd(Auth::user()->merchantBusiness->logo_image)
                                        @if(Auth::user()->merchantBusiness->logo_image != '')
                                            <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                                style="width: 102px;height: 87px;border-radius: 4px;" />
                                        @else
                                            <img src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                        @endif
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
                                                            {{$locations->businessLocation->states->name}},
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
                                <figure><img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}"
                                        alt=""></figure>
                                <h3>Account Status</h3>
                                @if (Auth::user()->merchantBusiness->status == 1)
                                <p style="color: green;"><i style="background: green;"></i>Active</p>
                                @elseif(Auth::user()->merchantBusiness->status == 0)
                                <p style="color: red;"><i style="background: red;"></i>Inactive</p>
                                @else
                                <p style="color: red;"><i style="background: red;"></i>Pending</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <p class="to-add-aditional-loyality-txt">To add additional features such as Loyalty Reward Programs,
                        upgrade to Merchant Plus <a href="">Here</a></p>
                </div>

                <div id="section3">

                    <div class="smart-contain-main">
                        <div class="container1">
                            <div class="smart-rental-button">

                                @if (Auth::user()->user_title == 'Associate')
                                <ul class="p-0 border-0">
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
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#Add-Item-Service">
                                            <img height="44" src="{{ asset('frontend_assets/images/file-save1.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and service Database</a>
                                    </li>


                                </ul>
                                @elseif(Auth::user()->user_title == 'Manager')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#dealManagement">
                                            <img src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                            Deal Management</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.createDeal.step1') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                            <span>Create Deal <br>
                                                <b>Using Deal wizard</b></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                            Add/Manage Participating Location</a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#Add-Item-Service">
                                            <img height="44" src="{{ asset('frontend_assets/images/file-save1.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and service Database</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Settings</a>
                                    </li>

                                </ul>
                                @elseif(Auth::user()->user_title == 'Corporate Lead')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#dealManagement">
                                            <img src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                            Deal Management</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.createDeal.step1') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                            <span>Create Deal <br>
                                                <b>Using Deal wizard</b></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                            Add/Manage Participating Location</a>
                                    </li>
                                    <li>
                                        <a href="#" id="item_service">
                                            <img height="44" src="{{ asset('frontend_assets/images/file-save1.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and service Database</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            My Profile Settings</a>
                                    </li>

                                </ul>
                                @elseif(Auth::user()->user_title == 'Corporate System Admin')
                                <ul class="p-0 border-0">
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#dealManagement">
                                            <img src="{{ asset('frontend_assets/images/icon91.svg') }}"
                                                class="cat-left-icon" />
                                            Deal Management</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.createDeal.step1') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                                class="cat-left-icon" />
                                            <span>Create Deal <br>
                                                <b>Using Deal wizard</b></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.loyal_reward_program') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon93.svg') }}"
                                                class="cat-left-icon" />
                                            Loyalty Rewards Programs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.user-management') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon94.svg') }}"
                                                class="cat-left-icon" />
                                            User Management</a>
                                    </li>
                                    <li>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#participatingLocation"> <img
                                                src="{{ asset('frontend_assets/images/icon95.svg') }}"
                                                class="cat-left-icon" />
                                            Add/Manage Participating Location</a>
                                    </li>
                                    <li>
                                        <a href="#" id="item_service">
                                            <img height="44" src="{{ asset('frontend_assets/images/file-save1.svg') }}"
                                                class="cat-left-icon img-one407" />
                                            Item and service Database</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('frontend.business_owner.corporate_settings') }}"> <img
                                                src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            Account Settings</a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="{{ asset('frontend_assets/images/icon14.svg') }}"
                                                class="cat-left-icon" />
                                            My Profile Settings</a>
                                    </li>

                                </ul>
                                @elseif(Auth::user()->user_title == 'Lead Manager')
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
            <div class="modal-content">

                <div class="modal-body">
                    <div class="modal-deal-management-top">
                        <h2>Deal Management</h2>
                        <button data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-deal-management-middle">
                        @if(count($dealManage) > 0)
                            @foreach ($dealManage as $data)
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="uplard-img">
                                                    @dd($data->deal_image)
                                                    @if ($data->deal_image != '')
                                                    <img src="{{$data->deal_image}}" style="border-radius: 10px;height: 100%;"
                                                        alt="img" />

                                                    @endif
                                                    {{-- <img src="{{Auth::user()->merchantBusiness->logo_image}}"
                                                        class="cat-left-icon" /> --}}
                                                    {{-- <h5> {{ $data->getUrl('deal_image') }}</h5> --}}
                                                </div>
                                                <div class="uplaoard-button-one-bottom preview-deal-one ">
                                                    <button class="preview_deal" type="button" data-id="{{ $data->id }}">Preview
                                                        deal</button>
                                                </div>

                                                {{-- @dd($data->id) --}}
                                            </div>

                                            <div class="col-lg-7 description-text1">
                                                <div class="description-text1">Description</div>
                                                <textarea class="modify_description{{ $data->id }}"
                                                    name="description">{{ $data->suggested_description }}</textarea>
                                                <button id="update-btn" class="update-description-text update_btn"
                                                    data-id="{{ $data->id }}">UPDATE DESCRIPTION</button>

                                                <div class="status-text-one">
                                                    <span class="status-text1">Status</span>
                                                    @if($data->status == 1)
                                                    <span class="span-text1" style="color:green;">Active</span>
                                                    @else
                                                    <span class="span-text1" style="color:red;">Inactive</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="top-one1">
                                            <table class="w-100 deal-management-text1">
                                                <tr>
                                                    <td>
                                                        <label class="description-text1">Original Sales Price</label>
                                                        <input class="text-area18 dealPrice{{ $data->id }}" placeholder=""
                                                            type="text" value="{{ $data->sales_amount }}" />
                                                        <button class="modyfi-text-one modify_price"
                                                            data-id="{{ $data->id }}">Modify
                                                            Price</button>

                                                    </td>
                                                    <td>
                                                        <label class="description-text1">Discount Type</label>
                                                        <select name="" id="" class="select-box1 select_type{{ $data->id }}">

                                                            <option class="" value="Free" <?php if ($data->discount_type ==
                                                                'Free') {
                                                                echo 'selected';
                                                                } ?>>Free
                                                            </option>
                                                            <option class="" value="Discount" <?php if ($data->discount_type ==
                                                                'Discount') {
                                                                echo 'selected';
                                                                } ?>>
                                                                Discount</option>
                                                            <option class="" value="Percentage" <?php if ($data->discount_type
                                                                == 'Percentage') {
                                                                echo 'selected';
                                                                } ?>>
                                                                Percentage</option>
                                                        </select>
                                                       
                                                        <button class="modyfi-text-one modify_discount_type"
                                                            data-id="{{ $data->id }}">Modify
                                                            Discount Type</button>

                                                    </td>
                                                    <td>
                                                        <label class="description-text1">Discount Amount</label>
                                                        <input class="text-area18 dealDiscountAmount{{ $data->id }}"
                                                            placeholder="" type="text" value="{{ $data->discount_amount }}" />
                                                        <button href="#" class="modyfi-text-one modify_discount_amount"
                                                            data-id="{{ $data->id }}">Change
                                                            Amount</button>

                                                    </td>
                                                    <td>
                                                        <label class="description-text1">Point Calc.</label>
                                                        <input class="text-area18 dealPoint{{ $data->id }}" placeholder=""
                                                            type="text" value="{{ $data->point }}" readonly />
                                                    

                                                    </td>
                                                    <td>
                                                        <label class="description-text1">Total Vouchers </label>
                                                        @if($data->voucher_number != '')
                                                        <input class="text-area18 dealVoucher{{ $data->id }}" placeholder=""
                                                            type="text" value="{{ $data->voucher_number }}" />
                                                        <button href="#" class="modyfi-text-one modify_voucher"
                                                            data-id="{{ $data->id }}">Modify
                                                            Total Vouchers</button>
                                                        @else
                                                        <input class="text-area18 dealVoucher{{ $data->id }}" placeholder=""
                                                            type="text" value="Unlimited" readonly />
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="vouchers-used">
                                                            <span class="number">0</span>
                                                            <span>Vouchers <br />used</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="b-one5">
                                            <div class="top-one1">
                                                <table class="w-100 deal-management-text1">
                                                    <tr>
                                                        <td class="btext11 top-pace-one1">
                                                            <div class="btext11">&nbsp;</div>
                                                            Active date
                                                        </td>
                                                        <td class="top-pace-one1">
                                                            <div class="btext11">&nbsp;</div>
                                                            @php $startdate =
                                                            date_format(date_create($data->start_Date),'d-m-y'); @endphp
                                                            {{-- @php $enddate =
                                                            date_format(date_create($data->end_Date),'d-m-y'); @endphp --}}

                                                            <input class="text-area18 dealDate{{ $data->id }}"
                                                                value="{{ $startdate }}" type="text"
                                                                onfocus="(this.type='date')" id="date">

                                                            {{-- <input class="text-area18 dealDate" data-id="{{ $data->id }}"
                                                                placeholder="" type="date" value="{{ $startdate }}" /> --}}

                                                        </td>
                                                        <td class="btext11 top-pace-one1">to</td>
                                                        <td class="top-pace-one1">
                                                            <div class="btext11">&nbsp;</div>
                                                            @if ($data->end_Date != '')
                                                            @php $enddate = date_format(date_create($data->end_Date),'d-m-y');
                                                            @endphp
                                                            <input class="text-area18 dealEndDate{{ $data->id }}"
                                                                value="{{ $enddate }}" type="text" onfocus="(this.type='date')"
                                                                id="date">
                                                            <span class="error_msg{{ $data->id }}"></span>
                                                            @else
                                                            <input class="text-area18 dealEndDate{{ $data->id }}" value=""
                                                                type="text" onfocus="(this.type='date')" id="date" />
                                                            <span class="error_msg{{ $data->id }}"></span>
                                                            @endif
                                                            <div>
                                                                <button class="change-dates1 modify_date"
                                                                    data-id="{{ $data->id }}">Changes Dates</button>

                                                            </div>

                                                            {{-- @php $enddate =
                                                            date_format(date_create($data->end_Date),'d-m-y'); @endphp
                                                            <input class="text-area18" placeholder="" type="text"
                                                                value="{{ $enddate }}" disabled="true" />
                                                            <div>
                                                                <button class="change-dates1">Changes Dates</button>
                                                            </div> --}}
                                                        </td>

                                                        @if((Auth::user()->merchantBusiness->business_type != 'Mobile Business')
                                                        || (Auth::user()->merchantBusiness->business_type != 'Online Only'))
                                                        <td class="top-pace-one1">
                                                            <div class="btext11">Participating Locations</div>
                                                            <div class="ocean-drive1">
                                                                @if($data->dealLocation)
                                                                <?php $locCount = '';?>
                                                                <?php $locCount = count($data->dealLocation); ?>

                                                                {{-- <input type="checkbox" /> --}}
                                                                @if ($locCount > 1)
                                                                Deal is connected to multiple locations({{$locCount}})

                                                                @else

                                                                @php $participating_location =
                                                                $data->dealLocation->first()->location->first();
                                                                @endphp
                                                                {{ $participating_location->address }}, {{
                                                                $participating_location->city }},
                                                                {{ $participating_location->zip_code }}
                                                                @endif
                                                                @else
                                                                @endif
                                                            </div>
                                                            <div class="text-end">
                                                                @if (($data->physical_location == $locCount))
                                                                <button type="button" data-id="{{ $data->id }}"
                                                                    class="change-dates1 another_location_modal">View/Manage
                                                                    Location</button>
                                                                @else
                                                                <button type="button" data-id="{{ $data->id }}"
                                                                    class="change-dates1 another_location_modal">Add another
                                                                    Location</button>

                                                                @endif
                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                          <div>No record</div>
                        @endif
                        <div id="success_message" class="ajax_response" style="float:left"></div>

                    </div>

                </div>

            </div>
        </div>
    </div>



    {{-- Edit Item service modal --}}
    <div class="modal fade" id="Edit-Item-Service" tabindex="-1" aria-labelledby="Edit-Item-ServiceLable"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal white-modal-scroll text-left">
                    <form name="itemEditForm" id="itemEditForm" method="post" action="javascript:void(0)">
                        <div class="d-flex justify-content-between">
                            <h1>Item And Service Database</h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <input type="hidden" name="item_id" id="hidden_id">
                        <div class="Gimmzi-Gift-Manager ">
                            <h2>Enter the name of Item or Service Below</h2>
                            <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                name="item_name_edit" id="item_name_edit" />
                        </div>
                        <span id="nameerror" style="color: red;"></span>
                        <div class="row value-of-this-gift">
                            <div class="col-sm-6">
                                <h3>Enter the Value of this Item</h3>
                                <h4>the amount the customer would normally pay</h4>
                                <div class="customer-input">
                                    <label>$</label>
                                    <input type="text" name="value_edit" id="value_edit" class="value-input-text"
                                        style=" width: 62px;" />
                                    {{-- <label>.</label>
                                    <input type="text" name="value_two_edit" id="value_edit" class="value-input-text" />
                                    --}}
                                </div>
                                <span id="amounterror" style="color: red;"></span>
                            </div>
                            <div class="col-sm-6">
                                <h3>Notes (Optional)</h3>
                                <textarea class="note-text" name="note" id="note_edit"></textarea>
                            </div>
                            <div id="success_message_edit" class="ajax_response" style="float:left"></div>
                        </div>
                        <div class="gift-database-main">
                            <div class="d-flex justify-content-between">
                                <button type="submit" id="update_item">Add To Database</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Add participating location modal --}}
    <div class="new_modal_participate modal fade" id="participatingLocation" tabindex="-1"
        aria-labelledby="participatingLocationLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-deal-management-top">
                        <h2>Participating Locations</h2>
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
                                                    <input type="checkbox" class="assign-one1" />
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
                                            <?php $locations = Auth::user()->merchantBusiness->locations;?>

                                            @if(count($locations) > 0)
                                            @foreach($locations as $businesslocation)
                                            <tr>
                                                <td>
                                                    {{$businesslocation->address }}, {{$businesslocation->city}},
                                                    {{$businesslocation->states->name }},
                                                    {{$businesslocation->zip_code}}
                                                    <div class="" id="preview-deal-text">
                                                        <a href="javascript:void(0)" data-id="{{$businesslocation->id}}"
                                                            class="p-deal-one edit_participating">Edit</a>
                                                    </div>
                                                </td>
                                                <?php 
                                                            $location = '';
                                                            $checked = '';
                                                            if($dealManage[0]) {
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

                                        </tbody>
                                    </table>
                                    <table id="loyalty_programs" style="display:none;">
                                        <tr>
                                            <th>
                                                <select class="two-hours-text select_deal">
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
                                            <th class="new-select1">
                                                Assign to all locations
                                                <div class="text-center assign-one4">
                                                    <input type="checkbox" class="assign-one1" />
                                                </div>
                                            </th>
                                            <th>
                                                Total Members
                                                <div class="text-center assign-one4 deal_voucher">
                                                    @if(count($loyaltyManage) > 0)
                                                    @if(count($loyaltyManage[0]->consumerLoyalty) > 0)
                                                    {{count($loyaltyManage[0]->consumerLoyalty)}}
                                                    @else
                                                    {{0}}
                                                    @endif
                                                    @endif
                                                </div>
                                            </th>
                                            <th>Completion %
                                                <div class="text-center assign-one4">
                                                    0%
                                                </div>
                                            </th>
                                        </tr>
                                        <tbody id="deallocation">
                                            <?php $locations = Auth::user()->merchantBusiness->locations;?>
                                            
                                            @if(count($locations) > 0)
                                            @foreach($locations as $businesslocation)
                                            <tr>
                                                <td>
                                                    {{$businesslocation->address }}, {{$businesslocation->city}},
                                                    {{$businesslocation->states->name }},
                                                    {{$businesslocation->zip_code}}
                                                    <div class="" id="preview-deal-text">
                                                        <a href="javascript:void(0)" data-id="{{$businesslocation->id}}"
                                                            class="p-deal-one edit_participating">Edit</a>
                                                    </div>
                                                </td>
                                                <?php 
                                                            $location = '';
                                                            $checked = '';
                                                            if($loyaltyManage[0]) {
                                                                if(count($loyaltyManage[0]->loyaltylocations) > 0) {
                                                                    foreach($loyaltyManage[0]->loyaltylocations as $reward_location){
                                                                        if($reward_location->location_id == $businesslocation->id){
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
                                                                <input type="checkbox" class="assign-one1 locationAssigned" data-id = "{{$businesslocation->id}}" <?php echo $checked;?>/>
                                                            </div>

                                                        </td>
                                                        <td class="dealvoucher">
                                                            <div class="text-center assign-one4 assignedVoucher <?php if($checked == 'checked'){echo 'checked_location';}else{ echo '';} ?>" data-id = "{{$businesslocation->id}}">
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
                                    <div class="cmn_links_clkd2">
                                        <a href="javascript:void(0)">Manage this Loyalty Reward Program</a>
                                    </div>
                                    <div class="purchase_rcv_ordr_box">
                                        <div class="purchase_rcv_ordr_box_row row gy-4">

                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <textarea
                                                    placeholder="Purchase $150 or more and receive $5 off next order"
                                                    readonly>{{$loyaltyManage[0]->program_name}}</textarea>
                                            </div>
                                            <div class="col-lg-12 purchase_rcv_ordr_box_col">
                                                <button type="submit" class="btn_table_s blu">Loyalty Rewards
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

                                    <div class="cmn_links_clkd2">
                                        <a href="javascript:void(0)">Manage this Deal</a>
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
                                                <input type="text" placeholder="${{$dealManage[0]->discount_amount}}"
                                                    readonly>
                                                @elseif($dealManage[0]->discount_type == 'discount')
                                                <input type="text" placeholder="${{$dealManage[0]->discount_amount}}"
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
                                                <button type="submit" class="btn_table_s blu">Deal
                                                    Management</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->merchantBusiness->locations->where('participating_type','Participating')->count() < Auth::user()->merchantBusiness->number_of_location)
                        <div class="text-left add_location_button" ><button class="add-participating-location" id="add_location_modal"
                                >ADD PARTICIPATING LOCATION</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- change password modal --}}
    <div class="modal fade merchent-main-madal" id="changepasswordModal" tabindex="-1"
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
                                    <h5>Business Location Fax Number</h5>
                                    <input type="text" name="location_fax" id="location_fax">
                                    <span id="faxerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Email</h5>
                                    <input type="text" name="location_email" id="location_email">
                                    <span id="emailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Street Address *</h5>
                                    <input type="text" name="address" id="address">
                                    <span id="addresserror"></span>
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
                                    <select name="state_id" id="state">
                                        <option value=""> Select State </option>
                                        @if ($stateList)
                                        @foreach ($stateList as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
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
                                {{ $location->states->name }}-{{ $location->zip_code }}
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
                                    <h5>Business Location Fax Number</h5>
                                    <input type="text" name="edit_location_fax" id="edit_location_fax">
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
                                    <select name="edit_state_id" id="edit_state_id">
                                        <option value=""> Select State </option>
                                        @if ($stateList)
                                        @foreach ($stateList as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
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
    <!-- <div class="modal fade merchent-main-madal" id="resetpasswordModal" tabindex="-1" aria-labelledby="resetpasswordModalLabel"
    aria-hidden="true">
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

    {{-- Item and service management modal --}}
    <div class="modal fade" id="Add-Item-Service" tabindex="-1" aria-labelledby="Add-Item-ServiceLable"
        aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal white-modal-scroll text-left">
                    <div class="d-flex justify-content-between">
                        <h1>Item And Service Database</h1>
                        <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                    </div>
                    @if(Auth::user()->user_title != 'Associate')

                    <div class="Gimmzi-Gift-Manager ">
                        <div class="btn_title">
                            <button class="btn_title_btn collapsebutton"><img id="collapseimage"
                                    src="{{ asset('frontend_assets/images/right_arrow.png') }}"></button>
                            <h2 id="collapsetitle">Add an item or service to database</h2>
                        </div>

                    </div>
                    <div id="itemserviceform" style="display:none;">
                        <form name="itemForm" id="itemForm" method="post" action="javascript:void(0)">

                            <div class="Gimmzi-Gift-Manager ">
                                <h2>Enter the name of item or service below</h2>
                                <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                    name="item_name" id="item_name" />
                            </div>
                            <span id="nameerror" style="color: red;"></span>
                            <div class="row value-of-this-gift">
                                <div class="col-sm-6">
                                    <h3>Enter the Value of this Item</h3>
                                    <h4>the amount the customer would normally pay</h4>
                                    <div class="customer-input">
                                        <label>$</label>
                                        <input type="text" name="value_one" id="value_one" class="value-input-text" />
                                        <label>.</label>
                                        <input type="text" name="value_two" id="value_two" class="value-input-text" />
                                    </div>
                                    <span id="amounterror" style="color: red;"></span>
                                </div>
                                <div class="col-sm-6">
                                    <h3>Notes (Optional)</h3>
                                    <textarea class="note-text" name="note" id="note"></textarea>
                                </div>
                                <div id="success_message_itemadd" class="ajax_response" style="float:left"></div>
                            </div>
                            <div class="form-group multi-select">
                                <label for="" style="color:black;">Participating
                                    Location(s)</label>
                                <select class="select-item select2" name="participating_location_ids[]"
                                    id="participating_location_id" multiple style="padding-bottom:18px!important;">
                                    <option value="" disabled>Select locations</option>
                                    @if ($business_locations)
                                    @foreach ($business_locations as $locations)
                                    <option value="{{ $locations->id }}">
                                        {{ $locations->address }},
                                        {{ $locations->city }},{{ $locations->states->name }},
                                        {{ $locations->zip_code }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="gift-database-main">
                                <div class="d-flex justify-content-between">
                                    <h3>Item or Service Database</h3>
                                    @if($itemGet)
                                    <div class="filter-sec-manage-programs">
                                        <select name="" id="filter_item" class="filter-select11"
                                            data-id="{{ $itemGet->id }}">
                                            <option value="All">All</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        <button type="submit" id="submit_item">Add To Database</button>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    @endif
                    <div class="gift-database-table mt-4">
                        <table class="gift-table-main table">
                            <thead>
                                <tr>
                                    <td>Status</td>
                                    <td>name of Gift</td>
                                    <td>Notes</td>
                                    <td>Value</td>
                                    <td>Add to Gift Database</td>
                                    @if (Auth::user()->user_title != 'Associate')
                                    <td>Action</td>
                                    @endif
                                </tr>
                            </thead>

                            <tbody class="merchantItemList">
                                
                                @if(count($item) > 0)
                                @forelse ($item as $data)

                                <tr>
                                    @if ($data->status == 1)
                                    <td style="color: #42ac04;">Active</td>
                                    @else
                                    <td style="color: #e61717;">Inactive</td>
                                    @endif
                                    <td>{{ $data->item_name }}</td>
                                    @if ($data->note != '')
                                    <td>{{ $data->note }}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                    {{-- @if ($data->item_price != '')
                                    <td>{{ $data->item_price }}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif --}}
                                    @if ($data->item_price != '')
                                    <td id="valueShow"><a href="#"
                                            class="view-value viewitemvalue view_value{{ $data->id }}"
                                            data-id="{{ $data->id }}">View
                                            Value</a>
                                    </td>
                                    @else
                                    <td>
                                        <a href="#" class="view-value additemvalue add_value{{ $data->id }}"
                                            data-id="{{ $data->id }}">Add
                                            Value</a>
                                        <input type="text" id="itemValue" data-id="{{ $data->id }}"
                                            class="select-input-item itemvalue{{ $data->id }}" style="display:none;">
                                    </td>
                                    @endif
                                    <td class="custom-checkbox-all-product-database text-center"><input
                                            class="form-check-input check_item{{ $data->id }}" name="item_checked"
                                            type="checkbox" {{ $data->is_checked == 1 ? 'checked' : '' }}
                                        id="flexCheckDefault check_item_id" data-id="{{ $data->id }}">
                                    </td>
                                    @if (Auth::user()->user_title != 'Associate')
                                    <td>
                                        <div class="filter-sec-manage-programs select-menu-one">
                                            <select name="item" class="select_item_class" data-id="{{ $data->id }}">
                                                <option value="" class="btn btn-sm btn-clean btn-icon btn-icon-md">...
                                                </option>
                                                <option value="Edit" id="edit_item">Edit</option>
                                                @if ($data->status == 1)
                                                <option value="Remove" class="remove_item">Remove</option>
                                                @else
                                                <option value="Re-add">Re-Add</option>
                                                @endif
                                            </select>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <td>No record</td>
                                @endforelse
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="smart-rewards">
                        <h1>Smart Rewards Family & Friends Gift</h1>
                        <div class="gift-database-table mt-4">
                            <div class="table-manage-program-sec">
                                <table class="gift-table-main table">
                                    <thead>
                                        <tr>
                                            <td>Status</td>
                                            <td>name of Gift</td>
                                            <td>Notes</td>
                                            <td>Value</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Active</td>
                                            <td>Free Appetizer</td>
                                            <td>&nbsp;</td>
                                            <td><a href="#" class="view-value">View
                                                    Value</a></td>
                                            <td><a href="#" class="turn-on-one">Turn
                                                    on</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
            <script>
                $("#participating_location_id").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
            </script>
            @endpush
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

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
                $(document).on('click', '#item_service', function(){
                    $('#Add-Item-Service').modal('show');

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
                });
           
             
                $(".preview_deal").on('click', function() {
                    var deal_Id = $(this).data('id');
                    console.log(deal_Id);
                    $.ajax({
                        url: "{{ route('frontend.business_owner.preview.deal') }}",
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
                        url: "{{ route('frontend.business_owner.description.edit') }}",
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
                //deal price update
                $(".modify_price").on('click', function() {
                    var price_Id = $(this).data('id');
                    var price = $('.dealPrice' + price_Id).val();
                    // console.log(price);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_price.edit') }}',
                        type: 'POST',
                        data: {
                            'price_Id': price_Id,
                            'price': price
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {
                                toastr.success('Deal Price updated successfully');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            }
                        }
                    });

                });
                //deal discount type update
                $(".modify_discount_type").on('click', function() {
                    var discountType_Id = $(this).data('id');
                    var discountType = $('.select_type' + discountType_Id).val();
                    // console.log(discountType);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_discount.edit') }}',
                        type: 'POST',
                        data: {
                            'discountType_Id': discountType_Id,
                            'discountType': discountType
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {
                                toastr.success('Discount Type updated successfully');
                                    setTimeout(() => {
                                       location.reload();
                                    },3000);

                            }
                        }
                    });

                });

                //deal discount Amount update
                $(".modify_discount_amount").on('click', function() {
                    var discountAmount_Id = $(this).data('id');
                    var discountAmount = $('.dealDiscountAmount' + discountAmount_Id).val();
                    // console.log(discountType);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_discount_amount.edit') }}',
                        type: 'POST',
                        data: {
                            'discountAmount_Id': discountAmount_Id,
                            'discountAmount': discountAmount
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {

                                toastr.success('Deal Discount amount updated successfully');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            }
                        }
                    });

                });

                //deal point update
                $(".modify_point").on('click', function() {
                    var point_id = $(this).data('id');
                    var point = $('.dealPoint' + point_id).val();
                    // console.log(discountType);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_point.edit') }}',
                        type: 'POST',
                        data: {
                            'point_id': point_id,
                            'point': point
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {
                                $('#success_message').css('color', 'green').fadeIn().html(
                                    'Deal Point updated successfully....');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            }
                        }
                    });

                });

                //deal voucher update
                $(".modify_voucher").on('click', function() {
                    var voucher_id = $(this).data('id');
                    var voucher = $('.dealVoucher' + voucher_id).val();
                    // console.log(discountType);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_voucher.edit') }}',
                        type: 'POST',
                        data: {
                            'voucher_id': voucher_id,
                            'voucher': voucher
                        },
                        success: function(response) {
                            // console.log(response.success);
                            if (response.success == 1) {
                                $('#success_message').css('color', 'green').fadeIn().html(
                                    'Deal Voucher updated successfully....');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            }
                        }
                    });

                });

                //deal date update
                $(".modify_date").on('click', function() {
                    var date_id = $(this).data('id');
                    var start_date = $('.dealDate' + date_id).val();
                    var end_date = $('.dealEndDate' + date_id).val();
                    // console.log(date.setDate(date.getDate() + 30));
                    // console.log(end_date);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.deal_date.edit') }}',
                        type: 'POST',
                        data: {
                            'date_id': date_id,
                            'start_date': start_date,
                            'end_date': end_date
                        },
                        success: function(response) {
                            console.log(response.success);
                            if (response.success == 1) {
                                toastr.success('Deal Date updated successfully');

                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    // location.reload();
                                }, 3000);

                            } else {
                                $(".error_msg" + date_id).html(
                                    'The End Date can not be less than 30 days from start date '
                                );
                            }
                        }
                    });

                });

                //$("input[type='checkbox']").on('click', function() {
                $(document).on('click', 'input[name="item_checked"]', function() {
                    if ($(this).is(":checked")) {
                        var item_Id = $(this).data('id');
                        // console.log(item_Id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('frontend.business_owner.save.item.gift') }}",
                            type: 'POST',
                            data: {
                                'item_Id': item_Id,

                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    // location.reload();
                                    $("#Add-Item-Service").modal('hide');
                                }
                            }
                        });
                    } else if ($(this).is(":not(:checked)")) {
                        var item_Id = $(this).data('id');
                        // console.log(item_Id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.unsave.item.gift') }}',
                            type: 'POST',
                            data: {
                                'item_Id': item_Id,

                            },
                            success: function(response) {
                                //console.log(response.success);
                                if (response.success == 1) {
                                    //   alert('successful');
                                    // location.reload();
                                    $("#Add-Item-Service").modal('hide');
                                }
                            }
                        });

                    }

                });
            });

            $(document).ready(function() {

                $('#filter_item').change(function() {
                    if ($(this).val() == "All") {
                        var status = $(this).val();
                        $.ajax({
                            url: "{{ route('frontend.business_owner.filterItemService') }}",
                            type: 'GET',
                            data: {
                                'status': status,

                            },
                            success: function(response) {
                                if (response.success == 1) {

                                    var data = response.data;

                                    $(".merchantItemList").empty();
                                    for (var i = 0; i < data.length; i++) {
                                        // console.log(data[i].item_value);
                                        if (data[i].note != null) {
                                            var note = data[i].note;
                                        } else {
                                            var note = 'N/A';
                                        }
                                        if (data[i].item_price != null) {
                                            var value =
                                                '<a href="#"class="view-value viewitemvalue view_value' +
                                                data[i].id + '"data-id="' + data[i].id + '">' +
                                                'View Value</a>';
                                        } else {
                                            var value =
                                                '<a href="#" class="view-value additemvalue add_value' +
                                                data[i].id + '"' +
                                                'data-id="' + data[i].id + '">Add Value</a>' +
                                                '<input type="text" id="itemValue" data-id="' +
                                                data[i].id +
                                                '" class="select-input-item itemvalue' + data[i]
                                                .id + '" style="display:none;">';
                                        }
                                        if (data[i].is_checked == 1) {
                                            var isChecked = 'checked';
                                        } else {
                                            var isChecked = '';
                                        }
                                        if (data[i].status != 1) {
                                            var itemstatus =
                                                '<td style="color: #e61717;">Inactive</td>';
                                            var optionValue =
                                                '<option value="Re-add">Re-Add</option>';
                                        } else {
                                            var itemstatus =
                                                '<td style="color: #42ac04;">Active</td>';
                                            var optionValue =
                                                '<option value="Remove" >Remove</option>';
                                        }

                                        var items = '<tr>' + itemstatus +
                                            '<td>' + data[i].item_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +
                                            '<td class="custom-checkbox-all-product-database  text-center">' +
                                            '<input class="form-check-input check_item' + data[i]
                                            .id + '" name="item_checked" type="checkbox"' +
                                            isChecked +
                                            ' id="flexCheckDefault check_item_id" data-id="' + data[
                                                i].id + '">' +
                                            '</td>' +
                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_item_class"' +
                                            'data-id="' + data[i].id + '">' +
                                            '<option value=""' +
                                            'class="btn btn-sm btn-clean btn-icon btn-icon-md">...' +
                                            '</option>' +
                                            '<option value="Edit" id="edit_item">Edit</option>' +
                                            optionValue +
                                            '</select>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                        $(".merchantItemList").append(items);
                                    }

                                    //$("#demo").html(response.data);
                                }
                            }
                        });
                    } else if ($(this).val() == "Active") {
                        var status = $(this).val();
                        $.ajax({
                            url: "{{ route('frontend.business_owner.filterItemService') }}",
                            type: 'GET',
                            data: {
                                'status': status,

                            },
                            success: function(response) {
                                if (response.success == 1) {

                                    var data = response.data;
                                    $(".merchantItemList").empty();
                                    for (var i = 0; i < data.length; i++) {
                                        // console.log(data[i].item_value);
                                        if (data[i].note != null) {
                                            var note = data[i].note;
                                        } else {
                                            var note = 'N/A';
                                        }
                                        if (data[i].item_price != null) {
                                            var value =
                                                '<a href="#"class="view-value viewitemvalue view_value' +
                                                data[i].id + '"data-id="' + data[i].id + '">' +
                                                'View Value</a>';
                                        } else {
                                            var value =
                                                '<a href="#" class="view-value additemvalue add_value' +
                                                data[i].id + '"' +
                                                'data-id="' + data[i].id + '">Add Value</a>' +
                                                '<input type="text" id="itemValue" data-id="' +
                                                data[i].id +
                                                '" class="select-input-item itemvalue' + data[i]
                                                .id + '" style="display:none;">';
                                        }
                                        if (data[i].is_checked == 1) {
                                            var isChecked = 'checked';
                                        } else {
                                            var isChecked = '';
                                        }
                                        var items = '<tr>' +
                                            '<td style="color: #42ac04;">Active</td>' +
                                            '<td>' + data[i].item_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +
                                            '<td class="custom-checkbox-all-product-database  text-center">' +
                                            '<input class="form-check-input check_item' + data[i]
                                            .id + '" name="item_checked" type="checkbox"' +
                                            isChecked +
                                            ' id="flexCheckDefault check_item_id" data-id="' + data[
                                                i].id + '">' +
                                            '</td>' +
                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_item_class"' +
                                            'data-id="' + data[i].id + '">' +
                                            '<option value=""' +
                                            'class="btn btn-sm btn-clean btn-icon btn-icon-md">...' +
                                            '</option>' +
                                            '<option value="Edit" id="edit_item">Edit</option>' +
                                            '<option value="Remove" >Remove</option>' +
                                            '</select>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                        $(".merchantItemList").append(items);
                                    }

                                    //$("#demo").html(response.data);
                                }
                            }
                        });
                    } else if ($(this).val() == "Inactive") {
                        var status = $(this).val();
                        $.ajax({
                            url: "{{ route('frontend.business_owner.filterItemService') }}",
                            type: 'GET',
                            data: {
                                'status': status,

                            },
                            success: function(response) {
                                if (response.success == 1) {

                                    var data = response.data;
                                    $(".merchantItemList").empty();
                                    for (var i = 0; i < data.length; i++) {
                                        // console.log(data[i].item_value);
                                        if (data[i].note != null) {
                                            var note = data[i].note;
                                        } else {
                                            var note = 'N/A';
                                        }
                                        if (data[i].item_price != null) {
                                            var value =
                                                '<a href="#"class="view-value viewitemvalue view_value' +
                                                data[i].id + '"data-id="' + data[i].id + '">' +
                                                'View Value</a>';
                                        } else {
                                            var value =
                                                '<a href="#" class="view-value additemvalue add_value' +
                                                data[i].id + '"' +
                                                'data-id="' + data[i].id + '">Add Value</a>' +
                                                '<input type="text" id="itemValue" data-id="' +
                                                data[i].id +
                                                '" class="select-input-item itemvalue' + data[i]
                                                .id + '" style="display:none;">';
                                        }
                                        if (data[i].is_checked == 1) {
                                            var isChecked = 'checked';
                                        } else {
                                            var isChecked = '';
                                        }
                                        var items = '<tr>' +
                                            '<td style="color: #e61717;">Inactive</td>' +
                                            '<td>' + data[i].item_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +
                                            '<td class="custom-checkbox-all-product-database  text-center">' +
                                            '<input class="form-check-input check_item' + data[i]
                                            .id + '" name="item_checked" type="checkbox"' +
                                            isChecked +
                                            ' id="flexCheckDefault check_item_id" data-id="' + data[
                                                i].id + '">' +
                                            '</td>' +
                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_item_class"' +
                                            'data-id="' + data[i].id + '">' +
                                            '<option value=""' +
                                            'class="btn btn-sm btn-clean btn-icon btn-icon-md">...' +
                                            '</option>' +
                                            '<option value="Edit" id="edit_item">Edit</option>' +
                                            '<option value="Re-add">Re-Add</option>' +
                                            '</select>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                        $(".merchantItemList").append(items);
                                    }

                                    //$("#demo").html(response.data);
                                }
                            }
                        });
                    }

                });
                $("#submit_item").click(function(e) {
                    e.preventDefault();

                    if ($("#item_name").val() == '') {
                        $("#nameerror").html('Please enter item or service name');
                    }
                    if ($("#value_two").val() != '' && $("#value_one").val() != '') {
                        var amount = $("#value_one").val() + '.' + $("#value_two").val();
                    } else if ($("#value_one").val() != '' && $("#value_two").val() == '') {
                        var amount = $("#value_one").val() + '.00';
                    } else {
                        var amount = '';
                    }
                    var location_ids = $('#participating_location_id').val();
                    // console.log(location);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit_item').html('Please Wait...');
                    $("#submit_item").attr("disabled", true);

                    $.ajax({
                        url: "{{ url('save-item-service') }}",
                        type: "POST",
                        data: {
                            item_name: $("#item_name").val(),
                            note: $("#note").val(),
                            value: amount,
                            location_ids: location_ids
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                $('#participating_location_id').val('');
                                document.getElementById("itemForm").reset();
                              
                                toastr.success('Item or Services added successfully');
                                setTimeout(function() {
                                    $('#success_message_itemadd').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                                //location.reload();
                            } else {
                                $("#Add-Item-Service").modal('show');
                            }
                        }
                    });

                });


                $(document).on('click', '.viewitemvalue', function() {
                    //$('.view-value').on('click', function() {
                    var value = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('frontend.business_owner.viewItemService') }}",
                        type: 'get',
                        data: {
                            'value': value
                        },
                        success: function(response) {
                            console.log(response.data.price);
                            if (response.success == 1) {
                                if (response.data.price != null) {
                                    $('.view_value' + value).text("");
                                    $('.view_value' + value).text(response.data.price);
                                    // $("#valueShow").css('display','none');
                                    // console.log('ok');
                                }
                            }
                            // console.log(response.data.gift_value);
                        }
                    });
                });
                $(document).on('click', '.additemvalue', function() {
                    var value = $(this).data('id');
                    $(".itemvalue" + value).css('display', 'block');
                    $(".add_value" + value).css('display', 'none');

                });
                $(document).on('blur', '.select-input-item', function() {
                    var value = $(this).data('id');
                    console.log(value);
                    if ($(this).val() != '') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('frontend.business_owner.addItemValue') }}",
                            type: 'get',
                            data: {
                                'price': $(this).val(),
                                'itemid': value
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    toastr.success('Item or Services price updated successfully');
                                    setTimeout(function() {
                                        $('#success_message').fadeOut("slow");
                                        location.reload();
                                    }, 3000);
                                } else {
                                    $(".itemvalue" + value).css('display', 'none');
                                    $(".add_value" + value).css('display', 'block');
                                }

                            }
                        });
                    } else {
                        // $(".itemvalue"+value).css('display','none');
                        // $(".add_value"+value).css('display','block');
                    }


                })
                $(document).on('change', '.select_item_class', function() {
                    // $('.select_item_class').on('change',function() {
                    console.log($(this).val());
                    if ($(this).val() == "Remove") {
                        var item_remove = $(this).data('id');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.remove.item.service') }}',
                            type: 'POST',
                            data: {
                                'item_remove': item_remove,

                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    location.reload();
                                }
                            }
                        });

                    } else if ($(this).val() == "Re-add") {
                        var item_readd = $(this).data('id');
                        // console.log(item_readd);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.readdItemService') }}',
                            type: 'POST',
                            data: {
                                'item_readd': item_readd,

                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    location.reload();
                                }
                            }
                        });
                    } else if ($(this).val() == "Edit") {
                        var item_edit = $(this).data('id');
                        // console.log(item_edit);
                        $.ajax({
                            url: 'edit-item-service/' + item_edit,
                            type: 'GET',
                            data: {
                                'item_edit': item_edit,

                            },
                            success: function(response) {
                                //console.log(response);
                                if (response.success == 1) {
                                    $('#hidden_id').val(response.data.id);
                                    $("#Edit-Item-Service").modal('show');
                                    $("#item_name_edit").val(response.data.item_name);
                                    $("#value_edit").val(response.data.item_price.price);
                                    // $("#value_two_edit").val(response.data.item_value);
                                    $("#note_edit").val(response.data.note);
                                    // console.log(response.data.item_name);
                                }
                            }
                        });
                    }
                });

                $("#update_item").click(function(e) {
                    // console.log('hi');
                    e.preventDefault();

                    if ($("#item_name_edit").val() == '') {
                        $("#nameerror").html('Please enter item or service name');
                    }
                    // if ($("#value_two_edit").val() != '' && $("#value_one_edit").val() != '') {
                    //     var amountEdit = $("#value_one_edit").val() + '.' + $("#value_two_edit").val();
                    // } else if ($("#value_one_edit").val() != '' && $("#value_two_edit").val() == '') {
                    //     var amountEdit = $("#value_one_edit").val() + '.00';
                    // } else {
                    //     var amountEdit = '';
                    // }
                    var id = $("#hidden_id").val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#update_item').html('Please Wait...');
                    $("#update_item").attr("disabled", true);

                    $.ajax({
                        url: 'update-item-service/' + id,
                        type: "POST",
                        data: {
                            item_name: $("#item_name_edit").val(),
                            note: $("#note_edit").val(),
                            id: id,
                            value: $("#value_edit").val(),
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                document.getElementById("itemEditForm").reset();
                                toastr.success('Item or Services updated successfully');
                                setTimeout(function() {
                                    $('#success_message_edit').fadeOut("slow");
                                    location.reload();
                                }, 2000);
                                //location.reload();
                            } else {
                                $("#Add-Item-Service").modal('show');
                            }
                        }
                    });
                });

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

<<<<<<< HEAD


=======
>>>>>>> 3a3efe5885aaf81b49aa92e6bd03579cfcd3e19b
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
                        location_fax: {
                            minlength: 10,
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
                        state_id: {
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
                        edit_location_fax: {
                            min: 10,
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
                        edit_state_id: {
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
                        edit_state_id: {
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
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Participating Location has been added successfully.');

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
                                $("#success_modal").modal('show');
                                $("#successmsg").html('Business Location has been updated successfully.');

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
                   $(".preview_deal").attr('data-id',dealid)
                   $.ajax({
                            url: "{{ route('frontend.business_owner.get_deal') }}",
                            type: 'GET',
                            data: {
                                'deal_Id': dealid,

                            },
                            success: function(response) {
                                if(response.success == 1){
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
                                        $(".add_location_button").css('display','block');
                                    }

                                   // console.log(response.locations.length);
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


                                            var locationData = '<tr>'+
                                                        '<td>'+
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
                                            $('#deallocation').append(locationData);
                                        }
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
                                        $("#discount_price").val('$'+response.data.discount_amount);
                                    }
                                    else if(response.data.discount_type == 'percentage'){
                                        $("#discount_price").val(response.data.discount_amount+'%');
                                    }
                                    $("#description").val('');
                                    $("#description").val(response.data.suggested_description);
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
                                    $("#edit_location_fax").val(response.data.business_fax_number);
                                    $("#edit_location_email").val(response.data.business_email);
                                    $("#edit_address").val(response.data.address);
                                    $("#edit_zip_code").val(response.data.zip_code);
                                    $("#edit_city").val(response.data.city);
                                    $("#edit_state_id").val(response.data.state_id);
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
                                //$(this).attr('checked',true);

                            }
                    });

                });

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
        });
    </script>
    @endpush
</x-layouts.frontend-layout>
