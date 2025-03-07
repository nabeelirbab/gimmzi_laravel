<div>
    @push('style')
    <style>
        .event a {
            background: #005704 !important;
            color: #f7f0f0 !important;
        }

        .eventrange a {
            background: #d35858 !important;
            color: #f7f0f0 !important;
        }

        .ui-state-default {
            background: #0c9200 !important;
            color: #f7f0f0 !important;
        }
        /* .saveleasebutton{
            display: none;
        }
        .guest_tr th{
                position: sticky;
                top: 0;
                background: #fff;
        } */
       
    </style>
    @endpush

    <div class="all-smart-rental-database-main-sec show-filled-units-only smart-badges">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <figure>
                            <img src="{{ asset('frontend_assets/images/rental-home-icon-1.svg') }}" alt="" />
                        </figure>
                    </div>
                   
                    <div class="right-sec-rental">
                        <h3><span
                                id="change_first">{{$user->travelType->name}}</span>
                            {{-- <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" />
                                </button>
                            </span> --}} 
                        </h3>

                        <div class="apartments-sec">
                            <ul>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt="" /></span>Address:
                                            <span class="points-distributed-txt"><label
                                                    id="property_address">{{$user->travelType->address}}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span>Mail:<span
                                                class="points-distributed-txt">{{ $user->email }}</span>
                                        </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/star-icon-rental.svg') }}"
                                                    alt="" /></span>Total Points to Distribute:
                                            <span class="points-distributed-txt-new"
                                                id="distributePoint">{{number_format($user->travelType->points_to_distribute)}}
                                                Points</span>
                                        </h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 my-auto">
                        <div class="d-flex flex-wrap align-items-center">
                            <div class="new_col_wrp">
                                <div class="new_col">
                                    <label>Select Building</label>
                                    <select wire:model.live='select_building' wire:click="blankUnit">
                                        <option value="all">Select Building</option>
                                        @if($buldingList)
                                            @foreach ($buldingList as $building_data)
                                                <option value="{{$building_data->id}}">{{$building_data->building_name}}&nbsp;&nbsp;({{$building_data->buildingunits->count()}} units)</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                {{-- <div class="new_col enterunit">
                                    <label>Enter Unit Number</label>
                                    <div class="enterunit_dropdown_parent">
                                        <input type="text" placeholder="Start typing to search units"  wire:model.defer="search_text" wire:keyup="searchResult">
                                        @if($showdiv)
                                        <ul style="z-index: 999;">
                                            @if(!empty($result))
                                            @foreach($result as $result_data)
    
                                            <li wire:click="getUnit({{ $result_data->id }})">{{
                                                $result_data->unit_name}}</li>
    
                                            @endforeach
                                            @endif
                                        </ul>
                                        @endif
                                    </div>
                                </div> --}}

                                <div class="new_col enterunit">
                                    <label>Enter Unit Number</label>
                                    <div class="enterunit_dropdown_parent">
                                        <input type="text" placeholder="Start typing to search units" wire:model.defer="search_text" wire:keyup="searchResult">
                                        @if($showdiv)
                                        <ul style="z-index: 999; max-height: 200px; overflow-y: auto;">
                                            @if(!empty($result))
                                            @foreach($result as $result_data)
                                            <li wire:click="getUnit({{ $result_data->id }})">{{ $result_data->unit_name }}</li>
                                            @endforeach
                                            @endif
                                        </ul>
                                        @endif
                                    </div>
                                </div>
                                

                                <div class="new_col">
                                    <a href="#" id="clear_list_data" class="clear_list_data">
                                        <h5 style="color: rgb(35, 111, 155);"><u>Clear search results</u></h5>
                                      </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex justify-content-end align-items-center filter-main">
                            <select class="form-select" aria-label="Default select example"
                                wire:click='badgeFilter($event.target.value)'>
                                <option disabled>Filter</option>
                                <option value="ALL" >All</option>
                                <option value="ACTIVE" selected>Active</option>
                                <option value="INACTIVE">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 smart-rentel-db" id="ajaxrentaldbtable">
                        <div class="scroll_table smart-badge-table">
                            <table class="table table-striped table-hover" style="position: relative;">
                                <thead>
                                    <tr class="guest_tr"> 
                                        <th scope="col"></th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Building</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Check In Date</th>
                                        <th scope="col">Check Out Date</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">Badge Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @if(@$units)
                                        <?php //echo "<pre>"; print_r($units); die();?>
                                            @foreach($units as $unit_data) 
                                                <tr>
                                                    <td></td>
                                                    {{-- <td><input class="form-check-input" name="select" wire:click='getBadgeDetail({{$unit_data['id']}},"unit")'  type="radio" /></td> --}}
                                                    <td><a href="javascript:void(0);" wire:click='HotelBadgeModal({{$unit_data['id']}})' class="pupUp_modal">Open</a></td>

                                                    <td>{{ $unit_data['unitbuildings']['building_name']}}</td>

                                                    <td>{{ $unit_data['unit_name']}}</td>
                                                    
                                                    <td>---</td>
                                                    
                                                    <td>---</td>
                                                    
                                                    <td>---</td>

                                                    <td>---</td>

                                                </tr>
                                                {{-- @dd($unit_data) --}}
                                                @if(count($unit_data['unitbadges']) > 0)
                                                    @foreach ($unit_data['unitbadges'] as $badge_data)
                                                        @if(count($badge_data['badgesguest']) > 0)
                                                            @foreach($badge_data['badgesguest'] as $key => $guest)
                                                                <tr>
                                                                    <td><input class="form-check-input" wire:click='getBadgeDetail({{$guest['id']}},"guest")' name="select"  type="radio" /></td>
                                                                    @if($guest['user_id'] != null)
                                                                        <td>{{$guest['user']['first_name']}} {{$guest['user']['last_name']}}</td>
                                                                    @else
                                                                        <td>{{$guest['guest_email']}}</td>
                                                                    @endif

                                                                    <td>{{ $unit_data['unitbuildings']['building_name']}}</td>

                                                                    <td>{{ $unit_data['unit_name']}}</td>

                                                                    <?php $start_date = date_format(date_create($badge_data['start_date']),'m-d-Y');?>
                                                                    <td>
                                                                        <a wire:click.prevent="NewselectBadge({{ $badge_data['id'] }})" style="cursor: pointer;">
                                                                        {{ $start_date }}
                                                                        </a>
                                                                    </td>
                                                                    {{-- <td>{{ $start_date}}</td> --}}
                                                                    <?php 
                                                                    $today = date('Y-m-d');
                                                                    $date1=date_create($today);
                                                                    $date2=date_create($badge_data['end_date']);
                                                                    $diff=date_diff($date1,$date2);
                                                                    $duration = $diff->format("%a");
                                                                    
                                                                    $end_date = date_format(date_create($badge_data['end_date']),'m-d-Y');
                                                                        ?>
                                                                    {{-- <input type="radio" name="table-radio"
                                                                    wire:click="selectBadge({{ $badge_data['id'] }})"> --}}
                                                                    
                                                                    <td>{{ $end_date}}</td>
                                                                    

                                                                    @if($guest['user_id'] != null)
                                                                        @if($guest['status'] == 1)
                                                                            <td>{{$guest['user']['point']}}</td>  
                                                                        @else
                                                                            <td>---</td>  
                                                                        @endif
                                                                    @else
                                                                        <td>---</td>
                                                                    @endif
                                                                    
                                                                    @if($guest['status'] == 1)
                                                                        <td><span style="color: green">Accepted</span></td>
                                                                    @else
                                                                        <td>Badge sent by {{ auth()->user()->first_name }} on
                                                                            {{ date('m-d-Y', strtotime($guest['created_at'])) }}
                                                                        </td>

                                                                        <td class="badge-cancel-td"><a
                                                                                href="javascript:void(0);"
                                                                                class="badge-cancel"
                                                                                wire:click="cancelBadgeRequest({{ $guest['id'] }})"
                                                                                style="color: red">Cancel</a></td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td><input class="form-check-input" name="select" wire:click='getBadgeDetail({{$badge_data['id']}},"badge")'  type="radio" /></td>
                                                                <td>N/A</td>

                                                                <td>{{ $unit_data['unitbuildings']['building_name']}}</td>

                                                                <td>{{ $unit_data['unit_name']}}</td>
                                                                <?php $start_date = date_format(date_create($badge_data['start_date']),'m-d-Y');?>
                                                                <td>
                                                                    <a wire:click.prevent="NewselectBadge({{ $badge_data['id'] }})" style="cursor: pointer;">
                                                                        {{ $start_date }}
                                                                    </a>
                                                                </td>
                                                                <?php 
                                                                $today = date('Y-m-d');
                                                                $date1=date_create($today);
                                                                $date2=date_create($badge_data['end_date']);
                                                                $diff=date_diff($date1,$date2);
                                                                $duration = $diff->format("%a");
                                                                
                                                                $end_date = date_format(date_create($badge_data['end_date']),'m-d-Y');
                                                                    ?>
                                                                <td>{{$end_date}}</td>
                                                                
                                                                <td>---</td>

                                                                <td>---</td>

                                                            </tr>  
                                                        @endif
                                                    @endforeach
                                                @else
                                                @endif
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7" style="text-align: center;">No Data Found</td>
                                        </tr>
                                        @endif
                                        
                                    </tbody>
                               
                            </table>
                        </div>
                        <div class="vacation_page_next_prev_btn">
                            {{ $units->links() }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="btn_area_section" style="padding: 14px 20px;min-height: 1px;">
                            <span> Action </span>
                            {{-- <button type="button" class="btn sky_btn" wire:click.prevent='addBadgeTerm'>Add term</button> --}} 
                            <button type="button" class="btn red_btn" wire:click="deactivateBadge" >Deactivate Badge</button>
                            <button type="button" class="btn green_btn" wire:click.prevent='resendBadge' >Resend Badge</button>
                            <button type="button" class="btn sky_btn add_term" wire:click="addPoint"
                                >Add Points</button>
                            <button class="btn yellow_btn view_profile"  id="guestRecogBtn"
                                wire:click="guestRecognition">Guest Recognition</button>
                            <button class="btn sky_btn" wire:click='scheduledBadge'>Scheduled Badges</button>

                            <button class="btn purple_btn" wire:click='viewconsumerProfile'>View profile</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      

        <!-- scheduled badges start modal -->
        <div>
        <div wire:ignore.self class="modal scheduled_badges_modal fade" id="schedulemodal" tabindex="-1" aria-labelledby="schedulemodal" aria-hidden="true" style="padding-right: 15px; ">
            <div class="modal-dialog">
                <div class="modal-content" style="width: 113%;">
                    <div class="modal-body scheduled_badges_inner_wpr" style=" padding: 0!important;">
                        <div class="scheduled_badges_header">
                            <div class="scheduled_badges_popup_left">
                                <a class="scheduled_badges_btn" href="javascript:void(0);" data-bs-toggle="modal"
                                    data-bs-target="#schedulemodal"><img
                                        src="{{ asset('frontend_assets/images/calender-time.svg') }}" alt="">
                                    Scheduled Badges</a>
                            </div>
                            <div class="scheduled_badges_date">
                                @if ($month > $current_month)
                                    {{-- @if ($year >= $current_year) --}}
                                    <a class="date_prev date_arow" href="javascript:void(0);"
                                        wire:click="changeMonth('min')"><img
                                            src="{{ asset('frontend_assets/images/prev-arrow.svg') }}"
                                            alt=""></a>
                                    {{-- @endif --}}
                                @elseif ($year > $current_year)
                                    <a class="date_prev date_arow" href="javascript:void(0);"
                                        wire:click="changeMonth('min')"><img
                                            src="{{ asset('frontend_assets/images/prev-arrow.svg') }}"
                                            alt=""></a>
                                @endif
                                <p>{{ $monthyear }}</p>

                                <a class="date_next date_arow" href="javascript:void(0);"
                                    wire:click="changeMonth('max')"><img
                                        src="{{ asset('frontend_assets/images/next-arrow.svg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="scheduled_badges_modal_searchbar">
                            <form>
                                <input type="text"
                                    style="width: 60%;
                                        height: 40px;
                                        border-color: #26a7df;"
                                    placeholder="Type to search for unit name" wire:model.defer="search_name"
                                    wire:keyup="searchUnit">
                            </form>
                            <div class="selectedbadgelisting">
                                @if ($showdiv)
                                    <ul>
                                        @if (!empty($unit_result))
                                            @foreach ($unit_result as $result_data)
                                                <li wire:click="selectunit({{ $result_data->id }})">
                                                    {{ $result_data->unit_name }}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="scheduled_badges_table">
                            <table>
                                <thead> 
                                    <tr>
                                        
                                        <th style="width:24%;">Unit Name</th>
                                        <th>Building Name</th>
                                        <th>Check In - Check Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($monthly_scheduled) > 0)
                                    <?php //echo"<pre>"; print_r($monthly_scheduled);?>
                                        @foreach ($monthly_scheduled as $monthly_value)
                                            @foreach ($monthly_value as $badgeValue)
                                                <tr>
                                                    <td>
                                                        <div class="scheduled_badges_radio">
                                                            <label>
                                                                <input type="radio" name="table-radio"
                                                                    wire:click="selectBadge({{ $badgeValue['id'] }})">
                                                                {{-- <span>{{ $badgeValue['unites']['unitbuildings']['building_name'] }}</span> --}}
                                                                <span>{{ $badgeValue['unites']['unit_name']}}</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    {{-- <td>{{ $badgeValue['unites']['unit_name']}}</td> --}}
                                                    <td>{{ $badgeValue['unites']['unitbuildings']['building_name'] }}</td>
                                                    <?php $in_date = date_format(date_create($badgeValue['start_date']), 'm/d/Y'); ?>
                                                    <?php $out_date = date_format(date_create($badgeValue['end_date']), 'm/d/Y'); ?>
                                                    <td>
                                                        {{ $in_date }} - {{ $out_date }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <div class="scheduled_badges_radio">
                                                    <label>
                                                        <span>There is no scheduled badges</span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        {{-- @dd($monthly_scheduled); --}}
                        @if (count($monthly_scheduled) > 0)
                            <div class="scheduled_badges_modal_button">
                                <a class="page-btn page-btn-green-peas" href="javascript:void(0);"
                                    wire:click="show_selected_badge">Select</a>
                                {{-- <a class="page-btn page-btn-red" href="javascript:void(0);"
                                    wire:click="closebadgePopup">Cancel</a> --}}
                                <a class="page-btn page-btn-red closeScheduledbadgePopup" href="javascript:void(0);">Cancel</a>
                                    
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- scheduled badges end modal -->
         {{-- Success popup --}}
         <div wire:ignore.self  data-bs-backdrop = 'static' class="modal fade cmn_modal_designs gap_sec_modal2" id="clear_date_success_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="date_success_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='closeSuccessModal' >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Success popup --}}

        <!-- selected badge show popup start modal -->
        <div wire:ignore.self class="modal dolphing_cove_modal fade" id="selectedScheduleModal" tabindex="-1" aria-labelledby="selectedSchedule" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- @dd($badge) --}}
                        {{-- @if ($badge) --}}
                            <h3 class="dolphincove_modal_title">{{ $unitName}} Badges</h3>
                        {{-- @endif --}}
                        <a href="javascript:void(0);" class="refresh-btn" wire:click="refreshForm"><img
                                src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt=""> Refresh</a>
                                {{-- <a href="javascript:void(0);" class="refresh-btn" ><img
                                    src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt=""> Refresh</a> --}}
                    </div>
                    <div class="modal-body">
                        <div class="dolphing_cove_form">
                            <form>
                                <div class="row dolphin_row">
                                    <div class="col-lg-6 dolphin_column input-date">
                                        <label>*Check-In</label>
                                        <input type="text" class="checkinDatePicker" wire:model="checkin_date"
                                        style="background-color: #e8e8e8;" disabled >
                                    </div>
                                    <div class="col-lg-6 dolphin_column input-date" wire:ignore>
                                        <label>*Check-Out</label>
                                        <input type="text" class="checkoutDatePicker" wire:model="checkout_date"
                                        style="background-color: #e8e8e8;" disabled >
                                    </div>
                                </div>
                                <div class="dolphin-outer-wraper">
                                    <div class="dolphin-cus-row">
                                        <div class="dolphin_column_left">
                                            <div class="dolphin_column_left_inner">
                                                <h4 class="dolphin_sub_title">Email Address <span
                                                        class="guest_count">({{ $guest_count }}/{{ $listing_guests }})</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="dolphin_column_right">
                                            <div class="dolphin_column_left_inner">
                                                <h4 class="dolphin_sub_title">Badge Statuses</h4>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    @if (count($guests) > 0)
                                        @foreach ($guests as $key => $value)
                                            <div class="dolphin-cus-row">
                                                <div class="dolphin_column_left">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input">
                                                            @if ($value->status == 1)
                                                                <?php $parts = explode('.', $value->guest_email);
                                                                $username = $parts[0];?>
                                                                <span>{{ substr($username, 0, 1) . str_repeat('*', strlen($username) - 0) . '.' . $parts[1] }}</span>
                                                                
                                                            @else
                                                            
                                                                <span>{{ $value->guest_email }}</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dolphin_column_right{{ $key }}">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input" style="margin-left: 28px;">
                                                            @if ($value->status == 0 && $value->is_resend == 1)
                                                                <span class="sky-text">Resent on
                                                                    {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                            @elseif($value->status == 0)
                                                                <span class="sky-text">Invite Sent</span>
                                                            @elseif($value->status == 1)
                                                                <span class="text-green">Badge Activated</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    
                                   
                                    @if ($remaining_count > 0)
                                        @for ($i = 1; $i <= $remaining_count; $i++)
                                            <div class="dolphin-cus-row">
                                                <div class="dolphin_column_left">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input" x-data="{ isOpen: false }">
                                                            <?php
                                                                $today = date('Y-m-d');
                                                            ?>
                                                            @if($today < $badge_checkout_date)
                                                                <input type="text" @keyup.tab="getEmail()"
                                                                wire:model.defer="email_addresses.{{ $i }}"
                                                                wire:keydown.enter="checkEmail"> 
                                                            @else
                                                                <input type="text" style="background-color: #e8e8e8;" @keyup.tab="getEmail()"
                                                                wire:model.defer="email_addresses.{{ $i }}"
                                                                wire:keydown.enter="checkEmail" disabled>
                                                            @endif 
                                                            {{-- <a class="common-found" href="#url" data-bs-toggle="modal" data-bs-target="#MemberFound">asdf</a> --}}
                                                        </div>
                                                        {{-- @dd($errors) --}}
                                                        @if ($errors->has('email_addresses.{{ $i }}'))
                                                            <span class="invalid-message" role="alert"
                                                                style="font-size: 12px; color:red;">
                                                                {{ $errors->first('email_addresses') }}
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <div class="dolphin_column_right{{ $i }}"
                                                style="display:none;">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input" style="margin-left: 39px;">
                                                        <span class="sky-text">Invite Sent</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                        wire:click="sendSelectedBadge">Send Badge</button>
                    {{-- <a class="page-btn page-btn-red closeSelectedBadge" href="javascript:void(0);"
                        wire:click="closeSelectedBadge">Close</a> --}}
                    <a class="page-btn page-btn-red closeSelectedBadge" href="javascript:void(0);"
                       >Close</a>
                    <a class="page-btn page-btn-blue" href="javascript:void(0);" wire:click="clearBadgeDates"> Clear
                        Dates</a>
                        {{-- <a class="page-btn page-btn-blue" href="javascript:void(0);" >Clear
                            Dates</a> --}}
                </div>
                <div class="row">
                    {{-- <span style="text-align: center;margin-top: 20px;">Use<a wire:click="resendBadge"
                            style="color: blue;" href="javascript:void(0);"> Resend </a>to resend badge invites</span> --}}
                            <span style="text-align: center;margin-top: 20px;">Use<a wire:click="resendBadge"
                                style="color: blue;" href="javascript:void(0);"> Resend </a>to resend badge invites</span>
                </div>

            </div>
        </div>
        </div>
    
        <!--selected badge show popup end modal -->

        <!-- new_unit_badge_modal badge popup modal -->
        <div wire:ignore.self data-bs-backdrop = 'static' keyboard = "false" class="modal dolphing_cove_modal fade"
            id="new_unit_badge_modal" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="dolphincove_modal_title" wire:ignore></h3>
                        <a href="javascript:void(0);" class="refresh-btn" wire:click="badgesRefreshForm"><img
                                src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt="">
                            Refresh</a>
                            {{-- <a href="javascript:void(0);" class="refresh-btn" ><img
                                src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt="">
                            Refresh</a> --}}
                    </div>
                        <div class="modal-body">
                            <div class="dolphing_cove_form">
                                <form>
                                    <div class="row dolphin_row">
                                        <div class="col-lg-6 dolphin_column input-date" wire:ignore>
                                            <label>*Check-In</label>
                                            <input type="text" class="checkinDatePicker" wire:model="checkin_date">
                                        </div>
                                        <div class="col-lg-6 dolphin_column input-date" wire:ignore>
                                            <label>*Check-Out</label>
                                            <input type="text" class="checkoutDatePicker" wire:model="checkout_date">
                                        </div>
                                    </div>
                                    <div class="dolphin-outer-wraper">
                                        <div class="dolphin-cus-row">
                                            <div class="dolphin_column_left">
                                                <div class="dolphin_column_left_inner">
                                                    <h4 class="dolphin_sub_title"> Email Address <span class="guest_count"
                                                            wire:ignore></span></h4>
                                                </div>
                                            </div>
                                            <div class="dolphin_column_right">
                                                <div class="dolphin_column_left_inner">
                                                    <h4 class="dolphin_sub_title">Badge Statuses</h4>
                                                </div>
                                            </div>
                                        </div>
                                        @if (count($guests) > 0)
                                            @foreach ($guests as $key => $value)
                                                <div class="dolphin-cus-row">
                                                    <div class="dolphin_column_left">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input" style="margin-left: 22px;">
                                                                @if ($value->badge_status == 1)
                                                                    <?php $parts = explode('.', $value->guest_email);
                                                                    $username = $parts[0]; ?>
                                                                    <span>{{ substr($username, 0, 1) . str_repeat('*', strlen($username) - 0) . '.' . $parts[1] }}</span>
                                                                @else
                                                                    <span>{{ $value->guest_email }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dolphin_column_right{{ $key }}">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input" style="margin-left: 39px;">
                                                                @if ($value->badge_status == 0)
                                                                    <span class="sky-text">Invite Sent</span>
                                                                @elseif($value->badge_status == 1)
                                                                    <span class="text-green">Badge Activated</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                      
                                        @elseif($listing_guests > 0)
                                            @for ($i = 1; $i <= $listing_guests; $i++)
                                                <div class="dolphin-cus-row">
                                                    <div class="dolphin_column_left">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input" x-data="{ isOpen: false }">
                                                                
                                                                    <input type="text" @keyup.tab="getEmail()"
                                                                    wire:model.defer="email_addresses.{{ $i }}"
                                                                    wire:keydown.enter="checkEmail">
                                                            
                                                            </div>
                                                            @if ($errors->has('email_addresses.{{ $i }}'))
                                                                <span class="invalid-message" role="alert"
                                                                    style="font-size: 12px; color:red;">
                                                                    {{ $errors->first('email_addresses') }}
                                                                </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="dolphin_column_right{{ $i }}"
                                                    style="display:none;">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input" style="margin-left: 39px;">
                                                            <span class="sky-text">Invite Sent</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                        @endif
                                </div>
                                </form>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="page-btn page-btn-green-peas" id="send_badge"
                            href="javascript:void(0);" wire:click="newSendBadge">Send Badge</button>
                        {{-- <a class="page-btn page-btn-red" href="javascript:void(0);"
                            wire:click="closebadgePopup">Close</a> --}}
                            <a class="page-btn page-btn-red closePop" >Close</a>
                        <a class="page-btn page-btn-blue" href="javascript:void(0);"
                            wire:click="UnitclearBadgeDates">Clear Dates</a>
                    </div>
                </div>
            </div>
        </div>
        <!--new_unit_badge_modal badge popup modal -->

        <!-- invite success modal start -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="invite_success_modal"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="invite_success_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd success_modal_off">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- invite success modal end -->

         <!-- Clears Dates start Modal -->
         <div wire:ignore.self class="modal common-border-modal Clears-Dates-Modal fade" id="resendClearsDatesModal" tabindex="-1" aria-labelledby="ClearresendClearsDatesModalsDatesModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body common-modal-body">
                        <p>
                            By clearing the dates, you will remove the available badges for:
                        </p>
                        <strong class="resend_badge_dates"></strong>
                        <p>
                            Would you like to continue and clear these dates?
                        </p>
                    </div>
                    <div class="common-modal-close">
                        <a href="javascript:void(0);" class="page-btn page-btn-red closeClearModal">No</a>
                        <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                            wire:click="resendRemoveBadgeDates">Yes</a>
                    </div>
                </div>
            </div>
        </div>
        
         {{-- NewSuccess popup --}}
         <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="Newsuccess_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="success_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='closeSuccessModal' >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end NewSuccess popup --}}
        {{-- Success popup --}}
        <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="success_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='closeSuccessModal' >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Success popup --}}


        {{-- Success popup --}}
        <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="hotel_success_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="message_success"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='hotelcloseSuccessModal' >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Success popup --}}

        {{-- resend_success_modal popup --}}
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="resend_success_modal"
        tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="resend_success_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click="resendBadge">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- resend_success_modal popup end--}}

        <!-- Resend badge popup modal start -->
        <div wire:ignore.self class="modal dolphing_cove_modal fade" id="Newresend_badge_modal" tabindex="-1"
        aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- @dd($shortBadgeStatus) --}}
                        @if ($shortBadgeStatus)
                            <h3 class="dolphincove_modal_title">{{ $shortBadgeStatus->unites->unit_name }} Badges</h3>
                        @endif
                        <a href="javascript:void(0);" class="refresh-btn">
                            {{-- <img src="{{ asset('frontend_assets/images/refresh-icon.svg')}}" alt="" > Refresh --}}
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="dolphing_cove_form ">
                            <form>
                                <div class="row dolphin_row">
                                    <div class="col-lg-6 dolphin_column input-date">
                                        <label>*Check-In</label>

                                        <input type="text" class="checkinDatePicker"
                                            value="{{ $resend_checkin_date }}" style="background-color: #e8e8e8;" disabled >
                                    </div>
                                    <div class="col-lg-6 dolphin_column input-date">
                                        <label>*Check-Out</label>
                                        <input type="text" class="checkoutDatePicker"
                                            value="{{ $resend_checkout_date }}" style="background-color: #e8e8e8;" disabled >
                                    </div>
                                </div>
                                <div class="dolphin-outer-wraper">
                                    {{-- @dd($globalSelected) --}}
                                    <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                        <div class="dolphin_colm_radiobox">
                                            <input class="form-check-input" type="checkbox" name="select"
                                                wire:model="selectAll"
                                                {{ count($globalSelected) > 0 ? '' : 'disabled' }} />
                                        </div>
                                        <div class="dolphin_column_left">


                                            <div class="dolphin_column_left_inner">
                                                <h4 class="dolphin_sub_title">Email Address <span
                                                        class="guest_count">({{ $guest_count }}/{{ $this->listing_guests }})</span>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="dolphin_column_right">
                                            <div class="dolphin_column_left_inner">
                                                <h4 class="dolphin_sub_title">Badge Statuses</h4>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @dd($not_accept_badges) --}}
                                    {{-- @dd($shortBadgeStatus) --}}
                                    @if (count($not_accept_badges) > 0)
                                        @foreach ($not_accept_badges as $key => $value)
                                            <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                                <div class="dolphin_colm_radiobox">
                                                    @if($shortBadgeStatus->end_date < date('Y-m-d'))
                                                        <input class="form-check-input" type="checkbox" name="select"
                                                        disabled />
                                                    @else
                                                        @if ($value->status == 1)
                                                        <input class="form-check-input" type="checkbox" name="select"
                                                            disabled />
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                wire:model="bulkIds" name="select"
                                                                value="{{ $value->id }}"
                                                                wire:click='selectSingle({{ $value->id }})' />
                                                        @endif
                                                    @endif
                                                    
                                                </div>
                                                <div class="dolphin_column_left">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input">
                                                            @if ($value->status == 1)
                                                                <?php $parts = explode('.', $value->guest_email);
                                                                $username = $parts[0]; ?>
                                                                <span>{{ substr($username, 0, 1) . str_repeat('*', strlen($username) - 0) . '.' . $parts[1] }}</span>
                                                            @else
                                                                <span>{{ $value->guest_email }}</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dolphin_column_right">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input">
                                                            @if ($value->status == 0 && $value->is_resend == 1)
                                                                <span class="sky-text">Resent on
                                                                    {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                            @elseif($value->status == 0)
                                                                <span class="sky-text">Invite Sent</span>
                                                            @elseif($value->status == 1)
                                                                <span class="text-green">Badge Activated</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div> 
                    <div class="modal-footer">
                        

                        <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                            wire:click="resend_pending_badge">Resend Badge </button>

                        <a class="page-btn page-btn-red" href="javascript:void(0);"
                            wire:click="closeRecentPopup">Close</a>
                        <a class="page-btn page-btn-blue" href="javascript:void(0);"
                            wire:click="clearRecendBadgeDates">Clear Dates</a>
                            {{-- <a class="page-btn page-btn-blue" href="javascript:void(0);">Clear Dates</a> --}}
                            
                    </div>
                    <div class="row">
                        <span style="text-align: center;margin-top: 20px;">Use<a wire:click="show_selected_badge"
                                style="color: blue;" href="javascript:void(0);"> Scheduled Badges </a>to add new badge
                            invites</span>
                    </div>
                </div>
            </div>
        </div>
        <!--Resend badge popup modal end --> 
        <!-- Guest Recognition popup start modal -->
        <div wire:ignore.self data-bs-backdrop = 'static' class="modal dolphing_cove_modal fade" id="guest_Recognition" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <h3 class="dolphincove_modal_title mb-3" style="color: #2e8cca;">Choose a reward below:</h3>
                    <div class="modal-body">
                        <div class="dolphing_cove_form ">
                            <form>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="guest_reward_value"
                                            value="guest_of_the_week" wire:model='guest_reward_value'>
                                        <b>Guest of The week</b> <br><span class="text-muted">An individual reward. Limited
                                            to one reward per booking.
                                            <b>Point value: {{ $points }} points</b></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="guest_reward_value"
                                            value="family_friend" wire:model='guest_reward_value'>
                                        <b>Family and Friends Rewards</b> <br><span class="text-muted">A group reward.
                                            Rewards all members that have accepted their badge in this member's listing. Limited to 2 rewards per booking
                                            <b>Point value: {{ $points }} points per member</b></span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                            wire:click="tenantReward">Send</button> --}}
                        <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                            wire:click="guestReward">Send</button>
                        <a class="page-btn page-btn-red" href="javascript:void(0);"
                            wire:click="closeRecognition">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!--Guest Recognition popup end modal -->
            <!-- member found popup start modal -->
        <div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="MemberFound" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <a href="#url" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-body common-modal-body">
                        <h4 class="manage-title">Member Found!</h4>
                        <i class="check-img closeFoundPopup" aria-label="Close"><img
                                src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- member found popup end modal -->

        <!-- member notfound popup start modal -->
        <div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="newMember" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <a href="javascript:void(0);" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-body common-modal-body">
                        <h4 class="manage-title">New Member!</h4>
                        <i class="check-img closeNotFoundPopup" aria-label="Close"><img
                                src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- member notfound popup end modal -->

        <!-- deactivate badge modal second start -->
        <div class="modal common-border-modal deactivate-badge-modal fade" id="DeactivateBadgeModal" tabindex="-1" aria-labelledby="DeactivateBadgeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body common-modal-body">
                        <h4 class="manage-title">Are you sure you want to deactivate this badge?</h4>
                        <p>
                            Are you sure you want to deactivate this badge? By deactivating, this member will no longer have
                            access
                            to benefits of the badge including receiving points and rewards from your organization
                        </p>
                        <p>
                            Please Note: if this action is taken after the check in time, the user may still receive points
                            reward.
                        </p>
                        <div class="common-modal-close">
                            <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal">No</a>
                            <a href="javascript:void(0);" class="page-btn page-btn-green-peas" wire:click="yesDeacivateBadge">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- deactivate badge modal second end -->

        {{-- deactivate badge model --}}
        <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="deactivate_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="error_msges"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd closeDeactivateModal" >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- deactivate badge model end--}}

        {{-- error popup --}}
        <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="error_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd closeErrorModal" >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       {{-- end error popup --}}
       

       {{-- cancel_success_modal --}}
       <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="cancel_success_modal"
        tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="cancel_success_msg"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd off_modal">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--End cancel_success_modal --}}

       <!-- Clears Dates start Modal -->
        <div class="modal common-border-modal Clears-Dates-Modal fade" id="NewClearsDatesModal" tabindex="-1"
        aria-labelledby="NewClearsDatesModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body common-modal-body">
                    <p>
                        By clearing the dates, you will remove the available badges for:
                    </p>
                    <strong class="badge_dates"></strong>
                    <p>
                        Would you like to continue and clear these dates?
                    </p>
                </div>
                <div class="common-modal-close">
                    <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal">No</a>
                    <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                        wire:click="removeBadgeDates">Yes</a>
                </div>
            </div>
        </div>
        </div>
        <!-- Clears Dates end Modal --> 

        <!-- Clears Dates start Modal -->
        <div wire:ignore.self class="modal common-border-modal Clears-Dates-Modal fade" id="UnitClearsDatesModal" tabindex="-1"
        aria-labelledby="UnitClearsDatesModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body common-modal-body">
                    <p>
                        By clearing the dates, you will remove the available badges for:
                    </p>
                    <strong class="badge_dates"></strong>
                    <p>
                        Would you like to continue and clear these dates?
                    </p>
                </div>
                <div class="common-modal-close">
                    <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal">No</a>
                    <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                        wire:click="removeUniteDates">Yes</a>
                </div>
            </div>
        </div>
        </div>
        <!-- Clears Dates end Modal -->


        {{-- Success popup --}}
        <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="hotel_resend_success_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="message_success_resend"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='hotelcloseSuccessModal' >ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="Newhotel_resend_success_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="Newmessage_success_resend"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    {{-- <button class="btn_table_s blu auto_wd" wire:click.prevent='ResendhotelcloseSuccessModal' >Ok</button> --}}
                                    <button class="btn_table_s blu auto_wd closecleardatemodal" >Ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end Success popup --}}

        <!-- Clears resend Dates start Modal -->
        <div class="modal common-border-modal Clears-Dates-Modal fade" id="UnitClearsResendDatesModal" tabindex="-1"
        aria-labelledby="UnitClearsResendDatesModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body common-modal-body">
                    <p>
                        By clearing the dates, you will remove the available badges for:
                    </p>
                    <strong class="badge_dates"></strong>
                    <p>
                        Would you like to continue and clear these dates?
                    </p>
                </div>
                <div class="common-modal-close">
                    <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal">No</a>
                    <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                        wire:click="removeResendUnitDates">Yes</a>
                </div>
            </div>
        </div>
        </div>
        <!-- Clears resend Dates end Modal -->

       <!-- Clears Dates start Modal -->
       <div wire:ignore.self class="modal common-border-modal Clears-Dates-Modal fade" id="ClearsDatesModal" tabindex="-1" aria-labelledby="ClearsDatesModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body common-modal-body">
                    <p>
                        By clearing the dates, you will remove the available badges for:
                    </p>
                    <strong class="badge_dates"></strong>
                    <p>
                        Would you like to continue and clear these dates?
                    </p>
                </div>
                <div class="common-modal-close">
                    <a href="javascript:void(0);" class="page-btn page-btn-red closeClearModal">No</a>
                    <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                        wire:click="removeBadgeDates">Yes</a>
                </div>
            </div>
         </div>
        </div>
        <!-- Clears Dates end Modal -->

       <!-- cancel badge start request -->
       <div wire:ignore.self class="modal common-border-modal Clears-Dates-Modal fade" id="cancelBadgeModal" tabindex="-1" aria-labelledby="canbadgeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body common-modal-body">
                        <p>
                            Would you like to cancel this invite?
                        </p>
                        <p>
                            By canceling, the listing will return to OPEN status for new invites for dates .
                        </p>
                        <strong>{{ $cancel_start_Date }} - {{ $cancel_end_Date }}</strong>
                    </div>
                    <div class="common-modal-close">
                        <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal">No</a>
                        <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                            wire:click="deleteGuestBadge">Yes</a>
                    </div>
                </div>
            </div>
        </div>
       <!-- cancel badge end request -->
        
     
        {{-- error_resend__modal start--}}
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_resend__modal" tabindex="-1"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="resend_error_message"></h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click="hideErrorModal">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- error_resend__modal end--}}

        

        <!--Guest Recognition popup success start modal -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="guest_Recognition_success"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>{{ $guest_success_message }}</h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd recognition_success_off" >ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!--Guest Recognition popup success end modal -->

        <!--Guest Recognition popup error start modal -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="guest_Recognition_error"
            tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>{{ $guest_error_message }}</h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click="$emit('guestRecognitionError')">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!--Guest Recognition popup error end modal -->
        <!--Guest error popup start modal -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="guest_error"
        tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3>Guest is not accepted the badge request</h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" wire:click.prevent='hotelcloseSuccessModal'>ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Guest error popup end modal -->
        

        <!-- member found but different role popup start modal -->
        <div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="notNewMember" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <a href="javascript:void(0);" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-body common-modal-body">
                        <h4 class="manage-title">This member has different role!</h4>
                        <i class="check-img closeNotNewFoundPopup" aria-label="Close"><img
                                src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- member found but different role popup end modal -->

        <!-- member wrong email popup start modal -->
        <div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="wrongMember" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <a href="javascript:void(0);" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-body common-modal-body">
                        <h4 class="manage-title">Wrong Email Address!</h4>
                        <i class="check-img closeWrongPopup" aria-label="Close"><img
                                src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- member wrong popup end modal -->



    @push('scripts')
        <script>
                function areDatesEqual(date1, date2) {
                    const d1 = new Date(date1);
                    const d2 = new Date(date2);

                    // Compare only the year, month, and day
                    return (
                        d1.getFullYear() === d2.getFullYear() &&
                        d1.getMonth() === d2.getMonth() &&
                        d1.getDate() === d2.getDate()
                    );
                }

                function getEmail() {
                    window.livewire.emit('checkEmail');
                }

                $(".clear_list_data").click(function() {
                    location.reload();
                });

                $(".off_modal").click(function() {
                    $('#cancel_success_modal').modal('hide');
                })

                $(".closecleardatemodal").click(function() {
                    location.reload();
                });

                $(".closeDeactivateModal").click(function() {
                    // console.log('123');
                    // $("#DeactivateBadge").modal('hide');
                    $("#DeactivateBadgeModal").modal('hide');
                    $("#deactivate_modal").modal('hide'); 
                    // location.reload();
                });

                $(document).on('click', '.closeScheduledbadgePopup', function() {
                    console.log('Cancel button clicked');
                    $("#schedulemodal").modal('hide'); 
                    // location.reload();
                });
    
                $(".closeSelectedBadge").click(function() {
                    // console.log('123');
                    $("#selectedScheduleModal").modal('hide'); 
                });

                

                $(".closePop").click(function() {
                    // console.log('123');
                    $("#new_unit_badge_modal").modal('hide');
                    // location.reload();
                });



                document.addEventListener('livewire:load', function(event) {
                   
                    @this.on('open_add_badge', data=> {
                        console.log(data);
                        $("#unit_badge_modal").modal('show');
                        console.log(data);
                        $('.checkinDatePicker').datepicker("destroy");
                        $('.checkoutDatePicker').datepicker("destroy");
                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: '-6M',
                            setdate: new Date(),
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkin_date', e.target.value);
                            @this.emit('datepickerEnable');

                        });

                        $(".checkoutDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkout_date', e.target.value);
                            @this.emit('datepickerEnable');

                        });
                    });

                    // @this.on('openAdjustLease', function() {
                        
                    //     // console.log(data);
                    //     $(".checkinDatePicker").css('background-color','');
                    //     $(".checkoutDatePicker").css('background-color','');
                    //     $(".checkinDatePicker").removeAttr('disabled',false);
                    //     $(".checkoutDatePicker").removeAttr('disabled',false);
                    //     $(".saveleasebutton").css('display','block');
                    //     $(".adjustleasebutton").css('display','none');
                    //     $('.sendbadge').prop('disabled',true);
                    //     $('.sendbadge').css('background-color','grey');
                    //     $('.sendbadge').css('cursor','none');
                    //     $(".checkinDatePicker").datepicker({
                    //         dateFormat: "mm/dd/yy",
                    //         changeMonth: true,
                    //         changeYear: true,
                    //         minDate: '-6M',
                    //         setdate: new Date(),
                    //     }).on('change', function(e) {
                    //         console.log(e.target.value);
                    //         @this.set('checkin_date', e.target.value);
                    //         @this.emit('adjustdatepickerEnable');

                    //     });

                    //     $(".checkoutDatePicker").datepicker({
                    //         dateFormat: "mm/dd/yy",
                    //         changeMonth: true,
                    //         changeYear: true,
                    //         minDate: 0,
                    //         setdate: new Date(),
                    //     }).on('change', function(e) {
                    //         console.log(e.target.value);
                    //         @this.set('checkout_date', e.target.value);
                    //         @this.emit('adjustdatepickerEnable');

                    //     });
                    // });

                    @this.on('openListingBadge', data => {
                        console.log(data);
                        $('#new_unit_badge_modal').modal('show');
                        //$('#listing_badge_modal').modal({'data-bs-backdrop': 'static', keyboard: false})  
                        $(".dolphincove_modal_title").text(data.unites.unit_name + " Badges");
                        $(".guest_count").text('(0/10)');
                        $('.checkinDatePicker').datepicker("destroy");
                        $('.checkoutDatePicker').datepicker("destroy");

                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                            beforeShowDay: function(date) {
                                if (data.dates.length > 0) {
                                    for (var j = 0; j < data.dates.length; j++) {
                                        if (areDatesEqual(date, data.dates[j])) {
                                            return [true, 'event ui-datepicker-unselectable', ''];
                                        }
                                    }
                                }

                                if (data.daterange.length > 0) {
                                    for (var i = 0; i < data.daterange.length; i++) {
                                        var previousDateObj = new Date(data.daterange[i].endDate);
                                        previousDateObj.setDate(previousDateObj.getDate());

                                        if (areDatesEqual(date, data.daterange[i].startDate)) {
                                            // return [true, 'eventrange', ''];
                                            return [true, 'eventrange ui-datepicker-unselectable', ''];
                                        }
                                        if (date > new Date(data.daterange[i].startDate) && date <=
                                            previousDateObj) {
                                            if (areDatesEqual(date, previousDateObj)) {
                                                return [true, 'eventrange', ''];
                                                // return [true, 'eventrange ui-datepicker-unselectable', ''];
                                            } else {
                                                return [true, 'eventrange ui-datepicker-unselectable',
                                                    ''
                                                ];
                                            }
                                        }

                                    }
                                }

                                return [true, '', ''];
                            }
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkin_date', e.target.value);
                            @this.emit('dateCheckDateRange', data.unites.id);

                        });

                        $(".checkoutDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                            beforeShowDay: function(date) {
                                if (data.dates.length > 0) {
                                    for (var j = 0; j < data.dates.length; j++) {
                                        if (areDatesEqual(date, data.dates[j])) {
                                            return [true, 'event ui-datepicker-unselectable', ''];
                                        }
                                    }
                                }
                                for (var i = 0; i < data.daterange.length; i++) {
                                    var previousDateObj = new Date(data.daterange[i].endDate);
                                    previousDateObj.setDate(previousDateObj.getDate());

                                    if (areDatesEqual(date, data.daterange[i].startDate)) {

                                        // return [true, 'eventrange', ''];
                                        return [true, 'eventrange ui-datepicker-unselectable', ''];

                                    }
                                    if (date > new Date(data.daterange[i].startDate) && date <=
                                        previousDateObj) {
                                        if (areDatesEqual(date, previousDateObj)) {
                                            // return [true, 'eventrange', ''];
                                            return [true, 'eventrange ui-datepicker-unselectable', ''];

                                        } else {
                                            return [true, 'eventrange ui-datepicker-unselectable', ''];
                                        }
                                    }

                                }

                                return [true, '', ''];
                            }

                        }).on('change', function(e) {
                            @this.set('checkout_date', e.target.value);
                            @this.emit('dateCheckDateRange', data.unites.id);
                        });
                    });
                   
                    @this.on('closeBadgePopup', function() {
                        $('#unit_badge_modal').modal('hide');
                        $('#new_unit_badge_modal').modal('hide');

                        $('#schedulemodal').modal('hide');
                        location.reload();
                    });

                    $(".closeSuccessModal").on('click',function(){
                        $("#success_modal").modal('hide');
                        $("#success_msg").text('');
                    });

                    $('.success_modal_off').on('click',function(){
                        $("#invite_success_modal").modal('hide');
                        $("#invite_success_msg").text('');
                        // location.reload();
                    });

                    @this.on('selectedSuccessPopup', data => {
                         console.log(data.text+'*-*-*---*-*-*-*-*')
                        // $("#success_modal").modal('show');
                        // $("#success_msg").text(data.text);
                        $("#hotel_success_modal").modal('show');
                        $("#message_success").text(data.text);
                    })


                    $(".closeUnitBadge").on('click',function(){
                        //location.reload();
                         $("#unit_badge_modal").modal('hide');
                         $("#Newresend_badge_modal").modal('hide');
                        // $(".checkinDatePicker").datepicker('setDate', null);
                        // $(".checkoutDatePicker").datepicker('setDate', null);
                    });

                    @this.on('badgeSent', data=> {
                        console.log(data.text);
                        $("#unit_badge_modal").modal('hide');
                        $("#success_modal").modal('show');
                        $("#success_msg").text(data.text);
                        
                    });

                    @this.on('badgeSuccessPopup', data => {
                        $('#Newresend_badge_modal').modal('hide');
                        $("#resend_success_modal").modal('show');
                        $("#resend_success_msg").text(data.text);
                    });

                    @this.on('resend_error_popup', data => {
                        $("#error_resend__modal").modal('toggle');
                        $("#resend_error_message").text(data.text);
                    });

                    @this.on('NewbadgeSent', data => {
                        console.log(data.key_arr.length);
                        if (data.key_arr.length > 0) {
                            for (var i = 0; i <= data.key_arr.length; i++) {
                                $(".dolphin_column_right" + data.key_arr[i]).css('display', 'block');
                            }
                            $(".guest_count").text('(' + data.guest_badge_count + '/10)');
                            if (data.text) {
                                $("#invite_success_modal").modal('show');
                                $("#invite_success_msg").text(data.text);
                            }

                        } else {
                            $(".guest_count").text('(' + data.guest_badge_count + '/10)');
                            if (data.text) {
                                $("#invite_success_modal").modal('show');
                                $("#invite_success_msg").text(data.text);
                            }
                        }

                    });

                    

                    @this.on('guestbadge', data => {
                        $("#resend_success_modal").modal('hide');
                        $('#Newresend_badge_modal').modal('show');
                    });

                    @this.on('scheduledBadgesPopup', function() {
                        // console.log('sdfds'); 
                        $('#schedulemodal').modal('show');
                    });

                    @this.on('selectedScheduledBadgesPopup', function() {
                        $('#selectedScheduleModal').modal('show');
                        // $('#schedulemodal').modal('hide');

                    });

                    @this.on('closeSelectedScheduledBadges', function() {
                        $('#selectedScheduleModal').modal('hide');
                    });

                    @this.on('guestbadgeClose', data => {
                        $('#Newresend_badge_modal').modal('hide');
                    });

                    @this.on('resetBadgeForm', data => {
                        $(".dolphincove_modal_title").text(data.listing.name + " Badges");
                        $(".guest_count").text('(' + data.badge_guest_count + '/' + data.listing.no_of_guests +
                            ')');
                        $("#invite_success_modal").modal('hide');
                    }); 
                    
                    @this.on('NewresetBadgeForm', data => {
                         $('.checkinDatePicker').val('');
                         $('.checkoutDatePicker').val('');
                    });

                    function getEmail() {
                        window.livewire.emit('checkEmail');
                    }

                    @this.on('NewmemberSuccessPopup', data => {
                        $(".dolphincove_modal_title").text(data.listing.unit_name + " Badges");
                        if (data.type == 'member_found') {
                            $('#MemberFound').modal('show');
                            //if(data.badges){
                            //     if(data.badges > 0){
                            //         $("#send_badge").prop('disabled',true);
                            //     }
                            //     else{
                            //         $("#send_badge").prop('disabled',false);
                            //     } 
                            // }
                        } else if (data.type == 'member_not_found') {
                            $('#newMember').modal('show');
                            // if(data.badges){
                            //     if(data.badges > 0){
                            //         $("#send_badge").prop('disabled',true);
                            //     }
                            //     else{
                            //         $("#send_badge").prop('disabled',false);
                            //     } 
                            // }
                        } else if (data.type == 'wrong_email') {
                            $("#success_modal").modal('show');
                            $("#success_msg").text('Email address must be valid');
                            // if(data.badges){
                            //     if(data.badges > 0){
                            //         $("#send_badge").prop('disabled',true);
                            //     }
                            //     else{
                            //         $("#send_badge").prop('disabled',false);
                            //     } 
                            // }
                        } else {
                            $("#success_modal").modal('show');
                            $("#success_msg").text(data.text);

                            // if(data.badges){
                            //     if(data.badges > 0){
                            //         $("#success_modal").modal('show');
                            //         $("#success_msg").text("You can't choose any date in another check-in check-out date");
                            //         $("#send_badge").prop('disabled',true);
                            //     }
                            //     else{
                            //         $("#send_badge").prop('disabled',false);
                            //     } 
                            // }
                        }
                        $('.checkinDatePicker').datepicker("destroy");
                        $('.checkoutDatePicker').datepicker("destroy");

                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                            beforeShowDay: function(date) {
                                if (data.dates.length > 0) {
                                    for (var j = 0; j < data.dates.length; j++) {
                                        if (areDatesEqual(date, data.dates[j])) {
                                            return [true, 'event ui-datepicker-unselectable', ''];
                                        }
                                    }
                                }
                                for (var i = 0; i < data.daterange.length; i++) {
                                    var previousDateObj = new Date(data.daterange[i].endDate);
                                    previousDateObj.setDate(previousDateObj.getDate());

                                    if (areDatesEqual(date, data.daterange[i].startDate)) {
                                        return [true, 'eventrange ui-datepicker-unselectable', ''];
                                    }
                                    if (date > new Date(data.daterange[i].startDate) && date <=
                                        previousDateObj) {
                                        if (areDatesEqual(date, previousDateObj)) {
                                            return [true, 'eventrange', ''];
                                        } else {
                                            return [true, 'eventrange ui-datepicker-unselectable', ''];
                                        }
                                    }

                                }

                                return [true, '', ''];
                            }

                        }).on('change', function(e) {
                            @this.set('checkin_date', e.target.value);
                            @this.emit('dateCheckDateRange', data.listing.id);
                        });

                        $(".checkoutDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                            beforeShowDay: function(date) {
                                if (data.dates.length > 0) {
                                    for (var j = 0; j < data.dates.length; j++) {
                                        if (areDatesEqual(date, data.dates[j])) {
                                            return [true, 'event ui-datepicker-unselectable', ''];
                                        }
                                    }
                                }
                                for (var i = 0; i < data.daterange.length; i++) {
                                    var previousDateObj = new Date(data.daterange[i].endDate);
                                    previousDateObj.setDate(previousDateObj.getDate());

                                    if (areDatesEqual(date, data.daterange[i].startDate)) {
                                        return [true, 'eventrange ui-datepicker-unselectable', ''];
                                    }
                                    if (date > new Date(data.daterange[i].startDate) && date <=
                                        previousDateObj) {
                                        if (areDatesEqual(date, previousDateObj)) {
                                            return [true, 'eventrange', ''];
                                        } else {
                                            return [true, 'eventrange ui-datepicker-unselectable', ''];
                                        }
                                    }

                                }

                                return [true, '', ''];
                            }
                        }).on('change', function(e) {
                            @this.set('checkout_date', e.target.value);
                            @this.emit('dateCheckDateRange', data.listing.id);
                        });
                    });


                    @this.on('memberSuccessPopup', data => {
                        if (data.type == 'member_found') {
                            $('#MemberFound').modal('show');
                        }
                        else if (data.type == 'member_not_found') {
                            $('#newMember').modal('show');
                        }
                        else if (data.type == 'wrong_email'){
                            $('#wrongMember').modal('show');
                        }
                        else if (data.type == 'lease_Renewal'){
                            $("#success_modal").modal('show');
                            $("#success_msg").text(data.message);
                        }
                        else if (data.type == 'member_different_role'){
                            $('#notNewMember').modal('show');
                        }
                        else{
                            $("#success_modal").modal('show');
                            $("#success_msg").text('No dates are selected there');
                        }
                    });

                    $(".closeFoundPopup").on('click',function(){
                        $("#MemberFound").modal('hide');
                    });

                    $(".closeNotFoundPopup").on('click',function(){
                        $("#newMember").modal('hide');
                    });
                    $(".closeNotNewFoundPopup").on('click',function(){
                        $("#notNewMember").modal('hide');
                    });
                    $(".closeWrongPopup").on('click',function(){
                        $("#wrongMember").modal('hide');
                    });
                    $(".recognition_success_off").on('click',function(){
                        $("#guest_Recognition_success").modal('hide');
                    });

                    @this.on('badgeError', data => {
                        console.log(data.text);
                        $("#success_modal").modal('show');
                        $("#success_msg").text(data.text);
                 
                        
                    });

                    @this.on('clearBadgeDate', data => {
                         console.log(data+'*****************************');
                        $('#NewClearsDatesModal').modal('show');
                        $(".badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);
                    });

                    @this.on('clearUnitDate', data => {
                         console.log(data+'*****************************----');
                        $('#UnitClearsDatesModal').modal('show');
                        $(".badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);
                    });

                    @this.on('clearResendUnitDate', data => {
                        $('#UnitClearsResendDatesModal').modal('show');
                        $(".badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);
                    });

                    $(".closeClearModal").on('click',function(){
                        $('#ClearsDatesModal').modal('hide');
                    })

                    @this.on('removeUniteDate', data => {
                        console.log(data.text+'//////////////');
                        // $('#UnitClearsDatesModal').modal('hide');
                        $("#hotel_resend_success_modal").modal('show');
                        $("#message_success_resend").text(data.text);
                    });

                    @this.on('removeResendUniteDate', data => {
                        $('#UnitClearsResendDatesModal').modal('hide');
                        $("#Newhotel_resend_success_modal").modal('show');
                        $("#Newmessage_success_resend").text(data.text);
                    });

                    @this.on('NewremoveBadgeDate', data => {
                        $('#NewClearsDatesModal').modal('hide');
                        $('#selectedScheduleModal').modal('hide');
                        
                        $("#hotel_success_modal").modal('show');
                        $("#message_success").text(data.text);
                        // $('#schedulemodal').modal('show');

                        
                    });

                    // @this.on('removeBadgeDate', data => {
                    //     console.log(data);
                    //     $('#ClearsDatesModal').modal('hide');
                    //     $("#selectedScheduleModal").modal('hide');

                    //     $("#success_modal").modal('show');
                    //     $("#success_msg").text(data.text);
                    //     $("#closeSuccessModal").modal('hide');
                    //     $('.checkinDatePicker').datepicker("destroy");
                    //     $('.checkoutDatePicker').datepicker("destroy");
                    //     $(".checkinDatePicker").datepicker({
                    //         dateFormat: "mm/dd/yy",
                    //         changeMonth: true,
                    //         changeYear: true,
                    //         minDate: '-6M',
                    //     }).on('change', function(e) {
                    //         console.log(e.target.value);
                    //         @this.set('checkin_date', e.target.value);

                    //     });

                    //     $(".checkoutDatePicker").datepicker({
                    //         dateFormat: "mm/dd/yy",
                    //         changeMonth: true,
                    //         changeYear: true,
                    //         minDate: 0,
                    //         setdate: new Date(),
                    //     }).on('change', function(e) {
                    //         console.log(e.target.value);
                    //         @this.set('checkout_date', e.target.value);

                    //     });
                    // }); 

                    @this.on('hotelcloseSuccessPopup',function(){
                        // console.log('123');
                         $("#UnitClearsDatesModal").modal('hide');
                         $("#Newresend_badge_modal").modal('hide');
                         $("#hotel_resend_success_modal").modal('hide');
                         $("#Newhotel_resend_success_modal").modal('hide');
                         $("#hotel_success_modal").modal('hide');
                         $("#guest_error").modal('hide');

                    });

                    @this.on('ResendhotelcloseSuccessPopup',function(){
                        $("#Newresend_badge_modal").modal('hide');
                        $("#Newhotel_resend_success_modal").modal('hide');
                    });

                    @this.on('hotelResendcloseSuccessPopup',function(){
                        $("#hotel_unit_resend_success_modal").modal('hide');
                    });

                    @this.on('closeSuccessPopup',function(){
                        $("#selectedScheduleModal").modal('hide');
                        $("#success_modal").modal('hide');
                        $("#hotel_success_modal").modal('hide');
                        $("#hotel_resend_success_modal").modal('hide');

                        $("#clear_date_success_modal").modal('hide');
                        $("#success_msg").text('');
                        $("#date_success_msg").text('');
                        $("#Newresend_badge_modal").modal('hide');
                        @this.emit('datepickerEnable');
                       
                    });

                    @this.on('closeSaveLease', function() {
                        $(".checkinDatePicker").css('background-color','#e8e8e8');
                        $(".checkoutDatePicker").css('background-color','#e8e8e8');
                        $(".checkinDatePicker").removeAttr('disabled',true);
                        $(".checkoutDatePicker").removeAttr('disabled',true);
                        $(".saveleasebutton").css('display','none');
                        $(".adjustleasebutton").css('display','block');
                    });



                    @this.on('resend_badge', data=> {
                        console.log(data);
                        $("#resend_badge_modal").modal('show');
                        console.log(data);
                        $('.checkinDatePicker').datepicker("destroy");
                        $('.checkoutDatePicker').datepicker("destroy");
                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: '-6M',
                            setdate: new Date(),
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkin_date', e.target.value);
                            @this.emit('datepickerEnable');

                        });

                        $(".checkoutDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: 0,
                            setdate: new Date(),
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkout_date', e.target.value);
                            @this.emit('datepickerEnable');

                        });
                    });

                    @this.on('resendclearBadgeDate', data => {
                         console.log(data);
                        $('#resendClearsDatesModal').modal('show');
                        $(".resend_badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);
                    });
                    @this.on('resendRemoveBadgeDate', data => {
                        console.log(data);
                        $('#resendClearsDatesModal').modal('hide');
                        $("#clear_date_success_modal").modal('show');
                        $("#date_success_msg").text(data.text);
                       
                    });

                    @this.on('deactivateBadges', data => {
                        if (data.type == 1) {
                            $('#error_modal').modal('show');
                            $("#error_msg").text("After lease start date you can't deactivate these badge");
                        } else {
                            $('#DeactivateBadgeModal').modal('show');
                        }
                    });

                    @this.on('cancelBadgePopup', data => {
                        console.log(data);
                        $('#cancelBadgeModal').modal('show');
                    });

                    @this.on('termError', data => {
                        console.log(data);
                        $("#error_modal").modal('show');
                        $("#error_msg").text(data.text);
                        $('#cancelBadgeModal').modal('hide');
                    });

                    @this.on('deactivateError', data => {
                        // $("#DeactivateBadge").modal('hide');
                        // $('#DeactivateBadgeModal').modal('hide');
                        $("#deactivate_modal").modal('show');
                        $("#error_msges").text(data.text); 
                    });



                    

                    $(".closeErrorModal").on('click',function(){
                        // location.reload(); 
                        $("#error_modal").modal('hide');
                        $("#error_msg").text('');
                        // $('#Newresend_badge_modal').modal('show');
                    });

                    // @this.on('guestRecognitionpopup',function() {
                    //     $('#guest_Recognition').modal('toggle');
                    // });

                    @this.on('disableguestRecognitionpopup',function() {
                        $('#guest_Recognition').modal('hide');
                    });

                    @this.on('guestRecognition', data => {
                        $('#guest_Recognition').modal('toggle');
                    });
                    @this.on('guestRecognitionSuccess', data => {
                        $('#guest_Recognition').modal('hide');
                        $('#guest_Recognition_success').modal('show');
                    });
                    @this.on('guestRecognitionError', data => {
                        $('#guest_Recognition').modal('hide');
                        $('#guest_Recognition_error').modal('toggle');
                    });

                    @this.on('guestError', data => {
                        $('#guest_Recognition').modal('hide');
                        $('#guest_error').modal('toggle');
                    });
                    
                });

                $(document).on('show.bs.modal', '.modal', function() {
                    const zIndex = 1040 + 10 * $('.modal:visible').length;
                    $(this).css('z-index', zIndex);
                    setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass(
                        'modal-stack'));
                });
        </script>
    @endpush
</div>

