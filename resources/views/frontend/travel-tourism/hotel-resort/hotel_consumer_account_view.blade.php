<x-layouts.travel-tourism-layout title="provider account">
    @push('style')
    <style>
        .errorMsq {
            color: red !important;
            display: block;
        }
    </style>
    @endpush
    {{-- <div id="property-manage-search">
        <div class="property-manage-search">
            <div class="container">
                <h2>Search Smart Rental Database</h2>
                <div class="propert-search-main">
                    <input type="text" class="search-input"
                        placeholder="Search tenant using first name, last name or unit number" />
                    <button class="search-button"></button>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="building-park" class="building-parm-main">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="building-park-left">
                        <h2>{{$conUnit->guestbadges->unites->unitbuildings->building_name}}</h2>
                        <h4>{{$conUnit->guestbadges->unites->unit_name}}</h4>
                        <h4>1. {{$conUnit->user->full_name}}</h4>
                        @php $i = 2; @endphp
                        @if(count($consumer_unit) > 0)
                          @foreach($consumer_unit as $cunit)
                            <h4>{{$i}}. {{$cunit->user->full_name}} <a href="{{route('frontend.hotel.users.view.profile',$cunit->user_id)}}">View Profile</a></h4>
                            @php $i++; @endphp
                          @endforeach
                        @endif
                        <h4>{{$i}}. <a href="#" id="add_member">Add New Member</a></h4>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="building-park-mid">
                        <div class="row">
                            <div class="col-md-8 padding-right-space-0">
                                <div class="building-park-mid-main">
                                    <figure>
                                        @if($conUnit->user->getFirstMedia('consumerImages'))
                                            <img src="{{$conUnit->user->getFirstMedia('consumerImages')->getUrl()}}" style="border-radius: 13px;height:100%">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/icon-25.svg')}}" style="border-radius: 13px;height:100%">
                                        @endif
                                    </figure>
                                    <div class="building-park-mid-conatain">
                                        <h2>{{$conUnit->user->full_name}} </h2>
                                        <h4><img src="{{ asset('frontend_assets/images/icon29.svg')}}"> Gimmzi Smart Rewards Member Since :
                                           <span> {{date_format(date_create($conUnit->user->created_at),'m/d/Y')}}</span>
                                        </h4>
                                        <h4 class="w-100"><img src="{{ asset('frontend_assets/images/icon-27.svg')}}"> Total : <span id="total_consumer_point">{{number_format($conUnit->user->point)}} Points</span> </h4>
                                        <div class="w-100">
                                            {{-- <button class="deative-meber" id="deactive_member">Deactivate Member</button> --}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4 building-park-right-contain">
                                    <h4><img src="{{ asset('frontend_assets/images/mail-icon.svg')}}"> Mail:
                                        @php
                                            $email = $conUnit->user->email;
                                            $emailParts = explode('@', $email);

                                            if (count($emailParts) === 2) {
                                                $localPart = $emailParts[0];
                                                $firstChar = substr($localPart, 0, 1);
                                                $obfuscatedEmail = $firstChar.'**********.com';
                                            } else {
                                                $obfuscatedEmail = $email;
                                            }
                                        @endphp
                                    <a ></a>{{$obfuscatedEmail}}</a></h4>
                                    @if($conUnit->user->expiry_date != null)
                                    <?php $expirydate = date_format(date_create($conUnit->user->expiry_date),'m/d/Y')?>
                                       <h4><img src="{{ asset('frontend_assets/images/calender-11.svg')}}"> Term Date: <span id="termdate">{{$expirydate}}</span></h4>
                                    @endif
                                    
                                    <h4><img src="{{ asset('frontend_assets/images/call-16.svg')}}"> Phone: 
                                        @if($conUnit->user->phone)
                                            @php
                                                $phoneNumber = $conUnit->user->phone;
                                                $firstDigit = substr($phoneNumber, 0, 1);
                                                $phone = $firstDigit.'***-***-****';
                                            @endphp
                                        @else
                                            @php
                                                $phone = '';
                                            @endphp  
                                        @endif
                                       <a >{{$phone}}</a></h4>

                            </div>

                        </div>
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
                                <a href="javascript:void(0);" class="add_points" data-id ="{{$conUnit->user->id}}">
                                    <img src="{{ asset('frontend_assets/images/add-frame.svg')}}" class="cat-left-icon" />
                                    Add points</a>
                            </li>
                            <li>
                                {{-- <a href="{{route('frontend.hotel.user_recognation',$conUnit->user_id)}}" class=""><img src="{{ asset('frontend_assets/images/icon44.svg')}}" class="cat-left-icon" /> --}}
                                <a href="javascript:void(0);" class="guest_recognition"><img src="{{ asset('frontend_assets/images/icon44.svg')}}" class="cat-left-icon" />
                                    Guest Recognition  </a>
                            </li>
                            <li>
                                <a href="#"> <img src="{{ asset('frontend_assets/images/b.svg')}}" class="cat-left-icon" />
                                    <span> Gimmzi Gift pack <br />
                                    <span class="text-one11">For New guests</span><br />
                                    <span class="text-one11">(Coming Soon)</span> </span> </a>

                            </li>
                            {{-- <li>
                                <a href="javascript:void(0);" class=""> <img src="{{ asset('frontend_assets/images/b2.svg')}}" class="cat-left-icon" />
                                    Add term</a>
                            </li> --}}


                        </ul>
                    </div>
                    <div class="have-text-one">
                        <a href="#">Having Technical issues? Submit a Trouble ticket here </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal dolphing_cove_modal fade" id="addMemberModel" tabindex="-1" aria-labelledby="selectedSchedule" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="dolphincove_modal_title">{{ $unitName}} Badges</h3>
                    <a href="javascript:void(0);" class="refresh-btn refreshForm" id="refreshForm"><img src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt=""> Refresh</a>          
                </div>
                <div class="modal-body">
                    <div class="dolphing_cove_form">
                        <form>
                            <div class="row dolphin_row">
                                <div class="col-lg-6 dolphin_column input-date">
                                    <label>*Check-In</label>
                                    <input type="text" class="checkinDatePicker" name="checkin_date"
                                    value="{{$checkin_date}}"
                                    style="background-color: #e8e8e8;" disabled >
                                </div>
                                <div class="col-lg-6 dolphin_column input-date" wire:ignore>
                                    <label>*Check-Out</label>
                                    <input type="text" class="checkoutDatePicker" name="checkout_date"
                                    value="{{$checkout_date}}"
                                    style="background-color: #e8e8e8;" disabled >
                                </div>
                            </div>
                            <div class="dolphin-outer-wraper">
                                <div class="dolphin-cus-row">
                                    <div class="dolphin_column_left">
                                        <div class="dolphin_column_left_inner">
                                            <h4 class="dolphin_sub_title">Email Address <span
                                                    class="guest_count">({{ $guest_count }}/10)</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <input type="hidden" name="badge_id" value="{{$badge_id}}">
                                    <div class="dolphin_column_right">
                                        <div class="dolphin_column_left_inner">
                                            <h4 class="dolphin_sub_title">Badge Statuses</h4>
                                        </div>
                                    </div>
                                </div>
                              
                                @if (count($guests) > 0)
                                    @foreach ($guests as $key => $value)
                                        <div class="dolphin-cus-row">
                                            <div class="dolphin_column_left">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input">
                                                        @if ($value->status == 1)
                                                            <?php $parts = explode('.', $value->guest_email);
                                                            $username = $parts[0];?>
                                                            <span>{{ substr($username, 0, 1) . str_repeat('*', strlen($username) - 0) . '.' . $parts[1] }}</span>
                                                            
                                                        @else
                                                        
                                                            <span>{{ $value->guest_email }}</span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dolphin_column_right{{ $key }}">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input" style="margin-left: 28px;">
                                                        @if ($value->status == 0 && $value->is_resend == 1)
                                                            <span class="sky-text">Resent on
                                                                {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                        @elseif($value->status == 0)
                                                            <span class="sky-text">Invite Sent</span>
                                                        @elseif($value->status == 1)
                                                            <span class="text-green">Badge Activated</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                
                               
                                @if ($remaining_count > 0)
                                    @for ($i = 1; $i <= $remaining_count; $i++)
                                        <div class="dolphin-cus-row">
                                            <div class="dolphin_column_left">
                                                <div class="dolphin_column_left_inner">
                                                    <div class="dolphin_input" x-data="{ isOpen: false }">
                                                        <?php
                                                            $today = date('Y-m-d');
                                                        ?>
                                                        @if($today < $badge_checkout_date)
                                                            <input type="text" name="email_addresses.{{ $i }}"> 
                                                        @else
                                                            <input type="text" style="background-color: #e8e8e8;"
                                                            name="email_addresses.{{ $i }}" disabled>
                                                        @endif 
                                                        
                                                    </div>
                                                    @if ($errors->has('email_addresses.{{ $i }}'))
                                                        <span class="invalid-message" role="alert"
                                                            style="font-size: 12px; color:red;">
                                                            {{ $errors->first('email_addresses') }}
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="dolphin_column_right{{ $i }}"
                                            style="display:none;">
                                            <div class="dolphin_column_left_inner">
                                                <div class="dolphin_input" style="margin-left: 39px;">
                                                    <span class="sky-text">Invite Sent</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="page-btn page-btn-green-peas sendSelectedBadge" href="javascript:void(0);"
                   id="sendSelectedBadge">Send Badge</button>
                <a class="page-btn page-btn-red closeSelectedBadge" href="javascript:void(0);"
                    id="closeSelectedBadge">Close</a>
                <a class="page-btn page-btn-blue clearBadgeDates" href="javascript:void(0);" id="clearBadgeDates"> Clear
                    Dates</a>
            </div>
            <div class="row">
                {{-- <span style="text-align: center;margin-top: 20px;">Use<a wire:click="resendBadge" style="color: blue;" href="javascript:void(0);"> Resend </a>to resend badge invites</span> --}}
            </div>

        </div>
    </div>
    </div>

    <div class="modal fade deactivate_modal_1" id="deactiveModal" tabindex="-1"  aria-labelledby="deactiveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom pb-3">
                        <h6>Are You Sure you Want To Deactivate this Member?</h6>
                        <p>By deactivating this member, they will no longer have access to Smart</p>
                        <p>Rentals. This action cannot be undone</p>
                    </div>
                    <div class="d-flex justify-content-between mt-5 allen-park-apartments-button">
                        <button type="button" class="btn next_btn consumer_deactivate">
                            Yes
                        </button>
                        
                        <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade memberAddModal" id="memberAddModal" tabindex="-1"
        aria-labelledby="memberAddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-body">
                    <div class="we-want-con main-form" style="display:block;">
                        <div class="text-center mt-4 mb-4 popup-logo">
                            
                        </div>
                        <p class="by-continue-text">Please enter The New Member information below</p>
                        <form id="member_registration">
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    First Name
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="input-box-one" name = "first_name" id = "first_name" placeholder="" onKeyPress="return ValidateAlpha(event);"/>
                                </div>
        
                            </div>
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    Last Name
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="input-box-one" name = "last_name" id = "last_name" placeholder="" onKeyPress="return ValidateAlpha(event);"/>
                                </div>
        
                            </div>
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    Email <input type="radio" name="sent_by" id="sent_by" value="email"/> &nbsp; &nbsp; Phone <input type="radio" id="sent_by" name="sent_by" value="phone"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="input-box-one" name="link_Sent_on" id="link_Sent_on" placeholder="" />
                                </div>
                            </div>
                            <span id="linksentmessage"></span>
                            <br>
                            <div class="row we-want-text1">
                                <div class="col-sm-12 text-center">
                                    <button class="send-button-one4" type="submit">Send invite</button>
                                    <button class="cancel-button44" onclick="location.reload();" type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade merchent-main-madal" id="recognitionModal" tabindex="-1" aria-labelledby="recognitionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <div class="cross-icon11"><img data-bs-dismiss="modal" aria-label="Close"
                            src="{{ asset('frontend_assets/images/cross-icon-one.svg') }}" /></div>
                    <div class="border_bottom">
                        <h2>Choose a reward below</h2>
                    </div>
                    <form id="dateSet" name="dateSet" method="post">
                        @csrf
                        <div class="row">
                            <div class="merchent-input">
                                <select style="margin:10px; padding:10px;color: #fff;background-color: #419cd482;" id="recognitionid" >
                                    @if($recognitions)
                                        @foreach($recognitions as $type)
                                                <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <span id="resetdaterror"></span>
                            <p style = "color: #fff;">Once a reward is selected from the dropdown, the recognition description will appear here.</p>
                            <div class="col-sm-6 login-top-one1">
                                <button class="login-button-one" type="button" name="stepone" id="saveRecognition"
                                    style="width:50%;">Save</button>
                            </div>
                            <div class="col-sm-6 login-top-one1">
                                
                                    <button class="login-button-one" type="button" data-bs-dismiss="modal"
                                    aria-label="Close" style="background-color: #e61717; width:50%;">Cancel</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="wrap_modal_cntntr">
                  <div class="cmn_secthd_modals">
                      <h3 id="errormsg"></h3>
                  </div>
      
                  <div class="cmn_secthd_modals_btnnn">
                      <div class="btn_foot_end centr">
                           <button class="btn_table_s blu auto_wd"  onclick="window.location.reload();">ok</button>    
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

     <!-- Guest Recognition popup start modal -->
     <div wire:ignore.self data-bs-backdrop = 'static' class="modal dolphing_cove_modal fade" id="guest_Recognition" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h3 class="dolphincove_modal_title mb-3" style="color: #2e8cca;">Choose a reward below:</h3>
                <div class="modal-body">
                    <div class="dolphing_cove_form ">
                        <form>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="guest_reward_value"
                                        value="guest_of_the_week" wire:model='guest_reward_value'>
                                    <b>Guest of The week</b> <br><span class="text-muted">An individual reward. Limited
                                        to one reward per booking.
                                        <b>Point value: {{ $points }} points</b></span>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="guest_reward_value"
                                        value="family_friend" wire:model='guest_reward_value'>
                                    <b>Family and Friends Rewards</b> <br><span class="text-muted">A group reward.
                                        Rewards all members that have accepted their badge in this member's listing. Limited to 2 rewards per booking
                                        <b>Point value: {{ $points }} points per member</b></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="page-btn page-btn-green-peas GuestReward" 
                         data-id ="{{$conUnit->user->id}}" >Send</button>
                    {{-- <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                        wire:click="guestReward">Send</button> --}}
                    <a class="page-btn page-btn-red closeRecognition" href="javascript:void(0);"
                        id="closeRecognition">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!--Guest Recognition popup end modal -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="add_member_message_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <div class="wrap_modal_cntntr">
                  <div class="cmn_secthd_modals">
                      <h3 id="error_message"></h3>
                  </div>
      
                  <div class="cmn_secthd_modals_btnnn">
                      <div class="btn_foot_end centr">
                           <button class="btn_table_s blu auto_wd colose_sdd_member_message_model" >ok</button>    
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



            $('#link_Sent_on').keyup(function(){
                if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
                }
            });

            $(document).on('click',".clearBadgeDates", function() {
                $("#add_member_message_modal").modal('show');
                $("#error_message").text("Please go to the Smart Guest Database and do Clear Dates from there.");
            });
            

            $(document).on('click',".refreshForm", function() {
                // refreshInitialModal();
                // localStorage.setItem('triggerClickAfterReload', 'true');
                sessionStorage.setItem('modalOpenAfterReload', 'true');
                location.reload();
            });

            $(document).on('click',".add_points", function() {
                var userId = $(this).data('id');
                console.log('User ID:', userId);
                $.ajax({
                    type: 'get',
                    url: '{{route("frontend.hotel.users.addpoints")}}',
                    data: {
                        'conunit_id': userId
                    },
                    success: function(response) {
                        console.log(response.success);
                        if(response.success == true){
                            // $("#total_consumer_point").html(response.data+' Points');
                            $("#message_modal").modal('show');
                            $("#errormsg").text("Points have been added to this member's account");
                            }
                        else if(response.status == false){
                            $("#message_modal").modal('show');
                            $("#errormsg").text("There is no point to added consumer's profile");
                            }
                        else{
                            location.reload();
                        }
                        
                    }
                });
            
            });
                
            $(document).on('click',".guest_recognition", function() {
                $("#guest_Recognition").modal('show');
            });

            $(document).on('click',".closeRecognition", function() {
                $("#guest_Recognition").modal('hide');
            });

            $(document).on('click',".closeSelectedBadge", function() {
                $("#addMemberModel").modal('hide');
            });

            $(document).on('click',".colose_sdd_member_message_model", function(e) {
                e.preventDefault();
                // $("#add_member_message_modal").modal('hide');
                // localStorage.setItem('triggerClickAfterReload', 'true');
                sessionStorage.setItem('modalOpenAfterReload', 'true');
                location.reload();
                // $("#addMemberModel").modal('show');
                // $("#add_member").click();
                
            });

            $(document).ready(function() {
                // if (localStorage.getItem('triggerClickAfterReload') === 'true') {
                //     localStorage.removeItem('triggerClickAfterReload');
                //     $('#addMemberModel').modal('show');
                // }

                if (sessionStorage.getItem('modalOpenAfterReload') === 'true') {
                    sessionStorage.removeItem('modalOpenAfterReload');
                    $('#addMemberModel').modal('show');
                }
            });


            $(document).on('click',".sendSelectedBadge", function() {
                var checkinDate = $('input[name="checkin_date"]').val();
                var checkoutDate = $('input[name="checkout_date"]').val();
                var badgeId = $('input[name="badge_id"]').val();
                var emailAddresses = [];
                
                $('input[name^="email_addresses"]').each(function() {
                    var email = $(this).val();
                    if (email) { 
                        emailAddresses.push(email);
                    }
                });

                $.ajax({
                    type: 'get',
                    url: '{{route("frontend.hotel.users.addmember")}}',
                    data: {
                        'checkinDate': checkinDate,
                        'checkoutDate':checkoutDate,
                        'badgeId':badgeId,
                        'emailAddresses':emailAddresses
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status == 0){
                            $("#add_member_message_modal").modal('show');
                            $("#error_message").text(response.message);
                        }else if(response.status == 1){
                            if (response.key_arr.length > 0) {
                                for (var i = 0; i <= response.key_arr.length; i++) {
                                    $(".dolphin_column_right" + response.key_arr[i]).css('display', 'block');
                                }
                                $(".guest_count").text('(' + response.guest_badge_count + '/10)');
                                if (response.message) {
                                    $("#add_member_message_modal").modal('show');
                                    $("#error_message").text(response.message);
                                    // $("#addMemberModel").modal('hide')
                                }
                            } else {
                                $(".guest_count").text('(' + response.guest_badge_count + '/10)');
                                if (response.message) {
                                    $("#add_member_message_modal").modal('show');
                                    $("#error_message").text(response.message);
                                    // $("#addMemberModel").modal('hide')
                                }
                            }
                        }else{
                            location.reload();
                        }
                    }

                });
            });

            function refreshInitialModal() {
                $('#addMemberModel').find('form')[0].reset();
            }

            $(document).on('click', '.GuestReward', function() {
                var selectedReward = $('input[name="guest_reward_value"]:checked').val();

                var userId = $(this).data('id');
                console.log('Selected Reward:', selectedReward);
                console.log('User ID:', userId);

                $.ajax({
                    type: 'get',
                    url: '{{route("frontend.hotel.users.addguestpoint")}}',
                    data: {
                        'conunit_id': userId,
                        'select_reward':selectedReward
                    },
                    success: function(response) {
                        console.log(response.status);
                        console.log(response.message);
                        if(response.status == 1){
                            $("#guest_Recognition").modal('hide');
                            $("#message_modal").modal('show');
                            $("#errormsg").text(response.message);
                            }
                        else if(response.status == false){
                            $("#guest_Recognition").modal('hide');
                            $("#message_modal").modal('show');
                            $("#errormsg").text(response.message);
                            }
                        else{
                            location.reload();
                        }
                        
                    }
                });
                
            });
            
            function ValidateAlpha(evt)
            {
                var keyCode = (evt.which) ? evt.which : evt.keyCode
                if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
                
                return false;
                    return true;
            }
            $.validator.addMethod('customphone', function (value, element) {
                    return this.optional(element) || /^(\+91-|\+91|0)?\d{10}$/.test(value);
            }, "Please enter a valid phone number");

            $(document).on('click', '#deactive_member', function() {
                $("#deactiveModal").modal('show');
            });

            $(document).on('click','#add_member', function() {
                // $("#memberAddModal").modal('show');//-------------------
                $("#addMemberModel").modal('show')

            });

            $(document).on('click',".consumer_deactivate", function() {
            // $("#deactiveModal").modal('hide');

                var conunitid = '<?php echo $conUnit->id;?>';
                
                $.ajax({
                        type: 'get',
                        url: '{{route("frontend.hotel.users.deactivate")}}',
                        data: {
                            'conunit_id': conunitid
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 1){
                                window.location = response.redirect_url+'/'+response.data.id;
                            }
                            else if(response.status == 2){
                                window.location = response.redirect_url;
                            }
                            else{
                                location.reload();
                            }
                        }
                });
            });

            $(document).ready(function() {
                $("#member_registration").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true,
                        },
                        sent_by: {
                            required: true,
                        },
                        link_Sent_on: {
                            required: true,
                            email: {
                                depends: function(elem) {
                                    if($("input:radio[name=sent_by]:checked").val() == 'email'){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                            },
                            // phoneUS:{
                            //     depends: function(elem) {
                            //         if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                            //             return true;
                                        
                            //         }
                            //         else{
                            //             return false;
                            //         }
                            //     }
                            // },
                            // customphone: {
                            //     depends: function(elem) {
                            //         if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                            //             return true;
                                        
                            //         }
                            //         else{
                            //             return false;
                            //         }
                            //     }
                            // },
                            
                              
                        },
                    },
                    messages: {
                        first_name: {
                            required: " Please enter your first name ",
                        },
                        last_name: {
                            required: " Please enter your last name ",
                        },
                        sent_by: {
                            required: " Please check any checkbox ",
                        },
                        link_Sent_on: {
                            required: 'Please enter your email id or phone',
                            email: 'Please give a valid email address',
                            
                        },
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                $("#member_registration").submit(function(e) {
                    e.preventDefault();
                    var url = window.location.pathname;
                    var conunitid = url.substring(url.lastIndexOf('/') + 1);
                    //console.log(conunitid);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('frontend.property.consumer.send-registration-link') }}",
                        type: 'POST',
                        data: {
                            first_name: $("#first_name").val(),
                            last_name: $("#last_name").val(),
                            sent_by: $("input:radio[name=sent_by]:checked").val(),
                            link_Sent_on: $("#link_Sent_on").val(),
                            conunit_id: conunitid,
                            flag: 'consumer_unit',
                        },
                        success: function(result) {
                            console.log(result);
                            if(result.status == 0){
                                $('#linksentmessage').css('color','red').fadeIn().html('Something went wrong');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                        //location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 1){
                                $('#linksentmessage').css('color','red').fadeIn().html('Registration link not sent successfully to given email address');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                       // location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 2){
                                $('#linksentmessage').css('color','green').fadeIn().html('Registration link sent successfully to given email address');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                        //location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 3){
                                $('#linksentmessage').css('color','green').fadeIn().html('Registration link sent successfully to given phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                       // location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 4){
                                $('#linksentmessage').css('color','red').fadeIn().html('Please give correct phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                }, 3000 );
                            }
                            else if(result.status == 9){
                                $('#linksentmessage').css('color','red').fadeIn().html('Please give correct phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                }, 3000 );
                            }
                        }
                    });
                });

                $(document).on('click','.addPoint', function(){
                    var consumer_id = '<?php echo $conUnit->consumer_id;?>';
                    var property_id = '<?php echo $conUnit->provider_type_id;?>';
                    $("#errormsg").text("");
                    $.ajax({
                        type: 'get',
                        url: '{{route("frontend.add-point")}}',
                        data: {
                            'consumer_id': consumer_id,
                            'property_id' : property_id
                        },
                        success: function(response) {
                            console.log(response);
                            if(response.status == 1){
                            $("#total_consumer_point").html(response.data+' Points');
                            $("#message_modal").modal('show');
                            $("#errormsg").text("Point Added !!! ");
                            }
                            else if(response.status == 2){
                            $("#message_modal").modal('show');
                            $("#errormsg").text("There is no point to added consumer's profile");
                            }
                            else{
                                location.reload();
                            }
                        }
                    });
                });

                $(document).on('click','.addTermDate', function(){
                    var consumer_id = '<?php echo $conUnit->consumer_id;?>';
                    var property_id = '<?php echo $conUnit->provider_type_id;?>';
                    $("#errormsg").text("");
                    $.ajax({
                        type: 'get',
                        url: '{{route("frontend.add-term")}}',
                        data: {
                            'consumer_id': consumer_id,
                            'property_id' : property_id
                        },
                        success: function(response) {
                            if(response.status == 1){
                                var date = new Date(response.data);
                                var newDate = ("0" + (date.getMonth() + 1)).slice(-2) +'/' + date.getDate() + '/' + date.getFullYear();   
                                $("#termdate").html(newDate);                               
                                $("#message_modal").modal('show');
                                $("#errormsg").text("Term Added !!! ");
                            }
                            else if(response.status == 2){
                                $("#message_modal").modal('show');
                                $("#errormsg").text("Consumer not found");
                            }
                            else if(response.status == 3){
                                $("#message_modal").modal('show');
                                $("#errormsg").text("There is no term to added consumer's profile");
                            }
                            else{
                                location.reload();
                            }
                        }
                    });
                });

                $(document).on('click','.tenantRecognition',function(){
                    $("#recognitionModal").modal('show');
                    var consumer_id = '<?php echo $conUnit->consumer_id;?>';
                    var property_id = '<?php echo $conUnit->provider_type_id;?>';
                    $.ajax({
                        type: 'get',
                        url: '{{route("frontend.check-reward")}}',
                        data: {
                            'consumer_id': consumer_id,
                            'property_id' : property_id
                        },
                        success: function(response) {
                            console.log(response.data);
                             if(response.status == 1){
                                    $("#recognitionid").val(response.data.id);
                             }
                             
                            
                        }
                    });

                });

                $(document).on('change','#saveRecognition',function(){
                    var consumer_id = '<?php echo $conUnit->consumer_id;?>';
                    var property_id = '<?php echo $conUnit->provider_type_id;?>';
                    var recognition_type_id = $("#recognitionid").val();

                    $.ajax({
                        type: 'get',
                        url: '{{route("frontend.saveTenantRecognition")}}',
                        data: {
                            'consumer_id': consumer_id,
                            'property_id' : property_id,
                            'recognition_type_id': recognition_type_id,
                        },
                        success: function(response) {

                        }

                    });

                })
            }); 

    </script>
    @endpush

</x-layouts.provider-layout>
