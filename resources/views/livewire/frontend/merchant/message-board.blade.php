<div>
    @push('style')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @endpush
    <div
        class="all-smart-rental-database-main-sec show-filled-units-only corporate-lead-setting-1-main-sec loyality-rewards-program-sec-main">
        <div class="middle-smart-rental-sec">
            <div class="container">
                <div class="middle-smart-rental-sec-all">
                    <div class="row gy-4">
                        <div class="col-md-9">
                            <div class="all-corporate-lead-seting-1-flex neww">
                                <div class="left-sec-home">
                                    <span>
                                        <img src="{{ Auth::user()->merchantBusiness->logo_image }}" alt=""
                                            style="width: 102px;height: 87px;border-radius: 4px;" />
                                    </span>
                                </div>
                                <div class="right-sec-rental">
                                    <h3>{{ Auth::user()->merchantBusiness->business_name }}</h3>
                                    <select wire:model="merchant_main_location" class="form-control"
                                        wire:change.prevent='getLocationDetail' style="width: 50%;">
                                        @if ($merchant_location)
                                            @foreach ($merchant_location as $locations)
                                                <option value="{{ $locations->businessLocation->id }}">
                                                    {{ $locations->businessLocation->location_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="apartments-sec" style="margin-top: 25px;">
                                        <ul>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/location-icon-rental-1.svg') }}"
                                                                alt="" /></span>
                                                        Address:
                                                        <span class="points-distributed-txt">
                                                            {{ $location }}
                                                        </span>
                                                    </h6>
                                                </div>
                                                <div class="apartment-right-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/email-icon-1-rental.svg') }}"
                                                                alt="" /></span>Mail:<span
                                                            class="points-distributed-txt" id="change_email">
                                                            @foreach ($merchant_location as $locations)
                                                                @if ($locations->is_main == 1)
                                                                    {{ $locations->businessLocation->business_email }}
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="left-apartments-data">
                                                    <h6>
                                                        <span class="icon-img-sec-rental"><img
                                                                src="{{ asset('frontend_assets/images/call-16.svg') }}"
                                                                alt="" /></span>Phone:
                                                        <span class="number-txt" id="change_phone">
                                                            @foreach ($merchant_location as $locations)
                                                                @if ($locations->is_main == 1)
                                                                    {{ $locations->businessLocation->business_phone }}
                                                                @endif
                                                            @endforeach
                                                        </span>
                                                    </h6>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="right-sec-account-status-lead-setting-1">
                                <figure>
                                    @if(auth()->user()->profile_image)
                                        <img src="{{auth()->user()->profile_image}}" alt="">
                                    @else
                                       <img src="{{ asset('frontend_assets/images/lead-setting-people-icon.svg') }}" alt="">
                                    @endif
                                </figure>
                                <h3>Account Status</h3>
                                @if (Auth::user()->merchantBusiness->status == 1)
                                    <p style="color: green;"><i style="background: green;"></i>Active</p>
                                @elseif(Auth::user()->merchantBusiness->status == 0)
                                    <p style="color: red;"><i style="background: red;"></i>Inactive</p>
                                @elseif(Auth::user()->merchantBusiness->status == 2)
                                    <p style="color: #ffb822;"><i style="background: #ffb822;"></i>Pending</p>
                                @elseif(Auth::user()->merchantBusiness->status == 3)
                                    <p style="color: #5578eb;"><i style="background: #5578eb;"></i>Does Not Meet
                                        Merchant Guidelines</p>
                                @elseif(Auth::user()->merchantBusiness->status == 4)
                                    <p style="color: #b80abb;"><i style="background: #b80abb;"></i>Saved</p>
                                @else
                                    <p style="color: red;"><i style="background: red;"></i>Pending</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="first-smart-rental-sec" style="padding-bottom: 0px;">
                <div class="container">
                    <h2>Gimmzi Page Message Boards</h2>
                </div>
            </div>
            <form method="post" wire:submit.prevent="submitMerchantMessageboard">
                <div class="message_board">
                    <div class="display_sec">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 margin_cls">
                                    <div style="margin-bottom: 40px;">
                                        <select wire:model.defer="location_id" class="form-control"
                                            id="participating_location" wire:change.prevent='changeLocationBoard'
                                            style="width: 50%;">
                                            <option>Select a participating location</option>
                                            @if ($business_locations)
                                                @foreach ($business_locations as $participating)
                                                    <option value="{{ $participating->id }}">
                                                        {{ $participating->location_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="d-flex align-items-center max_cls">
                                        <h6>Display Message Boards</h6>
                                        <div class="d-flex">
                                            <label class="container_radio">

                                                <input type="radio" value="1" name="display_board"
                                                    wire:model.defer="status" />
                                                <span class="checkmark"></span>On
                                            </label>
                                            <label class="container_radio mx-4">
                                                <input type="radio" value="0" name="display_board"
                                                    wire:model.defer="status" />
                                                <span class="checkmark"></span>Off
                                            </label>

                                        </div>
                                    </div>
                                    @error('status')
                                        <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    

                                    <p>
                                        Display to be viewed by Smart Rewards users and all traffic that comes to your
                                        Gimmzi page. Add notes for users to view on your merchant site such as upcoming
                                        events, newly added locations and weekly specials.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form_section_area">

                        <div class="container form_margin">
                            <div class="row">

                                <div class="col-sm-4 top-space18">
                                    {{-- @dd($user_message_board) --}}
                                    {{-- @if ($main_location) --}}

                                        <select class="form-select" id="display_board_id"
                                            wire:model.defer="display_board_id" aria-label="Default select example" >
                                            <option value="">Select Message Type</option>
                                            <option value="0">None (This option will not display a message board)</option>

                                            @foreach ($display_board as $display)
                                                <option value="{{ $display->id }}">{{ $display->title }}</option>
                                            @endforeach
                                        </select>

                                    {{-- @endif --}}
                                </div>
                            
                                @error('display_board_id')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror
                            
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3" wire:ignore>
                                        <p></p>
                                        {{-- @if ($main_location) --}}
                                        {{-- @dd($description,$display_board_id) --}}
                                            <textarea style="margin-top: 51px;" class="form-control" wire:model.defer="description" id="merchant_message"
                                                rows="3" placeholder="Enter the message">{{ $description }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="error" style="color:red;">
                                                    {{ $errors->first('description') }}</div>
                                            @endif
                                            
                                            <a href="javascript:void(0);" wire:click.prevent ="clearMessage"
                                                style="margin-left: 65rem;">Clear and remove message</a>

                                        {{-- @endif --}}
                                    </div>
                                   

                                </div>
                            </div>
                        </div>

                        <div class="container form_margin">
                            <div class="row">

                                <div class="col-sm-4 top-space18">

                                    @if ($main_location)

                                        <select class="form-select" id="display_board_id2"
                                            wire:model.defer="display_board_id2" aria-label="Default select example">
                                            <option value="">Select Message Type</option>
                                            <option value="0">None (This option will not display a message board)</option>

                                            @foreach ($display_board as $display)
                                                <option value="{{ $display->id }}">{{ $display->title }}</option>
                                            @endforeach
                                        </select>

                                    @endif
                                </div>
                                @error('display_board_id2')
                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                    {{ $message }}
                                </span>
                                @enderror


                            </div>
                        </div>



                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3" wire:ignore>
                                        <p></p>
                                        @if ($main_location)
                                            <textarea style="margin-top: 51px;" class="form-control" wire:model.defer="description2" id="merchant_message2"
                                                rows="3" placeholder="Enter the message">{{ $description2}}</textarea>
                                                {{-- @error('description2')
                                                <span class="invalid-message" role="alert" style="font-size: 12px; color:red;">
                                                    {{ $message }}
                                                </span>
                                                @enderror --}}
                                            @if ($errors->has('description2'))
                                                <div class="error" style="color:red;">
                                                    {{ $errors->first('description2') }}</div>
                                            @endif
                                            <a href="javascript:void(0);" wire:click.prevent ="clearMessage2"
                                                style="margin-left: 65rem;">Clear and remove message</a>

                                        @endif
                                    </div>
                                   
    

                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    {{-- @if ($user_message_board)
                                  @if ($user_message_board->status == 1) --}}
                                    <div class="btn-flex">
                                        <button type="button" class="btn preview_btn" wire:click='previewMessageBoard'
                                            style="display:block;">Preview</button>
                                        <button class="btn publish_btn" type="submit"
                                            name="submit">Publish</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

      {{-- preview modal --}}
      <div wire:ignore.self class="modal preview_modal_faded fade" id="preview_modal_publish" tabindex="-1" role="dialog" aria-labelledby="preview_modal_publishTitle" aria-hidden="true">
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
                              <span>Hotel/Resort</span>
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
                              <span>Hotel/Resort</span>
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
                              <span>Hotel/Resort</span>
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

      <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="infomsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd hideInfoModal"
                                    >ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- start success modal --}}
    <div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="textmsg"></h3>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd closeModal">ok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end success modal --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
              

        });

            document.addEventListener('livewire:load', function (event) {
                        $('#merchant_message').summernote({
                        height: 300,
                        placeholder: 'Enter the message',
                        callbacks : {
                            onChange : function(contents, $editable){
                                @this.set("description", contents);
                            }
                        }
                    });

                    $('#merchant_message2').summernote({
                        height: 300,
                        placeholder: 'Enter the message',
                        callbacks : {
                            onChange : function(contents, $editable){
                                @this.set("description2", contents);
                            }
                        }
                    });

                    Livewire.on('descriptionUpdated', (newDescription) => {
                        if (newDescription) {
                            $('#merchant_message').summernote('code', newDescription);
                        } else {
                            $('#merchant_message').summernote('code', ''); // Reset content to show placeholder
                            $('#merchant_message').summernote('reset'); // Ensure placeholder appears
                        }
                    });

                    Livewire.on('description2Updated', (newDescription2) => {
                        if (newDescription2) {
                            $('#merchant_message2').summernote('code', newDescription2);
                        } else {
                            $('#merchant_message2').summernote('code', ''); // Reset content to show placeholder
                            $('#merchant_message2').summernote('reset'); // Ensure placeholder appears
                        }
                    });

                    Livewire.on('descriptionCleared', () => {
                        $('#merchant_message').summernote('code', ''); // Clear the content in Summernote
                        $('#merchant_message').summernote('reset'); // Ensure placeholder appears
                        document.getElementById('display_board_id').value = '';
                    });

                    Livewire.on('clear_message2', () => {
                        $('#merchant_message2').summernote('code', ''); // Clear the content in Summernote
                        $('#merchant_message2').summernote('reset'); // Ensure placeholder appears
                        document.getElementById('display_board_id2').value = '';
                    });

                    @this.on('openPreview',data =>{
                        if(data.message_type != ''){
                        $(".1st_board").css('display','block');
                        $('#show_msg').html(data.message_type);
                        $('#show_text_msg').html(data.message);
                
                        }
                        else{
                        $(".1st_board").css('display','none');
                        }
                        
                        if(data.message_type2 != ''){
                        $(".2nd_board").css('display','block');
                        $('#show_msg2').html(data.message_type2);
                        $('#show_text_msg2').html(data.message2);
                        
                        }
                        else{
                        $(".2nd_board").css('display','none');
                        }
                        
                        $('#preview_modal_publish').modal('show');
                    });
                    // @this.on('clear_message', function () {

                    //     @this.set('description', "");
                    // });
                    // @this.on('clear_message2', function () {
                    
                    
                    //     @this.set('description2', "");
                    // });

                  @this.on('infoModal', data =>{
                      $('#message_modal2').modal('show');
                      $("#infomsg").html(data.text);   
                  });
                  @this.on('closeInfo', data =>{
                      $('#message_modal2').modal('hide');
                      $("#infomsg").html('');   
                  });
                @this.on('successModal',data =>{
                    $('#message_modal').modal('show');
                    $('#textmsg').text(data.text);
                })
            })

        // window.livewire.on('successModal', data=> {
        //     // console.log(true);
           
        //  })
         $(".closeModal").on('click',function(){
                   
                    $('#message_modal').modal('hide');
                    $('#textmsg').text('');
         })
            $(".hideInfoModal").on('click',function(){
                   
                   $('#message_modal2').modal('hide');
                   $('#infomsg').text('');
        })
    </script>
    @endpush
</div>



   

  
