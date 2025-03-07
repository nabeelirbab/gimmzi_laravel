<div>
    <div class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="row mcd_row">
                  <div class="col-lg-9 mcd_col">
                    <div class="mcd_Left">
                      <h1>My Profile Settings</h1>

                      <div class="mcd_form">
                        <form wire:submit.prevent='updateProfile' >
                          <div class="mcd_form_inner">
                            @if($user)
                            <div class="row mcd_form_row">
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Full Name</label>
                                <div class="mcd_input mcd_input_with_btn">
                                  <input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id">
                                 
                                  <input type="text" placeholder="Full Name " value="{{$user->full_name}}" wire:model = "full_name" {{$name_readonly}}>
                                  {{-- <input type="hidden" class="form-control"
                                  value="{{ $businessProfile->business_name }}" id="update_business_name">
                                   --}}
                                  <a href="Javascript:void(0);" class="mcd_edit_btn" wire:click='removeReadonly("name")'><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                @error('full_name')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                              </div>
                           
                           
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Email Address</label>
                                <div class="mcd_input mcd_input_with_btn">
                                    <input type="email" placeholder="Email Address" value="{{$user->email}}" wire:model = "email" {{$email_readonly}}>
                                   
                                    <a href="Javascript:void(0);" class="mcd_edit_btn" wire:click='removeReadonly("email")'><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                @error('email')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Phone Number</label>
                                <div class="mcd_input mcd_input_with_btn">
                                    <input type="text" onkeypress="return isNumber(event);" placeholder="Phone Number" value="{{$user->phone}}" wire:model = "phone" {{$phone_readonly}}>
                               
                                    <a href="Javascript:void(0);" class="mcd_edit_btn"  wire:click='removeReadonly("phone")' ><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                @error('phone')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Password</label>
                                    <div class="mcd_input mcd_input_with_btn">
                                       
                                        <input type="password" placeholder="Password" value="" wire:model='password' {{$password_readonly}}>
                            
                                        <a href="Javascript:void(0);" class="mcd_edit_btn"  wire:click='removeReadonly("password")'><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                    </div>
                                    @error('password')
                                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="" style="font-weight: 700;">Communication Settings</label>
                                <span class="cst_chk">
                                  <input type="radio" name="communication_settings" id="email_text" value="email_and_text" wire:model='communication_setting' <?php if($user->communication_setting == 'email_and_text'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;">
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Email and Text</label>
                                </span>
                                <span class="cst_chk">
                                  <input type="radio" name="communication_settings" id="emailonly" value="email_only" wire:model='communication_setting'  <?php if($user->communication_setting == 'email_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Email Only</label>
                                </span>
                                <span class="cst_chk">
                                  <input type="radio" name="communication_settings" id="textonly" value="text_only" wire:model='communication_setting'  <?php if($user->communication_setting == 'text_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Text Only</label>
                                </span>
                              </div>

                              <div class="col-lg-12 mcd_form_col" style="border: 1px #000 solid;background-color: #e6e6e6;">
                                <textarea class="form-control" style="height: 77px;" readonly>You may receive additional notifications about provider updates on Gimmzi. You can opt-out of  specific emails and or texts using the unsubscribe link included in each message.</textarea>
                              </div>

                              <div class="col-lg-6 mcd_form_col">
                                
                                <p>
                                  <span class="cst_chk">
                                    <input type="checkbox" name="newsletter" id="newsletter" value="1" wire:model='newsletter' <?php if($user->newsletter == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                    <label for="dateCheck" style="margin-left: 7px;color:black;">Newsletter</label>
                                  </span>
                                </p>
                                <p>
                                  <span class="cst_chk">
                                        <input type="checkbox" name="gimmzi_update" id="gimmzi_update" value="1" wire:model='gimmzi_update' <?php if($user->gimmzi_update == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                        <label for="dateCheck" style="margin-left: 7px;color:black;">Gimmzi Updates</label>
                                  </span>
                                </p>
                                <p>
                                  <span class="cst_chk">
                                      <input type="checkbox" name="special_promotion_offer" id="special_promotion" value="1" wire:model='special_promotion_offer'  <?php if($user->special_promotion_offer == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                      <label for="dateCheck" style="margin-left: 7px;color:black;">Special Promotions and Offers</label>
                                  </span>
                                </p>
                                
                              </div>
                              <div class="col-lg-6 mcd_form_col">
                                
                                <p>
                                  <span class="cst_chk">
                                    <input type="checkbox" name="gimmzi_upcoming_event" id="gimmzi_event" value="1"  wire:model='gimmzi_upcoming_event' <?php if($user->gimmzi_upcoming_event == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                    <label for="dateCheck" style="margin-left: 7px;color:black;">Gimmzi Upcoming Events</label>
                                  </span>
                                </p>
                                 
                                  <p>
                                    <span class="cst_chk">
                                      <input type="checkbox" name="unsubscribe_from_all" id="unsubscribe" value="1" wire:model='unsubscribe_from_all'  <?php if($user->unsubscribe_from_all == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                      <label for="dateCheck" style="margin-left: 7px;color:black;">Unsubscribe from All notifications</label>
                                    </span>
                                  </p>
  
                                  
                                </div>
                            </div>
                           
                           
                            <div class="mcd_save">
                              <button type="submit" class="btn_table_s grn" style="width:0px;" >Save</button>
                            </div>
                            @endif
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 mcd_col">
                    <div class="mcd_right"> 
                      <h3>Role: <span>{{$user->title->title_name}}</span></h3>
                     
                        <div class="row">
                            <div class="col-m-4">
                                <div class="uploard-logo-one">
                                    @if($imgId)
                                    <img id="preview_photo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{asset($imgId)}}"/>
                                    @else
                                    <img id="preview_photo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-m-4">
                                <div class="uploard-logo-one">
                                    <input type="file" class="uploard-file-one" wire:model="user_photo"/>
                                    {{-- <img src="{{ $imgId }}" /> --}}
                                    <h4 style="font-size: 19px!important;">Upload Profile Picture</h4>
                                </div>
                            </div>
                            @error('user_photo')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                        <span id="imageerror"></span>
                    </div>
                  </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="error_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="errormsg"></h3>
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
@push('scripts')
  <script>
      function isNumber(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode > 31 && (charCode < 48 || charCode > 57))
              return false;

          return true;
      }
  </script>
@endpush

</div>
