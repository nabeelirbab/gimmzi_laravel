<x-layouts.provider-layout title="message board">
  @push('style')
  <style>
    .errorMsq {
      color: red !important;
      display: block;
    }
  </style>
  @endpush
  <div class="all-smart-rental-database-main-sec">
  <div id="alen-park-contain">
                <div class="container">
                    <div class="alen-park-contain">
                        <div class="allen-img-main">
                            <img src="{{ asset('frontend_assets/images/image11.png') }}" class="alen-img" />
                        </div>
                        <div class="middle-smart-rental-sec">
                        
                            <div class="right-sec-rental">
                                <h3>
                                  <span id="change_first">
                                    @if(Session::get('provider_name'))
                                      {{Session::get('provider_name')}}
                                    @else
                                      {{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}
                                    @endif
                                  </span>
                                        <span class="dropdown top-droup-down-menu">
                                            <button class="dropdown-toggle custom-droup-down" type="button"
                                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                                    class="" />
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
                                        <label>Address:</label> <label
                                            id="property_address">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->address : '' }}</label>
                                    </span>
        
                                    <span class="p-responsive-main">
                                        <span class="mail-image-icon"></span><label>Mail:</label> <a
                                            href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </span>
                                </p>
                                <p class="alen-park-text1 alen-park-text1 star-image-icon"><label>Total Points to
                                        Distribute:</label> <span class="alen-park-text1" id="distributePoint">{{ number_format($propertyDetails->first()->provider->points_to_distribute) }}
                                        points</span>
        
                            </div>
                            </p>
                        </div>
        
                    </div>
        
                </div>
            </div>
    <div class="first-smart-rental-sec">
      <div class="container">
        <h2>Gimmzi Page Message Boards</h2>
      </div>
    </div>
  </div>
  <form method="post" name="provider_message_board" action="{{route('frontend.store_message_board')}}">
    @csrf
    @if(Session::get('provider_name'))
        <input type="hidden" name="property_id" value="{{ session::get('provider_id') }}" id="property_id">
    @else
        <input type="hidden" name="property_id" value="{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->id : '' }}" id="property_id">
    @endif
    <div class="message_board">
      <div class="display_sec">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 margin_cls">
              <div class="d-flex align-items-center max_cls">
                <h6>Display Message Boards</h6>
                  <div class="d-flex">
                    <label class="container_radio">
                      <input type="radio" value="1" name="display_board" id="display_board_on"  />
                      <span class="checkmark"></span>On
                    </label>
                    <label class="container_radio mx-4">
                      <input type="radio" value="0" name="display_board" id="display_board_off" />
                      <span class="checkmark"></span>Off
                    </label>
                    <span id="boarderror"></span>
                  </div>
              </div>
              @if ($errors->has('display_board'))
                <div class="error" style="color:red;">{{ $errors->first('display_board') }}
                </div>
              @endif
              <p>
                Display to be viewed by Smart Rental users only, Public, or
                both. Add notes for residents such as Inspection Due Dates, Rent
                Specials for New Residents, Need to Knows, and more.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="form_section_area">

          <div class="container form_margin">
            <div class="row">

              <div class="col-sm-4 top-space18">
               
                  <select class="form-select" id="message_board" name="message_board_id" aria-label="Default select example">
                    <option value="" selected disabled>Select Message Type</option>
                    @foreach ($messageboard as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                  </select>
                @if ($errors->has('message_board_id'))
                  <div class="error" style="color:red;">{{ $errors->first('message_board_id') }}</div>
                @endif 
              </div>


              {{-- <div class="col-sm-4 top-space18">
                  <input type="date" id="open_start_date" name="start_date" class="start_date" value="{{old('start_date')}}"/>
                    @if ($errors->has('start_date'))
                      <div class="error" style="color:red;">{{ $errors->first('start_date') }}</div>
                    @endif 
              </div> --}}
              {{-- <div class="col-sm-4 top-space18">
                  <input type="date" id="open_end_date" name="end_date" value="{{old('end_date')}}"/>
                   @if ($errors->has('end_date'))
                     <div class="error" style="color:red;">{{ $errors->first('end_date') }}</div>
                  @endif

                  <input type="checkbox" name="add_date" class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 25px!important;margin-top: 7px;" id="dateCheck">
                  <label for="dateCheck" style="position: absolute;margin-left: 7px;color:black;margin-top: 7px;">Add dates to message</label>
             
                <br>
                  <span id="check_add_date"></span>
              </div> --}}
            </div>
          </div>
          <div class="display_sec">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                    
                        <div class="d-flex">
                          <label class="container_radio">
                            <input type="radio" id="tenant_only" value="tenant" name="show_for" />
                            <span class="checkmark"></span>Tenants Only
                          </label>
                          <label class="container_radio mx-4">
                            <input type="radio" id="make_public" value="public" name="show_for"/>
                            <span class="checkmark"></span>Make Public
                          </label>
                        </div>
                    @if ($errors->has('show_for'))
                      <div class="error" style="color:red;">{{ $errors->first('show_for') }}</div>
                    @endif
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <p></p>
                      <textarea style="margin-top: 51px;"  class="form-control" name="message" id="textmessage" rows="3"
                      placeholder="Enter the message">{{$provider_messages->message}}</textarea>
                      @if ($errors->has('message'))
                      <div class="error" style="color:red;">{{ $errors->first('message') }}</div>
                      @endif
                      <a href="javascript:void(0);" id="clear_message_board" style="margin-left: 66rem;">Clear and remove message</a>
                   
                </div>
                <span id="messageerror"></span>
                
              </div>
            </div>
          </div>

          <div class="container form_margin">
            <div class="row">

              <div class="col-sm-4 top-space18">
                  <select class="form-select" id="message_board2" name="message_board_id2" aria-label="Default select example">
                    <option value="" selected disabled>Select Message Type</option>
                    @foreach ($messageboard as $item)
                    <option value="{{ $item->id }}"<?php if(old('message_board_id2') == $item->id){ echo 'selected'; }?>>{{ $item->title }}</option>
                    @endforeach
                  </select>
                @if ($errors->has('message_board_id2'))
                  <div class="error" style="color:red;">{{ $errors->first('message_board_id2') }}</div>
                @endif 
              </div>

              {{-- <div class="col-sm-4 top-space18">
                  <input type="date" id="open_start_date2" name="start_date2" class="start_date" value="{{old('start_date2')}}"/>
                    @if ($errors->has('start_date2'))
                      <div class="error" style="color:red;">{{ $errors->first('start_date2') }}</div>
                    @endif 
              </div> --}}

{{-- 
              <div class="col-sm-4 top-space18">
                  <input type="date"  id="open_end_date2" name="end_date2" value="{{old('end_date2')}}"/>
                   @if ($errors->has('end_date2'))
                     <div class="error" style="color:red;">{{ $errors->first('end_date2') }}</div>
                  @endif

              
                  <input type="checkbox" name="add_date2" <?php if(old('add_date2') == 1){ echo 'checked';}?> class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 25px!important;margin-top: 7px;" id="dateCheck">
                  <label for="dateCheck" style="position: absolute;margin-left: 7px;color:black;margin-top: 7px;">Add dates to message</label>
                <br>
                  <span id="check_add_date2"></span>
              </div> --}}


            </div>
          </div> 
   
          <div class="display_sec">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
               
                
                  <div class="d-flex">
                      <label class="container_radio">
                        <input type="radio" id="tenant_only2" value="tenant" name="show_for2" <?php if(old('show_for2') == 'tenant'){echo 'checked';}?>/>
                        <span class="checkmark"></span>Tenants Only
                      </label>
                      <label class="container_radio mx-4">
                        <input type="radio" id="make_public2" value="public" name="show_for2" <?php if(old('show_for2') == 'public'){echo 'checked';}?>/>
                        <span class="checkmark"></span>Make Public
                      </label>
                    </div>
             
                @if ($errors->has('show_for2'))
                  <div class="error" style="color:red;">{{ $errors->first('show_for2') }}</div>
                @endif
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <p></p>
                  
                      <textarea style="margin-top: 51px;" class="form-control" name="message2" id="textmessage2" rows="3"
                      placeholder="Enter the message">{{$provider_messages->message2}}</textarea>
                      @if ($errors->has('message2'))
                      <div class="error" style="color:red;">{{ $errors->first('message2') }}</div>
                      @endif
                      <a href="javascript:void(0);" id="clear_message_board2" style="margin-left: 66rem;">Clear and remove message</a>
                   
                </div>
                
              </div>
            </div>
          </div> 
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                @if($provider_messages)
                  @if($provider_messages->display_board == 1)
                    <div class="btn-flex" id="display_preview_on">
                      <button type="button" class="btn preview_btn" id="preview" data-bs-toggle="modal" data-bs-target="#preview_modal_publish" style="display:block;">Preview</button>
                      <button class="btn publish_btn" type="submit" name="submit">Publish</button>
                    </div>
                    @else
                    <div class="btn-flex" id="">
                      <button type="button" class="btn preview_btn" id="preview" data-bs-toggle="modal" data-bs-target="#preview_modal_publish" style="display:none;">Preview</button>
                      <button class="btn publish_btn" type="submit" name="submit">Publish</button>
                    </div>
                  @endif
                @else
                    <div class="btn-flex" id="display_preview">
                      <button type="button" class="btn preview_btn" id="preview" data-bs-toggle="modal" data-bs-target="#preview_modal_publish" style="display:block;">Preview</button>
                      <button class="btn publish_btn" type="submit" name="submit">Publish</button>
                    </div>
                @endif
            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

    {{-- //Preview Modal --}}

      <div class="modal preview_modal_faded fade" id="preview_modal_publish" tabindex="-1" role="dialog" aria-labelledby="preview_modal_publishTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">Go back</span>
                  </button>
            </div>
            <div class="modal-body">
                <div class="search_popup_outerss">

                    <div class="search_popup_outerss_nav">
                        <ul>

                           <li class="active"><a href="#url">Home</a></li>
                           <li><a href="#url">Order Online</a></li>
                           <li><a href="#url">Visit Direct Website</a></li>

                        </ul>
                    </div>

                    <div class="search_popup_outerss_phts">
                        <div class="row search_popup_outerss_phts_row gy-5">
                            <div class="col-lg-7 search_popup_outerss_phts_col_lft">
                                <div class="row allen-container-mid-one">
                                      <div class="col-sm-5">
                                          <img src="{{url('/')}}/frontend_assets/images/r-allen.png" class="allen-img-first" alt="">
                                      </div>
                                      <div class="col-sm-7 allen-small-img">
                                          <div class="row">
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen1.png" alt="">
                                              </div>
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen2.png" alt="">
                                              </div>
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen3.png" alt="">
                                              </div>
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen4.png" alt="">
                                              </div>
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen5.png" alt="">
                                              </div>
                                              <div class="col-sm-4"><img src="{{url('/')}}/frontend_assets/images/r-allen6.png" alt="">
                                              </div>
                                          </div>
                                      </div>
                                </div>
                            </div>

                              <div class="col-lg-5 search_popup_outerss_phts_col_rtt">
                                <div class="special_mvmnt_wrapper 1st_board">
                                  <div class="special_mvmnt_wrapper_inr">
                                    <div id="show_msg" class="special_mvmnt_wrapper_inr_top">
                                      Please Select Message Type
                                    </div>
                                    <div class="special_mvmnt_wrapper_inr_btm">
                                      <h4 id="show_start_date"></h4>
                                      <p id="show_text_msg" style="text-transform: initial;"></p>
                                    </div>
                                  </div>
                                </div>
                                <div class="special_mvmnt_wrapper 2nd_board" style="display:none;">
                                  <div class="special_mvmnt_wrapper_inr">
                                    <div id="show_msg2" class="special_mvmnt_wrapper_inr_top">
                                      Please Select Message Type
                                    </div>
                                    <div class="special_mvmnt_wrapper_inr_btm">
                                      <h4 id="show_start_date2"></h4>
                                      <p id="show_text_msg2" style="text-transform: initial;"></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      {{-- EndPreviewModal --}}

   <!--clear message board 1 modal -->
   <div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_message_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="remove_id" value="">
                            <h4>Are you sure you want to clear and remove this message from the message board?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="messageRemove">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!--clear message board 2 modal -->
  <div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_message2_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <input type="hidden" id="remove_id" value="">
                            <h4>Are you sure you want to clear and remove this message from the message board?</h4>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="message2Remove">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
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
          $(document).ready(function() {
              $('#textmessage').summernote({
                  height: 300,
                
                  callbacks : {
                      onChange : function(contents, $editable){
                        $('#textmessage').val(contents);
                      }
                  }
              });

              $('#textmessage2').summernote({
                  height: 300,
                  
                  callbacks : {
                      onChange : function(contents, $editable){
                          $('#textmessage2').val(contents);
                      }
                  }
              });
              
            });

            $(document).ready(function() {
              var base_url = window.location.origin;
               @if($provider_messages)
                @if($provider_messages->display_board == 1)
                    $("#display_board_on").attr('checked',true);
                    $("#display_board_off").attr('checked',false);
                  @else
                    $("#display_board_off").attr('checked',true);
                    $("#display_board_on").attr('checked',false);
                @endif
                @if($provider_messages->message_board_id != null)
                  $("#message_board").val({{$provider_messages->message_board_id}});
                @else
                  $("#message_board").val(' ');
                @endif
                @if($provider_messages->start_date != null)
                  const startdate = new Date('{{$provider_messages->start_date}}');
                  const yyyy0 = startdate.getFullYear();
                  let mm0 = startdate.getMonth() + 1; // Months start at 0!
                  let dd0 = startdate.getDate();
                  if (dd0 < 10) dd0 = '0' + dd0;
                  if (mm0 < 10) mm0 = '0' + mm0;
                  const formattedstart = yyyy0 + '-' + mm0 + '-' + dd0;
                  $("#open_start_date").val(formattedstart);
                @else
                  $("#open_start_date").val(' ');
                @endif
                @if($provider_messages->end_date != null)
                  const enddate = new Date('{{$provider_messages->end_date}}');
                  const yyyy = enddate.getFullYear();
                  let mm = enddate.getMonth() + 1; // Months start at 0!
                  let dd = enddate.getDate();
                  if (dd < 10) dd = '0' + dd;
                  if (mm < 10) mm = '0' + mm;
                  const formattedend = yyyy + '-' + mm + '-' + dd;
                  $("#open_end_date").val(formattedend);
                @else
                  $("#open_end_date").val(' ');
                @endif
                @if($provider_messages->add_message_date != 0)
                  $("input[name='add_date']").attr('checked',true);
                @else
                  $("input[name='add_date']").attr('checked',false);
                @endif
                @if($provider_messages->tenant_only != 0)
                  $("#tenant_only").attr('checked',true);
                  $("#make_public").attr('checked',false);
                @else
                  $("#tenant_only").attr('checked',false);
                  $("#make_public").attr('checked',true);
                @endif
                @if($provider_messages->message != null)
                  $("#textmessage").val('{{$provider_messages->message}}');
                @else
                  $("#textmessage").val(' ');
                @endif
                @if($provider_messages->message_board_id2 != null)
                  $("#message_board2").val({{$provider_messages->message_board_id2}});
                @else
                  $("#message_board2").val(' ');
                @endif
                @if($provider_messages->start_date2 != null)
                  const startdate2 = new Date('{{$provider_messages->start_date2}}');
                  const yyyy3 = startdate2.getFullYear();
                  let mm3 = startdate2.getMonth() + 1; // Months start at 0!
                  let dd3 = startdate2.getDate();
                  if (dd3 < 10) dd3 = '0' + dd3;
                  if (mm3 < 10) mm3 = '0' + mm3;
                  const formattedstart2 = yyyy3 + '-' + mm3 + '-' + dd3;
                  $("#open_start_date2").val(formattedstart2);
                @else
                  $("#open_start_date2").val(' ');
                @endif
                @if($provider_messages->end_date2 != null)
                  const enddate2 = new Date('{{$provider_messages->end_date2}}');
                  const yyyy2 = enddate2.getFullYear();
                  let mm2 = enddate2.getMonth() + 1; // Months start at 0!
                  let dd2 = enddate2.getDate();
                  if (dd2 < 10) dd2 = '0' + dd2;
                  if (mm2 < 10) mm2 = '0' + mm2;
                  const formattedend2 = yyyy2 + '-' + mm2 + '-' + dd2;
                  $("#open_end_date2").val(formattedend2);
                @else
                  $("#open_end_date2").val(' ');
                @endif
                @if($provider_messages->add_message_date2 != 0)
                  $("input[name='add_date2']").attr('checked',true);
                @else
                  $("input[name='add_date2']").attr('checked',false);
                @endif
                @if($provider_messages->tenant_only2 != 0)
                  $("#tenant_only2").attr('checked',true);
                  $("#make_public2").attr('checked',false);
                @else
                  $("#tenant_only2").attr('checked',false);
                  $("#make_public2").attr('checked',true);
                @endif
                @if($provider_messages->message2 != null)
                  $("#textmessage2").val('{{$provider_messages->message2}}');
                @else
                  $("#textmessage2").val(' ');
                @endif
               @endif
               $("input[id='open_start_date']").on('click',function(){
                 if($("input[name='add_date']").is(':checked') == 0){
                     $("#check_add_date").html('Please check above checkbox').css('color','red');
                     $("input[id='open_start_date']").attr('disabled',true);
                 }
                 else{
                  $("#check_add_date").html(' ');
                  $("input[id='open_start_date']").attr('disabled',false);
                 }
               })

               $("input[id='open_end_date']").on('click',function(){
                  if($("input[name='add_date']").is(':checked') == 0){
                     $("#check_add_date").html('Please check above checkbox').css('color','red');
                     $("input[id='open_end_date']").attr('disabled',true);
                  }
                  else{
                    $("#check_add_date").html(' ');
                    $("input[id='open_end_date']").attr('disabled',false);
                  }
               });

               $("input[name='add_date']").on('click',function(){
                  if($("input[name='add_date']").is(':checked') != 0){
                    $("input[id='open_start_date']").attr('disabled',false);
                    $("input[id='open_end_date']").attr('disabled',false);
                  }
                  else{
                    $("input[id='open_start_date']").attr('disabled',true);
                    $("input[id='open_end_date']").attr('disabled',true);
                  }
               });

               $("input[id='open_start_date2']").on('click',function(){
                 if($("input[name='add_date2']").is(':checked') == 0){
                     $("#check_add_date2").html('Please check above checkbox').css('color','red');
                     $("input[id='open_start_date2']").attr('disabled',true);
                 }
                 else{
                  $("#check_add_date2").html(' ');
                  $("input[id='open_start_date2']").attr('disabled',false);
                 }
               });

               $("input[id='open_end_date2']").on('click',function(){
                  if($("input[name='add_date2']").is(':checked') == 0){
                     $("#check_add_date2").html('Please check above checkbox').css('color','red');
                     $("input[id='open_end_date2']").attr('disabled',true);
                  }
                  else{
                    $("#check_add_date2").html(' ');
                    $("input[id='open_end_date2']").attr('disabled',false);
                  }
               });

               $("input[name='add_date2']").on('click',function(){
                  if($("input[name='add_date2']").is(':checked') != 0){
                    $("input[id='open_start_date2']").attr('disabled',false);
                    $("input[id='open_end_date2']").attr('disabled',false);
                  }
                  else{
                    $("input[id='open_start_date2']").attr('disabled',true);
                    $("input[id='open_end_date2']").attr('disabled',true);
                  }
               });

                $('#preview').click(function(){
                    if($("#display_board_off").is(":checked") > 0){
                      // console.log($("#display_board_off").val());
                        
                        $("#preview_modal_publish").modal('show');
                        console.log('123');
                        $("#show_msg").hide();
                        $(".special_mvmnt_wrapper_inr_btm").hide();
                        $('#show_msg2').hide('');
                        $("#show_start_date").html(' ');
                        $('#show_text_msg').html('');
                        $("#show_msg").html('');
                        $("#show_start_date2").html('');
                        $('#show_text_msg2').html('');
                        $('#show_msg2').html('');
                    }
                    else{
                        $("#show_msg").show();
                        $(".special_mvmnt_wrapper_inr_btm").show();
                        $('#show_msg2').show('');
                        if( $('#message_board').val() != null){
                          $(".1st_board").css('display','block');
                            if($('#open_start_date').val() != ''){
                              var tempStartDate = new Date($('#open_start_date').val());
                              var formattedStartDate = [tempStartDate.getMonth() + 1, tempStartDate.getDate(), tempStartDate.getFullYear()];
                              var fsd = formattedStartDate[0]+'-'+formattedStartDate[1]+'-'+formattedStartDate[2];
                              if($('#open_end_date').val() != ''){
                                var tempEndDate = new Date($('#open_end_date').val());
                                var formattedEndDate = [tempEndDate.getMonth() + 1, tempEndDate.getDate(), tempEndDate.getFullYear()];
                                var fed = formattedEndDate[0]+'-'+formattedEndDate[1]+'-'+formattedEndDate[2];
                                if($("input[name='add_date']").is(':checked') != 0){
                                  var msgDate = 'From '+fsd+' to '+ fed;
                                  $("#show_start_date").html(msgDate);
                                }
                                else{
                                  
                                  $("#show_start_date").html(' ');
                                }
                              }
                              else{
                                if($("input[name='add_date']").is(':checked') != 0){
                                  var msgDate = 'From '+fsd+' to Open';
                                  $("#show_start_date").html(msgDate);
                                }
                                else{
                                  $("#show_start_date").html(' ');
                                }
                              }
                            }
                            else{
                              $("#show_start_date").html('');
                            }
                            if($('#textmessage').val() != null){
                              var str = $('#textmessage').val();
                              // str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                              //     return letter.toUpperCase();
                              // });
                              $('#show_text_msg').html(str);
                            }
                            else{
                              $('#show_text_msg').html('');
                            }
                            $('#show_msg').html($("#message_board option:selected").text());
                        }
                        else{
                          $(".1st_board").css('display','none');
                        }
                        if($('#message_board2').val() != null){
                            $(".2nd_board").css('display','block');
                              if($('#open_start_date2').val() != ''){
                                var tempStartDate2 = new Date($('#open_start_date2').val());
                                var formattedStartDate2 = [tempStartDate2.getMonth() + 1, tempStartDate2.getDate(), tempStartDate2.getFullYear()];
                                var fsd2 = formattedStartDate2[0]+'-'+formattedStartDate2[1]+'-'+formattedStartDate2[2];
                                if($('#open_end_date2').val() != ''){
                                  var tempEndDate2 = new Date($('#open_end_date2').val());
                                  var formattedEndDate2 = [tempEndDate2.getMonth() + 1, tempEndDate2.getDate(), tempEndDate2.getFullYear()];
                                  var fed2 = formattedEndDate2[0]+'-'+formattedEndDate2[1]+'-'+formattedEndDate2[2];
                                  if($("input[name='add_date2']").is(':checked') != 0){
                                    var msgDate2 = 'From '+fsd2+' to '+ fed2;
                                    $("#show_start_date2").html(msgDate2);
                                  }
                                  else{
                                    $("#show_start_date2").html(' ');
                                  }
                                  
                                }
                                else{
                                  if($("input[name='add_date2']").is(':checked') != 0){
                                    var msgDate2 = 'From '+fsd2+' to Open';
                                    $("#show_start_date2").html(msgDate2);
                                  }
                                  else{
                                    $("#show_start_date2").html(' ');
                                  }
                                }
                              }
                              else{
                                $("#show_start_date2").html('');
                              }
                              if($('#textmessage2').val() != null){
                                var str2 = $('#textmessage2').val();
                                // str2 = str2.toLowerCase().replace(/\b[a-z]/g, function(letter2) {
                                //     return letter2.toUpperCase();
                                // });
                                $('#show_text_msg2').html(str2);
                              }
                              else{
                                $('#show_text_msg2').html('');
                              }
                              $('#show_msg2').html($("#message_board2 option:selected").text());
                            }
                            else{
                              $(".2nd_board").css('display','none');
                            }
                    }
                   

                    
                    

                    // var start_date = $('#start_date').val();
                    // var end_date = $('#end_date').val();
                    // var tempStartDate = new Date(start_date);
                    // var formattedStartDate = [tempStartDate.getMonth() + 1, tempStartDate.getDate(), tempStartDate.getFullYear()];
                    // var fsd = formattedStartDate[0]+'-'+formattedStartDate[1]+'-'+formattedStartDate[2];
                    // //console.log(formattedStartDate);
                    // var tempEndDate = new Date(end_date);
                    // var formattedEndDate = [tempEndDate.getMonth() + 1, tempEndDate.getDate(), tempEndDate.getFullYear()];
                    // var fed = formattedEndDate[0]+'-'+formattedEndDate[1]+'-'+formattedEndDate[2];
                    // //console.log(formattedEndDate);

                    // var message = $('#message_board').val();
                    // var text_area = $('#textmessage').val();
                    // //console.log(start_date);
                    // var msgDate = 'From '+fsd+' to '+ fed;
                    // $("#show_start_date").html(msgDate);
                    // //$("#show_end_date").html(end_date);
                    // $("#show_text_msg").html(text_area);

                    // $.ajax({
                    //     url: "{{ url('show_message') }}",
                    //     type: 'GET',
                    //     data: {
                    //         'message': message,
                    //     },
                    //     success: function(response) {
                    //         if (response.success == 1) {
                    //             console.log(response.getTitle.title);
                    //             $("#show_msg").html(response.getTitle.title);
                    //         }else{
                    //             $('#show_msg').html('');
                    //         }
                    //     }
                    //  });
                    // }else{
                    //      $("#show_start_date").html(date);
                    //      $("#show_text_msg").html(msg);
                    // }

                });

                $("#clear_message_board").on('click',function(){
                  $("#remove_message_modal").modal('show');
                });
                $("#clear_message_board2").on('click',function(){
                  $("#remove_message2_modal").modal('show');
                });

                $("#messageRemove").on('click',function(){
                  // console.log('ddddddd');

                  $("#remove_message_modal").modal('hide');
                  $("#message_board").val('');
                  // $("#textmessage").val('');
                  
                  $("#open_start_date").val('');
                  $("#open_end_date").val('');
                  if($("input[name='add_date']").is(':checked') > 0){
                    $("input[name='add_date']").attr('checked',false);
                  }
                  // $("#textmessage").val('');
                  $('#textmessage').summernote('code', '');
                  // document.getElementById('textmessage').value = '';
                  if($("input[name='show_for']:checked").val() == 'tenant'){
                    $("input[name='show_for']").attr('checked',false);
                  }
                  if($("input[name='show_for']:checked").val() == 'public'){
                    $("input[name='show_for']").attr('checked',false);
                  }
                });

                $("#message2Remove").on('click',function(){
                  $("#remove_message2_modal").modal('hide');
                  $("#message_board2").val('');
                  $("#open_start_date2").val('');
                  $("#open_end_date2").val('');
                  if($("input[name='add_date2']").is(':checked') > 0){
                    $("input[name='add_date2']").attr('checked',false);
                  }
                  $("#textmessage2").summernote('code', '');
                  if($("input[name='show_for2']:checked").val() == 'tenant'){
                    $("input[name='show_for2']").attr('checked',false);
                  }
                  if($("input[name='show_for2']:checked").val() == 'public'){
                    $("input[name='show_for2']").attr('checked',false);
                  }
                });

                $(document).on('click', '#property_provider', function() {
                  var property_id = $(this).attr('data-property_id');

                  $.ajax({
                      type: 'GET',
                      url: '{{route("frontend.get-message-board")}}',
                      data: {propertyid : property_id},
                      success: function(response) {
                        // console.log(response);
                          if(response.status == 1){
                            $("#propertyid").val(response.data.property.id);
                            $('#change_first').text(response.data.property.name)
                            $('#property_address').text(response.data.property.address)
                            $('#property_id').val(response.data.property.id)
                            $('#distributePoint').text(addCommas(response.data.property.points_to_distribute) +' Points');
                            if(response.data.message_board_id != null){
                              $("#message_board").val(response.data.message_board_id);
                            }
                            else{
                              $("#message_board").val('');
                            }
                            if(response.data.start_date != null){
                              $("#open_start_date").val(response.data.start_date);
                            }
                            else{
                              $("#open_start_date").val('');
                            }
                            if(response.data.end_date != null){
                              $("#open_end_date").val(response.data.end_date);
                            }
                            else{
                              $("#open_end_date").val('');
                            }
                            if(response.data.add_message_date == 0){
                              $("input[name='add_date']").attr('checked',false);
                            }
                            else{
                              $("input[name='add_date']").attr('checked',true);
                            }
                            if(response.data.tenant_only == 0){
                              $("input[id='tenant_only']").attr('checked',false);
                            }
                            else{
                              $("input[id='tenant_only']").attr('checked',true);
                            }
                            if(response.data.make_public == 0){
                              $("input[id='make_public']").attr('checked',false);
                            }
                            else{
                              $("input[id='make_public']").attr('checked',true);
                            }
                            if(response.data.message != null){
                              $("#textmessage").val(response.data.message);
                            }
                            else{
                              $("#textmessage").val('');
                            }

                            if(response.data.message_board_id2 != null){
                              $("#message_board2").val(response.data.message_board_id2);
                            }
                            else{
                              $("#message_board2").val('');
                            }
                            if(response.data.start_date2 != null){
                              $("#open_start_date2").val(response.data.start_date2);
                            }
                            else{
                              $("#open_start_date2").val('');
                            }
                            if(response.data.end_date2 != null){
                              $("#open_end_date2").val(response.data.end_date2);
                            }
                            else{
                              $("#open_end_date2").val('');
                            }
                            if(response.data.add_message_date2 == 0){
                              $("input[name='add_date2']").attr('checked',false);
                            }
                            else{
                              $("input[name='add_date2']").attr('checked',true);
                            }
                            if(response.data.tenant_only2 == 0){
                              $("input[id='tenant_only2']").attr('checked',false);
                            }
                            else{
                              $("input[id='tenant_only2']").attr('checked',true);
                              //$("input[id='tenant_only2"+response.data.id+"']").attr('checked',true);
                            }
                            if(response.data.make_public2 == 0){
                              $("input[id='make_public2']").attr('checked',false);
                            }
                            else{
                              $("input[id='make_public2']").attr('checked',true);
                            }
                            if(response.data.message2 != null){
                              $("#textmessage2").val(response.data.message2);
                            }
                            else{
                              $("#textmessage2").val('');
                            }
                            if(response.data.status == 1){
                              $('#preview').css('display', 'block');
                              $("#display_board_off").prop('checked',false);
                              $("#display_board_on").prop('checked',true);
                             
                            }else{
                              // console.log('123');
                              $('#preview').css('display', 'none');
                              $("#display_board_off").prop('checked',true);
                              $("#display_board_on").prop('checked',false);
                            }
                            
                            
                          }
                          else{
                            // console.log('123');
                            $('#preview').css('display', 'block');
                            $("#display_board_off").prop('checked',false);
                            $("#display_board_on").prop('checked',false);
                            $("#propertyid").val(response.data.id);
                            $('#change_first').text(response.data.name)
                            $('#property_address').text(response.data.address)
                            $('#property_id').val(response.data.id)
                            $('#distributePoint').text(response.data.points_to_distribute +' Points');
                            $("#message_board").val('');
                            $("#open_start_date").val('');
                            $("#open_end_date").val('');
                            $("input[name='add_date']").attr('checked',false);
                            $("input[name='show_for']").attr('checked',false);
                            $("input[name='display_board']").attr('checked',false);
                            $("#textmessage").val('');
                            $("#message_board2").val('');
                            $("#open_start_date2").val('');
                            $("#open_end_date2").val('');
                            $("input[name='add_date2']").attr('checked',false);
                            $("input[name='show_for2']").attr('checked',false);
                            $("#textmessage2").val('');
                          }
                          
                      }
                  });

                });
            });
  </script>
  @endpush

</x-layouts.provider-layout>
