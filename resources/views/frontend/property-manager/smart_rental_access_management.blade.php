<x-layouts.provider-layout title="Smart rental access management page">
    @push('style')
        <style>
            .errorMsq {
                color: red !important;
                display: block;
            }
        </style>
    @endpush
    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div id="alen-park-contain">
                <div class="container">
                    <div class="alen-park-contain">
                        <div class="allen-img-main">
                            <img src="{{ asset('frontend_assets/images/image11.png') }}" class="alen-img" />
                        </div>
                        <div class="middle-smart-rental-sec">
                        <input type="hidden" name="property_id"
                        value="{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->id : '' }}"
                        id="property_id">
                            <div class="right-sec-rental">
                                <h3><span
                                        id="change_first">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}</span>
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
        
                                <p class="alen-park-text1 img-b-space1">
                                    <span class="p-responsive-main location-image-icon img-b-space1">
                                        <label>Address:</label><label
                                            id="property_address">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->address : '' }}</label>
                                    </span>
        
                                    <span class="p-responsive-main">
                                        <span class="mail-image-icon">&nbsp;</span> <label>Mail:</label><a
                                            href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </span>
                                </p>
                                <p class="alen-park-text1 alen-park-text1 star-image-icon"><label>Total Points to
                                        Distribute:</label><span class="alen-park-text1" id="distributePoint">{{ number_format($propertyDetails->first()->provider->points_to_distribute) }}
                                        points</span>
        
                            </div>
                            </p>
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
                                                placeholder="Search using First or Last Name">
                                            <button type="button" class="searchBy"><i><img
                                                        src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}"
                                                        alt=""></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="add_usern_sctn_top_wrap_rtt">
                                <a class="cmn_usr_btn" data-bs-toggle="modal" href="#new_user_pop1" role="button">Add
                                    New User</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add_new_user_sctn_btmm">
                    <div class="container">
                        <div class="table_user_top_sec gap_cmnn">
                            <div class="row table_user_top_sec_row gy-2">
                                <div class="col-lg-8 table_user_top_sec_col_lft">
                                </div>

                                <div class="col-lg-4 table_user_top_sec_col_rght">
                                    <div class="cmn_selct_filter">
                                        <select class="form-select sortFilter" aria-label="Default select example">
                                            <option value="name(A-Z)">Names - A to Z</option>
                                            <option value="name(Z-A)">Names - Z to A</option>
                                            <option value="role(A-Z)">Roles - A to Z</option>
                                            <option value="role(Z-A)">Roles - Z to A</option>
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
                                            <div class="scroll_table">
                                                <table id="usertable">
                                                    <thead>
                                                        <tr>
                                                            <th><div class="custom_checked_box"></div></th>
                                                            <th>Name</th>
                                                            <th>Role</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody id="providerData">
                                                        @if ($providers)
                                                            @foreach ($providers as $data)
                                                                <tr>
                                                                    <td>
                                                                        <div class="custom_checked_box">
                                                                            <input class="form-check-input checkuser"
                                                                                type="radio" value="{{ $data->provideruser->id }}"
                                                                                name="providerid"
                                                                                id="flexCheckDefault{{ $data->provideruser->id }}">
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $data->provideruser->full_name }}</td>
                                                                    <td>{{ $data->title->title_name }}</td>
                                                                    <td>{{ $data->provideruser->email }}</td>
                                                                    <td>{{ $data->provideruser->phone }}
                                                                        @if ($data->provideruser->phone_ext != '')
                                                                            ext {{ $data->provideruser->phone_ext }}
                                                                        @endif
                                                                    </td>
                                                                
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            No User Found
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                  
                                        <div class="col-lg-3 table_user_bttm_sec_head_col_lft">
                                            <div class="table_support_cnt_rt">
                                                <a href="javascript:void(0)" class="btn_table_s grn" id="edituser">Edit
                                                    User</a>
                                                <a href="javascript:void(0)" class="btn_table_s purpl"
                                                    data-bs-toggle="modal" id="changeroleuser">Change Role</a>
                                                {{-- <a href="javascript:void(0)" class="btn_table_s blu"
                                                    data-bs-toggle="modal" id="merchantlocation">Locations</a> --}}
                                                <a href="javascript:void(0)" class="btn_table_s ylw"
                                                    data-bs-toggle="modal" id="resetpassword">Change PW</a>
                                                <a href="javascript:void(0)" class="btn_table_s rdd"
                                                    id="deactivateuser">Deactivate</a>
                                                <a href="javascript:void(0)" class="btn_table_s grn" data-bs-target="#new_user_pop2"
                                                    data-bs-toggle="modal" data-bs-dismiss="modal">Pending User Invites</a>
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
  <!-- Add New User Modal-->
    <div class="modal fade cmn_modal_designs" id="new_user_pop1" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close addUserClose" >Close</button>
                </div>
                <form id="add_provider_user" name="add_provider_user" method="post" enctype="multipart/form-data">
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
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Gimmzi Id *</h5>
                                    <input type="text" name="gimmzi_id" id="gimmzi_id" readonly>
                                    <span id="gimmzierror"></span>
                                </div> --}}
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" name="phone_ext" id="phone_ext">
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
                            <button type= "button" class="btn_table_s rdd addUserClose" >Close</button>
                        </div>
                    </div>
                </form>
            </div>
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

                            <tbody id="pendingProviderUser">
                                @if ($pendingusers)
                                {{-- @dd($pendingusers) --}}
                                    @foreach ($pendingusers as $puser)
                                        <tr>
                                            <td>
                                                
                                            </td>
                                            <td>{{ $puser->provideruser->full_name }}</td>
                                            @if ($puser->title)
                                                <td>{{ $puser->title->title_name }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            <td>{{ $puser->provideruser->email }}</td>
                                            <td>{{ $puser->provideruser->phone }}</td>
                                            <?php $senddate = date_format(date_create($puser->provideruser->created_at), 'm-d-Y'); ?>
                                            <td>{{ $senddate }}</td>
                                            <?php $expiredate = date_format(date_create($puser->provideruser->expiry_date), 'm-d-Y'); ?>
                                            <td>{{ $expiredate }}</td>
                                            <td>
                                                <div class="selctd_table_sec">
                                                    <select class = "pendingOption">
                                                        <option style="text-align:center;">...</option>
                                                        <option style="text-align:center;" class="remove" value="{{$puser->provideruser->id}}">Remove</option>
                                                        <option style="text-align:center;" class="resend" value="{{$puser->provideruser->id}}">Resend</option>
                                                        <option style="text-align:center;" class="editrequest" value="{{$puser->provideruser->id}}">Edit request</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>No user found</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn_foot_end">
                        {{-- <a href="javascript:void(0)" class="btn_table_s rdd" data-bs-target="#new_user_pop1"
                            data-bs-toggle="modal" data-bs-dismiss="modal">Close</a> --}}
                            <a href="javascript:void(0)" class="btn_table_s rdd" 
                            data-bs-toggle="modal" data-bs-dismiss="modal">Close</a>
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
                                            <p>This user role is for entry-level employees who assist residents and handle daily tasks.</p>
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
                                            <p>Example: On-site manager. Can manage leases, residents' points, and handle property-wide tasks.</p>
                                        </th>
                                        <th>
                                            <div class="custom_radio_btn">
                                                <div class="form_input_radio">
                                                    <label>
                                                        <input type="radio" name="role_id" id="role_id"
                                                            value="3">
                                                        <span>Property Lead</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <p>Example: Oversees multiple properties, manages all on-site staff, and ensures consistency across locations.</p>
                                        </th>
                                    </tr>
                                </thead>
                            </form>

                            <tbody>
                                <tr>
                                    <td>Access</td>
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
                                    <td>Smart Rental Database</td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
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
                                </tr>
                                <tr>
                                    <td>Send Points To Tenants</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
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
                                    <td>Tenant Recognition</td>
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
                                </tr>

                                <tr>
                                    <td>Message Boards</td>
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
                                </tr>

                                <tr>
                                    <td>Term Extension</td>
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

    <!-- edit_user_modal -->
    <div class="modal fade cmn_modal_designs" id="edit_user_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close editUserClose" >Close</button>
                </div>
                <form id="edit_provider_user" name="edit_provider_user" method="post" enctype="multipart/form-data">
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
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Gimmzi Id*</h5>
                                    <input type="text" name="user_gimmzi_id" id="user_gimmzi_id" readonly>
                                </div> --}}
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" name="user_phone_ext" id="user_phone_ext">
                                </div>
                               
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
                                    {{-- <div class="cmn_links_clkd">
                                        <a href="javascript:void(0)" id="generatenewid">Generate New ID</a>
                                    </div> --}}
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


    <!-- pending_edit_user_modal -->
    <div class="modal fade cmn_modal_designs" id="pending_edit_user_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close pendingEditUserClose" >Close</button>
                </div>
                <form id="pending_edit_provider_user" name="pending_edit_provider_user" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <input type="hidden" id="pending_edituser_id" name="pending_edituser_id">
                                    <h5>First Name*</h5>
                                    <input type="text" name="pending_user_first_name" id="pending_user_first_name">
                                    <span id="userfirsterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Last Name*</h5>
                                    <input type="text" name="pending_user_last_name" id="pending_user_last_name">
                                    <span id="userlasterror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Email Address*</h5>
                                    <input type="email" name="pending_user_email" id="pending_user_email">
                                    <span id="useremailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Number*</h5>
                                    <input type="tel" name="pending_user_phone_no" id="pending_user_phone_no">
                                    <span id="userphoneerror"></span>
                                </div>
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Gimmzi Id*</h5>
                                    <input type="text" name="user_gimmzi_id" id="user_gimmzi_id" readonly>
                                </div> --}}
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" name="pending_user_phone_ext" id="pending_user_phone_ext">
                                </div>
                               
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <div class="custom_file_uploader">
                                        <input type="file" class="file_upload_btn" name="pending_user_image"
                                            id="pending_user_image">
                                        <div class="custom_file_uploader_inr">
                                            <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}">
                                            <h4>Upload Profile Picture</h4>
                                            <span class="output_inpt_sec"></span>
                                        </div>
                                    </div>
                                    {{-- <div class="cmn_links_clkd">
                                        <a href="javascript:void(0)" id="generatenewid">Generate New ID</a>
                                    </div> --}}
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
                            <button type="button" class="btn_table_s rdd pendingEditUserClose" >Close</button>
                        </div>
                    </div>
                </form>
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

    <!-- New error model-->
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
                                <button class="btn_table_s blu auto_wd close_new_error_modal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---End new error model-->

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
                            {{-- <h4>If you would the user to remain a user but remove access to some participating
                                locations, use the location menu ssd.</h4> --}}
                            <h3>By deactivating, the user below will no longer have access to your community Portal</h3>
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
                                        <p>This user role is for entry-level employees who assist residents and handle daily tasks.</p>
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
                                        <p>Example: On-site manager. Can manage leases, residents' points, and handle property-wide tasks.                                        </p>
                                    </th>
                                    <th>
                                        <div class="custom_radio_btn">
                                            <div class="form_input_radio">
                                                <label>
                                                    <input type="radio" name="user_role_id" id="user_role_id"
                                                        value="3">
                                                    <span>Property Lead</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p>Example: Oversees multiple properties, manages all on-site staff, and ensures consistency across locations.</p>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>Access</td>
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
                                    <td>Smart Rental Database</td>
                                    <td class="multiple_inner_tabl">
                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
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
                                </tr>
                                <tr>
                                    <td>Send Points To Tenants</td>
                                    <td class="multiple_inner_tabl">

                                        <div class="multipleP_create_tab">
                                            <div class="multipleP_create_tab_in"></div>
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
                                    <td>Tenant Recognition</td>
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
                                </tr>

                                <tr>
                                    <td>Message Boards</td>
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
                                </tr>

                                <tr>
                                    <td>Term Extension</td>
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


    <!-- remove pending user modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_pending_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px #000 solid;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            
                            <h3>By removing, the user below will no longer have access to your Provider Portal</h3>
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


    <!-- Error modal  -->
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="mesage_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px #000 solid;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="usermsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd closemesagemodal">ok</button>
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
        
            $(function () {
                //console.log(sessionStorage.getItem('userid'));
                if(sessionStorage.getItem('userid') != null){
                    $('#flexCheckDefault'+sessionStorage.getItem('userid')).attr('checked',true);
                    var userid = sessionStorage.getItem('userid');
                }
            });
        $(document).ready(function(){

            function get_smart_rental_access(propertyid){
              var sort = $('.sortFilter').val();
              let ajaxPath = "{{ route('frontend.provider.smart-rental-access-users') }}";
              console.log(propertyid);
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    data: {propertyid:propertyid,sortby:sort},
                    success: function(result) {
                        console.log(result);
                        $("#providerData").html('');
                        if(result.status == 1){
                            $("#propertyid").val(result.provider.id);
                            $('#change_first').text(result.provider.name)
                            $('#property_address').text(result.provider.address)
                            $('#property_id').val(result.provider.id)
                            $('#distributePoint').text(addCommas(result.provider.points_to_distribute) +
                                ' Points');
                            if(result.data.length > 0){
                                for(var i = 0; i < result.data.length; i++){
                                    if(result.data[i].provideruser.phone_ext != null){
                                        var ext = ' ext '+result.data[i].provideruser.phone_ext;
                                    }
                                    else{
                                        var ext = '';
                                    }
                                    var userdata = '<tr>'+
                                                    '<td><div class="custom_checked_box">'+
                                                        '<input class="form-check-input checkuser" type="radio" value="'+result.data[i].provideruser.id+'" name="providerid" id="flexCheckDefault'+result.data[i].provideruser.id+'">'+
                                                        '</div>'+
                                                    '</td>'+
                                                    '<td>'+result.data[i].provideruser.full_name+'</td>'+
                                                    '<td>'+result.data[i].title.title_name+'</td>'+
                                                    '<td>'+result.data[i].provideruser.email+'</td>'+
                                                    '<td>'+result.data[i].provideruser.phone+ext+'</td>'+
                                                    '</tr>'
                                    $("#providerData").append(userdata);
                                }
                            }
                            else{
                                $("#providerData").html('No user found');
                            }
                            
                        }
                    }
                }); 
            }

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
            $(document).on('click', '#property_provider', function() {
                var value = 'default';
                var value1 = $(this).attr('data-property_id');
                
                return get_smart_rental_access(value1);

                // let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1;

                // $.ajax({
                //     type: 'GET',
                //     url: ajaxPath,
                //     success: function(data) {
                //         console.log(data);
                //         $("#propertyid").val(data.propertyDetails.id);
                //         $('#change_first').text(data.propertyDetails.name)
                //         $('#property_address').text(data.propertyDetails.address)
                //         $('#property_id').val(data.propertyDetails.id)
                //         $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
                //             ' Points')
                //     }
                // });

            });
            var addvalidator = $("#add_provider_user").validate({
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
                        image: {
                            extension: " Please upload valid image",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
            });

            var editvalidator = $("#edit_provider_user").validate({
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

            $(document).on('click','#addNewuser',function(){
                $('#new_user_pop1').modal('show');
                $(this).find('#add_provider_user')[0].reset();  
            });

            $(".addUserClose").click(function(){
                $('#new_user_pop1').modal('hide');
                addvalidator.resetForm();
                $('#new_user_pop1').find('form').trigger('reset');
            });
            $(".editUserClose").click(function(){
                $('#edit_user_modal').modal('hide');
                editvalidator.resetForm();
                $('#edit_user_modal').find('form').trigger('reset');
            });

            $("#first_name").on('blur',function(){
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

            $("#add_provider_user").submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var propertyid = $("#property_id").val();
                var form = $('#add_provider_user')[0];
                var formdata = new FormData(form);
                formdata.append('property_id', propertyid);
            
                $.ajax({
                    url: "{{ route('frontend.provider.add-new-provider-user') }}",
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
                            $('#gimmzierror').html('The Gimmzi id Field is required').css('color', 'red');
                        } else if (result.status === 4) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            //$('#phoneerror').html('The Phone number Field is required').css('color','red');
                        } else if (result.status === 5) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            //$('#emailerror').html('The Email address Field is required').css('color','red');
                        } else if (result.status === 6) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            //$('#firsterror').html('The First name Field is required').css('color','red');
                        } else if (result.status === 8) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            //$('#lasterror').html('The Last name Field is required').css('color','red');
                        } else if (result.status === 0) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#emailerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 1) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#phoneerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 2) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#imageerror').html(result.validation_errors).css('color', 'red');
                        } else if (result.status === 9) {
                            $('#gimmzierror').html('');
                            $('#firsterror').html('');
                            $('#lasterror').html('');
                            $('#emailerror').html('');
                            $('#phoneerror').html('');
                            $('#imageerror').html('');
                            $('#gimmzierror').html(result.validation_errors).css('color', 'red');
                        }  else {

                        }

                    }
                });
               
            });

            $(document).on('click', '#sendInvite', function() {
                var userid = $("#user_id").val();
                var roleid = $("input[id='role_id']:checked").val();
                var propertyid = $("#property_id").val();
                //console.log(roleid);
                var ajaxpath = base_url + "/invite-new-provider-user" + "?userid=" + userid + "&roleid=" + roleid + "&propertyid=" + propertyid;
                $.ajax({
                    url: ajaxpath,
                    type: 'GET',
                    success: function(result) {
                        console.log(result);
                        if (result.status == 1) {
                            $("#add_role_modal").modal('hide');
                            toastr.success('Invitaion sent successfully');
                            setTimeout(function() {
                                    location.reload();
                                }, 1000);
                        } else if (result.status == 0) {
                            $("#add_role_modal").modal('hide');
                            toastr.success('Something went wrong');
                            setTimeout(function() {
                                    location.reload();
                                }, 1000);
                        } else {
                            $("#add_role_modal").modal('hide');
                            toastr.success('User saved successfully but mail not sent');
                            setTimeout(function() {
                                    location.reload();
                                }, 1000);
                        }
                    }
                });
            });

            $(document).on('click', '#edituser', function() {
                if ($(".checkuser").is(':checked')) {
                    var userid = $(".checkuser:checked").val();
                    console.log(userid +'****');
                    sessionStorage.removeItem("userid");
                    sessionStorage.setItem("userid", userid);
                    var ajaxpath = base_url + "/edit-find-provider-user" + "?userid=" + userid;
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
                                $("#userpreview").attr('src', result.data.provider_profile_image);
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

            $(document).on('click', '#generatenewid', function(){
                var mystring = $("#user_gimmzi_id").val();
                mystring = mystring.substring(0, 4);
                var length = 4;
                var mynumber = Math.floor(Math.pow(10, length-1) + Math.random() * (Math.pow(10, length) - Math.pow(10, length-1) - 1));
                const last3Str = String($("#user_gimmzi_id").val()).slice(-3);
                $("#user_gimmzi_id").val('');
                $("#user_gimmzi_id").val(mynumber+last3Str);

            });

            $("#edit_provider_user").submit(function(e) {
                e.preventDefault();
                var userid = $(".checkuser:checked").val();
                sessionStorage.removeItem("userid");
                sessionStorage.setItem("userid", userid);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#edit_provider_user')[0];
                var formdata = new FormData(form);
                
                $.ajax({
                    url: "{{ route('frontend.provider.update-provider-user') }}",
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
                                sessionStorage.setItem("userid", result.data.id);
                                $("#user_id").val(result.data.id);
                                $("#edit_user_modal").modal('hide');
                                // $("#merchantData").load(location.href + "#merchantData");
                                toastr.success('The Provider user has been updated successfully');
                                setTimeout(() => {
                                    location.reload();
                                },300);
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
                                $("#usertable").load(window.location + " #usertable");
                                setTimeout(() => {
                                location.reload();
                                },3000);
                            }
                        } 
                });
                
            });

            $("#pending_edit_provider_user").submit(function(e) {
                e.preventDefault();
                var userid = $(".checkuser:checked").val();
                sessionStorage.removeItem("userid");
                sessionStorage.setItem("userid", userid);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#pending_edit_provider_user')[0];
                var formdata = new FormData(form);
                
                $.ajax({
                    url: "{{ route('frontend.provider.pending-update-provider-user') }}",
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
                                sessionStorage.setItem("userid", result.data.id);
                                $("#user_id").val(result.data.id);
                                // $("#pending_edit_user_modal").modal('hide');
                                // $("#merchantData").load(location.href + "#merchantData");
                                toastr.success('The Provider user has been updated successfully');
                                // setTimeout(() => {
                                //     location.reload();
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
                                // setTimeout(() => {
                                // location.reload();
                                // },3000);
                            }
                        } 
                });
                
            });

            $(document).on('click', '#resetpassword', function() {
                if ($(".checkuser").is(':checked')) {
                    var userid = $(".checkuser:checked").val();
                    var ajaxpath = base_url + "/reset-provider-password-link" + "?userid=" + userid;
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

            $(document).on('click', '#deactivateuser', function() {
                if ($(".checkuser").is(':checked')) {
                    var userid = $(".checkuser:checked").val();
                    var ajaxpath = base_url + "/edit-find-provider-user" + "?userid=" + userid;
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
            });

            $(document).on('click', '#yesDeactivate', function() {
                if ($(".checkuser").is(':checked')) {
                    var userid = $(".checkuser:checked").val();
                    var ajaxpath = base_url + "/deactivate-provider-user" + "?userid=" + userid;
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

            $(document).on('click', '#changeroleuser', function() {
                if ($(".checkuser").is(':checked')) {
                    var userid = $(".checkuser:checked").val();
                    sessionStorage.removeItem("userid");
                    sessionStorage.setItem("userid", userid);
                    var ajaxpath = base_url + "/edit-find-provider-user" + "?userid=" + userid;
                    $.ajax({
                        url: ajaxpath,
                        type: 'GET',
                        success: function(result) {
                            console.log(result);
                            if (result.status == 1) {
                                console.log(result.data.title_id);
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
                var propertyid = $("#property_id").val();
                var ajaxpath = base_url + "/change-provider-user-role" + "?userid=" + userid + "&role_id=" + roleid + "&propertyid=" +propertyid;
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
            })

            $(document).on('click',".sortFilter",function(){
                var sort = $(this).val();
                var property_id = $('#property_id').val();
                var ajaxpath = base_url + "/smart-rental-access-management" + "?sortby=" + sort +"&property_id="+property_id ;
                $.ajax({
                    url: ajaxpath,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        if(data.status == 'success'){
                            $("#providerData").html('');
                            for(var i = 0; i < data.providers.length; i++){
                                if(data.providers[i].provideruser.phone_ext != null){
                                    var ext = ' ext '+data.providers[i].provideruser.phone_ext;
                                }
                                else{
                                    var ext = '';
                                }
                                var userdata = '<tr>'+
                                                '<td><div class="custom_checked_box">'+
                                                    '<input class="form-check-input checkuser" type="radio" value="'+data.providers[i].provideruser.id+'" name="providerid" id="flexCheckDefault'+data.providers[i].provideruser.id+'">'+
                                                    '</div>'+
                                                '</td>'+
                                                '<td>'+data.providers[i].provideruser.full_name+'</td>'+
                                                '<td>'+data.providers[i].title.title_name+'</td>'+
                                                '<td>'+data.providers[i].provideruser.email+'</td>'+
                                                '<td>'+data.providers[i].provideruser.phone+ext+'</td>'+
                                                '</tr>'
                                $("#providerData").append(userdata);
                            }
                        }
                        
                    }
                })
            })

            $(document).on('click',".searchBy",function(){
                var search = $("#search").val();
                var property_id = $('#property_id').val();
                var ajaxpath = base_url + "/smart-rental-access-management" + "?search_by=" + search +"&property_id="+property_id ;
                $.ajax({
                    url: ajaxpath,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        if(data.status == 'success'){
                            $("#providerData").html('');
                            if(data.providers.length > 0){
                                for(var i = 0; i < data.providers.length; i++){
                                    if(data.providers[i].provideruser.phone_ext != null){
                                        var ext = ' ext '+data.providers[i].provideruser.phone_ext;
                                    }
                                    else{
                                        var ext = '';
                                    }
                                    var userdata = '<tr>'+
                                                    '<td><div class="custom_checked_box">'+
                                                        '<input class="form-check-input checkuser" type="radio" value="'+data.providers[i].provideruser.id+'" name="providerid" id="flexCheckDefault'+data.providers[i].provideruser.id+'">'+
                                                        '</div>'+
                                                    '</td>'+
                                                    '<td>'+data.providers[i].provideruser.full_name+'</td>'+
                                                    '<td>'+data.providers[i].title.title_name+'</td>'+
                                                    '<td>'+data.providers[i].provideruser.email+'</td>'+
                                                    '<td>'+data.providers[i].provideruser.phone+ext+'</td>'+
                                                    '</tr>'
                                    $("#providerData").append(userdata);
                                }
                            }
                            else{
                                $("#providerData").html('No User Found');
                            }
                            
                        }
                        
                    }
                })
            });



            $(document).on('change','.pendingOption',function(){
                    var userid = $(this).val();
                    
                    var propertyid = $("#property_id").val();
                   
                    // console.log($(this).children(":selected").attr('class'));
                    if($(this).children(":selected").attr('class') == 'remove'){
                        var ajaxpath = base_url + "/edit-find-provider-user" + "?userid=" + userid;
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
                                    $("#errormsg").html('User Not Found fdf');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }
                    else if($(this).children(":selected").attr('class') == 'editrequest'){
                        var userid = $(this).val();
                        console.log(userid +'----------');
                        var ajaxpath = base_url + "/apartment-edit-user" + "?userid=" + userid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#pending_edituser_id").val(result.data.id);
                                    $("#pending_user_first_name").val(result.data.first_name);
                                    $("#pending_user_last_name").val(result.data.last_name);
                                    $("#pending_user_email").val(result.data.email);
                                    $("#pending_user_phone_no").val(result.data.phone);
                                    $("#pending_user_gimmzi_id").val(result.data.userId);
                                    $("#pending_user_phone_ext").val(result.data.phone_ext);
                                    $("#pending_edit_user_modal").modal('show');
                                    $("#userpreview").attr('src', result.data.profile_image);
                                } else {
                                    $("#errormsg").html('User Not Found dddd');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }

                    else if($(this).children(":selected").attr('class') == 'resend'){
                        // var ajaxpath = base_url + "/find-provider-user" + "?userid=" + userid;
                        var ajaxpath = base_url + "/find-provider-user" + "?userid=" + userid + "&propertyid=" + propertyid;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#resendUserName").html(result.data.full_name);
                                    // $("#new_user_pop2").modal('hide');
                                    // $("#resend_modal").modal('show');
                                    // $("#userid").val(userid);
                                    
                                    $("#new_errormsg").html('Successfully resend.');
                                    $("#new_error_modal").modal('show');

                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        });
                    }
                    
            })


            $(document).on('click', '.close_new_error_modal', function() {
                $('.pendingOption').prop('selectedIndex', 0);
                $("#new_error_modal").modal('hide');
            });
                $(document).on('click','#yesremove',function(){
                        var userid = $("#userid").val();
                        var property_id = $('#property_id').val();
                        var ajaxpath = base_url + "/remove-pending-provider" + "?userid=" + userid +'&propertyid='+property_id;
                        $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#pendingUserName").html('');
                                    $("#remove_pending_modal").modal('hide');
                                    $("#usermsg").html('User Deleted Successfully');
                                    $("#mesage_modal").modal('show');
                                    $("#pendingProviderUser").html('');
                                    if(result.pending.length > 0){
                                        
                                        for(var i = 0; i < result.pending.length; i++){
                                            // var sentdate = $.datepicker.formatDate('m-d-Y', new Date(result.pending[i].provideruser.created_at));
                                            // var expirydate = $.datepicker.formatDate('m-d-Y', new Date(result.pending[i].provideruser.expiry_date));

                                            var create_d = new Date(result.pending[i].provideruser.created_at);
                                            var sentdate = 
                                                ("0" + (create_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + create_d.getDate()).slice(-2) + '-' +
                                                create_d.getFullYear();

                                            var expiry_d = new Date(result.pending[i].provideruser.expiry_date);
                                            var expirydate = 
                                                ("0" + (expiry_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + expiry_d.getDate()).slice(-2) + '-' +
                                                expiry_d.getFullYear();

                                           var users = '<tr>'+
                                                        '<td>'+
                                                        '</td>'+
                                                        '<td>'+ result.pending[i].provideruser.full_name+'</td>'+
                                                        '<td>'+result.pending[i].title.title_name+'</td>'+
                                                        '<td>'+result.pending[i].provideruser.email +'</td>'+
                                                        '<td>'+ result.pending[i].provideruser.phone +'</td>'+
                                                        '<td>'+sentdate+'</td>'+
                                                        '<td>'+expirydate+'</td>'+
                                                        '<td>'+
                                                            '<div class="selctd_table_sec">'+
                                                                '<select class = "pendingOption">'+
                                                                    '<option style="text-align:center;">...</option>'+
                                                                    '<option style="text-align:center;" class="remove" value="'+result.pending[i].provideruser.id+'">Remove</option>'+
                                                                    '<option style="text-align:center;" class="resend" value="'+result.pending[i].provideruser.id+'">Resend</option>'+
                                                                    '<option style="text-align:center;" class="editrequest" value="'+result.pending[i].provideruser.id+'">Edit request</option>'+
                                                                '</select>'+
                                                            '</div>'+
                                                        '</td>'+
                                                    '</tr>';
                                           $("#pendingProviderUser").append(users);
                                        }
                                    }
                                    else{
                                        $("#pendingProviderUser").html('No User Found');
                                    }
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        })

                })

                $(document).on('click','.closemesagemodal',function(){
                    $("#mesage_modal").modal('hide');
                    $("#usermsg").html('');
                });


                $(".pendingEditUserClose").click(function(){
                    $('#pending_edit_user_modal').modal('hide');
                    editvalidator.resetForm();
                    $('#pending_edit_user_modal').find('form').trigger('reset');
                });


                $(document).on('click','.pendingEditUserClose',function(){
                    $('#pending_edit_user_modal').modal('hide');
                    editvalidator.resetForm();
                    $('#pending_edit_user_modal').find('form').trigger('reset');
                    // location.reload();
                    // var userid = $("#userid").val();
                    var userid = $("#userid").val();
                        var property_id = $('#property_id').val();
                        var ajaxpath = base_url + "/edit-apartment-pending-user" + "?userid=" + userid +'&propertyid='+property_id;
                    // var ajaxpath = base_url + "/edit-apartment-pending-user";
                    $.ajax({
                            url: ajaxpath,
                            type: 'GET',
                            success: function(result) {
                                console.log(result);
                                if (result.status == 1) {
                                    $("#pendingUserName").html('');
                                    // $("#remove_pending_modal").modal('hide');
                                    // $("#usermsg").html('User edited Successfully');
                                    // $("#mesage_modal").modal('show');
                                    $("#pendingProviderUser").html('');
                                    if(result.pending.length > 0){
                                        
                                        for(var i = 0; i < result.pending.length; i++){
                                            

                                            var create_d = new Date(result.pending[i].provideruser.created_at);
                                            var sentdate = 
                                                ("0" + (create_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + create_d.getDate()).slice(-2) + '-' +
                                                create_d.getFullYear();

                                            var expiry_d = new Date(result.pending[i].provideruser.expiry_date);
                                            var expirydate = 
                                                ("0" + (expiry_d.getMonth() + 1)).slice(-2) + '-' +
                                                ("0" + expiry_d.getDate()).slice(-2) + '-' +
                                                expiry_d.getFullYear();

                                            
                                            


                                           var users = '<tr>'+
                                                        '<td>'+
                                                        '</td>'+
                                                        '<td>'+ result.pending[i].provideruser.full_name+'</td>'+
                                                        '<td>'+result.pending[i].title.title_name+'</td>'+
                                                        '<td>'+result.pending[i].provideruser.email +'</td>'+
                                                        '<td>'+ result.pending[i].provideruser.phone +'</td>'+
                                                        '<td>'+sentdate+'</td>'+
                                                        '<td>'+expirydate+'</td>'+
                                                        '<td>'+
                                                            '<div class="selctd_table_sec">'+
                                                                '<select class = "pendingOption">'+
                                                                    '<option style="text-align:center;">...</option>'+
                                                                    '<option style="text-align:center;" class="remove" value="'+result.pending[i].provideruser.id+'">Remove</option>'+
                                                                    '<option style="text-align:center;" class="resend" value="'+result.pending[i].provideruser.id+'">Resend</option>'+
                                                                    '<option style="text-align:center;" class="editrequest" value="'+result.pending[i].provideruser.id+'">Edit request</option>'+
                                                                '</select>'+
                                                            '</div>'+
                                                        '</td>'+
                                                    '</tr>';
                                           $("#pendingProviderUser").append(users);
                                        }
                                    }
                                    else{
                                        $("#pendingProviderUser").html('No User Found');
                                    }
                                } else {
                                    $("#errormsg").html('User Not Found');
                                    $("#error_modal").modal('show');
                                }
                            }
                        })
                });


            // $(document).on('click', '#merchantlocation', function() {
            //     if ($(".checkuser").is(':checked')) {
            //         var userid = $(".checkuser:checked").val();
            //         sessionStorage.removeItem("userid");
            //         sessionStorage.setItem("userid", userid);
            //         var ajaxpath = base_url + "/get-merchant-location" + "?userid=" + userid;
            //         $.ajax({
            //             url: ajaxpath,
            //             type: 'GET',
            //             success: function(result) {
            //                 if (result.status == 1) {
            //                     // console.log(result.row);
            //                     $("#location_modal").modal('show');
            //                     $("#erroraccess").html("");
            //                     $("#merchantusername").html(result.user.full_name +
            //                         '<span> has access to these location <span>');
            //                     $("#mainlocation").html("");
            //                     $("#participatinglocation").html("");
            //                     $("#mainlocation").html(
            //                         '<span> Home Location: </span>' +
            //                         result.main.business_location.location_name);
            //                         $('#available_location').html('<option value = "">Choose Location </option>');
            //                         for(var x = 0; x < result.row.length; x++){
            //                             // console.log(result.row[x]);
            //                             var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
            //                             $("#available_location").append(availabledata);
            //                         }
            //                         for (var i = 0; i < result.another.length; i++) {
            //                             console.log('done');
            //                                 if (result.another[i].is_main == false) {
            //                                     var locationdata = '<tr id="'+result.another[i].id+'">' +
            //                                         '<td id="participatinglocation_'+result.another[i].id+'">' + result.another[i]
            //                                         .business_location.location_name + '</td>' +
            //                                         '<td>' +
            //                                         '<div class="selctd_table_sec">' +
            //                                         '<select name="location" class="select_action"' +
            //                                         'data-id="' + result.another[i].id + '">' +
            //                                         '<option value="">....</option>' +
            //                                         '<option value="Remove">Remove Access</option>' +
            //                                         '<option value="Make-Home">Make Home Location</option>' +
            //                                         '</select>' +
            //                                         '</div>' +
            //                                         '</td>' +
            //                                         '</tr>';
            //                                     $("#participatinglocation").append(locationdata);
            //                                 } else {
            //                                     $("#participatinglocation").html(
            //                                         'No Participating location found');
            //                                 }
            //                             }    

            //                 } else if (result.status == 2) {
            //                     // console.log('hi');
            //                     $("#location_modal").modal('show');
            //                     $("#erroraccess").html("");
            //                     $("#merchantusername").html(result.user.full_name +
            //                         '<span> has access to these location <span>');
            //                     $("#mainlocation").html("");
            //                     $("#participatinglocation").html("");
            //                     $("#mainlocation").html(
            //                         '<span> Home Location: </span>' +
            //                         result.main.business_location.location_name);
            //                     $("#participatinglocation").html(
            //                         'No Participating location found');
            //                     $('#available_location').html('<option value = "">Choose Location </option>');
            //                     for(var x = 0; x < result.row.length; x++){
            //                         var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
            //                         $("#available_location").append(availabledata);
            //                     }

            //                 } else if (result.status == 3) {
            //                     $("#location_modal").modal('show');
            //                     $("#erroraccess").html("");
            //                     $("#merchantusername").html(result.user.full_name +
            //                         '<span> has access to these location <span>');
            //                     $("#mainlocation").html("");
            //                     $("#participatinglocation").html("");
            //                     $("#mainlocation").html(
            //                         '<span> Home Location: </span> No main location found');
            //                     $("#participatinglocation").html(
            //                         'No Participating location found');
            //                     $('#available_location').html('<option value = "">Choose Location</option>');
            //                     for(var x = 0; x < result.row.length; x++){
            //                         var availabledata = '<option value="' + result.row[x].id +'">' + result.row[x].location_name +'</option>';
            //                         $("#available_location").append(availabledata);
            //                     }
            //                 } else {
            //                     $("#errormsg").html('User Not Found');
            //                     $("#error_modal").modal('show');
            //                 }
            //             }
            //         });
            //     } else {
            //         $("#errormsg").html('Please click on checkbox first');
            //         $("#error_modal").modal('show');
            //     }
            // });
        });
    </script>

@endpush
</x-layouts.provider-layout>