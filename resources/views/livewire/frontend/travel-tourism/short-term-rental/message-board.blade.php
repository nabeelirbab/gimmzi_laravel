<div>
  @push('style')
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
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
                            <h3>{{$user->travelType->name}}</h3>
                            <p class="alen-park-text1 img-b-space1">
                                <span class="p-responsive-main location-image-icon img-b-space1">
                                    <label>
                                        <strong>Address:</strong></label>
                                        <label>{{$user->travelType->address}}</label>
                                </span>
                                <span class="p-responsive-main">
                                    <span class="mail-image-icon"></span>
                                    <label><strong>Mail:</strong></label>
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </span>
                            </p>
                            <p class="alen-park-text1 alen-park-text1 star-image-icon">
                                <label>Total Points to Distribute:</label>
                                <span class="alen-park-text1">
                                    {{number_format($user->travelType->points_to_distribute)}} Points
                                </span>
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
        <div>
          <form method="post" wire:submit.prevent="addMessageBoard">
            
            <div class="message_board">
              <div class="display_sec">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12 margin_cls">
                      <div class="d-flex align-items-center max_cls">
                        <h6>Display Message Boards</h6>
                          <div class="d-flex" >
                            <label class="container_radio">
                              
                              <input type="radio" value="1"  name="display_board"  wire:model.defer="status"/>
                              <span class="checkmark"></span>On
                            </label>
                            <label class="container_radio mx-4">
                              <input type="radio" value="0" name="display_board"  wire:model.defer="status" />
                              <span class="checkmark"></span>Off
                            </label>
                            
                          </div>
                      </div>
                      @error('status')
                          <span class="invalid-message" role="alert"
                              style="font-size: 12px; color:red;">
                              {{ $message }}
                          </span>
                      @enderror
                      
                      <p>
                          Display to be viewed by all Smart Rewards members. Use the message boards to communicate with your guests as well as potential guests. Choose up to two message boards at a time. Topics include Local Specials, Announcements, Upcoming Events, and Need to Know.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form_section_area">
        
                  <div class="container form_margin">
                    <div class="row">
        
                      <div class="col-sm-4 top-space18">
                      
                          <select class="form-select" wire:model="message_board_id" aria-label="Default select example">
                            <option value="">Select Message Type</option>
                            @foreach ($type as $item)
                            <option value="{{ $item->id }}" >{{ $item->title }}</option>
                            @endforeach
                          </select>
                          @error('message_board_id')
                              <span class="invalid-message" role="alert"
                                  style="font-size: 12px; color:red;">
                                  {{ $message }}
                              </span>
                          @enderror
                      </div>
        
        
                      <div class="col-sm-4 top-space18">
                          {{-- <input type="date" id="open_start_date" wire:model.defer="start_date" /> --}}
                      {{-- @error('start_date')
                          <span class="invalid-message" role="alert"
                              style="font-size: 12px; color:red;">
                              {{ $message }}
                          </span>
                      @enderror --}}
                      </div>
                      <div class="col-sm-4 top-space18">
                          {{-- <input type="date" id="open_end_date" wire:model.defer="end_date" /> --}}
                          
                          {{-- @error('end_date')
                              <span class="invalid-message" role="alert"
                                  style="font-size: 12px; color:red;">
                                  {{ $message }}
                              </span>
                              <br>
                          @enderror --}}
                        
                          {{-- <input type="checkbox" wire:model.defer="add_message_date" class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 25px!important;margin-top: 7px;" id="dateCheck">
                          <label for="dateCheck" style="position: absolute;margin-left: 7px;color:black;margin-top: 7px;">Add dates to message</label> --}}
                    
                        <br>
                        {{-- @error('add_message_date')
                          <span class="invalid-message" role="alert"
                              style="font-size: 12px; color:red;">
                              {{ $message }}
                          </span>
                          @enderror --}}
                      </div>
                    </div>
                  </div>

                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3" wire:ignore>

                            <textarea style="margin-top: 51px;" class="form-control" wire:model.defer="message" id="message" ></textarea>
                          
                            <a href="javascript:void(0);" wire:click.prevent ="clearMessage"  style="margin-left: 65rem;">Clear and remove message</a>
                          
                        </div>
                        @error('message')
                          <span class="invalid-message" role="alert"
                              style="font-size: 12px; color:red;">
                              {{ $message }}
                          </span>
                        @enderror
                        
                      </div>
                    </div>
                  </div>
        
                  <div class="container form_margin">
                    <div class="row">
        
                      <div class="col-sm-4 top-space18">
                          <select class="form-select" wire:model.defer="message_board_id2" aria-label="Default select example">
                            <option value="" >Select Message Type</option>
                            @foreach ($type as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                          </select>
                          @error('message_board_id2')
                              <span class="invalid-message" role="alert"
                                  style="font-size: 12px; color:red;">
                                  {{ $message }}
                              </span>
                          @enderror
                      </div>
        
                      <div class="col-sm-4 top-space18">
                          {{-- <input type="date" id="open_start_date2" wire:model.defer="start_date2" />
                          @error('start_date2')
                              <span class="invalid-message" role="alert"
                                  style="font-size: 12px; color:red;">
                                  {{ $message }}
                              </span>
                          @enderror --}}
                            
                      </div>
        
        
                      <div class="col-sm-4 top-space18">
                          {{-- <input type="date"  id="open_end_date2" wire:model.defer="end_date2"  />
                          @error('end_date2')
                              <span class="invalid-message" role="alert"
                                  style="font-size: 12px; color:red;">
                                  {{ $message }}
                              </span>
                              <br>
                          @enderror --}}
                          {{-- <input type="checkbox" wire:model.defer="add_message_date2" class="assign-one1 check_no_checkbox" style="width: 25px!important;height: 25px!important;margin-top: 7px;" id="dateCheck">
                          <label for="dateCheck" style="position: absolute;margin-left: 7px;color:black;margin-top: 7px;">Add dates to message</label> --}}
                        <br>
                          {{-- <span id="check_add_date2"></span> --}}
                      </div>
                    </div>
                  </div> 
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="mb-3" wire:ignore>

                            <textarea style="margin-top: 51px;" class="form-control" wire:model.defer="message2" id="message2" rows="3"
                            placeholder="Enter the message"></textarea>
                          
                            <a href="javascript:void(0);" wire:click.prevent ="clearMessage2" style="margin-left: 65rem;">Clear and remove message</a>
                          
                        </div>
                        @error('message2')
                          <span class="invalid-message" role="alert"
                              style="font-size: 12px; color:red;">
                              {{ $message }}
                          </span>
                        @enderror
                        
                      </div>
                    </div>
                  </div> 
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="btn-flex" id="display_preview">
                          <button type="button" class="btn preview_btn" wire:click='previewMessageBoard' style="display:block;">Preview</button>
                          <button class="btn publish_btn" type="submit" name="submit">Publish</button>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          {{-- Modal div start --}}
          <div>
            {{-- preview modal --}}
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
                              <li><a href="#url">Book Online</a></li>
                              <li><a href="#url">Guest Portal</a></li>
                              <li><a href="#url">Book Online</a></li>
                              <li><a href="#url">Visit Direct Website</a></li>
                              <li><a href="#url">Contact us</a></li>
  
                          </ul>
                      </div>
                        <div class="search_popup_outerss_phts">
                          <div class="row search_popup_outerss_phts_row gy-5">
                            <div class="col-lg-7 search_popup_outerss_phts_col_lft">
                              <div class="row allen-container-mid-one">
                                <div class="col-sm-4">
                                  <div>
                                    <img src="{{url('/')}}/frontend_assets/images/hotel1.jpg" class="allen-img-first" alt="">
                                  </div>
                                  <div class="listing_preview">
                                    <h3>Sunset Place</h3>
                                    <span>Other</span>
                                    <ul>
                                      <li>Bed:5</li>
                                      <li>Bath:2</li>
                                      <li>Bed:5</li>
                                    </ul>
                                  </div> 
                                </div>
                                <div class="col-sm-4">
                                  <div>
                                    <img src="{{url('/')}}/frontend_assets/images/hotel2.jpg" class="allen-img-first" alt="">
                                  </div>
                                  <div class="listing_preview">
                                    <h3>By The Beach</h3>
                                    <span>Condo</span>
                                    <ul>
                                      <li>Bed:5</li>
                                      <li>Bath:2</li>
                                      <li>Bed:5</li>
                                    </ul>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div>
                                    <img src="{{url('/')}}/frontend_assets/images/hotel3.jpg" class="allen-img-first" alt="">
                                  </div>
                                  <div class="listing_preview">
                                    <h3>Sky View Paris</h3>
                                    <span>House</span>
                                    <ul>
                                      <li>Bed:5</li>
                                      <li>Bath:2</li>
                                      <li>Bed:5</li>
                                    </ul>
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

            {{-- infomodal --}}
            <div class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-body">
                          <div class="wrap_modal_cntntr">
                              <div class="cmn_secthd_modals">
                                  <h3 id="infomsg"></h3>
                              </div>

                              <div class="cmn_secthd_modals_btnnn">
                                  <div class="btn_foot_end centr">
                                      <button class="btn_table_s blu auto_wd"
                                          wire:click="hideInfoModal">ok</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
          {{-- Modal div end --}}
          @push('scripts')
          <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
          <script>
            $(document).ready(function() {
              
              
            });
            document.addEventListener('livewire:load', function (event) {
              $('#message').summernote({
                  height: 300,
                
                  callbacks : {
                      onChange : function(contents, $editable){
                          @this.set("message", contents);
                      }
                  }
              });

              $('#message2').summernote({
                  height: 300,
                  
                  callbacks : {
                      onChange : function(contents, $editable){
                          @this.set("message2", contents);
                      }
                  }
              });

              Livewire.on('clear_message', () => {
                $('#message').summernote('code', '');
                $('#message').summernote('reset'); // for showing placeholder
              });
              Livewire.on('clear_message2', () => {
                $('#message2').summernote('code', '');
                $('#message2').summernote('reset'); 
              });
              // @this.on('clear_message', function () {
              //   console.log(@this.get('message'));
              //   @this.set('message', "");
              // });
              // @this.on('clear_message2', function () {
              //   console.log(@this.get('message2'));
              //   @this.set('message2', "");
              // });
              @this.on('openPreview',data =>{
                if(data.message_type != ''){
                  $(".1st_board").css('display','block');
                  $('#show_msg').html(data.message_type);
                  $('#show_text_msg').html(data.message);
                  if(data.start_date != ''){
                    if(data.end_date != ''){
                      $('#show_start_date').html(data.start_date+' To '+data.end_date);
                    }
                    else{
                      $('#show_start_date').html(data.start_date+' To Open');
                    }
                  }
                  else{
                    $('#show_start_date').html('');
                  }
                }
                else{
                  $(".1st_board").css('display','none');
                }
                
                if(data.message_type2 != ''){
                  $(".2nd_board").css('display','block');
                  $('#show_msg2').html(data.message_type2);
                  $('#show_text_msg2').html(data.message2);
                  if(data.start_date2 != ''){
                    if(data.end_date2 != ''){
                      $('#show_start_date2').html(data.start_date2+' To '+data.end_date2);
                    }
                    else{
                      $('#show_start_date2').html(data.start_date2+' To Open');
                    }
                  }
                  else{
                    $('#show_start_date2').html('');
                  }
                }
                else{
                  $(".2nd_board").css('display','none');
                }
                
                $('#preview_modal_publish').modal('show');
              });
              @this.on('infoModal', data =>{
                  $('#message_modal').modal('show');
                  $("#infomsg").html(data.text);   
              });
              @this.on('closeInfo', data =>{
                  $('#message_modal').modal('hide');
                  $("#infomsg").html('');   
              });
            });



            
               
          </script>
            
          @endpush
        </div>

</div>
