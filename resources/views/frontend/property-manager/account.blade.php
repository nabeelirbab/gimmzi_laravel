<x-layouts.provider-layout title="provider account">
    {{-- <div id="property-manage-search" class="all-smart-rental-database-main-sec">
        <div class="property-manage-search">
            <div class="container">
                <h2>Search Smart Rental Database</h2>
                <div class="propert-search-main">
                    <input type="text" class="search-input dropdown-toggle custom-droup-down search"
                        placeholder="Search tenant using First Name, Last Name, or Unit Number....." id="autocomplete" />
                        <input type='hidden' id='selectitem_id' />
                    <button class="search-button searchConsumer"></button>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="alen-park-contain">
        <div class="container">
            <div class="alen-park-contain">
                <div class="allen-img-main">
                    <img src="{{ asset('frontend_assets/images/image11.png') }}" class="alen-img" />
                </div>
                <div class="middle-smart-rental-sec">
                    <div class="right-sec-rental">
                        <h3><span
                                id="change_first">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}</span>
                            <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" /> -->
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
                                <label>Address: </label>&nbsp;<label
                                    id="property_address">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->address : '' }}</label>
                            </span>

                            <span class="p-responsive-main">
                                <span class="mail-image-icon"></span> <label>Mail:</label>&nbsp;<a
                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </span>
                        </p>
                        <p class="alen-park-text1 alen-park-text1 star-image-icon"><label>Total Points to
                                Distribute:</label>&nbsp;<span class="alen-park-text1">{{ number_format($propertyDetails->first()->provider->points_to_distribute) }}
                                points</span>

                    </div>
                    </p>
                </div>

            </div>

        </div>
    </div>
    <div id="section3">

        <div class="smart-contain-main">
            <div class="container">
                <div class="smart-rental-button">
                    <ul>
                            <li>
                                <a href="{{ route('frontend.smart-rental-db') }}">
                                    <img src="{{ asset('frontend_assets/images/icon9.svg') }}" class="cat-left-icon" />
                                    Smart Rental Database
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('frontend.tenant-recognation') }}"> <img
                                        src="{{ asset('frontend_assets/images/icon12.svg') }}" class="cat-left-icon" />
                                    Resident Recognition</a>
                            </li> --}}
                            <li>
                                <a href="{{route('frontend.low-point-balance-member')}}"> <img src="{{ asset('frontend_assets/images/icon11.svg') }}"
                                        class="cat-left-icon" />
                                    <span>Low Point Balance Member Search</span> </a>
                            </li>
                        <li>
                            <a href="{{ route('frontend.message-board') }}"> <img
                                    src="{{ asset('frontend_assets/images/icon10.svg') }}" class="cat-left-icon" />
                                Message Boards </a>
                                
                        </li>
                       
                       
                        <li>
                            <a href="{{route('frontend.smart-rental-access-management')}}"> <img src="{{ asset('frontend_assets/images/icon13.svg') }}"
                                    class="cat-left-icon" />
                                Smart Rental Access Management</a>
                        </li>


                        <li>
                            <a href="{{route('frontend.apartmet.community-report')}}"> <img src="{{ asset('frontend_assets/images/icon92.svg') }}"
                                    class="cat-left-icon" />
                               Reports</a>
                        </li>

                        <li>
                            <a href=""> <img src="{{ asset('frontend_assets/images/icon13.svg') }}"
                                    class="cat-left-icon" />
                               Gimmzi Gift Pack (coming soon)</a>
                        </li>

                        <li>
                            <a href="{{ route('frontend.corporate-settings') }}"> <img
                                    src="{{ asset('frontend_assets/images/icon14.svg') }}" class="cat-left-icon" />
                                Settings</a>
                        </li>

                    </ul>
                </div>
                <div class="have-text-one">
                    <a href="#">Having Technical issues? Submit a Trouble ticket here </a>
                </div>
            </div>
        </div>

    </div>

    {{-- change password modal --}}
    <div class="modal fade merchent-main-madal" id="changepasswordModal" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11">
                        {{-- <img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /> --}}
                    </div>
                    <div class="border_bottom">
                        <h2>Change Your Password</h2>
                    </div>
                    <form id="changepassword">
                        <div class="merchent-input">
                            <input type="password" placeholder="New Password" id="new_password" name="new_password" />
                            <span class="newerror"></span>
                        </div>
                        <div class="merchent-input">
                            <input type="password" placeholder="Confirm Password" id="confirm_password"
                                name="confirm_password" />
                            <span class="confirmerror"></span>
                        </div>
                        <div class="green-login-button">
                            <button type="submit" class="password_save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    
        <script>
            @if (Auth::user()->created_password != '')
                $(window).on('load', function() {
                    $('#changepasswordModal').modal('show');
                });
            @endif
            @if (!empty(Session::get('token')))
                $(window).on('load', function() {
                    $('#changepasswordModal').modal('show');
                });
            @endif
            
           
            $(document).on('click', '#property_provider', function() {
                var id = $(this).attr('data-property_id');
                //console.log($(this).attr('data-property_url'));
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('data-property_url'),

                    success: function(data) {
                        $('#change_first').text(data.name)
                        $('#property_address').text(data.address)
                        // $("#price_submit_button").val('Next $'+ data.total_price);
                        //  $("#total_price").val(data.total_price);
                    }
                });

            });
            // $(document).ready(function() {
            //     $('#property_provider').change(function (e) {
            //         var id = $(this).attr('data-property_id');
            //         console.log(id)
            //     });
            // });
                $("#changepassword").on('submit', function(e) {
                    e.preventDefault();
                    console.log($("#new_password").val());
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route("frontend.provider.change-password") }}',
                        type: "POST",
                        data: {
                            new_password: $("#new_password").val(),
                            confirm_password: $("#confirm_password").val(),
                        },
                        success: function(response) {
                            if (response.status == 4) {
                                setTimeout(() => {
                                    toastr.success(
                                        'Password updated successfully but mail not sent'
                                        );
                                    location.reload();
                                }, 500);
                                $(".newerror").html('');
                            } else if (response.status == 1) {
                                $(".confirmerror").html('');
                                setTimeout(() => {
                                    $('#changepasswordModal').modal('hide');
                                    toastr.success(
                                        'Password updated successfully and mail sent to your email address'
                                        );
                                }, 500);
                            } else if (response.status == 0) {
                                $(".confirmerror").html(
                                    'New password and confirm password does not matched').css(
                                    'color', 'red');
                            } else if (response.status == 2) {
                                $(".confirmerror").html('Confirm password field is required..').css(
                                    'color', 'red');
                            } else if (response.status == 3) {
                                $(".newerror").html('New password field is required..').css('color',
                                    'red');
                            }
                        }
                    });
                });
                
        </script>
    @endpush
</x-layouts.provider-layout>
