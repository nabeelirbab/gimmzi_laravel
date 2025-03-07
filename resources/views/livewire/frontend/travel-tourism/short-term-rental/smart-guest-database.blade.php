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
            
        </style>
    @endpush
    <div class="all-smart-rental-database-main-sec show-filled-units-only smart-badges">
        {{-- <div class="first-smart-rental-sec">
            <div class="container">
                <h2>Search smart travel database</h2>
                <div class="form-group-rental-input">
                    <input type="text" class="search-input dropdown-toggle custom-droup-down search"
                        placeholder="Search tenant using First Name, Last Name, or Unit Number....." id="autocomplete" />
                    <input type='hidden' id='selectitem_id' />
                    <button class="search-button searchConsumer"></button>
                </div>
            </div>
        </div> --}}

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <figure>
                            <img src="{{ $user->travelType->short_term_logo }}" alt="" />
                        </figure>
                    </div>

                    <div class="right-sec-rental">
                        <h3>{{ $user->travelType->name }}</h3>

                        <div class="apartments-sec">
                            <ul>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt="" /></span><strong>Address:</strong>
                                            &nbsp;<span><label>{{ $user->travelType->address }}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span><strong>Mail:</strong><span
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
                                                id="distributePoint">{{ number_format($user->travelType->points_to_distribute) }}
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

                            <div class="form-check">
                                <input class="form-check-input change_list" wire:model="selectedOption" type="radio"
                                    name="radio_change_list" id="flexRadioDefault1" value="default" />
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Default View
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input change_list" type="radio" name="radio_change_list"
                                    id="flexRadioDefault2" value="filledunit" wire:model="selectedOption" />
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Show Filled badges only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input change_list" type="radio" name="radio_change_list"
                                    id="flexRadioDefault3" value="openunits" wire:model="selectedOption" />
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Show open badges only
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex justify-content-end align-items-center filter-main">
                            <select class="form-select" aria-label="Default select example"
                                wire:click='badgeFilter($event.target.value)'>
                                <option disabled>Filter</option>
                                <option value="ALL">All</option>
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
                    @if ($selectedOption === 'filledunit')
                        <div class="col-md-10 smart-rentel-db" id="ajaxrentaldbtable">
                            <div class="scroll_table smart-badge-table">
                                <table class="table table-striped table-hover" style="position: relative;">
                                    <thead>
                                        <tr class="guest_tr">
                                            <th scope="col"></th>
                                            <th scope="col" style="padding: 20px 8px;">Guest</th>
                                            <th scope="col" style="padding: 20px 8px;">Listing Name</th>
                                            <th scope="col" style="padding: 20px 8px" class="smart-address-th">
                                                Address</th>
                                            <th scope="col" style="padding: 20px 8px;">Check in</th>
                                            <th scope="col" style="padding: 20px 8px;">Check out</th>
                                            <th scope="col" style="padding: 20px 8px">POINTS</th>
                                            <th scope="col" style="padding: 20px 8px;">Badge status</th>
                                            <th scope="col" style="padding: 20px 8px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($data) > 0)
                                            @foreach ($data as $list)
                                                <tr>

                                                    @if (isset($list['guest']))
                                                        <td><input class="form-check-input" name="select"
                                                                wire:click='checkListingStatus({{ $list['id'] }})'
                                                                type="radio" /></td>
                                                        <td>{{ $list['guest']['full_name'] ?? 'N/A' }}</td>
                                                    @else
                                                        <td><input class="form-check-input" name="select"
                                                                wire:click='checkListingStatus({{ $list['id'] }})'
                                                                type="radio" /></td>
                                                        <td>{{ $list['guest_email'] ?? 'N/A' }}</td>
                                                    @endif
                                                    <td>{{ $list['listing']['name'] ?? 'N/A' }}</td>
                                                    <td class="smart-address-th">
                                                        {{ $list['listing']['street_address'] ?? 'N/A' }}</td>
                                                    <td><a href="javascript:void(0);" wire:click.prevent="click_date_badge({{ $list['id'] }})">{{ $list['checkin_date'] ? date('m-d-Y', strtotime($list['checkin_date'])) : 'N/A' }}</a>
                                                    </td>
                                                    <td>{{ $list['checkout_date'] ? date('m-d-Y', strtotime($list['checkout_date'])) : 'N/A' }}
                                                    </td>
                                                    <td>{{ $list['guest']['point'] ?? 'N/A' }}</td>
                                                    @if ($list['badge_status'] == true)
                                                        <td><span style="color: green">Accepted</span></td>
                                                    @else
                                                        <td><span>Badge sent by {{ auth()->user()->first_name }} on
                                                                {{ date('m-d-Y', strtotime($list['created_at'])) }}
                                                            </span></td>
                                                        <td class="badge-cancel-td"><a class="badge-cancel"
                                                                wire:click="cancelBadgeRequest({{ $list['id'] }})"
                                                                href="javascript:void(0);"
                                                                style="color: red">Cancel</a></td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>No listing found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="vacation_page_next_prev_btn">

                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif

                    @if ($selectedOption === 'default')
                        <div class="col-md-10 smart-rentel-db" id="ajaxrentaldbtable">
                            <div class="scroll_table smart-badge-table">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col" style="padding: 20px 8px;">Guest</th>
                                            <th scope="col" style="padding: 20px 8px;">Listing Name</th>
                                            <th scope="col" style="padding: 20px 8px" class="smart-address-th">
                                                Address</th>
                                            <th scope="col" style="padding: 20px 8px;">Check in</th>
                                            <th scope="col" style="padding: 20px 8px;">Check out</th>
                                            <th scope="col" style="padding: 20px 8px">POINTS</th>
                                            <th scope="col" style="padding: 20px 8px;">Badge status</th>
                                            <th scope="col" style="padding: 20px 8px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($data as $list)
                                            <tr>
                                                <td></td>

                                                <td><a href="javascript:void(0);" class="pupUp_modal"
                                                        wire:click="ListingBadgeModal({{ $list['id'] }})">Open</a>
                                                </td>

                                                <td>{{ $list['name'] }}</td>

                                                <td class="smart-address-th">{{ $list['street_address'] ?? 'N/A' }}
                                                </td>

                                                <td>---</td>

                                                <td>---</td>

                                                <td>---</td>

                                                <td>---</td>
                                                <td class="badge-cancel-td"></td>
                                            </tr>
                                            @if (count($list['badges']) > 0)
                                            {{-- @dd($list['badges']) --}}
                                                @foreach ($list['badges'] as $key => $value)
                                                {{-- @dd($value); --}}
                                                    <tr>
                                                        <td>
                                                            @if (isset($value['badge_status']))
                                                                <input class="form-check-input" type="radio"
                                                                    name="select"
                                                                    wire:click='checkListingStatus({{ $value['id'] }})' />
                                                            @endif
                                                        </td>

                                                        @if ($value['guest'] == null)
                                                            <td>{{ $value['guest_email'] ?? 'N/A' }}</td>
                                                        @else
                                                            <td>{{ $value['guest']['full_name'] ?? 'N/A' }}</td>
                                                        @endif

                                                        @if (isset($value['listing']))
                                                            <td>{{ $value['listing']['name'] }}</td>
                                                        @else
                                                            <td>{{ $list['name'] }}</td>
                                                        @endif

                                                        @if (isset($value['listing']))
                                                            <td class="smart-address-th">
                                                                {{ $value['listing']['street_address'] }}</td>
                                                        @else
                                                            <td class="smart-address-th">
                                                                {{ $value['street_address'] ?? 'N/A' }}</td>
                                                        @endif
                                                        {{-- @dd( $value['id']) --}}
                                                        @if (isset($value['checkin_date']))
                                                            <td><a href="javascript:void(0);"  wire:click.prevent="click_date_badge({{ $value['id'] }})" >{{ $value['checkin_date'] ? date('m-d-Y', strtotime($value['checkin_date'])) : '---' }}</a>
                                                            </td>
                                                        @else
                                                            <td>---</td>
                                                        @endif

                                                        @if (isset($value['checkout_date']))
                                                            <td>{{ $value['checkout_date'] ? date('m-d-Y', strtotime($value['checkout_date'])) : '---' }}
                                                            </td>
                                                        @else
                                                            <td>---</td>
                                                        @endif
                                                        @if (isset($value['guest']['point']))
                                                            <td>{{ $value['guest']['point'] ?? 'N/A' }}</td>
                                                        @else
                                                            <td>---</td>
                                                        @endif

                                                        @if ($value['guest_email'] != null)
                                                            @if ($value['badge_status'] == true)
                                                                <td><span style="color: green">Accepted</span></td>
                                                                <td class="badge-cancel-td"></td>
                                                            @else
                                                                <td>Badge sent by {{ auth()->user()->first_name }} on
                                                                    {{ date('m-d-Y', strtotime($value['created_at'])) }}
                                                                </td>

                                                                <td class="badge-cancel-td"><a
                                                                        href="javascript:void(0);"
                                                                        class="badge-cancel"
                                                                        wire:click="cancelBadgeRequest({{ $value['id'] }})"
                                                                        style="color: red">Cancel</a></td>
                                                            @endif
                                                        @else
                                                            <td>---</td>
                                                            <td class="badge-cancel-td"></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @empty
                                            <td>No listing found</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="vacation_page_next_prev_btn">
                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif

                    @if ($selectedOption === 'openunits')
                        <div class="col-md-9 smart-rentel-db" id="ajaxrentaldbtable">
                            <div class="scroll_table smart-badge-table">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col" style="padding: 20px 8px;">Guest</th>
                                            <th scope="col" style="padding: 20px 8px;">Listing Name</th>
                                            <th scope="col" style="padding: 20px 8px" class="smart-address-th">
                                                Address</th>
                                            <th scope="col" style="padding: 20px 8px;">Check in</th>
                                            <th scope="col" style="padding: 20px 8px;">Check out</th>
                                            <th scope="col" style="padding: 20px 8px">POINTS</th>
                                            <th scope="col" style="padding: 20px 8px;">Badge status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $list)
                                            <tr>
                                                <td><input class="form-check-input unitCheck" type="radio" /></td>
                                                <td><a href="javascript:void(0);" class="pupUp_modal"
                                                        wire:click="ListingBadgeModal({{ $list['id'] }})">Open</a>
                                                </td>
                                                <td>{{ $list['name'] ?? 'N/A' }}</td>
                                                <td class="smart-address-th">{{ $list['street_address'] ?? 'N/A' }}
                                                </td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                            </tr>
                                        @empty
                                            <td>No listing found</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="vacation_page_next_prev_btn">
                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif

                    <div class="col-md-2">
                        <div class="btn_area_section" style="padding: 14px 20px;min-height: 1px;">
                            <span> Action </span>
                            <button type="button" class="btn green_btn add_point" id="resendBadgeBtn"
                                wire:click="resendBadge({{$guestBadge_id}})" disabled>Resend Badge</button>
                            <button type="button" class="btn red_btn deactive" id="deactivateBadgeBtn"
                                wire:click="deactivateBadge" disabled>Deactivate Badge</button>
                            <button type="button" class="btn sky_btn add_term" id="pointBtn" wire:click="addPoint"
                                disabled>Add Points</button>
                            <button class="btn yellow_btn view_profile" disabled id="guestRecogBtn"
                                wire:click="guestRecognition">Guest
                                Recognition</button>

                            <button class="btn sky_btn" wire:click='scheduledBadge'>Scheduled Badges</button>

                            <button class="btn purple_btn" disabled id="view_profile" wire:click='viewconsumerProfile'>View profile</button>


                            
                            {{-- <div class="scheduled_badges_wpr">
                                <a class="scheduled_badges_btn" href="javascript:void(0);"
                                    wire:click="scheduledBadge"><img
                                        src="{{ asset('frontend_assets/images/calender-time.svg') }}" alt="">
                                    Scheduled Badges</a>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- Listing badge popup modal -->
        <div wire:ignore.self data-bs-backdrop = 'static' keyboard = "false" class="modal dolphing_cove_modal fade"
            id="listing_badge_modal" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="dolphincove_modal_title" wire:ignore></h3>
                        <a href="javascript:void(0);" class="refresh-btn" wire:click="refreshForm"><img
                                src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt="">
                            Refresh</a>
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
                                                <h4 class="dolphin_sub_title">Email Address <span class="guest_count"
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
                                        @if ($remaining_guest > 0)
                                            @for ($i = 1; $i <= $remaining_guest; $i++)
                                                <div class="dolphin-cus-row">
                                                    <div class="dolphin_column_left">
                                                        <div class="dolphin_column_left_inner">
                                                            <div class="dolphin_input">
                                                                
                                                                <?php
                                                                    //$today = date('Y-m-d');
                                                                ?>
                                                                {{-- @if($today < $badge_checkout_date)  --}}
                                                                    <input type="text"
                                                                    wire:model.defer="email_addresses.{{ $i }}"
                                                                    wire:keydown.enter="checkEmail">
                                                                {{-- @else
                                                                    <input type="text" style="background-color: #e8e8e8;"
                                                                    wire:model.defer="email_addresses.{{ $i }}"
                                                                    wire:keydown.enter="checkEmail" disabled>
                                                                @endif --}}
                                                                {{-- <a class="common-found" href="#url" data-bs-toggle="modal"
                                                            data-bs-target="#MemberFound">asdf</a> --}}
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
                                                        <div class="dolphin_input">
                                                            <span class="sky-text">Invite Sent</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    @endif
                                @elseif($listing_guests > 0)
                                    @for ($i = 1; $i <= $listing_guests; $i++)
                                        <div class="dolphin-cus-row">
                                            <div class="dolphin_column_left">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input" x-data="{ isOpen: false }">
                                                        <?php
                                                            //$today = date('Y-m-d');
                                                        ?>
                                                        {{-- @if($today < $badge_checkout_date)  --}}
                                                            <input type="text" @keyup.tab="getEmail()"
                                                            wire:model.defer="email_addresses.{{ $i }}"
                                                            wire:keydown.enter="checkEmail">
                                                        {{-- @else
                                                            <input type="text" style="background-color: #e8e8e8;" @keyup.tab="getEmail()"
                                                            wire:model.defer="email_addresses.{{ $i }}"
                                                            wire:keydown.enter="checkEmail" disabled>
                                                        @endif --}}
                                                        {{-- <a class="common-found" href="#url" data-bs-toggle="modal"
                                                            data-bs-target="#MemberFound">asdf</a> --}}
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
                <button type="button" class="page-btn page-btn-green-peas" id="send_badge"
                    href="javascript:void(0);" wire:click="sendBadge">Send Badge</button>
                <a class="page-btn page-btn-red" href="javascript:void(0);"
                    wire:click="closebadgePopup">Close</a>
                <a class="page-btn page-btn-blue" href="javascript:void(0);"
                    wire:click="clearBadgeDates">Clear Dates</a>
            </div>
        </div>
    </div>
</div>
<!--Listing badge popup modal --> 
</div>

<!-- member found/notfound popup start modal -->
<div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="MemberFound" tabindex="-1"
aria-labelledby="MemberFound" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <a href="#url" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
        <div class="modal-body common-modal-body">
            <h4 class="manage-title">Member Found!</h4>
            <i class="check-img" data-bs-dismiss="modal" aria-label="Close"><img
                    src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
        </div>
    </div>
</div>
</div>
<!-- member found/notfound popup end modal -->

<!-- member found/notfound popup start modal -->
<div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="newMember" tabindex="-1"
aria-labelledby="MemberFound" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <a href="javascript:void(0);" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
        <div class="modal-body common-modal-body">
            <h4 class="manage-title">New Member!</h4>
            <i class="check-img" data-bs-dismiss="modal" aria-label="Close"><img
                    src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
        </div>
    </div>
</div>
</div>
<!-- member found/notfound popup end modal -->

<!-- Clears Dates start Modal -->
<div class="modal common-border-modal Clears-Dates-Modal fade" id="ClearsDatesModal" tabindex="-1"
aria-labelledby="ClearsDatesModal" aria-hidden="true">
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


<!-- cancel badge start request -->
<div class="modal common-border-modal Clears-Dates-Modal fade" id="cancelBadgeModal" tabindex="-1"
aria-labelledby="ClearsDatesModal" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body common-modal-body">
            <p>
                Would you like to cancel this invite?
            </p>
            <p>
                By canceling, the listing will return to OPEN status for new invites for dates .
            </p>
            <strong>{{ $cancel_checkin_Date }} - {{ $cancel_checkout_Date }}</strong>
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



<!-- point add start -->
    <div wire:ignore.self class="modal fade points_add_modal" id="addPointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <h6 id="heading"></h6>
                        <p id="pointModalmessage"></p>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- Point add end -->

<!-- scheduled badges start modal -->
<div wire:ignore.self class="modal scheduled_badges_modal fade" id="schedulemodal" tabindex="-1" aria-labelledby="schedulemodal" aria-hidden="true" style="padding-right: 15px; ">
    <div class="modal-dialog">
        <div class="modal-content">
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
                            placeholder="Type to search for listing name" wire:model.defer="search_name"
                            wire:keyup="searchListing">
                    </form>
                    <div class="selectedbadgelisting">
                        @if ($showdiv)
                            <ul>
                                @if (!empty($result))
                                    @foreach ($result as $result_data)
                                        <li wire:click="selectlisting({{ $result_data->id }})">
                                            {{ $result_data->name }}</li>
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
                                <th>Listing Name</th>
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
                                                        <span>{{ $badgeValue['listing']['name'] }}</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <?php $in_date = date_format(date_create($badgeValue['checkin_date']), 'm/d/Y'); ?>
                                            <?php $out_date = date_format(date_create($badgeValue['checkout_date']), 'm/d/Y'); ?>
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
                @if (count($monthly_scheduled) > 0)
                    <div class="scheduled_badges_modal_button">
                        <a class="page-btn page-btn-green-peas" href="javascript:void(0);"
                            wire:click="show_selected_badge">Select</a>
                        <a class="page-btn page-btn-red" href="javascript:void(0);"
                            wire:click="closebadgePopup">Cancel</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- scheduled badges end modal -->

<!-- selected badge show popup start modal -->
<div wire:ignore.self class="modal dolphing_cove_modal fade" id="selectedScheduleModal" tabindex="-1" aria-labelledby="selectedSchedule" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($badge)
                    <h3 class="dolphincove_modal_title">{{ $badge->listing->name }} Badges</h3>
                @endif
                <a href="javascript:void(0);" class="refresh-btn" wire:click="refreshForm"><img
                        src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt=""> Refresh</a>
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
                                                <div class="dolphin_input" style="margin-left: 28px;">
                                                    @if ($value->badge_status == 0 && $value->is_resend == 1)
                                                        <span class="sky-text">Resent on
                                                            {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                    @elseif($value->badge_status == 0)
                                                        <span class="sky-text">Invite Sent</span>
                                                    @elseif($value->badge_status == 1)
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
                                                    @if($badge_checkout_date < date('Y-m-d'))
                                                        <input type="text" @keyup.tab="getEmail()"
                                                            wire:model.defer="email_addresses.{{ $i }}"
                                                            wire:keydown.enter="checkEmail" style="background-color: #e8e8e8;" disabled>
                                                    @else
                                                        <input type="text" @keyup.tab="getEmail()"
                                                        wire:model.defer="email_addresses.{{ $i }}"
                                                        wire:keydown.enter="checkEmail">
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
            <a class="page-btn page-btn-red" href="javascript:void(0);"
                wire:click="closeSelectedBadge">Close</a>
            <a class="page-btn page-btn-blue" href="javascript:void(0);" wire:click="clearBadgeDates">Clear
                Dates</a>
        </div>
        <div class="row">
            <span style="text-align: center;margin-top: 20px;">Use<a wire:click="resendBadge({{$badgeid}})"
                    style="color: blue;" href="javascript:void(0);"> Resend </a>to resend badge invites</span>
        </div>

    </div>
</div>
</div>
<!--selected badge show popup end modal -->


<!-- deactivate badge modal second start -->
<div class="modal common-border-modal deactivate-badge-modal fade" id="DeactivateBadge" tabindex="-1"
aria-labelledby="DeactivateBadge" aria-hidden="true">
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
            <a href="javascript:void(0);" class="page-btn page-btn-green-peas"
                wire:click="yesDeacivateBadge">Yes</a>
        </div>
    </div>
</div>
</div>
</div>
<!-- deactivate badge modal second end -->

<!-- Resend badge popup modal start -->
<div wire:ignore.self class="modal dolphing_cove_modal fade" id="resend_badge_modal" tabindex="-1"
    aria-labelledby="dolphingcove" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($shortBadgeStatus)
                        <h3 class="dolphincove_modal_title">{{ $shortBadgeStatus->listing->name }} Badges</h3>
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
                                <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                    <div class="dolphin_colm_radiobox">
                                        @if($resend_checkout_date < date('m/d/Y'))
                                            <input class="form-check-input" type="checkbox" name="select"
                                                wire:model="selectAll"
                                                {{ count($globalSelected) > 0 ? '' : 'disabled' }} disabled/>
                                        @else
                                                <input class="form-check-input" type="checkbox" name="select"
                                                wire:model="selectAll"
                                                {{ count($globalSelected) > 0 ? '' : 'disabled' }} />
                                        @endif
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
                                @if (count($not_accept_badges) > 0)
                                    @foreach ($not_accept_badges as $key => $value)
                                        <div class="dolphin-cus-row dolphin-cus-row-new new-checkbx">
                                            <div class="dolphin_colm_radiobox">

                                                @if ($value->badge_status == 1)
                                                    <input class="form-check-input" type="checkbox" name="select"
                                                        disabled />
                                                @else
                                                   @if($resend_checkout_date < date('m/d/Y'))
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:model="bulkIds" name="select"
                                                            value="{{ $value->id }}"
                                                            wire:click='selectSingle({{ $value->id }})' disabled/>
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
                                            <div class="dolphin_column_right">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input">
                                                        @if ($value->badge_status == 0 && $value->is_resend == 1)
                                                            <span class="sky-text">Resent on
                                                                {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                        @elseif($value->badge_status == 0)
                                                            <span class="sky-text">Invite Sent</span>
                                                        @elseif($value->badge_status == 1)
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
                        wire:click="resend_pending_badge">Resend Badge</button>
                    <a class="page-btn page-btn-red" href="javascript:void(0);"
                        wire:click="closeRecentPopup">Close</a>
                    <a class="page-btn page-btn-blue" href="javascript:void(0);"
                        wire:click="clearRecendBadgeDates">Clear Dates</a>
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

<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
        <div class="modal-body">
            <div class="wrap_modal_cntntr">
                <div class="cmn_secthd_modals">
                    <h3 id="success_msg"></h3>
                </div>
                <div class="cmn_secthd_modals_btnnn">
                    <div class="btn_foot_end centr">
                        <button class="btn_table_s blu auto_wd" wire:click="hideSuccessModal">ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

{{-- resend error pop up --}}

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
                    <button class="btn_table_s blu auto_wd" wire:click="refreshForm">ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

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
                    {{-- <button class="btn_table_s blu auto_wd" wire:click="resendBadge">ok</button> --}}
                    <button class="btn_table_s blu auto_wd resendBadgeSuccessClose">ok</button>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Guest Recognition popup start modal -->
<div wire:ignore.self class="modal dolphing_cove_modal fade" id="guest_Recognition" tabindex="-1"
aria-labelledby="dolphingcove" aria-hidden="true">
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
                        <b>Guest of The Week</b> <br><span class="text-muted">An individual reward. Limited
                            to one reward per booking.
                            <b>Point value: {{ $points }} points</b></span>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="guest_reward_value"
                            value="family_friend" wire:model='guest_reward_value'>
                        <b>Family and Friends Rewards</b> <br><span class="text-muted">A group reward.
                            Rewards all members that have accepted their badge in this member's listing.
                            Limited to 2 rewards per booking.
                            <b>Point value: {{ $points }} points per member</b></span>
                    </label>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
            wire:click="guestReward">Send</button>
        <a class="page-btn page-btn-red" href="javascript:void(0);"
            wire:click="$emit('guestRecognition')">Cancel</a>
    </div>
</div>
</div>
</div>
<!--Guest Recognition popup end modal -->


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
                            <button class="btn_table_s blu auto_wd" onclick="window.location.reload()">ok</button>
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

@push('scripts')
<script>
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [month, day, year].join('/');
    }

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

    $(".off_modal").click(function() {
        $('#cancel_success_modal').modal('hide');
    })

    $(document).on('click', '.resendBadgeSuccessClose', function() {
        $("#resend_success_modal").modal('hide'); 
        // location.reload();
    });

    document.addEventListener('livewire:load', function(event) {

        @this.on('openListingBadge', data => {
            console.log(data);
            $('#listing_badge_modal').modal('show');
            //$('#listing_badge_modal').modal({'data-bs-backdrop': 'static', keyboard: false})  
            $(".dolphincove_modal_title").text(data.listing.name + " Badges");
            $(".guest_count").text('(0/' + data.listing.no_of_guests + ')');
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
                                return [true, 'eventrange ui-datepicker-unselectable', ''];
                            }
                            if (date > new Date(data.daterange[i].startDate) && date <=
                                previousDateObj) {
                                if (areDatesEqual(date, previousDateObj)) {
                                    return [true, 'eventrange ui-datepicker-unselectable', ''];
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
                @this.emit('dateCheckDateRange', data.listing.id);
            });
        });

        @this.on('memberSuccessPopup', data => {
            $(".dolphincove_modal_title").text(data.listing.name + " Badges");
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

        @this.on('hideSuccessPopup', data => {
            console.log(data);
            $("#success_msg").text(' ');
            if (data != '') {
                $(".dolphincove_modal_title").text(data.listing.name + " Badges");
                $("#success_modal").modal('hide');
                if (data.badges > 0) {
                    $("#send_badge").prop('disabled', true);
                } else {
                    $("#send_badge").prop('disabled', false);
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
                                    return [true, 'eventrange ui-datepicker-unselectable',
                                        ''
                                    ];
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
                                    return [true, 'eventrange ui-datepicker-unselectable',
                                        ''
                                    ];
                                }
                            }

                        }

                        return [true, '', ''];
                    }
                }).on('change', function(e) {
                    @this.set('checkout_date', e.target.value);
                    @this.emit('dateCheckDateRange', data.listing.id);
                });
            } else {
                $("#success_modal").modal('hide');
                location.reload();
                // $(".modal-backdrop").removeClass('show');
            }


        });

        @this.on('resetBadgeForm', data => {
            $(".dolphincove_modal_title").text(data.listing.name + " Badges");
            $(".guest_count").text('(' + data.badge_guest_count + '/' + data.listing.no_of_guests +
                ')');
            $("#invite_success_modal").modal('hide');
        });

        @this.on('badgeSent', data => {
            console.log(data.key_arr.length);
            if (data.key_arr.length > 0) {
                for (var i = 0; i <= data.key_arr.length; i++) {
                    $(".dolphin_column_right" + data.key_arr[i]).css('display', 'block');
                }
                $(".guest_count").text('(' + data.guest_badge_count + '/' + data.listing.no_of_guests +
                    ')');
                if (data.text) {
                    $("#invite_success_modal").modal('show');
                    $("#invite_success_msg").text(data.text);
                }

            } else {
                $(".guest_count").text('(' + data.guest_badge_count + '/' + data.listing.no_of_guests +
                    ')');
                if (data.text) {
                    $("#invite_success_modal").modal('show');
                    $("#invite_success_msg").text(data.text);
                }
            }

        });

        @this.on('resend_error_popup', data => {

            $("#error_resend__modal").modal('toggle');
            $("#resend_error_message").text(data.text);
        });



        @this.on('closeBadgePopup', function() {
            $('#listing_badge_modal').modal('hide');
            $('#schedulemodal').modal('hide');
            //location.reload();
        });

        @this.on('clearBadgeDate', data => {
            $('#ClearsDatesModal').modal('show');
            $(".badge_dates").text(data.checkindate + ' - ' + data.checkoutdate);

        });

        @this.on('enableActionBtns', function() {
            $("#resendBadgeBtn").prop('disabled', false);
            $("#deactivateBadgeBtn").prop('disabled', false);
            $("#pointBtn").prop('disabled', false);
            $("#guestRecogBtn").prop('disabled', false);
            $("#view_profile").prop('disabled', false);
            
        });

        @this.on('enableResendBtn', function() {
            $("#resendBadgeBtn").prop('disabled', false);
        });

        @this.on('removeBadgeDate', data => {
            $('#ClearsDatesModal').modal('hide');
            $('#resend_badge_modal').modal('hide');
            $(".guest_count").text('(0/' + data.listing.no_of_guests + ')');
            if (data.hide_popup) {
                if (data.hide_popup == true) {
                    $('#selectedScheduleModal').modal('hide');
                    $('#cancel_success_modal').modal('show');
                    $("#cancel_success_msg").text('Badge request is cancelled successfully');
                }

            }
        });

        @this.on('cancelBadgePopup', data => {
            $('#cancelBadgeModal').modal('show');
            //$(".guest_count").text('(0/'+data.listing.no_of_guests+')');
        });

        @this.on('successPopup', data => {
            $('#success_modal').modal('show');
            $("#success_msg").text(data.text);

        });

        @this.on('pointAddPopup', data => {
            $('#addPointModal').modal('show');
            if (data.status == 0) {
                $("#heading").text('');
            } else {
                $("#heading").text('Points Added!');
            }
            $('#pointModalmessage').text(data.message);
            $("#resendBadgeBtn").prop('disabled', false);
            $("#deactivateBadgeBtn").prop('disabled', false);
            $("#pointBtn").prop('disabled', false);
            $("#guestRecogBtn").prop('disabled', false);
            $("#view_profile").prop('disabled', false);


        })

        @this.on('scheduledBadgesPopup', function() {
            $('#schedulemodal').modal('show');
        });

        @this.on('selectedScheduledBadgesPopup', function() {
            $('#selectedScheduleModal').modal('show');
        });


        @this.on('selectedSuccessPopup', data => {
            $("#success_modal").modal('show');
            $("#success_msg").text(data.text);
        })

        @this.on('closeSelectedScheduledBadges', function() {
            $('#selectedScheduleModal').modal('hide');
        });

        @this.on('deactivateBadges', data => {
            if (data.type == 1) {
                $('#success_modal').modal('show');
                $("#success_msg").text("After check-in date you can't deactivate these badge");
            } else {
                $('#DeactivateBadge').modal('show');
            }
        });

        @this.on('successDeactivateBadges', function() {
            $('#success_modal').modal('show');
            $("#success_msg").text("Badge deactivated successfully");
        });

        @this.on('guestbadge', data => {
            $("#resend_success_modal").modal('hide');
            $('#resend_badge_modal').modal('show');
        });

        @this.on('guestbadgeClose', data => {
            $('#resend_badge_modal').modal('hide');
        });

        @this.on('badgeSuccessPopup', data => {
            $('#resend_badge_modal').modal('hide');
            $("#resend_success_modal").modal('show');
            $("#resend_success_msg").text(data.text);
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
