<div>
    @push('style')
    <style>
        .inputSelect_main ul {
            list-style: none;
            padding: 0px;
            width: 250px;
            position: relative;
            margin: 0;
            background: white;
        }

        .inputSelect_main ul li {
            background: lavender;
            padding: 4px;
            margin-bottom: 1px;
        }

        .inputSelect_main ul li:nth-child(even) {
            background: cadetblue;
            color: white;
        }

        .inputSelect_main ul li:hover {
            cursor: pointer;
        }
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
                        <figure>
                            <img src="{{ $user->travelType->short_term_logo }}" alt="" />
                        </figure>
                    </div>
                    <div class="right-sec-rental">
                        <div class="settings_title">
                            <h3 style="margin: 0 0 2px; line-height: 3.23em;">{{$user->travelType->name}}</h3>
                            <a href="javascript:void(0);" class="edit_provider_btn"
                                wire:click.prevent="editProviderDetail">edit provider details</a>
                        </div>

                        <div class="apartments-sec">
                            <ul>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                    alt="" /></span>Address:
                                            <span><label>{{$user->travelType->address}}</label></span>
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
                                            <span class="points-distributed-txt-new" id="distributePoint"
                                                style="margin-left: -9px;">
                                                {{number_format($user->travelType->points_to_distribute)}} Points
                                            </span>
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
                                <li class="property-text-one11">Listing Page <a href="javascript:void(0);"
                                        wire:click.prevent="mainListingWebsite">View Main Listing Website</a></li>
                                <li class="property-text12">Landing homepage for property listing.</li>
                                <li>
                                    {{-- <button class="property-site-text border-0" wire:click.prevent="listingSettings"
                                        type="button">Listing Page Settings</button> --}}

                                    <button class="leads-managers" id="manage_contact_id"
                                        wire:click.prevent="showLeadManager" type="button" style="border: none;">Leads &
                                        managers</button>

                                    <button class="leads-managers"
                                        style="background:#d69414!important;border: none;width: 27.33%;"
                                        wire:click.prevent="showQrCode" type="button" style="border: none;"> QR Code
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="corporate-bottom">

                            <div class="setting_search_wrap">
                                <div class="setting_search_field">
                                    <input type="text" wire:keydown.enter="searchList" wire:model.defer="searchName"
                                        placeholder="Search for listing using listing name">
                                </div>
                                <div class="setting_select_wrap">
                                    <select wire:change="statusWiseListing" wire:model = 'listing_status'>
                                        <option value="-1">All</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="manage_listing_table" style="max-height: 590px;overflow: auto;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="position: sticky;top: 0;z-index: 9;">Listing</th>
                                            <th style="position: sticky;top: 0;z-index: 9;">Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($short_term_listing) > 0)
                                        @foreach($short_term_listing as $listing)
                                        <tr>
                                            <td>
                                                <h5 class="manage_name_title">{{$listing->name}}</h5>
                                                <div class="manage_details_wpr">
                                                    <p>{{$listing->street_address}}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mange_check_box form_input_check">
                                                    @if($listing->status == 1)
                                                    <label>
                                                        <input type="checkbox" checked>
                                                        <span></span>
                                                        <a href="javascript:void(0);" class="checkbox_popup"
                                                            wire:click.prevent="listingStatusChange({{$listing->id}})"></a>
                                                    </label>
                                                    @else
                                                    <label>
                                                        <input type="checkbox">
                                                        <span></span>
                                                        <a href="javascript:void(0);" class="checkbox_popup"
                                                            wire:click.prevent="activateListing({{$listing->id}})"></a>
                                                    </label>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td style="width: 80%;">
                                                <div class="manage_details_wpr">There is no listing</div>
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-6 corporate-right-text">
                        <div class="limit_head" style="margin-left: 30px;">
                            <p style="font-size: 36px;">Limits</p>
                        </div>
                        <ul>

                            <li>Per Day Badge Bonus:
                                <span class="property_term_limit">
                                    @if($provider_settings)
                                    @if($provider_settings->badge_bonus_point == null)
                                    0
                                    @else
                                    {{$provider_settings->badge_bonus_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive each day of their reservation</li>
                            <li>Add Points:
                                <span class="property_frequency">
                                    @if($provider_settings)
                                    @if($provider_settings->add_point == null)
                                    0
                                    @else
                                    {{$provider_settings->add_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points that are sent when using Add points button</li>
                            <li>Guest Of The Week:
                                <span class="property_current_allowance">
                                    @if($provider_settings)
                                    @if($provider_settings->guest_of_week_point == null)
                                    0
                                    @else
                                    {{$provider_settings->guest_of_week_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever you recognize them as the guest of
                                the week </li>
                            <li>Double Booker Reward:
                                <span class="property_sign_up">
                                    @if($provider_settings)
                                    @if($provider_settings->double_booker_point == null)
                                    0
                                    @else
                                    {{$provider_settings->double_booker_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever booking twice in one year</li>
                            <li>Triple Booker Reward:
                                <span class="property_low_point">
                                    @if($provider_settings)
                                    @if($provider_settings->triple_booker_point == null)
                                    0
                                    @else
                                    {{$provider_settings->triple_booker_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                            </li>
                            <li>This is the number of points a guest receive whenever booking three times in one year
                            </li>
                            <li>Live Like A Local Reward:
                                <span class="property_add_point">
                                    @if($provider_settings)
                                    @if($provider_settings->local_reward_point == null)
                                    0
                                    @else
                                    {{$provider_settings->local_reward_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    Points
                                </span>
                                <a href="javascript:void(0);" style="text-decoration: underline !important;
                                margin-left: 10px;
                                font-size: 20px;
                                font-weight: 500;color:#26a7df;" data-backdrop="static" data-keyboard="false"
                                    wire:click.prevent="manageLimit">Setup</a>
                            </li>
                            <li>This is the number of points a guest receive whenever redeeming a discount or actively
                                enrolling in select merchant's loyal reward program</li>
                            <li class="manage-limits"><button data-backdrop="static" data-keyboard="false"
                                    class="limitModal" wire:click.prevent="manageLimit">Manage limits</button></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal listingSetting-modal fade" id="listingSetting_Modal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1140px;">
            <div class="modal-content">
                <div class="listingSetting_modal_body">
                    <div class="container">
                        <div class="modal-header">
                            <h3 id="exampleModalLabel">Listing Page Settings</h3>
                            <a href="#" class="page-btn page-btn-red" data-bs-dismiss="modal"
                                aria-label="Close">Close</a>
                        </div>
                        <div class="modal-body">
                            <div class="row listingSetting-modal-rw">
                                <div class="col-lg-12 listingSetting-modal-col">
                                    <h4>{{$user->travelType->name}}</h4>
                                    <div class="listing_page_setting_main">
                                        <div class="listing_page_setting_innr">
                                            <div class="listing_page_setting_rw">
                                                <div class="listing_page_setting_txt">
                                                    <h4><span>Listing</span> Website</h4>
                                                </div>
                                                <div class="listing_page_setting_radio_wrap">
                                                    <div class="form_input_radio">
                                                        <label style=" margin-right: 10px;">
                                                            <input type="radio" wire:model.defer="listing_website"
                                                                wire:click.prevent="updateListingWebsiteStatus(1)"
                                                                value="1">
                                                            <span>Active</span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" wire:model.defer="listing_website"
                                                                wire:click.prevent="updateListingWebsiteStatus(0)"
                                                                value="0">
                                                            <span>Inactive</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing_page_setting_innr">
                                            <div class="listing_page_setting_rw">
                                                <div class="listing_page_setting_txt">
                                                    <h4>Message Boards</h4>
                                                </div>
                                                <div class="listing_page_setting_radio_wrap">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model="message_board"
                                                                wire:click.prevent="updateMessageBoardStatus(1)"
                                                                value="1">
                                                            <span>Active</span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" wire:model="message_board"
                                                                wire:click.prevent="updateMessageBoardStatus(0)"
                                                                value="0">
                                                            <span>Inactive</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing_page_setting_innr">
                                            <div class="listing_page_setting_rw">
                                                <div class="listing_page_setting_txt">
                                                    <p>Display to be viewed by all Smart Rewards members. Use the
                                                        message boards to communicate with your guests as well as
                                                        potential guests. </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing_page_setting_innr">
                                            <div class="listing_page_setting_rw">
                                                <div class="listing_page_setting_txt">
                                                    <h4>Guest Recognition</h4>
                                                    <p>Allows the ability to reward guest with recognition. Points can
                                                        be rewarded with recognition.</p>
                                                </div>
                                                <div class="listing_page_setting_radio_wrap">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model="guest_recognition"
                                                                wire:click.prevent="updateGuestRecognitionStatus(1)"
                                                                value="1">
                                                            <span>Active</span>
                                                        </label>
                                                        <label>
                                                            <input type="radio" wire:model="guest_recognition"
                                                                wire:click.prevent="updateGuestRecognitionStatus(0)"
                                                                value="0">
                                                            <span>Inactive</span>
                                                        </label>
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

    <div wire:ignore.self class="modal listingWebsite-modal fade" id="listingWebsite_Modal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1011px;">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</a>
                </div>
                <div class="modal-body">
                    <div class="hotel-portal-wrapper">
                        <div class="row align-items-center">
                            <div class="col-lg-9">
                                <div class="hotel-portal-left-panel">
                                    <div class="hotel-portal-logo">
                                        <img src="{{ $user->travelType->short_term_logo }}" alt="title">
                                    </div>
                                    <div class="hotel-portal-info">
                                        <h3>{{$user->travelType->name}}</h3>
                                        <ul class="info-list">
                                            <li>
                                                <img src="images/location-icon-rental.svg" class="info-icon" alt="">
                                                <strong>{{$user->travelType->address}},
                                                    {{$user->travelType->city}}, {{$user->travelType->state->name}},
                                                    {{$user->travelType->zip_code}}</strong>

                                            </li>
                                            <li>
                                                <img src="images/phone-icon.svg" class="info-icon" alt="">
                                                <strong>
                                                    <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                                                </strong>
                                            </li>
                                        </ul>
                                        <ul class="media-list">
                                            <li>
                                                <label class="media-save-lbl">
                                                    <input type="checkbox">
                                                    <span>
                                                        <svg width="438" height="360" viewBox="0 0 438 360" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M412.28 45.4597C396.633 24.9023 374.531 10.2009 349.523 3.71724C324.515 -2.76639 298.054 -0.65589 274.39 9.7097C253.21 18.8497 234.32 34.2597 219 54.7597C203.68 34.2597 184.79 18.8497 163.61 9.7597C139.951 -0.611191 113.494 -2.72953 88.4864 3.74492C63.479 10.2194 41.3734 24.9108 25.72 45.4597C9.22 67.0797 0.5 94.0997 0.5 123.59C0.5 166.03 25.81 212.59 75.72 262.03C116.39 302.3 164.45 335.28 189.47 351.35C198.286 356.992 208.533 359.99 219 359.99C229.467 359.99 239.714 356.992 248.53 351.35C273.53 335.28 321.61 302.3 362.28 262.03C412.19 212.61 437.5 166.03 437.5 123.59C437.5 94.0997 428.78 67.0797 412.28 45.4597Z"
                                                                fill="black" />
                                                            <path class="heart-fill"
                                                                d="M412.5 123.59C412.5 159.11 389.69 199.71 344.69 244.27C305.69 282.93 259.22 314.77 235.02 330.27C230.242 333.322 224.69 334.944 219.02 334.944C213.35 334.944 207.798 333.322 203.02 330.27C178.82 314.73 132.39 282.89 93.35 244.27C48.35 199.71 25.54 159.11 25.54 123.59C25.54 99.5898 32.54 77.8498 45.63 60.5898C57.7039 44.8054 74.6164 33.4111 93.78 28.1498C101.415 26.0845 109.291 25.042 117.2 25.0498C147.68 25.0498 182.84 40.2898 208.26 83.6298C209.361 85.5115 210.935 87.0721 212.827 88.1566C214.718 89.2412 216.86 89.8118 219.04 89.8118C221.22 89.8118 223.362 89.2412 225.253 88.1566C227.145 87.0721 228.719 85.5115 229.82 83.6298C262.12 28.5698 310.13 18.8698 344.3 28.1498C363.464 33.4111 380.376 44.8054 392.45 60.5898C405.55 77.8498 412.5 99.6298 412.5 123.59Z"
                                                                fill="#ffffff" />
                                                        </svg>
                                                        Save this page
                                                    </span>
                                                </label>
                                            </li>
                                            <li>
                                                <a href="Javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#shareModal">
                                                    <svg width="338" height="438" viewBox="0 0 338 438" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M289.256 131.938H245.587C241.343 131.938 237.274 133.624 234.273 136.625C231.272 139.625 229.587 143.695 229.587 147.938C229.587 152.182 231.272 156.251 234.273 159.252C237.274 162.253 241.343 163.938 245.587 163.938H289.267C298.088 163.938 305.267 171.117 305.267 179.938V389.176C305.267 397.997 298.088 405.176 289.267 405.176H48.744C39.9227 405.176 32.744 397.997 32.744 389.176V179.938C32.744 171.117 39.9227 163.938 48.744 163.938H92.424C96.6675 163.938 100.737 162.253 103.738 159.252C106.738 156.251 108.424 152.182 108.424 147.938C108.424 143.695 106.738 139.625 103.738 136.625C100.737 133.624 96.6675 131.938 92.424 131.938H48.744C36.018 131.952 23.8172 137.014 14.8185 146.013C5.81979 155.011 0.758135 167.212 0.744019 179.938V389.176C0.744019 415.64 22.28 437.176 48.744 437.176H289.267C315.731 437.176 337.267 415.64 337.267 389.176V179.938C337.25 167.211 332.186 155.011 323.185 146.012C314.185 137.014 301.983 131.952 289.256 131.938ZM109.341 99.6397L153.533 55.4477V266.093C153.533 268.194 153.947 270.275 154.751 272.216C155.555 274.157 156.734 275.921 158.22 277.407C159.705 278.892 161.469 280.071 163.41 280.875C165.352 281.679 167.432 282.093 169.533 282.093C171.635 282.093 173.715 281.679 175.656 280.875C177.598 280.071 179.361 278.892 180.847 277.407C182.333 275.921 183.511 274.157 184.315 272.216C185.12 270.275 185.533 268.194 185.533 266.093V55.4477L229.725 99.6397C232.851 102.765 236.947 104.322 241.043 104.322C245.139 104.322 249.235 102.765 252.36 99.6397C255.36 96.6392 257.045 92.5703 257.045 88.3277C257.045 84.085 255.36 80.0161 252.36 77.0157L180.861 5.50632C179.375 4.0195 177.611 2.84003 175.669 2.03531C173.727 1.2306 171.646 0.816406 169.544 0.816406C167.442 0.816406 165.361 1.2306 163.419 2.03531C161.477 2.84003 159.713 4.0195 158.227 5.50632L86.7173 77.0157C85.1892 78.4916 83.9703 80.2571 83.1317 82.2092C82.2932 84.1612 81.8518 86.2608 81.8333 88.3852C81.8149 90.5097 82.2197 92.6166 83.0242 94.5829C83.8287 96.5493 85.0168 98.3357 86.519 99.838C88.0213 101.34 89.8077 102.528 91.7741 103.333C93.7404 104.137 95.8473 104.542 97.9718 104.524C100.096 104.505 102.196 104.064 104.148 103.225C106.1 102.387 107.865 101.168 109.341 99.6397Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                    Share this page
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="hotel-portal-right-panel">
                                    <a href="javascript:void(0);" class="page-btn page-btn-bright-cerulean">
                                        <svg class="page-btn-icon" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21.447 6.10523L15.447 3.10523C15.3081 3.03571 15.1549 2.99951 14.9995 2.99951C14.8441 2.99951 14.6909 3.03571 14.552 3.10523L9 5.88223L3.447 3.10523C3.2945 3.02902 3.12506 2.99307 2.95476 3.00079C2.78446 3.0085 2.61895 3.05962 2.47397 3.1493C2.32899 3.23897 2.20933 3.36422 2.12638 3.51315C2.04342 3.66209 1.99992 3.82975 2 4.00023V17.0002C2 17.3792 2.214 17.7252 2.553 17.8952L8.553 20.8952C8.69193 20.9647 8.84515 21.0009 9.0005 21.0009C9.15585 21.0009 9.30907 20.9647 9.448 20.8952L15 18.1182L20.553 20.8942C20.7051 20.9712 20.8744 21.0076 21.0446 21.0001C21.2149 20.9925 21.3803 20.9413 21.525 20.8512C21.82 20.6682 22 20.3472 22 20.0002V7.00023C22 6.62123 21.786 6.27523 21.447 6.10523ZM10 7.61823L14 5.61823V16.3822L10 18.3822V7.61823ZM4 5.61823L8 7.61823V18.3822L4 16.3822V5.61823ZM20 18.3822L16 16.3822V5.61823L20 7.61823V18.3822Z"
                                                fill="currentColor" />
                                        </svg>
                                        Map it
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal_main_part_innr">
                        <ul class="hotel-portal-navigate-nav">
                            <li class="nav-item active">
                                <a href="javascript:void(0);">home</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);">Book Online</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);">Guest Portal</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);">Visit Direct Website</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);">Contact Us</a>
                            </li>
                        </ul>
                        <div class="navigate-panel">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="navigate-panel-left">
                                        <div class="qs">
                                            <h4>Quick Search</h4>
                                            <div class="qs-form">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="qs-form-box">
                                                                <select>
                                                                    <option value="0">Type</option>
                                                                    <option value="1">Type 1</option>
                                                                    <option value="2">Type 2</option>
                                                                    <option value="3">Type 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="qs-form-box">
                                                                <select>
                                                                    <option value="0">Location</option>
                                                                    <option value="1">Location 1</option>
                                                                    <option value="2">Location 2</option>
                                                                    <option value="3">Location 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="qs-form-box">
                                                                <select>
                                                                    <option value="0">Guests</option>
                                                                    <option value="1">Guests 1</option>
                                                                    <option value="2">Guests 2</option>
                                                                    <option value="3">Guests 3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="qs-form-box">
                                                                <input type="submit" value="Search" class="qs-btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="m-filter">
                                            <div class="m-filter-bx">
                                                <select>
                                                    <option>Search by Listing</option>
                                                    <option>Search by Option 1</option>
                                                    <option>Search by Option 1</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="qs-result">
                                            <div class="qs-result-scroll">
                                                <div class="row">
                                                    @if(count($short_term_listing) > 0)
                                                    @foreach($short_term_listing as $data)
                                                    <div class="col-md-6">
                                                        <div class="qs-result-box">
                                                            <div class="qs-result-image">
                                                                <img src="{{$data->main_img}}" alt="">
                                                                <div class="qs-result-image-overlay">
                                                                    <div class="qs-wishlist">
                                                                        <label class="media-save-lbl">
                                                                            <input type="checkbox">
                                                                            <span>
                                                                                <svg width="438" height="360"
                                                                                    viewBox="0 0 438 360" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M412.28 45.4597C396.633 24.9023 374.531 10.2009 349.523 3.71724C324.515 -2.76639 298.054 -0.65589 274.39 9.7097C253.21 18.8497 234.32 34.2597 219 54.7597C203.68 34.2597 184.79 18.8497 163.61 9.7597C139.951 -0.611191 113.494 -2.72953 88.4864 3.74492C63.479 10.2194 41.3734 24.9108 25.72 45.4597C9.22 67.0797 0.5 94.0997 0.5 123.59C0.5 166.03 25.81 212.59 75.72 262.03C116.39 302.3 164.45 335.28 189.47 351.35C198.286 356.992 208.533 359.99 219 359.99C229.467 359.99 239.714 356.992 248.53 351.35C273.53 335.28 321.61 302.3 362.28 262.03C412.19 212.61 437.5 166.03 437.5 123.59C437.5 94.0997 428.78 67.0797 412.28 45.4597Z"
                                                                                        fill="black"></path>
                                                                                    <path class="heart-fill"
                                                                                        d="M412.5 123.59C412.5 159.11 389.69 199.71 344.69 244.27C305.69 282.93 259.22 314.77 235.02 330.27C230.242 333.322 224.69 334.944 219.02 334.944C213.35 334.944 207.798 333.322 203.02 330.27C178.82 314.73 132.39 282.89 93.35 244.27C48.35 199.71 25.54 159.11 25.54 123.59C25.54 99.5898 32.54 77.8498 45.63 60.5898C57.7039 44.8054 74.6164 33.4111 93.78 28.1498C101.415 26.0845 109.291 25.042 117.2 25.0498C147.68 25.0498 182.84 40.2898 208.26 83.6298C209.361 85.5115 210.935 87.0721 212.827 88.1566C214.718 89.2412 216.86 89.8118 219.04 89.8118C221.22 89.8118 223.362 89.2412 225.253 88.1566C227.145 87.0721 228.719 85.5115 229.82 83.6298C262.12 28.5698 310.13 18.8698 344.3 28.1498C363.464 33.4111 380.376 44.8054 392.45 60.5898C405.55 77.8498 412.5 99.6298 412.5 123.59Z"
                                                                                        fill="#ffffff"></path>
                                                                                </svg>
                                                                                Save
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="qs-share">
                                                                        <a href="Javascript:void(0);">
                                                                            <svg width="338" height="438"
                                                                                viewBox="0 0 338 438" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M289.256 131.938H245.587C241.343 131.938 237.274 133.624 234.273 136.625C231.272 139.625 229.587 143.695 229.587 147.938C229.587 152.182 231.272 156.251 234.273 159.252C237.274 162.253 241.343 163.938 245.587 163.938H289.267C298.088 163.938 305.267 171.117 305.267 179.938V389.176C305.267 397.997 298.088 405.176 289.267 405.176H48.744C39.9227 405.176 32.744 397.997 32.744 389.176V179.938C32.744 171.117 39.9227 163.938 48.744 163.938H92.424C96.6675 163.938 100.737 162.253 103.738 159.252C106.738 156.251 108.424 152.182 108.424 147.938C108.424 143.695 106.738 139.625 103.738 136.625C100.737 133.624 96.6675 131.938 92.424 131.938H48.744C36.018 131.952 23.8172 137.014 14.8185 146.013C5.81979 155.011 0.758135 167.212 0.744019 179.938V389.176C0.744019 415.64 22.28 437.176 48.744 437.176H289.267C315.731 437.176 337.267 415.64 337.267 389.176V179.938C337.25 167.211 332.186 155.011 323.185 146.012C314.185 137.014 301.983 131.952 289.256 131.938ZM109.341 99.6397L153.533 55.4477V266.093C153.533 268.194 153.947 270.275 154.751 272.216C155.555 274.157 156.734 275.921 158.22 277.407C159.705 278.892 161.469 280.071 163.41 280.875C165.352 281.679 167.432 282.093 169.533 282.093C171.635 282.093 173.715 281.679 175.656 280.875C177.598 280.071 179.361 278.892 180.847 277.407C182.333 275.921 183.511 274.157 184.315 272.216C185.12 270.275 185.533 268.194 185.533 266.093V55.4477L229.725 99.6397C232.851 102.765 236.947 104.322 241.043 104.322C245.139 104.322 249.235 102.765 252.36 99.6397C255.36 96.6392 257.045 92.5703 257.045 88.3277C257.045 84.085 255.36 80.0161 252.36 77.0157L180.861 5.50632C179.375 4.0195 177.611 2.84003 175.669 2.03531C173.727 1.2306 171.646 0.816406 169.544 0.816406C167.442 0.816406 165.361 1.2306 163.419 2.03531C161.477 2.84003 159.713 4.0195 158.227 5.50632L86.7173 77.0157C85.1892 78.4916 83.9703 80.2571 83.1317 82.2092C82.2932 84.1612 81.8518 86.2608 81.8333 88.3852C81.8149 90.5097 82.2197 92.6166 83.0242 94.5829C83.8287 96.5493 85.0168 98.3357 86.519 99.838C88.0213 101.34 89.8077 102.528 91.7741 103.333C93.7404 104.137 95.8473 104.542 97.9718 104.524C100.096 104.505 102.196 104.064 104.148 103.225C106.1 102.387 107.865 101.168 109.341 99.6397Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg>
                                                                            Share
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="qs-result-info">
                                                                <a href="user-dashboard-PM-107.html">
                                                                    <h3>{{$data->name}}</h3>
                                                                    <ul>
                                                                        <li>Bed: {{$data->no_of_bedrooms}}</li>
                                                                        <li>Bath: {{$data->no_of_baths}}</li>
                                                                        <li>Guests: {{$data->no_of_guests}}</li>
                                                                    </ul>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($travel_message_board)
                                @if($travel_message_board->status == 1)
                                <div class="col-lg-4">
                                    <div class="navigate-panel-right">
                                        @if($travel_message_board->message_board_id != null)
                                        <div class="move-in-special">
                                            <div class="move-in-special-heading bg-color-special-one">
                                                {{$travel_message_board->messageBoard->title}}
                                            </div>
                                            <div class="move-spa-con">
                                                @if ($travel_message_board->add_message_date == 1)
                                                <?php $startDate = date_format(date_create($travel_message_board->start_date),'m-d-Y');?>
                                                @if ($travel_message_board->end_date != null)
                                                <?php $endDate = date_format(date_create($travel_message_board->end_date),'m-d-Y');?>
                                                @else
                                                <?php $endDate ='Open';?>
                                                @endif
                                                <h2>From {{$startDate}} to {{$endDate}} </h2>
                                                @endif
                                                <p>{!! $travel_message_board->message !!}</p>
                                            </div>
                                        </div>
                                        @endif
                                        @if($travel_message_board->message_board_id2 != null)
                                        <div class="move-in-special">
                                            <div class="move-in-special-heading bg-color-special-ten">
                                                {{$travel_message_board->messageBoard->title}}
                                            </div>
                                            <div class="move-spa-con">
                                                @if ($travel_message_board->add_message_date2 == 1)
                                                <?php $startDate2 = date_format(date_create($travel_message_board->start_date2),'m-d-Y');?>
                                                @if ($travel_message_board->end_date2 != null)
                                                <?php $endDate2 = date_format(date_create($travel_message_board->end_date2),'m-d-Y');?>
                                                @else
                                                <?php $endDate2 ='Open';?>
                                                @endif
                                                <h2>From {{$startDate2}} to {{$endDate2}} </h2>
                                                @endif
                                                <p>{!! $travel_message_board->message2 !!}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @else
                                <div class="col-lg-4">
                                    <p>There is no message board</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal checkbox_modal_popup fade" id="CheckBoxpopup" tabindex="-1"
        aria-labelledby="CheckBoxpopup" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body checkbox_modal_popup_inner">
                    <h4 class="manage-title">By deactivating this Listing</h4>
                    <ul class="popup_listing">
                        <li>
                            The Gimmzi Page of this listing will be offline, which means it won't be
                            accessible
                            to
                            guests or public viewing.
                        </li>
                        <li>
                            Any badges that have already been accepted for this listing will still be honored
                            and
                            guests
                            will receive the agreed sign up point bonuses on the check-in date unless the badge
                            has
                            been deactivated on an individual basis in the Smart Guest Database.
                        </li>
                        <li>
                            Both future and past guests who have not accepted the badges will not be able to
                            access
                            then
                            at this listing.
                        </li>
                    </ul>
                    <p>
                        Additionally, if the listing is deactivated, it can be reactivated in future by checking
                        the
                        active checkbox.
                    </p>
                    <div>
                        <div class="checkbox_modal_bottom">
                            <h5 class="checkboxpopup_subtitle">
                                Would you like to proceed with deactivating this listing?
                            </h5>
                            <div class="checkbox_bottom_btn">

                                <a href="javascript:void(0);" class="page_btn2" wire:click.prevent='yesDeactivate'
                                    id="yeschange">Yes</a>
                                <a href="javascript:void(0);" class="page_btn2" onclick="window.location.reload()"
                                    id="closeactive">No</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs" id="view_contact_info_modal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="table_user_top_sec_col_lft new">

                        <h3></h3>

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
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($managers as $user)
                                <tr id="removeuser_id{{ $user->id }}">
                                    <td></td>
                                    <td id="">{{ $user->full_name }}</td>
                                    <td>{{ $user->title->title_name }}</td>
                                    @if($user->phone != '')
                                    <td>{{ $user->phone }}</td>
                                    @else
                                    <td>---</td>
                                    @endif
                                    @if($user->phone_ext != '')
                                    <td>{{ $user->phone_ext }}</td>
                                    @else
                                    <td>---</td>
                                    @endif
                                    <td>{{ $user->email }}</td>
                                    @if ($user->id != Auth::user()->id)
                                    <td>
                                        <div class="selctd_table_sec">
                                            <button class="btn btn-danger"
                                                wire:click.prevent="showRemoveManager({{ $user->id }})">Remove</button>
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
                                <form wire:submit.prevent="activeManager">
                                    <div class="selctd_table_sec large">
                                        <select id="available_user" wire:model="manager_id">
                                            <option value="">Choose Available Management Level User</option>
                                            @foreach ($deactive_managers as $deactives)
                                            <option value="{{ $deactives->id }}">{{ $deactives->full_name }}</option>
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
                                            id="adduser">Add User</button>
                                    </div>
                                </form>
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

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeuser_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
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
                                <button class="btn_table_s blu auto_wd" wire:click.prevent="removeManager">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal manage_listing_popup provider_setting_popUp fade" id="provider_detail"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-header detail">
                <a href="javascript:void(0);" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</a>
            </div>
            <div class="modal-content">
                <div class="modal-body manage_listing_popup_body">
                    <form wire:submit.prevent="UpdateProviderDetail">
                        <div class="row provider_setting_rw">
                            <div class="col-lg-8 provider_setting_frm_col">
                                <div class="provider_setting_cmn_wpr">
                                    <div class="provider_setting_frm_head">
                                        <h2>Provider Settings</h2>
                                    </div>
                                    <div class="provider_setting_frm_gruop provider_name_wrap">
                                        <label>Provider name</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_name" class="provider_name"
                                                readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProvidername"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg')}}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_name')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="provider_setting_frm_gruop">

                                        <label>Provider Address</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_address"
                                                class="provider_address" id="autocomplete1" readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click="editProvideraddress"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg')}}"
                                                        alt=""></a>
                                            </div>
                                            <input type="hidden" wire:model.defer="lat" id="latitude">
                                            <input type="hidden" wire:model.defer="long" id="longitude">
                                            <div class="list-address-col-form" style="display:none;">
                                                <label>Zip Code*</label>
                                                <input type="hidden" wire:model.defer="zip_code" id="zipcode" readonly>
                                            </div>

                                            <div class="list-address-col-form" style="display:none;">
                                                <label>City*</label>
                                                <input type="hidden" wire:model.defer="provider_city" id="city" readonly>
                                            </div>

                                            <div class="list-address-col-form" style="display:none;">
                                                <label>State*</label>
                                                <input type="text" wire:model.defer="provider_state" id="state" readonly>
                                                <input type="text" wire:model.defer="state_id" id="state_id" readonly>
                                            </div>
                                        </div>
                                        @error('provider_address')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span><br>
                                        @enderror
                                        @error('zip_code')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span><br>
                                        @enderror
                                        @error('state_id')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                        @enderror


                                    </div>

                                    <div class="provider_setting_frm_gruop">
                                        <label>Provider Email Address</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text" wire:model.defer="provider_email" class="provider_email"
                                                readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProvideremail"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg')}}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_email')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="provider_setting_frm_gruop">
                                        <label>Provider Phone number</label>
                                        <div class="provider_setting_frm_field_wrap">
                                            <input type="text"  onkeypress="return isNumber(event);" wire:model.defer="provider_phone" class="provider_phone"
                                                readonly>
                                            <div class="provider_setting_edit_wrap">
                                                <a href="javascript:void(0);" wire:click.prevent="editProviderphone"
                                                    class="inputEdit_btn"><img
                                                        src="{{ asset('frontend_assets/images/edit-pen.svg')}}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                        @error('provider_phone')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="provider_submitBtn_wrap">
                                        <button type="submit" class="save_provider">Save</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 provider_setting_img_col">
                                <div class="provider_setting_cmn_wpr provider_setting_img_main">

                                    <label>Provider Logo</label>
                                    <div class="provider_setting_large_img">
                                        <img src="{{ $logo}}" alt="" id="previous_logo">
                                    </div>
                                    <div id="shownewlogo" wire:ignore style="display:none;">
                                        <label>Provider New Logo</label>
                                        <div class="provider_setting_large_img">
                                            <img id="new_logo">
                                        </div>
                                    </div>

                                    <div class="provider_setting_upload_wrap">
                                        <label>
                                            <input type="file" id="logoupload" wire:model.defer="provider_logo">
                                            <span>
                                                <i><img src="{{ asset('frontend_assets/images/upload-icon.svg')}}"
                                                        alt=""></i>
                                                Upload Logo
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div data-bs-backdrop='static' wire:ignore.self class="modal common-border-modal limitSetting-modal fade"
        id="limitSetting_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Limit Settings</h5>
                    <a href="javascript:void(0);" class="page-btn page-btn-red" wire:click.prevent="settingCancel">CLOSE</a>
                </div>
                <div class="modal-body common-modal-body">
                    <div class="row limitSetting_rw">
                        <div class="col-md-6 limitSetting_col">
                            <div class="limitTime_main">
                                <div class="limitTime_innr">
                                    <label>Check In Time:</label>
                                    <div class="limitTime_field_wrap">
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkin_hour">
                                        <p>:</p>
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkin_min">
                                        <select wire:model.defer="checkin_time">
                                            <option value="">--</option>
                                            <option value="PM">PM</option>
                                            <option value="AM">AM</option>
                                        </select>
                                    </div>
                                    <a href="javascript:void(0);" wire:click="updateCheckinTime" class="setting_timing">Update</a>
                                </div>
                                @error('checkin_hour')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                                @error('checkin_min')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                                @error('checkin_time')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                                <div class="limitTime_innr">
                                    <label>Check Out Time:</label>
                                    <div class="limitTime_field_wrap">
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkout_hour">
                                        <p>:</p>
                                        <input type="text" onkeypress="return isNumber(event);" maxlength="2"
                                            wire:model.defer="checkout_min">
                                        <select wire:model.defer="checkout_time">
                                            <option value="">--</option>
                                            <option value="PM">PM</option>
                                            <option value="AM">AM</option>
                                        </select>
                                    </div>
                                    <a href="javascript:void(0);" wire:click="updateCheckoutTime" class="setting_timing">Update</a>
                                </div>
                                @error('checkout_hour')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                                @error('checkout_min')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                                @error('checkout_time')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span><br>
                                @enderror
                            </div>
                            <div class="cmnLimit_setting_main">
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Per Day Badge</strong>
                                        points: @if($provider_settings)
                                        @if($provider_settings->badge_bonus_point == null)
                                        0
                                        @else
                                        {{$provider_settings->badge_bonus_point}}
                                        @endif
                                        @else
                                        0
                                        @endif
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="badge_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click="updateBadge" class="blue_btn">update</a>
                                    </div>
                                    @error('badge_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p>Add points:
                                        @if($provider_settings)
                                        @if($provider_settings->add_point == null)
                                        0
                                        @else
                                        {{$provider_settings->add_point}}
                                        @endif
                                        @else
                                        0
                                        @endif
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="add_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateAddPoint"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('add_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Guest of The Week</strong>:
                                        @if($provider_settings)
                                        @if($provider_settings->guest_of_week_point == null)
                                        0
                                        @else
                                        {{$provider_settings->guest_of_week_point}}
                                        @endif
                                        @else
                                        0
                                        @endif
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="guest_point"
                                            onkeypress="return isNumber(event);">
                                        <p>25 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateGuest"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('guest_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Double Booker</strong>:
                                        @if($provider_settings)
                                        @if($provider_settings->double_booker_point == null)
                                        0
                                        @else
                                        {{$provider_settings->double_booker_point}}
                                        @endif
                                        @else
                                        0
                                        @endif
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="double_point"
                                            onkeypress="return isNumber(event);">
                                        <p>50 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateDouble"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('double_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Triple Booker</strong>:
                                        @if($provider_settings)
                                        @if($provider_settings->triple_booker_point == null)
                                        0
                                        @else
                                        {{$provider_settings->triple_booker_point}}
                                        @endif
                                        @else
                                        0
                                        @endif
                                        points
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="triple_point"
                                            onkeypress="return isNumber(event);">
                                        <p>75 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent="updateTriple"
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('triple_point')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <div class="cmnLimit_setting_inner">
                                    <p><strong>Low Point Balance </strong>:<span class="low_point"></span>  @if($provider_settings){{ $provider_settings->low_point_balance }} points @endif
                                    </p>
                                    <div class="cmnLimit_setting_field_wrap">
                                        <input type="text" wire:model.defer="low_point"
                                            onkeypress="return isNumber(event);">
                                        <p>100 points minimum</p>
                                        <a href="javascript:void(0);" wire:click.prevent='updateLowPoint'
                                            class="blue_btn">update</a>
                                    </div>
                                    @error('low_point')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 limitSetting_col">
                            <div class="cmnLimit_setting_inner">
                                <p><strong>Live like a local</strong> points:
                                    @if($provider_settings)
                                    @if($provider_settings->local_reward_point == null)
                                    0
                                    @else
                                    {{$provider_settings->local_reward_point}}
                                    @endif
                                    @else
                                    0
                                    @endif
                                    points
                                </p>
                                <div class="cmnLimit_setting_field_wrap">
                                    <input type="text" wire:model.defer="local_point"
                                        onkeypress="return isNumber(event);">
                                    <p>200 points minimum</p>
                                    <a href="javascript:void(0);" wire:click.prevent="updateLocal"
                                        class="blue_btn">update</a>
                                </div>
                                @error('local_point')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <p>From the list below, you must select at least 5 and up to 10 merchants. If a member who
                                has been awarded a badge
                                uses a Gimmzi Smart Rewards discount or enrolls in an active loyalty plan with at least
                                5 of the selected merchants during their stay
                                they will receive a Live Like a Local Reward</p>
                            <div class="inputSelect_main">
                                <div class="inner_input_sec">
                                    <input type="text" placeholder="Search using marchant name"
                                        wire:model.defer="search_text" wire:keyup="searchResult">
                                    @if($showdiv)
                                    <ul>
                                        @if(!empty($result))
                                        @foreach($result as $result_data)

                                        <li wire:click="merchantBusiness({{ $result_data->id }})">{{
                                            $result_data->business_name}}</li>

                                        @endforeach
                                        @endif
                                    </ul>
                                    @endif
                                </div>
                                <select wire:model.defer="search_filter" wire:change="filterWiseBusiness">
                                    <option value="all">All</option>
                                    @foreach($business_type as $type)
                                    <option value="{{$type->id}}">{{$type->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="limitSetting_table_wrap new_table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Marchant ({{$travel_merchant_count}}/{{$business_count}} selected)</th>
                                            <th>Selected</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($merchants) > 0)
                                            @foreach($merchants as $business)
                                                <tr>
                                                    <td>
                                                        <p><strong>{{$business->business_name}}</strong></p>
                                                        <p>{{$business->head_location}}</p>
                                                    </td>
                                                    <td>
                                                        <div class="form_input_check mange_check_box">
                                                            <label>
                                                                @if($business->travelMerchant($shortTerm->id,$business->id) ==
                                                                true)
                                                                <input type="checkbox" value="1" name="tableOne"
                                                                    wire:click.prevent="checkMerchant({{$business->id}})"
                                                                    checked>
                                                                @else
                                                                <input type="checkbox" value="1" name="tableOne"
                                                                    wire:click.prevent="checkMerchant({{$business->id}})">
                                                                @endif
                                                                <span></span>
                                                            </label>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr><td colspan="2">No businesses in this category in your area, please select a different category</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal qrscanModal_popUp fade" id="qrscanModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="closeBtn_wrap">
                        <a href="javascript:void(0);" class="page-btn page-btn-red" data-bs-dismiss="modal"
                            aria-label="Close">cancel</a>
                    </div>
                    <div class="closeBtn_wrap d-flex gap-2 selectedlisting">
                        <input type="text" placeholder="Search for listing using listing name"
                        wire:model.defer="search_listing" wire:keyup="searchListing">
                        
                        <a href="javascript:void(0);" class="setting_timing d-flex align-items-center" wire:click="resetListing">Reset</a>
                        
                    </div>
                    <div class="selectedlisting">
                    @if($showdiv)
                        <ul>
                            @if(!empty($result))
                            @foreach($result as $result_data)

                            <li wire:click="autocompleteListingSelect({{ $result_data->id }})">{{$result_data->name}}</li>

                            @endforeach
                            @endif
                        </ul>
                    @endif
                    </div>
                    <div class="qrscanModal_body_innr">
                        <h2>Welcome to {{$selected_listing_city}},{{$selected_listing_state}}!</h2>
                        <p class="subtitle"><strong>We're excited to have you as our guest at {{$selected_listing_name}}!
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
                            <input type="hidden" value="{{$text}}" id="myInput">
                            {{-- <a href="{{route('printPdf',$shortTerm->id)}}" class="btnprn">[Print]<span><img
                                        src="{{ asset('frontend_assets/images/print-icon.svg')}}" alt=""></span></a>
                            --}}
                            {{-- <a href="javascript:void(0);" onclick="printFunction()">[Print]<span><img
                                        src="{{ asset('frontend_assets/images/print-icon.svg')}}" alt=""></span></a>
                            --}}
                            @if($selected_listing_name != '---')
                                <a href="{{route('downloadPdf',$shortTerm->id)}}">[Download]<span><img
                                            src="{{ asset('frontend_assets/images/download.svg')}}" alt=""></span></a>
                                <a href="javascript:void(0);" onclick="myFunction()">[Copy Link]<span><img
                                            src="{{ asset('frontend_assets/images/copy_link.svg')}}" alt=""></span></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="errormsg"></h3>
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
                                <button class="btn_table_s blu auto_wd" wire:click="hideSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="limit_success_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="limitsuccessmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="hideLimitSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="merchant_count_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="merchantmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="hideCountModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- manage_contact_info_modal -->
 
    @push('scripts')
    <script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>
    <script src="{{asset('frontend_assets/js/jquery.printPage.js')}}"></script>
    <script>
        function isNumber(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        window.livewire.on('showListingSettings', () => {
            $('#listingSetting_Modal').modal('show');
        });
        window.livewire.on('viewMainListingWebsite', () => {
            $('#listingWebsite_Modal').modal('show');
        });
        window.livewire.on('successModal', data => {
            $('#error_modal').modal('show');
            $("#errormsg").html(data.text);
        });
        window.livewire.on('showDeactivateModal', function () {
            $('#CheckBoxpopup').modal('show');
            @this.get('id');      
        });

        window.livewire.on('showLeadManager', function () {
            $('#view_contact_info_modal').modal('show');
        });
        window.livewire.on('showRemoveModal', data => {
            $('#removeuser_modal').modal('show');
            $("#user_name").html(data.name);
        });

        window.livewire.on('showProviderDetail', function () {
            $('#provider_detail').modal('show');
        });

        window.livewire.on('editProviderName', function () {
            $('.provider_name').removeAttr('readonly',false);
        });

        window.livewire.on('editProviderAddress', function () {
            $('.provider_address').removeAttr('readonly',false);
        });

        window.livewire.on('editProviderEmail', function () {
            $('.provider_email').removeAttr('readonly',false);
        });

        window.livewire.on('editProviderPhone', function () {
            $('.provider_phone').removeAttr('readonly',false);
        });

        window.livewire.on('manageLimit', function () {
            $('#limitSetting_modal').modal('show');
        });

        document.getElementById("logoupload").onchange = function(event) {
                let file = event.target.files[0];
                let blobURL = URL.createObjectURL(file);
                console.log(blobURL);
                document.querySelector("#shownewlogo").style.display = 'block';
                // document.querySelector("#shownewlogo").style.display = 'none';
                document.querySelector("#new_logo").src = blobURL;
                    
        }

        window.livewire.on('openQrCode', data => {
            $('#qrscanModal').modal('show');
            $("#qr_img").attr('src','data:image/png;base64, '+data.png);
        
        });
        window.livewire.on('printQrCode', function(){
            window.print();
        });
        function myFunction(){
            var copyText = document.getElementById("myInput");
            console.log(copyText);
            navigator.clipboard.writeText(copyText.value);
            alert('Link Copied');
            
        }
        function printFunction(){
            livewire.emit('');
            //window.print();
        }
        // $(document).ready(function(){
        //     $('.btnprn').printPage();
        // });

        window.livewire.on('userSuccessModal', data => {
            $('#user_success_modal').modal('show');
            $("#successmsg").html(data.text);
        });

        window.livewire.on('hideUserSuccessModal', function () {
            $('#user_success_modal').modal('hide');
            $('#removeuser_modal').modal('hide');
        });

        $("#autocomplete1").on('keyup', function(){
                   
                var input = document.getElementById('autocomplete1');
                var autocomplete = new google.maps.places.Autocomplete(input);
                console.log(autocomplete);
                autocomplete.setComponentRestrictions({'country': ['us']});
                google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                    var place = autocomplete.getPlace();
                    console.log(place);
                    
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                    @this.set('lat', place.geometry['location'].lat());
                    @this.set('long', place.geometry['location'].lng());
                    @this.set('provider_address', place.formatted_address);
                    
            
                    for(var i = 0; i < place.address_components.length; i++){
                        console.log(place.address_components[i]);
                        for (var j = 0; j < place.address_components[i].types.length; j++) {
                            if (place.address_components[i].types[j] == "postal_code") {
                            
                                $("#zipcode").val(place.address_components[i].long_name);
                                @this.set('zip_code', place.address_components[i].long_name);
                            }
                            if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                window.livewire.emit('checkState',[place.address_components[i].long_name]);
                                
                                $("#state").val(place.address_components[i].long_name);
                                @this.set('provider_state', place.address_components[i].long_name);
                                
                                
                            }
                            if (place.address_components[i].types[j] == "administrative_area_level_2") {
                                
                                $("#city").val(place.address_components[i].long_name);
                                @this.set('provider_city', place.address_components[i].long_name);
                            }

                        }

                    }
                    
                });
        });

        window.livewire.on('limitSuccessModal', data => {
            $('#limit_success_modal').modal('show');
            $("#limitsuccessmsg").html(data.text);
        });
        window.livewire.on('hideLimitSuccessModal', function () {
            $('#limit_success_modal').modal('hide');
        });

        window.livewire.on('merchantSuccessModal', data => {
            $('#merchant_count_modal').modal('show');
            $("#merchantmsg").html(data.text);
        });

        window.livewire.on('hideCountModal', function () {
            $('#merchant_count_modal').modal('hide');
        });

        $(document).ready(function () {
            $(document).on('show.bs.modal', '.modal', function() {
                const zIndex = 1040 + 10 * $('.modal:visible').length;
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
            });
        });
     
    </script>
    @endpush
</div>