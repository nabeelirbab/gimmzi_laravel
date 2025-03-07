<div>
    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="left-sec-home">
                        <figure>
                            <img src="{{ asset('frontend_assets/images/rental-home-icon-1.svg') }}" alt="" />
                        </figure>
                    </div>
                   
                    <div class="right-sec-rental">
                        <h3><span
                            id="change_first">{{ $property_name }}</span>
                            <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach ($propertyDetails as $property)
                                        <li><a class="property_provider" id="property_provider"
                                                href="javascript:void(0);" wire:click.prevent='getpropertyDetail({{$property->provider->id}})'>{{ $property->provider ? $property->provider->name : '' }}</a>
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
                                                    id="property_address">{{ $address }}</label></span>
                                        </h6>
                                    </div>
                                    <div class="apartment-right-data">
                                        <h6>
                                            <span class="icon-img-sec-rental"><img
                                                    src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                    alt="" /></span>Mail:<span
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
                                                id="distributePoint">{{ $point }}
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
        <div class="first-smart-rental-sec">
            <div class="container">
                
                <h2>Low Point Balance Member Search</h2>
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
                               <button type="button" class="btn green_btn" wire:click='addPoint(200)' value="200" style="color: #fff;">Add 200 Points to these members</button>
                            </div>
                            <div class="form-check add_point_member" style="width:auto;">
                                <button type="button" class="btn green_btn"  wire:click='addPoint(400)' value="400" style="color: #fff;">Add 400 Points to these members</button>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex justify-content-end align-items-center filter-main">
                            <select class="form-select" wire:model = "point_status" wire:change='changePointStatus' aria-label="Default select example">
                                <option value="all">All Point Counts</option>
                                <option value="low_to_high">Point Count - Lowest to Highest</option>
                                <option value="high_to_low">Point Count - Highest to Lowest</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 smart-rentel-db" id="ajaxrentaldbtable">
                        <div class="scroll_table">
                            <table class="table table-striped table-hover">
                                <thead>
                                      <tr>
                                        <th scope="col">
                                           
                                        </th> 
                                        <th scope="col">Resident</th>
                                        <th scope="col">Building Name</th>
                                        <th scope="col">Unit</th>
                                        
                                        {{-- <th scope="col">Signed Up</th> --}}
                                        <th scope="col">Lease End Date</th>
                                        <th scope="col">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                @if($users)
                                    @foreach($users as $user) 
                                        {{-- @dd($user) --}}
                                            <tr class="low_balance_member">
                                            @if($user['consumer_id'] != '')
                                            <td><input class="form-check-input" type="radio" name="unit" value="{{$user['consumer_id']}}" wire:click='selectUser({{$user['consumer_id']}})'/></td>
                                            @endif
                                            <td>{{$user['primary_member']}}</td>
                                            <td>{{$user['building_name']}}</td>
                                            <td>{{$user['unit']}}</td>
                                            {{-- <td>{{$user['signed_up']}}</td> --}}
                                            {{-- <td>{{$user['account_term_date']}}</td> --}}
                                           <td> {{ $user['account_term_date'] ? date('m-d-Y', strtotime($user['account_term_date'])) : 'N/A' }}</td>
                                            <td style="color:red">{{$user['point']}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                        @if($provider_settings->low_point_balance != '')
                                            <tr>
                                                <td colspan="4" style="text-align: center;">Low point balance point limit is set to: {{$provider_settings->low_point_balance}} points</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" style="text-align: center;">There are no members with low point balances</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td colspan="4" style="text-align: center;">There are no members with low point balances</td>
                                            </tr>
                                        @endif
                                @endif
                                </tbody>
                            </table>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="btn_area_section">
                            <span> Action </span>
                            <button type="button" class="btn green_btn" wire:click='addPointToConsumer' >Add Points</button>
                            {{-- <button type="button" class="btn red_btn deactive" >Deactivate</button> --}}
                            {{-- <button type="button" class="btn sky_btn add_term" wire:click='addTermToConsumer'>Add term</button> --}}
                            <button class="btn yellow_btn" wire:click='viewconsumerProfile'>View profile</button>
                            <a href="{{route('frontend.smart-rental-db')}}"  class="btn purple_btn">Go to Complete Smart Rental Database</a>
                            <div id="success_message" class="ajax_response" style="float:left"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="pointaddmessage_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <p>Are you sure you would like to <span style="font-weight: 800;"> Add {{$amount}} points </span> to each of these members?</p>
                        <p>{{$message2}}</p>
                        <p>{{$message3}}</p>
                        <input type="hidden" value="" id="pointadded">
                    </div>

                    <div class="row we-want-text1">
                        <div class="col-sm-12 text-center">
                            <button class="cancel-button44" style="background: red;border: 1px solid #ff2719;" onclick="location.reload();" type="button">No</button>
                            <button class="send-button-one4" wire:click='yesAddPointToMember' type="button" >Yes</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade points_add_modal" id="errorModal" tabindex="-1" aria-labelledby="errorModallLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <p id="error_msg" style="font-size: 23px;"></p>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function(event) {
            @this.on('pointAddPopup', function(){
                $('#pointaddmessage_modal').modal('show');
            });
            @this.on('sucesspopup', data=>{
                $('#errorModal').modal('show');
                $('#pointaddmessage_modal').modal('hide');
                $("#error_msg").html(data.msg);
            });
        });
    </script>
    @endpush
</div>
