<x-layouts.frontend-layout title="Business Owners Loyal Reward program Page">
   
    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main purchase-goal-sec-main-new-page">

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
                                                @if ($locations->merchantUser->location_type == 'multiple')
                                                    <option {{ $locations->is_main == 1 ? 'selected' : '' }}
                                                        value="{{ $locations->businessLocation->id }}">
                                                        {{ $locations->businessLocation->location_name }}
                                                    </option>
                                                @else
                                                    <option {{ $locations->is_main == 1 ? 'selected' : '' }}
                                                        value="{{ $locations->businessLocation->id }}">
                                                        {{ $locations->businessLocation->location_name }}
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
                                                                alt="" /></span>Address:
                                                        <span class="points-distributed-txt" id="change_address">
                                                            @foreach ($merchant_location as $locations)
                                                                @if ($locations->is_main == 1)
                                                                    {{ $locations->businessLocation->address }},
                                                                    {{ $locations->businessLocation->city }},
                                                                    @if($locations->businessLocation->state_id == null)
                                                                        {{$locations->businessLocation->state_name }},
                                                                    @else
                                                                        {{$locations->businessLocation->states->name}},
                                                                    @endif
                                                                    {{ $locations->businessLocation->states->name }},
                                                                    {{ $locations->businessLocation->zip_code }}
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
                                                                @if ($locations->is_main == 1)
                                                                    {{ $locations->businessLocation->business_email }}
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
                                                                src="./images/call-16.svg"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt" id="change_phone">
                                                            @foreach ($merchant_location as $locations)
                                                                @if ($locations->is_main == 1)
                                                                    {{ $locations->businessLocation->business_phone }}
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

                <div class="allen-part-tab-one-main loyality-rewards-program-tab-sec">
                    <nav>
                        <div class="nav nav-tabs mb-3 nav-cutom-tabs" id="nav-tab" role="tablist">
                            @if (Auth::user()->user_title != 'Associate')
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">Bulid Your <span class="loyality-text">Loyalty Rewards
                                        Program</span></button>
                            @endif
                            @if (Auth::user()->user_title == 'Associate')
                                <button class="nav-link active" id="nav-profile-tab1" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="true">Manage Programs
                                </button>
                            @else
                                <button class="nav-link" id="nav-profile-tab1" data-bs-toggle="tab"
                                    data-bs-target="#nav-profile" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">Manage Programs
                                </button>
                            @endif
                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Program Database
                            </button>
                        </div>
                    </nav>




                    <div class="tab-content allen-container-mid" id="nav-tabContent">
                        @if (Auth::user()->user_title != 'Associate')
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                {{ Form::open(['route' => 'frontend.business_owner.loyal_reward_store', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red', 'files' => true]) }}
                                <div class="build-your-loyality-first-tab-sec">
                                    <div class="first-tab-build-sec">
                                        <h6>Select the date you would like to start your 
                                            <span class="loyality-text">Loyalty Rewards Program.</span>
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="text" name="start_on" id="startOn" placeholder = "mm/dd/yyyy" value="{{old('start_on')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    @if((!old()) && (old('no_end_date') == null))
                                                        <input type="checkbox" class="assign-one1 check_no_checkbox" id="enddatecheckbox" name="no_end_date"checked >
                                                        <label for="enddatecheckbox" style="position: absolute;top: 12px;margin-left: 7px;color:black;">No End Date</label>
                                                    @elseif(old('no_end_date') == 'null')
                                                        <input type="checkbox" class="assign-one1 check_no_checkbox" id="enddatecheckbox" name="no_end_date" >
                                                        <label for="enddatecheckbox" style="position: absolute;top: 12px;margin-left: 7px;color:black;">No End Date</label>
                                                    @elseif(old('no_end_date') == 'ON')
                                                        <input type="checkbox" class="assign-one1 check_no_checkbox" id="enddatecheckbox" name="no_end_date" checked>
                                                        <label for="enddatecheckbox" style="position: absolute;top: 12px;margin-left: 7px;color:black;">No End Date</label>
                                                    @else
                                                        <input type="checkbox" class="assign-one1 check_no_checkbox" id="enddatecheckbox" name="no_end_date" checked>
                                                        <label for="enddatecheckbox" style="position: absolute;top: 12px;margin-left: 7px;color:black;">No End Date</label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($errors->has('start_on'))
                                        <div class="error">{{ $errors->first('start_on') }}</div>
                                    @endif
                                    @if((!old()) && (old('no_end_date') == null))
                                        <div class="first-tab-build-sec enddatesection" style="display:none;">
                                            <h6>Select the date you would like to end your 
                                                <span class="loyality-text">Loyalty Rewards Program.</span>
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="end_on" id="endOn" placeholder = "mm/dd/yyyy">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    @elseif(old('no_end_date') == null)
                                        <div class="first-tab-build-sec enddatesection" style="display:block;">
                                            <h6>Select the date you would like to end your 
                                                <span class="loyality-text">Loyalty Rewards Program.</span>
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="end_on" id="endOn" placeholder = "mm/dd/yyyy" value="{{old('end_on')}}">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('end_on'))
                                            <div class="error">{{ $errors->first('end_on') }}</div>
                                        @endif
                                    @elseif(old('no_end_date') == 'ON')
                                        <div class="first-tab-build-sec enddatesection" style="display:none;">
                                            <h6>Select the date you would like to end your 
                                                <span class="loyality-text">Loyalty Rewards Program.</span>
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="end_on" id="endOn" placeholder = "mm/dd/yyyy">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @else
                                        <div class="first-tab-build-sec enddatesection" style="display:none;">
                                            <h6>Select the date you would like to end your 
                                                <span class="loyality-text">Loyalty Rewards Program.</span>
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" name="end_on" id="endOn" placeholder = "mm/dd/yyyy">
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                       
                                    @endif
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group multi-select">
                                                <label for="" style="color:black;">Participating
                                                    Location(s)</label>
                                                <select class="select-item select2" name="location_ids[]"
                                                    id="location_id" multiple
                                                    style="padding-bottom:18px!important;">
                                                    <option value=""disabled>Select locations
                                                    </option>
                                                    @if ($business_locations)
                                                        @foreach ($business_locations as $locations)
                                                            <option value="{{ $locations->id }}">
                                                                {{ $locations->address }},
                                                                {{ $locations->city }},
                                                                @if($locations->state_id == null)
                                                                    {{$locations->state_name }},
                                                                @else
                                                                    {{$locations->states->name}},
                                                                @endif,
                                                                {{ $locations->zip_code }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            @if($errors->has('location_ids'))
                                                <div class="error">Please select at least one location</div>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="loyality-rewards-last-sec">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="left-tab__sec new-tab-one5">
                                                <ul>
                                                    <li>
                                                        <p>Select the type of <span class="loyality-text">Loyalty
                                                                Rewards Program</span>you would like to bulid.</p>
                                                    </li>
                                                   
                                                    <li>
                                                        <div class="purchase-goal-sec">
                                                            <p style="color:black;">Purchase Goal (Free)</p>
                                                            <div class="form-group-custom-radio">
                                                                <input type="radio" name="purchase_goal"
                                                                    value="free"
                                                                    {{ old('purchase_goal') == 'free' ? 'checked' : '' }}>
                                                                <label for="" style="color:black;">Purchase a
                                                                    certain number
                                                                    of an item and get one for
                                                                    FREE</label>
                                                                <span class="checkmark"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="purchase-goal-sec">
                                                            <p style="color:black;">Purchase Goal (Deal Discount)</p>
                                                            <div class="form-group-custom-radio">
                                                                <input type="radio" name="purchase_goal"
                                                                    value="deal_discount"
                                                                    {{ old('purchase_goal') == 'deal_discount' ? 'checked' : '' }}>
                                                                <label for="" style="color:black;">Spend up to
                                                                    a
                                                                    set dollar
                                                                    amount on a specific item or item
                                                                    type and earn a dollar amount deal discount off the
                                                                    next
                                                                    purchase
                                                                </label>
                                                                <span class="checkmark"></span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if ($errors->has('purchase_goal'))
                                                        <div class="error">{{ $errors->first('purchase_goal') }}</div>
                                                    @endif
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        @if (old('purchase_goal') == 'free')
                                            <div class="col-md-6 free_goal" style="display:block;">
                                            @else
                                                <div class="col-md-6 free_goal" style="display:none;">
                                        @endif

                                        <div class="right-tab-sec-purchase-goal">
                                            <div class="all-field-txt-purchase-goal">
                                                <div class="form-group multi-select">
                                                    <label for="" style="color:black;">What Item or items
                                                        would
                                                        you like to use for this loyalty program?</label>
                                                    <select class="select-item select2" name="free_item[]"
                                                        id="item_id" multiple>

                                                        @if (count($item) > 0)
                                                            @foreach ($item as $data)
                                                                <option value="{{ $data->id }}"
                                                                    <?php if (old('free_item') == $data->id) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                                    {{ $data->item_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @if ($errors->has('free_item'))
                                                        <div class="error">{{ $errors->first('free_item') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="" style="color:black;">How many of these does
                                                        your
                                                        customer have to buy before they earn one free?
                                                    </label>
                                                    <input type="text" name="have_to_buy"
                                                        placeholder="Enter the  number of the items needed"
                                                        value="{{ old('have_to_buy') }}" class="w-75 how_much">
                                                    @if ($errors->has('have_to_buy'))
                                                        <div class="error">{{ $errors->first('have_to_buy') }}</div>
                                                    @endif
                                                </div>
                                                <div class="customer-last-sec-purchase-goal form-group">
                                                    <p class="customer-get-the">
                                                        <label class="what-item-one" style="color:black;">And the
                                                            customer get the</label>
                                                        <label class="what-item-one"> <input type="text"
                                                                name="free_item_no" placeholder="Enter here"
                                                                id="free_item_id" value="{{ old('free_item_no') }}"
                                                                disabled>
                                                            <input type="text" hidden name="free_item_get"
                                                                placeholder="" id="free_item_hidden" value="">
                                                        </label>
                                                        <label class="what-item-one" style="color:black;"> Free
                                                        </label>
                                                        @if ($errors->has('free_item_no'))
                                                            <div class="error">{{ $errors->first('free_item_no') }}
                                                            </div>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (old('purchase_goal') == 'deal_discount')
                                        <div class="col-md-6 deal_discount_goal" style="display:block;">
                                        @else
                                            <div class="col-md-6 deal_discount_goal" style="display:none;">
                                    @endif

                                    <div class="right-tab-sec-purchase-goal">
                                        <div class="all-field-txt-purchase-goal">
                                            <div class="form-group multi-deal-select">
                                                <label for="" style="color:black;">What Item or items would
                                                    you like to use for
                                                    this loyalty program?
                                                </label>
                                                <select class="select-item select2" name="discount_item[]" multiple
                                                    id="ditem_id">

                                                    @if (count($item) > 0)
                                                        @foreach ($item as $data)
                                                            <option value="{{ $data->id }}" <?php if (old('discount_item') == $data->id) {
                                                                echo 'selected';
                                                            } ?>>
                                                                {{ $data->item_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @if ($errors->has('discount_item'))
                                                    <div class="error">{{ $errors->first('discount_item') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="" style="color:black;">How much (dollar amonut)
                                                    does your customer
                                                    have to spent before they recieve this deal discount?
                                                </label>
                                                <input type="text" name="spend_amount" class="w-75"
                                                    placeholder="Enter the dollar amount needed to spend here"
                                                    value="{{ old('spend_amount') }}">
                                                @if ($errors->has('spend_amount'))
                                                    <div class="error">{{ $errors->first('spend_amount') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group customer-get-the">
                                                <span class="what-item-one" style="color:black;">And the
                                                    customer get the</span>
                                                <span class="what-item-one a-width"> <input type="text"
                                                        name="discount_amount" placeholder="Enter discount"
                                                        value="{{ old('discount_amount') }}">
                                                    @if ($errors->has('discount_amount'))
                                                        <div class="error">
                                                            {{ $errors->first('discount_amount') }}</div>
                                                    @endif
                                                </span>
                                                <span class="what-item-one" style="color:black;"> OFF
                                                </span>
                                                <span class="what-item-one new-select1">
                                                    <select class="" id="when" name="when_order"
                                                        value="{{ old('when_order') }}">
                                                        <option value="">When?</option>
                                                        <option value="current">Current</option>
                                                        <option value="next">Next</option>
                                                    </select>
                                                    @if ($errors->has('when_order'))
                                                        <div class="error">{{ $errors->first('when_order') }}
                                                        </div>
                                                    @endif
                                                </span>
                                                <span class="what-item-one" style="color:black;">order.</span>



                                                @if ($errors->has('spend_amount'))
                                                    <div class="error">{{ $errors->first('spend_amount') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>


                    <div class="last-cancel-save-btn-sec-purchase-goal-loyality">
                        <button class="cancel-btn cancelCreateProgram" type="button" >CANCEL</button>
                        <button class="publish-btn">Publish</button>
                    </div>

                    <div class="last-technical-issue-txt-loyality-purchase-goal">
                        <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                    </div>
                    {{ Form::close() }}
                </div>
                @endif

                <div class="tab-pane fade @if (Auth::user()->user_title == 'Associate') active show @endif" id="nav-profile"
                    role="tabpanel" aria-labelledby="nav-profile-tab1">
                    <!-- manage programs tab-->
                    <div class="manage-program-tab-content-main-sec">
                        <div class="filter-sec-manage-programs">
                            <select name="" id="">
                                <option value="">Filter</option>
                                <option value="">Active</option>
                                <option value="">Inactive</option>
                            </select>
                        </div>

                        <div class="table-manage-program-sec">
                            <table>
                                <tr>
                                    <th>Status</th>
                                    <th>Program Type</th>
                                    <th style="width: 21%;">Description of program</th>
                                    <th>Participating Location</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($loyalty as $data)
                                    <tr>
                                        <td>{{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td> Purchase Goal
                                            ({{ $data->purchase_goal == 'deal_discount' ? 'Deal Discount' : 'Free' }})
                                        </td>
                                        <td>{{ $data->program_name }}</td>
                                        <td><a href="#" class="view_location" style="color: #1f8ac9;"
                                                data-id="{{ $data->id }}">View Locations</a></td>
                                        <?php $startdate = date_format(date_create($data->start_on),'m-d-Y');?>
                                        <td>{{ $startdate }}</td>
                                        <?php 
                                        if($data->end_on != ''){
                                            $enddate = date_format(date_create($data->end_on),'m-d-Y');
                                        }
                                        else{
                                            $enddate = 'No End Date';
                                        }
                                        ?>
                                        <td id="endOn{{ $data->id }}">{{ $enddate }}</td>

                                        <td id="programBtn{{ $data->id }}">
                                            @php
                                                $today = date('Y-m-d');
                                                $enddate = date_create($data->end_on);
                                                $todaydate = date_create($today);
                                                $diff = date_diff($enddate, $todaydate);
                                                $days = $diff->format('%a');
                                                // dd($days);
                                            @endphp
                                            @if($data->end_on == '')
                                                <button class="end-program-btn-sec end_program"
                                                        data-id="{{ $data->id }}" style="margin-bottom: 10px;">End Program
                                                </button>
                                            @elseif($days > 30)
                                                <button class="end-program-btn-sec end_program"
                                                        data-id="{{ $data->id }}" style="margin-bottom: 10px;">End Program
                                                </button>
                                                <button class="extend-program-btn-sec extend_program"
                                                        data-id="{{ $data->id }}">Extend Program
                                                </button>
                                            @elseif($days < 30)
                                                <button class="extend-program-btn-sec schedule_to_end"
                                                        data-id="{{ $data->id }}" style="margin-bottom: 10px; background-color: #d70303;
                                                        border-color: #d70303;">Scheduled To End
                                                </button>
                                                <button class="extend-program-btn-sec extend_program"
                                                        data-id="{{ $data->id }}">Extend Program
                                                </button>
                                            @elseif($days == 30)   
                                                <button class="extend-program-btn-sec schedule_to_end"
                                                        data-id="{{ $data->id }}" style="margin-bottom: 10px; background-color: #d70303;
                                                        border-color: #d70303;">Scheduled To End
                                                </button> 
                                            @endif
                                           
                                        </td>

                                    </tr>
                                @empty
                                    </tr>
                                    <td>No Program available</td>
                                    </tr>
                                @endforelse

                            </table>
                            {{-- <div>  {{ $loyalty->links() }} </div> --}}
                        </div>

                        <div
                            class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                            <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                        </div>
                    </div>
                    <!-- manage programs end tab-->

                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


                    <!-- Program Database tab content -->

                    <div class="manage-program-tab-content-main-sec programe-database-main-sec-tab-content">
                        <div class="filter-sec-manage-programs">
                            <button class="add-manage-gifts-btn-sec" data-bs-toggle="modal"
                                data-bs-target="#Add-Manage-Gifts">Add/Manage Gifts</button>
                            <select name="" id="">
                                <option value="">Filter</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>

                        </div>

                        <div class="table-manage-program-sec">
                            <table>
                                <tr>
                                    <th class="custom-checkbox-all-product-database bg-color-blue">
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="flexCheckDefault">
                                    </th>
                                    <th>Member Name</th>
                                    <th>Participating Program</th>
                                    <th>Participating Location</th>
                                    <th>Join Date</th>
                                    <th>Program Progress</th>
                                    <th>Send a Gimmzi Gift</th>
                                    <th>Action</th>
                                </tr>
                                @forelse ($consumerLoyalty as $data)
                                    <tr>
                                        <td class="custom-checkbox-all-product-database"><input
                                                class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault"></td>
                                        <td>{{ $data->consumers->full_name }}</td>
                                        <td>{{ $data->loyalty->program_name }}</td>
                                        <td></td>
                                        <?php
                                        $joindate = date_format(date_create($data->join_date), 'd-m-y');
                                        ?>
                                        <td>{{ $joindate }}</td>
                                        @if ($data->loyalty->purchase_goal == 'free')
                                            <td>{{ $data->program_process }}/{{ $data->loyalty->have_to_buy }} items
                                                ({{ $data->program_process_percentage }})
                                            </td>
                                        @else
                                            <td>{{ $data->program_process }}
                                                ({{ $data->program_process_percentage }})</td>
                                        @endif

                                        <td class="custom-select-box-gift-program-database">
                                            <select name="" id="">
                                                <option value="">Select Gift</option>
                                                @foreach ($gift as $gifts)
                                                    <option value="{{ $gifts->id }}">{{ $gifts->gift_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </td>
                                        <td><button class="send-program-btn-sec" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">Send</button></td>
                                    </tr>
                                @empty
                                    <tr>No record available</tr>
                                @endforelse
                            </table>
                        </div>
                        @if (Auth::user()->user_title != 'Associate')
                            <div class="gift-setting-sec">
                                <h4>Automatic Gimmzi Gift Settings <span> </span> <button class="Edit-Setting-button"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal4">Edit
                                        Setting</button></h4>
                                <div class="custom-checkbox-send-edit-setting">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label for="">Auto Send<span>Chips & Salsa</span>to Customers
                                        with<span>50%</span>program Progress </label>
                                </div>
                                <div class="custom-checkbox-send-edit-setting">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label for="">Auto Send<span>FREE APPETIZER</span>to Customers Whom
                                        Completed
                                        <span>3</span> Loyalty Reward Programs within a <span>1 Year</span>
                                        timeframe </label>
                                </div>
                                <div class="custom-checkbox-send-edit-setting">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label for="">Auto Send<span>Chips & Salsa</span>to Customers their
                                        birthday
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div
                            class="last-technical-issue-txt-loyality-purchase-goal new-tab-manage-program-technical-issue-txt">
                            <a href="">Having Technical issues? Submit a Trouble ticket here</a>
                        </div>
                    </div>
                    <!-- Program Database tab content end-->
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>

    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-data-sec">
                <div class="modal-content">

                    <div class="modal-body white-modal white-modal-scroll text-left">
                        <div class="d-flex justify-content-between">
                            <h1>Automatic Gimmzi Gift Settings</h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-6 align-items-center d-flex">
                                <label class="progrss-incon">Pro gress Incentive</label>
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="col-sm-6 align-items-center d-flex justify-content-end progrss-status-text">
                                Status: <span>oN</span>
                            </div>
                        </div>
                        <div class="p-con-one">
                            <label>Auto Send </label>
                            <select class="auto-send-select">
                                <option value="">Chips & Salsa</option>
                                <option value="">Chips & Salsa 1</option>
                            </select>
                            <label>To Customers with </label>
                            <select class="auto-send-select">
                                <option value="">50%</option>
                                <option value="">100%</option>
                            </select>
                            <label>Program Progress </label>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-12 align-items-center d-flex justify-content-between">

                                <div><label class="progrss-incon">Program Completion Incentive
                                        <small> (Smart rewards
                                            family and friends gift)</small>
                                    </label>
                                    <span class="top-44">
                                        <label class="switch pt-22">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </span>
                                </div>
                                <label class="pl-1 progrss-status-text-off">
                                    Status: <span>OFF</span>
                                </label>
                            </div>
                            <div class="col-sm-6 align-items-center d-flex justify-content-end ">

                            </div>
                        </div>
                        <div class="p-con-one">
                            <div>
                                <label>Auto Send </label>
                                <select class="auto-send-select">
                                    <option value="">Free Appetizer</option>
                                    <option value="">Free Appetizer 1</option>
                                </select>
                                <label>to Customers whom have completed</label>
                                <select class="auto-send-select">
                                    <option value="">3</option>
                                    <option value="">2</option>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label>Loyalty Reward Programs Within </label>
                                <select class="auto-send-select">
                                    <option value="">3</option>
                                    <option value="">2</option>
                                </select>
                                <select class="auto-send-select">
                                    <option value="">Year</option>
                                    <option value="">2</option>
                                </select>
                                <label>
                                    Timeframe.
                                </label>
                            </div>
                        </div>
                        <div class="automatick-gimzi-content-top row">
                            <div class="col-sm-12 align-items-center d-flex justify-content-between">

                                <div><label class="progrss-incon">Birthday Gift Incentive <small>(Customer has
                                            to been
                                            signed up for at least 3 months to receive)</small></label>
                                    <label class="switch">
                                        <input type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <label class="pl-1 float-right">
                                    <span class="progrss-status-text"> Status: <span>ON</span>
                                </label>
                            </div>

                        </div>
                        <div class="p-con-one">
                            <label>Auto Send </label>
                            <select class="auto-send-select">
                                <option value="">Chips & Salsa</option>
                                <option value="">Chips & Salsa 1</option>
                            </select>
                            <label>To Customers On their birthdays </label>
                        </div>
                        <div><button class="update-button1">Update</button></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
   

    {{-- Edit Gift Manage modal --}}
    <div class="modal fade" id="Edit-Gift-manage" tabindex="-1" aria-labelledby="Edit-Gift-manageLable"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal white-modal-scroll text-left">
                    <form name="giftEditForm" id="giftEditForm" method="post" action="javascript:void(0)">
                        <div class="d-flex justify-content-between">
                            <h1>Gift Management </h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <input type="hidden" name="item_id" id="hidden_id">
                        <div class="Gimmzi-Gift-Manager ">
                            <h2>Enter the name of Item or Service Below</h2>
                            <input type="text" class="Gimmzi-Gift-Manager-input"
                                placeholder="Example: Large Drink" name="gift_name_edit" id="gift_name_edit" />
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
                                    {{-- <label>.</label> --}}
                                    {{-- <input type="text" name="value_two_edit" id="value_two_edit"
                                      class="value-input-text" /> --}}
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
                                <button type="submit" id="update_gift">Add To Database</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- program end date button click modal --}}
    <div class="modal fade merchent-main-madal" id="endDateModal" tabindex="-1" aria-labelledby="endDateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Loyalty Reward Program</h1>
                    </div>

                    <div class="row">
                        <input type="hidden" id="program_id" name="program_id">
                        <input type="hidden" id="programenddate" name="programenddate">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                            <p style="color: #fff;">If location was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>

                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one program_schedule_end_date" type="button"
                                data-id=""
                                style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                End Date</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one yes_set_program_end_date" type="button" name="stepone"
                                style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    {{-- program 'schedule end date' button click & set end date modal --}}
    <div class="modal fade merchent-main-madal" id="enddateSetModal" tabindex="-1"
        aria-labelledby="enddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to end this Loyalty Reward Program</h2>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" id="extend_type" name="extend_type">
                            <input type="hidden" id="program_id" name="program_id">
                            <div class="merchent-input">
                                <input type="text" placeholder="" id="end_date" name="end_date" class="datepicker"
                                    style="margin:10px; padding:10px;" />
                            </div>
                            <span id="enddaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="setEndDate"
                                    style="width:81%;">Set End Date</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- schedule to end  and extend date modal --}}
    <div class="modal fade merchent-main-madal" id="dateSetModal" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to extend this Loyalty Reward Program</h2>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="extend_program_id" id="extend_program_id">
                            <input type="hidden" id="extend_type" name="extend_type">
                            <div class="merchent-input">
                                <input type="text" placeholder="" id="extend_end_date" name="extend_end_date" class="datepicker"
                                    style="margin:10px; padding:10px;" />
                            </div>
                            <span id="resetdaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="setExtendDate"
                                    style="width:50%;">Extend</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    

    {{-- When user select 'Yes' but end date set after 30 days by system --}}
    <div class="modal fade merchent-main-madal" id="yesenddateSetModal" tabindex="-1"
        aria-labelledby="yesenddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;">To allow participating consumers enough notice, the earliest the program can be ended is 30 days from time of request</h3>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            <p style="font-size: 23px;color: #fff;margin-top: 22px;">Program End Date: <span id="setenddate"></span></p>

                            <input type="hidden" id="extend_type" name="extend_type">
                            <input type="hidden" id="program_id" name="program_id">
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="setSystemEndDate"
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- When user select 'Yes' but end date is present in db --}}
    <div class="modal fade merchent-main-madal" id="yesenddateExtendModal" tabindex="-1"
        aria-labelledby="yesenddateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;font-size: 25px;">This program is already set to end on [<span id="program_enddate"></span>]. If you have created this program in error or need further assistance, please reach out to 844-4GIMMZI</h3>
                        <h3 style="color:#fff;font-size: 23px;">Select Continue, if you would like to End this program</h3>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            <p style="font-size: 19px;color: #fff;margin-top: 22px;">To allow prticipating consumers enough notice, the earliest the program can be ended is 30 days from time of request</p>

                            <input type="hidden" id="extend_type" name="extend_type">
                            <input type="hidden" id="program_id" name="program_id">
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="setSystemEndDate"
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- When user select 'Yes' but set program end date --}}
    <div class="modal fade merchent-main-madal" id="yesdateSetModal" tabindex="-1"
        aria-labelledby="yesdateSetModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h3 style="color:#fff;" id="endtext"></h3>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                           

                            <input type="hidden" id="extend_type" name="extend_type">
                            <input type="hidden" id="date_id" name="date_id">
                            <div class="merchent-input">
                                <input type="hidden"  id="end_date" name="end_date"  />
                            </div>
                            <span id="enddaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" data-bs-dismiss="modal"
                                    style="width:81%;">Continue</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- view and add location modal --}}

    <div class="modal fade cmn_modal_designs gap_sec_modal1" id="location_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title new" id="program_name"></h5>
                    <button type="button" class="btn-close locationmodalclose" aria-label="Close">Close</button>
                </div>
                
                <div class="modal-body">
                <span id="showProgramEndDate">Program End Date:</span>
                    <div class="table_user_top_sec_col_lft new">
                        <h3 id="mainlocation"></h3>
                    </div>
                    <div class="table_cmn_part_sgn">
                        <input type="hidden" id="location_program_id" name="location_program_id">
                        <table>
                            <thead>
                                <tr>
                                    <th>Participating Locations</th>
                                    <th style="font-size: 13px;">Action</th>
                                    <th style="font-size: 13px;">Scheduled Remove Date</th>
                                    <th># of customers</th>
                                </tr>
                            </thead>

                            <tbody id="programlocation">

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
                                    <a href="javascript:void(0)" id="addlocationtoprogram">Add program to this
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

    {{-- click on remove location button--}}
    <div class="modal fade merchent-main-madal" id="removeLocationModal" tabindex="-1"
        aria-labelledby="removeLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">Are you sure you want to end this</h2>
                        <h1 style="color: #fff;">Loyalty Reward Program</h1>
                        <h2 style="font-size: 35px;">from this location</h2>
                    </div>

                    <div class="row">
                        <input type="hidden" id="reward_location_id" name="reward_location_id">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                            <p style="color: #fff;">If location was added in error, contact 844-4GIMMZI for assistance.
                            </p>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one location_schedule_end_date" type="button"
                                style="background-color: #DAA52B; width:100%;letter-spacing: 0.0em;font-size: 18px;">Schedule
                                Date To Remove</button>
                        </div>
                        <div class="col-sm-4 login-top-one1">
                            <button class="login-button-one location_end_date" type="button"
                                name="stepone"style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Location end date more than 30 days--}}
    <div class="modal fade merchent-main-madal" id="more30DaysLocationModal" tabindex="-1"
        aria-labelledby="removeLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 35px;">This program is already set to be removed from this location on</h2>
                        <h3 id="show_location_end_date" style="color: #fff;"></h3>
                    </div>

                    <div class="row">
                        <input type="hidden" id="reward_location_id" name="reward_location_id">
                        <div class="merchent-input">
                            <p style="color: #fff;">Note: To allow participating consumers enough notice, the earliest
                                the program can be ended in 30 days from time of request.</p>
                                <p style="color: #fff;font-size: 21px;">Select Continue, if you would like to remove this program from this location on [<span id="date_of_remove"></span>]</p>
                            <p style="color: #fff;font-size: 21px;">If you have added this location to this program in error or need further assistance, please reach out to 844-4GIMMZI. </p>
                        </div>
                        <input type="hidden" id="location_end_date">
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one " id="setLocationEndDate" type="button"
                                name="stepone"style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Program does not have end date--}}
    <div class="modal fade merchent-main-madal" id="withoutEndDateProgramModal" tabindex="-1"
        aria-labelledby="withoutEndDateProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        
                    </div>

                    <div class="row">
                        <input type="hidden" id="reward_location_id" name="reward_location_id">
                        <div class="merchent-input">
                            <p style="color: #fff;">To allow participating consumers enough notice, the earliest
                                the program can be removed from this location is 30 days from time of request.</p>
                                <p style="color: #fff;font-size: 21px;">Program Remove Date:  <span id="date_of_location_remove"></span></p>
                           
                        </div>
                        <input type="hidden" id="location_end_date">
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Cancel</button>
                        </div>
                        <div class="col-sm-6 login-top-one1">
                            <button class="login-button-one" id="setLocationEndDate" type="button"
                                name="stepone"style="width:100%;letter-spacing: 0.0em;font-size: 18px;">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- location end date schedule modal --}}
    <div class="modal fade merchent-main-madal" id="locationDateScheduleModal" tabindex="-1"
        aria-labelledby="locationDateScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to remove this Loyalty Reward Program from this location</h2>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" id="location_schedule_type" name="location_schedule_type">
                            <input type="hidden" id="rewardLocationId" name="rewardLocationId">
                            <div class="merchent-input">
                                <input type="text" placeholder="" id="schedule_date" name="schedule_date" class="datepicker"
                                    style="margin:10px; padding:10px;" />
                            </div>
                            <span id="scheduledaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone"
                                    id="setLocationScheduleEndDate" style="width:81%; letter-spacing: 0.1em;">Set Remove Date</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- location end date in extend modal --}}
    <div class="modal fade merchent-main-madal" id="locationEndDateModal" tabindex="-1"
        aria-labelledby="locationEndDateModalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Select a date to extend this Loyalty Reward Program to be available at this location</h2>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" id="location_end_type" name="location_end_type">
                            <input type="hidden" id="rewardLocationId" name="rewardLocationId">
                            <div class="merchent-input">
                                <input type="text" placeholder="" id="location_end_date_schedule" class="datepicker" name="location_end_date_schedule"
                                    style="margin:10px; padding:10px;" />
                            </div>
                            <span id="locationenddaterror"></span>

                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" id="extendLocationScheduleEndDate"
                                    style="width:81%;">Extend</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- cancel button popup --}}
    <div class="modal fade merchent-main-madal" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Are you sure you want to stop building this Loyalty Rewards Program</h2>
                    </div>
                
                        <div class="row">
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">No</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" id="cancelProgram"
                                    style="width:63%;">Yes</button>
                            </div>
                        </div>

                 
                </div>
            </div>
        </div>
    </div>



    {{-- add location less than 14 days--}}
    <div class="modal fade merchent-main-madal" id="14daysleftAddLocationModal" tabindex="-1"
        aria-labelledby="14daysleftAddLocationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2 style="font-size: 23px;">This Loyalty Rewards Program is unable to be added from this location because there are 14 days or less left before the program end date</h2>
                        <h2 style="font-size: 20px;">To add this location, first go to Manage Programs and ectend the program end date</h2>
                    </div>

                    <div class="row">
                        <input type="hidden" id="reward_location_id" name="reward_location_id">
                        <div class="merchent-input">
                            <p style="color: #fff;">If this location was added in error, contact 844-4GIMMZI for assistance.</p>
                        </div>
                        <div class="col-sm-12 login-top-one1">
                            <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                aria-label="Close"
                                style="background-color: #e61717;letter-spacing: 0.0em; width:67%;font-size: 18px;">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- message modal  -->
     <div class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="responsemsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    onclick="window.location.reload();">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>

            $(function() {
                $(".datepicker").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate: 0,
                    setdate: new Date()
                });
                $("#startOn").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                    minDate: 0,
                    setdate: new Date()
                });
                $("#endOn").datepicker({
                    dateFormat:"mm/dd/yy",
                    changeMonth:true,
                    changeYear:true,   
                });
                if (sessionStorage.getItem("openTab")) {
                    if (sessionStorage.getItem("openTab") == 'manage_program') {
                        $("#nav-home").removeClass('active');
                        $("#nav-home").removeClass('show');
                        $("#nav-profile").addClass('active');
                        $("#nav-profile").addClass('show');
                        $("#nav-profile-tab1").addClass('active');
                        $("#nav-home-tab").removeClass('active');
                        sessionStorage.removeItem("openTab");
                    }
                }
            });
            $("#nav-contact-tab").click(function() {
                $("#nav-profile").removeClass('active show');
                $("#nav-home").removeClass('active show');
            })
            $('input[type=radio]').on('click', function() {

                // console.log($("input:radio:checked").val());
                if ($("input:radio:checked").val() == 'free') {
                    $(".free_goal").css('display', 'block');
                } else {
                    $(".free_goal").css('display', 'none');
                }
                if ($("input:radio:checked").val() == 'deal_discount') {
                    $(".deal_discount_goal").css('display', 'block');
                } else {
                    $(".deal_discount_goal").css('display', 'none');
                }

            });

            function daysdifference(firstDate, secondDate) {
                var startDay = new Date(firstDate);
                var endDay = new Date(secondDate);
                // Determine the time difference between two dates     
                var millisBetween = startDay.getTime() - endDay.getTime();
                // Determine the number of days between two dates  
                var days = millisBetween / (1000 * 3600 * 24);
                // Show the final number of days between dates     
                return Math.round(Math.abs(days));
            }


            $(document).ready(function() {


                $('#filter_item').change(function() {
                    if ($(this).val() == "All") {
                        var status = $(this).val();
                        $.ajax({
                            url: "{{ route('frontend.business_owner.filterGift') }}",
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

                                        if (data[i].gift_price != '') {
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

                                        var items = '<tr>' + itemstatus +
                                            '<td>' + data[i].gift_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +
                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_gift_class"' +
                                            'data-id="' + data[i].id + '">' +
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
                            url: "{{ route('frontend.business_owner.filterGift') }}",
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
                                        if (data[i].gift_price != '') {
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

                                        var items = '<tr>' +
                                            '<td style="color: #42ac04;">Active</td>' +
                                            '<td>' + data[i].gift_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +

                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_gift_class"' +
                                            'data-id="' + data[i].id + '">' +
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
                            url: "{{ route('frontend.business_owner.filterGift') }}",
                            type: 'GET',
                            data: {
                                'status': status,

                            },
                            success: function(response) {
                                $(".merchantItemList").empty();
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
                                        if (data[i].gift_price != '') {
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

                                        var items = '<tr>' +
                                            '<td style="color: #e61717;">Inactive</td>' +
                                            '<td>' + data[i].gift_name + '</td>' +
                                            '<td>' + note + '</td>' +
                                            '<td id="valueShow">' + value + '</td>' +
                                            '<td>' +
                                            '<div class="filter-sec-manage-programs select-menu-one">' +
                                            '<select name="item"  class="select_gift_class"' +
                                            'data-id="' + data[i].id + '">' +
                                            '<option value="Edit" id="edit_item">Edit</option>' +
                                            '<option value="Re-add">Re-Add</option>' +
                                            '</select>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                        $(".merchantItemList").append(items);
                                    }

                                    //$("#demo").html(response.data); 
                                } else {
                                    $(".merchantItemList").text('No gift is there');
                                }
                            }
                        });
                    }

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
                            url: "{{ route('frontend.business_owner.addGiftValue') }}",
                            type: 'get',
                            data: {
                                'price': $(this).val(),
                                'giftid': value
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    $('#success_message').css('color', 'green').fadeIn().html(
                                        'Gift price updated successfully....');
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
                        $(".itemvalue" + value).css('display', 'none');
                        $(".add_value" + value).css('display', 'block');
                    }

                })

                $("#submit_gift").click(function(e) {
                    e.preventDefault();
                    if ($("#itemgiftid").val() == '') {
                        $("#nameerror").html('Please enter item or service name');
                    }
                    if ($("#value_two").val() != '' && $("#value_one").val() != '') {
                        var amount = $("#value_one").val() + '.' + $("#value_two").val();
                    } else if ($("#value_one").val() != '' && $("#value_two").val() == '') {
                        var amount = $("#value_one").val() + '.00';
                    } else {
                        var amount = '';
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#submit_gift').html('Please Wait...');
                    $("#submit_gift").attr("disabled", true);

                    $.ajax({
                        url: "{{ url('store-gift-management') }}",
                        type: "POST",
                        data: {
                            item_gift_id: $("#itemgiftid").val(),
                            gift_item_name: $("#gift_item_name").val(),
                            note: $("#note").val(),
                            value: amount
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                document.getElementById("giftForm").reset();
                                $('#success_message').css('color', 'green').fadeIn().html(
                                    'Gift updated successfully....');
                                setTimeout(function() {
                                    $('#success_message').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                                //location.reload();
                            } else {
                                $("#Add-Manage-Gifts").modal('show');
                            }
                        }
                    });

                });
            });


            $(document).ready(function() {
                $(".restart_program").on('click', function() {
                    // console.log('true');
                    var restart_Id = $(this).data('id');
                    // console.log(end_Id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('loyalty.restart.program') }}',
                        type: 'post',
                        data: {
                            'restart_Id': restart_Id
                        },
                        success: function(response) {
                            // alert('saved');
                            if (response.success == 1)
                                location.reload();
                        }
                    });
                });
            });

            $(document).ready(function() {
                $('.how_much').on('keyup', function() {
                    console.log($(this).val());
                    var amount = $(this).val();
                    var free = 1;
                    var total = parseInt(amount) + parseInt(free);

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
                        $("#free_item_id").val(totals);
                        $("#free_item_hidden").val(total);

                    } else {
                        $("#free_item_id").val("");
                    }
                });

                $('#item_id').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });

                $('#ditem_id').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
                $("#location_id").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });


                $(document).on('click', '.view-value', function() {
                    //$('.view-value').on('click', function() {
                    var value = $(this).data('id');
                    // alert(value);
                    // console.log(result);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.ajaxViewGiftManagement') }}',
                        type: 'get',
                        data: {
                            'value': value
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                if (response.data.price != null) {
                                    $('.view_value' + value).text("");
                                    $('.view_value' + value).text(response.data.price);
                                    // $("#valueShow").css('display','none');
                                    // console.log('ok');
                                } else {
                                    $('.view_value' + value).text("");
                                }
                            }
                            // console.log(response.data.gift_value);

                        }
                    });
                });

            });

            $(document).ready(function() {
                $('#itemgiftid').on('change', function() {
                    if ($('#itemgiftid').val() == "add_new") {
                        $("#gift_item_name").css('display', 'block');
                        // console.log('hi');
                    } else {
                        $("#gift_item_name").css('display', 'none');

                    }

                })

                $(document).on('change', '.select_gift_class', function() {
                    //$('.select_gift_class').change(function() {
                    if ($(this).val() == "Remove") {
                        var gift_remove = $(this).data('id');
                        // console.log(item_remove);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.ajaxGiftManagementRemove') }}',
                            type: 'POST',
                            data: {
                                'gift_remove': gift_remove,

                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    location.reload();
                                }
                            }
                        });

                    } else if ($(this).val() == "Re-add") {
                        var gift_readd = $(this).data('id');
                        // console.log(gift_readd);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.ajaxGiftManagementReadd') }}',
                            type: 'POST',
                            data: {
                                'gift_readd': gift_readd,

                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    location.reload();
                                }
                            }
                        });
                    } else if ($(this).val() == "Edit") {
                        var gift_edit = $(this).data('id');
                        // console.log(item_edit);
                        $.ajax({
                            url: 'ajax-gift-management-edit/' + gift_edit,
                            type: 'GET',
                            data: {
                                'gift_edit': gift_edit,

                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    $('#hidden_id').val(response.data.id);
                                    $("#Edit-Gift-manage").modal('show');
                                    $("#gift_name_edit").val(response.data.gift_name);
                                    $("#value_edit").val(response.data.gift_value);
                                    // $("#value_two_edit").val(response.data.gift_value);
                                    $("#note_edit").val(response.data.note);
                                }
                            }
                        });
                    }
                });

                ///// Start Program end date set

                $(document).on('click', '.end_program', function() {
                    $("#endDateModal").modal('show');
                    var program_id = $(this).data('id');
                    var enddate = $(this).parent().prev('td#endOn'+program_id).text();
                    $("#programenddate").val(enddate);
                    $("#program_id").val(program_id);
                });

                $(document).on('click', '.program_schedule_end_date', function() {
                    var program_id = $("#program_id").val();
                    var today = new Date();
                    today.setDate(today.getDate() + parseInt(31));
                    var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();   
                    console.log(setdate);                           
                    $(".datepicker").datepicker("option",{"minDate" : new Date(setdate)});
                    $(".datepicker").datepicker("setDate" , new Date(setdate));
                    $("#enddateSetModal").modal('show');
                    $("#program_id").val(program_id);
                    $("#extend_type").val('schedule');
                });

                $(document).on('click', '#setEndDate', function() {
                    var program_id = $('#program_id').val();
                    var end_date = $("#end_date").val();
                    // console.log(date_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.reset_end_date") }}',
                        type: 'POST',
                        data: {
                            'end_date': end_date,
                            'program_id': program_id,
                            'type': $("#extend_type").val()

                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 0) {
                                $("#enddaterror").html(response.validation_errors).css('color',
                                    'red');;
                            } else if (response.success == 1) {
                                sessionStorage.setItem("openTab", "manage_program");
                                toastr.success('End date set successfully');
                                location.reload();
                            }
                        }
                    });
                });

                $(document).on('click', '#setExtendDate', function() {
                    var program_id = $('#extend_program_id').val();
                    var extend_end_date = $("#extend_end_date").val();
                    // console.log(date_id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.reset_extend_date") }}',
                        type: 'POST',
                        data: {
                            'reset_date': extend_end_date,
                            'program_id': program_id,
                            'type': $("#extend_type").val()

                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 0) {
                                $("#resetdaterror").html(response.validation_errors).css('color',
                                    'red');
                            } else if (response.success == 1) {
                                $("#dateSetModal").hide();
                                sessionStorage.setItem("openTab", "manage_program");
                                $("#responsemsg").html('Extend date set successfully');
                                $("#message_modal").modal('show');
                            }
                            else if(response.success == 2){
                                $("#dateSetModal").hide();
                                sessionStorage.setItem("openTab", "manage_program");
                                $("#responsemsg").html('Scheduled to End Dates after the Program End Date will be changed to the new Program End Date.');
                                $("#message_modal").modal('show');
                            }
                        }
                    });

                });

                $(document).on('click', '.extend_program', function() {
                    var program_id = $(this).data('id');
                    
                    $("#dateSetModal").modal('show');
                    var enddate = $(this).parent().prev('td#endOn'+program_id).text();
                    if(enddate != null){
                        var end_date = new Date(enddate);
                        end_date.setDate(end_date.getDate() + parseInt(1));
                        var default_date = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                        $("#extend_end_date").datepicker("option","minDate" , new Date(default_date)).datepicker("setDate", new Date(default_date));
                        
                    }
                    else{
                        var end_date = new Date();
                        end_date.setDate(end_date.getDate() + parseInt(2));
                        var default_date = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                        $("#extend_end_date").datepicker("option","minDate" , new Date(default_date)).datepicker("setDate", new Date(default_date));
                    }
                   $("#extend_program_id").val(program_id);
                   $("#extend_type").val('extend');

                });

                $(document).on('click', '.yes_set_program_end_date', function() {
                    var program_id = $("#program_id").val();
                    var enddate = $("#programenddate").val();
                    console.log(enddate);
                    if(enddate == ''){
                        var today = new Date();
                        today.setDate(today.getDate() + parseInt(30));
                        var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();                              
                        $("#yesenddateSetModal").modal('show');
                        $("#setenddate").html(setdate);
                        $("#program_id").val(program_id);
                    }
                    else{
                        var end_date = new Date(enddate);
                        end_date.setDate(end_date.getDate());
                        var setdate = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();  
                        $("#yesenddateExtendModal").modal('show');
                        $("#program_enddate").html(setdate);
                        $("#program_id").val(program_id);
                        
                    }
                    
                   
                })

                // $(document).on('click', '#setEndDate', function() {
                //     var program_id = $('#program_id').val();
                //     var end_date = $("#end_date").val();
                //     // console.log(date_id);
                //     $.ajaxSetup({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         }
                //     });
                //     $.ajax({
                //         url: '{{ route("frontend.business_owner.reset_end_date") }}',
                //         type: 'POST',
                //         data: {
                //             'end_date': end_date,
                //             'program_id': program_id,
                //             'type': $("#extend_type").val()

                //         },
                //         success: function(response) {
                //             console.log(response);
                //             if (response.success == 0) {
                //                 $("#enddaterror").html(response.validation_errors).css('color',
                //                     'red');;
                //             } else if (response.success == 1) {
                //                 sessionStorage.setItem("openTab", "manage_program");
                //                 toastr.success('End date set successfully');
                //                 location.reload();
                //             }
                //         }
                //     });
                // });

                // $(document).on('click','#setSystemEndDate',function() {
                //     var program_id = $('#program_id').val();
                //     $.ajaxSetup({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         }
                //     });
                //     $.ajax({
                //         url: '{{ route("frontend.business_owner.reset_end_date") }}',
                //         type: 'POST',
                //         data: {
                //             'program_id': program_id,
                //             'type': 'enddate'

                //         },
                //         success: function(response) {
                //             if(response.success == 0){
                //                 toastr.success(response.message);
                //             }
                //             else if(response.success == 1){
                //                 sessionStorage.setItem("openTab", "manage_program");
                //                 toastr.success('End date set successfully');
                //                 location.reload();
                //             }
                //             else{
                //                 toastr.success(response.message);
                //             }
                //         }
                //     });
                // });

                $(document).on('click','.schedule_to_end',function(){
                    var program_id = $(this).data('id');
                    $('#dateSetModal').modal('show');
                    var enddate = $(this).parent().prev('td#endOn'+program_id).text();
                    if(enddate != null){
                        var end_date = new Date(enddate);
                        end_date.setDate(end_date.getDate());
                        var default_date = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                        $("#extend_end_date").datepicker("option","minDate" , new Date(default_date)).datepicker("setDate", new Date(default_date));
                        
                    }
                    else{
                        var end_date = new Date();
                        end_date.setDate(end_date.getDate());
                        var default_date = ("0" + (end_date.getMonth() + 1)).slice(-2) +'/' + end_date.getDate() + '/' + end_date.getFullYear();
                        $("#extend_end_date").datepicker("option","minDate" , new Date(default_date)).datepicker("setDate", new Date(default_date));
                    }
                   $("#extend_program_id").val(program_id);
                   $("#extend_type").val('schedule');

                })

                $(document).on('click','#setSystemEndDate',function() {
                    var program_id = $('#program_id').val();
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.reset_end_date") }}',
                        type: 'POST',
                        data: {
                            'program_id': program_id,
                            'type': 'enddate',

                        },
                        success: function(response) {
                            console.log(response);
                            if(response.success == 0){
                                toastr.error(response.message);
                            }
                            else if(response.success == 1){
                                sessionStorage.setItem("openTab", "manage_program");
                                toastr.success('End date set successfully');
                                location.reload();
                            }
                            else{
                                toastr.success(response.message);
                            }
                        }
                    });
                });


                ///// End Program end date set

                $(document).on('click', '.view_location', function() {
                    var program_id = $(this).data('id');
                    $.ajax({
                        url: '{{ route("frontend.business_owner.get_date_to_extend") }}',
                        type: 'GET',
                        data: {
                            'program_id': program_id,

                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 1) {
                                // $(window).live('scroll', function() { return false; });
                                $('body').css('top', `-${window.scrollY}px`);
                                $('body').css('position', 'fixed');
                                $("#location_modal").modal('show');
                                

                                // $('.loyality-rewards-program-sec-main').css('overflow', 'hidden');
                                //$('body').css('height', 'auto');
                                $("#program_name").html(response.data.program_name);
                                
                                $("#location_program_id").val('');
                                $("#location_program_id").val(response.data.id);
                                $("#programlocation").html('');
                                if(response.data.end_on != null) {
                                    var programenddate = new Date(response.data.end_on),
                                        programendyr = programenddate.getFullYear(),
                                        programendmonth = ("0" + (programenddate.getMonth() + 1)).slice(-2),
                                        programendday = programenddate.getDate() < 10 ? '0' + programenddate
                                        .getDate() : programenddate.getDate(),
                                        programscheduleDate = programendmonth + '/' + programendday + '/' + programendyr;
                                    $("#showProgramEndDate").html('Program End Date: '+ programscheduleDate);
                                }  
                                else{
                                    $("#showProgramEndDate").html('Program End Date: None');
                                } 
                                
                                
                                for (var x = 0; x < response.data.loyaltylocations.length; x++) {
                                    var remove_btn = '';
                                    var date = new Date(),
                                        yr = date.getFullYear(),
                                        month = ("0" + (date.getMonth() + 1)).slice(-2),
                                        day = date.getDate() < 10 ? '0' + date.getDate() : date
                                        .getDate(),
                                        todayDate = yr + '-' + month + '-' + day;
                                    var programenddate = new Date(response.data.end_on),
                                        programendyr = programenddate.getFullYear(),
                                        programendmonth = ("0" + (programenddate.getMonth() + 1)).slice(-2),
                                        programendday = programenddate.getDate() < 10 ? '0' + programenddate
                                        .getDate() : programenddate.getDate(),
                                        programscheduleDate = programendyr + '-' + programendmonth + '-' + programendday;
                                    var programsdaysdiff = daysdifference(todayDate, programscheduleDate);
                                    //console.log(programsdays);
                                    if(response.data.loyaltylocations[x].end_date != null){
                                        var locationEndDate = new Date(response.data.loyaltylocations[x].end_date),
                                        locationendyr = locationEndDate.getFullYear(),
                                        locationendmonth = ("0" + (locationEndDate.getMonth() + 1)).slice(-2),
                                        locationendday = locationEndDate.getDate() < 10 ? '0' + locationEndDate
                                        .getDate() : locationEndDate.getDate(),
                                        locationscheduleDate = locationendmonth + '/' + locationendday + '/' + locationendyr;
                                        var locationdaysdiff = daysdifference(todayDate, locationscheduleDate); 
                                    }
                                    else{
                                        var  locationscheduleDate = 'No Remove Date';
                                    }
                                    if(response.data.end_date < todayDate){
                                        var remove_btn = '';
                                    }
                                    else{
                                        if(response.data.end_on == null){ 
                                           
                                            var remove_btn =
                                            '<button class="btn_table_s blu remove_location" style="font-size: 14px!important;" data-id = "' +
                                            response.data.loyaltylocations[x].id +
                                            '">Remove Location</button>';
                                            var locationDate = '<td>'+locationscheduleDate+'</td>'
                                            
                                        }
                                        else{
                                            console.log(locationdaysdiff);
                                            if(programsdaysdiff > 30){
                                                if(response.data.loyaltylocations[x].end_date == null){
                                                    var remove_btn =
                                                    '<button class="btn_table_s blu remove_location" style="font-size: 14px!important;" data-id = "' +
                                                    response.data.loyaltylocations[x].id +
                                                    '">Remove Location</button>';
                                                    var locationDate = '<td>'+locationscheduleDate+'</td>'
                                                }
                                                else if(locationdaysdiff > 30){
                                                    var remove_btn =
                                                    '<button class="btn_table_s blu remove_location" style="font-size: 14px!important;" data-id = "' +
                                                    response.data.loyaltylocations[x].id +
                                                    '">Remove Location</button>';
                                                    var locationDate = '<td>'+locationscheduleDate+'</td>'
                                                }
                                                else if(locationdaysdiff <= 30){
                                                    var remove_btn =
                                                            '<button class="btn_table_s rdd scheduled_remove_location" style="font-size: 12px;padding: 14px;" data-id = "' +
                                                            response.data.loyaltylocations[x].id +
                                                            '">Scheduled to Remove</button>';
                                                    var locationDate = '<td style="color:red;">'+locationscheduleDate+'</td>'
                                                }
                                                else{
                                                    var remove_btn =
                                                    '<button class="btn_table_s blu remove_location" style="font-size: 14px!important;" data-id = "' +
                                                    response.data.loyaltylocations[x].id +
                                                    '">Remove Location</button>';
                                                    var locationDate = '<td>'+locationscheduleDate+'</td>'
                                                }
                                                
                                                
                                            }
                                            else if(programsdaysdiff  == 30){
                                                var remove_btn =
                                                            '<button class="btn_table_s rdd scheduled_remove_location" style="font-size: 12px;padding: 14px;" data-id = "' +
                                                            response.data.loyaltylocations[x].id +
                                                            '">Scheduled to Remove</button>';
                                                var locationDate = '<td style="color:red;">'+locationscheduleDate+'</td>'
                                            }
                                            
                                            else if(programsdaysdiff < 30){
                                                if(response.data.loyaltylocations[x].end_date == null){
                                                    var remove_btn =
                                                            '<button class="btn_table_s rdd scheduled_remove_location" style="font-size: 12px;padding: 14px;" data-id = "' +
                                                            response.data.loyaltylocations[x].id +
                                                            '">Scheduled to Remove</button>';
                                                    var locationDate = '<td style="color:red;">'+locationscheduleDate+'</td>'
                                                }
                                                else if(locationdaysdiff < 30){
                                                    var remove_btn =
                                                            '<button class="btn_table_s rdd scheduled_remove_location" style="font-size: 12px;padding: 14px;" data-id = "' +
                                                            response.data.loyaltylocations[x].id +
                                                            '">Scheduled to Remove</button>';
                                                    var locationDate = '<td style="color:red;">'+locationscheduleDate+'</td>'
                                                }
                                                else{
                                                    var remove_btn =
                                                            '<button class="btn_table_s rdd scheduled_remove_location" style="font-size: 12px;padding: 14px;" data-id = "' +
                                                            response.data.loyaltylocations[x].id +
                                                            '">Scheduled to Remove</button>';
                                                    var locationDate = '<td style="color:red;">'+locationscheduleDate+'</td>'
                                                }
                                                
                                            }
                                               
                                        }
                                        
                                    }
                                    if(remove_btn != ''){
                                        //console.log('123');
                                        var locationdata = '<tr>' +
                                            '<td>' + response.data.loyaltylocations[x].locations
                                            .location_name + '</td>' +
                                            '<td>' + remove_btn + '</td>' +
                                            locationDate +
                                            '<td>0</td>' +
                                            '</tr>';
                                        $("#programlocation").append(locationdata);
                                    }
                                }

                                if (response.other_location.length > 0) {
                                    $('#business_location').html(
                                        '<option value = "">Choose Location </option>');
                                    for (var i = 0; i < response.other_location.length; i++) {
                                        var locations = '<option value="' + response.other_location[
                                                i].id + '">' + response.other_location[i]
                                            .location_name + '</option>';
                                        $("#business_location").append(locations);
                                    }
                                } else {
                                    $('#business_location').html(
                                        '<option value = "">No Location is there</option>');
                                }
                            }
                        }
                    });
                });

                $(document).on('click','.locationmodalclose',function(){
                    const scrollY = document.body.style.top;
                    document.body.style.position = '';
                    document.body.style.top = '';
                    window.scrollTo(0, parseInt(scrollY || '0') * -1);
                    $('#location_modal').modal('hide');
                })

                $(document).on('click', '#addlocationtoprogram', function() {
                    var program_id = $("#location_program_id").val();
                    var location_id = $("#business_location").val();
                    $.ajax({
                        url: '{{ route("frontend.business_owner.add_location_to_program") }}',
                        type: 'GET',
                        data: {
                            'location_id': location_id,
                            'program_id': program_id

                        },
                        success: function(response) {
                            if (response.success == 1) {
                                toastr.success('Location added to this program successfully');
                                // console.log(response.data);
                                var addedLocation = '<tr>' +
                                    '<td>' + response.data.locations.location_name + '</td>' +
                                    '<td><button class="btn_table_s blu remove_location" data-id = "' +
                                    response.data.id + '">Remove Location</button></td>' +
                                    '<td>0</td>' +
                                    '</tr>';
                                $("#programlocation").append(addedLocation);
                                $("#business_location").val('');
                            } else if (response.success == 0) {
                                $("#14daysleftAddLocationModal").modal('show');
                            } else if (response.success == 2) {
                                toastr.error('Program not found');
                            } else if (response.success == 3) {
                                toastr.error('Location not found');
                            }
                        }

                    });
                });

                $(document).on('click', '.remove_location', function() {
                    var rwardlocationid = $(this).data('id');
                    $("#reward_location_id").val(rwardlocationid);
                    $("#removeLocationModal").modal('show');

                });

                $(document).on('click', '.location_schedule_end_date', function() {

                    var today = new Date();
                    today.setDate(today.getDate() + parseInt(31));
                    var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();                              
                    $("#schedule_date").datepicker("option",{"minDate" : new Date(setdate)});
                    $("#schedule_date").datepicker("setDate" , new Date(setdate));
                    $('#locationDateScheduleModal').modal('show');
                    var reward_location_id = $("#reward_location_id").val();
                    $('#rewardLocationId').val(reward_location_id);
                    $("#location_schedule_type").val('location_schedule');
                });

                $(document).on('click', '#setLocationScheduleEndDate', function() {
                    var reward_location_id = $('#rewardLocationId').val();
                    var schedule_date = $('#schedule_date').val();
                    var type = $("#location_schedule_type").val();
                    console.log(type);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.schedule_location_end_date") }}',
                        type: 'POST',
                        data: {
                            'reward_location_id': reward_location_id,
                            'type': type,
                            'end_date': schedule_date
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 0) {
                                $("#scheduledaterror").html(response.validation_errors).css('color',
                                    'red');
                            } else if (response.success == 1) {
                                sessionStorage.setItem("openTab", "manage_program");
                                toastr.success('Reward location end date set successfully');
                                location.reload();
                            }
                        }
                    });
                });
                $(document).on('click', '.location_end_date', function() {
                    var reward_location_id = $("#reward_location_id").val();
                    var today = new Date();
                    today.setDate(today.getDate() + parseInt(30));
                    var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();                              
                    
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.get_program_from_locationid") }}',
                        type: 'POST',
                        data: {
                            'location_id': reward_location_id,
                        },
                        success: function(response) {
                            if(response.status == 1){
                                $("#reward_location_id").val(reward_location_id);
                                $("#show_location_end_date").html(response.data);
                                $("#date_of_remove").html(setdate);
                                $("#location_end_date").val(setdate);
                                $("#more30DaysLocationModal").modal('show');
                            }
                            else if(response.status == 2){
                                $("#reward_location_id").val(reward_location_id);
                                $("#date_of_location_remove").html(setdate);
                                $("#location_end_date").val(setdate);
                                $("#withoutEndDateProgramModal").modal('show');
                            }
                        }
                    });
                });

               

                $(document).on('click', '#setLocationEndDate', function() {
                    var reward_location_id = $('#reward_location_id').val();
                    var end_date = $('#location_end_date').val();
                    var type = 'location_end';
                    //    console.log(type);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.business_owner.reset_location_end_date") }}',
                        type: 'POST',
                        data: {
                            'reward_location_id': reward_location_id,
                            'type': type,
                            'end_date': end_date
                        },
                        success: function(response) {
                            if (response.success == 0) {
                                $("#locationenddaterror").html(response.validation_errors).css(
                                    'color', 'red');
                            } else if (response.success == 1) {
                                sessionStorage.setItem("openTab", "manage_program");
                                toastr.success('Reward location end date set successfully');
                                location.reload();
                            }
                        }
                    });
                });
            });

            $(document).on('click','.scheduled_remove_location',function(){
                var reward_location_id = $(this).data('id');
                var locationenddate = $(this).parent().next('td').text();
                console.log(locationenddate);
                $("#locationEndDateModal").modal('show');
                $("#location_end_type").val('location_schedule');
                $("#rewardLocationId").val(reward_location_id);
                    if(locationenddate != 'None'){
                        var location_end_date = new Date(locationenddate);
                        location_end_date.setDate(location_end_date.getDate());
                        var default_date = ("0" + (location_end_date.getMonth() + 1)).slice(-2) +'/' + location_end_date.getDate() + '/' + location_end_date.getFullYear();
                        $("#location_end_date_schedule").datepicker("option","minDate" , new Date(default_date)).datepicker("setDate", new Date(default_date));
                    }
                    else{
                        var today = new Date();
                        today.setDate(today.getDate());
                        var setdate = ("0" + (today.getMonth() + 1)).slice(-2) +'/' + today.getDate() + '/' + today.getFullYear();                              
                        $("#location_end_date_schedule").datepicker("option",{"minDate" : new Date(setdate)});
                        $("#location_end_date_schedule").datepicker("setDate" , new Date(setdate));
                        
                    }
                    
            });

            $(document).on('click','#extendLocationScheduleEndDate',function(){
                var reward_location_id = $("#rewardLocationId").val();
                var location_end_type = $("#location_end_type").val();
                var end_date = $("#location_end_date_schedule").val();
                //console.log(location_end_type);
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                $.ajax({
                    url: '{{ route("frontend.business_owner.reset_location_end_date") }}',
                    type: 'POST',
                    data: {
                        'reward_location_id': reward_location_id,
                        'type': location_end_type,
                        'end_date': end_date
                    },
                    success: function(response) {
                        if (response.success == 0) {
                            $("#locationenddaterror").html(response.validation_errors).css(
                                'color', 'red');
                        } else if (response.success == 1) {
                            sessionStorage.setItem("openTab", "manage_program");
                            toastr.success('Reward location end date set successfully');
                            location.reload();
                        }
                    }
                });
            })

            $(document).ready(function() {
                $("#update_gift").click(function(e) {
                    // console.log('hi');
                    e.preventDefault();

                    if ($("#gift_name_edit").val() == '') {
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
                    $('#update_gift').html('Please Wait...');
                    $("#update_gift").attr("disabled", true);

                    $.ajax({
                        url: 'ajax-gift-management-update/' + id,
                        type: "POST",
                        data: {
                            gift_name: $("#gift_name_edit").val(),
                            note: $("#note_edit").val(),
                            id: id,
                            value: $("#value_edit").val(),
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                document.getElementById("giftEditForm").reset();
                                $('#success_message_edit').css('color', 'green').fadeIn().html(
                                    'Gift updated successfully....');
                                setTimeout(function() {
                                    $('#success_message_edit').fadeOut("slow");
                                    location.reload();
                                }, 2000);
                                //location.reload();
                            } else {
                                $("#Add-Manage-Gifts").modal('show');
                            }
                        }
                    });
                });

                $(document).on('change', '#main_location', function() {
                    var location_id = $(this).val();
                    //  console.log(location_id);
                    $.ajax({
                        url: '{{ route('frontend.business_owner.loyalty_merchant_business_location') }}',
                        type: 'GET',
                        data: {
                            'location_id': location_id
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                $('#change_address').html('');
                                $('#change_email').html('');
                                $('#change_phone').html('');
                                var address = response.data.address + ',' + response.data.city +
                                    ',' + response.data.states.name + ',' + response.data.zip_code;
                                $('#change_address').append(address);
                                var email = response.data.business_email;
                                $('#change_email').html(email);
                                var phone = response.data.business_phone;
                                $('#change_phone').html(phone);
                            }

                        }
                    });
                });

                $(document).on('click','.cancelCreateProgram',function(){
                    $("#cancelModal").modal('show');
                });

                $(document).on('click','#cancelProgram',function(){
                    var url = "{{route('frontend.business_owner.account')}}";
                    window.location = url;
                });

                $(document).on('click','.check_no_checkbox',function(){
                    if($(".check_no_checkbox").is(':checked')){
                        $(".enddatesection").hide();
                    }
                    else{
                        if($("#startOn").val() != ''){
                            var startdate = new Date($("#startOn").val());
                            startdate.setDate(startdate.getDate() + parseInt(45));
                            var setdate = ("0" + (startdate.getMonth() + 1)).slice(-2) +'/' + startdate.getDate() + '/' + startdate.getFullYear();                              
                            $("#endOn").datepicker("option",{"minDate" : new Date(setdate)});
                            $("#endOn").datepicker("setDate" , new Date(setdate));
                            $(".enddatesection").show();
                        }
                        else{
                            $(".check_no_checkbox").prop('checked','checked');
                            toastr.error('At first you have to select start date');
                            $(".enddatesection").hide();
                        }
                            
                    }
                    
                })
            });
        </script>
    @endpush
</x-layouts.frontend-layout>
