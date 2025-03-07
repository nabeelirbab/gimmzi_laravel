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
                <h2>Low Point Balance Member Search</h2>
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
                                                    alt="" />
                                            </span>
                                            <strong>Address:</strong>
                                            &nbsp;<span>
                                                <label>{{ $user->travelType->address }}</label>
                                            </span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" />
                                            </span>
                                            <strong>Mail:</strong>
                                            <span class="points-distributed-txt">{{ $user->email }}</span>
                                        </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="left-apartments-data">
                                        <h6>
                                            <span class="icon-img-sec-rental">
                                                <img src="{{ asset('frontend_assets/images/star-icon-rental.svg') }}"
                                                    alt="" />
                                            </span>Total Points to Distribute:
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
                            </div>
                            <div class="form-check add_point_member" style="width:auto;">
                                <button type="button" class="btn green_btn" wire:click='addPoint(200)'
                                    {{ count($data) > 0 ? '' : 'disabled' }} style="color: #fff;">Add 200 Points to
                                    these
                                    members</button>
                            </div>
                            <div class="form-check add_point_member" style="width:auto;">
                                <button {{ count($data) > 0 ? '' : 'disabled' }} type="button" class="btn green_btn"
                                    value="400" wire:click='addPoint("400")' style="color: #fff;">Add 400 Points to
                                    these members</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        {{-- <div class="col-sm-3"> --}}
                            <div class="d-flex justify-content-end align-items-center filter-main">
                                <select class="form-select" wire:model = "point_status" wire:change='changePointStatus' aria-label="Default select example">
                                    <option value="all">All Point Counts</option>
                                    <option value="low_to_high">Point Count - Lowest to Highest</option>
                                    <option value="high_to_low">Point Count - Highest to Lowest</option>
                                </select>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="table_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 smart-rentel-db" id="ajaxrentaldbtable">
                        <div class="scroll_table smart-badge-table">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                           
                                        </th> 
                                        <th scope="col" style="padding: 20px 8px;">Guest</th>
                                        <th scope="col" style="padding: 20px 8px;">Listing Name</th>
                                        <th scope="col" style="padding: 20px 8px" class="smart-address-th">
                                            Address</th>
                                        {{-- <th scope="col" style="padding: 20px 8px;">Check in</th> --}}
                                        <th scope="col" style="padding: 20px 8px;">Check out Date</th>
                                        <th scope="col" style="padding: 20px 8px">POINTS</th>
                                        {{-- <th scope="col" style="padding: 20px 8px;">Badge status</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $list)
                                        <tr>
                                            <td><input class="form-check-input" type="radio" name="unit" value="{{$list['guest_id']}}" wire:click='selectUser({{$list['guest_id']}})'/></td>
                                            @if (isset($list['guest']))
                                                <td>{{ $list['guest']['full_name'] ?? 'N/A' }}</td>
                                            @else
                                                <td>{{ $list['guest_email'] ?? 'N/A' }}</td>
                                            @endif
                                            

                                            <td>{{ $list['listing']['name'] ?? 'N/A' }}</td>
                                            <td class="smart-address-th">
                                                {{ $list['listing']['street_address'] ?? 'N/A' }}</td>
                                            {{-- <td>{{ $list['checkin_date'] ? date('m-d-Y', strtotime($list['checkin_date'])) : 'N/A' }}
                                            </td> --}}
                                            <td>{{ $list['checkout_date'] ? date('m-d-Y', strtotime($list['checkout_date'])) : 'N/A' }}
                                            </td>
                                            <td style="color:red">{{ $list['guest']['point'] ?? 'N/A' }}</td>
                                            {{-- @if ($list['badge_status'] == true)
                                                <td>
                                                    <span style="color: green">Accepted</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span>Badge sent by {{ auth()->user()->first_name }} on
                                                        {{ date('m-d-Y', strtotime($list['created_at'])) }}
                                                    </span>
                                                </td>
                                            @endif --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="padding-left: 35rem">No members found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="vacation_page_next_prev_btn">
                            {{ $data->links() }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="btn_area_section">
                            <span> Action </span>
                            <button type="button" class="btn green_btn" wire:click='addPointToConsumer' >Add Points</button>
                            {{-- <button type="button" class="btn red_btn deactive" >Deactivate</button> --}}
                            {{-- <button type="button" class="btn sky_btn add_term" wire:click='addTermToConsumer'>Add term</button> --}}
                            <button class="btn yellow_btn" wire:click='viewconsumerProfile'>View profile</button>
                            <a href="{{route('frontend.smart_guest_database')}}"  class="btn purple_btn">Go to Guest Database</a>
                            <div id="success_message" class="ajax_response" style="float:left"></div>
                        </div>
                    </div>

                    

                   
                </div>
            </div>
        </div>
    </div>


    {{-- Add point modal start --}} 
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="pointaddmessage_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">

                            <p>Are you sure you would like to <b>Add {{ $points }} points</b> to each of these
                                members?</p>

                            <p>Total Members: {{ $members }} members</p>
                            <p>Total points to be added: {{ $total_points }} points</p>
                        </div>
                        <div class="row we-want-text1">
                            <div class="col-sm-12 text-center">
                                <button class="cancel-button44" style="background: red;border: 1px solid #ff2719;"
                                    onclick="location.reload();" type="button">No</button>
                                <button class="send-button-one4" type="button"
                                    wire:click='addPointPost'>Yes</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add point modal end --}}

    {{-- Add point success modal start --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>{{ $success_message }}</h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd"
                                    onclick="window.location.reload();">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Add point success modal end --}}
    <div wire:ignore.self class="modal fade points_add_modal" id="errorModal" tabindex="-1" aria-labelledby="errorModallLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <p id="error_msg" style="font-size: 23px;"></p>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function(event) {
            @this.on('add_point', data => {
                $("#pointaddmessage_modal").modal('show');
            });
            @this.on('sucesspopup', data => {
                // $('#message_modal').modal('show');
                $("#pointaddmessage_modal").modal('hide');
                $('#errorModal').modal('show')
                $("#error_msg").html(data.msg);
            });
        })

        // document.addEventListener('livewire:load', function(event) {
        //     @this.on('pointAddPopup', function(){
        //         $('#pointaddmessage_modal').modal('show');
        //     });
        //     @this.on('sucesspopup', data=>{
        //         $('#errorModal').modal('show');
        //         $('#pointaddmessage_modal').modal('hide');
        //         $("#error_msg").html(data.msg);
        //     });
        // });
    </script>
@endpush
</div>
