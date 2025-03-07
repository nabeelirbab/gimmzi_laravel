
@push('style')
<style>
  .errorMsq {
    color: red !important;
    display: block;
  }
</style>
@endpush
<div class="all-smart-rental-database-main-sec show-filled-units-only">
    {{-- <div class="first-smart-rental-sec">
        <div class="container">
            <h2>Search Smart Rental Database</h2>
            <div class="form-group-rental-input">
                <input type="text" placeholder="Search tenant using First Name, Last Name, or Unit Number....." />
                <button class="search">
                    <img src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}" alt="" />
                </button>
            </div>
        </div>
    </div> --}}

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
                    <h3><span id="change_first">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}</span>
                        <span class="dropdown top-droup-down-menu">
                            <button class="dropdown-toggle custom-droup-down" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                    class="" />
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach ($propertyDetails as $property)
                                    <li><a class="property_provider" id="property_provider"
                                            href="javascript:void(0);"
                                            data-property_id="{{ $property->provider->id }}"
                                            data-property_url="{{ route('frontend.ajax-rental-db-table', $property->provider->id) }}">{{ $property->provider ? $property->provider->name : '' }}</a>
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
                                id="property_address">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->address : '' }}</label></span>
                                    </h6>
                                </div>
                                <div class="apartment-right-data">
                                    <h6>
                                        <span class="icon-img-sec-rental"><img
                                                src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                alt="" /></span>Mail:<span
                                            class="points-distributed-txt"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                    </h6>
                                </div>
                            </li>
                            <li>
                                <div class="left-apartments-data">
                                    <h6>
                                        <span class="icon-img-sec-rental"><img src="{{ asset('frontend_assets/images/star-icon-rental.svg') }}"
                                                alt="" /></span>Total Points to Distribute:
                                        <span class="points-distributed-txt-new" id="distributePoint" >{{ number_format($propertyDetails->first()->provider->points_to_distribute) }}
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
                            <li class="property-text-one11">Gimmzi Page <a href="{{route('frontend.provider.view_property_website')}}">View your page</a></li>
                            <li class="property-text12">Landing homepage for your property listing. What customers will see. These customers include registered and non-registered Smart Rewards users</li>
                            <li>
                                <button href="#" class="property-site-text border-0" id="site_setting" type="button">Gimmzi Page
                                    Settings</button>

                                    <button href="#" class="leads-managers" id="manage_contact_id" type="button" style="border: none;" data-id="{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->id : '' }}" >Leads & managers</button>
                                {{-- <a href="#manage_contact_info_modal" data-bs-toggle="modal" role="button"></a> --}}
                            </li>
                        </ul>
                    </div>
                    {{-- <div class="corporate-bottom">
                        <ul>
                            <li class="d-flex flex-wrap align-items-center justify-content-between">
                                <span class="Gift-Pack-11"> GIMMZI Gift Pack<span class="text-one11" style="font-size: 16px;">  (Coming Soon)</span></span>
                                <div class="d-flex flex-wrap align-items-center Gift-Pack-check">
                                    <div class="form-check ml-5">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            On
                                        </label> -->
                                    </div>
                                    <div class="form-check">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            off
                                        </label> -->
                                    </div>
                                </div>

                            </li>
                            <li class="collection-text1">
                                Collection of coupons sent to new registered members
                            </li>
                        </ul>
                    </div> --}}
                    <div class="corporate-bottom">
                        <label>About <span id="about_property_name">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}</span></label>
                        <div class="setting_search_wrap">
                           
                            <div class="setting_search_field" style="width: 100%;">
                       
                                <textarea id="property_description"
                                    placeholder="Write about your hotel here" name="description" readonly>{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->description : '' }}</textarea>
                                    <div class="edit-textarea edit-show" style="display: block;">
                                        <button class="edit-textarea-btn" type="button" id='editHotelDescription'>Edit <img src="{{ asset('frontend_assets/images/edit-icon.svg') }}" alt=""></button>
                                    </div>

                                    <div class="edit-textarea update-show" style="display: none;">
                                        <button class="edit-textarea-btn" type="button" id='updateHotelDescription'>Update <img src="{{ asset('frontend_assets/images/edit-icon.svg') }}" alt=""></button>
                                    </div>

                                    <div class="rd-text">
                                        <p>To Add Display Message Board Go To: <a href="{{route('frontend.message-board')}}">Mesage Board page</a></p>
                                    </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 corporate-right-text">
                    <ul>
                        
                        <li>Limits:  
                            <span class="property_term_limit">
                                @if($property_limit)
                                    @if($property_limit->term_limit!= null)
                                        {{$property_limit->term_limit}}
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>This date range determines how long the tenant’s resident badge is active with your apartment community</li>
                        <li>Frequency in which user automatically receive points:
                            <span class="property_frequency">
                                @if($property_limit)
                                    @if($property_limit->frequency!= null)
                                        {{$property_limit->frequency}} 
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>This is the frequency in which residents automatically receive points</li>
                        <li>Current point allowance schedule:
                            <span class="property_current_allowance">
                                @if($property_limit)
                                    @if($property_limit->current_allowance_point_limit!= null)
                                        {{$property_limit->current_allowance_point_limit}} point
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>This is the amount in which residents automatically receive points</li>
                        <li>Sign Up Bonus Points: 
                            <span class="property_sign_up">
                                @if($property_limit)
                                    @if($property_limit->sign_up_bonus_point!= null)
                                        {{$property_limit->sign_up_bonus_point}} point
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>New residents receive courtesy points at signup</li>
                        <li>Low Point Balance: 
                            <span class="property_low_point">
                                @if($property_limit)
                                    @if($property_limit->low_point_balance!= null)
                                        {{$property_limit->low_point_balance}} point
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>This is the limit set to identify members have low point counts for easy point distribution</li>
                        <li>Add Points: 
                            <span class="property_add_point">
                                @if($property_limit)
                                    @if($property_limit->add_point != null)
                                        {{$property_limit->add_point}} point
                                    @endif
                                @endif
                            </span>
                        </li>
                        <li>This is the number of points that are sent by apartment staff when using Add Points button</li>
                        <li class="manage-limits"><button class="limitModal">Manage limits</button></li>
                        

                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="Manage-limitsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl white-modal modal-grey-bg">
        <div class="modal-content p-0">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Limit Settings</h5>
                    <button type="button" class="cancel-button" data-bs-dismiss="modal"
                        aria-label="Close" onClick="window.location.reload();">Close</button>
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
                                        Current term limit: <span class="term_limit"></span>
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <span class="form-check">
                                            <input class="form-check-input update_term_limit" type="radio" name="term_limit_year"
                                                id="1_year" value="1 year">
                                            <label class="form-check-label" for="1_year">
                                                1 Year
                                            </label>
                                        </span>
                                        <span class="form-check">
                                            <input class="form-check-input update_term_limit" type="radio" name="term_limit_year"
                                                id="2_year" value="2 year">
                                            <label class="form-check-label" for="2_year">
                                                2 Year
                                            </label>
                                        </span>
                                        <span class="form-check">
                                            <input class="form-check-input update_term_limit" type="radio" name="term_limit_year"
                                                id="3_year" value="3 year">
                                            <label class="form-check-label" for="3_year">
                                                3 Year
                                            </label>
                                        </span>
                                        <span class="form-check">
                                            <input class="form-check-input update_term_limit" type="radio" name="term_limit_year"
                                                id="5_year" value="5 year">
                                            <label class="form-check-label" for="5_year">
                                                5 Year
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="point-about-con limit-setting-top">
                                    <div class="curent-text1">
                                        Frequency in which residents automatically receive points: <span class="frequency"></span>
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <span class="form-check">
                                            <input class="form-check-input update_frequency" type="radio" name="frequency"
                                                id="monthly" value="Monthly">
                                            <label class="form-check-label" for="monthly">
                                                Monthly
                                            </label>
                                        </span>
                                        <span class="form-check">
                                            <input class="form-check-input update_frequency" type="radio" name="frequency"
                                                id="weekly" value="Weekly">
                                            <label class="form-check-label" for="weekly">
                                               Weekly
                                            </label>
                                        </span>
                                    </div>
                                   
                                </div>
                                <div class="point-about-con limit-setting-top">
                                    <div class="curent-text1">
                                      Current allowance point: <span class="current_allowance"></span> points
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <input type="text" class="allowance"/> <label>100 point minimum</label>
                                        <button class="update_current_allowance">update</button>
                                        <br>
                                        <span class="allowance_error"></span>
                                    </div>
                                    
                                </div>
                                
                                <div class="point-about-con limit-setting-top">
                                    <div class="curent-text1">
                                        Sign Up Bonus Points: <span class="sign_up"></span> points
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <input type="text" class="sign_up_point" /> <label>100 point minimum</label>
                                        <button class="update_signup">update</button>
                                        <br>
                                        <span class="signup_error"></span>
                                    </div>
                                </div>
                                <div class="point-about-con limit-setting-top">
                                    <div class="curent-text1">
                                        Low Point Balance: <span class="low_point"></span> points
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <input type="text" class="low_point_balance"/> <label>100 point minimum</label>
                                        <button class="update_lowpoint">update</button>
                                        <br>
                                        <span class="lowpoint_error"></span>
                                    </div>
                                </div>
                                <div class="point-about-con limit-setting-top">
                                    <div class="curent-text1">
                                        Add Points: <span class="add_point"></span> points
                                    </div>
                                    <div class="point-minium point-top-one14">
                                        <input type="text" class="point"/> <label>25 point minimum</label>
                                        <button class="update_point">update</button>
                                        <br>
                                        <span class="point_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 limit-setting-right">
                        <div class="point-about-con limit-setting-top">
                            <p>Tenant Recognition Limit Settings</p>
                            <div class="curent-text1">
                                Tenant of The Month Reward: <span class="tenant_reward"></span> points
                            </div>
                            <div class="point-minium point-top-one14">
                                <input type="text" class="tenant_reward_point"/> <label>100 point minimum</label>
                                <button class="update_tenant_reward">update</button>
                                <br>
                                <span class="tenant_reward_error"></span>
                            </div>
                        </div>
                        <div class="point-about-con limit-setting-top">
                            <div class="curent-text1">
                                100% Pass Inspection Reward: <span class="inspection_Reward"></span> points
                            </div>
                            <div class="point-minium point-top-one14">
                                <input type="text" class="inspection_reward_point"/> <label>100 point minimum</label>
                                <button class="update_inspection_reward">update</button>
                                <br>
                                <span class="inspection_reward_error"></span>
                            </div>
                        </div>
                        <div class="point-about-con limit-setting-top">
                            <div class="curent-text1">
                                Because You Are A Great Tenant Reward: <span class="great_tenant"></span> points
                            </div>
                            <div class="point-minium point-top-one14">
                                <input type="text" class="great_tenant_point"/> <label>50 point minimum</label>
                                <button class="update_great_tenant">update</button>
                                <br>
                                <span class="great_tenant_error"></span>
                            </div>
                        </div>
                        <div class="point-about-con limit-setting-top">
                            <div class="curent-text1">
                                Community Helper Reward: <span class="community_helper"></span> points
                            </div>
                            <div class="point-minium point-top-one14">
                                <input type="text" class="comunity_helper_point"/> <label>50 point minimum</label>
                                <button class="update_community_helper">update</button>
                                <br>
                                <span class="community_helper_error"></span>
                            </div>
                        </div>
                        <div class="point-about-con limit-setting-top">
                            <div class="curent-text1">
                                Good Samaritan Reward: <span class="good_samaritan"></span> points
                            </div>
                            <div class="point-minium point-top-one14">
                                <input type="text" class="good_samaritan_point"/> <label>50 point minimum</label>
                                <button class="update_good_samaritan">update</button>
                                <br>
                                <span class="good_samaritan_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade new-fade-modal-property-site-setting white-modal" id="property_settingModal" tabindex="-1"
    aria-labelledby="property_settingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-heading-property-site-setting w-100">
                    <h1>Property Site Settings</h1>
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-body p-0">
                <div class="property-site-setting-website">
                    <div class="row">
                        <h3 id="currentpropertyName" style="margin-left: 17px;"></h3>
                    </div>
                    <div class="row m-0">
                        <div class="col-lg-6 property-site-setting-website11">
                            
                            <div class="">
                                <div class="property-website-con">
                                    <h4>Property Website</h4>
                                    <div class="property-contain-r">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="external-links-text1">External links connected to buttons on property
                                    page
                                    <a href="javascript:void(0);" class="external_manage">Manage</a>
                                </div>
                                <div class="featured-mid-con">
                                    <span>Features</span> <a href="javascript:void(0);" class="feature_view">View</a> <a href="javascript:void(0);" class="feature_manage">Manage</a>
                                    <span>Amenities</span> <a href="javascript:void(0);"  class="amenity_view">View</a> <a href="javascript:void(0);" class="amenity_manage">Manage</a>
                                </div>
                                <div class="mesage-board-bottom-contain">
                                    <div class="property-website-con">
                                        <h4>Message Boards</h4>
                                        <div class="property-contain-r">
                                            
                                            <div class="form-check">

                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault" id="active">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault" id="inactive">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <p>
                                        Display to be viewed by Smart Rental users only, Public, or both. Add notes
                                        for tenants such as Inspection Due Dates, Rent Specials for New Tenants,
                                        Need to Knows, etc.
                                    </p>
                                </div>

                                <div class="mesage-board-bottom-contain">
                                    <div class="property-website-con">
                                        <h4>Tenant Recognition</h4>
                                        <div class="property-contain-r">
                                            
                                            <div class="form-check">

                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <p>
                                    Allows ability to reward tenant of the month or recognition on a per tenant basis. Points can be rewarded with recognition.
                                    </p>
                                </div>
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
                                Upload Property Logo
                            </div>
                            <div class="uploard-photo-main">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="uploard-logo-one">
                                            <input type="file" class="uploard-file-one"  id="property_logo"/>
                                            <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                            <h4>Upload logo</h4>
                                            <h5>25 MB Maximum</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="uploard-logo-one" >
                                            <img id="preview_logo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                        </div>
                                        <div class="btn_grp">
                                           <a class="dlt_btn removePropertyLogo" href="#" style="margin-left: 98px;color: red;">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="uploard-top-one">
                                Upload Photos
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="uploard-logo-one">
                                        <input type="file" class="uploard-file-one" multiple id="property_photos"/>
                                        <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                        <h4>Upload Photos</h4>
                                        <h5>25 MB Maximum</h5>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="uploard-logo-one">
                                        <img id="preview_photo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                    </div>
                                    <input type="hidden" id="main_image_id">
                                    <div class="btn_grp">
                                           <a class="dlt_btn removeMainImage" href="#" style="margin-left: 98px;color: red;">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="photo_preview">

                            </div>
                            <div class="uploard-top-one">
                                Upload Media
                            </div>
                            <div class="row" style="margin-bottom: 31px;">
                                <div class="col-sm-5">
                                    <div class="uploard-logo-one">
                                        <input type="file" class="uploard-file-one" id="property_media" accept="video/*"/>
                                        <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                        <h4>Upload Media</h4>
                                        <h5>25 MB Maximum</h5>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="uploard-logo-one">
                                    <video id="preview_media" width="230" height="147" style="display:none" controls>
                                             Your browser does not support the video tag.
                                    </video>
                                    </div>
                                    <div class="btn_grp">
                                        <a class="dlt_btn removePropertyMedia" href="#" style="margin-left: 98px;color: red;">Delete</a>
                                    </div>
                                    <span id="mediaerror"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



 <!--remove merchant user -->
 <div class="modal fade cmn_modal_designs gap_sec_modal2" id="removeuser_modal" tabindex="-1" aria-hidden="true">
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
                            <button class="btn_table_s blu auto_wd" id="yesRemove">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- view_contact_info_modal -->
 <div class="modal fade cmn_modal_designs" id="view_contact_info_modal" aria-hidden="true" tabindex="-1">
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
                        @forelse ($getusers as $user)
                            <tr id="removeuser_id{{ $user->provideruser->id }}">
                                <td></td>
                                <td id="">{{ $user->provideruser->full_name }}</td>
                                <td>{{ $user->title->title_name }}</td>
                                @if($user->provideruser->phone != '')
                                   <td>{{ $user->provideruser->phone }}</td>
                                @else
                                   <td>---</td>
                                @endif
                                @if($user->provideruser->phone_ext != '')
                                   <td>{{ $user->provideruser->phone_ext }}</td>
                                @else
                                  <td>---</td>
                                @endif
                                <td>{{ $user->provideruser->email }}</td>
                                @if ($user->provideruser->id != Auth::user()->id)
                                <td>
                                    <div class="selctd_table_sec">
                                        <button class="btn btn-danger remove_user"
                                            data-id="{{ $user->provideruser->id }}">Remove</button>
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
            <div class="modal-footer">
                <div class="btn_foot_end">
                    <a href="javascript:void(0)" class="btn_table_s rdd" data-bs-target="#new_user_pop1"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- remove  image -->

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_property_image_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this photo</h3>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeLogo">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_property_media_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this video</h3>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeVideo">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_property_mainimage_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this photo</h3>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeMainPhoto">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_property_photo_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this photo</h3>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removePhoto">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_property_photo_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this photo</h3>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removePhoto">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="featureviewModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr text-left">
                    <div class="cmn_secthd_modals">
                        <div class="feature-tab-wrapper">
                            <ul class="nav">
                                <li class="nav-item">
                                  <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="#">Features</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" href="#">Amenities</a>
                                </li>
                            </ul>   
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="feature-tab-body featureviewList">
                                       
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="feature-tab-body amenityviewList">
                                        
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

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="featureManageModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr text-left">
                    <div class="cmn_secthd_modals">
                        <div class="feature-tab-wrapper">
                            <ul class="nav">
                                <li class="nav-item">
                                  <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="javascript:void(0);">Features</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link link-secondary" id="about-tab"  href="javascript:void(0);">Amenities</a>
                                </li>
                            </ul>   
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="feature-tab-body featuremanageList">
                                        
                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="feature-tab-body">
                                        <div class="feature-list">
                                            <p>Wood-Style Flooring</p>
                                        </div>
                                        <div class="feature-list">
                                            <p>Wood-Style Flooring</p>
                                        </div>
                                        <div class="feature-list">
                                            <p>Wood-Style Flooring</p>
                                        </div>
                                        <div class="feature-list">
                                            <p>Wood-Style Flooring</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-modal-btm editForm">
                        <div class="f-btm-outr">
                            <form class="feature-form">
                                <div class="form-group">                         
                                     <input type="text" placeholder="Enter text" id="featuretext">
                                     <input type = "hidden" id="featureid">
                                     <input type = "hidden" id="featuretype" value="add">
                                </div>
                                <span id="text_error" style="color:red;"></span>
                            </form>
                            <div class="btn-wrap">
                                <button type="submit" class="btn_table_s grn addUpdateFeature" name="submit">Add</button>
                                <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="amenityManageModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr text-left">
                    <div class="cmn_secthd_modals">
                        <div class="feature-tab-wrapper">
                            <ul class="nav">
                                <li class="nav-item">
                                  <a class="nav-link link-secondary " id="home-tab" href="javascript:void(0);">Features</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link link-secondary active" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" href="javascript:void(0);">Amenities</a>
                                </li>
                            </ul>   
                            <div class="tab-content" id="tabContent">
                                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="feature-tab-body ">
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                                    <div class="feature-tab-body amenityManagerList">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="feature-modal-btm editForm">
                        <div class="f-btm-outr">
                            <form class="feature-form">
                                <div class="form-group">                         
                                     <input type="text" placeholder="Enter text" id="amenitytext">
                                     <input type = "hidden" id="amenityid">
                                     <input type = "hidden" id="amenitytype" value="add">
                                </div>
                                <span id="amenitytext_error" style="color:red;"></span>
                            </form>
                            <div class="btn-wrap">
                                <button type="submit" class="btn_table_s grn addUpdateAmenity" name="submit">Add</button>
                                <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs" id="externalManageModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >

            <div class="modal-body">
                <div class="table_user_top_sec_col_lft new">
                    <h3 id="prpertyName"></h3>
                </div>

                <div class="table_cmn_part_sgn">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th style="text-align: center;">URL or Source</th>
                                <th style="text-align: center;">Display On Landing Page</th>
                            </tr>
                        </thead>
                        <tbody id="external_Data">
                            <tr>
                                <td>Conatct Community</td>
                                <td style="text-align: center;"><input type="text" id="contact_community_text" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                   <br> <span id="contact_community_error"></span></td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="contact_community_check" ></td>
                            </tr>
                            <tr>
                                <td>View Event Flyer</td>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu viewEventFlyerImages" >Manage Event Flyer Images</a>
                                </td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="event_flyer_check" ></td>
                            </tr>
                            <tr>
                                <td>Floor Plans</td>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0)" style="width: 100%;" class="btn_table_s blu viewFloorImages" >Manage Floor Plan Images</a>
                                </td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="floor_plan_check" ></td>
                            </tr>
                            <tr>
                                <td>Lease Online</td>
                                <td style="text-align: center;"><input type="text" id="lease_online_text" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                    <br> <span id="lease_online_error"></span></td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="lease_online_check" ></td>
                            </tr>
                            <tr>
                                <td>Resident Portal</td>
                                <td style="text-align: center;"><input type="text" id="resident_portal_text" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                    <br> <span id="resident_portal_error"></span></td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="resident_portal_check" ></td>
                            </tr>
                            <tr>
                                <td>Visit Direct Website</td>
                                <td style="text-align: center;"><input type="text" id="visit_website_text" class="form-control" style="width: 100%;border: 1px solid #b7aeae!important;">
                                    <br> <span id="direct_website_error"></span></td>
                                <td style="text-align: center;"><input type="checkbox" class="assign-one1" id="visit_website_check" ></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer not_last">
                <div class="modal-footer-gap-none">
                    <div class="row option_avlbl_row align-items-center gy-2">
                        <div class="col-lg-6 option_avlbl_col_lft">
                        </div>
                        <div class="col-lg-6 option_avlbl_col_rght">
                           
                            <div class="btn_foot_end">
                                <a href="javascript:void(0)" class="btn_table_s grn saveExternalData" >Save</a>
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

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="FloorimageModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <form id="managefloorplan" name="managefloorplan" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="cmn_secthd_modals">
                            <div class="manage-modal-outr">
                                <h4>Floor Plan Manager</h4>
                                <div class="manage-modal-inn">
                                    <div class="row m-row">
                                        <div class="col-md-3">
                                            <div class="manage-modal-lft">
                                                <div class="uploard-logo-one">
                                                    <input type="file" class="uploard-file-one" id="floor_image1" wire:model.defer="floor_image1">
                                                    <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg" id="floorimage1_preview" style="height: 39px; border-radius: 7%;">
                                                    <h4 id="floorimage1_title">Floor Plan Image</h4>
                                                    <input type="hidden" id="edit_image1">
                                                </div>
                                                <div class="feaure-btn">
                                                    <a href="javascript:void(0);" class="rmve-btn deleteimage1">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9" style="margin-bottom: 27px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bedroom1" name="bedroom1">
                                                    </div>
                                                </div>
                                                

                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bathroom1" name="bathroom1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>Total sqft.</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="total1" name="total1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-btn">
                                                        <a href="javascript:void(0);" id="clear1_all">Clear All</a>
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
                                                    <input type="file" class="uploard-file-one" id="floor_image2" name="floor_image2" wire:model.defer="floor_image2">
                                                    <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg" id="floorimage2_preview" style="height: 39px; border-radius: 7%;">
                                                    <h4 id="floorimage2_title">Floor Plan Image</h4>
                                                    <input type="hidden" id="edit_image2">
                                                </div>
                                                <span id="floorimage2error" ></span>
                                                <div class="feaure-btn">
                                                
                                                    <a href="javascript:void(0);" class="rmve-btn deleteimage2">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9" style="margin-bottom: 27px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bedroom2" name="bedroom2">
                                                    </div>
                                                    <span id="bedroom2error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bathroom2" name="bathroom2">
                                                    </div>
                                                    <span id="bathroom2error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>Total sqft.</h3>
                                                            <input type="text"  onkeypress="return isNumber(event);" id="total2" name="total2">
                                                    </div>
                                                    <span id="total2error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-btn">
                                                        <a href="javascript:void(0);" id="clear2_all">Clear All</a>
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
                                                    <input type="file" class="uploard-file-one" id="floor_image3" name="floor_image3" wire:model.defer="floor_image3">
                                                    <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/uploard-logo-icon11.svg" id="floorimage3_preview" style="height: 39px; border-radius: 7%;">
                                                    <h4 id="floorimage3_title">Floor Plan Image</h4>
                                                    <input type="hidden" id="edit_image3">
                                                </div>
                                                <span id="floorimage3error" ></span>
                                                <div class="feaure-btn">
                                                
                                                    <a href="javascript:void(0);" class="rmve-btn deleteimage3">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9" style="margin-bottom: 27px;">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bedrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bedroom3" name="bedroom3">
                                                    </div>
                                                    <span id="bedroom3error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>#Bathrooms</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="bathroom3" name="bathroom3">
                                                    </div>
                                                    <span id="bathroom3error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-modal-inr">
                                                        <h3>Total sqft.</h3>
                                                            <input type="text" onkeypress="return isNumber(event);" id="total3" name="total3">
                                                    </div>
                                                    <span id="total3error" ></span>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="manage-btn">
                                                        <a href="javascript:void(0);" id="clear3_all">Clear All</a>
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
                                                <button type="submit" name="submit" class="btn_table_s grn" >Save</button>
                                                <a href="javascript:void(0)" class="btn_table_s rdd" data-bs-dismiss="modal">Close</a>
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

<div class="modal fade cmn_modal_designs" id="EventFlyerimageModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 45%!important;">
        <div class="modal-content" style="background-color:#d6d5d5!important;" >
            <form id="manageflyerimage" name="manageflyerimage" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="table_user_top_sec_col_lft new">
                        <h3>Event Flyer Manager</h3>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="uploard-logo-one">
                                <input type="file" class="uploard-file-one"  id="flyer_image1" name="flyer_image1"/>
                                <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" id="flyerimage1_preview"/>
                                <h4 id="flyerimage1_title">Flyer Image #1</h4>
                            </div>
                            <div class="btn_grp" style="text-align: center;">
                                <a class="dlt_btn removeFlyerImage1" style="color: #ff2719;" data-id = "" href="javascript:void(0);">Delete</a>
                            </div>
                            <span id="flyerimage1_error"></span>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="uploard-logo-one">
                                <input type="file" class="uploard-file-one"  id="flyer_image2" name="flyer_image2"/>
                                <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" id="flyerimage2_preview"/>
                                <h4 id="flyerimage2_title">Flyer Image #2</h4>
                            </div>
                            <div class="btn_grp" style="text-align: center;">
                                <a class="dlt_btn removeFlyerImage2" style="color: #ff2719;"  data-id = "" href="javascript:void(0);" >Delete</a>
                            </div>
                            <span id="flyerimage2_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            
                            <div class="col-lg-12 option_avlbl_col_rght">
                            
                                <div class="btn_foot_end">
                                    <button type="submit" class="btn_table_s grn" name="submit">Save</button>
                                    <a href="javascript:void(0)" class="btn_table_s rdd"
                                        data-bs-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="img_delete_success_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="successmessage"></h3>
                    </div>
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_feature_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you would like to remove this feature?</h3>
                    </div>
                    <input type="hidden" id="remove_featureid" name="remove_featureid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeFeature">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_amenity_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you would like to remove this Amenity?</h3>
                    </div>
                    <input type="hidden" id="remove_amenityid" name="remove_amenityid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeAmenity">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_floorimage_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you would like to remove this image?</h3>
                    </div>
                    <input type="hidden" id="remove_image" >
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeFloorImage">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_flyer_photo_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>Are you sure you want to delete this photo</h3>
                    </div>
                    <input type="hidden" id="imageid" name="imageid">
                    <input type="hidden" id="image_number" name="image_number">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="removeFlyerImage">Yes</button>
                            <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@push('scripts')

<script>
    var base_url = window.location.origin;
        function isNumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    $(document).ready(function(){
        $(document).on('click','#site_setting',function(){
            $("#property_settingModal").modal('show');
            $('#currentpropertyName').text($("#change_first").text());
            const logourl = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
            
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.get_provider_detail') }}",
                data: {'property_id':$("#property_id").val()},
                success: function(response) {
                    console.log(response);
                    if(response.logo != ''){
                        $("#preview_logo").attr('src',response.logo);
                    }
                    else{
                        $("#preview_logo").attr('src',logourl);
                    }
                    
                    if(response.data.property_video != ''){
                        if(response.data.property_video != null){
                            const mediaurl = base_url+'/storage/'+response.data.property_video;
                            $("#preview_media").css('display','block')
                            $("#preview_media").attr('src',mediaurl);
                        }
                        else{
                            $("#preview_media").css('display','none')
                            $("#preview_media").attr('src','');
                        }
                        
                    }
                    else{
                        $("#preview_media").css('display','none')
                        $("#preview_media").attr('src','');
                    }
                    $('#photo_preview').html('');
                    if(response.photos.length > 0){
                        for(var i = 0; i < response.photos.length; i++){
                            if(response.photos[i].image == response.data.main_image){
                                var mainimage = response.photos[i].image;
                                var mainimageid = response.photos[i].id;
                            }
                            var image_list = '<div class="col-md-3 item imageclass">' +
                                            '<div class="inner">' +
                                                '<img width="175" height="130" class="propertyimage" data-id = "' + response.photos[i].id + '" src="' + response.photos[i].image +
                                                        '"  alt="" />' +
                                                '<div class="btn_grp">' +
                                                    '<a class="dlt_btn removeImage" href="javascript:void(0);" style="font-size: 11px;color: red;">Delete</a>' +
                                                    '<a class="mkm_pht_btn make_main_photo" href="javascript:void(0);" style="font-size: 11px;margin-left: 14px;">Make Main Photo</a>' +
                                                '</div>' +
                                            '</div>' +
                                            '</div>';
                            $('#photo_preview').append(image_list);
                            
                        }
                        $("#preview_photo").attr('src', mainimage);
                        $("#main_image_id").val(mainimageid);
                    }
                    else{
                        $("#preview_photo").attr('src', logourl);
                        $("#main_image_id").val('');
                    }
                    

                }
            });

        });

        $(document).on('click', '#property_provider', function() {
            var propertyid = $(this).attr('data-property_id');
            // console.log(value1);
            let ajaxPath = base_url + "/get-provider-detail";
            $(".property_term_limit").text('');
            $(".property_frequency").text('');
            $(".property_current_allowance").text('');
            $(".property_sign_up").text('');
            $(".property_low_point").text('');
            $(".property_add_point").text('');
            $.ajax({
                type: 'GET',
                url: ajaxPath,
                data:{'property_id':propertyid},
                success: function(response) {
                    console.log(response);
                    $('#change_first').text(response.data.name);
                    $('#property_address').text(response.data.address);
                    $('#property_id').val(response.data.id);
                    $('#distributePoint').text(addCommas(response.data.points_to_distribute) +
                        ' Points');
                    $('#currentpropertyName').text(response.data.name);
                    $('#about_property_name').text(response.data.name);
                    $('#property_description').text(response.data.description);;                        console.log();
                    if(response.data.property_limit != null){
                        if(response.data.property_limit.term_limit != null){
                            $(".property_term_limit").text(response.data.property_limit.term_limit);
                        }
                        if(response.data.property_limit.frequency != null){
                            $(".property_frequency").text(response.data.property_limit.frequency);
                        }
                        if(response.data.property_limit.current_allowance_point_limit != null){
                            $(".property_current_allowance").text(response.data.property_limit.current_allowance_point_limit+' point');
                        }
                        if(response.data.property_limit.sign_up_bonus_point != null){
                            $(".property_sign_up").text(response.data.property_limit.sign_up_bonus_point+' point');
                        }
                        if(response.data.property_limit.low_point_balance != null){
                            $(".property_low_point").text(response.data.property_limit.low_point_balance+' point');
                        }
                        if(response.data.property_limit.add_point != null){
                            $(".property_add_point").text(response.data.property_limit.add_point+' point');
                        }
                                                    
                    }
                    
                }
            });

        });

        $(document).on('click', '#manage_contact_id', function(){
            $("#manage_contact_info_modal").modal('show');
            var propertyId = $('#property_id').val();
            // console.log(propertyId);
            $.ajax({
                url: "{{ route('frontend.provider.user_list_by_property_id') }}",
                type: 'GET',
                data: {
                    'propertyId': propertyId,
                },
                success: function(response) {
                   
                    if (response.status == 1) {
                        if (response.data.length > 0) {
                                    $("#merchant_user_list").html('');
                                    console.log(response.data);
                                    for (var i = 0; i < response.data.length; i++) {
                                        var userdata = response.data[i].provideruser;
                                        if (userdata.id != response.user.id) {
                                            // console.log(userdata.id);
                                            var action ='<div class="selctd_table_sec">'+
                                                                    '<button class="btn btn-danger remove_user"'+
                                                                        'data-id="'+userdata.id+'" type="button">Remove</button>'+
                                                        '</div>';
                                                    
                                        } else {
                                            var action = '<div class="selctd_table_sec">'+
                                                                    '---'+
                                                        '</div>';
                                        }
                                        if(userdata.phone_ext != null){
                                            var phonedata = userdata.phone_ext;
                                        } else{
                                            var phonedata =  '---';
                                        }
                                        if(userdata.phone != null){
                                            var phoneno = userdata.phone;
                                        } else{
                                            var phoneno =  '';
                                        }
                                        
                                        var list =   '<tr id="removeuser_id'+userdata.id+'">'+
                                                        '<td></td>'+
                                                        '<td id="">'+userdata.full_name+'</td>'+
                                                        '<td>'+userdata.title.title_name+'</td>'+
                                                        '<td>'+phoneno+'</td>'+
                                                        '<td>'+phonedata+'</td>'+
                                                        '<td>'+userdata.email+'</td>'+
                                                        
                                                            '<td>'+
                                                                action
                                                            '</td>'+
                                                    '</tr>' ;
                                                   
                                        $("#merchant_user_list").append(list);
                                        // console.log(options);
                                        console.log(list); 
                                    }

                                    if (response.adduser.length > 0) {
                                        
                                        $("#available_user").html(
                                            '<option value = "" >Choose Available Management Level User</option>'
                                            );
                                        for (var i = 0; i < response.adduser.length; i++) {
                                            var options = '<option value = "' + response.adduser[i].provideruser.id +
                                                '">' +
                                                response.adduser[i].provideruser.full_name + '</option>';
                                            $("#available_user").append(options);
                                            //console.log(options);
                                        }
                                    }
                            }
                    }
                }
            });
        });

        $(document).on('click','.remove_user', function() {
            var userId = $(this).data('id');

            $.ajax({
                url: "{{ route('frontend.provider.get_remove_provider_user') }}",
                type: 'GET',
                data: {
                    'userId': userId,
                },
                success: function(response) {
                    if (response.success == 1) {
                        $("#removeuser_modal").modal('show');
                        $("#user_name").html(response.data.full_name);
                        $("#user_id").val(response.data.id);

                    }
                }
            });
        });
        $(document).on('click', '#yesRemove', function() {
            var userRemove = $("#user_id").val();
            var propertyid = $("#property_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('frontend.provider.remove_provider_user') }}",
                type: 'POST',
                data: {
                    'userRemove': userRemove,
                    'propertyid' : propertyid,
                },
                success: function(response) {

                    if (response.success == 1) {
                        $("#removeuser_modal").modal('hide');
                        $("#manage_contact_info_modal").modal('show');
                        $("#removeuser_id" + userRemove).html("");
                        $("#available_user").html('');
                        // $("#success_modal").modal('show');
                        // $("#success_msg").html(
                        //     'The Merchant User has been removed successfully.')

                        if (response.data.length > 0) {
                            $("#available_user").html('');
                            $("#available_user").html(
                                '<option value = "" >Choose Available Management Level User</option>'
                                );
                            for (var i = 0; i < response.data.length; i++) {
                                var options = '<option value = "' + response.data[i].provideruser.id +
                                    '">' +
                                    response.data[i].provideruser.full_name + '</option>';
                                $("#available_user").append(options);
                                //console.log(options);
                            }
                        }
                    }
                }
            });
        });

        $(document).on('click', '#adduser', function() {
            $('#managerusererror').html(' ');
            if($("#available_user").val() != ''){
                var user = $("#available_user").val();
                var propertyid = $("#property_id").val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                        url: '{{ route("frontend.provider.add_provider_user") }}',
                        type: 'POST',
                        data: {
                            'user': user,
                            'propertyid' : propertyid
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                // console.log(response.data);
                                $("#manage_contact_info_modal").modal('show');
                                $("#available_user").html('');
                                toastr.success('Provider user added successfully.');
                                if (response.data.length > 0) {
                                    $("#merchant_user_list").html('');
                                    // console.log(response.data);
                                    for (var i = 0; i < response.data.length; i++) {
                                        var userdata = response.data[i].provideruser;
                                        if (userdata.id != response.user.id) {
                                            // console.log(userdata.id);
                                            var action ='<div class="selctd_table_sec">'+
                                                                    '<button class="btn btn-danger remove_user"'+
                                                                        'data-id="'+userdata.id+'" type="button">Remove</button>'+
                                                        '</div>';
                                                    
                                        } else {
                                            var action = '<div class="selctd_table_sec">'+
                                                                    '---'+
                                                        '</div>';
                                        }
                                        if(userdata.phone_ext != null){
                                            var phonedata = userdata.phone_ext;
                                        } else{
                                            var phonedata =  '---';
                                        }
                                        if(userdata.phone != null){
                                            var phoneno = userdata.phone;
                                        } else{
                                            var phoneno =  '';
                                        }
                                        
                                        var list =   '<tr id="removeuser_id'+userdata.id+'">'+
                                                        '<td></td>'+
                                                        '<td id="">'+userdata.full_name+'</td>'+
                                                        '<td>'+userdata.title.title_name+'</td>'+
                                                        '<td>'+phoneno+'</td>'+
                                                        '<td>'+phonedata+'</td>'+
                                                        '<td>'+userdata.email+'</td>'+
                                                        
                                                            '<td>'+
                                                                action
                                                            '</td>'+
                                                    '</tr>' ;
                                                   
                                        $("#merchant_user_list").append(list);
                                        // console.log(options);
                                        console.log(list); 
                                    }
                                    if (response.adduser.length > 0) {
                                        
                                        $("#available_user").html(
                                            '<option value = "" >Choose Available Management Level User</option>'
                                            );
                                        for (var i = 0; i < response.adduser.length; i++) {
                                            var options = '<option value = "' + response.adduser[i].provideruser.id +
                                                '">' +
                                                response.adduser[i].provideruser.full_name + '</option>';
                                            $("#available_user").append(options);
                                            //console.log(options);
                                        }
                                    }
                                }
                            

                        }
                    }
                });
            }
            else{
                $('#managerusererror').html('Select a manager first').css('color','red');
            }
                   
        });

        $(document).on('change','#property_logo',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var fd = new FormData();
            var logo = this.files[0];
            //console.log(logo);
            if(logo != ''){
             fd.append('logo',logo);
             fd.append('property_id',$('#property_id').val());
             
                $.ajax({
                            type: 'POST',
                            url: "{{ route('frontend.provider.save_property_logo') }}",
                            data: fd,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (response) => {
                               // console.log(response);
                                if(response.status == 1){
                                    $("#preview_logo").attr('src',response.data);
                                }
                            },
                            error: function(data) {
                                $.each(data.responseJSON.errors, function(key, value) {
                                    $(".show-error").find("ul").append('<li>' + value +
                                        '</li>');
                                })
                            }
                        });
            }
            else{
                console.log('123');
            }
        });

        $(document).on('click','.removePropertyLogo',function(){
            $("#remove_property_image_modal").modal('show');
            $("#removeid").val($('#property_id').val());
        });
        
        $(document).on('click','#removeLogo',function(){
            $("#remove_property_image_modal").modal('hide');
            const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.remove_provider_logo') }}",
                data: {'property_id':$("#removeid").val()},
                success: function(response) {
                    if(response.status == 1){
                        $("#img_delete_success_modal").modal('show');
                        $("#successmessage").html('Logo has been deleted successfully');
                        $("#preview_logo").attr('src',url);
                    }
                }
            });
        });

        $(document).on('change','#property_media',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var fdata = new FormData();
            var video = this.files[0];
            
            if(video != ''){
                fdata.append('media',video);
                fdata.append('property_id',$('#property_id').val());
               // console.log(fdata);
                $.ajax({
                            type: 'POST',
                            url: "{{ route('frontend.provider.save_property_media') }}",
                            data: fdata,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: (response) => {
                                console.log(response);
                                if(response.status == 1){
                                    var url = base_url+'/storage/'+response.data;
                                    $("#preview_media").css('display','block')
                                    $("#preview_media").attr('src',url);
                                }
                                else{
                                    $("#mediaerror").html(response.validation_errors).css('color','red');
                                }
                            },
                            error: function(data) {
                                $.each(data.responseJSON.errors, function(key, value) {
                                    $(".show-error").find("ul").append('<li>' + value +
                                        '</li>');
                                })
                            }
                        });
            }
            else{
                console.log('123');
            }
        });

        $(document).on('click','.removePropertyMedia',function(){
            $("#remove_property_media_modal").modal('show');
            $("#removeid").val($('#property_id').val());
        });

        $(document).on('click','#removeVideo',function(){
            $("#remove_property_media_modal").modal('hide');
            //const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.remove_provider_media') }}",
                data: {'property_id':$("#removeid").val()},
                success: function(response) {
                    if(response.status == 1){
                        $("#img_delete_success_modal").modal('show');
                        $("#successmessage").html('Media has been deleted successfully');
                        $("#preview_media").css('display','block')
                        $("#preview_media").attr('src','');
                        $("#preview_media").removeAttr('autoplay');
                        $("#preview_media").removeAttr('controls');
                    }
                }
            });
        });

        $(document).on('change','#property_photos',function(){
            var formData = new FormData();
            let TotalFiles = $('#property_photos')[0].files.length; //Total files
            if(TotalFiles > 0){
                let files = $('#property_photos')[0];
                    for (let i = 0; i < TotalFiles; i++) {
                        formData.append('files[' + i+']', files.files[i]);
                    }
                formData.append('TotalFiles', TotalFiles);
                formData.append('property_id', $('#property_id').val());
               // console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                        type: 'POST',
                        url: "{{ route('frontend.provider.save_property_photo') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: (response) => {
                            console.log(response);
                            if(response.status == 1){
                                for (var i = 0; i < response.data.length; i++) {
                                    var div_list = '<div class="col-md-3 item imageclass">' +
                                            '<div class="inner">' +
                                                '<img width="175" height="130" class="propertyimage" data-id = "' + response.data[i].id + '" src="' + response.data[i].image +
                                                        '"  alt="" />' +
                                                '<div class="btn_grp">' +
                                                    '<a class="dlt_btn removeImage" href="javascript:void(0);" style="font-size: 11px;color: red;">Delete</a>' +
                                                    '<a class="mkm_pht_btn make_main_photo" href="javascript:void(0);" style="font-size: 11px;margin-left: 14px;">Make Main Photo</a>' +
                                                '</div>' +
                                            '</div>' +
                                            '</div>';
                                    $('#photo_preview').append(div_list);
                                }
                            }
                           
                        },
                        error: function(data) {
                            // alert(data.responseJSON.errors.files[0]);
                            // console.log(data.responseJSON.errors);
                            $.each(data.responseJSON.errors, function(key, value) {
                                $(".show-error").find("ul").append('<li>' + value +
                                    '</li>');
                            })
                        }
                });
            }
        });

        $(document).on('click','.make_main_photo',function(){
            const url = $(this).parent().parent().find('img.propertyimage').attr('src');
            $("#preview_photo").attr('src', url);
            var id = $(this).parent().parent().find('img.propertyimage').data('id');
            $("#main_image_id").val(id);
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.make_main_property_photo') }}",
                data: {'photoid':id},
                success: function(response) {
                    // if(response.status == 1){
                        
                    // }
                    console.log(response);
                }
            });
        });

        $(document).on('click','.removeMainImage',function(){
            var imageid = $("#main_image_id").val();
            $("#remove_property_mainimage_modal").modal('show');
            $("#removeid").val(imageid);
        });

        $(document).on('click','#removeMainPhoto',function(){
            $("#remove_property_mainimage_modal").modal('hide');
            const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.remove_provider_main_photo') }}",
                data: {'photoid':$("#removeid").val()},
                success: function(response) {
                    if(response.status == 1){
                        $("#img_delete_success_modal").modal('show');
                        $("#successmessage").html('Main Image has been deleted successfully');
                        $("#preview_photo").attr('src', url);
                        $("#main_image_id").val('');
                        if(response.data.length > 0){
                            $('#photo_preview').html('');
                            for (var i = 0; i < response.data.length; i++) {
                                var div_list = '<div class="col-md-3 item imageclass">' +
                                        '<div class="inner">' +
                                            '<img width="175" height="130" class="propertyimage" data-id = "' + response.data[i].id + '" src="' + response.data[i].image +
                                                    '"  alt="" />' +
                                            '<div class="btn_grp">' +
                                                '<a class="dlt_btn removeImage" href="javascript:void(0);" style="font-size: 11px;color: red;">Delete</a>' +
                                                '<a class="mkm_pht_btn make_main_photo" href="javascript:void(0);" style="font-size: 11px;margin-left: 14px;">Make Main Photo</a>' +
                                            '</div>' +
                                        '</div>' +
                                        '</div>';
                                $('#photo_preview').append(div_list);
                            }
                        }

                    }
                }
            });
        });

        $(document).on('click','.removeImage',function(){
            var imgID = $(this).parent().parent().find('.propertyimage').data('id');
            $("#remove_property_photo_modal").modal('show');
            $("#removeid").val(imgID);
        });

        $(document).on('click','#removePhoto',function(){
            $("#remove_property_photo_modal").modal('hide');
            const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.remove_provider_photo') }}",
                data: {'photoid':$("#removeid").val()},
                success: function(response) {
                    $("#img_delete_success_modal").modal('show');
                    $("#successmessage").html('Photo has been deleted successfully');
                    if(response.status == 1){
                        $("#preview_photo").attr('src', url);
                        $("#main_image_id").val('');
                    }
                    
                    if(response.data.length > 0){
                        $('#photo_preview').html('');
                        for (var i = 0; i < response.data.length; i++) {
                            var div_list = '<div class="col-md-3 item imageclass">' +
                                    '<div class="inner">' +
                                        '<img width="175" height="130" class="propertyimage" data-id = "' + response.data[i].id + '" src="' + response.data[i].image +
                                                '"  alt="" />' +
                                        '<div class="btn_grp">' +
                                            '<a class="dlt_btn removeImage" href="javascript:void(0);" style="font-size: 11px;color: red;">Delete</a>' +
                                            '<a class="mkm_pht_btn make_main_photo" href="javascript:void(0);" style="font-size: 11px;margin-left: 14px;">Make Main Photo</a>' +
                                        '</div>' +
                                    '</div>' +
                                    '</div>';
                            $('#photo_preview').append(div_list);
                        }
                    }

                }
            });
        });

        $(document).on('click','.feature_view',function(){
            $("#featureviewModal").modal('show');
            $("#about-tab").removeClass('active');
            $("#home-tab").addClass('active');
            $("#home").addClass('active');
            $("#home").addClass('show');
            $("#about").removeClass('active');
            var propertyid = $("#property_id").val();
            $(".featureviewList").html('');
            $(".amenityviewList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.get_provider_feature') }}",
                    type: 'GET',
                    data: {
                        'propertyid': propertyid,
                    },
                    success: function(response) {
                        if(response.status == 1){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                    var fList = '<div class="feature-list">'+
                                                    '<p>'+response.data[i].feature_text+'</p>'+
                                                '</div>';
                                    $(".featureviewList").append(fList);
                                }
                            }
                            if(response.dataAmenity.length > 0){
                                for(var j = 0; j < response.dataAmenity.length; j++){
                                    var aList = '<div class="feature-list">'+
                                                    '<p>'+response.dataAmenity[j].amenity_text+'</p>'+
                                                '</div>';
                                    $(".amenityviewList").append(aList);
                                }
                            }
                        }
                        else if(response.status == 2){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                    var fList = '<div class="feature-list">'+
                                                    '<p>'+response.data[i].feature_text+'</p>'+
                                                '</div>';
                                    $(".featureviewList").append(fList);
                                }
                            }
                            $(".amenityviewList").html('No Amenities found');
                        }
                        else if(response.status == 0){
                            $(".featureviewList").html('No Features found');
                            $(".amenityviewList").append('No Amenities found');
                        }
                        else if(response.status == 3){
                            $(".featureviewList").html('No Features found');
                            if(response.dataAmenity.length > 0){
                                for(var j = 0; j < response.dataAmenity.length; j++){
                                    var aList = '<div class="feature-list">'+
                                                    '<p>'+response.dataAmenity[j].amenity_text+'</p>'+
                                                '</div>';
                                    $(".amenityviewList").append(aList);
                                }
                            }
                        }
                    }
            });
        })

        $(document).on('click','.feature_manage',function(){
            $("#featureManageModal").modal('show');
            var propertyid = $("#property_id").val();
            $(".featuremanageList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.get_provider_feature') }}",
                    type: 'GET',
                    data: {
                        'propertyid': propertyid,
                    },
                    success: function(response) {
                        if(response.status == 1){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                   
                                    var fmanageList = '<div class="feature-list">'+
                                                        '<p id="featureText">'+response.data[i].feature_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editFeature" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeFeatureModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".featuremanageList").append(fmanageList);
                                }
                            }
                        }
                        else if(response.status == 2){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                   
                                    var fmanageList = '<div class="feature-list">'+
                                                        '<p id="featureText">'+response.data[i].feature_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editFeature" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeFeatureModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".featuremanageList").append(fmanageList);
                                }
                            }
                        }
                        else if(response.status == 0){
                            $(".featuremanageList").html('No Features found');
                        }
                        else if(response.status == 3){
                            $(".featuremanageList").html('No Features found');
                        }
                    }
            });
        });

        $(document).on('click','.editFeature',function(){
            var featureid = $(this).data('id');
            $('.addUpdateFeature').text('Update');
            //console.log($(this).parent().parent().find('p#featureText').text());
            $('#featuretext').val($(this).parent().parent().find('p#featureText').text());
            $("#featureid").val(featureid);
            $('#featuretype').val('update');

        });

        $(document).on('click','.addUpdateFeature',function(){
            var featureid = $('#featureid').val();
            var feature_text = $('#featuretext').val();
            var feature_type = $('#featuretype').val();
            var propertyid = $("#property_id").val();
            
            if(feature_text == ''){
                $("#text_error").html('Please enter any text');
            }
            else{
                $(".featuremanageList").html('');
                $('#featuretext').val('');
                $('#featureid').val('');
                $('.addUpdateFeature').text('Add');
                $('#featuretype').val('add');
                console.log(feature_text);
                $("#text_error").html(' ');
            
                $.ajax({
                        url: "{{ route('frontend.provider.update_provider_feature') }}",
                        type: 'GET',
                        data: {
                            'featureid': featureid,
                            'feature_text' : feature_text,
                            'featuretype' : feature_type,
                            'propertyid': propertyid
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 1){
                                if(response.data.length > 0){
                                    for(var i = 0; i < response.data.length; i++){
                                    
                                        var fmanageList = '<div class="feature-list">'+
                                                            '<p id="featureText">'+response.data[i].feature_text+'</p>'+
                                                                '<div class="feaure-btn">'+
                                                                    '<a href="javascript:void(0);" class="edit-btn editFeature" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                    '<a href="javascript:void(0);" class="rmve-btn removeFeatureModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                                '</div>'+
                                                            '</div>';
                                        $(".featuremanageList").append(fmanageList);
                                        $("#img_delete_success_modal").modal('show');
                                        $('#successmessage').html('Feature updated successfully');
                                    }
                                }
                            }
                        }
                });
            }
        });

        $(document).on('click','.removeFeatureModal',function(){
            var featureid = $(this).data('id');
            $("#remove_featureid").val(featureid);
            $("#remove_feature_modal").modal('show');
        });

        $(document).on('click','#removeFeature',function(){
            var featureid = $("#remove_featureid").val();
            var propertyid = $("#property_id").val();
            $("#remove_feature_modal").modal('hide');
            $(".featuremanageList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.remove_provider_feature') }}",
                    type: 'GET',
                    data: {
                        'featureid': featureid,
                        'propertyid': propertyid
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status == 1){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                
                                    var fmanageList = '<div class="feature-list">'+
                                                        '<p id="featureText">'+response.data[i].feature_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editFeature" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeFeatureModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".featuremanageList").append(fmanageList);
                                    $("#img_delete_success_modal").modal('show');
                                    $('#successmessage').html('Feature removed successfully');
                                }
                            }
                        }
                    }
                });
        });

        $(document).on('click','.amenity_view',function(){
            $("#featureviewModal").modal('show');
            $("#about-tab").addClass('active');
            $("#home-tab").removeClass('active');
            $("#home").removeClass('active');
            $("#about").addClass('active');
            $("#about").addClass('show');
            var propertyid = $("#property_id").val();
            $(".amenityviewList").html('');
            $(".featureviewList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.get_provider_feature') }}",
                    type: 'GET',
                    data: {
                        'propertyid': propertyid,
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status == 1){
                            if(response.dataAmenity.length > 0){
                                for(var i = 0; i < response.dataAmenity.length; i++){
                                    var aList = '<div class="feature-list">'+
                                                    '<p>'+response.dataAmenity[i].amenity_text+'</p>'+
                                                '</div>';
                                                console.log(aList);
                                    $(".amenityviewList").append(aList);
                                }
                            }
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                    var fList = '<div class="feature-list">'+
                                                    '<p>'+response.data[i].feature_text+'</p>'+
                                                '</div>';
                                    $(".featureviewList").append(fList);
                                }
                            }
                        }
                        else if(response.status == 2){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                    var fList = '<div class="feature-list">'+
                                                    '<p>'+response.data[i].feature_text+'</p>'+
                                                '</div>';
                                    $(".featureviewList").append(fList);
                                }
                            }
                            $(".amenityviewList").append('No Amenities found');
                        }
                        else if(response.status == 0){
                            $(".featureviewList").html('No Features found');
                            $(".amenityviewList").append('No Amenities found');
                        }
                        else if(response.status == 3){
                            $(".featureviewList").html('No Features found');
                            if(response.dataAmenity.length > 0){
                                for(var j = 0; j < response.dataAmenity.length; j++){
                                    var aList = '<div class="feature-list">'+
                                                    '<p>'+response.dataAmenity[j].amenity_text+'</p>'+
                                                '</div>';
                                    $(".amenityviewList").append(aList);
                                }
                            }
                            $(".featureviewList").html('No Features found');
                        }
                    }
            });
        })

        $(document).on('click','.amenity_manage',function(){
            $("#amenityManageModal").modal('show');
            var propertyid = $("#property_id").val();
            $(".amenityManagerList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.get_provider_feature') }}",
                    type: 'GET',
                    data: {
                        'propertyid': propertyid,
                    },
                    success: function(response) {
                        if(response.status == 1){
                            if(response.dataAmenity.length > 0){
                                for(var i = 0; i < response.dataAmenity.length; i++){
                                   
                                    var amanageList = '<div class="feature-list">'+
                                                        '<p id="amenityText">'+response.dataAmenity[i].amenity_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editAmenity" data-id="'+response.dataAmenity[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeAmenityModal" data-id="'+response.dataAmenity[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".amenityManagerList").append(amanageList);
                                }
                            }
                        }
                        else if(response.status == 3){
                            if(response.dataAmenity.length > 0){
                                for(var i = 0; i < response.dataAmenity.length; i++){
                                   
                                    var amanageList = '<div class="feature-list">'+
                                                        '<p id="amenityText">'+response.dataAmenity[i].amenity_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editAmenity" data-id="'+response.dataAmenity[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeAmenityModal" data-id="'+response.dataAmenity[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".amenityManagerList").append(amanageList);
                                }
                            }
                        }
                        else if(response.status == 0){
                            $(".amenityManagerList").html('No Amenities found');
                        }
                        else if(response.status == 2){
                            $(".amenityManagerList").html('No Amenities found');
                        }
                    }
            });
        });

        $(document).on('click','.editAmenity',function(){
            var amenityid = $(this).data('id');
            $('.addUpdateAmenity').text('Update');
            //console.log($(this).parent().parent().find('p#featureText').text());
            $('#amenitytext').val($(this).parent().parent().find('p#amenityText').text());
            $("#amenityid").val(amenityid);
            $('#amenitytype').val('update');

        });

        $(document).on('click','.addUpdateAmenity',function(){
            var amenityid = $('#amenityid').val();
            var amenity_text = $('#amenitytext').val();
            var amenity_type = $('#amenitytype').val();
            var propertyid = $("#property_id").val();
            
            if(amenity_text == ''){
                $("#amenitytext_error").html('Please enter any text');
            }
            else{
                $(".amenityManagerList").html('');
                $('#amenitytext').val('');
                $('#amenityid').val('');
                $('.addUpdateAmenity').text('Add');
                $('#amenitytype').val('add');
                console.log(amenity_text);
                $("#amenitytext_error").html(' ');
            
                $.ajax({
                        url: "{{ route('frontend.provider.update_provider_amenity') }}",
                        type: 'GET',
                        data: {
                            'amenityid': amenityid,
                            'amenity_text' : amenity_text,
                            'amenitytype' : amenity_type,
                            'propertyid': propertyid
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 1){
                                if(response.data.length > 0){
                                    for(var i = 0; i < response.data.length; i++){
                                    
                                        var amanageList = '<div class="feature-list">'+
                                                            '<p id="amenityText">'+response.data[i].amenity_text+'</p>'+
                                                                '<div class="feaure-btn">'+
                                                                    '<a href="javascript:void(0);" class="edit-btn editAmenity" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeAmenityModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                                '</div>'+
                                                            '</div>';
                                        $(".amenityManagerList").append(amanageList);
                                        $("#img_delete_success_modal").modal('show');
                                        $('#successmessage').html('Amenities updated successfully');
                                    }
                                }
                            }
                        }
                });
            }
        });


        $(document).on('click','.removeAmenityModal',function(){
            var amenityid = $(this).data('id');
            $("#remove_amenityid").val(amenityid);
            $("#remove_amenity_modal").modal('show');
        });


        $(document).on('click','#removeAmenity',function(){
            var amenityid = $("#remove_amenityid").val();
            var propertyid = $("#property_id").val();
            $("#remove_amenity_modal").modal('hide');
            $(".amenityManagerList").html('');
            $.ajax({
                    url: "{{ route('frontend.provider.remove_provider_amenity') }}",
                    type: 'GET',
                    data: {
                        'amenityid': amenityid,
                        'propertyid': propertyid
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status == 1){
                            if(response.data.length > 0){
                                for(var i = 0; i < response.data.length; i++){
                                
                                    var amanageList = '<div class="feature-list">'+
                                                        '<p id="featureText">'+response.data[i].amenity_text+'</p>'+
                                                            '<div class="feaure-btn">'+
                                                                '<a href="javascript:void(0);" class="edit-btn editAmenity" data-id="'+response.data[i].id+'">Edit</a>|'+
                                                                '<a href="javascript:void(0);" class="rmve-btn removeAmenityModal" data-id="'+response.data[i].id+'">Remove</a>'+
                                                            '</div>'+
                                                        '</div>';
                                    $(".amenityManagerList").append(amanageList);
                                    $("#img_delete_success_modal").modal('show');
                                    $('#successmessage').html('Aminity removed successfully');
                                }
                            }
                        }
                    }
                });
        });

        $(document).on('click','.external_manage',function(){
            $("#externalManageModal").modal('show');
            $("#contact_community_error").html('');
            $("#lease_online_error").html('');
            $("#resident_portal_error").html('');
            $("#direct_website_error").html('');
            $("#prpertyName").text($("#change_first").text());
            var propertyid = $("#property_id").val();
                $.ajax({
                        url: "{{ route('frontend.provider.get_external_manage') }}",
                        type: 'GET',
                        data: {
                            'propertyid': propertyid,
                        },
                        success: function(response) {
                            //console.log(response);
                            if(response.status == 1){
                                
                                $("#contact_community_text").val(response.data.contact_community_url);
                                if(response.data.contact_community_display != 0){
                                    $('input[id="contact_community_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="contact_community_check"]').attr('checked',false);
                                }
                                if(response.data.floor_plan_display != 0){
                                    $('input[id="floor_plan_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="floor_plan_check"]').attr('checked',false);
                                }
                                if(response.data.event_flyer_display != 0){
                                    $('input[id="event_flyer_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="event_flyer_check"]').attr('checked',false);
                                }
                                $("#lease_online_text").val(response.data.lease_online_url);
                                if(response.data.lease_online_display != 0){
                                    $('input[id="lease_online_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="lease_online_check"]').attr('checked',false);
                                }
                                $("#resident_portal_text").val(response.data.resident_portal_url);
                                if(response.data.resident_portal_display != 0){
                                    $('input[id="resident_portal_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="resident_portal_check"]').attr('checked',false);
                                }
                                $("#visit_website_text").val(response.data.visit_website_url);
                                if(response.data.visit_website_display != 0){
                                    $('input[id="visit_website_check"]').attr('checked',true);
                                }
                                else{
                                    $('input[id="visit_website_check"]').attr('checked',false);
                                }
                                $(".removeFlyerImage1").data('id','');
                                if(response.data.flyer_image1 != ''){
                                    $("#flyerimage1_title").html('');
                                    $("#flyerimage1_preview").attr('src',response.data.flyer_image1);
                                    $("#flyerimage1_preview").css('height', '149px');
                                    $("#flyerimage1_preview").css('border-radius',' 7%');
                                    $("#flyerimage1_preview").css('margin-top','11px');
                                    $(".removeFlyerImage1").data('id',response.data.id);
                                }
                                $(".removeFlyerImage2").data('id','');
                                if(response.data.flyer_image2 != ''){
                                    $("#flyerimage2_title").html('');
                                    $("#flyerimage2_preview").attr('src',response.data.flyer_image2);
                                    $("#flyerimage2_preview").css('height', '149px');
                                    $("#flyerimage2_preview").css('border-radius',' 7%');
                                    $("#flyerimage2_preview").css('margin-top','11px');
                                    $(".removeFlyerImage2").data('id',response.data.id);
                                }
                                
                            }
                            else{
                                var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                                $("#contact_community_text").val('');
                                $("#lease_online_text").val('');
                                $("#resident_portal_text").val('');
                                $("#visit_website_text").val('');
                                $('input[id="contact_community_check"]').attr('checked',false);
                                $('input[id="floor_plan_check"]').attr('checked',false);
                                $('input[id="event_flyer_check"]').attr('checked',false);
                                $('input[id="lease_online_check"]').attr('checked',false);
                                $('input[id="resident_portal_check"]').attr('checked',false);
                                $('input[id="visit_website_check"]').attr('checked',false);
                                $(".removeFlyerImage1").data('id','');
                                $("#flyerimage1_title").html('Flyer Image #1');
                                $("#flyerimage1_preview").attr('src',imglink);
                                $("#flyerimage1_preview").css('height', '39px');
                                $("#flyerimage1_preview").css('border-radius',' 7%');
                                $(".removeFlyerImage2").data('id','');
                                $("#flyerimage2_title").html('Flyer Image #2');
                                $("#flyerimage2_preview").attr('src',imglink);
                                $("#flyerimage2_preview").css('height', '39px');
                                $("#flyerimage2_preview").css('border-radius',' 7%');
                            }
                        }
                });
        });

        $(document).on('click','.saveExternalData',function(){
                var propertyid = $("#property_id").val();
                if($('input[id="contact_community_check"]').is(':checked') > 0){
                    var contact_community_check = 1;
                }
                else{
                    var contact_community_check = 0;
                }
                if($('input[id="floor_plan_check"]').is(':checked') > 0){
                    var floor_plan_check = 1;
                }
                else{
                    var floor_plan_check = 0;
                }
                if($('input[id="event_flyer_check"]').is(':checked') > 0){
                    var event_flyer_check = 1;
                }
                else{
                    var event_flyer_check = 0;
                }
                if($('input[id="lease_online_check"]').is(':checked') > 0){
                    var lease_online_check = 1;
                }
                else{
                    var lease_online_check = 0;
                }
                if($('input[id="resident_portal_check"]').is(':checked') > 0){
                    var resident_portal_check = 1;
                }
                else{
                    var resident_portal_check = 0;
                }
                if($('input[id="visit_website_check"]').is(':checked') > 0){
                    var visit_website_check = 1;
                }
                else{
                    var visit_website_check = 0;
                }
                console.log(event_flyer_check);
                $("#contact_community_error").html('');
                $("#lease_online_error").html('');
                $("#resident_portal_error").html('');
                $("#direct_website_error").html('');
                $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                });
                $.ajax({
                        url: "{{ route('frontend.provider.update_external_manage') }}",
                        type: 'POST',
                        data: {
                            'propertyid': propertyid,
                            'contact_community_text' : $('#contact_community_text').val(),
                            'contact_community_check' : contact_community_check,
                            'floor_plan_check' : floor_plan_check,
                            'event_flyer_check' : event_flyer_check,
                            'lease_online_text' : $('#lease_online_text').val(),
                            'lease_online_check' : lease_online_check,
                            'resident_portal_text' : $("#resident_portal_text").val(),
                            'resident_portal_check' : resident_portal_check,
                            'visit_website_check' : visit_website_check,
                            'visit_website_text' : $("#visit_website_text").val()

                        },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 0){
                                $("#contact_community_error").css('color','red').html(response.validation_errors);
                            }
                            else if(response.status == 1){
                                $("#lease_online_error").css('color','red').html(response.validation_errors);
                            }
                            else if(response.status == 2){
                                $("#resident_portal_error").css('color','red').html(response.validation_errors);
                            }
                            else if(response.status == 3){
                                $("#direct_website_error").css('color','red').html(response.validation_errors);
                            }
                            else if(response.status == 4){
                                $("#img_delete_success_modal").modal('show');
                                $("#successmessage").html('External manage data updated successfully');
                            }
                            else{
                                $("#img_delete_success_modal").modal('show');
                                $("#successmessage").html('External manage data not added successfully');
                            }
                        }
                });
        });

        $(document).on('click','.viewFloorImages',function(){
            $("#FloorimageModal").modal('show');
            $('#row3error').html('');
            $('#row2error').html('');
            $('#row1error').html('');
            var propertyid = $("#property_id").val();
                $.ajax({
                        url: "{{ route('frontend.provider.get_provider_floor_plan') }}",
                        type: 'GET',
                        data: {
                            'propertyid': propertyid,
                        },
                        success: function(response) {
                            var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                            if(response.status == 1){
                                if(response.image1 != ''){
                                    $("#floorimage1_preview").attr('src',response.image1);
                                    $("#floorimage1_preview").css('height', '88px');
                                    $("#floorimage1_title").html('');
                                    $("#edit_image1").val(1);
                                }
                                else{
                                    $("#edit_image1").val(0);
                                    $("#floorimage1_title").html('Floor Plan Image');
                                    $("#floorimage1_preview").attr('src',imglink);
                                }
                                if(response.image2 != ''){
                                    $("#floorimage2_preview").attr('src',response.image2);
                                    $("#floorimage2_preview").css('height', '88px');
                                    $("#floorimage2_title").html('');
                                    $("#edit_image2").val(1);
                                }
                                else{
                                    $("#edit_image2").val(0);
                                    $("#floorimage2_title").html('Floor Plan Image');
                                    $("#floorimage2_preview").attr('src',imglink);
                                }
                                if(response.image3 != ''){
                                    $("#floorimage3_preview").attr('src',response.image3);
                                    $("#floorimage3_preview").css('height', '88px');
                                    $("#floorimage3_title").html('');
                                    $("#edit_image3").val(1);
                                }
                                else{
                                    $("#edit_image3").val(0);
                                    $("#floorimage3_title").html('Floor Plan Image');
                                    $("#floorimage3_preview").attr('src',imglink);
                                }
                                $("#bedroom1").val(response.data.bedroom_1);
                                $("#bathroom1").val(response.data.bathroom_1);
                                $("#total1").val(response.data.total_1);
                                $("#bedroom2").val(response.data.bedroom_2);
                                $("#bathroom2").val(response.data.bathroom_2);
                                $("#total2").val(response.data.total_2);
                                $("#bedroom3").val(response.data.bedroom_3);
                                $("#bathroom3").val(response.data.bathroom_3);
                                $("#total3").val(response.data.total_3);

                            }
                        }
                    });
        });

        $(document).on('click','.viewEventFlyerImages',function(){
            $("#EventFlyerimageModal").modal('show');
            $("#flyerimage1_error").html('');
            $("#flyerimage2_error").html('');
               
        });

        $('#flyer_image1').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#flyerimage1_title").html('');
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("flyerimage1_preview").src = e.target.result;
                $("#flyerimage1_preview").css('height', '149px');
                $("#flyerimage1_preview").css('border-radius',' 7%');
            };
            reader.readAsDataURL(this.files[0]);
        });

        $('#flyer_image2').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#flyerimage2_title").html('');
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("flyerimage2_preview").src = e.target.result;
                $("#flyerimage2_preview").css('height', '149px');
                $("#flyerimage2_preview").css('border-radius',' 7%');
            };
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on("click",".removeFlyerImage1",function(){
                $("#remove_flyer_photo_modal").modal('show');
                $("#imageid").val('');
                $("#image_number").val('');
                $("#imageid").val($(".removeFlyerImage1").data('id'));
                $("#image_number").val(1);
        });
            
        $(document).on("click",".removeFlyerImage2",function(){
            $("#remove_flyer_photo_modal").modal('show');
            $("#imageid").val('');
            $("#image_number").val('');
            $("#imageid").val($(".removeFlyerImage2").data('id'));
            $("#image_number").val(2);
        });

        $(document).on("click","#removeFlyerImage",function(){
            var imageid = $("#imageid").val();
            $.ajax({
                    url: "{{ route('delete_event_flyer_image') }}",
                    type: 'GET',
                    data: {
                        'imageid': imageid,
                        'image_number':$("#image_number").val()
                    },
                    success: function(response) {
                        var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                        if(response.status == 0){
                            $("#remove_flyer_photo_modal").modal('hide');
                            $("#img_delete_success_modal").modal('show');
                            $("#successmessage").html('Event Flyer Image #1 deleted sucessfully');
                            //$(".removeImage1").data('id','');
                            $("#flyerimage1_title").html('Flyer Image #1');
                            $("#flyerimage1_preview").attr('src',imglink);
                            $("#flyerimage1_preview").css('height', '39px');
                            $("#flyerimage1_preview").css('border-radius',' 7%');
                        }

                        if(response.status == 1){
                            $("#remove_flyer_photo_modal").modal('hide');
                            $("#img_delete_success_modal").modal('show');
                            $("#successmessage").html('Event Flyer Image #2 deleted sucessfully');
                            //$(".removeImage2").data('id','');
                            $("#flyerimage2_title").html('Flyer Image #2');
                            $("#flyerimage2_preview").attr('src',imglink);
                            $("#flyerimage2_preview").css('height', '39px');
                            $("#flyerimage2_preview").css('border-radius',' 7%');
                        }
                    }
            });             
        });

        $("#manageflyerimage").submit(function(e) {
                e.preventDefault();
                var propertyid = $("#property_id").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#manageflyerimage')[0];
                var formdata = new FormData(form);
                formdata.append('propertyid', propertyid);
                //if(formdata.length > 0){
                    $.ajax({
                    url: "{{ route('save_event_flyer_image') }}",
                    type: 'POST',
                    mimeType: "multipart/form-data",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,

                        success: function(result) {
                            if(result.status == 0){
                                $("#flyerimage1_error").html('Image type should be jpg').css('color','red');
                            }
                            else if(result.status == 1){
                                $("#flyerimage2_error").html('Image type should be jpg').css('color','red');
                            }
                           
                            else{
                                $("#flyerImagesModal").modal('hide');
                                $("#img_delete_success_modal").modal('show');
                                $("#successmessage").html('You have successfully updated the Flyer Image Manager');
                            }
                        }

                    });
                // }
                // else{
                //     $("#menuImagesModal").modal('hide');
                //     $("#img_delete_success_modal").modal('show');
                //     $("#successmessage").html('Upload at least one menu image');
                // }
        
        });

        $('#floor_image1').change(function(e) {
            var fileName = e.target.files[0].name;
            fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
            if((fileExtension == 'jpg') || (fileExtension == 'jpeg') || (fileExtension == 'png')){
                $("#floorimage1_title").html('');
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("floorimage1_preview").src = e.target.result;
                    $("#floorimage1_preview").css('height', '101px');
                    $("#floorimage1_preview").css('border-radius',' 7%');
                };
                reader.readAsDataURL(this.files[0]);
            }
            else{
                $('#row1error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
            }
            
        });

        $('#floor_image2').change(function(e) {
            var fileName = e.target.files[0].name;
            fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
            if((fileExtension == 'jpg') || (fileExtension == 'jpeg') || (fileExtension == 'png')){
                $("#floorimage2_title").html('');
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("floorimage2_preview").src = e.target.result;
                    $("#floorimage2_preview").css('height', '101px');
                    $("#floorimage2_preview").css('border-radius',' 7%');
                };
                reader.readAsDataURL(this.files[0]);
            }
            else{
                $('#row2error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
            }
        });

        $('#floor_image3').change(function(e) {
            var fileName = e.target.files[0].name;
            fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
            if((fileExtension == 'jpg') || (fileExtension == 'jpeg') || (fileExtension == 'png')){
                $("#floorimage3_title").html('');
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("floorimage3_preview").src = e.target.result;
                    $("#floorimage3_preview").css('height', '101px');
                    $("#floorimage3_preview").css('border-radius',' 7%');
                };
                reader.readAsDataURL(this.files[0]);
            }
            else{
                $('#row3error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
            }
        });

        $(document).on('click',".deleteimage1",function(){
            $("#remove_floorimage_modal").modal('show');
            $("#remove_image").val('image1');
        });

        $(document).on('click',".deleteimage2",function(){
            $("#remove_floorimage_modal").modal('show');
            $("#remove_image").val('image2');
        });

        $(document).on('click',".deleteimage3",function(){
            $("#remove_floorimage_modal").modal('show');
            $("#remove_image").val('image3');
        });

        $(document).on('click','#removeFloorImage',function(){
            if($("#remove_image").val() == 'image1'){
                $("#remove_floorimage_modal").modal('hide');
                var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                $("#floorimage1_preview").attr('src',imglink);
                $("#floorimage1_title").html('Floor Plan Image');
                $("#edit_image1").val(0);
                $("#floorimage1_preview").css('height', '39px');
            }
            if($("#remove_image").val() == 'image2'){
                $("#remove_floorimage_modal").modal('hide');
                var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                $("#floorimage2_preview").attr('src',imglink);
                $("#floorimage2_title").html('Floor Plan Image');
                $("#edit_image2").val(0);
                $("#floorimage2_preview").css('height', '39px');
            }
            if($("#remove_image").val() == 'image3'){
                $("#remove_floorimage_modal").modal('hide');
                var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
                $("#floorimage3_preview").attr('src',imglink);
                $("#floorimage3_title").html('Floor Plan Image');
                $("#edit_image3").val(0);
                $("#floorimage3_preview").css('height', '39px');
            }
            
        });

        $(document).on("click","#clear1_all",function(){
            var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
            $("#floorimage1_preview").attr('src',imglink);
            $("#floorimage1_title").html('Floor Plan Image');
            $("#edit_image1").val(0);
            $("#floorimage1_preview").css('height', '39px');
            $("#bedroom1").val('');
            $("#bathroom1").val('');
            $("#total1").val('');
        });

        $(document).on("click","#clear2_all",function(){
            var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
            $("#floorimage2_preview").attr('src',imglink);
            $("#floorimage2_title").html('Floor Plan Image');
            $("#edit_image2").val(0);
            $("#floorimage2_preview").css('height', '39px');
            $("#bedroom2").val('');
            $("#bathroom2").val('');
            $("#total2").val('');
        });

        $(document).on("click","#clear3_all",function(){
            var imglink = "{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}";
            $("#floorimage3_preview").attr('src',imglink);
            $("#floorimage3_title").html('Floor Plan Image');
            $("#edit_image3").val(0);
            $("#floorimage3_preview").css('height', '39px');
            $("#bedroom3").val('');
            $("#bathroom3").val('');
            $("#total3").val('');
        });


        $("#managefloorplan").submit(function(e) {
                e.preventDefault();
                var propertyid = $("#property_id").val();
                // console.log(propertyid);
                var row1 = 0;
                var row2 = 0;
                var row3 = 0;
                if($("#edit_image1").val() != 0){
                    var row1 = 1;
                }
                if($("#bedroom1").val() != ''){
                    var row1 = 1;
                }
                if($("#bathroom1").val() != ''){
                    var row1 = 1;
                }
                if($("#total1").val() != ''){
                    var row1 = 1;
                }
                if($("#edit_image2").val() != 0){
                    var row2 = 1;
                }
                if($("#bedroom2").val() != ''){
                    var row2 = 1;
                }
                if($("#bathroom2").val() != ''){
                    var row2 = 1;
                }
                if($("#total2").val() != ''){
                    var row2 = 1;
                }
                if($("#edit_image3").val() != 0){
                    var row3 = 1;
                }
                if($("#bedroom3").val() != ''){
                    var row3 = 1;
                }
                if($("#bathroom3").val() != ''){
                    var row3 = 1;
                }
                if($("#total3").val() != ''){
                    var row3 = 1;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#managefloorplan')[0];
                var formdata = new FormData(form);
                formdata.append('propertyid', propertyid);
                formdata.append('row1', row1);
                formdata.append('row2', row2);
                formdata.append('row3', row3);
                if($("#edit_image1").val() != 0){
                    formdata.append('id_edit1', 1);
                }
                else{
                    formdata.append('id_edit1', 0);
                }
                if($("#edit_image2").val() != 0){
                    formdata.append('id_edit2', 1);
                }
                else{
                    formdata.append('id_edit2', 0);
                }
                if($("#edit_image3").val() != 0){
                    formdata.append('id_edit3', 1);
                }
                else{
                    formdata.append('id_edit3', 0);
                }

                $.ajax({
                url: "{{ route('frontend.provider.store_provider_floor_plan') }}",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formdata,

                success: function(result) {
                   console.log(result);
                    if((result.status == 1) ){
                        $('#row1error').html('Please fill up all the field of first row');
                        $('#row2error').html('');
                        $('#row3error').html('');

                    }else if(result.status == 2){
                        $('#row2error').html('Please fill up all the field of second row');
                        $('#row1error').html('');
                        $('#row3error').html('');

                    }else if(result.status == 3){
                        $('#row3error').html('Please fill up all the field of third row');
                        $('#row1error').html('');
                        $('#row2error').html('');

                    }else if(result.status == 0){
                        $('#img_delete_success_modal').modal('show');
                        $("#successmessage").html('Floor Plan data updated successfully');
                        $('#row1error').html('');
                        $('#row2error').html('');
                        $('#row3error').html('');
                    }else if(result.status == 4){
                        $('#img_delete_success_modal').modal('show');
                        $("#successmessage").html('Please fill up the form');
                    }
                    else if(result.status == 5){
                        $('#row1error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
                        $('#row2error').html('');
                        $('#row3error').html('');
                    }
                    else if(result.status == 6){
                        $('#row1error').html('');
                        $('#row2error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
                        $('#row3error').html('');
                    }
                    else if(result.status == 7){
                        $('#row1error').html('');
                        $('#row2error').html('');
                        $('#row3error').html('Floor Plan Image must be a file of type: jpg, jpeg, png.');
                    }
                    else if(result.status == 8){
                        $('#img_delete_success_modal').modal('show');
                        $("#successmessage").html('Floor Plan has been cleared');
                    }
                }
            });

        });

        $(".limitModal").click('on',function(){
            $("#Manage-limitsModal").modal('show');
            $(".term_limit").html('');
            $(".frequency").html();
            $(".current_allowance").html();
            $(".sign_up").html();
            $(".low_point").html();
            $(".add_point").html();
            $(".tenant_reward").html();
            $(".inspection_Reward").html();
            $(".great_tenant").html();
            $(".community_helper").html();
            $(".good_samaritan").html();
            var propertyid = $("#property_id").val();
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.get_provider_limit') }}",
                data: {'property_id':$("#property_id").val()},
                success: function(response) {
                    if(response.status == 1){
                        $(".term_limit").html(response.data.term_limit);
                        $(".frequency").html(response.data.frequency);
                        $(".current_allowance").html(response.data.current_allowance_point_limit);
                        $(".sign_up").html(response.data.sign_up_bonus_point);
                        $(".low_point").html(response.data.low_point_balance);
                        $(".add_point").html(response.data.add_point);
                        $(".tenant_reward").html(response.data.tenant_of_the_month_Reward);
                        $(".inspection_Reward").html(response.data.pass_inspection_reward);
                        $(".great_tenant").html(response.data.great_tenant_reward);
                        $(".community_helper").html(response.data.community_helper_reward);
                        $(".good_samaritan").html(response.data.good_samaritan_reward);
                    }

                }
            });
        });

        $(".update_term_limit").click('on',function(){
            var term_limit = $(this).val();
            $(".term_limit").html('');
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.update_provider_limit') }}",
                data: {'property_id':$("#property_id").val(), 'value': term_limit, 'limit_type': 'term_limit'},
                success: function(response) {
                    if(response.status == 1){
                        toastr.success('Term limit updated successfully');
                        $(".term_limit").html(term_limit);
                    }

                }
            });
        });

        $(".update_frequency").click('on',function(){
            var frequency = $(this).val();
            $(".frequency").html('');
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.provider.update_provider_limit') }}",
                data: {'property_id':$("#property_id").val(), 'value': frequency, 'limit_type': 'frequency'},
                success: function(response) {
                    if(response.status == 1){
                        toastr.success('Frequency updated successfully');
                        $(".frequency").html(frequency);
                    }

                }
            });
        });

        $(".update_current_allowance").click('on',function(){
            var current_allowance = $(".allowance").val();
            $(".current_allowance").html('');
            $(".allowance_error").html('');
            console.log(current_allowance);
            if(current_allowance != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': current_allowance, 'limit_type': 'current_allowance'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Current Allowance updated successfully');
                            $(".current_allowance").html(current_allowance);
                        }
                        else if(response.status == 2){
                            $(".allowance_error").html('Maximum Point limit is 500').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".allowance_error").html('Minimum Point limit is 100').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_signup").click('on',function(){
            var sign_up_point = $(".sign_up_point").val();
            $(".sign_up").html('');
            $(".signup_error").html('');
            // console.log(sign_up_point);
            if(sign_up_point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': sign_up_point, 'limit_type': 'signup_point'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Signup Point updated successfully');
                            $(".sign_up").html(sign_up_point);
                        }
                        else if(response.status == 2){
                            $(".signup_error").html('Maximum Point limit is 500').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".signup_error").html('Minimum Point limit is 100').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_lowpoint").click('on',function(){
            var low_point = $(".low_point_balance").val();
            $(".low_point").html('');
            $(".lowpoint_error").html('');
            // console.log(sign_up_point);
            if(low_point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': low_point, 'limit_type': 'low_point'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Low Point Balance updated successfully');
                            $(".low_point").html(low_point);
                        }
                        else if(response.status == 2){
                            $(".lowpoint_error").html('Maximum Point limit is 250').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".lowpoint_error").html('Minimum Point limit is 100').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_point").click('on',function(){
            var point = $(".point").val();
            $(".add_point").html('');
            $(".point_error").html('');
            // console.log(sign_up_point);
            if(point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': point, 'limit_type': 'point'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Add Point updated successfully');
                            $(".add_point").html(point);
                        }
                        else if(response.status == 2){
                            $(".point_error").html('Maximum Point limit is 250').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".point_error").html('Minimum Point limit is 25').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_tenant_reward").click('on',function(){
            var tenant_reward_point = $(".tenant_reward_point").val();
            $(".tenant_reward").html('');
            $(".tenant_reward_error").html('');
            // console.log(sign_up_point);
            if(tenant_reward_point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': tenant_reward_point, 'limit_type': 'tenant_point'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Tenant of the month point updated successfully');
                            $(".tenant_reward").html(tenant_reward_point);
                        }
                        else if(response.status == 2){
                            $(".tenant_reward_error").html('Maximum Point limit is 500').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".tenant_reward_error").html('Minimum Point limit is 100').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_inspection_reward").click('on',function(){
            var inspection_reward_point = $(".inspection_reward_point").val();
            $(".inspection_Reward").html('');
            $(".inspection_reward_error").html('');
            // console.log(sign_up_point);
            if(inspection_reward_point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': inspection_reward_point, 'limit_type': 'inspection_reward'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('100% pass inspection point updated successfully');
                            $(".inspection_Reward").html(inspection_reward_point);
                        }
                        else if(response.status == 2){
                            $(".inspection_reward_error").html('Maximum Point limit is 400').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".inspection_reward_error").html('Minimum Point limit is 100').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_great_tenant").click('on',function(){
            var great_reward = $(".great_tenant_point").val();
            $(".great_tenant").html('');
            $(".great_tenant_error").html('');
            // console.log(great_reward);
            if(great_reward != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': great_reward, 'limit_type': 'great_tenant'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Great Tenant reward point updated successfully');
                            $(".great_tenant").html(great_reward);
                        }
                        else if(response.status == 2){
                            $(".great_tenant_error").html('Maximum Point limit is 250').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".great_tenant_error").html('Minimum Point limit is 50').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_community_helper").click('on',function(){
            var helper_reward = $(".comunity_helper_point").val();
            $(".community_helper").html('');
            $(".community_helper_error").html('');
            // console.log(great_reward);
            if(helper_reward != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': helper_reward, 'limit_type': 'community_helper'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Community helper point updated successfully');
                            $(".community_helper").html(helper_reward);
                        }
                        else if(response.status == 2){
                            $(".community_helper_error").html('Maximum Point limit is 250').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".community_helper_error").html('Minimum Point limit is 50').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(".update_good_samaritan").click('on',function(){
            var samaritan_point = $(".good_samaritan_point").val();
            $(".good_samaritan").html('');
            $(".good_samaritan_error").html('');
            // console.log(great_reward);
            if(samaritan_point != ''){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('frontend.provider.update_provider_limit') }}",
                    data: {'property_id':$("#property_id").val(), 'value': samaritan_point, 'limit_type': 'good_samaritan'},
                    success: function(response) {
                        if(response.status == 1){
                            toastr.success('Good samaritan point updated successfully');
                            $(".good_samaritan").html(samaritan_point);
                        }
                        else if(response.status == 2){
                            $(".good_samaritan_error").html('Maximum Point limit is 250').css('color','red');
                        }
                        else if(response.status == 3){
                            $(".good_samaritan_error").html('Minimum Point limit is 50').css('color','red');
                        }
                        else{

                        }

                    }
                });
            }
            
        });

        $(document).on("click","#editHotelDescription",function(){
            $("#property_description").prop('readonly', false);
            $(".update-show").css("display", "block");
            $(".edit-show").css("display", "none");
            // var description = $("#property_description").val();
            // console.log(description);
        })
        $(document).on("click","#updateHotelDescription",function(){
            // console.log(123);
            var description = $("#property_description").val();
            var propertyId = $("#property_id").val();
            console.log(propertyId);
            $.ajax({
                    url: "{{ route('frontend.provider.update_description') }}",
                    type: 'GET',
                    data: {
                        'description': description,
                        'propertyId' : propertyId
                       
                    },
                    success: function(response) {
                        if(response.status == 1){
                            $("#property_description").prop('readonly', true);
                            $(".update-show").css("display", "none");
                            $(".edit-show").css("display", "block");
                            // toastr.success('Property description updated successfully');
                        }
                        if(response.status == 0){
                            console.log(false);
                            toastr.error('Something went wrong');
                        }
                    }
            });  
        })
       
    });
</script>
@endpush