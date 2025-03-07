<div>
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
                                    <select wire:model="merchant_main_location" class="form-control" wire:change.prevent='getLocationDetail' style="width: 50%;">
                                            @if ($merchant_location)
                                                @foreach ($merchant_location as $locations)
                                                
                                                    <option value="{{ $locations->businessLocation->id }}" >{{ $locations->businessLocation->location_name }}</option>
                                                  
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
                                                        <span class="points-distributed-txt">
                                                            {{$location}}
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
                                                        @foreach ($merchant_location as $locations)
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
                            <div class="add_usern_sctn_top_wrap_lft" style="max-width: 64%!important;">
                                <div class="user_scn_form">
                                    <h3 id="user_main_location">Item & Service Database</h3>
                                </div>
                            </div>
                            <span class="">
                                <select class="filter-select11" wire:model="item_status" wire:change='changeStatus'>
                                    <option value="All">All</option>
                                    <option value="Active" selected>Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>

                            </span>
                            <div class="add_usern_sctn_top_wrap_rtt">
                               
                                <a class="cmn_usr_btn" wire:click='addItemServiceModal' role="button">Add</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="add_new_user_sctn_btmm">
                    <div class="container">
                        <div class="table_user_bttm_sec">
                            <div class="table_user_bttm_sec_head">
                                <div class="row table_user_bttm_sec_head_row gy-4">
                                    <div class="col-lg-12 table_user_bttm_sec_head_col_lft">
                                        <div class="table_cmn_part_sgn">
                                            <table id="usertable">
                                                <thead>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td>name of Gift</td>
                                                        <td>Notes</td>
                                                        <td>Value</td>
                                                        <td>Add to Gift Database</td>
                                                        @if (Auth::user()->user_title != 'Associate')
                                                        <td>Action</td>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody id="merchantData">
                                                    @if ($items)
                                                        @foreach ($items as $item)
                                                            <tr>
                                                                @if ($item->status == 1)
                                                                 <td style="color: #42ac04;">Active</td>
                                                                @else
                                                                 <td style="color: #e61717;">Inactive</td>
                                                                @endif
                                                                <td>{{ $item->item_name }}</td>
                                                                @if ($item->note != '')
                                                                 <td>{{ $item->note }}</td>
                                                                @else
                                                                 <td>N/A</td> 
                                                                @endif
                                                                @if ($item->item_price != '')
                                                                    
                                                                    <td id="valueShow">
                                                                        @if($price_show[$item->id] == false)
                                                                            <a href="javascript:void(0);" wire:click='viewItemprice({{$item->id}})'
                                                                                class="view-value">View Value</a>
                                                                        @else
                                                                            <a href="javascript:void(0);" class="view-value">${{$item->item_price->price}}</a>
                                                                        @endif
                                                                    </td>
                                                                @else
                                                                   
                                                                    <td>
                                                                        @if($price_show[$item->id] == false)
                                                                            <a href="javascript:void(0);" class="view-value" wire:click='viewItemprice({{$item->id}})'>Add Value</a>
                                                                        @else
                                                                            <input type="text" wire:model.lazy='price.{{$item->id}}' wire:key='{{$item->id}}'>
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                                <td class="custom-checkbox-all-product-database text-center">
                                                                    <input class="form-check-input " name="item_checked" wire:click='updateGiftManage({{$item->id}})'
                                                                    type="checkbox" {{ $item->is_checked == 1 ? 'checked' : '' }} id="flexCheckDefault" >
                                                                </td>
                                                                @if (Auth::user()->user_title != 'Associate')
                                                                    <td>
                                                                        <div class="filter-sec-manage-programs select-menu-one">
                                                                            <select wire:model="action_value" class="select_item_class" wire:change='itemAction({{$item->id}})'>
                                                                                <option value="" class="btn btn-sm btn-clean btn-icon btn-icon-md">...
                                                                                </option>
                                                                                <option value="Edit{{$item->id}}" >Edit</option>
                                                                                @if ($item->status == 1)
                                                                                <option value="Remove{{$item->id}}">Remove</option>
                                                                                @else
                                                                                <option value="Re-add{{$item->id}}">Re-Add</option>
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
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
            </div>

    {{-- start Item Add Modal --}}
    <div wire:ignore.self class="modal fade" id="Add-Item-Service" tabindex="-1" aria-labelledby="Add-Item-ServiceLable" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body white-modal text-left">
                        <div class="d-flex justify-content-between">
                            <h1>Item And Service Database</h1>
                            <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        @if(Auth::user()->user_title != 'Associate')
    
                            <div class="Gimmzi-Gift-Manager ">
                                <div class="btn_title">
                                    <h2 id="collapsetitle">Add an item or service to database</h2>
                                </div>
                            </div>
                            <div id="itemserviceform" >
                                <form method="post" name="itemForm" wire:submit.prevent='addItemService'>
        
                                    <div class="Gimmzi-Gift-Manager ">
                                        <h2>Enter the name of item or service below</h2>
                                        <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                            wire:model="item_name" />
                                    </div>
                                    @error('item_name')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <div class="row value-of-this-gift">
                                        <div class="col-sm-6">
                                            <h3>Enter the Value of this Item</h3>
                                            <h4>the amount the customer would normally pay</h4>
                                            <div class="customer-input">
                                                <label>$</label>
                                                <input type="text" wire:model="value_one" id="value_one" class="value-input-text" />
                                                <label>.</label>
                                                <input type="text" wire:model="value_two" id="value_two" class="value-input-text" />
                                            </div>
                                            @error('value_one')
                                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                            <br>
                                            @error('value_two')
                                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <h3>Notes (Optional)</h3>
                                            <textarea class="note-text" wire:model="note" id="note"></textarea>
                                            @error('note')
                                                <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="ajax_response" style="float:left">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group multi-select" wire:ignore>
                                        <label for="" style="color:black;">Participating
                                            Location(s)</label>
                                        <select  class="select-item " wire:model.defer="participating_location_ids"
                                            id="participating_location_id" multiple style="padding-bottom:18px!important;">
                                            <option value="" disabled>Select locations</option>
                                            @if ($business_locations)
                                                @foreach ($business_locations as $locations)
                                                <option value="{{ $locations->id }}">
                                                    {{ $locations->address }},
                                                    {{ $locations->city }},
                                                    @if($locations->state_id == null)
                                                        {{$locations->state_name }},
                                                    @else
                                                        {{$locations->states->name }},
                                                    @endif
                                                    {{ $locations->zip_code }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('participating_location_ids')
                                        <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <div class="gift-database-main">
                                        <div class="d-flex justify-content-between">
                                            <h3></h3>
                                            
                                            <div class="filter-sec-manage-programs">
                                           
                                                <button type="submit" id="submit_item">Add To Database</button>
        
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        
                        {{-- <div class="smart-rewards">
                            <h1>Smart Rewards Family & Friends Gift</h1>
                            <div class="gift-database-table mt-4">
                                <div class="table-manage-program-sec">
                                    <table class="gift-table-main table">
                                        <thead>
                                            <tr>
                                                <td>Status</td>
                                                <td>name of Gift</td>
                                                <td>Notes</td>
                                                <td>Value</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Active</td>
                                                <td>Free Appetizer</td>
                                                <td>&nbsp;</td>
                                                <td><a href="#" class="view-value">View
                                                        Value</a></td>
                                                <td><a href="#" class="turn-on-one">Turn
                                                        on</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    {{-- end Item Add Modal --}}

    {{-- start Item edit Modal --}}
    <div wire:ignore.self class="modal fade" id="edit-Item-Service" tabindex="-1" aria-labelledby="edit-Item-ServiceLable" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body white-modal text-left">
                    <div class="d-flex justify-content-between">
                        <h1>Item And Service Database</h1>
                        <button class="cancel-button" data-bs-dismiss="modal">CANCEL</button>
                    </div>
                    @if(Auth::user()->user_title != 'Associate')

                        <div class="Gimmzi-Gift-Manager ">
                            <div class="btn_title">
                                <h2 id="collapsetitle">Update an item or service to database</h2>
                            </div>
                        </div>
                        <div id="itemserviceform" >
                            <form method="post" name="itemFormEdit" wire:submit.prevent='editItemService'>
    
                                <div class="Gimmzi-Gift-Manager ">
                                    <h2>Enter the name of item or service below</h2>
                                    <input type="text" class="Gimmzi-Gift-Manager-input" placeholder="Example: Large Drink"
                                        wire:model="item_name" />
                                </div>
                                @error('item_name')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="row value-of-this-gift">
                                    <div class="col-sm-6">
                                        <h3>Enter the Value of this Item</h3>
                                        <h4>the amount the customer would normally pay</h4>
                                        <div class="customer-input">
                                            <label>$</label>
                                            <input type="text" wire:model="value_one" id="value_edit" class="value-input-text"
                                        style=" width: 129px;" />
                                        </div>
                                        @error('value_one')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                        <br>
                                        @error('value_two')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <h3>Notes (Optional)</h3>
                                        <textarea class="note-text" wire:model="note" id="note"></textarea>
                                        @error('note')
                                            <span class="invalid-message frontend-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="ajax_response" style="float:left">
                                        
                                    </div>
                                </div>
                                
                                <div class="gift-database-main">
                                    <div class="d-flex justify-content-between">
                                        <h3></h3>
                                        
                                        <div class="filter-sec-manage-programs">
                                       
                                            <button type="submit" id="submit_item">Update To Database</button>
    
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

{{-- end Item edit Modal --}}

    {{-- start remove confirm modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_confirm_modal" tabindex="-1"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="confirm_msg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn" style="display: flex;justify-content: center;">
                            <div class="btn_foot_end centr" style="padding-right: 11px;">
                                <button class="btn_table_s rdd auto_wd closeModal" >No</button>
                            </div>
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" wire:click='removeItem'>Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end remove confirm modal --}}
    {{-- start success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3 id="textmsg"></h3>
                            </div>

                            <div class="cmn_secthd_modals_btnnn">
                                
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd closeModal">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        {{-- end success modal --}}

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.addEventListener('livewire:load', function (event) {
                window.livewire.on('openItemServiceModal',function() {
                    $('#Add-Item-Service').modal('show');
                });
                window.livewire.on('editModal',function() {
                    $('#edit-Item-Service').modal('show');
                });
                window.livewire.on('messageModal',data=> {
                    $('#message_modal').modal('show');
                    $('#textmsg').text(data.text);
                });

                window.livewire.on('confirmModal',data=> {
                    $('#remove_confirm_modal').modal('show');
                    $('#confirm_msg').text(data.text);
                });
                 
            });
            $(".closeModal").on('click',function(){
                $('#message_modal').modal('hide');
                $("#textmsg").html('');
                location.reload();
            })
            window.livewire.on('select2', () => {
                initTicketTypesDrop();
            });
            // initTicketTypesDrop();
            $(document).ready(function() {
                window.initTicketTypesDrop = () => {
                    $("#participating_location_id").select2({
                            tags: true,
                            tokenSeparators: [',', ' '],
                            allowClear: true
                    });
                }

                $('#participating_location_id').on('change', function (e) {
                    var data = $('#participating_location_id').select2("val");
                    console.log(data);
                    @this.set('participating_location_ids', data);
                });
            });
           
            
        </script>
    @endpush
</div>
