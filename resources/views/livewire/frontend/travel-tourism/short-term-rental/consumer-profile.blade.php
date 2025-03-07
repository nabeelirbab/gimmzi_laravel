<div>
    <div id="building-park" class="building-parm-main">
        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <div class="building-park-left">
                        <h2>{{$badge->listing->name}}</h2>
                        <h4>1. {{$badge->guest->full_name}}</h4>
                        @php $i = 2; @endphp
                        @if(count($anotherbadge) > 0)
                          @foreach($anotherbadge as $another)
                            <h4>{{$i}}. {{$another->guest->full_name}} <a href="{{route('frontend.short.users.view.profile',$another->guest_id)}}">View Profile</a></h4>
                            @php $i++; @endphp
                          @endforeach
                        @endif
                        <h4>{{$i}}. <a href="javascript:void(0);" wire:click='addBadgeGuest'>Add New Member</a></h4>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="building-park-mid">
                        <div class="row">
                            <div class="col-md-8 padding-right-space-0">
                                <div class="building-park-mid-main">
                                    <figure>
                                        @if($badge->guest->getFirstMedia('consumerImages'))
                                            <img src="{{$badge->guest->getFirstMedia('consumerImages')->getUrl()}}" style="border-radius: 13px;height:100%">
                                        @else
                                            <img src="{{ asset('frontend_assets/images/icon-25.svg')}}" style="border-radius: 13px;height:100%">
                                        @endif
                                    </figure>
                                    <div class="building-park-mid-conatain">
                                        <h2>{{$badge->guest->full_name}} </h2>
                                        <h4><img src="{{ asset('frontend_assets/images/icon29.svg')}}"> Gimmzi Smart Rewards Member Since :
                                           <span> {{date_format(date_create($badge->guest->created_at),'m/d/Y')}}</span>
                                        </h4>
                                        <h4 class="w-100"><img src="{{ asset('frontend_assets/images/icon-27.svg')}}"> Total : <span id="total_consumer_point">{{number_format($badge->guest->point)}} Points</span> </h4>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4 building-park-right-contain">
                                    <h4><img src="{{ asset('frontend_assets/images/mail-icon.svg')}}"> Mail:
                                        @php
                                            $email = $badge->guest->email;
                                            $emailParts = explode('@', $email);

                                            if (count($emailParts) === 2) {
                                                $localPart = $emailParts[0];
                                                $firstChar = substr($localPart, 0, 1);
                                                $obfuscatedEmail = $firstChar.'**********.com';
                                            } else {
                                                $obfuscatedEmail = $email;
                                            }
                                        @endphp
                                    <a href="javascript:void(0);">{{$obfuscatedEmail}}</a></h4>
                                    @if($badge->guest->expiry_date != null)
                                    <?php $expirydate = date_format(date_create($badge->guest->expiry_date),'m/d/Y')?>
                                       <h4><img src="{{ asset('frontend_assets/images/calender-11.svg')}}"> Term Date:<span id="termdate">{{$expirydate}}</span></h4>
                                    @endif
                                    
                                    <h4><img src="{{ asset('frontend_assets/images/call-16.svg')}}"> Phone: 
                                        @if($badge->guest->phone)
                                            @php
                                                $phoneNumber = $badge->guest->phone;
                                                $firstDigit = substr($phoneNumber, 0, 1);
                                                $phone = $firstDigit.'***-***-****';
                                            @endphp
                                        @else
                                            @php
                                                $phone = '';
                                            @endphp  
                                        @endif
                                       <a href="javascript:void(0);">{{$phone}}</a></h4>

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
                                <a href="javascript:void(0);" class="" wire:click='addPoint'><img src="{{ asset('frontend_assets/images/add-frame.svg')}}" class="cat-left-icon" />
                                    Add points</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="" wire:click='guestRecognition'><img src="{{ asset('frontend_assets/images/icon44.svg')}}" class="cat-left-icon" />
                                    Guest Recognition </a>
                            </li>
                            <li>
                                <a href="#"> <img src="{{ asset('frontend_assets/images/b.svg')}}" class="cat-left-icon" />
                                    <span> Gimmzi Gift pack <br />
                                    <span class="text-one11">For New Guests</span><br />
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
        <!-- Guest Recognition popup start modal -->
        <div wire:ignore.self class="modal dolphing_cove_modal fade" id="guest_Recognition" tabindex="-1" aria-labelledby="dolphingcove" aria-hidden="true">
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
                                        <b>Guest of The Week</b> <br><span class="text-muted">An individual reward. Limited
                                            to one reward per booking.
                                            <b>Point value: {{ $points }} points</b></span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="guest_reward_value"
                                            value="family_friend" wire:model='guest_reward_value'>
                                        <b>Family and Friends Rewards</b> <br><span class="text-muted">A group reward.
                                            Rewards all members that have accepted their badge in this member's listing.
                                            Limited to 2 rewards per booking.
                                            <b>Point value: {{ $points }} points per member</b></span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                            wire:click="guestReward">Send</button>
                        <a class="page-btn page-btn-red" href="javascript:void(0);"
                            wire:click="$emit('guestRecognition')">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!--Guest Recognition popup end modal -->
        <!--Guest Recognition popup success start modal -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="guest_Recognition_success" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3>{{ $guest_success_message }}</h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" onclick="window.location.reload()">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Guest Recognition popup success end modal -->
        <!--Guest Recognition popup error start modal -->
        <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="guest_Recognition_error" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                    <div class="modal-body">
                        <div class="wrap_modal_cntntr">
                            <div class="cmn_secthd_modals">
                                <h3>{{ $guest_error_message }}</h3>
                            </div>
                            <div class="cmn_secthd_modals_btnnn">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd"
                                        wire:click="$emit('guestRecognitionError')">ok</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Guest Recognition popup error end modal -->


        <div wire:ignore.self  class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
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
    </div>
    
<div wire:ignore.self class="modal dolphing_cove_modal fade" id="selectedScheduleModal" tabindex="-1" aria-labelledby="selectedSchedule" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if ($badge)
                    <h3 class="dolphincove_modal_title">{{ $badge->listing->name }} Badges</h3>
                @endif
                <a href="javascript:void(0);" class="refresh-btn" wire:click="refreshForm"><img
                        src="{{ asset('frontend_assets/images/refresh-icon.svg') }}" alt=""> Refresh</a>
            </div>
            <div class="modal-body">
                <div class="dolphing_cove_form">
                    <form>
                        <div class="row dolphin_row">
                            <div class="col-lg-6 dolphin_column input-date">
                                <label>*Check-In</label>
                                <input type="text" class="checkinDatePicker" wire:model="checkin_date"
                                style="background-color: #e8e8e8;" disabled >
                            </div>
                            <div class="col-lg-6 dolphin_column input-date" wire:ignore>
                                <label>*Check-Out</label>
                                <input type="text" class="checkoutDatePicker" wire:model="checkout_date"
                                style="background-color: #e8e8e8;" disabled >
                            </div>
                        </div>
                        <div class="dolphin-outer-wraper">
                            <div class="dolphin-cus-row">
                                <div class="dolphin_column_left">
                                    <div class="dolphin_column_left_inner">
                                        <h4 class="dolphin_sub_title">Email Address <span
                                                class="guest_count">({{ $guest_count }}/{{ $listing_guests }})</span>
                                        </h4>
                                    </div>
                                </div>
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
                                                    @if ($value->badge_status == 1)
                                                        <?php $parts = explode('.', $value->guest_email);
                                                        $username = $parts[0]; ?>
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
                                                    @if ($value->badge_status == 0 && $value->is_resend == 1)
                                                        <span class="sky-text">Resent on
                                                            {{ \Carbon\Carbon::parse($value->updated_at)->format('m/d') }}</span>
                                                    @elseif($value->badge_status == 0)
                                                        <span class="sky-text">Invite Sent</span>
                                                    @elseif($value->badge_status == 1)
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
                                                    @if($badge_checkout_date < date('Y-m-d'))
                                                        <input type="text" @keyup.tab="getEmail()"
                                                            wire:model.defer="email_addresses.{{ $i }}"
                                                            wire:keydown.enter="checkEmail" disabled>
                                                    @else
                                                        <input type="text" @keyup.tab="getEmail()"
                                                        wire:model.defer="email_addresses.{{ $i }}"
                                                        wire:keydown.enter="checkEmail">
                                                    @endif
                                                    {{-- <a class="common-found" href="#url" data-bs-toggle="modal" data-bs-target="#MemberFound">asdf</a> --}}
                                                </div>
                                                {{-- @dd($errors) --}}
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
            <button type="button" class="page-btn page-btn-green-peas" href="javascript:void(0);"
                wire:click="sendSelectedBadge">Send Badge</button>
            <a class="page-btn page-btn-red" href="javascript:void(0);"
                wire:click="closeSelectedBadge">Close</a>
            <a class="page-btn page-btn-blue" href="javascript:void(0);" wire:click = 'clearBadge' >Clear
                Dates</a>
        </div>
        {{-- <div class="row">
            <span style="text-align: center;margin-top: 20px;">Use<a wire:click="resendBadge({{$badgeid}})"
                    style="color: blue;" href="javascript:void(0);"> Resend </a>to resend badge invites</span>
        </div> --}}

    </div>
</div>

 



<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="clear_badge_success" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3>If you want to clear badge dates then please go to <a href="{{route('frontend.smart_guest_database')}}">Smart Guest Database</a></h3>
                    </div>
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" onclick="window.location.reload()">ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- member found/notfound popup start modal -->
<div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="MemberFound" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a href="#url" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
            <div class="modal-body common-modal-body">
                <h4 class="manage-title">Member Found!</h4>
                <i class="check-img" wire:click="hideSuccessModal" aria-label="Close"><img
                        src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal common-border-modal memberfound-modal fade" id="newMember" tabindex="-1" aria-labelledby="MemberFound" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a href="javascript:void(0);" class="close-small" data-bs-dismiss="modal" aria-label="Close"></a>
            <div class="modal-body common-modal-body">
                <h4 class="manage-title">New Member!</h4>
                <i class="check-img" wire:click="hideSuccessModal" aria-label="Close"><img
                        src="{{ asset('frontend_assets/images/check-img.png') }}" alt=""></i>
            </div>
        </div>
    </div>
</div>
<!-- member found/notfound popup end modal -->
<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="success_msg"></h3>
                    </div>
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" wire:click="hideSuccessModal">ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="invite_success_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="invite_success_msg"></h3>
                    </div>
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" wire:click="hideSuccessModal">ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    @push('scripts')
        <script>
            function getEmail() {
                window.livewire.emit('checkEmail');
            }
            document.addEventListener('livewire:load', function(event) {
                @this.on('selectedScheduledBadgesPopup', function() {
                    $('#selectedScheduleModal').modal('show');
                });
                @this.on('closeSelectedScheduledBadges', function() {
                    $('#selectedScheduleModal').modal('hide');
                });
                @this.on('clearbadge', function() {
                    $('#clear_badge_success').modal('show');
                });

                @this.on('memberSuccessPopup', data=> {
                    if (data.type == 'member_found') {
                        $('#MemberFound').modal('show');
                    } else if (data.type == 'member_not_found') {
                        $('#newMember').modal('show');
                    } else if (data.type == 'wrong_email') {
                        $("#success_modal").modal('show');
                        $("#success_msg").text('Email address must be valid');
                    }

                });

                @this.on('hideSuccessPopup', function(){
                    $("#success_modal").modal('hide');
                    $("#success_msg").text('');
                    $('#newMember').modal('hide');
                    $('#MemberFound').modal('hide');
                    $("#invite_success_modal").modal('hide');
                    $("#invite_success_msg").text('');
                });

                @this.on('selectedSuccessPopup', data => {
                    $("#success_modal").modal('show');
                    $("#success_msg").text(data.text);
                });

                @this.on('badgeSent', data => {
                    console.log(data.key_arr.length);
                    if (data.key_arr.length > 0) {
                        for (var i = 0; i <= data.key_arr.length; i++) {
                            $(".dolphin_column_right" + data.key_arr[i]).css('display', 'block');
                        }
                        $(".guest_count").text('(' + data.guest_badge_count + '/' + data.listing.no_of_guests +
                            ')');
                        if (data.text) {
                            $("#invite_success_modal").modal('show');
                            $("#invite_success_msg").text(data.text);
                        }

                    } else {
                        $(".guest_count").text('(' + data.guest_badge_count + '/' + data.listing.no_of_guests +
                            ')');
                        if (data.text) {
                            $("#invite_success_modal").modal('show');
                            $("#invite_success_msg").text(data.text);
                        }
                    }

                });

                @this.on('pointAddPopup', data => {
                    $('#message_modal').modal('show');
                    $('#errormsg').text(data.message);
                });

                @this.on('guestRecognition', data => {
                    $('#guest_Recognition').modal('toggle');
                });
                @this.on('guestRecognitionSuccess', data => {
                    $('#guest_Recognition').modal('hide');
                    $('#guest_Recognition_success').modal('show');
                });
                @this.on('guestRecognitionError', data => {
                    $('#guest_Recognition').modal('hide');
                    $('#guest_Recognition_error').modal('toggle');
                });
            });
        </script>
    @endpush
</div>
