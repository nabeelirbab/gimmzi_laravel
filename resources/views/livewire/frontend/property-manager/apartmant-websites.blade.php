<div>
    <div class="allen-park-apartments-main-sec">
        <div class="allen-part-apartments-sec">
            <div class="first-goback-search-sec">
                <div class="container">
                    <div class="btn-go-search-apartments">
                        <a href="{{ route('frontend.apartment.list') }}"><button><img
                                    src="{{ asset('frontend_assets/images/go-back-icon-1.svg') }}" alt="">Go
                                Back to search</button></a>
                    </div>
                </div>
            </div>

            <div class="middle-park-main-middle-sec">
                <div class="container">
                    <div class="middle-park-apartments-sec-main">
                        <div class="left-middle-park-main-sec">
                            <div class="left-middle-park-sec left-middle-park-sec">
                                <figure>
                                    {{-- <img src="{{ $provider->main_image }}" alt="" /> --}}
                                    {{-- <img src="{{ asset('frontend_assets/images/allen-park-icon-11.png') }}" alt=""> --}} 
                                    {{-- @dd($provider) --}}
                                    @if($provider->logo_img)
                                        <img src="{{ $provider->logo_img }}" style="width:100px; height:100px;" alt="">
                                    @endif
                                </figure>
                            </div>
                            <div class="right-middle-park-sec">
                                {{-- <h2>Allen Park Apartments</h2> --}}
                                <h2>{{$provider->name}}</h2>
                                <ul>
                                    <li><span><img
                                                src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                alt=""></span>{{$provider->address}} {{$provider->city}} {{$provider->address}} {{$provider->state}}, {{$provider->zip_code}}
                                                </li>
                                    <li><span><img src="{{ asset('frontend_assets/images/allen-park-icon-2.svg') }}"
                                                alt=""></span>{{$provider_phone_number}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="right-middle-park-main-sec map-it-button">
                                <button wire:click="toggleMap" class="features-a">
                                    @if($showMap)
                                    <img src="{{ asset('frontend_assets/images/smart-rental-1-icon.svg') }}" alt="Back Icon">
                                    @else
                                        <img src="{{ asset('frontend_assets/images/map-icon-allen.svg') }}" alt="Map Icon">
                                    @endif
                                    {{ $showMap ? 'Back' : 'Map it' }}
                                </button>
                        </div>
                    </div>

                    @if(!$showMap)
                        <div class="allen-part-tab-one-main">
                            <nav>
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Home</button>
                                    @if($contact_community)
                                        <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-community" type="button" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Contact Community</button>
                                    @else
                                    @endif
                                
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-floor" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Floor Plans</button>

                                    @if($lease_online)
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-lease" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Lease Online</button>
                                    @else
                                    @endif
                                    @if($resident_portal)
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-resident" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Resident Portal</button>
                                    @else
                                    @endif
                                    @if($direct_website)
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-website" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">Visit Direct Website</button>
                                    @else
                                    @endif
                                </div>
                            </nav>
                            <div class="tab-content allen-container-mid" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="allen-container-mid">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row allen-container-mid-one">
                                                    <div class="col-sm-5 allen-img-first1">
                                                        <img src="{{$provider->main_image}}"
                                                            class="allen-img-first" alt="">
                                                    </div>
                                                    {{-- <div class="col-sm-7 allen-small-img">
                                                        <div class="row">
                                                            @foreach($provider->photo_img as $imge)
                                                            <div class="col-sm-4 col-4"><img
                                                                    src="{{$imge}}"
                                                                    alt="">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div> --}}

                                                <div class="col-sm-7 allen-small-img">
                                                    <div class="row">
                                                        <div class="row allen-container-mid-one">
                                                        @foreach($provider->photo_img as $imge)
                                                            <div class="col-sm-4 col-4">
                                                                <a href="{{$imge}}" data-lightbox="provider-gallery">
                                                                    <img src="{{$imge}}" alt="">
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                    

                                                </div>
                                                <div class="row">
                                                    {{-- <div class="col-sm-12 featured-amenties-button">
                                                        <button class="features-m">Features</button>
                                                        <button class="features-a">Amenities</button>
                                                    </div> --}}
                                                    <div class="col-sm-12 featured-amenties-button">
                                                        <button class="features-m"
                                                            wire:click="showFeature">Features</button>
                                                        <button class="features-a"
                                                            wire:click="showAmenity">Amenities</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                @if($get_message != null)
                                                @if($get_message->message != null)
                                                <div class="move-in-Special">
                                                    <div class="move-in-Special-heading bg-color-special-one">
                                                        {{$get_message->messageBoard->title}}
                                                    </div>
                                                    <div class="move-spa-con">
                                                        {{strip_tags(html_entity_decode($get_message->message))}}
                                                    </div>
                                                </div>
                                                @endif
                                                @if($get_message->message2 != null)
                                                <div class="move-in-Special">
                                                    <div class="move-in-Special-heading bg-color-special-one">
                                                        {{$get_message->messageBoardtwo->title}}
                                                    </div>
                                                    <div class="move-spa-con">
                                                        {{strip_tags(html_entity_decode($get_message->message2))}}
                                                    </div>
                                                </div>
                                                @endif
                                                @endif
                                                @if($get_tanent_reward != null)
                                                <div class="move-in-Special">
                                                    <div class="move-in-Special-heading bg-color-special-ten">Tenant of the
                                                        month</div>
                                                    <div class="move-spa-con">
                                                        <div class="tenant-top-one">
                                                            <span>Month of {{date('F',strtotime($get_tanent_reward->reward_active_on))}}</span>
                                                            <a href="#">Congratulations!</a>
                                                        </div>
                                                        <div class="tenant-month-bottom-con">
                                                            <img  src="{{ asset('frontend_assets/images/trent-one1.png') }}" alt="">
                                                            {{-- <img src="{{ asset($get_tanent_reward->user->profile_photo_path) }}" alt="" /> --}}
                                                            <span>{{$get_tanent_reward->user->full_name}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-community" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <button class="features-a" onclick="window.open('{{$contact_community}}', '_blank');">Contact Community</button>
                                </div>
                                <div class="tab-pane fade" id="nav-floor" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <p><strong>Comming Soon</strong></p>
                                </div>

                                <div class="tab-pane fade" id="nav-lease" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <button class="features-a" onclick="window.open('{{$lease_online}}', '_blank');">Lease Online</button>
                                </div>
                                <div class="tab-pane fade" id="nav-resident" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <button class="features-a" onclick="window.open('{{$resident_portal}}', '_blank');">Resident Portal</button>
                                </div>
                                <div class="tab-pane fade" id="nav-website" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">
                                    <button class="features-a" onclick="window.open('{{$direct_website}}', '_blank');">Visit Direct Website</button>
                                </div>

                            </div>

                        </div>
                    @else
                    <div class="location-map allen-part-tab-one-main">
                        <span class="location-title">{{ $provider->address }}</span>
                        <figure id="provider_location" style="width: 1000; height: 550px; margin: 0;"></figure>
                        
                    </div>
                    @endif
                </div>
            </div>


        </div>
    </div>

    <div class="modal fade new_registration_badge_modal" data-bs-backdrop = 'static' keyboard = "false" id="registration_form_modal" tabindex="-1" aria-labelledby="new-registration-modalLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close new-registration-modal-close" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="mt-5 mb-3 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <p class="by-continue-text">Claim your {{ $provider->name }} badge to unlock
                        special deals and discounts in the local area
                    </p>
                    <div class="main-form">
                        <form id="badgeForm" method="post">
                            <div class="row">
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your email address <span>*</span></label>
                                    <input type="text" name="booking_email" class="booking_email"
                                            placeholder="Email Address*" />

                                    <span class="email_error" style="color: red;"></span>
                                </div> 
                                {{-- {{$register_data['type']}} --}}
                                <div class="col-sm-12 form-select1">
                                    <label for="">Your booking dates <span>*</span></label>
                                    <select style="margin-top: 10px !important;" class="badge_id">
                                        @if (count($badge_dates) > 0)
                                            <option value="">Please choose a schedule</option>
                                            @foreach ($badge_dates as $badge_data)
                                                <option value="{{ $badge_data['id'] }}">check-In
                                                    :-{{ $badge_data['start_date'] }} - check-Out
                                                    :-{{ $badge_data['end_date'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    <span class="badge_error" style="color: red;"></span>
                                    <input type="hidden" class="guest_id">
                                    <input type="hidden" class="provider_id" value ="{{$provider->id}}">
                                </div>
                                <!-- dd($register_data['first_name']); -->
                                <div class="registration_input registerForm" style="display: none">
                                    <div class="col-sm-12 form-select1">
                                        <label for="">First Name <span>*</span></label>
                                        <input type="text" class="booking_first_name"
                                            placeholder="First name*" />
                                        <span class="first_name_error" style="color: red;"></span>
                                    </div>

                                    <div class="col-sm-12 form-select1">
                                        <label for="">Last Name <span>*</span></label>
                                        <input type="text" class="booking_last_name"
                                            placeholder="Last name*" />
                                    </div>
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Phone Number <span>*</span></label>
                                        <input type="text" class="booking_phone"
                                        placeholder="Phone Number*" />
                                    </div>
                                    <div class="col-sm-12 form-select1">
                                        <label for="">Zip Code  <span>*</span</label>
                                            <input type="text" class="zip_code"
                                            placeholder="Zip Code*" />
                                        <span class="error"></span>
                                    </div>


                                    <div class="col-sm-12 birthday-optional-text1">
                                        Birthday (Optional)
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_month" class="consumer_birth_month">

                                                <option value=" " selected>Month</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_day" class="consumer_birth_day">
                                                <option value=" " disabled selected>Day</option>
                                                @for($i = 1; $i < 31; $i++)
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-select1">
                                            <select name="consumer_birth_year" class="consumer_birth_year">
                                                <option value=" " disabled selected>Year</option>
                                                @for($i = 1970; $i < date('Y'); $i++)
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <p class="p_text">Recieve additional points and deals on your birthday, We
                                        wanna celebrate with
                                        you!
                                    </p>
                                    <span id="signup2error"></span>

                                    <div class="col-sm-12 login-top-one1">
                                        <button class="reg_btn login-button-one" type="submit" >Claim Gimmzi Badge</button>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-12 login-top-one1 next-btn" style="display: none">
                                    <button class="reg_btn login-button-one" type="button" name="stepone"
                                        id="signupstep1">Next</button>

                                </div> --}}
                                <div class="trm_info">
                                    <p>By creating an accoun, you agree to our <a target="_blank"
                                            href="{{ route('frontend.privacy-policy') }}"> Privacy policy</a> and
                                        <a target="_blank" href="{{ route('frontend.terms-of-use') }}"> Terms of
                                            use</a>
                                    </p>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div data-bs-backdrop = 'static'  class="modal fade password_badge_modal" id="passwordModal" tabindex="-1"
        aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" />
                    </div>
                    <div class="mt-5 mb-3 popup-logo">
                    <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>                                                              
                    <div class="main-form">
                    <form id="guest_password_submit" method="post" action="">
                        <div class="row">
                            <div class="col-sm-12 form-select1">
                            <label for="">Password <span>*</span></label>
                                <input type="password" name="consumer_password" id="consumer_password" placeholder="Password" />
                            </div>
                            <div class="col-sm-12 form-select1">
                                <label for="">Confirm Password <span>*</span></label>
                                <input type="password" name="consumer_confirm_password" id="consumer_confirm_password" placeholder="Confirm Password" />
                            </div>
                            <span id="guest_password_error"></span>
                            <div class="col-sm-12 login-top-one1">
                                <button class="reg_btn login-button-one" type="submit" name=""  id="">Next</button>
                            </div>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>

     {{-- Thank You modal start --}}
     <div class="modal fade" id="thanksmodal" tabindex="-1" aria-labelledby="thanksmodalLabel" aria-hidden="true">
        <div class="modal-dialog homemodal modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('frontend_assets/images/cancell-one.svg') }}"
                            class="cancell-one11"></button>
                    <div class="text-center mt-4 mb-4 popup-logo">

                        <img src="{{ asset('frontend_assets/images/logosmart-reward.svg') }}" />
                    </div>
                    <div class="main-form">
                        <div class="all-done-one">
                            <h4>All done!</h4>
                            <p id="thanks_message1"></p>
                            <h5 id="thanks_message2"></h5>
                            <div class="go-out-text smart-reward-text">
                                <p> Go out on the town and use them at your favorite places to eat, have fun, shop and
                                    more</p>
                                <a href="" class="deals-button close_registration" style="color: #fff!important;">Start using
                                    Smart Rewards</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Thank You modal end --}}

    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="featureAmenityModal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr text-left">
                        <div class="cmn_secthd_modals">
                            <div class="feature-tab-wrapper">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" href="javascript:void(0);">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-secondary" id="about-tab" data-bs-toggle="tab"
                                            data-bs-target="#about" href="javascript:void(0);">Amenities</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <div class="feature-tab-body featuremanageList">
                                            @if (count($features) > 0)
                                                @foreach ($features as $feature_data)
                                                    <div class="feature-list">
                                                        <p>{{ $feature_data->feature_text }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="feature-list">
                                                    <p>There are no features</p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="about" role="tabpanel"
                                        aria-labelledby="about-tab">
                                        <div class="feature-tab-body">
                                            @if (count($amenities) > 0)
                                                @foreach ($amenities as $amenity_data)
                                                    <div class="feature-list">
                                                        <p>{{ $amenity_data->amenity_text }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="feature-list">
                                                    <p>There are no amenities</p>
                                                </div>
                                            @endif
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
                                    {{-- <button type="submit" class="btn_table_s grn addUpdateFeature" name="submit">Add</button> --}}
                                    <button class=" btn_table_s rdd" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('style')
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet" />
    @endpush
    @push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox.min.js"></script>


    @if (session()->has('apartmentbadge'))

        <script>
            $(function() {
                console.log('sdcsdcdsc');
                $("#registration_form_modal").modal('show');
            });

            
        </script>
    @endif
    <script async defer type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>
    <script>
         $(document).ready(function() { //Add this line (and it's closing line)
            $('.booking_email').on('blur', function() {
                $(".email_error").text('');
                $('.guest_id').val('');
                var email = $(this).val();
                $.ajax({
                    url: "{{ route('provider.apartment_guest_email_check') }}",
                    type: 'get',
                    data: {
                        'email': email
                    },
                    success: function(result) {
                        // $(".registerForm").css('display', 'none');
                        // $(".submitForm").css('display', 'none');
                        // if (result.success == true) {
                        //     $('.guest_id').val(result.data);
                        //     $(".submitForm").css('display', 'block');
                        // } else {
                        //     if (result.text == 'user_not_found') {
                        //         $(".registerForm").css('display', 'block');
                        //         $(".submitForm").css('display', 'block');
                        //     } else {
                        //         $(".email_error").text(result.text);
                        //     }
                        // }
                        console.log(result.success);
                        if(result.success == true){
                            $(".registerForm").css('display', 'block');
                            $(".submitForm").css('display', 'block');
                        }else{
                            $(".registerForm").css('display', 'none');
                            $(".submitForm").css('display', 'none');
                            $(".email_error").text(result.text);
                        }
                    }
                });
            });
        });
        
        $("#badgeForm").submit(function(e) {
            var badge = $('.badge_id').val();
            // console.log(badge);
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.badge_error').text('');
            $(".phone_error").text('');
            $(".last_name_error").text('');
            $(".first_name_error").text('');
            $(".zip_code").text('');
            

            // if ($('.guest_id').val() != '') {
            //     if ($('.badge_id').val() != '') {

            //         $.ajax({
            //             url: "{{ route('provider.apartment_guest_add_to_scheduled_badge') }}",
            //             type: 'POST',
            //             data: {
            //                 guest_id: $('.guest_id').val(),
            //                 email: $('.booking_email').val(),
            //                 badge_id: $('.badge_id').val(),
            //             },
            //             success: function(result) {
            //                 console.log(result);
            //                 if (result.status == true) {
            //                     $("#registration_form_modal").modal('hide');
            //                     $("#badge_success_modal").modal('show');
            //                     $("#badgesuccessmsg").text('Badge Accepted Successfully');
            //                 }
            //             }
            //         });
            //     } else {
            //         $('.badge_error').text('Please select a scheduled date');
            //     }
            // } else {
                if ($('.badge_id').val() != '') {
                    if ($(".booking_first_name").val() != '') {
                        if ($(".booking_last_name").val() != '') {
                            if ($(".booking_phone").val() != '') {
                                $.ajax({
                                    url: "{{ route('provider.apartment_guest_add_to_scheduled_badge') }}",
                                    type: 'POST',
                                    data: {
                                        // guest_id: $('.guest_id').val(),
                                        email: $('.booking_email').val(),
                                        badge_id: $('.badge_id').val(),
                                        booking_first_name: $('.booking_first_name').val(),
                                        booking_last_name: $('.booking_last_name').val(),
                                        booking_phone: $('.booking_phone').val(),
                                        zip_code: $('.zip_code').val(),
                                        provider_id: $('.provider_id').val(),

                                    },
                                    success: function(result) {
                                        console.log(result.status);
                                        if (result.status == true) {
                                            $("#registration_form_modal").modal('hide');
                                            $("#passwordModal").modal('show');
                                            // $("#badge_success_modal").modal('show');
                                            // $("#badgesuccessmsg").text('Badge Accepted Successfully');
                                        } 
                                    }
                                });
                            } else {
                                $('.phone_error').text('Give your phone number');
                            }
                        } else {
                            $('.last_name_error').text('Give your last name');
                        }
                    } else {
                        $('.first_name_error').text('Give your first name');
                    }

                } else {
                    $('.badge_error').text('Please select a scheduled date');
                }
            // }

        });

        $("#guest_password_submit").validate({
                rules: {
                        consumer_password: {
                        required: true,
                        minlength: 8,
                    },
                    consumer_confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: "#consumer_password"
                    },
                },
                messages: {
                    consumer_password: {
                        required: "Please enter a New password ",
                        minlength: "Password minimum length should be 8"
                    },
                    consumer_confirm_password: {
                        required: "Please enter Confirm password ",
                        minlength: "Password minimum length should be 8",
                        equalTo: "Confirm password should be equal to New password"
                    },
                }
        });

        $("#guest_password_submit").submit(function(e) {
            e.preventDefault();
            if($("#consumer_password").val() != ''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('provider.apartment-guest-password-submit') }}",
                    type: 'POST',
                    data: {
                        'consumer_password': $("#consumer_password").val(),
                        // 'user_token': $("#user_token").val(),
                        'consumer_confirm_password': $("#consumer_confirm_password").val(),
                    },
            
                    success: function(result)
                    {
                        if (result.status == 0) {
                            // $('#passwordModal').find('form').trigger(
                            //     'reset');
                            $('#passwordModal').modal('hide');
                            $("#thanksmodal").modal('show');
                            $("#thanks_message1").html(result.message1);
                            $("#thanks_message2").html(result.message2);
                            
                        }
                        else if(result.status == 1){
                            $("#guest_password_error").html(result.validation_errors).css('color',
                                'red');
                        }
                        
                    }

                });
            }
            
        });

        document.addEventListener('livewire:load', function(event) {

            @this.on('showListingFeature', function() {
                $("#featureAmenityModal").modal('show');
            });

            @this.on('showListingAmenity', function() {
                $("#featureAmenityModal").modal('show');
            });

            @this.on('openLocation', function() {
                setTimeout(function() {
                    var propertylat = '<?php echo $provider->latitude; ?>';
                    var propertylong = '<?php echo $provider->longitude; ?>';
                    var mapOptions2 = {
                        zoom: 10
                    };
                    promap = new google.maps.Map(document.getElementById('provider_location'),
                        mapOptions2);
                    var promarker;

                    promarker = new google.maps.Marker({
                        position: new google.maps.LatLng(propertylat, propertylong),
                        map: promap,
                        animation: google.maps.Animation.DROP,
                    });
                    promap.setCenter(promarker.getPosition());
                    promap.setZoom(10);
                }, 200);

            });
        });
        
    </script>    


    @endpush
</div>
