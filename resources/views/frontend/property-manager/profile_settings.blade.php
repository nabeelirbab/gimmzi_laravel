<x-layouts.provider-layout  title="User Profile Setting Page">
    <div class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="row mcd_row">
                  <div class="col-lg-9 mcd_col">
                    <div class="mcd_Left">
                      <h1>My Profile Settings</h1>

                      <div class="mcd_form">
                        <form id="edit_my_profile" name="edit_my_profile" method="post" enctype="multipart/form-data">
                          <div class="mcd_form_inner">
                            @if($user)
                            <div class="row mcd_form_row">
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Full Name</label>
                                <div class="mcd_input mcd_input_with_btn">
                                  <input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id">
                                 
                                  <input type="text" placeholder="Full Name " value="{{$user->full_name}}" id="full_name" name="full_name" readonly>
                                  {{-- <input type="hidden" class="form-control"
                                  value="{{ $businessProfile->business_name }}" id="update_business_name">
                                   --}}
                                  <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_name"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="nameerror"></span>
                              </div>
                           
                           
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Email Address</label>
                                <div class="mcd_input mcd_input_with_btn">
                                   @if($user->email != null)
                                    <input type="email" placeholder="Email Address" value="{{$user->email}}" id="email" name="email" readonly>
                                    @else
                                    <input type="email" placeholder="Email Address" value="" id="email" name="email" readonly>
                                   @endif
                                   
                        
                                    <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_email"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="emailerror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Phone Number</label>
                                <div class="mcd_input mcd_input_with_btn">
                                @if($user->phone != null)
                                    <input type="tel" placeholder="Phone Number" value="{{$user->phone}}" id="phone" name="phone" readonly>
                                @else
                                    <input type="tel" placeholder="Phone Number" value="" id="phone" name="phone" readonly>
                                @endif
                                    <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_phone"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="phoneerror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="">Password</label>
                                    <div class="mcd_input mcd_input_with_btn">
                                       
                                        <input type="password" placeholder="Password" value="" id="password" name="password" readonly>
                            
                                        <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_password"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                    </div>
                                    <span id="emailerror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <label for="" style="font-weight: 700;">Communication Settings</label>
                                <span class="cst_chk">
                                  <input type="checkbox" name="communication_settings" id="email_text" value="email_and_text" <?php if($user->communication_setting == 'email_and_text'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;">
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Email and Text</label>
                                </span>
                                <span class="cst_chk">
                                  <input type="checkbox" name="communication_settings" id="emailonly" value="email_only" <?php if($user->communication_setting == 'email_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Email Only</label>
                                </span>
                                <span class="cst_chk">
                                  <input type="checkbox" name="communication_settings" id="textonly" value="text_only" <?php if($user->communication_setting == 'text_only'){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                  <label for="dateCheck" style="margin-left: 7px;color:black;">Text Only</label>
                                </span>
                              </div>

                              <div class="col-lg-12 mcd_form_col" style="border: 1px #000 solid;background-color: #e6e6e6;">
                                <textarea class="form-control" style="height: 77px;" readonly>You may receive additional notifications about provider updates on Gimmzi. You can opt-out of  specific emails and or texts using the unsubscribe link included in each message.</textarea>
                              </div>

                              <div class="col-lg-6 mcd_form_col">
                                
                                <p>
                                  <span class="cst_chk">
                                    <input type="checkbox" name="newsletter" id="newsletter" value="1" <?php if($user->newsletter == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                    <label for="dateCheck" style="margin-left: 7px;color:black;">Newsletter</label>
                                  </span>
                                </p>
                                <p>
                                  <span class="cst_chk">
                                        <input type="checkbox" name="gimmzi_update" id="gimmzi_update" value="1"  <?php if($user->gimmzi_update == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                        <label for="dateCheck" style="margin-left: 7px;color:black;">Gimmzi Updates</label>
                                  </span>
                                </p>
                                <p>
                                  <span class="cst_chk">
                                      <input type="checkbox" name="special_promotion_offer" id="special_promotion" value="1"   <?php if($user->special_promotion_offer == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                      <label for="dateCheck" style="margin-left: 7px;color:black;">Special Promotions and Offers</label>
                                  </span>
                                </p>
                                
                              </div>
                              <div class="col-lg-6 mcd_form_col">
                                
                                <p>
                                  <span class="cst_chk">
                                    <input type="checkbox" name="gimmzi_upcoming_event" id="gimmzi_event" value="1"   <?php if($user->gimmzi_upcoming_event == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                    <label for="dateCheck" style="margin-left: 7px;color:black;">Gimmzi Upcoming Events</label>
                                  </span>
                                </p>
                                 
                                  <p>
                                    <span class="cst_chk">
                                      <input type="checkbox" name="unsubscribe_from_all" id="unsubscribe" value="1"   <?php if($user->unsubscribe_from_all == 1){echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 17px!important;" >
                                      <label for="dateCheck" style="margin-left: 7px;color:black;">Unsubscribe from All notifications</label>
                                    </span>
                                  </p>
  
                                  
                                </div>
                            </div>
                           
                           
                            <div class="mcd_save">
                              <button type="submit" class="btn_table_s grn" style="width:0px;" id="saveEditProfile">Save</button>
                            </div>
                            @endif
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 mcd_col">
                    <div class="mcd_right"> 
                     @if($user->official_title != '')
                      <h3>Role: <span>{{$user->official_title}}</span></h3>
                     @elseif ($user->merchantTitle != '')
                     <h3>Role: <span>{{$user->merchantTitle->business_title}}</span></h3>
                     @else
                     <h3>Role: <span></span></h3>
                     @endif
                        <div class="row">
                            <div class="col-m-4">
                                <div class="uploard-logo-one">
                                    @if($user->provider_profile_image)
                                    <img id="preview_photo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{$user->provider_profile_image}}"/>
                                    @else
                                    <img id="preview_photo" style="width: 230px;height: 147px;border-radius: 7%;" src="{{ asset('frontend_assets/images/placeholderimage.png') }}" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-m-4">
                                <div class="uploard-logo-one">
                                    <input type="file" class="uploard-file-one" id="user_photo" name="user_photo"/>
                                    <img src="{{ asset('frontend_assets/images/uploard-logo-icon11.svg') }}" />
                                    <h4 style="font-size: 19px!important;">Upload Profile Picture</h4>
                                </div>
                            </div>
                         
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
    $(document).ready(function () {
        $('#user_photo').change(function(e) {
                var fileName = e.target.files[0].name;
                $("#file").val(fileName);

                var reader = new FileReader();
                reader.onload = function(e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview_photo").src = e.target.result;
                   // document.getElementById("userpreview").src = e.target.result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
        });

        
        $('#edit_name').on('click', function(){
          $("#full_name").attr('readonly', false);
        });
        $('#edit_email').on('click', function(){
          $("#email").attr('readonly', false);
        });
        $('#edit_phone').on('click', function(){
          $("#phone").attr('readonly', false);
        });
        $('#edit_password').on('click', function(){
          $("#password").attr('readonly', false);
        });

        $("#email_text").on('click',function(){
          if($("#email_text").is(":checked") > 0){
            $(this).prop('checked', true);
            $("#emailonly").prop('checked',false);
            $("#textonly").prop('checked',false);
          }
        });

        $("#emailonly").on('click',function(){
          if($("#emailonly").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#email_text").prop('checked', false);
            $("#textonly").prop('checked', false);
          }
        });

        $("#textonly").on('click',function(){
          if($("#textonly").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#email_text").prop('checked', false);
            $("#emailonly").prop('checked', false);
          }
        });

        $("#unsubscribe").on('click',function(){
          if($("#unsubscribe").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#gimmzi_event").prop('checked', false);
            $("#special_promotion").prop('checked', false);
            $("#newsletter").prop('checked', false);
            $("#gimmzi_update").prop('checked', false);
          }
        });
        $("#gimmzi_event").on('click',function(){
          if($("#gimmzi_event").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#unsubscribe").prop('checked', false);
           
          }
        });

        $("#special_promotion").on('click',function(){
          if($("#special_promotion").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#unsubscribe").prop('checked', false);
            
          }
        });

        $("#newsletter").on('click',function(){
          if($("#newsletter").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#unsubscribe").prop('checked', false);
            
          }
        });

        $("#gimmzi_update").on('click',function(){
          if($("#gimmzi_update").is(":checked") > 0){
            $(this).prop('checked',true);
            $("#unsubscribe").prop('checked', false);
            
          }
        });

        $("#edit_my_profile").submit(function(e) {
          e.preventDefault();
          var form = $('#edit_my_profile')[0];
          var formdata = new FormData(form);
           console.log(formdata);
       
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            $.ajax({
                    url: "{{ route('frontend.provider.update_provider_profile') }}",
                    type: 'POST',
                    mimeType: "multipart/form-data",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,
                    success:  function(result) {
                    console.log(result);
                        if(result.status == 1){
                        $("#errormsg").html('The Provider account updated successfully');
                        $("#error_modal").modal('show');
                        //   toastr.success('The Merchant account updated successfully');
                        //                 setTimeout(() => {
                        //                    location.reload();
                        //                 },3000);
                        }else if(result.status == 0){
                        $('#emailerror').html('');
                        $('#phoneerror').html('');
                        $('#nameerror').html('Please enter Full Name').css('color', 'red');
                        }else if(result.status == 2){
                        $('#nameerror').html('');
                        $('#phoneerror').html('');
                        $('#emailerror').html('Please enter Email Address').css('color', 'red');
                        }else if(result.status == 3){
                        $('#nameerror').html('');
                        $('#emailerror').html('');
                        $('#phoneerror').html('Please enter Phone Number').css('color', 'red'); 
                        }else if(result.status == 6){
                        $('#nameerror').html('');
                        $('#phoneerror').html('');
                        $('#emailerror').html(result.validation_errors).css('color', 'red');
                    
                        }else if(result.status == 5){
                        $('#nameerror').html('');
                        $('#emailerror').html('');
                        $('#phoneerror').html(result.validation_errors).css('color', 'red');
                    
                        }else if(result.status == 7){
                        $('#nameerror').html('');
                        $('#emailerror').html('');
                        $('#imageerror').html(result.validation_errors).css('color', 'red');
                    
                        }else if(result.status == 4){
                            $("#errormsg").html('User not found');
                            $("#error_modal").modal('show');
                        }
                    }
                })
        });
    });
    </script>
    @endpush
</x-layouts.frontend-layout>