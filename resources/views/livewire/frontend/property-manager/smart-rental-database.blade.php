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
        .saveleasebutton{
            display: none;
        }
        .guest_tr th{
                position: sticky;
                top: 0;
                background: #fff;
        }
       
    </style>
@endpush
    <div class="all-smart-rental-database-main-sec show-filled-units-only guest-rntl">
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
                                id="change_first">{{ $property_name }}</span>
                            <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($propertyDetails as $property)
                                        <li><a class="property_provider" id="property_provider"
                                                href="javascript:void(0);" wire:click.prevent='getpropertyDetail({{$property->provider->id}})'>{{ $property->provider ? $property->provider->name : '' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </span>
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
                                                    id="property_address">{{ $address }}</label></span>
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
                                                id="distributePoint">{{ $point }}
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
                                    <select wire:model.live='select_building'>
                                        <option value="all">Select Building</option>
                                        @if($buldingList)
                                            @foreach ($buldingList as $building_data)
                                                <option value="{{$building_data->id}}">{{$building_data->building_name}}&nbsp;&nbsp;({{$building_data->units->count()}} units)</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="new_col enterunit">
                                    <label>Enter Unit Number</label>
                                    <div class="enterunit_dropdown_parent">
                                        <input type="text" placeholder="Start typing to search units"  wire:model.defer="search_text" wire:keyup="searchResult">
                                        @if($showdiv)
                                        <ul style="z-index: 999; max-height: 200px; overflow-y: auto;">
                                            @if(!empty($result))
                                            @foreach($result as $result_data)
    
                                            <li wire:click="getUnit({{ $result_data->id }})">{{
                                                $result_data->unit}}</li>
    
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

                            {{-- <div class="form-check">
                                <input class="form-check-input change_list" type="radio" wire:model="selectedOption"
                                    id="flexRadioDefault1" value="default" />
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Default View
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input change_list" type="radio" wire:model="selectedOption"
                                    id="flexRadioDefault2" value="filledunit" />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Show filled units only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input change_list" type="radio" wire:model="selectedOption"
                                    id="flexRadioDefault3" value="openunits" />
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Show open units only
                                </label>
                            </div> --}}

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex justify-content-end align-items-center filter-main">
                            <select wire:change='changeDateOrder' wire:model='date_order'class="form-select" aria-label="Default select example">
                                <option value="all">All Lease Dates</option>
                                <option value="start_date_asc">Start Dates - Oldest to Newest</option>
                                <option value="start_date_desc">Start Dates - Newest to Oldest</option>
                                <option value="end_date_asc">End Dates - Oldest to Newest</option>
                                <option value="end_date_desc">End Dates - Newest to Oldest</option>
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
                        <div class="scroll_table">
                            <table class="table table-striped table-hover" style="position: relative;">
                                <thead>
                                    <tr class="guest_tr"> 
                                        <th scope="col"></th>
                                        <th scope="col">Resident</th>
                                        <th scope="col">Building</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Lease Start</th>
                                        <th scope="col">Lease End</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">Badge Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                
                                    <tbody>
                                        @if(@$units)
                                        @foreach($units as $unit_data) 
                                            @if(count($unit_data['badges']) > 0)
                                                @foreach ($unit_data['badges'] as $badge_data)
                                                
                                                    @if(count($badge_data['badge_guest']) > 0)
                                                        <tr>
                                                            <td><input class="form-check-input" name="select" wire:click='getBadgeDetail({{$badge_data['id']}},"badge")'  type="radio" /></td>
                                                            <td><a href="javascript:void(0);" wire:click='getBadgeGuest({{$badge_data['id']}})' class="pupUp_modal">{{count($badge_data['badge_guest'])}}/10 badges</a></td>

                                                            <td>{{ $unit_data['buildings']['building_name']}}</td>

                                                            <td>{{ $unit_data['unit']}}</td>
                                                            <?php $start_date = date_format(date_create($badge_data['start_date']),'m-d-Y');?>
                                                            <td>{{ $start_date}}</td>
                                                            <?php 
                                                            $today = date('Y-m-d');
                                                            $date1=date_create($today);
                                                            $date2=date_create($badge_data['end_date']);
                                                            $diff=date_diff($date1,$date2);
                                                            $duration = $diff->format("%a");
                                                            
                                                            $end_date = date_format(date_create($badge_data['end_date']),'m-d-Y');
                                                                  ?>
                                                            @if($duration <= 45)
                                                                <td><span style="color:red;">{{ $end_date}}</span></td>
                                                            @else
                                                                <td>{{ $end_date}}</td>
                                                            @endif
                                                            <td>---</td>

                                                            <td>---</td>

                                                        </tr>
                                                        @foreach($badge_data['badge_guest'] as $key => $guest)
                                                            
                                                            <tr>
                                                                <td><input class="form-check-input" wire:click='getBadgeDetail({{$guest['id']}},"guest")' name="select"  type="radio" /></td>
                                                                @if($guest['user_id'] != null)
                                                                    <td>{{$guest['user']['first_name']}} {{$guest['user']['last_name']}}</td>
                                                                @else
                                                                    <td>{{$guest['guest_email']}}</td>
                                                                @endif

                                                                <td></td>

                                                                <td class="smart-address-th"></td>

                                                                <td></td>

                                                                <td></td>

                                                                <td>{{$guest['point']}}</td>
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
                                                            <td><input class="form-check-input" wire:click='getBadgeDetail({{$badge_data['id']}},"badge")' name="select"  type="radio" /></td>
                                                            <td><a href="javascript:void(0);" wire:click='getBadgeGuest({{$badge_data['id']}})' class="pupUp_modal">{{count($badge_data['badge_guest'])}}/10 badges</a></td>

                                                            <td>{{ $unit_data['buildings']['building_name']}}</td>

                                                            <td>{{ $unit_data['unit']}}</td>
                                                            <?php $start_date = date_format(date_create($badge_data['start_date']),'m-d-Y');?>
                                                            <td>{{ $start_date}}</td>
                                                            <?php 
                                                            $today = date('Y-m-d');
                                                            $date1=date_create($today);
                                                            $date2=date_create($badge_data['end_date']);
                                                            $diff=date_diff($date1,$date2);
                                                            $duration = $diff->format("%a");
                                                            
                                                            $end_date = date_format(date_create($badge_data['end_date']),'m-d-Y');
                                                                  ?>
                                                            @if($duration <= 45)
                                                                <td><span style="color:red;">{{ $end_date}}</span></td>
                                                            @else
                                                                <td>{{ $end_date}}</td>
                                                            @endif
                                                            <td>---</td>

                                                            <td>---</td>

                                                            <td>---</td>
                                                        </tr>
                                                    @endif
                                                @endforeach    
                                            @else
                                            <tr>
                                                <td><input class="form-check-input" wire:click='getBadgeDetail({{$unit_data['id']}},"unit")' name="select"  type="radio" /></td>
                                                <td><a href="javascript:void(0);" class="pupUp_modal" wire:click='addBadgeForUnit({{$unit_data['id']}})'>0/10 badges</a></td>

                                                <td>{{ $unit_data['buildings']['building_name']}}</td>

                                                <td>{{ $unit_data['unit']}}</td>

                                                <td>---</td>

                                                <td>---</td>

                                                <td>---</td>

                                                <td>---</td>
                                            </tr>
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
                    {{-- <div class="col-md-3">
                        <div class="btn_area_section">
                            <span> Action </span>
                            <button type="button" class="btn green_btn add_point" disabled>Add Points</button>
                            <button type="button" class="btn red_btn deactive" disabled>Deactivate</button>
                            <button type="button" class="btn sky_btn add_term" disabled>Add term</button>
                            <button class="btn yellow_btn view_profile" disabled id="viewprofile">View
                                profile</button>
                            <a href="{{route('frontend.low-point-balance-member')}}" class="btn purple_btn">Low Point Balance Member Search</a>
                            <div id="success_message" class="ajax_response" style="float:left"></div>
                        </div>
                    </div> --}}
                    <div class="col-md-2">
                        <div class="btn_area_section" style="padding: 14px 20px;min-height: 1px;">
                            <span> Action </span>
                            <button type="button" class="btn sky_btn" wire:click.prevent='addBadgeTerm'>Add term</button>
                            <button type="button" class="btn red_btn" wire:click="deactivateBadge" >Deactivate Badge</button>
                            <button type="button" class="btn green_btn" wire:click.prevent='resendBadge' >Resend Badge</button>
                            <button type="button" class="btn sky_btn add_term" wire:click="addPoint"
                                >Add Points</button>
                            <button class="btn yellow_btn view_profile"  id="guestRecogBtn"
                                wire:click="guestRecognition">Resident Recognition</button>

                            <button class="btn purple_btn" wire:click='viewconsumerProfile'>View profile</button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      

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
        <!-- Clears Dates end Modal -->

        {{-- Resend badge popup start --}}
        <div wire:ignore.self class="modal dolphing_cove_modal fade" id="resend_badge_modal" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($unit_name != '')
                            <h3 class="dolphincove_modal_title" >{{$unit_name}}</h3>
                        @endif
                        <a href="javascript:void(0);" class="refresh-btn">
                            {{-- <img src="{{ asset('frontend_assets/images/refresh-icon.svg')}}" alt="" > Refresh --}}
                        </a>


                    </div>
                    <div class="modal-body">
                        <div class="dolphing_cove_form ">
                            <form>
                                <div class="row dolphin_row">
                                    @if(count($badgeDates) > 0)
                                        {{-- @dd(count($badgeDates)); --}}
                                        <div class="col-lg-6 dolphin_column input-date" >
                                            <label>*Lease Start Date </label>
                                            <input type="text" class="checkinDatePicker" style="background-color: #e8e8e8;" wire:model="checkin_date" disabled>
                                        </div>
                                        <div class="col-lg-6 dolphin_column input-date" >
                                            <label>*Lease End Date</label>
                                            <input type="text" class="checkoutDatePicker" style="background-color: #e8e8e8;"  wire:model="checkout_date" disabled>
                                        </div>
                                    @else
                                        <div class="col-lg-6 dolphin_column input-date">
                                            <label>*Lease Start Date</label>
                                            <input type="text" class="checkinDatePicker" wire:model="checkin_date" >
                                        </div>
                                        <div class="col-lg-6 dolphin_column input-date">
                                            <label>*Lease End Date</label>
                                            <input type="text" class="checkoutDatePicker" wire:model="checkout_date">
                                        </div>
                                    @endif
                                </div>
                                <div class="dolphin-outer-wraper">
                                    <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                        <div class="dolphin_colm_radiobox">
                                            <input class="form-check-input" type="checkbox" name="select"
                                                wire:model="selectAll"
                                                {{ count($globalSelected) > 0 ? '' : 'disabled' }} />
                                        </div>
                                        <div class="dolphin_column_left">


                                            <div class="dolphin_column_left_inner">
                                                <h4 class="dolphin_sub_title">Email Address <span
                                                        class="guest_count">({{$guest_count}}/{{$badge_count}})</span>
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
                                            <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                                <div class="dolphin_colm_radiobox">
                                                    @if($selected_badge->end_date < date('Y-m-d'))
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
                    <div class="md-footer-top">
                        <p><strong>Lease Dates:-</strong> {{$checkin_date}} - {{$checkout_date}}</p>
                        <div class="md-footer-link">
                            <a href="javascript:void(0);" wire:click='adjustLease' class="adjustleasebutton"><small>Adjust Lease</small></a> 
                            <a href="javascript:void(0);" wire:click='SaveLease' class="saveleasebutton"><small>Save Lease</small></a> 
                            <a href="javascript:void(0);" wire:click='leaseRenewal'><small>Lease Renewal</small> (Add Term)</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="page-btn page-btn-green-peas" id="send_badge"
                            href="javascript:void(0);" wire:click="resendGuestBadge">Resend Badge</button>
                        <a class="page-btn page-btn-red closeUnitBadge" href="javascript:void(0);">Close</a>
                        <a class="page-btn page-btn-blue" href="javascript:void(0);"
                            wire:click="resendClearBadgeDates">Clear Dates</a>
                    </div>
                    {{-- <div class="row">
                        <span style="text-align: center;margin-top: 20px;">Use<a wire:click="show_selected_badge"
                                style="color: blue;" href="javascript:void(0);"> Scheduled Badges </a>to add new badge
                            invites</span>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- Resend badge popup end --}}

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
                                                value="resident_of_the_month" wire:model='guest_reward_value'>
                                            <b>Resident of The Month</b> <br><span class="text-muted">An individual reward. Limited
                                                to ten reward per month.
                                                <b>Point value: {{ $points }} points per member</b></span>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="guest_reward_value"
                                                value="family_friend" wire:model='guest_reward_value'>
                                            <b>Family and Friends Rewards</b> <br><span class="text-muted">A group reward.
                                                Rewards all members that have accepted their badge in this member's unit.
                                                <b>Point value: {{ $points }} points per member</b></span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                                wire:click="tenantReward">Send</button>
                            <a class="page-btn page-btn-red" href="javascript:void(0);"
                                wire:click="closeRecognition">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        <!--Guest Recognition popup end modal -->


        <!-- deactivate badge modal second start -->
        <div class="modal common-border-modal deactivate-badge-modal fade" id="DeactivateBadge" tabindex="-1" aria-labelledby="DeactivateBadge" aria-hidden="true">
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

       {{-- error popup --}}
       <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="new_error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="new_error_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd new_closeErrorModal" >ok</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end error popup --}}

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
        
        {{-- Add badge --}}
        <div wire:ignore.self  keyboard = "false" class="modal dolphing_cove_modal fade"  id="unit_badge_modal" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($unit_name != '')
                            <h3 class="dolphincove_modal_title" >{{$unit_name}}</h3>
                        @endif
                        <a href="javascript:void(0);" class="refresh-btn" wire:click="refreshForm"><img
                                src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt="">
                            Refresh</a>
                    </div>
                    <div class="modal-body">
                        <div class="dolphing_cove_form">
                            <form>
                                <div class="row dolphin_row">
                                   
                                    @if(count($badgeDates) > 0)
                                         {{-- @dd(count($badgeDates)); --}}
                                        <div class="col-lg-6 dolphin_column input-date" >
                                            <label>*Lease Start Date </label>
                                            <input type="text" class="checkinDatePicker" style="background-color: #e8e8e8;" wire:model="checkin_date" disabled>
                                        </div>
                                        <div class="col-lg-6 dolphin_column input-date" >
                                            <label>*Lease End Date</label>
                                            <input type="text" class="checkoutDatePicker" style="background-color: #e8e8e8;"  wire:model="checkout_date" disabled>
                                        </div>
                                    @else
                                        <div class="col-lg-6 dolphin_column input-date">
                                            <label>*Lease Start Date</label>
                                            <input type="text" class="checkinDatePicker" wire:model="checkin_date" >
                                        </div>
                                        <div class="col-lg-6 dolphin_column input-date">
                                            <label>*Lease End Date</label>
                                            <input type="text" class="checkoutDatePicker" wire:model="checkout_date">
                                        </div>
                                    @endif
                                </div>
                                <div class="dolphin-outer-wraper">
                                        <div class="dolphin-cus-row">
                                            <div class="dolphin_column_left">
                                                <div class="dolphin_column_left_inner">
                                                    <h4 class="dolphin_sub_title">Email Address <span>({{$guest_count}}/{{$badge_count}})</span></h4>
                                                </div>
                                            </div>
                                            <div class="dolphin_column_right">
                                                <div class="dolphin_column_left_inner">
                                                    <h4 class="dolphin_sub_title">Badge Statuses</h4>
                                                </div>
                                            </div>
                                        </div>
                                        @if(count($guests) > 0)
                                            @foreach ($guests as $key=>$badgeguest)
                                                <div class="dolphin-cus-row dolphin-cus-row-new">
                                                    <div class="dolphin_column_left">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input" >
                                                                @if ($badgeguest->status == 1)
                                                                    <?php $parts = explode('.', $badgeguest->guest_email);
                                                                        $username = $parts[0]; ?>
                                                                    <span>{{ substr($username, 0, 1) . str_repeat('*', strlen($username) - 0) . '.' . $parts[1] }}</span>
                                                                @else
                                                                    <span>{{ $badgeguest->guest_email }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dolphin_column_right{{$key}}">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input" style="margin-left: 28px;">
                                                                @if ($badgeguest->status == 0 && $badgeguest->is_resend == 1)
                                                                    <span class="sky-text">Resent on
                                                                        {{ \Carbon\Carbon::parse($badgeguest->updated_at)->format('m/d') }}</span>
                                                                @elseif($badgeguest->status == 0)
                                                                    <span class="sky-text">Invite Sent</span>
                                                                @elseif($badgeguest->status == 1)
                                                                    <span class="text-green">Badge Activated</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        @for ($i = 1; $i <= $remaining_count; $i++)
                                            <div class="dolphin-cus-row dolphin-cus-row-new">
                                                <div class="dolphin_column_left">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input" x-data="{ isOpen: false }">
                                                            <?php $outdate = date('Y-m-d',strtotime($checkout_date))
                                                            ?>
                                                            @if($today < $outdate)
                                                                <input type="text" @keyup.tab="getEmail()"
                                                                wire:model.defer="email_addresses.{{ $i }}"
                                                                wire:keydown.enter="checkEmail">
                                                            @else
                                                                <input type="text" style="background-color: #e8e8e8;" @keyup.tab="getEmail()"
                                                                wire:model.defer="email_addresses.{{ $i }}"
                                                                wire:keydown.enter="checkEmail" disabled>
                                                            @endif
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
                                                <div class="dolphin_column_right{{ $i }}" style="display:none;">
                                                    <div class="dolphin_column_left_inner">
                                                        <div class="dolphin_input" style="margin-left: 28px;">
                                                            <span class="sky-text">Invite Sent</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="md-footer-top">
                        <p><strong>Lease Dates:-</strong> {{$checkin_date}} - {{$checkout_date}}</p>
                        <div class="md-footer-link">
                            <a href="javascript:void(0);" wire:click='adjustLease' class="adjustleasebutton"><small>Adjust Lease</small></a> 
                            <a href="javascript:void(0);" wire:click='SaveLease' class="saveleasebutton"><small>Save Lease</small></a> 
                            <a href="javascript:void(0);" wire:click='leaseRenewal'><small>Lease Renewal</small> (Add Term)</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="page-btn page-btn-green-peas sendbadge" id="send_badge"
                            href="javascript:void(0);" wire:click="sendBadge">Send Badge</button>
                        <a class="page-btn page-btn-red closeUnitBadge" href="javascript:void(0);">Close</a>
                        <a class="page-btn page-btn-blue" href="javascript:void(0);"
                            wire:click="clearBadgeDates">Clear Dates</a>
                    </div>
                </div>
        </div>
        {{-- End Add Badge --}}

        


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

                // $(".clear_list_data").click(function() {
                //     console.log('scsddcsdcsd');
                //     // location.reload();
                // });

                $(document).on('click', '.clear_list_data', function() {
                    location.reload();
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

                    @this.on('openAdjustLease', function() {
                        
                        // console.log(data);
                        $(".checkinDatePicker").css('background-color','');
                        $(".checkoutDatePicker").css('background-color','');
                        $(".checkinDatePicker").removeAttr('disabled',false);
                        $(".checkoutDatePicker").removeAttr('disabled',false);
                        $(".saveleasebutton").css('display','block');
                        $(".adjustleasebutton").css('display','none');
                        $('.sendbadge').prop('disabled',true);
                        $('.sendbadge').css('background-color','grey');
                        $('.sendbadge').css('cursor','none');
                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: '-6M',
                            setdate: new Date(),
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkin_date', e.target.value);
                            @this.emit('adjustdatepickerEnable');

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
                            @this.emit('adjustdatepickerEnable');

                        });
                    });

                   

                    // $(".closeSuccessModal").on('click',function(){
                    //     $("#success_modal").modal('hide');
                    //     $("#success_msg").text('');
                    // });


                    $(".closeUnitBadge").on('click',function(){
                        //location.reload();
                         $("#unit_badge_modal").modal('hide');
                         $("#resend_badge_modal").modal('hide');
                        // $(".checkinDatePicker").datepicker('setDate', null);
                        // $(".checkoutDatePicker").datepicker('setDate', null);
                    });

                    @this.on('badgeSent', data=> {
                        console.log(data.text);
                        $("#unit_badge_modal").modal('hide');
                        $("#success_modal").modal('show');
                        $("#success_msg").text(data.text);
                        
                    });

                    

                    function getEmail() {
                        window.livewire.emit('checkEmail');
                    }

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

                    @this.on('badgeError', data => {
                        console.log(data.text);
                        $("#success_modal").modal('show');
                        $("#success_msg").text(data.text);
                 
                        
                    });

                    @this.on('clearBadgeDate', data => {
                         console.log(data);
                        $('#ClearsDatesModal').modal('show');
                        $(".badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);
                    });

                    $(".closeClearModal").on('click',function(){
                        $('#ClearsDatesModal').modal('hide');
                    })

                    @this.on('removeBadgeDate', data => {
                        console.log(data);
                        $('#ClearsDatesModal').modal('hide');
                        $("#success_modal").modal('show');
                        $("#success_msg").text(data.text);
                        $('.checkinDatePicker').datepicker("destroy");
                        $('.checkoutDatePicker').datepicker("destroy");
                        $(".checkinDatePicker").datepicker({
                            dateFormat: "mm/dd/yy",
                            changeMonth: true,
                            changeYear: true,
                            minDate: '-6M',
                        }).on('change', function(e) {
                            console.log(e.target.value);
                            @this.set('checkin_date', e.target.value);

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

                        });
                    });

                    @this.on('closeSuccessPopup',function(){
                        // $("#clear_date_success_modal").modal('hide');
                        $("#success_modal").modal('hide');
                        $("#clear_date_success_modal").modal('hide');
                        $("#success_msg").text('');
                        $("#date_success_msg").text('');
                        $("#resend_badge_modal").modal('hide');
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
                            $('#DeactivateBadge').modal('show');
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
                    });

                    @this.on('newtermError', data => {
                        $("#new_error_modal").modal('show');
                        $("#new_error_msg").text(data.text);
                    });

                    $(".closeErrorModal").on('click',function(){
                        location.reload();
                        $("#error_modal").modal('hide');
                        $("#error_msg").text('');
                    });

                    $(".new_closeErrorModal").on('click',function(){
                        $("#new_error_modal").modal('hide');
                        $("#new_error_msg").text('');
                    });

                    @this.on('guestRecognitionpopup',function() {
                        $('#guest_Recognition').modal('toggle');
                    });

                    @this.on('disableguestRecognitionpopup',function() {
                        $('#guest_Recognition').modal('hide');
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
