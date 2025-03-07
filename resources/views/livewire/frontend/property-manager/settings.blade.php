<div>
    @push('style')
    <style>
        .selectedlisting ul {
            list-style: none;
            padding: 0px;
            width: 250px;
            position: relative;
            margin: 0;
            background: white;
        }
        .selectedlisting ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .selectedlisting ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .selectedlisting ul li:hover {
            cursor: pointer;
        }
    </style>

    @endpush
    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <input type="hidden" name="property_id"
                            value="{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->id : '' }}"
                            id="property_id">
                        <figure>
                            <img src="{{ asset('frontend_assets/images/rental-home-icon-1.svg') }}" alt="" />
                        </figure>
                    </div>
                    <div class="right-sec-rental">
                        <h3><span>{{ $selectedProperty->provider ? $selectedProperty->provider->name : '' }}</span>
                            <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($propertyDetails as $property)
                                        <li><a class="property_provider"
                                                wire:click.prevent="property_provider({{ $property->provider->id }})"
                                                href="javascript:void(0);"
                                                data-property_id="{{ $property->provider->id }}">{{ $property->provider ? $property->provider->name : '' }}</a>
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
                                                    id="property_address">{{ $selectedProperty->provider ? $selectedProperty->provider->address : '' }}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span>Mail:<span class="points-distributed-txt"><a
                                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
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
                                                id="distributePoint">{{ number_format($selectedProperty->provider->points_to_distribute) }}
                                                points</span>
                                        </h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="Corporate-Lead_Setting-mid">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="corporate-left-mid">
                            <ul>
                                <li class="property-text-one11">Gimmzi Page <a
                                        href="{{ route('frontend.provider.view_property_website') }}" target="_blank">View your
                                        page</a></li>
                                <li class="property-text12">Landing homepage for your property listing. What customers
                                    will see. These customers include registered and non-registered Smart Rewards users
                                </li>
                                <li>
                                    <button class="property-site-text border-0" wire:click.prevent="openSiteSettings"
                                        type="button">Gimmzi Page Settings</button>

                                    <button class="leads-managers" id="manage_contact_id" type="button"
                                        style="border: none;">Leads & managers</button>

                                    <button class="leads-managers" type="button" wire:click.prevent='enableqrcodebutton'
                                        style="background: #d69414!important;border: none;width: 27.33%;">QR Code</button>
                                </li>
                            </ul>
                        </div>

                        <div class="corporate-bottom">
                            <label>About <span
                                    id="about_property_name">{{ $selectedProperty->provider ? $selectedProperty->provider->name : '' }}</span></label>
                            <div class="setting_search_wrap">

                                <div class="setting_search_field" style="width: 100%;">
                                    <textarea id="property_description" wire:model.defer="description" placeholder="Write about your hotel here"
                                        {{ $is_readonly }}></textarea>
                                    <div class="edit-textarea">
                                        <button class="edit-textarea-btn" type="button"
                                            wire:click='editDescription'>{{ $edit_text }} <img
                                                src="{{ asset('frontend_assets/images/edit-icon.svg') }}"
                                                alt=""></button>
                                    </div>
                                    <div class="rd-text">
                                        <p>To Add Display Message Board Go To: <a
                                                href="{{ route('frontend.message-board') }}">Mesage Board page</a></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 corporate-right-text">
                        <ul>
                            <li>Limits:
                                <span class="property_term_limit">
                                    @if ($property_limit)
                                        @if ($property_limit->term_limit != null)
                                            {{ $property_limit->term_limit }}
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>This date range determines how long the tenant’s resident badge is active with your
                                apartment community</li>
                            <li>Frequency in which user automatically receive points:
                                <span class="property_frequency">
                                    @if ($property_limit)
                                        @if ($property_limit->frequency != null)
                                            {{ $property_limit->frequency }}
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>This is the frequency in which residents automatically receive points</li>
                            <li>Current point allowance schedule:
                                <span class="property_current_allowance">
                                    @if ($property_limit)
                                        @if ($property_limit->current_allowance_point_limit != null)
                                            {{ $property_limit->current_allowance_point_limit }} point
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>This is the amount in which residents automatically receive points</li>
                            <li>Sign Up Bonus Points:
                                <span class="property_sign_up">
                                    @if ($property_limit)
                                        @if ($property_limit->sign_up_bonus_point != null)
                                            {{ $property_limit->sign_up_bonus_point }} point
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>New residents receive courtesy points at signup</li>
                            <li>Low Point Balance:
                                <span class="property_low_point">
                                    @if ($property_limit)
                                        @if ($property_limit->low_point_balance != null)
                                            {{ $property_limit->low_point_balance }} point
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>This is the limit set to identify members have low point counts for easy point
                                distribution</li>
                            <li>Add Points:
                                <span class="property_add_point">
                                    @if ($property_limit)
                                        @if ($property_limit->add_point != null)
                                            {{ $property_limit->add_point }} point
                                        @endif
                                    @endif
                                </span>
                            </li>
                            <li>This is the number of points that are sent by apartment staff when using Add Points
                                button</li>
                            <li class="manage-limits"><button class="limitModal">Manage limits</button></li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="Manage-limitsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl white-modal modal-grey-bg">
            <div class="modal-content p-0">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Limit Settings</h5>
                        <button type="button" class="cancel-button" data-bs-dismiss="modal" aria-label="Close"
                            onClick="window.location.reload();">Close</button>
                </div>
                <div class="modal-body">
                    <div class="row modal-border-one">
                        <div class="col-lg-6">
                            <div class="limit-setting-top">
                                <div class="">
                                    <p>Basic Limit Settings</p>

                                </div>
                                <div class="">
                                    <div class="point-about-con limit-setting-top">

                                        <div class="curent-text1">
                                            Current term limit: {{$this->term_limit}}
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <span class="form-check">
                                                <input class="form-check-input update_term_limit" type="radio"
                                                    wire:model.defer="term_limit" value="1 year"  wire:click.prevent = "updateTermLimit('1 year')">
                                                <label class="form-check-label" for="1_year">
                                                    1 Year
                                                </label>
                                            </span>
                                            <span class="form-check">
                                                <input class="form-check-input update_term_limit" type="radio"
                                                wire:model.defer="term_limit"  value="2 year"  wire:click.prevent = "updateTermLimit('2 year')">
                                                <label class="form-check-label" for="2_year">
                                                    2 Year
                                                </label>
                                            </span>
                                            <span class="form-check">
                                                <input class="form-check-input update_term_limit" type="radio"
                                                wire:model.defer="term_limit"  value="3 year"  wire:click.prevent = "updateTermLimit('3 year')">
                                                <label class="form-check-label" for="3_year">
                                                    3 Year
                                                </label>
                                            </span>
                                            <span class="form-check">
                                                <input class="form-check-input update_term_limit" type="radio"
                                                wire:model.defer="term_limit" wire:click.prevent = "updateTermLimit('5 year')" value="5 year">
                                                <label class="form-check-label" for="5_year">
                                                    5 Year
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="point-about-con limit-setting-top">
                                        <div class="curent-text1">
                                            Frequency in which residents automatically receive points: {{$frequency_limit}}
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <span class="form-check">
                                                <input class="form-check-input update_frequency" type="radio"
                                                     wire:model.defer="frequency_limit" wire:click.prevent = "updateFrequency('Monthly')" value="Monthly">
                                                <label class="form-check-label" for="monthly">
                                                    Monthly
                                                </label>
                                            </span>
                                            <span class="form-check">
                                                <input class="form-check-input update_frequency" type="radio"
                                                     wire:model.defer="frequency_limit" wire:click.prevent = "updateFrequency('Weekly')" value="Weekly">
                                                <label class="form-check-label" for="weekly">
                                                    Weekly
                                                </label>
                                            </span>
                                        </div>

                                    </div>
                                    <div class="point-about-con limit-setting-top">
                                        <div class="curent-text1">
                                            Current allowance point: <span class="current_allowance"></span> @if($property_limit){{ $property_limit->current_allowance_point_limit }} points @endif
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <input type="text" wire:model = "current_point" class="allowance" /> <label>100 point
                                                minimum</label>
                                            <button wire:click='updateLimitSettings("current_allowance")' class="update_current_allowance">update</button>
                                            <br>
                                            @error('current_point')
                                                <div style="color:red;">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="point-about-con limit-setting-top">
                                        <div class="curent-text1">
                                            Sign Up Bonus Points: <span class="sign_up"></span>  @if($property_limit) {{ $property_limit->sign_up_bonus_point }} points @endif
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <input type="text" class="sign_up_point" wire:model = "signup_point"/> <label>100 point
                                                minimum</label>
                                            <button wire:click='updateLimitSettings("signup_bonus")' class="update_signup">update</button>
                                            <br>
                                            @error('signup_point')
                                                <div style="color:red;">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="point-about-con limit-setting-top">
                                        <div class="curent-text1">
                                            Low Point Balance: <span class="low_point"></span>  @if($property_limit){{ $property_limit->low_point_balance }} points @endif
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <input type="text" class="low_point_balance" wire:model = "low_point"/> <label>100 point
                                                minimum</label>
                                            <button wire:click='updateLimitSettings("low_point")' class="update_lowpoint">update</button>
                                            <br>
                                            @error('low_point')
                                                <div style="color:red;">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="point-about-con limit-setting-top">
                                        <div class="curent-text1">
                                            Add Points: <span class="add_point"></span> @if($property_limit) {{ $property_limit->add_point }} points @endif
                                        </div>
                                        <div class="point-minium point-top-one14">
                                            <input type="text" class="point" wire:model = "add_point"/> <label>25 point minimum</label>
                                            <button wire:click='updateLimitSettings("add_point")' class="update_point">update</button>
                                            <br>
                                            @error('add_point')
                                                <div style="color:red;">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 limit-setting-right">
                            <div class="point-about-con limit-setting-top">
                                <p>Tenant Recognition Limit Settings</p>
                                <div class="curent-text1">
                                    Tenant of The Month Reward: <span class="tenant_reward"></span>  @if($property_limit) {{ $property_limit->tenant_of_the_month_Reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="tenant_reward_point" wire:model = "tenant_point" /> <label>100 point
                                        minimum</label>
                                    <button  wire:click='updateLimitSettings("tenant_Reward")' class="update_tenant_reward">update</button>
                                    <br>
                                    @error('tenant_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="point-about-con limit-setting-top">
                                <div class="curent-text1">
                                    100% Pass Inspection Reward: <span class="inspection_Reward"></span> @if($property_limit) {{ $property_limit->pass_inspection_reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="inspection_reward_point" wire:model = "inspection_point" /> <label>100 point
                                        minimum</label>
                                    <button wire:click='updateLimitSettings("inspection_Reward")' class="update_inspection_reward">update</button>
                                    <br>
                                    @error('inspection_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="point-about-con limit-setting-top">
                                <div class="curent-text1">
                                    Because You Are A Great Tenant Reward: <span class="great_tenant"></span> @if($property_limit) {{ $property_limit->great_tenant_reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="great_tenant_point" wire:model = "great_tenant_point"/> <label>50 point
                                        minimum</label>
                                    <button wire:click='updateLimitSettings("great_tenant")' class="update_great_tenant">update</button>
                                    <br>
                                    @error('great_tenant_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="point-about-con limit-setting-top">
                                <div class="curent-text1">
                                    Community Helper Reward: <span class="community_helper"></span> @if($property_limit) {{ $property_limit->community_helper_reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="comunity_helper_point" wire:model = "helper_point"/> <label>50 point
                                        minimum</label>
                                    <button  wire:click='updateLimitSettings("community_helper")' class="update_community_helper">update</button>
                                    <br>
                                    @error('helper_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="point-about-con limit-setting-top">
                                <div class="curent-text1">
                                    Good Samaritan Reward: <span class="good_samaritan"></span> @if($property_limit) {{ $property_limit->good_samaritan_reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="good_samaritan_point" wire:model = "samaritan_point"/> <label>50 point
                                        minimum</label>
                                    <button wire:click='updateLimitSettings("good_samaritan")' class="update_good_samaritan">update</button>
                                    <br>
                                    @error('samaritan_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="point-about-con limit-setting-top">
                                <div class="curent-text1">
                                    Community Leader Reward: <span class="community_leader_reward"></span> @if($property_limit) {{ $property_limit->community_leader_reward }} points @endif
                                </div>
                                <div class="point-minium point-top-one14">
                                    <input type="text" class="community_leader_reward" wire:model = "community_leader_point"/> <label>50 point
                                        minimum</label>
                                    <button wire:click='updateLimitSettings("community_leader_point")' class="update_good_samaritan">update</button>
                                    <br>
                                    @error('community_leader_point')
                                        <div style="color:red;">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- manage_contact_info_modal -->

    <div wire:ignore.self class="modal fade cmn_modal_designs" id="manage_contact_info_modal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="table_user_top_sec_col_lft new">

                        <h3 id="property"></h3>

                    </div>

                    <div class="table_cmn_part_sgn">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Phone Number</th>
                                    <th>Ext</th>
                                    <th>Email Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="merchant_user_list">
                                @forelse ($getusers as $user)
                                    <tr id="removeuser_id{{ $user->provideruser->id }}">
                                        <td></td>
                                        <td id="">{{ $user->provideruser->full_name }}</td>
                                        <td>{{ $user->title->title_name }}</td>
                                        @if ($user->provideruser->phone != '')
                                            <td>{{ $user->provideruser->phone }}</td>
                                        @else
                                            <td>---</td>
                                        @endif
                                        @if ($user->provideruser->phone_ext != '')
                                            <td>{{ $user->provideruser->phone_ext }}</td>
                                        @else
                                            <td>---</td>
                                        @endif
                                        <td>{{ $user->provideruser->email }}</td>
                                        @if ($user->provideruser->id != Auth::user()->id)
                                            <td>
                                                <div class="selctd_table_sec">
                                                    <button class="btn btn-danger"
                                                        wire:click.prevent="showRemoveManager({{ $user->provideruser->id }})">Remove</button>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="selctd_table_sec">
                                                    ---
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <td>No User found</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                {{-- <form > --}}
                                <div class="selctd_table_sec large">

                                    <select id="available_user" wire:model.defer="manager_id">
                                        <option value="">Choose Available Management Level User</option>
                                        @foreach ($adduser as $data)
                                            <option value="{{ $data->provideruser->id }}">
                                                {{ $data->provideruser->full_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('manager_id')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="cmn_links_clkd">
                                    <input type="hidden" id="add_user_id">
                                    <button type="submit" class="btn"
                                        style="text-decoration: underline !important;color: #208ccb;"
                                        wire:click.prevent="activeManager">Add User</button>
                                </div>
                                {{-- </form> --}}
                            </div>

                            <div class="col-lg-6 option_avlbl_col_rght">
                                <div class="btn_foot_end">
                                    <a href="javascript:void(0)" class="btn_table_s rdd"
                                        data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- success modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="user_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" data-bs-dismiss="modal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- success modal end --}}


    {{-- remove lead manager --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeuser_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">
                            <h4>By removing, the user below will no longer have access to your provider portal</h4>
                            <h3 id="user_name"></h3>
                            <h4>Do you want to continue?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="removeManager">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- remove lead manager --}}


    {{-- Listing site settings --}}

    <div wire:ignore.self
        class="modal fade new-fade-modal-property-site-setting md-modal-property-site-setting white-modal"
        id="property_settingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-header">
                    <div class="modal-heading-property-site-setting w-100">
                        <h1>Gimmzi Page Settings</h1>
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="property-site-setting-website">
                        <div class="row">
                            <h3 style="margin-left: 17px;">
                                {{ $selectedProperty->provider ? $selectedProperty->provider->name : '' }}</h3>
                        </div>
                        <div class="row m-0">
                            <div class="col-lg-6 property-site-setting-website11">
                                <div class="">
                                    <div class="property-website-con">
                                        <h4>Gimmzi Page</h4>
                                        <div class="property-contain-r">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    wire:model.defer="status"
                                                    wire:click.prevent="updateListingWebsiteStatus(1)" value="1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    wire:model.defer="status"
                                                    wire:click.prevent="updateListingWebsiteStatus(0)" value="0">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="external-links-text1">External links connected to buttons on <b>Listing</b>
                                        page
                                        <a href="javascript:void(0);" class="external_manage"
                                            wire:click='externalLinkModal'>Manage</a>
                                    </div> --}}
                                    <div class="featured-mid-con">
                                        <span>Features</span>
                                        <a href="javascript:void(0);" wire:click="featureView"
                                            class="feature_view">View</a>
                                        <a href="javascript:void(0);" class="feature_manage"
                                            wire:click="featureManage">Manage</a>
                                        <span>Amenities</span>
                                        <a href="javascript:void(0);" class="amenity_view"
                                            wire:click='amenityView'>View</a>
                                        <a href="javascript:void(0);" class="amenity_manage"
                                            wire:click="amenityManage">Manage</a>
                                    </div>
                                    <div class="featured-mid-con bd-none" style="border-bottom: none;">
                                        {{-- <span>External links connected to buttons</span> --}}
                                    </div>



                                    <form wire:submit.prevent="updateExternalLink" id="editListId">
                                        <div class="modal-body">
                                            <div class="table_user_top_sec_col_lft new">
                                                <h3>External links connected to buttons</h3>
                                            </div>

                                            <div class="table_cmn_part_sgn">
                                                <table>
                                                    <thead>

                                                    </thead>
                                                    <tbody id="external_Data">
                                                        <tr>
                                                            <td>Contact Community</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="contact_community_url"
                                                                    class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('contact_community_url')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>Lease Online</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="lease_online_url"
                                                                    class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('lease_online_url')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Visit Direct Website</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="visit_website_url"
                                                                    class="form-control"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('visit_website_url')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>Phone</td>
                                                            <td style="text-align: center;"><input type="text"
                                                                    wire:model.defer="phone" class="form-control" id="contact_phone"
                                                                    style="width: 100%;border: 1px solid #b7aeae!important;">
                                                                <br>
                                                                @error('phone')
                                                                    <span class="invalid-message" role="alert"
                                                                        style="font-size: 12px; color:red;">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </td>
                                                        </tr>


                                                        <tr>
                                                            <td>Floor Plans</td>
                                                            <td style="text-align: center;">
                                                                <a href="javascript:void(0)" style="width: 100%;"
                                                                    class="btn_table_s blu viewFloorImages"
                                                                    wire:click.prevent="showFloorImages">Manage Floor
                                                                    Plan Images</a>
                                                            </td>

                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="hours-table">
                                            <table>
                                                <tr>
                                                    <th>Hours of oparation</th>
                                                    <th>open</th>
                                                    <th>close</th>
                                                    <th>closed all day</th>
                                                </tr>
                                                <tr>
                                                    <td>Sunday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='sunday_open_hour'>
                                                                        <option value="" selected>HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='sunday_open_minute'>
                                                                        <option value="" selected>MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='sunday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('sunday_open_hour')
                                                                @php $sunday_open_message = 'Please add sunday open time'@endphp
                                                            @enderror
                                                            @error('sunday_open_minute')
                                                                @php $sunday_open_message = 'Please add sunday open time'@endphp
                                                            @enderror
                                                            @error('sunday_open_time')
                                                                @php $sunday_open_message = 'Please add sunday open time'@endphp
                                                            @enderror
                                                            @if($sunday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$sunday_open_message}}</td></tr>
                                                            @endif
                                                        </table>


                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='sunday_close_hour'>
                                                                        <option value="">HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='sunday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='sunday_close_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('sunday_close_hour')
                                                                @php $sunday_close_message = 'Please add sunday close time'@endphp
                                                            @enderror
                                                            @error('sunday_close_minute')
                                                                @php $sunday_close_message = 'Please add sunday close time'@endphp
                                                            @enderror
                                                            @error('sunday_close_time')
                                                                @php $sunday_close_message = 'Please add sunday close time'@endphp
                                                            @enderror
                                                            @if($sunday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$sunday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='sunday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Monday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='monday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='monday_open_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='monday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('monday_open_hour')
                                                                @php $monday_open_message = 'Please add monday open time'@endphp
                                                            @enderror
                                                            @error('monday_open_minute')
                                                                @php $monday_open_message = 'Please add monday open time'@endphp
                                                            @enderror
                                                            @error('monday_open_time')
                                                                @php $monday_open_message = 'Please add monday open time'@endphp
                                                            @enderror
                                                            @if($monday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$monday_open_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='monday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='monday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='monday_close_time'>
                                                                        <option value="..."></option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('monday_close_hour')
                                                                @php $monday_close_message = 'Please add monday close time'@endphp
                                                            @enderror
                                                            @error('monday_close_minute')
                                                                @php $monday_close_message = 'Please add monday close time'@endphp
                                                            @enderror
                                                            @error('monday_close_time')
                                                                @php $monday_close_message = 'Please add monday close time'@endphp
                                                            @enderror
                                                            @if($monday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$monday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='monday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tuesday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='tuesday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='tuesday_open_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='tuesday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('tuesday_open_hour')
                                                                @php $tuesday_open_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @error('tuesday_open_minute')
                                                                @php $tuesday_open_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @error('tuesday_open_time')
                                                                @php $tuesday_open_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @if($tuesday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$tuesday_open_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='tuesday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='tuesday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='tuesday_close_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('tuesday_close_hour')
                                                                @php $tuesday_close_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @error('tuesday_close_minute')
                                                                @php $tuesday_close_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @error('tuesday_close_time')
                                                                @php $tuesday_close_message = 'Please add tuesday open time'@endphp
                                                            @enderror
                                                            @if($tuesday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$tuesday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='tuesday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Wednesday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='wednesday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='wednesday_open_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='wednesday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('wednesday_open_hour')
                                                                @php $wednesday_open_message = 'Please add wednesday open time'@endphp
                                                            @enderror
                                                            @error('wednesday_open_minute')
                                                                @php $wednesday_open_message = 'Please add wednesday open time'@endphp
                                                            @enderror
                                                            @error('wednesday_open_time')
                                                                @php $wednesday_open_message = 'Please add wednesday open time'@endphp
                                                            @enderror
                                                            @if($wednesday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$wednesday_open_message}}</td></tr>
                                                            @endif
                                                        </table>


                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='wednesday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='wednesday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='wednesday_close_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('wednesday_close_hour')
                                                                @php $wednesday_close_message = 'Please add wednesday close time'@endphp
                                                            @enderror
                                                            @error('wednesday_close_minute')
                                                                @php $wednesday_close_message = 'Please add wednesday close time'@endphp
                                                            @enderror
                                                            @error('wednesday_close_time')
                                                                @php $wednesday_close_message = 'Please add wednesday close time'@endphp
                                                            @enderror
                                                            @if($wednesday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$wednesday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='wednesday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Thursday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='thursday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='thursday_open_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select  wire:model='thursday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('thursday_open_hour')
                                                                @php $thursday_open_message = 'Please add thursday open time'@endphp
                                                            @enderror
                                                            @error('thursday_open_minute')
                                                                @php $thursday_open_message = 'Please add thursday open time'@endphp
                                                            @enderror
                                                            @error('thursday_open_time')
                                                                @php $thursday_open_message = 'Please add thursday open time'@endphp
                                                            @enderror
                                                            @if($thursday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$thursday_open_message}}</td></tr>
                                                            @endif
                                                        </table>


                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='thursday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='thursday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='thursday_close_time'>
                                                                        <option value=""><div class=""></div></option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('thursday_close_hour')
                                                                @php $thursday_close_message = 'Please add thursday close time'@endphp
                                                            @enderror
                                                            @error('thursday_close_minute')
                                                                @php $thursday_close_message = 'Please add thursday close time'@endphp
                                                            @enderror
                                                            @error('thursday_close_time')
                                                                @php $thursday_close_message = 'Please add thursday close time'@endphp
                                                            @enderror
                                                            @if($thursday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$thursday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='thursday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Friday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='friday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='friday_open_minute'>
                                                                        <option value="">MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='friday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('friday_open_hour')
                                                                @php $friday_open_message = 'Please add friday open time'@endphp
                                                            @enderror
                                                            @error('friday_open_minute')
                                                                @php $friday_open_message = 'Please add friday open time'@endphp
                                                            @enderror
                                                            @error('friday_open_time')
                                                                @php $friday_open_message = 'Please add friday open time'@endphp
                                                            @enderror
                                                            @if($friday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$friday_open_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='friday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='friday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='friday_close_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('friday_close_hour')
                                                                @php $friday_close_message = 'Please add friday close time'@endphp
                                                            @enderror
                                                            @error('friday_close_minute')
                                                                @php $friday_close_message = 'Please add friday close time'@endphp
                                                            @enderror
                                                            @error('friday_close_time')
                                                                @php $friday_close_message = 'Please add friday close time'@endphp
                                                            @enderror
                                                            @if($friday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$friday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" wire:model='friday_closed'>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Saturday</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='saturday_open_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select  wire:model='saturday_open_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='saturday_open_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('saturday_open_hour')
                                                                @php $saturday_open_message = 'Please add saturday open time'@endphp
                                                            @enderror
                                                            @error('saturday_open_minute')
                                                                @php $saturday_open_message = 'Please add saturday open time'@endphp
                                                            @enderror
                                                            @error('saturday_open_time')
                                                                @php $saturday_open_message = 'Please add saturday open time'@endphp
                                                            @enderror
                                                            @if($saturday_open_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$saturday_open_message}}</td></tr>
                                                            @endif
                                                        </table>

                                                    </td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <select wire:model='saturday_close_hour'>
                                                                        <option value="" >HH</option>
                                                                        <?php 
                                                                            $hourlimit = 12;
                                                                            for($i = 01; $i <= $hourlimit; $i++){
                                                                            ?>
                                                                            <option value="<?php echo $i;?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='saturday_close_minute'>
                                                                        <option value="" >MM</option>
                                                                        <?php 
                                                                            $minlimit = 59;
                                                                            for($j = 01; $j <= $minlimit; $j++){
                                                                            ?>
                                                                            <option value="<?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?>"><?php echo str_pad($j, 2, "0", STR_PAD_LEFT);?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select wire:model='saturday_close_time'>
                                                                        <option value="">...</option>
                                                                        <option value="AM">AM</option>
                                                                        <option value="PM">PM</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            @error('saturday_close_hour')
                                                                @php $saturday_close_message = 'Please add saturday close time'@endphp
                                                            @enderror
                                                            @error('saturday_close_minute')
                                                                @php $saturday_close_message = 'Please add saturday close time'@endphp
                                                            @enderror
                                                            @error('saturday_close_time')
                                                                @php $saturday_close_message = 'Please add saturday close time'@endphp
                                                            @enderror
                                                            @if($saturday_close_message != '')
                                                                <tr> <td style="color:red;" colspan=3>{{$saturday_close_message}}</td></tr>
                                                            @endif
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"  wire:model='saturday_closed'>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="modal-footer not_last">
                                            <div class="modal-footer-gap-none">
                                                <div class="new-gm-btn-wrap">
                                                    <div class="new-gm-btn-wrap-left">
                                                        <a class="btn-blue-outline" target="_blank" href="{{ route('frontend.provider.view_property_website') }}">Preview Gimmzi
                                                            Site</a>
                                                    </div>
                                                    <div class="btn_foot_end">
                                                        <button type="submit"
                                                            class="btn_table_s grn">Publish</button>
                                                        {{-- <a href="javascript:void(0)" class="btn_table_s rdd"
                                                            data-bs-dismiss="modal">Close</a> --}}
                                                    </div>
                                                </div>
                                                {{-- <div class="row option_avlbl_row align-items-center gy-2">
                                                    <div class="col-lg-6 option_avlbl_col_lft">
                                                    </div>
                                                    <div class="col-lg-6 option_avlbl_col_rght">
                    
                                                        <div class="btn_foot_end">
                                                            <button type="submit" class="btn_table_s grn">Save</button>
                                                            <a href="javascript:void(0)" class="btn_table_s rdd"
                                                                data-bs-dismiss="modal">Close</a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 property-left-right-space">
                                <div class="row">
                                    <div class="col-md-5 contact-info-con-top">
                                        {{-- Contact info <a href="#view_contact_info_modal" data-bs-toggle="modal"
                                                role="button">View</a> <a href="#manage_contact_info_modal"
                                                data-bs-toggle="modal" role="button">Manage</a> --}}
                                    </div>
                                    <!-- <div class="col-md-7 contact-info-con-top property-left-right-space">
                                        Property Type Currnet : Standard <a href="#">Change</a>
                                    </div> -->
                                </div>

                                <div class="uploard-top-one">
                                    Upload Photos
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="uploard-logo-one">
                                            <input type="file" class="uploard-file-one" multiple id="edit_photos"
                                                wire:model.defer='listing_images' accept="image/*" />
                                            <img
                                                src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                            <h4>Upload Photos</h4>
                                            <h5>10 MB Maximum</h5>
                                        </div>
                                    </div>


                                    <div class="col-sm-5">
                                        @if ($main_image)
                                            <div class="uploard-logo-one">
                                                <input type="file" class="uploard-file-one" />
                                                <img style="height: 125px;padding: 10px;"
                                                    src="{{ asset($main_image) }}" id="main_photo" />
                                            </div>
                                            <div class="delete_button" style="display: block;">
                                                <a style="color:red;" href="javascript:void(0);"
                                                    wire:click='deleteEditMainPhoto({{ $selectedProperty->provider->id }})'>Delete</a>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="editImage_clss" id="photo_preview">
                                            @if ($model_images)
                                                @foreach ($model_images as $image)
                                                    <div class="edit_img_wrapper">
                                                        <div class="editmake_photo_button">
                                                            <img id="" style="height: 109px;padding: 10px;"
                                                                src="{{ $image->getUrl() }}" />
                                                        </div>

                                                        <div class="delete_button button_for_edit">
                                                            <a style="color:red;" href="javascript:void(0);"
                                                                wire:click="deleteEditListPhoto({{ $image->id }})">Delete</a>
                                                            <a href="javascript:void(0);"
                                                                wire:click="makeEditMainPhoto({{ $image->id }})">Make
                                                                Main Photo</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @error('listing_images')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                </div>
                                <div class="uploard-top-one">
                                    Upload Media
                                </div>
                                <div class="row" style="margin-bottom: 31px;">
                                    <div class="col-sm-5">
                                        <div class="uploard-logo-one">
                                            <input type="file" class="uploard-file-one" id="edit_list_video"
                                                wire:model.defer='listing_videos' accept="video/mp4" />
                                            <img
                                                src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                            <h4>Upload Media</h4>
                                            <h5>10 MB Maximum</h5>
                                        </div>

                                        @error('listing_videos')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">

                                        <div class="" wire:ignore>
                                            <video style="display:none;" id="edit_preview_media" width="200"
                                                height="147" controls>
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>


                                    </div>
                                    <div class="col-sm-5">

                                        @if ($model_video)
                                            <video id="edit_video" width="230" height="147" controls
                                                src="{{ $model_video->getUrl() }}" type="video/mp4">
                                                {{--
                                            <source src=""> --}}
                                            </video>
                                            <div class="delete_button" style="display: block;">
                                                <a style="color:red;" href="javascript:void(0);"
                                                    wire:click='deleteEditMedia()'>Delete</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Feature & amenities list modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="featureAmenityModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab"
                                            data-bs-target="#about" href="javascript:void(0);">Amenities</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @forelse ($features as $feature_data)
                                                <div class="feature-list">
                                                    <p>{{ $feature_data->feature_text }}</p>
                                                </div>

                                            @empty
                                                <div class="feature-list">
                                                    <p>There are no features</p>
                                                </div>
                                            @endforelse

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @forelse ($amenities as $amenity_data)
                                                <div class="feature-list">
                                                    <p>{{ $amenity_data->amenity_text }}</p>
                                                </div>
                                            @empty
                                                <div class="feature-list">
                                                    <p>There are no amenities</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <div class="f-btm-outr">
                                <form class="feature-form">

                                </form>
                                <div class="btn-wrap">
                                    <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Feature add-edit modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="featureManageModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @if (count($features) > 0)
                                                @foreach ($features as $feature_data)
                                                    <div class="feature-list">
                                                        <p>{{ $feature_data->feature_text }}</p>
                                                        <div class="feaure-btn">
                                                            <a href="javascript:void(0);" class="edit-btn"
                                                                wire:click="editFeature({{ $feature_data->id }})">Edit</a>|
                                                            <a href="javascript:void(0);" class="rmve-btn"
                                                                wire:click="removeFeature({{ $feature_data->id }})">Remove</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="feature-list">
                                                    <p>There are no features</p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                     <div class="feature-tab-body">
                                         @if (count($amenities) > 0)
                                         @foreach ($amenities as $amenity_data)
                                         <div class="feature-list">
                                             <p>{{$amenity_data->amenity_text}}</p>
                                         </div>
                                         @endforeach
                                         @else
                                         <div class="feature-list">
                                             <p>There are no amenities</p>
                                         </div>
                                         @endif
                                     </div>
                                 </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <form class="feature-form" wire:submit.prevent="updateFeature">
                                <div class="f-btm-outr">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter text"
                                            wire:model.defer="provider_feature">
                                        <input type = "hidden" wire:model.defer = "feature_id">
                                    </div>

                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd"
                                            wire:click="closeFeatureManage">Close</button>
                                    </div>
                                </div>
                                @error('provider_feature')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end Feature add-edit modal end --}}

    {{-- amenities add-edit modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="amenitiesManageModal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Amenities</a>
                                    </li>
                                    {{-- <li class="nav-item" disabled>
                                   <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"  href="javascript:void(0);">Amenities</a>
                                 </li> --}}
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if (count($amenities) > 0)
                                                @foreach ($amenities as $amenity_data)
                                                    <div class="feature-list">
                                                        <p>{{ $amenity_data->amenity_text }}</p>
                                                        <div class="feaure-btn">
                                                            <a href="javascript:void(0);" class="edit-btn"
                                                                wire:click="editAmenities({{ $amenity_data->id }})">Edit</a>|
                                                            <a href="javascript:void(0);" class="rmve-btn"
                                                                wire:click="removeAmenities({{ $amenity_data->id }})">Remove</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="feature-list">
                                                    <p>There are no amenities</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="feature-modal-btm editForm">
                            <form class="feature-form" wire:submit.prevent="updateAmenity">
                                <div class="f-btm-outr">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter text"
                                            wire:model.defer="provider_amenity">
                                        <input type = "hidden" wire:model.defer = "amenity_id">
                                    </div>

                                    <div class="btn-wrap">
                                        <button type="submit" class="btn_table_s grn" name="submit">Add</button>
                                        <button type="button"class=" btn_table_s rdd"
                                            wire:click="closeAmenityManage">Close</button>
                                    </div>
                                </div>
                                @error('provider_amenity')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end amenities add-edit modal end --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="feature_success_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="featuremsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideFeatureSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="external_success_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="externalmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideExternalSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- floor plan model --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="FloorimageModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <form wire:submit.prevent="submitFloorPlan">

                            <div class="cmn_secthd_modals">
                                <div class="manage-modal-outr">
                                    <h4>Floor Plan Manager</h4>
                                    <div class="manage-modal-inn">
                                        <div class="row m-row">
                                            <div class="col-md-3">
                                                <div class="manage-modal-lft">
                                                    <div class="uploard-logo-one">
                                                        <input type="file" class="uploard-file-one"
                                                            id="floor_image1" name="floor_image1"
                                                            wire:model.defer="floor_image1" accept="image/*">
                                                        @if($floor_plan)
                                                            @if ($floor_plan->floor_image1 != null)
                                                                <img src="{{ $floor_plan->floor_image1 }}"
                                                                    id="floorimage1_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @else
                                                                <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                                    id="floorimage1_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @endif
                                                        @else
                                                            <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                            id="floorimage1_preview"
                                                            style="height: 39px; border-radius: 7%;">
                                                        @endif
                                                        <h4 id="floorimage1_title">Floor Plan Image</h4>
                                                        <input type="hidden" id="edit_image1">
                                                    </div>
                                                    {{-- @error('floor_image1')
                                            <span class="invalid-message" role="alert"
                                                style="font-size: 12px; color:red;">
                                                {{ $message }}
                                            </span>
                                        @enderror --}}
                                                    <div class="feaure-btn">
                                                        <a href="javascript:void(0);" class="rmve-btn deleteimage1"
                                                            wire:click.prevent="deleteimage1">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9" style="margin-bottom: 27px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bedroom1" name="bedroom1"
                                                                wire:model.defer="bedroom_1">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bathroom1" name="bathroom1"
                                                                wire:model.defer="bathroom_1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>Total sqft.</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="total1" name="total1"
                                                                wire:model.defer="total_1">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-btn">
                                                            <a href="javascript:void(0);" id="clear1_all"
                                                                wire:click.prevent="clearAll1">Clear All</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="row1error" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="manage-modal-inn">
                                        <div class="row m-row">
                                            <div class="col-md-3">
                                                <div class="manage-modal-lft">
                                                    <div class="uploard-logo-one">
                                                        <input type="file" class="uploard-file-one"
                                                            id="floor_image2" name="floor_image2"
                                                            wire:model.defer="floor_image2">
                                                        @if($floor_plan)
                                                            @if ($floor_plan->floor_image2 != null)
                                                                <img src="{{ $floor_plan->floor_image2 }}"
                                                                    id="floorimage2_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @else
                                                                <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                                    id="floorimage2_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @endif
                                                        @else
                                                            <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                            id="floorimage2_preview"
                                                            style="height: 39px; border-radius: 7%;">
                                                        @endif
                                                        <h4 id="floorimage2_title">Floor Plan Image</h4>
                                                        <input type="hidden" id="edit_image2">
                                                    </div>
                                                    <span id="floorimage2error"></span>
                                                    <div class="feaure-btn">

                                                        <a href="javascript:void(0);" class="rmve-btn deleteimage2"
                                                            wire:click.prevent="deleteimage2">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9" style="margin-bottom: 27px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bedroom2" name="bedroom2"
                                                                wire:model.defer="bedroom_2">
                                                        </div>
                                                        <span id="bedroom2error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bathroom2" name="bathroom2"
                                                                wire:model.defer="bathroom_2">
                                                        </div>
                                                        <span id="bathroom2error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>Total sqft.</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="total2" name="total2"
                                                                wire:model.defer="total_2">
                                                        </div>
                                                        <span id="total2error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-btn">
                                                            <a href="javascript:void(0);" id="clear2_all"
                                                                wire:click.prevent="clearAll2">Clear All</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="row2error" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="manage-modal-inn" style="border-bottom: 0px!important;">
                                        <div class="row m-row">
                                            <div class="col-md-3">
                                                <div class="manage-modal-lft">
                                                    <div class="uploard-logo-one">
                                                        <input type="file" class="uploard-file-one"
                                                            id="floor_image3" name="floor_image3"
                                                            wire:model.defer="floor_image3">
                                                        @if($floor_plan)
                                                            @if ($floor_plan->floor_image3 != null)
                                                                <img src="{{ $floor_plan->floor_image3 }}"
                                                                    id="floorimage3_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @else
                                                                <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                                    id="floorimage3_preview"
                                                                    style="height: 39px; border-radius: 7%;">
                                                            @endif
                                                        @else
                                                            <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg"
                                                            id="floorimage3_preview"
                                                            style="height: 39px; border-radius: 7%;">
                                                        @endif
                                                        <h4 id="floorimage3_title">Floor Plan Image</h4>
                                                        <input type="hidden" id="edit_image3">
                                                    </div>
                                                    <span id="floorimage3error"></span>
                                                    <div class="feaure-btn">

                                                        <a href="javascript:void(0);" class="rmve-btn deleteimage3"
                                                            wire:click.prevent="deleteimage3">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9" style="margin-bottom: 27px;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bedroom3" name="bedroom3"
                                                                wire:model.defer="bedroom_3">
                                                        </div>
                                                        <span id="bedroom3error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="bathroom3" name="bathroom3"
                                                                wire:model.defer="bathroom_3">
                                                        </div>
                                                        <span id="bathroom3error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-modal-inr">
                                                            <h3>Total sqft.</h3>
                                                            <input type="text" onkeypress="return isNumber(event);"
                                                                id="total3" name="total3"
                                                                wire:model.defer="total_3">
                                                        </div>
                                                        <span id="total3error"></span>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="manage-btn">
                                                            <a href="javascript:void(0);" id="clear3_all"
                                                                wire:click.prevent="clearAll3">Clear All</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="row3error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer not_last">
                                    <div class="modal-footer-gap-none">
                                        <div class="row option_avlbl_row align-items-center gy-2">
                                            <div class="col-lg-2 option_avlbl_col_lft">
                                            </div>
                                            <div class="col-lg-10 option_avlbl_col_rght">
                                                <div class="btn_foot_end">
                                                    <button type="submit" name="submit"
                                                        class="btn_table_s grn">Save</button>
                                                    <a href="javascript:void(0)" class="btn_table_s rdd"
                                                        data-bs-dismiss="modal">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="floor_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="floormsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideFloorSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="delete_img_success_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="deleteMsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="hideDeleteModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- remove images --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_images_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">

                            <h4 id="removetext"></h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="removePropertyImage">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- remove lead manager --}}


    {{-- remove video --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_video_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">

                            <h4 id="removetext">Are you sure? Do you want to delete this media?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="removePropertyVideo">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- remove features --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeFeature"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">

                            <h4 id="removetext">Are you sure? Do you want to delete this?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="featureRemoveConfirm">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- remove amenity --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeAmenity"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">

                            <h4 id="removetext">Are you sure? Do you want to delete this?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    wire:click.prevent="amenityDeleteConfirm">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self class="modal qrscanModal_popUp fade modal-qrcode" id="qrscanModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="closeBtn_wrap">
                        <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal"
                            aria-label="Close">cancel</a>
                    </div>
                    <div class="closeBtn_wrap d-flex gap-2 selectedlisting">
                        {{-- <input type="text" placeholder="Search for unit using unit name"
                        wire:model.defer="search_unit" wire:keyup="searchUnit"> --}}
                        <div class="wrap-pop-info">
                            <div class="left-col-form">
                                <div class="row">
                                    <div class="col-sm-12 my-auto">
                                        <div class="">
                                            <div class="new_col_wrp">
                                                <div class="new_col">
                                                    <label>Select Building</label>
                                                    <select wire:model.live='select_building'>
                                                        <option value="all">Select Building</option>
                                                        @if($buldingList)
                                                            @foreach ($buldingList as $building_data)
                                                                <option value="{{$building_data->id}}">{{$building_data->building_name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="new_col enterunit">
                                                    <label>Enter Unit Number</label>
                                                    <div class="enterunit_dropdown_parent">
                                                        <input type="text" placeholder="Search for unit using unit name"
                                                        wire:model.defer="search_unit" wire:keyup="searchUnit">
                                                        <div class="selectedlisting">
                                                            @if($showdiv)
                                                                <ul>
                                                                    @if(!empty($result))
                                                                    @foreach($result as $result_data)
            
                                                                    <li wire:click="autocompleteUnitSelect({{ $result_data->id }})">{{$result_data->unit}}</li>
            
                                                                    @endforeach
                                                                    @endif
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="selectedlisting">
                                        @if($showdiv)
                                            <ul>
                                                @if(!empty($result))
                                                @foreach($result as $result_data)
        
                                                <li wire:click="autocompleteUnitSelect({{ $result_data->id }})">{{$result_data->unit}}</li>
        
                                                @endforeach
                                                @endif
                                            </ul>
                                        @endif
                                    </div> --}}
                                </div>
                            </div>
                            <div class="right-col-btn"><a href="javascript:void(0);" class="setting_timing" wire:click="resetUnit">Reset</a></div>
                        </div>

                        
                    </div>
                    
                    <div class="qrscanModal_body_innr">
                        {{-- <h2>Welcome to {{$selected_unit_name}}!</h2> --}}
                        <h2>Welcome to {{$selectedProperty->provider->name}}!</h2>

                        <p class="subtitle"><strong>We are delighted to welcome you into our community!
                            </strong>
                        </p>
                        <p>As a thank you for staying with us, we'd like to introduce you
                            to <a href="javascript:void(0);">Gimmzi Smart Rewards</a>– a new way to discover
                            local attractions and businesses while earning rewards.
                        </p>
                        <p>Simply scan the QR code with your smartphone and you'll be directed
                            to the Gimmzi app. From there, you can browse through a list of local
                            businesses that participate in our rewards program. By checking in, making a
                            purchase, or referring a friend, you'll earn points that you can
                            redeem for discounts, freebies, and more.</p>
                        <p>Here are just a few examples of the rewards you can earn:</p>
                        <div class="qrCode_rw">
                            <div class="qrTxt_col">
                                <p>Free coffee at a nearby café</p>
                                <p>10% off your bill at a popular restaurant</p>
                                <p>A free mini-golf game at a local attraction</p>
                                <p>A discount on a spa treatment at a nearby resort</p>
                                <span class="partner_logo_wrap"><img
                                        src="{{ asset('frontend_assets/images/gimmzilogo.jpg')}}" alt=""></span>
                            </div>
                            <div class="qaCode_col">
                                <div class="qrCode_wrap">
                                    @if($qr_image)
                                    <span>
                                        <img id="qr_img" src="data:image/png;base64, {{$qr_image}}">
                                        {{-- <img id="qr_img" src="{{ asset('frontend_assets/images/qr-code.png')}}"
                                            alt=""> --}}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="print_dwnlad_wrap">
                            <?php //print_r($text1);?>
                            <input type="hidden" value="{{$text1}}" id="myInput">
                            
                            @if($selected_unit_name != '')
                                <a href="{{route('frontend.apartment-download-pdf',$selected_unit_id)}}">[Download]<span><img
                                            src="{{ asset('frontend_assets/images/download.svg')}}" alt=""></span></a>
                                <a href="javascript:void(0);" onclick="myFunction()">[Copy Link]<span><img
                                            src="{{ asset('frontend_assets/images/copy_link.svg')}}" alt=""></span></a>
                                <span style="margin-left: 151px;"> Exclusive Deals for {{$selected_unit_name}} </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            function myFunction(){
                var copyText = document.getElementById("myInput");
                console.log(copyText);
                navigator.clipboard.writeText(copyText.value);
                alert('Link Copied');
            
            }
            $(document).on('click', '#manage_contact_id', function() {
                $("#manage_contact_info_modal").modal('show');
            })

            document.addEventListener('livewire:load', function(event) {

                $(".limitModal").on('click', function() {
                    $('#Manage-limitsModal').modal('show');
                })


                window.livewire.on('siteSettingsModal', function() {
                    $('#property_settingModal').modal('show');
                });

                window.livewire.on('showRemoveModal', data => {
                    $('#removeuser_modal').modal('show');
                    $("#user_name").html(data.name);
                });

                window.livewire.on('userSuccessModal', data => {
                    $('#user_success_modal').modal('show');
                    $("#successmsg").html(data.text);
                    $('#removeuser_modal').modal('hide');
                });

                @this.on('featureList', data => {
                    $('#featureAmenityModal').modal('show');
                });

                @this.on('amenityList', data => {
                    $('#featureAmenityModal').modal('show');
                    $('#home-tab').removeClass('active');
                    $('#about-tab').addClass('active');
                    $('#about-tab').addClass('show');
                    $('#home').removeClass('active');
                    $('#home').removeClass('show');
                    $('#about').addClass('active');
                    $('#about').addClass('show');

                });

                @this.on('featureManageOpen', function() {
                    $('#featureManageModal').modal('show');
                });

                @this.on('featureManageClose', function() {
                    $('#featureManageModal').modal('hide');
                });

                @this.on('amenityManageOpen', function() {
                    $('#amenitiesManageModal').modal('show');
                });

                @this.on('amenityManageClose', function() {
                    $('#amenitiesManageModal').modal('hide');
                });

                @this.on('featureSuccessModal', data => {
                    $('#feature_success_modal').modal('show');
                    //  console.log(data.text);
                    $("#featuremsg").html(data.text);

                });
                @this.on('featureManageClose', function() {
                    $('#featureManageModal').modal('hide');
                });
                @this.on('hidefeaturesuccessModal', function() {
                    $('#feature_success_modal').modal('hide');
                });

                @this.on('exteralSuccessModal', data => {
                    $('#external_success_modal').modal('show');
                    $("#externalmsg").html(data.text);

                });
                @this.on('hideExternalsuccessModal', function() {
                    $('#external_success_modal').modal('hide');
                    $('#SetLocation').modal('hide');
                    $("#emailAddressModal").modal('hide');
                });
                @this.on('openFloorImagesModal', function() {
                    $('#FloorimageModal').modal('show');
                });

                @this.on('floorSuccessModal', data => {
                    $('#floor_success_modal').modal('show');
                    $("#floormsg").html(data.text);

                });
                @this.on('hideFloorsuccessModal', function() {
                    $('#floor_success_modal').modal('hide');

                });

                @this.on('deleteImageModal', data => {
                    $('#delete_img_success_modal').modal('show');
                    $("#deleteMsg").html(data.text);

                });

                @this.on('hidedeleteModal', function() {
                    $('#delete_img_success_modal').modal('hide');

                });


                @this.on('showRemoveImageModal', data => {
                    $('#remove_images_modal').modal('show');
                    $("#removetext").html(data.text);

                });

                @this.on('hideRemoveImageModal', function() {
                    $('#remove_images_modal').modal('hide');

                })


                @this.on('showRemoveMediaModal', data => {
                    $('#remove_video_modal').modal('show');
                    // $("#removetext").html(data.text);

                });

                @this.on('hideRemoveMediaModal', function() {
                    $('#remove_video_modal').modal('hide');

                })

                @this.on('showRemoveFeatureModal', data => {
                    $('#removeFeature').modal('show');
                    // $("#removetext").html(data.text);

                });
                @this.on('hideRemoveFeatureModal', function() {
                    $('#removeFeature').modal('hide');

                })

                @this.on('showRemoveAmenitiesModal', data => {
                    $('#removeAmenity').modal('show');
                    // $("#removetext").html(data.text);
                });

                @this.on('hideRemoveAmenitiesModal', function() {
                    $('#removeAmenity').modal('hide');
                })

                @this.on('enableqrcodeModal', function() {
                    $('#qrscanModal').modal('show');
                })


                $('#contact_phone').keypress(function(event){
                    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
                        event.preventDefault();
                    }
                    else{
                        $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'));
                        //@this.set('contact_community_url', event.target);
                    }
                });
                
                
            })
        </script>
    @endpush

</div>
