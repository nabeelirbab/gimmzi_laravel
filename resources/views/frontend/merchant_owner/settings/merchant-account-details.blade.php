<x-layouts.frontend-layout title="Business Owners Account Page">
    <div class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">

        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="row mcd_row">
                  <div class="col-lg-9 mcd_col">
                    <div class="mcd_Left">
                      <h1>Merchant Account Details</h1>
                      <div class="mcd_status">
                        @if($businessProfile)
                          <span>Status</span>
                          @if($businessProfile->status == 1)
                          <span class="mcd_pending" style="color: green;"><span class="pending_circle" style="background: green;"></span>Active</span>
                          @elseif($businessProfile->status == 2)
                          <span class="mcd_pending"><span class="pending_circle"></span>Pending</span>
                          @else
                          <span class="mcd_pending" style="color: red;"><span class="pending_circle" style="background: red;"></span>Inactive</span>
                          @endif
                        @endif
                      </div>

                      <div class="mcd_form">
                        <form id="edit_merchant_account" name="edit_merchant_account" method="post" enctype="multipart/form-data">
                          <div class="mcd_form_inner">
                            @if($businessProfile)
                            <div class="row mcd_form_row">
                              <div class="col-lg-12 mcd_form_col">
                                <div class="mcd_input mcd_input_with_btn">
                                  <input type="hidden" value="{{ $businessProfile->id }}"
                                  id="business_id" name="business_id">
                                  <input type="text" placeholder="Business Name " value="{{ $businessProfile->business_name }}" id="business_name" name="business_name" readonly>
                                  {{-- <input type="hidden" class="form-control"
                                  value="{{ $businessProfile->business_name }}" id="update_business_name">
                                   --}}
                                  <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_name"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="nameerror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                              
                                <div class="mailing_tgl">
                                  <div class="mailing_tgl_inner">
                                    <input type="radio" id="switch_left" name="switch_2" value="business" >
                                    <label for="switch_left">Business Address</label>
                                    <input type="radio" id="switch_right" name="switch_2" value="mailing" checked>
                                    <label for="switch_right">Mailing Address</label>
                                  </div>
                                </div>
                                <div class="mcd_input mcd_input_with_btn">
                                  @if($non_participating_location != '')
                                  <input type="text" placeholder="Business Address" value="{{ $non_participating_location->address }}" id="business_address" readonly name="business_address">
                                  @else
                                  <input type="text" placeholder="Business Address" value="{{ $participating_location->address}}" id="business_address" readonly name="business_address">
                                  @endif
                                  <input type="hidden" placeholder="Mailing Address" value="@if($businessProfile->mailing_address != ''){{ $businessProfile->mailing_address}}@endif" id="mailing_address" readonly name="mailing_address">
                                  <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_mail_address" ><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="addresserror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <div class="mcd_input">
                                    @if($non_participating_location != '')
                                     <input type="text" placeholder="City" value="{{ $non_participating_location->city }}" id="business_city" readonly name="business_city">
                                    @else
                                     <input type="text" placeholder="City" value="{{ $participating_location->city}}" id="business_city" readonly name="business_city">
                                    @endif
                                     <input type="hidden" placeholder="Mailing City" value="@if($businessProfile->mailing_city != ''){{ $businessProfile->mailing_city}} @endif" id="mailing_city" readonly name="mailing_city">
                                    </div>
                                    <span id="cityerror"></span>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="mcd_input">
                                      @if($non_participating_location != '')
                                        <input type="text" placeholder="State" value="{{ $non_participating_location->states->name }}" id="business_state" name="business_state" readonly>
                                        <select class="form-control" id="business_state_id" name="business_state_id" style="display:none;"><span><img src="{{ asset('frontend_assets/images/green-down-tick.svg')}}" alt=""></span>
                                          @foreach ($stateList as $states)
                                              <option value="{{ $states->id }}"<?php if ($non_participating_location->state_id == $states->id) {
                                                  echo 'selected';
                                              } ?>>{{ $states->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                      @else
                                        @if($participating_location->states)
                                          <input type="text" placeholder="State" value="{{ $participating_location->states->name }}" id="business_state" name="business_state" readonly>
                                          <select class="form-control" id="business_state_id" name="business_state_id" style="display:none;"><span><img src="{{ asset('frontend_assets/images/green-down-tick.svg')}}" alt=""></span>
                                            @foreach ($stateList as $states)
                                                <option value="{{ $states->id }}"<?php if ($participating_location->state_id == $states->id) {
                                                    echo 'selected';
                                                } ?>>{{ $states->name }}
                                                </option>
                                            @endforeach
                                          </select>
                                        @else
                                        <input type="text" placeholder="State" value="{{ $participating_location->state_name }}" id="business_state" name="business_state" readonly>
                                        <select class="form-control" id="business_state_id" name="business_state_id" style="display:none;"><span><img src="{{ asset('frontend_assets/images/green-down-tick.svg')}}" alt=""></span>
                                          @foreach ($stateList as $states)
                                              <option value="{{ $states->id }}"<?php if ($participating_location->state_name == $states->name) {
                                                  echo 'selected';
                                              } ?>>{{ $states->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                        @endif
                                      @endif
                                      <input type="hidden" placeholder="Mailing State" value="@if($businessProfile->mailing_state_id != ''){{ $businessProfile->mailingstates->name }} @endif" id="mailing_state" name="Mailing_state" readonly>
                                        <select class="form-control" id="mail_state_id" name="mail_state_id" style="display:none;"><span><img src="{{ asset('frontend_assets/images/green-down-tick.svg')}}" alt="" ></span>
                                          @foreach ($stateList as $states)
                                              <option value="{{ $states->id }}"<?php if ($businessProfile->mailing_state_id == $states->id) {
                                                  echo 'selected';
                                              } ?>>{{ $states->name }}
                                              </option>
                                          @endforeach
                                        </select>
                                      
                                    </div>
                                    <span id="stateerror"></span>
                                  </div>
                                  <div class="col-lg-4">
                                    <div class="mcd_input">
                                      @if($non_participating_location != '')
                                        <input type="text" placeholder="Business Zipcode" value="{{ $non_participating_location->zip_code }}" id="business_zipcode" readonly name="business_zipcode">
                                      @else
                                        <input type="text" placeholder="Business Zipcode" value="{{ $participating_location->zip_code}}" id="business_zipcode" readonly name="business_zipcode">
                                      @endif
                                        <input type="hidden" placeholder="Mailing Zipcode" value="@if($businessProfile->mailing_zipcode != ''){{ $businessProfile->mailing_zipcode}} @endif" id="mailing_zipcode" readonly name="mailing_zipcode">
                                      </div>
                                      <span id="zipcodeerror"></span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <div class="mcd_input mcd_input_with_btn">
                                  @if($businessProfile->business_phone != null)
                                    <input type="tel" placeholder="Business Phone Number" value="{{ $businessProfile->business_phone }}" id="business_phone" name="business_phone" readonly>
                                  @else
                                    <input type="tel" placeholder="Business Phone Number" value="" id="business_phone" name="business_phone" readonly>
                                  @endif
                                    <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_phone"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="phoneerror"></span>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <div class="mcd_input mcd_input_with_btn">
                                  @if($businessProfile->business_email != null)
                                    <input type="email" placeholder="Business Email Address" value="{{ $businessProfile->business_email }}" id="business_email" name="business_email" readonly>
                                  @else
                                    <input type="email" placeholder="Business Email Address" value="" id="business_email" name="business_email" readonly>
                                  @endif
                                    <a href="Javascript:void(0);" class="mcd_edit_btn" id="edit_email"><img src="{{ asset('frontend_assets/images/mcd_edit.svg')}}" alt=""></a>
                                </div>
                                <span id="emailerror"></span>
                              </div>
                            </div>
                            <div class="row mcd_form_row mcd_margin_top">
                              <div class="col-lg-12 mcd_form_col">
                                <h3>Business Verification</h3>
                                <p>
                                  Upload a copy of documentation that verifies your connection to this company. For example, an employee ID card, business license, or TIN Letter
                                </p>
                              </div>
                              <div class="col-lg-12 mcd_form_col">
                                <div class="mcd_input mcd_input_with_btn">
                                  <div class="mcd_inp_file_main">
                                    <input type="file" id="files" name="verification_file">
                                    <div class="browse_btn_file_img">
                                      <span class="browse_btn_file_img_cont">Browse</span>
                                    </div>
                                  </div>
                                </div>
                                <span id="fileerror"></span>
                              </div>
                            </div>
                            <div class="mcd_save">
                              <button type="submit" class="btn_table_s grn" style="width:0px;" id="saveEditProfile">Save</button>
                            </div>
                            @endif
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 mcd_col">
                    <div class="mcd_right">
                      <h3>Merchant Overview</h3>
                      <ul>
                        <li>
                          <strong>Plan:</strong>
                          Merchant Plus
                        </li>
                        <li>
                          <strong>Deals:</strong>
                          5 of 5 being used
                        </li>
                        <li>
                          <strong>Access Users:</strong>
                          15 of 25 being used
                        </li>
                        <li>
                          <strong>Participating Locations:</strong>
                          3 of 4 being used
                        </li>
                        <li>
                          <strong>Landing Pages:</strong>
                          1 of 4 being used
                        </li>
                        <li>
                          <strong>Items & Services:</strong>
                          5 of 50 being used
                        </li>
                        <li>
                          <strong>Loyalty Rewards Programs:</strong>
                          2 of 2 being used
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Error modal  -->
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
                                    onclick="window.location.reload();">ok</button>
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
        $("#state_id").hide();
        $('#edit_name').on('click', function(){
          $("#business_name").attr('readonly', false);
         
        });

        $('#edit_mail_address').on('click', function(){
          console.log($('input[name="switch_2"]:checked').val());
          if($('input[name="switch_2"]').is(':checked')){
            
            if($('input[name="switch_2"]:checked').val() == 'business'){
              $("#mailing_address").attr('readonly', false);
              $("#mailing_city").attr('readonly', false);
              $("#mailing_state").hide();
              $("#mail_state_id").show();
              $("#mailing_zipcode").attr('readonly', false);
              $("#business_state_id").hide();
            }
            else{
              $("#mail_state_id").css('display','none');
              $("#business_address").attr('readonly', false);
              $("#business_city").attr('readonly', false);
              $("#business_state").hide();
              $("#business_state_id").css('display','block');
              $("#business_zipcode").attr('readonly', false);
            }
          }
          
        })
        $('#edit_phone').on('click', function(){
          $("#business_phone").attr('readonly', false);
        });

        $('#edit_email').on('click', function(){
          $("#business_email").attr('readonly', false);
        });
        $("#edit_merchant_account").submit(function(e) {
          e.preventDefault();
          var form = $('#edit_merchant_account')[0];
          var formdata = new FormData(form);
          // console.log(formdata);
       
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
         $.ajax({
                  url: "{{ route('frontend.business_owner.update_merchant_business') }}",
                  type: 'POST',
                  mimeType: "multipart/form-data",
                  dataType: 'json',
                  cache: false,
                  contentType: false,
                  processData: false,
                  data: formdata,
                  success:  function(result) {
                   // console.log(result);
                    if(result.status == 1){
                      $("#errormsg").html('The Merchant account updated successfully');
                      $("#error_modal").modal('show');
                    //   toastr.success('The Merchant account updated successfully');
                    //                 setTimeout(() => {
                    //                    location.reload();
                    //                 },3000);
                     }else if(result.status == 0){
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html('');
                      $('#nameerror').html('Please enter Business Name').css('color', 'red');
                    }else if(result.status == 2){
                      $('#nameerror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html('');
                      $('#addresserror').html('Please enter Mailing Address').css('color', 'red');
                    }else if(result.status == 3){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html('');
                      $('#cityerror').html('Please enter Mailing City').css('color', 'red');
                    }else if(result.status == 4){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html('Please enter Zip code').css('color', 'red');
                    }else if(result.status == 5){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#zipcodeerror').html('');
                      $('#stateerror').html('Please select one state').css('color', 'red');
                    }else if(result.status == 6){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html('');
                      $('#phoneerror').html('Please enter Business Phone Number').css('color', 'red');
                    }else if(result.status == 7){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html(''); 
                      $("#phoneerror").html('');
                      $("#emailerror").html('Please enter Business Email').css('color', 'red');
                    }else if(result.status == 8){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html(''); 
                      $('#emailerror').html(''); 
                      $("#phoneerror").html(result.validation_errors).css('color', 'red');
                    }else if(result.status == 9){
                      $('#nameerror').html('');
                      $('#addresserror').html('');
                      $('#cityerror').html('');
                      $('#stateerror').html('');
                      $('#zipcodeerror').html(''); 
                      $('#phoneerror').html(''); 
                      $("#emailerror").html(result.validation_errors).css('color', 'red');
                    }else if(result.status == 10){
                      $('#fileerror').html(result.validation_errors).css('color', 'red');
                    }
                  }
                })
        });

        

        $(document).on('click','#switch_left', function(){
          $("#switch_left").attr('checked',true);
          $("#switch_right").attr('checked',false);
          //mailing
          $("#mailing_address").attr('readonly', true);
              $("#mailing_city").attr('readonly', true);
              $("#mailing_state").show();
              $("#mail_state_id").hide();
              $("#business_state_id").hide();
              $("#mailing_zipcode").attr('readonly', true);
            $("#mailing_address").attr('type','text');
            $("#business_address").attr('type','hidden');
            $("#mailing_city").attr('type','text');
            $("#business_city").attr('type','hidden');
            $("#mailing_state").attr('type','text');
            $("#business_state").attr('type','hidden');
            $("#mailing_zipcode").attr('type','text');
            $("#business_zipcode").attr('type','hidden');

        });
        $(document).on('click','#switch_right', function(){
          $("#switch_right").attr('checked',true);
          $("#switch_left").attr('checked',false);
          //business
          $("#business_address").attr('readonly', true);
              $("#business_city").attr('readonly', true);
              $("#business_state").show();
              $("#business_state_id").hide();
              $("#mail_state_id").hide();
              $("#business_zipcode").attr('readonly', true);
            $("#mailing_address").attr('type','hidden');
            $("#business_address").attr('type','text');
            $("#mailing_city").attr('type','hidden');
            $("#business_city").attr('type','text');
            $("#mailing_state").attr('type','hidden');
            $("#business_state").attr('type','text');
            $("#mailing_zipcode").attr('type','hidden');
            $("#business_zipcode").attr('type','text');
        });

          $(document).on("keyup","#mailing_zipcode", function() {
            var zipcode = $(this).val();
            if (zipcode.length == 5) {
                $.ajax({
                    url: '{{ route("frontend.ajax.get_city") }}',
                    type: 'get',
                    data: {
                        'zipcode': zipcode
                    },
                    success: function(result) {
                        //console.log(result.data);
                        if (result.success == 1) {
                            $("#mailing_city").val(result.data.City);
                            $("#zipcodeerror").html('');
                            $("#mail_state_id").val(result.state_name);
                        } else {
                            $("#zipcodeerror").html(result.data[0]);
                            $("#zipcodeerror").css('color', 'red');
                        }

                    }
                });
            } else {
                //$("#profilecity").val('');
            }

          });

          $(document).on("keyup","#business_zipcode", function() {
            var zipcode = $(this).val();
            if (zipcode.length == 5) {
                $.ajax({
                    url: '{{ route("frontend.ajax.get_city") }}',
                    type: 'get',
                    data: {
                        'zipcode': zipcode
                    },
                    success: function(result) {
                        //console.log(result.data);
                        if (result.success == 1) {
                            $("#business_city").val(result.data.City);
                            $("#zipcodeerror").html('');
                            $("#business_state_id").val(result.state_name);
                        } else {
                            $("#zipcodeerror").html(result.data[0]);
                            $("#zipcodeerror").css('color', 'red');
                        }

                    }
                });
            } else {
                //$("#profilecity").val('');
            }

          });

      });
    </script>
    @endpush
</x-layouts.frontend-layout>