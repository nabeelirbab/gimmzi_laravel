<div>
    <div id="property-manage-search" class="all-smart-rental-database-main-sec">
        {{-- <div class="property-manage-search">
            <div class="container">
                <h2>Search Smart Travel Database</h2>
                <div class="propert-search-main">
                    <input type="text" class="search-input dropdown-toggle custom-droup-down search"
                        placeholder="Search tenant using First Name, Last Name, or Unit Number....." id="autocomplete" />
                        <input type='hidden' id='selectitem_id' />
                    <button class="search-button searchConsumer"></button>
                </div>
            </div>
        </div> --}}
    </div>
    <div id="alen-park-contain">
        <div class="container">
            <div class="alen-park-contain">
                <div class="allen-img-main">
                    <img src="{{ $user->travelType->hotel_image }}" class="alen-img" />
                </div>
                <div class="middle-smart-rental-sec">
                    <div class="right-sec-rental">
                        <h3><span id="change_first"></span>
                            <span class="dropdown top-droup-down-menu">
                                <button class="dropdown-toggle custom-droup-down" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                        class="" /> -->
                                </button>
                                <h1>{{$user->travelType->name}}</h1>
                            </span>
                        </h3>


                        <p class="alen-park-text1 img-b-space1">
                            <span class="p-responsive-main location-image-icon img-b-space1">
                                <label>Address: </label>&nbsp; <label>{{$user->travelType->address}}, {{$user->travelType->zip_code}}</label>
                            </span>

                            <span class="p-responsive-main">
                                <span class="mail-image-icon"></span> <label>Mail:</label>&nbsp;<a
                                    href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                            </span>
                        </p>
                        <p class="alen-park-text1 alen-park-text1 star-image-icon"><label>Total Points to
                                Distribute:</label>&nbsp;<span
                                class="alen-park-text1">{{number_format($user->travelType->points_to_distribute)}}
                                Points</span>


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
                                <a href="{{ route('frontend.hotel_resort.smart-rental-db') }}">
                                    <img src="{{ asset('frontend_assets/images/icon9.svg') }}" class="cat-left-icon" />
                                    Smart Guest Database
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('frontend.hotel_resort.low-point-member') }}"> <img src="{{ asset('frontend_assets/images/icon11.svg') }}"
                                        class="cat-left-icon" />
                                    <span>Low Point Balance Member Search</span> </a>
                            </li>
                            <li>
                                <a href="{{route('frontend.hotel_resort.message_board')}}"> <img
                                        src="{{ asset('frontend_assets/images/icon10.svg') }}" class="cat-left-icon" />
                                    Message Boards </a>
                                    
                            </li>
                        
                        
                            <li>
                                <a href="{{route('frontend.hotel_resort.smart_access_management')}}"> <img src="{{ asset('frontend_assets/images/icon13.svg') }}"
                                        class="cat-left-icon" />
                                    User Access Management</a>
                            </li>

                            <li>
                                <a href="javascript:void(0);" >
                                    <img style="height: 44px; width: 33px;"
                                                src="{{ asset('frontend_assets/images/reports_copy.svg') }}"
                                                class="cat-left-icon" />
                                    Reports</a>
                            </li>
                            <li>
                                <a href="#"> <img src="{{ asset('frontend_assets/images/b.svg')}}" class="cat-left-icon" />
                                    <span> Gimmzi Gift pack <br />
                                    <span class="text-one11">(Coming Soon)</span> </span> </a>
                            </li>

                            <li>
                                <a href="{{route('frontend.hotel_resort.settings')}}"> <img
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
    <div wire:ignore.self class="modal fade merchent-main-madal" id="changepasswordModal" tabindex="-1"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Change Your Password</h2>
                    </div>
                    <form  wire:submit.prevent = "changeUserPassword">
                        <div class="merchent-input">
                            <input type="password" placeholder="New Password" wire:model.defer="new_password" name="new_password" />
                            @error('new_password')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                @enderror
                        </div>
                        <div class="merchent-input">
                            <input type="password" placeholder="Confirm Password" wire:model.defer="confirm_password"
                                name="confirm_password" />
                                @error('confirm_password')
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                            @enderror
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
            @if(Auth::user()->created_password != '')
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
            $(document).ready(function() {
                $('#property_provider').change(function (e) {
                    var id = $(this).attr('data-property_id');
                    console.log(id)
                });
            });
               
        </script>
    @endpush
</div>
