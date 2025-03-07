<div>
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
                            <div class="right-sec-rental">
                                <h3>{{$user->travelType->name}}</h3>

                                <p class="alen-park-text1 img-b-space1">
                                    <span class="p-responsive-main location-image-icon img-b-space1">
                                        <label><strong>Address:</strong></label>
                                        <label>{{$user->travelType->address}}</label>
                                    </span>

                                    <span class="p-responsive-main">
                                        <span class="mail-image-icon">&nbsp;</span><label><strong>Mail:</strong></label>
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </span>
                                </p>
                                <p class="alen-park-text1 alen-park-text1 star-image-icon">
                                    <label>Total Points to Distribute:</label>
                                    <span
                                        class="alen-park-text1">{{number_format($user->travelType->points_to_distribute)}}
                                        Points</span>
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
                                        <form wire:submit.prevent = "searchProvider">
                                            <div class="form-group">
                                                <input type="text" name="search" wire:model.defer="search_user"
                                                    placeholder="Search using First Name or Last Name.....">
                                                <button type="submit" id="searchBy" ><i><img
                                                            src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}"
                                                            alt=""></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="add_usern_sctn_top_wrap_rtt">
                                    <a class="cmn_usr_btn" data-bs-toggle="modal" href="javascript:void(0)"
                                        role="button" wire:click='openAddUserModal'>Add
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
                                        {{-- <h3 id="user_main_location">Main Location: <span>Select a User</span></h3> --}}
                                    </div>

                                    <div class="col-lg-4 table_user_top_sec_col_rght">
                                        <div class="cmn_selct_filter">
                                            <select class="form-select" wire:model.defer = "status" aria-label="Default select example" wire:change="StatusWiseUser">                                               
                                                {{-- <option value="-1">All</option>
                                                <option selected = "" value="1">Active</option>
                                                <option value="0">Inactive</option> --}}
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
                                                                <th style="padding: 17px 42px!important;">
                                                                    <div class="custom_checked_box"></div>
                                                                </th>
                                                                <th>Name</th>
                                                                <th>Role</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody id="providerData">
                                                            @if (count($providers) > 0)
                                                            @foreach ($providers as $data)
                                                            <tr>
                                                                <td>
                                                                    <div class="custom_checked_box">
                                                                        <input class="form-check-input checkuser"
                                                                            type="radio"
                                                                            wire:click="selectedUserId({{ $data->id }})"
                                                                            value="{{ $data->id }}" name="providerid">
                                                                    </div>
                                                                </td>
                                                                <td>{{ $data->full_name }}</td>
                                                                @if($data->title != null)
                                                                <td>{{ $data->title->title_name}}</td>
                                                                @else
                                                                <td>-</td>
                                                                @endif
                                                                <td>{{ $data->email }}</td>
                                                                <td>{{ $data->phone }}
                                                                    @if ($data->phone_ext != '')
                                                                    ext {{ $data->phone_ext }}
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                            @endforeach
                                                            @else
                                                            <tr>
                                                                @if($status == 1)
                                                                  <td colspan=5 style="text-align:center;">No active user Found</td>
                                                                @elseif($status == 0)
                                                                  <td colspan=5 style="text-align:center;">No deactive user Found</td>
                                                                @else
                                                                <td colspan=5 style="text-align:center;">No user Found</td>
                                                                @endif
                                                            </tr>
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 table_user_bttm_sec_head_col_lft">
                                            <div class="table_support_cnt_rt">
                                                <a href="javascript:void(0)" class="btn_table_s grn" wire:click.prevent="editRentalAccessUser">Edit
                                                    User</a>
                                                <a href="javascript:void(0)" class="btn_table_s purpl"  wire:click.prevent="editRentalAccessRoleUser">Change Role</a>
                                                <a href="javascript:void(0)" class="btn_table_s ylw"  wire:click.prevent="changePassword">Change PW</a>
                                                @if($status != -1)
                                                    @if($status == 1)
                                                        <a href="javascript:void(0)" class="btn_table_s rdd" wire:click.prevent="deactivateUser">Deactivate</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn_table_s rdd" wire:click.prevent="activateUser">Activate </a>
                                                    @endif
                                                @else
                                                    @if($selected_provider)
                                                        @if($selected_provider->active == 1)
                                                            <a href="javascript:void(0)" class="btn_table_s rdd" wire:click.prevent="deactivateUser">Deactivate</a>
                                                        @else
                                                            <a href="javascript:void(0)" class="btn_table_s rdd" wire:click.prevent="activateUser">Activate </a>
                                                        @endif
                                                    @else                                                            
                                                        <a href="javascript:void(0)" class="btn_table_s rdd" wire:click.prevent="deactivateUser">Deactivate</a>
                                                    @endif
                                                @endif
                                                <a href="javascript:void(0)" class="btn_table_s grn" wire:click="pendingUser">Pending User Invites</a>
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

    <!-- Add New User Modal-->
    <div wire:ignore.self class="modal fade cmn_modal_designs" id="new_user_pop1" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    {{-- <button type="button" class="btn-close addUserClose">Close</button> --}}
                </div>
                <form wire:submit.prevent='addNewUser'>
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>First Name *</h5>
                                    <input type="text" wire:model="first_name" id="first_name">
                                    {{-- <span id="firsterror"></span> --}}
                                    @error('first_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Last Name *</h5>
                                    <input type="text" wire:model="last_name" id="last_name">
                                    {{-- <span id="lasterror"></span> --}}
                                    @error('last_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Email Address *</h5>
                                    <input type="email" wire:model="email" id="email">
                                    {{-- <span id="emailerror"></span> --}}
                                    @error('email')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Number *</h5>
                                    <input type="text" wire:model="phone" id="phone">
                                    {{-- <span id="phoneerror"></span> --}}
                                    @error('phone')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" wire:model="phone_ext" id="phone_ext">
                                </div>
                                <div class="col-lg-6 mb-4 custom_form_dsgn_pop_col">
                                    <h4>Upload Profile Picture</h4>

                                    <x-admin.filepond wire:model="image"
                                        class="{{ $errors->has('image') ? 'is-invalid' : '' }}" allowImagePreview
                                        imagePreviewMaxHeight="50" allowFileTypeValidation
                                        acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                                        allowFileSizeValidation maxFileSize="4mb" />
                                    @error('image')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            {{-- <a href="javascript:void(0)" class="btn_table_s grn" wire:click="pendingUser">Pending User Invites</a> --}}
                            <button class="btn_table_s blu addusersubmit" type="submit">Assign
                                Role</button>
                            <button type="button" class="btn_table_s rdd addUserClose"
                                wire:click='closeAdduser'>Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add_role_modal -->
    <div wire:ignore.self class="modal fade cmn_modal_designs modal_role_wrap_dialog" id="add_role_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            {{-- <form wire:submit.prevent='saveUserRole'> --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title new">Assign A Role</h5>
                    </div>
                    <div class="modal-body">
                        <div class="assign_role_userpt">
                            <table>
                                <form>
                                    {{-- <input type="hidden" name="user_id" id="user_id"> --}}
                                    <thead>
                                        <tr>
                                            <th><span class="asn_rl_sp">Assign the user's role</span></th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input wire:model='role_id' type="radio" id="role_id"
                                                                value="1" checked="">
                                                            <span>Associate</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>This user role is for entry-level employees who assist guests directly.</p>
                                            </th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model='role_id' id="role_id"
                                                                value="2">
                                                            <span>Manager</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>Example: Front Desk Supervisor. Can manage guest bookings and assign loyalty points</p>
                                            </th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model='role_id' id="role_id"
                                                                value="3">
                                                            <span>Property Lead</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>Example: Property Manager, Multiple Property Owner. Can oversee multiple locations and manage overall guest experiences.</p>
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
                                        <td>Smart Guest Database</td>
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
                                        <td>Low point balance member search</td>
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
                                        <td>User access management</td>
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
                                        <td>Manage listing</td>
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
                                        <td>Settings</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-gap-none">

                            <div class="btn_foot_end">
                                <span id="invitationmsg"></span>
                                <a href="javascript:void(0)" class="btn_table_s blu" wire:click='sendUserInvite'>Send
                                    Invite To
                                    User</a>
                                <a href="javascript:void(0)" class="btn_table_s rdd" id="closeaddrole"
                                    wire:click='closeAddRole'>Close</a>
                            </div>

                        </div>

                    </div>
                </div>
                {{--
            </form> --}}
        </div>
    </div>



    {{-- Edit User Model --}}


    <div wire:ignore.self class="modal fade cmn_modal_designs" id="editRentalAccessModel" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close addUserClose" wire:click="$emit('hideRentalAccessModel')">Close</button>
                </div>
                <form wire:submit.prevent='updateRentalAccessUser'>
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>First Name *</h5>
                                    <input type="text" wire:model="first_name" id="first_name">
                                    @error('first_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Last Name *</h5>
                                    <input type="text" wire:model="last_name" id="last_name">
                                    @error('last_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Email Address *</h5>
                                    <input type="email" wire:model="email" id="email">
                                    @error('email')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Number *</h5>
                                    <input type="text" wire:model="phone" id="phone">
                                    @error('phone')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Phone Ext</h5>
                                    <input type="text" wire:model="phone_ext" id="phone_ext">
                                </div>

                                <div class="col-lg-6 mb-4 custom_form_dsgn_pop_col">
                                    <h4>Upload Profile Picture</h4>
                                    <div class="form-group col-lg-6 mb-2">
                                        @if ($imgId)
                                        <img src="{{ asset($imgId) }}" width="100px" height="50px">
                                        @endif
                                    </div>
                                    <x-admin.filepond wire:model="image"
                                        class="{{ $errors->has('image') ? 'is-invalid' : '' }}" allowImagePreview
                                        imagePreviewMaxHeight="50" allowFileTypeValidation
                                        acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                                        allowFileSizeValidation maxFileSize="4mb" />
                                    @error('image')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            <button class="btn_table_s blu addusersubmit" type="submit">Update</button>
                            <button type="button" class="btn_table_s rdd addUserClose"
                                wire:click="$emit('hideRentalAccessModel')">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- End User Model--}}


    {{-- //Change Role Model --}}


    <!-- Add_role_modal -->
    <div wire:ignore.self class="modal fade cmn_modal_designs modal_role_wrap_dialog" id="editRentalAccessRoleModel" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            {{-- <form wire:submit.prevent='saveUserRole'> --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title new">Assign A Role</h5>
                    </div>
                    <div class="modal-body">
                        <div class="assign_role_userpt">
                            <table>
                                <form>
                                    <thead>
                                        <tr>
                                            <th><span class="asn_rl_sp">Assign the user's role</span></th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input wire:model='role_id' type="radio" id="role_id"
                                                                value="1" checked="">
                                                            <span>Associate</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>This user role is for entry level employees who assist guests directly.</p>
                                            </th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model='role_id' id="role_id"
                                                                value="2">
                                                            <span>Manager</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>Example: Front Desk Supervisor. Can manage guest bookings and assign loyalty points.</p>
                                            </th>
                                            <th>
                                                <div class="custom_radio_btn">
                                                    <div class="form_input_radio">
                                                        <label>
                                                            <input type="radio" wire:model='role_id' id="role_id"
                                                                value="3">
                                                            <span>Property Lead</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <p>Example: Property Manager, Multiple Property Owner. Can oversee multiple locations and manage overall guest experiences.</p>
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
                                        <td>Smart Guest Database</td>
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
                                        <td>Low point balance member search</td>
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
                                        <td>User access management</td>
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
                                        <td>Manage listing</td>
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
                                        <td>Settings</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="modal-footer-gap-none">

                            <div class="btn_foot_end">
                                <span id="invitationmsg"></span>
                                <a href="javascript:void(0)" class="btn_table_s blu" wire:click.prevent='updateRentalAccessRoleUser'>Change Role</a>
                                <a href="javascript:void(0)" class="btn_table_s rdd" id="closeaddrole"
                                    wire:click="$emit('hideRentalAccessRoleModel')">Close</a>
                            </div>

                        </div>

                    </div>
                </div>
                {{--
            </form> --}}
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="removeuser_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="user_id" value="">
                            <h4>By deactivating, the user below will no longer have access to your provider portal</h4>
                            <h3 id="user_name"></h3>
                            <h4>Do you want to continue to permanently deactivate this user?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="removeUser()">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- pending User Model --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs" id="pendingUserModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px #000 solid;">
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
                                   
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Date Sent</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($pending_users)
                                    @foreach ($pending_users as $puser)
                                        <tr>
                                           
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

    {{-- end pending User Model --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_pending_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px #000 solid;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            
                            <h3>By removing, the user below will no longer have access to your Provider Portal</h3>
                            
                            @if($remove_user != '')
                                <h2>{{$remove_user->full_name}}</h2>
                            @endif
                            <h3>Do you want to continue to permanently remove this user?</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="removePendingUser">Yes</button>
                                <button class="btn_table_s rdd auto_wd" wire:click="closeRemoveModal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{-- resend pending user --}}
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="resend_pending_modal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px #000 solid;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">

                            @if ($resend_user != '')
                                <h2>{{ $resend_user->full_name }}</h2>
                            @endif
                            <h3>Would you like to resend the invite request for this user?</h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click="resendPendingUser">Yes</button>
                                <button class="btn_table_s rdd auto_wd" wire:click="closeResendModal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="errormsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click.prevent="hideSuccessModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @push('scripts')
    <script>
        window.livewire.on('hideRentalAccessModel', () => {
            $('#editRentalAccessModel').modal('hide');
            $(".pendingOption").val('...');
        });
        window.livewire.on('showRentalAccessModel', () => {
            $('#editRentalAccessModel').modal('show');
           
        });

        window.livewire.on('hideRentalAccessRoleModel', () => {
            $('#editRentalAccessRoleModel').modal('hide');
        });
        window.livewire.on('showRentalAccessRoleModel', () => {
            $('#editRentalAccessRoleModel').modal('show');
        });

        document.addEventListener('livewire:load', function(event) {
            @this.on('showAddUserModal', function() {
                $('#new_user_pop1').modal('show');
            });
            @this.on('hideAddUserModal', function() {
                $('#new_user_pop1').modal('hide');
                $("#new_user_pop1").find('form').trigger('reset');
            });
            @this.on('showAddUserRoleModal', function() {
                $('#add_role_modal').modal('show');
            });
            @this.on('hideUserRoleModal', function() {
                $('#add_role_modal').modal('hide');
            });

            @this.on('showPendingUserModal', function() {
                $('#pendingUserModal').modal('show');
            });

            $(document).on('change','.pendingOption',function(){
               
                    var userid = $(this).val();
                    
                    if($(this).children(":selected").attr('class') == 'remove'){
                        // console.log($(this).children(":selected").attr('class'));
                        window.livewire.emit('openRemoveConfirmModal',[userid])
                    }
                    if($(this).children(":selected").attr('class') == 'resend'){
                        // console.log($(this).children(":selected").attr('class'));
                        window.livewire.emit('openResendConfirmModal', [userid])
                    }
                    if ($(this).children(":selected").attr('class') == 'editrequest') {
                        window.livewire.emit('showEditRequestUserModal', userid)
                    }
            });
            @this.on('openRemoveModal', function() {
                $('#remove_pending_modal').modal('show');
            });

            @this.on('hideRemoveModal', function() {
                $(".pendingOption").val('...');
                $('#remove_pending_modal').modal('hide');
            });
            
            @this.on('successModal', data =>{
                $('#error_modal').modal('show');
                $("#errormsg").html(data.text);
                        
            })

            @this.on('hidesuccessModal', function () {
                $('#error_modal').modal('hide');    
                $(".pendingOption").val('...');
                $('#remove_pending_modal').modal('hide');   
                $('#resend_pending_modal').modal('hide');                   
                //window.livewire.emit('openListingModal');
            });

            @this.on('showRemoveModal', data => {
                $('#removeuser_modal').modal('show');
                $("#user_name").html(data.name);
            });


            @this.on('openResendModal', function() {
                    $('#resend_pending_modal').modal('show');
                });


            @this.on('hideResendModal', function() {
                    $('#resend_pending_modal').modal('hide');
                    $(".pendingOption").val('...');
                });


                @this.on('hideEditRequestModal', function() {
                    $('#editRentalAccessModel').modal('hide');
                    $(".pendingOption").val('...');
                    // $("#").

                });

            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("preview").src = e.target.result;
                    @this.set('image', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });
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