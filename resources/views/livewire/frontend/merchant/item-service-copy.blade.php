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
                                <figure><img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}"
                                        alt=""></figure>
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
            <div class="copyclass" >
                <div class="add_new_user_sctn gap_cmnn btm_gap_none">
                    <div class="add_new_user_sctn_top">
                        <div class="container">
                            <div class="add_usern_sctn_top_wrap">
                                <div class="add_usern_sctn_top_wrap_lft">
                                    <div class="user_scn_form">
                                        <h3 class="user_main_location">Item & Service Database Copy</h3>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <div class="database_copy_outersd">
                        <div class="database_copy_outersd_top">
                            <div>
                                <div class="custom_select_style">
                                    <select wire:model="source_location" wire:change='getSourceLocation'>
                                        <option value=""  selected>Choose Source Location</option>
                                        @if($business_locations)
                                        @foreach ($business_locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->address }},
                                            {{ $location->city }},
                                            @if($location->state_id == null)
                                                {{$location->state_name }},
                                            @else
                                                {{$location->states->name }},
                                            @endif
                                            {{ $location->zip_code }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="custom_select_style">
                                    <select wire:model="destination_location" wire:change='getDestinationLocation'>
                                        <option>Choose Destination Location</option>
                                        @if($destination_locations)
                                        @foreach ($destination_locations as $destination)
                                        <option value="{{ $destination->id }}">{{ $destination->address }},
                                            {{ $destination->city }},
                                            @if($destination->state_id == null)
                                                {{$destination->state_name }},
                                            @else
                                                {{$destination->states->name }},
                                            @endif
                                            {{ $destination->zip_code }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div>
                                <div class="custom_select_btnn">
                                    <a href="javascript:void(0)" class="btn_table_s blu" wire:click='completeCopy'>Complete Copying</a>
                                </div>
                            </div>
                        </div>

                        <div class="database_copy_outersd_mdl">
                            <div class="custom_check_ntt">
                                <input type="checkbox" class="form-check-input" id="checkedbx1 "
                                    wire:click="setCopyPrice">
                                <label for="checkedbx1"> Do Not Copy Value With Item & Service</label>
                            </div>
                        </div>

                        <div class="database_copy_outersd_btmmmd">
                            <div class="row database_copy_outersd_btmmmd_row gy-4">
                                <div class="col-xl-5">
                                    <div class="street_dtls_wshntn custom_form_dsgn_pop_col">
                                        <input type="text" wire:model="source_location_details" placeholder="" readonly>
                                    </div>

                                    <div class="table_cmn_part_sgn">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Item & Service</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if(count($source_items) > 0)
                                                    @foreach($source_items as $key => $s_item)
                                                        <tr>
                                                            <td>
                                                                <div class="custom_checked_box" wire:ignore>
                                                                    <input class="form-check-input" name="source_checked_item" type="checkbox" id="flexCheckDefault{{$s_item->itemservice->id}}" wire:click = "sourceItem({{$s_item->itemservice->id}})">
                                                                </div>
                                                            </td>
                                                            <td>{{$s_item->itemservice->item_name}}</td>
                                                            <td>{{$s_item->itemservice->item_price->price}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-2">
                                    <a href="javascript:void(0)" wire:click='copyToDestination' class="btn_table_s blu ht_sm_inp">Copy</a>

                                </div>

                                <div class="col-xl-5">
                                    <div class="street_dtls_wshntn custom_form_dsgn_pop_col">
                                        <input type="text" wire:model="destination_location_details" placeholder="" readonly>
                                    </div>

                                    <div class="table_cmn_part_sgn">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Item & Service</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            @if(count($destination_items) > 0)
                                                @foreach($destination_items as $key => $d_item)
                                                    <tr>
                                                        <td>
                                                            <div class="custom_checked_box">
                                                                {{-- <input class="form-check-input" name="item_checked" type="checkbox"value="" id="flexCheckDefault{{$d_item->itemservice->id}}" data-id =""> --}}
                                                            </div>
                                                        </td>
                                                        <td>{{$d_item->itemservice->item_name}}</td>
                                                        <td>{{$d_item->itemservice->item_price->price}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if(count($copied_item) > 0)
                                                @foreach($copied_item as $key => $copy_item)
                                                    <tr>
                                                        <td>
                                                            <div class="custom_checked_box">
                                                                {{-- <input class="form-check-input" name="item_checked" type="checkbox"value="" id="flexCheckDefault{{$copy_item->id}}" data-id =""> --}}
                                                            </div>
                                                        </td>
                                                        <td>{{$copy_item['item_name']}}</td>
                                                        @if($do_not_copy == false)
                                                            <td>{{$copy_item['item_price']['price']}}</td>
                                                        @else
                                                            <td>N/A</td>
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
            <div class="copy-button-class">
                <div class="btn_foot_end">
                    <a href="javascript:void(0)" class="btn_table_s grn" wire:click="undoCopy">Undo Copy</a>
                    <a href="javascript:void(0)" class="btn_table_s rdd" id="edit_item_value">Edit Value</a>
                </div>
            </div>
            

        </div>

    </div>

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
        <script>
            document.addEventListener('livewire:load', function (event) {
                window.livewire.on('messageModal',data=> {
                    $('#message_modal').modal('show');
                    $('#textmsg').text(data.text);
                });

                $(".closeModal").on('click',function(){
                    $('#message_modal').modal('hide');
                    $('#textmsg').text('');
                })
            });
        </script>
    @endpush
</div>
