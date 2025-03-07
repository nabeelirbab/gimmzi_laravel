<x-layouts.frontend-layout title="Business Owners User Management Page">
    @push('style')
        <style>
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
                    <div class="row gy-4">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex neww">
                                <div class="left-sec-home">
                                    <span>
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                    </span>
                                </div>
                                <div class="right-sec-rental">
                                    <h3>{{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <select name="merchant_main_location" class="form-control" id="merchant_main_location" style="width: 50%;">
                                            @if ($user_merchant_location)
                                                @foreach ($user_merchant_location as $locations)
                                                
                                                    @if($locations->merchantUser->location_type == 'multiple')
                                                        <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{ $locations->businessLocation->id }}" >{{ $locations->businessLocation->location_name }}
                                                        </option>
                                                    @else
                                                        <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{ $locations->businessLocation->id }}">{{ $locations->businessLocation->location_name }}
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
                                                            @foreach ($user_merchant_location as $locations)
                                                                @if($locations->is_main == 1)
                                                                    {{$locations->businessLocation->address}},
                                                                    {{$locations->businessLocation->city}},
                                                                    @if($locations->businessLocation->state_id)
                                                                        {{$locations->businessLocation->states->name}},
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
                                                            @foreach ($user_merchant_location as $locations)
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
                                                        @foreach ($user_merchant_location as $locations)
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
                </div>



            </div>

            <div class="add_new_user_sctn gap_cmnn btm_gap_none">
                <div class="add_new_user_sctn_top">
                    <div class="container">
                        <div class="add_usern_sctn_top_wrap">
                            <div class="add_usern_sctn_top_wrap_lft">
                                <div class="user_scn_form">
                                    <form>
                                        <div class="form-group">
                                            <input type="text" name="search" id="search"
                                                placeholder="Search using First Name, Last Name, or telephone Number.....">
                                            <button type="button" id="searchBy"><i><img
                                                        src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}"
                                                        alt=""></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="add_usern_sctn_top_wrap_rtt">
                                <a class="cmn_usr_btn" id="addNewuser" role="button">Add New User</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add_new_user_sctn_btmm">
                    <div class="container">
                        <div class="table_user_top_sec gap_cmnn">
                            <div class="row table_user_top_sec_row gy-2">
                                <div class="col-lg-8 table_user_top_sec_col_lft">
                                    {{-- <h3 id="user_main_location">Main Location: <span>Select a User</span></h3> --}}
                                </div>

                                <div class="col-lg-4 table_user_top_sec_col_rght">
                                    <div class="cmn_selct_filter">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected="">Filter</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table_user_bttm_sec">
                            <div class="table_user_bttm_sec_head">
                                <div class="row table_user_bttm_sec_head_row gy-4">
                                    <div class="col-lg-9 table_user_bttm_sec_head_col_lft">
                                        <div class="table_cmn_part_sgn">
                                            <table id="usertable">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="custom_checked_box">

                                                            </div>
                                                        </th>
                                                        <th>Name</th>
                                                        <th>Role</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>GMZ ID</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="merchantData">
                                                    @if ($users)
                                                        @foreach ($users as $data)
                                                            <tr>
                                                                <td>
                                                                    <div class="custom_checked_box">
                                                                        <input class="form-check-input checkuser"
                                                                            type="radio" value="{{ $data->id }}"
                                                                            name="merchantid"
                                                                            id="flexCheckDefault{{ $data->id }}">
                                                                    </div>
                                                                </td>
                                                                <td>{{ $data->full_name }}</td>
                                                                <td>{{ $data->title->title_name }}</td>
                                                                <td>{{ $data->email }}</td>
                                                                <td>{{ $data->phone }}
                                                                    @if ($data->phone_ext != '')
                                                                        ext {{ $data->phone_ext }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $data->userId }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    @if (count($users) > 0)
                                        <div class="col-lg-3 table_user_bttm_sec_head_col_lft">
                                            <div class="table_support_cnt_rt">
                                                <a href="javascript:void(0)" class="btn_table_s grn" id="edituser">Edit
                                                    User</a>
                                                <a href="javascript:void(0)" class="btn_table_s purpl"
                                                    data-bs-toggle="modal" id="changeroleuser">Change Role</a>
                                                <a href="javascript:void(0)" class="btn_table_s blu"
                                                    data-bs-toggle="modal" id="merchantlocation">Locations</a>
                                                <a href="javascript:void(0)" class="btn_table_s ylw"
                                                    data-bs-toggle="modal" id="resetpassword">Change PW</a>
                                                <a href="javascript:void(0)" class="btn_table_s rdd"
                                                    id="deactivateuser">Deactivate</a>
                                                <a href="javascript:void(0)" class="btn_table_s grn" data-bs-target="#new_user_pop2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Pending User Invites</a>
                                            </div>
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


    <div class="modal fade cmn_modal_designs" id="new_user_pop1" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close addUserClose" >Close</button>
                </div>
                <form id="add_merchant_user" name="add_merchant_user" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>First Name *</h5>
                                    <input type="text" name="first_name" id="first_name">
                                    <span id="firsterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Last Name *</h5>
                                    <input type="text" name="last_name" id="last_name">
                                    <span id="lasterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Email Address *</h5>
                                    <input type="email" name="email" id="email">
                                    <span id="emailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Number *</h5>
                                    <input type="text" name="phone_no" id="phone_no">
                                    <span id="phoneerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Gimmzi Id *</h5>
                                    <input type="text" name="gimmzi_id" id="gimmzi_id" readonly>
                                    <span id="gimmzierror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" name="phone_ext" id="phone_ext">
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Main Location*</h5>
                                    <select name="main_location" id="main_location">
                                        <option value="" disabled selected>--select--</option>
                                        @if ($business_locations)
                                            @foreach ($business_locations as $locations)
                                                <option value="{{ $locations->id }}">{{ $locations->location_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="location_error"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col multi-select">
                                    <h5>Additional Locations</h5>
                                    <select name="additional_location[]" class="select-item select2"  id="additional_location_ids" multiple>
                                       
                                    </select>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <div class="custom_file_uploader">
                                        <input type="file" class="file_upload_btn" name="image" id="image">
                                        <div class="custom_file_uploader_inr">
                                            <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}">
                                            <h4>Upload Profile Picture</h4>
                                            <span class="output_inpt_sec"></span>
                                            <!-- <input type="hidden" class="form-control"  name="file" id="file"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <div class="form-group">
                                        <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}"
                                            id="preview" style="height: 50%;width: 50%;"class="img-thumbnail">
                                    </div>
                                </div>
                                <span id="imageerror"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            {{-- <a href="javascript:void(0)" class="btn_table_s grn" data-bs-target="#new_user_pop2"
                                data-bs-toggle="modal" data-bs-dismiss="modal">Pending User Invites</a> --}}
                            <button class="btn_table_s blu addusersubmit" type="submit" name="submit">Assign
                                Role</button>
                            {{-- <button type= "button" class="btn_table_s rdd addUserClose" >Close</button> --}}
                        </div>
                    </div>
                </form>
            </div>
            @push('scripts')
            <script>
                $("#additional_location_ids").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
            </script>
            @endpush
        </div>
    </div>

    <div class="modal fade cmn_modal_designs" id="new_user_pop2" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pending User Invites</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">
                    <div class="table_cmn_part_sgn">
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Date Sent</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class='pending_users'>
                                @if ($pendingusers)
                                    @foreach ($pendingusers as $puser)
                                        <tr>
                                            <td>
                                                
                                            </td>
                                            <td>{{ $puser->full_name }}</td>
                                            @if ($puser->title)
                                                <td>{{ $puser->title->title_name }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td>{{ $puser->email }}</td>
                                            <td>{{ $puser->phone }}</td>
                                            <?php $senddate = date_format(date_create($puser->created_at), 'm-d-Y'); ?>
                                            <td>{{ $senddate }}</td>
                                            <?php $expiredate = date_format(date_create($puser->expiry_date), 'm-d-Y'); ?>
                                            <td>{{ $expiredate }}</td>
                                            <td>
                                                <div class="selctd_table_sec">
                                                    <select class = "pendingOption">
                                                        <option style="text-align:center;">...</option>
                                                        <option style="text-align:center;" class="remove" value="{{$puser->id}}">Remove</option>
                                                        <option style="text-align:center;" class="resend" value="{{$puser->id}}">Resend</option>
                                                        <option style="text-align:center;" class="editrequest" value="{{$puser->id}}">Edit request</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>No user found</tr>
                                @endif
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


    <!-- edit_user_modal -->

    <div class="modal fade cmn_modal_designs" data-backdrop="static" data-keyboard="false" id="edit_user_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close editUserClose" >Close</button>
                </div>
                <form id="edit_merchant_user" name="edit_merchant_user" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <input type="hidden" id="edituser_id" name="edituser_id">
                                    <h5>First Name*</h5>
                                    <input type="text" name="user_first_name" id="user_first_name">
                                    <span id="userfirsterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Last Name*</h5>
                                    <input type="text" name="user_last_name" id="user_last_name">
                                    <span id="userlasterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Email Address*</h5>
                                    <input type="email" name="user_email" id="user_email">
                                    <span id="useremailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Number*</h5>
                                    <input type="tel" name="user_phone_no" id="user_phone_no">
                                    <span id="userphoneerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Gimmzi Id*</h5>
                                    <input type="text" name="user_gimmzi_id" id="user_gimmzi_id" readonly>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" name="user_phone_ext" id="user_phone_ext">
                                </div>
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                        <h5>Main Location*</h5>
                                       
                                        <select name="edit_main_location" id="edit_main_location">
                                            <option value="" disabled selected>--select--</option>
                                            @if ($business_locations)
                                                @foreach ($business_locations as $locations)
                                                    <option value="{{ $locations->id }}">{{ $locations->location_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span id="location_error"></span>
                                </div> --}}
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Additional Locations</h5>
                                    <select name="edit_additional_location" id="edit_additional_location">

                                    </select>
                                </div> --}}
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <div class="custom_file_uploader">
                                        <input type="file" class="file_upload_btn" name="user_image"
                                            id="user_image">
                                        <div class="custom_file_uploader_inr">
                                            <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}">
                                            <h4>Upload Profile Picture</h4>
                                            <span class="output_inpt_sec"></span>
                                        </div>
                                    </div>
                                    <div class="cmn_links_clkd">
                                        <a href="javascript:void(0)" id="generatenewid">Generate New ID</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <div class="form-group">
                                        <img src=""
                                        id="userpreview" style="height: 50%;width: 50%;"class="img-thumbnail">
                                    </div>
                                </div>
                                <span id="userimageerror"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            <button type="submit" name="submit" class="btn_table_s grn">Update</button>
                            <button type="button" class="btn_table_s rdd editUserClose" >Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- location_modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal1" id="location_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title new" id="merchantusername">Felix Sanders has access these location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">
                    <div class="table_user_top_sec_col_lft new">
                        <h3 id="mainlocation"></h3>
                    </div>
                    <div class="table_cmn_part_sgn">
                        <table>
                            <thead>
                                <tr>
                                    <th>Participating Locations</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="participatinglocation">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer not_last">
                    <div class="modal-footer-gap-none">
                        <div class="row option_avlbl_row align-items-center gy-2">
                            <div class="col-lg-6 option_avlbl_col_lft">
                                <div class="selctd_table_sec large">
                                    <select id="available_location" name="available_location">
                                    
                                    </select>
                                </div>
                                <div class="cmn_links_clkd">
                                    <a href="javascript:void(0)" id="addlocation">Add access to location</a>
                                </div>
                                <span id="erroraccess"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--remove location access modal -->
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="removelocation_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="remove_id" value="">
                            <h4>This user will no longer have access to this participating location</h4>
                            <h3 id="participating_location_id"></h3>
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

    <!-- change_to_home_location_modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="changelocation_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="replace_id" value="">
                            <h3 id="home_location_id"></h3>
                            <h4>will be replaced with</h4>
                            <h3 id="participatinglocation_id"></h3>
                            <h4>Do you want to continue?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="yesReplace">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- change_pw_modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="change_password_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>A password reset link has been sent to the email address</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <a href="javascript:void(0)" class="btn_table_s blu auto_wd"
                                    data-bs-dismiss="modal">Ok</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- deactivate_modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="deactivate_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h4>If you would the user to remain a user but remove access to some participating
                                locations, use the location menu.</h4>
                            <h3>By deactivating, the user below will no longer have access to your Merchant Portal</h3>
                            <h2 id="deactivateUserName"></h2>
                            <h3>Do you want to continue to permanently deactivate this user?</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="yesDeactivate">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Error modal  -->
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="errormsg"></h3>
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

    <!-- New Error Model-->
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="new_error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="new_errormsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd close_new_error_model">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End New error model-->

    <!-- change_role_modal -->

    <div class="modal fade cmn_modal_designs modal_role_wrap_dialog" id="chng_role_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title new">Manage User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
                <div class="modal-body">
                    <div class="assign_role_userpt">
                        <table>
                            <thead>
                                <tr>
                                    <th><span class="asn_rl_sp">Assign the user's role</span></th>
                                    <th>
                                        <div class="custom_radio_btn">
                                            <div class="form_input_radio">
                                                <label>
                                                    <input type="radio" name="user_role_id" id="user_role_id"
                                                        value="1">
                                                    <span>Associate</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>This user role is for entry level access employees.</p>
                                    </th>
                                    <th>
                                        <div class="custom_radio_btn">
                                            <div class="form_input_radio">
                                                <label>
                                                    <input type="radio" name="user_role_id" id="user_role_id"
                                                        value="2">
                                                    <span>Manager</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Example: Store supervisor. Can make deals and create users.</p>
                                    </th>
                                    <th>
                                        <div class="custom_radio_btn">
                                            <div class="form_input_radio">
                                                <label>
                                                    <input type="radio" name="user_role_id" id="user_role_id"
                                                        value="5">
                                                    <span>Lead Manager</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Example: General manager or small business owner.</p>
                                    </th>
                                    <th>
                                        <div class="custom_radio_btn">
                                            <div class="form_input_radio">
                                                <label>
                                                    <input type="radio" name="user_role_id" id="user_role_id"
                                                        value="6">
                                                    <span>Corporate Lead</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Example: Regional manager, multiple franchise owner.</p>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Access</td>
                                    <td class="multiple_inner_tabl">
                                        <!-- <table>
                                    <tr>
                                        <td>Create</td>
                                        <td>View</td>
                                        <td>Modify</td>
                                        <td>Deactivate</td>
                                    </tr>
                                </table> -->
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Deal Management</td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>


                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Deal Wizard</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Loyalty Rewards Programs</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>User Management</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Participating Locations</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Item and Service Database</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Settings</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                </tr>

                            </tbody>


                        </table>
                    </div>




                </div>
                <div class="modal-footer">
                    <div class="modal-footer-gap-none">

                        <div class="btn_foot_end">
                            <a href="javascript:void(0)" class="btn_table_s blu" id="user_role_change">Change
                                Role</a>
                            <a href="javascript:void(0)" class="btn_table_s rdd" data-bs-dismiss="modal">Close</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add_role_modal -->
    <div class="modal fade cmn_modal_designs modal_role_wrap_dialog" id="add_role_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title new">Assign A Role</h5>
                </div>
                <div class="modal-body">
                    <div class="assign_role_userpt">
                        <table>
                            <form>
                                <input type="hidden" name="user_id" id="user_id">
                                <thead>
                                    <tr>
                                        <th><span class="asn_rl_sp">Assign the user's role</span></th>
                                        <th>
                                            <div class="custom_radio_btn">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" checked="" name="role_id"
                                                            id="role_id" value="1">
                                                        <span>Associate</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p>This user role is for entry level access employees.</p>
                                        </th>
                                        <th>
                                            <div class="custom_radio_btn">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" name="role_id" id="role_id"
                                                            value="2">
                                                        <span>Manager</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p>Example: Store supervisor. Can make deals and create users.</p>
                                        </th>
                                        <th>
                                            <div class="custom_radio_btn">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" name="role_id" id="role_id"
                                                            value="5">
                                                        <span>Lead Manager</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p>Example: General manager or small business owner.</p>
                                        </th>
                                        <th>
                                            <div class="custom_radio_btn">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" name="role_id" id="role_id"
                                                            value="6">
                                                        <span>Corporate Lead</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p>Example: Regional manager, multiple franchise owner.</p>
                                        </th>
                                    </tr>
                                </thead>
                            </form>

                            <tbody>
                                <tr>
                                    <td>Access</td>
                                    <td class="multiple_inner_tabl">
                                        <!-- <table>
                                    <tr>
                                        <td>Create</td>
                                        <td>View</td>
                                        <td>Modify</td>
                                        <td>Deactivate</td>
                                    </tr>
                                </table> -->
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in">Create</div>
                                            <div class="multipleP_create_tab_in">View</div>
                                            <div class="multipleP_create_tab_in">Modify</div>
                                            <div class="multipleP_create_tab_in">Deactivate</div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Deal Management</td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>


                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Deal Wizard</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Loyalty Rewards Programs</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>User Management</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Participating Locations</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>Item and Service Database</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                        </div>

                                    </td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Settings</td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>

                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>

                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>

                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"><i class="fas fa-times"></i></div>
                                            <div class="multipleP_create_tab_in"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer-gap-none">

                        <div class="btn_foot_end">
                            <span id="invitationmsg"></span>
                            <a href="javascript:void(0)" class="btn_table_s blu" id="sendInvite">Send Invite To
                                User</a>
                            <a href="javascript:void(0)" class="btn_table_s rdd" id="closeaddrole">Close</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- remove pending user modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_pending_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            
                            <h3>By removing, the user below will no longer have access to your Merchant Portal</h3>
                            <h2 id="pendingUserName"></h2>
                            <input type="hidden" id="userid">
                            <h3>Do you want to continue to permanently remove this user?</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="yesremove">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="resend_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            
                            <h3>Would you like to resend</h3>
                            <h4>the user invite request for</h4>
                            <h2 id="resendUserName"></h2>
                            <input type="hidden" id="userid">
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="yesresend">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
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

        <script>
            var base_url = window.location.origin;
            
            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            //permutation
            const stringPermutations = str => {
            if (str.length <= 2) return str.length === 2 ? [str, str[1] + str[0]] : [str];
            return str
                .split('')
                .reduce(
                (acc, letter, i) =>
                    acc.concat(stringPermutations(str.slice(0, i) + str.slice(i + 1)).map(val => letter + val)),
                []
                );
            };
            //
            $(function () {
                //console.log(sessionStorage.getItem('userid'));
                if(sessionStorage.getItem('userid') != null){
                    $('#flexCheckDefault'+sessionStorage.getItem('userid')).attr('checked',true);
                    var userid = sessionStorage.getItem('userid');
                    // console.log(userid);
                    $.ajax({
                            url: '{{ route('frontend.business_owner.view-merchant-main-location') }}',
                            type: 'GET',
                            data: {
                                'userid': userid,
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.success == 1) {
                                    $("#user_main_location").html('Main Location: <span>'+result.data.business_location.location_name+'</span>');
                                    
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                }
            });

            
            $(document).ready(function() {

                

                var addvalidator = $("#add_merchant_user").validate({
                    rules: {
                        first_name: {
                            required:true,
                            minlength: 3,
                        },
                        last_name: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        phone_no: {
                            required: true,
                            minlength: 10,
                        },
                        gimmzi_id: {
                            required: true,
                        },
                        main_location: {
                            required: true,
                        },
                        image: {
                            extension: "jpg,jpeg,png",
                        },

                    },
                    messages: {
                        first_name: {
                            required: "Please enter user First Name",
                            minlength: " User First Name  must be consist of at least 3 characters",
                        },
                        last_name: " Please enter user Last Name",
                        email: {
                            required: " Please enter user Email Address ",
                            email: " Email address must be a valid address"
                        },
                        phone_no: {
                            required: " Please enter user Phone number",
                            number: " Phone number should be a number",
                            minlength: " User Phone number  must be consist of at least 10 characters",
                            maxlength: " User Phone number  must be consist of at most 12 characters"
                        },
                        gimmzi_id: " Please enter user Gimmzi Id",
                        main_location: " Please select a main location",
                        image: {
                            extension: " Please upload valid image",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                var editvalidator = $("#edit_merchant_user").validate({
                    rules: {
                        user_first_name: "required",
                        user_last_name: "required",
                        user_email: {
                            required: true,
                            email: true
                        },
                        user_phone_no: {
                            required: true,
                            minlength: 10,
                        },
                        user_image: {
                            extension: "jpg,jpeg,png",
                        },

                    },
                    messages: {
                        user_first_name: " Please enter user First Name",
                        user_last_name: " Please enter user Last Name",
                        user_email: {
                            required: " Please enter user Email Address ",
                            email: " Email address must be a valid address"
                        },
                        user_phone_no: {
                            required: " Please enter user Phone number",
                            number: " Phone number should be a number",
                            minlength: " User Phone number  must be consist of at least 10 characters",
                            maxlength: " User Phone number  must be consist of at most 12 characters"
                        },
                        user_image: {
                            extension: " Please upload valid image",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                $("#addNewuser").on('click',function(){
                    $('#new_user_pop1').modal('show');
                    $(this).find('#add_merchant_user')[0].reset();  
                    $("#preview").attr('src','{{ asset('frontend_assets/images/placeholderimage.png') }}');
                    $(".custom_file_uploader_inr").html(' ');
                                $(".custom_file_uploader_inr").prepend(`<img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"><h4>Upload Profile Picture</h4>`);
                });

                $(".addUserClose").click(function(){
                    $('#new_user_pop1').modal('hide');
                    addvalidator.resetForm();
                    $('#new_user_pop1').find('form').trigger('reset');
                    $("#preview").attr('src','{{ asset('frontend_assets/images/placeholderimage.png') }}');
                    $(".custom_file_uploader_inr").html(' ');
                                $(".custom_file_uploader_inr").prepend(`<img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"><h4>Upload Profile Picture</h4>`);
                });

                // $(".editUserClose").click(function(){
                $(document).on('click','.editUserClose',function(){
                    $('#edit_user_modal').modal('hide');
                    editvalidator.resetForm();
                    $('#edit_user_modal').find('form').trigger('reset');
                    // location.reload();
                    // var userid = $("#userid").val();
                    var ajaxpath = base_url + "/edit-pending-user";
                    $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#pendingUserName").html('');
                                    $("#remove_pending_modal").modal('hide');
                                    // $("#new_user_pop2").modal('hide');
                                    // $("#new_errormsg").html('User Deleted Successfully');
                                    // $("#new_error_modal").modal('show');
                                    $(".pending_users").html('');
                                    if(result.data.length > 0){
                                        for(var i = 0; i< result.data.length; i++){

                                            var create_d = new Date(result.data[i].created_at);
                                            var createdatestring = 
                                                ("0" + (create_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + create_d.getDate()).slice(-2) + '-' +
                                                create_d.getFullYear();

                                            var expiry_d = new Date(result.data[i].expiry_date);
                                            var expirydatestring = 
                                                ("0" + (expiry_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + expiry_d.getDate()).slice(-2) + '-' +
                                                expiry_d.getFullYear();
                                                
                                            var users = '<tr>'+
                                                        '<td>'+   
                                                        '</td>'+
                                                        '<td>'+result.data[i].full_name+'</td>'+
                                                        '<td>'+result.data[i].title.title_name+'</td>'+
                                                        '<td>'+result.data[i].email+'</td>'+
                                                        '<td>'+result.data[i].phone+'</td>'+
                                                        '<td>'+createdatestring+'</td>'+
                                                        '<td>'+expirydatestring+'</td>'+
                                                        '<td>'+
                                                            '<div class="selctd_table_sec">'+
                                                                '<select class = "pendingOption">'+
                                                                    '<option style="text-align:center;">...</option>'+
                                                                    '<option style="text-align:center;" class="remove" value="'+result.data[i].id+'">Remove</option>'+
                                                                    '<option style="text-align:center;" class="resend" value="'+result.data[i].id+'">Resend</option>'+
                                                                    '<option style="text-align:center;" class="editrequest" value="'+result.data[i].id+'">Edit request</option>'+
                                                            '</select>'+
                                                            '</div>'+
                                                        '</td>'+
                                                    '</tr>';
                                          
                                        

                                            $(".pending_users").append(users);
                                        }
                                    }
                                    else{
                                        $(".pending_users").html('No Data Found').css('color','red');
                                    }
                                } else {
                                    // $("#new_user_pop2").modal('hide');
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                    });
                });
                
                $("#first_name").on('blur',function(){
                    //console.log('123');
                    if($("#first_name").val().length > 2){
                        var firstname = $("#first_name").val();
                        var number = Math.floor(1000 + Math.random() * 9000);
                        var gimmziid = number+firstname.substr(0, 3);
                        $("#gimmzi_id").val(gimmziid);
                    }
                    else{
                        $("#gimmzi_id").val(''); 
                    }
                    
                       
                })
                $('#add_role_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('#edit_user_modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
                $('input[type="file"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#file").val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("preview").src = e.target.result;
                        document.getElementById("userpreview").src = e.target.result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });

                $("#main_location").on('change', function() {
                    var locationid = $(this).val();
                    // console.log(locationid);
                    var ajaxpath = base_url + "/get-business-location" + "?locationid=" + locationid;
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {

                            if (result.status == 1) {

                                $("#additional_location_ids").html('');
                                for (var i = 0; i <= result.data.length; i++) {
                                    var location = result.data[i];
                                    console.log(location.id);
                                    var options = `<option value = "`+ location.id +`">`+location.location_name +`</option>`;
                                    $("#additional_location_ids").append(options);
                                    console.log(options);
                                }
                            } else {
                                $("#additional_location_ids").html(
                                    '<option value = "" disabled selected> ---No location found for additional--</option>'
                                );
                            }
                        }
                    });

                });


                $("#edit_main_location").on('change', function() {
                    var locationid = $(this).val();
                    console.log(locationid);
                    var ajaxpath = base_url + "/get-business-location" + "?locationid=" + locationid;
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {

                            if (result.status == 1) {

                                $("#edit_additional_location").html(
                                    '<option value = "" disabled selected> ---Select--</option>'
                                );
                                for (var i = 0; i <= result.data.length; i++) {
                                    var location = result.data[i];

                                    var options = '<option value = "' + location.id + '">' +
                                        location.location_name + '</option>';
                                    $("#edit_additional_location").append(options);
                                    console.log(options);
                                }
                            } else {
                                $("#edit_additional_location").html(
                                    '<option value = "" disabled selected> ---No location found for additional--</option>'
                                );
                            }
                        }
                    });

                });

                
                $(document).on('click', '.checkuser', function() {
                    var userid = $(this).val();
                    // console.log(userid);
                    $.ajax({
                            url: '{{ route('frontend.business_owner.view-merchant-main-location') }}',
                            type: 'GET',
                            data: {
                                'userid': userid,
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.success == 1) {
                                    $("#user_main_location").html('Main Location: <span>'+result.data.business_location.location_name+'</span>');
                                    
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    // console.log(userid);
                });
                $(document).on('click', '#edituser', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        sessionStorage.removeItem("userid");
                        sessionStorage.setItem("userid", userid);
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#edituser_id").val(result.data.id);
                                    $("#user_first_name").val(result.data.first_name);
                                    $("#user_last_name").val(result.data.last_name);
                                    $("#user_email").val(result.data.email);
                                    $("#user_phone_no").val(result.data.phone);
                                    $("#user_gimmzi_id").val(result.data.userId);
                                    $("#user_phone_ext").val(result.data.phone_ext);
                                    $("#edit_user_modal").modal('show');
                                    $("#userpreview").attr('src', result.data.profile_image);
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });

                    } else {
                        $("#errormsg").html('Please click on checkbox first');
                        $("#error_modal").modal('show');
                    }
                });

                $("#edit_merchant_user").submit(function(e) {
                    e.preventDefault();
                    var userid = $(".checkuser:checked").val();
                    sessionStorage.removeItem("userid");
                    sessionStorage.setItem("userid", userid);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var form = $('#edit_merchant_user')[0];
                    var formdata = new FormData(form);
                    
                    $.ajax({
                        url: "{{ route('frontend.business_owner.update-user') }}",
                        type: 'POST',
                        mimeType: "multipart/form-data",
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,

                        success: function(result) {
                                if (result.status === 7) {
                                    sessionStorage.setItem("userid", result.data.id);
                                    $("#user_id").val(result.data.id);
                                    // $("#edit_user_modal").modal('hide');
                                   // $("#merchantData").load(location.href + "#merchantData");
                                   toastr.success('The Merchant user has been updated successfully');
                                    // setTimeout(() => {
                                    // //    location.reload();
                                    
                                    // },3000);
                                    
                                }else if (result.status === 4) {
                                    $('#userfirsterror').html('');
                                    $('#userlasterror').html('');
                                    $('#useremailerror').html('');
                                    $('#userimageerror').html('');
                                    // $('#userphoneerror').html('The Phone number Field is required').css('color','red');
                                }else if(result.status === 5){
                                    $('#userfirsterror').html('');
                                    $('#userlasterror').html('');
                                    $('#userphoneerror').html('');
                                    $('#userimageerror').html('');
                                    // $('#useremailerror').html('The Email Field is required').css('color','red');
                                }else if(result.status === 6){
                                    $('#useremailerror').html('');
                                    $('#userlasterror').html('');
                                    $('#userphoneerror').html('');
                                    $('#userimageerror').html('');
                                    // $('#userfirsterror').html('The First name Field is required').css('color','red');
                                }else if(result.status === 8){
                                    $('#userfirsterror').html('');
                                    $('#useremailerror').html('');
                                    $('#userphoneerror').html('');
                                    $('#userimageerror').html('');
                                    // $('#userlasterror').html('The First name Field is required').css('color','red');
                                }else if(result.status === 2){
                                    $('#userfirsterror').html('');
                                    $('#userlasterror').html('');
                                    $('#userphoneerror').html('');
                                    $('#useremailerror').html('');
                                    // $('#userimageerror').html('The First name Field is required').css('color','red');
                                } else{
                                    $("#edit_user_modal").modal('hide');
                                    sessionStorage.setItem("userid", result.data.id);
                                    toastr.success('Failed to update');
                                    //$("#usertable").load(window.location + " #usertable");
                                    setTimeout(() => {
                                    // location.reload();
                                    },3000);
                                }
                            } 
                        });
                   
                });

                $(document).on('click', '#closeaddrole', function() {

                    var userid = $("#user_id").val();
                    var ajaxpath = base_url + "/delete-new-user" + "?id=" + userid;
                    sessionStorage.removeItem("userid");
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {
                            console.log(result);
                            //sessionStorage.setItem("userid", userid);
                            if (result.status == 1) {
                                $("#add_role_modal").modal('hide');
                                $("#new_user_pop1").modal('show');
                                addvalidator.resetForm();
                                $('#new_user_pop1').find('#add_merchant_user')[0].reset(); 
                                $("#preview").attr('src','{{ asset('frontend_assets/images/placeholderimage.png') }}');
                                $(".custom_file_uploader_inr").html(' ');
                                $(".custom_file_uploader_inr").prepend(`<img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}"><h4>Upload Profile Picture</h4>`);
                            }
                        }
                    });

                });

                $(document).on('click', '#sendInvite', function() {
                    var userid = $("#user_id").val();
                    var roleid = $("input[id='role_id']:checked").val();
                    //console.log(roleid);
                    var ajaxpath = base_url + "/invite-new-user" + "?userid=" + userid + "&roleid=" + roleid;
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {
                            console.log(result);
                            if (result.status == 1) {
                                $('#invitationmsg').css('color', 'green').fadeIn().html(
                                    'Invitaion sent successfully');
                                setTimeout(function() {
                                    $('#invitationmsg').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else if (result.status == 0) {
                                $('#invitationmsg').css('color', 'red').fadeIn().html(
                                    'Something went wrong');
                                setTimeout(function() {
                                    $('#invitationmsg').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else {
                                $('#invitationmsg').css('color', 'red').fadeIn().html(
                                    'User saved successfully but mail not sent');
                                setTimeout(function() {
                                    $('#invitationmsg').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            }
                        }
                    });
                })

                $(document).on('click', '#deactivateuser', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#deactivateUserName").html(result.data.full_name);
                                    $("#deactivate_modal").modal('show');
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });

                    } else {
                        $("#errormsg").html('Please click on checkbox first');
                        $("#error_modal").modal('show');
                    }
                })


                $(document).on('click', '#changeroleuser', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        sessionStorage.removeItem("userid");
                        sessionStorage.setItem("userid", userid);
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    if (result.data.title_id != '') {
                                        $("input[id = 'user_role_id'][value = '" + result.data
                                            .title_id + "']").prop('checked', true);
                                        $("#chng_role_modal").modal('show');
                                    }
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });

                    } else {
                        $("#errormsg").html('Please click on checkbox first');
                        $("#error_modal").modal('show');
                    }
                });

                $(document).on('click', "#user_role_change", function() {
                    var userid = $(".checkuser:checked").val();
                    sessionStorage.removeItem("userid");
                    sessionStorage.setItem("userid", userid);
                    var roleid = $("#user_role_id:checked").val();
                    var ajaxpath = base_url + "/change-user-role" + "?userid=" + userid + "&role_id=" + roleid;
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {
                            console.log(result);
                            if (result.status == 1) {
                                
                                $("#chng_role_modal").modal('hide');
                                $("#errormsg").html('Role Changed Successfully');
                                $("#error_modal").modal('show');
                            } else {
                                $("#chng_role_modal").modal('hide');
                                $("#errormsg").html('User Not Found');
                                $("#error_modal").modal('show');
                            }
                        }
                    })
                });

                $(document).on('click', '#yesDeactivate', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        var ajaxpath = base_url + "/deactivate-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#deactivateUserName").html('');
                                    $("#deactivate_modal").modal('hide');
                                    $("#errormsg").html('User Deactivated Successfully');
                                    $("#error_modal").modal('show');
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        })

                    }
                });

                $(document).on('click', '#resetpassword', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        var ajaxpath = base_url + "/reset-password-link" + "?userid=" + userid;
                        sessionStorage.removeItem("userid");
                        sessionStorage.setItem("userid", userid);
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                // console.log('yes');
                                if (result.status == 1) {
                                    $("#change_password_modal").modal('show');
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    } else {
                        $("#errormsg").html('Please click on checkbox first');
                        $("#error_modal").modal('show');
                    }
                });

                $(document).on('click', '#merchantlocation', function() {
                    if ($(".checkuser").is(':checked')) {
                        var userid = $(".checkuser:checked").val();
                        console.log(userid);
                        sessionStorage.removeItem("userid");
                        sessionStorage.setItem("userid", userid);
                        var ajaxpath = base_url + "/get-merchant-location" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    // console.log(result.row);
                                    $("#location_modal").modal('show');
                                    $("#erroraccess").html("");
                                    $("#merchantusername").html(result.user.full_name +
                                        '<span> has access to these locations <span>');
                                    $("#mainlocation").html("");
                                    $("#participatinglocation").html("");
                                    $("#mainlocation").html(
                                        '<span> Home Location: </span>' +
                                        result.main.business_location.location_name);
                                        $('#available_location').html('<option value = "">Choose Location </option>');
                                        for(var x = 0; x < result.row.length; x++){
                                            // console.log(result.row[x]);
                                            var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
                                            $("#available_location").append(availabledata);
                                        }
                                        for (var i = 0; i < result.another.length; i++) {

                                            var locationdata = '<tr id="'+result.another[i].id+'">' +
                                                '<td id="participatinglocation_'+result.another[i].id+'">' + result.another[i]
                                                .business_location.location_name + '</td>' +
                                                '<td>' +
                                                '<div class="selctd_table_sec">' +
                                                '<select name="location" class="select_action"' +
                                                'data-id="' + result.another[i].id + '">' +
                                                '<option value="">....</option>' +
                                                '<option value="Remove">Remove Access</option>' +
                                                '<option value="Make-Home">Make Home Location</option>' +
                                                '</select>' +
                                                '</div>' +
                                                '</td>' +
                                                '</tr>';
                                            $("#participatinglocation").append(locationdata);
                                        }    

                                } else if (result.status == 2) {
                                    // console.log('hi');
                                    $("#location_modal").modal('show');
                                    $("#erroraccess").html("");
                                    $("#merchantusername").html(result.user.full_name +
                                        '<span> has access to these location <span>');
                                    $("#mainlocation").html("");
                                    $("#participatinglocation").html("");
                                    $("#mainlocation").html(
                                        '<span> Home Location: </span>' +
                                        result.main.business_location.location_name);
                                    $("#participatinglocation").html(
                                        'No Participating location found');
                                    $('#available_location').html('<option value = "">Choose Location </option>');
                                    for(var x = 0; x < result.row.length; x++){
                                        var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
                                        $("#available_location").append(availabledata);
                                    }

                                } else if (result.status == 3) {
                                    $("#location_modal").modal('show');
                                    $("#erroraccess").html("");
                                    $("#merchantusername").html(result.user.full_name +
                                        '<span> has access to these location <span>');
                                    $("#mainlocation").html("");
                                    $("#participatinglocation").html("");
                                    $("#mainlocation").html(
                                        '<span> Home Location: </span> No main location found');
                                    
                                    if(result.another.length > 0){
                                        for (var i = 0; i < result.another.length; i++) {
                                            console.log('done');
                                                var locationdata = '<tr id="'+result.another[i].id+'">' +
                                                    '<td id="participatinglocation_'+result.another[i].id+'">' + result.another[i]
                                                    .business_location.location_name + '</td>' +
                                                    '<td>' +
                                                    '<div class="selctd_table_sec">' +
                                                    '<select name="location" class="select_action"' +
                                                    'data-id="' + result.another[i].id + '">' +
                                                    '<option value="">....</option>' +
                                                    '<option value="Remove">Remove Access</option>' +
                                                    '<option value="Make-Home">Make Home Location</option>' +
                                                    '</select>' +
                                                    '</div>' +
                                                    '</td>' +
                                                    '</tr>';
                                                $("#participatinglocation").append(locationdata);
                                                
                                        } 
                                    }
                                    
                                    $('#available_location').html('<option value = "">Choose Location</option>');
                                    for(var x = 0; x < result.row.length; x++){
                                        var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
                                        $("#available_location").append(availabledata);
                                    }
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    } else {
                        $("#errormsg").html('Please click on checkbox first');
                        $("#error_modal").modal('show');
                    }
                });
  

                $(document).on('change', '.select_action', function() {
                    if ($(this).val() == "Remove") {
                        var get_location = $(this).data('id');

                        $.ajax({
                            url: '{{ route('frontend.business_owner.get-remove-merchant-location') }}',
                            type: 'GET',
                            data: {
                                'get_location': get_location,
                            },
                            success: function(response) {
                                console.log(response.success);
                                if (response.success == 1) {
                                    //console.log(response.data.business_location);
                                    $("#removelocation_modal").modal('show');
                                    $("#participating_location_id").html(response.data.business_location
                                        .location_name);
                                        $("#remove_id").val(response.data.id);
                                       
                                }
                            }
                        });                   
                    } else if ($(this).val() == "Make-Home") {
                        var another_location = $(this).data('id');
                        // console.log(another_location);
                        $.ajax({
                            url: '{{ route('frontend.business_owner.make-home-merchant-location') }}',
                            type: 'GET',
                            data: {
                                'another_location': another_location,
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.success == 1) {
                                    if(response.main != null){
                                        $("#changelocation_modal").modal('show');
                                        $("#home_location_id").html(response.main.business_location.location_name);
                                        $("#participatinglocation_id").html(response.another.business_location.location_name);
                                        $("#replace_id").val(response.another.id);
                                    }
                                    else{
                                        $("#changelocation_modal").modal('show');
                                        $("#home_location_id").html('');
                                        $("#participatinglocation_id").html(response.another.business_location.location_name);
                                        $("#replace_id").val(response.another.id);

                                    }
                                    

                                }
                            }
                        });
                    }
                });


                $(document).on('click', '#yesRemove', function() {
                        var userid = $(".checkuser:checked").val();
                        // console.log(userid);
                        var remove_location = $("#remove_id").val();
                        console.log(remove_location);
                        $('tr#'+remove_location).remove();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.remove-access-merchant-location') }}',
                            type: 'POST',
                            data: {
                                'userid' : userid,
                                'remove_location': remove_location,
                            },
                            success: function(response) {
                                if (response.success == 1) {
                                    console.log(response);
                                    $('#removelocation_modal').modal('hide');
                                    $('#location_modal').modal('show');
                                    $('.select_action').val('');
                                    $("#participatinglocation_"+remove_location).html("");
                                    $("#participatinglocation").html("");
                                    // $('#available_location'+remove_location).html('<option value="' + response.data.id +'">' + response.data.location_name +'</option>');
                                    // toastr.success('The participating location has been removed successfully');
                                    // setTimeout(() => {
                                    // location.reload();
                                    // },3000);
                                    if(response.main != null){
                                        $("#mainlocation").html('<span> Home Location: </span>' + response.main.business_location.location_name);
                                    }
                                    
                                    if(response.data.length > 0){
                                        $("#available_location").html('');
                                        $("#available_location").html(
                                        '<option value = "" disabled selected>Choose Location</option>');
                                        for (var i = 0; i < response.data.length; i++) {

                                            var options = '<option value = "' + response.data[i].id + '">' + response.data[i].location_name + '</option>';
                                            $("#available_location").append(options);
                                            //console.log(options);
                                        }
                                    }
                                    for (var j = 0; j < response.others.length; j++) {
                                            
                                        var locationdata = '<tr id="'+response.others[j].id+'">' +
                                            '<td id="participatinglocation_'+response.others[j].id+'">' + response.others[j].business_location.location_name + '</td>' +
                                            '<td>' +
                                            '<div class="selctd_table_sec">' +
                                            '<select name="location" class="select_action"' +
                                            'data-id="' + response.others[j].id + '">' +
                                            '<option value="">....</option>' +
                                            '<option value="Remove">Remove Access</option>' +
                                            '<option value="Make-Home">Make Home Location</option>' +
                                            '</select>' +
                                            '</div>' +
                                            '</td>' +
                                            '</tr>';
                                        $("#participatinglocation").append(locationdata);
                                    }  
                                  
                                }

                            }
                        });
                });
                    
                
                $(document).on('click', '#yesReplace', function() {
                    var replace_location = $("#replace_id").val();

                
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('frontend.business_owner.replace-home-merchant-location') }}',
                        type: 'POST',
                        data: {
                            'replace_location': replace_location,
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success == 1) {
                                $('#changelocation_modal').modal('hide');
                                $('#location_modal').modal('show');
                                console.log(response.replace);
                                $("#mainlocation").html(
                                    '<span> Home Location: </span>' +
                                    response.replace.business_location.location_name);
                                if(response.main != ''){
                                    $("#participatinglocation_"+replace_location).html(response.main.business_location.location_name);
                                }
                               
                                $('.select_action').val('');
                                toastr.success('The main location has been replaced successfully');
                                // setTimeout(() => {
                                // location.reload();
                                // },3000);
                            }
                        }
                    });
                });
                    
              

                $(document).on('click', "#searchBy", function(){
                    var search = $("#search").val();
                    console.log(search);
                    var ajaxpath = base_url + "/search-user" + "?searchby=" + search;

                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                 console.log(result);
                                if (result.status != 0) {
                                    $("#merchantData").html('');
                                    if(result.data != ''){
                                        for(var i = 0; i< result.data.length; i++){
                                            if (result.data[i].phone_ext != null){
                                               var extdata =  'ext '+result.data[i].phone_ext;
                                            }
                                            else{
                                                var extdata = '';
                                            }
                                            var users = '<tr>'+
                                                            '<td>'+
                                                                '<div class="custom_checked_box">'+
                                                            '<input class="form-check-input checkuser"'+
                                                                    'type="radio" value="'+result.data[i].id+'"'+
                                                                    'name="merchantid"'+
                                                                    'id="flexCheckDefault'+result.data[i].id+'">'+
                                                                '</div>'+
                                                            '</td>'+
                                                            '<td>'+result.data[i].full_name+'</td>'+
                                                            '<td>'+result.data[i].title.title_name+'</td>'+
                                                            '<td>'+result.data[i].email+'</td>'+
                                                            '<td>'+result.data[i].phone+' '+
                                                                   extdata+
                                                            '</td>'+
                                                            '<td>'+result.data[i].userId+'</td>'+
                                                        '</tr>';

                                            $("#merchantData").append(users);
                                        }
                                    }
                                    else{
                                        $("#merchantData").html('No Data Found').css('color','red');
                                    }
                                } else {
                                    
                                }
                            }
                        });
                    // } else {
                    //     $("#errormsg").html('Please click on checkbox first');
                    //     $("#error_modal").modal('show');
                    // }
                })

                $(document).on('change','.pendingOption',function(){
                    var userid = $(this).val();
                    // console.log($(this).children(":selected").attr('class'));
                    if($(this).children(":selected").attr('class') == 'remove'){
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                   
                                    $("#pendingUserName").html(result.data.full_name);
                                    $("#remove_pending_modal").modal('show');
                                    $("#userid").val(userid);
                                    
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }
                    else if($(this).children(":selected").attr('class') == 'editrequest'){
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#edituser_id").val(result.data.id);
                                    $("#user_first_name").val(result.data.first_name);
                                    $("#user_last_name").val(result.data.last_name);
                                    $("#user_email").val(result.data.email);
                                    $("#user_phone_no").val(result.data.phone);
                                    $("#user_gimmzi_id").val(result.data.userId);
                                    $("#user_phone_ext").val(result.data.phone_ext);
                                    $("#edit_user_modal").modal('show');
                                    $("#userpreview").attr('src', result.data.profile_image);
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }

                    else if($(this).children(":selected").attr('class') == 'resend'){
                        var ajaxpath = base_url + "/find-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#resendUserName").html(result.data.full_name);
                                    $("#resend_modal").modal('show');
                                    $("#userid").val(userid);
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }
                    
                })
                 
                $(document).on('click','#yesremove',function(){
                        var userid = $("#userid").val();
                        var ajaxpath = base_url + "/remove-pending-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#pendingUserName").html('');
                                    $("#remove_pending_modal").modal('hide');
                                    // $("#new_user_pop2").modal('hide');
                                    $("#new_errormsg").html('User Deleted Successfully');
                                    $("#new_error_modal").modal('show');
                                    $(".pending_users").html('');
                                    if(result.data.length > 0){
                                        for(var i = 0; i< result.data.length; i++){

                                            var create_d = new Date(result.data[i].created_at);
                                            var createdatestring = 
                                                ("0" + (create_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + create_d.getDate()).slice(-2) + '-' +
                                                create_d.getFullYear();

                                            var expiry_d = new Date(result.data[i].expiry_date);
                                            var expirydatestring = 
                                                ("0" + (expiry_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + expiry_d.getDate()).slice(-2) + '-' +
                                                expiry_d.getFullYear();
                                                
                                            var users = '<tr>'+
                                                        '<td>'+   
                                                        '</td>'+
                                                        '<td>'+result.data[i].full_name+'</td>'+
                                                        '<td>'+result.data[i].title.title_name+'</td>'+
                                                        '<td>'+result.data[i].email+'</td>'+
                                                        '<td>'+result.data[i].phone+'</td>'+
                                                        '<td>'+createdatestring+'</td>'+
                                                        '<td>'+expirydatestring+'</td>'+
                                                        '<td>'+
                                                            '<div class="selctd_table_sec">'+
                                                                '<select class = "pendingOption">'+
                                                                    '<option style="text-align:center;">...</option>'+
                                                                    '<option style="text-align:center;" class="remove" value="'+result.data[i].id+'">Remove</option>'+
                                                                    '<option style="text-align:center;" class="resend" value="'+result.data[i].id+'">Resend</option>'+
                                                                    '<option style="text-align:center;" class="editrequest" value="'+result.data[i].id+'">Edit request</option>'+
                                                            '</select>'+
                                                            '</div>'+
                                                        '</td>'+
                                                    '</tr>';
                                          
                                        

                                            $(".pending_users").append(users);
                                        }
                                    }
                                    else{
                                        $(".pending_users").html('No Data Found').css('color','red');
                                    }
                                } else {
                                    // $("#new_user_pop2").modal('hide');
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        })

                })
                
                $(document).on('click', '.close_new_error_model', function() {
                    $("#new_error_modal").modal('hide');
                });

                $(document).on('click','#yesresend',function(){
                        var userid = $("#userid").val();
                        var ajaxpath = base_url + "/resend-invitation-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#resendUserName").html('');
                                    $("#resend_modal").modal('hide');
                                    // $("#errormsg").html('Invitation Resend Successfully');
                                    // $("#error_modal").modal('show');
                                    $("#new_errormsg").html('Invitation Resend Successfully');
                                    $("#new_error_modal").modal('show');
                                    $(".pending_users").html('');
                                    if(result.data.length > 0){
                                        for(var i = 0; i< result.data.length; i++){

                                            var create_d = new Date(result.data[i].created_at);
                                            var createdatestring = 
                                                ("0" + (create_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + create_d.getDate()).slice(-2) + '-' +
                                                create_d.getFullYear();

                                            var expiry_d = new Date(result.data[i].expiry_date);
                                            var expirydatestring = 
                                                ("0" + (expiry_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + expiry_d.getDate()).slice(-2) + '-' +
                                                expiry_d.getFullYear();
                                                
                                            var users = '<tr>'+
                                                        '<td>'+   
                                                        '</td>'+
                                                        '<td>'+result.data[i].full_name+'</td>'+
                                                        '<td>'+result.data[i].title.title_name+'</td>'+
                                                        '<td>'+result.data[i].email+'</td>'+
                                                        '<td>'+result.data[i].phone+'</td>'+
                                                        '<td>'+createdatestring+'</td>'+
                                                        '<td>'+expirydatestring+'</td>'+
                                                        '<td>'+
                                                            '<div class="selctd_table_sec">'+
                                                                '<select class = "pendingOption">'+
                                                                    '<option style="text-align:center;">...</option>'+
                                                                    '<option style="text-align:center;" class="remove" value="'+result.data[i].id+'">Remove</option>'+
                                                                    '<option style="text-align:center;" class="resend" value="'+result.data[i].id+'">Resend</option>'+
                                                                    '<option style="text-align:center;" class="editrequest" value="'+result.data[i].id+'">Edit request</option>'+
                                                            '</select>'+
                                                            '</div>'+
                                                        '</td>'+
                                                    '</tr>';
                                          
                                        

                                            $(".pending_users").append(users);
                                        }
                                    }
                                    else{
                                        $(".pending_users").html('No Data Found').css('color','red');
                                    }
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        })

                })
            });

                          
                $(document).on('click', '#addlocation', function(){
                    if($('#available_location').val() != '' ){
                        var userid = $(".checkuser:checked").val();
                        var addlocation = $('#available_location').val();
                        $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                            });
                        $.ajax({
                            url: '{{ route('frontend.business_owner.add-particiapting-location') }}',
                            type: 'POST',
                            data: {
                                'userid': userid,
                                'addlocation': addlocation
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.success == 1) {
                                    // console.log('save');
                                    $('#location_modal').modal('show');
                                    $("#participatinglocation").html("");
                                    $('#available_location').html('');
                                    $('#available_location').html('<option value = "">Choose Location </option>');
                                    if(response.data.length > 0){
                                        for(var x = 0; x < response.data.length; x++){
                                        var availabledata = '<option value="' + response.data[x].id +'">' + response.data[x].location_name +'</option>';
                                        $("#available_location").append(availabledata);
                                        }
                                    }
                                    if(response.location.length > 0){
                                        for (var i = 0; i < response.location.length; i++) {
                                            var locationdata = '<tr id="'+response.location[i].id+'">' +
                                                '<td id="participatinglocation_'+response.location[i].id+'">' + response.location[i]
                                                .business_location.location_name + '</td>' +
                                                '<td>' +
                                                '<div class="selctd_table_sec">' +
                                                '<select name="location" class="select_action"' +
                                                'data-id="' + response.location[i].id + '">' +
                                                '<option value="">....</option>' +
                                                '<option value="Remove">Remove Access</option>' +
                                                '<option value="Make-Home">Make Home Location</option>' +
                                                '</select>' +
                                                '</div>' +
                                                '</td>' +
                                                '</tr>';
                                                $("#participatinglocation").append(locationdata);
                                                
                                            }
                                        }
                                    toastr.success('The participating location has been added successfully');
                                    // setTimeout(() => {
                                    // location.reload();
                                    // },3000);
                                }
                            }
                        });
                    } else{
                        $("#erroraccess").css('color','red').html('Please choose a location first');  
                    }
           
                });

                $(document).on('click', '#generatenewid', function(){
                    var mystring = $("#user_gimmzi_id").val();
                    mystring = mystring.substring(0, 4);
                    // console.log(mystring.trim());
                    // var numberarray = stringPermutations(mystring.trim());
                    // //console.log(numberarray);
                    // for(var i = 0; i < numberarray.length; i++){
                    //     if(numberarray[i] != mystring.trim()){
                    //         var mynumber = numberarray[i];
                    //        // console.log(mynumber);
                    //     }
                    // }
                    var length = 4;
                    var mynumber = Math.floor(Math.pow(10, length-1) + Math.random() * (Math.pow(10, length) - Math.pow(10, length-1) - 1));
                    const last3Str = String($("#user_gimmzi_id").val()).slice(-3);
                    $("#user_gimmzi_id").val('');
                    $("#user_gimmzi_id").val(mynumber+last3Str);

                });

            $("#add_merchant_user").submit(function(e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#add_merchant_user')[0];
                var formdata = new FormData(form);
                // jQuery.each(jQuery('#image')[0].files, function(i, file) {
                //     data.append('file-'+i, file);
                // });
                //console.log(formdata.length);
                // if(formdata.length > 0)
            
                $.ajax({
                    url: "{{ route('frontend.business_owner.add-new-user') }}",
                    type: 'POST',
                    mimeType: "multipart/form-data",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,

                    success: function(result) {
                        console.log(result);
                        if (result.status === 7) {
                            $("#user_id").val(result.data.id);
                            $("#add_role_modal").modal('show');
                            $("#new_user_pop1").modal('hide');
                        } else if (result.status === 3) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#gimmzierror').html('The Gimmzi id Field is required').css('color', 'red');
                        } else if (result.status === 4) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            //$('#phoneerror').html('The Phone number Field is required').css('color','red');
                        } else if (result.status === 5) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            //$('#emailerror').html('The Email address Field is required').css('color','red');
                        } else if (result.status === 6) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            //$('#firsterror').html('The First name Field is required').css('color','red');
                        } else if (result.status === 8) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            //$('#lasterror').html('The Last name Field is required').css('color','red');
                        } else if (result.status === 0) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#emailerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 1) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#phoneerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 2) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#imageerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 9) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#gimmzierror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 10) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#location_error').html('');
                            $('#location_error').html('The Last name Field is required').css('color',
                                'red');
                        } else {

                        }

                    }
                });
               
            });
            $(document).on('change', '#merchant_main_location', function(){
                    var location_id = $(this).val();
                    //  console.log(location_id);
                    $.ajax({
                            url: '{{ route('frontend.business_owner.merchant_business_location') }}',
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

            
        </script>
    @endpush

</x-layouts.frontend-layout>
