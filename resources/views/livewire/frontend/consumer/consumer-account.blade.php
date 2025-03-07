<div>
    @if (session()->has('success'))
        <script>
            // Assuming you are using toastr for the toast
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            // Assuming you are using toastr for the toast
            toastr.error("{{ session('error') }}");
        </script>
    @endif
        
        <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{date('m-d-Y',strtotime($user->created_at))}}</div>
        <div class="my_acc_prsn_info cmn_form_elem">
            <form wire:submit.prevent="details_submit">
                <div class="row">
                    <div class="col-lg-6 my_acc_prsn_info_lt">
                        <div class="my_acc_prsn_blk">
                            <div class="my_acc_prsn_hd">
                                <div class="title_h2">Personal Info</div>
                                {{-- <a href="#" class="edit_link" onclick="toggleEdit(event)"><img src="{{asset('frontend_assets/images/edit-icon-d.svg')}}" alt="edit"></a> --}}

                                <a href="Javascript:void(0);" class="edit_link" wire:click='removeReadonly("personal_info")'><img src="{{asset('frontend_assets/images/edit-icon-d.svg')}}" alt="edit"></a>
                            </div>


                            <div class="fld_blk">
                                <div class="fld_blk_prfl">
                                    <div class="fld_prft_lt">
                                        <input type="file" id="file_upload" wire:model.live="user_photo" {{$info_readonly}}>
                                        <label for="file_upload" {{$info_readonly}}>
                                            @if($user_photo != '')
                                                <img src="{{ asset('storage/tmp/'.$user_photo->getFilename()) }}" alt="">
                                            @else
                                                @if($profile_picture)
                                                <img src="{{asset($profile_picture)}}" alt="profile picture">
                                                @else
                                                <img src="{{asset('frontend_assets/images/personal-info-profile-image.png')}}" alt="profile picture">
                                                @endif
                                            @endif
                                                
                                            <span class="cam_part">
                                                <img src="{{asset('frontend_assets/images/camera-icon-w.svg')}}" alt="camera icon">
                                            </span>
                                        </label>
                                    </div>
                                    <div class="fld_prft_rt">
                                        <label for="file_upload" class="fld_prft_label1">Change Profile Pic</label>
                                        <label for="file_upload" class="fld_prft_label2">Click to upload</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 fld_blk">
                                    <label>First Name</label>
                                    {{-- @dd($user_first_name) --}}
                                    <input type="text" placeholder="First Name" wire:model.defer="first_name" {{$info_readonly}}>
                                </div>
                                <div class="col-lg-6 fld_blk">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Last Name" wire:model.defer="last_name" {{$info_readonly}}>
                                </div>
                                <div class="col-lg-6 fld_blk">
                                    <label>Phone</label>
                                    <input type="tel" placeholder="Phone Number" wire:model.defer="phone" {{$info_readonly}}>
                                </div>
                                <div class="col-lg-6 fld_blk fld_blk_date">
                                    <label>Birthdate</label>
                                    {{-- <input type="text" placeholder="01-02-2000" class="datepicker"> --}}
                                    <input type="text" placeholder="Please select date of birth" class="datepicker" wire:model.lazy="birthdate" disabled>
                                </div>
                                <div class="col-lg-12 fld_blk">
                                    <label>Email</label>
                                    <input type="text" placeholder="Email" wire:model.defer="email" {{$info_readonly}} >
                                </div>
                            </div>
                        </div>

                        <div class="my_acc_prsn_blk">
                            <div class="my_acc_prsn_hd">
                                <div class="title_h2">Change Your Password</div>
                                <a href="Javascript:void(0);" class="edit_link_password"  wire:click='removeReadonlyPassword("password_change")'><img src="{{asset('frontend_assets/images/edit-icon-d.svg')}}" alt="edit"></a>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 fld_blk fld_blk_password">
                                    <label>Current Password</label>
                                    <div class="pasrwd-field">
                                        <input type="password"  class="pass-input-field"  wire:model.defer="current_password" {{$password_readonly}}>
                                        <div class="pass-icon-set">
                                            <img src="{{asset('frontend_assets/images/eye-normal.svg')}}" alt="" class="pass-icon-eye">
                                            <img src="{{asset('frontend_assets/images/eye-slash.svg')}}" alt="" class="pass-icon-eye-off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 fld_blk fld_blk_password">
                                    <label>New Password</label>
                                    <div class="pasrwd-field">
                                        <input type="password"  class="pass-input-field"  wire:model.defer="new_password" {{$password_readonly}}>
                                        <div class="pass-icon-set">
                                            <img src="{{asset('frontend_assets/images/eye-normal.svg')}}" alt="" class="pass-icon-eye">
                                            <img src="{{asset('frontend_assets/images/eye-slash.svg')}}" alt="" class="pass-icon-eye-off">
                                        </div>
                                    </div>
                                    {{-- <div class="hint_text">This is a hint text to help user.</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my_acc_prsn_info_rt">
                        <div class="my_acc_prsn_hd">
                            <div class="title_h2">Preferences</div>
                            <!-- <a href="#" class="edit_link"><img src="images/edit-icon-d.svg" alt="edit"></a> -->
                        </div>
                        <div class="fld_blk">
                            <label>Communication Settings</label>
                             <div class="rad_grp">
                                <label> <input type="radio" name="communication_settings" id="email_text" value="email_and_text" wire:model='communication_setting' <?php if($user->communication_setting == 'email_and_text'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;"> <span></span> Email and Text</label>
                                <label> <input type="radio" name="communication_settings" id="emailonly" value="email_only" wire:model='communication_setting'  <?php if($user->communication_setting == 'email_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;"> <span></span> Email Only</label>
                                <label> <input type="radio" name="communication_settings" id="textonly" value="text_only" wire:model='communication_setting'  <?php if($user->communication_setting == 'text_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" > <span></span> Text Only</label>
                            </div>
                            {{-- <div class="fld_blk_chk">
                                <label> <input type="checkbox"> <span></span> Newsletter</label>
                                <label> <input type="checkbox"> <span></span> Gimmzi Upcoming Events</label>
                                <label> <input type="checkbox"> <span></span> Gimmzi Updates</label>
                                <label> <input type="checkbox"> <span></span> Unsubscribe from All notifications</label>
                                <label> <input type="checkbox"> <span></span> Special Promotions and Offers</label>
                            </div> --}}
                        </div>
                        <div class="fld_blk">
                            <label>Email and Text Preferences</label>
                            <div class="hnt_text">You may receive additional notifications about updates on Gimmzi. You can opt-out of specific emails and or texts using the unsubscribe link included in each message.</div>
                            {{-- @dd($newsletter) --}}
                            <div class="fld_blk_chk">
                                <label> <input type="checkbox" name="newsletter" id="newsletter" value="1" wire:model='newsletter' <?php if($newsletter == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" > <span></span> Newsletter</label>

                                <label> <input type="checkbox" name="gimmzi_upcoming_event" id="gimmzi_event" value="1"  wire:model='gimmzi_upcoming_event' <?php if($gimmzi_upcoming_event == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" > <span></span> Gimmzi Upcoming Events</label>

                                <label> <input type="checkbox" name="gimmzi_update" id="gimmzi_update" value="1" wire:model='gimmzi_update' <?php if($gimmzi_update == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;"> <span></span> Gimmzi Updates</label>

                                <label> <input type="checkbox"name="unsubscribe_from_all" id="unsubscribe" value="1" wire:model='unsubscribe_from_all'  <?php if($unsubscribe_from_all == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;"> <span></span> Unsubscribe from All notifications</label>

                                <label> <input type="checkbox" name="special_promotion_offer" id="special_promotion" value="1" wire:model='special_promotion_offer'  <?php if($user->special_promotion_offer == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" > <span></span> Special Promotions and Offers</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 my_acc_prsn_btn_col">
                        <button class="cmn_theme_btn">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
</div>

    <div  wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="new_popup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="new_popup_msg"></h3>
                        </div>
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd new_popup_close" >ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- <style>
    input:disabled, textarea:disabled, select:disabled {
    filter: none !important;
    opacity: 1 !important;
    background-color: #eeeeee !important;
    color: #757779 !important;
    cursor: not-allowed !important;
    }

    input[type="file"]:disabled {
        background-color: transparent !important;
    }
</style> --}}
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    function initializeDatepicker() {
        $('.datepicker').datepicker('destroy').datepicker({
            dateFormat: 'mm-dd-yy',
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            onSelect: function(dateText) {
                @this.set('birthdate', dateText);
            }
        });
        if (@this.birthdate === '') {
            $('.datepicker').val('');
        }
    }
    document.addEventListener('livewire:load', function () {
        initializeDatepicker();
        Livewire.hook('message.processed', () => {
            initializeDatepicker();
        });
    });

    //  function toggleEdit(event) {
    //     event.preventDefault();
    //     const inputs = document.querySelectorAll('.my_acc_prsn_info_lt input');
    //     inputs.forEach(input => {
    //         if (input.disabled) {
    //             input.disabled = false;
    //         } else {
    //             input.disabled = true;
    //         }
    //     });
    // }

    document.addEventListener('livewire:load', function(event) {
        @this.on('popUp', data => {
            $("#new_popup").modal('show');
            $("#new_popup_msg").text(data.text);
        });

        $(".new_popup_close").on('click',function(){
            $("#new_popup").modal('hide');
            $("#new_popup_msg").text('');
        });
    });
    
</script>
@endpush
